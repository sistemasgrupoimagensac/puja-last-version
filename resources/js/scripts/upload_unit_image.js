document.addEventListener('DOMContentLoaded', function () {
    const unidadImgUploadButton = document.getElementById('unidadImgUploadButton');
    const unidadImgInput = document.getElementById('unidadImgInput');
    const unidadImgDropZone = document.getElementById('unidadImgDropZone');
    const unidadImgPreviewContainer = document.getElementById('unidadImgPreviewContainer');
    const unidadExistingImagesContainer = document.getElementById('unidadExistingImagesContainer');
    const unidadImgUploadModal = document.getElementById('unidadImgUploadModal');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const maxImageSize = 400 * 1024; // 400 KB en bytes
    const maxImageCount = 50;

    const existingUnitImageDeleteButtons = document.querySelectorAll('.delete-image-unidad-btn');

    // Deshabilitar el botón mientras sube imágenes
    function disableUploadButton(disable = true) {
        unidadImgUploadButton.disabled = disable;
        unidadImgUploadButton.textContent = disable ? 'Subiendo imágenes...' : 'Subir / Actualizar Imágenes';
    }

    existingUnitImageDeleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const imageId = this.dataset.id;

            if (confirm('¿Seguro de que deseas eliminar esta imagen de la unidad?')) {
                fetch(`/unidades/imagenes/${imageId}`, {
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

    let selectedImages = [];

    // Eventos para manejar el drag-and-drop y selección de archivos
    setupFileHandlers(unidadImgDropZone, unidadImgInput, handleFiles);

    // Cargar imágenes existentes al abrir el modal
    unidadImgUploadModal.addEventListener('shown.bs.modal', () => loadExistingImages(unidadImgUploadButton.dataset.unidadId));

    // Subir las imágenes seleccionadas
    unidadImgUploadButton.addEventListener('click', () => uploadImages(unidadImgUploadButton.dataset.unidadId));

    // Función para inicializar los manejadores de archivos
    function setupFileHandlers(dropZone, fileInput, callback) {
        if (!dropZone || !fileInput) return;

        dropZone.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', () => processFiles(Array.from(fileInput.files), callback));
        setupDragAndDrop(dropZone, callback);
    }

    // Configurar eventos de drag-and-drop
    function setupDragAndDrop(dropZone, callback) {
        dropZone.addEventListener('dragover', (e) => e.preventDefault());
        dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
        dropZone.addEventListener('drop', (event) => {
            event.preventDefault();
            dropZone.classList.remove('dragover');
            processFiles(Array.from(event.dataTransfer.files), callback);
        });
    }

    // Procesar archivos seleccionados y validarlos
    function processFiles(files, callback) {
        files.forEach(file => validateFile(file) && callback(file));
        unidadImgInput.disabled = selectedImages.length >= maxImageCount;
    }

    // Validar tamaño y formato de los archivos
    function validateFile(file) {
        if (file.size > maxImageSize) return showAlert(`La imagen ${file.name} supera el tamaño máximo de 400KB.`);
        if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) return showAlert(`El formato ${file.name} no es válido.`);
        if (selectedImages.length >= maxImageCount) return showAlert(`Has alcanzado el límite de 50 imágenes.`);
        return true;
    }

    // Mostrar vista previa de la imagen seleccionada
    function handleFiles(file) {
        selectedImages.push(file);
        displayImagePreview(file, unidadImgPreviewContainer, () => removeImage(file.name));
    }

    // Mostrar la vista previa de la imagen en un contenedor
    function displayImagePreview(file, container, removeCallback) {
        const reader = new FileReader();
        reader.onload = () => {
            const imageElement = createImageElement(reader.result, file.name, removeCallback);
            container.appendChild(imageElement);
        };
        reader.readAsDataURL(file);
    }

    // Crear el elemento de imagen con la opción de eliminar
    function createImageElement(src, fileName, removeCallback) {
        const imageElement = document.createElement('div');
        imageElement.classList.add('image-preview');
        imageElement.innerHTML = `
          <img src="${src}" alt="${fileName}">
          <button class="remove-image-btn btn-close">
              <i class="fa-solid fa-xmark"></i>
          </button>
      `;
        imageElement.querySelector('.remove-image-btn').addEventListener('click', () => {
            removeCallback();
            imageElement.remove();
        });
        return imageElement;
    }

    // Eliminar una imagen seleccionada del array
    function removeImage(fileName) {
        selectedImages = selectedImages.filter(file => file.name !== fileName);
        unidadImgInput.disabled = selectedImages.length >= maxImageCount;
    }

    // Subir imágenes seleccionadas al servidor
    function uploadImages(unidadId) {
        if (!unidadId || selectedImages.length === 0) return showAlert('Por favor, seleccione una unidad e imágenes.');

        const formData = new FormData();
        selectedImages.forEach(image => formData.append('images[]', image));

        disableUploadButton(true)

        fetch(`/unidades/${unidadId}/imagenes`, { method: 'POST', body: formData, headers: { 'X-CSRF-TOKEN': csrfToken } })
            .then(response => response.json())
            .then(data => {
                showAlert('Imágenes subidas correctamente.');
                selectedImages = [];
                unidadImgPreviewContainer.innerHTML = '';
                loadExistingImages(unidadId);
            })
            .catch(() => showAlert('Hubo un error al subir las imágenes.'))
            .finally(() => {
                // Habilitar el botón nuevamente
                disableUploadButton(false);
            });
    }

    // Cargar imágenes existentes desde la base de datos
    function loadExistingImages(unidadId) {

        if (!unidadId) return;
        unidadExistingImagesContainer.innerHTML = '';

        fetch(`/unidades/${unidadId}/imagenes`, { method: 'GET', headers: { 'X-CSRF-TOKEN': csrfToken } })
            .then(response => response.json())
            .then(data => data.images.forEach(displayExistingImage))
            .catch(() => showAlert('Error al cargar las imágenes.'));
    }

    // Mostrar la vista previa de las imágenes existentes
    function displayExistingImage(image) {
        const imageElement = createImageElement(image.image_url, `Imagen de la Unidad`, () => deleteImage(image.id, imageElement));
        unidadExistingImagesContainer.appendChild(imageElement);
    }

    // Eliminar una imagen de la base de datos
    function deleteImage(imageId, element) {
        if (!confirm('¿Estás seguro de que deseas eliminar esta imagen?')) return;

        fetch(`/unidades/imagenes/${imageId}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': csrfToken } })
            .then(response => response.json())
            .then(data => data.success && element.remove())
            .catch(() => showAlert('Error al eliminar la imagen.'));
    }

    // Mostrar alertas simplificadas
    function showAlert(message) {
        alert(message);
    }
});
