<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Core\Services\CategoryService;

class CategoryObserver
{

    public function __construct(protected CategoryService $categoryService) {}
    /**
     * Handle the Category "creating" event.
     */
    public function creating(Category $category): void
    {
        $category->slug = Str::slug($category->title);
        $this->clearAndRebuildCache();
    }

    /**
     * Handle the Category "updating" event.
     */
    public function updating(Category $category): void
    {
        if ($category->isDirty('title')) {
            $category->slug = Str::slug($category->title);
        }
        $this->clearAndRebuildCache();
    }

    public function delete()
    {
        $this->clearAndRebuildCache();
    }

    public function clearAndRebuildCache()
    {
        cache()->forget('home_categories');
        cache()->rememberForever('home_categories', function () {
            return $this->categoryService->getAll(relations: ['media'], scopes: ['active']);
        });
    }
}
