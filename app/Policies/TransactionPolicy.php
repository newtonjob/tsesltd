<?php

namespace App\Policies;

use App\Models\Ability;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Transaction $transaction)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, string $channel = 'paystack'): bool
    {
        return $channel === 'paystack' || $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Transaction $transaction)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Transaction $transaction): bool
    {
        return $user->isSuperAdmin() && $transaction->isCash() && $transaction->updated_at->addDay()->isFuture();
    }
}
