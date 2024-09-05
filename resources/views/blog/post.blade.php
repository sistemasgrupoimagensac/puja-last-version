@extends('layouts.app')

@section('title')
    Blog
@endsection

@push('styles')
    @vite(['resources/sass/pages/post.scss'])
@endpush

@section('content')

<div class="post-titular">
  {{-- <img src="{{ asset('storage/' . $post->image) }}" class="post-titular-imagen" alt="Imagen del post"> --}}
  <div class="post-titular-imagen"></div>
  <style>
    .post-titular {
      .post-titular-imagen {
        background-image: linear-gradient(rgba(4, 19, 61, 0.712), rgba(158, 158, 158, 0.678)),url("{{ asset('storage/' . $post->image) }}");
      }
    }
  </style>
  <div class="mx-auto">
    <h1 class="post-titular-titulo display-4 fw-bold">{{ $post->title }}</h1>
  </div>
</div>

<div class="container my-5">

  <div class="d-flex justify-content-center">
    <div style="max-width: 50rem; text-align: justify;">
  
      <p><strong>Publicado: </strong> {{ $post->created_at->format('d M, Y') }}</p>
      {!! $post->content !!}
    </div>
  </div>

</div>

    
@endsection


{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
</head>
<body>
  @if ($post->image)
    <img src="{{ asset('storage/' . $post->image) }}" alt="Imagen del post">
  @endif
  <h1>{{ $post->title }}</h1>
  {!! $post->content !!}  <!-- Renderiza HTML -->
  <p><strong>Publicado: </strong> {{ $post->created_at->format('d M, Y') }}</p>
  
</body>
</html> --}}
