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
  <h1 class="text-center fw-bold h2">¿cuantos inmuebles quieres publicar?</h1>

  {{-- SWITCH PAQUETES MIXTOS O TOP --}}
  <div class="text-center mt-5 mb-3">
    <div class="btn-group btn-group-lg" role="group" aria-label="Basic radio toggle button group">
      <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked @click="categoriaPlan = 'mixto'">
      <label class="btn btn-outline-dark" for="btnradio1">Paquetes Mixtos</label>

      <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" @click="categoriaPlan = 'top'">
      <label class="btn btn-outline-dark" for="btnradio2">Paquetes Top</label>
    </div>
  </div>

  <form>
    @csrf
    <div class="d-flex flex-column align-items-center py-3 gap-5">
      <!-- número de avisos del plan -->
      <fieldset>
        <legend class="text-secondary h6 mb-3">1. Selecciona el número de avisos.</legend>
        {{-- PAQUETES TOP --}}
        <div x-show=" categoriaPlan === 'top' ">
          <div role="group" class="planes-numero-avisos d-flex flex-column flex-md-row justify-content-center align-items-center w-100 gap-3 gap-lg-4 px-1 p-lg-0 mt-4" x-data="{ open: false }">
            <div>
              <input type="radio" class="btn-check" id="1avisotop" value="1" autocomplete="off" x-model="numAvisosTop">
              <label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="1avisotop">1 Aviso</label>
            </div>
            <div>
              <input type="radio" class="btn-check" id="3avisotop" value="3" autocomplete="off" x-model="numAvisosTop">
              <label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="3avisotop">3 Avisos</label>
            </div>
            <div>
              <input type="radio" class="btn-check" id="5avisotop" value="5" autocomplete="off" x-model="numAvisosTop">
              <label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="5avisotop">5 Avisos</label>
            </div> 
          </div>
        </div>

        {{-- PAQUETES MIXTOS --}}
        <div x-show=" categoriaPlan === 'mixto' ">
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
        </div>
      </fieldset>

      {{-- duración del plan --}}
      <fieldset>
        <legend class="h6 text-secondary mb-3">2. Elige el tiempo de duración.</legend>
        {{-- PAQUETES TOP - duración --}}
        <div x-show=" categoriaPlan === 'top' ">
          <div role="group" class="planes-numero-avisos d-flex flex-column flex-md-row justify-content-center align-items-center w-100 gap-3 gap-lg-4 px-1 p-lg-0 mt-4">
            <div>
              <input type="radio" class="btn-check" id="30top" value="30" autocomplete="off" x-model="periodoPlanTop">
              <label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="30top">30 días</label>
            </div>
            <div>
              <input type="radio" class="btn-check" id="60top" value="60" autocomplete="off" x-model="periodoPlanTop">
              <label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="60top">60 días</label>
            </div>
            <div>
              <input type="radio" class="btn-check" id="90top" value="90" autocomplete="off" x-model="periodoPlanTop">
              <label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="90top">90 días</label>
            </div>
          </div>
        </div>

        {{-- PAQUETES MIXTOS - duración --}}
        <div x-show=" categoriaPlan === 'mixto' ">
          <div role="group" class="planes-numero-avisos d-flex flex-column flex-md-row justify-content-center align-items-center w-100 gap-3 gap-lg-4 px-1 p-lg-0 mt-4">
            <div>
              <input type="radio" class="btn-check" id="90mix" value="90" autocomplete="off" x-model="periodoPlan">
              <label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="90mix">90 días</label>
            </div>
            <div>
              <input type="radio" class="btn-check" id="180mix" value="180" autocomplete="off" x-model="periodoPlan">
              <label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="180mix">180 días</label>
            </div>
            <div>
              <input type="radio" class="btn-check" id="365mix" value="365" autocomplete="off" x-model="periodoPlan">
              <label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="365mix">365 días</label>
            </div>
          </div>

        </div>
      </fieldset>

      <!-- categoria de plan -->
      <fieldset>
        <legend class="text-secondary text-left h6 mb-3">3. Selecciona el mejor paquete para ti.</legend>
        {{-- PAQUETES MIXTO - categoria plan--}}
        <div x-show=" categoriaPlan === 'mixto' ">
          <div role="group" class="d-flex flex-column align-items-center flex-md-row gap-4 mt-4 w-100">
            <!-- plan basico -->
            <div>
              <input type="radio" class="btn-check" x-model="tipoPlan" id="basico" value="basico" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modalPago">
              <x-card-plan
                title="Básico"
                price="prices.basico"
                time="periodoPlan"
                plan="basico"
                className="btn-secondary border-secondary"
                avisos="avisos.basico"
              />
            </div>
  
            <!-- plan estandar -->
            <div>
              <input type="radio" class="btn-check" x-model="tipoPlan" id="estandar" value="estandar" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modalPago">
              <x-card-plan
                title="Estándar"
                price="prices.estandar"
                time="periodoPlan"
                plan="estandar"
                className="btn-warning border-warning"
                avisos="avisos.estandar"
              />
            </div>
  
            <!-- plan superior -->
            <div>
              <input type="radio" class="btn-check" x-model="tipoPlan" id="superior" value="superior" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modalPago">
              <x-card-plan
                title="Superior"
                price="prices.superior"
                time="periodoPlan"
                plan="superior"
                className="btn-success border-success"
                avisos="avisos.superior"
              />
            </div>
  
          </div>
        </div>

        {{-- PAQUETES TOP - categoria plan--}}
        <div x-show=" categoriaPlan === 'top' ">
          <div role="group" class="d-flex flex-column align-items-center flex-md-row gap-4 mt-4 w-100">
            {{-- plan top --}}
            <div>
              <input type="radio" class="btn-check" x-model="tipoPlan" id="top" value="top" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modalPago">
              <x-card-plan
                title="Top"
                price="prices.top"
                time="periodoPlanTop"
                plan="top"
                className="btn-light border-dark"
                avisos="numAvisosTop"
              />
            </div>
  
            <!-- plan top plus -->
            <div>
              <input type="radio" class="btn-check" x-model="tipoPlan" id="topPlus" value="topPlus" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modalPago">
              <x-card-plan
                title="Top Plus"
                price="prices.topPlus"
                time="periodoPlanTop"
                plan="topPlus"
                className="btn-danger border-danger"
                avisos="numAvisosTop"
              />
            </div>
          </div>
        </div>
      </fieldset>

      {{-- MODAL PAGO --}}
      <div class="modal fade" id="modalPago" tabindex="-1" aria-labelledby="modalPagoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

          <div class="modal-content rounded-4 position-relative custom" x-data="creditCardData()">
            <form>
              @csrf

              <div class="modal-body p-0">
              <button type="button" class="btn-close p-2 m-2 position-absolute bg-white top-0 end-0 z-1" data-bs-dismiss="modal" aria-label="Close"></button>
                
                <div class="d-flex flex-column flex-lg-row h-100">
                  {{-- detalles del plan contratado --}}
                  <div class="z-0 col p-lg-5">
                    <x-card-plan-checkout
                      showPlan="basico"
                      title="Básico"
                      bgColor="text-bg-dark"
                    />
    
                    <x-card-plan-checkout
                      showPlan="estandar"
                      title="Estándar"
                      bgColor="text-bg-warning"
                    />
    
                    <x-card-plan-checkout
                      showPlan="superior"
                      title="Superior"
                      bgColor="text-bg-success"
                    />
    
                    <x-card-plan-checkout
                      showPlan="top"
                      title="Top"
                      bgColor="text-bg-light"
                    />
    
                    <x-card-plan-checkout
                      showPlan="topPlus"
                      title="Top Plus"
                      bgColor="text-bg-danger"
                    />
                  </div>
    
                  {{-- Datos de la tarjeta de crédito --}}
                  <div class="m-2 col p-lg-5 m-lg-0">
                    <h6 class="icon-orange fw-bold">Pago con tarjeta</h6>
                    {{-- Número de la tarjeta de crédito o débito --}}
                    <div class="mb-3">
                      <label for="numeroTarjeta" class="form-label m-0 custom">Número de Tarjeta</label>
                      <div class="input-group">
                        <input type="text" class="form-control credit-card-input shadow-none" id="numeroTarjeta" x-model="numeroTarjeta" inputmode="numeric" minlength="19" maxlength="19" @input="formatCardNumber">
                        <span class="input-group-text"><i class="fa-regular fa-credit-card"></i></span>
                      </div>
                    </div>
  
                    {{-- Nombre de la tarjeta --}}
                    <div class="mb-3">
                      <label for="nombreTarjeta" class="form-label m-0 custom">Nombre en la Tarjeta</label>
                      <div class="input-group">
                        <input type="text" class="form-control shadow-none" id="nombreTarjeta" x-model="nombreTarjeta" inputmode="latin-name" maxlength="26">
                      </div>
                    </div>
  
                    <div class="d-flex justify-content-between">
                      {{-- Fecha de vencimiento --}}
                      <div class="mb-3 col-7">
                        <label for="fechaTarjeta" class="form-label m-0 custom">Fecha de Vencimiento</label>
                        <input type="text" class="form-control shadow-none" id="fechaTarjeta" x-model="fechaTarjeta" placeholder="MM/AA" maxlength="5" @input="formatExpiryDate">
                      </div>
                      {{-- CVC de la tarjeta --}}
                      <div class="mb-3 col-4">
                        <label for="cvcTarjeta" class="form-label m-0 custom">CVC</label>
                        <input type="password" class="form-control shadow-none" id="cvcTarjeta" x-model="cvcTarjeta" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3"/>
                      </div>
                    </div>

                  </div>
                  
                </div>
              </div>
              <div class="d-flex justify-content-center w-100">
                <button type="button" class="btn button-orange fs-3 rounded-3 m-2 mx-lg-5 w-100">Pagar S/ <span x-text="prices[tipoPlan]"></span></button>
              </div>
              <small class="text-body-tertiary p-3 px-lg-5">Al hacer clic en Pagar, está aceptando nuestros <a href="#">Términos y Condiciones de Contratación</a></small>
            </form>

          </div>
        </div>
      </div>

    </div>    
  </form>
  
</div>

<script>
  function pricingData() {
    return {
      // campos formulario:
      categoriaPlan: 'mixto',
      tipoPlan: '',

      // paquetes Mixtos
      numAvisos: 5,
      periodoPlan: 90,
      pricePlan: null,

      // paquetes Top
      numAvisosTop: 1,
      periodoPlanTop: 30,
      pricePlanTop: null,

      prices: {
        // categoria plan: mixto
        basico: 259,
        estandar: 325,
        superior: 405,
        // categoria plan: top
        top: 129,
        topPlus: 239,
      },
      avisos: {
        basico: [5,0,0],
        estandar: [3,2,0],
        superior: [2,2,1],
      },
      priceTableTop: {
        '1': { '30': [129, 239], '60': [219, 406], '90': [290, 537] },
        '3': { '30': [290, 540], '60': [495, 915], '90': [650, 1210] },
        '5': { '30': [505, 715], '60': [850, 1220], '90': [1225, 1610] },
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
        'mixto' : {
          '5': [ [5,0,0], [3,2,0], [2,2,1] ],
          '10': [ [10,0,0], [6,4,0], [4,4,2] ],
          '25': [ [25,0,0], [16,9,0], [13,9,3] ],
          '50': [ [50,0,0], [35,15,0], [25,18,7] ],
          '75': [ [75,0,0], [52,23,0], [37,29,9] ],
          '100': [ [100,0,0], [70,28,2], [50,40,10] ],
          '200': [ [200,0,0], [160,38,2], [120,60,20] ]
        }
      },
      updatePrices() {
        const selectedPrices = this.priceTable[this.numAvisos][this.periodoPlan]
        this.prices.basico = selectedPrices[0]
        this.prices.estandar = selectedPrices[1]
        this.prices.superior = selectedPrices[2]
      },
      updatePricesTop() {
        const selectedPricesTop = this.priceTableTop[this.numAvisosTop][this.periodoPlanTop]
        this.prices.top = selectedPricesTop[0]
        this.prices.topPlus = selectedPricesTop[1]
      },
      updateAvisosDistribution() {
        const selectAvisos = this.avisosDistribution[this.categoriaPlan][this.numAvisos]
        this.avisos.basico = selectAvisos[0]
        this.avisos.estandar = selectAvisos[1]
        this.avisos.superior = selectAvisos[2]
      },
      init() {
        // paquetes mixtos
        this.$watch('numAvisos', () => {
          this.updatePrices() 
          this.updateAvisosDistribution()
        })
        this.$watch('periodoPlan', () => {
          this.updatePrices()
        })
        // paquetes top
        this.$watch('numAvisosTop', () => {
          this.updatePricesTop() 
          console.log(this.numAvisosTop);
        })
        this.$watch('periodoPlanTop', () => {
          console.log(this.periodoPlanTop);
          this.updatePricesTop()
        })

        this.$watch('tipoPlan', () => {
          this.pricePlan = this.prices[this.tipoPlan]
          this.pricePlaTop = this.prices[this.tipoPlan]
        })
        this.$watch('categoriaPlan', () => {
          this.updatePrices()
        })
      },
    }
  }

  function creditCardData() {

    return {
      // tarjeta de credito
      numeroTarjeta: '',
      nombreTarjeta: '',
      fechaTarjeta: '',
      cvcTarjeta: '',

      formatCardNumber() {
        let input = this.numeroTarjeta.replace(/\D/g, '')
        this.numeroTarjeta = input.replace(/(.{4})/g, '$1 ').trim()
      },

      formatExpiryDate() {
        let input = this.fechaTarjeta.replace(/\D/g, '')

        if (input.length > 0 && input.length <= 2) {
          if (parseInt(input, 10) > 12) {
            input = '12'
          }
        }

        if (input.length = 2) {
          input = input.substring(0, 4) 
          input = input.replace(/(\d{2})(\d{1,2})/, '$1/$2') 
        }

        this.fechaTarjeta = input
      },

    }
  }
</script>
@endsection

@section('footer')
<x-footer></x-footer>
@endsection

@push('scripts')
    @vite(['resources/js/scripts/planes.js'])
@endpush