<?php

namespace App\Http\Controllers;

use App\Core\Services\Admin\ColorService;
use App\Core\Services\Admin\SliderService;
use App\Core\Services\Admin\ProductService;
use App\Core\Services\Admin\CategoryService;

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
