@extends('layouts.app')

@section('title')
    Proyecto: {{ $proyecto->nombre_proyecto }}
@endsection

@push('styles')
    @vite(['resources/sass/pages/inmueble.scss'])
@endpush

@section('content')

<div id="loader-overlay">
    <img src="{{ asset('images/loader.svg') }}" alt="Cargando...">
</div>

<div class="custom-container my-3 my-md-5">
    <div class="d-flex flex-column flex-lg-row">
    
        {{-- Caracteristicas del Proyecto --}}
        <div class="col-lg-8 pe-lg-3">
            <div class="py-3">

                {{-- Imágenes del Proyecto --}}
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper swiperProyectoImagenes2">
                    <div class="swiper-wrapper">
                        @foreach($imagenes as $n => $imagen)
                            <div class="swiper-image-container swiper-slide">
                                <img src="{{ $imagen->image_url }}" class="swiper-image" alt="Imagen del Proyecto" loading="lazy">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                
                <div thumbsSlider="" class="swiper swiperProyectoImagenes1">
                    <div class="swiper-wrapper">
                        @foreach($imagenes as $n => $imagen)
                            <div class="swiper-image-container swiper-slide">
                                <img src="{{ $imagen->image_url }}" class="swiper-image" alt="Imagen del Proyecto" loading="lazy">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Modal fullscreen con Swiper.js -->
                <div class="modal fade" id="fullscreenModal" tabindex="-1" aria-labelledby="fullscreenModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="fullscreenModalLabel">Galería de Imágenes</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <div class="swiper-container-wrapper">
                                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper swiperModalGallery">
                                        <div class="swiper-wrapper">
                                            @foreach($imagenes as $imagen)
                                                <div class="swiper-slide">
                                                    <img src="{{ $imagen->image_url }}" class="swiper-image" alt="Imagen del Proyecto" loading="lazy">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Estado del Proyecto y Fecha de Entrega --}}
                <h5 class="btn-group mt-5" role="group" aria-label="Basic example">
                    <span class="badge bg-dark-blue rounded-end-0 p-2 px-4">{{ $proyecto->progreso->estado }}</span>
                    <span class="badge text-bg-light rounded-start-0 p-2 px-4">Entrega
                        <span>{{ \Carbon\Carbon::parse($proyecto->fecha_entrega)->locale('es')->translatedFormat('F Y') }}</span>
                    </span>                    
                </h5>

                {{-- Título y Ubicación --}}
                <div class="my-4">
                    <h1 class="text-secondary m-0">{{ $proyecto->nombre_proyecto }}</h1>
                    <p class="p-0">
                        <i class="fa-solid fa-location-dot icon-orange"></i>
                        <span>{{ $proyecto->direccion }}</span>,
                        <span>{{ $proyecto->distrito }}</span>,
                        <span>{{ $proyecto->provincia }}</span>,
                        <span>{{ $proyecto->departamento }}</span>
                    </p>
                </div>

                {{-- Información de Precio y Financiamiento --}}
                <div class="d-flex justify-content-between align-items-end my-4">
                    <div class="d-flex flex-column">
                        <p class="m-0 p-0">Precio desde</p>
                        <p class="m-0 p-0 display-4 fw-semibold">S/ {{ number_format($proyecto->precio_desde, 2) }}</p>
                    </div>
                    
                    <h4 class="btn-group my-3" role="group" aria-label="Basic example">
                        <span class="badge text-bg-light p-2 px-4">Financiamiento
                            <span class="fw-light">{{ $proyecto->banco->nombre ?? 'No especificado' }}</span>
                        </span>
                    </h4>
                </div>

                {{-- Datos del Proyecto --}}
                <div class="d-flex flex-wrap justify-content-between gap-4 mt-5 px-3 py-4 border rounded shadow">
                    {{-- Unidades --}}
                    <div class="d-flex flex-column justify-content-between align-items-start align-items-md-center" style="width: 150px;">
                        <div class="d-flex">
                            <i class="fa-solid fa-house fa-lg icon-orange p-1"></i>
                            <h5 class="text-secondary m-1 fw-bold"><span>{{ $proyecto->unidades_cantidad }}</span></h5>
                        </div>
                        <h6 class="text-secondary m-0">Unidades</h6>
                    </div>

                    {{-- Área total --}}
                    <div class="d-flex flex-column justify-content-between align-items-start align-items-md-center" style="width: 150px;">
                        <div class="d-flex">
                            <i class="fa-solid fa-ruler-combined fa-lg icon-orange p-1"></i>
                            <h5 class="text-secondary m-1 fw-bold">
                                <span>{{ $proyecto->area_desde }} - {{ $proyecto->area_hasta }}</span> <span>m</span><sup>2</sup>
                            </h5>
                        </div>
                        <h6 class="text-secondary m-0">Área total</h6>
                    </div>

                    {{-- Dormitorios --}}
                    <div class="d-flex flex-column justify-content-between align-items-start align-items-md-center" style="width: 150px;">
                        <div class="d-flex">
                            <i class="fa-solid fa-bed fa-lg icon-orange p-1"></i>
                            <h5 class="text-secondary m-1 fw-bold">{{ $proyecto->dormitorios_desde }} - {{ $proyecto->dormitorios_hasta }}</h5>
                        </div>
                        <h6 class="text-secondary m-0">Dorm. </h6>
                    </div>

                    {{-- Baños --}}
                    <div class="d-flex flex-column justify-content-between align-items-start align-items-md-center" style="width: 150px;">
                        <div class="d-flex">
                            <i class="fa-solid fa-bath fa-lg icon-orange p-1"></i>
                            <h5 class="text-secondary m-1 fw-bold">{{ $proyecto->banios_desde }} - {{ $proyecto->banios_hasta }}</h5>
                        </div>
                        <h6 class="text-secondary m-0">Baños </h6>
                    </div>
                </div>

                {{-- Descripción del Proyecto --}}
                <div class="mt-5">
                    <h3 class="fw-bold">Descripción</h3>
                    <p>{{ $proyecto->descripcion }}</p>
                </div>

                {{-- Geolocalización --}}
                <div class="mt-5">
                    <h3 class="fw-bold">Localización</h3>
                    <p class="p-0">
                        <i class="fa-solid fa-location-dot icon-orange"></i>
                        <span>{{ $proyecto->direccion }}</span>,
                        <span>{{ $proyecto->distrito }}</span>,
                        <span>{{ $proyecto->provincia }}</span>,
                        <span>{{ $proyecto->departamento }}</span>
                    </p>
                    @if ($proyecto->latitude && $proyecto->longitude)
                        <div class="mt-3" id="map" style="height: 400px; width: 100%"></div>
                    @endif
                </div>
            </div>  
        </div>

        <div class="col-lg-4 ps-lg-3">
                    
            <div class="sticky-lg-top py-3">
                <div class="rounded bg-white border shadow">
                    <form class="d-flex flex-column gap-3 p-3" method="POST" id="send_contact">
                        @csrf
                        <input type="hidden" name="aviso_id" value="{{ $proyecto->id }}">
                        <div class="d-flex justify-content-between align-items-center">

                            <h5 class="form-title m-0">Contactar</h5>
                            {{-- <i class="fa-solid fa-arrow-down fa-lg me-1"></i> --}}
                            <i class="fa-solid fa-envelope-open-text fa-2x me-1 icon-orange"></i>
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
                            <label for="terminos">Acepto los <a href="/terminos-uso" target="_blank" class="custom-link-register text-decoration-none">Términos y Condiciones de Uso</a> y las <a href="/politica-privacidad" target="_blank" class="custom-link-register text-decoration-none">Políticas de Privacidad</a></label>
                            <div id="validationServerAccept_termsFeedback" class="invalid-feedback position-absolute top-100 px-4"></div>
                        
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>

<script>
    // Coordenadas del proyecto
    const lat = parseFloat(@json($proyecto->latitude));
    const lng = parseFloat(@json($proyecto->longitude));
    const defaultLocation = { lat, lng };
    const mapDiv = document.getElementById("map");
    let map, marker;

    // Inicializar el mapa
    function initMap() {
        // Definir los estilos para ocultar POI
        const mapStyles = [
            {
                featureType: "poi", // Puntos de interés
                stylers: [{ visibility: "off" }] // Ocultar POI
            },
            {
                featureType: "transit.station", // Paraderos de buses, metro, etc.
                stylers: [{ visibility: "off" }] // Ocultar estaciones de transporte
            }
        ];

        // Crear el mapa con estilos y configuración inicial
        map = new google.maps.Map(mapDiv, {
            center: defaultLocation,
            zoom: 16,
            styles: mapStyles, // Aplicar los estilos para ocultar POI
        });

        // Añadir marcador personalizado
        marker = new google.maps.Marker({
            position: defaultLocation,
            map: map,
            icon: {
                url: "/images/svg/marker_puja.svg",
                scaledSize: new google.maps.Size(80, 80),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(40, 80)
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        if (mapDiv) {
            initMap();
        }
    });
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuCCuPnZoJYgILw9e3PNom-ZG5TnsGNeg&callback=initMap" async defer></script>

@endsection

@push('scripts')
    @vite(['resources/js/scripts/proyecto.js'])
@endpush
