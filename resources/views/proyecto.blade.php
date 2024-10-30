@extends('layouts.app')

@section('title')
    Proyecto: {{ $proyecto->nombre_proyecto }}
@endsection

@push('styles')
    @vite(['resources/sass/pages/inmueble.scss'])
@endpush

@section('header')
    @include('components.header')
@endsection

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
                        <p class="m-0 p-0 display-4 fw-semibold">S/ {{ number_format($proyecto->precio_desde, 0) }}</p>
                    </div>
                    
                    <h4 class="btn-group my-3" role="group">
                        <span class="badge text-bg-light p-2">
                            <span class=" me-3">Financiamiento</span>
                            <span class="fw-light">
                                {{-- {{ $proyecto->banco->nombre ?? 'No especificado' }} --}}
                                <img src="/images/bancos/{{ $proyecto->banco->nombre }}.png" alt="" style="height: 50px" class=" rounded rounded-2">

                            </span>
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

                    <div class="my-3">
                        @php
                            // Obtener los dormitorios, hacerlos únicos y luego ordenarlos en orden ascendente
                            $dormitorios = $unidades->pluck('dormitorios')->unique()->sort();
                        @endphp
                        {{-- Generar botones dinámicamente para cada cantidad de dormitorios --}}
                        @foreach ($dormitorios as $index => $dorm)
                            <input type="radio" class="btn-check" name="options-base" id="option{{ $index }}" value="{{ $dorm }}" autocomplete="off" {{ $index === 0 ? 'checked' : '' }}>
                            <label class="btn" for="option{{ $index }}">{{ $dorm }} dormitorio{{ $dorm > 1 ? 's' : '' }}</label>
                        @endforeach
                    </div>
                    

                    <div class="border rounded shadow p-3 pb-0">
                        <div class="swiper swiperUnidadProyecto container">
                            <div class="swiper-wrapper" id="unidadesSwiperWrapper" style="height: 430px;">
                                {{-- Recorrer las unidades y agregar clases según el número de dormitorios --}}
                                @foreach ($unidades as $unidad)
                                    @php
                                        // Obtener la primera imagen de la unidad, si existe
                                        $primeraImagen = $unidad->imagenes()->where('estado', 1)->first();
                                        $imagenUrl = $primeraImagen ? $primeraImagen->image_url : null;
                                    @endphp

                                    <div class="swiper-slide dormitorio-{{ $unidad->dormitorios }}" data-dormitorios="{{ $unidad->dormitorios }}">
                                        <x-card-unidad-proyecto 
                                            :precioSoles="$unidad->precio_soles"
                                            :precioDolares="$unidad->precio_dolares"
                                            :area="$unidad->area"
                                            :banios="$unidad->banios"
                                            :dormitorios="$unidad->dormitorios"
                                            :imagenUrl="$imagenUrl"
                                            :unidadId="$unidad->id">
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

            {{-- <div id="map" style="max-width: 600px; width: 100%; height: 600px; border: 1px solid #ddd;"></div> --}}

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
                            <i class="fab fa-whatsapp text-success fa-lg"></i> 
                            Contáctenme ahora
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

    {{-- Modal planos unidad con carrusel dinámico --}}
    <div class="modal fade" id="unidadModal" tabindex="-1" aria-labelledby="unidadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="unidadModalLabel">Imágenes de la Unidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body align-items-end">
                    <!-- Carrusel de Bootstrap para las imágenes -->
                    <div id="unidadCarousel" class="carousel slide carousel-fade">
                        <div class="carousel-inner" id="unidadImgContainer">
                            <!-- Aquí se cargarán las imágenes dinámicamente -->
                        </div>
                        <!-- Controles del carrusel -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#unidadCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#unidadCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>

    // Coordenadas del proyecto
    const lat_saved = @json($proyecto->latitude);
    const lng_saved = @json($proyecto->longitude);

    document.addEventListener('DOMContentLoaded', function () {
        const unidadModal = document.getElementById('unidadModal');
        const unidadImgContainer = document.getElementById('unidadImgContainer');
        const sendContactForm = document.getElementById('send_contact');
        const contactButton = document.getElementById('btn-enviar-form-single');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const messageField = document.getElementById('contact-message');
        const swiperWrapper = document.getElementById('unidadesSwiperWrapper');
        const filterButtons = document.querySelectorAll('input[name="options-base"]');

        // Eventos de contacto
        document.getElementById('btn-enviar-form-single').addEventListener('click', (e) => handleContactForm(e, 'correo'));
        document.getElementById('whatsapp_contact_button').addEventListener('click', (e) => handleContactForm(e, 'whatsapp'));

        function handleContactForm(event, actionType) {
            event.preventDefault();
            clearFormErrors();
            submitForm('{{ route('procesar_contacto_proyecto') }}', actionType);
        }

        const phoneContacto = @json( $proyecto->cliente->telefono_contacto );

        function submitForm(actionUrl, accion) {
            let formData = new FormData(sendContactForm);
            formData.append('current_url', window.location.href);
            formData.append('accion', accion);

            fetch(actionUrl, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "Success") {
                    accion === 'whatsapp' ? sendWsp(phoneContacto) : alert('Formulario enviado correctamente');
                    sendContactForm.reset();
                } else {
                    handleFormErrors(data.errors);
                }
            })
            .catch(console.error);
        }

        function handleFormErrors(errors) {
            for (const field in errors) {
                const inputElement = document.querySelector(`[name="${field}"]`);
                const feedbackElement = document.getElementById(`validationServer${capitalizeFirstLetter(field)}Feedback`);

                if (inputElement && feedbackElement) {
                    inputElement.classList.add('is-invalid');
                    feedbackElement.textContent = errors[field][0];
                }
            }
        }

        function clearFormErrors() {
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function sendWsp(phoneNumber) {
            const formData = new FormData(sendContactForm);
            const message = `Nombre: ${formData.get('nombre_contacto')}\nCorreo: ${formData.get('email_contacto')}\nTeléfono: ${formData.get('telefono_contacto')}\nMensaje: ${formData.get('contact_message')}\n${window.location.href}`;
            window.open(`https://wa.me/+51${phoneNumber}?text=${encodeURIComponent(message)}`, '_blank');
        }

        // Agregar funcionalidad para el botón "COTIZAR" de cada unidad
        document.querySelectorAll('.btn-cotizar').forEach(button => {
            button.addEventListener('click', function () {
                // Obtener información de la unidad
                const unidadId = this.getAttribute('data-unidad-id');
                const dorm = this.closest('.card').querySelector('.fa-bed + span').textContent.trim(); // Obtener número de dormitorios
                const precio = this.closest('.card').querySelector('.h4.fw-bold').textContent.trim(); // Obtener precio en soles

                // Rellenar el mensaje dinámico
                messageField.value = `Deseo una cotizacion por la unidad de ${dorm} domitorio(s), con un precio de ${precio}. Gracias.`;

                // Simular clic en el botón de enviar correo del formulario
                contactButton.click();
            });
        });

        // Manejar la carga dinámica de imágenes de las unidades
        unidadModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Botón que activa el modal
            const unidadId = button.getAttribute('data-unidad-id');
            loadUnitImages(unidadId);
        });

        function loadUnitImages(unidadId) {
            unidadImgContainer.innerHTML = ''; // Limpiar contenedor

            fetch(`/unidades/${unidadId}/imagenes`, {
                method: 'GET',
                headers: { 'X-CSRF-TOKEN': csrfToken }
            })
            .then(response => response.json())
            .then(data => {
                if (data.images && data.images.length > 0) {
                    unidadImgContainer.innerHTML = `
                        <div id="carouselUnidadImages" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                ${data.images.map((image, index) => `
                                    <div class="carousel-item ${index === 0 ? 'active' : ''}">
                                        <img src="${image.image_url}" alt="Imagen de la Unidad" class="d-block w-100">
                                    </div>
                                `).join('')}
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselUnidadImages" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Anterior</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselUnidadImages" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Siguiente</span>
                            </button>
                        </div>`;
                } else {
                    unidadImgContainer.innerHTML = '<p class="text-center">No hay imágenes para esta unidad.</p>';
                }
            })
            .catch(error => {
                console.error('Error al cargar las imágenes:', error);
                unidadImgContainer.innerHTML = '<p class="text-center">Error al cargar las imágenes.</p>';
            });
        }

        // Añadir eventos a los botones de filtro
        filterButtons.forEach(button => {
            button.addEventListener('change', function () {
                const selectedDorm = this.value; // Obtener el número de dormitorios seleccionado
                filterUnitsByDorms(selectedDorm);
            });
        });

        // Función para mostrar/ocultar slides basado en el número de dormitorios
        function filterUnitsByDorms(selectedDorm) {
            const slides = swiperWrapper.querySelectorAll('.swiper-slide');
            let visibleSlideCount = 0;

            // Mostrar solo las slides que coinciden con el filtro y contar las visibles
            slides.forEach(slide => {
                const dorms = slide.getAttribute('data-dormitorios');
                if (dorms === selectedDorm) {
                    slide.style.display = ''; // Mostrar la slide
                    visibleSlideCount++; // Incrementar el contador de slides visibles
                } else {
                    slide.style.display = 'none'; // Ocultar la slide
                }
            });

            // Actualizar Swiper para reflejar los cambios en las slides visibles
            swiperUnidadProyecto.update(); // Forzar la actualización de Swiper
            adjustSwiperPagination(visibleSlideCount); // Ajustar la paginación de Swiper
        }

        // Ajustar la paginación de Swiper basada en la cantidad de slides visibles
        function adjustSwiperPagination(visibleCount) {
            // Si hay menos de 4 slides visibles, ocultar la paginación
            const swiperPagination = document.querySelector('.swiper-pagination');
            if (visibleCount <= 4) {
                swiperPagination.style.display = 'none';
            } else {
                swiperPagination.style.display = 'block';
            }
        }

        // Filtro inicial para el valor predeterminado (el primer valor seleccionado)
        const initialFilter = document.querySelector('input[name="options-base"]:checked').value;
        filterUnitsByDorms(initialFilter);
        
    });
</script>

@endsection


@section('footer')
    @include('components.footer')
@endsection

@push('scripts')
    @vite([ 'resources/js/scripts/proyecto_maps.js', ])
@endpush