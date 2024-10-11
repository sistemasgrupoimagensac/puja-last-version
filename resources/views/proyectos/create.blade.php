@extends('layouts.app')

@push('styles')
    @vite(['resources/sass/pages/create_project.scss'])
@endpush

@section('content')
<div class="container my-5">
    <h2>{{ isset($proyecto) ? 'Editar Proyecto Inmobiliario' : 'Crear Proyecto Inmobiliario' }}</h2>

    <!-- Formulario de creación de proyecto -->
    <form id="proyectoForm" data-proyecto-id="{{ $proyecto->id ?? '' }}">
        @csrf

        <div class="mb-3">
            <label for="nombre_proyecto" class="form-label">Nombre del Proyecto</label>
            <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto" value="{{ $proyecto->nombre_proyecto ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label for="unidades_cantidad" class="form-label">Cantidad de Unidades</label>
            <input type="number" class="form-control" id="unidades_cantidad" name="unidades_cantidad" value="{{ $proyecto->unidades_cantidad ?? '' }}" required>
        </div>

        <div class="mb-3">
            <label for="banco_id" class="form-label">Financiamiento</label>
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
          
        <!-- Botón para abrir el modal para agregar unidades -->
        <button type="button" class="btn button-orange" id="btnAddUnit" data-bs-toggle="modal" data-bs-target="#unidadModal">
            + Agregar Unidad
        </button>

        <!-- Tabla para mostrar las unidades agregadas -->
        <div class=" overflow-x-scroll">

            <table class="table table-striped mt-3" id="unidadesTable">
                <thead>
                    <tr>
                        <th>Miniatura</th>
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
        </div>

        <div class="d-flex flex-column justify-content-between flex-md-row my-5">

            <div class="w-100 me-md-3">
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
            </div>
        
            <!-- Div para mostrar el mapa -->
            <div id="map" style="max-width: 600px; width: 100%; height: 600px; border: 1px solid #ddd;"></div>
        
        </div>

        <!-- Botón para abrir el modal de subida de imágenes -->
        <button type="button" class="btn button-orange" data-bs-toggle="modal" data-bs-target="#proyectoImgUploadModal" title="Primero guarde el proyecto">
            Subir Imágenes del Proyecto
        </button>


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
                    <button type="submit" class="btn button-orange" id="btnSaveUnit">Guardar Unidad</button>
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

<!-- Modal para Subir y Editar Imágenes del Proyecto -->
<div class="modal fade" id="proyectoImgUploadModal" tabindex="-1" aria-labelledby="proyectoImgUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="proyectoImgUploadModalLabel">Gestionar Imágenes del Proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para subir imágenes -->
                <form id="proyectoImgUploadForm" class="proyecto-img-upload-form" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="proyectoImgInput" class="form-label">Selecciona las imágenes (Máximo 50)</label>
                        
                        <!-- Contenedor de Drag and Drop -->
                        <div id="proyectoImgDropZone" class="proyecto-img-drop-zone">
                            <p>Arrastra las imágenes aquí o haz clic para seleccionarlas</p>
                            <input type="file" id="proyectoImgInput" name="proyecto_images[]" accept=".jpg, .jpeg, .png, .webp" multiple class="form-control d-none">
                        </div>
                    </div>
                    
                    <!-- Contenedor para mostrar las miniaturas de las imágenes seleccionadas -->
                    <div id="proyectoImgPreviewContainer" class="d-flex flex-wrap gap-2 proyecto-img-preview-container">
                        <!-- Aquí se agregarán las miniaturas de las imágenes seleccionadas -->
                    </div>

                    <!-- Contenedor para mostrar las miniaturas de las imágenes ya existentes -->
                    <h5 class="mt-4">Imágenes Existentes</h5>
                    <div id="existingImagesContainer" class="d-flex flex-wrap gap-2">

                        @foreach($imagenes->where('estado', 1) as $imagen)
                            <div class="image-thumbnail position-relative">
                                <img src="{{ $imagen->image_url }}" alt="Imagen del Proyecto" class="img-thumbnail" style="max-width: 100px;">

                                <!-- Checkbox para seleccionar la imagen principal -->
                                <div class="form-check">
                                    <input class="form-check-input principal-checkbox" type="radio" name="principal" value="{{ $imagen->id }}" {{ $imagen->tipo == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label icon-orange fw-bold">principal</label>
                                </div>

                                <button type="button" class="remove-image-btn btn-close d-flex justify-content-center align-items-center delete-image-btn" data-id="{{ $imagen->id }}">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        @endforeach

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn button-orange" id="proyectoImgUploadButton">Subir / Actualizar Imágenes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Subir y Editar Imágenes de la Unidad -->
<div class="modal fade" id="unidadImgUploadModal" tabindex="-1" aria-labelledby="unidadImgUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unidadImgUploadModalLabel">Gestionar Imágenes de la Unidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="unidadImgUploadForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="unidadImgInput" class="form-label">Selecciona las imágenes (Máximo 50)</label>
                        <input hidden type="file" id="unidadImgInput" name="unidad_images[]" accept=".jpg, .jpeg, .png, .webp" multiple class="form-control">
                    </div>

                    <!-- Contenedor de Drag and Drop -->
                    <div id="unidadImgDropZone" class="proyecto-img-drop-zone">
                        <p>Arrastra las imágenes aquí o haz clic para seleccionarlas</p>
                    </div>

                    <!-- Contenedor para mostrar las miniaturas de las imágenes seleccionadas -->
                    <h5 class="mt-4">Imágenes Seleccionadas</h5>
                    <div id="unidadImgPreviewContainer" class="d-flex flex-wrap gap-2 mb-3">
                        <!-- Aquí se agregarán las miniaturas de las imágenes seleccionadas -->
                    </div>

                    <!-- Contenedor para mostrar las miniaturas de las imágenes ya existentes -->
                    <h5 class="mt-4">Imágenes Existentes de la Unidad</h5>
                    <div id="unidadExistingImagesContainer" class="d-flex flex-wrap gap-2">
                        <!-- Se cargan dinámicamente las imagenes de la unidad -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn button-orange" id="unidadImgUploadButton">Subir Imágenes</button>
            </div>
        </div>
    </div>
</div>

<script>
    const storeUrl = "{{ route('proyectos.store') }}";
    const csrfToken = "{{ csrf_token() }}";
    const initialUnidades = @json($proyecto->unidades ?? []);
    const imagenesUnidades = @json($imagenesUnidades);
</script>

@endsection

@push('scripts')
    @vite([ 'resources/js/scripts/create_project.js', 
            'resources/js/scripts/location_map.js', 
            'resources/js/scripts/project_upload_image.js', 
            'resources/js/scripts/upload_unit_image.js',
            ])
@endpush
