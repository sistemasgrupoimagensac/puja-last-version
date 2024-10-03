@extends('layouts.app')

@section('title')
    Proyecto
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
        
            {{-- Caracteristicas del inmueble --}}
            <div class="col-lg-8 pe-lg-3">
                <div class="py-3">

                    {{-- Imagenes --}}
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper swiperProyectoImagenes2">
                        <div class="swiper-wrapper">
                            <div class="swiper-image-container swiper-slide">
                                <img src="{{ $aviso->inmueble->imagenPrincipal() }}" class="swiper-image" alt="{{ $aviso->inmueble->title() }}" loading="lazy">
                            </div>
                            @foreach($aviso->inmueble->imagenes as $n => $image)
                                <div class="@if($n == 0) second-image @elseif($n == 1) third-image @else d-none  @endif swiper-image-container swiper-slide">
                                    <img src="{{ $image->imagen }}" class="swiper-image" alt="{{ $aviso->inmueble->title() }}" loading="lazy">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    
                    <div thumbsSlider="" class="swiper swiperProyectoImagenes1">
                        <div class="swiper-wrapper">
                            <div class="swiper-image-container swiper-slide">
                                <img src="{{ $aviso->inmueble->imagenPrincipal() }}" class="swiper-image" alt="{{ $aviso->inmueble->title() }}" loading="lazy">
                            </div>
                            @foreach($aviso->inmueble->imagenes as $n => $image)
                                <div class="@if($n == 0) second-image @elseif($n == 1) third-image @else d-none  @endif swiper-image-container swiper-slide">
                                    <img src="{{ $image->imagen }}" class="swiper-image" alt="{{ $aviso->inmueble->title() }}" loading="lazy">
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
                                    <!-- Container para controlar el tamaño de las imágenes -->
                                    <div class="swiper-container-wrapper">
                                        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper swiperModalGallery">
                                            <div class="swiper-wrapper">
                                                <!-- Imagen principal -->
                                                <div class="swiper-slide">
                                                    <img src="{{ $aviso->inmueble->imagenPrincipal() }}" class="swiper-image" alt="{{ $aviso->inmueble->title() }}" loading="lazy">
                                                </div>
                                                <!-- Otras imágenes del inmueble -->
                                                @foreach($aviso->inmueble->imagenes as $n => $image)
                                                <div class="swiper-slide">
                                                    <img src="{{ $image->imagen }}" class="swiper-image" alt="{{ $aviso->inmueble->title() }}" loading="lazy">
                                                </div>
                                                @endforeach
                                            </div>
                                            <!-- Botones de navegación de Swiper -->
                                            <div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Badget de entrega y estado --}}
                    <h5 class="btn-group mt-5" role="group" aria-label="Basic example">
                        <span class="badge bg-dark-blue rounded-end-0 p-2 px-4">En construcción</span>
                        <span class="badge text-bg-light rounded-start-0 p-2 px-4">Entrega
                            <span>diciembre 2025</span>
                        </span>
                    </h5>

                    <div class="my-4">
                        {{-- Titulo --}}
                        <h1 class=" text-secondary m-0">C. Gonzales 239</h1>
    
                        {{-- Ubicación --}}
                        <p class="p-0">
                            <i class="fa-solid fa-location-dot icon-orange"></i>
                            <span>{{ $aviso->inmueble->address() }}</span> {{-- address --}}
                            <span>, </span>
                            <span>{{ $aviso->inmueble->distrito() }}</span> {{-- district --}}
                            <span>, </span>
                            <span>{{ $aviso->inmueble->provincia() }}</span> {{-- departament --}}
                        </p>
                    </div>

                    <div class="d-flex justify-content-between align-items-end my-">

                        {{-- Precio --}}
                        <div class="d-flex flex-column">
                            <p class="m-0 p-0">precio desde</p>
                            <p class="m-0 p-0 display-4 fw-semibold">S/ 423,000 <span class="h3 fw-light">($ 120,000)</span></p>
                            
                        </div>
                        
                        {{-- Financiamiento --}}
                        <h4 class="btn-group my-3" role="group" aria-label="Basic example">
                            <span class="badge text-bg-light p-2 px-4">Financiamiento 
                                <span class="fw-light">Banco BCP</span>
                            </span>
                        </h4>

                    </div>

                    {{-- Datos del Proyecto --}}
                    <div class="d-flex flex-wrap justify-content-between gap-4 mt-5 px-3 py-4 border rounded shadow">

                        {{-- unidades --}}
                        @if(true)
                            <div class="d-flex flex-column justify-content-between align-items-start align-items-md-center" style="width: 150px;">
                                <div class="d-flex">
                                    <i class="fa-solid fa-house fa-lg icon-orange p-1"></i>

                                    <h5 class="text-secondary m-1 fw-bold"> 
                                        <span>23</span>
                                    </h5>
                                </div>
                                <h6 class="text-secondary m-0"> unidades </h6>
                            </div>
                        @endif

                        {{-- area total --}}
                        @if($aviso->inmueble->area())
                            <div class="d-flex flex-column justify-content-between align-items-start align-items-md-center" style="width: 150px;">
                                <div class="d-flex">
                                    <i class="fa-solid fa-ruler-combined fa-lg icon-orange p-1"></i>
                                    <h5 class="text-secondary m-1 fw-bold"> 
                                        <span>40 - 78</span>
                                        <span>m</span>
                                        <sup>2</sup>
                                    </h5>
                                </div>
                                <h6 class="text-secondary m-0"> area total </h6>
                            </div>
                        @endif
                        
                        {{-- area techada --}}
                        @if($aviso->inmueble->areaConstruida())
                            <div class="d-flex flex-column justify-content-between align-items-start align-items-md-center" style="width: 150px;">
                                <div class="d-flex">
                                    <i class="fa-solid fa-ruler-combined fa-lg icon-orange p-1"></i>
                                    <h5 class="text-secondary m-1 fw-bold"> 
                                        <span>40 - 78</span>
                                        <span>m</span>
                                        <sup>2</sup>
                                    </h5>
                                </div>
                                <h6 class="text-secondary m-0"> area construida </h6>
                            </div>
                        @endif

                        {{-- dormitorios --}}
                        @if($aviso->inmueble->dormitorios())
                            <div class="d-flex flex-column justify-content-between align-items-start align-items-md-center" style="width: 150px;">
                                <div class="d-flex">
                                    <i class="fa-solid fa-bed fa-lg icon-orange p-1"></i>
                                    <h5 class="text-secondary m-1 fw-bold"> 1 - 3 </h5>
                                </div>
                                <h6 class="text-secondary m-0"> dorm. </h6>
                            </div>
                        @endif

                        {{-- baño completo --}}
                        @if($aviso->inmueble->banios())
                            <div class="d-flex flex-column justify-content-between align-items-start align-items-md-center" style="width: 150px;">
                                <div class="d-flex">
                                    <i class="fa-solid fa-bath fa-lg icon-orange p-1"></i>
                                    <h5 class="text-secondary m-1 fw-bold"> 1 - 3 </h5>
                                </div>
                                <h6 class="text-secondary m-0"> bañ. </h6>
                            </div>
                        @endif

                    </div>

                    {{-- Unidades en venta --}}
                    <div class="mt-5">
                        <h3 class="fw-bold">Unidades en venta</h3>

                        <div class=" my-3">

                            <input type="radio" class="btn-check" name="options-base" id="option5" autocomplete="off" checked>
                            <label class="btn" for="option5">1 dormitorio</label>
    
                            <input type="radio" class="btn-check" name="options-base" id="option6" autocomplete="off">
                            <label class="btn" for="option6">2 dormitorios</label>
    
                            <input type="radio" class="btn-check" name="options-base" id="option7" autocomplete="off">
                            <label class="btn" for="option7">3 dormitorios</label>
    
                            <input type="radio" class="btn-check" name="options-base" id="option8" autocomplete="off">
                            <label class="btn" for="option8">4 dormitorios</label>

                        </div>

                        <div class=" border rounded shadow p-3 pb-0">

                            <div class="swiper swiperUnidadProyecto container">
                                <div class="swiper-wrapper" style="height: 400px;">
                                    <x-card-unidad-proyecto></x-card-unidad-proyecto>
                                    <x-card-unidad-proyecto></x-card-unidad-proyecto>
                                    <x-card-unidad-proyecto></x-card-unidad-proyecto>
                                    <x-card-unidad-proyecto></x-card-unidad-proyecto>
                                    <x-card-unidad-proyecto></x-card-unidad-proyecto>
                                    <x-card-unidad-proyecto></x-card-unidad-proyecto>
                                </div>
                                <div class="swiper-pagination mt-4"></div>
                            </div>

                        </div>
                    </div>

                    {{-- Descripción --}}
                    <div class="mt-5">
                        <h3 class="fw-bold">Descripción</h3>

                        <p>
                            Innovador proyecto en San Miguel. Cuenta con coworking, zona de parrillas, piscina, gimnasio, zona gourmet y otros. Céntrico y cercano a Plaza San Miguel, Open Plaza, Parque de las leyendas e instituciones educativas
                        </p>
                    </div>



                    {{-- Más Características --}}
                    {{-- <div class="mt-5">
                        <h3 class="fw-bold">Más Características</h3>

                        <ul class="list-unstyled d-flex flex-wrap justify-content-between">
                            @foreach($aviso->inmueble->extra->caracteristicas as $caracteristica)
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
                    </div> --}}

                    {{-- Comodidades --}}
                    {{-- @if(!$inmueble_en_remate)
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
                    @endif --}}

                    {{-- Geolocalización --}}
                    <div class="mt-5">
                        <h3 class="fw-bold">Localización</h3>

                        {{-- direccion --}}
                        <p class="p-0">
                            <i class="fa-solid fa-location-dot icon-orange"></i>
                            <span>{{ $aviso->inmueble->address() }}</span> {{-- address --}}
                            <span>, </span>
                            <span>{{ $aviso->inmueble->distrito() }}</span> {{-- district --}}
                            <span>, </span>
                            <span>{{ $aviso->inmueble->provincia() }}</span> {{-- departament --}}
                        </p>

                        @if ($aviso->inmueble->principal->ubicacion->latitud)
                            <div class="mt-3" id="map" style="height: 600px; width: 100%"></div>
                        @endif
                    </div>
                </div>  
            </div>

            {{-- Aside Formulario Contacto --}}
            <div class="col-lg-4 ps-lg-3">
                    
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

        const lat = parseFloat(@json($aviso->inmueble->principal->ubicacion->latitud));
        const lng = parseFloat(@json($aviso->inmueble->principal->ubicacion->longitud));
        const es_exacta = parseFloat(@json($aviso->inmueble->principal->ubicacion->es_exacta));
        const defaultLocation = { lat, lng };
        const mapDiv = document.getElementById("map")
        let map
        let marker
        let circle
        function initMap() {

            // Definir los estilos para ocultar POI (puntos de interés) y otros elementos.
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

            map = new google.maps.Map(mapDiv, {
                center: defaultLocation,
                zoom: 16,
                styles: mapStyles,
            })

            if ( es_exacta === 1 ){
                marker = new google.maps.Marker({
                    position: defaultLocation,
                    map: map,
                    icon: {
                        url: "/images/svg/marker_puja.svg",
                        scaledSize: new google.maps.Size(80, 80), 
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(40, 80)
                    }
                })
            } else {
                circle = new google.maps.Circle({
                    strokeColor: "#fb7125",
                    strokeOpacity: 0,
                    strokeWeight: 2,
                    fillColor: "#fb7125",
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