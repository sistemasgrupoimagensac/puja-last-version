<div class="card text-bg-light" style="width: 20rem;">
  <div class="card-header fs-3 fw-bolder">{{ $planTitle }}</div>
  <div class="card-body">

    <h5 class="card-title fw-bold text-primary">Periodo del plan</h5>
    <p class="m-0"><span class="fw-bold">Duración: </span>{{ $term }} días</p>
    <p class="m-0"><span class="fw-bold">Inicio del plan: </span>{{ $start }}</p>
    <p class="m-0"><span class="fw-bold">Fin del Plan: </span>{{ $end }}</p>

    <hr>

    <h5 class="card-title fw-bold text-primary">Avisos Contratados <span class="text-black fw-lighter"> (totales: {{ $totalAdsHired }})</span></h5>
    <p class="m-0"><span class="fw-bold">Avisos Premium: </span>{{ $topPlusAdsHired }}</p>
    <p class="m-0"><span class="fw-bold">Avisos Top: </span>{{ $topAdsHired }}</p>
    <p class="m-0"><span class="fw-bold">Avisos Típicos: </span>{{ $typicalAdsHired }}</p>

  </div>
  <div class="card-footer text-bg-dark">

    <h5 class="card-title fw-bold text-primary">Avisos Restantes</span></h5>
    <p class="m-0"><span class="fw-bold">Avisos Premium: </span>{{ $topPlusAdsRemaining }}</p>
    <p class="m-0"><span class="fw-bold">Avisos Top: </span>{{ $topAdsRemaining }}</p>
    <p class="m-0"><span class="fw-bold">Avisos Típicos: </span>{{ $typicalAdsRemaining }}</p>
    
  </div>
</div>