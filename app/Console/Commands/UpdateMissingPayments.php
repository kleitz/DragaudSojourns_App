<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateMissingPayments extends Command
{

  protected $signature = 'UpdateMissingPayments:fix';
  protected $description = 'Stores any missed payments present in Paypal';

  public function __construct()
  {
    parent::__construct();
  }

  public function handle()
  {
    $payments = app('App\Http\Controllers\PaypalController')->history(20, 0);

    $entries = [];
    for ($i = 0; $i < 20; $i++)
    {
      $entry = $payments->payments[$i];
      if ( $entry->state == 'approved')
      {
        $payment = [];
        $payment['attempt'] = $entry->transactions[0]->invoice_number;
        $payment['paypal_id'] = $entry->transactions[0]->related_resources[0]->sale->id;
        $payment['fee'] = $entry->transactions[0]->related_resources[0]->sale->transaction_fee->value;
        array_push($entries, $payment);
      }
    }
    $verification = app('App\Repositories\Billing')->fixMissing($entries);

    return $verification;
  }

}
