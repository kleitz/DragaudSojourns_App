<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetYourPassword;
use App\Trip;
use App\Payment;
use App\Traveler;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','cell', 'home', 'street', 'zip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function trips()
    {
      return $this->hasMany(Trip::class);
    }

    public function travelers()
    {
      return $this->hasMany(Traveler::class);
    }

    public function payments()
    {
      return $this->hasMany(Payment::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetYourPassword($token, $this->email));
    }
}
