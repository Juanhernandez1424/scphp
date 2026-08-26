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

        .btn-interna, .btn-cliente {
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

        .table th, .table td {
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

        .mb-3,
        .btn-form {
            display: none;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <x-sidebar/>

            <main class="col py-3">

    <h1 class="titulo-principal">Novedades</h1>

    <div class="grupo-botones">
        <button type="button" class="btn-interna">Interna</button>
        <button type="button" class="btn-cliente">Cliente</button>
    </div>

    <div class="contenedor-novedades">
        <h2 class="subtitulo_seccion">Novedad Interna</h2>
        <button type="button" class="btn-agregar-novedad">Agregar Novedad</button>
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
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
        </tbody>
    </table>

    <div class="mb-3">
        <h2> Crear Novedades</h2>
        <h2> Tipo de Novedad</h2>
        <select class="form-select">
            <option value="1">Espacio de Trabajo</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
    </div>

    <div class="mb-3">
        <h2>Ticket de Novedad</h2>
        <textarea class="form-control" rows="3"></textarea>
    </div>

    <div class="mb-3">
        <h2>Colaborador</h2>
        <select class="form-select">
            <option value="1">Tom Welling</option>
            <option value="1">chi</option>
            <option value="1">uwu</option>
        </select>
    </div>

    <div class="mb-3">
        <h2>Descripcion</h2>
        <textarea class="form-control" rows="3"></textarea>
    </div>

    <button type="button" class="btn btn-primary btn-sm btn-form">Guardar</button>
    <button type="button" class="btn btn-secondary btn-sm btn-form">Cerrar</button>

            </main>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
