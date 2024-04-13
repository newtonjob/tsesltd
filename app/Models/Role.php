<?php

namespace App\Models;

use App\Models\Concerns\ObservesWrites;
use App\Models\Enums\Ability;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory, ObservesWrites;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'abilities'        => AsEnumCollection::class.':'.Ability::class,
    ];

    /**
     * Special roles attributes
     */
    const SUPER_ADMIN = 'super-admin';

    public function scopeAssignable(Builder $builder)
    {
        if (user()->isSuperAdmin()) return;

        $builder->whereKey(user()->role);
    }

    public function isSuperAdmin()
    {
        return $this->attribute === self::SUPER_ADMIN;
    }

    /**
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
