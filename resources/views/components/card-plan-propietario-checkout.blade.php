<div x-show="tipoPlan === '{{ $showPlan }}'" class="plan-checkout-card">
    <div class="card {{ $bgColor }} shadow">
      <div class="card-body text-center d-flex flex-column justify-content-around">
        <h3 class="card-title">{{ $title }}</h3>
        <div class="card-text h1 fw-bolder"> S/ <x-miles-coma amount="prices[tipoPlan]"/></div>
        <p class="card-text h2"> <span x-text="numAvisos"></span> aviso(s) <small class="h5"> / <span x-text="periodoPlan"></span> días </small> </p>
      </div>
    </div>
</div>