@extends('layouts.app')

@section('title')
  TEST ALPINE
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
        <form x-show="step === 1" method="POST" action="{{ route('avisos.store.paso1') }}">
            @csrf
            <input type="hidden" name="aviso_id" :value="aviso_id">
            <h2>Operación y tipo de inmueble</h2>
            <div class="form-group">
                <label>Tipo de operación</label>
                <select name="tipo_operacion" class="form-control" required>
                    <option value="">Selecciona una opción</option>
                    <option value="venta">Venta</option>
                    <option value="alquiler">Alquiler</option>
                    <option value="remate">Remate</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tipo de inmueble</label>
                <select name="tipo_inmueble" class="form-control" required>
                    <option value="">Selecciona una opción</option>
                    <option value="departamento">Departamento</option>
                    <option value="casa">Casa</option>
                    <option value="terreno">Terreno</option>
                </select>
            </div>
            <div class="form-group">
                <label>Subtipo de inmueble</label>
                <input type="text" name="subtipo_inmueble" class="form-control" placeholder="Subtipo de inmueble" required>
            </div>
            <button type="button" @click="prevStep()" class="btn btn-secondary">Atrás</button>
            <button type="submit" class="btn btn-primary">Continuar</button>
        </form>

        <!-- Paso 2: Ubicación -->
        <form x-show="step === 2" method="POST" :action="`{{ url('/guardar-aviso/paso2') }}/${aviso_id}`">
            @csrf
            <input type="hidden" name="aviso_id" :value="aviso_id">
            <h2>Ubicación</h2>
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" name="direccion" class="form-control" placeholder="Dirección" required>
            </div>
            <div class="form-group">
                <label>Departamento</label>
                <input type="text" name="departamento" class="form-control" placeholder="Departamento" required>
            </div>
            <div class="form-group">
                <label>Provincia</label>
                <input type="text" name="provincia" class="form-control" placeholder="Provincia" required>
            </div>
            <div class="form-group">
                <label>Distrito</label>
                <input type="text" name="distrito" class="form-control" placeholder="Distrito" required>
            </div>
            <button type="button" @click="prevStep()" class="btn btn-secondary">Atrás</button>
            <button type="submit" class="btn btn-primary">Continuar</button>
        </form>

        <!-- Paso 3: Características -->
        <form x-show="step === 3" method="POST" :action="`{{ url('/guardar-aviso/paso3') }}/${aviso_id}`">
            @csrf
            <input type="hidden" name="aviso_id" :value="aviso_id">
            <h2>Características</h2>
            <div class="form-group">
                <label>Habitaciones</label>
                <input type="number" name="habitaciones" class="form-control" placeholder="Habitaciones" required>
            </div>
            <div class="form-group">
                <label>Baños</label>
                <input type="number" name="banos" class="form-control" placeholder="Baños" required>
            </div>
            <div class="form-group">
                <label>Área construida (m²)</label>
                <input type="number" name="area_construida" class="form-control" placeholder="Área construida" required>
            </div>
            <div class="form-group">
                <label>Área total (m²)</label>
                <input type="number" name="area_total" class="form-control" placeholder="Área total" required>
            </div>
            <button type="button" @click="prevStep()" class="btn btn-secondary">Atrás</button>
            <button type="submit" class="btn btn-primary">Continuar</button>
        </form>

        <!-- Paso 4: Multimedia (fotos, videos, planos) -->
        <form x-show="step === 4" method="POST" enctype="multipart/form-data" :action="`{{ url('/guardar-aviso/paso4') }}/${aviso_id}`">
            @csrf
            <input type="hidden" name="aviso_id" :value="aviso_id">
            <h2>Multimedia</h2>
            <div class="form-group">
                <label>Fotos</label>
                <input type="file" multiple name="fotos[]" class="form-control">
            </div>
            <div class="form-group">
                <label>Videos</label>
                <input type="text" name="videos" class="form-control" placeholder="URL de videos">
            </div>
            <div class="form-group">
                <label>Planos</label>
                <input type="file" multiple name="planos[]" class="form-control">
            </div>
            <button type="button" @click="prevStep()" class="btn btn-secondary">Atrás</button>
            <button type="submit" class="btn btn-primary">Continuar</button>
        </form>

        <!-- Paso 5: Adicionales -->
        <form x-show="step === 5" method="POST" :action="`{{ url('/guardar-aviso/paso5') }}/${aviso_id}`">
            @csrf
            <input type="hidden" name="aviso_id" :value="aviso_id">
            <h2>Adicionales</h2>
            <div class="form-group">
                <label>Acceso a la playa</label>
                <input type="checkbox" name="acceso_playa" class="form-control">
            </div>
            <div class="form-group">
                <label>Aire acondicionado</label>
                <input type="checkbox" name="aire_acondicionado" class="form-control">
            </div>
            <!-- Añade más campos de adicionales según sea necesario -->
            <button type="button" @click="prevStep()" class="btn btn-secondary">Atrás</button>
            <button type="submit" class="btn btn-primary">Continuar</button>
        </form>

        <!-- Paso 6: Comodidades -->
        <form x-show="step === 6" method="POST" :action="`{{ url('/guardar-aviso/paso6') }}/${aviso_id}`">
            @csrf
            <input type="hidden" name="aviso_id" :value="aviso_id">
            <h2>Comodidades</h2>
            <div class="form-group">
                <label>Acceso a parque</label>
                <input type="checkbox" name="acceso_parque" class="form-control">
            </div>
            <div class="form-group">
                <label>Ascensores</label>
                <input type="checkbox" name="ascensores" class="form-control">
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
                nextStep(event) {
                    if (event.target.checkValidity()) {
                        this.step++;
                    } else {
                        event.target.reportValidity();
                    }
                },
                prevStep() {
                    this.step--;
                }
            }
        }
    </script>

@endsection