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
        <form id="formSignin" class="my-4">
          @csrf

          <div class="d-flex flex-column gap-3 input-group-lg">
			      <input type="hidden" name="user_type" value="{{ $profile_type }}">

            <div class="form-floating">
              <input type="email" class="form-control" id="signin_email" name="correo" placeholder="Correo electrónico">
              <label class="text-secondary" for="signin_email">Correo electrónico</label>
							<div id="validationServerCorreoFeedback" class="invalid-feedback"></div>
            </div>

            <div class="form-floating">
              <input type="password" class="form-control" id="signin_password" name="contraseña" placeholder="Contraseña">
              <label class="text-secondary" for="signin_password">Contraseña</label>
							<div id="validationServerContraseñaFeedback" class="invalid-feedback"></div>
            </div>

            <input class="btn button-orange w-100" type="submit" id="submit-signin-button" value="Ingresar">
          </div>

        </form>

        {{-- recuperar contraseña link --}}
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
              <div class="modal-body p-2 p-md-3">
                <div class="alert alert-info m-0 p-2 p-md-3" role="alert">
                  <p class="m-0">Vas a ingresar como
                    @if ($profile_type === '2')
                      <span class="fw-bold">Propietario</span>
                    @elseif ($profile_type === '3')
                      <span class="fw-bold">Corredor</span>
                    @elseif ($profile_type === '4')
                      <span class="fw-bold">Acreedor</span>
                    @endif
                  ¿Es correcto?</p>
                </div>
                <div class="mt-3 mt-md-1">
                  <small class="p-2 p-md-3"> <span class="fw-bold">Nota:</span> si ya tienes una cuenta se te redirigirá a tu perfil</small>
                </div>
              </div>
              <div class="modal-footer p-2 p-md-3">
                <div class="w-100 d-flex justify-content-between m-0 gap-3">
                  <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">NO</button>
                  <a href="/google-auth/redirect?profile_type={{ $profile_type }}" type="button" class="btn button-orange w-100">SI</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex flex-column align-items-center mt-5 bg-secondary bg-opacity-10 rounded-3 py-2 w-100">
          <p class="">si no tienes una cuenta registrate aquí</p>
          <a href="{{ route("login.register") }}" class=" text-decoration-none fw-bold">REGISTRATE</a>
        </div>
        
      </div>
    </div>

  </div>

</section>

<script>
  document.getElementById('submit-signin-button').addEventListener('click', (event) => {
    event.preventDefault();
    clearErrors();
    consultarFormulario();
  });

  function consultarFormulario() {
      let form = document.getElementById('formSignin');
      let formData = new FormData(form);

      fetch("{{ route('login') }}", {
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
          body: formData
      })
      .then(response => {
          if (!response.ok) {
              // Si la respuesta no es exitosa, es probable que haya errores de validación
              return response.json().then(data => {
                  handleErrors(data.errors);
                  throw new Error(data.message || 'Error al iniciar sesión');
              });
          }
          return response.json();
      })
      .then(data => {
          if (data.redirect) {
              // Si hay una redirección, navegar a la URL proporcionada
              window.location.href = data.redirect;
          } else {
              console.log(data.message || 'Inicio de sesión exitoso');
          }
      })
      .catch(error => {
          console.error('Error:', error.message);
      });
  }

  function handleErrors(errors) {
      if (!errors) return; // Manejar caso donde errors sea undefined o null

      for (const field in errors) {
          const inputElement = document.querySelector(`[name="${field}"]`);
          const feedbackElement = document.getElementById(`validationServer${capitalizeFirstLetter(field)}Feedback`);

          if (inputElement && feedbackElement) {
              inputElement.classList.add('is-invalid');
              feedbackElement.textContent = errors[field][0];
          }
      }
  }

  function clearErrors() {
      const inputElements = document.querySelectorAll('.is-invalid');
      inputElements.forEach(element => {
          element.classList.remove('is-invalid');
      });

      const feedbackElements = document.querySelectorAll('.invalid-feedback');
      feedbackElements.forEach(element => {
          element.textContent = '';
      });
  }

  function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
  }

</script>

@endsection