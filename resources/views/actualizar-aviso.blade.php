@extends('layouts.app')

@section('title')
    Crear tu Aviso
@endsection

@push('styles')
    @vite(['resources/sass/pages/crear-aviso.scss'])
@endpush

@section('content')
    <div x-data="avisoForm( {{ $inmueble }}, {{ $op_inmueble }}, {{ $ubi_inmueble }}, {{ $caract_inmueble_id }}, {{ $mult_inmueble }}, {{ $imgs_inmueble }}, {{ $videos_inmueble }}, {{ $planos_inmueble }}, {{ $extra_carac_inmueble }} )" x-init="initialize()" {{-- x-cloak x-effect="checkStep()"  --}}class="">

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
                    <span class="d-none d-lg-inline">. Adicionales</span>
                </div>
                <div :class="{ 'text-primary': step === 6 }" class="crear-aviso-menu-paso">
                    <span>6</span>
                    <span class="d-none d-lg-inline">. Comodidades</span>
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
                                <label class="btn btn-outline-secondary button-filter" for="alquilar">Alquilar</label>

                                <input type="radio" class="btn-check" x-model="tipo_operacion" id="rematar" autocomplete="off" value="3" required>
                                <label class="btn btn-outline-secondary button-filter" for="rematar">Rematar</label>
                            </div>
                        </div>

                        <div class="form-floating" x-init="fetchSubtipos()">
                            <select x-model="selectedSubtipo" class="form-select" id="tipoinmueble" required>
                                <option value="">Selecciona un subtipo</option>
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

                        <div class="d-flex justify-content-between gap-2 w-100">
                            <button type="button" @click="prevStep()" class="btn btn-secondary w-100">Atrás</button>
                            <button type="submit" class="btn button-orange w-100">Continuar</button>
                        </div>
                    </form>
                </div>

                <!-- Paso 3: Características -->
                <div x-show="step === 3">
                    <form @submit.prevent="nextStep(3)" class="d-flex flex-column gap-4 my-5">
                        @csrf
                        <h2>Características</h2>
                        <input type="hidden" name="caracteristicas" :value="step === 3 ? 1 : 0">

                        <fieldset>
                        <legend>Características Principales</legend>

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
                                <div class="form-group w-100">
                                    <label class="text-secondary" for="precio_soles">Precio soles</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">S/.</span>
                                        <input type="number" id="precio_soles" x-model="precio_soles" min="99" max="999999999" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group w-100">
                                    <label class="text-secondary" for="precio_dolares">Precio dólares</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">US$</span>
                                        <input type="number" id="precio_dolares" x-model="precio_dolares" min="99" max="99999999" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        {{-- <fieldset>
                            <legend>Describe el inmueble</legend>
                            <div class="form-floating mb-3">
                                <input type="text" id="titulo" x-model="titulo" class="form-control" placeholder="Título del aviso" required>
                                <label for="titulo">Título del aviso</label>
                            </div>

                            <div class="form-floating mb-2">
                                <textarea class="form-control" placeholder="Descripción del aviso" x-model="description" id="description" rows="8" cols="50" style="with: 100%; height: 100px;"></textarea>
                                <label for="description">Descripción del aviso</label>
                            </div>
                        </fieldset> --}}

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

                        <div id="image-container">
                            <template x-if="main_img_init">
                                <div>
                                    <img :src="main_img_init" alt="Current Image">
                                    <button type="button" class="btn btn-danger btn-sm mt-2" @click="eliminarImagen('main_img_init')">Eliminar</button>
                                </div>
                            </template>
                        </div>
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

                        <div id="video-container">
                            <template x-if="video_init">
                                <div>
                                    <video width="320" height="240" controls autoplay>
                                        <source :src="video_init" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <button type="button" class="btn btn-danger btn-sm mt-2" @click="eliminarImagen('video_init')">Eliminar</button>
                                    {{-- <button @click="deleteVideo">Delete Video</button> --}}
                                </div>
                            </template>
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

                <!-- Paso 5: Adicionales -->
                <div x-show="step === 5" x-init="initializeQuintoStep(1)">
                    <form @submit.prevent="nextStep(5)" class="d-flex flex-column gap-4 my-5">
                        @csrf
                        <div class="mt-4">
                            <h2>Adicionales</h2>
                            <input type="hidden" name="adicionales" :value="step === 5 ? 1 : 0">

                            <div>
                                <template x-for="extra in extras" :key="extra.id">
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" name="options[]" :id="'add_' + extra.id" :value="extra.id">
                                        <label class="form-check-label" :for="'add_' + extra.id">
                                            <i :class="'fa-solid ' + extra.icono + ' icon-orange mx-2'"></i>
                                            <span x-text="extra.caracteristica"></span>
                                        </label>
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

                <!-- Paso 6: Comodidades -->
                <div x-show="step === 6" x-init="initializeSextoStep(2)">
                    <form @submit.prevent="nextStep(6)" class="d-flex flex-column gap-4 my-5">
                        @csrf
                        <div class="mt-4">
                            <h2>Comodidades</h2>
                            <input type="hidden" name="comodidades" :value="step === 6 ? 1 : 0">
                            <div>
                                <template x-for="extra in extras2" :key="extra.id">
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="checkbox" name="options[]" :value="extra.id" :id="'add_' + extra.id">
                                        <label class="form-check-label text-secondary filter-additional-input" :for="'add_' + extra.id">
                                            <i :class="'fa-solid ' + extra.icono + ' icon-orange mx-2'"></i>
                                            <span x-text="extra.caracteristica"></span>
                                        </label>
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
        function avisoForm(inmueble, op_inmueble, ubi_inmueble, caract_inmueble_id, mult_inmueble, imgs_inmueble, videos_inmueble, planos_inmueble, extra_carac_inmueble) {
            return {
                step: {{ session('step', 1) }},
                aviso_id: {{ session('aviso_id', 'null') }},
                
                tipo_operacion: op_inmueble.tipo_operacion_id,
                subtipos: [],
                selectedSubtipo: '',
                titulo: '',
                description: '',

                direccion: ubi_inmueble.direccion,
                departamentos: [],
                provincias: [],
                distritos: [],
                selectedDepartamento: "",
                selectedProvincia: "",
                selectedDistrito: "",

                main_img_init: mult_inmueble.imagen_principal,
                video_init: videos_inmueble.video,

                extras: [],
                extras2: [],
                adicionales: [],
                comodidades: [],

                fotos: [],
                imagen_principal: null,
                videos: null,
                planos: [],
                dormitorios: caract_inmueble_id.habitaciones,
                banios: caract_inmueble_id.banios,
                medio_banios: caract_inmueble_id.medio_banios,
                estacionamiento: caract_inmueble_id.estacionamientos,
                area_construida: caract_inmueble_id.area_construida,
                area_total: caract_inmueble_id.area_total,
                antiguedad: caract_inmueble_id.antiguedad,
                anios_antiguedad: caract_inmueble_id.anios_antiguedad,
                precio_soles: caract_inmueble_id.precio_soles,
                precio_dolares: caract_inmueble_id.precio_dolares,

                acceso_playa: false,
                aire_acondicionado: false,
                acceso_parque: false,
                ascensores: false,
                codigo_unico: inmueble.codigo_unico,

                initialize() {
                    console.log("videos", videos_inmueble);
                },
                initializeSecondStep() {
                    this.get_ubicacion()
                },
                initializeQuintoStep(extra_id) {
                    this.fetchExtras(extra_id);
                },
                initializeSextoStep(extra_id) {
                    this.fetchExtras(extra_id);
                },
                nextStep(step) {
                    const stepMap = {
                        1: '/my-post/store',
                        2: `/my-post/store`,
                        3: `/my-post/store`,
                        4: `/my-post/store`,
                        6: `/my-post/store`,
                    }

                    if (step === 5) /* Extras 1 */ {
                        this.fetchExtras(1);
                        this.step++
                    } else if (step === 6) /* Extras 2 */ {
                        this.fetchExtras(2);
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
                            formData.append('codigo_unico', this.codigo_unico)
                        } else if (step === 3) /* Caracteristicas */ {
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
                    } else if (type === 'main_img_init') {
                        this.main_img_init = null
                    } else if (type === 'videos') {
                        this.videos = null
                    } else if (type === 'video_init') {
                        this.video_init = null
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
                            this.selectedSubtipo = op_inmueble.subtipo_inmueble_id;
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
                async get_ubicacion() {
                    try {
                        // Primera llamada para obtener los departamentos
                        let response = await fetch('/my-post/ubicacion/departamentos');
                        let data = await response.json();
                        this.departamentos = data.departamentos;
                        // console.log("GET UBI DEPA", this.departamentos);
                        
                        // Segunda llamada para obtener las provincias basadas en el departamento seleccionado
                        response = await fetch(`/my-post/ubicacion/provincias/${ubi_inmueble.departamento_id}`);
                        data = await response.json();
                        this.provincias = data;
                        // console.log("GET UBI PROV", this.provincias);
                        
                        // Tercera llamada para obtener los distritos basados en la provincia seleccionada
                        response = await fetch(`/my-post/ubicacion/distritos/${ubi_inmueble.provincia_id}`);
                        data = await response.json();
                        this.distritos = data;
                        // console.log("GET UBI DIST", this.distritos);
                        
                        // Actualizar las propiedades seleccionadas
                        this.selectedDepartamento = ubi_inmueble.departamento_id;
                        this.selectedProvincia = ubi_inmueble.provincia_id;
                        this.selectedDistrito = ubi_inmueble.distrito_id;
                    } catch (error) {
                        console.error('Error fetching ubicacion:', error);
                    }
                },
                fetchExtras(extra_id) {
                    fetch(`/my-post/extras/${extra_id}`)
                    .then(response => response.json())
                    .then(data => {
                        if( extra_id== 1 ){
                            this.extras = data;
                        } else if( extra_id== 2 ){
                            this.extras2 = data;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching distritos:', error);
                    });
                },
            }
        }
    </script>

@endsection