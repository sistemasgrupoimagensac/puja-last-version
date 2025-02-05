@extends('layouts.app')

@section('title')
    Blog
@endsection

@push('styles')
    @vite(['resources/sass/pages/post.scss'])
@endpush

@section('header')
	@include('components.header')
@endsection

@section('content')

<div class="post-titular position-relative">
	<div class="post-titular-imagen">
		<img src="{{ asset('storage/' . $post->image) }}" class="post-titular-imagen" alt="Imagen del post">
	</div>
	<div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center">
		<div class="container">
			<h1 class="post-titular-titulo display-4 fw-bold">{{ $post->title }}</h1>
		</div>
	</div>
</div>

<div class="container my-5">

	<div class="d-flex justify-content-center">
		<div style="max-width: 50rem; text-align: justify;">
			<p><strong>Publicado: </strong> {{ $post->created_at->format('d M, Y') }}</p>
			<div class="post-content">
				{!! $post->content !!}
			</div>
		</div>
	</div>

</div>

@endsection