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
          <div class="images-wrapper" data-bs-toggle="modal" data-bs-target="#ImagesProperty">
            @foreach($aviso->inmueble->imagenes as $image)
            <div class="image-inmueble card-image-container shadow">
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
    
              {{-- Precion del inmueble --}}
              {{-- <div class="d-flex justify-content-between align-items-end flex-md-column"> --}}
    
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
    
                
                {{-- </div> --}}
            </div>


            <h4 class="p-0 m-0 mt-4">
              ID: {{ $aviso->id }}
            </h4>

          </div>

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
              <li class="mt-3" style="min-width: 250px;">
                <h6 class="text-secondary">
                  <i class="fa-solid fa-video fa-lg icon-orange me-2"></i>
                  Video Vigilancia
                </h6>
              </li>
              <li class="mt-3" style="min-width: 250px;">
                <h6 class="text-secondary">
                  <i class="fa-solid fa-umbrella-beach fa-lg icon-orange me-2"></i>
                  Terraza
                </h6>
              </li>
              <li class="mt-3" style="min-width: 250px;">
                <h6 class="text-secondary">
                  <i class="fa-solid fa-droplet fa-lg icon-orange me-2"></i>
                  Tanque de Agua
                </h6>
              </li>
              <li class="mt-3" style="min-width: 250px;">
                <h6 class="text-secondary">
                  <i class="fa-solid fa-person-swimming fa-lg icon-orange me-2"></i>
                  Piscina
                </h6>
              </li>
              <li class="mt-3" style="min-width: 250px;">
                <h6 class="text-secondary">
                  <i class="fa-solid fa-sun-plant-wilt fa-lg icon-orange me-2"></i>
                  Jardín Externo
                </h6>
              </li>
              <li class="mt-3" style="min-width: 250px;">
                <h6 class="text-secondary">
                  <i class="fa-solid fa-bath fa-lg icon-orange me-2"></i>
                  Habitación principal con baño
                </h6>
              </li>
            </ul>


          </div>

          {{-- Comodidades --}}
          <div class="mt-5">
            <h3 class="fw-bold">Comodidades</h3>

            <ul class="list-unstyled d-flex flex-wrap justify-content-between">
              <li class="mt-3" style="min-width: 250px;">
                <h6 class="text-secondary">
                  <i class="fa-solid fa-tree fa-lg icon-orange me-2"></i>
                  Parque Interno
                </h6>
              </li>
              <li class="mt-3" style="min-width: 250px;">
                <h6 class="text-secondary">
                  <i class="fa-solid fa-water fa-lg icon-orange me-2"></i>
                  Vista al Mar
                </h6>
              </li>
              <li class="mt-3" style="min-width: 250px;">
                <h6 class="text-secondary">
                  <i class="fa-solid fa-arrows-to-circle fa-lg icon-orange me-2"></i>
                  Zona Céntrica
                </h6>
              </li>
            </ul>

          </div>

        </div>  
      </div>

      {{-- Aside Formulario Contacto --}}
      <div class="col-lg-4 ps-lg-3">
          <div class="sticky-lg-top py-3">

            <div class="rounded bg-white border shadow">
              <form class="d-flex flex-column gap-3 p-3">
                @csrf
                  <h5 class="form-title">Contactar</h5>
  
                  {{-- nombre --}}
                  <input class="form-control bg-white" type="text" name="contact-name" id="contact-name"
                      placeholder="Nombre completo">
  
                  {{-- email --}}
                  <input class="form-control bg-white" type="email" name="contact-email" id="contact-email"
                      placeholder="Correo electrónico">
  
                  {{-- telefono --}}
                  <input class="form-control bg-white" type="phone" name="contact-phone" id="contact-phone"
                      placeholder="Teléfono">
  
                  {{-- mensaje --}}
                  <textarea class="form-control bg-white" name="contact-message" id="contact-message" rows="4"
                      placeholder="Deja tu mensaje">¡Hola! Deseo que me contacten por este inmueble</textarea>
  
                  <button class="btn btn-light border-secondary-subtle">
                      <i class="fab fa-whatsapp"></i> WhatsApp
                  </button>
  
                  <button class="btn btn-light border-secondary-subtle">
                      <i class="fas fa-envelope"></i> Email
                  </button>
  
                  <div class="form-group d-flex gap-3 align-items-top mb-2">
                    <input type="checkbox" name="acepto_terminos_condiciones" id="terminos" class="form-check-input"/>
                    <label for="terminos">Acepto los <a href="" class="custom-link-register text-decoration-none">Términos y Condiciones de Uso</a> y las <a href="" class="custom-link-register text-decoration-none">Políticas de Privacidad</a></label>
                  </div>
  
              </form>
            </div>

          </div>
      </div>

    </div>

  </div>

@endsection

@section('footer')
  @include('components.footer')
@endsection

@push('scripts')
    @vite(['resources/js/scripts/inmueble.js'])
@endpush