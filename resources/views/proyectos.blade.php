{{-- @extends('layouts.app')

@section('title')
    Inmuebles
@endsection

@section('header')
    @include('components.header')
@endsection

@section('content')
    <section class="custom-container my-4">
        @include('components.filters')
    </section>

    <section class="custom-container my-5 filterAvisos-container">
        @foreach($avisos as $aviso)
            @include('components.card_inmueble', [
                'link' => route('inmueble.single', ['inmueble' => $aviso->link()]),
                'image' => $aviso->inmueble->imagenPrincipal(),
                'user' => $aviso->inmueble->user->nombres . ' ' . $aviso->inmueble->user->apellidos,
                'type' => $aviso->inmueble->type(),
                'category' => $aviso->inmueble->category(),
                'currency' => $aviso->inmueble->currencySoles(),
                'idCaracteristica' => $aviso->inmueble->idCaracteristica(),
                'isPuja' => $aviso->inmueble->is_puja() == 1 ? $aviso->inmueble->is_puja() : 0,
                'price' => $aviso->inmueble->precioSoles(),
                'currency_dolar' => $aviso->inmueble->currencyDolares(),
                'price_dolar' => $aviso->inmueble->precioDolares(),
                'remate_precio_base' => $aviso->inmueble->remate_precio_base(),
                'remate_valor_tasacion' => $aviso->inmueble->remate_valor_tasacion(),
                'address' => $aviso->inmueble->address(),
                'district' => $aviso->inmueble->distrito(),
                'department' => $aviso->inmueble->provincia(),
                'area' => $aviso->inmueble->area(),
                'bedrooms' => $aviso->inmueble->dormitorios(),
                'bathrooms' => $aviso->inmueble->banios(),
                'description' => $aviso->inmueble->description(),
                'like' => false,
                'fecha_publicacion' => Carbon\Carbon::parse($aviso->fecha_publicacion)->format('Y-m-d H:i'),
                'type_ad' => $aviso->ad_type ,
                'views' => $aviso->views ,
            ])
        @endforeach
        {{ $avisos->onEachSide(1)->links() }}
    </section>
@endsection

@section('footer')
    @include('components.footer')
@endsection

@push('scripts')
    @vite(['resources/js/scripts/inmuebles.js'])
@endpush --}}

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
                'image' => $proyecto->imagenesAdicionales->first()->image_url ?? asset('images/default-project.jpg'), // Usar la primera imagen activa o una por defecto
                'nombre_proyecto' => $proyecto->nombre_proyecto,
                'entrega' => \Carbon\Carbon::parse($proyecto->fecha_entrega)->locale('es')->translatedFormat('F Y'),
                'direccion' => $proyecto->direccion,
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
