@extends('user.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                    </div>
                    
                    <h1 class="mb-3">Thank You!</h1>
                    <p class="lead mb-4">Your order has been placed successfully.</p>
                    
                    <div class="mb-4">
                        <p class="mb-1">Order Number: <strong>{{ $order->order_number }}</strong></p>
                        <p>A confirmation email has been sent to <strong>{{ $order->email }}</strong></p>
                    </div>
                    
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('product.index') }}" class="btn btn-outline-dark">Continue Shopping</a>
                        <a href="{{ route('user.orders') }}" class="btn btn-dark">View My Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Clear cart after successful order
    localStorage.removeItem('cartItems');
    localStorage.removeItem('quickBuyCount');
</script>
@endpush
@endsection