<aside class="lateral-submenu d-none d-lg-block">
    <div class="border rounded px-2 pt-2">
        <ul class="menu-container p-0 m-0 list-unstyled">
            <li class="mb-2">
                <a href="{{ route('panel.proyecto.mis-proyectos') }}" class="@if(Route::currentRouteName() == 'panel.proyecto.mis-proyectos') active @endif d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-house fa-xl my-2 me-3"></i>
                    <span>Mis proyectos</span>
                </a>
            </li>
            {{-- Otras rutas de panel proyecto aquí --}}
            {{-- Ejemplo: Planes contratados (comentado por ahora, pero puede ser habilitado) --}}
            {{-- 
            <li class="mb-2">
                <a href="{{ route('panel.proyecto.planes-contratados') }}" class="@if(Route::currentRouteName() == 'panel.proyecto.planes-contratados') active @endif d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-clipboard-list fa-xl my-2 me-3"></i>
                    <span>Planes contratados</span>
                </a>
            </li>
            --}}
            <hr class="m-2">
            <li class="mb-2">
                <a href="{{ route('panel.proyecto.perfil') }}" class="@if(Route::currentRouteName() == 'panel.proyecto.perfil') active @endif d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-user fa-xl my-2 me-3"></i>
                    <span>Mi cuenta</span>
                </a>
            </li>
            {{-- Si agregas cambiar contraseña para proyectos: --}}
            
            <li class="mb-2">
                <a href="{{ route('panel.proyecto.password') }}" class="@if(Route::currentRouteName() == 'panel.proyecto.password') active @endif d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-key fa-xl my-2 me-3"></i>
                    <span>Cambiar contraseña</span>
                </a>
            </li>
           
        </ul>
    </div>
</aside>
