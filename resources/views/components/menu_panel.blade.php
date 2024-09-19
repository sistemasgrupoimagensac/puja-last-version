@push('styles')
    @vite(['resources/sass/components/menu_panel.scss'])
@endpush

<aside class="lateral-submenu d-none d-lg-block">
    <div class="border rounded px-2 pt-2">
        <ul class="menu-container p-0 m-0 list-unstyled">
            <li class="mb-2">
                <a href="{{ route('panel.mis-avisos') }}" class="@if(Route::currentRouteName() == 'panel.mis-avisos') active @endif d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-house fa-xl my-2 me-3"></i>
                    <span>Mis avisos</span>
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('panel.planes-contratados') }}" class="@if(Route::currentRouteName() == 'panel.planes-contratados') active @endif d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-clipboard-list fa-xl my-2 me-3"></i>
                    <span>Planes contratados</span>
                </a>
            </li>
            <hr class="m-2">
            <li class="mb-2">
                <a href="{{ route('panel.perfil') }}" class="@if(Route::currentRouteName() == 'panel.perfil') active @endif d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-user fa-xl my-2 me-3"></i>
                    <span>Mi cuenta</span>
                </a>
            </li>
            <li class="mb-2">
                <a href="{{ route('panel.password') }}" class="@if(Route::currentRouteName() == 'panel.password') active @endif d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-key fa-xl my-2 me-3"></i>
                    <span>Cambiar contraseña</span>
                </a>
            </li>
        </ul>
    </div>
</aside>