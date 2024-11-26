<header class="custom-container">

    {{-- Navbar Desktop --}}
    <div class="d-lg-block">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid p-0">
                <a class="navbar-brand" href="/">
                    <img class="navbar-logo-puja" src="{{ asset('images/svg/logo_puja.svg') }}" alt="logo de pujainmobiliaria">
                </a>
        
                <button class="btn d-lg-none d-flex align-items-center justify-content-center p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="fa-solid fa-bars icon-orange fa-xl m-3"></i>
                </button>
        
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                        {{-- Compra --}}
                        <li class="header-nav-item nav-item dropdown">
                            <a class="header-nav-link nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Compra
                            </a>
                            <div class="header-dropdown-menu dropdown-menu p-5">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column">
                                        <h5 class="text-dark h6 fw-bold">Provincia</h5>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en Lima')]) }}">Lima</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en Piura')]) }}">Piura</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en Callao')]) }}">Callao</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en Ica')]) }}">Ica</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en La Libertad')]) }}">La Libertad</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en Arequipa')]) }}">Arequipa</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en Cusco')]) }}">Cusco</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en Tumbes')]) }}">Tumbes</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en Junín')]) }}">Junín</a>
                                    </div>

                                    <div class="d-flex flex-column">
                                        <h5 class="text-dark h6 fw-bold">Tipo de Propiedad</h5>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Venta')]) }}">Departamento</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Casas en Venta')]) }}">Casa</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Terrenos en Venta')]) }}">Terreno / Lote</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Oficinas en Venta')]) }}">Oficina</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Locales en Venta')]) }}">Local Comercial</a>
                                    </div>

                                    <div class="d-flex flex-column">
                                        <h5 class="text-dark h6 fw-bold">Dormitorios</h5>
                                        <a class="text-decoration-none text-dark mb-1" href="#">3 dormitorios</a>
                                        <a class="text-decoration-none text-dark mb-1" href="#">2 dormitorios</a>
                                        <a class="text-decoration-none text-dark mb-1" href="#">1 dormitorio</a>
                                        <a class="text-decoration-none text-dark mb-1" href="#">4 dormitorios</a>
                                        <a class="text-decoration-none text-dark mb-1" href="#">5 o más dormitorios</a>
                                    </div>

                                    <div class="d-flex flex-column">
                                        <h5 class="text-dark h6 fw-bold">Servicios</h5>
                                        <a class="text-decoration-none text-dark mb-1" href="#">Guía para comprar un inmueble</a>
                                        <a class="text-decoration-none text-dark mb-1" href="#">Publica un inmueble para venta</a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        {{-- Alquiler --}}
                        <li class="header-nav-item nav-item dropdown">
                            <a class="header-nav-link nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Alquiler
                            </a>
                            <div class="header-dropdown-menu dropdown-menu p-5">

                                <div class="d-flex justify-content-between">

                                    <div class="d-flex flex-column">
                                        <h5 class="text-dark h6 fw-bold">Provincia</h5>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en Lima')]) }}">Lima</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en Piura')]) }}">Piura</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en Callao')]) }}">Callao</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en Ica')]) }}">Ica</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en La Libertad')]) }}">La Libertad</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en Arequipa')]) }}">Arequipa</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en Cusco')]) }}">Cusco</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en Tumbes')]) }}">Tumbes</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en Junín')]) }}">Junín</a>
                                    </div>

                                    <div class="d-flex flex-column">
                                        <h5 class="text-dark h6 fw-bold">Tipo de Propiedad</h5>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Alquiler')]) }}">Departamento</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Casas en Alquiler')]) }}">Casa</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Terrenos en Alquiler')]) }}">Terreno / Lote</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Oficinas en Alquiler')]) }}">Oficina</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Locales en Alquiler')]) }}">Local Comercial</a>
                                    </div>

                                    <div class="d-flex flex-column">
                                        <h5 class="text-dark h6 fw-bold">Dormitorios</h5>
                                        <a class="text-decoration-none text-dark mb-1" href="#">3 dormitorios</a>
                                        <a class="text-decoration-none text-dark mb-1" href="#">2 dormitorios</a>
                                        <a class="text-decoration-none text-dark mb-1" href="#">1 dormitorio</a>
                                        <a class="text-decoration-none text-dark mb-1" href="#">4 dormitorios</a>
                                        <a class="text-decoration-none text-dark mb-1" href="#">5 o más dormitorios</a>
                                    </div>

                                    <div class="d-flex flex-column">
                                        <h5 class="text-dark h6 fw-bold">Servicios</h5>
                                        <a class="text-decoration-none text-dark mb-1" href="#">Guía para alquilar un inmueble</a>
                                        <a class="text-decoration-none text-dark mb-1" href="#">Publica un inmueble para alquilar</a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        {{-- Servicios --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Servicios
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/blog" target="_blank">Blog</a></li>
                            </ul>
                        </li>
                        
                        {{-- Remates --}}
                        <li class="header-nav-item nav-item dropdown">
                            <a class="header-nav-link nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Remates
                            </a>
                            <div class="header-dropdown-menu dropdown-menu p-5">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column">
                                        <h5 class="text-dark h6 fw-bold">Provincia</h5>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en Lima')]) }}">Lima</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en Piura')]) }}">Piura</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en Callao')]) }}">Callao</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en Ica')]) }}">Ica</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en La Libertad')]) }}">La Libertad</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en Arequipa')]) }}">Arequipa</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en Cusco')]) }}">Cusco</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en Tumbes')]) }}">Tumbes</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en Junín')]) }}">Junín</a>
                                    </div>

                                    <div class="d-flex flex-column">
                                        <h5 class="text-dark h6 fw-bold">Tipo de Propiedad</h5>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Remate')]) }}">Departamento</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Casas en Remate')]) }}">Casa</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Terrenos en Remate')]) }}">Terreno / Lote</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Oficinas en Remate')]) }}">Oficina</a>
                                        <a class="text-decoration-none text-dark mb-1" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Locales en Remate')]) }}">Local Comercial</a>
                                    </div>

                                    <div class="d-flex flex-column">
                                        <h5 class="text-dark h6 fw-bold">Dormitorios</h5>
                                        <a class="text-decoration-none text-dark mb-1" href="#">3 dormitorios</a>
                                        <a class="text-decoration-none text-dark mb-1" href="#">2 dormitorios</a>
                                        <a class="text-decoration-none text-dark mb-1" href="#">1 dormitorio</a>
                                        <a class="text-decoration-none text-dark mb-1" href="#">4 dormitorios</a>
                                        <a class="text-decoration-none text-dark mb-1" href="#">5 o más dormitorios</a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        {{-- Proyectos --}}
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-success dropdown-toggle p-0 px-3" data-bs-toggle="dropdown" aria-expanded="false">
                              Proyectos
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('proyectos.filtrar', 'en-planos') }}">En planos</a></li>
                                <li><a class="dropdown-item" href="{{ route('proyectos.filtrar', 'en-construccion') }}">En construcción</a></li>
                                <li><a class="dropdown-item" href="{{ route('proyectos.filtrar', 'entrega-inmediata') }}">Entrega inmediata</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('proyectos.index') }}">Todos</a></li>
                            </ul>
                        </div>
        
                    </ul>
                    @auth
                    @php
                        $tipoUsuarioID = Auth::user()->tipo_usuario_id;
                        $canEditProject = false;
                    
                        if (isset($projectInfo)) {
                            if ($projectInfo !== false) {
                                $canEditProject = $projectInfo['al_dia']; // Usar el campo 'al_dia'
                            }
                        }
                    @endphp
                    
                    @if (isset($tienePlanes)) 
                        @if (!$tienePlanes && $tipoUsuarioID === 3)
                            <a href="/planes-inmobiliaria" class="btn-outline-secondary aside-menu btn mx-4">Publica Aquí</a>
                        @elseif ( $canEditProject && $tipoUsuarioID === 5 )
                            <a href="{{ route("proyectos.create") }}" class="btn-outline-secondary aside-menu btn mx-4">Publica Aquí</a>
                        @elseif ( !$canEditProject && $tipoUsuarioID === 5 )
                            <a class="btn-outline-secondary aside-menu btn mx-4" href="/publica-tu-inmueble">Publica Aquí</a>
                        @else 
                            <a href="{{ route("posts.create") }}" class="btn-outline-secondary aside-menu btn mx-4">Publica Aquí</a>
                        @endif
                    @endif
                

                        @php
                            $nombreCompleto = Auth::user()->nombres;
                            $posicionEspacio = strpos($nombreCompleto, ' ');
                            $nombreCortado = $posicionEspacio === false ? $nombreCompleto : substr($nombreCompleto, 0, $posicionEspacio);

                            $tipoUsuarioID = Auth::user()->tipo_usuario_id;
                            if ( (int)$tipoUsuarioID === 2 ) {
                                $tipoUsuario = "Propietario";
                            } else if ( (int)$tipoUsuarioID === 3 ) {
                                $tipoUsuario = "Corredor";
                            } else if ( (int)$tipoUsuarioID === 4 ) {
                                $tipoUsuario = "Acreedor";
                            } else if ( (int)$tipoUsuarioID === 5 ) {
                                $tipoUsuario = "Proyecto";
                            } else {
                                $tipoUsuario = "Propietario";
                            }

                            $avatarUser = Auth::user()->imagen;
                            $user_image = $avatarUser ? $avatarUser : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPnb_I_OQt7Mcts15Kf9qwVchNCE7SJlkfYQ&s";

                        @endphp
                        <nav>
                            <div class="profile">
                                <div class="user mt-3">
                                    <h6 style="margin-bottom: 0.1rem;"><b>{{ $nombreCortado }}</b></h6>
                                    <p>{{ $tipoUsuario }}</p>
                                </div>
                                <div class="img-box">
                                    <img src="{{ $user_image }}" alt="some user image">
                                </div>
                            </div>
                            <div class="menu rounded-3">
                                <ul class="p-0 m-0 rounded-3">
                                    <li class="rounded-3 rounded-bottom-0">
                                        <a href="{{ route('panel.perfil') }}">
                                            <div>
                                                <i class="fa-solid fa-user"></i>
                                                &nbsp; Perfil
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('panel.mis-avisos') }}">
                                            <div>
                                                <i class="fa-solid fa-store"></i></i>
                                                &nbsp; Avisos
                                            </div>
                                        </a>
                                    </li>
                                    <li class="rounded-3 rounded-top-0">
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <div>
                                                <i class="fa-regular fa-circle-xmark"></i>
                                                &nbsp; Cerrar sesión
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    @else
                        <a class="btn-outline-secondary btn mx-1" href="/publica-tu-inmueble">Publica Aquí</a>
                        <a class="button-orange btn mx-1" href="{{ route("sign_in", ['profile_type' => 2]) }}">Iniciar Sesión</a>
                    @endauth

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </div>
        </nav>
    </div>

</header> 

{{-- Navbar Mobile (contenido en un offcanvas) --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">

    <div class="offcanvas-header d-flex justify-content-between">
        <a class="navbar-brand" href="/">
            <img class="navbar-logo-puja" src="{{ asset('images/svg/logo_puja.svg') }}" alt="logo de pujainmobiliaria">
        </a>
        <button type="button" class="btn p-0" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fa-solid fa-xmark icon-orange fa-xl m-3"></i>
        </button>
    </div>

    {{-- Linea divisora --}}
    <hr class="m-0">

    
    <div class="offcanvas-body">

        <div class="d-flex flex-column h-100 justify-content-between">

            <div>

                {{-- Menú perfil para movil --}}
                <div class="d-flex flex-column gap-3">
                    @auth
            
                        <div class="d-flex gap-4 px-2">
                            <div class="">
                                <img src="{{ $user_image }}" alt="some user image" class="rounded-circle" style="width: 48px">
                            </div>
                            <div class="">
                                <h6 style="margin-bottom: 0.1rem;"><b>{{ $nombreCortado }}</b></h6>
                                <p class="m-0">{{ $tipoUsuario }}</p>
                            </div>
                        </div>
            
                        @if ($tipoUsuarioID === 5)
            
                            <ul class="list-group list-group-flush">
                                <a class="list-group-item p-2" href="{{ route('panel.proyecto.mis-proyectos') }}">Mis proyectos</a>
                                <a class="list-group-item p-2" href="{{ route('panel.proyecto.proyectos-contratados') }}">Plan Contratado</a>
                                <a class="list-group-item p-2" href="{{ route('panel.proyecto.interesados') }}">Interesados</a>
                                <a class="list-group-item p-2" href="{{ route('panel.proyecto.perfil') }}">Mi Perfil</a>
                                <a class="list-group-item p-2" href="{{ route('panel.proyecto.password') }}">Password</a>
                                <div></div>
                            </ul>
            
                        @else
                            
                            <ul class="list-group list-group-flush">
                                <a class="list-group-item p-2" href="{{ route('panel.perfil') }}">Mi Cuenta</a>
                                <a class="list-group-item p-2" href="{{ route('panel.password') }}">Password</a>
                                <a class="list-group-item p-2" href="{{ route('panel.mis-avisos') }}">Mis Avisos</a>
                                <a class="list-group-item p-2" href="{{ route('panel.planes-contratados') }}">Mis Planes</a>
                                <div></div>
                            </ul>
            
                        @endif
            
                        @if (isset($tienePlanes)) 
                            @if (!$tienePlanes && $tipoUsuarioID === 3)
                                <a href="/planes-inmobiliaria" class="button-clear aside-menu btn">Publica Aquí</a>
                            @elseif ( $canEditProject && $tipoUsuarioID === 5 )
                                <a href="{{ route("proyectos.create") }}" class="button-clear aside-menu btn">Publica Aquí</a>
                            @elseif ( !$canEditProject && $tipoUsuarioID === 5 )
                                <a class="button-clear aside-menu btn" href="/publica-tu-inmueble">Publica Aquí</a>
                            @else 
                                <a href="{{ route("posts.create") }}" class="button-clear aside-menu btn">Publica Aquí</a>
                            @endif
                        @endif
            
                    @else 
                        <a class="button-orange btn" href="{{ route("sign_in", ['profile_type' => 2]) }}">Iniciar Sesión</a>
                        <a class="button-clear aside-menu btn" href="/publica-tu-inmueble">Publica Aquí</a>
                    @endauth
                </div>
        
                {{-- Contenido Navbar en tamaño responsivo --}}
                <div class="accordion" id="accordionGeneral">
        
                    {{-- COMPRAR --}}
                    <div class="accordion-item rounded-0 border-0 border-bottom">
                        <h2 class="accordion-header" id="headingCompra">
                            <button class="custom-accordion-button accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCompra" aria-expanded="true" aria-controls="collapseCompra">
                                Comprar
                            </button>
                        </h2>
                        <div id="collapseCompra" class="accordion-collapse collapse" aria-labelledby="headingCompra" data-bs-parent="#accordionGeneral">
                            <div class="accordion-body py-2" id="accordionComprar">
        
                                {{-- Segundo nivel de acordeón  --}}
                                <div class="accordion">
                                    <div class="accordion-item rounded-0 border-0 border-bottom">
                                        <h2 class="accordion-header" id="headingNestedProvincia">
                                            <button class="custom-accordion-button accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNestedProvincia" aria-expanded="true" aria-controls="collapseNestedProvincia">
                                                Provincia
                                            </button>
                                        </h2>
                                        <div id="collapseNestedProvincia" class="accordion-collapse collapse" aria-labelledby="headingNestedProvincia" data-bs-parent="#accordionComprar">
                                            <div class="accordion-body py-2">
                                                {{-- Componentes Provincia  --}}
                                                <div class="list-group">
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en Lima')]) }}" class="list-group-item list-group-item-action border-0 p-0">Lima</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en Piura')]) }}" class="list-group-item list-group-item-action border-0 p-0">Piura</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en Callao')]) }}" class="list-group-item list-group-item-action border-0 p-0">Callao</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en Ica')]) }}" class="list-group-item list-group-item-action border-0 p-0">Ica</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en La Libertad')]) }}" class="list-group-item list-group-item-action border-0 p-0">La Libertad</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en Arequipa')]) }}" class="list-group-item list-group-item-action border-0 p-0">Arequipa</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en Cusco')]) }}" class="list-group-item list-group-item-action border-0 p-0">Cusco</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en Tumbes')]) }}" class="list-group-item list-group-item-action border-0 p-0">Tumbes</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta en Junín')]) }}" class="list-group-item list-group-item-action border-0 p-0">Junín</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                {{-- Segundo nivel de acordeón  --}}
                                <div class="accordion" id="accordionComprar">
                                    <div class="accordion-item rounded-0 border-0 border-bottom">
                                        <h2 class="accordion-header" id="headingNestedTipoPropiedad">
                                            <button class="custom-accordion-button accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNestedTipoPropiead" aria-expanded="true" aria-controls="collapseNestedTipoPropiead">
                                                Tipo de Propiedad
                                            </button>
                                        </h2>
                                        <div id="collapseNestedTipoPropiead" class="accordion-collapse collapse" aria-labelledby="headingNestedTipoPropiedad" data-bs-parent="#accordionComprar">
                                            <div class="accordion-body py-2">
                                                {{-- Componentes Dormitorios  --}}
                                                <div class="list-group">
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Venta')]) }}" class="list-group-item list-group-item-action border-0 p-0">Departamento</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Casas en Venta')]) }}" class="list-group-item list-group-item-action border-0 p-0">Casa</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Terrenos en Venta')]) }}" class="list-group-item list-group-item-action border-0 p-0">Terreno / Lote</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Oficinas en Venta')]) }}" class="list-group-item list-group-item-action border-0 p-0">Oficina</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Locales en Venta')]) }}" class="list-group-item list-group-item-action border-0 p-0">Local Comercial</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                {{-- Segundo nivel de acordeón  --}}
                                <div class="accordion" id="accordionComprar">
                                    <div class="accordion-item rounded-0 border-0">
                                        <h2 class="accordion-header" id="headingNestedDormitorios">
                                            <button class="custom-accordion-button custom-accordion-button accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNestedDormitorios" aria-expanded="true" aria-controls="collapseNestedDormitorios">
                                                Dormitorios
                                            </button>
                                        </h2>
                                        <div id="collapseNestedDormitorios" class="accordion-collapse collapse" aria-labelledby="headingNestedDormitorios" data-bs-parent="#accordionComprar">
                                            <div class="accordion-body py-2">
                                                {{-- Componentes Dormitorios  --}}
                                                <div class="list-group">
                                                    <a href="#" class="list-group-item list-group-item-action border-0 p-0">3 dormitorios</a>
                                                    <a href="#" class="list-group-item list-group-item-action border-0 p-0">2 dormitorios</a>
                                                    <a href="#" class="list-group-item list-group-item-action border-0 p-0">4 dormitorios</a>
                                                    <a href="#" class="list-group-item list-group-item-action border-0 p-0">5 o más dormitorios</a>
                                                    <a href="#" class="list-group-item list-group-item-action border-0 p-0">1 dormitorio</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
        
                    {{-- ALQUILAR --}}
                    <div class="accordion-item rounded-0 border-0 border-bottom">
                        <h2 class="accordion-header" id="headingAlquiler">
                            <button class="custom-accordion-button accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAlquilar" aria-expanded="true" aria-controls="collapseAlquilar">
                                Alquilar
                            </button>
                        </h2>
                        <div id="collapseAlquilar" class="accordion-collapse collapse" aria-labelledby="headingAlquiler" data-bs-parent="#accordionGeneral">
                            <div class="accordion-body py-2" id="accordionAlquilar">
        
                                {{-- Segundo nivel: alquiler provincia --}}
                                <div class="accordion" id="accordionAlquilarProvincia">
                                    <div class="accordion-item rounded-0 border-0 border-bottom">
                                        <h2 class="accordion-header" id="headingNestedAlquilarProvincia">
                                            <button class="custom-accordion-button accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNestedAlquilarProvincia" aria-expanded="true" aria-controls="collapseNestedAlquilarProvincia">
                                                Provincia
                                            </button>
                                        </h2>
                                        <div id="collapseNestedAlquilarProvincia" class="accordion-collapse collapse" aria-labelledby="headingNestedAlquilarProvincia" data-bs-parent="#accordionAlquilar">
                                            <div class="accordion-body py-2">
                                                {{-- Componentes Alquiler Provincia --}}
                                                <div class="list-group">
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en Lima')]) }}" class="list-group-item list-group-item-action border-0 p-0">Lima</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en Piura')]) }}" class="list-group-item list-group-item-action border-0 p-0">Piura</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en Callao')]) }}" class="list-group-item list-group-item-action border-0 p-0">Callao</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en Ica')]) }}" class="list-group-item list-group-item-action border-0 p-0">Ica</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en La Libertad')]) }}" class="list-group-item list-group-item-action border-0 p-0">La Libertad</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en Arequipa')]) }}" class="list-group-item list-group-item-action border-0 p-0">Arequipa</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en Cusco')]) }}" class="list-group-item list-group-item-action border-0 p-0">Cusco</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en Tumbes')]) }}" class="list-group-item list-group-item-action border-0 p-0">Tumbes</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler en Junín')]) }}" class="list-group-item list-group-item-action border-0 p-0">Junín</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                {{-- Segundo nivel: Alquiler tipo de propiedad --}}
                                <div class="accordion" id="accordionAlquilarTipo">
                                    <div class="accordion-item rounded-0 border-0 border-bottom">
                                        <h2 class="accordion-header" id="headingNestedAlquilarTipoPropiedad">
                                            <button class="custom-accordion-button accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNestedAlquilarTipoPropiead" aria-expanded="true" aria-controls="collapseNestedAlquilarTipoPropiead">
                                                Tipo de Propiedad
                                            </button>
                                        </h2>
                                        <div id="collapseNestedAlquilarTipoPropiead" class="accordion-collapse collapse" aria-labelledby="headingNestedAlquilarTipoPropiedad" data-bs-parent="#accordionAlquilar">
                                            <div class="accordion-body py-2">
                                                {{-- Componentes Alquiler Tipo de propiedad --}}
                                                <div class="list-group">
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Alquiler')]) }}" class="list-group-item list-group-item-action border-0 p-0">Departamento</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Casas en Alquiler')]) }}" class="list-group-item list-group-item-action border-0 p-0">Casa</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Terrenos en Alquiler')]) }}" class="list-group-item list-group-item-action border-0 p-0">Terreno / Lote</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Oficinas en Alquiler')]) }}" class="list-group-item list-group-item-action border-0 p-0">Oficina</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Locales en Alquiler')]) }}" class="list-group-item list-group-item-action border-0 p-0">Local Comercial</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                {{-- Segundo nivel: alquiler dormitorios --}}
                                <div class="accordion" id="accordionAlquilarDormitorios">
                                    <div class="accordion-item rounded-0 border-0">
                                        <h2 class="accordion-header" id="headingNestedAlquilarDormitorios">
                                            <button class="custom-accordion-button custom-accordion-button accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNestedAlquilarDormitorios" aria-expanded="true" aria-controls="collapseNestedAlquilarDormitorios">
                                                Dormitorios
                                            </button>
                                        </h2>
                                        <div id="collapseNestedAlquilarDormitorios" class="accordion-collapse collapse" aria-labelledby="headingNestedAlquilarDormitorios" data-bs-parent="#accordionAlquilar">
                                            <div class="accordion-body py-2">
                                                {{-- Componentes Alquilar Dormitorios --}}
                                                <div class="list-group">
                                                    <a href="#" class="list-group-item list-group-item-action border-0 p-0">3 dormitorios</a>
                                                    <a href="#" class="list-group-item list-group-item-action border-0 p-0">2 dormitorios</a>
                                                    <a href="#" class="list-group-item list-group-item-action border-0 p-0">4 dormitorios</a>
                                                    <a href="#" class="list-group-item list-group-item-action border-0 p-0">5 o más dormitorios</a>
                                                    <a href="#" class="list-group-item list-group-item-action border-0 p-0">1 dormitorio</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    {{-- REMATES --}}
                    <div class="accordion-item rounded-0 border-0 border-bottom">
                        <h2 class="accordion-header" id="headingRemates">
                            <button class="custom-accordion-button accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRemates" aria-expanded="true" aria-controls="collapseRemates">
                                Remates
                            </button>
                        </h2>
                        <div id="collapseRemates" class="accordion-collapse collapse" aria-labelledby="headingRemates" data-bs-parent="#accordionGeneral">
                            <div class="accordion-body py-2" id="accordionRemates">
        
                                {{-- Segundo nivel: remates provincia --}}
                                <div class="accordion" id="accordionRematesProvincia">
                                    <div class="accordion-item rounded-0 border-0 border-bottom">
                                        <h2 class="accordion-header" id="headingNestedRematesProvincia">
                                            <button class="custom-accordion-button accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNestedRematesProvincia" aria-expanded="true" aria-controls="collapseNestedRematesProvincia">
                                                Provincia
                                            </button>
                                        </h2>
                                        <div id="collapseNestedRematesProvincia" class="accordion-collapse collapse" aria-labelledby="headingNestedRematesProvincia" data-bs-parent="#accordionRemates">
                                            <div class="accordion-body py-2">
                                                {{-- Componentes remates Provincia --}}
                                                <div class="list-group">
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en Lima')]) }}" class="list-group-item list-group-item-action border-0 p-0">Lima</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en Piura')]) }}" class="list-group-item list-group-item-action border-0 p-0">Piura</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en Callao')]) }}" class="list-group-item list-group-item-action border-0 p-0">Callao</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en Ica')]) }}" class="list-group-item list-group-item-action border-0 p-0">Ica</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en La Libertad')]) }}" class="list-group-item list-group-item-action border-0 p-0">La Libertad</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en Arequipa')]) }}" class="list-group-item list-group-item-action border-0 p-0">Arequipa</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en Cusco')]) }}" class="list-group-item list-group-item-action border-0 p-0">Cusco</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en Tumbes')]) }}" class="list-group-item list-group-item-action border-0 p-0">Tumbes</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate en Junín')]) }}" class="list-group-item list-group-item-action border-0 p-0">Junín</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                {{-- Segundo nivel: remates tipo de propiedad --}}
                                <div class="accordion" id="accordionAlquilarTipo">
                                    <div class="accordion-item rounded-0 border-0 border-bottom">
                                        <h2 class="accordion-header" id="headingNestedRematesTipoPropiedad">
                                            <button class="custom-accordion-button accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNestedRematesTipoPropiead" aria-expanded="true" aria-controls="collapseNestedRematesTipoPropiead">
                                                Tipo de Propiedad
                                            </button>
                                        </h2>
                                        <div id="collapseNestedRematesTipoPropiead" class="accordion-collapse collapse" aria-labelledby="headingNestedRematesTipoPropiedad" data-bs-parent="#accordionRemates">
                                            <div class="accordion-body py-2">
                                                {{-- Componentes remates Tipo de propiedad --}}
                                                <div class="list-group">
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Departamentos en Remate')]) }}" class="list-group-item list-group-item-action border-0 p-0">Departamento</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Casas en Remate')]) }}" class="list-group-item list-group-item-action border-0 p-0">Casa</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Terrenos en Remate')]) }}" class="list-group-item list-group-item-action border-0 p-0">Terreno / Lote</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Oficinas en Remate')]) }}" class="list-group-item list-group-item-action border-0 p-0">Oficina</a>
                                                    <a href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Locales en Remate')]) }}" class="list-group-item list-group-item-action border-0 p-0">Local Comercial</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                {{-- Segundo nivel: alquiler dormitorios --}}
                                <div class="accordion" id="accordionRematesDormitorios">
                                    <div class="accordion-item rounded-0 border-0">
                                        <h2 class="accordion-header" id="headingNestedRematesDormitorios">
                                            <button class="custom-accordion-button custom-accordion-button accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNestedRematesDormitorios" aria-expanded="true" aria-controls="collapseNestedRematesDormitorios">
                                                Dormitorios
                                            </button>
                                        </h2>
                                        <div id="collapseNestedRematesDormitorios" class="accordion-collapse collapse" aria-labelledby="headingNestedRematesDormitorios" data-bs-parent="#accordionRemates">
                                            <div class="accordion-body py-2">
                                                {{-- Componentes Alquilar Dormitorios --}}
                                                <div class="list-group">
                                                    <a href="#" class="list-group-item list-group-item-action border-0 p-0">3 dormitorios</a>
                                                    <a href="#" class="list-group-item list-group-item-action border-0 p-0">2 dormitorios</a>
                                                    <a href="#" class="list-group-item list-group-item-action border-0 p-0">4 dormitorios</a>
                                                    <a href="#" class="list-group-item list-group-item-action border-0 p-0">5 o más dormitorios</a>
                                                    <a href="#" class="list-group-item list-group-item-action border-0 p-0">1 dormitorio</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
        
                    {{-- SERVICIOS --}}
                    <div class="accordion-item rounded-0 border-0 border-bottom">
                        <h2 class="accordion-header" id="headingServicios">
                            <button class="custom-accordion-button accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseServicios" aria-expanded="true" aria-controls="collapseServicios">
                                <span class="">Servicios</span>
                            </button>
                        </h2>
                        <div id="collapseServicios" class="accordion-collapse collapse" aria-labelledby="headingServicios" data-bs-parent="#accordionGeneral">
                            <div class="accordion-body py-2" id="accordionServicios">
                                <div class="accordion" id="accordionServiciosProvincia">
                                    <div class="accordion-body py-2">
                                        <div class="list-group">
                                            <a class="text-decoration-none text-dark mb-1" href="/blog" target="_blank">Blog</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    {{-- PROYECTOS --}}
                    <div class="accordion-item rounded-0 border-0 border-bottom">
                        <h2 class="accordion-header" id="headingProyectos">
                            <button class="custom-accordion-button accordion-button border border-success rounded-2 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProyectos" aria-expanded="true" aria-controls="collapseProyectos">
                                <span class="text-success fw-bold">Proyectos</span>
                            </button>
                        </h2>
                        <div id="collapseProyectos" class="accordion-collapse collapse" aria-labelledby="headingProyectos" data-bs-parent="#accordionGeneral">
                            <div class="accordion-body py-2" id="accordionProyectos">
                                <div class="accordion" id="accordionProyectosProvincia">
                                    <div class="accordion-body py-2">
                                        <div class="list-group">
                                            <a class="text-decoration-none text-dark mb-1" href="{{ route('proyectos.filtrar', 'en-planos') }}">En planos</a>
                                        </div>
                                        <div class="list-group">
                                            <a class="text-decoration-none text-dark mb-1" href="{{ route('proyectos.filtrar', 'en-construccion') }}">En construcción</a>
                                        </div>
                                        <div class="list-group">
                                            <a class="text-decoration-none text-dark mb-1" href="{{ route('proyectos.filtrar', 'entrega-inmediata') }}">Entrega inmediata</a>
                                        </div>
                                        <hr class=" m-0 my-1">
                                        <div class="list-group">
                                            <a class="text-decoration-none text-dark mb-1" href="{{ route('proyectos.index') }}">Todos</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                </div>

            </div>

        
            {{-- cerrar sesión --}}
            @auth
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" type="button" class="btn btn-danger mt-3 w-100 text-center">
                    Cerrar sesión
                </a>
            @endauth

        </div>

    </div>
</div>