@push('styles')
    @vite(['resources/sass/components/menu_panel.scss'])
@endpush

<aside class="lateral-submenu d-none d-lg-block">
    <div class="border rounded px-2 pt-2">
        <ul class="menu-container p-0 m-0 list-unstyled">
            <li class="mb-2">
                <a href="{{ route('panel.proyecto.mis-proyectos') }}" class="@if(Route::currentRouteName() == 'panel.proyecto.mis-proyectos') active @endif d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-house fa-xl my-2 me-3"></i>
                    <span>Mis proyectos</span>
                </a>
            </li>
            
            <li class="mb-2">
                <a href="{{ route('panel.proyecto.proyectos-contratados') }}" class="@if(Route::currentRouteName() == 'panel.proyecto.proyectos-contratados') active @endif d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-clipboard-list fa-xl my-2 me-3"></i>
                    <span>Proyectos contratados</span>
                </a>
            </li>
            
            <li class="mb-2">
                <a href="{{ route('panel.proyecto.interesados') }}" class="@if(Route::currentRouteName() == 'panel.proyecto.interesados') active @endif d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-envelope-open-text fa-xl my-2 me-3"></i>
                    <span>Interesados</span>
                </a>
            </li>
           
            <hr class="m-2">
            <li class="mb-2">
                <a href="{{ route('panel.proyecto.perfil') }}" class="@if(Route::currentRouteName() == 'panel.proyecto.perfil') active @endif d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-user fa-xl my-2 me-3"></i>
                    <span>Mi cuenta</span>
                </a>
            </li>
            
            <li class="mb-2">
                <a href="{{ route('panel.proyecto.password') }}" class="@if(Route::currentRouteName() == 'panel.proyecto.password') active @endif d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-key fa-xl my-2 me-3"></i>
                    <span>Cambiar contraseña</span>
                </a>
            </li>
           
        </ul>
    </div>
</aside>
