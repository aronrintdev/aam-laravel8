<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->message = (new MailMessage)
            ->subject(Lang::getFromJson('Welcome to V1 Sports'))
            ->greeting(Lang::getFromJson('Thank you for creating an account with us!'))
            ->line(Lang::getFromJson('Thank you for signing up for V1 Account. You now have access to a personal portal where you can purchase online lessons, communicate directly with your pros, and keep track of the progression of your game!'))
            ->line('')
            ->line(Lang::getFromJson('If you need further support help, please contact us at <support@v1sports.com>.'))
            ->line('')
            ->salutation("Welcome to the team,\n\nV1 Sports");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Welcome to V1 Sports');
        return $this->markdown('vendor.notifications.email', $this->message->data());
    }

}
