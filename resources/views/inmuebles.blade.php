@extends('layouts.app')

@section('title')
    Inmuebles
@endsection

@section('header')
  @include('components.header', ['tienePlanes' => $tienePlanes])
@endsection

@section('content')

  {{-- Sección de filtros --}}
  <section class="custom-container my-3">
    @include('components.filters')
  </section>

  {{-- Sección de cards de inmuebles --}}
  <section class="custom-container my-5">
    @foreach($avisos as $aviso)
    @include('components.card_inmueble', [
      'link' => route('inmueble.single', ['inmueble' => $aviso->link()]),
      'image' => $aviso->inmueble->imagenPrincipal(),
      'user' => $aviso->inmueble->user->nombres . ' ' . $aviso->inmueble->user->apellidos,
      'type' => $aviso->inmueble->type(),
      'category' => $aviso->inmueble->category(),
      'currency' => $aviso->inmueble->currencySoles(),
      'idCaracteristica' => $aviso->inmueble->idCaracteristica(),
      'isPuja' => $aviso->inmueble->is_puja() == 1 ? $aviso->inmueble->is_puja() : 0,
      'price' => $aviso->inmueble->precioSoles(),
      'currency_dolar' => $aviso->inmueble->currencyDolares(),
      'price_dolar' => $aviso->inmueble->precioDolares(),
      'address' => $aviso->inmueble->address(),
      'district' => $aviso->inmueble->distrito(),
      'department' => $aviso->inmueble->provincia(),
      'area' => $aviso->inmueble->area(),
      'bedrooms' => $aviso->inmueble->dormitorios(),
      'bathrooms' => $aviso->inmueble->banios(),
      'description' => $aviso->inmueble->description(),
      'like' => false,
    ])
  @endforeach
  </section>

@endsection

@section('footer')
  @include('components.footer')
@endsection

@push('scripts')
    @vite(['resources/js/scripts/inmuebles.js'])
@endpush