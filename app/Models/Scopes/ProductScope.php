<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait ProductScope
{
    /**
     * Scope the query to only include featured products.
     */
    public function scopeFeatured(Builder $builder): void
    {
        $builder->whereNotNull('featured_at');
    }

    /**
     * Scope the query to only include discounted products.
     */
    public function scopeDiscounted(Builder $builder): void
    {
        $builder->where('discount', '>', 0);
    }

    public function scopeSearch(Builder $builder, $keyword = null): void
    {
        // Todo: Prepare keyword for better results.
        $keyword = request()->str('q', $keyword)->squish();

        if ($keyword->isNotEmpty()) {
            $builder->whereFullText(['name', 'tags'], $keyword.'*', ['mode' => 'boolean']);
        }
    }

    public function scopeFilter(Builder $builder): void
    {
        $builder->when(request('category'),
            fn ($builder, $category) => $builder->whereRelation('subCategory.category', 'slug', $category)
        )->when(request('sub-category'),
            fn ($builder, $subCategory) => $builder->whereRelation('subCategory', 'slug', $subCategory)
        )->when(request('brand'),
            fn ($builder, $brand) => $builder->whereRelation('brand', 'slug', $brand)
        )->when(request('location'),
            fn ($builder, $location) => $builder->whereRelation('locations', 'slug', $location)
        )->when(request('color'),
            fn ($builder, $color) => $builder->whereRelation('color', 'slug', $color)
        );
    }

    public function scopeWithStock(Builder $builder): void
    {
        $builder->withSum([
            'locations as stock' => fn ($query) => $query->select(
                DB::raw('SUM(stock.quantity)')
            )
        ], '');
    }
}
