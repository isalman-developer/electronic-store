<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Core\Services\Admin\SizeService;
use App\Http\Controllers\Controller;
use App\Core\Services\Admin\BrandService;
use App\Core\Services\Admin\ColorService;
use App\Core\Services\Admin\ProductService;
use App\Core\Services\Admin\CategoryService;
use App\Http\Requests\Admin\Product\ProductStoreRequest;
use App\Http\Requests\Admin\Product\ProductUpdateRequest;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $service,
        protected CategoryService $categoryService,
        protected ColorService $colorService,
        protected SizeService $sizeService,
        protected BrandService $brandService
    ) {}

    public function index()
    {
        $products = $this->service->getAll(relations:['media','category','sizes','brand','colors']);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAll();
        $colors = $this->colorService->getAll();
        $sizes = $this->sizeService->getAll();
        $brands = $this->brandService->getAll();
        return view('admin.products.create', compact('categories', 'colors', 'sizes','brands'));
    }

    public function show(Product $product)
    {
        $product->load(['sizes', 'colors', 'category', 'media','brand']);
        return view('admin.products.show', compact('product'));
    }

    public function store(ProductStoreRequest $request)
    {
        $this->service->store($request->validated());
        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load(['colors','sizes']);
        $categories = $this->categoryService->getAll();
        $colors = $this->colorService->getAll();
        $sizes = $this->sizeService->getAll();
        $brands = $this->brandService->getAll();
        return view('admin.products.edit', compact('product', 'categories', 'colors', 'sizes','brands'));
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $this->service->update($product->id, $request->validated());
        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->service->delete($product->id);
        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
