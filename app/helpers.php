<?php

use App\Core\Services\Admin\CategoryService;
use Illuminate\Support\Facades\Cache;

if (!function_exists('showValidationMessage')) {
    function showValidationMessage($error = null)
    {
        if ($error) {
            echo "<div class='invalid-feedback'>" . htmlspecialchars($error) . " </div>";
        }
    }
}

if (!function_exists('getImageUrl')) {
    function getImageUrl($media)
    {
        return $media ? asset('storage/' . $media->file_path) : asset('no-image.png');
    }
}

if (!function_exists('getSingleImageUrl')) {
    function getSingleImageUrl($object)
    {
        return $object->media->count() > 0 ? asset('storage/' . $object->media->first()->file_path) : asset('no-image.png');
    }
}

if (!function_exists('getStatus')) {
    function getStatus($value)
    {
        return $value == 1 ? 'Active' : 'In-Active';
    }
}

if (!function_exists('getCategories')) {
    function getCategories($perPage = null)
    {
        return Cache::rememberForever('active_categories_for_footer', function () use ($perPage) {
            $categoryService = app(CategoryService::class);
            return $categoryService->getAll(scopes: ['active'], perPage: $perPage);
        });
    }
}
