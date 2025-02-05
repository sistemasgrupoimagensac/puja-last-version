@extends('layouts.app')

@section('title')
    Home
@endsection

@section('header')
    @include('components.header', ['tienePlanes' => $tienePlanes, ])
@endsection

<style>
    .carousel-wrapper {
        display: flex;
        justify-content: center;
        width: 100%;
    }
  
    #carousel-container {
        /* display: flex; */
        gap: 20px; /* Espaciado entre cards */
        max-width: 100%;
    }
</style>

@section('content')

    <main class="container-fluid main-container main-home">
        <div class="main-home-background-image-container position-relative">

            <img
                src="{{ $imagenFondo ? $imagenFondo->image_url : asset('images/home1.jpg') }}"
                class="w-100 h-100 main-home-background-image"
                alt="Imagen de Fondo"
            >

            <div class="overlay"></div>

            @php

            if(isset($proyecto)) {
                $nombreProyecto = $proyecto->nombre_proyecto;
                $precioDesde = $proyecto->precio_desde;
                $precioDesde = number_format($precioDesde, 0, '', ',');
            } else {
                $nombreProyecto = null;
                $precioDesde = null;
            }

            @endphp

            @if (isset($proyecto))
                <a href="{{ route('proyecto.show', ['slug' => $proyecto->slug] ) }}" class="main-home-proyecto-data text-decoration-none rounded-3">
                    <h4 class=" fw-bold">
                        {{ $nombreProyecto }}
                    </h4>
                    <p class="m-0 p-0"> precio desde:
                        <span class="fw-bold">
                            S/ {{ $precioDesde }}
                        </span>
                    </p>
                </a>
            @endif
            
            
            <div class="main-home-search">
                <h1 class="main-home-titular text-white fw-bold mb-4 text-center">
                    Consigue tu Próximo Inmueble
                </h1>

                <div class="d-flex justify-content-center mb-3">
                    <div class="btn-group" role="group" aria-label="Tipo de transacción">
                        <input type="radio" class="btn-check" name="transaccion" id="venta" autocomplete="off" value="1" checked>
                        <label class="btn p-2 px-3 mb-2 btn-light fs-5 text-body-secondary" for="venta">Comprar</label>
                        
                        <input type="radio" class="btn-check" name="transaccion" id="alquiler" autocomplete="off" value="2">
                        <label class="btn p-2 px-3 mb-2 btn-light fs-5 text-body-secondary" for="alquiler">Alquilar</label>
                
                        <input type="radio" class="btn-check" name="transaccion" id="alquiler_temporal" autocomplete="off" value="3">
                        <label class="btn p-2 px-3 mb-2 btn-light fs-5 text-body-secondary" for="alquiler_temporal">Remates</label>
                    </div>
                </div>
        
                <form action="{{ route('filter_search') }}" class="d-flex justify-content-center">
                    <div class="input-group input-group-lg" style="max-width: 600px;">
        
                        
                        <select class="form-select rounded-start" aria-label="Tipo de Propiedad" name="categoria" style="width: 120px; min-width:100px; flex: 0 0 auto;">
                            @foreach($tipos_inmuebles as $tipo)
                            <option value="{{ $tipo->id }}" @if($loop->first) selected @endif>{{ $tipo->tipo }}</option>
                            @endforeach
                        </select>
                        
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Ciudad, provinicia o distrito"
                            aria-label="direccion"
                            aria-describedby="direccion"
                            name="direccion"
                        >

                        <button class="btn button-orange" type="submit">  
                            <i class="fas fa-search"></i> 
                        </button>     
                    </div>
                </form>
            </div>
        </div>
    </main>

    <section class="info-section py-5">
        <div class="container">
            <div class="row g-4">
            
                <div class="col-md-4">
                    <div class="info-card p-4 h-100">
                        <a href="{{ url('blog') }}" class="text-decoration-none text-body">
                            <div class="info-icon mb-3">
                                <i class="fa-solid fa-file-invoice" style="color: #f57c00; height: 45px;"></i>
                            </div>
                            <h3 class="info-title mb-2">Nuestro blog</h3>
                            <p class="info-text m-0">
                                Novedades y consejos sobre adquisición de inmuebles.
                            </p>
                        </a>
                    </div>
                </div>
            
                <div class="col-md-4">
                    <div class="info-card p-4 h-100">
                        <a href="{{ url('blog/tendencias-del-mercado-departamentos-en-venta-en-lima-2024') }}" class="text-decoration-none text-body">
                            <div class="info-icon mb-3">
                                <i class="fa-solid fa-chart-pie" style="color: #f57c00; height: 45px;"></i>
                            </div>
                            <h3 class="info-title mb-2">Tendencias</h3>
                            <p class="info-text m-0">
                                Te informamos sobre la demandas sostenida y nuevas zonas de expansión.
                            </p>
                        </a>
                    </div>
                </div>
            
                <div class="col-md-4">
                    <div class="info-card p-4 h-100">
                        <a href="{{ route('contacto') }}" class="text-decoration-none text-body">
                            <div class="info-icon mb-3">
                                <i class="fa-solid fa-door-open" style="color: #f57c00; height: 45px;"></i>
                            </div>
                            <h3 class="info-title mb-2">Contáctanos</h3>
                            <p class="info-text m-0">
                                Ponte en contacto con nosotros para esclarecer tus dudas para una mayor experiencia.
                            </p>
                        </a>
                    </div>
                </div>
        
            </div>
        </div>
    </section>
    
    {{-- Sección de NUEVOS --}}
    <section class="custom-container">

        <h3 class="mx-3 mb-5 font-weight-bold fs-md-5 mx-md-5">Últimos inmuebles</h3>

        <div>
            @include('components.container-cards_nuevos')
        </div>
    </section>
    
    <section class="custom-container">
        <div class="d-flex justify-content-end">
            {{-- <h3 class="mx-3 my-5 font-weight-bold fs-md-5 mx-md-5">Últimos inmuebles</h3> --}}
            <a href="/inmuebles/inmuebles-en-venta-y-alquiler" class="text-decoration-none">
                <h5 class="mx-3 my-5 fw-bold">Recomendaciones</h5>
            </a>
        </div>

        <div>
            @include('components.carousel')
        </div>
    </section>
    
    {{-- Sección de Destacados --}}
    <section class="custom-container">

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