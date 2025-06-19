<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    public function creating(Product $product): void
    {
        $product->slug = Str::slug($product->title);
    }

    /**
     * Handle the Product "updating" event.
     */
    public function updating(Product $product): void
    {
        if ($product->isDirty('title')) {
            $product->slug = Str::slug($product->title);
        }
    }

    /**
     * Handle the Product "deleted" event.
     * Only handle deletions here since create/update cache clearing
     * is now handled in ProductService after relationships are attached
     */
    public function deleted(Product $product): void
    {
        $this->clearProductCaches();
    }

    /**
     * Clear product-related caches
     */
    private function clearProductCaches()
    {
        Cache::forget('new_arrivals');
        Cache::forget('featured_products');
        Cache::forget('top_rated_products');
    }
}
