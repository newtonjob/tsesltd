<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\PasswordChanged;
use App\Notifications\Welcome;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     */
    public function creating(User $user): void
    {
        //
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $user->sendEmailVerificationNotification();
        $user->notify(new Welcome);
    }

    /**
     * Handle the User "updating" event.
     */
    public function updating(User $user): void
    {
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($user->isDirty('type') && $user->type === 'customer') {
            $user->role_id = null;
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if ($user->wasChanged('password')) {
            $user->notify(new PasswordChanged);
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user)
    {
        //
    }
}
