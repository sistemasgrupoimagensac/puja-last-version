@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($proyecto) ? 'Editar Proyecto Inmobiliario' : 'Crear Proyecto Inmobiliario' }}</h2>

    <!-- Formulario de creación de proyecto -->
    <form id="proyectoForm" data-proyecto-id="{{ $proyecto->id ?? '' }}">
        @csrf

        <input type="hidden" name="latitude" id="latitude" value="{{ $proyecto->latitude ?? '' }}">
        <input type="hidden" name="longitude" id="longitude" value="{{ $proyecto->longitude ?? '' }}">

        <div class="mb-3">
            <label for="nombre_proyecto" class="form-label">Nombre del Proyecto</label>
            <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto" value="{{ $proyecto->nombre_proyecto ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label for="unidades_cantidad" class="form-label">Cantidad de Unidades</label>
            <input type="number" class="form-control" id="unidades_cantidad" name="unidades_cantidad" value="{{ $proyecto->unidades_cantidad ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label for="banco_id" class="form-label">Banco</label>
            <select class="form-control" id="banco_id" name="banco_id" required>
                @foreach($bancos as $banco)
                    <option value="{{ $banco->id }}" {{ isset($proyecto) && $proyecto->banco_id == $banco->id ? 'selected' : '' }}>{{ $banco->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="proyecto_progreso_id" class="form-label">Progreso del Proyecto</label>
            <select class="form-control" id="proyecto_progreso_id" name="proyecto_progreso_id" required>
                @foreach($progresos as $progreso)
                    <option value="{{ $progreso->id }}" {{ isset($proyecto) && $proyecto->proyecto_progreso_id == $progreso->id ? 'selected' : '' }}>{{ $progreso->estado }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción del Proyecto</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $proyecto->descripcion ?? '' }}</textarea>
        </div>

        <div class="mb-3">
            <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
            <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" value="{{ $proyecto->fecha_entrega ?? '' }}">
        </div>

        <!-- Sección para la ubicación -->
        {{-- <div class="mb-3">
            <label for="place_input" class="form-label">Ubicación del Proyecto</label>
            <input type="text" id="place_input" class="form-control" placeholder="Ingrese la dirección o seleccione en el mapa">
        </div>

        <input type="text" id="place_input" placeholder="Ingresa la dirección">
        <input type="text" id="direccion" name="direccion" placeholder="Dirección">
        <input type="text" id="distrito" name="distrito" placeholder="Distrito">
        <input type="text" id="provincia" name="provincia" placeholder="Provincia">
        <input type="text" id="departamento" name="departamento" placeholder="Departamento">
        <input type="hidden" id="latitude" name="latitude" value="{{ $proyecto->latitude ?? '' }}">
        <input type="hidden" id="longitude" name="longitude" value="{{ $proyecto->longitude ?? '' }}">
        <div id="map" style="max-width: 600px; width: 100%; height: 600px"></div>


        <div id="map" style="max-width: 600px; width: 100%; height: 600px; border: 1px solid #ddd;"></div>

        <input type="hidden" id="latitude" name="latitude" value="{{ $proyecto->latitude ?? '' }}">
        <input type="hidden" id="longitude" name="longitude" value="{{ $proyecto->longitude ?? '' }}"> --}}

        <div class="mb-3">
            <!-- Campos ocultos para latitud y longitud -->
            <input type="hidden" id="latitude" name="latitude" value="{{ $proyecto->latitude ?? '' }}">
            <input type="hidden" id="longitude" name="longitude" value="{{ $proyecto->longitude ?? '' }}">
            
            <div class="form-group">
              <label for="place_input">Dirección</label>
              <input type="text" id="place_input" class="form-control" name="direccion" value="{{ $proyecto->direccion ?? '' }}">
            </div>
            
            <div class="form-group">
              <label for="distrito">Distrito</label>
              <input type="text" id="distrito" class="form-control" name="distrito" value="{{ $proyecto->distrito ?? '' }}">
            </div>
            
            <div class="form-group">
              <label for="provincia">Provincia</label>
              <input type="text" id="provincia" class="form-control" name="provincia" value="{{ $proyecto->provincia ?? '' }}">
            </div>
            
            <div class="form-group">
              <label for="departamento">Departamento</label>
              <input type="text" id="departamento" class="form-control" name="departamento" value="{{ $proyecto->departamento ?? '' }}">
            </div>

            <!-- Div para mostrar el mapa -->
            <div id="map" style="max-width: 600px; width: 100%; height: 600px; border: 1px solid #ddd;"></div>

        </div>
          

        <!-- Botón para abrir el modal para agregar unidades -->
        <button type="button" class="btn btn-primary" id="btnAddUnit" data-bs-toggle="modal" data-bs-target="#unidadModal">
            + Agregar Unidad
        </button>

        <!-- Tabla para mostrar las unidades agregadas -->
        <table class="table table-striped mt-3" id="unidadesTable">
            <thead>
                <tr>
                    <th>Dormitorios</th>
                    <th>Precio (Soles)</th>
                    <th>Área</th>
                    <th>Área Techada</th>
                    <th>Baños</th>
                    <th>Piso</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se agregarán dinámicamente las unidades -->
            </tbody>
        </table>

        <!-- Botón para guardar parcialmente -->
        <button type="submit" name="action" value="guardar" class="btn btn-secondary">Guardar parcialmente</button>

        <!-- Botón para guardar y regresar -->
        <button type="submit" name="action" value="guardar_salir" class="btn btn-success">Guardar y salir</button>
    </form>
</div>

<!-- Modal para agregar unidades -->
<div class="modal fade" id="unidadModal" tabindex="-1" aria-labelledby="unidadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="unidadForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="unidadModalLabel">Agregar/Editar Unidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="unidad_id" name="unidad_id">
                    <div class="mb-3">
                        <label for="dormitorios" class="form-label">Dormitorios</label>
                        <input type="number" class="form-control" id="dormitorios" name="dormitorios" required>
                    </div>

                    <div class="mb-3">
                        <label for="precio_soles" class="form-label">Precio en Soles</label>
                        <input type="number" class="form-control" id="precio_soles" name="precio_soles" required>
                    </div>

                    <div class="mb-3">
                        <label for="area" class="form-label">Área</label>
                        <input type="number" class="form-control" id="area" name="area" required>
                    </div>

                    <div class="mb-3">
                        <label for="area_techada" class="form-label">Área Techada</label>
                        <input type="number" class="form-control" id="area_techada" name="area_techada" required>
                    </div>

                    <div class="mb-3">
                        <label for="banios" class="form-label">Baños</label>
                        <input type="number" class="form-control" id="banios" name="banios" required>
                    </div>

                    <div class="mb-3">
                        <label for="piso_numero" class="form-label">Número de Piso</label>
                        <input type="number" class="form-control" id="piso_numero" name="piso_numero" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="btnSaveUnit">Guardar Unidad</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar unidad -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea eliminar esta unidad?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<script>
    const storeUrl = "{{ route('proyectos.store') }}";
    const csrfToken = "{{ csrf_token() }}";
    const initialUnidades = @json($proyecto->unidades ?? []);
</script>

@endsection

@push('scripts')
    @vite(['resources/js/scripts/create_project.js', 'resources/js/scripts/location_map.js'])
@endpush
