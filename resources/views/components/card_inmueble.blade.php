<div class="card my-4 card-inmueble shadow border-0 bg-white filterAvisos-card"
    data-relevancia="{{ $type_ad }}"
    data-precio_soles="{{ $price }}"
    data-precio_dolares="{{ $price_dolar??$remate_precio_base }}"
    data-reciente="{{ $fecha_publicacion }}"
    data-vistos="{{ $views }}"
>
    <div class="row g-0 h-100">

        <div class="col-lg-4 h-100 position-relative">
            <a href="{{ $link }}" target="_blank" class="text-decoration-none text-reset">
                <img src="{{ asset($image) }}" class="card-inmueble-image rounded" alt="imagen inmueble">
            </a>

            @if ($type === 'Remate')
                <div class="position-absolute top-0 end-0 mt-4 me-2">
                    <h3><span class="badge text-bg-danger">REMATE JUDICIAL</span></h3>
                </div>
            @endif


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
                                    @if ( !$remate_precio_base )
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
                                    @else
                                        <div class="d-flex flex-column align-items-end flex-lg-row gap-lg-3">
                                            <div>
                                                <span class="fs-6">Valor tasación</span>
                                                <span class="fs-4">{{ $currency_dolar }}</span>
                                                <span class="fs-4">{{ number_format($remate_valor_tasacion) }}</span>
                                            </div>
    
                                            {{-- <span> - </span> --}}
                                            <div class="text-primary">
                                                <span class="fs-5">Precio base</span>
                                                <span class="fs-2">{{ $currency_dolar }}</span>
                                                <span class="fs-2">{{ number_format($remate_precio_base) }}</span>
                                            </div>
                                        </div>
                                    @endif

                                </h2>

                                {{-- Caracteristicas del inmueble --}}
                                <p class="m-0 d-flex card-inmuebles-features">
                                    <span class="text-secondary me-1">{{ $area }}</span>
                                    <span class="text-secondary me-1">m²</span>
                                    <i class="fa-solid fa-ruler-combined icon-orange"></i>

                                    
                                    @if ( $bedrooms )
                                    <span class="text-secondary mx-2">-</span>

                                    <span class="text-secondary me-1"> {{ $bedrooms }} </span>
                                    <span class="text-secondary me-1">dorm.</span>
                                    <i class="fa-solid fa-bed icon-orange"></i>
                                    @endif
                                    
                                    @if ( $bathrooms )
                                    <span class="text-secondary mx-2">-</span>

                                    <span class="text-secondary me-1"> {{ $bathrooms }} </span>
                                    <span class="text-secondary me-1"> bañ. </span>
                                    <i class="fa-solid fa-shower icon-orange"></i>
                                    @endif
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
