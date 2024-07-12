<div x-show="tipoPlan === '{{ $showPlan }}'" class="plan-checkout-card">
  <div class="card {{ $bgColor }} shadow">
    <div class="card-body text-center d-flex flex-column justify-content-around">
      <h3 class="card-title">{{ $title }}</h3>
      <p class="card-text h1 fw-bolder"> S/ <span x-text="prices[tipoPlan]"></span> </p>

      @if ( $showPlan === 'top' || $showPlan === 'topPlus' )
        <p class="card-text h2"> <span x-text="numAvisosTop"></span> avisos <small class="h5"> / <span x-text="periodoPlanTop"></span> días </small> </p>
      @else
        <p class="card-text h2"> <span x-text="numAvisos"></span> avisos <small class="h5"> / <span x-text="periodoPlan"></span> días </small> </p>
      @endif
    </div>
  </div>
</div>
