@extends('layouts.app')

@section('title')
    Iniciar Sesión
@endsection

@push('styles')
  @vite(['resources/sass/pages/recover-password.scss'])
@endpush

@section('content')

<div class="restore-form col m-0 px-5">
  <div class="restore-form-content">

    <div class="d-flex flex-column align-items-center">
      <a href="/">
        <img src="{{ asset('images/svg/logo_puja.svg') }}" class="puja-logo" alt="Logo Pujainmobiliaria">
      </a>
      <h1 class="h6 m-3">Ingresa tu correo electrónico</h1>
    </div>
    
    <form action="{{ route('auth.forgot-password.send') }}" method="post" class="my-3">
      @csrf

      <div class="d-flex flex-column gap-3 input-group-lg">

        <div class="form-floating">
          <input type="email" class="form-control" id="email_recoveryEmail" name="email" placeholder="Telefono">
          <label class="text-secondary" for="email_recoveryEmail">Correo electrónico</label>
        </div>
        
        <input class="btn button-orange w-100" type="submit" value="Enviar">
      </div>
      <div class="d-flex flex-column align-items-center mt-3 bg-opacity-10 rounded-3 py-2 w-100">
          <a href="{{ route("sign_in") }}" class="text-decoration-none fw-bold">Iniciar sesión</a>
      </div>

    </form>

  </div>
</div>

@endsection
