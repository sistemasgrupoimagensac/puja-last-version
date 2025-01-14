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
                            <div class="text-bg-secondary rounded-3 p-4 m-lg-4">

                                <div class="d-flex flex-column">

                                    <span>Fecha publicación: <span class="fw-semibold">{{ \Carbon\Carbon::parse($aviso->fecha_publicacion)->format('d . m . Y') }}</span></span>
                                    <span>Fecha finalización: <span class="fw-semibold">{{ \Carbon\Carbon::parse($aviso->planUser->end_date)->format('d . m . Y') }}</span></span>
                                    
                                    @if ( $aviso->ad_type === 3 )
                                        <span>Aviso tipo: <span class="fw-semibold">Premium</span></span>
                                    @elseif ( $aviso->ad_type === 2 )
                                        <span>Aviso tipo: <span class="fw-semibold">Top</span></span>
                                    @else
                                        <span>Aviso tipo: <span class="fw-semibold">Típico</span></span>
                                    @endif
    
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-end gap-3 mx-lg-4">
                        
                        @if ( $user_id === 6 && ($aviso->historial->first()->pivot->estado_aviso_id == 3 || $aviso->historial->first()->pivot->estado_aviso_id == 7) )
                            <button 
                                type="button" 
                                class="action cancel border-0 bg-transparent p-1"
                                title="Cancelar aviso"
                                data-bs-toggle="modal" 
                                data-bs-target="#avisoCancelModal"
                                onclick="setCancelModal('{{ $title }}', '{{ $id }}', '{{ $aviso->historial->first()->pivot->estado_aviso_id }}')"
                            >
                                @if ( $aviso->historial->first()->pivot->estado_aviso_id == 3 )
                                    <i class="fa-solid fa-ban w-100 h-100 text-danger"></i>
                                @else
                                    <i class="fa-solid fa-circle-check w-100 h-100 text-success"></i>
                                @endif
                            </button>
                        @endif

                        {{-- Editar aviso --}}
                        @if ( $edit_enabled )
                            <button type="button" class="action edit border-0 bg-transparent p-1"

                                @if ($published)
                                    title="Tiene 72 horas para editar el anuncio desde el momento de la publicación"
                                @else
                                    title="Editar aviso"
                                @endif

                                onclick="window.location.href='{{ route('posts.edit', ['aviso' => $id]) }}'"
                            >
                                <i class="fa-solid fa-pen-to-square w-100 h-100"></i>
                            </button>
                        @endif

                        {{-- Eliminar aviso --}}
                        <button type="button" class="action delete border-0 bg-transparent p-1" title="Eliminar aviso" data-bs-toggle="modal" 
                            data-bs-target="#avisoDeleteModal"
                            onclick="setDeleteModal('{{ $title }}', '{{ $id }}')">
                            <i class="fa-solid fa-trash-can w-100 h-100 text-danger"></i>
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
