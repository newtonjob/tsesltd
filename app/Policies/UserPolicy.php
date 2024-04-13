<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability)
    {
        if ($user->isSuperAdmin()) return true;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('manage-customer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        if ($user->is($model)) return true;

        if ($model->isAdmin()) {
            return $user->can('manage-admin');
        }

        if ($model->isCustomer()) {
            return $user->can('manage-customer');
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, string $type = 'customer'): bool
    {
        return $user->can('manage-customer') && $type === 'customer' ;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->can('manage-customer') || $user->is($model);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->is($model);
    }
}
