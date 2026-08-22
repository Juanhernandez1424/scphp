<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas - SmartClean</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row flex-nowrap">

            <x-sidebar />

            <main class="col py-3">
                <h1 class="h3 mb-3">Reservas</h1>
                <p class="text-muted">bienvenido al modulo de reservas</p>

                <!-- CARD 1: BUSCADOR Y RESULTADO DEL CLIENTE -->
                <div class="card border border-light-subtle shadow-sm rounded-4 p-4 mb-4">
                    <!-- Encabezado -->
                    <h5 class="fw-bold text-dark d-flex align-items-center gap-2 mb-1">
                        <i class="bi bi-search"></i> Buscar Cliente
                    </h5>
                    <p class="text-secondary small mb-3">Ingresa el tipo y número de documento del cliente</p>

                    <!-- Formulario HTML Puro -->
                    <form action="{{ route('reservas.create') }}" method="GET" class="d-flex gap-2 mb-3">
                        <select name="tipo_doc" class="form-select w-auto rounded-3">
                            <option value="CC" {{ request('tipo_doc') == 'CC' ? 'selected' : '' }}>CC</option>
                            <option value="CE" {{ request('tipo_doc') == 'CE' ? 'selected' : '' }}>CE</option>
                            <option value="NIT" {{ request('tipo_doc') == 'NIT' ? 'selected' : '' }}>NIT</option>
                        </select>

                        <input type="text" name="num_doc" class="form-control rounded-3"
                            placeholder="1098765432" value="{{ request('num_doc') }}" required>

                        <button type="submit" class="btn btn-dark rounded-3 px-4 fw-bold">
                            Buscar
                        </button>
                    </form>

                    <!-- Mensaje si no se encuentra el cliente -->
                    @if(session('error'))
                    <div class="alert alert-danger py-2 px-3 mb-0 small rounded-3">
                        {{ session('error') }}
                    </div>
                    @endif

                    <!-- Resultado si el cliente existe -->
                    @if(isset($cliente))
                    <div class="rounded-3 p-3 border" style="background-color: #f3fbf9; border-color: #9ee5d3 !important;">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold d-flex align-items-center gap-2">
                                <i class="bi bi-person text-success"></i>
                                <span class="text-dark fw-bold">Cliente encontrado</span>
                            </span>

                            <!-- El botón Cambiar recarga la vista limpia -->
                            <a href="{{ route('reservas.create') }}" class="btn btn-white btn-sm border bg-white rounded-3 px-3 shadow-sm text-dark text-decoration-none">
                                Cambiar
                            </a>
                        </div>

                        <div class="fw-bold text-dark fs-6">{{ $cliente->nombre }}</div>
                        <div class="text-muted small">
                            {{ $cliente->tipo_documento }}: {{ $cliente->documento }} | Tel: {{ $cliente->telefono }} | Placa: {{ $cliente->placa ?? 'N/A' }}
                        </div>
                    </div>
                    @endif
                </div>

                <!-- CARD 2: FORMULARIO DE RESERVA (Solo se despliega si existe $cliente) -->
                @if(isset($cliente))
                <div class="card border border-light-subtle shadow-sm rounded-4 p-4">
                    
                    <!-- Pestañas Tipo de Servicio (Lavado Directo / Crear Reserva) -->
                    <div class="d-flex gap-2 mb-4">
                        <h1>aqui puedes crear una reserva</h1>
                    </div>

                    <!-- Formulario de creación de Reserva -->
                    <form action="#" method="POST">
                        @csrf
                        <!-- ID del cliente para vincularlo en la BD -->
                        <input type="hidden" name="cliente_id" value="{{ $cliente->id ?? '' }}">

                        <!-- Seleccionar Colaborador -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Colaborador</label>
                            <select name="colaborador_id" class="form-select rounded-3">
                                <option value="1">Carlos Ramírez (Disponible)</option>
                                <option value="2">Ana Gómez (Disponible)</option>
                            </select>
                        </div>

                        <!-- Tipo de Vehículo -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Tipo de Vehículo</label>
                            <select name="tipo_vehiculo" class="form-select rounded-3">
                                <option value="Automovil">Automóvil</option>
                                <option value="Camioneta">Camioneta</option>
                                <option value="Motocicleta">Motocicleta</option>
                            </select>
                        </div>

                        <!-- Servicio -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Servicio</label>
                            <select name="servicio_id" class="form-select rounded-3">
                                <option value="1">Lavado Sencillo - $ 25.000</option>
                                <option value="2">Lavado General - $ 45.000</option>
                                <option value="3">Polichado - $ 80.000</option>
                            </select>
                        </div>

                        

                        <!-- Horario de Reserva -->
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-dark">Horario</label>
                            <select name="horario" class="form-select rounded-3 w-auto">
                                <option value="11:00">11:00 AM</option>
                                <option value="11:30">11:30 AM</option>
                                <option value="12:00">12:00 PM</option>
                            </select>
                        </div>

                        <!-- Botón de Confirmación -->
                        <button type="submit" class="btn btn-dark w-100 rounded-3 py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-calendar-plus"></i> Crear Reserva
                        </button>
                    </form>
                </div>
                @endif

            </main>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>