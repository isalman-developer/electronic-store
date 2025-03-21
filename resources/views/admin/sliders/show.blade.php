@extends('admin.layouts.app')

@section('title', 'Products List')
@section('toogle-button', 'Products List')

@section('content')
<!-- Start Container Fluid -->
<div class="container-xxl">
  
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
            <div class="text-center mb-4">
                <img src="{{ getSingleImageUrl($slider) }}" class="img-fluid rounded-3" alt="{{ $slider->title }}" style="max-height: 300px;">
            </div>
            <h2 class="text-center mb-3">{{ $slider->title }}</h2>
            <p class="text-muted text-center">{{ $slider->description }}</p>
            <div class="text-center mt-4">
                <a href="{{ $slider->redirect_url }}" class="btn btn-primary btn-lg">
                    Visit Page <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- End Container Fluid -->

@endsection
