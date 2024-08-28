@extends('layouts.app')

@section('title')
    Cambiar password
@endsection

@push('styles')
  @vite(['resources/sass/pages/perfil.scss'])
@endpush

@section('header')
    @include('components.header')
@endsection

@section('content')
    <main id="main-misavisos" class="custom-container mt-3">
        <div class="container-fluid p-0 d-flex">
            @include('components.menu_panel')
            <section class="col px-lg-5 pt-2">
                <h2>Cambiar contraseña</h2>

                <section class="my-3">
                    <div class="row m-0 p-0">
                        <div class="col py-4 m-md-0">
                            <form method="POST" action="{{ route('auth.edit-password', ['id' => $user_id]) }}" class="form-perfil" id="form-changePassword">
                                @csrf
                                @method('PUT')
                                <div class="d-flex flex-column gap-4">
                                    <fieldset class="d-flex flex-column gap-2">
                                        <legend class="h6 m-0 p-0 fw-bold">Contraseña actual</legend>
                                        <div class="form-floating">
                                            <input type="password"
                                                class="form-control @error('current_password') is-invalid @enderror"
                                                id="current_password"
                                                name="current_password"
                                                placeholder="Contraseña"
                                                aria-describedby="password_limits"
                                                required
                                            >
                                            <label class="text-secondary" for="current_password">Contraseña</label>
                                            @error('current_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </fieldset>
                                    <fieldset class="d-flex flex-column gap-2">
                                        <legend class="h6 m-0 p-0 fw-bold">Contraseña nueva</legend>
                                        <div class="form-floating">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password"
                                                name="password"
                                                placeholder="Contraseña nueva"
                                                aria-describedby="password_limits"
                                                required
                                            >
                                            <label class="text-secondary" for="password">Contraseña nueva</label>
                                            <p class="form-text m-0 p-0" id="password_limits">Mínimo 6 y máximo 20 caracteres</p>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-floating">
                                            <input type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                id="password_confirmation"
                                                name="password_confirmation"
                                                placeholder="Repetir Contraseña nueva"
                                            >
                                            <label class="text-secondary" for="password_confirmation">Repetir Contraseña nueva</label>
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </fieldset>
                                    <input class="btn button-orange w-100 fw-bold p-2" type="submit" id="submit-editPassword" value="GUARDAR CAMBIOS">
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </section>
        </div>
    </main>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const $formEditPassword = document.getElementById("form-changePassword")
    const $submitEditPassword = document.getElementById("submit-editPassword")

    $formEditPassword.addEventListener('submit', () => {
        $submitEditPassword.disabled = true
        $submitEditPassword.value = 'Guardando...'
    })
})
</script>

@section('footer')
  @include('components.footer')
@endsection