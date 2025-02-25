@extends('layouts.app')

@section('title')
    Inmuebles
@endsection

<style>
    @media (max-width: 425px) {
    .contact-buttons {
        display: flex;
        gap: 8px; /* Espaciado entre botones */
    }

    .contact-buttons .btn-responsive {
        flex: 1;  /* Hace que cada botón ocupe el 50% */
        text-align: center;
    }
}
</style>

@section('header')
    @include('components.header', ['tienePlanes' => $tienePlanes])
@endsection

@section('content')
    {{-- Sección de filtros --}}
    <section class="custom-container my-4">
        @include('components.filters')
    </section>

    <div class="custom-container mt-4 fw-bold">
        @if ( $key_word )
            <p class="fs-5">{{$key_word}}</p>
        @endif
    </div>
    
    {{-- Sección de cards de inmuebles --}}
    <section class="custom-container mb-5 filterAvisos-container">
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
                'inmueble_id' => $aviso->inmueble->id,
                'like' => false,
                'comodidades' => $aviso->inmueble->extra->caracteristicas->where('categoria_caracteristica_id', 2)->take(3),
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
@endpush