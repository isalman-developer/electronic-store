@extends('admin.layouts.app')

@section('title', 'Order Details')

@push('page-style')
    <style>
        /* Modern Order Tracking Stepper */
        .order-tracking-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .order-stepper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            position: relative;
            margin: 2rem 0;
        }

        .order-stepper-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
            min-width: 100px;
        }

        .order-stepper-circle {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 2;
            position: relative;
        }

        .order-stepper-circle.completed {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            transform: scale(1.05);
        }

        .order-stepper-circle.active {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
        }

        .order-stepper-circle.pending {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        }

        .order-stepper-circle.canceled {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .order-stepper-label {
            margin-top: 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            text-align: center;
            color: #374151;
            line-height: 1.2;
        }

        .order-stepper-label.completed {
            color: #16a34a;
        }

        .order-stepper-label.active {
            color: #1d4ed8;
        }

        .order-stepper-label.canceled {
            color: #dc2626;
        }

        .order-stepper-bar {
            position: absolute;
            top: 28px;
            left: 0;
            right: 0;
            height: 4px;
            background: #e5e7eb;
            z-index: 1;
            border-radius: 2px;
        }

        .order-stepper-bar-fill {
            position: absolute;
            top: 28px;
            left: 0;
            height: 4px;
            background: linear-gradient(90deg, #22c55e 0%, #3b82f6 100%);
            z-index: 2;
            border-radius: 2px;
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Timeline Styles */
        .timeline-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .timeline-entry {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .timeline-entry:last-child {
            margin-bottom: 0;
        }

        .timeline-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: #fff;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .timeline-content {
            flex: 1;
            padding-top: 0.25rem;
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }

        .timeline-title {
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        .timeline-time {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .timeline-description {
            color: #4b5563;
            margin: 0;
            line-height: 1.5;
        }

        .timeline-user {
            font-size: 0.75rem;
            color: #9ca3af;
            margin-top: 0.25rem;
        }

        /* Status Transition Buttons */
        .status-transitions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .status-btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-btn-primary {
            background: #3b82f6;
            color: #fff;
        }

        .status-btn-primary:hover {
            background: #2563eb;
        }

        .status-btn-danger {
            background: #ef4444;
            color: #fff;
        }

        .status-btn-danger:hover {
            background: #dc2626;
        }

        .status-btn-warning {
            background: #f59e0b;
            color: #fff;
        }

        .status-btn-warning:hover {
            background: #d97706;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .order-stepper {
                flex-direction: column;
                gap: 1rem;
            }

            .order-stepper-step {
                flex-direction: row;
                align-items: center;
                text-align: left;
            }

            .order-stepper-circle {
                width: 40px;
                height: 40px;
                font-size: 1.25rem;
                margin-right: 1rem;
            }

            .order-stepper-label {
                margin-top: 0;
                font-size: 0.875rem;
            }

            .order-stepper-bar {
                display: none;
            }

            .status-transitions {
                flex-direction: column;
            }

            .status-btn {
                justify-content: center;
            }
        }

        /* Loading Animation */
        .loading-spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
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

                                            @if ($order->payment_status == 'pending')
                                                <span class="badge bg-light text-dark px-2 py-1 fs-13">
                                                    Unpaid
                                                </span>
                                            @elseif($order->payment_status == 'refunded')
                                                <span class="badge bg-light text-dark px-2 py-1 fs-13">
                                                    Refunded
                                                </span>
                                            @else
                                                <span class="badge bg-success text-light px-2 py-1 fs-13">
                                                    Paid
                                                </span>
                                            @endif

                                            <span class="border border-warning text-warning fs-13 px-2 py-1 rounded">
                                                {{ !in_array($order->status, ['completed','canceled', 'returned', 'refunded']) ? 'In Progress' : ucfirst($order->status) }}
                                            </span>

                                        </h4>
                                        <p class="mb-0">
                                            {{ $order->created_at->format('M d, Y') }} at
                                            {{ $order->created_at->format('h:i a') }}
                                        </p>
                                    </div>
                                    <div>

                                        {{-- Return Button --}}
                                        @if ($order->status == 'completed' && $order->payment_status == 'paid')
                                            <form action="{{ route('admin.orders.return', $order->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-orange"
                                                    style="background:#f97316;color:#fff;">Return</button>
                                            </form>
                                        @endif

                                        {{-- Refund Button --}}
                                        @if ($order->status === 'returned')
                                            <form action="{{ route('admin.orders.refund', $order->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-warning">Refund</button>
                                            </form>
                                        @endif

                                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-outline-secondary">
                                            Edit Order
                                        </a>
                                    </div>
                                </div>

                                <!-- Order Tracking Section -->
                                <div class="order-tracking-container">
                                    <h4 class="fw-medium text-dark mb-3">Order Tracking</h4>

                                    <div class="order-stepper">
                                        <div class="order-stepper-bar"></div>
                                        <div class="order-stepper-bar-fill"
                                            style="width: {{ $progressData['progress_percentage'] }}%"></div>

                                        @foreach ($progressData['statuses'] as $statusKey => $statusInfo)
                                            @php
                                                $stepIndex = array_search(
                                                    $statusKey,
                                                    array_keys($progressData['statuses']),
                                                );
                                                $isCompleted = $stepIndex < $progressData['current_index'];
                                                $isActive = $stepIndex === $progressData['current_index'];
                                            $isCanceled = $statusKey === 'canceled'; @endphp
                                            <div class="order-stepper-step" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="{{ $statusInfo['tooltip'] }}">
                                                <div
                                                    class="order-stepper-circle @if ($isCanceled) canceled @elseif($isActive) active @elseif($isCompleted) completed @else pending @endif">
                                                    <i class="{{ $statusInfo['icon'] }}"></i>
                                                </div>
                                                <div
                                                    class="order-stepper-label @if ($isCanceled) canceled @elseif($isActive) active @elseif($isCompleted) completed @endif">
                                                    {{ $statusInfo['label'] }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Status Transition Buttons -->
                                    @if (!empty($transitionButtons))
                                        <div class="status-transitions">
                                            @foreach ($transitionButtons as $button)
                                                <form action="{{ route('admin.orders.status.update', $order->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="{{ $button['status'] }}">
                                                    <input type="hidden" name="description"
                                                        value="{{ $button['label'] }}">
                                                    <button type="submit"
                                                        class="status-btn status-btn-{{ $button['color'] }}">
                                                        <i class="{{ $button['icon'] }}"></i>
                                                        {{ $button['label'] }}
                                                    </button>
                                                </form>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rest of the existing layout -->
            <div class="col-xl-9 col-lg-8">
                <!-- Shipping Information Card -->
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

                                @if ($order->status === 'shipped')
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

                        <!-- Products Card -->
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Products</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0 table-hover table-centered">
                                        <thead class="bg-light-subtle border-bottom">
                                            <tr>
                                                <th>Product Name & Size</th>
                                                <th>Status</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Tax</th>
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
                                                            class="badge bg-success-subtle text-success px-2 py-1 fs-13">Ready</span>
                                                    </td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>${{ number_format($item->price, 2) }}</td>
                                                    <td>${{ number_format($item->tax, 2) }}</td>
                                                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary Cards -->
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
                                                <p class="mb-0">{{ $order->first_name }} {{ $order->last_name }}</p>
                                            </div>
                                            <div
                                                class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                                <iconify-icon icon="solar:user-circle-bold-duotone"
                                                    class="fs-35 text-primary">
                                                </iconify-icon>
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

            <!-- Order Summary Sidebar -->
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
                                                <iconify-icon icon="solar:ticket-broken"
                                                    class="align-middle"></iconify-icon>
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
                                                    class="align-middle">
                                                </iconify-icon> Tax :
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
                            <p class="fw-bold text-dark mb-0 fs-16">
                                ${{ number_format(
                                    $order->total_amount ??
                                        $order->items->sum(function ($item) {
                                            return $item->price * $item->quantity + $item->tax;
                                        }) +
                                            ($order->shipping_fee ?? 0) -
                                            ($order->discount ?? 0),
                                    2,
                                ) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Timeline Entry Modal -->
    <!-- REMOVED: Timeline and Note modals, timeline UI, and related code -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            if (window.bootstrap) {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                    new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }
        });
    </script>
@endsection
