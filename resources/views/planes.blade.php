@extends('layouts.app')

@section('title')
	Planes de Pago
@endsection

@push('styles')
  	@vite(['resources/sass/pages/planes.scss', 'resources/sass/components/card_plan.scss', 'resources/sass/components/flipping.scss'])
@endpush

@section('header')
    @include('components.header', ['tienePlanes' => $tienePlanes])
@endsection

@section('content')

	<div id="loader-overlay">
		<div class="flipping"></div>
	</div>

	<div class="container my-5" x-data="pricingData()">
		<x-completa-registro-google></x-completa-registro-google>

		<h1 class="text-center fw-bold h2">¿cuantos inmuebles quieres publicar?</h1>

		{{-- SWITCH PAQUETES MIXTOS O TOP --}}
		<div class="text-center mt-5 mb-3">
			<div class="btn-group btn-group-lg" role="group" aria-label="Basic radio toggle button group">
				<input type="radio" class="btn-check" name="btnradio" id="mixtoCheck" autocomplete="off" checked @click="categoriaPlan = 'mixto'" />
				<label class="btn btn-outline-dark" for="mixtoCheck">Planes Mixtos</label>

				<input type="radio" class="btn-check" name="btnradio" id="topCheck" autocomplete="off" @click="categoriaPlan = 'top'" />
				<label class="btn btn-outline-dark" for="topCheck">Planes Exclusivos</label>
			</div>
		</div>

		<form>
			@csrf
			<div class="d-flex flex-column align-items-center py-3 gap-5" x-data="consultaDocumento()">
				<!-- número de avisos del plan -->
				<fieldset>
					<legend class="text-secondary h6 mb-3">1. Selecciona el número de avisos.</legend>
					{{-- PAQUETES TOP --}}
					<div x-show=" categoriaPlan === 'top' ">
						<div role="group" class="planes-numero-avisos d-flex flex-column flex-md-row justify-content-center align-items-center w-100 gap-3 gap-lg-4 px-1 p-lg-0 mt-4" x-data="{ open: false }">
							<div>
								<input type="radio" class="btn-check" id="1avisotop" value="1" autocomplete="off" x-model="numAvisosTop" />
								<label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="1avisotop">1 Aviso</label>
							</div>
							<div>
								<input type="radio" class="btn-check" id="3avisotop" value="3" autocomplete="off" x-model="numAvisosTop" />
								<label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="3avisotop">3 Avisos</label>
							</div>
							<div>
								<input type="radio" class="btn-check" id="5avisotop" value="5" autocomplete="off" x-model="numAvisosTop" />
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
								<p class="m-0" x-show="open">mostrar menos.</p>
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
					
					{{-- <div x-show=" categoriaPlan === 'mixto' ">
						<div role="group" class="d-flex flex-column align-items-center flex-md-row gap-4 mt-4 w-100">
							<div>
								@if ($sesion_iniciada)
									<input type="radio" class="btn-check" x-model="tipoPlan" id="basico" value="basico" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modalPago">
								@endif
								<x-card-plan
									:$sesion_iniciada
									title="Básico"
									price="prices.basico"
									time="periodoPlan"
									plan="basico"
									className="btn-secondary border-secondary"
									avisos="avisos.basico"
								/>
							</div>
				
							<div>
								@if ($sesion_iniciada)
									<input type="radio" class="btn-check" x-model="tipoPlan" id="estandar" value="estandar" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modalPago">
								@endif
								<x-card-plan
									:$sesion_iniciada
									title="Estándar"
									price="prices.estandar"
									time="periodoPlan"
									plan="estandar"
									className="btn-warning border-warning"
									avisos="avisos.estandar"
								/>
							</div>
				
							<div>
								@if ($sesion_iniciada)
									<input type="radio" class="btn-check" x-model="tipoPlan" id="superior" value="superior" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modalPago">
								@endif
								<x-card-plan
									:$sesion_iniciada
									title="Premium"
									price="prices.superior"
									time="periodoPlan"
									plan="superior"
									className="btn-success border-success"
									avisos="avisos.superior"
								/>
							</div>
						</div>
					</div>

					<div x-show=" categoriaPlan === 'top' ">
						<div role="group" class="d-flex flex-column align-items-center flex-md-row gap-4 mt-4 w-100">
							<div>
								@if ($sesion_iniciada)
									<input type="radio" class="btn-check" x-model="tipoPlan" id="top" value="top" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modalPago">
								@endif
								<x-card-plan
									:$sesion_iniciada
									title="Top"
									price="prices.top"
									time="periodoPlanTop"
									plan="top"
									className="btn-light border-dark"
									avisos="numAvisosTop"
								/>
							</div>
				
							<div>
								@if ($sesion_iniciada)
									<input type="radio" class="btn-check" x-model="tipoPlan" id="premium" value="premium" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modalPago">
								@endif
								<x-card-plan
									:$sesion_iniciada
									title="Premium"
									price="prices.premium"
									time="periodoPlanTop"
									plan="premium"
									className="btn-danger border-danger"
									avisos="numAvisosTop"
								/>
							</div>
						</div>
					</div> --}}




					<div role="group" class="d-flex flex-column align-items-center flex-md-row gap-4 mt-4 w-100">

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
									class="card btn btn-lg p-0 card-plan-label rounded-4"
									:class="plan.class_name"
									:for="`plan-${plan.id}`"
								>

									{{-- @if (!$sesion_iniciada)
										<a class="text-decoration-none text-reset" href="{{ route("sign_in", ['profile_type' => 3]) }}">
									@endif --}}

										<div>
											<div class="card-body p-0">
												<h3 class="card-title fw-bolder mt-3" x-text="plan.name"></h3>
												<template x-if="plan.promotion !== null">
													<h4 class="card-subtitle mb-2">
														S/ <span x-text="formatPrice(plan.price*plan.promotion.percentage/100)"></span> por 
														<span x-text="plan.duration_in_days"></span> días
													</h4>
												</template>
												<template x-if="plan.promotion !== null">
													<h6 class="fw-bolder">ahorras <span x-text="plan.promotion.percentage"></span>%</h6>
												</template>
												<template x-if="plan.promotion !== null">
													<h6 class="card-subtitle mb-2">precio regular S/ <span x-text="formatPrice(plan.price)"></span></h6>
												</template>

												<template x-if="plan.promotion === null">
													<h4 class="card-subtitle mb-2">
														S/ <span x-text="formatPrice(plan.price)"></span> por 
														<span x-text="plan.duration_in_days"></span> días
													</h4>
												</template>

												<hr>
												<div class="card-description-plan d-flex justify-content-start px-4">
													<ul class="list-unstyled text-start h6 mb-4">
														<li>
															<span x-text="plan.typical_ads"></span><span> avisos típicos</span>
														</li>
														<li>
															<span x-text="plan.top_ads"></span><span> avisos top</span>
														</li>
														<li>
															<span x-text="plan.premium_ads"></span><span> avisos premium</span>
														</li>
													</ul>
												</div>
											</div>
											<div class="card-footer fw-bold fs-5">
												¡Lo quiero!
											</div>
										</div>

									{{-- @if (!$sesion_iniciada)
										</a>   
								  	@endif --}}

								</label>

							</div>
						</template>

					</div>





				</fieldset>

				{{-- Modal de Pago --}}
				@isset($user)
					<x-pay-modal
						avisoId="null"
						userName="{{ $user->nombres }}"
						userSurname="{{ $user->apellidos }}"
						userEmail="{{ $user->email }}"
						userPhone="{{ $user->celular }}"
						userTypeId="{{ $user->tipo_usuario_id }}"
					>
						<x-card-plan-checkout
						showPlan="Plan Estandar"
						title="Plan Estandar"
						bgColor="text-bg-dark"
						/>

						<x-card-plan-checkout
						showPlan="Plan VIP"
						title="Plan VIP"
						bgColor="text-bg-warning"
						/>
		
						<x-card-plan-checkout
						showPlan="Plan Premium"
						title="Plan Premium"
						bgColor="text-bg-success"
						/>
					</x-pay-modal>
				@endisset
				
			</div>    
		</form>
	</div>


	<script>

		const $loaderOverlay = document.getElementById('loader-overlay');
		window.showModal = @json($show_modal);

		let idPlan = 29;
		let tipoDeAviso = null;

		function pricingData() {
			return {
				
				planes: [],
				categoriaPlan: 'mixto',
				numAvisos: 5,
				periodoPlan: 90,

				planId: null,

				prices: 0,


				// campos formulario:
				tipoPlan: 'Plan Estandar',
				id: '',

				// paquetes Mixtos
				pricePlan: null,

				// paquetes Top
				numAvisosTop: 1,
				periodoPlanTop: 30,
				pricePlanTop: null,

				/* prices: {
					// categoria plan: mixto
					basico: 259,
					estandar: 325,
					superior: 405,
					// categoria plan: top
					top: 129,
					premium: 239,
				}, */

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

				idsTop: {
					'1': { '30': [91, 92], '60': [93, 94], '90': [95, 96]  },
					'3': { '30': [97, 98], '60': [99, 100], '90': [101, 102]  },
					'5': { '30': [103, 104], '60': [105, 106], '90': [107, 108]  },
				},

				idsMixto: {
					'5': { '90': [28, 29, 30], '180': [31, 32, 33], '365': [34, 35, 36] },
					'10': { '90': [37, 38, 39], '180': [40, 41, 42], '365': [43, 44, 45] },
					'25': { '90': [46, 47, 48], '180': [49, 50, 51], '365': [52, 53, 54] },
					'50': { '90': [55, 56, 57], '180': [58, 59, 60], '365': [61, 62, 63] },
					'75': { '90': [64, 65, 66], '180': [67, 68, 69], '365': [70, 71, 72] },
					'100': { '90': [73, 74, 75], '180': [76, 77, 78], '365': [79, 80, 81] },
					'200': { '90': [82, 83, 84], '180': [85, 86, 87], '365': [88, 89, 90] }
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
					this.prices.premium = selectedPricesTop[1]
				},
				updateAvisosDistribution() {
					const selectAvisos = this.avisosDistribution[this.categoriaPlan][this.numAvisos]
					this.avisos.basico = selectAvisos[0]
					this.avisos.estandar = selectAvisos[1]
					this.avisos.superior = selectAvisos[2]
				},
				updateIdMixtos() {
					const selectedId = this.idsMixto[this.numAvisos][this.periodoPlan]
					if(this.tipoPlan === 'basico') {
						idPlan = selectedId[0]
					} else if (this.tipoPlan === 'estandar') {
						idPlan = selectedId[1]
					} else if (this.tipoPlan === 'superior') {
						idPlan = selectedId[2]
					}
				},
				updateIdTop() {
					const selectedId = this.idsTop[this.numAvisosTop][this.periodoPlanTop]
					if(this.tipoPlan === 'top') {
						idPlan = selectedId[0]
					} else if (this.tipoPlan === 'premium') {
						idPlan = selectedId[1]
					}
				},

				fetchPlanes() {
					console.log("Esa ejecutando la funcion fetchPlanes()")
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
						if ( data.data.promotion === null ) {
							this.prices = data.data.price
						} else {
							this.prices = data.data.price * (data.data.promotion.percentage / 100)
						}
						this.tipoPlan = data.data.name
						if ( this.tipoPlan === "Plan Estandar" ) {
							this.tipoDeAviso = 1
						} else if ( this.tipoPlan === "Plan VIP" ) {
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

					// paquetes MIXTOS ========================
					this.$watch('numAvisos', () => {
						this.debounceFetch();
						// this.updatePrices() 
						// this.updateAvisosDistribution()
						// this.updateIdMixtos()
					})
					this.$watch('periodoPlan', () => {
						this.debounceFetch();
						// this.updatePrices()
						// this.updateIdMixtos()
					})

					// paquetes TOP ============================
					this.$watch('numAvisosTop', () => {
						this.debounceFetch();
						// this.updatePricesTop() 
						// this.updateIdTop()
					})
					this.$watch('periodoPlanTop', () => {
						this.debounceFetch();
						// this.updatePricesTop() 
						// this.updateIdTop()
					})

					this.$watch('tipoPlan', () => {
						console.log("aqui entro")
						this.debounceFetch();
						// this.pricePlan = this.prices[this.tipoPlan]
						// this.pricePlaTop = this.prices[this.tipoPlan]
						// update id
						// this.updateIdMixtos()
						// this.updateIdTop()
					})
					this.$watch('categoriaPlan', () => {
						console.log("Entro al cambio de Categoria")
						this.debounceFetch();
						// this.updatePrices()
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

@push('scripts')
  	@vite([ 'resources/js/scripts/planes.js' ])
@endpush
  
@push('scripts-head')  
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="https://js.openpay.pe/openpay.v1.min.js"></script>
	<script src="https://js.openpay.pe/openpay-data.v1.min.js"></script>
@endpush
