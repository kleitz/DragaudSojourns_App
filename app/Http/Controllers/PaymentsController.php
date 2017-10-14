<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Group;
use App\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $user = $request->input('payment.user_id');
        $group = $request->input('payment.group_id');
        $trip = $request->input('payment.trip_id');
        $amount = $request->input('payment.amount');

        $t = Carbon::now();
        $groupNum = Group::find($group)->number;
        $receipt = 'receipts/' . $user . '/' . $groupNum . '-payment-' . $t->toDateString() . '.pdf';
        Storage::disk('local')->put('public/' . $receipt, 'RECEIPT TEST 2!!!!!');
        $verification = time();

        $curTrip = Trip::find($trip);
        $curTrip->paid = $curTrip->paid + $amount;
        $curTrip->save();

        $payment = Payment::create([
            'method' => $request->input('payment.method'),
            'paypal_id' => $request->input('payment.paypal_id'),
            'user_id' => $user,
            'trip_id' => $trip,
            'amount' => $amount,
            'balance' => $request->input('payment.balance'),
            'receipt' => 'storage/' . $receipt,
            'verification' => $verification
          ]);

          $returnData = new \stdClass();
          $returnData->receipt = 'storage/' . $receipt;
          $returnData->verification = $verification;
          $returnData->status = 'SUCCESS';
          return json_encode($returnData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
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
