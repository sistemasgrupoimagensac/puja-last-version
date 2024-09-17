import * as bootstrap from 'bootstrap';
const toastPayError = document.getElementById('toastPayError')
const toastBootstrapPayError = bootstrap.Toast.getOrCreateInstance(toastPayError)

function triggerToastPayError () {
  toastBootstrapPayError.show()
}

window.triggerToastPayError = triggerToastPayError;