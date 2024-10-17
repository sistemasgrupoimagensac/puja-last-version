<div class="card my-4 card-inmueble shadow border-0 bg-white filterAvisos-card">
    <div class="row g-0 h-100">
        <div class="col-lg-4 h-100 position-relative">
            <a href="{{ $link }}" target="_blank" class="text-decoration-none text-reset">
                <img src="{{ $image }}" class="card-inmueble-image rounded" alt="imagen proyecto">
            </a>
        </div>

        <div class="col-lg-8">
            <div class="card-body h-100 p-0 d-flex flex-column justify-content-between">
                <div class="card-proyecto-content p-3 h-100">
                    <a href="{{ $link }}" target="_blank" class="text-decoration-none text-reset">
                        <div class="h-100 d-flex flex-column justify-content-between">
                            {{-- Título del proyecto --}}
                            <h2 class="card-title fw-bold text-with-overflow card-proyecto-title text-secondary">
                                <span>{{ $nombre_proyecto }}</span>
                            </h2>
                            {{-- Ubicación del proyecto --}}
                            <div class="card-proyecto-location">
                                <p class="m-0">
                                    <i class="fa-solid fa-location-dot icon-orange"></i>
                                    <span class="text-dark-emphasis fw-bolder">{{ $direccion }}</span>,
                                    <span class="text-dark-emphasis fw-bolder">{{ $distrito }}</span>,
                                    <span class="text-dark-emphasis fw-bolder">{{ $provincia }}</span>,
                                    <span class="text-dark-emphasis fw-bolder">{{ $departamento }}</span>
                                </p>
                            </div>

                            {{-- Precio --}}
                            <div class="d-flex gap-4 justify-content-end align-items-end">
                                <p class="p-0 m-0 h4">desde:</p>
                                <h2 class="fw-bolder display-5 p-0 m-0">S/ {{ number_format($precio_desde, 2) }}</h2>
                            </div>

                            {{-- Características del Proyecto --}}
                            <p class="m-0 d-flex card-inmuebles-features">
                                <span class="text-secondary me-1">{{ $area_desde }} - {{ $area_hasta }}</span>
                                <span class="text-secondary me-1">m²</span>
                                <i class="fa-solid fa-ruler-combined icon-orange"></i>
                                
                                {{-- Dormitorios --}}
                                <span class="text-secondary mx-2">-</span>
                                <span class="text-secondary me-1">{{ $dormitorios_desde }} - {{ $dormitorios_hasta }}</span>
                                <span class="text-secondary me-1">dorm.</span>
                                <i class="fa-solid fa-bed icon-orange"></i>
                            </p>

                        </div>
                    </a>
                </div>
                <div class="card-footer bg-dark-subtle border-0">
                    <div class="py-2 d-flex justify-content-between align-items-center">

                        <h5 class="btn-group p-0 m-0 h-100" role="group" aria-label="Basic example">
                            <span class="badge bg-dark-blue rounded-end-0 p-2 px-4">{{ $estado }}</span>
                            <span class="badge text-bg-light rounded-start-0 p-2 px-4">Entrega {{ $entrega }}</span>                    
                        </h5>

                        <img src="/images/bancos/{{ $banco }}.png" alt="" style="height: 40px" class=" rounded rounded-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
