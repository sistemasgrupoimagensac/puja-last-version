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
    case "DNI":
      placeholderText = "DNI"

      break
    case "RUC":
      placeholderText = "RUC"

      break
    case "OTRO_DOC":
      placeholderText = "Otro Documento"

      break
    default:
      placeholderText = "Documento"

  }

  documentNumber.textContent = placeholderText

})