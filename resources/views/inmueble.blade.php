@extends('layouts.app')

@section('title')
    Inmueble
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/layouts/inmueble.css') }}">
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
            <div class="first-image card-image-container shadow">
              <img src="{{ asset('images/house_2.webp') }}" class="card-image-custom rounded" alt="imagen inmueble">
            </div>
            <div class="second-image card-image-container shadow">
            <img src="{{ asset('images/house_1.webp') }}" class="card-image-custom rounded" alt="imagen inmueble">
            </div>
            <div class="third-image card-image-container shadow">
              <img src="{{ asset('images/house_3.webp') }}" class="card-image-custom rounded" alt="imagen inmueble">
            </div>
          </div>

          {{-- modal --}}

          <div class="modal fade" id="ImagesProperty" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered inmueble-modal-dialog">
              <div class="modal-content ">

                <div class="modal-body p-0 bg-secondary">

                  {{-- imagenes carrusel --}}
                  <div id="carouselImagesInmueble" class="carousel slide carousel-fade">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="{{ asset('images/house_1.webp') }}" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="{{ asset('images/house_2.webp') }}" class="d-block w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="{{ asset('images/casa-prueba.webp') }}" class="d-block w-100" alt="...">
                      </div>
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
                  <span>Casa</span> {{-- category --}}
                  <span>en</span>
                  <span>Venta</span> {{-- type --}}
                  <span>en</span>
                  <span>San Isidro</span> {{-- district --}}
                </h1>
      
                {{-- direccion --}}
                <h5 class="p-0">
                  <i class="fa-solid fa-location-dot icon-orange"></i>
                  <span>Calle Manuel A. Fuentes</span> {{-- address --}}
                  <span>, </span>
                  <span>San Isidro</span> {{-- district --}}
                  <span>, </span>
                  <span>Lima</span> {{-- departament --}}
                </h5>
    
              </div>
    
              {{-- Precion del inmueble --}}
              {{-- <div class="d-flex justify-content-between align-items-end flex-md-column"> --}}
    
                <div class="d-flex flex-column align-items-start align-items-md-end mt-4 mt-md-0">
                  <h2 class="m-0 fw-bolder">
                    <span>S/. </span>
                    <span>2,100,000</span>
                  </h2>
                  <h3 class="m-0 fw-bolder text-secondary">
                    <small>USD </small>
                    <small>567,568</small>
                  </h3>
                </div>
    
                
                {{-- </div> --}}
            </div>


            <h4 class="p-0 m-0 mt-4">
              ID: 83946
            </h4>

          </div>

          {{-- Card - Más datos del inmueble --}}
          <div class="d-flex flex-wrap justify-content-between gap-4 mt-4 px-3 py-4 border rounded shadow">

            {{-- dormitorios --}}
            <div class="d-flex flex-column justify-content-between align-items-center" style="width: 110px;">
              <div class="d-flex">
                <i class="fa-solid fa-bed fa-lg icon-orange p-1"></i>
                <h5 class="text-secondary m-1 fw-bold"> 3 </h5>
              </div>
              <h6 class="text-secondary m-0"> dorm. </h6>
            </div>

            {{-- baño completo --}}
            <div class="d-flex flex-column justify-content-between align-items-center" style="width: 110px;">
              <div class="d-flex">
                <i class="fa-solid fa-bath fa-lg icon-orange p-1"></i>
                <h5 class="text-secondary m-1 fw-bold"> 2 </h5>
              </div>
              <h6 class="text-secondary m-0"> bañ. </h6>
            </div>

            {{-- medio baño --}}
            <div class="d-flex flex-column justify-content-between align-items-center" style="width: 110px;">
              <div class="d-flex">
                <i class="fa-solid fa-toilet fa-lg icon-orange p-1"></i>
                <h5 class="text-secondary m-1 fw-bold"> 1 </h5>
              </div>
              <h6 class="text-secondary m-0"> 1/2 bañ. </h6>
            </div>
            
            {{-- estacionamientos --}}
            <div class="d-flex flex-column justify-content-between align-items-center" style="width: 110px;">
              <div class="d-flex">
                <i class="fa-solid fa-car fa-lg icon-orange p-1"></i>
                <h5 class="text-secondary m-1 fw-bold"> 3 </h5>
              </div>
              <h6 class="text-secondary m-0"> estacion. </h6>
            </div>

            {{-- area total --}}
            <div class="d-flex flex-column justify-content-between align-items-center" style="width: 110px;">
              <div class="d-flex">
                <i class="fa-solid fa-ruler-combined fa-lg icon-orange p-1"></i>
                <h5 class="text-secondary m-1 fw-bold"> 
                  <span>100</span>
                  <span>m</span>
                  <sup>2</sup>
                </h5>
              </div>
              <h6 class="text-secondary m-0"> area total </h6>
            </div>
            
            {{-- area techada --}}
            <div class="d-flex flex-column justify-content-between align-items-center" style="width: 110px;">
              <div class="d-flex">
                <i class="fa-solid fa-ruler-combined fa-lg icon-orange p-1"></i>
                <h5 class="text-secondary m-1 fw-bold"> 
                  <span>100</span>
                  <span>m</span>
                  <sup>2</sup>
                </h5>
              </div>
              <h6 class="text-secondary m-0"> area techada </h6>
            </div>

          </div>

          {{-- Card - descripción --}}
          <div class="description-container mt-5">
            <h3 class="fw-bold">Sobre este inmueble</h3>

            <p class="fw-bold">Antigüedad: 
              <span>15</span>
              años
            </p>
            <p class="short-text" id="shortText">{!! nl2br($shortText) !!}</p>
            <p class="full-text" id="fullText">{!! nl2br($fullText) !!}</p>
            @if(strlen($shortText) > $charLimit)
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
    <script src="{{ asset('js/scripts/inmueble.js') }}"></script>
@endpush