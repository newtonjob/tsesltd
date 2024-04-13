<?php

namespace App\Models;

use App\Models\Concerns\HasMediaAttribute;
use App\Models\Concerns\ObservesWrites;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Image extends Model
{
    use HasMediaAttribute, ObservesWrites;

    public function src(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => cloudinary_url($value, 1000, true),
            set: fn ($value) => $this->uploadAndReturnPath($value, config('cloudinary.folders.product'))
        )->withoutObjectCaching();
    }

    public function thumbnail(): Attribute
    {
        return Attribute::get(fn () => $this->transform(90, true));
    }

    public function medium(): Attribute
    {
        return Attribute::get(fn () => $this->transform(300, true));
    }

    public function transform($transformation, $bg_auto): string
    {
        return cloudinary_url($this->getAttributeFromArray('src'), $transformation, $bg_auto);
    }
}
