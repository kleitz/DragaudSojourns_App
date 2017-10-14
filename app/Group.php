<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'number', 'destination', 'depart', 'return', 'school', 'packages', 'icon', 'itinerary', 'release', 'message'
    ];
}
