@extends('layouts.app')

@section('title')
    Publica Tu Inmueble
@endsection

{{-- Estilos personalizados para esta página --}}
@push('styles')
    @vite(['resources/sass/pages/publica-inmueble.scss'])
@endpush

@section('header')
  @include('components.header')
@endsection

@section('content')

<h1 class="text-center h3 mt-5"> ¿Cómo deseas publicar? </h1>
<div class="container publica-container">
  <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center my-5 px-5 gap-3 w-100">

    <a href="/sign-in" class="card shadow-lg publica-card text-decoration-none text-reset border-0">
      <div class="card-body">

        <h2 class="card-title text-center fw-bold">Dueño</h2>
        <div>
          <img class="m-4" src="{{ asset('images/svg/owner.svg') }}" alt="logo dueño">
        </div>
      </div>
      <div class="card-footer p-0 m-0 bg-primary">
        <p> </p>
      </div>
    </a>

    <a href="/#" class="card shadow-lg publica-card text-decoration-none text-reset border-0">
      <div class="card-body">

        <h2 class="card-title text-center fw-bold">Corredor</h2>
        <div>
          <img class="m-4" src="{{ asset('images/svg/broker.svg') }}" alt="imagen contrato">
        </div>
      </div>
      <div class="card-footer p-0 m-0 bg-primary">
        <p> </p>
      </div>
    </a>

    <a href="/sign-in" class="card shadow-lg publica-card text-decoration-none text-reset border-0">
      <div class="card-body">

        <h2 class="card-title text-center fw-bold">Acreedor</h2>
        <div>
          <img class="m-4" src="{{ asset('images/svg/creditor.svg') }}" alt="imagen contrato">
        </div>
      </div>
      <div class="card-footer p-0 m-0 bg-primary">
        <p> </p>
      </div>
    </a>

    <a href="/#" class="card shadow-lg publica-card text-decoration-none text-reset border-0">
      <div class="card-body">

        <h2 class="card-title text-center fw-bold">Proyecto</h2>
        <div>
          <img class="m-4" src="{{ asset('images/svg/project.svg') }}" alt="logo constructora">
        </div>

      </div>
      <div class="card-footer p-0 m-0 bg-primary">
        <p> </p>
      </div>
    </a>
    
  </div>
</div>

@endsection

@section('footer')
  @include('components.footer')
@endsection

{{-- JS personalizado para esta página --}}
@push('scripts')
    
@endpush