import * as bootstrap from 'bootstrap';

// Mostrar modal para completar registro de usuario logueado con Google
document.addEventListener('DOMContentLoaded', function() {
  if (showModal) {
      const myModal = new bootstrap.Modal(document.getElementById('staticBackdropRegister'), {
          keyboard: false
      });
      myModal.show();
  }
});