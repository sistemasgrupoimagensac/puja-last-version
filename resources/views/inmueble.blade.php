@extends('layouts.app')

@section('title')
    Inmueble
@endsection

@push('styles')
    @vite(['resources/sass/pages/inmueble.scss'])
@endpush

@section('header')
    @include('components.header')
@endsection

@section('content')
    <div class="custom-container my-2">
        <div class="d-flex flex-column flex-lg-row">
        
            {{-- Caracteristicas del inmueble --}}
            <div class="col-lg-8 pe-lg-3">
                <div class="py-3">

                    {{-- Imagenes --}}
                    <div class="images-wrapper position-relative" data-bs-toggle="modal" data-bs-target="#ImagesProperty">
                        
                        @if ($aviso->ad_type === 3)
                            <div class="ribbon premium">Premium</div>
                        @elseif ($aviso->ad_type === 2)
                            <div class="ribbon top">Top</div>
                        @endif

                        <div class="first-image card-image-container shadow">
                            <img src="{{ $aviso->inmueble->imagenPrincipal() }}" class="card-image-custom rounded" alt="{{ $aviso->inmueble->title() }}">
                        </div>
                        {{-- @foreach($aviso->inmueble->imagenes as $n => $image)
                            <div class="@if($n == 0) second-image @elseif($n == 1) third-image @else  @endif card-image-container shadow">
                                <img src="{{ $image->imagen }}" class="card-image-custom rounded" alt="{{ $aviso->inmueble->title() }}">
                            </div>
                        @endforeach --}}
                        @foreach($aviso->inmueble->imagenes as $n => $image)
                            <div class="@if($n == 0) first-image @elseif($n == 1) second-image @elseif($n == 2) third-image @else  @endif card-image-container shadow">
                                <img src="{{ $image->imagen }}" class="card-image-custom rounded" alt="{{ $aviso->inmueble->title() }}">
                            </div>
                        @endforeach

                    </div>
                    
                    {{-- modal --}}
                    <div class="modal fade" id="ImagesProperty" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered inmueble-modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-body p-0 bg-secondary">

                                    {{-- imagenes carrusel --}}
                                    <div id="carouselImagesInmueble" class="carousel slide carousel-fade">
                                        <div class="carousel-inner">
                                            @foreach($aviso->inmueble->imagenes as $image)
                                            <div class="carousel-item @if($loop->first) active @endif">
                                                <img src="{{ $image->imagen }}" class="d-block w-100" alt="{{ $aviso->inmueble->title() }}">
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

                    {{-- Card - Datos del inmueble --}}
                    <div class="custom-container mt-4 p-3 rounded bg-body-secondary d-flex flex-row justify-content-between align-items-end flex-md-column align-items-md-stretch shadow">

                        <div class="d-flex flex-column flex-md-row justify-content-between">
                            <div>
                                
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

                            {{-- Precio del inmueble Remate --}}
                            @if($aviso->inmueble->remate_precio_base())
                                <div class="d-flex flex-column align-items-start align-items-md-end mt-4 mt-md-0">
                                    <small class="text-prim">Precio base remate</small>
                                    <h2 class="m-0 fw-bolder text-primary">
                                        <span>{{ $aviso->inmueble->currencyDolares() }}</span>
                                        <span> {{ $aviso->inmueble->remate_precio_base() }} </span>
                                    </h2>
                                    <small class="mt-3">Valor de la tasación</small>
                                    <h3 class="m-0 fw-bolder text-secondary">
                                        <small>{{ $aviso->inmueble->currencyDolares() }}</small>
                                        <span> {{ $aviso->inmueble->remate_valor_tasacion() }} </span>
                                    </h3>
                                </div>
                            @endif

                        </div>


                        <h4 class="p-0 m-0 mt-4">
                            ID: {{ $aviso->id }}
                        </h4>

                    </div>

                    {{-- Card - Remate (OPCIONAL) --}}
                        
                    @if($aviso->inmueble->remate_precio_base())
                        <div class="description-container mt-4 bg-primary-subtle text-bg-light p-3 rounded shadow">
                            <h3 class="fw-bold">Detalles del Remate</h3>

                            @if($aviso->inmueble->remate_direccion())
                                <p>
                                    <span class="fw-bolder">Lugar del remate:</span>
                                    {{ $aviso->inmueble->remate_direccion() }}
                                </p>
                            @endif

                            @if($aviso->inmueble->remate_fecha())
                                <p>
                                    <span class="fw-bolder">Fecha y hora:</span>
                                    {{ $aviso->inmueble->remate_fecha() }} {{ $aviso->inmueble->remate_hora() ? $aviso->inmueble->remate_hora() : "" }}
                                </p>
                            @endif

                            @if($aviso->inmueble->remate_nombre_contacto())
                                <p>
                                    <span class="fw-bolder">Contacto:</span>
                                    {{ $aviso->inmueble->remate_nombre_contacto() }}
                                </p>
                            @endif

                            @if($aviso->inmueble->remate_telef_contacto())
                                <p>
                                    <span class="fw-bolder">Teléfono:</span>
                                    {{ $aviso->inmueble->remate_telef_contacto() }}
                                </p>
                            @endif

                            @if($aviso->inmueble->remate_partida_registral())
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

                    {{-- Card - descripción Osquitar IA --}}
                    <div class="description-container mt-5">
                        <h3 class="fw-bold">Descripción</h3>

                        <p class="text-secondary">
                            {{$aviso->inmueble->descripcion}}
                        </p>
                    </div>

                    {{-- Card - descripción --}}
                    <div class="description-container mt-5">
                        <h3 class="fw-bold">Sobre este inmueble</h3>

                        <p class="fw-bold">Antigüedad: 
                            <span>15</span>
                            años
                        </p>
                        <p class="short-text" id="shortText">{!! nl2br($aviso->inmueble->shortDescription()) !!}</p>
                        <p class="full-text" id="fullText">{!! nl2br($aviso->inmueble->description()) !!}</p>
                        @if(strlen($aviso->inmueble->shortDescription()) > $aviso->inmueble->charLimit())
                            <button class="ver-mas-btn btn btn-secondary" id="verMasBtn">Ver más</button>
                            <button class="ver-menos-btn btn btn-secondary" id="verMenosBtn">Ver menos</button>
                        @endif
                    </div>

                    {{-- Adicionales --}}
                    <div class="mt-5">
                        <h3 class="fw-bold">Más Características</h3>

                        <ul class="list-unstyled d-flex flex-wrap justify-content-between">
                            {{-- @dd($aviso->inmueble->extra->caracteristicas); --}}
                            @foreach($aviso->inmueble->extra->caracteristicas as $caracteristica)
                                {{-- <li>{{ $caracteristica->caracteristica }}: {{ $caracteristica->id }}</li> --}}
                                @if ( $caracteristica->categoria_caracteristica_id == 1 )
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

                </div>  
            </div>

            {{-- Aside Formulario Contacto --}}
            <div class="col-lg-4 ps-lg-3">

                @if ( $ad_belongs )

                    @if ( !$publicado )
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
                                        <input type="radio" class="btn-check" name="btnradio" id="btnPremiumAds" autocomplete="off" checked>
                                        <label class="btn btn-outline-secondary" for="btnPremiumAds">Premium Ads: <span id="premiumAdsRemaining"></span></label>
                                      
                                        <input type="radio" class="btn-check" name="btnradio" id="btnTopAds" autocomplete="off">
                                        <label class="btn btn-outline-secondary" for="btnTopAds">Top Ads: <span id="topAdsRemaining"></span></label>
                                      
                                        <input type="radio" class="btn-check" name="btnradio" id="btnTypicalAds" autocomplete="off">
                                        <label class="btn btn-outline-secondary" for="btnTypicalAds">Typical Ads: <span id="typicalAdsRemaining"></span></label>
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
                                    <label class="text-secondary" for="email_contacto">Correo electrónico</label>
                                    <div id="validationServerEmail_contactoFeedback" class="invalid-feedback"></div>
                                </div>  

                                <div class="form-floating">
                                    <input type="phone" class="form-control" id="telefono_contacto" maxlength="9" minlength="9" name="telefono_contacto" placeholder="Teléfono" required>
                                    <label class="text-secondary" for="telefono_contacto">Teléfono</label>
                                    <div id="validationServerTelefono_contactoFeedback" class="invalid-feedback"></div>
                                </div>  

                                @if ( $aviso->inmueble->is_puja() )
                                    <div class="input-group">
                                        <div class="input-group">
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="contact_divisa_monto" value="1" id="soles" autocomplete="off" checked>
                                                <label class="btn btn-outline-secondary" for="soles" style="width: 40px">S/</label>
                                              
                                                <input type="radio" class="btn-check" name="contact_divisa_monto" value="2" id="dolares" autocomplete="off">
                                                <label class="btn btn-outline-secondary rounded-end-0" for="dolares" style="width: 40px">$</label>
                                            </div>

                                            <input type="text" class="form-control" name="contact_monto_puja" placeholder="" aria-label="Example text with two button addons">

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
                                <x-whatsapp-modal-inmueble-contact></x-whatsapp-modal-inmueble-contact>
                
                                {{-- contacto por correo --}}
                                <button class="btn btn-light border-secondary-subtle" id="btn-enviar-form-single">
                                    <i class="fa-regular fa-paper-plane"></i> Enviar
                                </button>

                                <x-puja-modal-contact :monto="number_format($aviso->inmueble->precioSoles())"></x-puja-modal-contact>
                
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
        const adBelongs = @json($ad_belongs);
        const owner_phone = @json( $aviso->inmueble->user->phone );

        if(!adBelongs) {
            document.getElementById('btn-enviar-form-single').addEventListener('click', function(event) {
                event.preventDefault();
                clearErrors();
                submitForm('{{ route('email.enviar-datos_contacto') }}');
            });

            document.getElementById('whatsapp_contact_button').addEventListener('click', function(event) {
                event.preventDefault();
                console.log( "cel", owner_phone )
                sendWsp( owner_phone );
            });
        }

        function submitForm(actionUrl) {
            let form = document.getElementById('send_contact');
            let formData = new FormData(form);
            formData.append('current_url', window.location.href);

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
                    alert('Formulario enviado correctamente');
                    form.reset();
                } else {
                    handleErrors(data.errors);
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
            document.getElementById('redirect-form').submit();
        });

        const avisoId = @json($aviso->id);
        const avisoType = @json($aviso->ad_type);

    </script>

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