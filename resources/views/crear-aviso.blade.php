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
          <form @submit.prevent="nextStep('tipo_operacion', 'tipo_inmueble', 'subtipo_inmueble')"
            class="d-flex flex-column gap-4 my-5">
            @csrf
            <h2>Operación y tipo de inmueble</h2>

            <div class="d-flex flex-column">
              <label class="text-secondary">Tipo de operación</label>
              <div class="btn-group" role="group">
                <input type="radio" class="btn-check" x-model="tipo_operacion" id="vender" autocomplete="off"
                  value="vender" required>
                <label class="btn btn-outline-secondary button-filter" for="vender">Vender</label>

                <input type="radio" class="btn-check" x-model="tipo_operacion" id="alquilar" autocomplete="off"
                  value="alquilar" required>
                <label class="btn btn-outline-secondary button-filter" for="alquilar">Alquilar</label>

                <input type="radio" class="btn-check" x-model="tipo_operacion" id="rematar" autocomplete="off"
                  value="rematar" required>
                <label class="btn btn-outline-secondary button-filter" for="rematar">Rematar</label>
              </div>
            </div>

            <div class="form-floating">
              <select x-model="tipo_inmueble" class="form-select" id="tipoinmueble" required>
                <option selected></option>
                <option value="departamento">Departamento</option>
                <option value="departamento_penthouse">Penthouse</option>
                <option value="casa_ciudad">Casa</option>
                <option value="casa_campo">Casa de Campo</option>
                <option value="casa_playa">Casa de Playa</option>
                <option value="local_comercial">Local Comercial</option>
                <option value="local_industrial">Local Industrial</option>
                <option value="terreno">Terreno</option>
                <option value="terreno_agricola">Terreno Agrícola</option>
                <option value="terreno_industrial">Terreno Industrial</option>
                <option value="terreno_comercial">Terreno Comercial</option>
              </select>
              <label for="tipoinmueble">Tipo de inmueble</label>
            </div>

            <button type="submit" class="btn button-orange w-100">Continuar</button>
          </form>
        </div>

        <!-- Paso 2: Ubicación -->
        <div x-show="step === 2">
          <form @submit.prevent="nextStep('direccion', 'departamento', 'provincia', 'distrito')"
            class="d-flex flex-column gap-4 my-5">
            @csrf
            <h2>Ubicación</h2>
            <div class="form-group">
              <label class="text-secondary">Dirección</label>
              <input type="text" x-model="direccion" class="form-control" placeholder="Dirección" required>
            </div>
            <div class="form-group">
              <label class="text-secondary">Departamento</label>
              <input type="text" x-model="departamento" class="form-control" placeholder="Departamento" required>
            </div>
            <div class="form-group">
              <label class="text-secondary">Provincia</label>
              <input type="text" x-model="provincia" class="form-control" placeholder="Provincia" required>
            </div>
            <div class="form-group">
              <label class="text-secondary">Distrito</label>
              <input type="text" x-model="distrito" class="form-control" placeholder="Distrito" required>
            </div>

            <div class="d-flex justify-content-between gap-2 w-100">
              <button type="button" @click="prevStep()" class="btn btn-secondary w-100">Atrás</button>
              <button type="submit" class="btn button-orange w-100">Continuar</button>
            </div>
          </form>
        </div>

        <!-- Paso 3: Características -->
        <div x-show="step === 3">
          <form
            @submit.prevent="nextStep('dormitorios', 'banios', 'medio_banios', 'area_construida', 'area_total', 'antiguedad', 'anios_antiguedad', 'precio_soles', 'precio_dolares')"
            class="d-flex flex-column gap-4 my-5">
            @csrf
            <h2>Características</h2>

            <fieldset>
              <legend>Características Principales</legend>

              <div class="d-flex justify-content-between gap-4">
                <div class="form-group w-100">
                  <label class="text-secondary" for="dormitorios">Dormitorios</label>
                  <input type="number" id="dormitorios" x-model="dormitorios" min="0" max="99" class="form-control" required>
                </div>

                <div class="form-group w-100">
                  <label class="text-secondary" for="banios">Baños</label>
                  <input type="number" id="banios" x-model="banios" min="0" max="99"
                    class="form-control" required>
                </div>
              </div>

              <div class="d-flex justify-content-between gap-4 mt-3">
                <div class="form-group w-100">
                  <label class="text-secondary" for="medio_banios">Medio Baño</label>
                  <input type="number" id="medio_banios" x-model="medio_banios" min="0" max="99"
                    class="form-control" required>
                </div>

                <div class="form-group w-100">
                  <label class="text-secondary" for="estacionamiento">Estacionamientos</label>
                  <input type="number" id="estacionamiento" x-model="estacionamiento" min="0" max="99"
                    class="form-control" required>
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

            <div class="d-flex justify-content-between gap-2 w-100">
              <button type="button" @click="prevStep()" class="btn btn-secondary w-100">Atrás</button>
              <button type="submit" class="btn button-orange w-100">Continuar</button>
            </div>
          </form>
        </div>

        <!-- Paso 4: Multimedia (fotos, videos, planos) -->
        <div x-show="step === 4">
          <form @submit.prevent="nextStep('fotos', 'videos', 'planos')" enctype="multipart/form-data"
            class="d-flex flex-column gap-4 my-5">
            @csrf
            <h2>Multimedia</h2>
            <div class="form-group">
              <label class="text-secondary">Fotos</label>
              <input type="file" multiple class="form-control" @change="handleFiles($event, 'fotos')">
            </div>
            <div class="form-group">
              <label class="text-secondary">Videos</label>
              <input type="text" x-model="videos" class="form-control" placeholder="URL de videos">
            </div>
            <div class="form-group">
              <label class="text-secondary">Planos</label>
              <input type="file" multiple class="form-control" @change="handleFiles($event, 'planos')">
            </div>
            <div class="d-flex justify-content-between gap-2 w-100">
              <button type="button" @click="prevStep()" class="btn btn-secondary w-100">Atrás</button>
              <button type="submit" class="btn button-orange w-100">Continuar</button>
            </div>
          </form>
        </div>

        <!-- Paso 5: Adicionales -->
        <div x-show="step === 5">
          <form @submit.prevent="nextStep('acceso_playa', 'aire_acondicionado')" class="d-flex flex-column gap-4 my-5">
            @csrf
            <h2>Adicionales</h2>
            <div class="form-group">
              <label class="text-secondary">Acceso a la playa</label>
              <input type="checkbox" x-model="acceso_playa" class="form-control">
            </div>
            <div class="form-group">
              <label class="text-secondary">Aire acondicionado</label>
              <input type="checkbox" x-model="aire_acondicionado" class="form-control">
            </div>
            <!-- Añade más campos de adicionales según sea necesario -->
            <div class="d-flex justify-content-between gap-2 w-100">
              <button type="button" @click="prevStep()" class="btn btn-secondary w-100">Atrás</button>
              <button type="submit" class="btn button-orange w-100">Continuar</button>
            </div>
          </form>
        </div>

        <!-- Paso 6: Comodidades -->
        <div x-show="step === 6">
          <form x-show="step === 6" @submit.prevent="nextStep('acceso_parque', 'ascensores')"
            class="d-flex flex-column gap-4 my-5">
            @csrf
            <h2>Comodidades</h2>
            <div class="form-group">
              <label class="text-secondary">Acceso a parque</label>
              <input type="checkbox" x-model="acceso_parque" class="form-control">
            </div>
            <div class="form-group">
              <label class="text-secondary">Ascensores</label>
              <input type="checkbox" x-model="ascensores" class="form-control">
            </div>
            <!-- Añade más campos de comodidades según sea necesario -->
            <div class="d-flex justify-content-between gap-2 w-100">
              <button type="button" @click="prevStep()" class="btn btn-secondary w-100">Atrás</button>
              <button type="submit" class="btn btn-success w-100">Guardar y Publicar</button>
            </div>
          </form>
        </div>

      </div>
    </div>

  </div>

  {{-- SCRIPT --}}
  <script>
    function avisoForm() {
      return {
        step: {{ session('step', 4) }},
        aviso_id: {{ session('aviso_id', 'null') }},
        tipo_operacion: '',
        tipo_inmueble: '',
        subtipo_inmueble: '',
        direccion: '',
        departamento: '',
        provincia: '',
        distrito: '',
        dormitorios: null,
        banios: null,
        medio_banios: null,
        area_construida: null,
        area_total: null,
        antiguedad: null,
        fotos: [],
        videos: '',
        planos: [],
        acceso_playa: false,
        aire_acondicionado: false,
        acceso_parque: false,
        ascensores: false,

        nextStep(...fields) {
          const stepMap = {
            1: '/guardar-aviso/paso1',
            2: `/guardar-aviso/paso2/${this.aviso_id}`,
            3: `/guardar-aviso/paso3/${this.aviso_id}`,
            4: `/guardar-aviso/paso4/${this.aviso_id}`,
            5: `/guardar-aviso/paso5/${this.aviso_id}`,
            6: `/guardar-aviso/paso6/${this.aviso_id}`,
          };

          let data = {};
          fields.forEach(field => data[field] = this[field]);

          fetch(stepMap[this.step], {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
              if (this.step === 1) {
                this.aviso_id = data.id;
              }
              this.step++;
            })
            .catch(error => {
              console.error('Error:', error);
            });
        },

        prevStep() {
          this.step--;
        },

        handleFiles(event, type) {
          const files = event.target.files;
          if (type === 'fotos') {
            this.fotos = files;
          } else if (type === 'planos') {
            this.planos = files;
          }
        }
      };
    }
  </script>
@endsection

@push('scripts')
  @vite(['resources/js/scripts/crear-aviso.js'])
@endpush
