import * as bootstrap from 'bootstrap';

const documentSelected = document.getElementById("document_type")
const documentNumber = document.getElementById("label_document_number")
const registerSubmit = document.querySelector("#submit-register-button")
const termsConditionCheck = document.querySelector("#terminos")

// deshabilitar boton registrar =======================================================
let termsState = false

termsConditionCheck.addEventListener("change", () => {
    if (termsConditionCheck.checked) {
        termsState = true
    } else {
        termsState = false
    }
    disableSubmit()
})

function disableSubmit() {
    if (termsState === false) {
        registerSubmit.disabled = true
    } else {
        registerSubmit.disabled = false
    }
}
disableSubmit()

// actualizar el placeholder de los campos =============================================
documentSelected.addEventListener("change", function () {
  let selectedCategory = documentSelected.value
  let placeholderText = ""
  let placeholderName = ""

  switch (selectedCategory) {
    case "1":
      placeholderText = "DNI"
      break
    case "2":
      placeholderText = "RUC"
      break
    case "3":
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