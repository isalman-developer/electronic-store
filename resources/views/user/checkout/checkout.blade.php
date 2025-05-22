@extends('user.layouts.app')

@section('title', 'Checkout')
@section('meta_description', 'Checkout page')

@section('content')
    <!--Breadcrumb start-->
    <div class="container">
        <div class="row">
            <div class="col-12 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#!">Home</a></li>
                        <li class="breadcrumb-item"><a href="#!">Shop</a></li>
                        <li class="breadcrumb-item"><a href="#!">Shopping Cart</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12">
                <!--Heading-->
                <div class="my-5">
                    <h1 class="mb-0">Checkout</h1>
                </div>
            </div>
        </div>
    </div>
    <!--Breadcrumb end-->
    <!--Shopping checkout start-->
    <section class="pt-lg-4 pb-lg-8">
        <div class="container">
            <div class="row gx-lg-6 gy-4 gy-lg-0">
                <!--Shopping checkout detail-->
                <div class="col-lg-8">
                    <div class="">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h2 class="fs-5">Delivery address</h2>
                            <a href="#!" class="text-link" data-bs-toggle="modal" data-bs-target="#addressModal">Add
                                address</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-lg-center flex-column flex-md-row gap-2">
                            <p class="mb-0 d-flex align-items-center gap-2">
                                @include('user.svgs.location-pin-svg')
                                4450 North Avenue Oakland, Nebraska, United States,
                            </p>
                            <a class="text-link" data-bs-toggle="offcanvas" href="#offcanvasChange"
                                aria-controls="offcanvasChange">Change address</a>
                        </div>
                        <div>
                            <div class="d-flex align-items-center mt-5 mb-2 justify-content-between">
                                <h3 class="fs-5">Contact</h3>
                                <a href="#!" class="text-link">Log in</a>
                            </div>
                            <form>
                                <div class="mb-3">
                                    <label for="email" class="visually-hidden"></label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Email or mobile phone number" required />

                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="emailOfferNews"
                                        required />
                                    <label class="form-check-label" for="emailOfferNews">Email me with news and
                                        offers</label>

                                </div>
                            </form>
                        </div>
                        <div>
                            <div class="mt-5 mb-4">
                                <h3 class="fs-5 mb-2">Payment</h3>
                                <p class="mb-0">All transactions are secure and encrypted.</p>
                            </div>
                            <div id="paymentMethod">
                                <div class="mb-2">
                                    <div class="bg-light p-3 d-flex flex-md-row flex-column justify-content-between align-items-lg-center gap-2 gap-md-0"
                                        data-bs-toggle="collapse" data-bs-target="#collapseCreditcard" aria-expanded="true"
                                        aria-controls="collapseCreditcard">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault1" checked />
                                            <label class="form-check-label" for="flexRadioDefault1">Credit card</label>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            @include('user.svgs.credit-card-logos-svg')
                                        </div>
                                    </div>
                                    <div class="collapse show px-4" id="collapseCreditcard" data-bs-parent="#paymentMethod">
                                        <div class="row g-2 mt-4 mb-5">
                                            <div class="col-12">
                                                <!-- input -->
                                                <div class="mb-3">
                                                    <label for="card-mask" class="form-label">Card Number</label>
                                                    <input type="text" class="form-control" id="card-mask"
                                                        placeholder="xxxx-xxxx-xxxx-xxxx" required="" />

                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <!-- input -->
                                                <div class="mb-3 mb-lg-0">
                                                    <label class="form-label" for="nameoncard">Name on card</label>
                                                    <input type="text" class="form-control" placeholder="Enter name"
                                                        id="nameoncard" required />

                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <!-- input -->
                                                <div class="mb-3 mb-lg-0 position-relative">
                                                    <label class="form-label" for="dy-mask">Expiry date</label>
                                                    <input type="text" class="form-control" id="dy-mask"
                                                        placeholder="MM/YY" required />

                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <!-- input -->
                                                <div class="mb-3 mb-lg-0">
                                                    <label for="digit-mask" class="form-label">
                                                        CVV Code
                                                        <i class="bi bi-question-circle ms-1" data-bs-toggle="tooltip"
                                                            data-placement="top"
                                                            aria-label="A 3 - digit number, typically printed on the back of a card."
                                                            data-bs-original-title="A 3 - digit number, typically printed on the back of a card."></i>
                                                    </label>
                                                    <input type="password" class="form-control" name="digit-mask"
                                                        id="digit-mask" placeholder="xxx" maxlength="3"
                                                        inputmode="numeric" required="" />

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <div class="bg-light p-3 d-flex justify-content-between align-items-center mt-2"
                                        data-bs-target="#collapseCash" aria-expanded="false"
                                        aria-controls="collapseCash">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioCash" />
                                            <label class="form-check-label" for="flexRadioCash">Case on Delivery</label>
                                        </div>
                                        <div>
                                            @include('user.svgs.cash-svg')
                                        </div>
                                    </div>
                                    <div class="collapse" id="collapseCash" data-bs-parent="#paymentMethod"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid mt-4">
                            <button class="btn btn-primary" type="submit">Place Your Order</button>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-4">
                        <div class="alert alert-success small">Congratulations 🎉 You are eligible for free shipping.
                        </div>
                    </div>
                    <!--Order summary-->
                    <div class="card bg-light bg-opacity-25 mb-4">
                        <div class="card-header px-4 py-3">
                            <h3 class="fs-5 mb-0">Order Summary</h3>
                        </div>
                        <div class="card-body px-4">
                            <div class="d-flex justify-content-between mb-4">
                                <div class="d-flex align-items-start gap-3 flex-wrap">
                                    <a href="#!">
                                        <img src="{{ asset('user/images/product/product-img-2.jpg') }}"
                                            alt="product image" class="border" width="60" />
                                    </a>

                                    <div class="mb-2">
                                        <h3 class="fs-6 mb-1 text-link">
                                            <a href="#!">
                                                Stylish Wooden Table Lamp
                                            </a>
                                        </h3>

                                        <p class="mb-2 text-dark">
                                            Black
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-dark">
                                        $78
                                    </span>
                                </div>
                            </div>
                            <div class="mb-2 border-top pt-3 mb-2">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span>Subtotal(1 item)</span>
                                    <span class="text-dark fw-medium">$78</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span>Shipping</span>
                                    <span class="">Free</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span>Total Saving</span>
                                    <span class="">$15</span>
                                </div>
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-between border-top pt-3 mb-2 fw-medium text-dark">
                                <span class="">Estimated total:</span>
                                <span class="">$78.00 USD</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
