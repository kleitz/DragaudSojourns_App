<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Group;
use App\Trip;
use App\User;
use App\Traveler;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Elibyy\TCPDF\Facades\TCPDF;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trip = $request->input('payment.trip_id');
        $amount = $request->input('payment.amount');
        $verification = time();

        $curTrip = Trip::find($trip);
        $curTrip->paid = $curTrip->paid + $amount;
        $curTrip->save();

        $payment = Payment::create([
            'method' => $request->input('payment.method'),
            'paypal_id' => $request->input('payment.paypal_id'),
            'user_id' => $request->input('payment.user_id'),
            'trip_id' => $trip,
            'amount' => $amount,
            'fee' => $request->input('payment.fee'),
            'balance' => $request->input('payment.balance'),
            'verification' => $verification
          ]);

          $returnData = new \stdClass();
          $returnData->verification = $verification;
          $returnData->status = 'SUCCESS';
          return json_encode($returnData);
    }

    public function createReceipt($verification){

      $payment = Payment::where('verification', $verification)->first();
      $trip = Trip::find($payment->trip_id);
      $user = User::find($payment->user_id);
      $group = Group::find($trip->group_id);
      $traveler = Traveler::find($trip->traveler_id);

      $view = \View::make('auth.receipts.payment', compact('payment', 'trip', 'user', 'group', 'traveler'));

      $html = $view->render();

      $pdf = new TCPDF();

      $pdf::SetTitle('Draguad Sojourns Receipt');
      $pdf::AddPage();
      $pdf::writeHTML($html, true, false, true, false, '');

      $pdf::Output('dragaud_sojourns_receipt.pdf');
    }

    public function createTripReceipt($trip_id){

      $trip = Trip::find($trip_id);
      $user = User::find($trip->user_id);
      $group = Group::find($trip->group_id);
      $traveler = Traveler::find($trip->traveler_id);

      $payments = Payment::where('trip_id', $trip_id)->get();

      $view = \View::make('auth.receipts.trip', compact('payments', 'trip', 'user', 'group', 'traveler'));

      $html = $view->render();

      $pdf = new TCPDF();

      $pdf::SetTitle('Draguad Sojourns Receipt');
      $pdf::AddPage();
      $pdf::writeHTML($html, true, false, true, false, '');

      $pdf::Output('dragaud_sojourns_receipt.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
     public $paymentsPerPage = 20;
     public function show($email, $page)
     {
       // $email =  Auth::admin()->email;
       $email = 'jjvannatta88';
       $search = \Request::get('search');
       $payments = Payment::orderBy('id', 'desc')->get();
       if ($search) {

         $travelerAll = DB::table('payments')
              ->join('trips', 'payments.trip_id', '=', 'trips.id')
              ->join('travelers', 'trips.traveler_id', '=', 'travelers.id')
              ->select('payments.*')
              ->where('name', 'like', '%'.$search.'%');

        $userAll = DB::table('payments')
             ->join('trips', 'payments.trip_id', '=', 'trips.id')
             ->join('users', 'trips.user_id', '=', 'users.id')
             ->select('payments.*')
             ->where('name', 'like', '%'.$search.'%');

       $groupAll = DB::table('payments')
            ->join('trips', 'payments.trip_id', '=', 'trips.id')
            ->join('groups', 'trips.group_id', '=', 'groups.id')
            ->select('payments.*')
            ->where('number', 'like', '%'.$search.'%');

         $payments = Payment::where('verification', 'like', '%'.$search.'%')
             ->union($travelerAll)
             ->union($userAll)
             ->union($groupAll)
             ->orderBy('id', 'desc')
             ->get();
       }
       $paymentPages = ceil(count($payments) / $this->paymentsPerPage);

       // $authAdmin = Auth::admin();
       $authAdmin = 'jjvannatta88';
       $authPayments = $payments->forPage($page, $this->paymentsPerPage)->all();

       return view('admin.payments', compact('paymentPages', 'authAdmin', 'authPayments'));
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
