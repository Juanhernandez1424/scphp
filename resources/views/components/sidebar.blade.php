<!-- Estilos CSS para el sidebar -->
<style>
    :root {
        --color-primary: #2b78e4;
        --color-secondary: #9fc5f8;
        --color-tertiary: #8474b0;
    }

    .transition-sidebar {
        transition: all 0.3s ease;
    }

    .sidebar-collapsed-custom {
        width: 70px !important;
    }

    .sidebar-collapsed-custom .nav-text-custom {
        display: none !important;
    }

    .sidebar-collapsed-custom .nav-link,
    .sidebar-collapsed-custom .dropdown-toggle,
    .sidebar-collapsed-custom .brand-link {
        justify-content: center !important;
        text-align: center !important;
    }

    .nav-link.active {
        background-color: rgba(255, 255, 255, 0.2) !important;
    }
</style>

<!-- CONTENEDOR DE LA BARRA LATERAL -->
<div id="sidebar"
    class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 min-vh-100 d-flex flex-column justify-content-between transition-sidebar"
    style="background-color: var(--color-primary);">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white w-100">

        <div class="d-flex justify-content-between align-items-center w-100 pb-3 mb-md-0">
            <a href="{{ route('dashboard') }}"
                class="d-flex align-items-center text-white text-decoration-none brand-link">
                <span class="fs-5 nav-text-custom">SmartClean</span>
            </a>
            <button id="sidebarToggle" class="btn btn-link text-white p-0" type="button">
                <i id="toggleIcon" class="bi bi-chevron-left"></i>
            </button>
        </div>

        <!-- Menú de Enlaces usando variables de Laravel -->
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start w-100" id="menu">
            <li class="nav-item w-100">
                <!-- Reemplazamos la lógica vieja de PHP por directivas de Blade -->
                <a href="{{ route('dashboard') }}"
                    class="nav-link align-middle px-3 text-white d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    style="gap: 1rem;">
                    <i class="bi bi-graph-up fs-2"></i>
                    <span class="nav-text-custom">Dashboard</span>
                </a>
            </li>
            <li class="w-100">
                <a href="{{ route('reservas') }}"
                    class="nav-link px-3 align-middle text-white d-flex align-items-center {{ request()->routeIs('reservas') ? 'active' : '' }}"
                    style="gap: 1rem;">
                    <i class="bi bi-car-front-fill fs-2"></i>
                    <span class="nav-text-custom">Reservas</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Menú de Usuario -->
    <div class="dropdown pb-4 px-3 w-100 dropdown-container-custom">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle px-2"
            style="gap: 0.5rem;" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle fs-4"></i>
            <span class="nav-text-custom">Usuario</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">Configuración</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Cerrar sesión</button>
                </form>
            </li>
        </ul>
    </div>
</div>

<!-- Script de JS para el comportamiento del botón -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const toggleIcon = document.getElementById('toggleIcon');
        const dropdownContainer = document.querySelector('.dropdown-container-custom');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed-custom');
            if (sidebar.classList.contains('sidebar-collapsed-custom')) {
                sidebar.classList.remove('col-md-3', 'col-xl-2');
                sidebar.classList.add('col-auto');
                dropdownContainer.classList.add('text-center');
                toggleIcon.className = 'bi bi-chevron-right';
            } else {
                sidebar.classList.remove('col-auto');
                sidebar.classList.add('col-md-3', 'col-xl-2');
                dropdownContainer.classList.remove('text-center');
                toggleIcon.className = 'bi bi-chevron-left';
            }
        });
    });
</script>