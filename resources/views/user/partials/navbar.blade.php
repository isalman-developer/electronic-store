<nav class="navbar navbar-expand-xl sticky-top bg-white  w-100 border-bottom">
    <div class="container">
        <div class="d-flex justify-content-between w-100 align-items-center">
            <div class="d-flex align-items-center w-100 w-md-auto">
                <button class="navbar-toggler offcanvas-nav-btn" type="button">
                    <i class="bi bi-list"></i>
                </button>
                <a class="navbar-brand mx-auto mx-xxl-0 ms-4" href="/">
                    <img src="{{ asset('user/images/logo/logo.svg') }}" alt="" />
                </a>
            </div>
            <div class="">
                <div class="offcanvas offcanvas-bottom offcanvas-nav" style="height: 60vh">
                    <div class="offcanvas-header position-absolute top-0 start-50 translate-middle mt-n5">
                        <button type="button" class="btn-close bg-white opacity-100" data-bs-dismiss="offcanvas"
                            aria-label="Close">
                        </button>
                    </div>
                    <div class="offcanvas-body pt-xl-0 align-items-center">
                        <ul class="navbar-nav mb-2 mb-lg-0 ">
                            <li class="nav-item dropdown border-bottom border-bottom-xl-0">
                                <a class="nav-link dropdown-toggle" href="#!" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Shop
                                </a>
                                <div class="dropdown-menu dropdown-menu-xxl p-xl-4">
                                    <div class="row row-cols-lg-2 row-cols-1">
                                        <div class="col">
                                            <div class="dropdown-header">Categories</div>
                                            <ul class="list-unstyled d-inline-flex flex-column nav lh-lg">
                                                @foreach (getCategories() as $category)
                                                    <li class="nav-item">
                                                        <a href="{{ route('product.category', $category->slug) }}"
                                                            class="nav-link text-link d-inline px-0">
                                                            {{ $category->title }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col">
                                            <div class="dropdown-header">Brands</div>
                                            <ul class="list-unstyled d-inline-flex flex-column nav lh-lg">
                                                @foreach (getBrands() as $brand)
                                                    <li class="nav-item">
                                                        <a class="nav-link text-link d-inline px-0"
                                                            href="{{ route('product.brand', $brand->slug) }}">
                                                            {{ $brand->title }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </li>

                            <li class="nav-item dropdown w-100 w-lg-auto border-bottom border-bottom-xl-0">
                                <a class="nav-link dropdown-toggle" href="#!" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Find Products</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('product.featured') }}">Featured Products</a>
                                        <a class="dropdown-item" href="{{ route('product.new-arrivals') }}">New Arrivals</a>
                                        <a class="dropdown-item" href="{{ route('product.top-rated') }}">Top Rated Products</a>
                                        <a class="dropdown-item" href="{{ route('product.index', ['price' => '0-10000']) }}">Under 10,000 PKR</a>
                                        <a class="dropdown-item" href="{{ route('product.index') }}">All Products</a>
                                    </li>
                                </ul>
                            </li>


                            <li class="nav-item dropdown w-100 w-lg-auto border-bottom border-bottom-xl-0">
                                <a class="nav-link dropdown-toggle" href="#!" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Offers</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('product.featured', 'featured') }}">Flash Sale</a>
                                        <a class="dropdown-item" href="{{ route('product.new-arrivals', 'new-arrivals') }}">Season Sale</a>
                                    </li>
                                </ul>
                            </li>
                            {{-- <li
                                class="nav-item dropdown w-100 w-lg-auto dropdown-fullwidth border-bottom border-bottom-xl-0">
                                <a class="nav-link dropdown-toggle" href="#!" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Offers</a>
                                <div class="dropdown-menu pb-0">
                                    <div class="row p-2 p-xl-4">

                                        <div class="col-lg-3 col-12 mb-4 mb-lg-0">
                                            <div
                                                class="h-100 position-relative d-flex flex-column bg-light justify-content-center align-items-center">
                                                <img src="{{ asset('user/images/jpg/menu-benner.jpg') }}"
                                                    alt="eCommerce HTML Template" class="img-fluid" />
                                                <div class="position-absolute top-0 text-center pt-5">
                                                    <h3 class="fw-bold">Modern Furniture</h3>
                                                    <span>New Collection</span>
                                                </div>
                                                <div
                                                    class="position-absolute bottom-0 text-center pb-3 start-50 translate-middle">
                                                    <a href="product-list.html" class="btn btn-primary btn-sm">Shop
                                                        Now</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </li> --}}

                            <li class="nav-item dropdown w-100 w-lg-auto border-bottom border-bottom-xl-0">
                                <a class="nav-link dropdown-toggle" href="#!" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">More</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="blog.html">Blog</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="blog-single.html">Blog Single</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="blog-category.html">Blog Category</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="about.html">About us</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="faq.html">FAQ</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="product-reviews.html">Review</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="404error.html">404 Error</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="contact.html">Contact</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="terms-condition.html">Terms
                                            Conditions</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown border-bottom border-bottom-xl-0">
                                <a class="nav-link dropdown-toggle" href="#!" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-submenu dropend">
                                        <a class="dropdown-item dropdown-list-group-item dropdown-toggle"
                                            href="#!">Auth</a>
                                        <ul class=" dropdown-menu  px-1 pb-4 pt-0 p-xl-3">
                                            <li><a class="dropdown-item" href="signin.html">Sign In</a></li>
                                            <li><a class="dropdown-item" href="signup.html">Sign Up</a></li>

                                            <li><a class="dropdown-item" href="forgot-password.html">Forgot
                                                    Password</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="account-order.html">Order History</a>
                                    </li>
                                    <li><a class="dropdown-item" href="account-wishlist.html">Wishlist</a>
                                    </li>
                                    <li><a class="dropdown-item" href="account-payment.html">Payment
                                            Method</a>
                                    </li>
                                    <li><a class="dropdown-item" href="account-reviews.html">My Reviews</a>
                                    </li>
                                    <li><a class="dropdown-item" href="account-personal-info.html">Personal
                                            Info</a>
                                    </li>
                                    <li><a class="dropdown-item" href="account-address.html">Address</a>
                                    </li>
                                    <li><a class="dropdown-item" href="account-notification.html">Notification</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        <div class="d-xl-none d-grid position-absolute bottom-0 w-100 start-0 end-0 p-4">
                            <a href="signin.html" class="btn btn-primary">Sign in</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center gap-4">
                <div class="d-flex align-items-center gap-3">
                    <a class="d-none d-md-block" data-bs-toggle="offcanvas" href="#offcanvasSearchProduct"
                        role="button" aria-controls="offcanvasSearchProduct">
                        <svg width="20" height="20" viewBox="0 0 25 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22.3111 20.2041L17.8589 15.75C19.1938 14.0104 19.817 11.8282 19.6022 9.64607C19.3873 7.4639 18.3504 5.44516 16.7019 3.99936C15.0533 2.55357 12.9165 1.78899 10.725 1.86071C8.53343 1.93244 6.45121 2.8351 4.90072 4.38559C3.35023 5.93608 2.44757 8.01829 2.37584 10.2098C2.30412 12.4014 3.0687 14.5382 4.51449 16.1867C5.96029 17.8353 7.97903 18.8722 10.1612 19.087C12.3434 19.3019 14.5256 18.6787 16.2651 17.3437L20.7211 21.8006C20.8257 21.9053 20.9499 21.9883 21.0867 22.0449C21.2234 22.1016 21.3699 22.1307 21.5179 22.1307C21.6659 22.1307 21.8125 22.1016 21.9492 22.0449C22.0859 21.9883 22.2102 21.9053 22.3148 21.8006C22.4195 21.696 22.5025 21.5717 22.5591 21.435C22.6157 21.2983 22.6449 21.1517 22.6449 21.0037C22.6449 20.8558 22.6157 20.7092 22.5591 20.5725C22.5025 20.4358 22.4195 20.3115 22.3148 20.2069L22.3111 20.2041ZM4.64013 10.5C4.64013 9.23914 5.01402 8.0066 5.71451 6.95824C6.41501 5.90988 7.41064 5.09278 8.57552 4.61027C9.7404 4.12776 11.0222 4.00151 12.2588 4.24749C13.4955 4.49347 14.6314 5.10063 15.5229 5.99219C16.4145 6.88375 17.0217 8.01967 17.2676 9.2563C17.5136 10.4929 17.3874 11.7747 16.9049 12.9396C16.4224 14.1045 15.6053 15.1001 14.5569 15.8006C13.5085 16.5011 12.276 16.875 11.0151 16.875C9.32491 16.8733 7.70441 16.2011 6.50924 15.0059C5.31408 13.8107 4.64187 12.1902 4.64013 10.5Z"
                                fill="#211F1C" />
                        </svg>
                    </a>
                    <a href="signin.html" class="d-none d-md-block">
                        <svg width="20" height="20" viewBox="0 0 25 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22.4882 19.6875C21.2029 17.4316 19.1958 15.6738 16.7901 14.6972C17.9864 13.7999 18.8701 12.549 19.316 11.1216C19.7619 9.69424 19.7474 8.16274 19.2745 6.74406C18.8016 5.32539 17.8943 4.09147 16.6812 3.21709C15.468 2.3427 14.0105 1.87219 12.5151 1.87219C11.0197 1.87219 9.5622 2.3427 8.34906 3.21709C7.13591 4.09147 6.22864 5.32539 5.75575 6.74406C5.28286 8.16274 5.26832 9.69424 5.71421 11.1216C6.16009 12.549 7.04379 13.7999 8.24012 14.6972C5.83442 15.6738 3.82735 17.4316 2.54199 19.6875C2.46235 19.8156 2.40926 19.9583 2.3859 20.1073C2.36253 20.2563 2.36936 20.4085 2.40598 20.5548C2.4426 20.7011 2.50826 20.8385 2.59906 20.9589C2.68985 21.0794 2.80393 21.1803 2.93452 21.2557C3.0651 21.3312 3.20952 21.3796 3.35919 21.3981C3.50886 21.4166 3.66073 21.4049 3.80576 21.3635C3.95079 21.3222 4.08603 21.2521 4.20344 21.1574C4.32084 21.0628 4.41801 20.9455 4.48918 20.8125C6.18793 17.8762 9.18793 16.125 12.5151 16.125C15.8423 16.125 18.8423 17.8772 20.5411 20.8125C20.6953 21.0605 20.9399 21.2388 21.2232 21.3097C21.5065 21.3806 21.8063 21.3386 22.0592 21.1925C22.312 21.0464 22.4982 20.8077 22.5783 20.5268C22.6583 20.246 22.6261 19.945 22.4882 19.6875ZM7.64012 9C7.64012 8.03582 7.92603 7.09328 8.4617 6.29159C8.99738 5.4899 9.75875 4.86506 10.6495 4.49609C11.5403 4.12711 12.5205 4.03057 13.4662 4.21867C14.4118 4.40677 15.2805 4.87107 15.9623 5.55285C16.644 6.23463 17.1083 7.10328 17.2964 8.04893C17.4846 8.99459 17.388 9.97479 17.019 10.8656C16.6501 11.7564 16.0252 12.5177 15.2235 13.0534C14.4218 13.5891 13.4793 13.875 12.5151 13.875C11.2226 13.8735 9.98353 13.3594 9.06962 12.4455C8.1557 11.5316 7.64161 10.2925 7.64012 9Z"
                                fill="#211F1C" />
                        </svg>
                    </a>
                    <a href="#!" id="quickBuyBtn" class="position-relative" data-bs-toggle="offcanvas"
                        data-bs-target="#cartOffcanvas">
                        <svg width="20" height="20" viewBox="0 0 25 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22.9214 6.25781C22.7448 6.05922 22.5282 5.90019 22.2859 5.79114C22.0435 5.68208 21.7809 5.62547 21.5151 5.625H17.3742C17.2752 4.40426 16.7204 3.26548 15.8201 2.43518C14.9197 1.60487 13.7399 1.14387 12.5151 1.14387C11.2904 1.14387 10.1105 1.60487 9.21017 2.43518C8.30983 3.26548 7.75501 4.40426 7.65606 5.625H3.52262C3.25718 5.62396 2.99454 5.67929 2.75208 5.78733C2.50962 5.89537 2.29286 6.05367 2.11615 6.25174C1.93943 6.44981 1.80679 6.68315 1.72699 6.93632C1.64719 7.18948 1.62206 7.45671 1.65325 7.72031L2.98919 18.9703C3.04446 19.427 3.26522 19.8477 3.60971 20.1526C3.9542 20.4575 4.39851 20.6256 4.85856 20.625H20.1717C20.6317 20.6256 21.076 20.4575 21.4205 20.1526C21.765 19.8477 21.9858 19.427 22.0411 18.9703L23.377 7.72031C23.4083 7.4582 23.3839 7.19244 23.3054 6.94041C23.2268 6.68839 23.096 6.45578 22.9214 6.25781ZM12.5151 3.375C13.1463 3.37506 13.7563 3.60255 14.2334 4.01577C14.7105 4.429 15.0228 5.0003 15.1129 5.625H9.91731C10.0075 5.0003 10.3197 4.429 10.7968 4.01577C11.2739 3.60255 11.8839 3.37506 12.5151 3.375ZM19.8454 18.375H5.18481L3.937 7.875H21.0933L19.8454 18.375Z"
                                fill="#211F1C" />
                        </svg>
                        <span id="quickBuyCount"
                            class="badge text-bg-primary  rounded-pill  position-absolute start-50 top-0 p-1">0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
