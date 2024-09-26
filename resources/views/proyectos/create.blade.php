@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Proyecto Inmobiliario</h2>

    <!-- Formulario de creación de proyecto -->
    <form id="proyectoForm">
        @csrf
        <div class="mb-3">
            <label for="nombre_proyecto" class="form-label">Nombre del Proyecto</label>
            <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto" required>
        </div>

        <div class="mb-3">
            <label for="unidades" class="form-label">Cantidad de Unidades</label>
            <input type="number" class="form-control" id="unidades" name="unidades" required>
        </div>

        <div class="mb-3">
            <label for="banco_id" class="form-label">Banco</label>
            <select class="form-control" id="banco_id" name="banco_id" required>
                @foreach($bancos as $banco)
                    <option value="{{ $banco->id }}">{{ $banco->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="progreso_proyecto_id" class="form-label">Progreso del Proyecto</label>
            <select class="form-control" id="progreso_proyecto_id" name="progreso_proyecto_id" required>
                @foreach($progresos as $progreso)
                    <option value="{{ $progreso->id }}">{{ $progreso->estado }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción del Proyecto</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>

        <!-- Botón para abrir el modal para agregar unidades -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#unidadModal">
            + Agregar Unidad
        </button>

        <!-- Tabla para mostrar las unidades agregadas -->
        <table class="table table-striped mt-3" id="unidadesTable">
            <thead>
                <tr>
                    <th>Dormitorios</th>
                    <th>Precio (Soles)</th>
                    <th>Área</th>
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
                    <h5 class="modal-title" id="unidadModalLabel">Agregar Unidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                    <button type="submit" class="btn btn-primary">Agregar Unidad</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Array para almacenar las unidades temporalmente en el frontend
let unidades = [];

// Manejar el envío del formulario de unidades (modal)
document.getElementById('unidadForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Capturar los datos del formulario
    const unidad = {
        dormitorios: document.getElementById('dormitorios').value,
        precio_soles: document.getElementById('precio_soles').value,
        area: document.getElementById('area').value,
        banios: document.getElementById('banios').value,
        piso_numero: document.getElementById('piso_numero').value
    };

    // Agregar la unidad al array de unidades
    unidades.push(unidad);

    // Actualizar la tabla de unidades en la interfaz
    actualizarTablaUnidades();

    // Limpiar el formulario y cerrar el modal
    document.getElementById('unidadForm').reset();
    $('#unidadModal').modal('hide');
});

// Función para actualizar la tabla de unidades en la interfaz
function actualizarTablaUnidades() {
    const tableBody = document.querySelector('#unidadesTable tbody');
    tableBody.innerHTML = ''; // Limpiar la tabla

    unidades.forEach((unidad, index) => {
        const row = `
            <tr>
                <td>${unidad.dormitorios}</td>
                <td>${unidad.precio_soles}</td>
                <td>${unidad.area}</td>
                <td>${unidad.banios}</td>
                <td>${unidad.piso_numero}</td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="eliminarUnidad(${index})">Eliminar</button>
                </td>
            </tr>
        `;
        tableBody.innerHTML += row;
    });
}

// Función para eliminar una unidad del array
function eliminarUnidad(index) {
    unidades.splice(index, 1); // Eliminar la unidad del array
    actualizarTablaUnidades(); // Actualizar la tabla
}

// Manejo del envío del formulario del proyecto
document.getElementById('proyectoForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    formData.append('unidades', JSON.stringify(unidades)); // Añadir las unidades al formulario

    const action = this.querySelector('button[type="submit"][name="action"]:focus').value;

    fetch('{{ route('proyectos.store') }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (action === 'guardar_salir') {
            window.location.href = '/'; // Redirigir a la página principal
        } else {
            alert('Proyecto guardado parcialmente.');
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>
@endsection
