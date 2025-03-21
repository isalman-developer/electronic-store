<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Core\Services\ProductService;
use App\Core\Services\CategoryService;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected CategoryService $categoryService
    ) {}

    public function index()
    {
        $products = $this->productService->getAll(
            columns: ['id', 'title', 'price', 'category_id'],
            relations: ['category', 'media'],
            paginate: true,
            perPage: 12
        );

        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = $this->productService->getById(
            id: $id,
            relations: ['category', 'sizes', 'colors', 'media']
        );

        return view('products.show', compact('product'));
    }

    public function category($categoryId)
    {
        $category = $this->categoryService->getById($categoryId);
        $products = $this->productService->getAll(
            conditions: ['category_id' => $categoryId],
            relations: ['category', 'media'],
            paginate: true,
            perPage: 12
        );

        // return view('products.category', compact('category', 'products'));
    }
}
