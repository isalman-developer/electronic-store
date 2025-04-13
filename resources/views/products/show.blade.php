@extends('layouts.app')

@push('page-style')
    <style>
        .side-images-div {
            height: 30rem;
            overflow-y: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
            position: relative;
        }

        .more-images-div {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
    </style>
@endpush
@section('content')
    <!--Breadcrumb start-->
    <div class="container py-4">
        <div class="row">
            <div class="col-12 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#!">Shop</a></li>
                        <li class="breadcrumb-item"><a href="#!">Office</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Office Chair Pillow</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!--Breadcrumb end-->

    <!--Product start-->
    <section class="pb-lg-8">
        <div class="container">
            <div class="row gy-4 gy-lg-0">
                <!--Product image-->
                <div class="col-lg-6">
                    <!--Swiper-->
                    <div class="row">
                        <div class="swiper-container swiper" data-thumbs="true" id="swiper-1" data-pagination-type=""
                            data-speed="4000" data-space-between="120" data-pagination="true" data-navigation="true"
                            data-autoplay="true" data-effect="fade" data-autoplay-delay="3000"
                            data-breakpoints='{"480": {"slidesPerView": 1}, "768": {"slidesPerView": 1}, "1024": {"slidesPerView": 1}}'>
                            <div class="swiper-wrapper">
                                @foreach ($product->media as $media)
                                    <div class="swiper-slide">
                                        <img src="{{ getImageUrl($media) }}" width="538px"/>
                                    </div>
                                @endforeach
                                <!-- Add more slides as needed -->
                            </div>
                        </div>

                        <!-- Thumbs Swiper Container -->
                        <div class="swiper-container swiper-thumbs mt-4 overflow-hidden">
                            <div class="swiper-wrapper">
                                @foreach ($product->media as $media)
                                    <div class="swiper-slide">
                                        <div class="ratio ratio-1x1 border">
                                            <img src="{{ getImageUrl($media) }}" alt="product image"
                                                class="" />
                                        </div>
                                    </div>
                                @endforeach
                                <!-- Add more thumbnails as needed -->
                            </div>
                        </div>
                    </div>
                </div>

                <!--Product details-->
                <div class="col-lg-6">
                    <div class="ps-lg-6">
                        <div class="position-relative" id="zoomPanePillow">
                            <span class="badge bg-info">New</span>
                            <div class="d-flex align-items-start justify-content-between mt-3 mb-2">
                                <div class="mb-3">
                                    <h2>Office Chair Pillow</h2>
                                    <span>( Brand Name )</span>
                                </div>
                                <div class="text-success d-flex align-items-center gap-2 mt-2">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.2"
                                            d="M14 8C14 9.18669 13.6481 10.3467 12.9888 11.3334C12.3295 12.3201 11.3925 13.0892 10.2961 13.5433C9.19975 13.9974 7.99335 14.1162 6.82946 13.8847C5.66558 13.6532 4.59648 13.0818 3.75736 12.2426C2.91825 11.4035 2.3468 10.3344 2.11529 9.17054C1.88378 8.00666 2.0026 6.80026 2.45673 5.7039C2.91085 4.60754 3.67989 3.67047 4.66658 3.01118C5.65328 2.35189 6.81331 2 8 2C9.5913 2 11.1174 2.63214 12.2426 3.75736C13.3679 4.88258 14 6.4087 14 8Z"
                                            fill="#16A34A"></path>
                                        <path
                                            d="M10.8538 6.14625C10.9002 6.19269 10.9371 6.24783 10.9623 6.30853C10.9874 6.36923 11.0004 6.43429 11.0004 6.5C11.0004 6.56571 10.9874 6.63077 10.9623 6.69147C10.9371 6.75217 10.9002 6.80731 10.8538 6.85375L7.35375 10.3538C7.30732 10.4002 7.25217 10.4371 7.19147 10.4623C7.13077 10.4874 7.06571 10.5004 7 10.5004C6.9343 10.5004 6.86923 10.4874 6.80853 10.4623C6.74783 10.4371 6.69269 10.4002 6.64625 10.3538L5.14625 8.85375C5.05243 8.75993 4.99972 8.63268 4.99972 8.5C4.99972 8.36732 5.05243 8.24007 5.14625 8.14625C5.24007 8.05243 5.36732 7.99972 5.5 7.99972C5.63268 7.99972 5.75993 8.05243 5.85375 8.14625L7 9.29313L10.1463 6.14625C10.1927 6.09976 10.2478 6.06288 10.3085 6.03772C10.3692 6.01256 10.4343 5.99961 10.5 5.99961C10.5657 5.99961 10.6308 6.01256 10.6915 6.03772C10.7522 6.06288 10.8073 6.09976 10.8538 6.14625ZM14.5 8C14.5 9.28558 14.1188 10.5423 13.4046 11.6112C12.6903 12.6801 11.6752 13.5132 10.4874 14.0052C9.29973 14.4972 7.99279 14.6259 6.73192 14.3751C5.47104 14.1243 4.31285 13.5052 3.40381 12.5962C2.49477 11.6872 1.8757 10.529 1.6249 9.26809C1.37409 8.00721 1.50282 6.70028 1.99479 5.51256C2.48676 4.32484 3.31988 3.30968 4.3888 2.59545C5.45772 1.88122 6.71442 1.5 8 1.5C9.72335 1.50182 11.3756 2.18722 12.5942 3.40582C13.8128 4.62441 14.4982 6.27665 14.5 8ZM13.5 8C13.5 6.9122 13.1774 5.84883 12.5731 4.94436C11.9687 4.03989 11.1098 3.33494 10.1048 2.91866C9.09977 2.50238 7.9939 2.39346 6.92701 2.60568C5.86011 2.8179 4.8801 3.34172 4.11092 4.11091C3.34173 4.8801 2.8179 5.86011 2.60568 6.927C2.39347 7.9939 2.50238 9.09977 2.91867 10.1048C3.33495 11.1098 4.0399 11.9687 4.94437 12.5731C5.84884 13.1774 6.91221 13.5 8 13.5C9.45819 13.4983 10.8562 12.9184 11.8873 11.8873C12.9184 10.8562 13.4983 9.45818 13.5 8Z"
                                            fill="#16A34A"></path>
                                    </svg>
                                    In Stock
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-3">
                                    <p class="mb-0">
                                        <span class="text-danger">$300.00</span>
                                        <span class="text-decoration-line-through">$400.00</span>
                                    </p>
                                    <span class="badge bg-danger">Save $100.00</span>
                                </div>
                                <span class="">
                                    4.5
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        fill="currentColor" class="bi bi-star-fill align-baseline text-primary"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                        </path>
                                    </svg>
                                </span>
                            </div>
                            <hr class="my-3" />
                            <div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold pb-1 mb-2">
                                        Color:
                                        <span class="text-body fw-normal" id="colorOption">Gray</span>
                                    </label>
                                    <div class="d-flex flex-wrap gap-2 align-items-center" data-label="#colorOption">
                                        <input type="radio" class="btn-check" name="colors" id="grayColor"
                                            checked="" />
                                        <label for="grayColor" class="btn-color-swatch" data-label="Gray">
                                            <span class="icon-shape icon-xxs bg-light"></span>
                                            <span class="visually-hidden">Gray</span>
                                        </label>
                                        <input type="radio" class="btn-check" name="colors" id="black" />
                                        <label for="black" class="btn-color-swatch" data-label="Green">
                                            <span class="icon-shape icon-xxs bg-success"></span>
                                            <span class="visually-hidden">Black</span>
                                        </label>
                                        <input type="radio" class="btn-check" name="colors" id="blue" />
                                        <label for="blue" class="btn-color-swatch" data-label="Blue">
                                            <span class="icon-shape icon-xxs bg-info"></span>
                                            <span class="visually-hidden">Blue</span>
                                        </label>
                                        <input type="radio" class="btn-check" name="colors" id="Red" />
                                        <label for="Red" class="btn-color-swatch" data-label="Red">
                                            <span class="icon-shape icon-xxs bg-danger"></span>
                                            <span class="visually-hidden">Red</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-3" />
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <span>Quantity:</span>
                                <div class="d-flex align-items-center mt-2 border p-2">
                                    <button class="btn btn-icon btn-xs btn-focus-none quantity-btn minus fs-5">-</button>
                                    <input type="number"
                                        class="form-control quantity-input text-center mx-1 p-0 border-0" value="1"
                                        min="1" style="width: 50px" />
                                    <button class="btn btn-icon btn-xs btn-focus-none quantity-btn plus fs-5">+</button>
                                </div>
                            </div>
                            <div class="d-flex flex-md-row flex-column gap-2">
                                <a href="#!" class="btn btn-dark">Add to Cart</a>
                                <a href="#!" class="btn btn-outline-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                    </svg>
                                    Add to Wishlist
                                </a>
                            </div>

                            <div class="accordion accordion-flush mt-3" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <a class="collapsed px-0 fs-5 fw-bold d-flex justify-content-between align-items-center py-3"
                                        data-bs-toggle="collapse" href="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        Shipping & Returns
                                        <span class="icon-shape icon-xs bg-light text-dark rounded-circle">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                fill="currentColor" class="bi bi-chevron-down chevron-down"
                                                viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </span>
                                    </a>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <p>
                                                We're dedicated to making our products accessible worldwide. Our service
                                                ships to most
                                                countries, catering to diverse shipping needs. Enjoy free shipping on
                                                all orders over
                                                $100.
                                            </p>
                                            <p>You can return your product up to 30 days after receiving your order.</p>
                                            <a href="#!" class="text-link">Learn More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <a class="collapsed px-0 fs-5 fw-bold d-flex justify-content-between align-items-center py-3"
                                        data-bs-toggle="collapse" href="#flush-collapseTwo" aria-expanded="false"
                                        aria-controls="flush-collapseTwo">
                                        Warranty
                                        <span class="icon-shape icon-xs bg-light text-dark rounded-circle">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                fill="currentColor" class="bi bi-chevron-down chevron-down"
                                                viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </span>
                                    </a>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <p>
                                                We're dedicated to making our products accessible worldwide. Our service
                                                ships to most
                                                countries, catering to diverse shipping needs. Enjoy free shipping on
                                                all orders over
                                                $100.
                                            </p>
                                            <p>You can return your product up to 30 days after receiving your order.</p>
                                            <a href="#!" class="text-link">Learn More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <a class="collapsed px-0 fs-5 fw-bold d-flex justify-content-between align-items-center py-3"
                                        data-bs-toggle="collapse" href="#flush-collapseThree" aria-expanded="false"
                                        aria-controls="flush-collapseThree">
                                        More Payment option
                                        <span class="icon-shape icon-xs bg-light text-dark rounded-circle">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                fill="currentColor" class="bi bi-chevron-down chevron-down"
                                                viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </span>
                                    </a>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="list-unstyled lh-lg">
                                                <li class="d-flex align-items-center gap-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 2.4375C10.1087 2.4375 8.25991 2.99833 6.68736 4.04907C5.11482 5.09981 3.88917 6.59327 3.16541 8.34059C2.44164 10.0879 2.25227 12.0106 2.62125 13.8656C2.99022 15.7205 3.90096 17.4244 5.2383 18.7617C6.57564 20.099 8.27951 21.0098 10.1345 21.3788C11.9894 21.7477 13.9121 21.5584 15.6594 20.8346C17.4067 20.1108 18.9002 18.8852 19.9509 17.3126C21.0017 15.7401 21.5625 13.8913 21.5625 12C21.5595 9.46478 20.5511 7.03425 18.7584 5.24158C16.9658 3.44891 14.5352 2.44048 12 2.4375ZM20.4188 11.4375H16.3013C16.1934 8.5575 15.2616 5.82844 13.6819 3.73125C15.4929 4.10252 17.1323 5.05716 18.3491 6.44899C19.5658 7.84082 20.2928 9.5931 20.4188 11.4375ZM12 20.4375C11.9766 20.4376 11.9535 20.4328 11.9321 20.4232C11.9108 20.4137 11.8918 20.3997 11.8763 20.3822C10.0425 18.4069 8.94563 15.5822 8.82375 12.5625H15.1753C15.0544 15.5822 13.9566 18.4069 12.1238 20.3822C12.1083 20.3997 12.0892 20.4137 12.0679 20.4232C12.0465 20.4328 12.0234 20.4376 12 20.4375ZM8.82375 11.4375C8.94563 8.41781 10.0425 5.59312 11.8763 3.61781C11.8918 3.60039 11.9109 3.58645 11.9322 3.5769C11.9535 3.56736 11.9766 3.56242 12 3.56242C12.0234 3.56242 12.0465 3.56736 12.0678 3.5769C12.0891 3.58645 12.1082 3.60039 12.1238 3.61781C13.9575 5.59312 15.0544 8.41781 15.1753 11.4375H8.82375ZM10.3181 3.73125C8.73844 5.82844 7.80657 8.5575 7.69875 11.4375H3.58125C3.70718 9.5931 4.43418 7.84082 5.65093 6.44899C6.86768 5.05716 8.5071 4.10252 10.3181 3.73125ZM3.58125 12.5625H7.69875C7.80657 15.4425 8.73844 18.1716 10.3181 20.2687C8.5071 19.8975 6.86768 18.9428 5.65093 17.551C4.43418 16.1592 3.70718 14.4069 3.58125 12.5625ZM13.6819 20.2687C15.2616 18.1716 16.1934 15.4425 16.3013 12.5625H20.4188C20.2928 14.4069 19.5658 16.1592 18.3491 17.551C17.1323 18.9428 15.4929 19.8975 13.6819 20.2687Z"
                                                            fill="#211F1C" />
                                                    </svg>
                                                    Free Shipping on Products Over $150
                                                </li>
                                                <li class="d-flex align-items-center gap-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M23.0222 11.0419L21.7097 7.76062C21.613 7.51654 21.445 7.30726 21.2276 7.1601C21.0102 7.01293 20.7535 6.9347 20.4909 6.93563H17.0625V6C17.0625 5.85082 17.0032 5.70774 16.8977 5.60225C16.7923 5.49676 16.6492 5.4375 16.5 5.4375H2.25C1.9019 5.4375 1.56806 5.57578 1.32192 5.82192C1.07578 6.06806 0.9375 6.4019 0.9375 6.75V17.25C0.9375 17.5981 1.07578 17.9319 1.32192 18.1781C1.56806 18.4242 1.9019 18.5625 2.25 18.5625H3.99375C4.12285 19.1983 4.46779 19.7699 4.9701 20.1805C5.47242 20.591 6.10124 20.8153 6.75 20.8153C7.39876 20.8153 8.02758 20.591 8.5299 20.1805C9.03221 19.7699 9.37715 19.1983 9.50625 18.5625H14.4938C14.6229 19.1983 14.9678 19.7699 15.4701 20.1805C15.9724 20.591 16.6012 20.8153 17.25 20.8153C17.8988 20.8153 18.5276 20.591 19.0299 20.1805C19.5322 19.7699 19.8771 19.1983 20.0062 18.5625H21.75C22.0981 18.5625 22.4319 18.4242 22.6781 18.1781C22.9242 17.9319 23.0625 17.5981 23.0625 17.25V11.25C23.0624 11.1787 23.0487 11.1081 23.0222 11.0419ZM17.0625 8.0625H20.4919C20.5294 8.06246 20.5661 8.0737 20.5972 8.09477C20.6283 8.11583 20.6524 8.14574 20.6663 8.18063L21.6694 10.6875H17.0625V8.0625ZM2.0625 6.75C2.0625 6.70027 2.08225 6.65258 2.11742 6.61742C2.15258 6.58225 2.20027 6.5625 2.25 6.5625H15.9375V12.9375H2.0625V6.75ZM6.75 19.6875C6.41624 19.6875 6.08998 19.5885 5.81248 19.4031C5.53497 19.2177 5.31868 18.9541 5.19095 18.6458C5.06323 18.3374 5.02981 17.9981 5.09492 17.6708C5.16004 17.3434 5.32076 17.0428 5.55676 16.8068C5.79276 16.5708 6.09344 16.41 6.42078 16.3449C6.74813 16.2798 7.08743 16.3132 7.39578 16.441C7.70413 16.5687 7.96768 16.785 8.1531 17.0625C8.33853 17.34 8.4375 17.6662 8.4375 18C8.4375 18.4476 8.25971 18.8768 7.94324 19.1932C7.62677 19.5097 7.19755 19.6875 6.75 19.6875ZM14.4938 17.4375H9.50625C9.37715 16.8017 9.03221 16.2301 8.5299 15.8195C8.02758 15.409 7.39876 15.1847 6.75 15.1847C6.10124 15.1847 5.47242 15.409 4.9701 15.8195C4.46779 16.2301 4.12285 16.8017 3.99375 17.4375H2.25C2.20027 17.4375 2.15258 17.4177 2.11742 17.3826C2.08225 17.3474 2.0625 17.2997 2.0625 17.25V14.0625H15.9375V15.5138C15.57 15.7082 15.25 15.9815 15.0004 16.3141C14.7508 16.6467 14.5778 17.0303 14.4938 17.4375ZM17.25 19.6875C16.9162 19.6875 16.59 19.5885 16.3125 19.4031C16.035 19.2177 15.8187 18.9541 15.691 18.6458C15.5632 18.3374 15.5298 17.9981 15.5949 17.6708C15.66 17.3434 15.8208 17.0428 16.0568 16.8068C16.2928 16.5708 16.5934 16.41 16.9208 16.3449C17.2481 16.2798 17.5874 16.3132 17.8958 16.441C18.2041 16.5687 18.4677 16.785 18.6531 17.0625C18.8385 17.34 18.9375 17.6662 18.9375 18C18.9375 18.4476 18.7597 18.8768 18.4432 19.1932C18.1268 19.5097 17.6976 19.6875 17.25 19.6875ZM21.9375 17.25C21.9375 17.2997 21.9177 17.3474 21.8826 17.3826C21.8474 17.4177 21.7997 17.4375 21.75 17.4375H20.0062C19.8758 16.8026 19.5304 16.2322 19.0283 15.8223C18.5262 15.4125 17.8981 15.1882 17.25 15.1875C17.1872 15.1875 17.1244 15.1875 17.0625 15.1941V11.8125H21.9375V17.25Z"
                                                            fill="#211F1C" />
                                                    </svg>
                                                    Easy Returns
                                                </li>
                                                <li class="d-flex align-items-center gap-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M18.5625 15.75C18.561 16.8933 18.1062 17.9893 17.2978 18.7978C16.4893 19.6062 15.3933 20.061 14.25 20.0625H12.5625V21.75C12.5625 21.8992 12.5032 22.0423 12.3977 22.1477C12.2923 22.2532 12.1492 22.3125 12 22.3125C11.8508 22.3125 11.7077 22.2532 11.6023 22.1477C11.4968 22.0423 11.4375 21.8992 11.4375 21.75V20.0625H9.75C8.60671 20.061 7.51067 19.6062 6.70225 18.7978C5.89382 17.9893 5.43899 16.8933 5.4375 15.75C5.4375 15.6008 5.49676 15.4577 5.60225 15.3523C5.70774 15.2468 5.85082 15.1875 6 15.1875C6.14918 15.1875 6.29226 15.2468 6.39775 15.3523C6.50324 15.4577 6.5625 15.6008 6.5625 15.75C6.5625 16.5954 6.89832 17.4061 7.4961 18.0039C8.09387 18.6017 8.90462 18.9375 9.75 18.9375H14.25C15.0954 18.9375 15.9061 18.6017 16.5039 18.0039C17.1017 17.4061 17.4375 16.5954 17.4375 15.75C17.4375 14.9046 17.1017 14.0939 16.5039 13.4961C15.9061 12.8983 15.0954 12.5625 14.25 12.5625H10.5C9.35625 12.5625 8.25935 12.1081 7.4506 11.2994C6.64185 10.4906 6.1875 9.39375 6.1875 8.25C6.1875 7.10625 6.64185 6.00935 7.4506 5.2006C8.25935 4.39185 9.35625 3.9375 10.5 3.9375H11.4375V2.25C11.4375 2.10082 11.4968 1.95774 11.6023 1.85225C11.7077 1.74676 11.8508 1.6875 12 1.6875C12.1492 1.6875 12.2923 1.74676 12.3977 1.85225C12.5032 1.95774 12.5625 2.10082 12.5625 2.25V3.9375H13.5C14.6433 3.93899 15.7393 4.39382 16.5478 5.20225C17.3562 6.01067 17.811 7.10671 17.8125 8.25C17.8125 8.39918 17.7532 8.54226 17.6477 8.64775C17.5423 8.75324 17.3992 8.8125 17.25 8.8125C17.1008 8.8125 16.9577 8.75324 16.8523 8.64775C16.7468 8.54226 16.6875 8.39918 16.6875 8.25C16.6875 7.40462 16.3517 6.59387 15.7539 5.9961C15.1561 5.39832 14.3454 5.0625 13.5 5.0625H10.5C9.65462 5.0625 8.84387 5.39832 8.2461 5.9961C7.64832 6.59387 7.3125 7.40462 7.3125 8.25C7.3125 9.09538 7.64832 9.90613 8.2461 10.5039C8.84387 11.1017 9.65462 11.4375 10.5 11.4375H14.25C15.3933 11.439 16.4893 11.8938 17.2978 12.7022C18.1062 13.5107 18.561 14.6067 18.5625 15.75Z"
                                                            fill="#211F1C" />
                                                    </svg>
                                                    Price Match Guarantee
                                                </li>
                                                <li class="d-flex align-items-center gap-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M19.5 7.6875H16.3125V5.25C16.3125 4.10625 15.8581 3.00935 15.0494 2.2006C14.2406 1.39185 13.1437 0.9375 12 0.9375C10.8563 0.9375 9.75935 1.39185 8.9506 2.2006C8.14185 3.00935 7.6875 4.10625 7.6875 5.25V7.6875H4.5C4.1519 7.6875 3.81806 7.82578 3.57192 8.07192C3.32578 8.31806 3.1875 8.6519 3.1875 9V19.5C3.1875 19.8481 3.32578 20.1819 3.57192 20.4281C3.81806 20.6742 4.1519 20.8125 4.5 20.8125H19.5C19.8481 20.8125 20.1819 20.6742 20.4281 20.4281C20.6742 20.1819 20.8125 19.8481 20.8125 19.5V9C20.8125 8.6519 20.6742 8.31806 20.4281 8.07192C20.1819 7.82578 19.8481 7.6875 19.5 7.6875ZM8.8125 5.25C8.8125 4.40462 9.14832 3.59387 9.7461 2.9961C10.3439 2.39832 11.1546 2.0625 12 2.0625C12.8454 2.0625 13.6561 2.39832 14.2539 2.9961C14.8517 3.59387 15.1875 4.40462 15.1875 5.25V7.6875H8.8125V5.25ZM19.6875 19.5C19.6875 19.5497 19.6677 19.5974 19.6326 19.6326C19.5974 19.6677 19.5497 19.6875 19.5 19.6875H4.5C4.45027 19.6875 4.40258 19.6677 4.36742 19.6326C4.33225 19.5974 4.3125 19.5497 4.3125 19.5V9C4.3125 8.95027 4.33225 8.90258 4.36742 8.86742C4.40258 8.83225 4.45027 8.8125 4.5 8.8125H19.5C19.5497 8.8125 19.5974 8.83225 19.6326 8.86742C19.6677 8.90258 19.6875 8.95027 19.6875 9V19.5ZM12.9375 14.25C12.9375 14.4354 12.8825 14.6167 12.7795 14.7708C12.6765 14.925 12.5301 15.0452 12.3588 15.1161C12.1875 15.1871 11.999 15.2057 11.8171 15.1695C11.6352 15.1333 11.4682 15.044 11.3371 14.9129C11.206 14.7818 11.1167 14.6148 11.0805 14.4329C11.0443 14.251 11.0629 14.0625 11.1339 13.8912C11.2048 13.7199 11.325 13.5735 11.4792 13.4705C11.6333 13.3675 11.8146 13.3125 12 13.3125C12.2486 13.3125 12.4871 13.4113 12.6629 13.5871C12.8387 13.7629 12.9375 14.0014 12.9375 14.25Z"
                                                            fill="#211F1C" />
                                                    </svg>
                                                    Secure Payments
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Product end-->
    <!--Product tabs start-->
    <section class="py-lg-8">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills nav-lb-tab" id="myTab" role="tablist">
                        <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn -->
                            <button class="nav-link active" id="product-tab" data-bs-toggle="tab"
                                data-bs-target="#product-tab-pane" type="button" role="tab"
                                aria-controls="product-tab-pane" aria-selected="true">
                                Description
                            </button>
                        </li>
                        <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn -->
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                data-bs-target="#details-tab-pane" type="button" role="tab"
                                aria-controls="details-tab-pane" aria-selected="false">
                                Dimension
                            </button>
                        </li>
                        <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn -->
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                data-bs-target="#reviews-tab-pane" type="button" role="tab"
                                aria-controls="reviews-tab-pane" aria-selected="false">
                                Deliveries & Pickups
                            </button>
                        </li>
                        <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn -->
                            <button class="nav-link" id="sellerInfo-tab" data-bs-toggle="tab"
                                data-bs-target="#sellerInfo-tab-pane" type="button" role="tab"
                                aria-controls="sellerInfo-tab-pane" aria-selected="false">
                                Downloads
                            </button>
                        </li>
                    </ul>
                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                        <!-- tab pane -->
                        <div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel"
                            aria-labelledby="product-tab" tabindex="0">
                            <div class="my-6">
                                <div class="mb-5">
                                    <!-- text -->
                                    <h4 class="mb-3">Refined and portable freestanding lamp</h4>
                                    <p class="mb-4">
                                        There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered
                                        alteration in some form, by injected humour, or randomised words which don't
                                        look
                                        even slightly believable. If you are going to use a passage of Lorem Ipsum, you
                                        need to be sure
                                        there isn't anything embarrassing hidden in the middle of text. All the Lorem
                                        Ipsum generators on the Internet tend to repeat predefined chunks as necessary,
                                    </p>

                                    <ul class="list-unstyled lh-lg">
                                        <li class="d-flex align-items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                <path
                                                    d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                                            </svg>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                <path
                                                    d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                                            </svg>
                                            Ut sed nulla ut risus fermentum maximus.
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                <path
                                                    d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                                            </svg>
                                            Nunc sed metus id nisi gravida auctor.
                                        </li>
                                        <li class="d-flex align-items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                <path
                                                    d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                                            </svg>
                                            Maecenas venenatis.
                                        </li>
                                    </ul>
                                    <p>Mauris aliquam quam non lectus dictum, et laoreet mauris vestibulum.</p>
                                </div>
                            </div>
                        </div>
                        <!-- tab pane -->
                        <div class="tab-pane fade" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab"
                            tabindex="0">
                            <div class="my-6">
                                <img src="{{ asset('assets/images/png/graphics.png') }}" alt="graphics"
                                    class="img-fluid" />
                            </div>
                        </div>
                        <!-- tab pane -->
                        <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab"
                            tabindex="0">
                            <div class="my-6">
                                <div class="mb-5">
                                    <h3 class="fs-5">White Glove delivery</h3>
                                    <p>
                                        There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered
                                        alteration in some form, by injected humour, or randomised words which don't
                                        look
                                        even slightly believable.
                                    </p>
                                </div>
                                <div class="mb-5">
                                    <h3 class="fs-5">Pick up</h3>
                                    <p>
                                        There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered
                                        alteration in some form, by injected humour, or randomised words which don't
                                        look
                                        even slightly believable.Lorem Ipsum available, but the majority have suffered
                                        alteration in some
                                        form, by injected humour, or randomised words which don't look even slightly
                                        believable.
                                    </p>
                                </div>
                                <div class="mb-5">
                                    <h3 class="fs-5">Pick up time</h3>
                                    <p>For our local customers, pick up is available from our main distributioncenter,
                                        located at: 730 W
                                        Gota Lake Rd STE 111 Ahmedabad 344871.</p>
                                </div>
                            </div>
                        </div>
                        <!-- tab pane -->
                        <div class="tab-pane fade" id="sellerInfo-tab-pane" role="tabpanel"
                            aria-labelledby="sellerInfo-tab" tabindex="0">
                            <div class="my-6">
                                <div class="row gy-8 justify-content-center">
                                    <div class="col-md-3 col-6">
                                        <div class="text-center">
                                            <a href="#!" class="d-flex flex-column gap-3 justify-content-center">
                                                <span class="">
                                                    <svg width="32" height="20" viewBox="0 0 32 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M15.4263 6.375L12.1763 14.375C12.1013 14.5592 11.9732 14.7168 11.8082 14.8278C11.6432 14.9388 11.4488 14.9981 11.25 14.9981C11.0512 14.9981 10.8568 14.9388 10.6918 14.8278C10.5268 14.7168 10.3987 14.5592 10.3237 14.375L7.07375 6.375C7.01858 6.25232 6.98873 6.11977 6.98599 5.98529C6.98324 5.85081 7.00766 5.71715 7.05777 5.59232C7.10788 5.46749 7.18266 5.35406 7.27764 5.25881C7.37261 5.16355 7.48583 5.08844 7.61051 5.03796C7.73519 4.98748 7.86877 4.96268 8.00327 4.96503C8.13776 4.96738 8.27039 4.99684 8.39323 5.05165C8.51607 5.10646 8.62659 5.18548 8.71818 5.284C8.80976 5.38251 8.88053 5.4985 8.92625 5.625L11.25 11.3425L13.5737 5.625C13.6195 5.4985 13.6902 5.38251 13.7818 5.284C13.8734 5.18548 13.9839 5.10646 14.1068 5.05165C14.2296 4.99684 14.3622 4.96738 14.4967 4.96503C14.6312 4.96268 14.7648 4.98748 14.8895 5.03796C15.0142 5.08844 15.1274 5.16355 15.2224 5.25881C15.3173 5.35406 15.3921 5.46749 15.4422 5.59232C15.4923 5.71715 15.5168 5.85081 15.514 5.98529C15.5113 6.11977 15.4814 6.25232 15.4263 6.375ZM32 10C31.997 12.6513 30.9425 15.1931 29.0678 17.0678C27.1931 18.9425 24.6513 19.997 22 20H10C7.34784 20 4.8043 18.9464 2.92893 17.0711C1.05357 15.1957 0 12.6522 0 10C0 7.34784 1.05357 4.8043 2.92893 2.92893C4.8043 1.05357 7.34784 0 10 0H22C24.6513 0.00297764 27.1931 1.0575 29.0678 2.93222C30.9425 4.80694 31.997 7.34875 32 10ZM30 10C29.9977 7.87898 29.1541 5.84549 27.6543 4.3457C26.1545 2.84591 24.121 2.00232 22 2H10C7.87827 2 5.84344 2.84285 4.34315 4.34315C2.84285 5.84344 2 7.87827 2 10C2 12.1217 2.84285 14.1566 4.34315 15.6569C5.84344 17.1571 7.87827 18 10 18H22C24.121 17.9977 26.1545 17.1541 27.6543 15.6543C29.1541 14.1545 29.9977 12.121 30 10ZM22.605 11.2938L23.875 13.5C24.0066 13.7304 24.0413 14.0037 23.9715 14.2596C23.9016 14.5156 23.7329 14.7334 23.5025 14.865C23.2721 14.9966 22.9988 15.0313 22.7429 14.9615C22.4869 14.8916 22.2691 14.7229 22.1375 14.4925L20.7075 11.9925C20.6413 11.9925 20.5737 11.9988 20.5063 11.9988H19V13.9988C19 14.264 18.8946 14.5183 18.7071 14.7059C18.5196 14.8934 18.2652 14.9988 18 14.9988C17.7348 14.9988 17.4804 14.8934 17.2929 14.7059C17.1054 14.5183 17 14.264 17 13.9988V6C17 5.73478 17.1054 5.48043 17.2929 5.29289C17.4804 5.10536 17.7348 5 18 5H20.5C21.2334 5.00069 21.9481 5.23176 22.5431 5.66058C23.1381 6.0894 23.5833 6.69429 23.816 7.38984C24.0486 8.08539 24.0569 8.83644 23.8396 9.53693C23.6223 10.2374 23.1904 10.852 22.605 11.2938ZM19 10H20.5C20.8978 10 21.2794 9.84196 21.5607 9.56066C21.842 9.27936 22 8.89782 22 8.5C22 8.10218 21.842 7.72064 21.5607 7.43934C21.2794 7.15804 20.8978 7 20.5 7H19V10Z"
                                                            fill="#211F1C" />
                                                    </svg>
                                                </span>
                                                <span>Sketchup</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="text-center">
                                            <a href="#!" class="d-flex flex-column gap-3 justify-content-center">
                                                <span class="">
                                                    <svg width="33" height="32" viewBox="0 0 33 32"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M27.5 5H5.5C4.96957 5 4.46086 5.21071 4.08579 5.58579C3.71071 5.96086 3.5 6.46957 3.5 7V25C3.5 25.5304 3.71071 26.0391 4.08579 26.4142C4.46086 26.7893 4.96957 27 5.5 27H27.5C28.0304 27 28.5391 26.7893 28.9142 26.4142C29.2893 26.0391 29.5 25.5304 29.5 25V7C29.5 6.46957 29.2893 5.96086 28.9142 5.58579C28.5391 5.21071 28.0304 5 27.5 5ZM27.5 7V19.8438L24.2412 16.5863C24.0555 16.4005 23.835 16.2531 23.5923 16.1526C23.3497 16.052 23.0896 16.0003 22.8269 16.0003C22.5642 16.0003 22.3041 16.052 22.0614 16.1526C21.8187 16.2531 21.5982 16.4005 21.4125 16.5863L18.9125 19.0863L13.4125 13.5863C13.0375 13.2115 12.529 13.0009 11.9987 13.0009C11.4685 13.0009 10.96 13.2115 10.585 13.5863L5.5 18.6712V7H27.5ZM5.5 21.5L12 15L22 25H5.5V21.5ZM27.5 25H24.8288L20.3288 20.5L22.8288 18L27.5 22.6725V25ZM18.5 12.5C18.5 12.2033 18.588 11.9133 18.7528 11.6666C18.9176 11.42 19.1519 11.2277 19.426 11.1142C19.7001 11.0006 20.0017 10.9709 20.2926 11.0288C20.5836 11.0867 20.8509 11.2296 21.0607 11.4393C21.2704 11.6491 21.4133 11.9164 21.4712 12.2074C21.5291 12.4983 21.4993 12.7999 21.3858 13.074C21.2723 13.3481 21.08 13.5824 20.8334 13.7472C20.5867 13.912 20.2967 14 20 14C19.6022 14 19.2206 13.842 18.9393 13.5607C18.658 13.2794 18.5 12.8978 18.5 12.5Z"
                                                            fill="#211F1C" />
                                                    </svg>
                                                </span>
                                                <span>Image Library</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="text-center">
                                            <a href="#!" class="d-flex flex-column gap-3 justify-content-center">
                                                <span class="">
                                                    <svg width="33" height="32" viewBox="0 0 33 32"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M28.2075 11.2925L21.2075 4.2925C21.1146 4.19967 21.0042 4.12605 20.8829 4.07586C20.7615 4.02568 20.6314 3.9999 20.5 4H5.5C5.23478 4 4.98043 4.10536 4.79289 4.29289C4.60536 4.48043 4.5 4.73478 4.5 5V20C4.50011 20.2624 4.60337 20.5143 4.7875 20.7013L11.7875 27.7013C11.8805 27.7958 11.9914 27.8709 12.1137 27.9222C12.2361 27.9735 12.3674 27.9999 12.5 28H27.5C27.7652 28 28.0196 27.8946 28.2071 27.7071C28.3946 27.5196 28.5 27.2652 28.5 27V12C28.5001 11.8686 28.4743 11.7385 28.4241 11.6172C28.3739 11.4958 28.3003 11.3854 28.2075 11.2925ZM21.5 7.41375L25.0863 11H21.5V7.41375ZM11.5 24.5863L7.91375 21H11.5V24.5863ZM11.5 19H6.5V7.41375L11.5 12.4137V19ZM7.91375 6H19.5V11H12.9137L7.91375 6ZM19.5 13V19H13.5V13H19.5ZM13.5 26V21H20.0863L25.0863 26H13.5ZM26.5 24.5863L21.5 19.5863V13H26.5V24.5863Z"
                                                            fill="#211F1C" />
                                                    </svg>
                                                </span>
                                                <span>2d | 3d Files</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="text-center">
                                            <a href="#!" class="d-flex flex-column gap-3 justify-content-center">
                                                <span class="">
                                                    <svg width="32" height="32" viewBox="0 0 32 32"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M26.7075 8.2925L21.7075 3.2925C21.6146 3.19967 21.5042 3.12605 21.3829 3.07586C21.2615 3.02568 21.1314 2.9999 21 3H11C10.4696 3 9.96086 3.21071 9.58579 3.58579C9.21071 3.96086 9 4.46957 9 5V7H7C6.46957 7 5.96086 7.21071 5.58579 7.58579C5.21071 7.96086 5 8.46957 5 9V27C5 27.5304 5.21071 28.0391 5.58579 28.4142C5.96086 28.7893 6.46957 29 7 29H21C21.5304 29 22.0391 28.7893 22.4142 28.4142C22.7893 28.0391 23 27.5304 23 27V25H25C25.5304 25 26.0391 24.7893 26.4142 24.4142C26.7893 24.0391 27 23.5304 27 23V9C27.0001 8.86864 26.9743 8.73855 26.9241 8.61715C26.8739 8.49576 26.8003 8.38544 26.7075 8.2925ZM21 27H7V9H16.5863L21 13.4137V23.98C21 23.9875 21 23.9937 21 24C21 24.0063 21 24.0125 21 24.02V27ZM25 23H23V13C23.0001 12.8686 22.9743 12.7385 22.9241 12.6172C22.8739 12.4958 22.8003 12.3854 22.7075 12.2925L17.7075 7.2925C17.6146 7.19967 17.5042 7.12605 17.3829 7.07586C17.2615 7.02568 17.1314 6.9999 17 7H11V5H20.5863L25 9.41375V23ZM18 19C18 19.2652 17.8946 19.5196 17.7071 19.7071C17.5196 19.8946 17.2652 20 17 20H11C10.7348 20 10.4804 19.8946 10.2929 19.7071C10.1054 19.5196 10 19.2652 10 19C10 18.7348 10.1054 18.4804 10.2929 18.2929C10.4804 18.1054 10.7348 18 11 18H17C17.2652 18 17.5196 18.1054 17.7071 18.2929C17.8946 18.4804 18 18.7348 18 19ZM18 23C18 23.2652 17.8946 23.5196 17.7071 23.7071C17.5196 23.8946 17.2652 24 17 24H11C10.7348 24 10.4804 23.8946 10.2929 23.7071C10.1054 23.5196 10 23.2652 10 23C10 22.7348 10.1054 22.4804 10.2929 22.2929C10.4804 22.1054 10.7348 22 11 22H17C17.2652 22 17.5196 22.1054 17.7071 22.2929C17.8946 22.4804 18 22.7348 18 23Z"
                                                            fill="#211F1C" />
                                                    </svg>
                                                </span>
                                                <span>Tearsheet</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="text-center">
                                            <a href="#!" class="d-flex flex-column gap-3 justify-content-center">
                                                <span class="">
                                                    <svg width="33" height="32" viewBox="0 0 33 32"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M30.9138 17L18.5 4.58626C18.315 4.39973 18.0947 4.25185 17.852 4.15121C17.6093 4.05057 17.349 3.99917 17.0863 4.00001H5.50001C5.23479 4.00001 4.98044 4.10537 4.7929 4.2929C4.60537 4.48044 4.50001 4.73479 4.50001 5.00001V16.5863C4.49917 16.849 4.55057 17.1093 4.65121 17.352C4.75185 17.5947 4.89973 17.815 5.08626 18L17.5 30.4138C17.6857 30.5995 17.9062 30.7469 18.1489 30.8474C18.3916 30.948 18.6517 30.9997 18.9144 30.9997C19.1771 30.9997 19.4372 30.948 19.6799 30.8474C19.9225 30.7469 20.143 30.5995 20.3288 30.4138L30.9138 19.8288C31.0995 19.643 31.2469 19.4225 31.3474 19.1799C31.448 18.9372 31.4997 18.6771 31.4997 18.4144C31.4997 18.1517 31.448 17.8916 31.3474 17.6489C31.2469 17.4062 31.0995 17.1857 30.9138 17ZM18.9138 29L6.50001 16.5863V6.00001H17.0863L29.5 18.4138L18.9138 29ZM12.5 10.5C12.5 10.7967 12.412 11.0867 12.2472 11.3334C12.0824 11.58 11.8481 11.7723 11.574 11.8858C11.2999 11.9994 10.9983 12.0291 10.7074 11.9712C10.4164 11.9133 10.1491 11.7704 9.93935 11.5607C9.72957 11.3509 9.58671 11.0836 9.52883 10.7926C9.47095 10.5017 9.50066 10.2001 9.61419 9.92598C9.72772 9.6519 9.91998 9.41763 10.1667 9.25281C10.4133 9.08798 10.7033 9.00001 11 9.00001C11.3978 9.00001 11.7794 9.15805 12.0607 9.43935C12.342 9.72065 12.5 10.1022 12.5 10.5Z"
                                                            fill="#211F1C" />
                                                    </svg>
                                                </span>
                                                <span>Swatches</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="text-center">
                                            <a href="#!" class="d-flex flex-column gap-3 justify-content-center">
                                                <span class="">
                                                    <svg width="33" height="32" viewBox="0 0 33 32"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M27.3899 15.455C27.4544 15.3377 27.4946 15.2087 27.5082 15.0756C27.5218 14.9425 27.5086 14.808 27.4693 14.68C27.43 14.5521 27.3655 14.4334 27.2795 14.3309C27.1935 14.2284 27.0878 14.1442 26.9686 14.0833C26.8495 14.0224 26.7193 13.986 26.5858 13.9763C26.4524 13.9666 26.3183 13.9838 26.1916 14.0268C26.0649 14.0699 25.9482 14.1379 25.8483 14.2269C25.7483 14.316 25.6673 14.4241 25.6099 14.545C24.6855 16.3259 23.2441 17.7857 21.4749 18.7325L19.4024 14.0675C20.1945 13.5019 20.8043 12.7174 21.1571 11.8103C21.5098 10.9032 21.59 9.91279 21.3881 8.96068C21.1861 8.00857 20.7106 7.13612 20.0199 6.45033C19.3293 5.76455 18.4535 5.29525 17.4999 5.1V3C17.4999 2.73478 17.3946 2.48043 17.2071 2.29289C17.0195 2.10536 16.7652 2 16.4999 2C16.2347 2 15.9804 2.10536 15.7928 2.29289C15.6053 2.48043 15.4999 2.73478 15.4999 3V5.1C14.5464 5.29525 13.6706 5.76455 12.98 6.45033C12.2893 7.13612 11.8138 8.00857 11.6118 8.96068C11.4098 9.91279 11.4901 10.9032 11.8428 11.8103C12.1955 12.7174 12.8053 13.5019 13.5974 14.0675L7.5862 27.5938C7.53212 27.7139 7.50231 27.8435 7.49847 27.9751C7.49463 28.1068 7.51684 28.2379 7.56382 28.361C7.6108 28.484 7.68163 28.5966 7.77223 28.6922C7.86284 28.7878 7.97144 28.8645 8.09179 28.918C8.21215 28.9715 8.34189 29.0007 8.47357 29.004C8.60524 29.0072 8.73626 28.9844 8.85909 28.9368C8.98192 28.8893 9.09415 28.8179 9.18932 28.7269C9.2845 28.6358 9.36075 28.5269 9.4137 28.4062L12.5562 21.3363C13.8241 21.7777 15.1574 22.0021 16.4999 22C17.8432 21.9984 19.1773 21.7785 20.4499 21.3487L23.5862 28.4062C23.6947 28.6473 23.8944 28.8356 24.1414 28.93C24.3884 29.0243 24.6627 29.0169 24.9043 28.9095C25.1459 28.8021 25.3351 28.6033 25.4306 28.3568C25.5261 28.1102 25.52 27.8359 25.4137 27.5938L22.2887 20.5625C24.4739 19.4252 26.2553 17.6416 27.3899 15.455ZM16.4999 7C17.0933 7 17.6733 7.17595 18.1667 7.50559C18.66 7.83524 19.0445 8.30377 19.2716 8.85195C19.4986 9.40013 19.5581 10.0033 19.4423 10.5853C19.3265 11.1672 19.0408 11.7018 18.6213 12.1213C18.2017 12.5409 17.6672 12.8266 17.0852 12.9424C16.5033 13.0581 15.9001 12.9987 15.3519 12.7716C14.8037 12.5446 14.3352 12.1601 14.0055 11.6667C13.6759 11.1734 13.4999 10.5933 13.4999 10C13.4999 9.20435 13.816 8.44129 14.3786 7.87868C14.9412 7.31607 15.7043 7 16.4999 7ZM16.4999 20C15.4383 20.0013 14.3832 19.8325 13.3749 19.5L15.4274 14.8825C16.1356 15.0392 16.8693 15.0392 17.5774 14.8825L19.6374 19.515C18.6226 19.8363 17.5644 19.9998 16.4999 20Z"
                                                            fill="#211F1C" />
                                                    </svg>
                                                </span>
                                                <span>Assembly</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Reviews-->
            <div class="row">
                <div class="my-6">
                    <div class="mb-6">
                        <h3 class="mb-4">Reviews</h3>
                        <div class="my-2 p-4 bg-light">
                            <div class="row gy-4 gy-lg-0">
                                <div class="col-lg-4 col-md-8">
                                    <!-- progress -->
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                                        <div class="text-nowrap text-muted" style="width: 50px">
                                            <span class="d-inline-block align-middle text-muted">5</span>
                                            <i class="bi bi-star-fill ms-1 small text-primary"></i>
                                        </div>
                                        <div class="w-100">
                                            <div class="progress" style="height: 6px">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: 60%" aria-valuenow="60" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <span class="text-muted" style="width: 50px">22</span>
                                    </div>
                                    <!-- progress -->
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                                        <div class="text-nowrap text-muted" style="width: 50px">
                                            <span class="d-inline-block align-middle text-muted">4</span>
                                            <i class="bi bi-star-fill ms-1 small text-primary"></i>
                                        </div>
                                        <div class="w-100">
                                            <div class="progress" style="height: 6px">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                    aria-valuemax="50"></div>
                                            </div>
                                        </div>
                                        <span class="text-muted" style="width: 50px">19</span>
                                    </div>
                                    <!-- progress -->
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                                        <div class="text-nowrap text-muted" style="width: 50px">
                                            <span class="d-inline-block align-middle text-muted">3</span>
                                            <i class="bi bi-star-fill ms-1 small text-primary"></i>
                                        </div>
                                        <div class="w-100">
                                            <div class="progress" style="height: 6px">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                                    aria-valuemax="35"></div>
                                            </div>
                                        </div>
                                        <span class="text-muted" style="width: 50px">15</span>
                                    </div>
                                    <!-- progress -->
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                                        <div class="text-nowrap text-muted" style="width: 50px">
                                            <span class="d-inline-block align-middle text-muted">2</span>
                                            <i class="bi bi-star-fill ms-1 small text-primary"></i>
                                        </div>
                                        <div class="w-100">
                                            <div class="progress" style="height: 6px">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: 22%" aria-valuenow="22" aria-valuemin="0"
                                                    aria-valuemax="22"></div>
                                            </div>
                                        </div>
                                        <span class="text-muted" style="width: 50px">0</span>
                                    </div>
                                    <!-- progress -->
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                                        <div class="text-nowrap text-muted" style="width: 50px">
                                            <span class="d-inline-block align-middle text-muted">1</span>
                                            <i class="bi bi-star-fill ms-1 small text-primary"></i>
                                        </div>
                                        <div class="w-100">
                                            <div class="progress" style="height: 6px">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: 14%" aria-valuenow="14" aria-valuemin="0"
                                                    aria-valuemax="14"></div>
                                            </div>
                                        </div>
                                        <span class="text-muted" style="width: 50px">0</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 d-flex justify-content-center align-items-center">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="fs-2 text-dark fw-bold">5</div>
                                        <!-- rating -->
                                        <div class="d-flex flex-column">
                                            <small class="text-primary">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </small>

                                            <small>Based on 1 review</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 d-flex justify-content-center align-items-center">
                                    <a href="#!" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#reviewModal">Write a
                                        Review</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Search-->
                    <div class="mb-6">
                        <form>
                            <div class="row g-3">
                                <div class="col-lg-4 col-xl-3 col-md-6">
                                    <div class="position-relative">
                                        <label for="searchInput" class="visually-hidden"></label>
                                        <input type="search" id="searchInput" class="form-control ps-6"
                                            placeholder="Search Reviews" />
                                        <span class="position-absolute top-50 start-0 translate-middle ms-4">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M16.1479 15.3519L12.6273 11.8321C13.6477 10.6071 14.1566 9.03577 14.048 7.44512C13.9394 5.85447 13.2217 4.36692 12.0443 3.29193C10.8668 2.21693 9.32029 1.63725 7.72635 1.67348C6.13241 1.7097 4.6138 2.35904 3.48642 3.48642C2.35904 4.6138 1.7097 6.13241 1.67348 7.72635C1.63725 9.32029 2.21693 10.8668 3.29193 12.0443C4.36692 13.2217 5.85447 13.9394 7.44512 14.048C9.03577 14.1566 10.6071 13.6477 11.8321 12.6273L15.3519 16.1479C15.4042 16.2001 15.4663 16.2416 15.5345 16.2699C15.6028 16.2982 15.676 16.3127 15.7499 16.3127C15.8238 16.3127 15.897 16.2982 15.9653 16.2699C16.0336 16.2416 16.0956 16.2001 16.1479 16.1479C16.2001 16.0956 16.2416 16.0336 16.2699 15.9653C16.2982 15.897 16.3127 15.8238 16.3127 15.7499C16.3127 15.676 16.2982 15.6028 16.2699 15.5345C16.2416 15.4663 16.2001 15.4042 16.1479 15.3519ZM2.81242 7.87492C2.81242 6.87365 3.10933 5.89487 3.6656 5.06234C4.22188 4.22982 5.01253 3.58094 5.93758 3.19778C6.86263 2.81461 7.88053 2.71435 8.86256 2.90969C9.84459 3.10503 10.7466 3.58718 11.4546 4.29519C12.1626 5.00319 12.6448 5.90524 12.8401 6.88727C13.0355 7.8693 12.9352 8.8872 12.5521 9.81225C12.1689 10.7373 11.52 11.528 10.6875 12.0842C9.85497 12.6405 8.87618 12.9374 7.87492 12.9374C6.53271 12.9359 5.24591 12.4021 4.29683 11.453C3.34775 10.5039 2.81391 9.21712 2.81242 7.87492Z"
                                                    fill="#B3ACA3" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-2 col-md-6">
                                    <label for="ratingInput" class="visually-hidden"></label>

                                    <select id="ratingInput" class="" data-choices=""
                                        data-choices-removeitembutton="true" aria-label="Default select example">
                                        <option value="">All Rating</option>

                                        <option value="Top">Top</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mb-6">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0 fs-4">5 Reviews</h3>
                            <div class="col-lg-3">
                                <label for="mostRaing" class="visually-hidden"></label>
                                <select id="mostRaing" class="" data-choices=""
                                    data-choices-removeitembutton="true" aria-label="Default select example">
                                    <option value="">Sort by: Most recent</option>

                                    <option value="Highest Rating">Highest Rating</option>
                                    <option value="Lowest Rating">Lowest Rating</option>
                                    <option value="Verified Purchase">Verified Purchase</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-4 mb-4">
                            <!--Review-->
                            <div class="col-xl-4 col-md-6">
                                <div class="card h-100">
                                    <div class="card-body p-5">
                                        <small class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </small>
                                        <h3 class="fs-4 my-3">Exceptional Quality and Comfort</h3>
                                        <p>I purchased this chair a month ago, and it's been amazing! The design is
                                            sleek, and it's
                                            incredibly comfortable. Worth every penny!</p>
                                        <p class="d-flex align-items-center gap-3">
                                            Julia Robert
                                            <span class="small text-success d-flex align-items-center gap-1">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.2"
                                                        d="M15.75 9C15.75 10.335 15.3541 11.6401 14.6124 12.7501C13.8707 13.8601 12.8165 14.7253 11.5831 15.2362C10.3497 15.7471 8.99252 15.8808 7.68314 15.6203C6.37377 15.3598 5.17104 14.717 4.22703 13.773C3.28303 12.829 2.64015 11.6262 2.3797 10.3169C2.11925 9.00749 2.25292 7.65029 2.76382 6.41689C3.27471 5.18349 4.13987 4.12928 5.2499 3.38758C6.35994 2.64588 7.66498 2.25 9 2.25C10.7902 2.25 12.5071 2.96116 13.773 4.22703C15.0388 5.4929 15.75 7.20979 15.75 9Z"
                                                        fill="#15803D" />
                                                    <path
                                                        d="M12.2105 6.91453C12.2628 6.96677 12.3043 7.02881 12.3326 7.0971C12.3609 7.16538 12.3754 7.23858 12.3754 7.3125C12.3754 7.38642 12.3609 7.45962 12.3326 7.5279C12.3043 7.59619 12.2628 7.65823 12.2105 7.71047L8.27297 11.648C8.22073 11.7003 8.15869 11.7418 8.09041 11.7701C8.02212 11.7984 7.94892 11.8129 7.875 11.8129C7.80108 11.8129 7.72789 11.7984 7.6596 11.7701C7.59131 11.7418 7.52928 11.7003 7.47703 11.648L5.78953 9.96047C5.68399 9.85492 5.62469 9.71177 5.62469 9.5625C5.62469 9.41323 5.68399 9.27008 5.78953 9.16453C5.89508 9.05898 6.03824 8.99969 6.1875 8.99969C6.33677 8.99969 6.47992 9.05898 6.58547 9.16453L7.875 10.4548L11.4145 6.91453C11.4668 6.86223 11.5288 6.82074 11.5971 6.79244C11.6654 6.76413 11.7386 6.74956 11.8125 6.74956C11.8864 6.74956 11.9596 6.76413 12.0279 6.79244C12.0962 6.82074 12.1582 6.86223 12.2105 6.91453ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                        fill="#15803D" />
                                                </svg>
                                                Verified
                                            </span>
                                        </p>
                                        <div class="d-flex flex-row gap-3 align-items-center">
                                            <span>Was this review helpful?</span>
                                            <div class="d-flex flex-row gap-2">
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-up"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                        </path>
                                                    </svg>
                                                    2
                                                </a>
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-down"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                        </path>
                                                    </svg>
                                                    0
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Review-->
                            <div class="col-xl-4 col-md-6">
                                <div class="card h-100">
                                    <div class="card-body p-5">
                                        <small class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </small>
                                        <h3 class="fs-4 my-3">Perfect Addition to My Living Room</h3>
                                        <p>This lamp is not only stylish but also gives off the perfect amount of light.
                                            It transformed the
                                            look of my living room. Highly recommend!</p>
                                        <p class="d-flex align-items-center gap-3">
                                            Anita Parmar
                                            <span class="small text-success d-flex align-items-center gap-1">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.2"
                                                        d="M15.75 9C15.75 10.335 15.3541 11.6401 14.6124 12.7501C13.8707 13.8601 12.8165 14.7253 11.5831 15.2362C10.3497 15.7471 8.99252 15.8808 7.68314 15.6203C6.37377 15.3598 5.17104 14.717 4.22703 13.773C3.28303 12.829 2.64015 11.6262 2.3797 10.3169C2.11925 9.00749 2.25292 7.65029 2.76382 6.41689C3.27471 5.18349 4.13987 4.12928 5.2499 3.38758C6.35994 2.64588 7.66498 2.25 9 2.25C10.7902 2.25 12.5071 2.96116 13.773 4.22703C15.0388 5.4929 15.75 7.20979 15.75 9Z"
                                                        fill="#15803D" />
                                                    <path
                                                        d="M12.2105 6.91453C12.2628 6.96677 12.3043 7.02881 12.3326 7.0971C12.3609 7.16538 12.3754 7.23858 12.3754 7.3125C12.3754 7.38642 12.3609 7.45962 12.3326 7.5279C12.3043 7.59619 12.2628 7.65823 12.2105 7.71047L8.27297 11.648C8.22073 11.7003 8.15869 11.7418 8.09041 11.7701C8.02212 11.7984 7.94892 11.8129 7.875 11.8129C7.80108 11.8129 7.72789 11.7984 7.6596 11.7701C7.59131 11.7418 7.52928 11.7003 7.47703 11.648L5.78953 9.96047C5.68399 9.85492 5.62469 9.71177 5.62469 9.5625C5.62469 9.41323 5.68399 9.27008 5.78953 9.16453C5.89508 9.05898 6.03824 8.99969 6.1875 8.99969C6.33677 8.99969 6.47992 9.05898 6.58547 9.16453L7.875 10.4548L11.4145 6.91453C11.4668 6.86223 11.5288 6.82074 11.5971 6.79244C11.6654 6.76413 11.7386 6.74956 11.8125 6.74956C11.8864 6.74956 11.9596 6.76413 12.0279 6.79244C12.0962 6.82074 12.1582 6.86223 12.2105 6.91453ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                        fill="#15803D" />
                                                </svg>
                                                Verified
                                            </span>
                                        </p>
                                        <div class="d-flex flex-row gap-3 align-items-center">
                                            <span>Was this review helpful?</span>
                                            <div class="d-flex flex-row gap-2">
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-up"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                        </path>
                                                    </svg>
                                                    1
                                                </a>
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-down"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                        </path>
                                                    </svg>
                                                    0
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Review-->
                            <div class="col-xl-4 col-md-6">
                                <div class="card h-100">
                                    <div class="card-body p-5">
                                        <small class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </small>
                                        <h3 class="fs-4 my-3">Fast Shipping, Great Service</h3>
                                        <p>I was impressed by how quickly my order arrived. The product was exactly as
                                            described, and the
                                            customer service was outstanding. Will shop again!</p>
                                        <p class="d-flex align-items-center gap-3">
                                            Manasvi Suthar
                                            <span class="small text-danger d-flex align-items-center gap-1">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9.84375 12.6562C9.84375 12.8231 9.79427 12.9863 9.70156 13.125C9.60884 13.2638 9.47707 13.3719 9.32289 13.4358C9.16872 13.4996 8.99907 13.5163 8.8354 13.4838C8.67172 13.4512 8.52138 13.3709 8.40338 13.2529C8.28538 13.1349 8.20502 12.9845 8.17247 12.8209C8.13991 12.6572 8.15662 12.4875 8.22048 12.3334C8.28434 12.1792 8.39249 12.0474 8.53124 11.9547C8.66999 11.862 8.83313 11.8125 9 11.8125C9.22378 11.8125 9.43839 11.9014 9.59662 12.0596C9.75486 12.2179 9.84375 12.4325 9.84375 12.6562ZM9 5.0625C7.44891 5.0625 6.1875 6.19805 6.1875 7.59375V7.875C6.1875 8.02418 6.24677 8.16726 6.35226 8.27275C6.45775 8.37824 6.60082 8.4375 6.75 8.4375C6.89919 8.4375 7.04226 8.37824 7.14775 8.27275C7.25324 8.16726 7.3125 8.02418 7.3125 7.875V7.59375C7.3125 6.82031 8.06977 6.1875 9 6.1875C9.93024 6.1875 10.6875 6.82031 10.6875 7.59375C10.6875 8.36719 9.93024 9 9 9C8.85082 9 8.70775 9.05926 8.60226 9.16475C8.49677 9.27024 8.4375 9.41332 8.4375 9.5625V10.125C8.4375 10.2742 8.49677 10.4173 8.60226 10.5227C8.70775 10.6282 8.85082 10.6875 9 10.6875C9.14919 10.6875 9.29226 10.6282 9.39775 10.5227C9.50324 10.4173 9.5625 10.2742 9.5625 10.125V10.0744C10.845 9.83883 11.8125 8.81578 11.8125 7.59375C11.8125 6.19805 10.5511 5.0625 9 5.0625ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                        fill="#DC2626" />
                                                </svg>

                                                Unverified
                                            </span>
                                        </p>
                                        <div class="d-flex flex-row gap-3 align-items-center">
                                            <span>Was this review helpful?</span>
                                            <div class="d-flex flex-row gap-2">
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-up"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                        </path>
                                                    </svg>
                                                    1
                                                </a>
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-down"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                        </path>
                                                    </svg>
                                                    0
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Review-->
                            <div class="col-xl-4 col-md-6">
                                <div class="card h-100">
                                    <div class="card-body p-5">
                                        <small class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </small>
                                        <h3 class="fs-4 my-3">Stylish but Slightly Overpriced</h3>
                                        <p>The design is beautiful, and it complements my décor perfectly. However, I
                                            feel the price is a
                                            bit high for the size of the product.</p>
                                        <p class="d-flex align-items-center gap-3">
                                            Vallabh Sompura
                                            <span class="small text-success d-flex align-items-center gap-1">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.2"
                                                        d="M15.75 9C15.75 10.335 15.3541 11.6401 14.6124 12.7501C13.8707 13.8601 12.8165 14.7253 11.5831 15.2362C10.3497 15.7471 8.99252 15.8808 7.68314 15.6203C6.37377 15.3598 5.17104 14.717 4.22703 13.773C3.28303 12.829 2.64015 11.6262 2.3797 10.3169C2.11925 9.00749 2.25292 7.65029 2.76382 6.41689C3.27471 5.18349 4.13987 4.12928 5.2499 3.38758C6.35994 2.64588 7.66498 2.25 9 2.25C10.7902 2.25 12.5071 2.96116 13.773 4.22703C15.0388 5.4929 15.75 7.20979 15.75 9Z"
                                                        fill="#15803D" />
                                                    <path
                                                        d="M12.2105 6.91453C12.2628 6.96677 12.3043 7.02881 12.3326 7.0971C12.3609 7.16538 12.3754 7.23858 12.3754 7.3125C12.3754 7.38642 12.3609 7.45962 12.3326 7.5279C12.3043 7.59619 12.2628 7.65823 12.2105 7.71047L8.27297 11.648C8.22073 11.7003 8.15869 11.7418 8.09041 11.7701C8.02212 11.7984 7.94892 11.8129 7.875 11.8129C7.80108 11.8129 7.72789 11.7984 7.6596 11.7701C7.59131 11.7418 7.52928 11.7003 7.47703 11.648L5.78953 9.96047C5.68399 9.85492 5.62469 9.71177 5.62469 9.5625C5.62469 9.41323 5.68399 9.27008 5.78953 9.16453C5.89508 9.05898 6.03824 8.99969 6.1875 8.99969C6.33677 8.99969 6.47992 9.05898 6.58547 9.16453L7.875 10.4548L11.4145 6.91453C11.4668 6.86223 11.5288 6.82074 11.5971 6.79244C11.6654 6.76413 11.7386 6.74956 11.8125 6.74956C11.8864 6.74956 11.9596 6.76413 12.0279 6.79244C12.0962 6.82074 12.1582 6.86223 12.2105 6.91453ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                        fill="#15803D" />
                                                </svg>
                                                Verified
                                            </span>
                                        </p>
                                        <div class="d-flex flex-row gap-3 align-items-center">
                                            <span>Was this review helpful?</span>
                                            <div class="d-flex flex-row gap-2">
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-up"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                        </path>
                                                    </svg>
                                                    0
                                                </a>
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-down"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                        </path>
                                                    </svg>
                                                    2
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Review-->
                            <div class="col-xl-4 col-md-6">
                                <div class="card h-100">
                                    <div class="card-body p-5">
                                        <small class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </small>
                                        <h3 class="fs-4 my-3">Sturdy and Well-Made</h3>
                                        <p>The dining table exceeded my expectations. It’s solid, well-constructed, and
                                            looks elegant in my
                                            home. Assembly was straightforward too!</p>
                                        <p class="d-flex align-items-center gap-3">
                                            Sandip Chauhan
                                            <span class="small text-success d-flex align-items-center gap-1">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.2"
                                                        d="M15.75 9C15.75 10.335 15.3541 11.6401 14.6124 12.7501C13.8707 13.8601 12.8165 14.7253 11.5831 15.2362C10.3497 15.7471 8.99252 15.8808 7.68314 15.6203C6.37377 15.3598 5.17104 14.717 4.22703 13.773C3.28303 12.829 2.64015 11.6262 2.3797 10.3169C2.11925 9.00749 2.25292 7.65029 2.76382 6.41689C3.27471 5.18349 4.13987 4.12928 5.2499 3.38758C6.35994 2.64588 7.66498 2.25 9 2.25C10.7902 2.25 12.5071 2.96116 13.773 4.22703C15.0388 5.4929 15.75 7.20979 15.75 9Z"
                                                        fill="#15803D" />
                                                    <path
                                                        d="M12.2105 6.91453C12.2628 6.96677 12.3043 7.02881 12.3326 7.0971C12.3609 7.16538 12.3754 7.23858 12.3754 7.3125C12.3754 7.38642 12.3609 7.45962 12.3326 7.5279C12.3043 7.59619 12.2628 7.65823 12.2105 7.71047L8.27297 11.648C8.22073 11.7003 8.15869 11.7418 8.09041 11.7701C8.02212 11.7984 7.94892 11.8129 7.875 11.8129C7.80108 11.8129 7.72789 11.7984 7.6596 11.7701C7.59131 11.7418 7.52928 11.7003 7.47703 11.648L5.78953 9.96047C5.68399 9.85492 5.62469 9.71177 5.62469 9.5625C5.62469 9.41323 5.68399 9.27008 5.78953 9.16453C5.89508 9.05898 6.03824 8.99969 6.1875 8.99969C6.33677 8.99969 6.47992 9.05898 6.58547 9.16453L7.875 10.4548L11.4145 6.91453C11.4668 6.86223 11.5288 6.82074 11.5971 6.79244C11.6654 6.76413 11.7386 6.74956 11.8125 6.74956C11.8864 6.74956 11.9596 6.76413 12.0279 6.79244C12.0962 6.82074 12.1582 6.86223 12.2105 6.91453ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                        fill="#15803D" />
                                                </svg>
                                                Verified
                                            </span>
                                        </p>
                                        <div class="d-flex flex-row gap-3 align-items-center">
                                            <span>Was this review helpful?</span>
                                            <div class="d-flex flex-row gap-2">
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-up"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                        </path>
                                                    </svg>
                                                    1
                                                </a>
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-down"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                        </path>
                                                    </svg>
                                                    0
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Review-->
                            <div class="col-xl-4 col-md-6">
                                <div class="card h-100">
                                    <div class="card-body p-5">
                                        <small class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </small>
                                        <h3 class="fs-4 my-3">Sturdy and Well-Made</h3>
                                        <p>The dining table exceeded my expectations. It’s solid, well-constructed, and
                                            looks elegant in my
                                            home. Assembly was straightforward too!</p>
                                        <p class="d-flex align-items-center gap-3">
                                            Sandip Chauhan
                                            <span class="small text-success d-flex align-items-center gap-1">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.2"
                                                        d="M15.75 9C15.75 10.335 15.3541 11.6401 14.6124 12.7501C13.8707 13.8601 12.8165 14.7253 11.5831 15.2362C10.3497 15.7471 8.99252 15.8808 7.68314 15.6203C6.37377 15.3598 5.17104 14.717 4.22703 13.773C3.28303 12.829 2.64015 11.6262 2.3797 10.3169C2.11925 9.00749 2.25292 7.65029 2.76382 6.41689C3.27471 5.18349 4.13987 4.12928 5.2499 3.38758C6.35994 2.64588 7.66498 2.25 9 2.25C10.7902 2.25 12.5071 2.96116 13.773 4.22703C15.0388 5.4929 15.75 7.20979 15.75 9Z"
                                                        fill="#15803D" />
                                                    <path
                                                        d="M12.2105 6.91453C12.2628 6.96677 12.3043 7.02881 12.3326 7.0971C12.3609 7.16538 12.3754 7.23858 12.3754 7.3125C12.3754 7.38642 12.3609 7.45962 12.3326 7.5279C12.3043 7.59619 12.2628 7.65823 12.2105 7.71047L8.27297 11.648C8.22073 11.7003 8.15869 11.7418 8.09041 11.7701C8.02212 11.7984 7.94892 11.8129 7.875 11.8129C7.80108 11.8129 7.72789 11.7984 7.6596 11.7701C7.59131 11.7418 7.52928 11.7003 7.47703 11.648L5.78953 9.96047C5.68399 9.85492 5.62469 9.71177 5.62469 9.5625C5.62469 9.41323 5.68399 9.27008 5.78953 9.16453C5.89508 9.05898 6.03824 8.99969 6.1875 8.99969C6.33677 8.99969 6.47992 9.05898 6.58547 9.16453L7.875 10.4548L11.4145 6.91453C11.4668 6.86223 11.5288 6.82074 11.5971 6.79244C11.6654 6.76413 11.7386 6.74956 11.8125 6.74956C11.8864 6.74956 11.9596 6.76413 12.0279 6.79244C12.0962 6.82074 12.1582 6.86223 12.2105 6.91453ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                        fill="#15803D" />
                                                </svg>
                                                Verified
                                            </span>
                                        </p>
                                        <div class="d-flex flex-row gap-3 align-items-center">
                                            <span>Was this review helpful?</span>
                                            <div class="d-flex flex-row gap-2">
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-up"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                        </path>
                                                    </svg>
                                                    1
                                                </a>
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-down"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                        </path>
                                                    </svg>
                                                    0
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--More reviews-->
                        <div class="collapse" id="collapseContent">
                            <div class="row g-4 mb-4">
                                <div class="col-xl-4 col-lg-6">
                                    <div class="card h-100">
                                        <div class="card-body p-5">
                                            <small class="text-warning">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </small>
                                            <h3 class="fs-4 my-3">Sturdy and Well-Made</h3>
                                            <p>The dining table exceeded my expectations. It’s solid, well-constructed,
                                                and looks elegant in
                                                my home. Assembly was straightforward too!</p>
                                            <p class="d-flex align-items-center gap-3">
                                                Sandip Chauhan
                                                <span class="small text-success d-flex align-items-center gap-1">
                                                    <svg width="18" height="18" viewBox="0 0 18 18"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.2"
                                                            d="M15.75 9C15.75 10.335 15.3541 11.6401 14.6124 12.7501C13.8707 13.8601 12.8165 14.7253 11.5831 15.2362C10.3497 15.7471 8.99252 15.8808 7.68314 15.6203C6.37377 15.3598 5.17104 14.717 4.22703 13.773C3.28303 12.829 2.64015 11.6262 2.3797 10.3169C2.11925 9.00749 2.25292 7.65029 2.76382 6.41689C3.27471 5.18349 4.13987 4.12928 5.2499 3.38758C6.35994 2.64588 7.66498 2.25 9 2.25C10.7902 2.25 12.5071 2.96116 13.773 4.22703C15.0388 5.4929 15.75 7.20979 15.75 9Z"
                                                            fill="#15803D" />
                                                        <path
                                                            d="M12.2105 6.91453C12.2628 6.96677 12.3043 7.02881 12.3326 7.0971C12.3609 7.16538 12.3754 7.23858 12.3754 7.3125C12.3754 7.38642 12.3609 7.45962 12.3326 7.5279C12.3043 7.59619 12.2628 7.65823 12.2105 7.71047L8.27297 11.648C8.22073 11.7003 8.15869 11.7418 8.09041 11.7701C8.02212 11.7984 7.94892 11.8129 7.875 11.8129C7.80108 11.8129 7.72789 11.7984 7.6596 11.7701C7.59131 11.7418 7.52928 11.7003 7.47703 11.648L5.78953 9.96047C5.68399 9.85492 5.62469 9.71177 5.62469 9.5625C5.62469 9.41323 5.68399 9.27008 5.78953 9.16453C5.89508 9.05898 6.03824 8.99969 6.1875 8.99969C6.33677 8.99969 6.47992 9.05898 6.58547 9.16453L7.875 10.4548L11.4145 6.91453C11.4668 6.86223 11.5288 6.82074 11.5971 6.79244C11.6654 6.76413 11.7386 6.74956 11.8125 6.74956C11.8864 6.74956 11.9596 6.76413 12.0279 6.79244C12.0962 6.82074 12.1582 6.86223 12.2105 6.91453ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                            fill="#15803D" />
                                                    </svg>
                                                    Verified
                                                </span>
                                            </p>
                                            <div class="d-flex flex-row gap-3 align-items-center">
                                                <span>Was this review helpful?</span>
                                                <div class="d-flex flex-row gap-2">
                                                    <a href="#!" class="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                            </path>
                                                        </svg>
                                                        1
                                                    </a>
                                                    <a href="#!" class="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-hand-thumbs-down" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                            </path>
                                                        </svg>
                                                        0
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6">
                                    <div class="card h-100">
                                        <div class="card-body p-5">
                                            <small class="text-warning">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </small>
                                            <h3 class="fs-4 my-3">Sturdy and Well-Made</h3>
                                            <p>The dining table exceeded my expectations. It’s solid, well-constructed,
                                                and looks elegant in
                                                my home. Assembly was straightforward too!</p>
                                            <p class="d-flex align-items-center gap-3">
                                                Sandip Chauhan
                                                <span class="small text-success d-flex align-items-center gap-1">
                                                    <svg width="18" height="18" viewBox="0 0 18 18"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.2"
                                                            d="M15.75 9C15.75 10.335 15.3541 11.6401 14.6124 12.7501C13.8707 13.8601 12.8165 14.7253 11.5831 15.2362C10.3497 15.7471 8.99252 15.8808 7.68314 15.6203C6.37377 15.3598 5.17104 14.717 4.22703 13.773C3.28303 12.829 2.64015 11.6262 2.3797 10.3169C2.11925 9.00749 2.25292 7.65029 2.76382 6.41689C3.27471 5.18349 4.13987 4.12928 5.2499 3.38758C6.35994 2.64588 7.66498 2.25 9 2.25C10.7902 2.25 12.5071 2.96116 13.773 4.22703C15.0388 5.4929 15.75 7.20979 15.75 9Z"
                                                            fill="#15803D" />
                                                        <path
                                                            d="M12.2105 6.91453C12.2628 6.96677 12.3043 7.02881 12.3326 7.0971C12.3609 7.16538 12.3754 7.23858 12.3754 7.3125C12.3754 7.38642 12.3609 7.45962 12.3326 7.5279C12.3043 7.59619 12.2628 7.65823 12.2105 7.71047L8.27297 11.648C8.22073 11.7003 8.15869 11.7418 8.09041 11.7701C8.02212 11.7984 7.94892 11.8129 7.875 11.8129C7.80108 11.8129 7.72789 11.7984 7.6596 11.7701C7.59131 11.7418 7.52928 11.7003 7.47703 11.648L5.78953 9.96047C5.68399 9.85492 5.62469 9.71177 5.62469 9.5625C5.62469 9.41323 5.68399 9.27008 5.78953 9.16453C5.89508 9.05898 6.03824 8.99969 6.1875 8.99969C6.33677 8.99969 6.47992 9.05898 6.58547 9.16453L7.875 10.4548L11.4145 6.91453C11.4668 6.86223 11.5288 6.82074 11.5971 6.79244C11.6654 6.76413 11.7386 6.74956 11.8125 6.74956C11.8864 6.74956 11.9596 6.76413 12.0279 6.79244C12.0962 6.82074 12.1582 6.86223 12.2105 6.91453ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                            fill="#15803D" />
                                                    </svg>
                                                    Verified
                                                </span>
                                            </p>
                                            <div class="d-flex flex-row gap-3 align-items-center">
                                                <span>Was this review helpful?</span>
                                                <div class="d-flex flex-row gap-2">
                                                    <a href="#!" class="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                            </path>
                                                        </svg>
                                                        1
                                                    </a>
                                                    <a href="#!" class="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-hand-thumbs-down" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                            </path>
                                                        </svg>
                                                        0
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6">
                                    <div class="card h-100">
                                        <div class="card-body p-5">
                                            <small class="text-warning">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </small>
                                            <h3 class="fs-4 my-3">Sturdy and Well-Made</h3>
                                            <p>The dining table exceeded my expectations. It’s solid, well-constructed,
                                                and looks elegant in
                                                my home. Assembly was straightforward too!</p>
                                            <p class="d-flex align-items-center gap-3">
                                                Sandip Chauhan
                                                <span class="small text-success d-flex align-items-center gap-1">
                                                    <svg width="18" height="18" viewBox="0 0 18 18"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.2"
                                                            d="M15.75 9C15.75 10.335 15.3541 11.6401 14.6124 12.7501C13.8707 13.8601 12.8165 14.7253 11.5831 15.2362C10.3497 15.7471 8.99252 15.8808 7.68314 15.6203C6.37377 15.3598 5.17104 14.717 4.22703 13.773C3.28303 12.829 2.64015 11.6262 2.3797 10.3169C2.11925 9.00749 2.25292 7.65029 2.76382 6.41689C3.27471 5.18349 4.13987 4.12928 5.2499 3.38758C6.35994 2.64588 7.66498 2.25 9 2.25C10.7902 2.25 12.5071 2.96116 13.773 4.22703C15.0388 5.4929 15.75 7.20979 15.75 9Z"
                                                            fill="#15803D" />
                                                        <path
                                                            d="M12.2105 6.91453C12.2628 6.96677 12.3043 7.02881 12.3326 7.0971C12.3609 7.16538 12.3754 7.23858 12.3754 7.3125C12.3754 7.38642 12.3609 7.45962 12.3326 7.5279C12.3043 7.59619 12.2628 7.65823 12.2105 7.71047L8.27297 11.648C8.22073 11.7003 8.15869 11.7418 8.09041 11.7701C8.02212 11.7984 7.94892 11.8129 7.875 11.8129C7.80108 11.8129 7.72789 11.7984 7.6596 11.7701C7.59131 11.7418 7.52928 11.7003 7.47703 11.648L5.78953 9.96047C5.68399 9.85492 5.62469 9.71177 5.62469 9.5625C5.62469 9.41323 5.68399 9.27008 5.78953 9.16453C5.89508 9.05898 6.03824 8.99969 6.1875 8.99969C6.33677 8.99969 6.47992 9.05898 6.58547 9.16453L7.875 10.4548L11.4145 6.91453C11.4668 6.86223 11.5288 6.82074 11.5971 6.79244C11.6654 6.76413 11.7386 6.74956 11.8125 6.74956C11.8864 6.74956 11.9596 6.76413 12.0279 6.79244C12.0962 6.82074 12.1582 6.86223 12.2105 6.91453ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                            fill="#15803D" />
                                                    </svg>
                                                    Verified
                                                </span>
                                            </p>
                                            <div class="d-flex flex-row gap-3 align-items-center">
                                                <span>Was this review helpful?</span>
                                                <div class="d-flex flex-row gap-2">
                                                    <a href="#!" class="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                            </path>
                                                        </svg>
                                                        1
                                                    </a>
                                                    <a href="#!" class="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-hand-thumbs-down" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                            </path>
                                                        </svg>
                                                        0
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="text-center">
                                    <a class="btn btn-outline-primary" id="toggleButton" data-bs-toggle="collapse"
                                        href="#collapseContent" aria-expanded="false" aria-controls="collapseContent">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                                            <path
                                                d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
                                        </svg>
                                        Load more Reviews
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Product tabs end-->
    <!--Product start-->
    <section class="pb-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--Heading-->
                    <div class="text-center mb-6">
                        <h2 class="mb-0">You me also like</h2>
                    </div>
                </div>
            </div>
            <div class="row gy-6 gx-4">
                <!--Product-->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class=" text-center product-card-img mb-4">
                            <a href="#!"><img src="{{ asset('assets/images/product/product-img-1.jpg') }}"
                                    alt="product image" class="img-fluid">
                                <img src="{{ asset('assets/images/product/product-img-hover-1.jpg') }}"
                                    alt="product image" class="img-fluid product-img-hover"></a>
                            <div class="product-card-btn">
                                <button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
                                    data-bs-toggle="modal" data-bs-target="#quickViewModal">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye animate-target" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-primary  btn-sm quick-add-btn"
                                    data-product-name="Sofa with wood legs" data-product-price="34.00"
                                    data-product-img="{{ asset('assets/images/product/product-img-1.jpg') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                    Quick add
                                </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-medium text-uppercase">BRAND</span>
                            <div class="d-flex gap-3 align-items-center">
                                <span class="">
                                    4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        fill="currentColor" class="bi bi-star-fill align-baseline text-warning"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span>
                                <button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-heart animate-target" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"> <a href="#!">Sofa
                                    with
                                    wood
                                    legs</a></h3>
                            <p class="mb-0 lh-1 text-dark fw-semibold">$34.00</p>
                        </div>

                        <div role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1">
                            <label class="btn-color-swatch bg-primary" for="btnradio1"></label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2">
                            <label class="btn-color-swatch bg-success" for="btnradio2"></label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" checked>
                            <label class="btn-color-swatch bg-danger" for="btnradio3"></label>
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio4">
                            <label class="btn-color-swatch bg-info" for="btnradio4"></label>
                        </div>
                    </div>
                </div>
                <!--Product-->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class="text-center mb-4 product-card-img">
                            <a href="#!">
                                <img src="{{ asset('assets/images/product/product-img-2.jpg') }}" alt="product image"
                                    class="img-fluid" />
                                <img src="{{ asset('assets/images/product/product-img-hover-2.jpg') }}"
                                    alt="product image" class="img-fluid product-img-hover" />
                            </a>
                            <div class="product-card-btn">
                                <button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
                                    data-bs-toggle="modal" data-bs-target="#quickViewModal">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye animate-target" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm quick-add-btn"
                                    data-product-name="Floor Lamp" data-product-price="95.00"
                                    data-product-img="{{ asset('assets/images/product/product-img-2.jpg') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                    Quick add
                                </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-medium text-uppercase">BRAND</span>
                            <div class="d-flex gap-3 align-items-center">
                                <span class="">
                                    4.2
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        fill="currentColor" class="bi bi-star-fill align-baseline text-warning"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span>
                                <button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-heart animate-target" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"><a href="#!">Floor
                                    Lamp</a></h3>
                            <p class="mb-0 lh-1 text-dark fw-semibold">$95.00</p>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" name="btnradio2" id="btnradio5" checked />
                            <label class="btn-color-swatch bg-primary" for="btnradio5"></label>

                            <input type="radio" class="btn-check" name="btnradio2" id="btnradio6" />
                            <label class="btn-color-swatch bg-success" for="btnradio6"></label>
                        </div>
                    </div>
                </div>
                <!--Product-->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class="text-center mb-4 product-card-img">
                            <a href="#!">
                                <img src="{{ asset('assets/images/product/product-img-3.jpg') }}" alt="product image"
                                    class="img-fluid" />
                                <img src="{{ asset('assets/images/product/product-img-hover-3.jpg') }}"
                                    alt="product image" class="img-fluid product-img-hover" />
                            </a>
                            <div class="product-card-btn">
                                <button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
                                    data-bs-toggle="modal" data-bs-target="#quickViewModal">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye animate-target" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-primary  btn-sm quick-add-btn"
                                    data-product-name="Comfort Seat Chair" data-product-price="78.00"
                                    data-product-img="{{ asset('assets/images/product/product-img-3.jpg') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                    Quick add
                                </button>
                            </div>
                            <div class="position-absolute top-0 p-2 px-3">
                                <span class="badge bg-info">New</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-medium text-uppercase">BRAND</span>
                            <div class="d-flex gap-3 align-items-center">
                                <span class="">
                                    4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        fill="currentColor" class="bi bi-star-fill align-baseline text-warning"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span>
                                <button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-heart animate-target" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"><a href="#!">Comfort
                                    Seat
                                    Chair</a></h3>
                            <p class="mb-0 lh-1 text-dark fw-semibold">$78.00</p>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" name="btnradio3" id="btnradio9" checked>
                            <label class="btn-color-swatch bg-primary" for="btnradio9"></label>
                        </div>
                    </div>
                </div>
                <!--Product-->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class="text-center mb-4 product-card-img">
                            <a href="#!"><img src="{{ asset('assets/images/product/product-img-4.jpg') }}"
                                    alt="product image" class="img-fluid" />
                                <img src="{{ asset('assets/images/product/product-img-hover-4.jpg') }}"
                                    alt="product image" class="img-fluid product-img-hover" /></a>
                            <div class="product-card-btn">
                                <button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
                                    data-bs-toggle="modal" data-bs-target="#quickViewModal">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye animate-target" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-primary  btn-sm quick-add-btn"
                                    data-product-name="Armchair" data-product-price="75.00"
                                    data-product-img="{{ asset('assets/images/product/product-img-4.jpg') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                    Quick add
                                </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-medium text-uppercase">BRAND</span>
                            <div class="d-flex gap-3 align-items-center">
                                <span class="">
                                    4.5
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        fill="currentColor" class="bi bi-star-fill align-baseline text-warning"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span>
                                <button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-heart animate-target" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"><a
                                    href="#!">Armchair</a>
                            </h3>
                            <p class="mb-0 lh-1 text-dark fw-semibold">
                                <span class="text-danger">$75.00</span>
                                <span class="text-decoration-line-through">$95.00</span>
                            </p>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" name="btnradio4" id="btnradio13" checked />
                            <label class="btn-color-swatch bg-primary" for="btnradio13"></label>

                            <input type="radio" class="btn-check" name="btnradio4" id="btnradio14" />
                            <label class="btn-color-swatch bg-success" for="btnradio14"></label>

                            <input type="radio" class="btn-check" name="btnradio4" id="btnradio16" />
                            <label class="btn-color-swatch bg-info" for="btnradio16"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('page-script')
    <script>
        function changeMainImage(src) {
            document.getElementById('mainProductImage').src = src;
        }
    </script>
@endpush
