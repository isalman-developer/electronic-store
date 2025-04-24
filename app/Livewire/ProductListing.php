<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Core\Services\Admin\ProductService;

class ProductListing extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";
    public $category;
    public $orderBy = 'latest';
    public $minPrice = 0;
    public $maxPrice = 10000;
    public $perPage = 12;

    protected $queryString = [
        'category',
        'orderBy',
        'minPrice',
        'maxPrice'
    ];

    public function updating($field)
    {
        $this->resetPage();
    }

    public function updatingorderBy()
    {
        $this->resetPage();
    }

    public function render(ProductService $productService)
    {
        $conditions = [];
        if ($this->category) {
            $conditions['category_id'] = $this->category;
        }

        $orderByOptions = [
            'latest' => ['id' => 'desc'],
            'price_low' => ['price' => 'asc'],
            'price_high' => ['price' => 'desc'],
        ];

        // Ensure the orderBy option is correctly passed as an array
        $orderBy = $orderByOptions[$this->orderBy] ?? ['id' => 'desc'];

        $products = $productService->getAll(
            columns: ['*'], // Columns
            relations: ['category', 'media'], // Relations
            conditions: $conditions, // Filters
            perPage: $this->perPage, // Items per page
            orderBy: $orderBy // Sorting
        );

        return view('user.livewire.product-listing', compact('products'));
    }

    public function updated($propertyName)
    {
        info("Updated Property: {$propertyName}, New Value: " . $this->$propertyName);
    }
}
