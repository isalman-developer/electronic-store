<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Core\Services\User\BrandService;
use App\Core\Services\User\ColorService;
use App\Core\Services\User\SliderService;
use App\Core\Services\User\ProductService;
use App\Core\Services\User\CategoryService;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected SliderService $sliderService,
        protected ColorService $colorService,
        protected CategoryService $categoryService,
        protected BrandService $brandService
    ) {}

    public function index(Request $request)
    {
        $filters = $this->getFiltersFromRequest($request);
        $products = $this->productService->getFilteredProducts($filters);

        if ($request->ajax()) {
            return response()->json([
                'products' => view('user.products.partials.product-grid', compact('products'))->render(),
            ]);
        }

        $categories = $this->categoryService->getCategories();
        $brands = $this->brandService->getBrands();
        $colors = $this->colorService->getColors();

        return view('user.products.index', compact('products', 'categories', 'brands', 'colors', 'filters'));
    }

    public function quickView(Product $product)
    {
        $product->load(['category', 'media', 'brand', 'colors']);
        return response()->json([
            'success' => true,
            'html' => view('user.products.product-quick-view-modal', compact('product'))->render()
        ]);
    }

    public function show($slug)
    {
        $product = $this->productService->getBySlug(
            slug: $slug,
            relations: ['category', 'sizes', 'colors', 'media']
        );

        return view('user.products.show', compact('product'));
    }

    /**
     * Handle category-specific product listing
     */
    public function categoryProducts(Request $request, $categorySlug)
    {
        $filters = $this->getFiltersFromRequest($request);
        $filters['category_slug'] = $categorySlug;

        $products = $this->productService->getFilteredProducts($filters);
        $category = $this->categoryService->getBySlug($categorySlug);
        $categories = $this->categoryService->getCategories();
        $brands = $this->brandService->getBrands();
        $colors = $this->colorService->getColors();

        if ($request->ajax()) {
            return response()->json([
                'products' => view('user.products.partials.product-grid', compact('products'))->render(),
            ]);
        }

        return view('user.products.index', compact('products', 'category', 'categories', 'brands', 'colors', 'filters'));
    }

    /**
     * Handle brand-specific product listing
     */
    public function brandProducts(Request $request, $brandSlug)
    {
        $filters = $this->getFiltersFromRequest($request);
        $filters['brand_slug'] = $brandSlug;

        $products = $this->productService->getFilteredProducts($filters);
        $brand = $this->brandService->getBySlug($brandSlug);
        $categories = $this->categoryService->getCategories();
        $brands = $this->brandService->getBrands();
        $colors = $this->colorService->getColors();

        if ($request->ajax()) {
            return response()->json([
                'products' => view('user.products.partials.product-grid', compact('products'))->render(),
            ]);
        }

        return view('user.products.index', compact('products', 'brand', 'categories', 'brands', 'colors', 'filters'));
    }

    /**
     * Handle category and brand combined filtering
     */
    public function categoryBrandProducts(Request $request, $categorySlug, $brandSlug)
    {
        $filters = $this->getFiltersFromRequest($request);
        $filters['category_slug'] = $categorySlug;
        $filters['brand_slug'] = $brandSlug;

        $products = $this->productService->getFilteredProducts($filters);
        $category = $this->categoryService->getBySlug($categorySlug);
        $brand = $this->brandService->getBySlug($brandSlug);
        $categories = $this->categoryService->getCategories();
        $brands = $this->brandService->getBrands();
        $colors = $this->colorService->getColors();

        if ($request->ajax()) {
            return response()->json([
                'products' => view('user.products.partials.product-grid', compact('products'))->render(),
            ]);
        }

        return view('user.products.index', compact('products', 'category', 'brand', 'categories', 'brands', 'colors', 'filters'));
    }

    public function filteredProducts($categorySlug, $brandSlug, $min, $max, $sortOption)
    {
        $products = $this->productService->getFilteredProducts($categorySlug, $brandSlug, $min, $max, $sortOption);
        return view('user.products.index', compact('products'));
    }

    public function getFiltersFromRequest(Request $request)
    {
        $filters = [];

        // Handle colors filter
        if ($request->has('colors')) {
            if (is_array($request->input('colors'))) {
                $filters['colors'] = $request->input('colors');
            } else if (is_string($request->input('colors'))) {
                $filters['colors'] = explode('-', $request->input('colors'));
            }
        }

        // Handle price range filter
        if ($request->has('price')) {
            $priceRange = $request->input('price');
            if (strpos($priceRange, '-') !== false) {
                list($min, $max) = explode('-', $priceRange);
                if ($min !== '') {
                    $filters['price_min'] = $min;
                }
                if ($max !== '') {
                    $filters['price_max'] = $max;
                }
            } else {
                $filters['price_min'] = $request->input('price');
            }
        } else {
            // Handle separate min/max price inputs
            if ($request->has('min_price')) {
                $filters['price_min'] = $request->input('min_price');
            }
            if ($request->has('max_price')) {
                $filters['price_max'] = $request->input('max_price');
            }
        }

        // Handle rating filter
        if ($request->has('rating')) {
            $filters['rating'] = $request->input('rating');
        }

        // Handle in-stock filter
        if ($request->has('in_stock')) {
            $filters['in_stock'] = true;
        }

        // Handle sort option
        if ($request->has('sort')) {
            $filters['sort'] = $request->input('sort');
        }

        return $filters;
    }
}
