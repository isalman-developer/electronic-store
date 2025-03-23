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
        $sliders = $this->sliderService->getSlidersForHomePage();
        $newArrivals = $this->productService->getNewArrivalsForHomePage();
        $categories = $this->categoryService->getCategoriesForHomePage();
        $colors = $this->colorService->geColorsForHomePage();

        return view('home', compact('sliders', 'newArrivals', 'categories', 'colors'));
    }
}
