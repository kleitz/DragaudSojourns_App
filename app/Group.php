<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Trip;
use App\Coordinator;

class Group extends Model
{
    protected $fillable = [
        'number', 'destination', 'depart', 'return', 'school', 'packages', 'icon', 'itinerary', 'release', 'message'
    ];

    public function trips()
    {
      return $this->hasMany(Trip::class);
    }

    public function coordinators()
    {
      return $this->hasMany(Coordinator::class);
    }
}
