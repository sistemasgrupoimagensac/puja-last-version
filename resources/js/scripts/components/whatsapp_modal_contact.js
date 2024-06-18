// modal de whatsapp
const wsapContactBtn = document.querySelector("#whatsapp_contact_button")
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
}