<?php

namespace App\Models;

use App\Models\Concerns\ObservesWrites;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Stock extends Pivot
{
    use ObservesWrites;

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = true;

    public function quantity(): Attribute
    {
        return Attribute::set(fn ($value) => is_numeric($value) ? $this->quantity + $value : $value);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
