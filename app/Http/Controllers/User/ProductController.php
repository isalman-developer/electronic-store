<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Core\Services\User\ProductService;
use App\Core\Services\User\CategoryService;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected CategoryService $categoryService
    ) {}

    public function index()
    {
        $products = $this->productService->getAll(
            columns: ['id', 'title', 'price', 'category_id','slug'],
            relations: ['category', 'media', 'brand', 'colors'],
            perPage: 12
        );

        return view('user.products.index', compact('products'));
    }

    public function show($slug)
    {
        $product = $this->productService->getBySlug(
            slug: $slug,
            relations: ['category', 'sizes', 'colors', 'media']
        );

        return view('user.products.show', compact('product'));
    }

    public function category($categoryId)
    {
        $category = $this->categoryService->getById($categoryId);
        $products = $this->productService->getAll(
            conditions: ['category_id' => $categoryId],
            relations: ['category', 'media'],
            perPage: 12
        );
    }

    public function categoryProducts($categorySlug)
    {
        $products = $this->productService->getProductsByCategory($categorySlug);
        return view('user.products.index', compact('products'));
    }

    public function brandProducts($brandSlug)
    {
        $products = $this->productService->getProductsByBrand($brandSlug);
        return view('user.products.index', compact('products'));
    }

    public function categoryBrandProducts($categorySlug, $brandSlug)
    {
        $products = $this->productService->getProductsByCategoryAndBrand($categorySlug, $brandSlug);
        return view('user.products.index', compact('products'));
    }

    public function categoryPriceProducts($categorySlug, $min, $max)
    {
        $products = $this->productService->getProductsByPriceRange($categorySlug, $min, $max);
        return view('user.products.index', compact('products'));
    }

    public function categoryInStockProducts($categorySlug)
    {
        $products = $this->productService->getInStockProducts($categorySlug);
        return view('user.products.index', compact('products'));
    }

    public function categorySortedProducts($categorySlug, $sortOption)
    {
        $products = $this->productService->getSortedProducts($categorySlug, $sortOption);
        return view('user.products.index', compact('products'));
    }

    public function filteredProducts($categorySlug, $brandSlug, $min, $max, $sortOption)
    {
        $products = $this->productService->getFilteredProducts($categorySlug, $brandSlug, $min, $max, $sortOption);
        return view('user.products.index', compact('products'));
    }
}
