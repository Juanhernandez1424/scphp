<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas - SmartClean</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
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
            background: #212529;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 2rem;
            font-weight: 600;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .btn-search:hover {
            background: #000;
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
            background-color: #f3fbf9;
            border: 1px solid #9ee5d3;
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
            background: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.3rem 1rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .btn-activar:hover {
            background: #218838;
            color: white;
        }

        .lavado-completado {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border-left: 3px solid #28a745;
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
            background: #d4edda;
            color: #155724;
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
            background: #212529;
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
            background: #000;
            color: white;
        }

        .text-success-badge {
            color: #28a745;
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
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <x-sidebar />
            <main class="col py-3" style="background: #f8f9fa; min-height: 100vh;">
                <div class="container-fluid px-4">

                    <!-- ========== TÍTULO ========== -->
                    <div class="mb-3">
                        <h1 class="page-title mb-0">Lavados y Reservas</h1>
                        <p class="page-subtitle">Panel completo de lavados, reservas y pagos</p>
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

                            <!-- Formulario de Reserva -->
                            <div class="card-custom" id="formularioReserva" style="display: none;">
                                <div class="card-title">Crear Reserva</div>

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
                                            <input type="time" id="horaReserva" class="form-control form-select-custom"
                                                style="padding: 0.5rem 1rem;">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="label-form">Precio del servicio</label>
                                        <div class="precio-servicio" id="precioMostrado">$ 0</div>
                                    </div>

                                    <button type="button" class="btn-iniciar" onclick="crearReserva()">
                                        <i class="bi bi-calendar-plus me-2"></i> Crear Reserva
                                    </button>
                                </form>
                            </div>
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

    <script>
        // ========== VARIABLES GLOBALES ==========
        let clienteEncontrado = null;
        let colaboradoresData = [];
        let tiposVehiculoData = [];
        let serviciosData = [];
        let vehiculosCliente = [];

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
                                    data-tipo="${v.tipo_vehiculo}" 
                                    data-color="${v.color_vehiculo || ''}"
                                    data-marca="${v.marca_vehiculo || ''}"
                                    data-modelo="${v.modelo_vehiculo || ''}">
                                    ${v.placa_vehiculo} - ${v.tipo_vehiculo || 'Sin tipo'} ${v.marca_vehiculo ? '· ' + v.marca_vehiculo : ''}
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
                            <span class="text-dark fw-bold">Cliente encontrado</span>
                        </span>
                        <button class="btn-cambiar" onclick="limpiarBusqueda()">Cambiar</button>
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
                    document.getElementById('placaVehiculoSeleccionada').value = this.value;
                });
            }

            // Mostrar formulario de reserva
            document.getElementById('clienteId').value = cliente.no_documento_cliente;
            document.getElementById('formularioReserva').style.display = 'block';

            // Establecer fecha y hora por defecto
            const hoy = new Date();
            const fechaHoy = hoy.toISOString().split('T')[0];
            const horaActual = hoy.toTimeString().slice(0, 5);

            document.getElementById('fechaReserva').value = fechaHoy;
            document.getElementById('horaReserva').value = horaActual;

            document.getElementById('selectColaborador').focus();
        }

        // ========== LIMPIAR BÚSQUEDA ==========
        function limpiarBusqueda() {
            document.getElementById('numDocBusqueda').value = '';
            document.getElementById('resultadoBusqueda').innerHTML = '';
            document.getElementById('formularioReserva').style.display = 'none';
            clienteEncontrado = null;
            document.getElementById('clienteId').value = '';
            document.getElementById('selectColaborador').selectedIndex = 0;
            document.getElementById('selectTipoVehiculo').selectedIndex = 0;
            document.getElementById('selectServicio').innerHTML = '<option value="">Selecciona un servicio...</option>';
            document.getElementById('precioMostrado').textContent = '$ 0';
            document.getElementById('placaVehiculoSeleccionada').value = '';
            vehiculosCliente = [];
            document.getElementById('fechaReserva').value = '';
            document.getElementById('horaReserva').value = '';
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
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'No se pudo crear la reserva');
                }

                alert('Reserva creada correctamente');
                limpiarBusqueda();
                cargarReservas();

            } catch (error) {
                console.error('Error:', error);
                alert('Error: ' + error.message);
            }
        }

        // ========== LIMPIAR BÚSQUEDA ==========
        function limpiarBusqueda() {
            document.getElementById('numDocBusqueda').value = '';
            document.getElementById('resultadoBusqueda').innerHTML = '';
            document.getElementById('formularioReserva').style.display = 'none';
            clienteEncontrado = null;
            document.getElementById('clienteId').value = '';
            document.getElementById('selectColaborador').selectedIndex = 0;
            document.getElementById('selectTipoVehiculo').selectedIndex = 0;
            document.getElementById('selectServicio').innerHTML = '<option value="">Selecciona un servicio...</option>';
            document.getElementById('precioMostrado').textContent = '$ 0';
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
                    <option value="${servicio.id_servicio}" data-precio="${servicio.precio_servicio}">
                        ${servicio.nombre_servicio} - $ ${Number(servicio.precio_servicio).toLocaleString()}
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

            console.log('📤 Payload enviado:', JSON.stringify(payload, null, 2));

            try {
                const response = await fetch('/api/reservas', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'No se pudo crear la reserva');
                }

                alert('Reserva creada correctamente');
                limpiarBusqueda();
                cargarReservas();

            } catch (error) {
                console.error('Error:', error);
                alert('Error: ' + error.message);
            }
        }

        // ========== CARGAR RESERVAS ==========
        async function cargarReservas() {
            try {
                const response = await fetch('/api/reservas', {
                    method: 'GET',
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
                const container = document.getElementById('listaReservas');

                if (reservas.length === 0) {
                    container.innerHTML = `
                    <div class="empty-state">
                        <i class="bi bi-calendar-x"></i>
                        <p>No hay reservas pendientes</p>
                    </div>
                `;
                    document.getElementById('reservasPendientes').textContent = '0';
                    return;
                }

                let html = '';
                reservas.forEach(reserva => {
                    const usuario = reserva.cliente?.usuario || {};
                    const nombreCliente = `${usuario.nombre_usuario || ''} ${usuario.apellido_usuario || ''}`
                        .trim() || 'Sin nombre';
                    const placa = reserva.vehiculo?.placa_vehiculo || 'N/A';
                    const servicio = reserva.servicio?.nombre_servicio || 'Sin servicio';
                    const precio = reserva.servicio?.precio_servicio || 0;

                    html += `
                    <div class="reserva-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="placa">${placa}</div>
                                <div class="cliente-nombre">${nombreCliente}</div>
                                <div class="servicio-info">${servicio} - $ ${Number(precio).toLocaleString()}</div>
                                <div class="tiempo">${reserva.created_at ? 'Hace ' + new Date(reserva.created_at).toLocaleTimeString() : ''}</div>
                            </div>
                            <button class="btn-activar" onclick="activarReserva(${reserva.id_reserva})">Activar</button>
                        </div>
                    </div>
                `;
                });

                container.innerHTML = html;
                document.getElementById('reservasPendientes').textContent = reservas.length;

            } catch (error) {
                console.error('Error:', error);
            }
        }

        // ========== ACTIVAR RESERVA ==========
        async function activarReserva(idReserva) {
            if (!confirm('¿Activar esta reserva?')) return;

            try {
                const response = await fetch(`/api/reservas/${idReserva}/activar`, {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Error al activar reserva');
                }

                alert('Reserva activada correctamente');
                cargarReservas();

            } catch (error) {
                console.error('Error:', error);
                alert('Error: ' + error.message);
            }
        }

        // ========== INICIALIZAR ==========
        document.addEventListener('DOMContentLoaded', function() {
            cargarColaboradores();
            cargarTiposVehiculo();
            cargarReservas();

            // Permitir buscar con Enter
            document.getElementById('numDocBusqueda').addEventListener('keypress', function(e) {
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