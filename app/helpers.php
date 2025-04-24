<?php

use App\Core\Services\Admin\CategoryService;
use App\Core\Services\User\BrandService;
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

if (!function_exists('getFirstImageUrl')) {
    function getFirstImageUrl($object)
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
        return cache()->rememberForever('active_categories_for_footer', function () use ($perPage) {
            $categoryService = app(CategoryService::class);
            return $categoryService->getAll(scopes: ['active'], perPage: $perPage);
        });
    }
}

if (!function_exists('getBrands')) {
    function getBrands($perPage = null)
    {
        return cache()->rememberForever('brands', function () use ($perPage) {
            $brandService = app(BrandService::class);
            return $brandService->getAll(scopes: ['active'], perPage: $perPage);
        });
    }
}
