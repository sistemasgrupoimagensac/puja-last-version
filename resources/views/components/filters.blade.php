
{{-- Filtros --}}
<div class="d-flex justify-content-between">

  <div class="d-flex gap-3">

    <div class="btn-group d-none d-xl-inline-flex">
      <button type="button" class="btn border dropdown-toggle py-2 " data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="true">
        <i class="fa-solid fa-tag icon-orange me-2"></i>
        <span id="trasactionfiltertittle">@if(request()->get('transaccion') == 1) Venta @elseif(request()->get('transaccion') == 2) Alquiler @elseif(request()->get('transaccion') == 3) Remate @endif</span>
      </button>
      <ul class="dropdown-menu">
        <li class="dropdown-item filters-dropdown-li trasaction" data-value="venta">
          Venta
        </li>
        <li class="dropdown-item filters-dropdown-li trasaction" data-value="alquiler">
          Alquiler
        </li>
        <li class="dropdown-item filters-dropdown-li trasaction" data-value="remate">
          Remate
        </li>
      </ul>
    </div>
  
    {{-- Tipo inmueble --}}
    <div class="btn-group d-none d-xl-inline-flex">
      <button type="button" class="btn border dropdown-toggle py-2 " data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="true">
        <i class="fa-solid fa-city icon-orange me-2"></i>
        <span id="tipofiltertittle">Departamento</span>
      </button>
      <ul class="dropdown-menu ">
        <li class="dropdown-item filters-dropdown-li tipo" data-value="departamento">
          Departamento
        </li>
        <li class="dropdown-item filters-dropdown-li tipo" data-value="casa">
          Casa
        </li>
        <li class="dropdown-item filters-dropdown-li tipo" data-value="local_comercial">
          Local Comercial
        </li>
        <li class="dropdown-item filters-dropdown-li tipo" data-value="oficina">
          Oficina
        </li>
        <li class="dropdown-item filters-dropdown-li tipo" data-value="terreno">
          Terreno / Lote
        </li>
        <li class="dropdown-item filters-dropdown-li tipo" data-value="casa_campo">
          Casa de Campo
        </li>
        <li class="dropdown-item filters-dropdown-li tipo" data-value="casa_playa">
          Casa de Playa
        </li>
      </ul>
    </div>
  
    {{-- Precio Inmueble --}}
    <div class="btn-group d-none d-xl-inline-flex filters-price-desktop ">
      <button type="button" class="btn border dropdown-toggle py-2 " data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="true" aria-label="Orden">
        <i class="fa-solid fa-money-bill-1 icon-orange me-2"></i>
        <span id="ventafiltertittle">Precio</span>
      </button>
      <ul class="dropdown-menu p-2 ">
  
        <div class="d-flex justify-content-between align-items-center mb-1">
          <h6 class="m-0">Precio</h6>
          <div>
            <small class="text-primary fw-bold button-filter-price" id="filtersbuscarprecios">Aplicar</small>
          </div>
        </div>
  
        <div class="d-flex gap-3">
          <select type="text" class="form-select" name="preciominimo" id="preciominimo" aria-label="Precio mínimo">
            <option value="null" selected>Sin Mínimo</option>
            <option value="100">$100</option>
            <option value="150">$150</option>
            <option value="200">$200</option>
            <option value="250">$250</option>
            <option value="300">$300</option>
            <option value="350">$350</option>
            <option value="400">$400</option>
            <option value="450">$450</option>
            <option value="500">$500</option>
            <option value="600">$600</option>
            <option value="700">$700</option>
            <option value="800">$800</option>
            <option value="900">$900</option>
            <option value="1000">$1,000</option>
            <option value="1100">$1,100</option>
            <option value="1200">$1,200</option>
            <option value="1300">$1,300</option>
            <option value="1400">$1,400</option>
            <option value="1500">$1,500</option>
            <option value="1600">$1,600</option>
            <option value="1700">$1,700</option>
            <option value="1800">$1,800</option>
            <option value="2000">$2,000</option>
            <option value="2100">$2,100</option>
            <option value="2200">$2,200</option>
            <option value="2300">$2,300</option>
            <option value="2400">$2,400</option>
            <option value="2500">$2,500</option>
            <option value="2600">$2,600</option>
            <option value="2700">$2,700</option>
            <option value="2800">$2,800</option>
            <option value="2900">$2,900</option>
            <option value="3000">$3,000</option>
            <option value="3250">$3,250</option>
            <option value="3500">$3,500</option>
            <option value="3750">$3,750</option>
            <option value="4000">$4,000</option>
            <option value="4500">$4,500</option>
            <option value="5000">$5,000</option>
            <option value="6000">$6,000</option>
            <option value="8000">$8,000</option>
            <option value="10000">$10,000</option>
            <option value="15000">$15,000</option>
            <option value="20000">$20,000</option>
            <option value="30000">$30,000</option>
          </select>
  
          <select type="text" class="form-select" name="preciomaximo" id="preciomaximo" aria-label="Precio máximo">
            <option value="null" selected>Sin Máximo</option>
            <option value="100">$100</option>
            <option value="150">$150</option>
            <option value="200">$200</option>
            <option value="250">$250</option>
            <option value="300">$300</option>
            <option value="350">$350</option>
            <option value="400">$400</option>
            <option value="450">$450</option>
            <option value="500">$500</option>
            <option value="600">$600</option>
            <option value="700">$700</option>
            <option value="800">$800</option>
            <option value="900">$900</option>
            <option value="1000">$1,000</option>
            <option value="1100">$1,100</option>
            <option value="1200">$1,200</option>
            <option value="1300">$1,300</option>
            <option value="1400">$1,400</option>
            <option value="1500">$1,500</option>
            <option value="1600">$1,600</option>
            <option value="1700">$1,700</option>
            <option value="1800">$1,800</option>
            <option value="2000">$2,000</option>
            <option value="2100">$2,100</option>
            <option value="2200">$2,200</option>
            <option value="2300">$2,300</option>
            <option value="2400">$2,400</option>
            <option value="2500">$2,500</option>
            <option value="2600">$2,600</option>
            <option value="2700">$2,700</option>
            <option value="2800">$2,800</option>
            <option value="2900">$2,900</option>
            <option value="3000">$3,000</option>
            <option value="3250">$3,250</option>
            <option value="3500">$3,500</option>
            <option value="3750">$3,750</option>
            <option value="4000">$4,000</option>
            <option value="4500">$4,500</option>
            <option value="5000">$5,000</option>
            <option value="6000">$6,000</option>
            <option value="8000">$8,000</option>
            <option value="10000">$10,000</option>
            <option value="15000">$15,000</option>
            <option value="20000">$20,000</option>
            <option value="30000">$30,000</option>
          </select>
        </div>
    
      </ul>
    </div>
  
    {{-- Filtros Generales --}}
    <div>
    
      <!-- Botón Filtros Generales -->
      <button type="button" class="btn border py-2 " data-bs-toggle="modal" data-bs-target="#filterModal">
        <i class="fa-solid fa-filter icon-orange me-2"></i>
        Filtros
      </button>
      
      <!-- Modal Filtros Generales -->
      <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content ">
      
            <form class="modal-body overflow-x-hidden p-0">
              <div class="modal-header justify-content-between p-2 ps-4">
                
                {{-- Filtros Modal - titulo --}}
                <h5 class="modal-title">Filtros</h5>
                <button type="button" class="btn p-0" data-bs-dismiss="modal" aria-label="Close">
                  <i class="fa-solid fa-xmark icon-orange fa-xl m-3"></i>
                </button>
        
              </div>
              
              {{-- Filtros Modal - contenido --}}
              <div class="p-3">
      
                {{-- tipo de transaccion --}}
                <div class="btn-group w-100" role="group">
                  <input type="radio" class="btn-check" name="tipo_transaccion" id="comprarfilter" autocomplete="off" value="comprar" checked>
                  <label class="btn btn-outline-primary button-filter" for="comprarfilter">Comprar</label>
                
                  <input type="radio" class="btn-check" name="tipo_transaccion" id="alquilarfilter" autocomplete="off" value="alquilar">
                  <label class="btn btn-outline-primary button-filter" for="alquilarfilter">Alquilar</label>
                
                  <input type="radio" class="btn-check" name="tipo_transaccion" id="rematesfilter" autocomplete="off" value="remates">
                  <label class="btn btn-outline-primary button-filter" for="rematesfilter">Remates</label>
                </div>
        
                {{-- tipo de inmueble --}}
                <div class="mt-4">
                  <h6 class="mb-2 text-primary">Tipo de inmueble</h6>
                  <div class="container text-center my-2 px-1">
                    <div class="row">
          
                      <input type="radio" class="btn-check" name="tipo_inmueble" id="departamento" autocomplete="off" value="departamento" checked>
                      <label class="btn button-clear aside-menu col m-2 p-1 d-flex flex-column justify-content-center" for="departamento">
                        <i class="fa-solid fa-building text-secondary fa-xl my-4"></i>
                        <small class="text-secondary">Departamento</small>
                      </label>
              
                      <input type="radio" class="btn-check" name="tipo_inmueble" id="casa" autocomplete="off" value="casa">
                      <label class="btn button-clear aside-menu col m-2 p-1 d-flex flex-column justify-content-center" for="casa">
                        <i class="fa-solid fa-house-user text-secondary fa-xl my-4"></i>
                        <small class="text-secondary">Casa</small>
                      </label>
          
                      <input type="radio" class="btn-check" name="tipo_inmueble" id="local_comercial" autocomplete="off" value="local_comercial">
                      <label class="btn button-clear aside-menu col m-2 p-1 d-flex flex-column justify-content-center" for="local_comercial">
                        <i class="fa-solid fa-shop text-secondary fa-xl my-4"></i>
                        <small class="text-secondary">Local Comercial</small>
                      </label>
          
                    </div>
          
                    <div class="row">
          
                      <input type="radio" class="btn-check" name="tipo_inmueble" id="oficina" autocomplete="off" value="oficina">
                      <label class="btn button-clear aside-menu col m-2 p-1 d-flex flex-column justify-content-center" for="oficina">
                        <i class="fa-regular fa-building text-secondary fa-xl my-4"></i>
                        <small class="text-secondary">Oficina</small>
                      </label>
              
                      <input type="radio" class="btn-check" name="tipo_inmueble" id="terreno" autocomplete="off" value="terreno">
                      <label class="btn button-clear aside-menu col m-2 p-1 d-flex flex-column justify-content-center" for="terreno">
                        <i class="fa-solid fa-mountain-sun text-secondary fa-xl my-4"></i>
                        <small class="text-secondary">Terreno</small>
                      </label>
          
                      <input type="radio" class="btn-check" name="tipo_inmueble" id="local_industrial" autocomplete="off" value="local_industrial">
                      <label class="btn button-clear aside-menu col m-2 p-1 d-flex flex-column justify-content-center" for="local_industrial">
                        <i class="fa-solid fa-industry text-secondary fa-xl my-4"></i>
                        <small class="text-secondary">Local Industrial</small>
                      </label>
          
                    </div>
                  </div>
                </div>
        
                {{-- precio --}}
                <div class="mt-4">
                  <h6 class="mb-2 text-primary">Precio</h6>
                  <div class="d-flex gap-3">
                    <select type="text" class="form-select" name="preciominimo" id="preciominimo" aria-label="Precio mínimo">
                      <option value="null" selected>Sin Mínimo</option>
                      <option value="100">$100</option>
                      <option value="150">$150</option>
                      <option value="200">$200</option>
                      <option value="250">$250</option>
                      <option value="300">$300</option>
                      <option value="350">$350</option>
                      <option value="400">$400</option>
                      <option value="450">$450</option>
                      <option value="500">$500</option>
                      <option value="600">$600</option>
                      <option value="700">$700</option>
                      <option value="800">$800</option>
                      <option value="900">$900</option>
                      <option value="1000">$1,000</option>
                      <option value="1100">$1,100</option>
                      <option value="1200">$1,200</option>
                      <option value="1300">$1,300</option>
                      <option value="1400">$1,400</option>
                      <option value="1500">$1,500</option>
                      <option value="1600">$1,600</option>
                      <option value="1700">$1,700</option>
                      <option value="1800">$1,800</option>
                      <option value="2000">$2,000</option>
                      <option value="2100">$2,100</option>
                      <option value="2200">$2,200</option>
                      <option value="2300">$2,300</option>
                      <option value="2400">$2,400</option>
                      <option value="2500">$2,500</option>
                      <option value="2600">$2,600</option>
                      <option value="2700">$2,700</option>
                      <option value="2800">$2,800</option>
                      <option value="2900">$2,900</option>
                      <option value="3000">$3,000</option>
                      <option value="3250">$3,250</option>
                      <option value="3500">$3,500</option>
                      <option value="3750">$3,750</option>
                      <option value="4000">$4,000</option>
                      <option value="4500">$4,500</option>
                      <option value="5000">$5,000</option>
                      <option value="6000">$6,000</option>
                      <option value="8000">$8,000</option>
                      <option value="10000">$10,000</option>
                      <option value="15000">$15,000</option>
                      <option value="20000">$20,000</option>
                      <option value="30000">$30,000</option>
                    </select>
        
                    <select type="text" class="form-select" name="preciomaximo" id="preciomaximo" aria-label="Precio máximo">
                      <option value="null" selected>Sin Máximo</option>
                      <option value="100">$100</option>
                      <option value="150">$150</option>
                      <option value="200">$200</option>
                      <option value="250">$250</option>
                      <option value="300">$300</option>
                      <option value="350">$350</option>
                      <option value="400">$400</option>
                      <option value="450">$450</option>
                      <option value="500">$500</option>
                      <option value="600">$600</option>
                      <option value="700">$700</option>
                      <option value="800">$800</option>
                      <option value="900">$900</option>
                      <option value="1000">$1,000</option>
                      <option value="1100">$1,100</option>
                      <option value="1200">$1,200</option>
                      <option value="1300">$1,300</option>
                      <option value="1400">$1,400</option>
                      <option value="1500">$1,500</option>
                      <option value="1600">$1,600</option>
                      <option value="1700">$1,700</option>
                      <option value="1800">$1,800</option>
                      <option value="2000">$2,000</option>
                      <option value="2100">$2,100</option>
                      <option value="2200">$2,200</option>
                      <option value="2300">$2,300</option>
                      <option value="2400">$2,400</option>
                      <option value="2500">$2,500</option>
                      <option value="2600">$2,600</option>
                      <option value="2700">$2,700</option>
                      <option value="2800">$2,800</option>
                      <option value="2900">$2,900</option>
                      <option value="3000">$3,000</option>
                      <option value="3250">$3,250</option>
                      <option value="3500">$3,500</option>
                      <option value="3750">$3,750</option>
                      <option value="4000">$4,000</option>
                      <option value="4500">$4,500</option>
                      <option value="5000">$5,000</option>
                      <option value="6000">$6,000</option>
                      <option value="8000">$8,000</option>
                      <option value="10000">$10,000</option>
                      <option value="15000">$15,000</option>
                      <option value="20000">$20,000</option>
                      <option value="30000">$30,000</option>
                    </select>
                  </div>
                </div>
        
                {{-- dormitorios --}}
                <div class="mt-4">
                  <h6 class="mb-2 text-primary">Dormitorios</h6>
                  <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="dormitorios" id="undormitorio" autocomplete="off" value="1">
                    <label class="btn btn-light button-filter border" for="undormitorio">+1</label>
                    <input type="radio" class="btn-check" name="dormitorios" id="dosdormitorios" autocomplete="off" value="2">
                    <label class="btn btn-light button-filter border" for="dosdormitorios">+2</label>
                    <input type="radio" class="btn-check" name="dormitorios" id="tresdormitorios" autocomplete="off" value="3">
                    <label class="btn btn-light button-filter border" for="tresdormitorios">+3</label>
                    <input type="radio" class="btn-check" name="dormitorios" id="cuatrodormitorios" autocomplete="off" value="4">
                    <label class="btn btn-light button-filter border" for="cuatrodormitorios">+4</label>
                    <input type="radio" class="btn-check" name="dormitorios" id="cincodormitorios" autocomplete="off" value="5">
                    <label class="btn btn-light button-filter border" for="cincodormitorios">+5</label>
                  </div>
                </div>
        
                {{-- baños --}}
                <div class="mt-4">
                  <h6 class="mb-2 text-primary">Baños</h6>
                  <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="banos" id="unbano" autocomplete="off" value="1">
                    <label class="btn btn-light button-filter border" for="unbano">+1</label>
                    <input type="radio" class="btn-check" name="banos" id="dosbanos" autocomplete="off" value="2">
                    <label class="btn btn-light button-filter border" for="dosbanos">+2</label>
                    <input type="radio" class="btn-check" name="banos" id="tresbanos" autocomplete="off" value="3">
                    <label class="btn btn-light button-filter border" for="tresbanos">+3</label>
                    <input type="radio" class="btn-check" name="banos" id="cuatrobanos" autocomplete="off" value="4">
                    <label class="btn btn-light button-filter border" for="cuatrobanos">+4</label>
                    <input type="radio" class="btn-check" name="banos" id="cincobanos" autocomplete="off" value="5">
                    <label class="btn btn-light button-filter border" for="cincobanos">+5</label>
                  </div>
                </div>
        
                {{-- área total --}}
                <div class="mt-4">
                  <h6 class="mb-2 text-primary">Área Total m<sup>2</sup></h6>
                  <div class="d-flex gap-3">
        
                    <select type="text" class="form-select" name="areaminima" id="areaminima" aria-label="Área mínima">
                      <option value="null" selected>Sin Mínimo</option>
                      <option value="20">20 m2</option>
                      <option value="30">30 m2</option>
                      <option value="40">40 m2</option>
                      <option value="50">50 m2</option>
                      <option value="60">60 m2</option>
                      <option value="70">70 m2</option>
                      <option value="80">80 m2</option>
                      <option value="90">90 m2</option>
                      <option value="100">100 m2</option>
                      <option value="120">120 m2</option>
                      <option value="140">140 m2</option>
                      <option value="160">160 m2</option>
                      <option value="180">180 m2</option>
                      <option value="200">200 m2</option>
                      <option value="220">220 m2</option>
                      <option value="240">240 m2</option>
                      <option value="260">260 m2</option>
                      <option value="280">280 m2</option>
                      <option value="300">300 m2</option>
                      <option value="325">325 m2</option>
                      <option value="350">350 m2</option>
                      <option value="375">375 m2</option>
                      <option value="400">400 m2</option>
                      <option value="425">425 m2</option>
                      <option value="450">450 m2</option>
                      <option value="475">475 m2</option>
                      <option value="500">500 m2</option>
                      <option value="550">550 m2</option>
                      <option value="600">600 m2</option>
                      <option value="650">650 m2</option>
                      <option value="700">700 m2</option>
                      <option value="750">750 m2</option>
                      <option value="800">800 m2</option>
                      <option value="900">900 m2</option>
                      <option value="1000">1,000 m2</option>
                      <option value="1200">1,200 m2</option>
                      <option value="1400">1,400 m2</option>
                      <option value="1600">1,600 m2</option>
                      <option value="1800">1,800 m2</option>
                      <option value="2000">2,000 m2</option>
                      <option value="2500">2,500 m2</option>
                      <option value="3000">3,000 m2</option>
                      <option value="4000">4,000 m2</option>
                      <option value="5000">5,000 m2</option>
                      <option value="10000">10,000 m2</option>
                    </select>
        
                    <select type="text" class="form-select" name="areamaxima" id="areamaxima" aria-label="Área máxima">
                      <option value="null" selected>Sin Máximo</option>
                      <option value="20">20 m2</option>
                      <option value="30">30 m2</option>
                      <option value="40">40 m2</option>
                      <option value="50">50 m2</option>
                      <option value="60">60 m2</option>
                      <option value="70">70 m2</option>
                      <option value="80">80 m2</option>
                      <option value="90">90 m2</option>
                      <option value="100">100 m2</option>
                      <option value="120">120 m2</option>
                      <option value="140">140 m2</option>
                      <option value="160">160 m2</option>
                      <option value="180">180 m2</option>
                      <option value="200">200 m2</option>
                      <option value="220">220 m2</option>
                      <option value="240">240 m2</option>
                      <option value="260">260 m2</option>
                      <option value="280">280 m2</option>
                      <option value="300">300 m2</option>
                      <option value="325">325 m2</option>
                      <option value="350">350 m2</option>
                      <option value="375">375 m2</option>
                      <option value="400">400 m2</option>
                      <option value="425">425 m2</option>
                      <option value="450">450 m2</option>
                      <option value="475">475 m2</option>
                      <option value="500">500 m2</option>
                      <option value="550">550 m2</option>
                      <option value="600">600 m2</option>
                      <option value="650">650 m2</option>
                      <option value="700">700 m2</option>
                      <option value="750">750 m2</option>
                      <option value="800">800 m2</option>
                      <option value="900">900 m2</option>
                      <option value="1000">1,000 m2</option>
                      <option value="1200">1,200 m2</option>
                      <option value="1400">1,400 m2</option>
                      <option value="1600">1,600 m2</option>
                      <option value="1800">1,800 m2</option>
                      <option value="2000">2,000 m2</option>
                      <option value="2500">2,500 m2</option>
                      <option value="3000">3,000 m2</option>
                      <option value="4000">4,000 m2</option>
                      <option value="5000">5,000 m2</option>
                      <option value="10000">10,000 m2</option>
                    </select>
        
                  </div>
                </div>
        
                {{-- antiguedad --}}
                <div class="mt-4">
                  <h6 class="mb-2 text-primary">Antigüedad</h6>
                  <div class="d-flex gap-3">
        
                    <select type="text" class="form-select" name="antiguedad" id="antiguedad" aria-label="Antiguedad">
                      <option value="" disabled selected>Seleccione Antigüedad</option>
                      <option value="-1">En Construcción</option>
                      <option value="0">A estrenar</option>
                      <option value="5">Hasta 5 años</option>
                      <option value="10">Hasta 10 años</option>
                      <option value="20">Hasta 20 años</option>
                      <option value="50">Hasta 50 años</option>
                      <option value="51">Más de 50 años</option>
                    </select>
        
                  </div>
                </div>
        
        
                {{-- estacionamientos --}}
                <div class="mt-4">
                  <h6 class="mb-2 text-primary">Estacionamientos</h6>
                  <div class="btn-group w-100" role="group">
                    <input type="radio" class="btn-check" name="estacionamientos" id="unestacionamiento" autocomplete="off" value="1">
                    <label class="btn btn-light button-filter border" for="unestacionamiento">+1</label>
                    <input type="radio" class="btn-check" name="estacionamientos" id="dosestacionamientos" autocomplete="off" value="2">
                    <label class="btn btn-light button-filter border" for="dosestacionamientos">+2</label>
                    <input type="radio" class="btn-check" name="estacionamientos" id="tresestacionamientos" autocomplete="off" value="3">
                    <label class="btn btn-light button-filter border" for="tresestacionamientos">+3</label>
                    <input type="radio" class="btn-check" name="estacionamientos" id="cuatroestacionamientos" autocomplete="off" value="4">
                    <label class="btn btn-light button-filter border" for="cuatroestacionamientos">+4</label>
                    <input type="radio" class="btn-check" name="estacionamientos" id="cincoestacionamientos" autocomplete="off" value="5">
                    <label class="btn btn-light button-filter border" for="cincoestacionamientos">+5</label>
                  </div>
                </div>


                {{-- adicionales --}}
                <div class="mt-4">
                  <h6 class="mb-3 text-primary">Adicionales</h6>
         
                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="01" id="add_01">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_01">
                      <i class="fa-solid fa-couch icon-orange mx-2"></i>
                      Amoblado
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="02" id="add_02">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_02">
                      <i class="fa-solid fa-snowflake icon-orange mx-2"></i>
                      Aire Acondicionado
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="03" id="add_03">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_03">
                      <i class="fa-solid fa-warehouse icon-orange mx-2"></i>
                      Almacén
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="04" id="add_04">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_04">
                      <i class="fa-solid fa-elevator icon-orange mx-2"></i>
                      Ascensor
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="05" id="add_05">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_05">
                      <i class="fa-solid fa-hand-sparkles icon-orange mx-2"></i>
                      Área de Servicio
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="06" id="add_06">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_06">
                      <i class="fa-solid fa-comments icon-orange mx-2"></i>
                      Áreas Comunes
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="07" id="add_07">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_07">
                      <i class="fa-solid fa-house-chimney-window icon-orange mx-2"></i>
                      Balcón
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="08" id="add_08">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_08">
                      <i class="fa-solid fa-fire icon-orange mx-2"></i>
                      Calefacción
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="09" id="add_09">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_09">
                      <i class="fa-solid fa-user-shield icon-orange mx-2"></i>
                      Caseta de Seguridad
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="10" id="add_10">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_10">
                      <i class="fa-solid fa-kitchen-set icon-orange mx-2"></i>
                      Cocina Equipada
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="11" id="add_11">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_11">
                      <i class="fa-solid fa-city icon-orange mx-2"></i>
                      Condominio
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="12" id="add_12">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_12">
                      <i class="fa-regular fa-building icon-orange mx-2"></i>
                      Dúplex
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="13" id="add_13">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_13">
                      <i class="fa-solid fa-tree-city icon-orange mx-2"></i>
                      Frente a Parque
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="14" id="add_14">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_14">
                      <i class="fa-solid fa-fire-flame-simple icon-orange mx-2"></i>
                      Gas Natural
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="15" id="add_15">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_15">
                      <i class="fa-solid fa-dumbbell icon-orange mx-2"></i>
                      Gimnasio
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="16" id="add_16">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_16">
                      <i class="fa-solid fa-bath icon-orange mx-2"></i>
                      Habitación Principal con Baño
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="17" id="add_17">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_17">
                      <i class="fa-solid fa-plant-wilt icon-orange mx-2"></i>
                      Jardín Interno
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="18" id="add_18">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_18">
                      <i class="fa-solid fa-sun-plant-wilt icon-orange mx-2"></i>
                      Jardín Externo
                    </label>
                  </div>
                  
                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="19" id="add_19">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_19">
                      <i class="fa-solid fa-water-ladder icon-orange mx-2"></i>
                      Jacuzzi
                    </label>
                  </div>
                  
                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="20" id="add_20">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_20">
                      <i class="fa-solid fa-puzzle-piece icon-orange mx-2"></i>
                      Juegos para niños
                    </label>
                  </div>
                  
                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="21" id="add_21">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_21">
                      <i class="fa-solid fa-calendar-week icon-orange mx-2"></i>
                      Kitchenette
                    </label>
                  </div>
                  
                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="22" id="add_22">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_22">
                      <i class="fa-solid fa-jug-detergent icon-orange mx-2"></i>
                      Lavandería
                    </label>
                  </div>
                  
                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="23" id="add_23">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_23">
                      <i class="fa-solid fa-dog icon-orange mx-2"></i>
                      Pet Friendly
                    </label>
                  </div>
                  
                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="24" id="add_24">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_24">
                      <i class="fa-solid fa-person-swimming icon-orange mx-2"></i>
                      Piscina
                    </label>
                  </div>
                  
                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="25" id="add_25">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_25">
                      <i class="fa-solid fa-faucet-drip icon-orange mx-2"></i>
                      Servicios Básicos
                    </label>
                  </div>
                  
                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="26" id="add_26">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_26">
                      <i class="fa-solid fa-droplet icon-orange mx-2"></i>
                      Tanque de Agua
                    </label>
                  </div>
                  
                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="27" id="add_27">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_27">
                      <i class="fa-solid fa-bolt icon-orange mx-2"></i>
                      Terma Eléctrica
                    </label>
                  </div>
                  
                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="28" id="add_28">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_28">
                      <i class="fa-solid fa-umbrella-beach icon-orange mx-2"></i>
                      Terraza
                    </label>
                  </div>
                  
                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="29" id="add_29">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_29">
                      <i class="fa-solid fa-building icon-orange mx-2"></i>
                      Triplex
                    </label>
                  </div>
                  
                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="30" id="add_30">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_30">
                      <i class="fa-solid fa-video icon-orange mx-2"></i>
                      Video Vigilancia
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="additional" value="31" id="add_31">
                    <label class="form-check-label text-secondary filter-additional-input" for="add_31">
                      <i class="fa-solid fa-door-closed icon-orange mx-2"></i>
                      Walk-in Closet
                    </label>
                  </div>


        
                </div>

                {{-- comodidades --}}
                <div class="mt-4">
                  <h6 class="mb-3 text-primary">Comodidades</h6>
         
                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="comfort" value="01" id="comf_01">
                    <label class="form-check-label text-secondary filter-additional-input" for="comf_01">
                      <i class="fa-solid fa-book icon-orange mx-2"></i>
                      Biblioteca
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="comfort" value="02" id="comf_02">
                    <label class="form-check-label text-secondary filter-additional-input" for="comf_02">
                      <i class="fa-solid fa-futbol icon-orange mx-2"></i>
                      Cancha de Fútbol
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="comfort" value="03" id="comf_03">
                    <label class="form-check-label text-secondary filter-additional-input" for="comf_03">
                      <i class="fa-solid fa-volleyball icon-orange mx-2"></i>
                      Centro Deportivo
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="comfort" value="04" id="comf_04">
                    <label class="form-check-label text-secondary filter-additional-input" for="comf_04">
                      <i class="fa-solid fa-house-flag icon-orange mx-2"></i>
                      Club House
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="comfort" value="15" id="comf_15">
                    <label class="form-check-label text-secondary filter-additional-input" for="comf_15">
                      <i class="fa-solid fa-user-gear icon-orange mx-2"></i>
                      Conserje
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="comfort" value="05" id="comf_05">
                    <label class="form-check-label text-secondary filter-additional-input" for="comf_05">
                      <i class="fa-solid fa-road icon-orange mx-2"></i>
                      Ingreso Independiente
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="comfort" value="06" id="comf_06">
                    <label class="form-check-label text-secondary filter-additional-input" for="comf_06">
                      <i class="fa-solid fa-wifi icon-orange mx-2"></i>
                      Internet / WiFi
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="comfort" value="07" id="comf_07">
                    <label class="form-check-label text-secondary filter-additional-input" for="comf_07">
                      <i class="fa-solid fa-tree icon-orange mx-2"></i>
                      Parque Interno
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="comfort" value="08" id="comf_08">
                    <label class="form-check-label text-secondary filter-additional-input" for="comf_08">
                      <i class="fa-solid fa-fire-burner icon-orange mx-2"></i>
                      Parrilla
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="comfort" value="16" id="comf_16">
                    <label class="form-check-label text-secondary filter-additional-input" for="comf_16">
                      <i class="fa-solid fa-bell-concierge icon-orange mx-2"></i>
                      Recepción
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="comfort" value="09" id="comf_09">
                    <label class="form-check-label text-secondary filter-additional-input" for="comf_09">
                      <i class="fa-solid fa-table-tennis-paddle-ball icon-orange mx-2"></i>
                      Sala de Entretenimiento
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="comfort" value="10" id="comf_10">
                    <label class="form-check-label text-secondary filter-additional-input" for="comf_10">
                      <i class="fa-regular fa-handshake icon-orange mx-2"></i>
                      Sala de Reuniones
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="comfort" value="11" id="comf_11">
                    <label class="form-check-label text-secondary filter-additional-input" for="comf_11">
                      <i class="fa-solid fa-hot-tub-person icon-orange mx-2"></i>
                      Sauna
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="comfort" value="12" id="comf_12">
                    <label class="form-check-label text-secondary filter-additional-input" for="comf_12">
                      <i class="fa-solid fa-tv icon-orange mx-2"></i>
                      Televisión por Cable
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="comfort" value="13" id="comf_13">
                    <label class="form-check-label text-secondary filter-additional-input" for="comf_13">
                      <i class="fa-solid fa-water icon-orange mx-2"></i>
                      Vista al Mar
                    </label>
                  </div>

                  <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" name="comfort" value="14" id="comf_14">
                    <label class="form-check-label text-secondary filter-additional-input" for="comf_14">
                      <i class="fa-solid fa-arrows-to-circle icon-orange mx-2"></i>
                      Zona Céntrica
                    </label>
                  </div>

                </div>


      
              </div>
        
              <div class="modal-footer justify-content-between">
                <input class="button-clear aside-menu btn mx-1" type="submit" value="Restablecer Filtros">
                <input class="button-orange btn mx-1" type="submit" value="Aplicar Filtros">
              </div>
              
            </form>
      
          </div>
        </div>
      </div>
    
    </div>

  </div>
  

    {{-- Ordenar Anuncios --}}
    <div class="btn-group">
      <button type="button" class="btn border dropdown-toggle py-2 " data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="true" aria-label="Orden">
        <i class="fa-solid fa-sort icon-orange me-2"></i>
        <span id="relevanciafiltertittle">Relevancia</span>
      </button>
      <ul class="dropdown-menu ">
        <li class="dropdown-item filters-dropdown-li" data-value="relevancia" data-sort="desc">
          Relevancia
        </li>
        <li class="dropdown-item filters-dropdown-li" data-value="menor_precio" data-sort="asc">
          Menor precio
        </li>
        <li class="dropdown-item filters-dropdown-li" data-value="mayor_precio" data-sort="desc">
          Mayor precio
        </li>
        <li class="dropdown-item filters-dropdown-li" data-value="recientes" data-sort="desc">
          Recientes
        </li>
        <li class="dropdown-item filters-dropdown-li" data-value="vistos" data-sort="desc">
          Más vistos
        </li>
      </ul>
    </div>

</div>


