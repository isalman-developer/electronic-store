@extends('admin.layouts.app')

@section('title', "Edit Settings")
@section('toogle-button', 'Edit Settings')
@section('content')
    <!-- Start Container Fluid -->
    <div class="container-xxl">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Site Settings</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($settings as $setting)
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="{{ $setting->key }}" class="form-label">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</label>
                                        <input type="text" id="{{ $setting->key }}" class="form-control"
                                            name="{{ $setting->key }}" value="{{ $setting->value }}">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="p-3 bg-light mb-3 rounded">
                                <div class="row justify-content-end g-2">
                                    <div class="col-lg-auto">
                                        <a href="{{ route('admin.settings.index') }}" class="btn btn-primary">Cancel</a>
                                    </div>
                                    <div class="col-lg-auto">
                                        <button type="submit" class="btn btn-outline-secondary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- End Container Fluid -->
@endsection
