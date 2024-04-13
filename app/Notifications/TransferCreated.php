<?php

namespace App\Notifications;

use App\Models\Transfer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransferCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Transfer $transfer)
    {
        $this->afterCommit();
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
            ->greeting("Hello $notifiable->first_name!")
            ->subject("Products transferred from {$this->transfer->products->first()->pivot->from_location->name} #{$this->transfer->id}")
            ->line("**{$this->transfer->creator->name}** has just made a transfer for the following products from {$this->transfer->products->first()->pivot->from_location->name};");

        $this->transfer->products->each(
            fn ($product) => $message->line(" - {$product->name} ({$product->pivot->quantity}) to {$product->pivot->to_location->name}")
        );

        return $message->action('View transfer', route('transfers.show', $this->transfer));
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
