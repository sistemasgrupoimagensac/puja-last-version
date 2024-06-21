@push('styles')
    @vite(['resources/sass/components/menu_panel.scss'])
@endpush

<aside class="lateral-submenu">
    <div class="border rounded px-2 pt-2">
        <ul id="menu-container" class="p-0 m-0 list-unstyled">
            <li class="mb-2">
                <a href="" class="active d-flex align-items-center px-3 text-decoration-none">
                    <i class="fa-solid fa-house fa-xl my-2 me-3 icon-orange"></i>
                    <span>Mis avisos</span>
                </a>
            </li>
            <li class="mb-2">
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
            </li>
        </ul>
    </div>
</aside>