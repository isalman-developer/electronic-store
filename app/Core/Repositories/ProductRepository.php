<?php

namespace App\Core\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository extends AbstractRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    /**
     * Get new arrivals products
     */
    public function getNewArrivals(int $perPage = 10, array $relations = [], array $orderBy = [])
    {
        $query = $this->model->query();

        if (!empty($relations)) {
            $query->with($relations);
        }

        if (!empty($orderBy)) {
            foreach ($orderBy as $column => $direction) {
                $query->orderBy($column, $direction);
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Get products created in the last 30 days
        $query->where('created_at', '>=', now()->subDays(30));

        return $query->paginate($perPage);
    }

    /**
     * Get filtered products
     */
    public function getFilteredProducts(array $filters = [], int $perPage = 12)
    {
        $query = $this->model->query();
        $query->with(['category', 'brand', 'colors', 'sizes', 'media']);
        $query->where('status', 1);

        // Filter by featured products
        if (isset($filters['featured']) && $filters['featured'] == 'true') {
            $query->where('is_featured', 1);
        }

        // Filter by new arrivals
        if (isset($filters['new-arrivals']) && $filters['new-arrivals'] == 'true') {
            $query->where('created_at', '>=', now()->subDays(30));
        }

        // Filter by top rated products
        if (isset($filters['top-rated']) && $filters['top-rated'] == 'true') {
            $query->where('rating', '>=', 4);
        }

        // Filter by price range
        if (isset($filters['price']) && !empty($filters['price'])) {
            $priceRange = explode('-', $filters['price']);
            if (count($priceRange) == 2) {
                $minPrice = $priceRange[0];
                $maxPrice = $priceRange[1];

                if ($minPrice !== '') {
                    $query->where('price', '>=', $minPrice);
                }

                if ($maxPrice !== '') {
                    $query->where('price', '<=', $maxPrice);
                }
            }
        }

        // Filter by category
        if (isset($filters['category']) && !empty($filters['category'])) {
            $query->whereHas('category', function ($q) use ($filters) {
                $q->where('slug', $filters['category']);
            });
        }

        // Filter by brand
        if (isset($filters['brand']) && !empty($filters['brand'])) {
            $query->whereHas('brand', function ($q) use ($filters) {
                $q->where('slug', $filters['brand']);
            });
        }

        // Filter by colors
        if (isset($filters['colors']) && !empty($filters['colors'])) {
            $colorIds = is_array($filters['colors']) ? $filters['colors'] : explode('-', $filters['colors']);
            $query->whereHas('colors', function ($q) use ($colorIds) {
                $q->whereIn('colors.id', $colorIds);
            });
        }

        // Filter by sizes
        if (isset($filters['sizes']) && !empty($filters['sizes'])) {
            $sizeIds = is_array($filters['sizes']) ? $filters['sizes'] : explode('-', $filters['sizes']);
            $query->whereHas('sizes', function ($q) use ($sizeIds) {
                $q->whereIn('sizes.id', $sizeIds);
            });
        }

        // Apply sorting
        if (isset($filters['sort']) && !empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'Best-selling':
                    $query->orderBy('sales_count', 'desc');
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
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query->paginate($perPage);
    }
}
