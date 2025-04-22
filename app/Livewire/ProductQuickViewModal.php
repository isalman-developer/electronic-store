<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ProductQuickViewModal extends Component
{
    public $product;
    public $isVisible = false;

    protected $listeners = ['showQuickView'];

    public function showQuickView($productId)
    {
        if (is_array($productId) && isset($productId['productId'])) {
            $productId = $productId['productId'];
        }

        try {
            $this->product = Product::with(['category', 'media', 'brand', 'colors'])->findOrFail($productId);
            $this->isVisible = true;
        } catch (\Exception $e) {
            Log::error("Error loading product for quick view: " . $e->getMessage());
        }
    }

    public function hideModal()
    {
        $this->isVisible = false;
    }

    public function render()
    {
        return view('livewire.product-quick-view-modal');
    }
}
