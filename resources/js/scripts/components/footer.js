// obentener el año para el footer
const today = new Date()
const year = today.getFullYear()
const yearFooter = document.querySelector('#currentYear')
yearFooter.textContent = year