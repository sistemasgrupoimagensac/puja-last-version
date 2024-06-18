@extends('layouts.app')

@section('title')
    Iniciar Sesión
@endsection

@push('styles')
    @vite(['resources/sass/pages/signin.scss'])
@endpush

@section('content')

<section>

  <div class="row m-0 p-0">

    {{-- imagen sign in --}}
    <div class="d-none d-md-block col signin-image m-0 px-5"></div>

    {{-- form de sig in --}}
    <div class="col signin-form m-0 px-5">
      <div class="signin-form-content">

        <div>
          <img src="" alt="">
          <h1 class="h3">inicia sesión</h1>
        </div>
  
  
        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="d-flex flex-column gap-4 input-group-lg">
            <input class="form-control input-signin bg-light" type="email" name="signin_email" id="signin_email" placeholder="Correo electrónico">
            <input class="form-control input-signin bg-light" type="password" name="signin_password" id="signin_password" placeholder="Contraseña">
            <input class="btn button-orange w-100" type="submit" value="Ingresar">
          </div>

        </form>
        {{-- <input class="btn button-orange w-100" type="submit" value="Ingresar"> --}}
        <a class="btn button-orange w-100 mt-2" href="/google-auth/redirect">SSO GOOGLE</a>


      </div>
    </div>

  </div>

  <div class="footer-container d-flex align-items-center justify-content-between px-3 px-md-5">

    <div class="">
      <small class="">
        &#169 <span id="currentYear"></span>
        <a class="footer-link-puja" href="https://grupoimagensac.com.pe/" target="blank"> Grupo Inmobiliario Imagen SAC </a>
      </small>
    </div>

    <div>
      <a class="text-decoration-none" target="blank" href="https://www.facebook.com/pujainmobiliaria">
        <i class=" fa-brands fa-facebook-f img-fluid text-center icon m-auto p-2 icon-white"></i>
      </a>
      <a class="text-decoration-none" target="blank" href="https://www.instagram.com/pujainmobiliaria/">
        <i class="fa-brands fa-instagram text-center icon m-auto p-2 icon-white"></i>
      </a>
      
    </div>


  </div>

</section>

@endsection