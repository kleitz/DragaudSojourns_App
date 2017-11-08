<?php

namespace App\Notifications;

use App\Trip;
use App\User;
use App\Group;
use App\Traveler;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TravelInsuranceRequested extends Notification
{
    use Queueable;
    public $trip_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($trip_id)
    {
        $this->trip_id = $trip_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $trip = Trip::find($this->trip_id);
        $group = Group::find($trip->group_id);
        $user = User::find($trip->user_id);
        $traveler = Traveler::find($trip->traveler_id);
        return (new MailMessage)->view(
        'auth.emails.insurance', [
          'trip' => $trip,
          'user' => $user,
          'group' => $group,
          'traveler' => $traveler
          ]
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
