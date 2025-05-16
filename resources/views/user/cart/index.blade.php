@extends('user.layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Your Shopping Cart</h1>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body" id="cartPageItems">
                        <!-- Cart items will be loaded here via JavaScript -->
                        <div class="text-center py-5" id="emptyCartMessage">
                            @include('user.svgs.empty-cart-svg')
                            <h4>Your cart is empty</h4>
                            <p class="text-muted">Add items to your cart to continue shopping</p>
                            <a href="{{ route('product.index') }}" class="btn btn-dark mt-3">Browse Products</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm" id="orderSummary" style="display: none;">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span id="cartSubtotal">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total</strong>
                            <strong id="cartTotal">$0.00</strong>
                        </div>

                        <a href="{{ route('checkout') }}" class="btn btn-dark w-100">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                console.log('Cart page loaded');

                const cartPageItems = document.getElementById('cartPageItems');
                const emptyCartMessage = document.getElementById('emptyCartMessage');
                const orderSummary = document.getElementById('orderSummary');
                const cartSubtotal = document.getElementById('cartSubtotal');
                const cartTotal = document.getElementById('cartTotal');

                // Load cart items from localStorage
                function loadCartItems() {
                    const savedItems = localStorage.getItem('cartItems');
                    console.log('Cart items from localStorage:', savedItems);

                    if (savedItems && JSON.parse(savedItems).length > 0) {
                        const items = JSON.parse(savedItems);
                        let cartHTML = '';
                        let subtotal = 0;

                        // Generate HTML for each cart item
                        items.forEach((item, index) => {
                            const itemTotal = item.price * item.quantity;
                            subtotal += itemTotal;

                            cartHTML += `
                            <div class="d-flex align-items-center cart-page-item mb-3 pb-3 border-bottom" data-index="${index}">
                                <img src="${item.image}" alt="${item.name}" class="img-fluid me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h5 class="mb-1">${item.name}</h5>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <span class="text-muted">$${item.price.toFixed(2)} × ${item.quantity}</span>
                                            <div class="d-inline-flex align-items-center mt-2 border p-1 ms-2">
                                                <button class="btn btn-sm btn-link text-dark p-0 cart-qty-minus">−</button>
                                                <input type="number" class="form-control form-control-sm text-center mx-2 cart-qty" 
                                                    value="${item.quantity}" min="1" style="width: 45px;">
                                                <button class="btn btn-sm btn-link text-dark p-0 cart-qty-plus">+</button>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="fw-bold me-3">$${itemTotal.toFixed(2)}</span>
                                            <button class="btn btn-sm btn-outline-danger cart-remove-btn">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                        });

                        // Insert cart items HTML and hide empty cart message
                        cartPageItems.innerHTML = cartHTML + emptyCartMessage.outerHTML;
                        document.getElementById('emptyCartMessage').style.display = 'none';

                        // Show order summary
                        orderSummary.style.display = 'block';

                        // Update totals
                        cartSubtotal.textContent = '$' + subtotal.toFixed(2);
                        cartTotal.textContent = '$' + subtotal.toFixed(2);

                        // Add event listeners to quantity buttons and remove buttons
                        addCartEventListeners();
                    } else {
                        // Show empty cart message and hide order summary
                        emptyCartMessage.style.display = 'block';
                        orderSummary.style.display = 'none';
                    }
                }

                // Add event listeners to cart items
                function addCartEventListeners() {
                    // Quantity plus buttons
                    document.querySelectorAll('.cart-qty-plus').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const item = this.closest('.cart-page-item');
                            const index = parseInt(item.dataset.index);
                            const qtyInput = item.querySelector('.cart-qty');
                            const currentQty = parseInt(qtyInput.value);

                            qtyInput.value = currentQty + 1;
                            updateCartItem(index, currentQty + 1);
                        });
                    });

                    // Quantity minus buttons
                    document.querySelectorAll('.cart-qty-minus').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const item = this.closest('.cart-page-item');
                            const index = parseInt(item.dataset.index);
                            const qtyInput = item.querySelector('.cart-qty');
                            const currentQty = parseInt(qtyInput.value);

                            if (currentQty > 1) {
                                qtyInput.value = currentQty - 1;
                                updateCartItem(index, currentQty - 1);
                            }
                        });
                    });

                    // Quantity input change
                    document.querySelectorAll('.cart-qty').forEach(input => {
                        input.addEventListener('change', function() {
                            const item = this.closest('.cart-page-item');
                            const index = parseInt(item.dataset.index);
                            const newQty = parseInt(this.value) || 1;

                            this.value = newQty;
                            updateCartItem(index, newQty);
                        });
                    });

                    // Remove buttons
                    document.querySelectorAll('.cart-remove-btn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const item = this.closest('.cart-page-item');
                            const index = parseInt(item.dataset.index);

                            removeCartItem(index);
                        });
                    });
                }

                // Update cart item quantity
                function updateCartItem(index, newQuantity) {
                    const savedItems = JSON.parse(localStorage.getItem('cartItems'));

                    if (savedItems && savedItems[index]) {
                        savedItems[index].quantity = newQuantity;
                        localStorage.setItem('cartItems', JSON.stringify(savedItems));

                        // Update total count
                        const totalCount = savedItems.reduce((sum, item) => sum + item.quantity, 0);
                        localStorage.setItem('quickBuyCount', totalCount);

                        // Reload cart to reflect changes
                        loadCartItems();

                        // Update the navbar cart count
                        const quickBuyCountElem = document.getElementById("quickBuyCount");
                        if (quickBuyCountElem) {
                            quickBuyCountElem.textContent = totalCount;
                        }
                    }
                }

                // Remove cart item
                function removeCartItem(index) {
                    const savedItems = JSON.parse(localStorage.getItem('cartItems'));

                    if (savedItems && savedItems[index]) {
                        savedItems.splice(index, 1);
                        localStorage.setItem('cartItems', JSON.stringify(savedItems));

                        // Update total count
                        const totalCount = savedItems.reduce((sum, item) => sum + item.quantity, 0);
                        localStorage.setItem('quickBuyCount', totalCount);

                        // Reload cart to reflect changes
                        loadCartItems();

                        // Update the navbar cart count
                        const quickBuyCountElem = document.getElementById("quickBuyCount");
                        if (quickBuyCountElem) {
                            quickBuyCountElem.textContent = totalCount;
                        }
                    }
                }

                // Initial load
                loadCartItems();

                // Debug: Check if localStorage has cart items
                console.log('Initial cart items:', localStorage.getItem('cartItems'));
                console.log('Initial quick buy count:', localStorage.getItem('quickBuyCount'));
            });
        </script>
    @endpush
@endsection
