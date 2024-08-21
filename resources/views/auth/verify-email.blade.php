@extends('layouts.app')

@section('header')
	@include('components.header_login')
@endsection

@section('content')
  <section class="mt-5">

    <div class="container mt-5">

      <div class=" text-center">
        <h1>Verificación de correo electrónico</h1>

        <p>¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que te acabamos de enviar? Si no recibiste el correo electrónico, con gusto te enviaremos otro</p>
      </div>

      <hr>

      <div class="d-flex flex-column align-items-center w-100 mt-5">
        <div style="max-width: 500px;" class="py-lg-5">

          <div>
            <form method="POST" action="{{ route('verification.send') }}">
              @csrf

              <button class="btn btn-secondary w-100" type="submit">Reenviar correo electrónico de verificación</button>
            </form>
          </div>

          <div class="mt-3">
            <form method="POST" action="{{ route('logout') }}">
              @csrf

              <button class="btn btn-danger w-100" type="submit">Cerrar sesión</button>
            </form>
          </div>

        </div>
      </div>

    </div>

  </section>
@endsection