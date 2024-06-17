import './bootstrap';
import 'popper.js';
import 'bootstrap';
import 'flickity';

import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';

// cambiar color boton de acordeon del offcanvas añadiendo la clase collapsed desde el comienzo
document.querySelectorAll('.custom-accordion-button').forEach((button) => {
    if (!button.classList.contains('collapsed')) {
        button.classList.add('collapsed');
    }
});

// obentener el año para el footer
const today = new Date();
const year = today.getFullYear();
const yearFooter = document.querySelector('#currentYear');
yearFooter.textContent = year;