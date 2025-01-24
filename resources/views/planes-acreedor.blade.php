@extends('layouts.app')

@section('title')
	Planes de Pago Propietario
@endsection

@push('styles')
  	@vite(['resources/sass/pages/planes.scss', 'resources/sass/components/card-plan-propietario.scss', 'resources/sass/components/flipping.scss'])
@endpush

@section('header')
  	@include('components.header')
@endsection

@section('content')

	<div id="loader-overlay">
		<div class="flipping"></div>
	</div>

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
					<legend class="h6 text-secondary mb-3">1. Elige el tiempo de duración del aviso</legend>
				
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
					<legend class="text-secondary text-left h6 mb-3">2. Elige el tipo de aviso para tu remate</legend>
					<div>
						{{-- <div role="group" class="d-flex flex-column align-items-center flex-md-row gap-4 mt-4 w-100"> --}}
						<div role="group" class="row row-cols-1 row-cols-md-3 g-4 d-flex align-items-stretch mt-4 w-100">

							<template x-for="plan in planes" :key="plan.id">
								<div>
									<input 
										type="radio" 
										class="btn-check" 
										x-model="planId" 
										:id="`plan-${plan.id}`" 
										:value="plan.id"
										@click="selectPlan(plan.id)"
									>

									<label
										class="card btn btn-lg p-0 card-plan-propietario-label rounded-4 h-100"
										:class="plan.class_name"
										:for="`plan-${plan.id}`"
									>
										<div class="card-body d-flex flex-column p-0">
											<h3 class="card-title fw-bolder mt-3" x-text="plan.name"></h3>
											
											<template x-if="plan.promotion && plan.promotion2">
												<div>
													<h4 class="card-subtitle mb-2">
														S/ <span x-text="
															formatPrice(
																plan.price * (1 - plan.promotion.percentage / 100) * (1 - plan.promotion2.percentage / 100)
															)
														"></span>
														por <span x-text="plan.duration_in_days"></span> días
													</h4>
													<h6 class="fw-bolder">
														Descuento especial: <span x-text="plan.promotion.percentage"></span>%
														<br>
														Descuento adicional: <span x-text="plan.promotion2.percentage"></span>%
													</h6>
													<h6 class="card-subtitle mb-2">
														Precio regular: S/ <span x-text="formatPrice(plan.price)"></span>
													</h6>
												</div>
											</template>

											<template x-if="plan.promotion && !plan.promotion2">
												<div>
													<h4 class="card-subtitle mb-2">
														S/ <span x-text="
															formatPrice(
																plan.price * (1 - plan.promotion.percentage / 100)
															)
														"></span>
														por <span x-text="plan.duration_in_days"></span> días
													</h4>
													<h6 class="fw-bolder">
														Descuento especial: <span x-text="plan.promotion.percentage"></span>%
													</h6>
													<h6 class="card-subtitle mb-2">
														Precio regular: S/ <span x-text="formatPrice(plan.price)"></span>
													</h6>
												</div>
											</template>

											<template x-if="!plan.promotion && plan.promotion2">
												<div>
													<h4 class="card-subtitle mb-2">
														S/ <span x-text="
															formatPrice(
																plan.price * (1 - plan.promotion2.percentage / 100)
															)
														"></span>
														por <span x-text="plan.duration_in_days"></span> días
													</h4>
													<h6 class="fw-bolder">
														Descuento especial: <span x-text="plan.promotion2.percentage"></span>%
													</h6>
													<h6 class="card-subtitle mb-2">
														Precio regular: S/ <span x-text="formatPrice(plan.price)"></span>
													</h6>
												</div>
											</template>

											<template x-if="!plan.promotion && !plan.promotion2">
												<div>
													<h4 class="card-subtitle mb-2">
														S/ <span x-text="formatPrice(plan.price)"></span>
														por <span x-text="plan.duration_in_days"></span> días
													</h4>
												</div>
											</template>

										</div>
										<hr>
										<div class="card-description-plan d-flex justify-content-start px-4">
											<ul class="list-unstyled text-start h6 mb-4">
												<li>Publicación de Aviso <span x-text="plan.tipoAviso"></span></li>
												<li><span x-text="plan.duration_in_days"></span> días de publicación</li>
						
												<template x-if="plan.name === 'Plan Premium'">
													<li>Genera interesados</li>
													<li>Alta visibilidad</li>
													<li>Exposición Óptima</li>
												</template>
												<template x-if="plan.name === 'Plan Top'">
													<li>Genera interesados</li>
													<li>Alta visibilidad</li>
												</template>
												<template x-if="plan.name === 'Plan Estandar'">
													<li>Visibilidad Convencional</li>
												</template>
											</ul>
										</div>
										<div class="card-footer fw-bold fs-5">
											¡Lo quiero!
										</div>
									</label>

								</div>
							</template>

						</div>
					</div>
				</fieldset>

				{{-- Modal de Pago --}}
				@isset($user)
					<x-pay-modal
						avisoId="{{ $aviso_id }}"
						userName="{{ $user->nombres }}"
						userSurname="{{ $user->apellidos }}"
						userEmail="{{ $user->email }}"
						userPhone="{{ $user->celular }}"
						userTypeId="{{ $user->tipo_usuario_id }}"
					>
						<x-card-plan-propietario-checkout
							showPlan="Plan Premium"
							title="Plan Premium"
							bgColor="text-bg-dark"
						/>

						<x-card-plan-propietario-checkout
							showPlan="Plan Top"
							title="Plan Top"
							bgColor="text-bg-warning"
						/> 

						<x-card-plan-propietario-checkout
							showPlan="Plan Estandar"
							title="Plan Estandar"
							bgColor="text-bg-success"
						/>

					</x-pay-modal>
				@endisset

			</div>    
		</form>
	</div>

	<script>

		const $loaderOverlay = document.getElementById('loader-overlay');
		let idPlan = 111;

		function pricingData() {
			return {

				aviso_id: {{$aviso_id}},
				prices: 0,
				planes: [],
				planId: null,
				tipoPlan: "Plan Estandar",
				categoriaPlan: 'acreedor',
				tipoDeAviso: 0,
				numAvisos: 1,
				periodoPlan: 15,
				loading: false,
				error: '',
				pagoFree: false,

				priceTable: {
					'7': [150, 200, 240], '15': [250, 350, 420] ,
				},

				ids: {
					'7': [109, 110, 111], '15': [112, 113, 114],
				},

				updatePrices() {
					const selectedPrices = this.priceTable[this.periodoPlan];
					this.prices.estandar = selectedPrices[0];
					this.prices.top = selectedPrices[1];
					this.prices.topPlus = selectedPrices[2];
				},

				updateIds() {
					const selectedId = this.ids[this.periodoPlan];
					if (this.tipoPlan === 'estandar') {
						idPlan = selectedId[0]
						tipoDeAviso = 1
					} else if (this.tipoPlan === 'top') {
						idPlan = selectedId[1]
						tipoDeAviso = 2
					} else if (this.tipoPlan === 'topPlus') {
						idPlan = selectedId[2]
						tipoDeAviso = 3
					}
				},

				fetchPlanes() {
					$loaderOverlay.style.display = 'flex';
					document.body.style.pointerEvents = 'none';

					const datos = {
						package: this.categoriaPlan,
						total_ads: this.numAvisos,
						duration_in_days: this.periodoPlan,
					}

					this.loading = true;
					this.error = '';

					fetch('{{ route("get_planes") }}', {
						method: 'POST',
						headers: {
							'Accept': 'application/json',
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
						},
						body: JSON.stringify(datos)
					})
					.then( response => response.json() )
					.then( data => {

						this.loading = false;
						if(data.status === 'Success') {
							this.planes = data.data;
							console.log(this.planes)
						} else {
							this.error = data.message || 'Error al obtener los planes.';
						}
						
					})
					.catch(error => {
						this.loading = false;
						this.error = 'Error: ' + error.message;
					})
					.finally(() => {
						$loaderOverlay.style.display = 'none';
						document.body.style.pointerEvents = 'auto';
					});


				},

				getPlan() {
					$loaderOverlay.style.display = 'flex';
					document.body.style.pointerEvents = 'none';

					const datos = {
						plan_id: this.planId,
					}

					fetch('{{ route("get_plan") }}', {
						method: 'POST',
						headers: {
							'Accept': 'application/json',
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
						},
						body: JSON.stringify(datos)
					})
					.then( response => response.json() )
					.then( data => {
						if (data.data.promotion !== null && data.data.promotion2 !== null ) {
							this.prices = data.data.price
								* (1 - data.data.promotion.percentage / 100)
								* (1 - data.data.promotion2.percentage / 100);
						} else if (data.data.promotion && !data.data.promotion2) {
							this.prices = data.data.price
								* (1 - data.data.promotion.percentage / 100);
						} else if (!data.data.promotion && data.data.promotion2) {
							this.prices = data.data.price
								* (1 - data.data.promotion2.percentage / 100);
						} else {
							this.prices = data.data.price;
						}
						this.prices = this.formatPrice(this.prices)
						this.tipoPlan = data.data.name
						if ( this.tipoPlan === "Plan Estandar" ) {
							this.tipoDeAviso = 1
						} else if ( this.tipoPlan === "Plan Top" ) {
							this.tipoDeAviso = 2
						} else if ( this.tipoPlan === "Plan Premium" ) {
							this.tipoDeAviso = 3
						}
						
					})
					.catch(error => {
						console.error('Error:', error.message)
					})
					.finally(() => {
						$loaderOverlay.style.display = 'none';
						document.body.style.pointerEvents = 'auto';
					});

				},

				selectPlan(planId) {
					this.planId = planId;
					this.getPlan();
					const modalPago = new bootstrap.Modal('#modalPago');
					modalPago.show();
				},

				debounceFetch() {
					clearTimeout(this._fetchTimer);
					this._fetchTimer = setTimeout(() => {
						this.fetchPlanes();
					}, 300);
				},

				formatPrice(price) {
					return Number(price).toLocaleString('es-PE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
				},

				init() {

					this.debounceFetch();

					this.$watch('tipoPlan', () => {
						this.debounceFetch();
						// this.updateIds()
					})

					this.$watch('periodoPlan', () => {
						this.debounceFetch();
						// this.updatePrices()
						// this.updateIds()
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