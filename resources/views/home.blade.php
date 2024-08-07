@extends('layouts.app')

@section('title')
    Home
@endsection

@section('header')
    @include('components.header', ['tienePlanes' => $tienePlanes])
@endsection

@section('content')

    {{-- Main: incluye el buscador y Titular --}}
    <main class="main-home">
        <div class="main-home-background-image"></div>
        <div class="main-home-search d-flex flex-column h-100 w-100 px-3">

            <form action="{{ route('filter_search') }}" method="" class="m-auto">
                <h1 class="main-home-titular text-white font-weight-bold text-center mb-5">Consigue tu Próximo Inmueble</h1>
                <div class="main-home-filter">

                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
                        
                        <div class="input-group-lg mr-4">
                            <select class="form-select" aria-label="Tipo de Propiedad" name="categoria">
                                @foreach($tipos_inmuebles as $tipo)
                                    <option value="{{ $tipo->id }}" @if($loop->first) selected @endif>{{ $tipo->tipo }}</option>
                                @endforeach
                            </select>
                        </div>
                       
                        <div class="btn-group ml-4" role="group" aria-label="tipo de transaccion">
                            <input type="radio" class="btn-check" name="transaccion" id="comprar" autocomplete="off" value="1" checked>
                            <label class="btn p-2 px-3 mb-2 btn-light fs-5 text-body-secondary" for="comprar">Comprar</label>
                            
                            <input type="radio" class="btn-check" name="transaccion" id="alquilar" autocomplete="off" value="2">
                            <label class="btn p-2 px-3 mb-2 btn-light fs-5 text-body-secondary" for="alquilar">Alquilar</label>
    
                            <input type="radio" class="btn-check" name="transaccion" id="remates" autocomplete="off" value="3">
                            <label class="btn p-2 px-3 mb-2 btn-light fs-5 text-body-secondary" for="remates">Remates</label>
                        </div>

                    </div>
                    
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" placeholder="Dirección" aria-label="direccion" aria-describedby="direccion" name="direccion">
                        <input class="button-orange btn" type="submit" value="Buscar">
                    </div>
                </div>
            </form>
        </div>
    </main>
    {{-- Main: incluye el buscador y Titular --}}
    
    {{-- Sección de Recomendados --}}
    <section class="custom-container">
        {{-- <p>{{ session("user") }}</p> --}}
        {{-- @if (session('user'))
            @php
                $user = json_decode(session('user'));
            @endphp

            <div class="alert alert-success">
                <p>ID: {{ $user->id }}</p>
                <p>Nombres: {{ $user->nombres }}</p>
                <p>Email: {{ $user->email }}</p>
                <p>Imagen: <img src="{{ $user->imagen }}" alt="User Avatar"></p>
            </div>
        @endif --}}

        <h3 class="mx-3 my-5 font-weight-bold fs-md-5 mx-md-5">Nuestras recomendaciones</h3>

        <div>
            @include('components.carousel')
        </div>
    </section>
    {{-- Sección de Recomendados --}}

    
    {{-- Sección de Destacados --}}
    <section class="custom-container">

        {{-- <h3 class="m-3 font-weight-bold fs-md-5">Busca entre todos nuestro inmuebles</h3> --}}
        <h3 class="mx-3 my-5 font-weight-bold fs-md-5 mx-md-5">Busca entre todos nuestro inmuebles</h3>

        <div class="d-flex flex-column flex-lg-row justify-content-between m-3">

            <div class="accordion accordion-flush" id="acordionVentas">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="custom-accordion-button accordion-button collapsed fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#flush-colapsaVentas" aria-expanded="false" aria-controls="flush-colapsaVentas">
                            Venta de inmuebles 
                        </button>
                    </h2>
                    <div id="flush-colapsaVentas" class="accordion-collapse collapse" data-bs-parent="#acordionVentas">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Venta en Lima')]) }}">Venta Departamentos Lima</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Venta en Lince')]) }}">Venta Departamentos Lince</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Venta en San Isidro')]) }}">Venta Departamentos San Isidro</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Venta en Breña')]) }}">Venta Departamentos Breña</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Venta en Jesús María')]) }}">Venta Departamentos Jesús María</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Venta en San Borja')]) }}">Venta Departamentos San Borja</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Venta en La Victoria')]) }}">Venta Departamentos La Victoria</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Venta en Surco')]) }}">Venta Departamentos Surco</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    
            <div class="accordion accordion-flush" id="acordionAlquiler">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="custom-accordion-button accordion-button collapsed fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#flush-colapsaAlquiler" aria-expanded="false" aria-controls="flush-colapsaAlquiler">
                            Alquiler de inmuebles 
                        </button>
                    </h2>
                    <div id="flush-colapsaAlquiler" class="accordion-collapse collapse md:show" data-bs-parent="#acordionAlquiler">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Alquiler en Lima')]) }}">Alquiler Departamentos en Lima</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Alquiler en La Molina')]) }}">Alquiler Departamentos en La Molina</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Alquiler en Surco')]) }}">Alquiler Departamentos en Surco</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Alquiler en Surquillo')]) }}">Alquiler Departamentos en Surquillo</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Alquiler en Lince')]) }}">Alquiler Departamentos en Lince</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Alquiler en San Borja')]) }}">Alquiler Departamentos en San Borja</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Alquiler en San Isidro')]) }}">Alquiler Departamentos en San Isidro</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    
            <div class="accordion accordion-flush" id="acordionRemates">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="custom-accordion-button accordion-button collapsed fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#flush-colapsaRemates" aria-expanded="false" aria-controls="flush-colapsaRemates">
                            Remates de inmuebles 
                        </button>
                    </h2>
                    <div id="flush-colapsaRemates" class="accordion-collapse collapse" data-bs-parent="#acordionRemates">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Terrenos en Remate en Arequipa')]) }}">Remates Terrenos en Arequipa</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Terrenos en Remate en Tacna')]) }}">Remates Terrenos en Tacna</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Terrenos en Remate en Cajamarca')]) }}">Remates Terrenos en Cajamarca</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Terrenos en Remate en Ica')]) }}">Remates Terrenos en Ica</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Terrenos en Remate en Barranca')]) }}">Remates Terrenos en Barranca</a></li>
                            <li class="list-group-item"><a class="text-decoration-none text-body-secondary" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Terrenos en Remate en Piura')]) }}">Remates Terrenos en Piura</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </section>
    {{-- Sección de Destacados --}}

@endsection

@section('footer')
  <x-footer></x-footer>
@endsection

@push('scripts')
    @vite(['resources/js/scripts/home.js', 'resources/js/scripts/components/card_simple.js'])
@endpush