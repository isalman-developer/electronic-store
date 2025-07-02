@extends('admin.layouts.app')

@section('title', 'Order Details')
@section('content')
    <style>
        /* Minimal custom CSS to supplement Bootstrap */
        .order-tracking-container {
            padding: 20px 0;
        }

        /* Make the progress steps responsive */
        @media (max-width: 768px) {
            .order-tracking-container .d-flex {
                flex-wrap: wrap;
            }

            .order-tracking-container .text-center {
                width: 50% !important;
                margin-bottom: 20px;
            }
        }
    </style>
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
                                                <span class="badge bg-success text-light px-2 py-1 fs-13">Paid</span>
                                            @elseif($order->payment_status == 'refund')
                                                <span class="badge bg-light text-dark px-2 py-1 fs-13">Refund</span>
                                            @else
                                                <span class="badge bg-light text-dark px-2 py-1 fs-13">Unpaid</span>
                                            @endif

                                            <span class="border border-warning text-warning fs-13 px-2 py-1 rounded">
                                                {{ ucfirst($order->status) }}
                                            </span>

                                        </h4>
                                        <p class="mb-0">Order / Order Details / #{{ $order->order_number }} -
                                            {{ $order->created_at->format('M d, Y') }} at {{ $order->created_at->format('h:i a') }}
                                        </p>
                                    </div>
                                    <div>
                                        <a href="#!" class="btn btn-outline-secondary">Refund</a>
                                        <a href="#!" class="btn btn-outline-secondary">Return</a>
                                        <a href="#!" class="btn btn-primary">Edit Order</a>
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

                                <div class="order-tracking-container my-4">
                                    @php
                                        $statuses = [
                                            [
                                                'key' => 'pending',
                                                'label' => 'Receiving orders',
                                                'icon' => 'bx bx-check',
                                            ],
                                            [
                                                'key' => 'processing',
                                                'label' => 'Order processing',
                                                'icon' => 'bx bx-check',
                                            ],
                                            [
                                                'key' => 'delivering',
                                                'label' => 'Being delivered',
                                                'icon' => 'bx bx-check',
                                            ],
                                            [
                                                'key' => 'completed',
                                                'label' => 'Delivered',
                                                'icon' => 'bx bx-check',
                                            ],
                                        ];

                                        // Find the current status index
                                        $currentIndex = 0;
                                        foreach ($statuses as $index => $status) {
                                            if ($order->status === 'pending' && $index === 0) {
                                                $currentIndex = 0;
                                                break;
                                            } elseif (
                                                ($order->status === 'paid' ||
                                                    $order->status === 'packaging' ||
                                                    $order->status === 'ready_to_ship') &&
                                                $index === 1
                                            ) {
                                                $currentIndex = 1;
                                                break;
                                            } elseif (
                                                ($order->status === 'shipped' || $order->status === 'delivering') &&
                                                $index === 2
                                            ) {
                                                $currentIndex = 2;
                                                break;
                                            } elseif ($order->status === 'completed' && $index === 3) {
                                                $currentIndex = 3;
                                                break;
                                            }
                                        }
                                    @endphp

                                    <div class="position-relative mt-5 mb-4">
                                        <!-- Progress bar -->
                                        <div class="progress" style="height: 3px;">
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                style="width: {{ min(100, ($currentIndex / (count($statuses) - 1)) * 100) }}%;"
                                                aria-valuenow="{{ min(100, ($currentIndex / (count($statuses) - 1)) * 100) }}"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                        <!-- Status points -->
                                        <div class="row position-relative" style="margin-top: -20px;">
                                            @foreach ($statuses as $index => $status)
                                                @php
                                                    $isActive =
                                                        $index <= $currentIndex && $order->status !== 'canceled';
                                                    $isCurrent = $index === $currentIndex;

                                                    // Get timestamp for this status from order timeline
                                                    $timestamp = null;
                                                    foreach ($order->timelines as $timeline) {
                                                        if (
                                                            ($status['key'] === 'pending' &&
                                                                $timeline->status === 'pending') ||
                                                            ($status['key'] === 'processing' &&
                                                                in_array($timeline->status, [
                                                                    'processing',
                                                                    'packaging',
                                                                    'ready_to_ship',
                                                                ])) ||
                                                            ($status['key'] === 'delivering' &&
                                                                in_array($timeline->status, [
                                                                    'shipped',
                                                                    'delivering',
                                                                ])) ||
                                                            ($status['key'] === 'completed' &&
                                                                $timeline->status === 'completed')
                                                        ) {
                                                            $timestamp = $timeline->created_at;
                                                            break;
                                                        }
                                                    }

                                                    // Default timestamp if not found in timeline
                                                    if (!$timestamp && $isActive) {
                                                        $timestamp =
                                                            $index === 0 ? $order->created_at : $order->updated_at;
                                                    }

                                                    $statusLabel = $status['label'];
                                                    $statusTime = $timestamp ? $timestamp->format('h:i A') : 'Pending';
                                                @endphp

                                                <div class="col-3 text-center">
                                                    <div class="rounded-circle {{ $isActive ? 'bg-primary' : 'bg-light' }} d-flex align-items-center justify-content-center mx-auto"
                                                        style="width: 40px; height: 40px;">
                                                        @if ($isActive)
                                                            <i class="{{ $status['icon'] }} text-white"></i>
                                                        @endif
                                                    </div>
                                                    <div class="mt-2 fw-medium small">{{ $statusLabel }}</div>
                                                    <div class="small text-muted">{{ $statusTime }}</div>
                                                    <div class="small text-muted">
                                                        {{ $isCurrent ? 'Processing' : ($isActive ? '' : 'Pending') }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                    $description = 'Order marked as paid.';
                                                    break;
                                                case 'paid':
                                                    $nextStatus = 'processing';
                                                    $buttonText = 'Mark As Processing';
                                                    $description = 'Order is now processing.';
                                                    break;
                                                case 'processing':
                                                    $nextStatus = 'packaging';
                                                    $buttonText = 'Mark As Ready To Pack';
                                                    $description = 'Order is ready to be packed.';
                                                    break;
                                                case 'packaging':
                                                    $nextStatus = 'ready_to_ship';
                                                    $buttonText = 'Mark As Ready To Ship';
                                                    $description = 'Order is ready to ship.';
                                                    break;
                                                case 'ready_to_ship':
                                                    $nextStatus = 'shipped';
                                                    $buttonText = 'Mark As Shipped';
                                                    $description = 'Order has been shipped.';
                                                    break;
                                                case 'shipped':
                                                    $nextStatus = 'delivering';
                                                    $buttonText = 'Mark As Ready To Deliver';
                                                    $description = 'Order is out for delivery.';
                                                    break;
                                                case 'delivering':
                                                    $nextStatus = 'completed';
                                                    $buttonText = 'Mark As Completed';
                                                    $description = 'Order has been completed.';
                                                    break;
                                                case 'completed':
                                                    $nextStatus = 'canceled';
                                                    $buttonText = 'Cancel The Order';
                                                    $description = 'Order has been canceled.';
                                                    break;
                                            }
                                        @endphp
                                        @if ($nextStatus && $buttonText)
                                            <input type="hidden" name="status" value="{{ $nextStatus }}">
                                            <input type="hidden" name="description" value="{{ $description }}">
                                            <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
                                        @endif
                                    </form>
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
                                            <p class="mb-0 fw-medium">{{ $order->shipping_method ?? 'Standard Shipping' }}
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
                                            <p class="mb-0 fw-medium">{{ $order->tracking_number ?? 'Not available' }}</p>
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
                                                <label for="tracking_number" class="form-label">Tracking Number</label>
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
                                                                {{-- <img src="{{ getFirstImageUrl($item->product) }}"
                                                                    alt="" class="avatar-md"> --}}
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

                                    @forelse($order->timelines as $timeline)
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
                                                            class="{{ $timeline->icon ?? 'bx bx-check-circle' }} {{ $timeline->icon_class ?? 'text-success' }} fs-20"></i>
                                                    @endif
                                                </span>
                                                <div
                                                    class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                                    <div>
                                                        <h5 class="mb-1 text-dark fw-medium fs-15">{{ $timeline->title }}
                                                        </h5>
                                                        @if ($timeline->description)
                                                            <p class="mb-2">{!! $timeline->description !!}</p>
                                                        @endif

                                                        @if ($timeline->status === 'invoice_created')
                                                            <a href="{{ route('admin.orders.invoice.download', $order->id) }}"
                                                                class="btn btn-primary">Download Invoice</a>
                                                        @elseif($timeline->status === 'invoice_sent')
                                                            <a href="#" class="btn btn-light resend-invoice"
                                                                data-order-id="{{ $order->id }}">Resend Invoice</a>
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
                                                    <p class="mb-0">{{ $timeline->created_at->format('F d, Y, h:i a') }}
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
                                                <iconify-icon icon="solar:shop-2-bold-duotone"
                                                    class="fs-35 text-primary"></iconify-icon>
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
                                                <p class="mb-0">{{ $order->first_name }} {{ $order->last_name }}</p>
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
                                                <p class="mb-0">{{ $order->reference_number ?? $order->order_number }}
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
                                            <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon
                                                    icon="solar:clipboard-text-broken"></iconify-icon> Sub Total : </p>
                                        </td>
                                        <td class="text-end text-dark fw-medium px-0">
                                            ${{ number_format($order->items->sum(function ($item) {return $item->price * $item->quantity;}),2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">
                                            <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon
                                                    icon="solar:ticket-broken" class="align-middle"></iconify-icon>
                                                Discount : </p>
                                        </td>
                                        <td class="text-end text-dark fw-medium px-0">
                                            -${{ number_format($order->discount ?? 0, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">
                                            <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon
                                                    icon="solar:kick-scooter-broken" class="align-middle"></iconify-icon>
                                                Delivery Charge : </p>
                                        </td>
                                        <td class="text-end text-dark fw-medium px-0">
                                            ${{ number_format($order->shipping_fee ?? 0, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">
                                            <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon
                                                    icon="solar:calculator-minimalistic-broken"
                                                    class="align-middle"></iconify-icon> Tax : </p>
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
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status (Optional)</label>
                            <input type="text" class="form-control" id="status" name="status">
                            <small class="text-muted">E.g., processing, completed, etc.</small>
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

@push('page-script-bottom')
@endpush
