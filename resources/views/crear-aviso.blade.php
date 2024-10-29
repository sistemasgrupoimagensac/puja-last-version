@extends('layouts.app')

@section('title')
    Crear tu Aviso
@endsection

@push('styles')
    @vite(['resources/sass/pages/crear-aviso.scss', 'resources/sass/components/flipping.scss'])
@endpush

@section('content')
    
    <div id="loader-overlay">
        <div class="flipping"></div>
    </div>
    
    <div x-data="avisoForm()">

        <x-completa-registro-google></x-completa-registro-google>
        
        <!-- Menú de los pasos -->
        <div class="py-3 py-lg-4 bg-body-tertiary border-bottom">
            <div class="d-flex justify-content-around align-items-center fw-semibold text-light-emphasis">
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

                <a type="button" href="/" class="btn btn-danger px-4 fs-6">Salir</a>
            </div>
        </div>

        <div class="container">
            <div class="col-12 col-lg-6 px-lg-5">

                <div id="error-container" class="mt-3" style="margin-bottom: -1rem;"></div>

                <!-- Paso 1: Operación y tipo de inmueble -->
                <div x-show="step === 1">
                    <form @submit.prevent="nextStep(1)" class="d-flex flex-column gap-4 my-3 my-lg-5">
                        @csrf
                        <h2 class="m-0" class="m-0" class="m-0" class="m-0" class="m-0" class="m-0">Operación y tipo de inmueble</h2>
                        <input type="hidden" name="operacion" :value="step === 1 ? 1 : 0">

                        @php
                        $show_vender = false;
                        $show_alquilar = false;
                        $show_rematar = false;

                        $rematar_last = false;
                        $alquilar_last = false;
                        $vender_last = false;

                        if ($es_corredor) {
                            $show_vender = true;
                            $show_alquilar = true;
                            $alquilar_last = true;
                        } elseif ($es_acreedor) {
                            $show_rematar = true;
                            $rematar_last = true;
                        } elseif ($es_propietario) {
                            $show_vender = true;
                            $show_alquilar = true;
                            $alquilar_last = true;
                        }
                        @endphp

                        <div class="d-flex flex-column">
                            <label class="text-secondary">Tipo de operación</label>
                            <div class="btn-group" role="group">

                                {{-- vender --}}
                                <input type="radio" x-model="tipo_operacion" id="vender" autocomplete="off" value="1" required 
                                class="btn-check
                                    @if (!$show_vender) d-none @endif
                                ">
                                <label for="vender" 
                                class="btn btn-outline-secondary button-filter
                                    @if (!$show_vender) d-none @endif
                                    @if ($vender_last) rounded-end @endif
                                ">Vender</label>

                                {{-- alquilar --}}
                                <input type="radio" x-model="tipo_operacion" id="alquilar" autocomplete="off" value="2" required 
                                class="btn-check
                                    @if (!$show_alquilar) d-none @endif
                                ">
                                <label for="alquilar" 
                                class="btn btn-outline-secondary button-filter
                                    @if (!$show_alquilar) d-none @endif
                                    @if ($alquilar_last) rounded-end @endif
                                ">Alquilar</label>

                                {{-- rematar --}}
                                <input type="radio" x-model="tipo_operacion" id="rematar" autocomplete="off" value="3" required
                                class="btn-check
                                    @if (!$show_rematar) d-none @endif
                                ">
                                <label for="rematar" 
                                class="btn btn-outline-secondary button-filter
                                    @if (!$show_rematar) d-none @endif
                                    @if ($rematar_last) rounded @endif
                                ">Rematar</label>
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

                <!-- Paso 3: Características -->
                <div x-show="step === 3" {{-- x-init="initializeThridStep()" --}}>
                    <form @submit.prevent="nextStep(3)" class="d-flex flex-column gap-4 my-3 my-lg-5">
                        @csrf
                        <h2 class="m-0" class="m-0" class="m-0" class="m-0">Características</h2>
                        <input type="hidden" name="caracteristicas" :value="step === 3 ? 1 : 0">

                        <fieldset x-show="!perfil_acreedor">
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
                                    <label class="text-secondary" for="dormitorios">
                                        Dormitorios
                                        <span style="font-size: .75rem">(opcional)</span>
                                    </label>
                                    <input type="number" id="dormitorios" x-model="dormitorios" min="0" max="99" class="form-control">
                                </div>

                                <div class="form-group w-100">
                                    <label class="text-secondary" for="banios">
                                        Baños
                                        <span style="font-size: .75rem">(opcional)</span>
                                    </label>
                                    <input type="number" id="banios" x-model="banios" min="0" max="99" class="form-control">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between gap-4 mt-3">
                                <div class="form-group w-100">
                                    <label class="text-secondary" for="medio_banios">
                                        Medio Baño
                                        <span style="font-size: .75rem">(opcional)</span>
                                    </label>
                                    <input type="number" id="medio_banios" x-model="medio_banios" min="0" max="99" class="form-control">
                                </div>

                                <div class="form-group w-100">
                                    <label class="text-secondary" for="estacionamiento">
                                        Estacionamientos
                                        <span style="font-size: .75rem">(opcional)</span>
                                    </label>
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
                                        <input type="number" id="area_construida" x-model="area_construida" min="0" max="999999" class="form-control numeros-normales" required>
                                        <span class="input-group-text">m<sup>2</sup></span>
                                    </div>
                                </div>
                                <div class="form-group w-100">
                                    <label class="text-secondary" for="area_total">Área Total</label>
                                    <div class="input-group mb-3">
                                        <input type="number" id="area_total" x-model="area_total" min="0" max="999999" class="form-control numeros-normales" required>
                                        <span class="input-group-text">m<sup>2</sup></span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Antigüedad</legend>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" x-model="antiguedad" id="estreno" value="1" required>
                                <label class="form-check-label" for="estreno">
                                    Estreno
                                </label>
                            </div>

                            <div class="d-flex align-items-center justify-content-between my-2">

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" x-model="antiguedad" id="antiguedad" value="2" required>
                                    <label class="form-check-label" for="antiguedad">
                                        Años de antigüedad
                                    </label>
                                </div>

                                <div class="form-group" x-show="antiguedad === '2'">
                                    <div class="input-group">
                                        <input type="number" x-model="anios_antiguedad" min="0" max="99" class="form-control border-black" :required="antiguedad === '2'">
                                    </div>
                                </div>

                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" x-model="antiguedad" id="construccion" value="0" required>
                                <label class="form-check-label" for="construccion">
                                    En construcción
                                </label>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>
                                Precio
                                <span style="font-size: .75rem">(Debe registrar mínimo un precio.)</span>
                            </legend>

                            <div class="d-flex justify-content-between gap-4">
                                {{-- Precios para alquiler o venta --}}
                                <div class="form-group w-100" x-show="!perfil_acreedor">
                                    <label class="text-secondary" for="precio_soles">Precio soles</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">S/</span>
                                        <input 
                                            type="text"
                                            id="precio_soles"
                                            x-model="precio_soles" 
                                            class="form-control"
                                            @input="formatAmount('precio_soles')"
                                            @blur="formatAmount('precio_soles', true)"
                                            :required="!precio_soles && !precio_dolares && notVisible"
                                        >
                                    </div>
                                </div>

                                <div class="form-group w-100" x-show="!perfil_acreedor">
                                    <label class="text-secondary" for="precio_dolares">Precio dólares</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">US$</span>
                                        <input 
                                            type="text" 
                                            id="precio_dolares" 
                                            x-model="precio_dolares" 
                                            class="form-control" 
                                            @input="formatAmount('precio_dolares')" 
                                            @blur="formatAmount('precio_dolares', true)" 
                                            :required="!precio_soles && !precio_dolares && notVisible"
                                        >
                                    </div>
                                </div>

                                {{-- Precios para remate --}}
                                <div class="form-group w-100" x-show="perfil_acreedor">
                                    <label class="text-secondary" for="base_remate">Base de Remate</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">US$</span>
                                        <input 
                                            type="text" 
                                            id="base_remate" 
                                            x-model="base_remate" 
                                            class="form-control" 
                                            @input="formatAmount('base_remate')" 
                                            @blur="formatAmount('base_remate', true)" 
                                            :required="isVisible">
                                    </div>
                                </div>

                                <div class="form-group w-100" x-show="perfil_acreedor">
                                    <label class="text-secondary" for="valor_tasacion">Valor de Tasación</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">US$</span>
                                        <input 
                                            type="text" 
                                            id="valor_tasacion" 
                                            x-model="valor_tasacion" 
                                            class="form-control" 
                                            @input="formatAmount('valor_tasacion')" 
                                            @blur="formatAmount('valor_tasacion', true)" 
                                            :required="isVisible"
                                        >
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        {{-- Detalles del remate --}}
                        <fieldset x-show="perfil_acreedor">
                         
                            <legend>Detalles del Remate</legend>
                            

                            <div class=" d-flex flex-column gap-3">
                                <div>
                                    <label class="text-secondary" for="direccion_remate">
                                        Dirección del Remate
                                        <span style="font-size: .75rem">(opcional)</span>
                                        <span
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            data-bs-custom-class="custom-tooltip" 
                                            data-bs-title="Puede autocompletar la dirección del centro de arbitraje"
                                        >
                                            <i class="fa-solid fa-circle-info ms-2"></i>
                                        </span>

                                    </label>
                                    <div class="input-group">
                                        <input type="text" id="direccion_remate" x-model="direccion_remate" class="form-control">
                                        <button 
                                            class="btn btn-outline-secondary dropdown-toggle" 
                                            type="button" 
                                            data-bs-toggle="dropdown" 
                                            aria-expanded="false"
                                        >Arbitraje</button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li class="dropdown-item" type="button" @click=" selectDireccionRemate(2) ">CACLI</li>
                                            <li class="dropdown-item" type="button" @click=" selectDireccionRemate(3) ">CAFI</li>
                                            <li class="dropdown-item" type="button" @click=" selectDireccionRemate(4) ">REMAJU</li>
                                            <li class="dropdown-item" type="button" @click=" selectDireccionRemate(1) ">Otros</li>
                                        </ul>
                                    </div>
                                    <label class="text-secondary mt-2" for="direccion_remate">
                                        Nombre del centro de arbitraje
                                        <span style="font-size: .75rem">(opcional)</span>
                                    </label>
                                    <input type="text" id="remate_nombre_centro" x-model="remate_nombre_centro" class="form-control">
                                </div>
    
                                <div class="form-group w-100">
                                    <label class="text-secondary" for="partida_registral">
                                        Partida Registral
                                        <span style="font-size: .75rem">(opcional)</span>
                                    </label>
                                    <input type="text" id="partida_registral" x-model="partida_registral" class="form-control">
                                </div>
    
                                <div class="d-flex justify-content-between gap-4">
                                    <div class="form-group w-100">
                                        <label class="text-secondary" for="fecha_remate">
                                            Fecha del Remate
                                            <span style="font-size: .75rem">(opcional)</span>
                                        </label>
                                        <input type="date" id="fecha_remate" x-model="fecha_remate" class="form-control">
                                    </div>
                                    <div class="form-group w-100">
                                        <label class="text-secondary" for="hora_remate">
                                            Hora del Remate
                                            <span style="font-size: .75rem">(opcional)</span>
                                        </label>
                                        <input type="time" id="hora_remate" x-model="hora_remate" min="07:00" max="22:00" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group w-100">
                                    <label class="text-secondary" for="contacto_remate">
                                        Nombre del Contacto
                                        <span style="font-size: .75rem">(opcional)</span>    
                                    </label>
                                    <input type="text" id="contacto_remate" x-model="contacto_remate" class="form-control">
                                </div>
    
                                <div class="form-group w-100">
                                    <label class="text-secondary" for="telefono_contacto_remate">
                                        Teléfono del Contacto
                                        <span style="font-size: .75rem">(opcional)</span>
                                    </label>
                                    <input type="phone" id="telefono_contacto_remate" x-model="telefono_contacto_remate" class="form-control phone">
                                </div>

                                <div class="form-group w-100">
                                    <label class="text-secondary" for="correo_contacto_remate">
                                        Correo del Contacto
                                        <span style="font-size: .75rem">(opcional)</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">@</span>
                                        <input type="email" class="form-control" id="correo_contacto_remate" x-model="correo_contacto_remate">
                                    </div>
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
                    <form @submit.prevent="nextStep(4)" enctype="multipart/form-data" class="d-flex flex-column gap-4 my-3 my-lg-5">
                        @csrf
                        <h2 class="m-0" class="m-0" class="m-0">Multimedia</h2>
                        <input type="hidden" name="multimedia" :value="step === 4 ? 1 : 0">

                        <!-- Input para la imagen principal -->
                        <div class="form-group">
                            <label for="imagen_principal" class="form-label text-secondary">Imagen Principal</label>
                            <input type="file" accept="image/*" id="imagen_principal" class="form-control" @change="handleFiles($event, 'imagen_principal')">
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
                            <label for="images" class="form-label text-secondary">
                                Imágenes
                                <span style="font-size: .75rem">(opcional)</span>
                            </label>
                            <input type="file" accept="image/*" id="images" class="form-control" multiple @change="handleFiles($event, 'fotos')">
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
                            <label class="text-secondary">
                                Videos
                                <span style="font-size: .75rem">(opcional)</span>
                            </label>
                            <input type="file" {{-- x-model="videos" --}} class="form-control" placeholder="URL de videos" accept="video/*" @change="handleFiles($event, 'videos')">
                        </div>
                        
                        <!-- Input para seleccionar planos -->
                        <div class="form-group">
                            <label for="planos" class="form-label text-secondary">
                                Planos
                                <span style="font-size: .75rem">(opcional)</span>
                            </label>
                            <input type="file" accept="image/*" id="planos" class="form-control" multiple @change="handleFiles($event, 'planos')">
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

                {{-- Toasty error subir imagen principal primero --}}
                <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
                    <div id="toastPrincipalImageError" class="toast text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-body text-center fs-5 py-lg-4" id="error-principal-image-message"></div>
                    </div>
                </div>
            </div>

            <div class="col-12 px-lg-5">

                <!-- Paso 2: Ubicación -->
                <div x-show="step === 2" x-init="initializeSecondStep()" >

                    <h2 class="m-0 mt-5">Ubicación</h2>
                    <div class="d-flex flex-column flex-lg-row gap-4">
                        <div class="w-100">
                            <form @submit.prevent="nextStep(2)" class="d-flex flex-column gap-4 my-4">
                                @csrf
                                <input type="hidden" name="ubicacion" :value="step === 2 ? 1 : 0">
        
                                <div class="form-floating">
                                    <input type="text" id="place_input" x-model="direccion" class="form-control" placeholder="Dirección" required>
                                    <label for="place_input">Dirección</label>
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
                                        <option id="valueDistrito" value="">Seleccione un Distrito</option>
                                        <template x-for="distrito in distritos" :key="distrito.id">
                                            <option :value="distrito.id" x-text="distrito.nombre"></option>
                                        </template>
                                    </select>
                                    <label for="distrito">Distrito</label>
                                </div>
                            
                                <div class="d-flex justify-content-between gap-2 w-100">
                                    <button type="button" @click="prevStep()" class="btn btn-secondary w-100">Atrás</button>
                                    <button type="submit" class="btn button-orange w-100">Continuar</button>
                                </div>
                            </form>
                        </div>
    
                        <div class="w-100 my-4">
                            <div class="form-group mb-2">
                                <label for="location-type">¿Cómo deseas mostrar la ubicación?</label>
                                <div class="d-flex">
                                    <div class="form-check mr-3" style="margin-right: 2rem">
                                        <input class="form-check-input" type="radio" x-model="es_exacta" name="es_exacta" id="exact" value="1" checked>
                                        <label class="form-check-label" for="exact">
                                            Dirección exacta
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" x-model="es_exacta" name="es_exacta" id="approximate" value="0">
                                        <label class="form-check-label" for="approximate">
                                            Dirección aproximada
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- inyecta el mapa de google maps --}}
                            <div id="map" style="max-width: 600px; width: 100%; height: 600px"></div>
                            <input type="hidden" x-model="latitude" name="latitude">
                            <input type="hidden" x-model="longitude" name="longitude">
                        </div>
                    </div>
                </div>

                <!-- Paso 5: Comodidades -->
                <div x-show="step === 5" x-init="initializeQuintoStep(2)">
                    <form @submit.prevent="nextStep(5)" class="d-flex flex-column gap-4 my-3 my-lg-5">
                        @csrf
                        <div>
                            <h2 class="m-0" class="m-0">Comodidades</h2>
                            <input type="hidden" name="adicionales" :value="step === 5 ? 1 : 0">

                            <div class="row" x-show="!perfil_acreedor">
                                <template x-for="extra in extras" :key="extra.id">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-check my-2">
                                            <input class="form-check-input" type="checkbox" name="options[]" :id="'add_' + extra.id" :value="extra.id">
                                            <label class="form-check-label text-secondary filter-additional-input" :for="'add_' + extra.id">
                                                <i :class="'fa-solid ' + extra.icono + ' icon-orange mx-2'"></i>
                                                <span x-text="extra.caracteristica"></span>
                                            </label>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <div class="mt-4" x-show="perfil_acreedor">
                                <p>La propiedad en remate no tiene comodidades. Por favor continue.</p>
                            </div>
                            
                        </div>
                        <div class="d-flex justify-content-between gap-2 crear-aviso-buttons-extras">
                            <button type="button" @click="prevStep()" class="btn btn-secondary w-100">Atrás</button>
                            <button type="submit" class="btn button-orange w-100">Continuar</button>
                        </div>
                    </form>
                </div>

                <!-- Paso 6: Adicionales -->
                <div x-show="step === 6" x-init="initializeSextoStep(1)">
                    <form @submit.prevent="nextStep(6)" class="d-flex flex-column gap-4 my-3 my-lg-5">
                        @csrf
                        <div>
                            <h2 class="m-0">Adicionales</h2>
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

                        <div class="d-flex justify-content-between gap-2 crear-aviso-buttons-extras">
                            <button type="button" @click="prevStep()" class="btn btn-secondary w-100">Atrás</button>
                            <button type="submit" class="btn btn-success w-100">Guardar y Publicar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const $loaderOverlay = document.getElementById('loader-overlay');
        const defaultLocation = {lat: -12.09706477059002, lng: -77.02302118294135}; // Coordenadas iniciales de ejemplo
        const mapDiv = document.getElementById("map");
        let input = document.getElementById("place_input");
        let map;
        let marker;
        let circle;
        let autocomplete;
        let lat_inmueble;
        let lng_inmueble;
        let geocoder;

        document.addEventListener('DOMContentLoaded', function () {
            const $inputFields = document.querySelectorAll('.numeros-normales');

            $inputFields.forEach(function(inputField) {
                inputField.addEventListener('input', function () {
                    const regex = /^[1-9][0-9]{0,7}$/; // Permite hasta 8 dígitos, el primero debe ser del 1 al 9

                    // Si el valor del campo no coincide con la expresión regular, lo truncamos
                    if (!regex.test(inputField.value)) {
                        inputField.value = inputField.value.slice(0, 8).replace(/^0+/, '');
                    }
                });
            });
        });

        function initMap() {

            // Definir los estilos para ocultar POI (puntos de interés) y otros elementos.
            const mapStyles = [
                {
                    featureType: "poi", // Puntos de interés
                    stylers: [{ visibility: "off" }] // Ocultar POI
                },
                {
                    featureType: "transit.station", // Paraderos de buses, metro, etc.
                    stylers: [{ visibility: "off" }] // Ocultar estaciones de transporte
                }
            ];

            map = new google.maps.Map(mapDiv, {
                center: defaultLocation,
                zoom: 14,
                styles: mapStyles,
            });

            geocoder = new google.maps.Geocoder();

            marker = new google.maps.Marker({
                map: map,
                draggable: true, // Permite arrastrar el marcador
                icon: {
                    url: "/images/svg/marker_puja.svg",
                    scaledSize: new google.maps.Size(80, 80), // Ajusta el tamaño del logo
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(40, 80)  // Ajusta el punto de anclaje
                }
            });

            circle = new google.maps.Circle({
                strokeColor: "#fb7125",
                strokeOpacity: 0,
                strokeWeight: 2,
                fillColor: "#fb7125",
                fillOpacity: 0.35,
                map: null,
                center: defaultLocation,
                radius: 500,
            });

            initAutocomplete();

            map.addListener('click', (event) => {
                const clickedLocation = event.latLng;
                
                lat_inmueble = clickedLocation.lat();
                lng_inmueble = clickedLocation.lng();

                updateMapElements(clickedLocation);
            });

            marker.addListener('dragend', () => {
                const newPosition = marker.getPosition();
                lat_inmueble = newPosition.lat();
                lng_inmueble = newPosition.lng();

                geocoder.geocode({'location': newPosition}, (results, status) => {
                    if (status === 'OK' && results[0]) {
                        let cadena = results[0].formatted_address;
                        
                        let ultimaComa = cadena.lastIndexOf(",");
                        if (ultimaComa !== -1) {
                            let penultimaComa = cadena.lastIndexOf(",", ultimaComa - 1);
                            let cortarHasta = (penultimaComa !== -1) ? penultimaComa : ultimaComa;
                            cadena = cadena.substring(0, cortarHasta);
                        }
                        input.value = cadena;
                    } else {
                        input.value = 'Dirección no encontrada';
                    }
                });
            });

            document.getElementById('exact').addEventListener('change', () => updateMapElements(marker.getPosition()));
            document.getElementById('approximate').addEventListener('change', () => updateMapElements(marker.getPosition()));
        }

        function initAutocomplete() {
            autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener("place_changed", () => {
                const place = autocomplete.getPlace();
                map.setCenter(place.geometry.location);

                lat_inmueble = place.geometry.location.lat();
                lng_inmueble = place.geometry.location.lng();

                updateMapElements(place.geometry.location);
            });
        }

        function updateMapElements(location) {
            const isExact = document.getElementById('exact').checked;

            if (isExact) {
                marker.setPosition(location);
                marker.setMap(map);
                circle.setMap(null); // Ocultar el círculo si está visible
            } else {
                circle.setCenter(location);
                circle.setMap(map);
                marker.setMap(null); // Ocultar el marcador si está visible
            }

            geocoder.geocode({'location': location}, (results, status) => {
                if (status === 'OK' && results[0]) {
                    let cadena = results[0].formatted_address;
                    
                    let ultimaComa = cadena.lastIndexOf(",");
                    if (ultimaComa !== -1) {
                        let penultimaComa = cadena.lastIndexOf(",", ultimaComa - 1);
                        let cortarHasta = (penultimaComa !== -1) ? penultimaComa : ultimaComa;
                        cadena = cadena.substring(0, cortarHasta);
                    }
                    input.value = cadena;
                } else {
                    input.value = 'Dirección no encontrada';
                }
            });
        }

        function extractLocationComponents(addressComponents) {
            let direccion = '';
            let numeroDireccion = '';

            addressComponents.forEach(component => {
                if (component.types.includes('street_number')) {
                    numeroDireccion = component.long_name;
                }
                if (component.types.includes('route')) {
                    direccion = component.long_name;
                }
            });

            return {
                direccion,
                numeroDireccion
            };
        }

        function avisoForm() {
            return {
                    step: {{ session('step', 1) }},
                    aviso_id: {{ session('aviso_id', 'null') }},

                    perfil_acreedor: @json($es_acreedor),

                    is_puja: false,

                    // el campo es visible cuando es requerido
                    isVisible: false,
                    notVisible: true,
                    
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
                    extras3: [],
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
                    remate_nombre_centro: '',
                    remate_direccion_id: 1,
                    partida_registral: '',
                    fecha_remate: '',
                    hora_remate: '',
                    contacto_remate: '',
                    telefono_contacto_remate: '',
                    correo_contacto_remate: '',

                    map: null,
                    marker: null,
                    es_exacta: 1,
                    latitude: null,
                    longitude: null,

                selectDireccionRemate(val) {
                    const $direccion_remate = document.getElementById("direccion_remate")
                    const $remate_nombre_centro = document.getElementById("remate_nombre_centro")
                    $direccion_remate.disabled = true;
                    $remate_nombre_centro.disabled = true;
                    if ( val === 1 ) {
                        this.remate_direccion_id = val
                        this.direccion_remate = ""
                        $direccion_remate.disabled = false;
                        this.remate_nombre_centro = ""
                        $remate_nombre_centro.disabled = false;
                    } else if ( val === 2 ) {
                        this.remate_direccion_id = val
                        this.direccion_remate = "Av. Arequipa 330, oficina 907, Cercado de Lima"                        
                        this.remate_nombre_centro = "Centro de arbitraje comercial Lima"
                    } else if ( val === 3 ) {
                        this.remate_direccion_id = val
                        this.direccion_remate = "Av. Diez Canseco 442, oficina 202, Miraflores"                        
                        this.remate_nombre_centro = "Centro de arbitraje financiero Inmobiliario"
                    } else if ( val === 4 ) {
                        this.remate_direccion_id = val
                        this.direccion_remate = "Remate Virtual"                        
                        this.remate_nombre_centro = "Remate electrónico judicial"
                    }
                },

                formatAmount(modelName, final = false) {
                    // Remover todos los caracteres no numéricos
                    let numericValue = this[modelName].replace(/\D/g, '');

                    // Limitar a un máximo de 10 caracteres numéricos
                    if (numericValue.length > 10) {
                        numericValue = numericValue.slice(0, 10);
                    }

                    if (numericValue === '' || parseInt(numericValue) === 0) {
                        this[modelName] = '';
                        return;
                    }

                    // Convertir a número y formatear con separador de miles
                    let formattedValue = parseInt(numericValue).toLocaleString('en-US');

                    // Actualizar el valor del input
                    this[modelName] = formattedValue;
                },

                init() {

                    if ({{ $show_rematar ? 'true' : 'false' }} && !{{ $show_vender ? 'true' : 'false' }} && !{{ $show_alquilar ? 'true' : 'false' }}) {
                        this.tipo_operacion = 3; 
                    };

                    this.$watch('tipo_operacion', value => {
                        if (value == 3) {
                            this.is_puja = false;
                        }
                    });

                    if(this.perfil_acreedor) {
                        this.isVisible = true;
                        this.notVisible = false;
                    }

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
                    if (this.perfil_acreedor) {
                        this.fetchExtras(3);
                    } else {
                        this.fetchExtras(extra_id);
                    }
                },

                nextStep(step) {
                    // Div para mostrar errores (clean)
                    const $errorContainer = document.getElementById('error-container');
                    $errorContainer.innerHTML = '';
                    // spinner
                    $loaderOverlay.style.display = 'flex';
                    document.body.style.pointerEvents = 'none';

                    const stepMap = {
                        1: `/my-post/store`,
                        2: `/my-post/store`,
                        3: `/my-post/store`,
                        4: `/my-post/store`,
                        6: `/my-post/store`,
                    }

                    if (step === 5) /* Extras 1 */ {
                        this.step++
                        $loaderOverlay.style.display = 'none';
                        document.body.style.pointerEvents = 'auto';
                    } else if (step === 6) /* Extras 2 */ {
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
                            formData.append('direccion', input.value)
                            formData.append('departamento_id', this.selectedDepartamento)
                            formData.append('provincia_id', this.selectedProvincia)
                            formData.append('distrito_id', this.selectedDistrito)
                            formData.append('ubicacion', 1)
                            formData.append('es_exacta', this.es_exacta)
                            formData.append('latitud', lat_inmueble)
                            formData.append('longitud', lng_inmueble)
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
                            formData.append('remate_direccion_id', this.remate_direccion_id)
                            formData.append('remate_direccion', this.direccion_remate)
                            formData.append('remate_nombre_centro', this.remate_nombre_centro)
                            formData.append('remate_fecha', this.fecha_remate)
                            formData.append('remate_hora', this.hora_remate)
                            formData.append('remate_nombre_contacto', this.contacto_remate)
                            formData.append('remate_telef_contacto', this.telefono_contacto_remate)
                            formData.append('remate_correo_contacto', this.correo_contacto_remate)

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
                        // .then(response => response.json())
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(errorData => {
                                    throw errorData;
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.codigo_unico) {
                                this.codigo_unico = data.codigo_unico
                            }

                            console.log(this.codigo_unico);
                            

                            if (step === 1) {
                                this.aviso_id = data.id
                            }

                            this.step++
                            
                            
                        })
                        .catch(error => {

                            if (step === 4 && error.message_error) {

                                document.getElementById('error-principal-image-message').innerText = error.message_error;
                                triggerToastPrincipalImageError()

                            } else {
                                console.error('Error: ', error)
                            }
                        })
                        .finally(() => {
                            this.hideLoader();
                        });
                    }
                },  

                hideLoader() {
                    setTimeout(() => {
                        $loaderOverlay.style.display = 'none';
                        document.body.style.pointerEvents = 'auto';
                    }, 300);
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
                        
                        if( extra_id === 2 ) {
                            this.extras = data;
                        } else if( extra_id === 1 ) {
                            this.extras2 = data;
                        } else if( extra_id === 3) {
                            this.extras2 = data;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching distritos:', error);
                    });
                },
            }
        }

        window.showModal = @json($show_modal);
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuCCuPnZoJYgILw9e3PNom-ZG5TnsGNeg&libraries=places&callback=initMap" async defer></script>

@endsection

@push('scripts')
  @vite([ 'resources/js/scripts/updatePlaceholdersRegister.js', 'resources/js/scripts/toastyImagenPrincipalError.js' ])
@endpush
