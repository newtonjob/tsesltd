<?php

namespace App\Models;

use App\Models\Concerns\ObservesWrites;
use App\Observers\Observable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes, ObservesWrites, Observable;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function isPublic()
    {
        return $this->featured_at != null;
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, Stock::class)
            ->as('stock')
            ->withPivot(['id', 'quantity', 'created_by', 'updated_by'])
            ->withTimestamps();
    }
}
