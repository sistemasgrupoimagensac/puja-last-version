@extends('layouts.app')

@section('title')
    404 - NotFound
@endsection

@push('styles')
    @vite(['resources/css/404.css'])
@endpush


@section('content')
    <div class="error-container">
        <h1>404</h1>
        <p>Oops! La página que buscas no se encuentra.</p>
        <a href="{{ url('/') }}" class="btn btn-back">Ir a la página principal</a>
    </div>
    
    <script>
        document.querySelector('.btn-back').addEventListener('click', function() {
            window.location.href = '{{ url("/") }}';
        });
    </script>
@endsection
