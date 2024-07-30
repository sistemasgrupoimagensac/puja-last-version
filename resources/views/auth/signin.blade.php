@extends('layouts.app')

@section('title')
    Iniciar Sesión
@endsection

@push('styles')
    @vite(['resources/sass/pages/signin.scss'])
@endpush

@section('content')

<section>
  <style>
    .signin-image{
      background-image: url('{{ asset($imagen_path) }}');
    }
  </style>

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

        {{-- sigin form --}}
        <form method="POST" action="{{ route('login') }}" class="my-4">
          @csrf

          <div class="d-flex flex-column gap-3 input-group-lg">
			      <input type="hidden" name="user_type" value="{{ $profile_type }}">

            <div class="form-floating">
              <input type="email" class="form-control" id="signin_email" name="signin_email" placeholder="Telefono">
              <label class="text-secondary" for="signin_email">Correo electrónico</label>
            </div>

            <div class="form-floating">
              <input type="password" class="form-control" id="signin_password" name="signin_password" placeholder="Telefono">
              <label class="text-secondary" for="signin_password">Contraseña</label>
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
          <button data-bs-toggle="modal" data-bs-target="#user_type_confirmation" class="btn">
            <img src="{{ asset('images/google.png') }}" class="sigin-logo-google" alt="Logo log Google">
          </button>
        </div>

        <div class="modal fade" id="user_type_confirmation" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="alert alert-info m-0" role="alert">
                  <p class="m-0">Vas a registrarte como
                    @if ($profile_type === '2')
                      <span class="fw-bold">Propietario</span>
                      @elseif ($profile_type === '3')
                      <span class="fw-bold">Corredor</span>
                      @elseif ($profile_type === '4')
                      <span class="fw-bold">Acreedor</span>
                    @endif
                  ¿Es correcto?</p>
                </div>
              </div>
              <div class="modal-footer">
                <div class="w-100 d-flex justify-content-between gap-3">
                  <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">NO</button>
                  <a href="/google-auth/redirect?profile_type={{ $profile_type }}" type="button" class="btn button-orange w-100">SI</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex flex-column align-items-center mt-5 bg-secondary bg-opacity-10 rounded-3 py-2 w-100">
          <p class="">si no tienes una cuenta registrate aquí</p>
          {{-- @isset($profile_type)
            <a href="{{ route("login.register", ['profile_type' => $profile_type]) }}" class=" text-decoration-none fw-bold">REGISTRATE</a>
          @else
            <a href="{{ route("login.register", ['profile_type' => 2]) }}" class=" text-decoration-none fw-bold">REGISTRATE</a>
            @endisset --}}
            
          <a href="{{ route("login.register") }}" class=" text-decoration-none fw-bold">REGISTRATE</a>
              
        </div>
        
      </div>
    </div>

  </div>

</section>

@endsection