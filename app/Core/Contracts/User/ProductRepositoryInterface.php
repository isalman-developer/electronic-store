<?php

namespace App\Core\Contracts\User;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    /**
     * Get paginated products with optional filters
     *
     * @param array $filters
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedProducts(array $filters = [], int $perPage = 24): LengthAwarePaginator;

    /**
     * Get products by category slug
     *
     * @param string $categorySlug
     * @param array $filters
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getProductsByCategory(string $categorySlug, array $filters = [], int $perPage = 24): LengthAwarePaginator;

    /**
     * Get products by brand slug
     *
     * @param string $brandSlug
     * @param array $filters
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getProductsByBrand(string $brandSlug, array $filters = [], int $perPage = 24): LengthAwarePaginator;

    /**
     * Get product by slug
     *
     * @param string $slug
     * @return mixed
     */
    public function getProductBySlug(string $slug);
}
