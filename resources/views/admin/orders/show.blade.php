@extends('admin.layouts.app')

@section('title', 'Order Details')

@push('page-style')
    <style>
        .order-stepper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            position: relative;
            margin: 2rem 0 2.5rem 0;
        }
        .order-stepper-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
            min-width: 80px;
        }
        .order-stepper-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #f3f4f6;
            border: 3px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #9ca3af;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            z-index: 2;
        }
        .order-stepper-circle.completed {
            background: #f3f4f6;
            border-color: #d1d5db;
            color: #6b7280;
            box-shadow: 0 2px 8px rgba(107,114,128,0.08);
        }
        .order-stepper-circle.active {
            background: linear-gradient(135deg, #2563eb 60%, #1d4ed8 100%);
            border-color: #2563eb;
            color: #fff;
            box-shadow: 0 4px 16px rgba(37,99,235,0.15);
            transform: scale(1.1);
        }
        .order-stepper-circle.canceled {
            background: linear-gradient(135deg, #ef4444 60%, #b91c1c 100%);
            border-color: #ef4444;
            color: #fff;
            box-shadow: 0 4px 16px rgba(239,68,68,0.15);
        }
        .order-stepper-label {
            margin-top: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
            color: #374151;
            text-align: center;
        }
        .order-stepper-label.completed {
            color: #6b7280;
        }
        .order-stepper-label.active {
            color: #2563eb;
        }
        .order-stepper-label.canceled {
            color: #ef4444;
        }
        .order-stepper-bar {
            position: absolute;
            top: 24px;
            left: 0;
            right: 0;
            height: 6px;
            background: #e5e7eb;
            z-index: 1;
        }
        .order-stepper-bar-fill {
            position: absolute;
            top: 24px;
            left: 0;
            height: 6px;
            background: linear-gradient(90deg, #22c55e 60%, #2563eb 100%);
            z-index: 2;
            border-radius: 3px;
            transition: width 0.4s cubic-bezier(.4,0,.2,1);
        }
        @media (max-width: 600px) {
            .order-stepper-label { font-size: 0.85rem; }
            .order-stepper-circle { width: 36px; height: 36px; font-size: 1.1rem; }
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl">
        <div class="row">
            <div class="col-xl-12 col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                    <div>
                                        <h4 class="fw-medium text-dark d-flex align-items-center gap-2">
                                            #{{ $order->order_number }}

                                            @if ($order->payment_status == 'paid')
                                                <span class="badge bg-success text-light px-2 py-1 fs-13">
                                                    Paid
                                                </span>
                                            @elseif($order->payment_status == 'refund')
                                                <span class="badge bg-light text-dark px-2 py-1 fs-13">
                                                    Refund
                                                </span>
                                            @else
                                                <span class="badge bg-light text-dark px-2 py-1 fs-13">
                                                    Unpaid
                                                </span>
                                            @endif

                                            <span class="border border-warning text-warning fs-13 px-2 py-1 rounded">
                                                {{ ucfirst($order->status) }}
                                            </span>

                                        </h4>
                                        <p class="mb-0">Order / Order Details / #{{ $order->order_number }} -
                                            {{ $order->created_at->format('M d, Y') }} at
                                            {{ $order->created_at->format('h:i a') }}
                                        </p>
                                    </div>
                                    <div>
                                        <a href="#!" class="btn btn-outline-secondary">
                                            Refund
                                        </a>
                                        <a href="#!" class="btn btn-outline-secondary">
                                            Return
                                        </a>
                                        <a href="#!" class="btn btn-primary">
                                            Edit Order
                                        </a>
                                    </div>

                                </div>

                                <div class="mt-4">
                                    <h4 class="fw-medium text-dark">Detail</h4>
                                    <p class="text-muted mb-4">
                                        @if (in_array($order->status, ['shipped', 'delivering']))
                                            Your items is on the way. Tracking information will be available within 24
                                            hours.
                                        @elseif($order->status === 'completed')
                                            Your order has been delivered.
                                        @elseif($order->status === 'canceled')
                                            Your order has been canceled.
                                        @else
                                            Your order is being processed. We'll update you when it ships.
                                        @endif
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <h4 class="fw-medium text-dark">Order Tracking</h4>
                                </div>
                                <div class="order-stepper">
                                    <div class="order-stepper-bar"></div>
                                    @php
                                        $allStatuses = [
                                            'pending' => ['title' => 'Order Pending', 'icon' => 'bx bx-receipt', 'tooltip' => 'Order placed, awaiting payment.'],
                                            'paid' => ['title' => 'Payment Confirmed', 'icon' => 'bx bx-credit-card', 'tooltip' => 'Payment received.'],
                                            'shipped' => ['title' => 'Shipped', 'icon' => 'bx bx-car', 'tooltip' => 'Order shipped to courier.'],
                                            'delivering' => ['title' => 'Out for Delivery', 'icon' => 'bx bx-truck', 'tooltip' => 'Courier is delivering your order.'],
                                            'completed' => ['title' => 'Delivered', 'icon' => 'bx bx-check-double', 'tooltip' => 'Order delivered successfully.'],
                                            'canceled' => ['title' => 'Canceled', 'icon' => 'bx bx-block', 'tooltip' => 'Order was canceled.'],
                                        ];
                                        $statusKeys = array_keys($allStatuses);
                                        $currentStatusIndex = array_search($order->status, $statusKeys);
                                        $currentStatusIndex = $currentStatusIndex !== false ? $currentStatusIndex : 0;
                                        $barFillPercent = min(100, ($currentStatusIndex / (count($allStatuses) - 1)) * 100);
                                    @endphp
                                    <div class="order-stepper-bar-fill" style="width: {{ $barFillPercent }}%"></div>
                                    @foreach ($allStatuses as $status => $info)
                                        @php
                                            $stepIndex = array_search($status, $statusKeys);
                                            $isCompleted = $stepIndex < $currentStatusIndex;
                                            $isActive = $stepIndex === $currentStatusIndex;
                                            $isCanceled = $status === 'canceled';
                                        @endphp
                                        <div class="order-stepper-step" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $info['tooltip'] }}">
                                            <div class="order-stepper-circle @if($isCanceled) canceled @elseif($isActive) active @elseif($isCompleted) completed @endif">
                                                <i class="{{ $info['icon'] }}"></i>
                                            </div>
                                            <div class="order-stepper-label @if($isCanceled) canceled @elseif($isActive) active @elseif($isCompleted) completed @endif">
                                                {{ $info['title'] }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        if (window.bootstrap) {
                                            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                                            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                                                new bootstrap.Tooltip(tooltipTriggerEl);
                                            });
                                        }
                                    });
                                </script>
                                <div
                                    class="card-footer d-flex flex-wrap align-items-center justify-content-between bg-light-subtle gap-2">
                                    <p class="border rounded mb-0 px-2 py-1 bg-body">
                                        <i class="bx bx-arrow-from-left align-middle fs-16"></i>
                                        Estimated shipping date :
                                        <span class="text-dark fw-medium">
                                            {{ $order->created_at->addDays(7)->format('M d, Y') }}
                                        </span>
                                    </p>
                                    <div>
                                        <form action="{{ route('admin.orders.status.update', $order->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @php
                                                $nextStatus = null;
                                                $buttonText = null;
                                                $description = null;

                                                switch ($order->status) {
                                                    case 'pending':
                                                        $nextStatus = 'paid';
                                                        $buttonText = 'Mark As Paid';
                                                        $description =
                                                            'Payment received for order #' . $order->order_number;
                                                        break;
                                                    case 'paid':
                                                        $nextStatus = 'shippied';
                                                        $buttonText = 'Mark As Shipped';
                                                        $description = 'Order has been shipped';
                                                        break;
                                                    case 'shipped':
                                                        $nextStatus = 'delivering';
                                                        $buttonText = 'Out For Delivery';
                                                        $description = 'Order is out for delivery';
                                                        break;
                                                    case 'delivering':
                                                        $nextStatus = 'completed';
                                                        $buttonText = 'Mark As Delivered';
                                                        $description = 'Order has been delivered successfully';
                                                        break;
                                                }
                                            @endphp

                                            @if ($nextStatus)
                                                <input type="hidden" name="status" value="{{ $nextStatus }}">
                                                <input type="hidden" name="description" value="{{ $description }}">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ $buttonText }}
                                                </button>
                                            @endif
                                        </form>

                                        @if ($order->status != 'canceled' && $order->status != 'completed')
                                            <form action="{{ route('admin.orders.status.update', $order->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="canceled">
                                                <input type="hidden" name="description" value="Order has been canceled">
                                                <button type="submit" class="btn btn-outline-danger ms-2">
                                                    Cancel Order
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4 class="card-title">Shipping Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label text-muted">Shipping Method</label>
                                            <p class="mb-0 fw-medium">
                                                {{ $order->shipping_method ?? 'Standard Shipping' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label text-muted">Courier</label>
                                            <p class="mb-0 fw-medium">{{ $order->courier ?? 'Not assigned yet' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label text-muted">Tracking Number</label>
                                            <p class="mb-0 fw-medium">{{ $order->tracking_number ?? 'Not available' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label text-muted">Estimated Delivery</label>
                                            <p class="mb-0 fw-medium">
                                                {{ $order->created_at->addDays(7)->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                </div>

                                @if ($order->status === 'shipped' || $order->status === 'delivering')
                                    <div class="mt-3">
                                        <form action="{{ route('admin.orders.tracking.update', $order->id) }}"
                                            method="POST" class="row g-3">
                                            @csrf
                                            <div class="col-md-4">
                                                <label for="courier" class="form-label">Courier</label>
                                                <input type="text" class="form-control" id="courier" name="courier"
                                                    value="{{ $order->courier ?? '' }}" placeholder="Enter courier name">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="tracking_number" class="form-label">Tracking
                                                    Number</label>
                                                <input type="text" class="form-control" id="tracking_number"
                                                    name="tracking_number" value="{{ $order->tracking_number ?? '' }}"
                                                    placeholder="Enter tracking number">
                                            </div>
                                            <div class="col-md-4 d-flex align-items-end">
                                                <button type="submit" class="btn btn-primary">Update Shipping
                                                    Info</button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Product</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0 table-hover table-centered">
                                        <thead class="bg-light-subtle border-bottom">
                                            <tr>
                                                <th>Product Name &amp; Size</th>
                                                <th>Status</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Text</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->items as $item)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div
                                                                class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                {{-- <img src="{{ getFirstImageUrl($item->product) }}" alt=""
                                                            class="avatar-md"> --}}
                                                            </div>
                                                            <div>
                                                                <a href="#!"
                                                                    class="text-dark fw-medium fs-15">{{ $item->product->title ?? '' }}</a>
                                                                <p class="text-muted mb-0 mt-1 fs-13"><span>Size :
                                                                    </span>{{ $item->size }}</p>
                                                            </div>
                                                        </div>

                                                    </td>

                                                    <td>
                                                        <span
                                                            class="badge bg-success-subtle text-success  px-2 py-1 fs-13">Ready</span>
                                                    </td>
                                                    <td> {{ $item->quantity }}</td>
                                                    <td> ${{ number_format($item->price, 2) }}</td>
                                                    <td> ${{ number_format($item->tax, 2) }}</td>
                                                    <td>
                                                        ${{ number_format($item->price * $item->quantity, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Order Timeline</h4>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addTimelineModal">
                                    <i class="bx bx-plus me-1"></i> Add Entry
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="position-relative ms-2">
                                    <span class="position-absolute start-0 top-0 border border-dashed h-100"></span>

                                    @forelse($order->timelines->sortByDesc('created_at') as $timeline)
                                        <div class="position-relative ps-4">
                                            <div class="mb-4">
                                                <span
                                                    class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle">
                                                    @if ($timeline->status === 'processing')
                                                        <div class="spinner-border spinner-border-sm text-warning"
                                                            role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                    @else
                                                        <i
                                                            class="{{ $timeline->icon }} {{ $timeline->icon_class }} fs-20"></i>
                                                    @endif
                                                </span>
                                                <div
                                                    class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                                    <div>
                                                        <h5 class="mb-1 text-dark fw-medium fs-15">
                                                            {{ $timeline->title }}
                                                        </h5>
                                                        @if ($timeline->description)
                                                            <p class="mb-2">{!! $timeline->description !!}</p>
                                                        @endif

                                                        @if ($timeline->status)
                                                            <div class="d-flex align-items-center gap-2 mt-2">
                                                                @if (in_array($timeline->status, ['paid', 'completed']))
                                                                    <span
                                                                        class="badge bg-success-subtle text-success px-2 py-1 fs-13">
                                                                        {{ ucfirst($timeline->status) }}
                                                                    </span>
                                                                @elseif(in_array($timeline->status, ['canceled', 'refunded']))
                                                                    <span
                                                                        class="badge bg-danger-subtle text-danger px-2 py-1 fs-13">
                                                                        {{ ucfirst($timeline->status) }}
                                                                    </span>
                                                                @elseif(in_array($timeline->status, ['processing', 'packaging']))
                                                                    <span
                                                                        class="badge bg-warning-subtle text-warning px-2 py-1 fs-13">
                                                                        {{ ucfirst($timeline->status) }}
                                                                    </span>
                                                                @else
                                                                    <span
                                                                        class="badge bg-primary-subtle text-primary px-2 py-1 fs-13">
                                                                        {{ ucfirst($timeline->status) }}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <p class="mb-0">
                                                        {{ $timeline->created_at->format('F d, Y, h:i a') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center py-4">
                                            <p class="mb-0">No timeline entries found</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="card bg-light-subtle">
                            <div class="card-body">
                                <div class="row g-3 g-lg-0">
                                    <div class="col-lg-3 border-end">
                                        <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                            <div>
                                                <p class="text-dark fw-medium fs-16 mb-1">Vendor</p>
                                                <p class="mb-0">{{ $order->vendor->name ?? 'Direct Sale' }}</p>
                                            </div>
                                            <div
                                                class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                                <iconify-icon icon="solar:shop-2-bold-duotone" class="fs-35 text-primary">
                                                </iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 border-end">
                                        <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                            <div>
                                                <p class="text-dark fw-medium fs-16 mb-1">Date</p>
                                                <p class="mb-0">{{ $order->created_at->format('F d, Y') }}</p>
                                            </div>
                                            <div
                                                class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                                <iconify-icon icon="solar:calendar-date-bold-duotone"
                                                    class="fs-35 text-primary"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 border-end">
                                        <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                            <div>
                                                <p class="text-dark fw-medium fs-16 mb-1">Paid By</p>
                                                <p class="mb-0">{{ $order->first_name }} {{ $order->last_name }}
                                                </p>
                                            </div>
                                            <div
                                                class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                                <iconify-icon icon="solar:user-circle-bold-duotone"
                                                    class="fs-35 text-primary"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                            <div>
                                                <p class="text-dark fw-medium fs-16 mb-1">Reference #</p>
                                                <p class="mb-0">
                                                    {{ $order->reference_number ?? $order->order_number }}
                                                </p>
                                            </div>
                                            <div
                                                class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                                <iconify-icon icon="solar:clipboard-text-bold-duotone"
                                                    class="fs-35 text-primary"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Order Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td class="px-0">
                                            <p class="d-flex mb-0 align-items-center gap-1">
                                                <iconify-icon icon="solar:clipboard-text-broken"></iconify-icon> Sub Total
                                                :
                                            </p>
                                        </td>
                                        <td class="text-end text-dark fw-medium px-0">
                                            ${{ number_format(
                                                $order->items->sum(function ($item) {
                                                    return $item->price * $item->quantity;
                                                }),
                                                2,
                                            ) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">
                                            <p class="d-flex mb-0 align-items-center gap-1">
                                                <iconify-icon icon="solar:ticket-broken" class="align-middle">
                                                </iconify-icon>
                                                Discount :
                                            </p>
                                        </td>
                                        <td class="text-end text-dark fw-medium px-0">
                                            -${{ number_format($order->discount ?? 0, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">
                                            <p class="d-flex mb-0 align-items-center gap-1">
                                                <iconify-icon icon="solar:kick-scooter-broken" class="align-middle">
                                                </iconify-icon>
                                                Delivery Charge :
                                            </p>
                                        </td>
                                        <td class="text-end text-dark fw-medium px-0">
                                            ${{ number_format($order->shipping_fee ?? 0, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">
                                            <p class="d-flex mb-0 align-items-center gap-1">
                                                <iconify-icon icon="solar:calculator-minimalistic-broken"
                                                    class="align-middle"></iconify-icon> Tax :
                                            </p>
                                        </td>
                                        <td class="text-end text-dark fw-medium px-0">
                                            ${{ number_format($order->items->sum('tax'), 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between bg-light-subtle">
                        <div>
                            <p class="fw-medium text-dark mb-0">Total Amount</p>
                        </div>
                        <div>
                            <p class="fw-medium text-dark mb-0">${{ number_format($order->total_amount, 2) }}</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Payment Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-3 bg-light avatar d-flex align-items-center justify-content-center">
                                @if ($order->payment_method == 'credit_card')
                                    <img src="{{ asset('assets/images/card/mastercard.svg') }}" alt="Payment Method"
                                        class="avatar-sm">
                                @elseif($order->payment_method == 'paypal')
                                    <img src="{{ asset('assets/images/card/paypal.svg') }}" alt="Payment Method"
                                        class="avatar-sm">
                                @else
                                    <iconify-icon icon="solar:wallet-money-broken"
                                        class="fs-32 text-primary"></iconify-icon>
                                @endif
                            </div>
                            <div>
                                <p class="mb-1 text-dark fw-medium">
                                    @if ($order->payment_method == 'credit_card')
                                        Credit Card
                                    @elseif($order->payment_method == 'paypal')
                                        PayPal
                                    @else
                                        Cash on Delivery
                                    @endif
                                </p>
                                @if ($order->payment_method == 'credit_card' && isset($order->card_last4))
                                    <p class="mb-0 text-dark">xxxx xxxx xxxx {{ $order->card_last4 }}</p>
                                @endif
                            </div>
                            <div class="ms-auto">
                                @if ($order->payment_status == 'paid')
                                    <iconify-icon icon="solar:check-circle-broken"
                                        class="fs-22 text-success"></iconify-icon>
                                @elseif($order->payment_status == 'refund')
                                    <iconify-icon icon="solar:refresh-circle-broken"
                                        class="fs-22 text-warning"></iconify-icon>
                                @else
                                    <iconify-icon icon="solar:clock-circle-broken"
                                        class="fs-22 text-primary"></iconify-icon>
                                @endif
                            </div>
                        </div>
                        @if (isset($order->transaction_id))
                            <p class="text-dark mb-1 fw-medium">Transaction ID : <span class="text-muted fw-normal fs-13">
                                    {{ $order->transaction_id }}</span></p>
                        @endif
                        <p class="text-dark mb-0 fw-medium">Payment Status :
                            <span class="text-muted fw-normal fs-13">
                                @if ($order->payment_status == 'paid')
                                    <span class="badge bg-success text-light px-2 py-1 fs-13">Paid</span>
                                @elseif($order->payment_status == 'refund')
                                    <span class="badge bg-warning text-dark px-2 py-1 fs-13">Refunded</span>
                                @else
                                    <span class="badge bg-light text-dark px-2 py-1 fs-13">Pending</span>
                                @endif
                            </span>
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Customer Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2">
                            @if ($order->user && $order->user->profile_image)
                                <img src="{{ asset('storage/' . $order->user->profile_image) }}"
                                    alt="{{ $order->first_name }}" class="avatar rounded-3 border border-light border-3">
                            @else
                                <div
                                    class="avatar rounded-3 border border-light border-3 bg-primary text-white d-flex align-items-center justify-content-center">
                                    {{ strtoupper(substr($order->first_name, 0, 1)) }}{{ strtoupper(substr($order->last_name, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <p class="mb-1">{{ $order->first_name }} {{ $order->last_name }}</p>
                                <a href="mailto:{{ $order->email }}"
                                    class="link-primary fw-medium">{{ $order->email }}</a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <h5 class="">Contact Number</h5>
                            <div>
                                <a href="{{ route('admin.orders.edit', $order->id) }}"><i
                                        class="bx bx-edit-alt fs-18"></i></a>
                            </div>
                        </div>
                        <p class="mb-1">{{ $order->phone }}</p>

                        <div class="d-flex justify-content-between mt-3">
                            <h5 class="">Shipping Address</h5>
                            <div>
                                <a href="{{ route('admin.orders.edit', $order->id) }}"><i
                                        class="bx bx-edit-alt fs-18"></i></a>
                            </div>
                        </div>

                        <div>
                            @if ($order->shipping_address)
                                <p class="mb-1">{{ $order->shipping_address }}</p>
                                <p class="mb-1">{{ $order->city }}, {{ $order->state }} {{ $order->zip }}</p>
                                <p class="mb-1">{{ $order->country }}</p>
                                <p class="">{{ $order->phone }}</p>
                            @else
                                <p class="mb-1">No shipping address provided</p>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <h5 class="">Billing Address</h5>
                            <div>
                                <a href="{{ route('admin.orders.edit', $order->id) }}"><i
                                        class="bx bx-edit-alt fs-18"></i></a>
                            </div>
                        </div>

                        <p class="mb-1">
                            @if (isset($order->billing_address) && $order->billing_address != $order->shipping_address)
                                {{ $order->billing_address }}<br>
                                {{ $order->billing_city }}, {{ $order->billing_state }} {{ $order->billing_zip }}<br>
                                {{ $order->billing_country }}
                            @else
                                Same as shipping address
                            @endif
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mapouter">
                            <div class="gmap_canvas"><iframe class="gmap_iframe rounded" width="100%"
                                    style="height: 418px;" frameborder="0" scrolling="no" marginheight="0"
                                    marginwidth="0"
                                    src="https://maps.google.com/maps?width=1980&amp;height=400&amp;hl=en&amp;q=University%20of%20Oxford&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Timeline Entry Modal -->
    <div class="modal fade" id="addTimelineModal" tabindex="-1" aria-labelledby="addTimelineModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.orders.timeline.add', $order->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTimelineModalLabel">Add Timeline Entry</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="pending">Order Pending</option>
                                <option value="paid">Payment Confirmed</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Out for Delivery</option>
                                <option value="completed">Delivered</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Entry</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
