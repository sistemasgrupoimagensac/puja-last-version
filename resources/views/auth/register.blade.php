@extends('layouts.app')

@section('title')
    Iniciar Sesión
@endsection

@push('styles')
  @vite(['resources/sass/pages/register.scss'])
@endpush

@section('content')

<section>

  {{--  body --}}
  <div class="row m-0 p-0">

    {{--  image --}}
    <div class="signin-image d-none d-md-block col m-0 px-5"></div>

    {{--  --}}
    <div class="register-form col my-4 m-md-0 px-md-5">
      <div class="register-form-content">

        {{-- register title --}}
        <div class="d-flex justify-content-between align-items-end mb-4">
          <div class="d-flex gap-3 align-items-center">

            <x-back-button></x-back-button>
            <h1 class="h5 fw-bold m-0">registro</h1>

          </div>
          <a href="/">
            <img src="{{ asset('images/svg/logo_puja.svg') }}" class="signin-puja-logo" alt="Logo Pujainmobiliaria">
          </a>
        </div>

        <form>
          @csrf
          <div class="d-flex flex-column gap-4">

            <fieldset class="d-flex flex-column gap-2">
              <legend class="h6 m-0 p-0">Datos de Sesión</legend>

              <div class="form-floating">
                <input type="email" class="form-control" id="email_register" name="email_register" placeholder="Correo electrónico" required>
                <label class="text-secondary" for="email_register">Correo electrónico</label>
              </div>
                
              <div class="form-floating">
                <input type="password" class="form-control" id="password_register" name="password_register" placeholder="Contraseña" aria-describedby="password_limits" required>
                <label class="text-secondary" for="password_register">Contraseña</label>
                <p class="form-text m-0 p-0" id="password_limits">Mínimo 6 y máximo 20 caracteres</p>
              </div>

              <div class="form-floating">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repetir Contraseña">
                <label class="text-secondary" for="password_confirmation">Repetir Contraseña</label>
              </div>

            </fieldset>

            <fieldset class="d-flex flex-column gap-2">
              <legend class="h6 m-0 p-0">Datos de Contacto</legend>

              <div class="form-floating">
                <input type="text" class="form-control" id="name_register" name="name_register" placeholder="Nombre" required>
                <label class="text-secondary" for="name_register" id="label_name_register">Nombre</label>
              </div>
                
              <div class="form-floating">
                <input type="text" class="form-control" id="surename_register" name="surename_register" placeholder="Apellido">
                <label class="text-secondary" for="surename_register">Apellido</label>
              </div>

              <div class="form-floating">
                <input type="phone" class="form-control" id="phone_register" name="phone_register" placeholder="Telefono">
                <label class="text-secondary" for="phone_register">Teléfono</label>
              </div>

              <div class="form-floating">
                <select class="form-select" id="document_register" name="document_register">
                  <option value="DNI" selected>DNI</option>
                  <option value="RUC">RUC</option>
                  <option value="OTRO_DOC">Otro Documento</option>
                </select>
                <label for="document_register">Documento</label>
              </div>

              <div class="form-floating">
                <input type="text" class="form-control" id="doc_number_register" name="doc_number_register" placeholder="DNI" required>
                <label class="text-secondary" for="doc_number_register" id="label_doc_number_register">DNI</label>
              </div>

            </fieldset>
  
            <small>
              <div class="form-group d-flex gap-3 align-items-center">
                <input type="checkbox" name="acepto_terminos_condiciones" id="terminos" class="form-check-input m-0" required/>
                <label for="terminos">Acepto los <a href="" class="custom-link-register text-decoration-none">Términos y Condiciones de Uso</a> y las <a href="" class="custom-link-register text-decoration-none">Políticas de Privacidad</a></label>
              </div>
    
              <div class="form-group d-flex gap-3 align-items-center">
                <input type="checkbox" name="acepto_confidencialidad" id="confidencialidad" class="form-check-input m-0" required/>
                <label for="confidencialidad">Autorizo el uso de mi información para <a href="" class="custom-link-register text-decoration-none">fines adicionales</a></label>
              </div>
            </small>
  
          <input class="btn button-orange w-100 fw-bold p-2" type="submit" id="submit-register-button" value="REGÍSTRATE">
          </div>
  
        </form>
        
      </div>
    </div>

  </div>

</section>

@endsection

@push('scripts')
  @vite([ 'resources/js/scripts/register.js' ])
@endpush
