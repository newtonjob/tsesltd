<?php

namespace App\Models;

use App\Models\Concerns\ObservesWrites;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use ObservesWrites;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'social_links' => 'object',
        'about'        => 'object'
    ];

    public function logo(): Attribute
    {
        return Attribute::get(fn ($value) => cloudinary_url($value));
    }
}
