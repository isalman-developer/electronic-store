@extends('admin.layouts.app')

@section('title', 'Order Details')
@section('content')
    <div class="container-xxl">

        <div class="row">
            <div class="col-xl-9 col-lg-8">
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
                                                In Progress
                                            </span>
                                        </h4>
                                        <p class="mb-0">Order / Order Details / #{{ $order->order_number }} -
                                            {{ $order->created_at->format('M d, Y') }} at 6:23 pm
                                        </p>
                                    </div>
                                    <div>
                                        <a href="#!" class="btn btn-outline-secondary">Refund</a>
                                        <a href="#!" class="btn btn-outline-secondary">Return</a>
                                        <a href="#!" class="btn btn-primary">Edit Order</a>
                                    </div>

                                </div>

                                <div class="mt-4">
                                    <h4 class="fw-medium text-dark">Progress</h4>
                                </div>
                                <div class="row row-cols-xxl-5 row-cols-md-2 row-cols-1">
                                    <div class="col">
                                        <div class="progress mt-3" style="height: 10px;">
                                            <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-success"
                                                role="progressbar" style="width: 100%" aria-valuenow="70" aria-valuemin="0"
                                                aria-valuemax="70">
                                            </div>
                                        </div>
                                        <p class="mb-0 mt-2">Order Confirming</p>
                                    </div>
                                    <div class="col">
                                        <div class="progress mt-3" style="height: 10px;">
                                            <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-success"
                                                role="progressbar" style="width: 100%" aria-valuenow="70" aria-valuemin="0"
                                                aria-valuemax="70">
                                            </div>
                                        </div>
                                        <p class="mb-0 mt-2">Payment Pending</p>
                                    </div>
                                    <div class="col">
                                        <div class="progress mt-3" style="height: 10px;">
                                            <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-warning"
                                                role="progressbar" style="width: 60%" aria-valuenow="70" aria-valuemin="0"
                                                aria-valuemax="70">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2 mt-2">
                                            <p class="mb-0">Processing</p>
                                            <div class="spinner-border spinner-border-sm text-warning" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="progress mt-3" style="height: 10px;">
                                            <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-primary"
                                                role="progressbar" style="width: 0%" aria-valuenow="70" aria-valuemin="0"
                                                aria-valuemax="70">
                                            </div>
                                        </div>
                                        <p class="mb-0 mt-2">Shipping</p>
                                    </div>
                                    <div class="col">
                                        <div class="progress mt-3" style="height: 10px;">
                                            <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-primary"
                                                role="progressbar" style="width: 0%" aria-valuenow="70" aria-valuemin="0"
                                                aria-valuemax="70">
                                            </div>
                                        </div>
                                        <p class="mb-0 mt-2">Delivered</p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="card-footer d-flex flex-wrap align-items-center justify-content-between bg-light-subtle gap-2">
                                <p class="border rounded mb-0 px-2 py-1 bg-body"><i
                                        class="bx bx-arrow-from-left align-middle fs-16"></i> Estimated shipping date :
                                    <span
                                        class="text-dark fw-medium">{{ $order->created_at->addDays(7)->format('M d, Y') }}</span>
                                </p>
                                <div>
                                    <a href="#!" class="btn btn-primary">Make As Ready To Ship</a>
                                </div>
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
                                                                <img src="{{ getFirstImageUrl($item->product) }}"
                                                                    alt="" class="avatar-md">
                                                            </div>
                                                            <div>
                                                                <a href="#!"
                                                                    class="text-dark fw-medium fs-15">{{ $item->product->title }}</a>
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
                            <div class="card-header">
                                <h4 class="card-title">Order Timeline</h4>
                            </div>
                            <div class="card-body">
                                <div class="position-relative ms-2">
                                    <span class="position-absolute start-0  top-0 border border-dashed h-100"></span>
                                    <div class="position-relative ps-4">
                                        <div class="mb-4">
                                            <span
                                                class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle">
                                                <div class="spinner-border spinner-border-sm text-warning" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </span>
                                            <div
                                                class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                                <div>
                                                    <h5 class="mb-1 text-dark fw-medium fs-15">The packing has been started
                                                    </h5>
                                                    <p class="mb-0">Confirmed by Gaston Lapierre</p>
                                                </div>
                                                <p class="mb-0">April 23, 2024, 09:40 am</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative ps-4">
                                        <div class="mb-4">
                                            <span
                                                class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                                <i class="bx bx-check-circle"></i>
                                            </span>
                                            <div
                                                class="ms-2 d-flex flex-wrap gap-2  align-items-center justify-content-between">
                                                <div>
                                                    <h5 class="mb-1 text-dark fw-medium fs-15">The Invoice has been sent to
                                                        the customer</h5>
                                                    <p class="mb-2">Invoice email was sent to <a href="#!"
                                                            class="link-primary">hello@dundermuffilin.com</a></p>
                                                    <a href="#!" class="btn btn-light">Resend Invoice</a>
                                                </div>
                                                <p class="mb-0">April 23, 2024, 09:40 am</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative ps-4">
                                        <div class="mb-4">
                                            <span
                                                class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                                <i class="bx bx-check-circle"></i>
                                            </span>
                                            <div
                                                class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                                <div>
                                                    <h5 class="mb-1 text-dark fw-medium fs-15">The Invoice has been created
                                                    </h5>
                                                    <p class="mb-2">Invoice created by Gaston Lapierre</p>
                                                    <a href="#!" class="btn btn-primary">Download Invoice</a>
                                                </div>
                                                <p class="mb-0">April 23, 2024, 09:40 am</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative ps-4">
                                        <div class="mb-4">
                                            <span
                                                class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                                <i class="bx bx-check-circle"></i>
                                            </span>
                                            <div
                                                class="ms-2 d-flex flex-wrap gap-2 align-items-center justify-content-between">
                                                <div>
                                                    <h5 class="mb-1 text-dark fw-medium fs-15">Order Payment</h5>
                                                    <p class="mb-2">Using Master Card</p>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <p class="mb-1 text-dark fw-medium">Status :</p>
                                                        <span
                                                            class="badge bg-success-subtle text-success  px-2 py-1 fs-13">Paid</span>
                                                    </div>
                                                </div>
                                                <p class="mb-0">April 23, 2024, 09:40 am</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative ps-4">
                                        <div class="mb-2">
                                            <span
                                                class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                                <i class="bx bx-check-circle"></i>
                                            </span>
                                            <div
                                                class="ms-2 d-flex flex-wrap gap-2  align-items-center justify-content-between">
                                                <div>
                                                    <h5 class="mb-2 text-dark fw-medium fs-15">4 Order conform by Gaston
                                                        Lapierre</h5>
                                                    <a href="#!"
                                                        class="badge bg-light text-dark fw-normal  px-2 py-1 fs-13">Order
                                                        1</a>
                                                    <a href="#!"
                                                        class="badge bg-light text-dark fw-normal  px-2 py-1 fs-13">Order
                                                        2</a>
                                                    <a href="#!"
                                                        class="badge bg-light text-dark fw-normal  px-2 py-1 fs-13">Order
                                                        3</a>
                                                    <a href="#!"
                                                        class="badge bg-light text-dark fw-normal  px-2 py-1 fs-13">Order
                                                        4</a>
                                                </div>
                                                <p class="mb-0">April 23, 2024, 09:40 am</p>

                                            </div>
                                        </div>
                                    </div>
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
@endsection
