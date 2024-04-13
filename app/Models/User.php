<?php

namespace App\Models;

use App\Models\Concerns\InteractsWithUserAttributes;
use App\Models\Concerns\ObservesWrites;
use App\Models\Enums\Gender;
use App\Observers\Observable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, SoftDeletes, InteractsWithUserAttributes, ObservesWrites, Observable;

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = ['password', 'remember_token', 'meta'];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login'        => 'datetime',
        'banned_until'      => 'datetime',
        'gender'            => Gender::class,
        'password'          => 'hashed',
    ];

    public function scopeSearch(Builder $builder, $keyword = null): void
    {
        // Todo: Prepare keyword for better results.
        $keyword = request()->str('q', $keyword)->squish();

        if ($keyword->isNotEmpty()) {
            $builder->whereFullText(['first_name', 'last_name', 'email', 'phone'], $keyword.'*', ['mode' => 'boolean']);
        }
    }

    /**
     * Scope a query to only include admin users.
     */
    public function scopeAdmin(Builder $builder): void
    {
        $builder->whereType('admin');
    }

    /**
     * Scope a query to only include users that are customers.
     */
    public function scopeCustomer(Builder $builder): void
    {
        $builder->whereType('customer');
    }

    /**
     * Scope a query to only include users that can receive notifications.
     */
    public function scopeNotifiable(Builder $builder): void
    {
        $builder->whereNotifiable(true);
    }

    public function wishes(): HasMany
    {
        return $this->hasMany(Wish::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'created_by');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
