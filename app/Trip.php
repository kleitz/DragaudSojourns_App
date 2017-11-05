<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'group_id', 'user_id', 'traveler_id', 'total', 'paid', 'active', 'package', 'insurance'
    ];
}
