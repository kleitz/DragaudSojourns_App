<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\Billing as billing;
use App\Traveler;
use App\Trip;
use App\Group;
// Credentials
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
// Processing and issuing
use PayPal\Api\FundingInstrument;
use PayPal\Api\Authorization;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentCard;
use PayPal\Api\PaymentExecution;
// Transaction details
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
// Collection and updating
use PayPal\Api\Capture;

class PaypalController extends Controller
{
  // Paypal credential variables
  private $apiContext;
  private $mode;
  private $client_id;
  private $secret;
  private $billing;

  // Create a new instance with our paypal credentials
  public function __construct(billing $billing)
  {
    $this->billing = $billing;
    // Detect if we are running in live mode or sandbox
    if (config('paypal.settings.mode') == 'live'){
        $this->client_id = config('paypal.live_client_id');
        $this->secret = config('paypal.live_secret');
    } else {
        $this->client_id = config('paypal.sandbox_client_id');
        $this->secret = config('paypal.sandbox_secret');
    }

    // Set the Paypal API Context/Credentials
    $this->apiContext = new ApiContext(new OAuthTokenCredential($this->client_id, $this->secret));
    $this->apiContext->setConfig(config('paypal.settings'));
  }

  // Process credit card purchase
  public function process(Request $request)
  {
    $payment = $request->input('payment');
    $attempted = $this->billing->attempted($payment);

    $name = explode(' ', $payment['card_holder']);
    $first = $name[0];
    $last = '';
    foreach ($name as $key => $value) {
      if ($key > 0) $last .= ' ' . $value;
    }

    $card = new PaymentCard();
    $card->setType($payment['type'])
        ->setNumber($payment['card_number'])
        ->setExpireMonth($payment['exp_m'])
        ->setExpireYear($payment['exp_y'])
        ->setCvv2($payment['cvv2'])
        ->setFirstName($first)
        ->setLastName($last)
        ->setBillingCountry("US");

    $fi = new FundingInstrument();
    $fi->setPaymentCard($card);

    $payer = new Payer();
    $payer->setPaymentMethod("credit_card")
        ->setFundingInstruments(array($fi));

    $amount = new Amount();
    $amount->setCurrency("USD")
        ->setTotal($payment['amount']);

    $transaction = new Transaction();
    $transaction->setAmount($amount)
  	    ->setDescription('Credit card transaction made by: ' . $payment['card_holder'])
  	    ->setInvoiceNumber($attempted);

    $sale = new Payment();
    $sale->setIntent("sale")
        ->setPayer($payer)
        ->setTransactions(array($transaction));

    try {
        $sale->create($this->apiContext);
        $saleId = $sale->transactions[0]->related_resources[0]->sale->id;
        $capture = Capture::get($saleId, $this->apiContext);

        $payment['fee'] = $capture->transaction_fee->value;
        $payment['paypal_id'] = $saleId;
        $payment['attempt'] = $attempted;
        // $verification = $this->billing->store($payment);

        return 'null';
    }  catch (PayPalConnectionException $e) {
        echo $e->getData();
        exit(1);
    } catch (Exception $e) {
        echo $e->getMessage();
        exit(1);
    }
  }

  // Create connection with paypal for login
  public function create(Request $request){
    $trip = Trip::find($request->input('trip_id'));
    $group = Group::find($trip->group_id);
    $traveler = Traveler::find($trip->traveler_id);

    $payment = [];
    foreach ($request->input() as $key=>$value) {
      $payment[$key] = $value;
    }
    $attempted = $this->billing->attempted($payment);

    $payer = new Payer();
    $payer->setPaymentMethod("paypal");

    $item = new Item();
    $item->setName("Payment for Group ". $group->number)
        ->setCurrency('USD')
        ->setQuantity(1)
        ->setPrice($request->input('amount'));

    $itemList = new ItemList();
    $itemList->setItems([$item]);

    $details = new Details();
    $details->setSubtotal($request->input('amount'));

    $amount = new Amount();
    $amount->setCurrency('USD')
        ->setTotal($request->input('amount'))
        ->setDetails($details);

    $transaction = new Transaction();
    $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription('Payment for '.$traveler->name."'s trip to ". $group->destination. " on ". $group->depart)
        ->setInvoiceNumber($attempted);

    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl(url('/testpaypal'))
        ->setCancelUrl(url('/testpaypal'));

    $direct = new Payment();
    $direct->setIntent('sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions([$transaction]);

    try {
        $direct->create($this->apiContext);
        $approvalUrl = $direct->getApprovalLink();
        return $direct;
    }  catch (PayPalConnectionException $e) {
        echo $e->getData();
        exit(1);
    } catch (Exception $e) {
        echo $e->getMessage();
        exit(1);
    }
  }

  public function execute(Request $request){
    $paymentId = $request->input('paymentID');
    $payerId = $request->input('payerID');
    $trip = Trip::find($request->input('trip_id'));

    $payment = [];
    $payment['method'] = 'paypal';
    $payment['paypal_id'] = $paymentId;
    $payment['user_id'] = $trip->user_id;
    $payment['trip_id'] = $trip->id;
    $payment['amount'] = $request->input('amount');
    $payment['balance'] = $trip->total - $trip->paid;

    $direct = Payment::get($paymentId, $this->apiContext);

    $execution = new PaymentExecution();
    $execution->setPayerId($payerId);

    $details = new Details();
    $details->setShipping(0.0)
       ->setTax(0.0)
       ->setSubtotal($payment['amount']);

    $amount = new Amount();
    $amount->setCurrency('USD')
      ->setTotal($payment['amount'])
      ->setDetails($details);

    $transaction = new Transaction();
    $transaction->setAmount($amount);

    $execution->addTransaction($transaction);

    try {
        $sale = $direct->execute($execution, $this->apiContext);
        $saleId = $sale->transactions[0]->related_resources[0]->sale->id;
        $capture = Capture::get($saleId, $this->apiContext);

        $payment['fee'] = $capture->transaction_fee->value;
        $payment['paypal_id'] = $saleId;
        $payment['attempt'] = $capture->invoice_number;
        $verification = $this->billing->store($payment);
        try {
            $direct = Payment::get($paymentId, $this->apiContext);
            return $verification;
        }  catch (PayPalConnectionException $e) {
            echo $e->getData();
            exit(1);
        }
    }  catch (PayPalConnectionException $e) {
        echo $e->getData();
        exit(1);
    }

    return $direct;
  }

  public function history($records, $start_at){
    try {
        $params = array('count' => $records, 'start_index' => $start_at);
        $payments = Payment::all($params, $this->apiContext);
    } catch (Exception $ex) {
      echo $e->getData();
      exit(1);
    }

    return $payments;
  }

  public function details(Request $request){
    $saleId = $request->input('paypal_id');
    $capture = Capture::get($saleId, $this->apiContext);
    return $capture;
  }

}
