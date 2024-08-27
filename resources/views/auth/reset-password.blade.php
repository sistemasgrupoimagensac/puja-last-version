@extends('layouts.app')

@section('title')
    Nueva contraseña
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
				<h1 class="h6 m-3">{{__("Nueva contraseña")}}</h1>
			</div>
			
			<form action="{{ route('auth.password.reset.update') }}" method="post" class="my-3">
				@csrf

				<div class="d-flex flex-column gap-3 input-group-lg">
					<input type="hidden" name="token" value="{{ old('token', $token) }}">
                    <input type="hidden" name="email" value="{{ old('email', $email) }}">
					
					<div class="form-floating">
						<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Nueva contraseña">
            			<label class="text-secondary" for="password">Nueva contraseña</label>
						@error('password')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="form-floating">
						<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirmar nueva contraseña">
            			<label class="text-secondary" for="password_confirmation">Confirmar nueva contraseña</label>
						@error('password_confirmation')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					
					<input class="btn button-orange w-100" type="submit" value="Enviar">
				</div>
				<div class="d-flex flex-column align-items-center mt-3 bg-opacity-10 rounded-3 py-2 w-100">
					<a href="{{ route("sign_in") }}" class="text-decoration-none fw-bold">Iniciar sesión</a>
				</div>

			</form>

		</div>
	</div>

@endsection
