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
							<!-- plan top plus -->
							<div>
								<input type="radio" class="btn-check" x-model="tipoPlan" id="topPlus" value="topPlus" autocomplete="off" data-bs-toggle="modal" data-bs-target="#modalPago">
								<x-card-plan-propietario
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
								<x-card-plan-propietario
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
								<x-card-plan-propietario
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
				{{-- <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
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
				</div> --}}

			</div>    
		</form>
	</div>

	<script>

		let idPlan = 3
		let tipoDeAviso = 3

		function pricingData() {
				return {
						// campos formulario:
						aviso_id: {{$aviso_id}},
						categoriaPlan: 'unaviso',
						tipoPlan: 'topPlus',

						// plan unaviso
						numAvisos: 1,
						periodoPlan: 30,

						prices: {
								topPlus: 239,
								top: 129,
								estandar: 79,
						},

						priceTable: {
								'1': { '30': [239, 129, 79], '60': [406, 219, 134], '90': [537, 290, 177] },
								'3': { '30': [540, 290, 177], '60': [915, 495, 302], '90': [1210, 650, 399] },
								'5': { '30': [715, 505, 276], '60': [1220, 850, 470], '90': [1610, 1225, 622] },
						},

						ids: {
								'1': { '30': [1, 2, 3], '60': [4, 5, 6], '90': [7, 8, 9] },
								'3': { '30': [10, 11, 12], '60': [13, 14, 15], '90': [16, 17, 18] },
								'5': { '30': [19, 20, 21], '60': [22, 23, 24], '90': [25, 26, 27] },
						},

						updatePrices() {
								const selectedPrices = this.priceTable[this.numAvisos][this.periodoPlan];
								this.prices.topPlus = selectedPrices[0];
								this.prices.top = selectedPrices[1];
								this.prices.estandar = selectedPrices[2];
						},

						updateIds() {
								const selectedId = this.ids[this.numAvisos][this.periodoPlan];
								if (this.tipoPlan === 'estandar') {
										idPlan = selectedId[0]
										tipoDeAviso = 1
										console.log(idPlan);
								} else if (this.tipoPlan === 'top') {
										idPlan = selectedId[1]
										tipoDeAviso = 2
										console.log(idPlan);
								} else if (this.tipoPlan === 'topPlus') {
										idPlan = selectedId[2]
										tipoDeAviso = 3
										console.log(idPlan);
								}

						},

						init() {
								this.$watch('numAvisos', () => {
										this.updatePrices()
										this.updateIds()
								})
								this.$watch('periodoPlan', () => {
										this.updatePrices()
										this.updateIds()
								})
								this.$watch('tipoPlan', () => {
									this.updateIds()
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
					var paymentModal = bootstrap.Modal('#modalPago')
					console.log(paymentModal)
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
							this.clearForm()
							this.isProcessing = false
							document.getElementById('pay-button').disabled = false
							alert(`La tarjeta fue rechazada`)
						} else {
							this.clearForm()
							this.contratarPlan(formPost.amount);
							this.isProcessing = false
							document.getElementById('pay-button').disabled = false
							alert(`Pago realizado con éxito.`)
						}
					}).catch(error => {
						console.log(error)
					})
				},

				contratarPlan(price) {
						const dataToSend = {
								plan_id: idPlan,
                tipo_aviso: tipoDeAviso,
                aviso_id: {{ $aviso_id }},
						}

						fetch('/publicar-aviso', {
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
								if (data.status === "Success") {
										const planUserId = data.planuser_id
										this.factElectronica(price, planUserId)
										window.location.href = '/panel/avisos'
								} else {
										console.error('Error en la suscripción:', data.message);
								}
						})
						.catch(error => {
								console.error('Error sending data to backend:', error.message);
						});
				},

				factElectronica(price, planUserId){
					try {
						const data = {
							details: [
								{
									price: price,
									quantity: 1,
									product: 
										{
											id: idPlan,
											name: "Plan " + this.tipoPlan,
											type: 1
										}
								}
							],
							document_type_id: documentTypeId, // 3 ruc, 2 boleta
							note: '',
							num_doc: numeroDocumento,
							tipo_doc: tipoDocumento,
							receipt_name: nombreDocumento,
						}

						fetch(`/generarComprobanteElec/${planUserId}`, {
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
							console.log('data_response__facturacion-electronica', data);
						})
						.catch(error => {
							console.error('Hubo un error:', error)
						})

					} catch (error) {
						console.error('Hubo un error:', error)
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
				Alpine.store('creditCardData', creditCardData());
				Alpine.data('pricingData', pricingData);
		});

		let documentTypeId = 2
		let numeroDocumento
		let tipoDocumento
		let nombreDocumento

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
								.then(data_response => {
										if (data_response.success) {

											if(data_response.data.ruc) {
												numeroDocumento = data_response.data.ruc
												tipoDocumento = "RUC"
												nombreDocumento =data_response.data.nombre_o_razon_social
											} else {
												numeroDocumento = data_response.data.numero
												tipoDocumento = "DNI"
												nombreDocumento =data_response.data.nombre_completo
											}

											console.log('Response:', data_response)
											this.resultados = data_response.data

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
										documentTypeId = 2
										console.log(documentTypeId);
										return this.resultados.nombre_completo
								} else if (this.tipo === 'RUC' && this.resultados) {
										documentTypeId = 3
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