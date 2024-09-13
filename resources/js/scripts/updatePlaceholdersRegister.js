import * as bootstrap from 'bootstrap';

const documentSelected = document.getElementById("document_type")
const documentNumber = document.getElementById("label_document_number")

// actualizar el placeholder de los campos =============================================
documentSelected.addEventListener("change", function () {
  let selectedCategory = documentSelected.value
  let placeholderText = ""

  switch (selectedCategory) {
    case "1":
      placeholderText = "DNI"
      break
    case "3":
      placeholderText = "RUC"
      break
    case "2":
      placeholderText = "Otro Documento"
      break
    default:
      placeholderText = "Documento"
  }

  documentNumber.textContent = placeholderText

})

// Mostrar modal para completar registro de usuario logueado con Google
document.addEventListener('DOMContentLoaded', function() {
  if (showModal) {
      const myModal = new bootstrap.Modal(document.getElementById('staticBackdropRegister'), {
          keyboard: false
      });
      myModal.show();
  }
});