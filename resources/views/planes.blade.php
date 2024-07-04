@extends('layouts.app')

@section('title')
  Planes de Pago
@endsection

@push('styles')
  @vite(['resources/sass/pages/planes.scss'])
@endpush

@section('header')
  @include('components.header')
@endsection


@section('content')

<div class="container my-5" x-data="pricingData()">
  <h1 class="text-center fw-bold">Elige tu plan</h1>
  <form>
    @csrf
    <div class="d-flex flex-column align-items-center my-5 gap-5">
      <!-- número de avisos -->
      <fieldset>
        <legend class="text-secondary h6 mb-3">1. Selecciona el número de avisos.</legend>
        <div role="group" class="planes-numero-avisos justify-content-center d-flex flex-wrap w-100 gap-3 gap-lg-4 px-1 p-lg-0 mt-4" x-data="{ open: false }">
          <div>
            <input type="radio" class="btn-check" id="5avisos" value="5" autocomplete="off" x-model="numAvisos">
            <label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="5avisos">5 Avisos</label>
          </div>
          <div>
            <input type="radio" class="btn-check" id="10avisos" value="10" autocomplete="off" x-model="numAvisos">
            <label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="10avisos">10 Avisos</label>
          </div>
          <div>
            <input type="radio" class="btn-check" id="25avisos" value="25" autocomplete="off" x-model="numAvisos">
            <label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="25avisos">25 Avisos</label>
          </div> 
          <div x-show="open" x-transition.duration.200ms>
            <input type="radio" class="btn-check" id="50avisos" value="50" autocomplete="off" x-model="numAvisos">
            <label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="50avisos">50 Avisos</label>
          </div>
          <div x-show="open" x-transition.duration.200ms>
            <input type="radio" class="btn-check" id="75avisos" value="75" autocomplete="off" x-model="numAvisos">
            <label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="75avisos">75 Avisos</label>
          </div>
          <div x-show="open" x-transition.duration.200ms>
            <input type="radio" class="btn-check" id="100avisos" value="100" autocomplete="off" x-model="numAvisos">
            <label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="100avisos">100 Avisos</label>
          </div>
          <div x-show="open" x-transition.duration.200ms>
            <input type="radio" class="btn-check" id="200avisos" value="200" autocomplete="off" x-model="numAvisos">
            <label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="200avisos">200 Avisos</label>
          </div>
    
          <div class="avisos-desplegar d-flex align-items-center justify-content-center icon-orange border rounded" x-on:click="open = ! open">
            <p class="m-0" x-show="!open">mostrar más</p>
            <p class="m-0" x-show="open">mostrar menos</p>
          </div>
        </div>
      </fieldset>

      <fieldset>
        <legend class="h6 text-secondary mb-3">2. Elige el tiempo de duración de tu plan.</legend>
        <div role="group" class="planes-numero-avisos d-flex flex-column align-items-center flex-lg-row gap-3 gap-lg-4 px-1 p-lg-0 mt-4">
          <div>
            <input type="radio" class="btn-check" id="90" value="90" autocomplete="off" x-model="periodoPlan">
            <label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="90">90 días</label>
          </div>
          <div>
            <input type="radio" class="btn-check" id="180" value="180" autocomplete="off" x-model="periodoPlan">
            <label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="180">180 días</label>
          </div>
          <div>
            <input type="radio" class="btn-check" id="365" value="365" autocomplete="off" x-model="periodoPlan">
            <label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="365">365 días</label>
          </div>
        </div>
      </fieldset>

      <!-- categoria de plan -->
      <fieldset>
        <legend class="text-secondary text-left h6 mb-3">3. Selecciona el mejor plan para ti.</legend>
        <div role="group" class="d-flex flex-column align-items-center flex-lg-row gap-4 mt-4">
          <!-- plan basico -->
          <div>
            <input type="radio" class="btn-check" x-model="tipoPlan" id="basic_plan" value="basic_plan" autocomplete="off">
            <x-card-plan
              title="Básico"
              price="prices.basico"
              time="periodoPlan"
              plan="basic_plan"
              className="btn-dark border-secondary"
              avisos="avisos.basico"
            />
          </div>

          <!-- plan estandar -->
          <div>
            <input type="radio" class="btn-check" x-model="tipoPlan" id="standard_plan" value="standard_plan" autocomplete="off" checked>
            <x-card-plan
              title="Estándar"
              price="prices.estandar"
              time="periodoPlan"
              plan="standard_plan"
              className="btn-warning border-warning"
              avisos="avisos.estandar"
            />
          </div>

          <!-- plan superior -->
          <div>
            <input type="radio" class="btn-check" x-model="tipoPlan" id="advance_plan" value="advance_plan" autocomplete="off">
            <x-card-plan
              title="Superior"
              price="prices.superior"
              time="periodoPlan"
              plan="advance_plan"
              className="btn-success border-success"
              avisos="avisos.superior"
            />
          </div>

        </div>
      </fieldset>

      {{-- modal de pago de paquete --}}
      
      <!-- Button trigger modal -->
      <button type="button" class="btn button-orange fs-3 px-5 rounded-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Seleccionar Plan
      </button>
    
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-body">
              <h3>Plan que elegido</h3>
              <p><span>S/.</span><span x-text=""></span></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    
  </form>
  
</div>

<script>
  function pricingData() {
    return {
      // campos formulario
      numAvisos: '5',
      periodoPlan: '90',
      tipoPlan: 'standard_plan',

      prices: {
        basico: 259,
        estandar: 325,
        superior: 405
      },
      avisos: {
        basico: [5,0,0],
        estandar: [3,2,0],
        superior: [2,2,1],
      },
      priceTable: {
        '5': { '90': [259, 325, 405], '180': [490, 605, 745], '365': [719, 875, 1075] },
        '10': { '90': [529, 649, 809], '180': [989, 1199, 1499], '365': [1449, 1769, 2179] },
        '25': { '90': [879, 1120, 1404], '180': [1829, 2110, 2625], '365': [2679, 3100, 3845] },
        '50': { '90': [1139, 1339, 1699], '180': [2249, 2619, 3265], '365': [3349, 3889, 4749] },
        '75': { '90': [1599, 1865, 2375], '180': [3129, 3625, 4575], '365': [4649, 5475, 6775] },
        '100': { '90': [1985, 2350, 3375], '180': [3970, 4630, 6190], '365': [5950, 6899, 9160] },
        '200': { '90': [3390, 3980, 5190], '180': [6890, 8110, 10500], '365': [10400, 12099, 14990] }
      },
      avisosDistribution: {
        '5': [ [5,0,0], [3,2,0], [2,2,1] ],
        '10': [ [10,0,0], [6,4,0], [4,4,2] ],
        '25': [ [25,0,0], [16,9,0], [13,9,3] ],
        '50': [ [50,0,0], [35,15,0], [25,18,7] ],
        '75': [ [75,0,0], [52,23,0], [37,29,9] ],
        '100': [ [100,0,0], [70,28,2], [50,40,10] ],
        '200': [ [200,0,0], [160,38,2], [120,60,20] ]
      },
      updatePrices() {
        const selectedPrices = this.priceTable[this.numAvisos][this.periodoPlan];
        this.prices.basico = selectedPrices[0];
        this.prices.estandar = selectedPrices[1];
        this.prices.superior = selectedPrices[2];
      },
      updateAvisosDistribution() {
        const selectAvisos = this.avisosDistribution[this.numAvisos];
        this.avisos.basico = selectAvisos[0];
        this.avisos.estandar = selectAvisos[1];
        this.avisos.superior = selectAvisos[2];
      },
      init() {
        this.$watch('numAvisos', () => {
          this.updatePrices() 
          this.updateAvisosDistribution()
        });
        this.$watch('periodoPlan', () => {
          this.updatePrices()
        });
      }
    }
  }

</script>

@endsection

@section('footer')
  <x-footer></x-footer>
@endsection