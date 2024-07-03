@extends('layouts.app')

@section('title')
    Mis Avisos
@endsection

@section('header')
    @include('components.header')
@endsection

@section('content')
    <main id="main-misavisos" class="custom-container mt-3">
        <div class="container-fluid p-0 d-flex">
            @include('components.menu_panel')
            <section id="" class="col px-5 pt-2">
                <h2>Mis avisos</h2>

                <section class="my-3">
                    {{-- @php dd($avisos); @endphp --}}
                    @foreach($avisos as $aviso)
                    @include('components.aviso_simple', [
                        'id' => $aviso->id,
                        'codigo_unico' => $aviso->inmueble->codigo_unico,
                        'link' => route('inmueble.single', ['inmueble' => $aviso->link()]),
                        'title' => $aviso->inmueble->tituloReal() ?? 'Aviso sin título',
                        'image' => $aviso->inmueble->imagenPrincipal(),
                        'type' => $aviso->inmueble->type(),
                        'category' => $aviso->inmueble->category(),
                        'currency' => $aviso->inmueble->currencySoles() ?? $aviso->inmueble->currencyDolares(),
                        'price' => $aviso->inmueble->precioSoles() ?? $aviso->inmueble->precioDolares(),
                        'address' => $aviso->inmueble->address(),
                    ])
                    @endforeach
                </section>
            </section>
        </div>
    </main>
@endsection

@section('footer')
  @include('components.footer')
@endsection