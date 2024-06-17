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
      <h1 class="h6 m-3">ingresa tu correo electrónico</h1>
    </div>
    
    <form action="#" class="my-3">
      @csrf

      <div class="d-flex flex-column gap-3 input-group-lg">

        <div class="form-floating">
          <input type="email" class="form-control" id="email_recoveryEmail" name="email_recoveryEmail" placeholder="Telefono">
          <label class="text-secondary" for="email_recoveryEmail">Correo electrónico</label>
        </div>
        
        <input class="btn button-orange w-100" type="submit" value="Enviar">
      </div>

    </form>

  </div>
</div>

@endsection
