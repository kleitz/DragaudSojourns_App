<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

  protected $fillable = [
      'attempt', 'method', 'paypal_id', 'user_id', 'trip_id', 'amount', 'fee', 'balance', 'verification', 'created_at'
  ];

  public function user(){
    return $this->belongsTo('App\User');
  }
}
