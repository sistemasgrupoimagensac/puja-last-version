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

		{{-- Si esta logueado con Google y faltan datos, se los debe pedir por medio de este Modal --}}
		<div>
			<div class="modal fade" id="staticBackdropRegister" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg">
							<div class="modal-content p-2">
									<div class="modal-body">
											<form id="formRegistro" class="d-flex flex-column gap-3" @submit.prevent="submitForm">
											@csrf
													<fieldset class="d-flex flex-column gap-2">
															<legend class="h4 m-0 p-0 icon-orange">Completa tu registro</legend>
					
															<div class="form-floating">
																	<input type="phone" class="form-control" id="phone" minlength="9" maxlength="9" name="phone" placeholder="Telefono" required>
																	<label class="text-secondary" for="phone">Teléfono</label>
															</div>
					
															<div class="form-floating">
																	<select class="form-select" id="document_type" name="document_type" required>
																			<option value="1" selected>DNI</option>
																			<option value="3">RUC</option>
																			<option value="2">Otro Documento</option>
																	</select>
																	<label for="document_type">Documento</label>
															</div>
					
															<div class="form-floating">
																	<input type="text" class="form-control" id="document_number" minlength="8" maxlength="20" name="document_number" placeholder="DNI" required>
																	<label class="text-secondary" for="document_number" id="label_document_number">DNI</label>
															</div>
	
															<div class="form-floating">
																	<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección">
																	<label class="text-secondary" for="direccion" id="label_direccion">Dirección</label>
															</div>
					
															
															<small>
																	<div class="form-group d-flex gap-3 align-items-center">
																			<input type="checkbox" name="accept_terms" id="terminos" class="form-check-input m-0" required/>
																			<label for="terminos">Acepto los <a href="/terminos-uso" target="blank" class="custom-link-register text-decoration-none">Términos y Condiciones de Uso</a> y las <a href="/politica-privacidad" target="blank" class="custom-link-register text-decoration-none">Políticas de Privacidad</a></label>
																	</div>
																	
															</small>
													</fieldset>
											
													<input class="btn button-orange w-100 fw-bold p-2" type="submit" id="submit-register-button" value="COMPLETAR REGISTRO">
											</form>
	
									</div>
							</div>
					</div>
			</div>
		</div>

		<h1 class="text-center fw-bold h2">¿cuantos inmuebles quieres publicar?</h1>

		{{-- SWITCH PAQUETES MIXTOS O TOP --}}
		<div class="text-center mt-5 mb-3">
			<div class="btn-group btn-group-lg" role="group" aria-label="Basic radio toggle button group">
				<input type="radio" class="btn-check" name="btnradio" id="mixtoCheck" autocomplete="off" checked @click="categoriaPlan = 'mixto'" />
				<label class="btn btn-outline-dark" for="mixtoCheck">Planes Mixtos</label>

				<input type="radio" class="btn-check" name="btnradio" id="topCheck" autocomplete="off" @click="categoriaPlan = 'top'" />
				<label class="btn btn-outline-dark" for="topCheck">Planes Top</label>
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
					{{-- PAQUETES MIXTO - categoria plan--}}
					<div x-show=" categoriaPlan === 'mixto' ">
						<div role="group" class="d-flex flex-column align-items-center flex-md-row gap-4 mt-4 w-100">
							<!-- plan basico -->
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
				
							<!-- plan estandar -->
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
				
							<!-- plan superior -->
							<div>
								@if ($sesion_iniciada)
									<input type="radio" class="btn-check" x-model="tipoPlan" id="superior" value="superior" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modalPago">
								@endif
								<x-card-plan
									:$sesion_iniciada
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
				
							<!-- plan top plus -->
							<div>
								@if ($sesion_iniciada)
									<input type="radio" class="btn-check" x-model="tipoPlan" id="topPlus" value="topPlus" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modalPago">
								@endif
								<x-card-plan
									:$sesion_iniciada
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

				{{-- Modal de Pago --}}
				@isset($user)
					<x-pay-modal
						avisoId="null"
						userName="{{ $user->nombres }}"
						userSurname="{{ $user->apellidos }}"
						userEmail="{{ $user->email }}"
						userPhone="{{ $user->celular }}"
					>
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
					</x-pay-modal>
				@endisset
				
			</div>    
		</form>
	</div>

	<script>

		window.showModal = @json($show_modal);

		let idPlan = 29;
		let tipoDeAviso = null;

		function pricingData() {
			return {
				// campos formulario:
				categoriaPlan: 'mixto',
				tipoPlan: 'estandar',
        id: '',

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
					this.prices.topPlus = selectedPricesTop[1]
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
          } else if (this.tipoPlan === 'topPlus') {
						idPlan = selectedId[1]
          }
        },

				init() {
					// paquetes MIXTOS ========================
					this.$watch('numAvisos', () => {
						this.updatePrices() 
						this.updateAvisosDistribution()
            this.updateIdMixtos()
					})
					this.$watch('periodoPlan', () => {
						this.updatePrices()
            this.updateIdMixtos()
					})

					// paquetes TOP ============================
					this.$watch('numAvisosTop', () => {
						this.updatePricesTop() 
            this.updateIdTop()
					})
					this.$watch('periodoPlanTop', () => {
						this.updatePricesTop() 
            this.updateIdTop()
					})

					this.$watch('tipoPlan', () => {
						this.pricePlan = this.prices[this.tipoPlan]
						this.pricePlaTop = this.prices[this.tipoPlan]

            // update id
            this.updateIdMixtos()
            this.updateIdTop()
        
					})
					this.$watch('categoriaPlan', () => {
						this.updatePrices()
					})
				},

				submitForm() {
						let form = document.querySelector('#formRegistro');
						let formData = {
								phone: form.phone.value,
								document_type: form.document_type.value,
								document_number: form.document_number.value,
								direccion: form.direccion.value,
								accept_terms: form.terminos.checked
						};

						console.log('Form Data:', formData);

						fetch('/store-completeUserGoogle', {
								method: 'POST',
								headers: {
										'Content-Type': 'application/json',
										'X-CSRF-TOKEN': '{{ csrf_token() }}',
										'Accept': 'application/json',
								},
								body: JSON.stringify(formData)
						})
						.then(response => {
								if (!response.ok) {
										throw new Error('Network response was not ok');
								}
								return response.json();
						})
						.then(data => {
								alert(data.message);
								location.reload()
						})
						.catch(error => {
								console.error('Error:', error);
						});
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
