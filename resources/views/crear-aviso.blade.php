@extends('layouts.app')

@section('title')
  Crear tu Aviso
@endsection

@push('styles')
  @vite(['resources/sass/pages/crear-aviso.scss'])
@endpush

@section('content')
  <div x-data="avisoForm()" class="">

    <!-- Menú de los pasos -->
    <div class="py-2 py-lg-4 bg-body-tertiary border-bottom">
      <div class="d-flex justify-content-around fw-semibold text-light-emphasis">
        <div :class="{ 'text-primary': step === 1 }" class="crear-aviso-menu-paso"><span>1</span><span
            class="d-none d-lg-inline">. Operación y tipo de inmueble</span></div>
        <div :class="{ 'text-primary': step === 2 }" class="crear-aviso-menu-paso"><span>2</span><span
            class="d-none d-lg-inline">. Ubicación</span></div>
        <div :class="{ 'text-primary': step === 3 }" class="crear-aviso-menu-paso"><span>3</span><span
            class="d-none d-lg-inline">. Características</span></div>
        <div :class="{ 'text-primary': step === 4 }" class="crear-aviso-menu-paso"><span>4</span><span
            class="d-none d-lg-inline">. Multimedia</span></div>
        <div :class="{ 'text-primary': step === 5 }" class="crear-aviso-menu-paso"><span>5</span><span
            class="d-none d-lg-inline">. Adicionales</span></div>
        <div :class="{ 'text-primary': step === 6 }" class="crear-aviso-menu-paso"><span>6</span><span
            class="d-none d-lg-inline">. Comodidades</span></div>
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
                <input type="radio" class="btn-check" x-model="tipo_operacion" id="vender" autocomplete="off"
                  value="1" required>
                <label class="btn btn-outline-secondary button-filter" for="vender">Vender</label>

                <input type="radio" class="btn-check" x-model="tipo_operacion" id="alquilar" autocomplete="off"
                  value="2" required>
                <label class="btn btn-outline-secondary button-filter" for="alquilar">Alquilar</label>

                <input type="radio" class="btn-check" x-model="tipo_operacion" id="rematar" autocomplete="off"
                  value="3" required>
                <label class="btn btn-outline-secondary button-filter" for="rematar">Rematar</label>
              </div>
            </div>

            <div class="form-floating">
              <select x-model="tipo_inmueble" class="form-select" id="tipoinmueble" required>
                <option selected></option>
                <option value="1">Casa de playa</option>
                <option value="2">Casa de campo</option>
                <option value="3">Casa de ciudad</option>
                <option value="4">Casa en condominio</option>
                <option value="5">Casa en quinta</option>
                <option value="6">Departamento de campo</option>
                <option value="7">Departamento de ciudad</option>
                <option value="8">Departamento de playa</option>
                <option value="9">Departamento Loft</option>
                <option value="10">Departamento PentHouse</option>
                <option value="11">Minidepartamento</option>
                <option value="12">Terreno lote</option>
                <option value="13">Terreno agricola</option>
                <option value="14">Local comercial</option>
                <option value="15">Local industrial</option>
              </select>
              <label for="tipoinmueble">Tipo de inmueble</label>
            </div>

            <button type="submit" class="btn button-orange w-100">Continuar</button>
          </form>
        </div>

        <!-- Paso 2: Ubicación -->
        <div x-show="step === 2">
          <form @submit.prevent="nextStep(2)" class="d-flex flex-column gap-4 my-5">
            @csrf
            <h2>Ubicación</h2>
            <input type="hidden" name="ubicacion" :value="step === 2 ? 1 : 0">

            <div class="form-floating">
              <input type="text" id="direccion" x-model="direccion" class="form-control" placeholder="Dirección" required>
              <label for="direccion">Dirección</label>
            </div>

            <div class="form-floating">
              <select x-model="departamento" class="form-select" id="departamento" required>
                <option selected>Seleccione Departamento</option>
                <option value="1">Lima</option>
                <option value="2">Lima Provincias</option>
                <option value="3">Trujillo</option>
                <option value="4">Cusco</option>
                <option value="5">Chiclayo</option>
                <option value="6">Arequipa</option>
              </select>
              <label for="departamento">Departamento</label>
            </div>

            <div class="form-floating">
              <select x-model="provincia" class="form-select" id="provincia" required>
                <option selected>Seleccione Provincia</option>
                <option value="101">Lima</option>
                <option value="102">Barranca</option>
                <option value="103">Cajatambo</option>
                <option value="104">Canta</option>
                <option value="105">Cañete</option>
                <option value="106">Huaral</option>
                <option value="107">Huarochiri</option>
                <option value="108">Huaura</option>
                <option value="109">Oyón</option>
                <option value="110">Yauyos</option>
              </select>
              <label for="provincia">Provincia</label>
            </div>

            <div class="form-floating">
              <select x-model="distrito" class="form-select" id="distrito" required>
                <option selected>Seleccione Distrito</option>
                <option value="10101">Ancón</option>
                <option value="10102">Ate</option>
                <option value="10103">Barranco</option>
                <option value="10104">Breña</option>
                <option value="10105">Carabayllo</option>
                <option value="10106">Chaclacayo</option>
                <option value="10107">Chorrillos</option>
                <option value="10108">Cieneguilla</option>
                <option value="10109">Comas</option>
                <option value="10110">El Agustino</option>
                <option value="10111">Independencia</option>
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
                    <input type="number" id="area_construida" x-model="area_construida" min="0"
                      max="999999" class="form-control" required>
                    <span class="input-group-text">m<sup>2</sup></span>
                  </div>
                </div>
                <div class="form-group w-100">
                  <label class="text-secondary" for="area_total">Área Total</label>
                  <div class="input-group mb-3">
                    <input type="number" id="area_total" x-model="area_total" min="0" max="999999"
                      class="form-control" required>
                    <span class="input-group-text">m<sup>2</sup></span>
                  </div>
                </div>
              </div>
            </fieldset>

            <fieldset>
              <legend>Antigüedad</legend>

              <div class="form-check">
                <input class="form-check-input" type="radio" x-model="antiguedad" id="estreno" value="estreno"
                  required>
                <label class="form-check-label" for="estreno">
                  Estreno
                </label>
              </div>

              <div class="d-flex align-items-center justify-content-between my-2">

                <div class="form-check">
                  <input class="form-check-input" type="radio" x-model="antiguedad" id="antiguedad"
                    value="antiguedad" required>
                  <label class="form-check-label" for="antiguedad">
                    Años de antigüedad
                  </label>
                </div>

                <div class="form-group" x-show="antiguedad === 'antiguedad'">
                  <div class="input-group">
                    <input type="number" x-model="anios_antiguedad" min="0" max="99"
                      class="form-control border" :required="antiguedad === 'antiguedad'">
                  </div>
                </div>

              </div>

              <div class="form-check">
                <input class="form-check-input" type="radio" x-model="antiguedad" id="construccion"
                  value="construccion" required>
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
                    <input type="number" id="precio_soles" x-model="precio_soles" min="99" max="999999999"
                      class="form-control" required>
                  </div>
                </div>

                <div class="form-group w-100">
                  <label class="text-secondary" for="precio_dolares">Precio dólares</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text">US$</span>
                    <input type="number" id="precio_dolares" x-model="precio_dolares" min="99" max="99999999"
                      class="form-control" required>
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
                  <img :src="URL.createObjectURL(imagen_principal)" class="img-thumbnail" style="max-width: 200px" alt="Imagen Principal">
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
                            <button type="button" class="btn btn-danger btn-sm mt-2"
                                @click="eliminarImagen('fotos', index)">Eliminar</button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Input para videos -->
            <div class="form-group">
              <label class="text-secondary">Videos</label>
              <input type="text" x-model="videos" class="form-control" placeholder="URL de videos">
            </div>

            <!-- Input para planos -->
            <div class="form-group">
              <label class="text-secondary">Planos</label>
              <input type="file" multiple class="form-control" @change="handleFiles($event, 'planos')">
            </div>

            <!-- Botones de navegación -->
            <div class="d-flex justify-content-between gap-2 w-100">
              <button type="button" @click="prevStep()" class="btn btn-secondary w-100">Atrás</button>
              <button type="submit" class="btn button-orange w-100">Continuar</button>
            </div>
          </form>
        </div>


        <!-- Paso 5: Adicionales -->
        <div x-show="step === 5">
          <form @submit.prevent="nextStep(5)" class="d-flex flex-column gap-4 my-5">
            @csrf

            <div class="mt-4">
              <h2>Adicionales</h2>
              <input type="hidden" name="adicionales" :value="step === 5 ? 1 : 0">

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="1" id="add_01">
                <label class="form-check-label text-secondary filter-additional-input" for="add_01">
                  <i class="fa-solid fa-house-flood-water icon-orange mx-2"></i>
                  Acceso a la playa
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="2" id="add_02">
                <label class="form-check-label text-secondary filter-additional-input" for="add_02">
                  <i class="fa-solid fa-snowflake icon-orange mx-2"></i>
                  Acceso al campo
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_03" id="add_03">
                <label class="form-check-label text-secondary filter-additional-input" for="add_03">
                  <i class="fa-solid fa-warehouse icon-orange mx-2"></i>
                  Almacén
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_04" id="add_04">
                <label class="form-check-label text-secondary filter-additional-input" for="add_04">
                  <i class="fa-solid fa-elevator icon-orange mx-2"></i>
                  Ascensor
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_05" id="add_05">
                <label class="form-check-label text-secondary filter-additional-input" for="add_05">
                  <i class="fa-solid fa-hand-sparkles icon-orange mx-2"></i>
                  Área de Servicio
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_06" id="add_06">
                <label class="form-check-label text-secondary filter-additional-input" for="add_06">
                  <i class="fa-solid fa-comments icon-orange mx-2"></i>
                  Áreas Comunes
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_07" id="add_07">
                <label class="form-check-label text-secondary filter-additional-input" for="add_07">
                  <i class="fa-solid fa-house-chimney-window icon-orange mx-2"></i>
                  Balcón
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_08" id="add_08">
                <label class="form-check-label text-secondary filter-additional-input" for="add_08">
                  <i class="fa-solid fa-fire icon-orange mx-2"></i>
                  Calefacción
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_09" id="add_09">
                <label class="form-check-label text-secondary filter-additional-input" for="add_09">
                  <i class="fa-solid fa-user-shield icon-orange mx-2"></i>
                  Caseta de Seguridad
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_10" id="add_10">
                <label class="form-check-label text-secondary filter-additional-input" for="add_10">
                  <i class="fa-solid fa-kitchen-set icon-orange mx-2"></i>
                  Cocina Equipada
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_11" id="add_11">
                <label class="form-check-label text-secondary filter-additional-input" for="add_11">
                  <i class="fa-solid fa-city icon-orange mx-2"></i>
                  Condominio
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_12" id="add_12">
                <label class="form-check-label text-secondary filter-additional-input" for="add_12">
                  <i class="fa-regular fa-building icon-orange mx-2"></i>
                  Dúplex
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_13" id="add_13">
                <label class="form-check-label text-secondary filter-additional-input" for="add_13">
                  <i class="fa-solid fa-tree-city icon-orange mx-2"></i>
                  Frente a Parque
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_14" id="add_14">
                <label class="form-check-label text-secondary filter-additional-input" for="add_14">
                  <i class="fa-solid fa-fire-flame-simple icon-orange mx-2"></i>
                  Gas Natural
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_15" id="add_15">
                <label class="form-check-label text-secondary filter-additional-input" for="add_15">
                  <i class="fa-solid fa-dumbbell icon-orange mx-2"></i>
                  Gimnasio
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_16" id="add_16">
                <label class="form-check-label text-secondary filter-additional-input" for="add_16">
                  <i class="fa-solid fa-bath icon-orange mx-2"></i>
                  Habitación Principal con Baño
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_17" id="add_17">
                <label class="form-check-label text-secondary filter-additional-input" for="add_17">
                  <i class="fa-solid fa-plant-wilt icon-orange mx-2"></i>
                  Jardín Interno
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_18" id="add_18">
                <label class="form-check-label text-secondary filter-additional-input" for="add_18">
                  <i class="fa-solid fa-sun-plant-wilt icon-orange mx-2"></i>
                  Jardín Externo
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_19" id="add_19">
                <label class="form-check-label text-secondary filter-additional-input" for="add_19">
                  <i class="fa-solid fa-water-ladder icon-orange mx-2"></i>
                  Jacuzzi
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_20" id="add_20">
                <label class="form-check-label text-secondary filter-additional-input" for="add_20">
                  <i class="fa-solid fa-puzzle-piece icon-orange mx-2"></i>
                  Juegos para niños
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_21" id="add_21">
                <label class="form-check-label text-secondary filter-additional-input" for="add_21">
                  <i class="fa-solid fa-calendar-week icon-orange mx-2"></i>
                  Kitchenette
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_22" id="add_22">
                <label class="form-check-label text-secondary filter-additional-input" for="add_22">
                  <i class="fa-solid fa-jug-detergent icon-orange mx-2"></i>
                  Lavandería
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_23" id="add_23">
                <label class="form-check-label text-secondary filter-additional-input" for="add_23">
                  <i class="fa-solid fa-dog icon-orange mx-2"></i>
                  Pet Friendly
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_24" id="add_24">
                <label class="form-check-label text-secondary filter-additional-input" for="add_24">
                  <i class="fa-solid fa-person-swimming icon-orange mx-2"></i>
                  Piscina
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_25" id="add_25">
                <label class="form-check-label text-secondary filter-additional-input" for="add_25">
                  <i class="fa-solid fa-faucet-drip icon-orange mx-2"></i>
                  Servicios Básicos
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_26" id="add_26">
                <label class="form-check-label text-secondary filter-additional-input" for="add_26">
                  <i class="fa-solid fa-droplet icon-orange mx-2"></i>
                  Tanque de Agua
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_27" id="add_27">
                <label class="form-check-label text-secondary filter-additional-input" for="add_27">
                  <i class="fa-solid fa-bolt icon-orange mx-2"></i>
                  Terma Eléctrica
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_28" id="add_28">
                <label class="form-check-label text-secondary filter-additional-input" for="add_28">
                  <i class="fa-solid fa-umbrella-beach icon-orange mx-2"></i>
                  Terraza
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_29" id="add_29">
                <label class="form-check-label text-secondary filter-additional-input" for="add_29">
                  <i class="fa-solid fa-building icon-orange mx-2"></i>
                  Triplex
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_30" id="add_30">
                <label class="form-check-label text-secondary filter-additional-input" for="add_30">
                  <i class="fa-solid fa-video icon-orange mx-2"></i>
                  Video Vigilancia
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="add_31" id="add_31">
                <label class="form-check-label text-secondary filter-additional-input" for="add_31">
                  <i class="fa-solid fa-door-closed icon-orange mx-2"></i>
                  Walk-in Closet
                </label>
              </div>

            </div>

            <div class="d-flex justify-content-between gap-2 w-100">
              <button type="button" @click="prevStep()" class="btn btn-secondary w-100">Atrás</button>
              <button type="submit" class="btn button-orange w-100">Continuar</button>
            </div>
          </form>
        </div>

        <!-- Paso 6: Comodidades -->
        <div x-show="step === 6">
          <form @submit.prevent="nextStep(6)" class="d-flex flex-column gap-4 my-5">
            @csrf

            <div class="mt-4">

              <h2>Comodidades</h2>
              <input type="hidden" name="comodidades" :value="step === 6 ? 1 : 0">

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="comf_01" id="comf_01">
                <label class="form-check-label text-secondary filter-additional-input" for="comf_01">
                  <i class="fa-solid fa-book icon-orange mx-2"></i>
                  Biblioteca
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="comf_02" id="comf_02">
                <label class="form-check-label text-secondary filter-additional-input" for="comf_02">
                  <i class="fa-solid fa-futbol icon-orange mx-2"></i>
                  Cancha de Fútbol
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="comf_03" id="comf_03">
                <label class="form-check-label text-secondary filter-additional-input" for="comf_03">
                  <i class="fa-solid fa-volleyball icon-orange mx-2"></i>
                  Centro Deportivo
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="comf_04" id="comf_04">
                <label class="form-check-label text-secondary filter-additional-input" for="comf_04">
                  <i class="fa-solid fa-house-flag icon-orange mx-2"></i>
                  Club House
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="comf_15" id="comf_15">
                <label class="form-check-label text-secondary filter-additional-input" for="comf_15">
                  <i class="fa-solid fa-user-gear icon-orange mx-2"></i>
                  Conserje
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="comf_05" id="comf_05">
                <label class="form-check-label text-secondary filter-additional-input" for="comf_05">
                  <i class="fa-solid fa-road icon-orange mx-2"></i>
                  Ingreso Independiente
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="comf_06" id="comf_06">
                <label class="form-check-label text-secondary filter-additional-input" for="comf_06">
                  <i class="fa-solid fa-wifi icon-orange mx-2"></i>
                  Internet / WiFi
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="comf_07" id="comf_07">
                <label class="form-check-label text-secondary filter-additional-input" for="comf_07">
                  <i class="fa-solid fa-tree icon-orange mx-2"></i>
                  Parque Interno
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="comf_08" id="comf_08">
                <label class="form-check-label text-secondary filter-additional-input" for="comf_08">
                  <i class="fa-solid fa-fire-burner icon-orange mx-2"></i>
                  Parrilla
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="comf_16" id="comf_16">
                <label class="form-check-label text-secondary filter-additional-input" for="comf_16">
                  <i class="fa-solid fa-bell-concierge icon-orange mx-2"></i>
                  Recepción
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="comf_09" id="comf_09">
                <label class="form-check-label text-secondary filter-additional-input" for="comf_09">
                  <i class="fa-solid fa-table-tennis-paddle-ball icon-orange mx-2"></i>
                  Sala de Entretenimiento
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="comf_10" id="comf_10">
                <label class="form-check-label text-secondary filter-additional-input" for="comf_10">
                  <i class="fa-regular fa-handshake icon-orange mx-2"></i>
                  Sala de Reuniones
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="comf_11" id="comf_11">
                <label class="form-check-label text-secondary filter-additional-input" for="comf_11">
                  <i class="fa-solid fa-hot-tub-person icon-orange mx-2"></i>
                  Sauna
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="comf_12" id="comf_12">
                <label class="form-check-label text-secondary filter-additional-input" for="comf_12">
                  <i class="fa-solid fa-tv icon-orange mx-2"></i>
                  Televisión por Cable
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="comf_13" id="comf_13">
                <label class="form-check-label text-secondary filter-additional-input" for="comf_13">
                  <i class="fa-solid fa-water icon-orange mx-2"></i>
                  Vista al Mar
                </label>
              </div>

              <div class="form-check my-2">
                <input class="form-check-input" type="checkbox" name="options[]" value="comf_14" id="comf_14">
                <label class="form-check-label text-secondary filter-additional-input" for="comf_14">
                  <i class="fa-solid fa-arrows-to-circle icon-orange mx-2"></i>
                  Zona Céntrica
                </label>
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

  {{-- SCRIPTS --}}
  <script>
    function avisoForm() {
        return {
            step: {{ session('step', 5) }},
            aviso_id: {{ session('aviso_id', 'null') }},
            tipo_operacion: '',
            tipo_inmueble: '',
            direccion: '',
            departamento: '',
            provincia: '',
            distrito: '',
            fotos: [],
            imagen_principal: null,
            videos: '',
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
            adicionales: [],
            comodidades: [],

            nextStep(step) {
              const stepMap = {
                  1: '/guardar-aviso/paso1',
                  2: `/guardar-aviso/paso2/${this.aviso_id}`,
                  3: `/guardar-aviso/paso3/${this.aviso_id}`,
                  4: `/guardar-aviso/paso4/${this.aviso_id}`,
                  6: `/guardar-aviso/paso6/${this.aviso_id}`, // No paso5, paso6 enviará datos de ambos
              }

              if (step === 5) {
                  this.adicionales = []
                  document.querySelectorAll('input[name="options[]"]:checked').forEach((checkbox) => {
                      this.adicionales.push(checkbox.value)
                  })
                  this.step++
              } else if (step === 6) {
                  this.comodidades = []
                  document.querySelectorAll('input[name="options[]"]:checked').forEach((checkbox) => {
                      this.comodidades.push(checkbox.value)
                  })

                  const formData = new FormData()
                  formData.append('adicionales', JSON.stringify(this.adicionales))
                  formData.append('comodidades', JSON.stringify(this.comodidades))

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
                          window.location.href = data.redirect
                      }
                      this.step++
                  })
                  .catch(error => {
                      console.error('Error:', error)
                  })
              } else {
                  // Proceder con el fetch normal para los pasos 1-4
                  const formData = new FormData()

                  if (step === 1) {
                      formData.append('tipo_operacion', this.tipo_operacion)
                      formData.append('tipo_inmueble', this.tipo_inmueble)
                      formData.append('operacion', 1)
                  } else if (step === 2) {
                      formData.append('direccion', this.direccion)
                      formData.append('departamento', this.departamento)
                      formData.append('provincia', this.provincia)
                      formData.append('distrito', this.distrito)
                      formData.append('ubicacion', 1)
                      formData.append('operacion', 0)
                  } else if (step === 3) {
                      formData.append('dormitorios', this.dormitorios)
                      formData.append('banios', this.banios)
                      formData.append('medio_banios', this.medio_banios)
                      formData.append('estacionamiento', this.estacionamiento)
                      formData.append('area_construida', this.area_construida)
                      formData.append('area_total', this.area_total)
                      formData.append('antiguedad', this.antiguedad)
                      formData.append('anios_antiguedad', this.anios_antiguedad)
                      formData.append('precio_soles', this.precio_soles)
                      formData.append('precio_dolares', this.precio_dolares)
                      formData.append('caracteristicas', 1)
                      formData.append('ubicacion', 0)
                  } else if (step === 4) {
                      if (this.imagen_principal) {
                          formData.append('imagen_principal', this.imagen_principal)
                      }
                      this.fotos.forEach((foto, index) => {
                          formData.append(`foto_${index}`, foto)
                      })
                      this.planos.forEach((plano, index) => {
                          formData.append(`plano_${index}`, plano)
                      })
                      formData.append('videos', this.videos)
                      formData.append('multimedia', 1)
                      formData.append('caracteristicas', 0)
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
                }
            },

            eliminarImagen(type, index) {
                if (type === 'fotos') {
                    this.fotos.splice(index, 1)
                } else if (type === 'planos') {
                    this.planos.splice(index, 1)
                } else if (type === 'imagen_principal') {
                    this.imagen_principal = null
                }
            },

            updateStepStatus() {
                document.querySelector('input[name="operacion"]').value = this.step === 1 ? 1 : 0
                document.querySelector('input[name="ubicacion"]').value = this.step === 2 ? 1 : 0
                document.querySelector('input[name="caracteristicas"]').value = this.step === 3 ? 1 : 0
                document.querySelector('input[name="multimedia"]').value = this.step === 4 ? 1 : 0
                document.querySelector('input[name="adicionales"]').value = this.step === 5 ? 1 : 0
                document.querySelector('input[name="comodidades"]').value = this.step === 6 ? 1 : 0
            }
        }
    }
</script>


@endsection
