@extends('layouts.app')

@section('title')
    Blog
@endsection

@section('header')
    @include('components.header')
@endsection

@push('styles')
    @vite(['resources/sass/pages/blog.scss'])
@endpush

@section('content')

<div class="blog-titular position-relative">
    <div class="blog-titular-parallax"></div>
    <p class="position-absolute top-50 w-100 text-center text-white display-1 fw-bolder">Blog de Puja Inmobiliaria</p>
</div>

<div class="container">

    <div class="row justify-content-center row-cols-1 row-cols-lg-2 row-cols-xl-3 my-5">
        @foreach ($posts as $post)
            <x-post-card :post="$post"></x-post-card>
        @endforeach
    </div>
   
</div>


@endsection