<?php

namespace App\Core\Repositories\User;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Core\Contracts\User\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function getPaginatedProducts(array $filters = [], int $perPage = 24): LengthAwarePaginator
    {
        return $this->model
            ->with(['category', 'brand', 'media'])
            ->filter($filters)
            ->paginate($perPage);
    }

    public function getProductsByCategory(string $categorySlug, array $filters = [], int $perPage = 24): LengthAwarePaginator
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        return $this->model
            ->where('category_id', $category->id)
            ->with(['category', 'brand', 'media'])
            ->filter($filters)
            ->paginate($perPage);
    }

    public function getProductsByBrand(string $brandSlug, array $filters = [], int $perPage = 24): LengthAwarePaginator
    {
        $brand = Brand::where('slug', $brandSlug)->firstOrFail();

        return $this->model
            ->where('brand_id', $brand->id)
            ->with(['category', 'brand', 'media'])
            ->filter($filters)
            ->paginate($perPage);
    }

    public function getProductBySlug(string $slug)
    {
        return $this->model
            ->with(['category', 'brand', 'media', 'reviews'])
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
