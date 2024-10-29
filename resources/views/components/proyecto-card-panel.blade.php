<div class="card mb-4 shadow aviso-simple">

    {{-- Card --}}
    <div class="row g-0">

        <div class="col-lg-3">
            <a href="{{ $link }}" target="_blank" class="text-decoration-none text-reset">
                
                @if (isset($image))
                    <img src="{{ $image }}" class="card-inmueble-image rounded" alt="Imagen Inmueble">
                @else 
                    <img src="{{ asset('images/no-image.webp') }}" class="card-inmueble-image rounded border border-secondary border-secondary-subtle" alt="House Image Placeholder">
                @endif

            </a>
        </div>

        <div class="col-lg-9">
            <div class="d-flex flex-column justify-content-between h-100">

                {{-- titulo --}}
                <h5 class="card-header py-4">
                    <a class="text-secondary text-decoration-none fw-bold my-4" href="{{ $link }}" target="_blank">{{ $title }}</a>
                </h5>

                <div class="card-body">
                    <div class="d-flex flex-column flex-lg-row justify-content-lg-between gap-3">

                        {{-- datos inmueble sin publicar --}}
                        <div>
                            <div class="d-flex flex-column">
                                <p class="text-secondary m-0 fw-bold">Ubicación</p>
                                <small>dirección: <span class="text-secondary">{{ $address }}</span></small>
                                <small>distrito: <span class="text-secondary">{{ $distrito }}</span></small>
                                <small>provincia: <span class="text-secondary">{{ $provincia }}</span></small>
                                <small>departamento: <span class="text-secondary">{{ $departamento }}</span></small>
                            </div>

                            <hr>

                            <div class="d-flex flex-column mt-3">
                                <p class="text-secondary m-0 fw-bold">Precio</p>
                                <small>Precio desde: <span class="text-secondary">S/ {{ number_format($precioDesde) }}</span></small>
                                
                            </div>
                        </div>

                            <div class="text-bg-secondary rounded-3 p-4 m-lg-4">

                                <div class="d-flex flex-column">
                                    <span>Fecha Inicio Contrato: <span class="fw-semibold">{{ \Carbon\Carbon::parse($fechaInicioContrato)->format('d . m . Y') }}</span></span>
                                    <span>Fecha Fin Contrato: <span class="fw-semibold">{{ \Carbon\Carbon::parse($fechaFinContrato)->format('d . m . Y') }}</span></span>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-end gap-3 mx-lg-4">

                        {{-- Editar aviso --}}
                        <button type="button" class="action edit border-0 bg-transparent p-1"
                            onclick="window.location.href='{{ route('proyectos.create', ['id' => $id]) }}'"
                        >
                            <i class="fa-solid fa-pen-to-square w-100 h-100"></i>
                        </button>

                        {{-- Ir al aviso --}}
                        <a href="{{ $link }}" class="action link p-1" target="_blank">
                            <i class="fa-solid fa-up-right-from-square w-100 h-100"></i>
                        </a>

                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
