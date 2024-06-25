// logica para que el precio minimo siempre sea menor que el precio maximo ==========================================
const preciominimo = document.querySelector('#preciominimo')
const preciomaximo = document.querySelector('#preciomaximo')
const preciominimoModal = document.querySelector('#preciominimo_modal')
const preciomaximoModal = document.querySelector('#preciomaximo_modal')

preciominimo.addEventListener('change', () => compareMinMax(preciominimo, preciomaximo))
preciomaximo.addEventListener('change', () => compareMaxMin(preciomaximo, preciominimo))
preciominimoModal.addEventListener('change', () => compareMinMax(preciominimoModal, preciomaximoModal))
preciomaximoModal.addEventListener('change', () => compareMaxMin(preciomaximoModal, preciominimoModal))

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

// formulario de filtros generales
const formFilterInmueble = document.getElementById('formFilterInmueble')

// logica para cambiar nombre del titulo del filtro TRANSACCION ===================================================================
const dropdownItemsVenta = document.querySelectorAll('.filters-dropdown-li.trasaction')
const filterTitleVenta = document.getElementById('trasactionfiltertittle')

dropdownItemsVenta.forEach(function(item) {
    item.addEventListener('click', function(event) {
        event.preventDefault()

        const selectedValue = this.getAttribute('data-value')

        formFilterInmueble.querySelectorAll('[name="transaccion"]').forEach(function(operacion) {
            if (selectedValue === 'todos') {
                operacion.checked = false
            }else {
                if (operacion.value === selectedValue) {
                    operacion.checked = true
                }
            }
        })
        
        formFilterInmueble.submit()
    })
})

// logica para cambiar nombre del titulo del filtro TIPO INMUEBLE ===================================================================
const dropdownItemsTipo = document.querySelectorAll('.filters-dropdown-li.tipo')
const filterTitleTipo = document.getElementById('tipofiltertittle')

dropdownItemsTipo.forEach(function(item) {
    item.addEventListener('click', function(event) {
        event.preventDefault()

        const selectedValue = this.getAttribute('data-value')

        formFilterInmueble.querySelectorAll('[name="categoria"]').forEach(function(tipo_inmueble) {
            if (selectedValue === 'todos') {
                tipo_inmueble.checked = false
            }else {
                if (tipo_inmueble.value === selectedValue) {
                    tipo_inmueble.checked = true
                }
            }
        })
        
        formFilterInmueble.submit()
    })
})