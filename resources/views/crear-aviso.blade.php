@extends('layouts.app')

@section('title')
  Crear tu Aviso
@endsection

@section('content')

<div x-data="avisoForm()" class="container mt-5">
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
  <form x-show="step === 1" @submit.prevent="nextStep('tipo_operacion', 'tipo_inmueble', 'subtipo_inmueble')">
      @csrf
      <h2>Operación y tipo de inmueble</h2>

      <div class="d-flex flex-column">
        <label>Tipo de operación</label>
        <div class="btn-group" role="group">
          <input type="radio" class="btn-check" x-model="tipo_operacion" id="vender" autocomplete="off" value="vender" checked>
          <label class="btn btn-outline-primary button-filter" for="vender">Vender</label>
        
          <input type="radio" class="btn-check" x-model="tipo_operacion" id="alquilar" autocomplete="off" value="alquilar">
          <label class="btn btn-outline-primary button-filter" for="alquilar">Alquilar</label>
        
          <input type="radio" class="btn-check" x-model="tipo_operacion" id="rematar" autocomplete="off" value="rematar">
          <label class="btn btn-outline-primary button-filter" for="rematar">Rematar</label>
        </div>
      </div>

      <div class="form-group">
          <label>Tipo de inmueble</label>
          <select x-model="tipo_inmueble" class="form-control" required>
              <option value="">Selecciona una opción</option>
              <option value="departamento">Departamento</option>
              <option value="casa">Casa</option>
              <option value="terreno">Terreno</option>
          </select>
      </div>
      <div class="form-group">
          <label>Subtipo de inmueble</label>
          <input type="text" x-model="subtipo_inmueble" class="form-control" placeholder="Subtipo de inmueble" required>
      </div>
      <button type="button" @click="prevStep()" class="btn btn-secondary">Atrás</button>
      <button type="submit" class="btn btn-primary">Continuar</button>
  </form>

  <!-- Paso 2: Ubicación -->
  <form x-show="step === 2" @submit.prevent="nextStep('direccion', 'departamento', 'provincia', 'distrito')">
      @csrf
      <h2>Ubicación</h2>
      <div class="form-group">
          <label>Dirección</label>
          <input type="text" x-model="direccion" class="form-control" placeholder="Dirección" required>
      </div>
      <div class="form-group">
          <label>Departamento</label>
          <input type="text" x-model="departamento" class="form-control" placeholder="Departamento" required>
      </div>
      <div class="form-group">
          <label>Provincia</label>
          <input type="text" x-model="provincia" class="form-control" placeholder="Provincia" required>
      </div>
      <div class="form-group">
          <label>Distrito</label>
          <input type="text" x-model="distrito" class="form-control" placeholder="Distrito" required>
      </div>
      <button type="button" @click="prevStep()" class="btn btn-secondary">Atrás</button>
      <button type="submit" class="btn btn-primary">Continuar</button>
  </form>

  <!-- Paso 3: Características -->
  <form x-show="step === 3" @submit.prevent="nextStep('habitaciones', 'banos', 'area_construida', 'area_total')">
      @csrf
      <h2>Características</h2>
      <div class="form-group">
          <label>Habitaciones</label>
          <input type="number" x-model="habitaciones" class="form-control" placeholder="Habitaciones" required>
      </div>
      <div class="form-group">
          <label>Baños</label>
          <input type="number" x-model="banos" class="form-control" placeholder="Baños" required>
      </div>
      <div class="form-group">
          <label>Área construida (m²)</label>
          <input type="number" x-model="area_construida" class="form-control" placeholder="Área construida" required>
      </div>
      <div class="form-group">
          <label>Área total (m²)</label>
          <input type="number" x-model="area_total" class="form-control" placeholder="Área total" required>
      </div>
      <button type="button" @click="prevStep()" class="btn btn-secondary">Atrás</button>
      <button type="submit" class="btn btn-primary">Continuar</button>
  </form>

  <!-- Paso 4: Multimedia (fotos, videos, planos) -->
  <form x-show="step === 4" @submit.prevent="nextStep('fotos', 'videos', 'planos')" enctype="multipart/form-data">
      @csrf
      <h2>Multimedia</h2>
      <div class="form-group">
          <label>Fotos</label>
          <input type="file" multiple class="form-control" @change="handleFiles($event, 'fotos')">
      </div>
      <div class="form-group">
          <label>Videos</label>
          <input type="text" x-model="videos" class="form-control" placeholder="URL de videos">
      </div>
      <div class="form-group">
          <label>Planos</label>
          <input type="file" multiple class="form-control" @change="handleFiles($event, 'planos')">
      </div>
      <button type="button" @click="prevStep()" class="btn btn-secondary">Atrás</button>
      <button type="submit" class="btn btn-primary">Continuar</button>
  </form>

  <!-- Paso 5: Adicionales -->
  <form x-show="step === 5" @submit.prevent="nextStep('acceso_playa', 'aire_acondicionado')">
      @csrf
      <h2>Adicionales</h2>
      <div class="form-group">
          <label>Acceso a la playa</label>
          <input type="checkbox" x-model="acceso_playa" class="form-control">
      </div>
      <div class="form-group">
          <label>Aire acondicionado</label>
          <input type="checkbox" x-model="aire_acondicionado" class="form-control">
      </div>
      <!-- Añade más campos de adicionales según sea necesario -->
      <button type="button" @click="prevStep()" class="btn btn-secondary">Atrás</button>
      <button type="submit" class="btn btn-primary">Continuar</button>
  </form>

  <!-- Paso 6: Comodidades -->
  <form x-show="step === 6" @submit.prevent="nextStep('acceso_parque', 'ascensores')">
      @csrf
      <h2>Comodidades</h2>
      <div class="form-group">
          <label>Acceso a parque</label>
          <input type="checkbox" x-model="acceso_parque" class="form-control">
      </div>
      <div class="form-group">
          <label>Ascensores</label>
          <input type="checkbox" x-model="ascensores" class="form-control">
      </div>
      <!-- Añade más campos de comodidades según sea necesario -->
      <button type="button" @click="prevStep()" class="btn btn-secondary">Atrás</button>
      <button type="submit" class="btn btn-success">Guardar y Publicar</button>
  </form>
</div>

<script>
  function avisoForm() {
      return {
          step: {{ session('step', 1) }},
          aviso_id: {{ session('aviso_id', 'null') }},
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
                  console.log('Datos guardados:', data);
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