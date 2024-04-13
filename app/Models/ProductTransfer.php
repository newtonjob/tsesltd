<?php

namespace App\Models;

use App\Observers\Observable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductTransfer extends Pivot
{
    use Observable;

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = true;

    public function from_location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'from_location_id');
    }

    public function to_location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'to_location_id');
    }
}
