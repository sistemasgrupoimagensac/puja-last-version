import * as bootstrap from 'bootstrap';
const toastSuccess = document.getElementById('toastSuccess')
const toastBootstrapSuccess = bootstrap.Toast.getOrCreateInstance(toastSuccess)

function triggerToastSuccess () {
  toastBootstrapSuccess.show()
}

window.triggerToastSuccess = triggerToastSuccess;