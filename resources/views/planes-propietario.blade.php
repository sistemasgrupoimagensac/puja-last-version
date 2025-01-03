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

	<div class="container my-5" x-data="pricingData()" x-init="init()">
		<div class="text-center">
			<h1 class="text-center fw-bold h2">Publica tu inmueble</h1>
			<h3 class=" text-secondary h5">Selecciona el plan con el que quieres publicar</h3>
		</div>

		{{-- SWITCH PAQUETES UN AVISO O TOP --}}
		<div class="text-center mt-5 mb-3">
			<div class="btn-group btn-group-lg" role="group" aria-label="Basic radio toggle button group">
				<input type="radio" class="btn-check" name="btnradio" id="unaviso" autocomplete="off" checked @click="categoriaPlan = 'unaviso'" />
				<label class="btn btn-outline-dark" for="unaviso">Un Aviso</label>

				<input type="radio" class="btn-check" name="btnradio" id="masavisos" autocomplete="off" @click="categoriaPlan = 'masavisos'" />
				<label class="btn btn-outline-dark" for="masavisos">Más Avisos</label>
			</div>
		</div>

		<form>
			@csrf
			<div class="d-flex flex-column align-items-center py-3 gap-5" x-data="consultaDocumento()">
				<!-- número de avisos del plan -->
				<fieldset>
					<legend class="text-secondary h6 mb-3">1. Selecciona el número de avisos.</legend>
					{{-- PLANES MAS AVISOS --}}
					<div x-show=" categoriaPlan === 'masavisos' ">
						<div role="group" class="planes-numero-avisos d-flex flex-column flex-md-row justify-content-center align-items-center w-100 gap-3 gap-lg-4 px-1 p-lg-0 mt-4">
							<div>
								<input type="radio" class="btn-check" id="tresavisos" value="3" autocomplete="off" x-model="numAvisos" />
								<label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="tresavisos">3 Avisos</label>
							</div>
							<div>
								<input type="radio" class="btn-check" id="cincoavisos" value="5" autocomplete="off" x-model="numAvisos" />
								<label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="cincoavisos">5 Avisos</label>
							</div> 
						</div>
					</div>
					{{-- UNICO AVISO --}}
					<div x-show=" categoriaPlan === 'unaviso' ">
						<div role="group" class="planes-numero-avisos d-flex flex-column flex-md-row justify-content-center align-items-center w-100 gap-3 gap-lg-4 px-1 p-lg-0 mt-4">
							<div>
								<input type="radio" class="btn-check" id="unicoaviso" value="1" autocomplete="off" x-model="numAvisos" />
								<label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="unicoaviso">1 Aviso</label>
							</div> 
						</div>
					</div>
				</fieldset>

				{{-- duración del plan --}}
				<fieldset>
					<legend class="h6 text-secondary mb-3">2. Elige el tiempo de duración.</legend>
					<div>
						<div role="group" class="planes-numero-avisos d-flex flex-column flex-md-row justify-content-center align-items-center w-100 gap-3 gap-lg-4 px-1 p-lg-0 mt-4">
							<div>
								<input type="radio" class="btn-check" id="30" value="30" autocomplete="off" x-model="periodoPlan">
								<label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="30">30 días</label>
							</div>
							<div>
								<input type="radio" class="btn-check" id="60" value="60" autocomplete="off" x-model="periodoPlan">
								<label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="60">60 días</label>
							</div>
							<div>
								<input type="radio" class="btn-check" id="90" value="90" autocomplete="off" x-model="periodoPlan">
								<label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="90">90 días</label>
							</div>
						</div>
					</div>
				</fieldset>

				<!-- categoria de plan -->
				<fieldset>
					<legend class="text-secondary text-left h6 mb-3">3. Selecciona el mejor paquete para ti.</legend>
					{{-- PAQUETES unaviso - categoria plan--}}
					<div>
						<div role="group" class="d-flex flex-column align-items-center flex-md-row gap-4 mt-4 w-100">
							
							<template x-for="plan in planes" :key="plan.id">
								<div>
									<input 
										type="radio" 
										class="btn-check" 
										x-model="planId" 
										:id="`plan-${plan.id}`" 
										:value="plan.id"
										{{-- autocomplete="off" 
										data-bs-toggle="modal" 
										data-bs-target="#modalPago" --}}
										@click="selectPlan(plan.id)"
									>

									<label
										class="card btn btn-lg p-0 card-plan-propietario-label rounded-4"
										:class="plan.class_name"
										:for="`plan-${plan.id}`"
									>
										<div>
											<div class="card-body p-0">
												<h3 class="card-title fw-bolder mt-3" x-text="plan.name"></h3>
												<h4 class="card-subtitle mb-2">
													S/ <span x-text="formatPrice(plan.price)"></span> por 
													<span x-text="plan.duration_in_days"></span> días
												</h4>

												<template x-if="plan.duration_in_days == 60">
													<h6 class="fw-bolder">ahorras 15%</h6>
												</template>

												<template x-if="plan.duration_in_days == 90">
													<h6 class="fw-bolder">ahorras 25%</h6>
												</template>
										
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
											</div>
											<div class="card-footer fw-bold fs-5">
												¡Lo quiero!
											</div>
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
						userApe="Herrera"
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
		let idPlan = 3;
		// let tipoDeAviso = 3;

		function pricingData() {
			return {
				aviso_id: {{$aviso_id}},
				prices: 0,
				planes: [],
				planId: null,
				tipoPlan: "Plan Estandar",
				categoriaPlan: 'unaviso',
				tipoDeAviso: 0,
				numAvisos: 1,
				periodoPlan: 30,
				loading: false,
				error: '',

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
						
						this.prices = data.data.price
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

					this.$watch('categoriaPlan', () => {
						this.debounceFetch();
					})
					this.$watch('numAvisos', () => {
						this.debounceFetch();
					})
					this.$watch('periodoPlan', () => {
						this.debounceFetch();
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