<div>
    <!-- Encabezado con estadísticas -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Clientes</h6>
                    <h2 class="mb-0" id="totalClientes">1</h2>
                    <small class="text-muted">Clientes registrados</small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Registrados este Mes</h6>
                    <h2 class="mb-0">0</h2>
                    <small class="text-muted">Clientes nuevos</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de clientes -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-people me-2"></i>Clientes</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarClienteModal">
                <i class="bi bi-plus-circle me-1"></i>Agregar Cliente
            </button>
        </div>
        <div class="card-body">
            <p class="text-muted mb-3">Base de datos de clientes del lavadero</p>

            <!-- Buscador -->
            <div class="mb-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" placeholder="Buscar por nombre, documento, teléfono o placa..." id="buscadorClientes" oninput="filtrarClientes(this.value)">
                </div>
            </div>

            <!-- Contenedor de la lista de clientes -->
            <div id="contenedorClientes">
                <div class="text-center py-4" id="cargandoClientes">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <p class="mt-2 text-muted">Cargando clientes...</p>
                </div>
                <div id="listaClientes" class="list-group" style="display: none;">
                    <!-- Los clientes se renderizarán aquí dinámicamente -->
                </div>
                <div id="sinClientes" class="text-center py-4 text-muted" style="display: none;">
                    <i class="bi bi-people fs-1"></i>
                    <p class="mt-2">No hay clientes registrados</p>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarClienteModal">
                        <i class="bi bi-plus-circle me-1"></i>Agregar primer cliente
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Cliente (Paso 1) -->
<div class="modal fade" id="agregarClienteModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-person-plus me-2"></i>Agregar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formCliente">
                    <!-- Tipo de Documento -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Tipo de Documento</label>
                            <select class="form-select" id="tipoDocumento">
                                <option value="CC">Cédula de Ciudadanía</option>
                                <option value="CE">Cédula de Extranjería</option>
                                <option value="NIT">NIT</option>
                                <option value="PAS">Pasaporte</option>
                            </select>
                        </div>
                    </div>

                    <!-- Nombre y Apellidos -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nombre del Cliente</label>
                            <input type="text" class="form-control" id="nombreCliente" placeholder="Ej: Carlos">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Apellidos</label>
                            <input type="text" class="form-control" id="apellidosCliente" placeholder="Ej: Rodriguez">
                        </div>
                    </div>

                    <!-- Número de Documento y Teléfono -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Número de Documento</label>
                            <input type="text" class="form-control" id="numeroDocumento" placeholder="Ej: 1234567890">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Número celular</label>
                            <input type="tel" class="form-control" id="numeroCelular" placeholder="Ej: 3001234567">
                        </div>
                    </div>

                    <!-- Email (opcional) -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" id="emailCliente" placeholder="Ej: cliente@email.com">
                        </div>
                    </div>

                    <!-- Mensaje informativo -->
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Después de registrar el cliente, podrás agregar sus vehículos.
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarCliente()">
                    <i class="bi bi-check-circle me-1"></i>Registrar Cliente
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para registrar vehículos del cliente (Paso 2) -->
<div class="modal fade" id="agregarVehiculoClienteModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="bi bi-check-circle me-2"></i>¡Cliente Registrado!</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    El cliente se registró correctamente. Ahora puedes agregar sus vehículos.
                </div>

                <input type="hidden" id="noDocumentoClienteVehiculo">

                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="bi bi-car-front me-2"></i>Agregar vehículo</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Placa *</label>
                                <input type="text" class="form-control" id="placaVehiculoCliente" placeholder="ABC-123">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tipo</label>
                                <select class="form-select" id="tipoVehiculoCliente">
                                    <option value="Automóvil">Automóvil</option>
                                    <option value="Camioneta">Camioneta</option>
                                    <option value="Moto">Moto</option>
                                    <option value="Camión">Camión</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Marca</label>
                                <input type="text" class="form-control" id="marcaVehiculoCliente" placeholder="Toyota">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Modelo</label>
                                <input type="text" class="form-control" id="modeloVehiculoCliente" placeholder="2020">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Color</label>
                                <input type="text" class="form-control" id="colorVehiculoCliente" placeholder="Rojo">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="button" class="btn btn-primary w-100" onclick="guardarVehiculoCliente()">
                                    <i class="bi bi-check-circle me-1"></i>Guardar vehículo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lista de vehículos agregados -->
                <div class="mt-3">
                    <h6 class="fw-bold">Vehículos agregados</h6>
                    <div id="listaVehiculosCliente" class="list-group">
                        <div class="list-group-item text-muted text-center">
                            <i class="bi bi-car-front me-2"></i>No hay vehículos agregados aún
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" onclick="finalizarRegistro()">
                    <i class="bi bi-check-all me-1"></i>Finalizar Registro
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Script para manejar la lógica -->
<script>
    let clientesData = [];
    let clientesFiltrados = [];

    // ========== FUNCIONES DE CLIENTES ==========

    // Cargar clientes desde la API
    async function cargarClientes() {
        try {
            const response = await fetch('/api/clientes', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Error al cargar clientes');
            }

            // CORREGIDO: Usar result.data, no data directamente
            clientesData = result.data || [];
            clientesFiltrados = [...clientesData];

            renderizarClientes(clientesFiltrados);
            actualizarEstadisticas();

        } catch (error) {
            console.error('Error al cargar clientes:', error);
            document.getElementById('cargandoClientes').innerHTML = `
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Error al cargar clientes: ${error.message}
                </div>
            `;
        }
    }

    // Renderizar lista de clientes
    function renderizarClientes(clientes) {
        const listaContainer = document.getElementById('listaClientes');
        const cargando = document.getElementById('cargandoClientes');
        const sinClientes = document.getElementById('sinClientes');

        cargando.style.display = 'none';

        if (clientes.length === 0) {
            listaContainer.style.display = 'none';
            sinClientes.style.display = 'block';
            return;
        }

        listaContainer.style.display = 'block';
        sinClientes.style.display = 'none';

        let html = '';
        clientes.forEach(cliente => {
            const usuario = cliente.usuario || {};

            // CORREGIDO: Construir nombre completo correctamente
            const nombreCompleto = `${usuario.nombre_usuario || ''} ${usuario.apellido_usuario || ''}`.trim() || 'Sin nombre';
            const tipoDocumento = usuario.tipo_documento || 'Documento';
            const numeroDocumento = cliente.no_documento_cliente || 'N/A';
            const telefono = usuario.numero_celular || 'N/A';

            // Vehículos (si existen en la respuesta)
            const vehiculo = cliente.vehiculo || [];

            html += `
                <div class="list-group-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1"><strong>${nombreCompleto}</strong></h6>
                            <div class="small text-muted">
                                <div>${tipoDocumento}: ${numeroDocumento}</div>
                                <div>Tel: ${telefono}</div>
                                ${vehiculo.length > 0 ? `
                                    <div>Vehículos:</div>
                                    <ul class="mb-0 ps-3">
                                        ${vehiculo.map(v => `<li>${v.placa_vehiculo || 'Sin placa'} (${v.tipo_vehiculo || 'Sin tipo'})</li>`).join('')}
                                    </ul>
                                ` : `
                                    <div class="text-muted"><i class="bi bi-car-front me-1"></i>Sin vehículos registrados</div>
                                `}
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#" onclick="editarCliente('${numeroDocumento}')">
                                        <i class="bi bi-pencil me-2"></i>Editar
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#" onclick="eliminarCliente('${numeroDocumento}')">
                                        <i class="bi bi-trash me-2"></i>Eliminar
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            `;
        });

        listaContainer.innerHTML = html;
    }

    // Filtrar clientes por búsqueda
    function filtrarClientes(busqueda) {
        if (!busqueda || busqueda.trim() === '') {
            clientesFiltrados = [...clientesData];
        } else {
            const termino = busqueda.toLowerCase().trim();
            clientesFiltrados = clientesData.filter(cliente => {
                const usuario = cliente.usuario || {};
                const nombreCompleto = `${usuario.nombre_usuario || ''} ${usuario.apellido_usuario || ''}`.toLowerCase();
                const documento = String(cliente.no_documento_cliente || '');
                const telefono = String(usuario.numero_celular || '');
                const vehiculo = String((cliente.vehiculo && cliente.vehiculo.map(v => v.placa_vehiculo).join(' ')) || '').toLowerCase();

                return nombreCompleto.includes(termino) ||
                    documento.includes(termino) ||
                    telefono.includes(termino) ||
                    vehiculo.includes(termino);
            });
        }
        renderizarClientes(clientesFiltrados);
    }

    // Actualizar estadísticas
    function actualizarEstadisticas() {
        const total = clientesData.length;
        document.getElementById('totalClientes').textContent = total;
    }

    // Editar cliente (placeholder)
    function editarCliente(documento) {
        alert(`Editar cliente con documento: ${documento}`);
    }

    // Eliminar cliente
    async function eliminarCliente(documento) {
        if (!confirm(`¿Estás seguro de eliminar el cliente con documento ${documento}?`)) {
            return;
        }

        try {
            const response = await fetch(`/api/clientes/${documento}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Error al eliminar cliente');
            }

            alert('Cliente eliminado correctamente');
            cargarClientes();

        } catch (error) {
            console.error('Error:', error);
            alert('Error al eliminar: ' + error.message);
        }
    }


    // ========== FUNCIONES DE VEHÍCULOS ==========

    let vehiculosCliente = [];

    // Guardar cliente
    async function guardarCliente() {
        const nombre = document.getElementById('nombreCliente').value.trim();
        const apellidos = document.getElementById('apellidosCliente').value.trim();
        const tipoDoc = document.getElementById('tipoDocumento').value;
        const numDoc = document.getElementById('numeroDocumento').value.trim();
        const numCelular = document.getElementById('numeroCelular').value.trim();
        const email = document.getElementById('emailCliente').value.trim();

        if (!nombre || !apellidos || !numDoc || !numCelular) {
            alert('Por favor completa todos los campos obligatorios (*)');
            return;
        }

        // Limpiar y validar teléfono
        const telefonoLimpio = numCelular.replace(/[\s\-\(\)\.]/g, '');
        if (!/^\d+$/.test(telefonoLimpio)) {
            alert('El teléfono solo debe contener números');
            return;
        }
        if (telefonoLimpio.length > 15) {
            alert('El número de teléfono no puede tener más de 15 dígitos');
            return;
        }
        if (telefonoLimpio.length < 7) {
            alert('El número de teléfono debe tener al menos 7 dígitos');
            return;
        }

        // Limpiar y validar documento
        const documentoLimpio = numDoc.replace(/[\s\-\.]/g, '');
        if (!/^\d+$/.test(documentoLimpio)) {
            alert('El documento solo debe contener números');
            return;
        }
        if (documentoLimpio.length > 20) {
            alert('El documento no puede tener más de 20 dígitos');
            return;
        }
        if (documentoLimpio.length < 5) {
            alert('El documento debe tener al menos 5 dígitos');
            return;
        }

        const clientePayload = {
            tipo_documento: tipoDoc,
            nombre_usuario: nombre,
            apellido_usuario: apellidos,
            numero_celular: telefonoLimpio,
            id_rol: 1,
            contrasenia: 'cliente123',
            tipo_rol: 'cliente',
            no_documento_usuario: documentoLimpio,
            correo_electronico: email || `${documentoLimpio}@cliente.local`,
            id_plan: null
        };

        try {
            const response = await fetch('/api/usuarios', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(clientePayload)
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'No se pudo crear el cliente');
            }

            localStorage.setItem('smartclean_cliente_documento', documentoLimpio);
            document.getElementById('noDocumentoClienteVehiculo').value = documentoLimpio;
            console.log("local documento: " + documentoLimpio);


            // Cerrar el modal de cliente
            const clienteModal = bootstrap.Modal.getInstance(document.getElementById('agregarClienteModal'));
            if (clienteModal) {
                clienteModal.hide();
            }

            // Mostrar el modal de vehículos
            const vehiculoModal = new bootstrap.Modal(document.getElementById('agregarVehiculoClienteModal'));
            vehiculoModal.show();

            // Resetear lista de vehículos
            vehiculosCliente = [];
            actualizarListaVehiculosCliente();

            // Limpiar campos del vehículo
            document.getElementById('placaVehiculoCliente').value = '';
            document.getElementById('marcaVehiculoCliente').value = '';
            document.getElementById('modeloVehiculoCliente').value = '';
            document.getElementById('colorVehiculoCliente').value = '';
            document.getElementById('tipoVehiculoCliente').selectedIndex = 0;

            resetearFormulario();

        } catch (error) {
            console.error('Error:', error);
            alert('Error: ' + error.message);
        }
    }

    // Guardar vehículo
    async function guardarVehiculoCliente() {
        const noDocumentoCliente = localStorage.getItem('smartclean_cliente_documento');
        console.log("local documento: " + noDocumentoCliente);
        const placa = document.getElementById('placaVehiculoCliente').value.trim().toUpperCase();
        const tipo = document.getElementById('tipoVehiculoCliente').value;
        const marca = document.getElementById('marcaVehiculoCliente').value.trim();
        const modelo = document.getElementById('modeloVehiculoCliente').value.trim();
        const color = document.getElementById('colorVehiculoCliente').value.trim();

        if (!placa) {
            alert('Por favor ingresa la placa del vehículo');
            document.getElementById('placaVehiculoCliente').focus();
            return;
        }

        if (!noDocumentoCliente) {
            alert('Error: No se encontró el documento del cliente');
            return;
        }

        if (vehiculosCliente.some(v => v.placa === placa)) {
            alert('Esta placa ya fue agregada en esta sesión');
            document.getElementById('placaVehiculoCliente').focus();
            return;
        }

        try {
            const response = await fetch('/api/vehiculos', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    placa_vehiculo: placa,
                    no_documento_cliente: noDocumentoCliente,
                    tipo_vehiculo: tipo,
                    color_vehiculo: color,
                    marca_vehiculo: marca,
                    modelo_vehiculo: modelo
                })
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'No se pudo registrar el vehículo');
            }

            vehiculosCliente.push({
                placa,
                tipo,
                marca,
                modelo,
                color
            });
            actualizarListaVehiculosCliente();

            // Limpiar campos
            document.getElementById('placaVehiculoCliente').value = '';
            document.getElementById('marcaVehiculoCliente').value = '';
            document.getElementById('modeloVehiculoCliente').value = '';
            document.getElementById('colorVehiculoCliente').value = '';
            document.getElementById('tipoVehiculoCliente').selectedIndex = 0;

            // Mostrar mensaje de éxito
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-success alert-dismissible fade show mt-2';
            alertDiv.innerHTML = `
                <i class="bi bi-check-circle me-2"></i>
                Vehículo agregado correctamente
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.querySelector('#agregarVehiculoClienteModal .modal-body').prepend(alertDiv);
            setTimeout(() => alertDiv.remove(), 3000);

        } catch (error) {
            console.error('Error:', error);
            alert('Error al guardar vehículo: ' + error.message);
        }
    }

    // Actualizar lista de vehículos
    function actualizarListaVehiculosCliente() {
        const container = document.getElementById('listaVehiculosCliente');

        if (vehiculosCliente.length === 0) {
            container.innerHTML = `
                <div class="list-group-item text-muted text-center">
                    <i class="bi bi-car-front me-2"></i>No hay vehículos agregados aún
                </div>
            `;
            return;
        }

        let html = '';
        vehiculosCliente.forEach((vehiculo, index) => {
            const detalles = [];
            if (vehiculo.marca) detalles.push(vehiculo.marca);
            if (vehiculo.modelo) detalles.push(vehiculo.modelo);
            if (vehiculo.color) detalles.push(vehiculo.color);

            html += `
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>${vehiculo.placa}</strong>
                        <span class="badge bg-secondary ms-2">${vehiculo.tipo}</span>
                        ${detalles.length > 0 ? `<small class="text-muted d-block">${detalles.join(' · ')}</small>` : ''}
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="eliminarVehiculoCliente(${index})">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
            `;
        });
        container.innerHTML = html;
    }

    // Eliminar vehículo de la lista local
    function eliminarVehiculoCliente(index) {
        if (confirm('¿Eliminar este vehículo de la lista?')) {
            vehiculosCliente.splice(index, 1);
            actualizarListaVehiculosCliente();
        }
    }

    // Finalizar registro
    function finalizarRegistro() {
        const totalVehiculos = vehiculosCliente.length;
        const mensaje = totalVehiculos > 0 ?
            `Registro completado con ${totalVehiculos} vehículo(s)` :
            'El cliente se registró sin vehículos';

        alert(mensaje);

        const modal = bootstrap.Modal.getInstance(document.getElementById('agregarVehiculoClienteModal'));
        if (modal) {
            modal.hide();
        }

        // Recargar la lista de clientes
        cargarClientes();
    }

    // Resetear formulario
    function resetearFormulario() {
        document.getElementById('formCliente').reset();
        document.getElementById('noDocumentoClienteVehiculo').value = '';
        vehiculosCliente = [];
    }

    // Resetear cuando se cierra el modal principal
    document.getElementById('agregarClienteModal').addEventListener('hidden.bs.modal', function() {
        resetearFormulario();
    });

    // Permitir guardar vehículo con Enter
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            const modalVehiculo = document.getElementById('agregarVehiculoClienteModal');
            if (modalVehiculo && modalVehiculo.classList.contains('show')) {
                const campos = ['placaVehiculoCliente', 'marcaVehiculoCliente', 'modeloVehiculoCliente', 'colorVehiculoCliente'];
                if (campos.includes(document.activeElement.id)) {
                    e.preventDefault();
                    guardarVehiculoCliente();
                }
            }
        }
    });

    // ========== INICIALIZAR ==========
    // Cargar clientes al iniciar la página
    document.addEventListener('DOMContentLoaded', function() {
        cargarClientes();
    });
</script>