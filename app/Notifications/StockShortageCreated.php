<?php

namespace App\Notifications;

use App\Models\Stock;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StockShortageCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Stock $stock, public $shortage)
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
            ->error()
            ->subject("Stock Shortage [{$this->stock->product->name}]")
            ->greeting("Hello {$notifiable->first_name}!")
            ->line("Stock for **{$this->stock->product->name}** in **{$this->stock->location->name}** has just been reviewed downwards without sales.")
            ->line("**Shortage:** {$this->shortage}.")
            ->line("**Stock Left:** {$this->stock->quantity}.")
            ->line("**Initiated By:** {$this->stock->editor->name}.")
            ->action('View Product', route('products.edit', $this->stock->product));
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
