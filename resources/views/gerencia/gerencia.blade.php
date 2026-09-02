<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración - Lavadero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <div class="d-flex">
        <x-sidebar />
        
        <div class="flex-grow-1 p-4" style="background-color: #f8f9fa; min-height: 100vh;">
            <div class="mb-4">
                <h2 class="mb-1">Administración</h2>
                <p class="text-muted">Configura empleados, servicios, precios y clientes del lavadero</p>
            </div>

            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('gerencia.clientes') ? 'active' : '' }}"
                       href="{{ route('gerencia.clientes') }}">
                        <i class="bi bi-people me-2"></i>Clientes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('gerencia.colaboradores') ? 'active' : '' }}"
                       href="{{ route('gerencia.colaboradores') }}">
                        <i class="bi bi-person-badge me-2"></i>Empleados
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('gerencia.servicios') ? 'active' : '' }}"
                       href="{{ route('gerencia.servicios') }}">
                        <i class="bi bi-tools me-2"></i>Servicios
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                @if(request()->routeIs('gerencia.clientes'))
                    <x-clientes />
                @elseif(request()->routeIs('gerencia.colaboradores'))
                    <x-colaboradores />
                @elseif(request()->routeIs('gerencia.servicios'))
                    <x-servicios />
                @else
                    <x-dashboard :withSidebar="false" />
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>