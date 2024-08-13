@extends('layouts.app')

@section('title')
	Planes de Pago Propietario
@endsection

@push('styles')
  	@vite(['resources/sass/pages/planes.scss'])
@endpush

@section('header')
  	@include('components.header')
@endsection

@section('content')

	<div class="container my-5" x-data="pricingData()">
    <div class="text-center">
      <h1 class="text-center fw-bold h2">Remata tu inmueble</h1>
      <h3 class=" text-secondary h5">Selecciona el plan con el que quieres publicar tu Remate</h3>
    </div>

		<form>
			@csrf
			<div class="d-flex flex-column align-items-center py-3 gap-5" x-data="consultaDocumento()">

				{{-- duración del plan --}}
				<fieldset>
					<legend class="h6 text-secondary mb-3">1. Elige el tiempo de duración.</legend>
				
						<div role="group" class="planes-numero-avisos d-flex flex-column flex-md-row justify-content-center align-items-center w-100 gap-3 gap-lg-4 px-1 p-lg-0 mt-4">
							<div>
								<input type="radio" class="btn-check" id="7" value="7" autocomplete="off" x-model="periodoPlan">
								<label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="7">7 días</label>
							</div>
							<div>
								<input type="radio" class="btn-check" id="15" value="15" autocomplete="off" x-model="periodoPlan">
								<label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="15">15 días</label>
							</div>
						</div>
				
				</fieldset>

				<!-- categoria de plan -->
				<fieldset>
					<legend class="text-secondary text-left h6 mb-3">2. Elige el plan para tu remate.</legend>
					<div>
						<div role="group" class="d-flex flex-column align-items-center flex-md-row gap-4 mt-4 w-100">
							<!-- plan top plus -->
							<div>
								<input type="radio" class="btn-check" x-model="tipoPlan" id="topPlus" value="topPlus" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modalPago">
								<x-card-plan-acreedor
									title="Top Plus"
                  tipoAviso="Top Plus"
									price="prices.topPlus"
									time="periodoPlan"
									plan="topPlus"
									className="btn-secondary border-secondary"
									avisos="avisos.topPlus"
								/>
							</div>
				
							<!-- plan top -->
							<div>
								<input type="radio" class="btn-check" x-model="tipoPlan" id="top" value="top" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modalPago">
								<x-card-plan-acreedor
									title="Top"
                  tipoAviso="Top"
									price="prices.top"
									time="periodoPlan"
									plan="top"
									className="btn-warning border-warning"
									avisos="avisos.top"
								/>
							</div>
				
							<!-- plan estándar -->
							<div>
								<input type="radio" class="btn-check" x-model="tipoPlan" id="estandar" value="estandar" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modalPago">
								<x-card-plan-acreedor
									title="Estándar"
                  tipoAviso="Típico"
									price="prices.estandar"
									time="periodoPlan"
									plan="estandar"
									className="btn-success border-success"
									avisos="avisos.estandar"
								/>
							</div>
						</div>
					</div>

				</fieldset>

				{{-- Modal de Pago --}}
				<x-pay-modal
					avisoId="{{ $aviso_id }}"
					userName="{{ $user->nombres }}"
					userSurname="{{ $user->apellidos }}"
					userEmail="{{ $user->email }}"
					userPhone="{{ $user->celular }}"
				>
					<x-card-plan-propietario-checkout
					showPlan="topPlus"
					title="Plan Top Plus"
					bgColor="text-bg-dark"
					/>

					<x-card-plan-propietario-checkout
					showPlan="top"
					title="Plan Top"
					bgColor="text-bg-warning"
					/> 

					<x-card-plan-propietario-checkout
					showPlan="estandar"
					title="Plan Estandar"
					bgColor="text-bg-success"
					/>

				</x-pay-modal>

			</div>    
		</form>
	</div>

	<script>

		let idPlan = 111;
		let tipoDeAviso = 3;

		function pricingData() {
				return {
						// campos formulario:
						aviso_id: {{$aviso_id}},
						tipoPlan: 'topPlus',
						periodoPlan: 15,
						numAvisos:1,

						prices: {
								topPlus: 149,
								top: 99,
								estandar: 49,
						},

						priceTable: {
								'1': { '15': [420, 350, 250], '7': [240, 200, 150] },
						},

						ids: {
								'1': { '15': [1, 2, 3], '7': [4, 5, 6] },
						},

						updateIds() {
								if (this.tipoPlan === 'topPlus') {
										idPlan = 111
										tipoDeAviso = 3
								} else if (this.tipoPlan === 'top') {
										idPlan = 110
										tipoDeAviso = 2
								} else if (this.tipoPlan === 'estandar') {
										idPlan = 109
										tipoDeAviso = 1
								}
						},

						init() {
								this.$watch('tipoPlan', () => {
									this.updateIds()

									console.log(idPlan, tipoDeAviso, this.aviso_id);
									
								})
						},
				}
		}

		document.addEventListener('alpine:init', () => {
				Alpine.store('creditCardData', creditCardData());
				Alpine.data('pricingData', pricingData);
		});

	</script>

@endsection

@section('footer')
	<x-footer></x-footer>
@endsection
  
@push('scripts-head')  
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="https://js.openpay.pe/openpay.v1.min.js"></script>
	<script src="https://js.openpay.pe/openpay-data.v1.min.js"></script>
@endpush