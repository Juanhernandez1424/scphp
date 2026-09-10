<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración - Lavadero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .gerencia-submodulos {
            align-items: stretch;
            border-bottom: 0;
            border-radius: 10px;
            display: flex;
            gap: 0.25rem;
            margin-bottom: 1.5rem !important;
            padding: 0.25rem;
        }

        .gerencia-submodulos .nav-item {
            flex: 1 1 0;
        }

        .gerencia-submodulos .nav-link {
            align-items: center;
            border: 0;
            border-radius: 8px;
            color: #000;
            display: flex;
            gap: 0.45rem;
            justify-content: center;
            padding: 0.6rem 0.7rem;
            text-align: center;
        }

        .gerencia-submodulos .nav-link:hover {
            background-color: transparent;
            color: #2B78E4;
        }

        .gerencia-submodulos .nav-link.active {
            color: #2B78E4;
            font-weight: 600;
        }

        .gerencia-submodulos .nav-link i {
            display: inline-block;
            margin-right: 0 !important;
        }

        .gerencia-contenido .card {
            border: 0;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .gerencia-contenido .input-group {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
        }

        .gerencia-contenido .input-group-text,
        .gerencia-contenido .form-control {
            background-color: white;
            border: 0;
        }

        .gerencia-contenido .input-group:focus-within {
            border-color: #2B78E4;
            box-shadow: 0 0 0 0.15rem #9FC5F8;
        }

        .gerencia-contenido #listaClientes .list-group-item,
        .gerencia-contenido #listaColaboradores .list-group-item,
        .gerencia-contenido #listaTiposVehiculo>.card {
            border: 0;
            border-left: 4px solid #9FC5F8;
            border-radius: 10px;
            box-shadow: none;
            margin-bottom: 0.75rem;
        }

        .gerencia-contenido #listaClientes .list-group-item,
        .gerencia-contenido #listaColaboradores .list-group-item {
            padding: 1rem;
        }

        .gerencia-contenido #listaTiposVehiculo>.card .card-header {
            background-color: white;
            border-bottom: 0;
        }

        .gerencia-contenido #listaTiposVehiculo>.card .border-bottom {
            border-left: 3px solid #9FC5F8;
            border-bottom: 0 !important;
            border-radius: 6px;
            padding-left: 0.75rem;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <x-sidebar />

        <div class="flex-grow-1 p-4" style="background-color: #f8f9fa; min-height: 100vh;">
            <div class="mb-4">
                <h2 class="mb-1">Administración</h2>
                <p class="text-muted">Configura empleados, servicios, precios y clientes del lavadero</p>
            </div>

            <ul class="nav gerencia-submodulos mb-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('gerencia.clientes') ? 'active' : '' }}"
                        href="{{ route('gerencia.clientes') }}">
                        <i class="bi bi-people me-2"></i>Clientes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('gerencia.colaboradores') ? 'active' : '' }}"
                        href="{{ route('gerencia.colaboradores') }}">
                        <i class="bi bi-person-badge me-2"></i>Colaboradores
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('gerencia.servicios') ? 'active' : '' }}"
                        href="{{ route('gerencia.servicios') }}">
                        <i class="bi bi-tools me-2"></i>Servicios
                    </a>
                </li>
            </ul>

            <div class="tab-content gerencia-contenido">
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