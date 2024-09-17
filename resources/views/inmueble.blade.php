@extends('layouts.app')

@section('title')
    Inmueble
@endsection

@push('styles')
    @vite(['resources/sass/pages/inmueble.scss'])
@endpush

@section('header')
    @include('components.header', ['tienePlanes' => $tienePlanes])
@endsection

@section('content')

    <div id="loader-overlay">
        <img src="{{ asset('images/loader.svg') }}" alt="Cargando...">
    </div>
    
    @php
        $acepta_puja = false;
        if ($aviso->inmueble->is_puja() === 1) {
            $acepta_puja = true;
        }

        $inmueble_en_remate = false;
        $id_categoria_caracteristicas = 1;
        if ($aviso->inmueble->remate_precio_base() || $aviso->inmueble->remate_valor_tasacion()) {
            $inmueble_en_remate = true;
            $id_categoria_caracteristicas = 3;
        }


    @endphp
    <div class="custom-container my-2">
        <div class="d-flex flex-column flex-lg-row">
        
            {{-- Caracteristicas del inmueble --}}
            <div class="col-lg-8 pe-lg-3">
                <div class="py-3">

                    {{-- Imagenes --}}
                    <div class="images-wrapper position-relative mb-4" data-bs-toggle="modal" data-bs-target="#modalImagesCarousel">

                        @if ($inmueble_en_remate)
                            <div class="position-absolute top-0 end-0 mt-4 me-2">
                                <h3 class="h2"><span class="badge text-bg-danger">REMATE PÚBLICO</span></h3>
                            </div>
                        @endif
                        
                        @if ($aviso->ad_type === 3)
                            <div class="ribbon premium">Premium</div>
                        @elseif ($aviso->ad_type === 2)
                            <div class="ribbon top">Top</div>
                        @endif

                        <div class="first-image card-image-container shadow">
                            <img src="{{ $aviso->inmueble->imagenPrincipal() }}" class="card-image-custom rounded" alt="{{ $aviso->inmueble->title() }}">
                        </div>
                        @foreach($aviso->inmueble->imagenes as $n => $image)
                            <div class="@if($n == 0) second-image @elseif($n == 1) third-image @else d-none  @endif card-image-container shadow">
                                <img src="{{ $image->imagen }}" class="card-image-custom rounded" alt="{{ $aviso->inmueble->title() }}">
                            </div>
                        @endforeach


                    </div>
                    
                    {{-- modal --}}
                    <div class="modal fade" id="modalImagesCarousel" tabindex="-1">
                        <div class="modal-dialog modal-xl modal-dialog-centered inmueble-modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-body p-0 bg-secondary">

                                    {{-- imagenes carrusel --}}
                                    <div id="carouselImagesInmueble" class="carousel slide carousel-fade">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active"> 
                                                <img src="{{ $aviso->inmueble->imagenPrincipal() }}" class="d-block w-100" alt="{{ $aviso->inmueble->title() }}">
                                            </div>
                                            @foreach($aviso->inmueble->imagenes as $image)
                                                <div class="carousel-item @if($loop->first) @endif">
                                                    <img src="{{ $image->imagen }}" class="d-block w-100" alt="{{ $aviso->inmueble->title() }}">
                                                </div>
                                            @endforeach
                                            @foreach($aviso->inmueble->planos as $plano)
                                                <div class="carousel-item @if($loop->first) @endif">
                                                    <img src="{{ $plano->plano }}" class="d-block w-100" alt="planos">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImagesInmueble" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselImagesInmueble" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Precio del inmueble Remate --}}
                    @if($inmueble_en_remate)
                        <div class="card m-0 my-4 text-bg-dark shadow p-3">
                            <p class="h3">
                                <strong class="fw-bold text-primary">¡Gran oportunidad!</strong> Adquiere esta propiedad por <strong class="text-primary fw-bolder fs-2">USD {{ number_format($aviso->inmueble->remate_precio_base()) }}</strong> de precio base, 
                                muy por debajo de su valor tasado en <strong>USD {{ number_format($aviso->inmueble->remate_valor_tasacion()) }}</strong>
                            </p>
                        </div>
                    @endif

                    {{-- Card - Datos del inmueble --}}
                    @if ($inmueble_en_remate)
                        <div class="custom-container mt-2 p-3 rounded bg-body-secondary d-flex flex-column justify-content-between align-items-md-stretch shadow">
                    @else
                        <div class="custom-container mt-2 p-3 rounded bg-body-secondary d-flex flex-row justify-content-between align-items-end flex-md-column align-items-md-stretch shadow">
                    @endif

                        @if ($inmueble_en_remate)
                            <div class="d-flex flex-column">
                        @else
                            <div class="d-flex flex-column flex-md-row justify-content-between gap-2 gap-lg-5">
                        @endif

                            <div style="max-width: 700px">
                                
                                {{-- title --}}
                                <h1 class="p-0 h3 fw-bold">
                                    {{ $aviso->inmueble->title() }}
                                </h1>
                    
                                {{-- direccion --}}
                                <h5 class="p-0">
                                    <i class="fa-solid fa-location-dot icon-orange"></i>
                                    <span>{{ $aviso->inmueble->address() }}</span> {{-- address --}}
                                    <span>, </span>
                                    <span>{{ $aviso->inmueble->distrito() }}</span> {{-- district --}}
                                    <span>, </span>
                                    <span>{{ $aviso->inmueble->provincia() }}</span> {{-- departament --}}
                                </h5>

                            </div>
                
                            {{-- Precio del inmueble Alquiler y Venta --}}
                            @if (!$inmueble_en_remate)
                                <div class="d-flex justify-content-between">

                                    <div class="d-flex flex-column align-items-start align-items-md-end mt-4 mt-md-0">
                                        @if($aviso->inmueble->precioSoles())
                                            <h2 class="m-0 fw-bolder">
                                                <span>{{ $aviso->inmueble->currencySoles() }}</span>
                                                <span>{{ number_format($aviso->inmueble->precioSoles(), 0, '', ',') }}</span>
                                            </h2>
                                        @endif
                                        @if($aviso->inmueble->precioDolares())
                                            <h3 class="m-0 fw-bolder text-secondary">
                                                <small>{{ $aviso->inmueble->currencyDolares() }}</small>
                                                <small>{{ number_format($aviso->inmueble->precioDolares(), 0, '', ',') }}</small>
                                            </h3>
                                        @endif
        
                                    </div>
                                </div>
                            @endif

                            </div>

                        <h4 class="p-0 m-0 mt-4" style="min-width: 70px">
                            ID: {{ $aviso->id }}
                        </h4>
                    </div>

                    {{-- Card - Remate (OPCIONAL) --}}
                    @if($inmueble_en_remate)
                        <div class="description-container mt-4 bg-primary-subtle text-bg-light p-3 rounded border border-3 border-primary">
                            <h3 class="fw-bold">Detalles del Remate Público</h3>

                            @if($aviso->inmueble->remate_direccion() && $aviso->inmueble->remate_direccion() !== 'null')
                                <p>
                                    <span class="fw-bolder">Lugar del remate:</span>
                                    {{ $aviso->inmueble->remate_direccion() }} - {{ $aviso->inmueble->remate_nombre_centro() }}
                                </p>
                            @endif

                            @if($aviso->inmueble->remate_fecha() && $aviso->inmueble->remate_fecha() !== 'null')
                                <p>
                                    <span class="fw-bolder">Fecha y hora:</span>
                                    {{ $aviso->inmueble->remate_fecha() }} a las {{ $aviso->inmueble->remate_hora() ? $aviso->inmueble->remate_hora() : "" }} horas
                                </p>
                            @endif

                            @if($aviso->inmueble->remate_nombre_contacto() && $aviso->inmueble->remate_nombre_contacto() !== 'null')
                                <p>
                                    <span class="fw-bolder">Contacto:</span>
                                    {{ $aviso->inmueble->remate_nombre_contacto() }}
                                </p>
                            @endif

                            @if($aviso->inmueble->remate_telef_contacto() && $aviso->inmueble->remate_nombre_contacto() !== 'null')
                                <p>
                                    <span class="fw-bolder">Teléfono:</span>
                                    {{ $aviso->inmueble->remate_telef_contacto() }}
                                </p>
                            @endif

                            @if($aviso->inmueble->remate_correo_contacto() && $aviso->inmueble->remate_correo_contacto() !== 'null')
                                <p>
                                    <span class="fw-bolder">Correo:</span>
                                    {{ $aviso->inmueble->remate_correo_contacto() }}
                                </p>
                            @endif

                            @if($aviso->inmueble->remate_partida_registral() && $aviso->inmueble->remate_partida_registral() !== 'null')
                                <p>
                                    <span class="fw-bolder">Partida Registral:</span>
                                    <span class="px-2 bg-body-tertiary rounded">{{ $aviso->inmueble->remate_partida_registral() }}</span>
                                </p>
                            @endif

                        </div>
                    @endif

                    {{-- Card - Más datos del inmueble --}}
                    <div class="d-flex flex-wrap justify-content-between gap-4 mt-4 px-3 py-4 border rounded shadow">

                        {{-- dormitorios --}}
                        @if($aviso->inmueble->dormitorios())
                            <div class="d-flex flex-column justify-content-between align-items-center" style="width: 110px;">
                                <div class="d-flex">
                                    <i class="fa-solid fa-bed fa-lg icon-orange p-1"></i>
                                    <h5 class="text-secondary m-1 fw-bold"> {{ $aviso->inmueble->dormitorios() }} </h5>
                                </div>
                                <h6 class="text-secondary m-0"> dorm. </h6>
                            </div>
                        @endif

                        {{-- baño completo --}}
                        @if($aviso->inmueble->banios())
                            <div class="d-flex flex-column justify-content-between align-items-center" style="width: 110px;">
                                <div class="d-flex">
                                    <i class="fa-solid fa-bath fa-lg icon-orange p-1"></i>
                                    <h5 class="text-secondary m-1 fw-bold"> {{ $aviso->inmueble->banios() }} </h5>
                                </div>
                                <h6 class="text-secondary m-0"> bañ. </h6>
                            </div>
                        @endif

                        {{-- medio baño --}}
                        @if($aviso->inmueble->medioBanios())
                            <div class="d-flex flex-column justify-content-between align-items-center" style="width: 110px;">
                                <div class="d-flex">
                                    <i class="fa-solid fa-toilet fa-lg icon-orange p-1"></i>
                                    <h5 class="text-secondary m-1 fw-bold"> {{ $aviso->inmueble->medioBanios() }} </h5>
                                </div>
                                <h6 class="text-secondary m-0"> 1/2 bañ. </h6>
                            </div>
                        @endif
                        
                        {{-- estacionamientos --}}
                        @if($aviso->inmueble->estacionamientos())
                            <div class="d-flex flex-column justify-content-between align-items-center" style="width: 110px;">
                                <div class="d-flex">
                                    <i class="fa-solid fa-car fa-lg icon-orange p-1"></i>
                                    <h5 class="text-secondary m-1 fw-bold"> {{ $aviso->inmueble->estacionamientos() }} </h5>
                                </div>
                                <h6 class="text-secondary m-0"> estacion. </h6>
                            </div>
                        @endif

                        {{-- area total --}}
                        @if($aviso->inmueble->area())
                            <div class="d-flex flex-column justify-content-between align-items-center" style="width: 110px;">
                                <div class="d-flex">
                                    <i class="fa-solid fa-ruler-combined fa-lg icon-orange p-1"></i>
                                    <h5 class="text-secondary m-1 fw-bold"> 
                                        <span>{{ number_format($aviso->inmueble->area(), 0, '', ','); }}</span>
                                        <span>m</span>
                                        <sup>2</sup>
                                    </h5>
                                </div>
                                <h6 class="text-secondary m-0"> area total </h6>
                            </div>
                        @endif
                        
                        {{-- area techada --}}
                        @if($aviso->inmueble->areaConstruida())
                            <div class="d-flex flex-column justify-content-between align-items-center" style="width: 110px;">
                                <div class="d-flex">
                                    <i class="fa-solid fa-ruler-combined fa-lg icon-orange p-1"></i>
                                    <h5 class="text-secondary m-1 fw-bold"> 
                                        <span>{{ number_format($aviso->inmueble->areaConstruida(), 0, '', ','); }}</span>
                                        <span>m</span>
                                        <sup>2</sup>
                                    </h5>
                                </div>
                                <h6 class="text-secondary m-0"> area construida </h6>
                            </div>
                        @endif

                    </div>

                    {{-- Card - descripción --}}
                    <div class="description-container mt-5">
                        <h3 class="fw-bold">Sobre este inmueble</h3>

                        <p> <span class="fw-bold">Antigüedad:</span>
                            @if ( $aviso->inmueble->antiguedad() === 0 )
                                <span>En construccion</span>
                            @elseif ( $aviso->inmueble->antiguedad() === 1 )
                                <span>En estreno</span>
                            @elseif ( $aviso->inmueble->antiguedad() === 2 )
                                <span class=" fw-normal">{{ $aviso->inmueble->aniosAntiguedad() }} años</span>
                            @endif
                        </p>

                        <div class="description-container mt-4">
                            <h4 class="fw-bold">Descripción</h4>
    
                            @if ($acepta_puja)
                                <span class="badge text-bg-primary text-white fw-lighter my-3">Este aviso acepta ofertas en cuanto al precio que le ofrezcas</span> 
                            @endif
    
                            <form id="editDescriptionForm" action="{{ route('posts.edit_description') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <input type="hidden" name="aviso_id" value="{{ $aviso->id }}">
                                    <textarea class="form-control" id="editDescriptionTextarea" name="description" disabled>{!! $aviso->inmueble->principal->caracteristicas->descripcion !!}</textarea>
                                </div>
                                @if ( $ad_belongs && !in_array($aviso->historial[0]->estado, ["Publicado", "Aceptado"]) )
                                    <div class="btn-group border mt-3" role="group">
                                        <button type="button" id="editDesciptionButton" class="btn border-0 button-orange" style="width: 80px;">Editar</button>
                                        <button type="submit" id="saveDesciptionButton" class="btn border-0 button-orange" style="width: 80px;" disabled>Guardar</button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>

                    {{-- Más Características --}}
                    <div class="mt-5">
                        <h3 class="fw-bold">Más Características</h3>

                        <ul class="list-unstyled d-flex flex-wrap justify-content-between">
                            {{-- @dd($aviso->inmueble->extra->caracteristicas); --}}
                            @foreach($aviso->inmueble->extra->caracteristicas as $caracteristica)
                                {{-- <li>{{ $caracteristica->caracteristica }}: {{ $caracteristica->id }}</li> --}}
                                @if ( $caracteristica->categoria_caracteristica_id === $id_categoria_caracteristicas )
                                    <li class="mt-3" style="min-width: 250px;">
                                        <h6 class="text-secondary">
                                        <i class="fa-solid {{ $caracteristica->icono }} icon-orange me-2"></i>
                                        {{ $caracteristica->caracteristica }}
                                        </h6>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    {{-- Comodidades --}}
                    @if(!$inmueble_en_remate)
                        <div class="mt-5">
                            <h3 class="fw-bold">Comodidades</h3>

                            <ul class="list-unstyled d-flex flex-wrap justify-content-between">
                                @foreach($aviso->inmueble->extra->caracteristicas as $caracteristica)
                                    @if ( $caracteristica->categoria_caracteristica_id == 2 )
                                        <li class="mt-3" style="min-width: 250px;">
                                            <h6 class="text-secondary">
                                                <i class="fa-solid {{ $caracteristica->icono }} icon-orange me-2"></i>
                                                {{ $caracteristica->caracteristica }}
                                            </h6>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Geolocalización --}}
                    <div class="mt-5">
                        <h3 class="fw-bold">Localización</h3>
                        @if ($aviso->inmueble->principal->ubicacion->latitud)
                            <div class="mt-3" id="map" style="max-width: 600px; height: 600px"></div>
                        @endif
                    </div>
                </div>  
            </div>

            {{-- Aside Formulario Contacto --}}
            <div class="col-lg-4 ps-lg-3">

                @if ( $ad_belongs )

                    @if ( !$publicado )

                        @if ( $user_not_pay ) {{-- El cliente tiene activo la opcion para no PAGAR --}}
                            <div class="d-flex justify-content-center w-100">
                                <button type="button" class="btn button-orange fs-3 rounded-3 m-2 mx-lg-5 w-100" id="acreedor-especial-post-ad">
                                    Publicar
                                </button>
                                <form id="acreedor-especial-post" action="/contratar_plan" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="aviso_id" value="{{ $aviso->id }}">
                                    <input type="hidden" name="plan_id" value="{{ $plan_id }}">
                                    <input type="hidden" name="tipo_aviso" value="{{ $tipo_aviso }}">
                                    <input type="hidden" name="acreedor_post_free" value="1">
                                </form>
                            </div>
                        @else
                            <div class="sticky-lg-top py-3">
                                <div class="rounded bg-white border shadow">
                                    <div class="p-3">
                                        <h4 class="fw-bold m-0">Planes adquiridos:</h4>
                                        <hr>
                                        {{-- lista de planes o paquetes comprados --}}
                                        <div>
                                            {{-- Card Comprar Plan --}}
                                            <div class="card text-bg-light mb-3">
                                                <div class="card-body text-center">
                                                    <p class="m-0">Adquiere un plan con los mejores precios del mercado.</p>
                                                </div>

                                                @if ($tipo_usuario === 2)
                                                    <button class="btn btn-danger fs-5 rounded-top-0" id="redirect-button">
                                                        <i class="fa-solid fa-plus "></i>
                                                        Plan
                                                    </button>
                                                    <form id="redirect-form" action="{{ route('pagar.planes_propietario') }}" method="POST" style="display: none;">
                                                        @csrf
                                                        <input type="hidden" name="aviso_id" value="{{ $aviso->id }}">
                                                    </form>
                                                @elseif ($tipo_usuario === 3)
                                                    <a class="btn btn-danger fs-5 rounded-top-0" href="/planes-inmobiliaria">
                                                        <i class="fa-solid fa-plus "></i>
                                                        Plan
                                                    </a>
                                                @elseif ($tipo_usuario === 4)
                                                    <button class="btn btn-danger fs-5 rounded-top-0" id="redirect-button-acreedor">
                                                        <i class="fa-solid fa-plus "></i>
                                                        Plan
                                                    </button>
                                                    <form id="redirect-form-acreedor" action="{{ route('pagar.planes_acreedor') }}" method="POST" style="display: none;">
                                                        @csrf
                                                        <input type="hidden" name="aviso_id" value="{{ $aviso->id }}">
                                                    </form>
                                                @endif
                                            </div>

                                            <div id="plans-container" class=" d-flex flex-column gap-3">
                                                <!-- Las cards se agregarán aquí dinámicamente -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif


                    <!-- Modal confirmacion de publicacion -->
                    <div class="modal fade" id="publicarAviso" tabindex="-1" aria-labelledby="publicarAvisoLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="alert alert-danger m-0" role="alert">
                                        ¿Seguro quieres publicar tu inmuble con este Plan?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="d-flex justify-content-between gap-3 w-100">
                                        <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">NO</button>
                                        <button type="button" class="btn button-orange w-100" data-bs-toggle="modal" data-bs-target="#modalEleccionTipoAviso">SI</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal eleccion de tipo aviso -->
                    <div class="modal fade" id="modalEleccionTipoAviso" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEleccionTipoAvisoLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 icon-orange" id="modalEleccionTipoAvisoLabel">Elige el tipo de aviso</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex flex-column gap-3">
                                        <input type="radio" class="btn-check" name="btnradio" id="btnPremiumAds" autocomplete="off">
                                        <label class="btn btn-outline-secondary" for="btnPremiumAds">Aviso Premium: <span id="premiumAdsRemaining"></span></label>
                                      
                                        <input type="radio" class="btn-check" name="btnradio" id="btnTopAds" autocomplete="off">
                                        <label class="btn btn-outline-secondary" for="btnTopAds">Aviso Top: <span id="topAdsRemaining"></span></label>
                                      
                                        <input type="radio" class="btn-check" name="btnradio" id="btnTypicalAds" autocomplete="off">
                                        <label class="btn btn-outline-secondary" for="btnTypicalAds">Aviso Típico: <span id="typicalAdsRemaining"></span></label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="d-flex justify-content-between gap-3 w-100">
                                        <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">NO</button>
                                        <button type="button" class="btn button-orange w-100" id="siUsarEstePlan">Elegir este tipo de aviso</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @else
                    
                    <div class="sticky-lg-top py-3">
                        <div class="rounded bg-white border shadow">
                            <form class="d-flex flex-column gap-3 p-3" method="POST" id="send_contact">
                                @csrf
                                <input type="hidden" name="aviso_id" value="{{ $aviso->id }}">
                                <div class="d-flex justify-content-between align-items-center">

                                    <h5 class="form-title m-0">Contactar</h5>
                                    <i class="fa-solid fa-arrow-down fa-lg me-1"></i>
                                </div>

                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nombre_contacto" name="nombre_contacto" placeholder="Nombre Completo" required>
                                    <label class="text-secondary" for="nombre_contacto">Nombre Completo</label>
                                    <div id="validationServerNombre_contactoFeedback" class="invalid-feedback"></div>
                                </div>

                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email_contacto" name="email_contacto" placeholder="Correo electrónico" required>
                                    <label class="text-secondary" for="email_contacto">Correo Electrónico</label>
                                    <div id="validationServerEmail_contactoFeedback" class="invalid-feedback"></div>
                                </div>  

                                <div class="form-floating">
                                    <input type="phone" class="form-control" id="telefono_contacto" maxlength="9" minlength="9" name="telefono_contacto" placeholder="Teléfono" required>
                                    <label class="text-secondary" for="telefono_contacto">Teléfono</label>
                                    <div id="validationServerTelefono_contactoFeedback" class="invalid-feedback"></div>
                                </div>  

                                {{-- si admite oferta --}}
                                @if ( $aviso->inmueble->is_puja() )
                                    <div class="input-group">
                                        <div class="input-group">
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="contact_divisa_monto" value="1" id="soles" autocomplete="off" checked>
                                                <label class="btn btn-outline-secondary" for="soles" style="width: 40px">S/</label>
                                              
                                                <input type="radio" class="btn-check" name="contact_divisa_monto" value="2" id="dolares" autocomplete="off">
                                                <label class="btn btn-outline-secondary rounded-end-0" for="dolares" style="width: 40px">$</label>
                                            </div>

                                            <input type="text" class="form-control" name="contact_monto_puja" placeholder="Oferta un Precio" aria-label="Example text with two button addons">

                                            <span type="button" class="input-group-text"> 
                                                <div 
                                                    class="d-flex align-items-center"
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-placement="top"
                                                    data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="Oferta sobre el precio del inmueble publicado. Puede ser mayor o menor del monto que publicó el propietario.">
                                                    <i class="fa-solid fa-circle-info fa-lg"></i>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                    
                                {{-- Mensaje --}}
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Contactame" id="contact-message" name="contact_message" style="height: 100px">¡Hola! Deseo que me contacten por este inmueble</textarea>
                                    <label for="contact-message" class="text-secondary">Mensaje</label>
                                </div>

                                {{-- contacto por whatsapp --}}
                                <button class="btn btn-light border-secondary-subtle" type="button" id="whatsapp_contact_button">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </button>
                
                                {{-- contacto por correo --}}
                                <button class="btn btn-light border-secondary-subtle" id="btn-enviar-form-single">
                                    <i class="fa-regular fa-paper-plane"></i> Enviar
                                </button>
                
                                <div class="form-group d-flex align-items-top gap-2 mb-4 position-relative">
                                  
                                    <input type="checkbox" name="accept_terms" id="terminos" class="form-check-input" required/>
                                    <label for="terminos">Acepto los <a href="" class="custom-link-register text-decoration-none">Términos y Condiciones de Uso</a> y las <a href="" class="custom-link-register text-decoration-none">Políticas de Privacidad</a></label>
                                    <div id="validationServerAccept_termsFeedback" class="invalid-feedback position-absolute top-100 px-4"></div>
                                
                                </div>
                            </form>
                        </div>
                    </div>

                @endif

            </div>

        </div>
    </div>

    <script>

        const lat = parseFloat(@json($aviso->inmueble->principal->ubicacion->latitud));
        const lng = parseFloat(@json($aviso->inmueble->principal->ubicacion->longitud));
        const es_exacta = parseFloat(@json($aviso->inmueble->principal->ubicacion->es_exacta));
        const defaultLocation = { lat, lng };
        const mapDiv = document.getElementById("map")
        let map
        let marker
        let circle
        function initMap() {
            map = new google.maps.Map(mapDiv, {
                center: defaultLocation,
                zoom: 16,
            })

            if ( es_exacta === 1 ){
                marker = new google.maps.Marker({
                    position: defaultLocation,
                    map: map,
                })
            } else {
                circle = new google.maps.Circle({
                    strokeColor: "#FFFF00",
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: "#FFFF00",
                    fillOpacity: 0.35,
                    map: map,
                    center: defaultLocation,
                    radius: 400,
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function () {

            const editDesciptionButton = document.getElementById('editDesciptionButton');
            const saveDesciptionButton = document.getElementById('saveDesciptionButton');
            const editDescriptionTextarea = document.getElementById('editDescriptionTextarea');
            const form = document.getElementById('editDescriptionForm');

            editDesciptionButton?.addEventListener('click', function () {
                editDescriptionTextarea.disabled = false;
                saveDesciptionButton.disabled = false;
                editDesciptionButton.disabled = true;
            });

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                
                const formData = new FormData(form);
                formData.append('_method', 'PUT'); // Asegurarse de que el método sea PUT
                // formData.append('description', editDescriptionTextarea.value);
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.http_code === 200) {
                        editDescriptionTextarea.disabled = true;
                        saveDesciptionButton.disabled = true;
                        editDesciptionButton.disabled = false;
                        alert('Descripción guardada exitosamente.');
                    } else {
                        alert('Hubo un error al guardar la descripción.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un error al guardar la descripción.');
                });
            });
        });

        const adBelongs = @json($ad_belongs);
        const owner_phone = @json( $aviso->inmueble->user->phone );

        if (!adBelongs) {
            // Evento para el botón de enviar por correo
            document.getElementById('btn-enviar-form-single').addEventListener('click', function(event) {
                event.preventDefault();
                clearErrors();
                submitForm('{{ route('procesar_contacto') }}', 'correo');
            });

            // Evento para el botón de WhatsApp
            document.getElementById('whatsapp_contact_button').addEventListener('click', function(event) {
                event.preventDefault();
                clearErrors();
                submitForm('{{ route('procesar_contacto') }}', 'whatsapp');  // Primero validamos antes de enviar WhatsApp
            });
        }

        function submitForm(actionUrl, accion) {
            let form = document.getElementById('send_contact');
            let formData = new FormData(form);
            formData.append('current_url', window.location.href);
            formData.append('accion', accion);  // Agregamos la acción para que el backend sepa qué hacer

            fetch(actionUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status == "Success") {
                    if (accion === 'whatsapp') {
                        // Si la acción es WhatsApp, continuamos con la función sendWsp
                        sendWsp(owner_phone);
                    } else {
                        // Si la acción es correo, mostramos el mensaje de éxito
                        alert('Formulario enviado correctamente');
                        form.reset();
                    }
                } else {
                    handleErrors(data.errors);  // Si hay errores, los mostramos
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // alert('Error de comunicación con el servidor');
            });
        }


        function handleErrors(errors) {
            for (const field in errors) {
                
                const inputElement = document.querySelector(`[name="${field}"]`);
                const feedbackElement = document.getElementById(`validationServer${capitalizeFirstLetter(field)}Feedback`);

                if (inputElement && feedbackElement) {
                    inputElement.classList.add('is-invalid');
                    if(inputElement.getAttribute('id') === 'terminos') {
                        feedbackElement.textContent = 'Acepte los términos';
                    } else {
                        feedbackElement.textContent = errors[field][0];
                    }
                }
            }
        }

        function clearErrors() {
            const inputElements = document.querySelectorAll('.is-invalid');
            inputElements.forEach(element => {
                element.classList.remove('is-invalid');
            });

            const feedbackElement = document.querySelectorAll('.invalid-feedback');
            feedbackElement.forEach(element => {
                element.textContent = '';
            });
        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function sendWsp(phoneNumber) {
            const init_name = document.getElementById('nombre_contacto').value;
            const init_email = document.getElementById('email_contacto').value;
            const init_monto = document.getElementById('monto_puja')?.value;
            const init_phone = document.getElementById('telefono_contacto').value;
            const init_message = document.getElementById('contact-message').value;

            const name = init_name ? `Nombre: ${init_name}\n` : ''
            const email = init_email ? `Correo: ${init_email}\n` : ''
            const monto = init_monto ? `Monto ofrecido: ${init_monto}\n` : ''
            const phone = init_phone ? `Teléfono llamada: ${init_phone}\n` : ''
            const message = init_message ? `Mensaje: ${init_message}\n` : ''
            const currentUrl = `\n${window.location.href}`
            
            const fullMessage = `${name + email + monto + phone + message + currentUrl}`;
            var encodedMessage = encodeURIComponent(fullMessage);
            const url = `https://wa.me/+51${phoneNumber}?text=${encodedMessage}`;
            window.open(url, '_blank');
        }

        document.getElementById('redirect-button')?.addEventListener('click', function() {
            this.disabled=true;
            document.getElementById('redirect-form').submit();
        });

        document.getElementById('redirect-button-acreedor')?.addEventListener('click', function() {
            this.disabled=true;
            document.getElementById('redirect-form-acreedor').submit();
        });

        document.getElementById('acreedor-especial-post-ad')?.addEventListener('click', function() {
            this.disabled=true;
            document.getElementById('acreedor-especial-post').submit();
        });

        const avisoId = @json($aviso->id);
        const avisoType = @json($aviso->ad_type);

    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuCCuPnZoJYgILw9e3PNom-ZG5TnsGNeg&callback=initMap" async defer></script>

@endsection

@section('footer')
    @include('components.footer')
@endsection

@push('scripts')
    @vite(['resources/js/scripts/inmueble.js'])
@endpush

@push('scripts-head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush