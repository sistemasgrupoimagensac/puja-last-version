<label class="card btn btn-lg {{ $className }} p-0 card-plan-label rounded-4" for="{{ $plan }}" style="width:14rem; height: 14rem">
  <div>
    <div class="card-body p-0">
      <h2 class="card-title fw-bolder mt-3">{{ $title }}</h2>
      <h5 class="card-subtitle mb-2">S/. <span x-text="{{ $price }}"></span> por <span x-text="{{ $time }}"></span> días</h5>
      <hr>
      <div class="d-flex justify-content-center">

        <ul class="list-unstyled text-start h6">
          <template x-for="(aviso, index) in {{ $avisos }}">
            <li>
              <span x-text="aviso"></span>
              <template x-if="index===0"><span>avisos típicos</span></template>
              <template x-if="index===1"><span>avisos top</span></template>
              <template x-if="index===2"><span>avisos top plus</span></template>
            </li>
          </template>
        </ul>

      </div>
    </div>
  </div>
</label>

@push('styles')
    @vite(['resources/sass/components/card_plan.scss'])
@endpush