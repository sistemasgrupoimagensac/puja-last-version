// import 'bootstrap'
import * as bootstrap from 'bootstrap';
import 'popper.js'
import 'flickity'
import Alpine from 'alpinejs'

window.Alpine = Alpine
Alpine.start()

import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'

// Inicializar tooltips
document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
});

// cambiar color boton de acordeon del offcanvas añadiendo la clase collapsed desde el comienzo
document.querySelectorAll('.custom-accordion-button').forEach((button) => {
    if (!button.classList.contains('collapsed')) {
        button.classList.add('collapsed')
    }
})
