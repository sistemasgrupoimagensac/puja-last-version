@extends('layouts.app')

@section('title')
  TEST ALPINE
@endsection

@section('content')

<div x-data="anuncioForm()" class="container mt-5">
  <!-- Menú de pasos -->
  <div class="d-flex justify-content-between mb-4">
      <div :class="{'text-primary': step === 1}">Operación y tipo de inmueble</div>
      <div :class="{'text-primary': step === 2}">Ubicación</div>
      <div :class="{'text-primary': step === 3}">Características</div>
      <div :class="{'text-primary': step === 4}">Multimedia</div>
      <div :class="{'text-primary': step === 5}">Adicionales</div>
      <div :class="{'text-primary': step === 6}">Comodidades</div>
  </div>

  <!-- Paso 1: Operación y tipo de inmueble -->
  <form x-show="step === 1" @submit.prevent="nextStep($event)">
      <h2>Operación y tipo de inmueble</h2>
      <div class="form-group">
          <label>Tipo de operación</label>
          <select x-model="form.tipo_operacion" class="form-control" required>
              <option value="">Selecciona una opción</option>
              <option value="venta">Venta</option>
              <option value="alquiler">Alquiler</option>
              <option value="remate">Remate</option>
          </select>
      </div>
      <div class="form-group">
          <label>Tipo de inmueble</label>
          <select x-model="form.tipo_inmueble" class="form-control" required>
              <option value="">Selecciona una opción</option>
              <option value="departamento">Departamento</option>
              <option value="casa">Casa</option>
              <option value="terreno">Terreno</option>
          </select>
      </div>
      <div class="form-group">
          <label>Subtipo de inmueble</label>
          <input type="text" x-model="form.subtipo_inmueble" class="form-control" placeholder="Subtipo de inmueble" required>
      </div>
      <button type="submit" class="btn btn-primary">Continuar</button>
  </form>

  <!-- Paso 2: Ubicación -->
  <form x-show="step === 2" @submit.prevent="nextStep($event)">
      <h2>Ubicación</h2>
      <div class="form-group">
          <label>Dirección</label>
          <input type="text" x-model="form.direccion" class="form-control" placeholder="Dirección" required>
      </div>
      <div class="form-group">
          <label>Departamento</label>
          <input type="text" x-model="form.departamento" class="form-control" placeholder="Departamento" required>
      </div>
      <div class="form-group">
          <label>Provincia</label>
          <input type="text" x-model="form.provincia" class="form-control" placeholder="Provincia" required>
      </div>
      <div class="form-group">
          <label>Distrito</label>
          <input type="text" x-model="form.distrito" class="form-control" placeholder="Distrito" required>
      </div>
      <button type="button" @click="prevStep()" class="btn btn-secondary">Atrás</button>
      <button type="submit" class="btn btn-primary">Continuar</button>
  </form>

  <!-- Paso 3: Características -->
  <form x-show="step === 3" @submit.prevent="nextStep($event)">
      <h2>Características</h2>
      <div class="form-group">
          <label>Habitaciones</label>
          <input type="number" x-model="form.habitaciones" class="form-control" placeholder="Habitaciones" required>
      </div>
      <div class="form-group">
          <label>Baños</label>
          <input type="number" x-model="form.banos" class="form-control" placeholder="Baños" required>
      </div>
      <div class="form-group">
          <label>Área construida (m²)</label>
          <input type="number" x-model="form.area_construida" class="form-control" placeholder="Área construida" required>
      </div>
      <div class="form-group">
          <label>Área total (m²)</label>
          <input type="number" x-model="form.area_total" class="form-control" placeholder="Área total" required>
      </div>
      <button type="button" @click="prevStep()" class="btn btn-secondary">Atrás</button>
      <button type="submit" class="btn btn-primary">Continuar</button>
  </form>

  <!-- Paso 4: Multimedia (fotos, videos, planos) -->
  <form x-show="step === 4" @submit.prevent="nextStep($event)">
      <h2>Multimedia</h2>
      <div class="form-group">
          <label>Fotos</label>
          <input type="file" multiple x-on:change="handleFiles($event, 'fotos')" class="form-control" required>
      </div>
      <div class="form-group">
          <label>Videos</label>
          <input type="text" x-model="form.videos" class="form-control" placeholder="URL de videos">
      </div>
      <div class="form-group">
          <label>Planos</label>
          <input type="file" multiple x-on:change="handleFiles($event, 'planos')" class="form-control">
      </div>
      <button type="button" @click="prevStep()" class="btn btn-secondary">Atrás</button>
      <button type="submit" class="btn btn-primary">Continuar</button>
  </form>

  <!-- Paso 5: Adicionales -->
  <form x-show="step === 5" @submit.prevent="nextStep($event)">
      <h2>Adicionales</h2>
      <!-- Aquí añadirías los campos adicionales -->
      <div class="form-group">
          <label>Acceso a la playa</label>
          <input type="checkbox" x-model="form.acceso_playa" class="form-control">
      </div>
      <div class="form-group">
          <label>Aire acondicionado</label>
          <input type="checkbox" x-model="form.aire_acondicionado" class="form-control">
      </div>
      <!-- Añade más campos de adicionales según sea necesario -->
      <button type="button" @click="prevStep()" class="btn btn-secondary">Atrás</button>
      <button type="submit" class="btn btn-primary">Continuar</button>
  </form>

  <!-- Paso 6: Comodidades -->
  <form x-show="step === 6" @submit.prevent="saveData($event)">
      <h2>Comodidades</h2>
      <!-- Aquí añadirías los campos de comodidades -->
      <div class="form-group">
          <label>Acceso a parque</label>
          <input type="checkbox" x-model="form.acceso_parque" class="form-control">
      </div>
      <div class="form-group">
          <label>Ascensores</label>
          <input type="checkbox" x-model="form.ascensores" class="form-control">
      </div>
      <!-- Añade más campos de comodidades según sea necesario -->
      <button type="button" @click="prevStep()" class="btn btn-secondary">Atrás</button>
      <button type="submit" class="btn btn-success">Guardar y Publicar</button>
  </form>
</div>

<script>
  function anuncioForm() {
      return {
          step: 1,
          form: {
              tipo_operacion: '',
              tipo_inmueble: '',
              subtipo_inmueble: '',
              direccion: '',
              departamento: '',
              provincia: '',
              distrito: '',
              habitaciones: null,
              banos: null,
              area_construida: null,
              area_total: null,
              fotos: [],
              videos: '',
              planos: [],
              recorridos: '',
              // Campos adicionales y comodidades
              acceso_playa: false,
              aire_acondicionado: false,
              acceso_parque: false,
              ascensores: false,
          },
          nextStep(event) {
              if (event.target.checkValidity()) {
                  this.saveData();
                  this.step++;
              } else {
                  event.target.reportValidity();
              }
          },
          prevStep() {
              this.step--;
          },
          handleFiles(event, type) {
              if (type === 'fotos') {
                  this.form.fotos = Array.from(event.target.files);
              } else if (type === 'planos') {
                  this.form.planos = Array.from(event.target.files);
              }
          },
          saveData() {
              const stepMap = {
                  1: '/guardar-anuncio/paso1',
                  2: `/guardar-anuncio/paso2/${this.form.id}`,
                  3: `/guardar-anuncio/paso3/${this.form.id}`,
                  4: `/guardar-anuncio/paso4/${this.form.id}`,
                  5: `/guardar-anuncio/paso5/${this.form.id}`,
                  6: `/guardar-anuncio/paso6/${this.form.id}`,
              };
              fetch(stepMap[this.step], {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': '{{ csrf_token() }}'
                  },
                  body: JSON.stringify(this.form)
              })
              .then(response => response.json())
              .then(data => {
                  if (!this.form.id) {
                      this.form.id = data.id;
                  }
                  console.log('Datos guardados:', data);
              });
          }
      }
  }
</script>

@endsection