@extends('client.main')
@section('content')
    <!-- Slider -->
    @include('client.slider')
    @include('client.countdown')
    <!-- Banner -->
    @include('client.banner')
    @include('client.home_slide_product')
    @include('client.home_blog')
@endsection
