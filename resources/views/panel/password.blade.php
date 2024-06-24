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
        <section id="" class="col px-5 pt-2">
            <h2>Cambiar contraseña</h2>

            <section class="my-3">
                <div class="row m-0 p-0">
                    <div class="col py-4 m-md-0">
                        <form action="" class="" id="form-perfil">
                            @csrf
                            <div class="d-flex flex-column gap-4">
                                <fieldset class="d-flex flex-column gap-2">
                                    <legend class="h6 m-0 p-0 fw-bold">Contraseña actual</legend>
                      
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="current_password_perfil" name="current_password_perfil" placeholder="Contraseña" aria-describedby="password_limits" required>
                                        <label class="text-secondary" for="current_password_perfil">Contraseña</label>
                                        <p class="form-text m-0 p-0" id="password_limits">Mínimo 6 y máximo 20 caracteres</p>
                                    </div>
                      
                                </fieldset>

                                <fieldset class="d-flex flex-column gap-2">
                                    <legend class="h6 m-0 p-0 fw-bold">Contraseña nueva</legend>
                      
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="new_password_perfil" name="new_password_perfil" placeholder="Contraseña nueva" aria-describedby="password_limits" required>
                                        <label class="text-secondary" for="new_password_perfil">Contraseña nueva</label>
                                        <p class="form-text m-0 p-0" id="password_limits">Mínimo 6 y máximo 20 caracteres</p>
                                    </div>
                        
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password_confirmation_perfil" name="password_confirmation_perfil" placeholder="Repetir Contraseña nueva">
                                        <label class="text-secondary" for="password_confirmation_perfil">Repetir Contraseña nueva</label>
                                    </div>
                      
                                </fieldset>

                                <input class="btn button-orange w-100 fw-bold p-2" type="submit" id="submit-guardar-password-button" value="GUARDAR CAMBIOS">
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </section>
    </div>
</main>
@endsection

@section('footer')
  @include('components.footer')
@endsection