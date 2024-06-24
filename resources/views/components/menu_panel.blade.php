@push('styles')
    @vite(['resources/sass/components/menu_panel.scss'])
@endpush

<aside class="lateral-submenu">
    <div class="border rounded px-2 pt-2">
        <ul id="menu-container" class="p-0 m-0 list-unstyled">
            <li class="mb-2">
                <a href="{{ route('panel.mis-avisos') }}" class="@if(Route::currentRouteName() == 'panel.mis-avisos') active @endif d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-house fa-xl my-2 me-3"></i>
                    <span>Mis avisos</span>
                </a>
            </li>
            {{-- <li class="mb-2">
                <a href="" class="d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-users fa-xl my-2 me-3 text-secondary"></i>
                    <span>Interesados</span>
                </a>
            </li>
            <li class="mb-2">
                <a href="" class="d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-chart-line fa-xl my-2 me-3 text-secondary"></i>
                    <span>Mi actividad</span>
                </a>
            </li> --}}
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