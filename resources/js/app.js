import 'bootstrap'
import 'popper.js'
import 'flickity'
import Alpine from 'alpinejs'

window.Alpine = Alpine
Alpine.start()

import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'


// cambiar color boton de acordeon del offcanvas añadiendo la clase collapsed desde el comienzo
document.querySelectorAll('.custom-accordion-button').forEach((button) => {
    if (!button.classList.contains('collapsed')) {
        button.classList.add('collapsed')
    }
})