const documentSelected = document.getElementById('document_register')
const documentNumber = document.getElementById('label_doc_number_register')
const nameInput = document.getElementById('label_name_register')
const surenameInput = document.getElementById('surename_register')

const registerSubmit = document.querySelector('#submit-register-button')

const termsConditionCheck = document.querySelector('#terminos')
const informationCheck = document.querySelector('#confidencialidad')

let termsState = false
let informationState = false

termsConditionCheck.addEventListener('change', ()=>{
    if (termsConditionCheck.checked) {
        termsState = true
    } else {
        termsState = false
    }

    disableSubmit()
})

informationCheck.addEventListener('change', ()=>{
    if (informationCheck.checked) {
        informationState = true
    } else {
        informationState = false
    }

    disableSubmit()
})

documentSelected.addEventListener('change', function() {
    let selectedCategory = documentSelected.value
    let placeholderText = ''
    let placeholderName = ''

    switch (selectedCategory) {
        case 'DNI':
            placeholderText = 'DNI'
            placeholderName = 'Nombre'
            surenameInput.disabled = false
            break
        case 'RUC':
            placeholderText = 'RUC'
            placeholderName = 'Nombre o Razón Social'
            surenameInput.disabled = true
            break
        case 'OTRO_DOC':
            placeholderText = 'Otro Documento'
            placeholderName = 'Nombre'
            surenameInput.disabled = false
            break
        default:
            placeholderText = 'Documento'
    }

    documentNumber.textContent = placeholderText
    nameInput.textContent = placeholderName
})

function disableSubmit() {
    if ( termsState === false || informationState === false) {
        registerSubmit.disabled = true
    } else {
        registerSubmit.disabled = false
    }
}

disableSubmit()