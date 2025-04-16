@extends('user.layouts.app')

@section('title', 'Seco Official PK')

@section('content')
    @include('user.partials.home.sliders')

    @include('user.partials.home.new-arrival')

    @include('user.partials.home.explore-collection')

    @include('user.partials.home.blog')

    @include('user.partials.home.features-bottom-bar')

@endsection
