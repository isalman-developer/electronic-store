<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Core\Services\User\ColorService;
use App\Core\Services\User\SliderService;
use App\Core\Services\User\ProductService;
use App\Core\Services\User\CategoryService;
use App\Models\Product;

class HomeController extends Controller
{
    public function __construct(
        protected SliderService $sliderService,
        protected ProductService $productService,
        protected ColorService $colorService,
        protected CategoryService $categoryService
    ) {}

    public function index()
    {
        $sliders = $this->sliderService->getSliders();
        $newArrivals = $this->productService->getNewArrivalProducts();
        $categories = $this->categoryService->getCategories();
        $colors = $this->colorService->getColors();

        return view('home', compact('sliders', 'newArrivals', 'categories', 'colors'));
    }
}
