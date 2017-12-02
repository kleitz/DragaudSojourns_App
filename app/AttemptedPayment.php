<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttemptedPayment extends Model
{
  protected $fillable = [
      'method', 'user_id', 'trip_id', 'amount'
  ];
}
