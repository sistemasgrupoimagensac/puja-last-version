document.querySelectorAll('.amount').forEach( amount => {
    amount.addEventListener('input', function() {
        let valor = this.value.replace(/^0|[^\d]/g, '');
        valor = valor.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        this.value = valor;

        const valorEntero = valor.replace(/,/g, '');
        this.dataset.integerValue = valorEntero;
    });
});

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
    const minValue = parseInt(minimo.dataset.integerValue)
    const maxValue = parseInt(maximo.dataset.integerValue)
    if(minValue > maxValue) {
        maximo.value = null
        maximo.dataset.integerValue = null
    }
}

function compareMaxMin (maximo, minimo) {
    const minValue = parseInt(minimo.dataset.integerValue)
    const maxValue = parseInt(maximo.dataset.integerValue)
    if(minValue > maxValue) {
        minimo.value = null
        minimo.dataset.integerValue = null
    }
}

// formulario de filtros generales - MODAL
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
        console.log("change transaccion");
        
        
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
        console.log("change tipo inmueble");
        
        formFilterInmueble.submit()
    })
})


formFilterInmueble.addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe automáticamente

    let tipoOperacion = null
    let tipoInmueble = null

    const transaccionSeleccionada = parseInt(document.querySelector('input[name="transaccion"]:checked')?.value);
    const inmuebleSeleccionada = parseInt(document.querySelector('input[name="categoria"]:checked')?.value);

    if ( transaccionSeleccionada === 1 ) {
        tipoOperacion = 'venta'
    } else if ( transaccionSeleccionada === 2 ) {
        tipoOperacion = 'alquiler'
    } else if ( transaccionSeleccionada === 3 ) {
        tipoOperacion = 'remate'
    }
    
    if ( inmuebleSeleccionada === 1 ) {
        tipoInmueble = 'casas'
    } else if ( inmuebleSeleccionada === 2 ) {
        tipoInmueble = 'departamentos'
    } else if ( inmuebleSeleccionada === 3 ) {
        tipoInmueble = 'oficinas'
    } else if ( inmuebleSeleccionada === 4 ) {
        tipoInmueble = 'terrenos'
    } else if ( inmuebleSeleccionada === 5 ) {
        tipoInmueble = 'locales'
    } /* else if ( inmuebleSeleccionada === 6 ) {
        tipoInmueble = 'oficina'
    } */
    
    if ( !tipoOperacion || !tipoInmueble ) alert("Debe seleccionar el tipo de operacion y el tipo de inmueble")

    const currentUrl = window.location;
    const baseUrl = `${currentUrl.origin}/inmuebles/${tipoInmueble}-en-${tipoOperacion}`;


    // WHERE Precios en Soles - Rango 
    const precioMinimoModal = parseInt(document.getElementById("preciominimo_modal")?.dataset.integerValue)
    const precioMaximoModal = parseInt(document.getElementById("preciomaximo_modal")?.dataset.integerValue)
    const wherePrices = precioMinimoModal >= 0 && precioMaximoModal >= 0
        ? `&preciominimo=${precioMinimoModal}&preciomaximo=${precioMaximoModal}`
        : ""

    // WHERE dormitorios
    const cantDormitorios = parseInt(document.querySelector('input[name="dormitorios"]:checked')?.value);
    const whereDormitorios =  cantDormitorios > 0 ? `&dormitorios=${cantDormitorios}` : ""

    // WHERE Baños
    const cantBanios = parseInt(document.querySelector('input[name="banos"]:checked')?.value);
    const whereBanios = cantBanios > 0 ? `&banios=${cantBanios}` : ""

    // WHERE Area Total - Rango
    const areaMinima = parseInt(document.getElementById("areaminima")?.dataset.integerValue)
    const areaMaxima = parseInt(document.getElementById("areamaxima")?.dataset.integerValue)
    const whereArea = areaMinima >= 0 && areaMaxima >= 0 ? `&areaMinima=${areaMinima}&areaMaxima=${areaMaxima}` : ""

    // WHERE Antiguedad
    const antiguedad = parseInt(document.getElementById('antiguedad')?.value);
    const whereAntiguedad = typeof antiguedad === 'number' && !isNaN(antiguedad) ? whereAntiguedad = `&antiguedad=${antiguedad}` : ""

    // WHERE Estacionamientos
    const cantEstacionamientos = parseInt(document.querySelector('input[name="estacionamientos"]:checked')?.value);
    const whereEstacionamientos = cantEstacionamientos > 0 ? whereEstacionamientos = `&estacionamientos=${cantEstacionamientos}` : ""

    // WHERE caracteristicas - comodidades extras
    const valoresSeleccionados = []
    const checkboxes = document.querySelectorAll('input[name="options[]"]:checked')
    checkboxes.forEach( checkbox => valoresSeleccionados.push(checkbox.value) )
    let cadenaValores = valoresSeleccionados.join(',')
    let whereCaracteristicas =  cadenaValores.length > 0 ? `&caracteristicas=${cadenaValores}` : ""
    
    let urlTotal = `${baseUrl}?buscar=1${wherePrices}${whereDormitorios}${whereBanios}${whereArea}${whereAntiguedad}${whereEstacionamientos}${whereCaracteristicas}`
    window.location.href = urlTotal
});


document.getElementById('filtersbuscarprecios').addEventListener('click', function() {
    const currentUrl = window.location;
    const baseUrl = currentUrl.origin + currentUrl.pathname;
    const url = `${baseUrl}?preciominimo=${preciominimo.dataset.integerValue}&preciomaximo=${preciomaximo.dataset.integerValue}`;
    window.location.href = url;
});



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