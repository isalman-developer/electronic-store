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
            return $this->productRepository->getNewArrivals(perPage: 10, relations: ['brand', 'colors', 'category', 'media'], orderBy: ['created_at' => 'desc']);
        });
    }

    public function getFilteredProducts($filters = [], $perPage = 12)
    {
        // Generate a cache key based on filters
        $cacheKey = 'products_' . md5(json_encode($filters) . $perPage);

        // Cache results for frequently accessed filters
        return cache()->remember($cacheKey, now()->addMinutes(30), function () use ($filters, $perPage) {
            return $this->productRepository->getFilteredProducts($filters, $perPage);
        });
    }
}
