@extends('layouts.app')

@section('title')
    Contacto
@endsection

@push('styles')
  	@vite([ 'resources/sass/pages/contacto.scss' ])
@endpush

@section('header')
	@include('components.header_login')
@endsection

@section('content')

	<div class="container d-flex flex-column align-items-center my-3 my-lg-5">
		<div class="p-3 p-lg-4 pt-5 shadow-lg rounded">
			<h1 class="text-center">Puedes contar con nosotros</h1>
			<h4 class="text-secondary text-center">Completa el formulario y resolveremos tus consultas</h4>
			
			<form method="POST" id="page-contact-formData">
				@csrf
			
				<div class="d-flex flex-column gap-3 mt-4">
			
					<div class="form-floating">
						<input type="text" class="form-control shadow-none" id="page-contact-name" name="nombre" placeholder="Nombre Completo" required>
						<label class="text-secondary" for="page-contact-name">Nombre Completo*</label>
						<div id="validationServerNombreFeedback" class="invalid-feedback"></div>
					</div>
				
					<div class="form-floating">
						<input type="email" class="form-control shadow-none" id="page-contact-email" name="correo" placeholder="Correo electrónico" required>
						<label class="text-secondary" for="page-contact-email">Correo Electrónico*</label>
						<div id="validationServerCorreoFeedback" class="invalid-feedback"></div>
					</div>
				
					<div class="form-floating">
						<input type="phone" class="form-control shadow-none" id="page-contact-phone" maxlength="9" minlength="9" name="telefono" placeholder="Teléfono" required>
						<label class="text-secondary" for="page-contact-phone">Teléfono*</label>
						<div id="validationServerTelefonoFeedback" class="invalid-feedback"></div>
					</div>
				
					<div class="form-floating">
						<select class="form-select shadow-none" id="page-contact-issue" name="consulta">
							<option value="1_publicar_inmueble" selected>Publicar tu inmueble</option>
							<option value="2_soporte">Soporte sobre el uso del servicio</option>
							<option value="3_sugerencia">Sugerencias y comentarios</option>
							<option value="4_problema">Reportar un problema</option>
							<option value="5_otro">Otro</option>
						</select>
						<label for="floatingSelect">Tipo de Consulta</label>
						<div id="validationServerAsuntoFeedback" class="invalid-feedback"></div>
					</div>
				
					<div class="form-floating">
						<textarea class="form-control shadow-none" placeholder="Contactame" id="page-contact-message" name="mensaje" maxlength="2000"></textarea>
						<label for="page-contact-message" class="text-secondary">Mensaje*</label>
						<div id="validationServerMensajeFeedback" class="invalid-feedback"></div>
					</div>
				
					<button class="btn button-orange" id="send-page-contact">
						<i class="fa-regular fa-paper-plane"></i> Enviar
					</button>
				
					<small class="text-body-tertiary py-1">Al hacer clic en Enviar, estás aceptando nuestra 
						<a href="/politica-privacidad" target="blank" class="text-decoration-none">Política de Privacidad</a>
					</small>
			
				</div>
			
			</form>
		</div>
	</div>

	<script>
		const contactoUrl = "{{ route('post.contacto') }}";
	</script>

@endsection

@section('footer')
    <x-footer></x-footer>
@endsection

@push('scripts')
  	@vite([ 'resources/js/scripts/contacto.js' ])
@endpush