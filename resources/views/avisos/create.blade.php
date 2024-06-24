@extends('layouts.app')

@section('title')
    Avisos
@endsection

@push('styles')
    @vite(['resources/sass/pages/inmueble.scss'])
@endpush

@section('header')
    @include('components.header')
@endsection

    <form action="/my-post/store" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="principal" value="0">
        <input type="hidden" name="ubicacion" value="0">
        <input type="hidden" name="caracteristicas" value="0">
        <input type="hidden" name="multimedia" value="1">
        <input type="hidden" name="extras" value="0">

        <input type="number" name="tipo_operacion_id">
        <input type="number" name="tipo_inmueble_id">
        <input type="number" name="subtipo_inmueble_id">
        
        <input type="text" name="direccion">
        <input type="number" name="departamento_id" value="1">
        <input type="number" name="provincia_id" value="101">
        <input type="number" name="distrito_id" value="10101">
        <input type="text" name="latitud">
        <input type="text" name="longitud">
        
        <input type="number" name="habitaciones" value="1">
        <input type="number" name="banios" value="1">
        <input type="number" name="medio_banios" value="1">
        <input type="number" name="estacionamientos" value="2">
        <input type="number" name="area_construida" value="200">
        <input type="number" name="area_total" value="1000">
        <input type="number" name="antiguedad" value="10">
        <input type="number" name="anios_antiguedad" value="8">
        <input type="number" name="precio_soles" value="555">
        <input type="number" name="precio_dolares" value="666">
        <input type="text" name="titulo" value="Terreno de Oscar Soporte">
        <input type="text" name="descripcion" value="El senor padece de mariCron">

        <br>
        <label for="imagen_principal">Seleccionar imagen principal:</label>
        <input type="file" id="imagen_principal" name="imagen_principal" accept="image/jpeg,image/png,image/jpg">
        <br>
        <label for="imagen">Seleccionar imágenes:</label>
        <input type="file" id="imagen" name="imagen[]" accept="image/jpeg,image/png,image/jpg" multiple>
        <br>
        <label for="video">Seleccionar video:</label>
        <input type="file" id="video" name="video" accept="video/*">
        <br>
        <label for="imagen">Seleccionar imágenes:</label>
        <input type="file" id="imagen" name="imagen[]" accept="image/jpeg,image/png,image/jpg" multiple>
        <br>

        <label>
            <input type="checkbox" name="options[]" value="1"> Opción 1
        </label>
        <label>
            <input type="checkbox" name="options[]" value="2"> Opción 2
        </label>
        <label>
            <input type="checkbox" name="options[]" value="3"> Opción 3
        </label>
        <label>
            <input type="checkbox" name="options[]" value="4"> Opción 4
        </label>
        <label>
            <input type="checkbox" name="options[]" value="5"> Opción 5
        </label>
        <br>

        <button type="submit">Subir</button>
    </form>

@section('footer')
  @include('components.footer')
@endsection

@push('scripts')
    @vite(['resources/js/scripts/inmueble.js'])
@endpush