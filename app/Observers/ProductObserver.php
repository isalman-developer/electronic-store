<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Core\Services\User\ProductService;

class ProductObserver
{
    public function __construct(protected ProductService $productService) {}

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
     * Handle the Product "created and updated" event.
     */
    public function saved(Product $product): void
    {
        $this->clearAndRebuildCache();
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        $this->clearAndRebuildCache();
    }

    public function clearAndRebuildCache()
    {
        cache()->forget('new_arrivals');

        cache()->rememberForever('new_arrivals', function () {
            return $this->productService->getNewArrivals();
        });
    }
}
