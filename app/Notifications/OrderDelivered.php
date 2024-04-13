<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderDelivered extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Order $order)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Your order #{$this->order->id} has been delivered")
            ->greeting("Hello {$this->order->user->first_name}!")
            ->line([
                "Thank you again for your order.",
                "This email just confirms that you have received your order (**#{$this->order->id}**) in good condition."
            ])
            ->line('If you have any concerns, please feel free to reach out.')
            ->action('View order', route('orders.show', $this->order));
    }
}
