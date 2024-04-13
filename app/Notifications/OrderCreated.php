<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreated extends Notification implements ShouldQueue
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
        $message =  (new MailMessage)
            ->subject("New Order from {$this->order->user->name} #{$this->order->id}")
            ->line("**{$this->order->user->name}** just placed an order for the following products;");

        $this->order->products->each(
            fn ($product) => $message->line(" - {$product->name} ({$product->pivot->quantity})")
        );

        return $message->action('View order', route('orders.show', $this->order));
    }
}
