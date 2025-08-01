@extends('layouts.app')

@section('title')
    Mi cuenta
@endsection

@push('styles')
  @vite(['resources/sass/pages/perfil.scss', 'resources/sass/components/flipping.scss'])
@endpush

@section('header')
    @include('components.header')
@endsection

@section('content')

<div id="loader-overlay">
    <div class="flipping"></div>
</div>

<main class="main-misavisos custom-container my-5">
    <div class="container-fluid p-0 d-flex">
        @if (Request::is('panel-proyecto/*'))
            @include('components.menu-panel-proyecto')
        @else
            @include('components.menu_panel')
        @endif
        <section class="col px-lg-5 pt-2">
            <h1>Mi cuenta</h1>

            <section class="my-3">
                <div class="row m-0 p-0">
                    <div class="col py-4 m-md-0">
                        <form method="post" action="{{ route('auth.edit-profile', ['id' => $user]) }}" class="form-perfil" id="form-editProfile">
                            @csrf
                            @method('PUT')
                            <div class="d-flex flex-column gap-4">
                                <fieldset class="d-flex flex-column gap-2">
                                    <legend class="h6 m-0 p-0 fw-bold">Datos personales</legend>
                                    
                                    {{-- Nombre --}}
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name-registro" name="nombre" placeholder="Nombre" value="{{ $user->nombres }}" required>
                                        <label class="text-secondary" for="name-registro" id="label_name">Nombre</label>
                                        <div id="validationServerNombreFeedback" class="invalid-feedback"></div>
                                    </div>
                                        
                                    {{-- Apellido --}}
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="lastname-registro" name="apellido" placeholder="Apellido" value="{{ $user->apellidos }}" required>
                                        <label class="text-secondary" for="lastname-registro">Apellido</label>
                                        <div id="validationServerApellidoFeedback" class="invalid-feedback"></div>
                                    </div>

                                    {{-- Dirección --}}
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="address-registro" name="direccion" placeholder="Dirección" value="{{ $user->direccion }}" required>
                                        <label class="text-secondary" for="address-registro">Dirección</label>
                                        <div id="validationServerDireccionFeedback" class="invalid-feedback"></div>
                                    </div>
                                                              
                                    {{-- Tipo de documento --}}
                                    <div class="form-floating">
                                        <select class="form-select" id="document_type" name="tipo_documento">
                                            <option value="1" {{ $user->tipo_documento_id == 1 ? 'selected' : '' }}>DNI</option>
                                            <option value="2" {{ $user->tipo_documento_id == 2 ? 'selected' : '' }}>RUC</option>
                                        </select>
                                        <label for="document_type">Documento</label>
                                        <div id="validationServerTipo_documentoFeedback" class="invalid-feedback"></div>
                                    </div>
                                    
                                    {{-- Número de documento --}}
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="document_number" minlength="8" maxlength="20" name="numero_de_documento" placeholder="DNI" value="{{ $user->numero_documento }}">
                                        <label class="text-secondary" for="document_number" id="label_document_number">DNI</label>
                                        <div id="validationServerNumero_de_documentoFeedback" class="invalid-feedback"></div>
                                    </div>
                        
                                </fieldset>

                                <fieldset class="d-flex flex-column gap-2">
                                    <legend class="h6 m-0 p-0 fw-bold">Datos de contacto</legend>
                      
                                    {{-- Email --}}
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email-registro" name="email" disabled placeholder="Correo electrónico" value="{{ $user->email }}" required>
                                        <label class="text-secondary" for="email-registro">Correo electrónico</label>
                                        <div id="validationServerEmailFeedback" class="invalid-feedback"></div>
                                    </div>

                                    {{-- Teléfono --}}
                                    <div class="form-floating">
                                        <input type="phone" class="form-control shadow-none" id="phone" maxlength="9" minlength="9" name="telefono" placeholder="Teléfono" value="{{ $user->celular }}" required>
                                        <label class="text-secondary" for="phone">Teléfono</label>
                                        <div id="validationServerTelefonoFeedback" class="invalid-feedback"></div>
                                    </div>
                                    
                                    <div class="form-floating">
                                        <input type="phone" class="form-control shadow-none" id="phone_contact" maxlength="9" minlength="9" name="phone_contact" placeholder="Teléfono para contactar" value="{{ $user->cel_contactar }}" required>
                                        <label class="text-secondary" for="phone_contact">Celular para contactos</label>
                                        <div id="validationServerCelContactoFeedback" class="invalid-feedback"></div>
                                    </div>
                      
                                </fieldset>

                                <input class="btn button-orange w-100 fw-bold p-2" type="submit" id="submit-editProfile" value="GUARDAR CAMBIOS">
                            </div>
                        </form>

                        {{-- Toast éxito --}}
                        <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
                            <div id="toastSuccess" class="toast text-bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-body text-center fs-5 py-lg-4" id="success-message"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </section>
    </div>
</main>

<script>
    const $loaderOverlay = document.getElementById('loader-overlay');

    document.getElementById('submit-editProfile').addEventListener('click', (event) => {
      event.preventDefault();
      clearErrors();
      submitForm();
    });
  
    function submitForm() {
        // spinner
        $loaderOverlay.style.display = 'flex';
        document.body.style.pointerEvents = 'none';
        let form = document.getElementById('form-editProfile');
  
        let bodyTipoDoc = ''
        const tipo = form.tipo_documento.value
        const documento = form.numero_de_documento.value
  
        if(tipo === '1') {
          bodyTipoDoc = 'dni'
        } else if (tipo === '2') {
          bodyTipoDoc = 'ruc'
        }
  
        fetch("/consulta-dni-ruc", {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ [bodyTipoDoc]: documento }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Response:', data)
                consultarFormulario();
  
            } else {
                console.log('Response error:', data)
                const errors = {
                  numero_de_documento: [data.message],
                }
                console.log(errors);
                
                handleErrors(errors)
            }
        })
        .catch(error => {
            console.error('Error:', error.message)
        })
		.finally(() => {
			$loaderOverlay.style.display = 'none';
			document.body.style.pointerEvents = 'auto';
		});
    }
  
    function consultarFormulario() {
        let form = document.getElementById('form-editProfile');
        let formData = new FormData(form);

        const url = "{{ route('auth.edit-profile', ['id' => $user]) }}"
  
      fetch( url, {
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
          },
          body: formData
      })
      .then(response => response.json())
      .then(data => {
          if (data.status == "Success") {
              document.getElementById('success-message').innerText = data.message;
              triggerToastSuccess()

              setTimeout(() => {
                location.reload()
              }, 3000);
          } else {
              handleErrors(data.errors);
          }
      })
      .catch(error => {
          console.error('Error:', error);
      });
    }
  
    function handleErrors(errors) {
      for (const field in errors) {
          
          const inputElement = document.querySelector(`[name="${field}"]`);
          const feedbackElement = document.getElementById(`validationServer${capitalizeFirstLetter(field)}Feedback`);
  
          console.log(inputElement);
          
  
          if (inputElement && feedbackElement) {
              inputElement.classList.add('is-invalid');
              if(inputElement.getAttribute('id') === 'terminos') {
                  feedbackElement.textContent = 'Acepte los términos';
              } else {
                  console.log(errors[field]);
                  
                  feedbackElement.textContent = errors[field][0];
              }
          }
      }
    }
  
    function clearErrors() {
      const inputElements = document.querySelectorAll('.is-invalid');
      inputElements.forEach(element => {
        element.classList.remove('is-invalid');
      });
  
      const feedbackElement = document.querySelectorAll('.invalid-feedback');
      feedbackElement.forEach(element => {
        element.textContent = '';
      });
    }
  
    function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }
  
    
</script>

@endsection

@section('footer')
  @include('components.footer')
@endsection

@push('scripts')
  @vite([ 'resources/js/scripts/updatePlaceholdersRegister.js', 'resources/js/scripts/toastySuccess.js' ])
@endpush

