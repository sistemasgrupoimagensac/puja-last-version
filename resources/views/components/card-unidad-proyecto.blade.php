@props([
    'precioSoles' => 0,
    'precioDolares' => 0,
    'area' => 0,
    'banios' => 0,
    'dormitorios' => 0,
])

{{-- <div class="swiper-slide d-flex justify-content-center"> --}}
    <div class="d-flex justify-content-center">
        <div class="card" style="width: 13rem;">
            <button type="button" class="btn p-0">
                <img src="/images/plano1.webp" class="card-img-top p-3" alt="plano de unidad">
            </button>
        
            <div class="card-body pt-0">
                {{-- Mostrar el precio en Soles y Dólares --}}
                <div class="mb-3">
                    <p class="m-0 h4 fw-bold">S/ {{ number_format($precioSoles, 0, ',', '.') }}</p>
                    {{-- <p class="m-0">$ {{ number_format($precioDolares, 0, ',', '.') }}</p> --}}
                </div>
                
                {{-- Mostrar la información de área y baños --}}
                <div class="mb-3">
                    <div class="d-flex gap-2 align-items-end">
                        <i class="fa-solid fa-bed fa-lg icon-orange p-1"></i>
                        <span class="text-secondary"> {{ $dormitorios }} </span>
                        <span class="text-secondary"> dorm. </span>
                    </div>
                    <div class="d-flex gap-2">
                        <i class="fa-solid fa-expand icon-orange p-1"></i>
                        <span class="text-secondary"> {{ $area }} </span>
                        <span class="text-secondary"> m<sup>2</sup> </span>
                    </div>
                    <div class="d-flex gap-2 align-items-end">
                        <i class="fa-solid fa-bath fa-lg icon-orange p-1"></i>
                        <span class="text-secondary"> {{ $banios }} </span>
                        <span class="text-secondary"> bañ. </span>
                    </div>
                </div>

                {{-- Botón para cotizar --}}
                <button class="btn button-orange w-100 fs-4 p-0 m-0">COTIZAR</button>
            </div>
        </div>
    </div>
{{-- </div> --}}