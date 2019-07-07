<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Config;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class RegistrationVerification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $code, $url='')
    {
        if ($url == '') {
            $url = $this->verificationUrl($code);
        } else {
            $url .= $code;
        }
        $this->message = (new MailMessage)
            ->subject(Lang::getFromJson('Verify Email Address'))
            ->line(Lang::getFromJson('Please click the button below to verify your email address.'))
            ->action(
                Lang::getFromJson('Verify Email Address'),
                $url
            )
            ->line(Lang::getFromJson('If you did not create an account, no further action is required.'));
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($code)
    {
        return URL::temporarySignedRoute(
            'registration.activate',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            ['code' => $code]
        );
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('V1 | Verify Your Email');
        return $this->markdown('vendor.notifications.email', $this->message->data());
    }
}
