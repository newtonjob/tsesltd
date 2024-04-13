<?php

namespace App\Notifications;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransactionPaid extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Transaction $transaction)
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
        $amount  = number_format($this->transaction->amount, 2);
        $order   = $this->transaction->order;

        $subject = $notifiable->isAdmin()
            ? "Payment of $amount from {$order->user->name}"
            : "Payment Receipt for {$order->user->name}";

        return (new MailMessage)
            ->success()
            ->subject($subject)
            ->greeting("Hello $notifiable->first_name!")
            ->lineIf($notifiable->isAdmin(),
                "**{$order->user->name}** just paid **NGN {$amount}** for order **#{$order->id}**."
            )->lineIf(! $notifiable->isAdmin(),
                "We've received your payment of **NGN {$amount}** for order **#{$order->id}**."
            )->line("Date: " . $this->transaction->paid_at->toDayDateTimeString())
            ->action('View order', route('orders.show', $order));
    }
}
