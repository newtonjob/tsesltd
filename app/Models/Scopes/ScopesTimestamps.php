<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait ScopesTimestamps
{
    public function scopeThisYear(Builder $builder): void
    {
        $builder->where('created_at', '>=', now()->startOfYear());
    }

    public function scopeThisMonth(Builder $builder): void
    {
        $builder->where('created_at', '>=', now()->startOfMonth());
    }

    public function scopeThisWeek(Builder $builder): void
    {
        $builder->where('created_at', '>=', now()->startOfWeek());
    }

    public function scopeToday(Builder $builder): void
    {
        $builder->whereDate("created_at", today());
    }
}
