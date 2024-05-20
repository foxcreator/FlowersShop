<?php

namespace App\Notifications;

use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class TelegramFeedbackNotification extends Notification
{
    use Queueable;

    protected $feedback;

    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        $message = "*Новое обращение!!* \n\n";

        $message .= "Имя: *{$this->feedback->name}* \n";
        $message .= "Телефон: *{$this->feedback->phone}* \n";
        $message .= "Вопрос: \n *{$this->feedback->question}*";

        return TelegramMessage::create()
            ->content($message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
