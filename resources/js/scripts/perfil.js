const documentSelected = document.getElementById("document_perfil")
const documentNumber = document.getElementById("label_doc_number_perfil")
const nameInput = document.getElementById("label_name_perfil")
const surenameInput = document.getElementById("surename_perfil")

documentSelected.addEventListener("change", function () {
    let selectedCategory = documentSelected.options[documentSelected.selectedIndex].text
    let placeholderText = ""
    let placeholderName = ""

    switch (selectedCategory) {
        case "RUC":
            placeholderText = "RUC"
            placeholderName = "Nombre o Razón Social"
            surenameInput.disabled = true
            break
        default:
            placeholderText = selectedCategory
            placeholderName = "Nombre"
            surenameInput.disabled = false
            break
    }

    documentNumber.textContent = placeholderText
    nameInput.textContent = placeholderName
})