<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Trip;

class Group extends Model
{
    protected $fillable = [
        'number', 'destination', 'depart', 'return', 'school', 'packages', 'icon', 'itinerary', 'release', 'message'
    ];

    public function trips()
    {
      return $this->hasMany(Trip::class);
    }
}
