@extends('user.layouts.app')
@section('title', 'Cart')
@section('content')
    <!--Breadcrumb start-->
    <div class="container">
        <div class="row">
            <div class="col-12 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12">
                <!--Heading-->
                <div class="mb-4">
                    <h1 class="mb-0">Shopping Cart</h1>
                </div>
            </div>
        </div>
    </div>
    <!--Breadcrub end-->
    <!--Product shopping start-->
    <section class="pt-lg-4 pb-lg-8">
        <div class="container">
            <div class="row gx-lg-6 gy-4 gy-lg-0">
                <!--Shopping cart-->
                <div class="col-lg-8">
                    <div class="mb-4">
                        <span>Spend $61.00 more and get free shipping!</span>
                        <div class="progress mt-3" style="height: 4px">
                            <div class="progress-bar bg-danger" role="progressbar" aria-label="Basic example"
                                style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--Product table-->
                    <div class="card">
                        <div class="card-body">
                            <!-- Loading spinner -->
                            <div id="cartLoading" class="text-center py-5">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2">Loading your cart...</p>
                            </div>

                            <div class="table-responsive" id="cartContent" style="display: none;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Cart items will be loaded here via JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 d-flex gap-3">
                        <a href="{{ route('product.index') }}" class="text-link">Continue Shopping</a>
                        <a href="#!" class="text-link" id="updateCartBtn">Update Shopping Cart</a>
                    </div>
                    <div class="mt-6">
                        <h3 class="fs-6 d-flex align-items-center gap-2 mb-3">
                            <span>
                                @include('user.svgs.discount-svg')
                            </span>
                            <span>Apply Discount Code</span>
                        </h3>
                        <form class="row g-3">
                            <div class="col-lg-4 col-md-8 col-12">
                                <label for="discountCode" class="visually-hidden">Code</label>
                                <input type="text" class="form-control" id="discountCode" placeholder="" required />
                            </div>

                            <div class="col-lg-auto col-md-4 col-12">
                                <button type="submit" class="btn btn-primary">Apply Discount</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--Order summary-->
                <div class="col-lg-4">
                    <div class="card bg-light bg-opacity-25 mb-4">
                        <div class="card-header px-4 py-3">
                            <h3 class="fs-5 mb-0">Order Summary</h3>
                        </div>
                        <div class="card-body px-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span class="text-dark fw-medium" id="subtotalAmount">$0.00</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span>Shipping</span>
                                <span class="">Free</span>
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-between border-top pt-3 mb-2 fw-medium text-dark">
                                <span class="">Total:</span>
                                <span class="" id="totalAmount">$0.00</span>
                            </div>
                            <small>Tax included and shipping calculated at checkout</small>
                            <div class="d-grid mt-4">
                                <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                    <!--Payments cards-->
                    <div class="card mb-4">
                        <div class="card-body p-4">
                            <h3 class="fs-6 text-center mb-3">We accept payments</h3>
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                @include('user.svgs.credit-card-logos-svg')
                            </div>
                        </div>
                    </div>
                    <div class="" id="freeShippingAlert" style="display: none;">
                        <div class="alert alert-success">You are eligible for free shipping.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-script-bottom')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log('Cart page loaded');
            // Get DOM elements
            const cartLoading = document.getElementById('cartLoading');
            const cartContent = document.getElementById('cartContent');
            const cartTableBody = document.querySelector('table tbody');
            const subtotalElement = document.getElementById('subtotalAmount');
            const totalElement = document.getElementById('totalAmount');
            const freeShippingAlert = document.getElementById('freeShippingAlert');
            const freeShippingThreshold = 100; // Set your free shipping threshold

            // Load cart from localStorage
            function loadCartPage() {
                // Show loading spinner
                cartLoading.style.display = 'block';
                cartContent.style.display = 'none';

                // Simulate network delay (remove this in production)
                setTimeout(() => {
                    const savedItems = localStorage.getItem('cartItems');
                    console.log('Cart items from localStorage:', savedItems);

                    // Hide loading spinner
                    cartLoading.style.display = 'none';
                    cartContent.style.display = 'block';

                    if (savedItems && JSON.parse(savedItems).length > 0) {
                        const items = JSON.parse(savedItems);

                        // Clear existing items
                        cartTableBody.innerHTML = '';

                        // Calculate total
                        let total = 0;

                        // Add each item to cart
                        items.forEach((item, index) => {
                            const itemTotal = item.price * item.quantity;
                            total += itemTotal;

                            const row = document.createElement('tr');
                            row.setAttribute('data-index', index);
                            row.innerHTML = `
                            <td class="py-4 align-middle">
                                <div class="d-flex align-items-start gap-4">
                                    <a href="#!">
                                        <img src="${item.image}" alt="${item.name}" class="border" width="80" />
                                    </a>
                                    <div class="mb-2">
                                        <h3 class="fs-6 mb-1 text-link">
                                            <a href="#!">${item.name}</a>
                                        </h3>
                                        <p class="mb-1">$${item.price.toFixed(2)}</p>
                                        <a href="#!" class="btn btn-danger btn-sm remove-item">Remove</a>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="d-inline-flex align-items-center border p-2">
                                    <button class="btn btn-icon btn-xs btn-focus-none quantity-btn minus fs-5">-</button>
                                    <input type="number" class="form-control quantity-input text-center mx-1 p-0 border-0"
                                        value="${item.quantity}" min="1" style="width: 50px" />
                                    <button class="btn btn-icon btn-xs btn-focus-none quantity-btn plus fs-5">+</button>
                                </div>
                            </td>
                            <td class="align-middle">$${itemTotal.toFixed(2)}</td>
                        `;

                            cartTableBody.appendChild(row);
                        });

                        // Update totals
                        subtotalElement.textContent = `$${total.toFixed(2)}`;
                        totalElement.textContent = `$${total.toFixed(2)}`;

                        // Show/hide free shipping alert
                        if (total >= freeShippingThreshold) {
                            freeShippingAlert.style.display = 'block';
                        } else {
                            freeShippingAlert.style.display = 'none';
                        }

                        // Add event listeners
                        addCartEventListeners();
                    } else {
                        showEmptyCart();
                    }
                }, 500); // Simulate a half-second loading time
            }

            function showEmptyCart() {
                cartTableBody.innerHTML = `
                <tr>
                    <td colspan="3" class="text-center py-5">
                        <div>
                            @include('user.svgs.empty-cart-svg')
                            <h5 class="mt-3">Your cart is empty</h5>
                            <p class="text-muted">Add items to your cart to continue shopping</p>
                            <a href="{{ route('product.index') }}" class="btn btn-primary mt-3">Continue Shopping</a>
                        </div>
                    </td>
                </tr>
            `;

                subtotalElement.textContent = '$0.00';
                totalElement.textContent = '$0.00';
                freeShippingAlert.style.display = 'none';
            }

            function addCartEventListeners() {
                // Handle quantity changes
                document.querySelectorAll('.quantity-input').forEach(input => {
                    input.addEventListener('change', function() {
                        const row = this.closest('tr');
                        const index = row.getAttribute('data-index');
                        updateCartItemQuantity(index, parseInt(this.value) || 1);
                    });
                });

                // Handle minus button
                document.querySelectorAll('.quantity-btn.minus').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const row = this.closest('tr');
                        const index = row.getAttribute('data-index');
                        const input = row.querySelector('.quantity-input');
                        const currentQty = parseInt(input.value);

                        if (currentQty > 1) {
                            input.value = currentQty - 1;
                            updateCartItemQuantity(index, currentQty - 1);
                        }
                    });
                });

                // Handle plus button
                document.querySelectorAll('.quantity-btn.plus').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const row = this.closest('tr');
                        const index = row.getAttribute('data-index');
                        const input = row.querySelector('.quantity-input');
                        const currentQty = parseInt(input.value);

                        input.value = currentQty + 1;
                        updateCartItemQuantity(index, currentQty + 1);
                    });
                });

                // Handle remove button
                document.querySelectorAll('.remove-item').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const row = this.closest('tr');
                        const index = row.getAttribute('data-index');
                        removeCartItem(index);
                    });
                });
            }

            function updateCartItemQuantity(index, quantity) {
                // Show loading spinner
                cartLoading.style.display = 'block';
                cartContent.style.display = 'none';

                setTimeout(() => {
                    const savedItems = JSON.parse(localStorage.getItem('cartItems'));

                    if (savedItems && savedItems[index]) {
                        savedItems[index].quantity = quantity;

                        // Recalculate total count
                        const quickBuyCount = savedItems.reduce((sum, item) => sum + item.quantity, 0);

                        // Save to localStorage
                        localStorage.setItem('cartItems', JSON.stringify(savedItems));
                        localStorage.setItem('quickBuyCount', quickBuyCount);

                        // Update the navbar cart count
                        const quickBuyCountElem = document.getElementById("quickBuyCount");
                        if (quickBuyCountElem) {
                            quickBuyCountElem.textContent = quickBuyCount;
                        }

                        // Reload cart
                        loadCartPage();
                    }
                }, 300); // Shorter delay for updates
            }

            function removeCartItem(index) {
                // Show loading spinner
                cartLoading.style.display = 'block';
                cartContent.style.display = 'none';

                setTimeout(() => {
                    const savedItems = JSON.parse(localStorage.getItem('cartItems'));

                    if (savedItems && savedItems[index]) {
                        savedItems.splice(index, 1);

                        // Recalculate total count
                        const quickBuyCount = savedItems.reduce((sum, item) => sum + item.quantity, 0);

                        // Save to localStorage
                        localStorage.setItem('cartItems', JSON.stringify(savedItems));
                        localStorage.setItem('quickBuyCount', quickBuyCount);

                        // Update the navbar cart count
                        const quickBuyCountElem = document.getElementById("quickBuyCount");
                        if (quickBuyCountElem) {
                            quickBuyCountElem.textContent = quickBuyCount;
                        }

                        // Reload cart
                        loadCartPage();
                    }
                }, 300); // Shorter delay for removals
            }

            // Update cart button
            document.getElementById('updateCartBtn').addEventListener('click', function(e) {
                e.preventDefault();
                loadCartPage();
            });

            // Initialize cart page
            loadCartPage();
        });
    </script>
@endpush
