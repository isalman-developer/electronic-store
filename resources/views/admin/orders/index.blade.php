@extends('admin.layouts.app')

@section('title', 'orders List')
@section('toogle-button', 'orders List')
@section('content')
    <!-- Start Container Fluid -->
    <div class="container-xxl">

        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="card-title mb-2">Payment Refund</h4>
                                <p class="text-muted fw-medium fs-22 mb-0">{{ $orderStats['refunded_orders'] }}</p>
                            </div>
                            <div>
                                <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                    <iconify-icon icon="solar:chat-round-money-broken"
                                        class="fs-32 text-primary avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="card-title mb-2">Order Cancel</h4>
                                <p class="text-muted fw-medium fs-22 mb-0">{{ $orderStats['canceled_orders'] }}</p>
                            </div>
                            <div>
                                <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                    <iconify-icon icon="solar:cart-cross-broken"
                                        class="fs-32 text-primary avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="card-title mb-2">Order Shipped</h4>
                                <p class="text-muted fw-medium fs-22 mb-0">{{ $orderStats['shipped_orders'] }}</p>
                            </div>
                            <div>
                                <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                    <iconify-icon icon="solar:box-broken"
                                        class="fs-32 text-primary avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="card-title mb-2">Pending Orders</h4>
                                <p class="text-muted fw-medium fs-22 mb-0">{{ $orderStats['pending_orders'] }}</p>
                            </div>
                            <div>
                                <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                    <iconify-icon icon="solar:clock-circle-broken"
                                        class="fs-32 text-primary avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="card-title mb-2">Paid Orders</h4>
                                <p class="text-muted fw-medium fs-22 mb-0">{{ $orderStats['paid_orders'] }}</p>
                            </div>
                            <div>
                                <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                    <iconify-icon icon="solar:credit-card-broken"
                                        class="fs-32 text-primary avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="card-title mb-2">Completed</h4>
                                <p class="text-muted fw-medium fs-22 mb-0">{{ $orderStats['completed_orders'] }}</p>
                            </div>
                            <div>
                                <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                    <iconify-icon icon="solar:clipboard-check-broken"
                                        class="fs-32 text-primary avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="card-title mb-2">Returned</h4>
                                <p class="text-muted fw-medium fs-22 mb-0">{{ $orderStats['returned_orders'] }}</p>
                            </div>
                            <div>
                                <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                    <iconify-icon icon="solar:rotate-left-broken"
                                        class="fs-32 text-primary avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">All Order List</h4>
                        </div>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light rounded"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                This Month
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Download</a>
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Export</a>
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Import</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover table-centered">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Created at</th>
                                        <th>Customer</th>
                                        <th>Priority</th>
                                        <th>Total</th>
                                        <th>Payment Status</th>
                                        <th>Items</th>
                                        <th>Delivery Number</th>
                                        <th>Order Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td>
                                                {{ $order->order_number }}
                                            </td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="#!" class="link-primary fw-medium">{{ $order->first_name }}
                                                    {{ $order->last_name }}</a>
                                            </td>
                                            <td> Normal</td>
                                            <td> ${{ number_format($order->total_amount, 2) }}</td>
                                            <td>
                                                @if ($order->payment_status == 'paid')
                                                    <span class="badge bg-success text-light px-2 py-1 fs-13">Paid</span>
                                                @elseif($order->payment_status == 'refunded')
                                                    <span class="badge bg-light text-dark px-2 py-1 fs-13">Refunded</span>
                                                @else
                                                    <span class="badge bg-light text-dark px-2 py-1 fs-13">Unpaid</span>
                                                @endif
                                            </td>
                                            <td> {{ $order->items->count() }}</td>
                                            <td> {{ $order->delivery_number ?? '-' }}</td>
                                            <td>
                                                @if ($order->status == 'pending')
                                                    <span class="badge border border-warning text-warning px-2 py-1 fs-13">Pending</span>
                                                @elseif($order->status == 'paid')
                                                    <span class="badge border border-info text-info px-2 py-1 fs-13">Paid</span>
                                                @elseif($order->status == 'shipped')
                                                    <span class="badge border border-primary text-primary px-2 py-1 fs-13">Shipped</span>
                                                @elseif($order->status == 'completed')
                                                    <span class="badge border border-success text-success px-2 py-1 fs-13">Completed</span>
                                                @elseif($order->status == 'canceled')
                                                    <span class="badge border border-danger text-danger px-2 py-1 fs-13">Canceled</span>
                                                @elseif($order->status == 'refunded')
                                                    <span class="badge border border-purple text-purple px-2 py-1 fs-13">Refunded</span>
                                                @elseif($order->status == 'returned')
                                                    <span class="badge border border-orange text-orange px-2 py-1 fs-13">Returned</span>
                                                @else
                                                    <span class="badge border border-secondary text-secondary px-2 py-1 fs-13">{{ ucfirst($order->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                                        class="btn btn-light btn-sm">
                                                        <iconify-icon icon="solar:eye-broken" class="align-middle fs-18">
                                                        </iconify-icon>
                                                    </a>
                                                    <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                        class="btn btn-soft-primary btn-sm">
                                                        <iconify-icon icon="solar:pen-2-broken"
                                                            class="align-middle fs-18">
                                                        </iconify-icon>
                                                    </a>
                                                    <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-soft-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this order?')">
                                                            <iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                                                class="align-middle fs-18">
                                                            </iconify-icon>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">No orders found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                    <div class="card-footer border-top">
                        <div class="pagination justify-content-end mb-0">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- End Container Fluid -->
@endsection
