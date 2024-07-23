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

						<div class="modal-content rounded-4 position-relative custom" id="modalPago2" x-data="creditCardData()" x-init="init()">
							<form id="payment-form">
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
													<input type="text" class="form-control credit-card-input shadow-none" id="numeroTarjeta" x-model="numeroTarjeta" inputmode="numeric" minlength="14" maxlength="19" @input="formatCardNumber" data_openpay_card />
													<span class="input-group-text"><i class="fa-regular fa-credit-card"></i></span>
												</div>
											</div>
						
											{{-- Nombre de la tarjeta --}}
											<div class="mb-3">
												<label for="nombreTarjeta" class="form-label m-0 custom">Nombre en la Tarjeta</label>
												<div class="input-group">
													<input type="text" class="form-control shadow-none" id="nombreTarjeta" x-model="nombreTarjeta" inputmode="latin-name" maxlength="26" data_openpay_card />
												</div>
											</div>
						
											<div class="d-flex justify-content-between">
												{{-- Fecha de vencimiento --}}
												<div class="mb-3 col-7">
													<label for="fechaTarjeta" class="form-label m-0 custom">Fecha de Vencimiento</label>
													<input type="text" class="form-control shadow-none" id="fechaTarjeta" x-model="fechaTarjeta" placeholder="MM/AA" maxlength="5" @input="formatExpiryDate" data_openpay_card />
												</div>
												{{-- CVC de la tarjeta --}}
												<div class="mb-3 col-4">
													<label for="cvcTarjeta" class="form-label m-0 custom">CVC</label>
													<input type="password" class="form-control shadow-none" id="cvcTarjeta" x-model="cvcTarjeta" size="1" minlength="3" maxlength="4" data_openpay_card/>
												</div>
											</div>

											{{-- error de completar campos tarjeta de credito --}}
											<div class="card text-bg-danger" x-show="errorInputCreditcard">
												<p id="error-message" class="card-text text-center">Complete todos los campos de la tarjeta.</p>
											</div>
										</div>
										
									</div>
								</div>

								<div class="d-flex justify-content-between align-items-center px-5">
									<div>
										<button type="button" class="btn btn-outline-secondary rounded-3 w-100" data-bs-target="#modalOtroDNI" data-bs-toggle="modal">
											¿Desea pagar con una distinta Razón Social?</button>
									</div>
									<div>
										<template x-if="resultados">
											<div>
													<p class="m-0"><span class="fw-bold">Nombre:</span> <span x-text="getNombre()"></span></p>
											</div>
									</template>

									</div>
								</div>

								<div class="d-flex justify-content-center w-100">
									<button type="button" class="btn button-orange fs-3 rounded-3 m-2 mx-lg-5 w-100" id="pay-button">Pagar S/ 
										<span x-text="prices[tipoPlan]"></span>
									</button>
								</div>

								<small class="text-body-tertiary p-3 px-lg-5">Al hacer clic en Pagar, está aceptando nuestros 
									<a href="/terminos-contratacion" target="blank">Términos y Condiciones de Contratación</a>
								</small>

							</form>
						</div>
					</div>
				</div>

				{{-- SEGUNDO MODAL - ELECCION DE DNI --}}
				<div class="modal fade" id="modalOtroDNI" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
					<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
									<div class="modal-header">
											<h5 class="m-0">Seleccione el remitente del comprobante</h5>
									</div>
									<div class="modal-body">
											<div class="input-group mb-3">
													<form @submit.prevent="consultarDocumento" class="w-100">
															@csrf
															<div class="d-flex gap-2 justify-content-between w-100">
																	<div class="btn-group" role="group">
																			<input type="radio" class="btn-check" name="btnradio" id="DNIcheck" autocomplete="off" value="DNI" x-model="tipo" checked>
																			<label class="btn btn-outline-secondary" for="DNIcheck">DNI</label>
			
																			<input type="radio" class="btn-check" name="btnradio" id="RUCcheck" autocomplete="off" value="RUC" x-model="tipo">
																			<label class="btn btn-outline-secondary" for="RUCcheck">RUC</label>
																	</div>
			
																	<input type="text" class="form-control shadow-none" name="documento" placeholder="documento" x-model="documento" required>
			
																	<input type="submit" class="btn btn-secondary" value="Consultar">
															</div>
													</form>
											</div>
			
											<!-- Div para mostrar los resultados -->
											<template x-if="resultados">
													<div class="mt-3">
															<p>Nombre: <span x-text="getNombre()"></span></p>
													</div>
											</template>
			
											<!-- Div para mostrar los errores -->
											<div class="mt-3 alert alert-danger" x-show="error" x-text="error"></div>
									</div>
									<div class="modal-footer">
											<button type="button" class="btn button-orange" data-bs-target="#modalPago" data-bs-toggle="modal">
												<i class="fa-solid fa-arrow-left"></i>
												Regresar
											</button>
									</div>
							</div>
					</div>
				</div>

				<!-- MODAL RESULTADO -->
				<div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="resultModalLabel">Resultado del Pago</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body" id="resultModalBody">
								<!-- Aquí se mostrará la información del pago -->
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
          '1': { '30': [1, 10], '60': [2, 11], '90': [3, 12]  },
          '3': { '30': [4, 13], '60': [5, 14], '90': [6, 15]  },
          '5': { '30': [7, 16], '60': [8, 17], '90': [9, 18]  },
        },

        idsMixto: {
					'5': { '90': [19, 40, 61], '180': [26, 47, 68], '365': [33, 54, 75] },
					'10': { '90': [20, 41, 62], '180': [27, 48, 69], '365': [34, 55, 76] },
					'25': { '90': [21, 42, 63], '180': [28, 49, 70], '365': [35, 56, 77] },
					'50': { '90': [22, 43, 64], '180': [29, 50, 71], '365': [36, 57, 78] },
					'75': { '90': [23, 44, 65], '180': [30, 51, 72], '365': [37, 58, 79] },
					'100': { '90': [24, 45, 66], '180': [31, 52, 73], '365': [38, 59, 80] },
					'200': { '90': [25, 46, 67], '180': [32, 53, 74], '365': [39, 60, 81] }
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
            this.id = selectedId[0]
          } else if (this.tipoPlan === 'estandar') {
            this.id = selectedId[1]
          } else if (this.tipoPlan === 'superior') {
            this.id = selectedId[2]
          }
          console.log(this.id);
        },
        updateIdTop() {
          const selectedId = this.idsTop[this.numAvisosTop][this.periodoPlanTop]
          if(this.tipoPlan === 'top') {
            this.id = selectedId[0]
          } else if (this.tipoPlan === 'topPlus') {
            this.id = selectedId[1]
          }
          console.log(this.id);
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
			}
		}

		function creditCardData() {
			return {
				// tarjeta de credito
				numeroTarjeta: '',
				nombreTarjeta: '',
				fechaTarjeta: '',
				cvcTarjeta: '',
				deviceSessionId: '',
				isProcessing: false,
				errorInputCreditcard: false,
        
        idOpenpay: '',
				sk: '',

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

				isValidForm() {
					return this.numeroTarjeta && this.nombreTarjeta && this.fechaTarjeta && this.cvcTarjeta
				},

				createToken(callback) {
					const [month, year] = this.fechaTarjeta.split('/')
					OpenPay.token.create({
						"card_number": this.numeroTarjeta.replace(/\s+/g, ''),
						"holder_name": this.nombreTarjeta,
						"expiration_year": year,
						"expiration_month": month,
						"cvv2": this.cvcTarjeta,
					}, callback, this.handleTokenError)
				},

				handleTokenSuccess(response) {
					const source_id = response.data.id

					const client = {
						Cliente: 'Raul',
						Telefono1: '999625263',
						Correo: 'raul_correo@gmail.com'
					}

					let clientNames = client.Cliente.split(' ')
					let name = clientNames[0]
					let last_name = clientNames.slice(1).join(" ")

					const categoriaPlan = this.categoriaPlan
					const tipoPlan = this.tipoPlan
					const numAvisos = categoriaPlan === 'top' ? this.numAvisosTop : this.numAvisos
					const periodoPlan = categoriaPlan === 'top' ? this.periodoPlanTop : this.periodoPlan
					const price = this.prices[tipoPlan]

					const formPost = {
						"source_id": source_id,
						"method": "card",
						"amount": price,
						"currency": 'PEN',
						"description": `Paquete: ${categoriaPlan}, Plan: ${tipoPlan}, Días: ${periodoPlan}, Avisos: ${numAvisos}`,
						"device_session_id": this.deviceSessionId,
						"customer": {
							"name": name,
							"last_name": last_name,
							"phone_number": client.Telefono1,
							"email": client.Correo
						}
					}

					this.processPayment(formPost)
				},

				handleTokenError(error) {
					document.getElementById('error-message').innerText = error.data.description
					this.isProcessing = false
					document.getElementById('pay-button').disabled = false
				},

				showResultModal(data) {
					console.log(data)
					var paymentModal = bootstrap.Modal('#modalPago');
					console.log(paymentModal);
				},

				processPayment(formPost) {
					fetch(`https://sandbox-api.openpay.pe/v1/${this.idOpenpay}/charges`, {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
							'Authorization': `Basic ${btoa(`${this.sk}:`)}`
						},
						body: JSON.stringify(formPost)
					})
					.then(response => response.json())
					.then( data => {
						const error = data.error_code						
						if (error) {
							this.clearForm();
							this.isProcessing = false
							document.getElementById('pay-button').disabled = false
							alert(`La tarjeta fue rechazada`)
						} else {
							this.factElectronica(formPost.amount)
							this.clearForm();
							this.isProcessing = false
							document.getElementById('pay-button').disabled = false
							alert(`Pago realizado con éxito.`)
						}
					}).catch(error => {
						console.log(error);
					})
				},

				factElectronica(price){
					try {
						const data = {
							details: [
								{
									price: price,
									quantity: 1,
									product: 
										{
											id: this.id,
											name: "Plan" + this.tipoPlan,
											type: 1
										}
								}
							],
							document_type_id: 2,
							note: "",
							num_doc: '',
							tipo_doc: '',
							nombre_doc: '',
						};

						fetch(`/openpay/1`, {
							method: 'POST',
							headers: {
								'Content-Type': 'application/json',
								'X-CSRF-TOKEN': '{{ csrf_token() }}',
								'idCompany': 1
							},
							body: JSON.stringify(data)
						})
						.then(response => response.json())
						.then(data => {
							console.log(data)
						})
						.catch(error => {
							console.error('Hubo un error:', error);
						});

					} catch (error) {
						console.error('Hubo un error:', error);
					}

				},

				clearForm() {
					this.numeroTarjeta = ''
					this.nombreTarjeta = ''
					this.fechaTarjeta = ''
					this.cvcTarjeta = ''
				},

				initOpenPay() {
					const id = 'mplp0n81dz6brymhnuap'
					const pk = 'pk_9452549041de4a8f996ded2c2164bbf4'
					const sk = 'sk_5ed0fea4d3b4464f8325c2d4b2f0bbb8'
					OpenPay.setId(id)
					OpenPay.setApiKey(pk)
					OpenPay.setSandboxMode(true)
					this.deviceSessionId = OpenPay.deviceData.setup("payment-form")
					this.sk = sk
          this.idOpenpay = id
				},

				registerPayButton() {
					document.getElementById('pay-button').addEventListener('click', () => {
						const errorInline = document.getElementById('error-message')
						if (this.isProcessing) return
						if (this.isValidForm()) {
							this.isProcessing = true
							document.getElementById('pay-button').disabled = true
							this.createToken(this.handleTokenSuccess.bind(this))
						} else {
							setTimeout(() => {
								this.errorInputCreditcard = false
							}, 3000)
							this.errorInputCreditcard = true
						}
					})
				},

				init() {
					window.onload = () => {
						this.initOpenPay()
						this.$nextTick(() => {
							this.registerPayButton()
						})
					}
				},

			}
		}

		document.addEventListener('alpine:init', () => {
			Alpine.data('creditCardData', creditCardData)
		})

		function consultaDocumento() {
				return {
						documento: '',
						tipo: 'DNI',
						resultados: null,
						error: null,
						consultarDocumento() {
								this.resultados = null
								this.error = null

								const apiURL = this.tipo === 'DNI' ? 'https://apiperu.dev/api/dni' : 'https://apiperu.dev/api/ruc'
								const token = 'db3ed63994d8aef68d6a7db28083109d033ee0e32211ecd7932a86dd15093a31'
								const bodyTipoDoc = this.tipo === 'DNI' ? 'dni' : 'ruc'

								fetch(apiURL, {
										method: 'POST',
										headers: {
												'Accept': 'application/json',
												'Content-Type': 'application/json',
												'Authorization': `Bearer ${token}`
										},
										body: JSON.stringify({ [bodyTipoDoc]: this.documento })
								})
								.then(response => response.json())
								.then(data => {
										if (data.success) {
												console.log('Response:', data)
												this.resultados = data.data
												this.enviarDatosAlBackend()
										} else {
												this.error = 'Error al realizar la consulta.'
										}
								})
								.catch(error => {
										console.error('Error:', error.message)
										this.error = 'Error al realizar la consulta.'
								})
						},

						enviarDatosAlBackend() {
								const dataToSend = {
										documento: this.documento,
										tipo: this.tipo,
								}

								fetch('/enviar-datos-dni-ruc', {
										method: 'POST',
										headers: {
												'Accept': 'application/json',
												'Content-Type': 'application/json',
												'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
										},
										body: JSON.stringify(dataToSend)
								})
								.then(response => response.json())
								.then(data => {
										console.log('Response from backend:', data)
								})
								.catch(error => {
										console.error('Error sending data to backend:', error.message)
								})
						},

						getNombre() {
								if (this.tipo === 'DNI' && this.resultados) {
										return this.resultados.nombre_completo
								} else if (this.tipo === 'RUC' && this.resultados) {
										return this.resultados.nombre_o_razon_social
								}
								return ''
						}
				}
		}

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
