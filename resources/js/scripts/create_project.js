import * as bootstrap from 'bootstrap'; // Importar todas las funcionalidades de Bootstrap

let unidades = []; // Array para almacenar las unidades
let editIndex = null; // Índice de la unidad que se está editando
let modalInstance = null; // Instancia global del modal para agregar/editar unidad
let confirmDeleteModalInstance = null; // Instancia global del modal de confirmación de eliminación
let deleteIndex = null; // Índice de la unidad a eliminar
let proyectoId = null; // ID del proyecto (global)

// Inicializar los modales y los botones de la interfaz cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function () {
    const modalElement = document.getElementById('unidadModal');
    modalInstance = new bootstrap.Modal(modalElement, { backdrop: 'static' }); // Crear instancia del modal con opción estática

    const confirmDeleteModalElement = document.getElementById('confirmDeleteModal');
    confirmDeleteModalInstance = new bootstrap.Modal(confirmDeleteModalElement, { backdrop: 'static' }); // Crear instancia del modal de confirmación de eliminación

    // Capturar el ID del proyecto desde el atributo data-proyecto-id en el formulario
    proyectoId = document.getElementById('proyectoForm').dataset.proyectoId || null;

    // Botón para agregar una nueva unidad
    document.getElementById('btnAddUnit').addEventListener('click', function () {
        resetUnidadForm(); // Restablecer el formulario
        editIndex = null; // Nueva unidad, no estamos editando ninguna existente
        mostrarModal(); // Abrir el modal vacío para agregar una nueva unidad
    });

    // Confirmar la eliminación cuando se haga clic en "Eliminar" dentro del modal de confirmación
    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        if (deleteIndex !== null) {
            eliminarUnidad(deleteIndex); // Eliminar la unidad con el índice almacenado
            confirmDeleteModalInstance.hide(); // Cerrar el modal de confirmación
        }
    });

    // Inicializar el array de unidades con los datos cargados desde el backend
    if (typeof initialUnidades !== 'undefined' && initialUnidades.length > 0) {
        unidades = initialUnidades.map(unidad => ({
            ...unidad,
            estado: unidad.estado || 1
        }));
    }

    actualizarTablaUnidades();
});

const loader = document.querySelector('#loader-overlay');

// Manejar el envío del formulario de la unidad (Agregar o Editar)
document.getElementById('unidadForm').addEventListener('submit', function (event) {
    event.preventDefault();

    // Capturar los datos del formulario
    const unidad = {
        id: document.getElementById('unidad_id').value || null, // Capturar la ID si existe
        dormitorios: document.getElementById('dormitorios').value,
        precio_soles: document.getElementById('precio_soles').value,
        precio_dolares: document.getElementById('precio_dolares').value,
        area: document.getElementById('area').value,
        area_techada: document.getElementById('area_techada').value,
        banios: document.getElementById('banios').value,
        piso_numero: document.getElementById('piso_numero').value,
        estado: 1 // Asignar estado activo por defecto
    };
    
    // Determinar si se está agregando o editando
    if (editIndex === null) {
        unidades.push(unidad); // Agregar nueva unidad
    } else {
        unidades[editIndex] = unidad; // Editar unidad existente y mantener su ID
    }

    actualizarTablaUnidades(); // Actualizar la tabla con las unidades
    document.getElementById('unidadForm').reset();
    ocultarModal(); // Cerrar el modal después de agregar o editar
});

function ordenarUnidadesPorDormitorios() {
    unidades.sort((a, b) => a.dormitorios - b.dormitorios);
}

// Actualizar la tabla de unidades en la interfaz
function actualizarTablaUnidades() {
    ordenarUnidadesPorDormitorios();
    const tableBody = document.querySelector('#unidadesTable tbody');
    tableBody.innerHTML = ''; // Limpiar la tabla

    unidades.forEach((unidad, index) => {
        if (unidad.estado === 1) {  // Solo mostrar las unidades activas
            // Buscar la primera imagen para la unidad si existe en el objeto `imagenesUnidades`
            const unidadImages = imagenesUnidades[unidad.id] || []; // Obtener el array de imágenes o array vacío si no existe
            const primeraImagenUrl = unidadImages.length > 0 ? unidadImages[0].image_url : '/images/placeholder_plano.png'; // Obtener la primera imagen

            // Deshabilitar el botón de subir plano si no tiene ID
            const isDisabled = unidad.id ? '' : 'disabled';

            // Crear la fila de la unidad con la miniatura y botones de acciones
            const row = `
                <tr class="">
                    <td>
                        <img src="${primeraImagenUrl}" alt="Miniatura" style="width: 50px; height: 50px; object-fit: cover;">
                    </td>
                    <td>${unidad.dormitorios}</td>
                    <td>${Number(unidad.precio_soles).toLocaleString('en')}</td>
                    <td>${Number(unidad.precio_dolares).toLocaleString('en')}</td>
                    <td>${unidad.area}</td>
                    <td>${unidad.area_techada}</td>
                    <td>${unidad.banios}</td>
                    <td>${unidad.piso_numero}</td>
                    <td class="d-flex gap-3 p-3" style="height: 67px;">
                        <button type="button" class="btn btn-warning" onclick="editarUnidad(${index})">Editar</button>
                        <button type="button" class="btn btn-danger" onclick="mostrarConfirmacionEliminar(${index})">Eliminar</button>
                        <button type="button" class="btn button-orange" data-bs-toggle="modal" data-bs-target="#unidadImgUploadModal" ${isDisabled} onclick="abrirModalPlano(${unidad.id || ''})">Subir Plano</button>
                    </td>
                </tr>
            `;
            tableBody.innerHTML += row;
        }
    });
}


function abrirModalPlano(unidadId) {
    const unidadImgUploadButton = document.getElementById('unidadImgUploadButton');
    unidadImgUploadButton.setAttribute('data-unidad-id', unidadId);
}

// Función para editar una unidad
function editarUnidad(index) {
    const unidad = unidades[index];
    document.getElementById('dormitorios').value = unidad.dormitorios;
    document.getElementById('precio_soles').value = unidad.precio_soles;
    document.getElementById('precio_dolares').value = unidad.precio_dolares;
    document.getElementById('area').value = unidad.area;
    document.getElementById('area_techada').value = unidad.area_techada;
    document.getElementById('banios').value = unidad.banios;
    document.getElementById('piso_numero').value = unidad.piso_numero;

    // Guardar el ID de la unidad en un campo oculto para mantener la referencia
    document.getElementById('unidad_id').value = unidad.id || '';  // Si la unidad no tiene ID, asignar cadena vacía

    editIndex = index; // Establecer el índice de edición
    mostrarModal(); // Mostrar el modal con los datos cargados
}

function mostrarConfirmacionEliminar(index) {
    deleteIndex = index; // Almacenar el índice de la unidad a eliminar
    confirmDeleteModalInstance.show(); // Mostrar el modal de confirmación
}

// Función para eliminar una unidad del array
function eliminarUnidad(index) {
    if (unidades[index].id) {
        // Si la unidad tiene ID, marcarla como "inactiva"
        unidades[index].estado = 0; // Cambiar el estado a inactivo
    } else {
        // Si la unidad no tiene ID (es nueva), eliminarla del array
        unidades.splice(index, 1);
    }
    actualizarTablaUnidades(); // Actualizar la tabla
}

// Manejo del envío del formulario del proyecto
document.getElementById('proyectoForm').addEventListener('submit', function (event) {
    event.preventDefault();

    loader.style.display = 'flex';

    // Capturar los datos del proyecto
    const formData = new FormData(this);

    // Asegurar que se incluya el proyecto_id en cada solicitud
    if (proyectoId) {
        formData.append('proyecto_id', proyectoId); // `proyectoId` es una variable global para el proyecto actual
    }

    formData.append('unidades', JSON.stringify(unidades)); // Añadir las unidades al formulario

    const action = this.querySelector('button[type="submit"][name="action"]:focus').value;

    fetch(storeUrl, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then((response) => {
        if (!response.ok) {
            return response.json().then((data) => {
                // Mostrar alerta si se recibe un error 403 (límite de proyectos alcanzado)
                if (response.status === 403) {
                    alert(data.message); // Mensaje del controlador backend
                }
                throw new Error(data.message || 'Error al guardar el proyecto');
            });
        }
        return response.json();
    })
    .then((data) => {
        if (data.proyecto) {
            proyectoId = data.proyecto.id;  // Asignar el ID del proyecto si se guarda correctamente
            window.location.href = `/proyecto/editor/${proyectoId}`
        }

        // Actualizar las unidades en el frontend con las IDs del backend
        if (data.unidades) {
            unidades = data.unidades.map(unidad => ({ ...unidad, id: unidad.id.toString() }));  // Actualizar con las nuevas IDs
            actualizarTablaUnidades(); // Refrescar la tabla con las nuevas IDs
        }

        if (data.message) {
            alert(data.message);
        }

        if (action === 'guardar_salir') {
            window.location.href = '/proyectos'; // Redirigir a la página principal
        }
    })
    .catch((error) => console.error('Error:', error))
    .finally(
        () => {
            loader.style.display = 'none';
        }
    );
});

// Función para restablecer el formulario de la unidad
function resetUnidadForm() {
    document.getElementById('unidadForm').reset();
    document.getElementById('unidad_id').value = ''; // Reiniciar el valor del campo oculto de ID
    editIndex = null; // Reiniciar el índice de edición
}

// Función para mostrar el modal de Bootstrap
function mostrarModal() {
    if (modalInstance) {
        modalInstance.show(); // Mostrar modal usando la instancia global
    }
}

// Función para ocultar el modal de Bootstrap
function ocultarModal() {
    if (modalInstance) {
        modalInstance.hide(); // Ocultar modal usando la instancia global
    }
}

// Hacer las funciones accesibles globalmente para el manejo de eventos desde HTML
window.editarUnidad = editarUnidad;
window.abrirModalPlano = abrirModalPlano;
window.eliminarUnidad = eliminarUnidad;
window.proyectoId = proyectoId;
window.mostrarConfirmacionEliminar = mostrarConfirmacionEliminar;