<div class="card simple-card bg-white">
  <a href="{{ $link }}" target="_blank" class="text-decoration-none text-reset h-100">
      <div class="card-image-container">
          <img src="{{ $image }}" class="card-image-custom" alt="{{ $title }}">
      </div>
  
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
          @if($bedrooms)<small class="text-body-secondary mr-2">{{ $bedrooms }} Dorm.</small>@endif
          @if($bathrooms)<small class="text-body-secondary mr-2">{{ $bathrooms }} Bañ.</small>@endif
      </p>

      {{-- <button class="general-button p-0 heart-button" data-like="{{ $like ? 'true' : 'false' }}">
        <i class="fa-{{ $like ? 'solid' : 'regular' }} fa-heart icon-orange"></i>
    </button> --}}
  </div>
</div>


