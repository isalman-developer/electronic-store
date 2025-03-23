@extends('layouts.app')

@section('title', 'Seco Officiall PK')

@section('content')

    @include('partials.navbar')
    <!--Hero slider start-->
    @include('partials.home.sliders')
    <!--Hero slider end-->

    <!--New arrival start-->
    @include('partials.home.new-arrival')
    <!--New arrival end-->

    <!--Explore collection start-->
    @include('partials.home.explore-collection')
    <!--Explore collection end-->

    <!--Blog start-->
    @include('partials.home.blog')
    <!--Blog end-->

    <!--Feature start-->
    @include('partials.home.features-bottom-bar')
    <!--Feature end-->


@endsection
