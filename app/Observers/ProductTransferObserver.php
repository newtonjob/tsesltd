<?php

namespace App\Observers;

use App\Models\ProductTransfer;
use App\Models\Stock;

class ProductTransferObserver
{
    /**
     * Handle the ProductTransfer "created" event.
     */
    public function created(ProductTransfer $productTransfer): void
    {
        Stock::where([
            'product_id'  => $productTransfer->product_id,
            'location_id' => $productTransfer->from_location_id,
        ])->decrement('quantity', $productTransfer->quantity);

        Stock::firstOrCreate([
            'product_id' => $productTransfer->product_id,
            'location_id' => $productTransfer->to_location_id
        ])->increment('quantity', $productTransfer->quantity);
    }

}
