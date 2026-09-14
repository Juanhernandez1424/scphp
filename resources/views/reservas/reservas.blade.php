<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reservas - SmartClean</title>
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

        .page-title {
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

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1rem 1.25rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #f0f0f0;
            height: 100%;
            transition: all 0.2s;
        }

        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .stat-card .stat-icon {
            font-size: 1.25rem;
            color: #adb5bd;
        }

        .stat-card .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1.2;
        }

        .stat-card .stat-label {
            font-size: 0.75rem;
            color: #6c757d;
            font-weight: 500;
        }

        .card-custom {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border: 1px solid #f0f0f0;
        }

        .card-custom .card-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.25rem;
        }

        .card-custom .card-subtitle {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .search-box {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 0.5rem 1rem;
            width: 100%;
            font-size: 0.9rem;
        }

        .search-box:focus {
            border-color: #212529;
            box-shadow: none;
            outline: none;
        }

        .btn-search {
            background: #2B78E4;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 2rem;
            font-weight: 600;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .btn-search:hover {
            background: #2167c5;
            color: white;
        }

        .btn-cambiar {
            border: 1px solid #dee2e6;
            background: white;
            color: #495057;
            border-radius: 8px;
            padding: 0.25rem 1rem;
            font-size: 0.8rem;
        }

        .btn-cambiar:hover {
            background: #f8f9fa;
        }

        .client-found {
            background-color: #9FC5F8;
            border: 1px solid #7eaddf;
            border-radius: 12px;
            padding: 1rem;
            margin-top: 0.75rem;
        }

        .client-found .client-name {
            font-weight: 700;
            color: #1a1a1a;
            font-size: 1rem;
        }

        .client-found .client-info {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .empty-state {
            text-align: center;
            padding: 2rem 0;
            color: #adb5bd;
        }

        .empty-state i {
            font-size: 2rem;
            display: block;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        .reserva-item {
            border: 1px solid #f0f0f0;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 0.75rem;
            background: white;
            transition: all 0.2s;
        }

        .reserva-item:hover {
            border-color: #dee2e6;
        }

        .reserva-item .placa {
            font-weight: 700;
            font-size: 1rem;
            color: #1a1a1a;
        }

        .reserva-item .cliente-nombre {
            font-size: 0.85rem;
            color: #495057;
        }

        .reserva-item .servicio-info {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .reserva-item .tiempo {
            font-size: 0.7rem;
            color: #adb5bd;
        }

        .btn-activar {
            background: #2B78E4;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.3rem 1rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .btn-activar:hover {
            background: #2167c5;
            color: white;
        }

        .btn-iniciar-lavado,
        .btn-finalizar {
            background: #2B78E4;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.3rem 1rem;
            font-size: 0.75rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-iniciar-lavado:hover,
        .btn-finalizar:hover {
            background: #2167c5;
            color: white;
        }

        .btn-cancelar-reserva {
            background: #f8f9fa;
            color: #495057;
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 0.3rem 1rem;
            font-size: 0.75rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-cancelar-reserva:hover {
            background: #e9ecef;
            color: #212529;
        }

        .lavado-completado {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border-left: 3px solid #8474B0;
            margin-bottom: 0.5rem;
        }

        .lavado-completado .placa {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .lavado-completado .cliente {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .lavado-completado .servicio {
            font-size: 0.75rem;
            color: #6c757d;
        }

        .badge-completado {
            background: #8474B0;
            color: white;
            font-size: 0.7rem;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .form-select-custom {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            width: 100%;
        }

        .form-select-custom:focus {
            border-color: #212529;
            box-shadow: none;
            outline: none;
        }

        .precio-servicio {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a1a1a;
        }

        .label-form {
            font-size: 0.8rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.25rem;
        }

        .btn-iniciar {
            background: #2B78E4;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.6rem;
            font-weight: 600;
            font-size: 0.9rem;
            width: 100%;
            transition: all 0.2s;
        }

        .btn-iniciar:hover {
            background: #2167c5;
            color: white;
        }

        .text-success-badge {
            color: #2B78E4;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .text-warning-badge {
            color: #ffc107;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .page-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a1a1a;
        }

        .page-subtitle {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .spinner-loading {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #212529;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 0.5rem;
        }

        .badge-estado {
            display: inline-flex;
            align-items: center;
            font-size: 0.75rem;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .badge-finalizada {
            background: #d4edda;
            color: #155724;
        }

        .badge-cancelada {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-secundario {
            background: #e9ecef;
            color: #495057;
        }

        .reserva-estado {
            display: inline-flex;
            align-items: center;
            background: #8474B0;
            color: white;
            border-radius: 6px;
            padding: 0.25rem 0.65rem;
            font-size: 0.7rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .reserva-acciones {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 0.4rem;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .vehiculo-select {
            margin-top: 0.5rem;
        }

        .vehiculo-select select {
            font-size: 0.85rem;
            padding: 0.3rem 0.75rem;
        }

        .placa-badge {
            font-weight: 600;
            color: #1a1a1a;
        }

        .modal-total {
            background: #f1eef8;
            border: 1px solid #8474B0;
            border-radius: 12px;
            padding: 1rem;
        }

        .modal-total .amount {
            color: #8474B0;
            font-size: 1.75rem;
            font-weight: 700;
        }

        .payment-option {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            cursor: pointer;
            padding: 0.75rem 1rem;
            transition: border-color 0.2s, background-color 0.2s;
        }

        .payment-option:has(input:checked) {
            background: #9FC5F8;
            border-color: #2B78E4;
        }

        .payment-option input:checked {
            accent-color: #2B78E4;
        }

        .btn-cancelar-pago {
            background: white;
            border: 1px solid #6c757d;
            color: #6c757d;
        }

        .btn-cancelar-pago:hover {
            background: #f1f3f5;
            border-color: #495057;
            color: #495057;
        }

        .btn-confirmar-pago {
            background: #2B78E4;
            border: 1px solid #2B78E4;
            color: white;
        }

        .btn-confirmar-pago:hover,
        .btn-confirmar-pago:focus {
            background: #2167c5;
            border-color: #2167c5;
            color: white;
        }

        .receipt {
            border: 1px dashed #adb5bd;
            border-radius: 10px;
            padding: 1.25rem;
        }

        .receipt-row {
            border-bottom: 1px solid #f1f3f5;
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.55rem 0;
        }

        .receipt-row:last-child {
            border-bottom: 0;
        }

        .receipt-label {
            color: #6c757d;
        }

        .receipt-value {
            font-weight: 600;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <x-sidebar />
            <main class="col module-content" style="background: #f8f9fa; min-height: 100vh;">
                <div class="container-fluid px-4">

                    <!-- ========== TÍTULO ========== -->
                    <div class="mb-4">
                        <h1 class="module-title mb-1">Lavados y reservas</h1>
                        <p class="text-muted">Configura empleados, servicios, precios y clientes del lavadero</p>
                    </div>

                    <!-- ========== STATS ========== -->
                    <!-- <div class="row g-2 mb-4">
                        <div class="col-md-2 col-6">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-number" id="lavadosHoy">0</div>
                                        <div class="stat-label">Lavados Hoy</div>
                                    </div>
                                    <i class="bi bi-water stat-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-number">0m 0s</div>
                                        <div class="stat-label">Tiempo Promedio</div>
                                    </div>
                                    <i class="bi bi-clock stat-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-number">$ 0</div>
                                        <div class="stat-label">Ganancia Hoy</div>
                                    </div>
                                    <i class="bi bi-coin stat-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-number" id="reservasPendientes">0</div>
                                        <div class="stat-label">Reservas Pendientes</div>
                                    </div>
                                    <i class="bi bi-calendar-check stat-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="stat-card">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="stat-number">0</div>
                                        <div class="stat-label">Pendientes de Cobro</div>
                                    </div>
                                    <i class="bi bi-cash stat-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- ========== CONTENIDO PRINCIPAL: 2 COLUMNAS ========== -->
                    <div class="row g-4">

                        <!-- ====== COLUMNA IZQUIERDA: BUSCADOR + FORMULARIO ====== -->
                        <div class="col-lg-6">

                            @if(!in_array((int) auth()->user()->id_rol, [3, 4], true))
                            <!-- Buscador de Cliente -->
                            <div class="card-custom mb-4">
                                <div class="card-title">Buscar Cliente</div>
                                <p class="card-subtitle">Ingresa el tipo y número de documento del cliente</p>

                                <form id="formBuscarCliente" class="d-flex gap-2 mt-3">
                                    <select name="tipo_doc" id="tipoDocBusqueda" class="form-select-custom"
                                        style="max-width: 80px;">
                                        <option value="CC">CC</option>
                                        <option value="CE">CE</option>
                                        <option value="NIT">NIT</option>
                                    </select>
                                    <input type="text" id="numDocBusqueda" class="search-box" placeholder="1098765432"
                                        required>
                                    <button type="button" class="btn-search" onclick="buscarCliente()">
                                        <i class="bi bi-search me-1"></i> Buscar
                                    </button>
                                </form>

                                <div id="resultadoBusqueda"></div>
                            </div>
                            @endif

                            @if((int) auth()->user()->id_rol != 4)
                            <!-- Formulario de Reserva -->
                            <div class="card-custom" id="formularioReserva" style="display: none;">
                                <div class="card-title">Crear Reserva</div>

                                @if(auth()->user()->id_rol == 3)
                                <div id="resultadoBusqueda"></div>
                                @endif

                                <form id="formReserva" onsubmit="return false;">
                                    @csrf
                                    <input type="hidden" name="cliente_id" id="clienteId">

                                    <div class="mb-3">
                                        <label class="label-form">Colaborador</label>
                                        <select name="colaborador_id" id="selectColaborador" class="form-select-custom">
                                            <option value="">Cargando colaboradores...</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="label-form">Tipo de Vehículo</label>
                                        <select name="tipo_vehiculo_id" id="selectTipoVehiculo"
                                            class="form-select-custom" onchange="cargarServicios()">
                                            <option value="">Selecciona un tipo...</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="label-form">Servicio</label>
                                        <select name="servicio_id" id="selectServicio" class="form-select-custom"
                                            onchange="actualizarPrecio()">
                                            <option value="">Selecciona un servicio...</option>
                                        </select>
                                    </div>

                                    <!-- ✅ NUEVO: Fecha y Hora -->
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="label-form">Fecha</label>
                                            <input type="date" id="fechaReserva" class="form-control form-select-custom"
                                                style="padding: 0.5rem 1rem;">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="label-form">Hora</label>
                                            <select id="horaReserva" class="form-control form-select-custom"
                                                style="padding: 0.5rem 1rem;">
                                                <option value="">Selecciona una ventana...</option>
                                                @for ($minutos = 7 * 60; $minutos < 18 * 60; $minutos +=30)
                                                    @php
                                                    $horaInicio=sprintf('%02d:%02d', intdiv($minutos, 60), $minutos % 60);
                                                    $horaFin=sprintf('%02d:%02d', intdiv($minutos + 30, 60), ($minutos + 30) % 60);
                                                    @endphp
                                                    <option value="{{ $horaInicio }}">{{ $horaInicio }} - {{ $horaFin }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div id="disponibilidadReserva" class="alert py-2 px-3 mb-4" role="status"
                                        style="display: none;"></div>

                                    <div class="mb-4">
                                        <label class="label-form">Precio del servicio</label>
                                        <div class="precio-servicio" id="precioMostrado">$ 0</div>
                                    </div>

                                    <button type="button" id="btnCrearReserva" class="btn-iniciar" onclick="crearReserva()"
                                        disabled>
                                        <i class="bi bi-calendar-plus me-2"></i> Crear Reserva
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>

                        <!-- ====== COLUMNA DERECHA: RESERVAS Y LAVADOS ====== -->
                        <div class="col-lg-6">

                            <!-- Reservas de Hoy -->
                            <div class="card-custom mb-4">
                                <div class="card-title">Reservas de Hoy</div>
                                <p class="card-subtitle">Activa las reservas cuando el cliente llegue al lavadero</p>

                                <div id="listaReservas">
                                    <div class="empty-state">
                                        <i class="bi bi-calendar-x"></i>
                                        <p>No hay reservas pendientes</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Lavados Completados Hoy -->
                            <div class="card-custom">
                                <div class="card-title">Lavados Completados Hoy</div>

                                <div id="listaLavadosCompletados">
                                    <div class="empty-state">
                                        <i class="bi bi-check-circle"></i>
                                        <p>No hay lavados completados</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <!-- Modal para registrar el pago al finalizar un lavado -->
    <div class="modal fade" id="modalPagoReserva" tabindex="-1" aria-labelledby="modalPagoReservaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPagoReservaLabel">Finalizar reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted mb-3">Confirma el valor recibido y selecciona el método de pago.</p>
                    <div class="modal-total d-flex justify-content-between align-items-center mb-4">
                        <span class="fw-semibold">Total a pagar</span>
                        <span class="amount" id="pagoTotal">$ 0</span>
                    </div>

                    <div class="mb-2 fw-semibold">Método de pago</div>
                    <div class="d-grid gap-2" id="metodosPago">
                        <div class="text-muted small">Cargando métodos de pago...</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancelar-pago" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-confirmar-pago" id="btnConfirmarPago" onclick="confirmarPago()">
                        <i class="bi bi-check-circle me-1"></i>Confirmar pago
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Recibo mostrado después de finalizar correctamente la reserva -->
    <div class="modal fade" id="modalReciboReserva" tabindex="-1" aria-labelledby="modalReciboReservaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalReciboReservaLabel">Recibo de servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="bi bi-check-circle-fill text-success fs-1"></i>
                        <h5 class="mt-2 mb-1">Pago recibido</h5>
                        <p class="text-muted small mb-0" id="reciboFechaEmision"></p>
                    </div>
                    <div class="receipt">
                        <div class="receipt-row"><span class="receipt-label">Reserva</span><span class="receipt-value" id="reciboId"></span></div>
                        <div class="receipt-row"><span class="receipt-label">Cliente</span><span class="receipt-value" id="reciboCliente"></span></div>
                        <div class="receipt-row"><span class="receipt-label">Vehículo</span><span class="receipt-value" id="reciboVehiculo"></span></div>
                        <div class="receipt-row"><span class="receipt-label">Servicio</span><span class="receipt-value" id="reciboServicio"></span></div>
                        <div class="receipt-row"><span class="receipt-label">Fecha y hora</span><span class="receipt-value" id="reciboFechaServicio"></span></div>
                        <div class="receipt-row"><span class="receipt-label">Método de pago</span><span class="receipt-value" id="reciboMetodoPago"></span></div>
                        <div class="receipt-row fs-5"><span class="fw-semibold">Total</span><span class="receipt-value text-success" id="reciboTotal"></span></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar recibo</button>
                    <button type="button" class="btn btn-primary" onclick="descargarRecibo()">
                        <i class="bi bi-download me-1"></i>Descargar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditarReserva" tabindex="-1" aria-labelledby="modalEditarReservaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarReservaLabel">Editar reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editarReservaId">
                    <div class="mb-3">
                        <label class="label-form">Vehículo</label>
                        <select id="editarPlacaVehiculo" class="form-select form-select-custom"></select>
                    </div>
                    <div class="mb-3">
                        <label class="label-form">Colaborador</label>
                        <select id="editarColaborador" class="form-select form-select-custom"></select>
                    </div>
                    <div class="mb-3">
                        <label class="label-form">Tipo de vehículo</label>
                        <select id="editarTipoVehiculo" class="form-select form-select-custom"></select>
                    </div>
                    <div class="mb-3">
                        <label class="label-form">Servicio</label>
                        <select id="editarServicio" class="form-select form-select-custom"></select>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="label-form">Fecha</label>
                            <input type="date" id="editarFecha" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="label-form">Hora</label>
                            <select id="editarHora" class="form-select"></select>
                        </div>
                    </div>
                    <div id="editarReservaEstado" class="alert mt-3 d-none"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarEdicionReserva()">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ========== VARIABLES GLOBALES ==========
        let clienteEncontrado = null;
        let colaboradoresData = [];
        let tiposVehiculoData = [];
        let serviciosData = [];
        let vehiculosCliente = [];
        let reservaPendienteDePago = null;
        let reciboActual = null;
        const esClienteAutenticado = @json($rolUsuario === 3);
        const esColaboradorAutenticado = @json($rolUsuario === 4);
        const esAdministradorAutenticado = @json($rolUsuario === 1);
        const clienteAutenticado = @json($clienteAutenticado ?? null);

        // ========== BUSCAR CLIENTE ==========
        async function buscarCliente() {
            const tipoDoc = document.getElementById('tipoDocBusqueda').value;
            const numDoc = document.getElementById('numDocBusqueda').value.trim();

            if (!numDoc) {
                alert('Por favor ingresa el número de documento');
                return;
            }

            const resultadoDiv = document.getElementById('resultadoBusqueda');
            resultadoDiv.innerHTML = `
            <div class="text-center py-3">
                <div class="spinner-loading"></div>
                Buscando cliente...
            </div>
        `;

            try {
                const response = await fetch(`/api/clientes/byTipoNumDoc?tipoDoc=${tipoDoc}&numDoc=${numDoc}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                console.log(response);

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Error al buscar cliente');
                }

                if (!result.data) {
                    resultadoDiv.innerHTML = `
                    <div class="alert alert-warning mt-3 py-2 px-3 small rounded-3 mb-0">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        No se encontró un cliente con los datos ingresados
                    </div>
                `;
                    document.getElementById('formularioReserva').style.display = 'none';
                    return;
                }

                clienteEncontrado = result.data;
                mostrarClienteEncontrado(clienteEncontrado);

            } catch (error) {
                console.error('Error:', error);
                resultadoDiv.innerHTML = `
                <div class="alert alert-danger mt-3 py-2 px-3 small rounded-3 mb-0">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Error: ${error.message}
                </div>
            `;
            }
        }

        // ========== MOSTRAR CLIENTE ENCONTRADO ==========
        function mostrarClienteEncontrado(cliente) {
            const resultadoDiv = document.getElementById('resultadoBusqueda');
            const usuario = cliente.usuario || {};
            const vehiculos = cliente.vehiculo || [];

            const nombreCompleto = `${usuario.nombre_usuario || ''} ${usuario.apellido_usuario || ''}`.trim() ||
                'Sin nombre';
            const tipoDoc = usuario.tipo_documento || 'CC';
            const documento = cliente.no_documento_cliente || 'N/A';
            const telefono = usuario.numero_celular || 'N/A';

            // Guardar vehículos del cliente
            vehiculosCliente = vehiculos;

            // Construir select de vehículos
            let vehiculosHtml = '';
            if (vehiculos.length > 0) {
                vehiculosHtml = `
                    <div class="vehiculo-select mt-2">
                        <label class="label-form" style="font-size: 0.8rem;">Selecciona un vehículo</label>
                        <select id="vehiculoClienteSelect" class="form-select-custom" style="font-size: 0.85rem;">
                            <option value="">Selecciona un vehículo...</option>
                            ${vehiculos.map(v => `
                                <option value="${v.placa_vehiculo}" 
                                    data-tipo="${v.id_tipo_vehiculo}" 
                                    data-color="${v.color_vehiculo || ''}"
                                    data-marca="${v.marca_vehiculo || ''}"
                                    data-modelo="${v.modelo_vehiculo || ''}">
                                    ${v.placa_vehiculo} - ${v.id_tipo_vehiculo || 'Sin tipo'} ${v.marca_vehiculo ? '· ' + v.marca_vehiculo : ''}
                                </option>
                            `).join('')}
                        </select>
                    </div>
                `;
            } else {
                vehiculosHtml = `
                    <div class="vehiculo-select mt-2">
                        <small class="text-muted">⚠️ Cliente sin vehículos registrados</small>
                    </div>
                `;
            }

            resultadoDiv.innerHTML = `
                <div class="client-found">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold d-flex align-items-center gap-2">
                            <i class="bi bi-person text-success"></i>
                                <span class="text-dark fw-bold">${esClienteAutenticado ? 'Información del cliente' : 'Cliente encontrado'}</span>
                            </span>
                            ${esClienteAutenticado ? '' : '<button class="btn-cambiar" onclick="limpiarBusqueda()">Cambiar</button>'}
                    </div>
                    <div class="client-name">${nombreCompleto}</div>
                    <div class="client-info">
                        ${tipoDoc}: ${documento} | Tel: ${telefono}
                        ${vehiculos.length > 0 ? ` | ${vehiculos.length} vehículo(s)` : ' | Sin vehículos'}
                    </div>
                    ${vehiculosHtml}
                </div>
            `;

            const selectVehiculo = document.getElementById('vehiculoClienteSelect');
            if (selectVehiculo) {
                selectVehiculo.addEventListener('change', function() {
                    const placaVehiculoSeleccionada = document.getElementById('placaVehiculoSeleccionada');
                    if (placaVehiculoSeleccionada) {
                        placaVehiculoSeleccionada.value = this.value;
                    }
                });
            }

            // Mostrar formulario de reserva
            document.getElementById('clienteId').value = cliente.no_documento_cliente;
            document.getElementById('formularioReserva').style.display = 'block';

            // Establecer fecha y hora por defecto
            const hoy = new Date();
            const fechaHoy = hoy.toISOString().split('T')[0];

            document.getElementById('fechaReserva').value = fechaHoy;
            document.getElementById('horaReserva').value = '';
            actualizarDisponibilidad();

            document.getElementById('selectColaborador').focus();
        }

        // ========== LIMPIAR BÚSQUEDA ==========
        function limpiarBusqueda() {
            const numDocBusqueda = document.getElementById('numDocBusqueda');
            if (numDocBusqueda) numDocBusqueda.value = '';
            document.getElementById('resultadoBusqueda')?.replaceChildren();
            document.getElementById('formularioReserva')?.style.setProperty('display', 'none');
            clienteEncontrado = null;
            const clienteId = document.getElementById('clienteId');
            if (clienteId) clienteId.value = '';
            if (document.getElementById('selectColaborador')) document.getElementById('selectColaborador').selectedIndex = 0;
            if (document.getElementById('selectTipoVehiculo')) document.getElementById('selectTipoVehiculo').selectedIndex = 0;
            if (document.getElementById('selectServicio')) document.getElementById('selectServicio').innerHTML = '<option value="">Selecciona un servicio...</option>';
            document.getElementById('precioMostrado')?.replaceChildren(document.createTextNode('$ 0'));
            const placaVehiculoSeleccionada = document.getElementById('placaVehiculoSeleccionada');
            if (placaVehiculoSeleccionada) placaVehiculoSeleccionada.value = '';
            vehiculosCliente = [];
            const fechaReserva = document.getElementById('fechaReserva');
            const horaReserva = document.getElementById('horaReserva');
            if (fechaReserva) fechaReserva.value = '';
            if (horaReserva) horaReserva.value = '';
        }

        // ========== CREAR RESERVA ==========
        async function crearReserva() {
            const clienteId = document.getElementById('clienteId').value;
            const colaboradorId = document.getElementById('selectColaborador').value;
            const placaVehiculo = document.getElementById('vehiculoClienteSelect')?.value || '';
            const tipoVehiculoId = document.getElementById('selectTipoVehiculo').value;
            const servicioId = document.getElementById('selectServicio').value;
            const fecha = document.getElementById('fechaReserva').value;
            const hora = document.getElementById('horaReserva').value;

            // Validaciones
            if (!clienteId) {
                alert('Primero busca un cliente');
                return;
            }

            if (!colaboradorId) {
                alert('Selecciona un colaborador');
                return;
            }

            if (!placaVehiculo) {
                alert('Selecciona un vehículo del cliente en el área de "Cliente encontrado"');
                return;
            }

            if (!tipoVehiculoId) {
                alert('Selecciona un tipo de vehículo');
                return;
            }

            if (!servicioId) {
                alert('Selecciona un servicio');
                return;
            }

            if (!fecha) {
                alert('Selecciona una fecha para la reserva');
                return;
            }

            if (!hora) {
                alert('Selecciona una hora para la reserva');
                return;
            }

            const payload = {
                no_documento_cliente: parseInt(clienteId),
                no_documento_colaborador: parseInt(colaboradorId),
                placa_vehiculo: placaVehiculo,
                id_tipo_vehiculo: parseInt(tipoVehiculoId),
                id_servicio: parseInt(servicioId),
                fecha: fecha,
                hora: hora,
                fotos_vehiculo: '',
                etapa_lavado: 'Pendiente'
            };

            console.log('📤 Payload enviado:', JSON.stringify(payload, null, 2));

            try {
                const response = await fetch('/api/reservas', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'No se pudo crear la reserva');
                }

                alert('Reserva creada correctamente');
                limpiarBusqueda();
                cargarReservasHoy();

            } catch (error) {
                console.error('Error:', error);
                alert('Error: ' + error.message);
            }
        }

        // ========== LIMPIAR BÚSQUEDA ==========
        function limpiarBusqueda() {
            const numDocBusqueda = document.getElementById('numDocBusqueda');
            if (numDocBusqueda) numDocBusqueda.value = '';
            document.getElementById('resultadoBusqueda')?.replaceChildren();
            document.getElementById('formularioReserva')?.style.setProperty('display', 'none');
            clienteEncontrado = null;
            const clienteId = document.getElementById('clienteId');
            if (clienteId) clienteId.value = '';
            if (document.getElementById('selectColaborador')) document.getElementById('selectColaborador').selectedIndex = 0;
            if (document.getElementById('selectTipoVehiculo')) document.getElementById('selectTipoVehiculo').selectedIndex = 0;
            if (document.getElementById('selectServicio')) document.getElementById('selectServicio').innerHTML = '<option value="">Selecciona un servicio...</option>';
            const precioMostrado = document.getElementById('precioMostrado');
            if (precioMostrado) precioMostrado.textContent = '$ 0';
        }

        // ========== CARGAR COLABORADORES ==========
        async function cargarColaboradores() {
            try {
                const response = await fetch('/api/colaboradores', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Error al cargar los colaboradores');
                }

                colaboradoresData = result.data || [];
                const select = document.getElementById('selectColaborador');
                select.innerHTML = '<option value="">Selecciona un colaborador...</option>';

                colaboradoresData.forEach(colaborador => {
                    const usuario = colaborador.usuario || {};
                    const nombreCompleto = `${usuario.nombre_usuario || ''} ${usuario.apellido_usuario || ''}`
                        .trim() || 'Sin nombre';
                    const estado = colaborador.estado_colaborador !== undefined ? colaborador
                        .estado_colaborador : 1;
                    const estadoTexto = estado == 1 ? 'Disponible' : 'Ocupado';
                    const estadoClass = estado == 1 ? 'text-success-badge' : 'text-warning-badge';

                    select.innerHTML += `
                    <option value="${colaborador.no_documento_colaborador}">
                        ${nombreCompleto} <span class="${estadoClass}">${estadoTexto}</span>
                    </option>
                `;
                });

            } catch (error) {
                console.error('Error:', error);
                document.getElementById('selectColaborador').innerHTML = `
                <option value="">Error al cargar colaboradores</option>
            `;
            }
        }

        // ========== CARGAR TIPOS DE VEHÍCULO ==========
        async function cargarTiposVehiculo() {
            try {
                const response = await fetch('/api/tipo-vehiculo', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Error al cargar los tipos de vehículo');
                }

                tiposVehiculoData = result.data || [];
                const select = document.getElementById('selectTipoVehiculo');
                select.innerHTML = '<option value="">Selecciona un tipo...</option>';

                tiposVehiculoData.forEach(tipo => {
                    select.innerHTML += `
                    <option value="${tipo.id_tipo_vehiculo}">${tipo.nombre_tipo_vehiculo}</option>
                `;
                });

                // Cargar servicios del primer tipo si existe
                if (tiposVehiculoData.length > 0) {
                    cargarServicios();
                }

            } catch (error) {
                console.error('Error:', error);
                document.getElementById('selectTipoVehiculo').innerHTML = `
                <option value="">Error al cargar tipos</option>
            `;
            }
        }

        // ========== CARGAR SERVICIOS POR TIPO DE VEHÍCULO ==========
        async function cargarServicios() {
            const tipoVehiculoId = document.getElementById('selectTipoVehiculo').value;

            if (!tipoVehiculoId) {
                document.getElementById('selectServicio').innerHTML =
                    '<option value="">Selecciona un tipo primero...</option>';
                document.getElementById('precioMostrado').textContent = '$ 0';
                return;
            }

            try {
                const response = await fetch(`/api/servicios/tipo-vehiculo/${tipoVehiculoId}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Error al cargar los servicios');
                }

                serviciosData = result.data || [];
                const select = document.getElementById('selectServicio');
                select.innerHTML = '<option value="">Selecciona un servicio...</option>';

                serviciosData.forEach(servicio => {
                    select.innerHTML += `
                    <option value="${servicio.id_servicio}" data-precio="${servicio.costo_servicio}">
                        ${servicio.nombre_servicio} - $ ${Number(servicio.costo_servicio).toLocaleString()}
                    </option>
                `;
                });

                // Actualizar precio si hay servicios
                if (serviciosData.length > 0) {
                    actualizarPrecio();
                } else {
                    document.getElementById('precioMostrado').textContent = '$ 0';
                }

            } catch (error) {
                console.error('Error:', error);
                document.getElementById('selectServicio').innerHTML = `
                <option value="">Error al cargar servicios</option>
            `;
            }
        }

        // ========== ACTUALIZAR PRECIO ==========
        function actualizarPrecio() {
            const select = document.getElementById('selectServicio');
            const selectedOption = select.options[select.selectedIndex];
            const precio = selectedOption ? selectedOption.getAttribute('data-precio') : null;

            if (precio) {
                document.getElementById('precioMostrado').textContent = '$ ' + Number(precio).toLocaleString();
            } else {
                document.getElementById('precioMostrado').textContent = '$ 0';
            }
        }

        let consultaDisponibilidad = 0;

        async function actualizarDisponibilidad() {
            const colaboradorId = document.getElementById('selectColaborador').value;
            const fecha = document.getElementById('fechaReserva').value;
            const hora = document.getElementById('horaReserva').value;
            const estado = document.getElementById('disponibilidadReserva');
            const boton = document.getElementById('btnCrearReserva');
            const consultaActual = ++consultaDisponibilidad;

            boton.disabled = true;

            if (!colaboradorId || !fecha || !hora) {
                estado.style.display = 'none';
                return false;
            }

            estado.className = 'alert alert-info py-2 px-3 mb-4';
            estado.textContent = 'Consultando disponibilidad...';
            estado.style.display = 'block';

            try {
                const parametros = new URLSearchParams({
                    no_documento_colaborador: colaboradorId,
                    fecha,
                    hora
                });
                const response = await fetch(`/api/reservas/disponibilidad?${parametros}`, {
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const result = await response.json();

                if (consultaActual !== consultaDisponibilidad) {
                    return false;
                }

                if (!response.ok) {
                    throw new Error(result.message || 'No se pudo consultar la disponibilidad');
                }

                const disponible = result.disponible === true;
                estado.className = disponible ?
                    'alert alert-success py-2 px-3 mb-4' :
                    'alert alert-danger py-2 px-3 mb-4';
                estado.textContent = disponible ?
                    'Disponible: el colaborador puede atender esta reserva.' :
                    'No disponible: cambia de colaborador, hora o día.';
                boton.disabled = !disponible;
                return disponible;
            } catch (error) {
                if (consultaActual !== consultaDisponibilidad) {
                    return false;
                }

                estado.className = 'alert alert-danger py-2 px-3 mb-4';
                estado.textContent = error.message;
                boton.disabled = true;
                return false;
            }
        }

        // ========== CREAR RESERVA ==========
        async function crearReserva() {
            const clienteId = document.getElementById('clienteId').value;
            const colaboradorId = document.getElementById('selectColaborador').value;
            const placaVehiculo = document.getElementById('vehiculoClienteSelect').value;
            const tipoVehiculoId = document.getElementById('selectTipoVehiculo').value;
            const servicioId = document.getElementById('selectServicio').value;
            const fecha = document.getElementById('fechaReserva').value;
            const hora = document.getElementById('horaReserva').value;

            // Validaciones
            if (!clienteId) {
                alert('Primero busca un cliente');
                return;
            }

            if (!colaboradorId) {
                alert('Selecciona un colaborador');
                return;
            }

            if (!placaVehiculo) {
                alert('Selecciona un vehículo del cliente');
                return;
            }

            if (!tipoVehiculoId) {
                alert('Selecciona un tipo de vehículo');
                return;
            }

            if (!servicioId) {
                alert('Selecciona un servicio');
                return;
            }

            if (!fecha) {
                alert('Selecciona una fecha para la reserva');
                return;
            }

            if (!hora) {
                alert('Selecciona una hora para la reserva');
                return;
            }

            if (!(await actualizarDisponibilidad())) {
                alert('El colaborador no está disponible. Cambia de colaborador, hora o día.');
                return;
            }

            // Obtener el precio del servicio seleccionado
            const selectServicio = document.getElementById('selectServicio');
            const selectedOption = selectServicio.options[selectServicio.selectedIndex];
            const precio = selectedOption ? selectedOption.getAttribute('data-precio') : 0;

            const payload = {
                no_documento_cliente: parseInt(clienteId),
                no_documento_colaborador: parseInt(colaboradorId),
                placa_vehiculo: placaVehiculo,
                id_tipo_vehiculo: parseInt(tipoVehiculoId),
                id_servicio: parseInt(servicioId),
                fecha: fecha,
                hora: hora,
                fotos_vehiculo: '',
                id_plan: null,
                etapa_lavado: 'Pendiente'
            };

            try {
                const response = await fetch('/api/reservas', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'No se pudo crear la reserva');
                }

                alert('Reserva creada correctamente');
                limpiarBusqueda();
                cargarReservasHoy();

            } catch (error) {
                console.error('Error:', error);
                alert('Error: ' + error.message);
            }
        }

        // ========== CARGAR RESERVAS HOY ==========

        async function cargarReservasHoy() {
            try {
                const actualDay = new Date();
                const fecha = actualDay.toISOString().split('T')[0];
                const response = await fetch(`/api/reservas/fecha/${fecha}`, {
                    method: 'GET',
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Error al cargar reservas');
                }

                const reservas = result.data || [];
                const reservasFinalizadas = reservas.filter(reserva => reserva.etapa_lavado === 'Finalizada');
                const reservasPendientes = reservas.filter(reserva => reserva.etapa_lavado !== 'Finalizada');
                const container = document.getElementById('listaReservas');
                const completadosContainer = document.getElementById('listaLavadosCompletados');

                if (reservasPendientes.length === 0) {
                    container.innerHTML = `
                        <div class="empty-state">
                            <i class="bi bi-calendar-x"></i>
                            <p>No hay reservas pendientes</p>
                        </div>
                    `;
                } else {
                    let html = '';
                    reservasPendientes.forEach(reserva => {
                        const usuario = reserva.cliente?.usuario || {};
                        const nombreCliente = `${usuario.nombre_usuario || ''} ${usuario.apellido_usuario || ''}`.trim() || 'Sin nombre';
                        const placa = reserva.vehiculo?.placa_vehiculo || 'N/A';
                        const servicio = reserva.servicio?.nombre_servicio || 'Sin servicio';
                        const precio = reserva.servicio?.costo_servicio || 0;
                        const etapa = reserva.etapa_lavado || 'Pendiente';

                        // ✅ Renderizar botón según la etapa actual
                        const botonHtml = generarBotonEtapa(reserva.id_reserva, etapa);

                        html += `
                <div class="reserva-item">
                    <div class="reserva-estado">${etapa}</div>
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="placa">${placa}</div>
                            <div class="cliente-nombre">${nombreCliente}</div>
                            <div class="servicio-info">${servicio} - $ ${Number(precio).toLocaleString()}</div>
                            <div class="tiempo">${reserva.created_at ? 'Hace ' + new Date(reserva.created_at).toLocaleTimeString() : ''}</div>
                        </div>
                        <div class="reserva-acciones">${botonHtml}</div>
                    </div>
                </div>
            `;
                    });

                    container.innerHTML = html;
                }

                if (reservasFinalizadas.length === 0) {
                    completadosContainer.innerHTML = `
                        <div class="empty-state">
                            <i class="bi bi-check-circle"></i>
                            <p>No hay lavados completados</p>
                        </div>
                    `;
                } else {
                    completadosContainer.innerHTML = reservasFinalizadas.map(reserva => {
                        const usuario = reserva.cliente?.usuario || {};
                        const nombreCliente = `${usuario.nombre_usuario || ''} ${usuario.apellido_usuario || ''}`.trim() || 'Sin nombre';
                        const placa = reserva.vehiculo?.placa_vehiculo || 'N/A';
                        const servicio = reserva.servicio?.nombre_servicio || 'Sin servicio';
                        const precio = Number(reserva.servicio?.costo_servicio || 0).toLocaleString();

                        return `
                            <div class="lavado-completado">
                                <div class="d-flex justify-content-between align-items-start gap-2">
                                    <div>
                                        <div class="placa">${placa}</div>
                                        <div class="cliente">${nombreCliente}</div>
                                        <div class="servicio">${servicio} - $ ${precio}</div>
                                        <div class="tiempo">${reserva.fecha || ''} ${reserva.hora || ''}</div>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge-completado d-block mb-2">Finalizado</span>
                                        ${!esColaboradorAutenticado ? `<button type="button" class="btn btn-sm btn-outline-success" onclick="abrirRecibo(${reserva.id_reserva})">
                                            <i class="bi bi-receipt me-1"></i>Ver recibo
                                        </button>` : ''}
                                    </div>
                                </div>
                            </div>
                        `;
                    }).join('');
                }

                const reservasPendientesEl = document.getElementById('reservasPendientes');
                if (reservasPendientesEl) reservasPendientesEl.textContent = reservasPendientes.length;

            } catch (error) {
                console.error('Error:', error);
            }
        }

        // ✅ NUEVA FUNCIÓN: Genera el botón correcto según la etapa
        function generarBotonEtapa(idReserva, etapa) {
            let botonAccion = '';

            if (esColaboradorAutenticado) {
                if (etapa === 'Activa') {
                    return `<button class="btn-iniciar-lavado" onclick="cambiarEtapaReserva(${idReserva}, 'iniciar')">
                        <i class="bi bi-droplet-fill me-1"></i>Iniciar
                    </button>`;
                }

                if (etapa === 'En Proceso') {
                    return `<button class="btn-finalizar" onclick="cambiarEtapaReserva(${idReserva}, 'finalizar')">
                        <i class="bi bi-check-circle-fill me-1"></i>Finalizar
                    </button>`;
                }

                return '';
            }

            if (esClienteAutenticado) {
                if (etapa === 'Pendiente') {
                    botonAccion = `<button class="btn btn-sm btn-outline-primary me-1" onclick="abrirEdicionReserva(${idReserva})">
                        <i class="bi bi-pencil me-1"></i>Editar
                    </button><button class="btn-activar" onclick="cambiarEtapaReserva(${idReserva}, 'activar')">
                        <i class="bi bi-play-fill me-1"></i>Activar
                    </button>`;
                }

                if (['Pendiente', 'Activa'].includes(etapa)) {
                    return `${botonAccion}<button class="btn-cancelar-reserva" onclick="cambiarEtapaReserva(${idReserva}, 'cancelar')">
                        <i class="bi bi-x-circle me-1"></i>Cancelar
                    </button>`;
                }

                if (etapa === 'Finalizada') {
                    return `<button class="btn btn-sm btn-outline-success" onclick="abrirRecibo(${idReserva})"><i class="bi bi-receipt me-1"></i>Recibo</button>`;
                }

                return '';
            }

            if (esAdministradorAutenticado && etapa === 'Pendiente') {
                botonAccion += `<button class="btn btn-sm btn-outline-primary me-1" onclick="abrirEdicionReserva(${idReserva})">
                    <i class="bi bi-pencil me-1"></i>Editar
                </button>`;
            }

            switch (etapa) {
                case 'Pendiente':
                    botonAccion += `<button class="btn-activar" onclick="cambiarEtapaReserva(${idReserva}, 'activar')">
                        <i class="bi bi-play-fill me-1"></i>Activar
                    </button>`;
                    break;

                case 'Activa':
                    botonAccion = `<button class="btn-iniciar-lavado" onclick="cambiarEtapaReserva(${idReserva}, 'iniciar')">
                        <i class="bi bi-droplet-fill me-1"></i>Iniciar
                    </button>`;
                    break;

                case 'En Proceso':
                    botonAccion = `<button class="btn-finalizar" onclick="cambiarEtapaReserva(${idReserva}, 'finalizar')">
                        <i class="bi bi-check-circle-fill me-1"></i>Finalizar
                    </button>`;
                    break;

                case 'Finalizada':
                    return esAdministradorAutenticado ?
                        `<button class="btn btn-sm btn-outline-success" onclick="abrirRecibo(${idReserva})"><i class="bi bi-receipt me-1"></i>Recibo</button>` :
                        '';

                case 'Cancelada':
                    return '';

                default:
                    return '';
            }

            return `${botonAccion}<button class="btn-cancelar-reserva" onclick="cambiarEtapaReserva(${idReserva}, 'cancelar')">
                <i class="bi bi-x-circle me-1"></i>Cancelar
            </button>`;
        }


        async function cambiarEtapaReserva(idReserva, accion) {
            const acciones = {
                'activar': {
                    url: `/api/reservas/${idReserva}/activar`,
                    nombre: 'activar'
                },
                'iniciar': {
                    url: `/api/reservas/${idReserva}/iniciar`,
                    nombre: 'iniciar el lavado'
                },
                'finalizar': {
                    url: `/api/reservas/${idReserva}/finalizar`,
                    nombre: 'finalizar el lavado'
                },
                'cancelar': {
                    url: `/api/reservas/${idReserva}/cancelar`,
                    nombre: 'cancelar la reserva'
                }
            };

            const accionInfo = acciones[accion];
            if (!accionInfo) {
                alert('Acción no válida');
                return;
            }

            if (accion === 'finalizar') {
                abrirModalPago(idReserva);
                return;
            }

            if (!confirm(`¿Estás seguro de ${accionInfo.nombre}?`)) return;

            try {
                const response = await fetch(accionInfo.url, {
                    method: 'PUT',
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.error || result.message || 'Error al realizar la acción');
                }

                alert(`${result.message}`);
                cargarReservasHoy();

            } catch (error) {
                console.error('Error:', error);
                alert(error.message);
            }
        }

        async function cargarMetodosPago() {
            const contenedor = document.getElementById('metodosPago');

            if (!contenedor || contenedor.dataset.cargado === 'true') return;

            try {
                const response = await fetch('/api/metodos-pago', {
                    method: 'GET',
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'No se pudieron cargar los métodos de pago');
                }

                const metodos = (result.data || []).filter(metodo =>
                    metodo.estado_metodo_pago === undefined || Boolean(Number(metodo.estado_metodo_pago))
                );
                contenedor.replaceChildren();

                metodos.forEach(metodo => {
                    const label = document.createElement('label');
                    label.className = 'payment-option d-flex align-items-center gap-2';
                    label.innerHTML = `
                        <input class="form-check-input mt-0" type="radio" name="metodoPago" value="${metodo.id_metodo_pago}">
                        <span><i class="bi bi-credit-card me-2"></i>${metodo.nombre_metodo_pago}</span>
                    `;
                    contenedor.appendChild(label);
                });

                if (metodos.length === 0) {
                    contenedor.innerHTML = '<div class="text-muted small">No hay métodos de pago disponibles</div>';
                } else {
                    contenedor.dataset.cargado = 'true';
                    contenedor.querySelector('input[name="metodoPago"]').checked = true;
                }
            } catch (error) {
                contenedor.innerHTML = '<div class="text-danger small">Error al cargar métodos de pago</div>';
                throw error;
            }
        }

        async function abrirModalPago(idReserva) {
            try {
                await cargarMetodosPago();
                const response = await fetch(`/api/reservas/${idReserva}`, {
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'No se pudo cargar la reserva');
                }

                reservaPendienteDePago = result.data;
                const precio = Number(reservaPendienteDePago.servicio?.costo_servicio || 0);
                document.getElementById('pagoTotal').textContent = `$ ${precio.toLocaleString()}`;
                bootstrap.Modal.getOrCreateInstance(document.getElementById('modalPagoReserva')).show();
            } catch (error) {
                console.error('Error:', error);
                alert(error.message);
            }
        }

        async function confirmarPago() {
            if (!reservaPendienteDePago) return;

            const metodoSeleccionado = document.querySelector('input[name="metodoPago"]:checked');
            const idMetodoPago = Number(metodoSeleccionado?.value || 0);
            const metodoPago = metodoSeleccionado?.closest('label')?.querySelector('span')?.textContent?.trim() || '';

            if (!idMetodoPago) {
                alert('Selecciona un método de pago');
                return;
            }

            const boton = document.getElementById('btnConfirmarPago');
            boton.disabled = true;

            try {
                const response = await fetch(`/api/reservas/${reservaPendienteDePago.id_reserva}/finalizar`, {
                    method: 'PUT',
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });
                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.error || result.message || 'No se pudo finalizar la reserva');
                }

                const comprobanteResponse = await fetch('/api/comprobantes-pago', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        id_reserva: reservaPendienteDePago.id_reserva,
                        id_metodo_pago: idMetodoPago
                    })
                });
                const comprobanteResult = await comprobanteResponse.json();

                if (!comprobanteResponse.ok) {
                    throw new Error(comprobanteResult.error || comprobanteResult.message ||
                        'La reserva finalizó, pero no se pudo registrar el comprobante');
                }

                const reservaFinalizada = {
                    ...reservaPendienteDePago,
                    ...(result.data || {}),
                    comprobante_pago: comprobanteResult.data
                };
                bootstrap.Modal.getInstance(document.getElementById('modalPagoReserva'))?.hide();
                mostrarRecibo(reservaFinalizada, metodoPago);
                cargarReservasHoy();
            } catch (error) {
                console.error('Error:', error);
                alert(error.message);
            } finally {
                boton.disabled = false;
            }
        }

        function mostrarRecibo(reserva, metodoPago) {
            reciboActual = reserva;
            const usuario = reserva.cliente?.usuario || {};
            const nombreCliente = `${usuario.nombre_usuario || ''} ${usuario.apellido_usuario || ''}`.trim() || 'Sin nombre';
            const precio = Number(reserva.servicio?.costo_servicio || 0);
            const fechaServicio = `${reserva.fecha || 'Sin fecha'} ${reserva.hora || ''}`.trim();

            document.getElementById('reciboId').textContent = `#${reserva.id_reserva}`;
            document.getElementById('reciboCliente').textContent = nombreCliente;
            document.getElementById('reciboVehiculo').textContent = reserva.vehiculo?.placa_vehiculo || 'N/A';
            document.getElementById('reciboServicio').textContent = reserva.servicio?.nombre_servicio || 'Sin servicio';
            document.getElementById('reciboFechaServicio').textContent = fechaServicio;
            document.getElementById('reciboMetodoPago').textContent = metodoPago;
            document.getElementById('reciboTotal').textContent = `$ ${precio.toLocaleString()}`;
            document.getElementById('reciboFechaEmision').textContent = `Emitido el ${new Date().toLocaleString()}`;

            bootstrap.Modal.getOrCreateInstance(document.getElementById('modalReciboReserva')).show();
        }

        async function abrirRecibo(idReserva) {
            try {
                const response = await fetch(`/api/comprobantes-pago/reserva/${idReserva}`, {
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'No se pudo consultar el recibo');
                }

                const comprobante = result.data;
                const reserva = comprobante.reserva || {};
                reserva.comprobante_pago = comprobante;
                mostrarRecibo(reserva, comprobante.metodo_pago?.nombre_metodo_pago || 'No especificado');
            } catch (error) {
                console.error('Error:', error);
                alert(error.message);
            }
        }

        function descargarRecibo() {
            if (!reciboActual) return;

            const contenido = document.querySelector('#modalReciboReserva .receipt')?.innerHTML || '';
            const ventana = window.open('', '_blank');
            ventana.document.write(`<!doctype html><html lang="es"><head><meta charset="utf-8"><title>Recibo #${reciboActual.id_reserva}</title>
                <style>body{font-family:Arial,sans-serif;padding:32px;color:#222}h1{font-size:20px}.receipt-row{display:flex;justify-content:space-between;border-bottom:1px solid #ddd;padding:10px 0}.receipt-label{font-weight:600}</style>
                </head><body><h1>Recibo de servicio</h1>${contenido}</body></html>`);
            ventana.document.close();
            ventana.focus();
            ventana.print();
        }

        // ========== INICIALIZAR ==========
        document.addEventListener('DOMContentLoaded', function() {
            if (!esColaboradorAutenticado) {
                cargarColaboradores();
                cargarTiposVehiculo();
            }
            cargarReservasHoy();

            if (esClienteAutenticado) {
                if (clienteAutenticado) {
                    mostrarClienteEncontrado(clienteAutenticado);
                } else {
                    document.getElementById('formularioReserva').style.display = 'block';
                    document.getElementById('resultadoBusqueda').innerHTML =
                        '<div class="alert alert-danger">No hay un cliente asociado a este usuario.</div>';
                }
            }

            document.getElementById('selectColaborador')?.addEventListener('change', actualizarDisponibilidad);
            document.getElementById('fechaReserva')?.addEventListener('change', actualizarDisponibilidad);
            document.getElementById('horaReserva')?.addEventListener('change', actualizarDisponibilidad);

            // Permitir buscar con Enter
            document.getElementById('numDocBusqueda')?.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    buscarCliente();
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>