import Swiper from 'swiper/bundle';

import * as bootstrap from 'bootstrap';
import 'popper.js';

const swiperProyectoImagen1 = new Swiper(".swiperProyectoImagenes1", {
  spaceBetween: 10,
  slidesPerView: 4,
  freeMode: true,
  watchSlidesProgress: true,
});

const swiperProyectoImagen2 = new Swiper(".swiperProyectoImagenes2", {
  spaceBetween: 10,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: swiperProyectoImagen1,
  },
  lazy: {
    loadPrevNext: true, // Carga la imagen siguiente y anterior
  },
});

// Inicializa el swiper del modal en fullscreen
const swiperModalGallery = new Swiper(".swiperModalGallery", {
  spaceBetween: 10,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

// Al hacer clic en las imágenes grandes (del carrusel principal), abrir el modal
document.querySelectorAll('.swiperProyectoImagenes2 .swiper-image').forEach((img, index) => {
  img.addEventListener('click', () => {
    // Mostrar el modal
    const modal = new bootstrap.Modal(document.getElementById('fullscreenModal'));
    modal.show();

    // Cambiar a la imagen correspondiente en el swiper del modal
    swiperModalGallery.slideTo(index);
  });
});

const swiperUnidadProyecto = new Swiper(".swiperUnidadProyecto", {
  slidesPerView: 1,
  spaceBetween: 10,
  freeMode: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  breakpoints: {
    640: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    980: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    1160: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    1400: {
      slidesPerView: 4,
      spaceBetween: 10,
    },
  },
});

window.swiperUnidadProyecto = swiperUnidadProyecto