@extends('layouts.app')

@section('content')

    <h1>Blog</h1>

    <div class="row row-cols-1 row-cols-lg-3 row-cols-xl-5">
        @foreach ($posts as $post)
            <x-post-card :post="$post"></x-post-card>
        @endforeach
    </div>
    
@endsection
