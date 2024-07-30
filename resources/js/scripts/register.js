const documentSelected = document.getElementById("document_type")
const documentNumber = document.getElementById("label_document_number")
const nameInput = document.getElementById("label_name")
const surenameInput = document.getElementById("surename")

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
    console.log(selectedCategory);
    let placeholderText = ""
    let placeholderName = ""

    switch (selectedCategory) {
        case "1":
            placeholderText = "DNI"
            placeholderName = "Nombre"
            surenameInput.disabled = false
            break
        case "3":
            placeholderText = "RUC"
            placeholderName = "Nombre o Razón Social"
            surenameInput.disabled = true
            break
        case "2":
            placeholderText = "Otro Documento"
            placeholderName = "Nombre"
            surenameInput.disabled = false
            break
        default:
            placeholderText = "Documento"
            placeholderName = "Nombre"
    }

    documentNumber.textContent = placeholderText
    nameInput.textContent = placeholderName
})