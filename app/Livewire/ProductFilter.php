<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductFilter extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Filter properties
    public $inStock = true;
    public $selectedColors = ['Black'];
    public $selectedBrands = ['Brand-1'];
    public $selectedProductTypes = ['Kitchen'];
    public $minPrice = 10;
    public $maxPrice = 259;
    public $selectedRating = 4;
    public $sortBy = 'featured';

    // Available options for filters
    public $colors = [];
    public $brands = [];
    public $productTypes = [];

    protected $queryString = [
        'inStock' => ['except' => true],
        'selectedColors' => ['except' => []],
        'selectedBrands' => ['except' => []],
        'selectedProductTypes' => ['except' => []],
        'minPrice' => ['except' => 10],
        'maxPrice' => ['except' => 259],
        'selectedRating' => ['except' => 0],
        'sortBy' => ['except' => 'featured'],
    ];

    public function mount()
    {
        info("mounted");
        // Load available filter options
        $this->colors = \App\Models\Color::pluck('title')->toArray();
        $this->brands = Product::distinct()->pluck('brand')->toArray();
        $this->productTypes = Product::distinct()->pluck('product_type')->toArray();
    }

    public function updatingInStock()
    {
        info("updating in stock");
        $this->resetPage();
    }

    public function updatingSelectedColors()
    {
        info("updating in colors");
        $this->resetPage();
    }

    public function updatingSelectedBrands()
    {
        info("updating in brands");
        $this->resetPage();
    }

    public function updatingSelectedProductTypes()
    {
        info("updating in product type");
        $this->resetPage();
    }

    public function updatingMinPrice()
    {
        info("updating in mi price");
        $this->resetPage();
    }

    public function updatingMaxPrice()
    {
        info("updating in max price");
        $this->resetPage();
    }

    public function updatingSelectedRating()
    {
        info("updating in rating");
        $this->resetPage();
    }

    public function updatingSortBy()
    {
        info("updating in sort by");
        $this->resetPage();
    }

    public function setPriceRange($min, $max)
    {
        info("updating in price range");
        $this->minPrice = $min;
        $this->maxPrice = $max;
        $this->resetPage();
    }

    public function toggleColor($color)
    {
        info("updating in toggle color");
        if (in_array($color, $this->selectedColors)) {
            $this->selectedColors = array_diff($this->selectedColors, [$color]);
        } else {
            $this->selectedColors[] = $color;
        }
        $this->resetPage();
    }

    public function toggleBrand($brand)
    {
        info("updating in toogle brand");
        if (in_array($brand, $this->selectedBrands)) {
            $this->selectedBrands = array_diff($this->selectedBrands, [$brand]);
        } else {
            $this->selectedBrands[] = $brand;
        }
        $this->resetPage();
    }

    public function toggleProductType($type)
    {
        info("updating in toogle product type");
        if (in_array($type, $this->selectedProductTypes)) {
            $this->selectedProductTypes = array_diff($this->selectedProductTypes, [$type]);
        } else {
            $this->selectedProductTypes[] = $type;
        }
        $this->resetPage();
    }

    public function setRating($rating)
    {
        info("updating in set rating");
        $this->selectedRating = $rating;
        $this->resetPage();
    }

    public function clearFilter($filter)
    {
        info("updating in cler filter ");
        switch ($filter) {
            case 'inStock':
                $this->inStock = false;
                break;
            case 'colors':
                $this->selectedColors = [];
                break;
            case 'brands':
                $this->selectedBrands = [];
                break;
            case 'productTypes':
                $this->selectedProductTypes = [];
                break;
            case 'priceRange':
                $this->minPrice = 0;
                $this->maxPrice = 500;
                break;
            case 'rating':
                $this->selectedRating = 0;
                break;
        }
        $this->resetPage();
    }

    public function clearAllFilters()
    {
        info("updating in clear all filters ");
        $this->inStock = false;
        $this->selectedColors = [];
        $this->selectedBrands = [];
        $this->selectedProductTypes = [];
        $this->minPrice = 0;
        $this->maxPrice = 500;
        $this->selectedRating = 0;
        $this->sortBy = 'featured';
        $this->resetPage();
    }

    public function render()
    {
        info("updating in render");
        $query = Product::query();

        // Apply filters
        if ($this->inStock) {
            $query->where('stock', '>', 0);
        }

        if (!empty($this->selectedColors)) {
            $query->whereHas('colors', function($q) {
                $q->whereIn('title', $this->selectedColors);
            });
        }

        if (!empty($this->selectedBrands)) {
            $query->whereIn('brand', $this->selectedBrands);
        }

        if (!empty($this->selectedProductTypes)) {
            $query->whereIn('product_type', $this->selectedProductTypes);
        }

        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);

        if ($this->selectedRating > 0) {
            $query->where('rating', '>=', $this->selectedRating);
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'Best selling':
                $query->orderBy('sales_count', 'desc');
                break;
            case 'Alphabetically, A-Z':
                $query->orderBy('title', 'asc');
                break;
            case 'Alphabetically, Z-A':
                $query->orderBy('title', 'desc');
                break;
            case 'Price, low to high':
                $query->orderBy('price', 'asc');
                break;
            case 'Price, high to low':
                $query->orderBy('price', 'desc');
                break;
            case 'Date, old to new':
                $query->orderBy('created_at', 'asc');
                break;
            case 'Date, new to old':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('featured', 'desc');
        }

        $products = $query->paginate(12);

        return view('livewire.product-filter', [
            'products' => $products
        ]);
    }
}
