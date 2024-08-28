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
                        <form method="post" action="{{ route('auth.edit-profile', ['id' => $user]) }}" class="form-perfil" id="form-editProfile">
                            @csrf
                            @method('PUT')
                            <div class="d-flex flex-column gap-4">
                                <fieldset class="d-flex flex-column gap-2">
                                    <legend class="h6 m-0 p-0 fw-bold">Datos personales</legend>
                      
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('name_perfil') is-invalid @enderror" id="name_perfil" name="name_perfil" placeholder="Nombre" required value="{{ old('name_perfil', $user->nombres) }}">
                                        <label class="text-secondary" for="name_perfil" id="label_name_perfil">Nombre</label>
                                        @error('name_perfil')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                      
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('surename_perfil') is-invalid @enderror" id="surename_perfil" name="surename_perfil" placeholder="Apellido" value="{{ old('surename_perfil', $user->apellidos) }}">
                                        <label class="text-secondary" for="surename_perfil">Apellido</label>
                                        @error('surename_perfil')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-floating">
                                        <select class="form-select @error('document_perfil') is-invalid @enderror" id="document_perfil" name="document_perfil">
                                            @foreach($tipos_documento as $tipo)
                                                <option value="{{ $tipo->id }}" {{ old('document_perfil', $user->tipo_documento_id) == $tipo->id ? 'selected' : '' }}>
                                                    {{ $tipo->documento }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="document_perfil">Documento</label>
                                        @error('document_perfil')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                        
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('doc_number_perfil') is-invalid @enderror" id="doc_number_perfil" name="doc_number_perfil" placeholder="{{ optional($user->tipoDocumento)->documento }}" required value="{{ old('doc_number_perfil', $user->numero_documento) }}">
                                        <label class="text-secondary" for="doc_number_perfil" id="label_doc_number_perfil">{{ optional($user->tipoDocumento)->documento }}</label>
                                        @error('doc_number_perfil')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </fieldset>

                                <fieldset class="d-flex flex-column gap-2">
                                    <legend class="h6 m-0 p-0 fw-bold">Datos de contacto</legend>
                      
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email_perfil" disabled placeholder="Correo electrónico" required value="{{ $user->email }}">
                                        <label class="text-secondary" for="email_perfil">Correo electrónico</label>
                                    </div>

                                    <div class="form-floating">
                                        <input type="phone" class="form-control @error('phone_perfil') is-invalid @enderror" id="phone_perfil" name="phone_perfil" placeholder="Telefono" value="{{ old('phone_perfil', $user->celular) }}">
                                        <label class="text-secondary" for="phone_perfil">Teléfono</label>
                                        @error('phone_perfil')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                      
                                </fieldset>

                                <input class="btn button-orange w-100 fw-bold p-2" type="submit" id="submit-editProfile" value="GUARDAR CAMBIOS">
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