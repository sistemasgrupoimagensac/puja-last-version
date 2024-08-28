import * as bootstrap from 'bootstrap';
const toastPaySuccess = document.getElementById('toastPaySuccess')
const toastBootstrapPaySuccess = bootstrap.Toast.getOrCreateInstance(toastPaySuccess)

function triggerToastPaySuccess () {
  toastBootstrapPaySuccess.show()
}

window.triggerToastPaySuccess = triggerToastPaySuccess;