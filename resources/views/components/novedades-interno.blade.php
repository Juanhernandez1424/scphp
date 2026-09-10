<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Novedades</title>
    <style>
        body {
            /* margin: 0;
            padding: 50px; /
            font-family: sans-serif;
            background-color: #ffffff; */
        }

        .titulo-principal {
            margin: 0 0 30px 0;
            font-family: 'PT Serif Bold', serif;
            font-size: 2.5rem;
            color: #333333;
        }

        .grupo-botones {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 40px;
        }

        .btn-interna,
        .btn-cliente {
            background-color: #e2e8f0;
            color: #4a5568;
            padding: 12px 30px;
            font-size: 1.1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-family: 'PT Serif Bold', serif;
        }

        .btn-interna {
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
            font-family: 'PT Serif Bold', serif;
            color: #333333;
            font-size: 1.8rem;
            margin: 0;
        }

        .btn-agregar-novedad {
            background-color: #2B78E4;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
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

        .mb-3-modal {
            margin-bottom: 1rem;
        }

        .modal-body h2 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 8px;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <x-sidebar />

            <main class="col py-3">

                <h1 class="titulo-principal">Novedades</h1>

                <div class="grupo-botones">
                    <a href="{{ url('/novedades-interno') }}" class="btn-interna">Interna</a>
                    <a href="{{ url('/novedades-cliente') }}" class="btn-cliente">Cliente</a>
                </div>

                <div class="contenedor-novedades">
                    <h2 class="subtitulo_seccion">Novedad Interna</h2>
                    <button type="button" class="btn-agregar-novedad" data-bs-toggle="modal" data-bs-target="#modalNovedad">Agregar Novedad</button>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ticket</th>
                            <th scope="col">Numero de Documento</th>
                            <th scope="col">Fecha Reporte</th>
                            <th scope="col">Etapa Novedad</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

                <div class="modal fade" id="modalNovedad" tabindex="-1" aria-labelledby="modalNovedadLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalNovedadLabel" style="font-family: 'PT Serif Bold', serif; font-size: 1.5rem;">Crear Novedades</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3-modal">
                                        <h2>Tipo de Novedad</h2>
                                        <select class="form-select" id="selectTipoNovedadInterna">
                                            <option value="espacio_trabajo">Espacio de Trabajo</option>
                                            <option value="herramientas_insumo">Herramientas de Insumo</option>
                                            <option value="gestion_operaciones">Gestión de Operaciones</option>
                                        </select>
                                    </div>

                                    <div class="mb-3-modal mt-3">
                                        <h2>Ticket de Novedad</h2>
                                        <input type="text" class="form-control" id="inputTicketInterno" disabled placeholder="Se genera automáticamente al guardar">
                                    </div>
                                    <div class="mb-3-modal mt-3">
                                        <h2>Colaborador</h2>
                                        <select class="form-select" id="selectColaboradorInterno">
                                            <option value="">Seleccione un colaborador</option>
                                        </select>
                                    </div>

                                    <div class="mb-3-modal mt-3">
                                        <h2>Descripcion</h2>
                                        <textarea class="form-control" id="inputDescripcionInterna" rows="3"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" id="btnGuardarNovedadInterna" class="btn btn-primary btn-sm" style="background-color: #2B78E4;">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let colaboradoresCache = [];

        async function cargarColaboradoresInterno() {
            try {
                const response = await fetch('/api/usuarios', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const result = await response.json();
                const usuarios = result.success ? result.data : result;

                const selectHTML = document.getElementById('selectColaboradorInterno');
                selectHTML.innerHTML = '<option value="">-- Seleccione el Colaborador --</option>';
                colaboradoresCache = [];

                usuarios.forEach(usuario => {
                    if (usuario.id_rol == 2 && usuario.colaborador) {
                        colaboradoresCache.push(usuario);
                        const opcion = document.createElement('option');
                        opcion.value = usuario.colaborador.no_documento_colaborador;
                        opcion.textContent = `Cédula: ${usuario.colaborador.no_documento_colaborador} - ${usuario.nombre_usuario} ${usuario.apellido_usuario}`;
                        selectHTML.appendChild(opcion);
                    }
                });
            } catch (error) {
                console.error("Error cargando los colaboradores:", error);
            }
        }

        async function guardarNovedadInterna() {
            const noDocumentoColaborador = document.getElementById('selectColaboradorInterno').value;

            if (!noDocumentoColaborador) {
                alert('Por favor selecciona un colaborador.');
                return;
            }

            const payload = {
                tipo_novedad: document.getElementById('selectTipoNovedadInterna').value,
                descripcion_novedad: document.getElementById('inputDescripcionInterna').value,
                no_documento_colaborador: parseInt(noDocumentoColaborador),
                etapo_novedad: "Pendiente",
                estado_novedad: 1
                no_documento_colaborador: parseInt(noDocumentoColaborador)
                // no se envía no_documento_cliente ni id_reserva: quedan null (novedad interna)
            };

            try {
                const response = await fetch('/api/novedades', {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
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

                document.getElementById('inputDescripcionInterna').value = '';
                document.getElementById('selectColaboradorInterno').value = '';

                cargarNovedadesInternas();

            } catch (error) {
                console.error("Error guardando la novedad:", error);
                alert('Ocurrió un error de conexión al guardar.');
            }
        }

        async function cargarNovedadesInternas() {
            try {
                const response = await fetch('/api/novedades', {
                    method: 'GET',
                    headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' }
                });
                const resultado = await response.json();
                const novedades = resultado.success ? resultado.data : resultado;

                // Solo mostramos las novedades INTERNAS (ticket empieza con 'I')
                const internas = novedades.filter(n => n.ticket_novedad && n.ticket_novedad.startsWith('I'));

                const tbody = document.querySelector('table.table tbody');
                tbody.innerHTML = '';

                internas.forEach((novedad, index) => {
                    const fecha = novedad.created_at
                        ? new Date(novedad.created_at).toLocaleDateString('es-CO')
                        : '-';

                    const fila = document.createElement('tr');
                    fila.innerHTML = `
                        <th scope="row">${index + 1}</th>
                        <td>${novedad.ticket_novedad}</td>
                        <td>${novedad.no_documento_colaborador ?? '-'}</td>
                        <td>${fecha}</td>
                        <td>${novedad.etapo_novedad}</td>
                        <td><button class="btn btn-sm btn-outline-primary">Ver</button></td>
                    `;
                    tbody.appendChild(fila);
                });
            } catch (error) {
                console.error("Error cargando las novedades internas:", error);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            cargarColaboradoresInterno();
            cargarNovedadesInternas();
            document.getElementById('btnGuardarNovedadInterna').addEventListener('click', guardarNovedadInterna);
        });
    </script>
</body>

</html>