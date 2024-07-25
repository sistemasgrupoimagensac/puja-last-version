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
  <div class="custom-container my-2" {{-- x-data="showRemate()" --}}>

    <div class="d-flex flex-column flex-lg-row">

      {{-- Caracteristicas del inmueble --}}
      <div class="col-lg-8 pe-lg-3">
        <div class="py-3">

          {{-- Imagenes --}}
          <div class="images-wrapper position-relative" data-bs-toggle="modal" data-bs-target="#ImagesProperty">
            
            <div class="ribbon premium">Premium</div>
    
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
                @if($aviso->inmueble->precioSoles())
                    <div class="d-flex flex-column align-items-start align-items-md-end mt-4 mt-md-0">
                        <h2 class="m-0 fw-bolder">
                            <span>{{ $aviso->inmueble->currencySoles() }}</span>
                            <span>{{ number_format($aviso->inmueble->precioSoles()) }}</span>
                        </h2>
                        <h3 class="m-0 fw-bolder text-secondary">
                            <small>{{ $aviso->inmueble->currencyDolares() }}</small>
                            <small>{{ number_format($aviso->inmueble->precioDolares()) }}</small>
                        </h3>
                    </div>
                @endif

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
                    <span>{{ $aviso->inmueble->area() }}</span>
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
                    <span>{{ $aviso->inmueble->areaConstruida() }}</span>
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
                        <button class="btn btn-danger fs-5 rounded-top-0" id="redirect-button">
                          <i class="fa-solid fa-plus "></i>
                          Plan
                        </button>
                        <form id="redirect-form" action="{{ route('pagar.planes_propietario') }}" method="POST" style="display: none;">
                          @csrf
                          <input type="hidden" name="aviso_id" value="{{ $aviso->id }}">
                        </form>
                      </div>

                      <div id="plans-container" class=" d-flex flex-column gap-3">
                        <!-- Las cards se agregarán aquí dinámicamente -->
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            @endif


            <!-- Modal -->
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
                      <button type="button" class="btn button-orange w-100" id="siUsarEstePlan">SI</button>

                    </div>
                  </div>
                </div>
              </div>
            </div>

          @else
            
            <div class="sticky-lg-top py-3">

              <div class="rounded bg-white border shadow">
                <form class="d-flex flex-column gap-3 p-3">
                  @csrf
                  <div class="d-flex justify-content-between align-items-center">

                    <h5 class="form-title m-0">Contactar</h5>
                    {{-- <i class="fa-regular fa-square-caret-down fa-lg me-1"></i> --}}
                    <i class="fa-solid fa-arrow-down fa-lg me-1"></i>
                  </div>

                    <div class="form-floating">
                      <input type="text" class="form-control" id="contact-name" name="contact-name" placeholder="Nombre Completo" required>
                      <label class="text-secondary" for="contact-name">Nombre Completo</label>
                    </div>

                    <div class="form-floating">
                      <input type="email" class="form-control" id="contact-email" name="contact-email" placeholder="Correo electrónico" required>
                      <label class="text-secondary" for="contact-email">Correo electrónico</label>
                    </div>  

                    <div class="form-floating">
                      <input type="phone" class="form-control" id="contact-phone" name="contact-phone" placeholder="Teléfono" required>
                      <label class="text-secondary" for="contact-phone">Teléfono</label>
                    </div>  

                    @if ( $aviso->inmueble->is_puja() )
                    <div class="input-group has-validation">
                      <div class="form-floating is-invalid">
                        <input type="text" class="form-control is-invalid" id="monto_puja" placeholder="Monto a ofrecer">
                        <label for="monto_puja">Monto a ofrecer</label>
                      </div>
                      <div class="invalid-feedback">
                        Envíale tu monto oferta a quien publicó el inmueble.
                      </div>
                    </div>
                        
                    @endif

                        
                    {{-- Mensaje --}}
                    <div class="form-floating">
                      <textarea class="form-control" placeholder="Contactame" id="contact-message" style="height: 100px">¡Hola! Deseo que me contacten por este inmueble</textarea>
                      <label for="contact-message" class="text-secondary">Mensaje</label>
                    </div>

                    <x-whatsapp-modal-inmueble-contact></x-whatsapp-modal-inmueble-contact>
    
                    {{-- contacto por correo --}}
                    <button class="btn btn-light border-secondary-subtle" type="button" id="btn-enviar-form-single">
                      <i class="fa-regular fa-paper-plane"></i> Enviar
                    </button>

                    <x-puja-modal-contact :monto="number_format($aviso->inmueble->precioSoles())"></x-puja-modal-contact>
    
                    <div class="form-group d-flex gap-3 align-items-top mb-2">
                      <input type="checkbox" name="acepto_terminos_condiciones" id="terminos" class="form-check-input"/>
                      <label for="terminos">Acepto los <a href="" class="custom-link-register text-decoration-none">Términos y Condiciones de Uso</a> y las <a href="" class="custom-link-register text-decoration-none">Políticas de Privacidad</a></label>
                    </div>
    
                </form>
              </div>
            </div>

          @endif

      </div>

    </div>

  </div>

  <script>
      document.getElementById('redirect-button').addEventListener('click', function() {
          // Enviar el formulario oculto
          document.getElementById('redirect-form').submit();
      });
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