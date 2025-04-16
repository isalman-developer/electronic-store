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

    public function getByBrand($brandSlug)
    {
        return Product::whereHas('brand', function ($query) use ($brandSlug) {
            $query->where('slug', $brandSlug);
        })->paginate(12);
    }

    public function getByCategoryAndBrand($categorySlug, $brandSlug)
    {
        return Product::whereHas('category', function ($query) use ($categorySlug) {
            $query->where('slug', $categorySlug);
        })->whereHas('brand', function ($query) use ($brandSlug) {
            $query->where('slug', $brandSlug);
        })->paginate(12);
    }

    public function getByPriceRange($categorySlug, $min, $max)
    {
        return Product::whereHas('category', function ($query) use ($categorySlug) {
            $query->where('slug', $categorySlug);
        })->whereBetween('price', [$min, $max])->paginate(12);
    }

    public function getInStock($categorySlug)
    {
        return Product::whereHas('category', function ($query) use ($categorySlug) {
            $query->where('slug', $categorySlug);
        })->where('stock', '>', 0)->paginate(12);
    }

    public function getSorted($categorySlug, $sortOption)
    {
        $query = Product::whereHas('category', function ($query) use ($categorySlug) {
            $query->where('slug', $categorySlug);
        });

        switch ($sortOption) {
            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'price-low-high':
                $query->orderBy('price', 'asc');
                break;
            case 'price-high-low':
                $query->orderBy('price', 'desc');
                break;
        }

        return $query->paginate(12);
    }

    public function getFiltered($categorySlug, $brandSlug, $min, $max, $sortOption)
    {
        $query = Product::whereHas('category', function ($query) use ($categorySlug) {
            $query->where('slug', $categorySlug);
        })->whereHas('brand', function ($query) use ($brandSlug) {
            $query->where('slug', $brandSlug);
        })->whereBetween('price', [$min, $max]);

        switch ($sortOption) {
            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'price-low-high':
                $query->orderBy('price', 'asc');
                break;
            case 'price-high-low':
                $query->orderBy('price', 'desc');
                break;
        }

        return $query->paginate(12);
    }
}
