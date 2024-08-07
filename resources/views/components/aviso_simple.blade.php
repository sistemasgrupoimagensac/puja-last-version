<div class="card card-aviso shadow bg-white mb-3">
    <div class="card-body h-100">
        <div class="row g-0 h-100">
            <div class="col-lg-3 col-xl-2 h-100">
                <div class="image-aviso h-100">
                    <a href="{{ $link }}" target="_blank" class="text-decoration-none text-reset">
                        <img src="{{ $image }}" class="card-inmueble-image rounded" alt="imagen inmueble">
                    </a>
                </div>
            </div>
            <div class="col-lg-9 col-xl-10">
                <div class="card-aviso-content pb-3">
                    <div class="col-lg-6">
                        <div>
                            <span class="tipo-inmueble-aviso">{{ $category }}</span>
                        </div>
                        <div class="m-0">
                            <h3 class="m-0">
                                <a href="{{ $link }}" target="_blank" class="titulo-aviso">{{ $title }}</a>
                            </h3>
                            <span class="address-aviso">{{ $address }}</span>
                            <div class="d-flex align-items-center">
                                <span class="tipo-operacion-aviso">{{ $type }}</span>
                                <span class="price-aviso">{{ $currency }}{{ number_format($price) }}</span>
                            </div>
                        </div>

                    </div>
                </div>
                <hr class="m-0">
                <div class="text-secondary d-flex justify-content-between align-items-center py-2">
                    <p class="m-0 info-footer-aviso">
                        ID:
                        <span class="id-aviso ms-1">{{ $codigo_unico }}</span>
                    </p>
          
                    <div class="d-flex gap-2">
                        @if ( $edit_enabled )
                            <button
                                class="btn btn-light border-secondary-subtle bg-white"
                                title="Editar aviso"
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