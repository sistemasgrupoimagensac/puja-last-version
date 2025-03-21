// import 'bootstrap'
import * as bootstrap from 'bootstrap'
import 'popper.js'

// flickity
import 'flickity';
import 'flickity-fullscreen';
import 'flickity-as-nav-for';

// Swiper
import "./swiper.js"

// Alpine
import Alpine from 'alpinejs'

window.Alpine = Alpine
Alpine.start()

import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'
import './scripts/toggleLike';

window.bootstrap = bootstrap

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

// REPLACE para formatod de telefono
document.querySelectorAll('.phone').forEach( phone => {
    phone.addEventListener('input', function() {
        this.value = this.value.replace(/[^\d]/g, '');
        if (this.value.length > 9) {
            this.value = this.value.slice(0, 9);
        }
    });
});