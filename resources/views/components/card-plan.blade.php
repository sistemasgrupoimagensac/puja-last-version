<label class="card btn btn-lg {{ $className }} p-0 shadow" for="{{ $plan }}" style="width:14rem; height: 14rem">
  <div>
    <div class="card-body p-0">
      <h2 class="card-title mt-3">{{ $title }}</h2>
      <h6 class="card-subtitle mb-2">S/.{{ $price }} por {{ $time }} días</h6>
      <hr>
      <p class="card-text">{{ $text }}</p>
      <ul class=" list-unstyled">
        <li></li>
      </ul>
    </div>
  </div>
</label>

@push('styles')
    @vite(['resources/sass/components/card_plan.scss'])
@endpush

@push('scripts')
    @vite(['resources/js/scripts/components/card_plan.js'])
@endpush