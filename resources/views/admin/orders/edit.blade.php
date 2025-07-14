@extends('admin.layouts.app')

@section('title', "Edit Order #{$order->order_number}")
@section('toogle-button', 'Edit Order')

@section('content')
    <!-- Start Container Fluid -->
    <div class="container-xxl">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Order #{{ $order->order_number }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Customer Information -->
                                <div class="col-lg-6">
                                    <h5 class="mb-3">Customer Information</h5>
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                               value="{{ $order->first_name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                               value="{{ $order->last_name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{ $order->email }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                               value="{{ $order->phone }}">
                                    </div>
                                </div>

                                <!-- Order Information -->
                                <div class="col-lg-6">
                                    <h5 class="mb-3">Order Information</h5>
                                    <div class="mb-3">
                                        <label for="order_number" class="form-label">Order Number</label>
                                        <input type="text" class="form-control" id="order_number" name="order_number"
                                               value="{{ $order->order_number }}" readonly>
                                        <small class="text-muted">Order number cannot be changed</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Order Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                            <option value="refunded" {{ $order->status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                            <option value="returned" {{ $order->status == 'returned' ? 'selected' : '' }}>Returned</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="payment_status" class="form-label">Payment Status</label>
                                        <select class="form-control" id="payment_status" name="payment_status" required>
                                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="refund" {{ $order->payment_status == 'refund' ? 'selected' : '' }}>Refunded</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="payment_method" class="form-label">Payment Method</label>
                                        <input type="text" class="form-control" id="payment_method" name="payment_method"
                                               value="{{ $order->payment_method }}" readonly>
                                        <small class="text-muted">Payment method cannot be changed after order creation</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Information -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5 class="mb-3">Shipping Information</h5>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="shipping_address" class="form-label">Shipping Address</label>
                                                <textarea class="form-control" id="shipping_address" name="shipping_address"
                                                          rows="3" required>{{ $order->shipping_address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="city" class="form-label">City</label>
                                                        <input type="text" class="form-control" id="city" name="city"
                                                               value="{{ $order->city }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="state" class="form-label">State</label>
                                                        <input type="text" class="form-control" id="state" name="state"
                                                               value="{{ $order->state }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="zip" class="form-label">ZIP Code</label>
                                                        <input type="text" class="form-control" id="zip" name="zip"
                                                               value="{{ $order->zip }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="country" class="form-label">Country</label>
                                                        <input type="text" class="form-control" id="country" name="country"
                                                               value="{{ $order->country }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tracking Information -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5 class="mb-3">Tracking Information</h5>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="courier" class="form-label">Courier</label>
                                                <input type="text" class="form-control" id="courier" name="courier"
                                                       value="{{ $order->courier }}" placeholder="e.g., FedEx, UPS, DHL">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="tracking_number" class="form-label">Tracking Number</label>
                                                <input type="text" class="form-control" id="tracking_number" name="tracking_number"
                                                       value="{{ $order->tracking_number }}" placeholder="e.g., 1234567890">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Items (Read-only) -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5 class="mb-3">Order Items (Read-only)</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->items as $item)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if($item->product && $item->product->image)
                                                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                                                     alt="{{ $item->product->name }}"
                                                                     class="me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                                            @endif
                                                            <div>
                                                                <strong>{{ $item->product->name ?? 'Product Not Found' }}</strong>
                                                                @if($item->product)
                                                                    <br><small class="text-muted">SKU: {{ $item->product->sku ?? 'N/A' }}</small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>${{ number_format($item->price, 2) }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <small class="text-muted">Order items cannot be modified after order creation</small>
                                </div>
                            </div>

                            <!-- Financial Information -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5 class="mb-3">Financial Information</h5>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="total_amount" class="form-label">Total Amount</label>
                                                <input type="number" class="form-control" id="total_amount" name="total_amount"
                                                       value="{{ $order->total_amount }}" step="0.01" readonly>
                                                <small class="text-muted">Total amount cannot be changed after order creation</small>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="shipping_method" class="form-label">Shipping Method</label>
                                                <input type="text" class="form-control" id="shipping_method" name="shipping_method"
                                                       value="{{ $order->shipping_method }}" placeholder="e.g., Standard, Express">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="notes" class="form-label">Order Notes</label>
                                                <textarea class="form-control" id="notes" name="notes"
                                                          rows="3">{{ $order->notes }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary">
                                            Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            Update Order
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Container Fluid -->
@endsection
