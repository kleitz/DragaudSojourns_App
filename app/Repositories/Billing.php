<?php

namespace App\Repositories;

use App\Payment;
use App\AttemptedPayment;
use App\Trip;
use Illuminate\Http\Request;

class Billing
{

  public function attempted($payment)
  {
    $attempt = AttemptedPayment::create([
        'method' => $payment['method'],
        'user_id' => $payment['user_id'],
        'trip_id' => $payment['trip_id'],
        'amount' => $payment['amount']
    ]);

    return $attempt->id;
  }

  public function store($payment)
  {
      $attempt = AttemptedPayment::find($payment['attempt']);
      $trip = Trip::find($attempt->trip_id);
      $verification = time();

      if (array_key_exists('created_at', $payment)) {
        $created = $payment['created_at'];
      } else {
        $created = date("Y-m-d H:i:s");
      }

      $trip->paid = $trip->paid + $attempt->amount;
      $trip->save();

      $payment = Payment::create([
          'attempt' => $attempt->id,
          'method' => $attempt->method,
          'paypal_id' => $payment['paypal_id'],
          'user_id' => $attempt->user_id,
          'trip_id' => $attempt->trip_id,
          'amount' => $attempt->amount,
          'fee' => $payment['fee'],
          'balance' => $trip->total - $trip->paid,
          'verification' => $verification,
          'created_at' => $created
        ]);

        return $verification;
  }

  public function fixMissing($entries)
  {
    $verifications = [];
    foreach($entries as $entry){
      $payment = Payment::where('attempt', $entry['attempt'])->get();

      if (count($payment) == 0)
        $verifications[] = $this->store($entry);
    }
    return $verifications;
  }

}
