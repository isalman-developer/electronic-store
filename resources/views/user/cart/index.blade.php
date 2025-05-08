@extends('user.layouts.app')
@section('title', 'Cart')
@section('content')
    <!--Breadcrumb start-->
    <div class="container">
        <div class="row">
            <div class="col-12 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#!">Home</a></li>
                        <li class="breadcrumb-item"><a href="#!">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12">
                <!--Heading-->
                <div class="mb-4">
                    <h1 class="mb-0">Shopping Cart</h1>
                </div>
            </div>
        </div>
    </div>
    <!--Breadcrub end-->
    <!--Product shopping start-->
    <section class="pt-lg-4 pb-lg-8">
        <div class="container">
            <div class="row gx-lg-6 gy-4 gy-lg-0">
                <!--Shopping cart-->
                <div class="col-lg-8">
                    <div class="mb-4">
                        <span>Spend $61.00 more and get free shipping!</span>
                        <div class="progress mt-3" style="height: 4px">
                            <div class="progress-bar bg-danger" role="progressbar" aria-label="Basic example"
                                style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--Product table-->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="py-4 align-middle">
                                                <div class="d-flex align-items-start gap-4">
                                                    <a href="#!">
                                                        <img src="{{ asset('user/images/product/product-img-9.jpg') }}"
                                                            alt="product image" class="border" width="80" />
                                                    </a>

                                                    <div class="mb-2">
                                                        <h3 class="fs-6 mb-1 text-link">
                                                            <a href="#!">
                                                                Stylish Wooden Table Lamp
                                                            </a>
                                                        </h3>
                                                        <p class="mb-1">$78.00</p>
                                                        <p class="mb-2">Black</p>
                                                        <a href="#!" class="btn btn-danger btn-sm">Remove</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-inline-flex align-items-center border p-2">
                                                    <button
                                                        class="btn btn-icon btn-xs btn-focus-none quantity-btn minus fs-5">-</button>
                                                    <input type="number"
                                                        class="form-control quantity-input text-center mx-1 p-0 border-0"
                                                        value="1" min="1" style="width: 50px" />
                                                    <button
                                                        class="btn btn-icon btn-xs btn-focus-none quantity-btn plus fs-5">+</button>
                                                </div>
                                            </td>
                                            <td class="align-middle">$78.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 d-flex gap-3">
                        <a href="#!" class="text-link">Continue Shopping</a>
                        <a href="#!" class="text-link">Update Shopping Cart</a>
                    </div>
                    <div class="mt-6">
                        <h3 class="fs-6 d-flex align-items-center gap-2 mb-3">
                            <span>
                                @include('user.svgs.discount-svg')
                            </span>
                            <span>Apply Discount Code</span>
                        </h3>
                        <form class="row g-3">
                            <div class="col-lg-4 col-md-8 col-12">
                                <label for="discountCode" class="visually-hidden">Code</label>
                                <input type="text" class="form-control" id="discountCode" placeholder="" required />
                            </div>

                            <div class="col-lg-auto col-md-4 col-12">
                                <button type="submit" class="btn btn-primary">Apply Discount</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--Order summary-->
                <div class="col-lg-4">
                    <div class="card bg-light bg-opacity-25 mb-4">
                        <div class="card-header px-4 py-3">
                            <h3 class="fs-5 mb-0">Order Summary</h3>
                        </div>
                        <div class="card-body px-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span>Subtotal(1 item)</span>
                                <span class="text-dark fw-medium">$78</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span>Shipping</span>
                                <span class="">Free</span>
                            </div>
                            <div
                                class="d-flex align-items-center justify-content-between border-top pt-3 mb-2 fw-medium text-dark">
                                <span class="">Total:</span>
                                <span class="">$78.00 USD</span>
                            </div>
                            <small>Tax included and shipping calculated at checkout</small>
                            <div class="d-grid mt-4">
                                <button class="btn btn-primary">Proceed to Checkout</button>
                            </div>
                        </div>
                    </div>
                    <!--Payments cards-->
                    <div class="card mb-4">
                        <div class="card-body p-4">
                            <h3 class="fs-6 text-center mb-3">We accept payments</h3>
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                @include('user.svgs.credit-card-logos-svg')
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="alert alert-success">You are eligible for free shipping.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
