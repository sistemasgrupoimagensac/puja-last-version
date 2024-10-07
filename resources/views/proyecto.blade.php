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

                {{-- Unidades en venta --}}
                <div class="mt-5">
                    <h3 class="fw-bold">Unidades en venta</h3>

                    {{-- <div class="my-3">
                        @php
                            $dormitorios = $unidades->pluck('dormitorios')->unique();
                        @endphp

                        @foreach ($dormitorios as $index => $dorm)
                            <input type="radio" class="btn-check" name="options-base" id="option{{ $index }}" autocomplete="off" {{ $index === 0 ? 'checked' : '' }}>
                            <label class="btn" for="option{{ $index }}">{{ $dorm }} dormitorio{{ $dorm > 1 ? 's' : '' }}</label>
                        @endforeach
                    </div> --}}

                    <div class="my-3">
                        @php
                            $dormitorios = $unidades->pluck('dormitorios')->unique();
                        @endphp
                        {{-- Generar botones dinámicamente para cada cantidad de dormitorios --}}
                        @foreach ($dormitorios as $index => $dorm)
                            <input type="radio" class="btn-check" name="options-base" id="option{{ $index }}" value="{{ $dorm }}" autocomplete="off" {{ $index === 0 ? 'checked' : '' }}>
                            <label class="btn" for="option{{ $index }}">{{ $dorm }} dormitorio{{ $dorm > 1 ? 's' : '' }}</label>
                        @endforeach
                    </div>
                    

                    <div class="border rounded shadow p-3 pb-0">
                        <div class="swiper swiperUnidadProyecto container">
                            <div class="swiper-wrapper" style="height: 400px;">
                                {{-- Recorrer las unidades y agregar clases según el número de dormitorios --}}
                                @foreach ($unidades as $unidad)
                                    <div class="swiper-slide dormitorio-{{ $unidad->dormitorios }}">
                                        <x-card-unidad-proyecto 
                                            :precioSoles="$unidad->precio_soles"
                                            :precioDolares="$unidad->precio_dolares"
                                            :area="$unidad->area"
                                            :banios="$unidad->banios"
                                            :dormitorios="$unidad->dormitorios">
                                        </x-card-unidad-proyecto>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination mt-4"></div>
                        </div>
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

        {{-- Contacto --}}
        <div class="col-lg-4 ps-lg-3">
                    
            <div class="sticky-lg-top py-3">
                <div class="rounded bg-white border shadow">
                    <form class="d-flex flex-column gap-3 p-3" method="POST" id="send_contact">
                        @csrf
                        <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">
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
                            <i class="fab fa-whatsapp"></i> 
                            Contáctenme
                        </button>

                        <div class="d-flex flex-column">
                            <small class="fw-secondary">Deseo que me contacten en:</small>
                            {{-- Selector de periodo de contacto --}}
                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                <input type="radio" class="btn-check" name="time" id="horario_contacto_manana" autocomplete="off" value="mañana" checked>
                                <label class="btn btn-outline-secondary rounded-bottom-0" for="horario_contacto1_manana">Mañana</label>
                              
                                <input type="radio" class="btn-check" name="time" id="horario_contacto_tarde" autocomplete="off" value="tarde">
                                <label class="btn btn-outline-secondary rounded-bottom-0" for="horario_contacto_tarde">Tarde</label>
                              
                                <input type="radio" class="btn-check" name="time" id="horario_contacto_noche" autocomplete="off" value="noche">
                                <label class="btn btn-outline-secondary rounded-bottom-0" for="horario_contacto_noche">Noche</label>
                            </div>
            
                            {{-- contacto por correo --}}
                            <button class="btn btn-light border-secondary-subtle rounded-top-0" id="btn-enviar-form-single">
                                <i class="fa-regular fa-envelope"></i>
                                Enviar correo
                            </button>
                        </div>

        
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

    // Evento para el botón de correo
    document.getElementById('btn-enviar-form-single').addEventListener('click', function(event) {
        event.preventDefault();
        clearFormErrors();
        submitForm('{{ route('procesar_contacto_proyecto') }}', 'correo');
    });

    // Evento para el botón de WhatsApp
    document.getElementById('whatsapp_contact_button').addEventListener('click', function(event) {
        event.preventDefault();
        clearFormErrors();
        submitForm('{{ route('procesar_contacto_proyecto') }}', 'whatsapp');  // Primero validamos antes de enviar WhatsApp
    });

    function submitForm(actionUrl, accion) {
        let form = document.getElementById('send_contact');
        let formData = new FormData(form);
        formData.append('current_url', window.location.href);
        formData.append('accion', accion);  // Agregamos la acción para que el backend sepa qué hacer

        console.log(formData);
        

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
                    // sendWsp(owner_phone);
                    sendWsp('986640912');
                } else {
                    // Si la acción es correo, mostramos el mensaje de éxito
                    alert('Formulario enviado correctamente');
                    form.reset();
                }
            } else {
                handleFormErrors(data.errors);  // Si hay errores, los mostramos
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // alert('Error de comunicación con el servidor');
        });
    }

    function handleFormErrors(errors) {
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

    function clearFormErrors() {
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


</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuCCuPnZoJYgILw9e3PNom-ZG5TnsGNeg&callback=initMap" async defer></script>

@endsection

{{-- @push('scripts')
    @vite(['resources/js/scripts/proyecto.js'])
@endpush --}}
