<?php

namespace App\Core\Services\User;

use App\Core\Services\AbstractService;
use App\Core\Repositories\ProductRepository;

class ProductService extends AbstractService
{
    public function __construct(protected ProductRepository $productRepository)
    {
        parent::__construct($productRepository);
    }

    public function getNewArrivals()
    {
        return cache()->rememberForever('new_arrivals', function () {
            return $this->productRepository->getNewArrivals(
                perPage: 10,
                relations: ['brand', 'colors', 'category', 'media'],
                orderBy: ['created_at' => 'desc']
            );
        });
    }

    public function getFilteredProducts($filters = [], $perPage = 12, $orderBy = [])
    {
        return $this->productRepository->getFilteredProducts($filters, $perPage, $orderBy);
    }

    /**
     * Get featured products
     */
    public function getFeaturedProducts($perPage = 8)
    {
        return cache()->rememberForever('featured_products', function () use ($perPage) {
            return $this->productRepository->getFilteredProducts(['featured' => 'true'], $perPage);
        });
    }

    /**
     * Get top rated products
     */
    public function getTopRatedProducts($perPage = 8)
    {
        return cache()->rememberForever('top_rated_products', function () use ($perPage) {
            return $this->productRepository->getFilteredProducts(['top_rated' => 'true'], $perPage);
        });
    }
}
