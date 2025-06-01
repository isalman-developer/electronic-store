@extends('admin.layouts.app')

@section('title', 'Setting Details')
@section('toogle-button', 'Setting Details')
@section('content')
    <!-- Start Container Fluid -->
    <div class="container-xxl">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center gap-1">
                        <h4 class="card-title flex-grow-1">Setting Details</h4>

                        <a href="{{ route('admin.settings.edit') }}" class="btn btn-sm btn-primary">
                            Edit Setting
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5>Key</h5>
                                    <p>{{ $setting->key }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5>Value</h5>
                                    <p>{{ $setting->value }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Container Fluid -->
@endsection
