
{{-- Filtros --}}
<div class="d-flex justify-content-between">

    <div class="d-flex gap-3">

        <div class="btn-group d-none d-xl-inline-flex">
            <button type="button" class="btn border dropdown-toggle py-2 " data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="true">
                <i class="fa-solid fa-tag icon-orange me-2"></i>
                <span id="trasactionfiltertittle">
                    @if(!$url_parse['operacion'])
                        Todos
                    @else
                        @if ( ($url_parse['operacion'])->tipo == "Remate" )
                            Remate Público
                        @else
                            {{ ($url_parse['operacion'])->tipo }}
                        @endif
                    @endif
                </span>
            </button>
            <ul class="dropdown-menu">
                <li class="dropdown-item filters-dropdown-li filter-operation @if(optional($url_parse['operacion'])->id != null) trasaction @endif" data-value="todos">
                    Todos
                </li>
                <li class="dropdown-item filters-dropdown-li filter-operation @if(optional($url_parse['operacion'])->id != 1) trasaction @endif" data-value="1">
                    Venta
                </li>
                <li class="dropdown-item filters-dropdown-li filter-operation @if(optional($url_parse['operacion'])->id != 2) trasaction @endif" data-value="2">
                    Alquiler
                </li>
                <li class="dropdown-item filters-dropdown-li filter-operation @if(optional($url_parse['operacion'])->id != 3) trasaction @endif" data-value="3">
                    Remate Público
                </li>
            </ul>
        </div>
    
        {{-- Direccion de Remate --}}
        <div id="remateButton" class="d-none">
            <div class="btn-group d-xl-inline-flex">
                <button type="button" class="btn border dropdown-toggle py-2" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="true">
                    <i class="fa-solid fa-house-laptop icon-orange me-2"></i>
                    <span id="direccionRemateFiltertittle">
                        Todos
                    </span>
                </button>
                <ul class="dropdown-menu ">
                    <li class="dropdown-item filters-dropdown-li direccion-remate filterOthers" data-submit="direccionRemate"  data-valor="0">
                        Todos
                    </li>
                    <li class="dropdown-item filters-dropdown-li direccion-remate filterOthers" data-submit="direccionRemate" data-valor="2">
                        CACLI
                    </li>
                    <li class="dropdown-item filters-dropdown-li direccion-remate filterOthers" data-submit="direccionRemate" data-valor="3">
                        CAFI
                    </li>
                    <li class="dropdown-item filters-dropdown-li direccion-remate filterOthers" data-submit="direccionRemate" data-valor="4">
                        REMAJU
                    </li>
                    <li class="dropdown-item filters-dropdown-li direccion-remate filterOthers" data-submit="direccionRemate" data-valor="1">
                        Otros
                    </li>
                </ul>
            </div>
        </div>

        {{-- Tipo inmueble --}}
        <div class="btn-group d-none d-xl-inline-flex">
            <button type="button" class="btn border dropdown-toggle py-2 " data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="true">
                <i class="fa-solid fa-city icon-orange me-2"></i>
                <span id="tipofiltertittle">
                    @if(!$url_parse['tipo_inmueble'])
                        Todos
                    @else
                        {{ ($url_parse['tipo_inmueble'])->tipo }}
                    @endif
                </span>
            </button>
            <ul class="dropdown-menu ">
                <li class="dropdown-item filters-dropdown-li @if(optional($url_parse['tipo_inmueble'])->id !== null) tipo @endif" data-value="todos">
                    Todos
                </li>
                @foreach($tipos_inmuebles as $tipo)
                    <li class="dropdown-item filters-dropdown-li @if(optional($url_parse['tipo_inmueble'])->id !== $tipo->id) tipo @endif" data-value="{{ $tipo->id }}">
                        {{ $tipo->tipo }}
                    </li>
                @endforeach
            </ul>
        </div>
    
        {{-- Precio Inmueble --}}
        <div id="priceRange">
            <div class="btn-group  filters-price-desktop ">
                <button type="button" class="btn border dropdown-toggle py-2 " data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="true" aria-label="Orden">
                    <i class="fa-solid fa-money-bill-1 icon-orange me-2"></i>
                    <span id="ventafiltertittle">Precio</span>
                </button>
                <ul class="dropdown-menu p-2 ">
            
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <h6 class="m-0">Precio</h6>
                        <div>
                            <small class="text-primary fw-bold button-filter-price filterOthers" data-submit="filtersbuscarprecios">Aplicar</small>
                        </div>
                    </div>
                
                    <div class="d-flex gap-3">
                        <input type="text" class="form-control amount" name="preciominimo" id="preciominimo" placeholder="Precio mínimo">
                        <input type="text" class="form-control amount" name="preciomaximo" id="preciomaximo" placeholder="Precio máximo">
                    </div>
                
                </ul>
            </div>
        </div>
    
        {{-- Filtros Generales MODAL --}}
        <div>
            <!-- Botón Filtros Generales -->
            <button type="button" class="btn border py-2 " data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fa-solid fa-filter icon-orange me-2"></i>
                Filtros
            </button>
            
            <!-- Modal Filtros Generales -->
            <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                
                        <form id="formFilterInmueble" class="modal-body overflow-x-hidden p-0" action="{{ route('filter_search') }}" method="get">
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
                                    <input type="radio" class="btn-check" name="transaccion" id="comprarfilter" autocomplete="off" value="1" @if(optional($url_parse['operacion'])->id === 1) checked @endif>
                                    <label class="btn btn-outline-primary button-filter" for="comprarfilter">Comprar</label>
                                    
                                    <input type="radio" class="btn-check" name="transaccion" id="alquilarfilter" autocomplete="off" value="2" @if(optional($url_parse['operacion'])->id === 2) checked @endif>
                                    <label class="btn btn-outline-primary button-filter" for="alquilarfilter">Alquilar</label>
                                    
                                    <input type="radio" class="btn-check" name="transaccion" id="rematesfilter" autocomplete="off" value="3" @if(optional($url_parse['operacion'])->id === 3) checked @endif>
                                    <label class="btn btn-outline-primary button-filter" for="rematesfilter">Remates</label>
                                </div>
                        
                                {{-- tipo de inmueble --}}
                                <div class="mt-4">
                                    <h6 class="mb-2 text-primary">Tipo de inmueble</h6>
                                    <div class="container text-center my-2 px-1">
                                        <div class="row">
                            
                                            <input type="radio" class="btn-check" name="categoria" id="departamento" autocomplete="off" value="2" @if(optional($url_parse['tipo_inmueble'])->id === 2) checked @endif>
                                            <label class="btn button-clear aside-menu col m-2 p-1 d-flex flex-column justify-content-center" for="departamento">
                                                <i class="fa-solid fa-building text-secondary fa-xl my-4"></i>
                                                <small class="text-secondary">Departamento</small>
                                            </label>
                                    
                                            <input type="radio" class="btn-check" name="categoria" id="casa" autocomplete="off" value="1" @if(optional($url_parse['tipo_inmueble'])->id === 1) checked @endif>
                                            <label class="btn button-clear aside-menu col m-2 p-1 d-flex flex-column justify-content-center" for="casa">
                                                <i class="fa-solid fa-house-user text-secondary fa-xl my-4"></i>
                                                <small class="text-secondary">Casa</small>
                                            </label>
                                
                                            <input type="radio" class="btn-check" name="categoria" id="local_comercial" autocomplete="off" value="5" @if(optional($url_parse['tipo_inmueble'])->id === 5) checked @endif>
                                            <label class="btn button-clear aside-menu col m-2 p-1 d-flex flex-column justify-content-center" for="local_comercial">
                                                <i class="fa-solid fa-shop text-secondary fa-xl my-4"></i>
                                                <small class="text-secondary">Local Comercial</small>
                                            </label>
                            
                                        </div>
                            
                                        <div class="row">
                            
                                            <input type="radio" class="btn-check" name="categoria" id="oficina" autocomplete="off" value="3" @if(optional($url_parse['tipo_inmueble'])->id === 3) checked @endif>
                                            <label class="btn button-clear aside-menu col m-2 p-1 d-flex flex-column justify-content-center" for="oficina">
                                                <i class="fa-regular fa-building text-secondary fa-xl my-4"></i>
                                                <small class="text-secondary">Oficina</small>
                                            </label>
                                    
                                            <input type="radio" class="btn-check" name="categoria" id="terreno" autocomplete="off" value="4" @if(optional($url_parse['tipo_inmueble'])->id === 4) checked @endif>
                                            <label class="btn button-clear aside-menu col m-2 p-1 d-flex flex-column justify-content-center" for="terreno">
                                                <i class="fa-solid fa-mountain-sun text-secondary fa-xl my-4"></i>
                                                <small class="text-secondary">Terreno</small>
                                            </label>
                                
                                            {{-- <input type="radio" class="btn-check" name="categoria" id="local_industrial" autocomplete="off" value="5">
                                            <label class="btn button-clear aside-menu col m-2 p-1 d-flex flex-column justify-content-center" for="local_industrial">
                                                <i class="fa-solid fa-industry text-secondary fa-xl my-4"></i>
                                                <small class="text-secondary">Local Industrial</small>
                                            </label> --}}
                            
                                        </div>
                                    </div>
                                </div>
                        
                                {{-- precio --}}
                                <div class="mt-4">
                                    <h6 class="mb-2 text-primary">Precio</h6>
                                    <div class="d-flex gap-3">
                                        <input type="text" class="form-control amount" name="preciominimo" id="preciominimo_modal" placeholder="Precio mínimo">
                                        <input type="text" class="form-control amount" name="preciomaximo" id="preciomaximo_modal" placeholder="Precio máximo">
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
                                        <input type="text" class="form-control amount" name="areaminima" id="areaminima" placeholder="Area mínima">
                                        <input type="text" class="form-control amount" name="areamaxima" id="areamaxima" placeholder="Area máxima">
                                    </div>
                                </div>
                        
                                {{-- antiguedad --}}
                                <div class="mt-4">
                                    <h6 class="mb-2 text-primary">Antigüedad</h6>
                                    <div class="d-flex gap-3">
                                        <select type="text" class="form-select" name="antiguedad" id="antiguedad" aria-label="Antiguedad">
                                            <option value="" disabled selected>Seleccione Antigüedad</option>
                                            <option value="0">En Construcción</option>
                                            <option value="1">A estrenar</option>
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
                            
                                    @foreach ( $caracteristicas as $caracteristica )
                                        <div class="form-check my-2">
                                            <input class="form-check-input" type="checkbox" name="options[]" value="{{ $caracteristica->id }}" id="add_{{ $caracteristica->id }}">
                                            <label class="form-check-label text-secondary filter-additional-input" for="add_{{ $caracteristica->id }}">
                                                <i class="fa-solid {{ $caracteristica->icono }} icon-orange mx-2"></i>
                                                {{ $caracteristica->caracteristica }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- comodidades --}}
                                <div class="mt-4">
                                    <h6 class="mb-3 text-primary">Comodidades</h6>
                                    @foreach ( $comodidades as $comodidad )
                                        <div class="form-check my-2">
                                            <input class="form-check-input" type="checkbox" name="options[]" value="{{ $comodidad->id }}" id="comodidad_{{ $comodidad->id }}">
                                            <label class="form-check-label text-secondary filter-additional-input" for="comodidad_{{ $comodidad->id }}">
                                                <i class="fa-solid {{ $comodidad->icono }} icon-orange mx-2"></i>
                                                {{ $comodidad->caracteristica }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                    
                            </div>
                        
                            <div class="modal-footer justify-content-between">
                                <input type="button" class="btn button-clear aside-menu mx-1 px-3" value="Restablecer Filtros">
                                <input type="submit" class="btn button-orange mx-1 px-3" value="Aplicar Filtros">
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
            <span id="relevanceFilterTittle">Relevancia</span>
        </button>
        <ul class="dropdown-menu filters-relevance">
            <li class="dropdown-item filters-dropdown-li" data-value="relevancia" data-sort="desc">
                Relevancia
            </li>
            <li class="dropdown-item filters-dropdown-li" data-value="menor_precio_soles" data-sort="asc">
                Menor precio Soles
            </li>
            <li class="dropdown-item filters-dropdown-li" data-value="mayor_precio_soles" data-sort="desc">
                Mayor precio Soles
            </li>
            <li class="dropdown-item filters-dropdown-li" data-value="menor_precio_dolares" data-sort="asc">
                Menor precio Dólares
            </li>
            <li class="dropdown-item filters-dropdown-li" data-value="mayor_precio_dolares" data-sort="desc">
                Mayor precio Dólares
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