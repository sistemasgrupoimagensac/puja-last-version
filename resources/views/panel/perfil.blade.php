@extends('layouts.app')

@section('title')
    Mi cuenta
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
            <h1>Mi cuenta</h1>

            <section class="my-3">
                <div class="row m-0 p-0">
                    <div class="col py-4 m-md-0">
                        <form action="" class="" id="form-perfil">
                            @csrf
                            <div class="d-flex flex-column gap-4">
                                <fieldset class="d-flex flex-column gap-2">
                                    <legend class="h6 m-0 p-0 fw-bold">Datos personales</legend>
                      
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name_perfil" name="name_perfil" placeholder="Nombre" required value="{{ $user->nombres }}">
                                        <label class="text-secondary" for="name_perfil" id="label_name_perfil">Nombre</label>
                                    </div>
                                      
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="surename_perfil" name="surename_perfil" placeholder="Apellido" value="{{ $user->apellidos }}">
                                        <label class="text-secondary" for="surename_perfil">Apellido</label>
                                    </div>
                      
                                    <div class="form-floating">
                                        <select class="form-select" id="document_perfil" name="document_perfil">
                                            @foreach($tipos_documento as $tipo)
                                            <option value="{{ $tipo->id }}" @if($tipo->id === $user->tipo_documento_id) selected @endif>{{ $tipo->documento }}</option>
                                            @endforeach
                                        </select>
                                        <label for="document_perfil">Documento</label>
                                    </div>
                        
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="doc_number_perfil" name="doc_number_perfil" placeholder="{{ optional($user->tipoDocumento)->documento }}" required value="{{ $user->numero_documento }}">
                                        <label class="text-secondary" for="doc_number_perfil" id="label_doc_number_perfil">{{ optional($user->tipoDocumento)->documento }}</label>
                                    </div>
                      
                                </fieldset>

                                <fieldset class="d-flex flex-column gap-2">
                                    <legend class="h6 m-0 p-0 fw-bold">Datos de contacto</legend>
                      
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email_perfil" name="email_perfil" placeholder="Correo electrónico" required value="{{ $user->email }}">
                                        <label class="text-secondary" for="email_perfil">Correo electrónico</label>
                                    </div>

                                    <div class="form-floating">
                                        <input type="phone" class="form-control" id="phone_perfil" name="phone_perfil" placeholder="Telefono" value="{{ $user->celular }}">
                                        <label class="text-secondary" for="phone_perfil">Teléfono</label>
                                    </div>
                      
                                </fieldset>

                                <input class="btn button-orange w-100 fw-bold p-2" type="submit" id="submit-guardar-perfil-button" value="GUARDAR CAMBIOS">
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </section>
    </div>
</main>
@endsection

@push('scripts')
  @vite([ 'resources/js/scripts/perfil.js' ])
@endpush

@section('footer')
  @include('components.footer')
@endsection