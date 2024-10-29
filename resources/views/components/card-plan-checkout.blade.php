<div x-show="tipoPlan === '{{ $showPlan }}'" class="plan-checkout-card">
  <div class="card {{ $bgColor }} shadow">
    <div class="card-body text-center d-flex flex-column justify-content-around">
      <h3 class="card-title">{{ $title }}</h3>

      <div class="d-flex flex-column align-items-center">
        <div class="card-text fw-bold display-3 d-flex gap-2">
          <span>S/</span><x-miles-coma amount="prices[tipoPlan]"/>
        </div>
      </div>
        
      @if ( $showPlan === 'top' || $showPlan === 'topPlus' )
        <p class="card-text h2"> <span x-text="numAvisosTop"></span> avisos <small class="h5"> / <span x-text="periodoPlanTop"></span> días </small> </p>

      @else
        <p class="card-text h2"> <span x-text="numAvisos"></span> avisos <small class="h5"> / <span x-text="periodoPlan"></span> días </small> </p>
      @endif
    </div>
  </div>
</div>