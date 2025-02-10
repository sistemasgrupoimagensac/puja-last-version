@php
    $user = auth()->user();
    $yaLikeado = false;

    if ( $user ) {
        $yaLikeado = $user->avisosLikeados()->where('aviso_id', $aviso->id)->exists();
    }
@endphp

<div class="card card-nuevos bg-white p-0" style="height: 27rem;">
	<a href="{{ $link }}" target="_blank" class="text-decoration-none text-reset  position-relative">
		<div class="card-image-container">
			<img src="{{ $image }}" class="card-image-custom" alt="{{ $title }}">
		</div>
		
		<a 
			href="#"
			class="toggle-like-btn position-absolute end-0 bg-white text-dark fw-bold px-3 py-1 rounded shadow-lg m-3 d-flex justify-content-center align-items-center"
			style="height: 2rem; top:32%"
			data-aviso-id="{{ $aviso->id }}"
			>
				<i class="{{ $yaLikeado ? 'fa-solid' : 'fa-regular' }} fa-heart heart-icon-{{ $aviso->id }}"></i>
		</a>

		@if ($type === 'Remate')
			<div class="position-absolute top-0 end-0 mt-4 me-2">
				<h3><span class="badge text-bg-danger">REMATE PÚBLICO</span></h3>
			</div>
		@endif


		@if ($aviso->ad_type === 3)
			<div class="ribbon premium">Premium</div>
		@elseif ($aviso->ad_type === 2)
			<div class="ribbon top">Top</div>
		@endif
	
		<div class="card-body px-3 py-2">
			<p class="mb-2 fw-bold">
				<small class="text-black-50">{{ $type }}</small>
				<small class="text-black-50"> - </small>
				<small class="text-black-50">{{ $category }}</small>
			</p>
			<h4 class="card-title fw-bold mb-2">
				<span>{{ $currency }} </span>
				<span>{{ number_format($price) }}</span>
			</h4>
			<h6 class="card-text m-0 card-simple-address-overflow fw-bold">{{ $address }}</h6>
			<p class="m-0">
				<small class="text-black-50">{{ $district }}</small>
				<small class="text-black-50">, </small>
				<small class="text-black-50">{{ $department }}</small>
			</p>

			<div class="d-flex gap-3 flex-nowrap overflow-hidden" style="white-space: nowrap;">
				@foreach ($comodidades as $comodidad)

				<div class="badge bg-light text-black text-wrap p-3 w-auto"{{--  style="width: 10rem;" --}}>
					{{ $comodidad->caracteristica; }}
				</div>
					
				@endforeach
			</div>

			<div class="d-flex gap-2 w-100 flex-wrap contact-buttons justify-content-center mt-2 d-md-none">
				<x-whatsapp-modal-contact :inmuebleId="$inmueble_id" />
				<x-email-modal-contact :inmuebleId="$inmueble_id" />
			</div>
		</div>
	</a>

	<div class="card-footer d-flex justify-content-between align-items-center">
		<p class="m-0">
			@if($area)<small class="text-body-secondary mr-2">{{ $area }} m<sup>2</sup></small>@endif
			@if($bedrooms)
				<small class="text-body-secondary mr-2">
					{{ $bedrooms }} 
					@if ( $aviso->inmueble->typeInmueble() != 'Oficina' )
						Dorm.
					@else
						Ambs.
					@endif
				</small>
			@endif
			@if($bathrooms)<small class="text-body-secondary mr-2">{{ $bathrooms }} Bañ.</small>@endif
		</p>
	</div>
</div>


