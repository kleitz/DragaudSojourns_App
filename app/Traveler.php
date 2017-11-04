<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Traveler extends Model
{
    protected $fillable = [
        'name', 'dob', 'gender', 'relationship','emerg_name', 'emerg_phone', 'user_id'
    ];
}
