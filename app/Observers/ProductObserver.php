<?php

namespace App\Observers;

use App\Core\Services\ProductService;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    public function __construct(protected ProductService $productService) {}
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
        cache()->forget('home_new_arrivals');

        Cache::rememberForever('home_new_arrivals', function () {
            return $this->productService->getNewArrivals();
        });
    }
}
