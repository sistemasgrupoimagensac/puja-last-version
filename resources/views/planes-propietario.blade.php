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
			<div class="d-flex flex-column align-items-center py-3 gap-5">
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

					{{-- PLAN UN AVISO --}}
					{{-- <div x-show=" categoriaPlan === 'unaviso' ">
						<div role="group" class="planes-numero-avisos justify-content-center d-flex flex-wrap w-100 gap-3 gap-lg-4 px-1 p-lg-0 mt-4">
              <div>
								<input type="radio" class="btn-check" id="unaviso" value="1" autocomplete="off" x-model="numAvisos" />
								<label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="unaviso">1 Aviso</label>
							</div>
						</div>
					</div> --}}
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
													<input type="text" class="form-control credit-card-input shadow-none" id="numeroTarjeta" x-model="numeroTarjeta" inputmode="numeric" minlength="19" maxlength="19" @input="formatCardNumber" data_openpay_card />
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
													<input type="password" class="form-control shadow-none" id="cvcTarjeta" x-model="cvcTarjeta" size="1" minlength="3" maxlength="3" data_openpay_card/>
												</div>
											</div>

											{{-- error de completar campos tarjeta de credito --}}
											<div class="card text-bg-danger" x-show="errorInputCreditcard">
												<p id="error-message" class="card-text text-center">Complete todos los campos de la tarjeta.</p>
											</div>
										</div>
										
									</div>
								</div>
								<div class="d-flex justify-content-center w-100">
									<button type="button" class="btn button-orange fs-3 rounded-3 m-2 mx-lg-5 w-100" id="pay-button">Pagar S/ 
										<span x-text="prices[tipoPlan]"></span>
									</button>
								</div>
								<small class="text-body-tertiary p-3 px-lg-5">Al hacer clic en Pagar, está aceptando nuestros 
									<a href="#">Términos y Condiciones de Contratación</a>
								</small>
							</form>
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
				categoriaPlan: 'unaviso',
				tipoPlan: 'topPlus',
        id: '',

				// plan unaviso
				numAvisos: 1,
				periodoPlan: 30,
				pricePlan: null,

				// paquetes Top
				// numAvisosTop: 3,
				// periodoPlan: 30,
				// pricePlanTop: null,

				prices: {
					topPlus: 239,
					top: 129,
					estandar: 79,
				},

				// avisos: {
				// 	basico: [5,0,0],
				// 	estandar: [3,2,0],
				// 	superior: [2,2,1],
				// },

				// priceTableTop: {
				// 	'3': { '30': [239, 129, 79], '60': [406, 219, 134], '90': [537, 290, 177] },
				// 	'5': { '30': [239, 129, 79], '60': [406, 219, 134], '90': [537, 290, 177] },
				// },

				priceTable: {
					'1': { '30': [239, 129, 79], '60': [406, 219, 134], '90': [537, 290, 177] },
          '3': { '30': [645, 348, 213], '60': [1097, 592, 362], '90': [1451, 783, 479] },
					'5': { '30': [1015, 548, 335], '60': [1726, 932, 570], '90': [2285, 1233, 755] },
				},

        ids: {
          '1': { '30': [1, 10], '60': [2, 11], '90': [3, 12]  },
          '3': { '30': [4, 13], '60': [5, 14], '90': [6, 15]  },
          '5': { '30': [7, 16], '60': [8, 17], '90': [9, 18]  },
        },

				updatePrices() {
					const selectedPrices = this.priceTable[this.numAvisos][this.periodoPlan]
					this.prices.topPlus = selectedPrices[0]
					this.prices.top = selectedPrices[1]
					this.prices.estandar = selectedPrices[2]
				},
				// updatePricesTop() {
				// 	const selectedPricesTop = this.priceTableTop[this.numAvisosTop][this.periodoPlan]
				// 	this.prices.top = selectedPricesTop[0]
				// 	this.prices.topPlus = selectedPricesTop[1]
				// },
				// updateAvisosDistribution() {
				// 	const selectAvisos = this.avisosDistribution[this.categoriaPlan][this.numAvisos]
				// 	this.avisos.basico = selectAvisos[0]
				// 	this.avisos.estandar = selectAvisos[1]
				// 	this.avisos.superior = selectAvisos[2]
				// },
        updateIds() {
          const selectedId = this.ids[this.numAvisos][this.periodoPlan]
          if(this.tipoPlan === 'topPlus') {
            this.id = selectedId[0]
          } else if (this.tipoPlan === 'top') {
            this.id = selectedId[1]
          } else if (this.tipoPlan === 'estandar') {
            this.id = selectedId[2]
          }
          console.log(this.id);
        },
        // updateIdTop() {
        //   const selectedId = this.idsTop[this.numAvisosTop][this.periodoPlan]
        //   if(this.tipoPlan === 'top') {
        //     this.id = selectedId[0]
        //   } else if (this.tipoPlan === 'topPlus') {
        //     this.id = selectedId[1]
        //   }
        //   console.log(this.id);
        // },

				init() {
          console.log(this.numAvisos, this.periodoPlan);
					// paquetes unavisoS ========================
					this.$watch('numAvisos', () => {
						this.updatePrices() 
					})
					this.$watch('periodoPlan', () => {
						this.updatePrices()
					})

					// // paquetes TOP ============================
					// this.$watch('numAvisosTop', () => {
					// 	this.updatePricesTop() 
          //   this.updateIdTop()
					// })
					// this.$watch('periodoPlan', () => {
          //   this.updateIdTop()
					// })

					// this.$watch('tipoPlan', () => {
					// 	this.pricePlan = this.prices[this.tipoPlan]
					// 	this.pricePlaTop = this.prices[this.tipoPlan]

          //   // update id
          //   this.updateIdunavisos()
          //   this.updateIdTop()
        
					// })
					// this.$watch('categoriaPlan', () => {
					// 	this.updatePrices()
					// })
				},
			}
		}

		function creditCardData() {
			return {
				// tarjeta de credito
				numeroTarjeta: '4242 4242 4242 4242',
				nombreTarjeta: 'Enrique',
				fechaTarjeta: '12/25',
				cvcTarjeta: '123',
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
					const numAvisos = this.numAvisos
					const periodoPlan = this.periodoPlan
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
							console.log('switch de error');
							switch (error) {
								case 3001:
									alert(`La tarjeta fue rechazada`)
									this.clearForm()
									this.isProcessing = false
									document.getElementById('pay-button').disabled = false
									break;

								case 3002:
									alert(`La tarjeta ha expirado`)
									this.clearForm()
									this.isProcessing = false
									document.getElementById('pay-button').disabled = false
									break;

								case 3003:
									alert(`La tarjeta no tiene fondos suficientes`)
									this.clearForm()
									this.isProcessing = false
									document.getElementById('pay-button').disabled = false
									break;

								case 3004:
									alert(`La tarjeta ha sido identificada como una tarjeta robada`)
									this.clearForm()
									this.isProcessing = false
									document.getElementById('pay-button').disabled = false
									break;

								case 3005:
									alert(`La tarjeta ha sido rechazada por el sistema antifraudes`)
									this.clearForm()
									this.isProcessing = false
									document.getElementById('pay-button').disabled = false
									break;

								default:
									alert('Hubo un error con el pago')
									this.clearForm()
									this.isProcessing = false
									document.getElementById('pay-button').disabled = false
									break;
							}

						} else {
							this.factElectronica(formPost.amount)
							this.clearForm();
							this.isProcessing = false
							document.getElementById('pay-button').disabled = false
							alert(`Pago de PEN ${data.amount} realizado con éxito.`)
						}
					}).catch(error => {
						// document.getElementById('error-message').innerText = error.message
						// this.isProcessing = false
						// document.getElementById('pay-button').disabled = false
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
							note: ""
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
	</script>

@endsection

@section('footer')
	<x-footer></x-footer>
@endsection
  
@push('scripts-head')  
	<script src="https://js.openpay.pe/openpay.v1.min.js"></script>
	<script src="https://js.openpay.pe/openpay-data.v1.min.js"></script>
@endpush