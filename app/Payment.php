<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $fillable = [
      'method', 'paypal_id', 'user_id', 'trip_id', 'amount', 'balance', 'receipt', 'verification'
  ];
}
