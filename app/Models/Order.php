<?php

namespace App\Models;

use App\Models\Concerns\ObservesWrites;
use App\Observers\Observable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes, ObservesWrites, Observable;

    protected $with = ['user'];

    public function scopeSearch(Builder $builder, $keyword): void
    {
        if ($keyword) {
            $builder->where(
                fn ($builder) => $builder->where('id', 'like', $keyword.'%')
                    ->orWhereHas('user', fn ($query) => $query->search($keyword))
            );
        }
    }

    public function scopeWithLocationName(Builder $builder)
    {
        $builder->select('orders.*', 'locations.name as location_name')
            ->join('locations', 'locations.id', 'location_id');
    }

    public function total(): Attribute
    {
        return Attribute::get(fn () => $this->products->sum('pivot.amount'));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, OrderProduct::class)
            ->withPivot(['id', 'price', 'quantity', 'location_id'])
            ->withTimestamps();
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function paidTransactions(): HasMany
    {
        return $this->transactions()->paid();
    }

    public function amountPaid(): Attribute
    {
        return Attribute::get(fn () => $this->transactions->whereNotNull('paid_at')->sum('amount'));
    }

    public function isDelivered(): bool
    {
        return (bool) $this->delivered_at;
    }

    public function isNotDelivered(): bool
    {
        return ! $this->isDelivered();
    }

    /**
     * Determine if the order was marked as delivered during the current request.
     */
    public function wasRecentlyDelivered(): bool
    {
        return $this->wasChanged('delivered_at') && $this->isDelivered();
    }

    public function isDispatched(): bool
    {
        return (bool) $this->products->first()?->pivot->location_id;
    }

    public function isPaid(): bool
    {
        return $this->amount_paid >= $this->total;
    }

    /**
     * Get the current amount payable for the order.
     */
    public function amountPayable(): int
    {
        $payable = $this->total - $this->amount_paid;

        return max($payable, 0);
    }
}
