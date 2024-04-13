<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class Welcome extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(User $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to '.config('app.name').", {$notifiable->first_name}!")
            ->line('Thank you for signing up with ' .config('app.name'). '.')
            ->line('You can browse and shop electronic products from our well stocked shop.')
            ->line('You will also be the first to know about our latest promotions, and special discounts.')
            ->line("You may access your dashboard using your email address and password.")
            ->unless($notifiable->password, function ($message) use ($notifiable) {
                $message
                    ->line("Your password is: **{$this->generateDefaultPassword($notifiable)}**")
                    ->line("*You may change this password to something more personal after you login.*");
            })
            ->line('Should you have any questions or concerns, our support team is always here to assist you.')
            ->action('Go to Dashboard', route('dashboard'));
    }

    /**
     * Generate a default password for the user.
     */
    public function generateDefaultPassword(User $notifiable)
    {
        return tap(Str::random(5),
            fn ($password) => $notifiable->updateQuietly(['password' => $password])
        );
    }
}
