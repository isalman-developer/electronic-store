@extends('user.layouts.app')

@section('title', 'Seco Official PK')

@section('content')
    @include('user.home.partials.sliders')

    @include('user.home.partials.new-arrival')

    @include('user.home.partials.explore-collection')

    @include('user.home.partials.blog')

    @include('user.home.partials.features-bottom-bar')

@endsection
