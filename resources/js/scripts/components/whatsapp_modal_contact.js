// modal de whatsapp
/* const wsapContactBtn = document.querySelector("#whatsapp_contact_button")
const wsapDialog = document.querySelector("#whatsapp-dialog")

wsapContactBtn.addEventListener("click", function () {
  console.log('hola')
  document.body.classList.add("modal-open")
  wsapDialog.showModal()
})

wsapDialog.addEventListener("close", function () {
  document.body.classList.remove("modal-open")
})

wsapDialog.addEventListener("click", function (event) {
  if (event.target === wsapDialog) {
    closeModal()
  }
})

function closeModal() {
  document.body.classList.remove("modal-open")
  wsapDialog.close()
} */


document.addEventListener('DOMContentLoaded', () => {
  const wsapContactBtns = document.querySelectorAll("[id^='whatsapp_contact_button']");
  wsapContactBtns.forEach(button => {
      button.addEventListener("click", function () {
          const idCaracteristica = button.getAttribute('data-caract-id');
          const wsapDialog = document.querySelector(`#whatsapp-dialog_${idCaracteristica}`);
          document.body.classList.add("modal-open");
          wsapDialog.showModal();
      });
  });

  const wsapDialogs = document.querySelectorAll("[id^='whatsapp-dialog']");
  wsapDialogs.forEach(dialog => {
      dialog.addEventListener("close", function () {
          document.body.classList.remove("modal-open");
      });

      dialog.addEventListener("click", function (event) {
          if (event.target === dialog) {
              closeModal(dialog.getAttribute('data-caract-id'));
          }
      });
  });

  window.closeModal = function (idCaracteristica) {
    const wsapDialog = document.querySelector(`#whatsapp-dialog_${idCaracteristica}`);
    document.body.classList.remove("modal-open");
    wsapDialog.close();
  };
});

/* function closeModal(avisoId) {
  const wsapDialog = document.querySelector(`#whatsapp-dialog_${avisoId}`);
  document.body.classList.remove("modal-open");
  wsapDialog.close();
} */
