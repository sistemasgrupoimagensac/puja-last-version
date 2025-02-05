@php
    $user = auth()->user();
    $yaLikeado = false;

    if ( $user ) {
        $yaLikeado = $user->avisosLikeados()->where('aviso_id', $aviso->id)->exists();
    }
@endphp

<div class="card simple-card bg-white">
	<a href="{{ $link }}" target="_blank" class="text-decoration-none text-reset h-100 position-relative">
		<div class="card-image-container">
			<img src="{{ $image }}" class="card-image-custom" alt="{{ $title }}">
		</div>
		<a 
			href="#"
			class="toggle-like-btn position-absolute top-0 end-0 bg-white text-dark fw-bold px-3 py-1 rounded shadow-lg m-3 d-flex justify-content-center align-items-center"
			style="height: 2rem;"
    		data-aviso-id="{{ $aviso->id }}"
			>
				<i class="{{ $yaLikeado ? 'fa-solid' : 'fa-regular' }} fa-heart heart-icon-{{ $aviso->id }}"></i>
		</a>
	
		<div class="card-body px-3 py-2">
			<p class="mb-2">
				<small class="text-black-50">{{ $type }}</small>
				<small class="text-black-50"> - </small>
				<small class="text-black-50">{{ $category }}</small>
			</p>
			<h4 class="card-title font-weight-bold mb-2">
				<span>{{ $currency }} </span>
				<span>{{ number_format($price) }}</span>
			</h4>
			<h6 class="card-text m-0 card-simple-address-overflow">{{ $address }}</h6>
			<p class="m-0">
				<small class="text-black-50">{{ $district }}</small>
				<small class="text-black-50">, </small>
				<small class="text-black-50">{{ $department }}</small>
			</p>
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
