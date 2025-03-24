@extends('layouts.app')

@section('title', 'Seco Official PK')

@section('content')
    @include('partials.home.sliders')

    @include('partials.home.new-arrival')

    @include('partials.home.explore-collection')

    @include('partials.home.blog')

    @include('partials.home.features-bottom-bar')

@endsection
