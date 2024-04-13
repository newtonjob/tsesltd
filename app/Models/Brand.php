<?php

namespace App\Models;

use App\Models\Concerns\HasMediaAttribute;
use App\Models\Concerns\ObservesWrites;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasMediaAttribute, ObservesWrites;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => cloudinary_url($value, 300, true),
            set: fn ($value) => $this->uploadAndReturnPath($value, config('cloudinary.folders.brand'))
        )->withoutObjectCaching();
    }

    public function thumbnail(): Attribute
    {
        return Attribute::get(fn () => cloudinary_url($this->getRawOriginal('image'), 100, true));
    }

    public static function booted()
    {
        static::creating(function ($brand) {
            $brand->slug = Str::slug($brand->name);
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
