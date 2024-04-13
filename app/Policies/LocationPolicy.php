<?php

namespace App\Policies;

use App\Models\Location;
use App\Models\User;

class LocationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->can('manage-shop-location');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Location $location)
    {
        return $user->can('manage-shop-location');

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('manage-shop-location');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Location $location)
    {
        return $user->can('manage-shop-location');

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Location $location): bool
    {
        return $user->can('manage-shop-location') && empty($location->products()->sum('stock.quantity'));
    }
}
