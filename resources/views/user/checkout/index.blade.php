@extends('user.layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Checkout</h1>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Shipping Information</h5>

                        <form action="{{ route('order.place') }}" method="POST" id="checkoutForm">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="first_name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="last_name" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Street Address</label>
                                <input type="text" class="form-control" id="address" name="shipping_address" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                </div>
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label for="state" class="form-label">State/Province</label>
                                    <input type="text" class="form-control" id="state" name="state" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="zip" class="form-label">Zip/Postal Code</label>
                                    <input type="text" class="form-control" id="zip" name="zip" required>
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
                            </div>

                            <div class="mb-3">
                                <label for="notes" class="form-label">Order Notes (Optional)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                            </div>

                            <!-- Hidden field for cart data -->
                            <input type="hidden" name="cart_data" id="cartData">

                            <h5 class="card-title mt-5 mb-4">Payment Method</h5>

                            <div class="mb-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment_method"
                                        id="paymentCreditCard" value="credit_card" checked>
                                    <label class="form-check-label" for="paymentCreditCard">
                                        Credit Card
                                    </label>
                                </div>

                                <div id="creditCardFields" class="ps-4 mb-4">
                                    <div class="mb-3">
                                        <label for="cardNumber" class="form-label">Card Number</label>
                                        <input type="text" class="form-control" id="cardNumber"
                                            placeholder="1234 5678 9012 3456">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="expiryDate" class="form-label">Expiry Date</label>
                                            <input type="text" class="form-control" id="expiryDate"
                                                placeholder="MM/YY">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cvv" class="form-label">CVV</label>
                                            <input type="text" class="form-control" id="cvv" placeholder="123">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method"
                                        id="paymentPaypal" value="paypal">
                                    <label class="form-check-label" for="paymentPaypal">
                                        PayPal
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark btn-lg">Place Order</button>
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
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                console.log('Checkout page loaded');

                const checkoutItemsList = document.getElementById('checkoutItemsList');
                const checkoutSubtotal = document.getElementById('checkoutSubtotal');
                const checkoutTotal = document.getElementById('checkoutTotal');
                const cartDataInput = document.getElementById('cartData');

                // Load checkout items from localStorage
                function loadCheckoutItems() {
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

                        // Insert checkout items HTML
                        checkoutItemsList.innerHTML = checkoutHTML;

                        // Update totals
                        checkoutSubtotal.textContent = '$' + subtotal.toFixed(2);
                        checkoutTotal.textContent = '$' + subtotal.toFixed(2);

                        // Store cart data in hidden input for form submission
                        cartDataInput.value = savedItems;
                    } else {
                        // Redirect to cart if no items
                        window.location.href = '{{ route('cart.index') }}';
                    }
                }

                // Handle form submission
                document.getElementById('checkoutForm').addEventListener('submit', function(e) {
                    // You can add validation here if needed

                    // Clear cart after successful order (will happen after form submission)
                    // localStorage.removeItem('cartItems');
                    // localStorage.removeItem('quickBuyCount');
                });

                // Initial load
                loadCheckoutItems();
            });
        </script>
    @endpush
@endsection
