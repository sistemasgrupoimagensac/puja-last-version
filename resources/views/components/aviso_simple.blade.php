<div class="card mb-3 shadow">
    <div class="row g-0">

        <div class="col-md-3">
            <a href="{{ $link }}" target="_blank" class="text-decoration-none text-reset">
                <img src="{{ $image }}" class="card-inmueble-image rounded" alt="imagen inmueble">
            </a>
        </div>

        <div class="col-md-9">
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

                                @if ($type === "Remate")
                                    <small>Precio Base: <span class="text-secondary">{{ $currencyDolares }}{{ number_format($precioBase) }}</span></small>
                                    <small>Valor Tasado: <span class="text-secondary">{{ $currencyDolares }}{{ number_format($precioValorTasado) }}</span></small>
                                @else
                                    @if ( isset($precioSoles) )
                                        <small>Precio Soles: <span class="text-secondary">{{ $currencySoles }}{{ number_format($precioSoles) }}</span></small>
                                    @endif

                                    @if ( isset($precioDolares) )
                                        <small>Precio Dólares: <span class="text-secondary">{{ $currencyDolares }}{{ number_format($precioDolares) }}</span></small>
                                    @endif
                                @endif
                                
                            </div>
                        </div>

                        {{-- datos inmueble publicado --}}
                        @if (isset($aviso->planUser->end_date))
                            <div class="text-bg-dark rounded-3 p-4 m-lg-4">

                                <div class="d-flex flex-column">

                                    <small>Fecha inicio: <span class="text-secondary">{{ \Carbon\Carbon::parse($aviso->planUser->start_date)->format('d/m/Y') }}</span></small>
                                    <small>Fecha finalización: <span class="text-secondary">{{ \Carbon\Carbon::parse($aviso->planUser->end_date)->format('d/m/Y') }}</span></small>
    
                                    @if ($aviso->ad_type === '3')
                                        <small>Aviso tipo: <span class="text-secondary">Premium</span></small>
                                    @elseif ($aviso->ad_type === '2')
                                        <small>Aviso tipo: <span class="text-secondary">Top</span></small>
                                    @else
                                        <small>Aviso tipo: <span class="text-secondary">Típico</span></small>
                                    @endif
    
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-end gap-3">
                        @if ( $edit_enabled )
                            <button
                                class="btn btn-light border-secondary-subtle bg-white"

                                @if ($published)
                                    title="Tiene 72 horas para editar desde el momento de la publicación"
                                @else
                                    title="Editar aviso"
                                @endif

                                onclick="window.location.href='{{ route('posts.edit', ['aviso' => $id]) }}'"
                            >
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        @endif
                        <a href="{{ $link }}" target="_blank" class="btn btn-light border-secondary-subtle bg-white" title="Ir al aviso">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>