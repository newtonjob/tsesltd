<?php

namespace App\Models;

use App\Models\Concerns\ObservesWrites;
use App\Observers\Observable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    use ObservesWrites, Observable;

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = true;

    public function amount(): Attribute
    {
        return Attribute::get(fn () => $this->price * $this->quantity);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
