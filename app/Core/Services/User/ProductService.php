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
            return $this->productRepository->getNewArrivals(perPage: 10, relations: [], orderBy: ['created_at' => 'desc']);
        });
    }

    public function getProductsByCategory($categorySlug)
    {
        return $this->productRepository->getByCategory($categorySlug);
    }

    public function getProductsByBrand($brandSlug)
    {
        return $this->productRepository->getByBrand($brandSlug);
    }

    public function getProductsByCategoryAndBrand($categorySlug, $brandSlug)
    {
        return $this->productRepository->getByCategoryAndBrand($categorySlug, $brandSlug);
    }

    public function getProductsByPriceRange($categorySlug, $min, $max)
    {
        return $this->productRepository->getByPriceRange($categorySlug, $min, $max);
    }

    public function getInStockProducts($categorySlug)
    {
        return $this->productRepository->getInStock($categorySlug);
    }

    public function getSortedProducts($categorySlug, $sortOption)
    {
        return $this->productRepository->getSorted($categorySlug, $sortOption);
    }

    public function getFilteredProducts($categorySlug, $brandSlug, $min, $max, $sortOption)
    {
        return $this->productRepository->getFiltered($categorySlug, $brandSlug, $min, $max, $sortOption);
    }
}
