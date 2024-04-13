<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Login;

class UserEventSubscriber
{
    /**
     * Handle the login event.
     */
    public function handleLogin(Login $event): void
    {
        User::withoutEvents(function () use ($event) {
            $event->user->increment('login_count', extra: ['last_login' => now()]);
        });
    }
}
