@php
    if($avisoId === "null") {
        $aviso_id = null;
    }
@endphp


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
                            {{ $slot }}
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
                                
                                <div class="mb-3 col-4">
                                    <label for="cvcTarjeta" class="form-label m-0 custom">CVC/CVV</label>
                                    <div class="input-group">
                                        <input :type="showCVC ? 'text' : 'password'" class="form-control shadow-none" id="cvcTarjeta" x-model="cvcTarjeta" size="1" minlength="3" maxlength="4" data_openpay_card/>
                                        <span class="input-group-text">
                                            <i class="fa fa-eye" x-on:click="toggleCVC" style="cursor: pointer"></i>
                                        </span>
                                    </div>
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

<script>


function creditCardData() {
    return {
        // tarjeta de credito
        numeroTarjeta: '',
        nombreTarjeta: '',
        fechaTarjeta: '',
        cvcTarjeta: '',
        showCVC: false,
        toggleCVC() {
            this.showCVC = !this.showCVC;
            console.log('toggleCVC called:', this.showCVC); 
        },
        deviceSessionId: '',
        isProcessing: false,
        errorInputCreditcard: false,

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

        processPayment(formPost) {
            fetch("/pagar-openpay", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
                    aviso_id: {{ $avisoId }},
                }
                console.log(dataToSend)

                fetch('/contratar_plan', {
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
            fetch('/get-data-openpay', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "Success") {
                    OpenPay.setId(data.openpay_id)
                    OpenPay.setApiKey(data.openpay_pk)
                    OpenPay.setSandboxMode(data.openpay_sb_mode)
                    this.deviceSessionId = OpenPay.deviceData.setup("payment-form")
                } else {
                    console.error('Error openPay:', data.message);
                }
            })
            .catch(error => {
                console.error('Error sending data to backend:', error.message);
            });
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

            const bodyTipoDoc = this.tipo === 'DNI' ? 'dni' : 'ruc'
            fetch("/consulta-dni-ruc", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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

        // enviarDatosAlBackend() {
        //     const dataToSend = {
        //         documento: this.documento,
        //         tipo: this.tipo,
        //     }

        //     fetch('/enviar-datos-dni-ruc', {
        //         method: 'POST',
        //         headers: {
        //             'Accept': 'application/json',
        //             'Content-Type': 'application/json',
        //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //         },
        //         body: JSON.stringify(dataToSend)
        //     })
        //     .then(response => response.json())
        //     .then(data => {
        //         console.log('Response from backend:', data)
        //     })
        //     .catch(error => {
        //         console.error('Error sending data to backend:', error.message)
        //     })
        // },

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