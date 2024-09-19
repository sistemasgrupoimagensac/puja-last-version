@extends('layouts.app')

@section('title')
    Iniciar Sesión
@endsection

@push('styles')
  	@vite(['resources/sass/pages/register.scss'])
@endpush

@section('content')

	<div id="loader-overlay">
		<img src="{{ asset('images/loader.svg') }}" alt="Cargando...">
	</div>

	<section>
		{{--  body --}}
		<div class="row m-0 p-0">
			{{--  image --}}
			<div class="register-image d-none d-md-block col m-0 px-5"></div>

			{{-- register --}}
			<div class="register-form col py-4 m-md-0 px-md-5">
				<div class="register-form-content p-4">

					{{-- register title --}}
					<div class="d-flex justify-content-between align-items-end mb-4">
						<div class="d-flex gap-3 align-items-center">
							<x-back-button></x-back-button>
							<h1 class="h5 fw-bold m-0">Registro</h1>
						</div>
						<a href="/">
							<img src="{{ asset('images/svg/logo_puja.svg') }}" class="register-puja-logo" alt="Logo Pujainmobiliaria">
						</a>
					</div>

					<form id="formRegistro" x-data="{ userType: '' }">
						@csrf
						<div class="d-flex flex-column gap-4">

							<fieldset class="d-flex flex-column gap-2">
								<legend class="h6 m-0 p-0 icon-orange">Datos de Sesión</legend>

								<div class="form-floating">
									<select class="form-select" id="user_type" name="tipo_de_usuario" x-model="userType" required>
										<option value="" selected>Elegir tipo de perfil</option>
										@foreach ($user_types as $user_type)
											<option value="{{ $user_type->id }}">{{ $user_type->tipo }}</option>
										@endforeach
									</select>
									<label for="document_type">Perfil</label>
								</div>

								{{-- <input type="hidden" value="{{ $profile_type }}" name="user_type"> --}}
								<input type="hidden" value="CC-WW-12" name="unique_code">

								<div class="form-floating">
									<input type="email" class="form-control" id="email-registro" name="email" placeholder="Correo electrónico" x-bind:disabled="userType === ''" required>
									<label class="text-secondary" for="email-registro">Correo electrónico</label>
									<div id="validationServerEmailFeedback" class="invalid-feedback"></div>
								</div>
									
								<div class="form-floating">
									<input type="password" class="form-control" id="password-registro" name="contraseña" placeholder="Contraseña" minlength="6" maxlength="20" x-bind:disabled="userType === ''" required>
									<label class="text-secondary" for="password-registro">Contraseña</label>
									<p class="form-text m-0 p-0" id="password_limits">Mínimo 6 y máximo 20 caracteres</p>
									<div id="validationServerContraseñaFeedback" class="invalid-feedback"></div>
								</div>

							</fieldset>

							<fieldset class="d-flex flex-column gap-2" x-bind:disabled="userType === ''">
								<legend class="h6 m-0 p-0 icon-orange">Datos de Contacto</legend>

								<div class="form-floating">
									<input type="text" class="form-control" id="name-registro" name="nombre" placeholder="Nombre" required>
									<label class="text-secondary" for="name-registro" id="label_name">Nombre</label>
									<div id="validationServerNombreFeedback" class="invalid-feedback"></div>
								</div>
									
								<div class="form-floating">
									<input type="text" class="form-control" id="lastname-registro" name="apellido" placeholder="Apellido" required>
									<label class="text-secondary" for="lastname-registro">Apellido</label>
									<div id="validationServerApellidoFeedback" class="invalid-feedback"></div>
								</div>

								<div class="form-floating">
									<input type="tel" class="form-control" id="phone-registro" maxlength="9" minlength="9" name="telefono" placeholder="Telefono" required>
									<label class="text-secondary" for="phone-registro">Teléfono</label>
									<div id="validationServerTelefonoFeedback" class="invalid-feedback"></div>
								</div>

								<div class="form-floating">
									<input type="text" class="form-control" id="address-registro" name="direccion" placeholder="Dirección" required>
									<label class="text-secondary" for="address-registro">Dirección</label>
									<div id="validationServerDireccionFeedback" class="invalid-feedback"></div>
								</div>

								<div class="d-flex justify-content-between gap-2 w-100">
									<div class="form-floating col">
										<select class="form-select" id="document_type" name="tipo_documento" required>
											<option value="1" selected>DNI</option>
											<option value="3">RUC</option>
											<option value="2">CE</option>
											<option value="4">Otro Documento</option>
										</select>
										<label for="document_type">Documento</label>
									</div>
				
									<div class="form-floating col">
										<input type="text" class="form-control" id="document-number-registro" name="numero_de_documento" placeholder="DNI" required>
										<label class="text-secondary" for="document-number-registro" id="label_document_number">DNI</label>
										<div id="validationServerNumero_de_documentoFeedback" class="invalid-feedback"></div>
									</div>
								</div>
							</fieldset>
				
							<small>
								<div class="form-group d-flex gap-3 align-items-center">
									<input type="checkbox" name="terminos" id="terminos" class="form-check-input m-0" required/>
									<label for="terminos">Acepto los <a href="/terminos-uso" target="_blank" class="custom-link-register text-decoration-none">Términos y Condiciones de Uso</a> y las <a href="/politica-privacidad" target="_blank" class="custom-link-register text-decoration-none">Políticas de Privacidad</a></label>
									<div id="validationServerTerminosFeedback" class="invalid-feedback"></div>
								</div>
							</small>
				
							<input class="btn button-orange w-100 fw-bold p-2" type="submit" id="submit-register-button" value="REGÍSTRATE">
						</div>
					</form>
				
				</div>
			</div>
		</div>
	</section>

	<script>
  		const $loaderOverlay = document.getElementById('loader-overlay');

		document.getElementById('submit-register-button').addEventListener('click', (event) => {
			event.preventDefault();
  			$loaderOverlay.style.display = 'flex';
			document.body.style.pointerEvents = 'none';
			clearErrors();
			submitForm();
		});

		function submitForm() {
			let form = document.getElementById('formRegistro');
			let bodyTipoDoc = '';
			const tipo = form.tipo_documento.value;
			const documento = form.numero_de_documento.value;

			// Identificar el tipo de documento (dni, ruc, ce, etc.)
			switch (tipo) {
					case '1': // DNI
						bodyTipoDoc = 'dni';
						break;
					case '3': // RUC
						bodyTipoDoc = 'ruc';
						break;
					case '2': // CE
					case '4': // Otro Documento
						// No se realiza la consulta a la API, se procede al registro directamente
						consultarFormulario();
						return; // Salir de la función para evitar la llamada a la API
					default:
						console.error('Tipo de documento no válido.');
						return;
			}

			// Realizar la consulta a la API solo para DNI o RUC
			fetch("/consulta-dni-ruc", {
				method: 'POST',
				headers: {
					'Accept': 'application/json',
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({ [bodyTipoDoc]: documento }),
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					console.log('Response:', data);
					// Si la consulta es exitosa, procede a registrar al usuario
					consultarFormulario();
				} else {
					const errors = {
							numero_de_documento: [data.message],
					};
					handleErrors(errors);
				}
			})
			.catch(error => {
				console.error('Error:', error.message);
			})
			.finally(() => {
				$loaderOverlay.style.display = 'none';
				document.body.style.pointerEvents = 'auto';
			});
		}

		function consultarFormulario() {
			let form = document.getElementById('formRegistro');
			let formData = new FormData(form);
			document.getElementById('submit-register-button').disabled = true;

			fetch('/store', {
				method: 'POST',
				headers: {
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
				},
				body: formData
			})
			.then(response => {
				// Si la respuesta es una redirección (registro exitoso)
				if (response.redirected) {
					window.location.href = response.url;
					return;
				} 
				// Si la respuesta tiene errores de validación (HTTP 422)
				else if (!response.ok) {
					document.getElementById('submit-register-button').disabled = false;
					return response.json().then(data => {
						if (data.errors) {
								handleErrors(data.errors);
						} else {
								console.error('Unexpected response:', data);
						}
					});
				}

				// Si la respuesta es JSON y está OK, manejarlo
				return response.json();
			})

			.catch(error => {
				console.error('Error:', error.message);
			})
			.finally(() => {
				$loaderOverlay.style.display = 'none';
				document.body.style.pointerEvents = 'auto';
			});
		}

		function handleErrors(errors) {
			for (const field in errors) {
				const inputElement = document.querySelector(`[name="${field}"]`);
				const feedbackElement = document.getElementById(`validationServer${capitalizeFirstLetter(field)}Feedback`);

				if (inputElement && feedbackElement) {
					inputElement.classList.add('is-invalid');
					feedbackElement.textContent = (inputElement.getAttribute('id') === 'terminos')
						? 'Acepte los términos'
						: errors[field][0];
				} else {
					console.warn(`Elementos para ${field} no encontrados.`);
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

@push('scripts')
  	@vite([ 'resources/js/scripts/register.js' ])
@endpush
