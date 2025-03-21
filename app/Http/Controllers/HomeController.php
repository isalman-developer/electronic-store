<?php

namespace App\Http\Controllers;

use App\Core\Services\CategoryService;
use App\Core\Services\ColorService;
use App\Core\Services\SliderService;
use App\Core\Services\ProductService;

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
        $newArrivals = $this->productService->getNewArrivals();
        $categories = $this->categoryService->getAll();
        $colors = $this->colorService->getAll();
        return view('home', compact('sliders', 'newArrivals'));
    }
}
