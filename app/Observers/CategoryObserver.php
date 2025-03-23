<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Core\Services\CategoryService;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{

    public function __construct(protected CategoryService $categoryService) {}
    /**
     * Handle the Category "creating" event.
     */
    public function creating(Category $category): void
    {
        $category->slug = Str::slug($category->title);
    }

    /**
     * Handle the Category "updating" event.
     */
    public function updating(Category $category): void
    {
        if ($category->isDirty('title')) {
            $category->slug = Str::slug($category->title);
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
        Cache::forget('home_categories');
        Cache::forget('active_categories_for_footer');

        Cache::rememberForever('home_categories', function () {
            return $this->categoryService->getAll(relations: ['media'], scopes: ['active']);
        });

        Cache::rememberForever('active_categories_for_footer', function () {
            return $this->categoryService->getAll(scopes: ['active'], perPage: 5);
        });
    }
}
