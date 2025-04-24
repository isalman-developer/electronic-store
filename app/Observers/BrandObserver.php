<?php

namespace App\Observers;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Core\Services\User\BrandService;

class BrandObserver
{
    public function __construct(protected BrandService $brandService) {}
    /**
     * Handle the Brand "creating" event.
     */
    public function creating(Brand $brand): void
    {
        $brand->slug = Str::slug($brand->title);
    }

    /**
     * Handle the Brand "updating" event.
     */
    public function updating(Brand $brand): void
    {
        if ($brand->isDirty('title')) {
            $brand->slug = Str::slug($brand->title);
        }
    }

    public function saved()
    {
        $this->clearAndRebuildCache();
    }

    public function delete()
    {
        $this->clearAndRebuildCache();
    }

    public function clearAndRebuildCache()
    {
        Cache::forget('brands');
        Cache::forget('active_brands_for_footer');

        cache()->rememberForever('brands', function () {
            return $this->brandService->getAll(relations: ['media'], scopes: ['active']);
        });

        cache()->rememberForever('active_brands_for_footer', function () {
            return $this->brandService->getAll(scopes: ['active'], perPage: 5);
        });
    }
}
