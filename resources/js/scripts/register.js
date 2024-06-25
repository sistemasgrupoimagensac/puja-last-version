const documentSelected = document.getElementById("document_type")
const documentNumber = document.getElementById("label_document_number")
const nameInput = document.getElementById("label_name")
const surenameInput = document.getElementById("surename")

const registerSubmit = document.querySelector("#submit-register-button")

const termsConditionCheck = document.querySelector("#terminos")
const informationCheck = document.querySelector("#confidencialidad")

// deshabilitar boton registrar =======================================================
let termsState = false
let informationState = false

termsConditionCheck.addEventListener("change", () => {
    if (termsConditionCheck.checked) {
        termsState = true
    } else {
        termsState = false
    }
    disableSubmit()
})

informationCheck.addEventListener("change", () => {
    if (informationCheck.checked) {
        informationState = true
    } else {
        informationState = false
    }

    disableSubmit()
})

function disableSubmit() {
    if (termsState === false || informationState === false) {
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
        case "DNI":
            placeholderText = "DNI"
            placeholderName = "Nombre"
            surenameInput.disabled = false
            break
        case "RUC":
            placeholderText = "RUC"
            placeholderName = "Nombre o Razón Social"
            surenameInput.disabled = true
            break
        case "OTRO_DOC":
            placeholderText = "Otro Documento"
            placeholderName = "Nombre"
            surenameInput.disabled = false
            break
        default:
            placeholderText = "Documento"
    }

    documentNumber.textContent = placeholderText
    nameInput.textContent = placeholderName
})