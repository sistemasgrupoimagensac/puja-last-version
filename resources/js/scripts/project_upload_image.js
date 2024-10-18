document.addEventListener('DOMContentLoaded', function () {
    // Obtener el ID del proyecto desde el formulario
    const proyectoForm = document.getElementById('proyectoForm');
    const proyectoId = proyectoForm ? proyectoForm.dataset.proyectoId : null;

    const dropZone = document.getElementById('proyectoImgDropZone');
    const proyectoImgInput = document.getElementById('proyectoImgInput');
    const proyectoImgPreviewContainer = document.getElementById('proyectoImgPreviewContainer');
    const proyectoImgUploadButton = document.getElementById('proyectoImgUploadButton');
    const maxImageSize = 400 * 1024; // 400 KB en bytes
    const maxImageCount = 50;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const existingImageDeleteButtons = document.querySelectorAll('.delete-image-btn');
    const principalCheckboxes = document.querySelectorAll('.principal-checkbox');

    // Deshabilitar el botón mientras sube imágenes
    function disableUploadButton(disable = true) {
        proyectoImgUploadButton.disabled = disable;
        proyectoImgUploadButton.textContent = disable ? 'Subiendo imágenes...' : 'Subir / Actualizar Imágenes';
    }

    existingImageDeleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const imageId = this.dataset.id;

            if (confirm('¿Estás seguro de que deseas eliminar esta imagen?')) {
                fetch(`/proyectos/${proyectoId}/imagenes/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken, // Token CSRF para la eliminación en Laravel
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message === 'Imagen eliminada correctamente.') {
                            // Eliminar la miniatura de la interfaz si la eliminación es exitosa
                            this.parentElement.remove();
                            alert('Imagen eliminada correctamente.');
                        } else if (response.status === 500) {
                            alert('El estado de la imagen fue actualizado, pero no se pudo eliminar de Wasabi.');
                        } else {
                            alert('Error al eliminar la imagen.');
                        }
                    })
                    .catch(error => {
                        console.error('Error al eliminar la imagen:', error);
                        alert('Hubo un error al eliminar la imagen.');
                    });
            }
        });
    });

    let selectedImages = []; // Array para almacenar las imágenes seleccionadas

    // Selección de la imagen principal
    principalCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (this.checked) {
                updatePrincipalImage(this.value);
            }
        });
    });

    // Función para actualizar la imagen principal en la base de datos
    function updatePrincipalImage(imageId) {
        fetch(`/proyectos/${proyectoId}/imagenes-principal`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                image_id: imageId
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Imagen principal actualizada correctamente.');
                } else {
                    alert('Error al actualizar la imagen principal.');
                }
            })
            .catch(error => {
                console.error('Error al actualizar la imagen principal:', error);
            });
    }

    // Mostrar el input de selección de archivos al hacer clic en el contenedor de arrastre
    dropZone.addEventListener('click', () => proyectoImgInput.click());

    // Manejar archivos seleccionados a través del input
    proyectoImgInput.addEventListener('change', () => {
        const files = Array.from(proyectoImgInput.files); // Obtener las imágenes seleccionadas desde el input
        handleFiles(files); // Procesar las imágenes seleccionadas
        proyectoImgInput.value = ""; // Restablecer el input para permitir la selección repetida
    });

    // Manejo de eventos de arrastre (drag and drop)
    dropZone.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropZone.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));

    dropZone.addEventListener('drop', (event) => {
        event.preventDefault();
        dropZone.classList.remove('dragover');
        handleFiles(Array.from(event.dataTransfer.files)); // Convertir la lista de archivos en un array y procesarlos
    });

    // Manejar la subida de imágenes
    proyectoImgUploadButton.addEventListener('click', () => {
        if (selectedImages.length === 0) {
            alert('No has seleccionado ninguna imagen.');
            return;
        }

        if (!proyectoId) {
            alert('Por favor, primero guarde el proyecto.');
            return;
        }

        // Deshabilitar el botón mientras sube las imágenes
        disableUploadButton(true);

        // Crear un FormData para enviar las imágenes
        const formData = new FormData();

        selectedImages.forEach((image) => {
            formData.append('images[]', image);
        });

        // Enviar las imágenes a través de fetch
        fetch(`/proyectos/${proyectoId}/imagenes`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken // Incluir el token CSRF para protección en Laravel
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error al subir las imágenes: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                alert('Imágenes subidas correctamente.');
            })
            .catch(error => {
                console.error('Error al subir las imágenes:', error);
                alert('Hubo un error al subir las imágenes.');
            })
            .finally(() => {
                // Habilitar el botón nuevamente
                disableUploadButton(false);
            });
    });

    // Función para manejar la selección de archivos
    function handleFiles(files) {
        files.forEach(file => {
            if (validateFile(file)) {
                selectedImages.push(file); // Añadir imagen al array de imágenes seleccionadas
                displayImagePreview(file); // Mostrar miniatura de la imagen
            }
        });

        // Desactivar el input si se alcanza el límite
        if (selectedImages.length >= maxImageCount) {
            proyectoImgInput.disabled = true;
        }
    }

    // Validar tamaño y formato de archivo
    function validateFile(file) {
        if (file.size > maxImageSize) {
            alert(`La imagen ${file.name} supera el tamaño máximo de 400KB.`);
            return false;
        }
        if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
            alert(`El archivo ${file.name} no es un formato de imagen válido.`);
            return false;
        }
        if (selectedImages.length >= maxImageCount) {
            alert(`Has alcanzado el límite de 50 imágenes.`);
            return false;
        }
        return true;
    }

    // Mostrar la vista previa de las imágenes seleccionadas
    function displayImagePreview(file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const imageElement = document.createElement('div');
            imageElement.classList.add('image-preview');
            imageElement.innerHTML = `
              <img src="${e.target.result}" alt="${file.name}">
              <button class="remove-image-btn btn-close d-flex justify-content-center align-items-center" data-name="${file.name}">
                <i class="fa-solid fa-xmark"></i>
              </button>
          `;
            proyectoImgPreviewContainer.appendChild(imageElement);

            // Botón para eliminar la miniatura
            imageElement.querySelector('.remove-image-btn').addEventListener('click', () => {
                removeImage(file.name);
                imageElement.remove();
            });
        };
        reader.readAsDataURL(file);
    }

    // Eliminar una imagen del arreglo y habilitar el input si corresponde
    function removeImage(fileName) {
        selectedImages = selectedImages.filter(file => file.name !== fileName);
        proyectoImgInput.disabled = selectedImages.length >= maxImageCount ? true : false;
    }
});
