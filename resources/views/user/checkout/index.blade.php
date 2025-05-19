@extends('user.layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Checkout</h1>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Shipping Information</h5>

                        <!-- Loading spinner for checkout -->
                        <div id="checkoutLoading" class="text-center py-5" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2">Processing your order...</p>
                        </div>

                        <form action="{{ route('order.place') }}" method="POST" id="checkoutForm" class="needs-validation"
                            novalidate>
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="first_name" required>
                                    <div class="invalid-feedback">
                                        Please enter your first name.
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="last_name" required>
                                    <div class="invalid-feedback">
                                        Please enter your last name.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback">
                                    Please enter a valid email address.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                                <div class="invalid-feedback">
                                    Please enter your phone number.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Street Address</label>
                                <input type="text" class="form-control" id="address" name="shipping_address" required>
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                    <div class="invalid-feedback">
                                        Please enter your city.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label for="state" class="form-label">State/Province</label>
                                    <input type="text" class="form-control" id="state" name="state" required>
                                    <div class="invalid-feedback">
                                        Please enter your state or province.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="zip" class="form-label">Zip/Postal Code</label>
                                    <input type="text" class="form-control" id="zip" name="zip" required>
                                    <div class="invalid-feedback">
                                        Please enter your zip code.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-select" id="country" name="country" required>
                                    <option value="">Select Country</option>
                                    <option value="US">United States</option>
                                    <option value="CA">Canada</option>
                                    <option value="UK">United Kingdom</option>
                                    <!-- Add more countries as needed -->
                                </select>
                                <div class="invalid-feedback">
                                    Please select your country.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="notes" class="form-label">Order Notes (Optional)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                            </div>

                            <!-- Hidden field for cart data -->
                            <input type="hidden" name="cart_data" id="cartData">

                            <!-- Hidden payment method field -->
                            <input type="hidden" name="payment_method" value="cash_on_delivery">

                            <h5 class="card-title mt-5 mb-4">Payment Method</h5>

                            <div class="mb-4">
                                <div class="bg-light p-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Cash on Delivery</strong>
                                        <p class="mb-0 text-muted small">Pay with cash when your order is delivered</p>
                                    </div>
                                    <div>
                                        @include('user.svgs.cash-svg')
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark btn-lg" id="placeOrderBtn">Place
                                    Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <!-- Loading spinner for order summary -->
                        <div id="summaryLoading" class="text-center py-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2">Loading your order...</p>
                        </div>

                        <div id="checkoutSummary" style="display: none;">
                            <div id="checkoutItemsList">
                                <!-- Checkout items will be loaded here via JavaScript -->
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span id="checkoutSubtotal">$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping</span>
                                <span>Free</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Total</strong>
                                <strong id="checkoutTotal">$0.00</strong>
                            </div>
                        </div>

                        <!-- Empty cart message -->
                        <div id="emptyCartCheckout" class="text-center py-4" style="display: none;">
                            <div class="mb-3">
                                @include('user.svgs.empty-cart-svg')
                            </div>
                            <h5>Your cart is empty</h5>
                            <p class="text-muted">Add items to your cart before checkout</p>
                            <a href="{{ route('product.index') }}" class="btn btn-dark mt-2">Browse Products</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('page-script-bottom')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                console.log('Checkout page loaded');

                const checkoutItemsList = document.getElementById('checkoutItemsList');
                const checkoutSubtotal = document.getElementById('checkoutSubtotal');
                const checkoutTotal = document.getElementById('checkoutTotal');
                const cartDataInput = document.getElementById('cartData');
                const summaryLoading = document.getElementById('summaryLoading');
                const checkoutSummary = document.getElementById('checkoutSummary');
                const emptyCartCheckout = document.getElementById('emptyCartCheckout');
                const checkoutForm = document.getElementById('checkoutForm');
                const checkoutLoading = document.getElementById('checkoutLoading');
                const placeOrderBtn = document.getElementById('placeOrderBtn');

                // Load checkout items from localStorage
                function loadCheckoutItems() {
                    // Show loading spinner
                    summaryLoading.style.display = 'block';
                    checkoutSummary.style.display = 'none';
                    emptyCartCheckout.style.display = 'none';

                    setTimeout(() => {
                        const savedItems = localStorage.getItem('cartItems');
                        console.log('Cart items from localStorage:', savedItems);

                        if (savedItems && JSON.parse(savedItems).length > 0) {
                            const items = JSON.parse(savedItems);
                            let checkoutHTML = '';
                            let subtotal = 0;

                            // Generate HTML for each checkout item
                            items.forEach(item => {
                                const itemTotal = item.price * item.quantity;
                                subtotal += itemTotal;

                                checkoutHTML += `
                                <div class="d-flex mb-3">
                                    <img src="${item.image}" alt="${item.name}" class="img-fluid me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                    <div>
                                        <h6 class="mb-0">${item.name}</h6>
                                        <small class="text-muted">$${item.price.toFixed(2)} × ${item.quantity}</small>
                                        <div class="fw-bold">$${itemTotal.toFixed(2)}</div>
                                    </div>
                                </div>
                                `;
                            });

                            // Hide loading and show summary
                            summaryLoading.style.display = 'none';
                            checkoutSummary.style.display = 'block';

                            // Insert checkout items HTML
                            checkoutItemsList.innerHTML = checkoutHTML;

                            // Update totals
                            checkoutSubtotal.textContent = '$' + subtotal.toFixed(2);
                            checkoutTotal.textContent = '$' + subtotal.toFixed(2);

                            // Store cart data in hidden input for form submission
                            cartDataInput.value = savedItems;
                        } else {
                            // Hide loading and show empty cart message
                            summaryLoading.style.display = 'none';
                            emptyCartCheckout.style.display = 'block';

                            // Disable the form submission
                            placeOrderBtn.disabled = true;
                        }
                    }, 500);
                }

                // Handle form submission
                checkoutForm.addEventListener('submit', function(e) {
                    // Check if the form is valid
                    if (!this.checkValidity()) {
                        e.preventDefault();
                        e.stopPropagation();
                        this.classList.add('was-validated');
                        return;
                    }

                    // Show loading spinner
                    checkoutLoading.style.display = 'block';
                    checkoutForm.style.display = 'none';

                    // Form is valid, allow submission
                    // The cart will be cleared after successful order in the success page
                });

                // Pre-fill user data if logged in
                if (localStorage.getItem('userData')) {
                    try {
                        const userData = JSON.parse(localStorage.getItem('userData'));
                        if (userData) {
                            if (userData.name) {
                                const nameParts = userData.name.split(' ');
                                if (nameParts.length > 0) document.getElementById('firstName').value = nameParts[0];
                                if (nameParts.length > 1) document.getElementById('lastName').value = nameParts.slice(1)
                                    .join(' ');
                            }
                            if (userData.email) document.getElementById('email').value = userData.email;
                            if (userData.phone) document.getElementById('phone').value = userData.phone;
                            if (userData.address) document.getElementById('address').value = userData.address;
                        }
                    } catch (e) {
                        console.error('Error parsing user data:', e);
                    }
                }

                // Initial load
                loadCheckoutItems();
            });
        </script>
    @endpush
@endsection
