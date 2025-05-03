<?php

namespace App\Core\Repositories;

use App\Models\Product;
use App\Core\Repositories\AbstractRepository;

class ProductRepository extends AbstractRepository
{

    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function getNewArrivals($perPage, $relations = [], $orderBy)
    {
        return $this->getAll(relations: $relations, orderBy: $orderBy, perPage: $perPage);
    }

    public function getByCategory($categorySlug)
    {
        return Product::whereHas('category', function ($query) use ($categorySlug) {
            $query->where('slug', $categorySlug);
        })->paginate(12);
    }

    public function getFilteredProducts($filters = [], $perPage = 12)
    {
        $query = $this->model->newQuery();

        // Apply eager loading for common relationships
        $query->with(['category', 'brand', 'media', 'colors']);

        // Category filter
        if (!empty($filters['category_slug'])) {
            $query->whereHas('category', function ($q) use ($filters) {
                $q->where('slug', $filters['category_slug']);
            });
        }

        // Brand filter
        if (!empty($filters['brand_slug'])) {
            $query->whereHas('brand', function ($q) use ($filters) {
                $q->where('slug', $filters['brand_slug']);
            });
        }

        // Price range filter
        if (!empty($filters['price_min']) && !empty($filters['price_max'])) {
            $query->whereBetween('price', [$filters['price_min'], $filters['price_max']]);
        } else if (!empty($filters['price_min'])) {
            $query->where('price', '>=', $filters['price_min']);
        } else if (!empty($filters['price_max'])) {
            $query->where('price', '<=', $filters['price_max']);
        }

        // In stock filter
        if (!empty($filters['in_stock']) && $filters['in_stock']) {
            $query->where('stock', '>', 0);
        }

        // Color filter
        if (!empty($filters['colors']) && is_array($filters['colors'])) {
            $query->whereHas('colors', function ($q) use ($filters) {
                $q->whereIn('colors.slug', $filters['colors']);
            });
        }

        // Rating filter
        if (!empty($filters['rating'])) {
            $query->whereHas('reviews', function ($q) use ($filters) {
                $q->selectRaw('AVG(rating) as avg_rating')
                    ->groupBy('product_id')
                    ->havingRaw('AVG(rating) >= ?', [$filters['rating']]);
            });
        }

        // Apply sorting
        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'Best-selling':
                    // $query->orderBy('views', 'desc');
                    $query->orderBy('id', 'desc');
                    break;
                case 'Alphabetically-A-Z':
                    $query->orderBy('title', 'asc');
                    break;
                case 'Alphabetically-Z-A':
                    $query->orderBy('title', 'desc');
                    break;
                case 'Price-low-to-high':
                    $query->orderBy('price', 'asc');
                    break;
                case 'Price-high-to-low':
                    $query->orderBy('price', 'desc');
                    break;
                case 'Date-old-to-new':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'Date-new-to-old':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            // Default sorting
            $query->orderBy('created_at', 'desc');
        }

        // Ensure pagination maintains all filters
        $paginator = $query->paginate($perPage);
        $paginator->appends(request()->except('page'));

        return $paginator;
    }
}
