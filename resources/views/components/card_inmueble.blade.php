<div class="card my-4 card-inmueble shadow border-0 bg-white">
  <div class="row g-0 h-100">

    <div class="col-lg-4 h-100">
      <a href="{{ $link }}" target="_blank" class="text-decoration-none text-reset">
        <img src="{{ asset($image) }}" class="card-inmueble-image rounded" alt="imagen inmueble">
      </a>

      @if ($aviso->ad_type === 3)
        <div class="ribbon premium">Premium</div>
      @elseif ($aviso->ad_type === 2)
        <div class="ribbon top">Top</div>
      @endif
    </div>

    <div class="col-lg-8">
      <div class="card-body h-100 p-0 d-flex flex-column justify-content-between">

        {{-- Contenido Card Inmueble --}}
        <div class="card-inmueble-content p-3">
          <a href="{{ $link }}" target="_blank" class="text-decoration-none text-reset">

            <div class="h-100 d-flex flex-column justify-content-between">
              {{-- Titulo del inmueble --}}
              <h3 class="card-title fw-bold text-with-overflow card-inmueble-title">
                <span> {{ $category }} </span>
                <span> en </span>
                <span> {{ $type }} </span>
                <span> en </span>
                <span> {{ $address }} </span> {{-- Direccion --}}
              </h3>

              <div class="d-flex flex-column flex-lg-row-reverse justify-content-between align-items-lg-center">
                {{-- Precion del inmueble --}}
                <h2 class="fw-bolder">
                  @if($price)
                  <span>{{ $currency }}</span>
                  <span>{{ number_format($price) }}</span>
                  @endif
                  @if($price && $price_dolar)
                  <span> - </span>
                  @endif
                  @if($price_dolar)
                  <span>{{ $currency_dolar }}</span>
                  <span>{{ number_format($price_dolar) }}</span>
                  @endif
                </h2>

                {{-- Caracteristicas del inmueble --}}
                <p class="m-0 d-flex card-inmuebles-features">
                  <span class="text-secondary me-1">{{ $area }}</span>
                  <span class="text-secondary me-1">m²</span>
                  <i class="fa-solid fa-ruler-combined icon-orange"></i>

                  <span class="text-secondary mx-2">-</span>

                  <span class="text-secondary me-1"> {{ $bedrooms }} </span>
                  <span class="text-secondary me-1">dorm.</span>
                  <i class="fa-solid fa-bed icon-orange"></i>

                  <span class="text-secondary mx-2">-</span>

                  <span class="text-secondary me-1"> {{ $bathrooms }} </span>
                  <span class="text-secondary me-1"> bañ. </span>
                  <i class="fa-solid fa-shower icon-orange"></i>
                </p>

              </div>

              {{-- ubicacion del inmueble --}}
              <div class="card-inmueble-location">
                <p class="m-0">
                  <i class="fa-solid fa-location-dot icon-orange"></i>
                  <span class="text-dark-emphasis fw-bolder"> {{ $address }} </span> {{-- Direccion --}}
                  <span class="text-dark-emphasis fw-bolder">, </span>
                  <span class="text-dark-emphasis fw-bolder"> {{ $district }} </span> {{-- Distrito --}}
                  <span class="text-dark-emphasis fw-bolder">, </span>
                  <span class="text-dark-emphasis fw-bolder"> {{ $department }} </span> {{-- Departamento --}}
                </p>

              </div>

              {{-- descripcion del inmueble --}}
              <p class="card-text card-inmueble-description"> {{ $description }} </p>

            </div>
          </a>
        </div>

        {{-- Footer Card Inmueble --}}
        <div class="card-footer text-secondary d-flex justify-content-between align-items-center">
          <p class="m-0">
            {{ $user }}
          </p>

          <div class="d-flex gap-2">

            <x-whatsapp-modal-contact :idCaracteristica="$idCaracteristica" :isPuja="$isPuja"></x-whatsapp-modal-contact>

            <button class="btn btn-light border-secondary-subtle bg-white">
              <i class="fas fa-envelope"></i> Email
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
