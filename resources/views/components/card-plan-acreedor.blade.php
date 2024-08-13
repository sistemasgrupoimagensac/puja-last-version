<label class="card btn btn-lg {{ $className }} p-0 card-plan-propietario-label rounded-4" for="{{ $plan }}">
    <div>
      <div class="card-body p-0">
        <h3 class="card-title fw-bolder mt-3">Plan {{ $title }}</h3>
        <h4 class="card-subtitle mb-2">
          S/ <span x-text="{{ $price }}"></span> por 15 días
        </h4>
        <hr>
        <div class="card-description-plan d-flex justify-content-start px-4">
          <ul class="list-unstyled text-start h6 mb-4">
            <li>Publicación de Aviso {{ $tipoAviso }}</li>
            <li>15 días de publicación</li>
  
            @if ( $plan === 'topPlus' )
              <li>Genera interesados</li>
              <li>Alta visibilidad</li>
              <li>Exposición Óptima</li>
            @elseif ( $plan === 'top' )
              <li>Genera interesados</li>
              <li>Alta visibilidad</li>
            @elseif ( $plan === 'estandar' )
              <li>Visibilidad Convencional</li>
            @endif
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