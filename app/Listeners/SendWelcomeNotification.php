<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class SendWelcomeNotification
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $mail   = new \App\Mail\WelcomeEmail();
        Mail::to( $event->user->routeNotificationForMail() )->send($mail);
    }
}
