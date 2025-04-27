@extends('user.layouts.app')

@section('title', $metaTitle ?? 'Shop Products')
@section('meta_description', $metaDescription ?? 'Browse our collection of products')

@push('page-style-bottom')
@endpush

@section('content')
    <!--Breadcrumb start-->
    <div class="container">
        <div class="row">
            <div class="col-12 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 fw-medium">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Shop</a></li>
                        @if ($category)
                            <li class="breadcrumb-item active" aria-current="page">{{ $category->title }}</li>
                        @endif
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!--Breadcrumb end-->

    <!--Filter button start-->
    <div class="position-fixed bottom-0 start-50 translate-middle d-block d-lg-none z-1">
        <a class="btn btn-dark d-flex align-items-center gap-2" data-bs-toggle="offcanvas" href="#offcanvasCategory"
            role="button" aria-controls="offcanvasCategory">
            @include('user.svgs.filter-svg')
            <span>Filter</span>
        </a>
    </div>
    <!--Filter button end-->

    <!-- Render the Livewire Component -->
    <livewire-products-filter />

@endsection

@push('page-script-bottom')
    <script src="{{ asset('user/js/quick-view.js') }}"></script>
@endpush
