<?php

namespace App\Models;

use App\Models\Concerns\HasMediaAttribute;
use App\Models\Concerns\ObservesWrites;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasMediaAttribute, ObservesWrites;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => cloudinary_url($value, 400, true),
            set: fn ($value) => $this->uploadAndReturnPath($value, config('cloudinary.folders.category'))
        )->withoutObjectCaching();
    }

    public function thumbnail(): Attribute
    {
        return Attribute::get(fn () => cloudinary_url($this->getRawOriginal('image'), 100, true));
    }

    public static function booted()
    {
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function name(): Attribute
    {
        return Attribute::get(fn ($value) => str($value)->title());
    }

    /**
     * Determine if the category is featured.
     */
    public function isFeatured(): bool
    {
        return (bool) $this->featured_at;
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(Product::class, SubCategory::class, secondKey: 'sub_category_id', secondLocalKey: 'id');
    }
}
