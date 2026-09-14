<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novedades</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@400&display=swap" rel="stylesheet">
    <style>
        .module-content {
            padding: 2rem 2.25rem !important;
        }

        .module-title {
            font-family: 'PT Serif', serif;
            font-size: 2rem;
            font-weight: 400;
            line-height: 1.2;
        }

        a {
            text-decoration: none !important;
        }

        @media (max-width: 768px) {
            .module-content {
                padding: 1.25rem 1rem !important;
            }
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .titulo-principal {
            margin: 0 0 1.5rem;
            font-family: 'PT Serif', serif;
            font-size: 2rem;
            font-weight: 400;
            color: #333333;
        }

        .grupo-botones {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .btn-interna,
        .btn-cliente {
            background-color: #e2e8f0;
            color: #4a5568;
            padding: 0.6rem 1.25rem;
            font-size: 0.9rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-family: Arial, sans-serif;
        }

        .btn-cliente {
            background-color: #2B78E4;
            color: white;
        }

        .contenedor-novedades {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            margin-bottom: 25px;
        }

        .subtitulo_seccion {
            font-family: 'PT Serif', serif;
            color: #333333;
            font-size: 1.25rem;
            font-weight: 400;
            margin: 0;
        }

        .btn-agregar-novedad {
            background-color: #2B78E4;
            color: white;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }

        .table th,
        .table td {
            border-bottom: 1px solid #e2e8f0;
            padding: 16px 12px;
            text-align: left;
            color: #333333;
        }

        .table th {
            font-weight: bold;
            color: #64748b;
            font-size: 0.95rem;
            border-top: 1px solid #e2e8f0;
        }

        .modal-body h2 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 8px;
            margin-top: 15px;
        }

        .modal-body h2:first-child {
            margin-top: 0;
        }

        .detalle-novedad p {
            margin-bottom: 4px;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <x-sidebar />

            <main class="col module-content">

                <h1 class="titulo-principal module-title">Novedades</h1>

                @if(auth()->user()->id_rol != 3)
                <div class="grupo-botones">
                    <a href="{{ url('/novedades-interno') }}" class="btn-interna">Interna</a>
                    <a href="{{ url('/novedades-cliente') }}" class="btn-cliente">Cliente</a>
                </div>
                @endif

                <div class="contenedor-novedades">
                    <h2 class="subtitulo_seccion">Novedad Cliente</h2>
                    <button type="button" class="btn-agregar-novedad" data-bs-toggle="modal" data-bs-target="#modalNovedad">Agregar Novedad</button>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ticket</th>
                            <th scope="col">Numero de Documento</th>
                            <th scope="col">Placa</th>
                            <th scope="col">Fecha Reporte</th>
                            <th scope="col">Etapa Novedad</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                <!-- Modal Crear Novedad -->
                <div class="modal fade" id="modalNovedad" tabindex="-1" aria-labelledby="modalNovedadLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalNovedadLabel">Crear Novedad</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <h2>Tipo de Novedad</h2>
                                        <select class="form-select" id="selectTipoNovedad">
                                            <option value="inconformidad">Inconformidad con el servicio</option>
                                            <option value="retraso">Retraso en la entrega</option>
                                            <option value="danos_vehiculo">Daños en el vehículo</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <h2>Reserva</h2>
                                        <select class="form-select" id="selectReserva">
                                            <option value="">Cargando reservas...</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <h2>Cliente</h2>
                                        <input type="text" class="form-control" id="inputCliente" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <h2>Colaborador</h2>
                                        <input type="text" class="form-control" id="inputColaborador" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <h2>Ticket de Novedad</h2>
                                        <input type="text" class="form-control" id="inputTicket" disabled placeholder="Se genera automáticamente al guardar">
                                    </div>

                                    <div class="mb-3">
                                        <h2>Descripcion</h2>
                                        <textarea class="form-control" id="inputDescripcion" rows="3"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" id="btnGuardarNovedad" class="btn btn-primary btn-sm" style="background-color: #2B78E4; border: none;">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Ver Detalle de Novedad -->
                <div class="modal fade" id="modalVerNovedad" tabindex="-1" aria-labelledby="modalVerNovedadLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalVerNovedadLabel">Detalle de Novedad</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body detalle-novedad">
                                <div id="verNovedadCargando" class="text-center py-3">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Cargando...</span>
                                    </div>
                                </div>
                                <div id="verNovedadContenido" style="display: none;">
                                    <h2>Ticket</h2>
                                    <p id="verTicket">-</p>

                                    <h2>Tipo de Novedad</h2>
                                    <p id="verTipo">-</p>

                                    <h2>Cliente</h2>
                                    <p id="verCliente">-</p>

                                    <h2>Colaborador</h2>
                                    <p id="verColaborador">-</p>

                                    <h2>Placa</h2>
                                    <p id="verPlaca">-</p>

                                    <h2>Fecha Reporte</h2>
                                    <p id="verFecha">-</p>

                                    <h2>Etapa</h2>
                                    <p id="verEtapa">-</p>

                                    <h2>Descripción</h2>
                                    <p id="verDescripcion">-</p>
                                </div>
                                <div id="verNovedadError" class="alert alert-danger" style="display: none;"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let reservasCache = [];
        const clienteAutenticadoId = @json(optional(auth()->user()->cliente)->no_documento_cliente);

        async function cargarReservas() {
            try {
                const response = await fetch('/api/reservas', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });
                const resultado = await response.json();
                const todasLasReservas = resultado.success ? resultado.data : resultado;

                const reservas = todasLasReservas.filter(r =>
                    r.etapa_lavado === 'Finalizada' &&
                    (!clienteAutenticadoId || r.no_documento_cliente == clienteAutenticadoId)
                );

                reservasCache = reservas;

                const selectHTML = document.getElementById('selectReserva');
                selectHTML.innerHTML = '<option value="">-- Seleccione la Reserva --</option>';

                reservas.forEach(reserva => {
                    const nombreCliente = reserva.cliente?.usuario ?
                        `${reserva.cliente.usuario.nombre_usuario} ${reserva.cliente.usuario.apellido_usuario}` :
                        'Cliente desconocido';

                    const opcion = document.createElement('option');
                    opcion.value = reserva.id_reserva;
                    opcion.textContent = `Reserva #${reserva.id_reserva} - ${nombreCliente} - Placa ${reserva.placa_vehiculo} - ${reserva.fecha}`;
                    selectHTML.appendChild(opcion);
                });

                if (reservas.length === 0) {
                    selectHTML.innerHTML = '<option value="">No hay reservas finalizadas disponibles</option>';
                }
            } catch (error) {
                console.error("Error cargando las reservas:", error);
            }
        }

        function autocompletarReserva() {
            const idReserva = document.getElementById('selectReserva').value;
            const reserva = reservasCache.find(r => r.id_reserva == idReserva);

            const inputCliente = document.getElementById('inputCliente');
            const inputColaborador = document.getElementById('inputColaborador');

            if (!reserva) {
                inputCliente.value = '';
                inputColaborador.value = '';
                return;
            }

            inputCliente.value = reserva.cliente?.usuario ?
                `${reserva.cliente.usuario.nombre_usuario} ${reserva.cliente.usuario.apellido_usuario} (CC ${reserva.no_documento_cliente})` :
                `Cédula ${reserva.no_documento_cliente}`;

            inputColaborador.value = reserva.colaborador?.usuario ?
                `${reserva.colaborador.usuario.nombre_usuario} ${reserva.colaborador.usuario.apellido_usuario} (CC ${reserva.no_documento_colaborador})` :
                `Cédula ${reserva.no_documento_colaborador}`;
        }

        async function guardarNovedad() {
            const idReserva = document.getElementById('selectReserva').value;
            const reserva = reservasCache.find(r => r.id_reserva == idReserva);

            if (!reserva) {
                alert('Por favor selecciona una reserva.');
                return;
            }

            const payload = {
                tipo_novedad: document.getElementById('selectTipoNovedad').value,
                descripcion_novedad: document.getElementById('inputDescripcion').value,
                no_documento_colaborador: reserva.no_documento_colaborador,
                no_documento_cliente: reserva.no_documento_cliente,
                id_reserva: reserva.id_reserva
            };

            try {
                const response = await fetch('/api/novedades', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const resultado = await response.json();

                if (!response.ok) {
                    console.error(resultado);
                    alert(resultado.message || 'Ocurrió un error al guardar la novedad.');
                    return;
                }

                const modalEl = document.getElementById('modalNovedad');
                bootstrap.Modal.getInstance(modalEl).hide();

                document.getElementById('inputDescripcion').value = '';
                document.getElementById('inputCliente').value = '';
                document.getElementById('inputColaborador').value = '';
                document.getElementById('selectReserva').value = '';

                cargarNovedades();

            } catch (error) {
                console.error("Error guardando la novedad:", error);
                alert('Ocurrió un error de conexión al guardar.');
            }
        }

        async function cargarNovedades() {
            try {
                const response = await fetch('/api/novedades', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });
                const resultado = await response.json();
                const novedades = resultado.success ? resultado.data : resultado;

                // Solo mostramos las novedades de CLIENTE (ticket empieza con 'C')
                const deCliente = novedades.filter(n =>
                    n.ticket_novedad &&
                    n.ticket_novedad.startsWith('C') &&
                    (!clienteAutenticadoId || n.no_documento_cliente == clienteAutenticadoId)
                );

                const tbody = document.querySelector('table.table tbody');
                tbody.innerHTML = '';

                deCliente.forEach((novedad, index) => {
                    const fecha = novedad.created_at ?
                        new Date(novedad.created_at).toLocaleDateString('es-CO') :
                        '-';
                    const placa = novedad.reserva?.placa_vehiculo ?? '-';

                    const fila = document.createElement('tr');
                    fila.innerHTML = `
                <th scope="row">${index + 1}</th>
                <td>${novedad.ticket_novedad}</td>
                <td>${novedad.no_documento_cliente ?? '-'}</td>
                <td>${placa}</td>
                <td>${fecha}</td>
                <td>${novedad.etapa_novedad}</td>
                <td><button class="btn btn-sm btn-outline-primary" onclick="verNovedad(${novedad.id_novedad})">Ver</button></td>
            `;
                    tbody.appendChild(fila);
                });
            } catch (error) {
                console.error("Error cargando las novedades:", error);
            }
        }

        // ========== VER DETALLE DE NOVEDAD ==========
        async function verNovedad(idNovedad) {
            const modalEl = document.getElementById('modalVerNovedad');
            const modal = new bootstrap.Modal(modalEl);

            const cargando = document.getElementById('verNovedadCargando');
            const contenido = document.getElementById('verNovedadContenido');
            const errorDiv = document.getElementById('verNovedadError');

            cargando.style.display = 'block';
            contenido.style.display = 'none';
            errorDiv.style.display = 'none';

            modal.show();

            try {
                const response = await fetch(`/api/novedades/${idNovedad}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const resultado = await response.json();

                if (!response.ok) {
                    throw new Error(resultado.message || 'No se pudo obtener la novedad');
                }

                const novedad = resultado.data;

                const nombreCliente = novedad.cliente?.usuario ?
                    `${novedad.cliente.usuario.nombre_usuario} ${novedad.cliente.usuario.apellido_usuario} (CC ${novedad.no_documento_cliente})` :
                    (novedad.no_documento_cliente ?? '-');

                const nombreColaborador = novedad.colaborador?.usuario ?
                    `${novedad.colaborador.usuario.nombre_usuario} ${novedad.colaborador.usuario.apellido_usuario} (CC ${novedad.no_documento_colaborador})` :
                    (novedad.no_documento_colaborador ?? '-');

                document.getElementById('verTicket').textContent = novedad.ticket_novedad ?? '-';
                document.getElementById('verTipo').textContent = novedad.tipo_novedad ?? '-';
                document.getElementById('verCliente').textContent = nombreCliente;
                document.getElementById('verColaborador').textContent = nombreColaborador;
                document.getElementById('verPlaca').textContent = novedad.reserva?.placa_vehiculo ?? '-';
                document.getElementById('verFecha').textContent = novedad.created_at ?
                    new Date(novedad.created_at).toLocaleDateString('es-CO') : '-';
                document.getElementById('verEtapa').textContent = novedad.etapa_novedad ?? '-';
                document.getElementById('verDescripcion').textContent = novedad.descripcion_novedad ?? 'Sin descripción';

                cargando.style.display = 'none';
                contenido.style.display = 'block';

            } catch (error) {
                console.error('Error cargando el detalle de la novedad:', error);
                cargando.style.display = 'none';
                errorDiv.textContent = 'Error al cargar el detalle: ' + error.message;
                errorDiv.style.display = 'block';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            cargarReservas();
            cargarNovedades();
            document.getElementById('selectReserva').addEventListener('change', autocompletarReserva);
            document.getElementById('btnGuardarNovedad').addEventListener('click', guardarNovedad);
        });
    </script>
</body>

</html>