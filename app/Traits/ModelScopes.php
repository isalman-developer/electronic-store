<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ModelScopes
{
    /**
     * Scope for active records (assuming status field is used)
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 1);
    }

    /**
     * Scope for inactive records
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('status', 0);
    }

}
