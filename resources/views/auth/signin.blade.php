@extends('layouts.app')

@section('title')
    Iniciar Sesión
@endsection

@push('styles')
    @vite(['resources/sass/pages/signin.scss'])
@endpush

@section('content')

<section>

  {{-- signin body --}}
  <div class="row m-0 p-0">

    {{-- signin image --}}
    <div class="signin-image d-none d-md-block col m-0 px-5"></div>

    {{-- sigin --}}
    <div class="signin-form col m-0 px-5">
      <div class="signin-form-content">

        {{-- signin title --}}
        <div class="d-flex justify-content-between align-items-end">
          <div class="d-flex gap-3 align-items-center">

            <x-back-button></x-back-button>
            <h1 class="h5 fw-bold m-0">inicia sesión</h1>
  
          </div>
          <a href="/">
            <img src="{{ asset('images/svg/logo_puja.svg') }}" class="signin-puja-logo" alt="Logo Pujainmobiliaria">
          </a>
        </div>
        
        {{-- signin form --}}
        <form action="#" class="my-3">
          @csrf

          <div class="d-flex flex-column gap-3 input-group-lg">

            <div class="form-floating">
              <input type="email" class="form-control" id="signin_email" name="signin_email" placeholder="Telefono">
              <label class="text-secondary" for="signin_email">Correo electrónico</label>
            </div>

            <div class="form-floating">
              <input type="password" class="form-control" id="signin_password" name="signin_password" placeholder="Telefono">
              <label class="text-secondary" for="signin_password">Contraseña</label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember">
              <label class="form-check-label text-secondary" for="remember">
                Recuerdame
              </label>
            </div>
            <input class="btn button-orange w-100" type="submit" value="Ingresar">
          </div>

        </form>

        <div class="w-100 text-center">
          <a href="/recuperar-password" class="signin-recuperar-password">¿Has olvidado tu contraseña?</a>
        </div>

        {{-- signin google --}}
        <div class="hr-container mt-5 mb-3">
          <hr size="10">
          <span> O ingresa con </span>
        </div>

        <div class="w-100 text-center">
          <a href="#" class="">
            <img src="{{ asset('images/google.png') }}" class="sigin-logo-google" alt="Logo log Google">
          </a>
        </div>

        <div class="d-flex flex-column align-items-center mt-5 bg-secondary bg-opacity-10 rounded-3 py-2 w-100">
          <p class="">si no tienes una cuenta registrate aquí</p>
          <a href="/register" class=" text-decoration-none fw-bold">REGISTRATE</a>
        </div>
        
      </div>
    </div>

  </div>

</section>

@endsection