@extends('user.layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor"
                                class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>
                        </div>

                        <h1 class="mb-3">Thank You!</h1>
                        <p class="lead mb-4">Your order has been placed successfully.</p>

                        <div class="mb-4">
                            <p class="mb-1">Order Number: <strong>{{ $order->order_number }}</strong></p>
                            <p>A confirmation email has been sent to <strong>{{ $order->email }}</strong></p>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Order Summary</h5>
                            </div>
                            <div class="card-body">
                                @foreach ($order->items as $item)
                                    <div class="d-flex justify-content-between mb-3">
                                        <div>
                                            <h6 class="mb-0">{{ $item->product_name }}</h6>
                                            <small class="text-muted">Quantity: {{ $item->quantity }}</small>
                                        </div>
                                        <div class="text-end">
                                            <span>${{ number_format($item->price, 2) }}</span>
                                        </div>
                                    </div>
                                @endforeach

                                <hr>

                                <div class="d-flex justify-content-between">
                                    <strong>Total</strong>
                                    <strong>${{ number_format($order->total_amount, 2) }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('product.index') }}" class="btn btn-outline-dark">Continue Shopping</a>
                            @auth
                                <a href="{{ route('user.orders') }}" class="btn btn-dark">View My Orders</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('page-script-bottom')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                console.log('Clearing cart data...');

                // Clear cart after successful order
                localStorage.removeItem('cartItems');
                localStorage.removeItem('quickBuyCount');

                // Update cart count in navbar
                const quickBuyCountElem = document.getElementById("quickBuyCount");
                if (quickBuyCountElem) {
                    quickBuyCountElem.textContent = "0";
                    quickBuyCountElem.style.display = "none";
                }

                console.log('Cart data cleared successfully');
            });
        </script>
    @endpush
@endsection
