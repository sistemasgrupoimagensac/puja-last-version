@extends('layouts.app')

@section('title')
    Pago Pendiente
@endsection

@section('header')
    @include('components.header_login')
@endsection

@section('content')

    @php
        if ($precio) {
            $precio_formateado = number_format($precio);
        } else {
            $precio_formateado = null;
        }

        if ($razonSocial) {
            $razon_social = $razonSocial;
        } else {
            $razon_social = null;
        }
    @endphp

    <div class="position-relative container my-5" style="max-width: 600px" id="modalPago2" x-data="creditCardData()" x-init="init()">
        <form id="payment-form">
            @csrf

            <div class="p-0">
                <div class="d-flex flex-column ">

                    {{-- detalles del plan contratado --}}
                    {{-- <div class="text-bg-dark shadow h-100">
                        <div class="text-center d-flex flex-column justify-content-around">
                        <h3>Pago Proyecto</h3>
                    
                        <div class="d-flex flex-column align-items-center">
                            <div class="card-text fw-bold display-3 d-flex gap-2">
                            <span>S/ {{ $precio_formateado }}</span>
                            </div>
                        </div>

                        <p class="card-text h2"> 
                            <span>
                                aviso(s) {{ $numeroAnuncios }} 
                            </span>
                        </p>

                        <small class="h5 d-flex flex-column align-items-start">
                            <div>
                                <span class="">desde: </span> <span>{{ $fechaInicio }}</span>
                            </div>
                            <div>
                                <span class="">hasta: </span> <span>{{ $fechaFin }}</span>
                            </div>
                        </small> 


                        </div>
                    </div> --}}

                    <div class="card text-bg-dark mb-3 border-0 text-center">
                        {{-- <div class="card-header"> --}}
                            <h4 class="card-header fw-bold border-bottom">Pago Proyecto</h4>

                        {{-- </div> --}}
                        <div class="card-body py-4">
                            {{-- <h4 class="card-title fw-bold">Pago Proyecto</h4> --}}
                            <p class="card-text fw-bold display-3">S/ {{ $precio_formateado }}</p>
                            <p class="card-text h3">aviso(s): {{ $numeroAnuncios }} </p>
                        </div>

                        <div class="card-footer bg-secondary d-flex justify-content-center py-3">
                            <div class="d-flex flex-column align-items-start">
                                <p class="m-0 h5">
                                    <span>desde: </span> <span>{{ $fechaInicio }}</span>
                                </p>

                                <p class="m-0 h5">
                                    <span>hasta: </span> <span>{{ $fechaFin }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Tarjetas aceptadas --}}
                    <div class="d-flex gap-3 my-3">
                        <div>
                            <img style="height: 32px" src="/images/tarjetas/amex2.png" alt="amex">
                            {{-- <i class="fa-brands fa-cc-amex fa-3x text-secondary"></i> --}}
                        </div>
                        <div>
                            <img style="height: 32px" src="/images/tarjetas/mastercard2.png" alt="amex">
                            {{-- <i class="fa-brands fa-cc-mastercard fa-3x text-secondary"></i> --}}
                        </div>
                        <div>
                            <img style="height: 32px" src="/images/tarjetas/visa2.png" alt="amex">
                            {{-- <i class="fa-brands fa-cc-visa fa-3x text-secondary"></i> --}}
                        </div>
                    </div>
        
                    {{-- Datos de la tarjeta de crédito --}}
                    <div class=" col p-lg-4 p-2 border rounded-2 shadow">
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
                    </div>
        
                </div>
            </div>

            {{-- Datos Facturación --}}
            <div class="mt-4 p-2 mb-2 mb-lg-0 p-lg-4">

                <h6 class="icon-orange fw-bold">Datos para el comprobante</h6>
                <p class="m-0"> 
                    <span class=" fw-bold">Tipo Documento:</span>
                    <span class="text-uppercase" id="resultadoTipoDoc" > {{ $tipoDocumento }}</span>
                </p>
    
                <p class="m-0">
                    <span class=" fw-bold">Nombre: </span>
                    <span class="resultadoConsultaDoc"> {{ $razon_social }}</span>
                </p>
            </div>

            <div class="d-flex justify-content-center w-100">
                <button type="button" class="btn btn-outline-secondary rounded-3 m-2 mx-lg-4 w-100" data-bs-target="#modalDNIoRUC" data-bs-toggle="modal">
                    ¿Desea pagar con una distinta Razón Social?
                </button>
            </div>

            <div class="d-flex justify-content-center w-100">
                <button type="button" class="btn button-orange fs-3 rounded-3 m-2 mx-lg-4 w-100" id="pay-button">
                    <span>Pagar S/</span>
                    {{ $precio_formateado }}
                </button>
            </div>
            <p class="text-body-tertiary h6 py-1 px-3 py-lg-3 px-lg-4 text-justify">
                Al hacer clic en Pagar, está aceptando nuestros 
                <a class=" text-decoration-none" href="/terminos-contratacion" target="blank">
                Términos y Condiciones de Contratación</a>
            </p>
        </form>
    </div>

    {{-- MODAL ELECCION DOCUMENTO --}}
    <div class="modal fade" id="modalDNIoRUC" tabindex="-1" aria-hidden="true" aria-labelledby="modalDNIoRUC" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="m-0">Obtener Razón Social por RUC o DNI</h5>
                </div>
                <div class="modal-body">
                        <div class="input-group mb-3">
                            <form id="consultarDocForm" class="w-100">
                                @csrf
                                <div class="d-flex flex-column gap-4 justify-content-between w-100">
                                    <div class="d-flex justify-content-between">

                                        <div class="btn-group btn-group-sm" role="group">
                                            <input type="radio" class="btn-check" name="btnSelectDoc" id="DNIcheck" autocomplete="off" value="dni" checked>
                                            <label class="btn btn-outline-secondary" for="DNIcheck">DNI</label>

                                            <input type="radio" class="btn-check" name="btnSelectDoc" id="RUCcheck" autocomplete="off" value="ruc">
                                            <label class="btn btn-outline-secondary" for="RUCcheck">RUC</label>
                                        </div>

                                        <input type="submit" class="btn btn-secondary btn-sm" id="consultar-documento" value="Consultar">

                                    </div>

                                    <div class="form-floating">
                                        <input type="text" class="form-control form-control-lg shadow-none" name="documento" id="documentoConsulta" placeholder="Número documento" required>
                                        <label class=" text-secondary" for="documentoConsulta">Número documento</label>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <!-- Div para mostrar los resultados -->
                        <div class="mt-3" id="resultadoConsultaDocContainer">
                            <span class="resultadoEtiqueta fw-bold" id="resultadoEtiqueta"></span>
                            <span class="resultadoConsultaDoc" id="resultadoConsultaDoc"></span>
                        </div>
    
                        <!-- Div para mostrar los errores -->
                        <div class="mt-3 alert alert-danger" id="errorConsultaDocContainer">
                            <span id="errorConsultaDoc"></span>
                        </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn button-orange" data-bs-dismiss="modal">
                        <i class="fa-solid fa-arrow-left"></i>
                            Regresar
                    </button>
                </div>
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
                const price = {{ $precio }}

                const formPost = {
                    "source_id": source_id,
                    "method": "card",
                    "amount": price,
                    "currency": 'PEN',
                    "description": `Contrato de proyecto inmobiliario adquirido por S/ ${price}`,
                    "device_session_id": this.deviceSessionId,
                    "customer": {
                        "name": '{{ $razon_social }}',
                        "phone_number": '{{ $telefono }}',
                        "email": '{{ $correo }}'
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
                    const dataToSend = {

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
                            this.factElectronica(price, planUserId, description)
                            window.location.href = '/panel/avisos'
                        } else {
                            console.error('Error en la suscripción:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error sending data to backend:', error.message);
                    });
            },

            factElectronica(price, planUserId, description) {
                try {
                    const data = {
                        details: [
                            {
                                price: price,
                                quantity: 1,
                                product: 
                                    {
                                        id: idPlan,
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
                        plan_name: `Plan ${this.tipoPlan}`,
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
</script>

@endsection

@push('scripts')
    @vite(['resources/js/scripts/consultar_documento.js', 'resources/js/scripts/toastySuccess.js', 'resources/js/scripts/toastyPayError.js' ])
@endpush

@push('scripts-head')
	<script src="https://js.openpay.pe/openpay.v1.min.js"></script>
	<script src="https://js.openpay.pe/openpay-data.v1.min.js"></script>
@endpush