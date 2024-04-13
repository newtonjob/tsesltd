<?php

namespace App\Models;

use App\Models\Concerns\ObservesWrites;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Color extends Model
{
    use ObservesWrites;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function booted()
    {
        static::creating(function ($color) {
            $color->slug       = Str::slug($color->name);
            $color->created_by = user('id');
        });
        static::updating(function ($color) {
            $color->slug       = Str::slug($color->name);
            $color->updated_by = user('id');
        });
    }

    public function products(): hasMany
    {
        return $this->hasMany(Product::class);
    }
}
