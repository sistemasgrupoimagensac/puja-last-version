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
          <form @submit.prevent="nextStep(1)"
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
          <form @submit.prevent="nextStep(2)"
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
          <form @submit.prevent="nextStep(3)"
            class="d-flex flex-column gap-4 my-5">
            @csrf
            <h2>Características</h2>

            <fieldset>
              <legend>Características Principales</legend>

              <div class="d-flex justify-content-between gap-4">
                <div class="form-group w-100">
                  <label class="text-secondary" for="dormitorios">Dormitorios</label>
                  <input type="number" id="dormitorios" x-model="dormitorios" min="0" max="99"
                    class="form-control" required>
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
          <form @submit.prevent="nextStep(4)" enctype="multipart/form-data"
            class="d-flex flex-column gap-4 my-5">
            @csrf
            <h2>Multimedia</h2>

            <!-- Input para seleccionar imágenes -->
            <div class="form-group">
              <label for="images" class="form-label">Seleccionar imágenes</label>
              <input type="file" id="images" class="form-control" multiple
                @change="handleFiles($event, 'fotos')">
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
          <form @submit.prevent="nextStep(6)" class="d-flex flex-column gap-4 my-5">
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

  {{-- SCRIPTS --}}
  <script>
    function avisoForm() {
      return {
        step: {{ session('step', 1) }},
        aviso_id: {{ session('aviso_id', 'null') }},
        tipo_operacion: '',
        tipo_inmueble: '',
        direccion: '',
        departamento: '',
        provincia: '',
        distrito: '',
        fotos: [],
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

        nextStep(step) {
          const stepMap = {
            1: '/guardar-aviso/paso1',
            2: `/guardar-aviso/paso2/${this.aviso_id}`,
            3: `/guardar-aviso/paso3/${this.aviso_id}`,
            4: `/guardar-aviso/paso4/${this.aviso_id}`,
            5: `/guardar-aviso/paso5/${this.aviso_id}`,
            6: `/guardar-aviso/paso6/${this.aviso_id}`,
          };

          // Crear formData para enviar al servidor
          const formData = new FormData();

          // Agregar los campos del formulario actual al formData
          if (step === 1) {
            formData.append('tipo_operacion', this.tipo_operacion);
            formData.append('tipo_inmueble', this.tipo_inmueble);
          } else if (step === 2) {
            formData.append('direccion', this.direccion);
            formData.append('departamento', this.departamento);
            formData.append('provincia', this.provincia);
            formData.append('distrito', this.distrito);
          } else if (step === 3) {
            formData.append('dormitorios', this.dormitorios);
            formData.append('banios', this.banios);
            formData.append('medio_banios', this.medio_banios);
            formData.append('estacionamiento', this.estacionamiento);
            formData.append('area_construida', this.area_construida);
            formData.append('area_total', this.area_total);
            formData.append('antiguedad', this.antiguedad);
            formData.append('anios_antiguedad', this.anios_antiguedad);
            formData.append('precio_soles', this.precio_soles);
            formData.append('precio_dolares', this.precio_dolares);
          } else if (step === 4) {
            this.fotos.forEach((foto, index) => {
              formData.append(`foto_${index}`, foto);
            });
            this.planos.forEach((plano, index) => {
              formData.append(`plano_${index}`, plano);
            });
            formData.append('videos', this.videos);
          } else if (step === 5) {
            formData.append('acceso_playa', this.acceso_playa);
            formData.append('aire_acondicionado', this.aire_acondicionado);
          } else if (step === 6) {
            formData.append('acceso_parque', this.acceso_parque);
            formData.append('ascensores', this.ascensores);
          }

          // Realizar la solicitud fetch
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
            this.fotos.push(...files);
          } else if (type === 'planos') {
            this.planos.push(...files);
          }
        },

        eliminarImagen(type, index) {
          if (type === 'fotos') {
            this.fotos.splice(index, 1); // Eliminar imagen del array de fotos
          } else if (type === 'planos') {
            this.planos.splice(index, 1); // Eliminar plano del array de planos
          }
        }
      };
    }
  </script>
@endsection


@push('scripts')
  @vite(['resources/js/scripts/crear-aviso.js'])
@endpush
