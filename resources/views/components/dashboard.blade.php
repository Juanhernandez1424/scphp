@props(['withSidebar' => true])

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SmartClean</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'PT Serif', serif;
            font-weight: 400;
        }

        h1 {
            font-size: 2rem;
        }

        .module-content {
            padding: 2rem 2.25rem !important;
        }

        .module-title {
            font-family: 'PT Serif', serif;
            font-size: 2rem;
            font-weight: 400;
            line-height: 1.2;
        }

        @media (max-width: 768px) {
            .module-content {
                padding: 1.25rem 1rem !important;
            }
        }

        .dashboard-card {
            border: 0;
            border-radius: 14px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .dashboard-value {
            font-size: 2rem;
            font-weight: 700;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row flex-nowrap">

            @if($withSidebar)
            <x-sidebar />
            @endif

            <main class="col module-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="module-title mb-1">Dashboard</h1>
                        <p class="text-muted mb-0">Resumen operativo del día</p>
                    </div>
                    <input type="date" id="fechaMetricas" class="form-control" style="max-width: 180px;">
                </div>

                <div id="estadoMetricas" class="alert d-none" role="status"></div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card dashboard-card h-100">
                            <div class="card-body">
                                <div class="text-muted">Lavados finalizados</div>
                                <div id="lavadosFinalizados" class="dashboard-value text-success">-</div>
                                <i class="bi bi-check-circle text-success fs-3"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dashboard-card h-100">
                            <div class="card-body">
                                <div class="text-muted">Ingresos del lavadero</div>
                                <div id="ingresosLavadero" class="dashboard-value text-primary">-</div>
                                <i class="bi bi-cash-stack text-primary fs-3"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card dashboard-card h-100">
                            <div class="card-body">
                                <div class="text-muted">Servicios pendientes</div>
                                <div id="serviciosPendientes" class="dashboard-value text-warning">-</div>
                                <i class="bi bi-hourglass-split text-warning fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        async function cargarMetricas(fecha) {
            const estado = document.getElementById('estadoMetricas');
            estado.className = 'alert alert-info';
            estado.textContent = 'Cargando métricas...';

            try {
                const response = await fetch(`/api/dashboard/metricas?fecha=${encodeURIComponent(fecha)}`, {
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'No se pudieron cargar las métricas');
                }

                const metricas = result.data;
                document.getElementById('lavadosFinalizados').textContent = metricas.lavados_finalizados;
                document.getElementById('ingresosLavadero').textContent = Number(metricas.ingresos).toLocaleString('es-CO', {
                    style: 'currency',
                    currency: 'COP',
                    maximumFractionDigits: 0
                });
                document.getElementById('serviciosPendientes').textContent = metricas.servicios_pendientes;
                estado.className = 'alert alert-light text-muted';
                estado.textContent = `Información correspondiente al ${metricas.fecha}`;
            } catch (error) {
                estado.className = 'alert alert-danger';
                estado.textContent = error.message;
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const fecha = new Date().toISOString().split('T')[0];
            const selectorFecha = document.getElementById('fechaMetricas');
            selectorFecha.value = fecha;
            cargarMetricas(fecha);
            selectorFecha.addEventListener('change', event => cargarMetricas(event.target.value));
        });
    </script>
</body>

</html>