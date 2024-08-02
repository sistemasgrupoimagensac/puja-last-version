@extends('layouts.app')

@section('title')
    Crear tu Aviso
@endsection

@push('styles')
    @vite(['resources/sass/pages/crear-aviso.scss'])
@endpush

@section('content')
    <div x-data="avisoForm()">

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
                                        <input type="phone" class="form-control" id="phone" name="phone" placeholder="Telefono" required>
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
                                        <input type="text" class="form-control" id="document_number" name="document_number" placeholder="DNI" required>
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
        
        <!-- Menú de los pasos -->
        <div class="py-2 py-lg-4 bg-body-tertiary border-bottom">
            <div class="d-flex justify-content-around fw-semibold text-light-emphasis">
                <div :class="{ 'text-primary': step === 1 }" class="crear-aviso-menu-paso">
                    <span>1</span>
                    <span class="d-none d-lg-inline">. Operación y tipo de inmueble</span>
                </div>
                <div :class="{ 'text-primary': step === 2 }" class="crear-aviso-menu-paso">
                    <span>2</span>
                    <span class="d-none d-lg-inline">. Ubicación</span>
                </div>
                <div :class="{ 'text-primary': step === 3 }" class="crear-aviso-menu-paso">
                    <span>3</span>
                    <span class="d-none d-lg-inline">. Características</span>
                </div>
                <div :class="{ 'text-primary': step === 4 }" class="crear-aviso-menu-paso">
                    <span>4</span>
                    <span class="d-none d-lg-inline">. Multimedia</span>
                </div>
                <div :class="{ 'text-primary': step === 5 }" class="crear-aviso-menu-paso">
                    <span>5</span>
                    <span class="d-none d-lg-inline">. Comodidades</span>
                </div>
                <div :class="{ 'text-primary': step === 6 }" class="crear-aviso-menu-paso">
                    <span>6</span>
                    <span class="d-none d-lg-inline">. Adicionales</span>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="col-12 col-lg-6 px-lg-5">

                <!-- Paso 1: Operación y tipo de inmueble -->
                <div x-show="step === 1">
                    <form @submit.prevent="nextStep(1)" class="d-flex flex-column gap-4 my-5">
                        @csrf
                        <h2>Operación y tipo de inmueble</h2>
                        <input type="hidden" name="operacion" :value="step === 1 ? 1 : 0">

                        <div class="d-flex flex-column">
                            <label class="text-secondary">Tipo de operación</label>
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" x-model="tipo_operacion" id="vender" autocomplete="off" value="1" required>
                                <label class="btn btn-outline-secondary button-filter" for="vender">Vender</label>

                                <input type="radio" class="btn-check" x-model="tipo_operacion" id="alquilar" autocomplete="off" value="2" required>
                                <label class="btn btn-outline-secondary button-filter" for="alquilar" :class="{'rounded-end': !perfil_acreedor}">Alquilar</label>

                                <input type="radio" class="btn-check" :class="{'d-none': !perfil_acreedor}" x-model="tipo_operacion" id="rematar" autocomplete="off" value="3" required>
                                <label class="btn btn-outline-secondary button-filter" :class="{'d-none': !perfil_acreedor}" for="rematar">Rematar</label>
                            </div>
                        </div>

                        <div class="form-floating" x-init="fetchSubtipos()">
                            <select x-model="selectedSubtipo" class="form-select" id="tipoinmueble" required>
                                <option selected value="">Selecciona un subtipo</option>
                                <template x-for="subtipo in subtipos" :key="subtipo.id">
                                    <option :value="subtipo.id" x-text="subtipo.subtipo"></option>
                                </template>
                            </select>
                        <label for="tipoinmueble">Tipo de inmueble</label>
                        </div>

                        <button type="submit" class="btn button-orange w-100">Continuar</button>
                    </form>
                </div>

                <!-- Paso 2: Ubicación -->
                <div x-show="step === 2" x-init="initializeSecondStep()">
                    <form @submit.prevent="nextStep(2)" class="d-flex flex-column gap-4 my-5">
                        @csrf
                        <h2>Ubicación</h2>
                        <input type="hidden" name="ubicacion" :value="step === 2 ? 1 : 0">

                        <div class="form-floating">
                            <input type="text" id="direccion" x-model="direccion" class="form-control" placeholder="Dirección" required>
                            <label for="direccion">Dirección</label>
                        </div>

                        <div class="form-floating">
                            <select x-model="selectedDepartamento" @change="fetchProvincias()" class="form-select" id="departamento" required>
                                <option value="">Seleccione un Departamento</option>
                                <template x-for="departamento in departamentos" :key="departamento.id">
                                    <option :value="departamento.id" x-text="departamento.nombre"></option>
                                </template>
                            </select>
                        <label for="departamento">Departamento</label>
                        </div>

                        <div class="form-floating">
                            <select x-model="selectedProvincia" @change="fetchDistritos()" :disabled="!selectedDepartamento" class="form-select" id="provincia" required>
                                <option value="">Seleccione una Provincia</option>
                                <template x-for="provincia in provincias" :key="provincia.id">
                                    <option :value="provincia.id" x-text="provincia.nombre"></option>
                                </template>
                            </select>
                            <label for="provincia">Provincia</label>
                        </div>

                        <div class="form-floating">
                            <select x-model="selectedDistrito" :disabled="!selectedProvincia" class="form-select" id="distrito" required>
                                <option value="">Seleccione un Distrito</option>
                                <template x-for="distrito in distritos" :key="distrito.id">
                                    <option :value="distrito.id" x-text="distrito.nombre"></option>
                                </template>
                            </select>
                            <label for="distrito">Distrito</label>
                        </div>

                        {{-- <div x-init="initMap"> --}}
                            <div id="map" style="width: 600px; height: 600px"></div>
                            <input type="hidden" x-model="latitude" name="latitude">
                            <input type="hidden" x-model="longitude" name="longitude">
                        {{-- </div> --}}


                        <div class="d-flex justify-content-between gap-2 w-100">
                            <button type="button" @click="prevStep()" class="btn btn-secondary w-100">Atrás</button>
                            <button type="submit" class="btn button-orange w-100">Continuar</button>
                        </div>
                    </form>
                </div>

                <!-- Paso 3: Características -->
                <div x-show="step === 3" {{-- x-init="initializeThridStep()" --}}>
                    <form @submit.prevent="nextStep(3)" class="d-flex flex-column gap-4 my-5">
                        @csrf
                        <h2>Características</h2>
                        <input type="hidden" name="caracteristicas" :value="step === 3 ? 1 : 0">

                        <fieldset>
                            <legend>Características Principales</legend>

                            <div class="d-flex justify-content-between gap-4">
                                <div x-show="tipo_operacion != 3">
                                    <div class="form-check form-switch form-group w-100">
                                        <label class="form-check-label" for="is_puja">Desea recibir ofertas de precios</label>
                                        <input class="form-check-input" type="checkbox" role="switch" id="is_puja" x-model="is_puja">
                                        <span data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Seleccionar el campo si queremos que los posibles compradores puedan enviarnos sus montos que ofrecen.">
                                            <i class="fa-solid fa-circle-info ms-2"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between gap-4">
                                <div class="form-group w-100">
                                    <label class="text-secondary" for="dormitorios">Dormitorios</label>
                                    <input type="number" id="dormitorios" x-model="dormitorios" min="0" max="99" class="form-control">
                                </div>

                                <div class="form-group w-100">
                                    <label class="text-secondary" for="banios">Baños</label>
                                    <input type="number" id="banios" x-model="banios" min="0" max="99" class="form-control">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between gap-4 mt-3">
                                <div class="form-group w-100">
                                    <label class="text-secondary" for="medio_banios">Medio Baño</label>
                                    <input type="number" id="medio_banios" x-model="medio_banios" min="0" max="99" class="form-control">
                                </div>

                                <div class="form-group w-100">
                                    <label class="text-secondary" for="estacionamiento">Estacionamientos</label>
                                    <input type="number" id="estacionamiento" x-model="estacionamiento" min="0" max="99" class="form-control">
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Superficie</legend>

                            <div class="d-flex justify-content-between gap-4">
                                <div class="form-group w-100">
                                    <label class="text-secondary" for="area_construida">Área Construida</label>
                                    <div class="input-group mb-3">
                                        <input type="number" id="area_construida" x-model="area_construida" min="0" max="999999" class="form-control" required>
                                        <span class="input-group-text">m<sup>2</sup></span>
                                    </div>
                                </div>
                                <div class="form-group w-100">
                                    <label class="text-secondary" for="area_total">Área Total</label>
                                    <div class="input-group mb-3">
                                        <input type="number" id="area_total" x-model="area_total" min="0" max="999999" class="form-control" required>
                                        <span class="input-group-text">m<sup>2</sup></span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Antigüedad</legend>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" x-model="antiguedad" id="estreno" value="estreno" required>
                                <label class="form-check-label" for="estreno">
                                    Estreno
                                </label>
                            </div>

                            <div class="d-flex align-items-center justify-content-between my-2">

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" x-model="antiguedad" id="antiguedad" value="antiguedad" required>
                                    <label class="form-check-label" for="antiguedad">
                                        Años de antigüedad
                                    </label>
                                </div>

                                <div class="form-group" x-show="antiguedad === 'antiguedad'">
                                    <div class="input-group">
                                        <input type="number" x-model="anios_antiguedad" min="0" max="99" class="form-control border" :required="antiguedad === 'antiguedad'">
                                    </div>
                                </div>

                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" x-model="antiguedad" id="construccion" value="construccion" required>
                                <label class="form-check-label" for="construccion">
                                    En construcción
                                </label>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Precio</legend>

                            <div class="d-flex justify-content-between gap-4">
                                {{-- Precios para alquiler o venta --}}
                                <div class="form-group w-100" x-show="!perfil_acreedor || (perfil_acreedor && tipo_operacion != 3)">
                                    <label class="text-secondary" for="precio_soles">Precio soles</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">S/.</span>
                                        <input type="text" id="precio_soles" x-model="precio_soles" class="form-control" @input="formatAmount('precio_soles')" @blur="formatAmount('precio_soles', true)">
                                    </div>
                                </div>

                                <div class="form-group w-100" x-show="!perfil_acreedor || (perfil_acreedor && tipo_operacion != 3)">
                                    <label class="text-secondary" for="precio_dolares">Precio dólares</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">US$</span>
                                        <input type="text" id="precio_dolares" x-model="precio_dolares" class="form-control" @input="formatAmount('precio_dolares')" @blur="formatAmount('precio_dolares', true)">
                                    </div>
                                </div>

                                {{-- Precios para remate --}}
                                <div class="form-group w-100" x-show="perfil_acreedor && tipo_operacion == 3">
                                    <label class="text-secondary" for="base_remate">Base de Remate</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">US$</span>
                                        <input type="text" id="base_remate" x-model="base_remate" class="form-control" @input="formatAmount('base_remate')" @blur="formatAmount('base_remate', true)">
                                    </div>
                                </div>

                                <div class="form-group w-100" x-show="perfil_acreedor && tipo_operacion == 3">
                                    <label class="text-secondary" for="valor_tasacion">Valor de Tasación</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">US$</span>
                                        <input type="text" id="valor_tasacion" x-model="valor_tasacion" class="form-control" @input="formatAmount('valor_tasacion')" @blur="formatAmount('valor_tasacion', true)">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset x-show="perfil_acreedor && tipo_operacion == 3">
                            <legend>Detalles del Remate</legend>

                            <div class="d-flex justify-content-between gap-4">
                                <div class="form-group w-100">
                                    <label class="text-secondary" for="direccion_remate">Dirección del Remate</label>
                                    <input type="text" id="direccion_remate" x-model="direccion_remate" class="form-control">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between gap-4 mt-3">
                                <div class="form-group w-100">
                                    <label class="text-secondary" for="partida_registral">Partida Registral</label>
                                    <input type="text" id="partida_registral" x-model="partida_registral" class="form-control">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between gap-4 mt-3">
                                <div class="form-group w-100">
                                    <label class="text-secondary" for="fecha_remate">Fecha del Remate</label>
                                    <input type="date" id="fecha_remate" x-model="fecha_remate" class="form-control">
                                </div>
                                <div class="form-group w-100">
                                    <label class="text-secondary" for="hora_remate">Hora del Remate</label>
                                    <input type="time" id="hora_remate" x-model="hora_remate" min="07:00" max="22:00" class="form-control">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between gap-4 mt-3">
                                <div class="form-group w-100">
                                    <label class="text-secondary" for="contacto_remate">Nombre del Contacto</label>
                                    <input type="text" id="contacto_remate" x-model="contacto_remate" class="form-control">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between gap-4 mt-3">
                                <div class="form-group w-100">
                                    <label class="text-secondary" for="telefono_contacto_remate">Teléfono del Contacto</label>
                                    <input type="phone" id="telefono_contacto_remate" x-model="telefono_contacto_remate" class="form-control">
                                </div>
                            </div>

                        </fieldset>

                        <div class="d-flex justify-content-between gap-2 w-100">
                            <button type="button" @click="prevStep()" class="btn btn-secondary w-100">Atrás</button>
                            <button type="submit" class="btn button-orange w-100">Continuar</button>
                        </div>
                    </form>
                </div>

                <!-- Paso 4: Multimedia (fotos, videos, planos) -->
                <div x-show="step === 4">
                    <form @submit.prevent="nextStep(4)" enctype="multipart/form-data" class="d-flex flex-column gap-4 my-5">
                        @csrf
                        <h2>Multimedia</h2>
                        <input type="hidden" name="multimedia" :value="step === 4 ? 1 : 0">

                        <!-- Input para la imagen principal -->
                        <div class="form-group">
                            <label for="imagen_principal" class="form-label">Imagen Principal</label>
                            <input type="file" id="imagen_principal" class="form-control" @change="handleFiles($event, 'imagen_principal')">
                            <!-- Mostrar miniatura de la imagen principal seleccionada -->
                            <div class="mt-3" x-show="imagen_principal">
                                <h4>Miniatura de Imagen Principal</h4>
                                <img x-bind:src="imagen_principal ? URL.createObjectURL(imagen_principal) : ''" class="img-thumbnail" style="max-width: 200px" alt="Imagen Principal">
                                <!-- Botón para eliminar la imagen principal -->
                                <button type="button" class="btn btn-danger btn-sm mt-2" @click="eliminarImagen('imagen_principal')">Eliminar</button>
                            </div>
                        </div>



                        <!-- Input para seleccionar imágenes -->
                        <div class="form-group">
                            <label for="images" class="form-label">Seleccionar imágenes</label>
                            <input type="file" id="images" class="form-control" multiple @change="handleFiles($event, 'fotos')">
                            <!-- Mostrar miniaturas de las imágenes seleccionadas -->
                            <div class="mt-3" x-show="fotos.length > 0">
                                <h4>Miniaturas</h4>
                                <div class="row">
                                    <template x-for="(foto, index) in fotos" :key="index">
                                        <div class="col-md-3 mb-3">
                                            <img :src="URL.createObjectURL(foto)" class="img-thumbnail" style="max-width: 100%;"
                                                :alt="'Imagen ' + (index + 1)">
                                            <!-- Botón para eliminar imagen -->
                                            <button type="button" class="btn btn-danger btn-sm mt-2" @click="eliminarImagen('fotos', index)">Eliminar</button>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Input para videos -->
                        <div class="form-group">
                            <label class="text-secondary">Videos</label>
                            <input type="file" {{-- x-model="videos" --}} class="form-control" placeholder="URL de videos" @change="handleFiles($event, 'videos')">
                        </div>
                        
                        <!-- Input para seleccionar planos -->
                        <div class="form-group">
                            <label for="planos" class="form-label">Seleccionar imágenes</label>
                            <input type="file" id="planos" class="form-control" multiple @change="handleFiles($event, 'planos')">
                            <!-- Mostrar miniaturas de los planos seleccionadas -->
                            <div class="mt-3" x-show="planos.length > 0">
                                <h4>Miniaturas</h4>
                                <div class="row">
                                    <template x-for="(plano, index) in planos" :key="index">
                                        <div class="col-md-3 mb-3">
                                            <img :src="URL.createObjectURL(plano)" class="img-thumbnail" style="max-width: 100%;" :alt="'Plano ' + (index + 1)">
                                            <!-- Botón para eliminar plano -->
                                            <button type="button" class="btn btn-danger btn-sm mt-2" @click="eliminarImagen('planos', index)">Eliminar</button>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de navegación -->
                        <div class="d-flex justify-content-between gap-2 w-100">
                            <button type="button" @click="prevStep()" class="btn btn-secondary w-100">Atrás</button>
                            <button type="submit" class="btn button-orange w-100">Continuar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-12 col-lg-12 px-lg-5">
                <!-- Paso 5: Comodidades -->
                <div x-show="step === 5" x-init="initializeQuintoStep(2)">
                    <form @submit.prevent="nextStep(5)" class="d-flex flex-column gap-4 my-5">
                        @csrf
                        <div class="mt-4">
                            <h2>Comodidades</h2>
                            <input type="hidden" name="adicionales" :value="step === 5 ? 1 : 0">

                            <div class="row">
                                <template x-for="extra in extras" :key="extra.id">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-check my-2">
                                            <input class="form-check-input" type="checkbox" name="options[]" :id="'add_' + extra.id" :value="extra.id">
                                            <label class="form-check-label" :for="'add_' + extra.id">
                                                <i :class="'fa-solid ' + extra.icono + ' icon-orange mx-2'"></i>
                                                <span x-text="extra.caracteristica"></span>
                                            </label>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between gap-2 w-100">
                            <button type="button" @click="prevStep()" class="btn btn-secondary w-100">Atrás</button>
                            <button type="submit" class="btn button-orange w-100">Continuar</button>
                        </div>
                    </form>
                </div>

                <!-- Paso 6: Adicionales -->
                <div x-show="step === 6" x-init="initializeSextoStep(1)">
                    <form @submit.prevent="nextStep(6)" class="d-flex flex-column gap-4 my-5">
                        @csrf
                        <div class="mt-4">
                            <h2>Adicionales</h2>
                            <input type="hidden" name="comodidades" :value="step === 6 ? 1 : 0">
                            <div class="row">
                                <template x-for="extra in extras2" :key="extra.id">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-check my-2">
                                            <input class="form-check-input" type="checkbox" name="options[]" :value="extra.id" :id="'add_' + extra.id">
                                            <label class="form-check-label text-secondary filter-additional-input" :for="'add_' + extra.id">
                                                <i :class="'fa-solid ' + extra.icono + ' icon-orange mx-2'"></i>
                                                <span x-text="extra.caracteristica"></span>
                                            </label>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between gap-2 w-100">
                            <button type="button" @click="prevStep()" class="btn btn-secondary w-100">Atrás</button>
                            <button type="submit" class="btn btn-success w-100">Guardar y Publicar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- SCRIPTS ALPINE JS --}}
    <script>
        function avisoForm() {
            return {
                step: {{ session('step', 1) }},
                aviso_id: {{ session('aviso_id', 'null') }},

                perfil_acreedor: @json($es_acreedor),

                is_puja: false,
                
                tipo_operacion: '',
                subtipos: [],
                selectedSubtipo: '',
                titulo: '',
                description: '',

                direccion: '',
                departamentos: [],
                provincias: [],
                distritos: [],
                selectedDepartamento: '',
                selectedProvincia: '',
                selectedDistrito: '',

                extras: [],
                extras2: [],
                adicionales: [],
                comodidades: [],

                fotos: [],
                imagen_principal: null,
                videos: null,
                planos: [],
                dormitorios: '',
                banios: '',
                medio_banios: '',
                estacionamiento: '',
                area_construida: '',
                area_total: '',
                antiguedad: '',
                anios_antiguedad: '',
                precio_soles: '',
                precio_dolares: '',
                acceso_playa: false,
                aire_acondicionado: false,
                acceso_parque: false,
                ascensores: false,
                codigo_unico: '',

                // detalles de remate
                base_remate: '',
                valor_tasacion: '',
                direccion_remate: '',
                partida_registral: '',
                fecha_remate: '',
                hora_remate: '',
                contacto_remate: '',
                telefono_contacto_remate: '',

                map: null,
                marker: null,
                latitude: null,
                longitude: null,

                initMap() {
                    var defaultLocation = {lat: -12.09706477059002, lng: -77.02302118294135}; // Coordenadas iniciales de ejemplo
                    this.map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 18,
                        center: defaultLocation
                    });

                    this.map.addListener('click', (event) => {
                        this.placeMarker(event.latLng);
                    });

                    // Colocar un marcador inicial si hay coordenadas preexistentes
                    if (this.latitude && this.longitude) {
                        this.placeMarker({ lat: this.latitude, lng: this.longitude });
                    }
                },
                placeMarker(location) {
                    if (this.marker) {
                        this.marker.setPosition(location);
                    } else {
                        this.marker = new google.maps.Marker({
                            position: location,
                            map: this.map
                        });
                    }
                    this.latitude = location.lat();
                    this.longitude = location.lng();
                    console.log("Coordinates set to:", this.latitude, this.longitude); // Verificar coordenadas aquí
                },
                /* validateLocation() {
                    console.log('Validating location:', this.latitude, this.longitude); // Verificar coordenadas antes de validar
                    if (this.latitude === null || this.longitude === null) {
                        alert('Por favor, marque su ubicación en el mapa.');
                        return false;
                    }
                    return true;
                }, */

                formatAmount(modelName, final = false) {
                    // Remover todos los caracteres no numéricos
                    let numericValue = this[modelName].replace(/\D/g, '');
                    console.log(typeof(this[modelName]))

                    if (numericValue === '') {
                        this[modelName] = '';
                        return;
                    }

                    // Convertir a número y formatear con separador de miles
                    let formattedValue = parseInt(numericValue).toLocaleString('en-US');

                    // Actualizar el valor del input
                    this[modelName] = formattedValue;
                },

                /* initializeThridStep() {
                    console.log(this.perfil_acreedor)
                    this.mostrar_campo = this.perfil_acreedor;
                }, */
                init() {
                    this.$watch('tipo_operacion', value => {
                        if (value == 3) {
                            this.is_puja = false;
                        }
                    });
                },
                initializeSecondStep() {
                    this.fetchDepartamentos();
                    this.fetchProvincias();
                    this.fetchDistritos();
                },
                initializeQuintoStep(extra_id) {
                    this.fetchExtras(extra_id);
                },
                initializeSextoStep(extra_id) {
                    this.fetchExtras(extra_id);
                },

                nextStep(step) {
                    /* if (step === 2) {
                        if (!this.validateLocation()) {
                            return;
                        }
                    } */
                    const stepMap = {
                        1: '/my-post/store',
                        2: `/my-post/store`,
                        3: `/my-post/store`,
                        4: `/my-post/store`,
                        6: `/my-post/store`,
                    }

                    if (step === 5) /* Extras 1 */ {
                        // this.fetchExtras(1);
                        this.step++
                    } else if (step === 6) /* Extras 2 */ {
                        // this.fetchExtras(2);
                        let send_extras = []
                        document.querySelectorAll('input[name="options[]"]:checked').forEach((checkbox) => {
                            send_extras.push(checkbox.value)
                        })
                        const formData = new FormData()
                        let options = [...send_extras];

                        options.forEach((option) => {
                            formData.append('options[]', option);
                        });
                        formData.append('extras', 1)
                        formData.append('codigo_unico', this.codigo_unico)

                        fetch(stepMap[step], {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (step === 1) {
                                this.aviso_id = data.id
                            } else if (step === 6) {
                                // Redirigir a la página de "mis-avisos"
                                window.location.href = data.redirect_url
                            }
                            this.step++
                        })
                        .catch(error => {
                            console.error('Error:', error)
                        })
                    } else {
                        // Proceder con el fetch normal para los pasos 1-4
                        const formData = new FormData()
                        if (step === 1) /* Tipo de operacion */ {
                            formData.append('tipo_operacion_id', this.tipo_operacion)
                            formData.append('subtipo_inmueble_id', this.selectedSubtipo)
                            formData.append('principal', 1)
                            formData.append('codigo_unico', this.codigo_unico)
                        } else if (step === 2) /* Ubicacion */ {
                            formData.append('direccion', this.direccion)
                            formData.append('departamento_id', this.selectedDepartamento)
                            formData.append('provincia_id', this.selectedProvincia)
                            formData.append('distrito_id', this.selectedDistrito)
                            formData.append('ubicacion', 1)
                            formData.append('latitud', this.latitude);
                            formData.append('longitud', this.longitude);
                            formData.append('codigo_unico', this.codigo_unico)
                        } else if (step === 3) /* Caracteristicas */ {
                            formData.append('is_puja', this.is_puja ? 1 : 0)
                            formData.append('habitaciones', this.dormitorios)
                            formData.append('banios', this.banios)
                            formData.append('medio_banios', this.medio_banios)
                            formData.append('estacionamientos', this.estacionamiento)
                            formData.append('area_construida', this.area_construida)
                            formData.append('area_total', this.area_total)
                            formData.append('antiguedad', this.antiguedad)
                            formData.append('anios_antiguedad', this.anios_antiguedad)
                            formData.append('precio_soles', this.precio_soles)
                            formData.append('precio_dolares', this.precio_dolares)
                            
                            formData.append('remate_precio_base', this.base_remate)
                            formData.append('remate_valor_tasacion', this.valor_tasacion)
                            formData.append('remate_partida_registral', this.partida_registral)
                            formData.append('remate_direccion', this.direccion_remate)
                            formData.append('remate_fecha', this.fecha_remate)
                            formData.append('remate_hora', this.hora_remate)
                            formData.append('remate_nombre_contacto', this.contacto_remate)
                            formData.append('remate_telef_contacto', this.telefono_contacto_remate)

                            formData.append('titulo', this.titulo)
                            formData.append('description', this.description)
                            formData.append('caracteristicas', 1)
                            formData.append('codigo_unico', this.codigo_unico)
                        } else if (step === 4) /* Multimedia */ {
                            if (this.imagen_principal) {
                                formData.append('imagen_principal', this.imagen_principal)
                            }
                            this.fotos.forEach((foto, index) => {
                                formData.append(`imagen[]`, foto)
                            })
                            this.planos.forEach((plano, index) => {
                                formData.append(`planos[]`, plano)
                            })
                            if (this.videos) {
                                formData.append('video', this.videos)
                            }
                            formData.append('multimedia', 1)
                            formData.append('codigo_unico', this.codigo_unico)
                        }
                        fetch(stepMap[step], {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            this.codigo_unico = data.codigo_unico
                            if (step === 1) {
                                this.aviso_id = data.id
                            }
                            this.step++
                        })
                        .catch(error => {
                            console.error('Error:', error)
                        })
                    }
                },  

                prevStep() {
                    this.step--
                    this.updateStepStatus()
                },

                handleFiles(event, type) {
                    const files = event.target.files
                    if (type === 'fotos') {
                        this.fotos.push(...files)
                    } else if (type === 'planos') {
                        this.planos.push(...files)
                    } else if (type === 'imagen_principal') {
                        this.imagen_principal = files[0]
                    } else if (type === 'videos') {
                        this.videos = files[0]
                    }
                },

                eliminarImagen(type, index) {
                    if (type === 'fotos') {
                        this.fotos.splice(index, 1)
                    } else if (type === 'planos') {
                        this.planos.splice(index, 1)
                    } else if (type === 'imagen_principal') {
                        this.imagen_principal = null
                    } else if (type === 'videos') {
                        this.videos = null
                    }
                },

                updateStepStatus() {
                    document.querySelector('input[name="operacion"]').value = this.step === 1 ? 1 : 0
                    document.querySelector('input[name="ubicacion"]').value = this.step === 2 ? 1 : 0
                    document.querySelector('input[name="caracteristicas"]').value = this.step === 3 ? 1 : 0
                    document.querySelector('input[name="multimedia"]').value = this.step === 4 ? 1 : 0
                    document.querySelector('input[name="adicionales"]').value = this.step === 5 ? 1 : 0
                    document.querySelector('input[name="comodidades"]').value = this.step === 6 ? 1 : 0
                },

                fetchSubtipos() {
                    fetch('/my-post/operaciones/subtipos')
                    .then(response => response.json())
                    .then(data => {
                        if (!data.error) {
                            this.subtipos = data.subtipos;
                        } else {
                            console.error('Error fetching subtipos:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                },

                fetchDepartamentos() {
                    fetch('/my-post/ubicacion/departamentos')
                    .then(response => response.json())
                    .then(data => {
                        this.departamentos = data.departamentos;
                    })
                    .catch(error => {
                        console.error('Error fetching departamentos:', error);
                    });
                },

                fetchProvincias() {
                    if (this.selectedDepartamento) {
                        fetch(`/my-post/ubicacion/provincias/${this.selectedDepartamento}`)
                        .then(response => response.json())
                        .then(data => {
                            this.provincias = data;
                            this.selectedProvincia = '';
                            this.distritos = [];
                            this.selectedDistrito = '';
                        })
                        .catch(error => {
                            console.error('Error fetching provincias:', error);
                        });
                    } else {
                        this.provincias = [];
                        this.selectedProvincia = '';
                        this.distritos = [];
                        this.selectedDistrito = '';
                    }
                },

                fetchDistritos() {
                    if (this.selectedProvincia) {
                        fetch(`/my-post/ubicacion/distritos/${this.selectedProvincia}`)
                        .then(response => response.json())
                        .then(data => {
                            this.distritos = data;
                            this.selectedDistrito = '';
                        })
                        .catch(error => {
                            console.error('Error fetching distritos:', error);
                        });
                    } else {
                        this.distritos = [];
                        this.selectedDistrito = '';
                    }
                },

                fetchExtras(extra_id) {
                    fetch(`/my-post/extras/${extra_id}`)
                    .then(response => response.json())
                    .then(data => {
                        if( extra_id== 2 ){
                            this.extras = data;
                        } else if( extra_id== 1 ){
                            this.extras2 = data;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching distritos:', error);
                    });
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
                }
            }
        }

        window.showModal = @json($show_modal);

        // Inicializar el mapa de Google
        function initMap() {
            const elements = document.querySelectorAll('[x-data]');

            elements.forEach(element => {
                const xDataFunction = new Function('return ' + element.getAttribute('x-data'))();
                if (typeof xDataFunction.initMap === 'function') {
                    xDataFunction.initMap();
                }
            });
            // console.log("INIT MAP LAST:", this.longitude)
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuCCuPnZoJYgILw9e3PNom-ZG5TnsGNeg&callback=initMap"
    async defer></script>

@endsection

@push('scripts')
  @vite([ 'resources/js/scripts/updatePlaceholdersRegister.js' ])
@endpush