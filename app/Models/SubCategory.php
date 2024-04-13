<?php

namespace App\Models;

use App\Models\Concerns\ObservesWrites;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

class SubCategory extends Model
{
    use ObservesWrites;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function booted()
    {
        static::creating(function ($subCategory) {
            $subCategory->slug = Str::slug($subCategory->name);
        });
    }

    public function scopeTelevision(Builder $builder)
    {
        $builder->where('name', 'like', '%television%');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function brands(): HasManyThrough
    {
        return $this->hasManyThrough(Brand::class, Product::class, secondKey: 'id', secondLocalKey: 'brand_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
