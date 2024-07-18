<label class="card btn btn-lg {{ $className }} p-0 card-plan-propietario-label rounded-4" for="{{ $plan }}">
  <div>
    <div class="card-body p-0">
      <h3 class="card-title fw-bolder mt-3">{{ $title }}</h3>
      <h5 class="card-subtitle mb-2">S/ <span x-text="{{ $price }}"></span> por <span x-text="{{ $time }}"></span> días</h5>
      <hr>
      <div class="d-flex justify-content-center">

        {{-- @if ($plan === 'top')
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
        @endif --}}

        <ul class="list-unstyled text-start h6 mb-4 px-4">
          <li>Publicación de Aviso Top Plus</li>
          <li>30 días de publicación</li>
          <li>Genera interesados</li>
          <li>Alta visibilidad</li>
          <li>Exposición Óptima</li>
        </ul>

      </div>
    </div>
    <div class="card-footer fw-bold fs-5">
      ¡Lo quiero!
    </div>
  </div>
</label>

@push('styles')
    @vite(['resources/sass/components/card-plan-propietario.scss'])
@endpush