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
        // Remove caching and directly return repository results
        return $this->productRepository->getFilteredProducts($filters, $perPage);
    }
}