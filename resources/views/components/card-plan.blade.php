<label class="card btn btn-lg {{ $className }} p-0 card-plan-label rounded-4" for="{{ $plan }}" >

  @if (!$sesionIniciada)
    <a class="text-decoration-none text-reset" href="{{ route("sign_in", ['profile_type' => 3]) }}">
  @endif

    <div>
      <div class="card-body p-0">
        <h2 class="card-title fw-bolder mt-3">{{ $title }}</h2>
        <h5 class="card-subtitle mb-2">S/ <x-miles-coma amount="{{ $price }}"></x-miles-coma> por <span x-text="{{ $time }}"></span> días</h5>
        <hr>
        <div class="d-flex justify-content-center">
  
          @if ($plan === 'top')
            <p><span x-text={{ $avisos }}></span> avisos top</p>
          @elseif ($plan === 'topPlus')
            <p><span x-text={{ $avisos }}></span> avisos top plus</p>
          @else     
            <ul class="list-unstyled text-start h6 mb-4">
              <template x-for="(aviso, index) in {{ $avisos }}">
                <li>
                  <span x-text="aviso"></span>
                  <template x-if="index===0"><span>avisos típicos</span></template>
                  <template x-if="index===1"><span>avisos top</span></template>
                  <template x-if="index===2"><span>avisos top plus</span></template>
                </li>
              </template>
            </ul>
          @endif
  
        </div>
      </div>
      <div class="card-footer fw-bold fs-5">
        ¡Lo quiero!
      </div>
    </div>

  @if (!$sesionIniciada)
    </a>   
  @endif

</label>

@push('styles')
    @vite(['resources/sass/components/card_plan.scss'])
@endpush