import * as bootstrap from 'bootstrap';

const documentSelected = document.getElementById("document_type")
const documentNumber = document.getElementById("label_document_number")

// actualizar el placeholder de los campos =============================================
documentSelected?.addEventListener("change", function () {

	let selectedCategory = documentSelected.value
	let placeholderText = ""

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

let showModal = false

// Mostrar modal para completar registro de usuario logueado con Google
document.addEventListener('DOMContentLoaded', function() {

	if (typeof window.showModal !== 'undefined' && window.showModal) {

		const myModal = new bootstrap.Modal(document.getElementById('staticBackdropRegister'), {
			keyboard: false,
		});
		myModal.show();

	}

});