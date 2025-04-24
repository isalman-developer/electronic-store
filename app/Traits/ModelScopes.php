<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

trait ModelScopes
{
    /**
     * Scope for active records (assuming status field is used)
     */
    public function scopeActive(Builder $query): Builder
    {
        // if (Schema::hasColumn($this->getTable(), 'status')) {
        //     return $query->where('status', 1);
        // }

        return $query;
    }

    /**
     * Scope for inactive records
     */
    public function scopeInactive(Builder $query): Builder
    {
        // if (Schema::hasColumn($this->getTable(), 'status')) {
        //     return $query->where('status', 0);
        // }
        return $query;
    }
}
