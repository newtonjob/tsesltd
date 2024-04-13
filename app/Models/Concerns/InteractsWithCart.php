<?php

namespace App\Models\Concerns;

use Facades\App\Support\Cart;

trait InteractsWithCart
{
    /**
     * Add the product to the user's cart.
     */
    public function addToCart(): void
    {
        Cart::add($this);
    }

    /**
     * Replace the product in the user's cart.
     */
    public function syncInCart(): void
    {
        Cart::sync($this);
    }

    /**
     * Remove the product from the user's cart.
     */
    public function removeFromCart(): void
    {
        Cart::remove($this);
    }
}
