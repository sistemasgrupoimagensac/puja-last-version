@extends('layouts.app')

@section('title')
    Proyectos
@endsection

@section('header')
    @include('components.header')
@endsection

@section('content')
    {{-- Sección de cards de proyectos --}}
    <section class="custom-container my-5 filterAvisos-container">
        @foreach($proyectos as $proyecto)
            @include('components.card-proyecto-home', [
                'link' => route('proyecto.show', ['slug' => $proyecto->slug]), // Ruta para el detalle del proyecto
                'image' => $proyecto->imagenesAdicionales->first()->image_url ?? asset('images/no-image.webp'), // Usar la primera imagen activa o una por defecto
                'nombre_proyecto' => $proyecto->nombre_proyecto,
                'entrega' => \Carbon\Carbon::parse($proyecto->fecha_entrega)->locale('es')->translatedFormat('F Y'),
                'direccion' => $proyecto->direccion,
                'nombre_user' => $proyecto->cliente->user->nombres,
                'distrito' => $proyecto->distrito,
                'provincia' => $proyecto->provincia,
                'departamento' => $proyecto->departamento,
                'area_desde' => $proyecto->area_desde,
                'area_hasta' => $proyecto->area_hasta,
                'dormitorios_desde' => $proyecto->dormitorios_desde, // Rango de dormitorios
                'dormitorios_hasta' => $proyecto->dormitorios_hasta, // Rango de dormitorios
                'precio_desde' => $proyecto->precio_desde,
                'banco' => $proyecto->banco->nombre ?? 'No especificado',
                'estado' => $proyecto->progreso->estado ?? 'No especificado',
            ])
        @endforeach

        {{-- Paginación --}}
        {{ $proyectos->onEachSide(1)->links() }}
    </section>
@endsection

@section('footer')
    @include('components.footer')
@endsection

@push('scripts')
    @vite(['resources/js/scripts/inmuebles.js'])
@endpush
