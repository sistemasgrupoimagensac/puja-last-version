@extends('layouts.app')

@section('title')
    Libro Reclamaciones
@endsection

@section('header')
	@include('components.header_login')
@endsection

@section('content')
    <div id="loading" class="loading fade">
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="sr-only"></span>
            </div>
        </div>
    </div>
    <div class="header">
        <header>
            <div class="container">
                <div class="row pt-4 pb-4">
                    <div class="col-12">
                        <div id="logo">
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <section class="body mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="title-body">LIBRO VIRTUAL DE RECLAMACIONES</h1>
                </div>
            </div>
            <form class="" id="form" novalidate>
                <div class="row form-body-claim">
                    <div class="col-lg-3 col-md-3 col-6 mt-4">
                        <label for="type_document" class="form-label">Tipo de documento</label>
                        <select class="form-select" id="type_document" onchange="validate_document()" required>
                            <option value="" disabled disabled selected>Seleccionar...</option>
                            <option value="1">DNI</option>
                            <option value="2">Carné de Extranjería</option>
                        </select>
                        <div class="invalid-feedback">
                            Seleccione una opción.
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mt-4">
                        <label for="id_number" class="form-label">N° de Documento</label>
                        <input type="text" class="form-control" id="id_number" placeholder="01256453" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                        <div class="invalid-feedback">
                            Ingrese un número válido.
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mt-4">
                        <label for="name" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="name" maxlength="50" onkeyup="validate_label(this.value, this.id)" placeholder="Carlos Enrique" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/(\..*)\./g, '$1');" required>
                        <div class="invalid-feedback">
                            Ingrese correctamente su(s) nombre(s).
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mt-4">
                        <label for="last_name" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="last_name" maxlength="50" onkeyup="validate_label(this.value, this.id)" placeholder="Feliciano Lopez" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/(\..*)\./g, '$1');" required>
                        <div class="invalid-feedback">
                            Ingrese correctamente sus apellidos.
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" placeholder="cenrique@micorreo.com" required>
                        <div class="invalid-feedback">
                            Ingrese un correo válido.
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="phone" class="form-label">Celular</label>
                        <input type="text" class="form-control" id="phone" placeholder="956265478" maxlength="9" minlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required>
                        <div class="invalid-feedback">
                            Ingrese un número de celular válido.
                        </div>
                    </div>
                    <div class="col-md-3 mt-4">
                        <label for="provincia" class="form-label">Provincia</label>
                        <select class="form-select" id="provincia" onchange="cambia_provincia()" required>
                            <option value="" disabled selected>Seleccionar...</option>
                            <option value="1">LIMA</option>
                            <option value="2">CALLAO</option>
                            <option value="3">CAÑETE</option>
                            <option value="4">HUAURA</option>
                        </select>
                        <div class="invalid-feedback">
                            Seleccione una opción.
                        </div>
                    </div>
                    <div class="col-md-3 mt-4">
                        <label for="distrito" class="form-label">Distrito</label>
                        <select class="form-select" id="distrito" required>
                            <option value="" disabled selected>Seleccionar...</option>
                        </select>
                        <div class="invalid-feedback">
                            Seleccione una opción.
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="address" class="form-label">Dirección de su domicilio</label>
                        <input type="text" class="form-control" id="address" maxlength="150" onkeyup="validate_label(this.value, this.id)" placeholder="Av. Ricardo Palma 294" required>
                        <div class="invalid-feedback">
                            Ingrese una dirección válida.
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="service" class="form-label">Servicio Contratado</label>
                        <select class="form-select" id="service" required>
                            <option value="" disabled selected>Seleccionar...</option>
                            <option value="1">Asesoría para obtener un préstamos con garantía hipotecaria</option>
                            <option value="2">Asesoría para invertir en prestamos con garantía hipotecaria</option>
                        </select>
                        <div class="invalid-feedback">
                            Seleccione una opción.
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="service" class="form-label">Fecha del suceso</label>
                        <input type="date" class="form-control" id="date_happened" title="Fecha del Suceso"  required>
                        <div class="invalid-feedback">
                            Seleccione una fecha válida.
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="claim" class="form-label">Descripción del reclamo</label>
                        <div class="form-floating">
                            <textarea class="form-control" name="claim" id="claim" onkeyup="validate_label(this.value, this.id)" rows="5" maxlength="750"  minlength="10" required></textarea>
                            <div class="invalid-feedback">
                                El reclamo debe contener al menos 10 caracteres.
                            </div>
                            <label for="claim" class="claim-label">Máximo de 750 caracteres</label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="request" class="form-label">¿Qué solicita?</label>
                        <div class="form-floating">
                            <textarea class="form-control" name="request" id="request" onkeyup="validate_label(this.value, this.id)" rows="5" maxlength="750" minlength="10" required></textarea>
                            <div class="invalid-feedback">
                                La solicitud debe contener al menos 10 caracteres.
                            </div>
                            <label for="request" class="request-label" required>Máximo de 750 caracteres</label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="request" class="form-label">Seleccio el medio por el cual desea recibir una respuesta</label>
                        <div class="form-check mt-2 ms-5">
                            <input class="form-check-input" type="radio" name="response_type" id="rd_1" value="1" checked required>
                            <label class="form-check-label" for="rd_1">
                                Correo Electrónico
                            </label>
                            <div class="invalid-feedback">
                                Debe elegir una de las opciones.
                            </div>
                        </div>
                        <div class="form-check mt-2 ms-5">
                            <input class="form-check-input" type="radio" name="response_type" id="rd_2" value="2" required>
                            <label class="form-check-label" for="rd_2">
                                Dirección Física
                            </label>
                            <div class="invalid-feedback">
                                Debe elegir una de las opciones.
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="accept_terms" required>
                            <label class="form-check-label" for="accept_terms">
                                Confirmo la veracidad y autorizo el tratamiento de los datos inscritos en este formulario con la finalidad de obtener una respuesta.
                            </label>
                            <div class="invalid-feedback">
                                Debe aceptar los términos.
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-5 text-center">
                        <button type="submit" class="btn btn-lg btn-primary w-50">Enviar</button>
                    </div>
                </div>
            </form>
            
        </div>
    </section>
@endsection

@section('footer')
  <x-footer></x-footer>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.js" integrity="sha512-NXopZjApK1IRgeFWl6aECo0idl7A+EEejb8ur0O3nAVt15njX9Gvvk+ArwgHfbdvJTCCGC5wXmsOUXX+ZZzDQw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var sl = document.getElementById('logo');
        var sf = document.getElementById('footer');
        var sf = document.getElementsByTagName('head')[0];
        var favicon = document.createElement('link');
        favicon.setAttribute('rel', 'shortcut icon');
        favicon.setAttribute('type', 'image/png');
        sf.appendChild(favicon);
        document.getElementById('id_number').disabled = true
        var date = moment();
        var currentDate = date.format('YYYY-MM-DD');
        var date_happened = document.getElementById('date_happened');
        date_happened.setAttribute('max', currentDate);
    
        var producto;

        var form = document.getElementById('form');

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            if (form.checkValidity()) {
                document.getElementById('loading').classList.remove('fade');

                var type_document = document.getElementById('type_document').value;
                var id_number = document.getElementById('id_number').value;
                var name = document.getElementById('name').value;
                var last_name = document.getElementById('last_name').value;
                var email = document.getElementById('email').value;
                var address = document.getElementById('address').value;
                var provincia = document.getElementById('provincia')[document.getElementById('provincia').selectedIndex].textContent;
                var distrito = document.getElementById('distrito')[document.getElementById('distrito').selectedIndex].textContent;
                var phone = document.getElementById('phone').value;
                var service = document.getElementById('service').value;
                var date_happened = document.getElementById('date_happened').value;
                var claim = document.getElementById('claim').value;
                var request = document.getElementById('request').value;
                var rd = document.getElementsByName("response_type");
                var response_type = Array.from(rd).find(rd => rd.checked).value;
                // console.log(producto, type_document, id_number, name, last_name, email, address, phone, service, date_happened, claim, request, response_type);

                var myHeaders = new Headers();
                myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

                var urlencoded = new URLSearchParams();
                urlencoded.append("producto", producto);
                urlencoded.append("type_document", type_document);
                urlencoded.append("id_number", id_number);
                urlencoded.append("name", name);
                urlencoded.append("last_name", last_name);
                urlencoded.append("email", email);
                urlencoded.append("address", address);
                urlencoded.append("provincia", provincia);
                urlencoded.append("distrito", distrito);
                urlencoded.append("phone", phone);
                urlencoded.append("service", service);
                urlencoded.append("date_happened", date_happened);
                urlencoded.append("claim", claim);
                urlencoded.append("request", request);
                urlencoded.append("response_type", response_type);

                var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: urlencoded,
                redirect: 'follow'
                };

                // fetch("http://localhost:4000/libro-de-reclamaciones", requestOptions)
                fetch("https://360creative.pe/libro-de-reclamaciones", requestOptions)
                .then((res) => res.json())
                .then((response) => {
                    if (parseInt(response.status) < 201 && parseInt(response.status) > 0) {
                        document.getElementById('loading').classList.add('fade');
                        Swal.fire({
                            allowOutsideClick: false,
                            icon: response.icon,
                            title: response.title,
                            text: response.text,
                        });
                        Swal.fire({
                            allowOutsideClick: false,
                            title: response.title,
                            text: response.text,
                            icon: response.icon,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        })
                    } else {
                        document.getElementById('loading').classList.add('fade');
                        Swal.fire({
                            icon: response.icon,
                            title: response.title,
                            text: response.text,
                        });
                    }
                })
                .catch(error => {
                    document.getElementById('loading').classList.add('fade');
                        Swal.fire({
                            icon: 'error',
                            title: 'Opss...',
                            text: 'Ocurrió un error al intentar enviar la solicitud.\nPor favor, póngase en contacto al (01) 471 2222 para que puedan atenteder su solicitud',
                        });
                });
            }
        });

    });

    var rs = window.location.hostname;
    switch (rs) {
        case 'pujainmobiliaria.com.pe':
            sl.innerHTML = `<img class="logo" src="./assets/img/prestacapital.png" alt="">`;
            favicon.setAttribute('href', './assets/img/favicon_prestacapital.png');
            producto = 0;
            break;
        case 'reclamos.grupoimagensac.com.pe':
            sl.innerHTML = `<img class="logo" src="./assets/img/grupoimagen.png" alt="">`;
            favicon.setAttribute('href', './assets/img/favicon_grupoimagen.png');
            producto = 1;
            break;
        case 'reclamos.prestacapital.com.pe':
            sl.innerHTML = `<img class="logo" src="./assets/img/prestacapital.png" alt="">`;
            favicon.setAttribute('href', './assets/img/favicon_prestacapital.png');
            producto = 2;
            break;
        case 'reclamos.prestaemprendedor.com.pe':
            sl.innerHTML = `<img class="logo" src="./assets/img/prestaemprendedor.png" alt="">`;
            favicon.setAttribute('href', './assets/img/favicon_prestaemprendedor.png');
            producto = 3;
            break;
        case 'reclamos.soymype.com.pe':
            sl.innerHTML = `<img class="logo" src="./assets/img/soymype.png" alt="">`;
            favicon.setAttribute('href', './assets/img/favicon_soymype.png');
            producto = 4;
            break;
        case 'reclamos.soymype.com.pe':
            sl.innerHTML = `<img class="logo" src="./assets/img/soymype.png" alt="">`;
            favicon.setAttribute('href', './assets/img/favicon_soymype.png');
            producto = 4;
            break;
        case 'reclamos.grupoimagensac.com.pe':
            sl.innerHTML = `<img class="logo" src="./assets/img/soymype.png" alt="">`;
            favicon.setAttribute('href', './assets/img/favicon_soymype.png');
            producto = 9;
            break;
        default:
            break;
    }
    console.log('libro.js is loaded'); // Debes ver esto en la consola
    function validate_document() {
        console.log('validate_document is called');
        let type_document = document.getElementById('type_document');
        type_document.value == '0' ? type_document.classList.add('is-invalid'): type_document.classList.remove('is-invalid');
        
        let id_number = document.getElementById('id_number');
        switch (type_document.value) {
            case '0':
                id_number.setAttribute('disabled','');
                id_number.value = '';
                break;
            case '1':
                id_number.removeAttribute('disabled');
                id_number.setAttribute('maxlength','8');
                id_number.value = '';
                break;
            case '2':
                id_number.removeAttribute('disabled');
                id_number.setAttribute('maxlength','11');
                id_number.value = '';
                break;
            default:
                break;
        }
    }

    function validate_label(label, id) {
        document.getElementById(id).value = label.replace(/\s{1,}/g, ' ');
    }

    ;(() => {
        'use strict';
        const forms = document.querySelectorAll('#form');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
        }, false)
        })
    })()

    // Select provincia
    const lima = {
        1249: "LIMA",
        1250: "ANCON",
        1251: "ATE",
        1252: "BARRANCO",
        1253: "BREÑA",
        1254: "CARABAYLLO",
        1255: "CHACLACAYO",
        1256: "CHORRILLOS",
        1257: "CIENEGUILLA",
        1258: "COMAS",
        1259: "EL AGUSTINO",
        1260: "INDEPENDENCIA",
        1261: "JESUS MARIA",
        1262: "LA MOLINA",
        1263: "LA VICTORIA",
        1264: "LINCE",
        1265: "LOS OLIVOS",
        1266: "LURIGANCHO",
        1267: "LURIN",
        1268: "MAGDALENA DEL MAR",
        1269: "PUEBLO LIBRE",
        1270: "MIRAFLORES",
        1271: "PACHACAMAC",
        1272: "PUCUSANA",
        1273: "PUENTE PIEDRA",
        1274: "PUNTA HERMOSA",
        1275: "PUNTA NEGRA",
        1276: "RIMAC",
        1277: "SAN BARTOLO",
        1278: "SAN BORJA",
        1279: "SAN ISIDRO",
        1280: "SAN JUAN DE LURIGANCHO",
        1281: "SAN JUAN DE MIRAFLORES",
        1282: "SAN LUIS",
        1283: "SAN MARTIN DE PORRES",
        1284: "SAN MIGUEL",
        1285: "SANTA ANITA",
        1287: "SANTA ROSA",
        1288: "SANTIAGO DE SURCO",
        1289: "SURQUILLO",
        1290: "VILLA EL SALVADOR",
        1291: "VILLA MARIA DEL TRIUNFO",
        1286: "SANTA MARÍA DEL MAR"

    };
    const callao = {
        678: "CALLAO",
        679: "BELLAVISTA",
        680: "CARMEN DE LA LEGUA REYNOSO",
        681: "LA PERLA",
        682: "LA PUNTA",
        683: "VENTANILLA"

    };
    const cañete = {
        1310: "ASIA",
        1317: "MALA",
        1312: "	CERRO AZUL",
        1309: "SAN VICENTE DE CAÑETE",
        1313: "CHILCA",
        1323: "	SANTA CRUZ DE FLORES"
    };
    const huaura = {
        1369: "	HUACHO",
        1380: "VEGUETA"
    }

    var todasProvincias = [
        [], lima, callao, cañete, huaura
    ];

    function cambia_provincia() {
        //tomo el valor del select de la provincia elegida
        var e = document.getElementById("provincia");
        var provincia;
        provincia = e.selectedIndex;
        if (provincia != 0) {
            mis_provincias = todasProvincias[provincia];
            num_provincias = Object.keys(mis_provincias).length;
            for (i = 0; i < num_provincias; i++) {
                html = "";
                if (provincia == 1) {
                    for (var key in lima) {
                        html += "<option value=" + key + ">" + lima[key] + "</option>";
                        document.getElementById("distrito").innerHTML = html;
                    }
                } else if (provincia == 2) {
                    for (var key in callao) {
                        html += "<option value=" + key + ">" + callao[key] + "</option>";
                        document.getElementById("distrito").innerHTML = html;
                    }
                } else if (provincia == 3) {
                    for (var key in cañete) {
                        html += "<option value=" + key + ">" + cañete[key] + "</option>";
                        document.getElementById("distrito").innerHTML = html;
                    }
                } else if (provincia == 4) {
                    for (var key in huaura) {
                        html += "<option value=" + key + ">" + huaura[key] + "</option>";
                        document.getElementById("distrito").innerHTML = html;
                    }
                }
            }
        }
    }

</script>

