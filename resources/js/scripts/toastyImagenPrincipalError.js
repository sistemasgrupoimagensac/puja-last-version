import * as bootstrap from 'bootstrap';
const toastPrincipalImageError = document.getElementById('toastPrincipalImageError')
const toastBootstrapPrincipalImageError = bootstrap.Toast.getOrCreateInstance(toastPrincipalImageError)

function triggerToastPrincipalImageError () {
  toastBootstrapPrincipalImageError.show()
}

window.triggerToastPrincipalImageError = triggerToastPrincipalImageError;

// toasty error edit ==================================================
const toastPrincipalImageErrorEdit = document.getElementById('toastPrincipalImageErrorEdit')
const toastBootstrapPrincipalImageErrorEdit = bootstrap.Toast.getOrCreateInstance(toastPrincipalImageErrorEdit)

function triggerToastPrincipalImageErrorEdit () {
  toastBootstrapPrincipalImageErrorEdit.show()
}

window.triggerToastPrincipalImageErrorEdit = triggerToastPrincipalImageErrorEdit;