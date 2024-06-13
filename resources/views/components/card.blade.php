<div class="card simple-card">
  <div class="card-image-container">
    <img src="{{ $aviso->inmueble->imagenPrincipal() }}" class="card-image-custom" alt="{{ $aviso->inmueble->fullName() }}">
  </div>

  <div class="card-body px-3 py-2">
    <p class="mb-2">
      <small class="text-black-50">{{ $aviso->inmueble->fullName() }}</small>
    </p>
    <h4 class="card-title font-weight-bold mb-2">
      <span>{{ $aviso->inmueble->precioSoles() }}</span>
    </h4>
    <h6 class="card-text m-0">{{ $aviso->inmueble->address() }}</h6>
    <p class="m-0">
      <small class="text-black-50">{{ $aviso->inmueble->ubicacionGeografica() }}</small>
    </p>
  </div>

  <div class="card-footer d-flex justify-content-between align-items-center">
    <p class="m-0">
      @if($aviso->inmueble->area())
      <small class="text-body-secondary mr-2">{{ $aviso->inmueble->area() }} m²</small>
      @endif
      @if($aviso->inmueble->dormitorios())
      <small class="text-body-secondary mr-2">{{ $aviso->inmueble->dormitorios() }} Dorm</small>
      @endif
      @if($aviso->inmueble->banios())
      <small class="text-body-secondary mr-2">{{ $aviso->inmueble->banios() }} Baños</small>
      @endif
    </p>
    <button class="general-button p-0">
      <i class="fa-regular fa-heart icon-orange"></i>
    </button>
  </div>
</div>