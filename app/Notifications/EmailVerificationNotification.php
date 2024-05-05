<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class EmailVerificationNotification extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    public function toMail($notifiable)
    {
        return (new MailMessage())->view('mails.email-verification', [
            'verifyUrl' => $this->verificationUrl($notifiable),
        ]);
    }

    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject(Lang::get('email.verify_email_subject'))
            ->line(Lang::get('email.verify_email_line1'))
            ->action(Lang::get('email.verify_email_action'), $url)
            ->line(Lang::get('email.verify_email_line2'));
    }
}
