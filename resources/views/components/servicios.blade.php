<div>
    <!-- Encabezado con estadísticas -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Tipos de Vehículo</h6>
                    <h2 class="mb-0" id="totalTiposVehiculo">0</h2>
                    <small class="text-muted">Categorías registradas</small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Servicios y Precios</h6>
                    <h2 class="mb-0" id="totalServicios">0</h2>
                    <small class="text-muted">Total servicios disponibles</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Tipos de Vehículos y Servicios -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-tools me-2"></i>Tipos de Vehículos y Servicios</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarTipoVehiculoModal">
                <i class="bi bi-plus-circle me-1"></i>Agregar Tipo de Vehículo
            </button>
        </div>
        <div class="card-body">
            <p class="text-muted mb-3">Cada tipo de vehículo puede tener varios servicios con diferentes precios</p>

            <!-- Contenedor de la lista -->
            <div id="contenedorTiposVehiculo">
                <div class="text-center py-4" id="cargandoTiposVehiculo">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <p class="mt-2 text-muted">Cargando tipos de vehículo...</p>
                </div>
                <div id="listaTiposVehiculo" style="display: none;">
                    <!-- Los tipos de vehículo se renderizarán aquí -->
                </div>
                <div id="sinTiposVehiculo" class="text-center py-4 text-muted" style="display: none;">
                    <i class="bi bi-car-front fs-1"></i>
                    <p class="mt-2">No hay tipos de vehículo registrados</p>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#agregarTipoVehiculoModal">
                        <i class="bi bi-plus-circle me-1"></i>Agregar primer tipo
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Tipo de Vehículo -->
<div class="modal fade" id="agregarTipoVehiculoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-car-front me-2"></i>Agregar Tipo de Vehículo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formTipoVehiculo">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tipo de Vehículo</label>
                        <input type="text" class="form-control" id="nombreTipoVehiculo"
                            placeholder="Ej: Automovil, Camioneta, Moto">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Descripción</label>
                        <textarea class="form-control" id="descripcionTipoVehiculo" rows="2"
                            placeholder="Descripción del tipo de vehículo"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarTipoVehiculo()">
                    <i class="bi bi-check-circle me-1"></i>Guardar Tipo
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Servicio a Tipo de Vehículo -->
<div class="modal fade" id="agregarServicioModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Agregar Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="tipoVehiculoIdServicio">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre del Servicio</label>
                    <input type="text" class="form-control" id="nombreServicio" placeholder="Ej: Lavado Sencillo">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Precio</label>
                    <input type="number" class="form-control" id="precioServicio" placeholder="Ej: 25000">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Descripción</label>
                    <textarea class="form-control" id="descripcionServicio" rows="2"
                        placeholder="Descripción del servicio"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarServicio()">
                    <i class="bi bi-check-circle me-1"></i>Agregar Servicio
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let tiposVehiculoData = [];
    let tiposVehiculoFiltrados = [];

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
            console.log('📥 Tipos de vehículo:', result);

            if (!response.ok) {
                throw new Error(result.message || 'Error al cargar los tipos de vehículo');
            }

            tiposVehiculoData = result.data || [];
            tiposVehiculoFiltrados = [...tiposVehiculoData];

            renderizarTiposVehiculo(tiposVehiculoFiltrados);
            actualizarEstadisticas();

        } catch (error) {
            console.error('Error:', error);
            document.getElementById('cargandoTiposVehiculo').innerHTML = `
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Error al cargar tipos de vehículo: ${error.message}
                </div>
            `;
        }
    }

    // ========== RENDERIZAR LISTA ==========
    function renderizarTiposVehiculo(tipos) {
        const listaContainer = document.getElementById('listaTiposVehiculo');
        const cargando = document.getElementById('cargandoTiposVehiculo');
        const sinTipos = document.getElementById('sinTiposVehiculo');

        cargando.style.display = 'none';

        if (!tipos || tipos.length === 0) {
            listaContainer.style.display = 'none';
            sinTipos.style.display = 'block';
            return;
        }

        listaContainer.style.display = 'block';
        sinTipos.style.display = 'none';

        let html = '';
        tipos.forEach(tipo => {
            const servicios = tipo.servicios || [];
            const totalServicios = servicios.length;

            html += `
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0"><strong>${tipo.nombre_tipo_vehiculo || 'Sin nombre'}</strong></h6>
                            <small class="text-muted">${totalServicios} servicio${totalServicios !== 1 ? 's' : ''}</small>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-primary" onclick="abrirModalAgregarServicio(${tipo.id_tipo_vehiculo})">
                                <i class="bi bi-plus-circle me-1"></i>Agregar Servicio
                            </button>
                            <button class="btn btn-sm btn-outline-secondary" onclick="toggleServicios(${tipo.id_tipo_vehiculo})">
                                <i class="bi bi-chevron-down" id="icon_${tipo.id_tipo_vehiculo}"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" id="servicios_${tipo.id_tipo_vehiculo}" style="display: none;">
                        ${totalServicios > 0 ? `
                            ${servicios.map(servicio => `
                                <div class="border-bottom pb-2 mb-2">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1"><strong>${servicio.nombre_servicio || 'Sin nombre'}</strong></h6>
                                            <p class="small text-muted mb-1">${servicio.descripcion_servicio || 'Sin descripción'}</p>
                                            <span class="badge bg-success">$ ${Number(servicio.precio_servicio || 0).toLocaleString()}</span>
                                        </div>
                                        <div>
                                            <button class="btn btn-sm btn-outline-primary" onclick="editarServicio(${servicio.id_servicio})">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" onclick="eliminarServicio(${servicio.id_servicio})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            `).join('')}
                        ` : `
                            <p class="text-muted text-center mb-0">
                                <i class="bi bi-info-circle me-1"></i>
                                Este tipo de vehículo no tiene servicios asociados
                            </p>
                        `}
                        <div class="mt-2">
                            <button class="btn btn-outline-primary btn-sm w-100" onclick="abrirModalAgregarServicio(${tipo.id_tipo_vehiculo})">
                                <i class="bi bi-plus-circle me-1"></i>Agregar Servicio
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });

        listaContainer.innerHTML = html;
    }

    // ========== TOGGLE SERVICIOS ==========
    function toggleServicios(idTipoVehiculo) {
        const serviciosDiv = document.getElementById(`servicios_${idTipoVehiculo}`);
        const icon = document.getElementById(`icon_${idTipoVehiculo}`);

        if (serviciosDiv.style.display === 'none') {
            serviciosDiv.style.display = 'block';
            icon.className = 'bi bi-chevron-up';
        } else {
            serviciosDiv.style.display = 'none';
            icon.className = 'bi bi-chevron-down';
        }
    }

    // ========== ABRIR MODAL AGREGAR SERVICIO ==========
    function abrirModalAgregarServicio(idTipoVehiculo) {
        document.getElementById('tipoVehiculoIdServicio').value = idTipoVehiculo;
        document.getElementById('nombreServicio').value = '';
        document.getElementById('precioServicio').value = '';
        document.getElementById('descripcionServicio').value = '';

        const modal = new bootstrap.Modal(document.getElementById('agregarServicioModal'));
        modal.show();
    }

    // ========== GUARDAR SERVICIO ==========
    async function guardarServicio() {
        const idTipoVehiculo = document.getElementById('tipoVehiculoIdServicio').value;
        const nombre = document.getElementById('nombreServicio').value.trim();
        const precio = document.getElementById('precioServicio').value.trim();
        const descripcion = document.getElementById('descripcionServicio').value.trim();

        if (!nombre || !precio) {
            alert('Por favor completa todos los campos obligatorios');
            return;
        }

        const payload = {
            id_tipo_vehiculo: parseInt(idTipoVehiculo),
            nombre_servicio: nombre,
            precio_servicio: parseFloat(precio),
            descripcion_servicio: descripcion || null
        };

        try {
            const response = await fetch('/api/servicios', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'No se pudo crear el servicio');
            }

            alert('✅ Servicio agregado correctamente');

            const modal = bootstrap.Modal.getInstance(document.getElementById('agregarServicioModal'));
            if (modal) modal.hide();

            cargarTiposVehiculo();

        } catch (error) {
            console.error('Error:', error);
            alert('❌ Error: ' + error.message);
        }
    }

    // ========== GUARDAR TIPO DE VEHÍCULO ==========
    async function guardarTipoVehiculo() {
        const nombre = document.getElementById('nombreTipoVehiculo').value.trim();
        const descripcion = document.getElementById('descripcionTipoVehiculo').value.trim();

        if (!nombre) {
            alert('Por favor ingresa el nombre del tipo de vehículo');
            return;
        }

        const payload = {
            nombre_tipo_vehiculo: nombre,
            descripcion_tipo_vehiculo: descripcion || null
        };

        try {
            const response = await fetch('/api/tipo-vehiculo', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'No se pudo crear el tipo de vehículo');
            }

            alert('✅ Tipo de vehículo agregado correctamente');

            const modal = bootstrap.Modal.getInstance(document.getElementById('agregarTipoVehiculoModal'));
            if (modal) modal.hide();

            document.getElementById('formTipoVehiculo').reset();
            cargarTiposVehiculo();

        } catch (error) {
            console.error('Error:', error);
            alert('❌ Error: ' + error.message);
        }
    }

    // ========== ELIMINAR SERVICIO ==========
    async function eliminarServicio(idServicio) {
        if (!confirm('¿Estás seguro de eliminar este servicio?')) {
            return;
        }

        try {
            const response = await fetch(`/api/servicios/${idServicio}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Error al eliminar servicio');
            }

            alert('Servicio eliminado correctamente');
            cargarTiposVehiculo();

        } catch (error) {
            console.error('Error:', error);
            alert('Error al eliminar: ' + error.message);
        }
    }

    // ========== EDITAR SERVICIO (placeholder) ==========
    function editarServicio(idServicio) {
        alert(`Editar servicio con ID: ${idServicio}`);
    }

    // ========== ESTADÍSTICAS ==========
    function actualizarEstadisticas() {
        const totalTipos = tiposVehiculoData.length;
        let totalServicios = 0;

        tiposVehiculoData.forEach(tipo => {
            totalServicios += (tipo.servicios || []).length;
        });

        document.getElementById('totalTiposVehiculo').textContent = totalTipos;
        document.getElementById('totalServicios').textContent = totalServicios;
    }

    // ========== INICIALIZAR ==========
    document.addEventListener('DOMContentLoaded', function() {
        cargarTiposVehiculo();
    });
</script>