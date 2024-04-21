<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use mysql_xdevapi\Session;

class ResetPasswordNotification extends ResetPassword
{
    use Queueable;

    /**
     * Get the mail representation of the notification.
     */
    protected function buildMailMessage($url): MailMessage
    {
        $this->locale(App::getLocale());
        return (new MailMessage)
            ->view('mails.forgot-password', ['url' => $url]);
    }
}
