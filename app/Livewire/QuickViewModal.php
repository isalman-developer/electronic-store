<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class QuickViewModal extends Component
{
    public $show = false;
    public $productId = null;
    public $product = null;
    public $quantity = 1;
    public $selectedColorId = null;

    protected $listeners = ['showQuickViewModal'];

    public function showQuickViewModal($productId)
    {

        $this->productId = $productId;
        $this->loadProduct();
        $this->show = true;
    }

    public function loadProduct()
    {
        $this->product = Product::with(['media', 'colors', 'brand', 'category'])->findOrFail($this->productId);
        $this->selectedColorId = $this->product->colors->first()->id ?? null;
    }

    public function incrementQuantity()
    {
        $this->quantity++;
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        // Add to cart logic
        // You can dispatch events or call your cart service

        // Example:
        // auth()->user()->cart()->add($this->productId, $this->quantity, $this->selectedColorId);

        // $this->dispatchBrowserEvent('cart-updated');
        // $this->dispatchBrowserEvent('notify', [
        //     'type' => 'success',
        //     'message' => 'Product added to cart successfully!'
        // ]);

        $this->closeModal();
    }
    public function addToWishlist()
    {
        // // Add to wishlist logic
        // auth()->user()->wishlist()->add($this->productId);

        // $this->dispatchBrowserEvent('notify', [
        //     'type' => 'success',
        //     'message' => 'Product added to wishlist!'
        // ]);
    }
    public function closeModal()
    {
        $this->show = false;
        $this->reset(['productId', 'product', 'quantity', 'selectedColorId']);
    }

    public function render()
    {
        return view('user.livewire.quick-view-modal');
    }
}
