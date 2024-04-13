<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductDeleted;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class ProductObserver
{
    /**
     * Handle the Product "creating" event.
     */
    public function creating(Product $product): void
    {
        $product->slug = Str::slug($product->name);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        Notification::send(
            User::notifiable()->admin()->get()->filter->can('manage-shop'),
            new ProductDeleted($product)
        );
    }
}
