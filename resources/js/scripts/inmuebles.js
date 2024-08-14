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



document.querySelectorAll('.filters-relevance .filters-dropdown-li').forEach( function(item) {
    item.addEventListener('click', function() {
        const sortType = this.dataset.value;
        const sortOrder = this.dataset.sort;
        sortAvisos(sortType, sortOrder);
    });
});

function sortAvisos(sortType, sortOrder) {
    const avisosContainer = document.querySelector('.filterAvisos-container'); // Contenedor de los avisos
    const avisos = Array.from(document.querySelectorAll('.filterAvisos-card'));
    
    avisos.sort(function(a, b) {
        let aValue, bValue;

        switch (sortType) {
            case 'relevancia':
                aValue = new Date(a.dataset.relevancia);
                bValue = new Date(b.dataset.relevancia);
                console.log(`Comparando relevancia: ${aValue} y ${bValue}`);
                break;
            case 'menor_precio_soles':
            case 'mayor_precio_soles':
                aValue = parseFloat(a.dataset.precio_soles);
                bValue = parseFloat(b.dataset.precio_soles);
                console.log(`Comparando precios en soles: ${aValue} y ${bValue}`);
                break;
            case 'menor_precio_dolares':
            case 'mayor_precio_dolares':
                aValue = parseFloat(a.dataset.precio_dolares);
                bValue = parseFloat(b.dataset.precio_dolares);
                console.log(`Comparando precios en dólares: ${aValue} y ${bValue}`);
                break;
            case 'recientes':
                aValue = new Date(a.dataset.reciente);
                bValue = new Date(b.dataset.reciente);
                console.log(`Comparando fechas: ${aValue} y ${bValue}`);
                break;
            case 'vistos':
                aValue = parseInt(a.dataset.vistos);
                bValue = parseInt(b.dataset.vistos);
                console.log(`Comparando vistos: ${aValue} y ${bValue}`);
                break;
            default:
                return 0; // No se realiza ninguna ordenación
        }

        const comparison = sortOrder === 'asc' ? aValue - bValue : bValue - aValue;
        console.log(`Resultado de la comparación: ${comparison}`);
        return comparison;
    });

    avisosContainer.innerHTML = '';
    avisos.forEach(function(aviso) {
        avisosContainer.appendChild(aviso);
    });
    document.getElementById('relevanceFilterTittle').innerText = getFilterTitle(sortType);
}

function getFilterTitle(sortType) {
    switch (sortType) {
        case 'menor_precio_soles':
            return 'Menor precio Soles';
        case 'mayor_precio_soles':
            return 'Mayor precio Soles';
        case 'menor_precio_dolares':
            return 'Menor precio Dólares';
        case 'mayor_precio_dolares':
            return 'Mayor precio Dólares';
        case 'recientes':
            return 'Recientes';
        case 'vistos':
            return 'Más vistos';
        default:
            return 'Relevancia';
    }
}