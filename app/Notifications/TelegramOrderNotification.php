<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class TelegramOrderNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
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
        $message = "*Новый заказ!!* \n\n";

        foreach ($this->order->orderProducts as $product) {
            $message .= "$product->product_name $product->quantity шт \n";
        }

        $message .= "\n Сумма заказа *{$this->order->amount}грн*";
        $url = 'https://346e-141-170-246-15.ngrok-free.app/admin/orders/' . $this->order->id;
        return TelegramMessage::create()
            ->content($message)
            ->button('Просмотреть заказ', $url);

            // (Optional) Blade template for the content.
//             ->view('notification', ['url' => $url])

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
