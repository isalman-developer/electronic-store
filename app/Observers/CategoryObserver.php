<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
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
}
