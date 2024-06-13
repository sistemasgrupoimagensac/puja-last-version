// logica para que el precio minimo siempre sea menor que el precio maximo ==========================================
const preciominimo = document.querySelector('#preciominimo')
const preciomaximo = document.querySelector('#preciomaximo')

preciominimo.addEventListener('change', () => compareMinMax(preciominimo, preciomaximo))
preciomaximo.addEventListener('change', () => compareMaxMin(preciomaximo, preciominimo))

// logica para que el área minima siempre sea menor que el area maxima
const areaminima = document.querySelector('#areaminima')
const areamaxima = document.querySelector('#areamaxima')

areaminima.addEventListener('change', () => compareMinMax(areaminima, areamaxima))
areamaxima.addEventListener('change', () => compareMaxMin(areamaxima, areaminima))

// funciones de comparacion de minimo con maximo
function compareMinMax (minimo, maximo) {
    const minValue = parseInt(minimo.value)
    const maxValue = parseInt(maximo.value)
    if(minValue > maxValue) {
        maximo.value = null
    }
}

function compareMaxMin (maximo, minimo) {
    const minValue = parseInt(minimo.value)
    const maxValue = parseInt(maximo.value)
    if(minValue > maxValue) {
        minimo.value = null
    }
}

// logica para cambiar nombre del titulo del filtro TRANSACCION ===================================================================
const dropdownItemsVenta = document.querySelectorAll('.filters-dropdown-li.trasaction')
const filterTitleVenta = document.getElementById('trasactionfiltertittle')

dropdownItemsVenta.forEach(function(item) {
    item.addEventListener('click', function(event) {
        event.preventDefault()

        const selectedValue = this.getAttribute('data-value')

        if (selectedValue === 'venta') {
            filterTitleVenta.textContent = 'Venta'
        } else if (selectedValue === 'alquiler') {
            filterTitleVenta.textContent = 'Alquiler'
        } else if (selectedValue === 'remate') {
            filterTitleVenta.textContent = 'Remate'
        }
    })
})

// logica para cambiar nombre del titulo del filtro TIPO INMUEBLE ===================================================================
const dropdownItemsTipo = document.querySelectorAll('.filters-dropdown-li.tipo')
const filterTitleTipo = document.getElementById('tipofiltertittle')

dropdownItemsTipo.forEach(function(item) {
    item.addEventListener('click', function(event) {
        event.preventDefault()

        const selectedValue = this.getAttribute('data-value')

        if (selectedValue === 'departamento') {
            filterTitleTipo.textContent = 'Departamento'
        } else if (selectedValue === 'casa') {
            filterTitleTipo.textContent = 'Casa'
        } else if (selectedValue === 'local_comercial') {
            filterTitleTipo.textContent = 'Local Comercial'
        } else if (selectedValue === 'oficina') {
            filterTitleTipo.textContent = 'Oficina'
        } else if (selectedValue === 'terreno') {
            filterTitleTipo.textContent = 'Terreno / Lote'
        } else if (selectedValue === 'casa_campo') {
            filterTitleTipo.textContent = 'Casa de Campo'
        } else if (selectedValue === 'casa_playa') {
            filterTitleTipo.textContent = 'Casa de Playa'
        }
    })
})