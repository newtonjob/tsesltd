<?php

namespace App\Observers;

use App\Models\OrderProduct;
use App\Models\Stock;

class OrderProductObserver
{
    /**
     * Handle the OrderProduct "created" event.
     */
    public function created(OrderProduct $orderProduct): void
    {
        //
    }

    /**
     * Handle the OrderProduct "updated" event.
     */
    public function updated(OrderProduct $orderProduct): void
    {
        if ($orderProduct->wasChanged('location_id')) {
            if ($orderProduct->location_id) {
                Stock::firstOrCreate(
                    $orderProduct->only('product_id', 'location_id')
                )->update(['quantity' => -$orderProduct->quantity]);
            }

            if ($orderProduct->getOriginal('location_id')) {
                Stock::firstOrCreate([
                    'product_id'  => $orderProduct->product_id,
                    'location_id' => $orderProduct->getOriginal('location_id'),
                ])->update(['quantity' => $orderProduct->quantity]);
            }
        }
    }

    /**
     * Handle the OrderProduct "deleted" event.
     */
    public function deleted(OrderProduct $orderProduct): void
    {
        //
    }
}
