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
                    <h2 class="subtitulo_seccion">Novedad Cliente</h2>
                    <button type="button" class="btn-agregar-novedad" data-bs-toggle="modal" data-bs-target="#modalNovedad">Agregar Novedad</button>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ticket</th>
                            <th scope="col">Numero de Documento</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Placa</th>
                            <th scope="col">Fecha Reporte</th>
                            <th scope="col">Etapa Novedad</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
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
                                    <div class="mb-3">
                                        <h2>Tipo de Novedad</h2>
                                        <select class="form-select">
                                            <option value="1">Espacio de Trabajo</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <h2>Cliente</h2>
                                        <select class="form-select" name="no_documento_cliente" id="selectClientes">
                                            <option value="">Cargando clientes de la base de datos...</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <h2>Ticket de Novedad</h2>
                                        <input class="form-control" rows="3"></input>
                                    </div>

                                    <div class="mb-3">
                                        <h2>Colaborador</h2>
                                        <select class="form-select" name="no_documento_colaborador" id="selectColaboradores">
                                            <option value="">Cargando colaboradores...</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <h2>Descripcion</h2>
                                        <textarea class="form-control" rows="3"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary btn-sm" style="background-color: #2B78E4; border: none;">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // este solo consulta datos, va por un solo archivo sin mandar todo el html por eso en formato json  y toca esperar antes de seguir al otro punto
        async function cargarClientes() {
            try {
                const response = await fetch('/api/reservas', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const resultado = await response.json();

                if (resultado.success) { //Aca revisa si respondio con exito
                    const clientes = resultado.data;
                    const selectHTML = document.getElementById('selectClientes'); // aca borra los clientes repetidos del html y los deja en blanco

                    selectHTML.innerHTML = '<option value="">-- Seleccione el Cliente --</option>';

                    clientes.forEach(cliente => { //aca es un ciclo donde revisa 1 por 1
                        const opcion = document.createElement('option');
                        // Asigna la cédula real de tu base de datos al value
                        opcion.textContent = `Cédula: ${cliente.cliente.no_documento_cliente}`;
                        selectHTML.appendChild(opcion);
                    });
                }
            } catch (error) {
                console.error("Error conectando con ClienteController:", error); //mensaje de error
            }
        }
        document.addEventListener('DOMContentLoaded', cargarClientes); //funciona
    </script>
    <script>
        async function cargarColaboradores() {
            try {
                const response = await fetch('/api/reservas', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const resultado = await response.json();

                console.log(resultado);

                if (resultado.success) {
                    const colaboradores = resultado.data;
                    const selectHTML = document.getElementById('selectColaboradores');

                    selectHTML.innerHTML = '<option value="">-- Seleccione el Colaborador --</option>';

                    colaboradores.forEach(colaborador => {
                        const opcion = document.createElement('option');

                        // 1. Primero calculamos la cédula con la red de seguridad de forma limpia
                        // const cedula = colaborador.no_documento_colaborador ||
                        //     (colaborador.usuario ? colaborador.usuario.no_documento_usuario : '') ||
                        //     colaborador.id_usuario;

                        // 2. Ahora que ya tenemos la cédula calculada, se la asignamos a la opción
                        opcion.textContent = `Cédula Colaborador: ${colaborador.colaborador.no_documento_colaborador}`;

                        // 3. Finalmente insertamos la opción en el menú desplegable
                        selectHTML.appendChild(opcion);
                    });

                }
            } catch (error) {
                console.error("Error conectando con ColaboradorController:", error);
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            cargarClientes();
            cargarColaboradores();
        });
    </script>
</body>

</html>