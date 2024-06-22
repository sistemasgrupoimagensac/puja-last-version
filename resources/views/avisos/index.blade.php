@extends('layouts.app')

@section('title')
    Avisos
@endsection

@push('styles')
    @vite(['resources/sass/pages/inmueble.scss'])
@endpush

@section('header')
    @include('components.header')
@endsection

@section('content')
    <h1>Mis Avisos</h1>

    @if($avisos->isEmpty())
        <p>No tienes avisos.</p>
    @else
        <ul>
            @foreach($avisos as $aviso)
                <li>
                    <h2>User Id: {{ $userId }}</h2>
                    <p>Fecha de Publicacion: {{ $aviso->fecha_publicacion }}</p>
                    <p>Estado: {{ $aviso->estado }}</p>
                    <p>Codigo Unico del aviso: {{ $aviso->inm_cu }}</p>
                    <p>Estado del inmueble: {{ $aviso->inm_estado }}</p>
                </li>
            @endforeach
        </ul>
    @endif
@endsection

@section('footer')
  @include('components.footer')
@endsection

@push('scripts')
    @vite(['resources/js/scripts/inmueble.js'])
@endpush