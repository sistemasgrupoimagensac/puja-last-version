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
                    <div class="d-flex flex-column flex-lg-row">

                        {{-- detalles del plan contratado --}}
                        <div class="z-0 col p-lg-5">
                            {{ $slot }}
                        </div>

                        {{-- Datos de la tarjeta de crédito --}}
                        <div x-show="!pagoFree" class="m-2 col p-lg-5 m-lg-0">
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
                                <div class="col-7">
                                    <label for="fechaTarjeta" class="form-label m-0 custom">Fecha de Vencimiento</label>
                                    <input type="text" class="form-control shadow-none" id="fechaTarjeta" x-model="fechaTarjeta" placeholder="MM/AA" maxlength="5" @input="formatExpiryDate" data_openpay_card />
                                </div>

                                <div class="col-4">
                                    <label for="cvcTarjeta" class="form-label m-0 custom">CVV</label>
                                    <div class="input-group">
                                        <input :type="showCVC ? 'text' : 'password'" class="form-control shadow-none" id="cvcTarjeta" x-model="cvcTarjeta" size="1" minlength="3" maxlength="4" data_openpay_card/>
                                        <span class="input-group-text">
                                            <i class="fa fa-eye" x-on:click="toggleCVC" style="cursor: pointer"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <template x-if="userBrokerNotRegister && !usuarioEmail">
                                <div>
                                    {{-- Correo electronico --}}
                                    <div class="my-3">
                                        <label for="emailNuevo" class="form-label m-0 custom">Correo: </label>
                                        <br>
                                        <span style="font-weight: 700; font-size:.7rem">*Se enviará un correo con sus credenciales</span>
                                        <div class="input-group">
                                            <input type="email" class="form-control shadow-none" id="emailNuevo" x-model="emailNuevo" inputmode="latin-name" maxlength="50" data_openpay_card />
                                        </div>
                                    </div>

                                    {{-- Celular --}}
                                    <div class="mb-3">
                                        <label for="celularNuevo" class="form-label m-0 custom">Celular:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control shadow-none" id="celularNuevo" x-model="celularNuevo" inputmode="numeric" maxlength="50" data_openpay_card />
                                        </div>
                                    </div>

                                    <input type="hidden" id="nombresNuevo" x-model="nombresNuevo" inputmode="latin-name" maxlength="100"/>
                                    <input type="hidden" id="apellidosNuevo" x-model="apellidosNuevo" inputmode="latin-name" maxlength="100"/>
                                </div>
                            </template>

                        </div>

                    </div>
                </div>

                <div x-show="!pagoFree">
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center gap-2 p-2 px-md-5 w-100">
                        <template x-if="userBrokerNotRegister && !usuarioEmail">
                            <button type="button"
                                    class="btn btn-outline-secondary rounded-3"
                                    data-bs-target="#modalOtroDNI" data-bs-toggle="modal">
                                ¡Agregar su documento de identidad!
                            </button>
                        </template>
                        <template x-if="!userBrokerNotRegister">
                            <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-target="#modalOtroDNI" data-bs-toggle="modal">
                                ¿Desea pagar con una distinta Razón Social?
                            </button>
                        </template>
                        <div>
                            <template x-if="resultados">
                                <div>
                                    <p class="m-0"><span class="fw-bold">Nombre:</span> <span id="nombreSpan" x-text="getNombre()"></span></p>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center w-100">
                    <button type="button" class="btn button-orange fs-3 rounded-3 m-2 m-lg-2 mx-lg-5 w-100" id="pay-button">Pagar S/
                        {{-- <x-miles-coma amount="prices[tipoPlan]"></x-miles-coma> --}}
                        <span x-text="formatPrice(prices)"></span>
                    </button>
                </div>
                <small class="text-body-tertiary py-1 px-3 py-lg-3 px-lg-5">Al hacer clic en Pagar, está aceptando nuestros
                    <a href="/terminos-contratacion" target="blank">Términos y Condiciones de Contratación</a>
                </small>
            </form>
        </div>
    </div>
</div>

{{-- Toasty pago exitoso --}}
<div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
    <div id="toastSuccess" class="toast text-bg-success" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-center fs-5 py-lg-4" id="success-message"></div>
    </div>
</div>

{{-- Toasty pago denegado --}}
<div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
    <div id="toastPayError" class="toast text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-center fs-5 py-lg-4" id="error-message"></div>
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

@props(['avisoId', 'userName', 'userSurname', 'userEmail', 'userPhone', 'userTypeId', 'userBrokerNotRegister' => 0])

<script>

    function creditCardData() {
        return {
            // tarjeta de credito
            numeroTarjeta: '',
            nombreTarjeta: '',
            fechaTarjeta: '',
            cvcTarjeta: '',
            nombresNuevo: '',
            emailNuevo: '',
            celularNuevo: '',
            usuarioEmail: @json($userEmail),
            userBrokerNotRegister: Boolean(Number(@json($userBrokerNotRegister))),
            showCVC: false,
            toggleCVC() {
                this.showCVC = !this.showCVC;
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
                if ( !this.pagoFree ) {
                    return this.numeroTarjeta && this.nombreTarjeta && this.fechaTarjeta && this.cvcTarjeta /* && this.emailNuevo && this.celularNuevo  */
                } else {
                    return true
                }
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
                // (response) => {
                //     console.log("[OpenPay] Éxito al crear token:", response);
                //     // Llamas a tu callback de éxito
                //     callback(response);
                // },
                // (error) => {
                //     console.log("[OpenPay] Error al crear token:", error);
                //     // Llamas a tu manejador de errores
                //     this.handleTokenError(error);
                // })
            },

            getCliente() {
                const userName = '{{ $userName }}';
                const userSurname = '{{ $userSurname }}';
                const userEmail = '{{ $userEmail }}';
                const userPhone = '{{ $userPhone }}';

                const cliente = (userEmail && userEmail.trim() !== '')
                    ? {
                        nombres:   userName,
                        apellidos: userSurname,
                        email:     userEmail,
                        celular:   userPhone
                    }
                    : {
                        nombres:   (document.getElementById('nombresNuevo')?.value || '').trim(),
                        apellidos: (document.getElementById('apellidosNuevo')?.value || '').trim(),
                        email:     this.emailNuevo || '',
                        celular:   this.celularNuevo || '',
                        tipDocId:  tipoIdDocumento,
                        num_doc:   numeroDocumento
                    };
                
                return cliente;
            },

            handleTokenSuccess(response) {
                const source_id = response.data.id
                let cliente = this.getCliente()

                const categoriaPlan = this.categoriaPlan
                const tipoPlan = this.tipoPlan
                const numAvisos = this.numAvisos
                const periodoPlan = this.periodoPlan
                const price = this.prices
                const plan_id = this.planId

                const formPost = {
                    "source_id": source_id,
                    "method": "card",
                    "amount": price,
                    // "plan_id": plan_id,
                    "currency": 'PEN',
                    "description": `Plan adquirido: ${tipoPlan} - Vigencia: ${periodoPlan} días - Avisos: ${numAvisos}.`,
                    "device_session_id": this.deviceSessionId,
                    "customer": {
                        "name": cliente.nombres,
                        "last_name": cliente.apellidos,
                        "phone_number": cliente.celular,
                        "email": cliente.email
                    }
                }

                this.processPayment(formPost)
            },

            handleTokenError(error) {
                document.getElementById('error-message').innerText = 'Verifique los datos de la tarjeta y vuelva a intentarlo';
                triggerToastPayError()
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            },

            processPayment(formPost) {
                let transactionData = {
                    amount: formPost.amount,
                    plan_id: formPost.plan_id,
                    currency: formPost.currency,
                    customer_name: formPost.customer.name,
                    customer_email: formPost.customer.email,
                    customer_phone_number: formPost.customer.phone_number,
                    description: formPost.description,
                    tipo_usuario_id: {{ $userTypeId }}
                }

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

                    if (data.error_code) {
                        transactionData = {
                            ...transactionData,
                            status: 0, // Transacción fallida
                            error_description: data.description,
                            error_code: data.error_code,
                            request_id: data.request_id
                        };

                        this.saveTransaction(transactionData);

                        this.clearForm()
                        this.isProcessing = false
                        document.getElementById('pay-button').disabled = false
                        document.getElementById('error-message').innerText = 'La tarjeta ha sido rechazada';
                        triggerToastPayError()

                        setTimeout(() => {
                            window.location.reload();
                        }, 3000);

                    } else {
                        transactionData = {
                            ...transactionData,
                            status: 1, // Transacción exitosa
                            card_bank_code: data.card.bank_code,
                            card_bank_name: data.card.bank_name,
                            card_holder_name: data.card.holder_name,
                            card_type: data.card.type,
                        };

                        this.saveTransaction(transactionData);

                        this.clearForm()
                        this.isProcessing = false
                        document.getElementById('pay-button').disabled = false
                        document.getElementById('success-message').innerText = 'Pago realizado con éxito';
                        triggerToastSuccess()
                        this.contratarPlan(formPost.amount, formPost.description);
                    }

                }).catch(error => {
                    console.error(error)
                })
            },

            saveTransaction(transactionData) {
                fetch("/save-transaction", {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(transactionData)
                })
                .then(response => response.json())
                .catch(error => {
                    console.error('Error guardando la transacción:', error);
                });
            },

            contratarPlan(price, description) {
                    let cliente = this.getCliente()
                    const dataToSend = {
                        plan_id: this.planId,
                        tipo_aviso: this.tipoDeAviso,
                        aviso_id: {{ $avisoId }},
                        cliente,
                    }

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
                            if ( !this.pagoFree ) {
                                this.factElectronica(price, planUserId, description)
                            }
                           window.location.href = '/panel/avisos'
                        } else {
                            console.error('Error en la suscripción:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error sending data to backend:', error.message);
                    });
            },

            factElectronica(price, planUserId, description){
                try {
                    const data = {
                        details: [
                            {
                                price: price,
                                quantity: 1,
                                product:
                                    {
                                        id: this.planId,
                                        name: description,
                                        type: 1
                                    }
                            }
                        ],
                        document_type_id: documentTypeId, // 3 ruc, 2 boleta
                        note: '',
                        num_doc: numeroDocumento,
                        tipo_doc: tipoDocumento,
                        receipt_name: nombreDocumento,
                        plan_name: `${this.tipoPlan}`,
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

            async verificarEmail(email) {
                try {
                    const resp = await fetch(`/verificarEmailExistente?email=${encodeURIComponent(email)}`);
                    const data = await resp.json();
                    if (data.ok) return Boolean(data.existeEmail);
                    console.warn('Respuesta no OK en verificarEmail');
                    return false;
                } catch (e) {
                    console.error("Error en la petición:", e);
                    return true;
                }
            },

            registerPayButton() {
                document.getElementById('pay-button').addEventListener('click', async () => {
                    const errorInline = document.getElementById('error-message')
                    if (this.isProcessing) return

                    if ( this.userBrokerNotRegister && !this.usuarioEmail ) {
                        if(this.emailNuevo.trim() === '' ){
                            alert('Favor de registrar un correo');
                            return false;
                        }
                        if(this.celularNuevo.trim() === '' ){
                            alert('Favor de registrar un celular');
                            return false;
                        }
                        const existe = await this.verificarEmail(this.emailNuevo);
                        if (existe) {
                            alert('El email ya existe, favor de loguearse y comprar el plan con su cuenta o de lo contrario registrar otro correo.');
                            return;
                        }

                        const span = document.getElementById('nombreSpan');
                        const nombre = span ? span.innerText.trim() : '';
                        if (!nombre) {
                            alert('Favor de consultar su número de documento');
                            return false;
                        }
                    }

                    if (this.isValidForm()) {
                        console.log("Entro al IF de validate()")
                        this.isProcessing = true
                        document.getElementById('pay-button').disabled = true

                        if ( this.pagoFree ) {
                            this.contratarPlan(0, "Promocion de inicio.")
                        } else {
                            this.createToken(this.handleTokenSuccess.bind(this))
                        }
                    } else {
                        console.log("Entro al ELSE de validate()")
                        return false
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
    let tipoIdDocumento = 1
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

                document.getElementById('nombresNuevo').value = ''
                document.getElementById('apellidosNuevo').value = ''

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
                            tipoIdDocumento = 2
                            nombreDocumento = data_response.data.nombre_o_razon_social

                            document.getElementById('nombresNuevo').value = data_response.data.nombres
                            document.getElementById('apellidosNuevo').value = ''
                            
                        } else {
                            numeroDocumento = data_response.data.numero
                            tipoDocumento = "DNI"
                            tipoIdDocumento = 1
                            nombreDocumento =data_response.data.nombre_completo

                            document.getElementById('nombresNuevo').value = data_response.data.nombres
                            document.getElementById('apellidosNuevo').value = data_response.data.apellido_paterno + " " + data_response.data.apellido_materno
                        
                        }
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

            getNombre() {
                if (this.tipo === 'DNI' && this.resultados) {
                    documentTypeId = 2
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

@push('scripts')
    @vite([ 'resources/js/scripts/toastySuccess.js', 'resources/js/scripts/toastyPayError.js' ])
@endpush
