const windowWidth = window.innerWidth

// Si el ancho de la ventana es mayor o igual a 992px, agrega la clase "show" a los acordeones
if (windowWidth >= 992) {
    const colapsaVentas = document.getElementById('flush-colapsaVentas')
    const colapsaAlquiler = document.getElementById('flush-colapsaAlquiler')
    const colapsaRemates = document.getElementById('flush-colapsaRemates')

    colapsaVentas.classList.add('show')
    colapsaAlquiler.classList.add('show')
    colapsaRemates.classList.add('show')
}