<div>
    <!-- Encabezado con estadísticas -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Empleados</h6>
                    <h2 class="mb-0" id="totalColaboradores">0</h2>
                    <small class="text-muted">Lista de empleados registrados en el sistema</small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Inactivos</h6>
                    <h2 class="mb-0" id="inactivosColaboradores">0</h2>
                    <small class="text-muted">Empleados inactivos</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de empleados -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Empleados</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarEmpleadoModal">
                <i class="bi bi-plus-circle me-1"></i>Agregar Empleado
            </button>
        </div>
        <div class="card-body">
            <p class="text-muted mb-3">Lista de empleados registrados en el sistema</p>

            <!-- Buscador -->
            <div class="mb-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" placeholder="Buscar por nombre, documento o teléfono..."
                        id="buscadorColaboradores" oninput="filtrarColaboradores(this.value)">
                </div>
            </div>

            <!-- Contenedor de la lista de colaboradores -->
            <div id="contenedorColaboradores">
                <div class="text-center py-4" id="cargandoColaboradores">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <p class="mt-2 text-muted">Cargando empleados...</p>
                </div>
                <div id="listaColaboradores" class="list-group" style="display: none;">
                    <!-- Los colaboradores se renderizarán aquí dinámicamente -->
                </div>
                <div id="sinColaboradores" class="text-center py-4 text-muted" style="display: none;">
                    <i class="bi bi-person-badge fs-1"></i>
                    <p class="mt-2">No hay empleados registrados</p>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#agregarEmpleadoModal">
                        <i class="bi bi-plus-circle me-1"></i>Agregar primer empleado
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Empleado -->
<div class="modal fade" id="agregarEmpleadoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-person-plus me-2"></i>Agregar Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formColaborador">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tipo de Documento</label>
                        <select class="form-select" id="tipoDocumentoColaborador">
                            <option value="CC">Cédula de Ciudadanía</option>
                            <option value="CE">Cédula de Extranjería</option>
                            <option value="NIT">NIT</option>
                            <option value="PAS">Pasaporte</option>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nombre</label>
                            <input type="text" class="form-control" id="nombreColaborador"
                                placeholder="Nombre del empleado">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Apellidos</label>
                            <input type="text" class="form-control" id="apellidosColaborador"
                                placeholder="Apellidos del empleado">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Número de Documento</label>
                            <input type="text" class="form-control" id="documentoColaborador"
                                placeholder="Número de documento">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Teléfono</label>
                            <input type="tel" class="form-control" id="telefonoColaborador" placeholder="Teléfono">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" id="emailColaborador" placeholder="Email del empleado">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarColaborador()">
                    <i class="bi bi-check-circle me-1"></i>Guardar Empleado
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let colaboradoresData = [];
    let colaboradoresFiltrados = [];

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
            colaboradoresFiltrados = [...colaboradoresData];

            renderizarListaColaboradores(colaboradoresFiltrados);
            actualizarEstadisticasColaboradores();

        } catch (error) {
            console.error('Error:', error);
            document.getElementById('cargandoColaboradores').innerHTML = `
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Error al cargar empleados: ${error.message}
                </div>
            `;
        }
    }

    // ========== RENDERIZAR LISTA ==========
    function renderizarListaColaboradores(colaboradores) {
        const listaContainer = document.getElementById('listaColaboradores');
        const cargando = document.getElementById('cargandoColaboradores');
        const sinColaboradores = document.getElementById('sinColaboradores');

        cargando.style.display = 'none';

        if (!colaboradores || colaboradores.length === 0) {
            listaContainer.style.display = 'none';
            sinColaboradores.style.display = 'block';
            return;
        }

        listaContainer.style.display = 'block';
        sinColaboradores.style.display = 'none';

        let html = '';
        colaboradores.forEach(colaborador => {
            const usuario = colaborador.usuario || {};

            // Construir nombre completo
            const nombreCompleto = `${usuario.nombre_usuario || ''} ${usuario.apellido_usuario || ''}`.trim() ||
                'Sin nombre';
            const tipoDocumento = usuario.tipo_documento || 'N/A';
            const numeroDocumento = colaborador.no_documento_colaborador || 'N/A';
            const telefono = usuario.numero_celular || 'N/A';
            const estado = colaborador.estado_colaborador !== undefined ? colaborador.estado_colaborador : usuario
                .estado_usuario;
            const estadoTexto = estado == 1 ? 'Activo' : 'Inactivo';
            const estadoBadge = estado == 1 ? 'bg-success' : 'bg-danger';

            html += `
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1"><strong>${nombreCompleto}</strong></h6>
                        <small class="text-muted d-block">
                            ${tipoDocumento}: ${numeroDocumento} | Tel: ${telefono}
                        </small>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge ${estadoBadge}">${estadoTexto}</span>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#" onclick="editarColaborador('${numeroDocumento}')">
                                        <i class="bi bi-pencil me-2"></i>Editar
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#" onclick="eliminarColaborador('${numeroDocumento}')">
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

    // ========== FILTRAR COLABORADORES ==========
    function filtrarColaboradores(busqueda) {
        if (!busqueda || busqueda.trim() === '') {
            colaboradoresFiltrados = [...colaboradoresData];
        } else {
            const termino = busqueda.toLowerCase().trim();
            colaboradoresFiltrados = colaboradoresData.filter(colaborador => {
                const usuario = colaborador.usuario || {};
                const nombreCompleto = `${usuario.nombre_usuario || ''} ${usuario.apellido_usuario || ''}`
                    .toLowerCase();
                const documento = String(colaborador.no_documento_colaborador || '');
                const telefono = String(usuario.numero_celular || '');

                return nombreCompleto.includes(termino) ||
                    documento.includes(termino) ||
                    telefono.includes(termino);
            });
        }
        renderizarListaColaboradores(colaboradoresFiltrados);
    }

    // ========== ESTADÍSTICAS ==========
    function actualizarEstadisticasColaboradores() {
        const total = colaboradoresData.length;
        const inactivos = colaboradoresData.filter(c => {
            const estado = c.estado_colaborador !== undefined ? c.estado_colaborador : (c.usuario?.estado_usuario ||
                1);
            return estado == 0;
        }).length;

        document.getElementById('totalColaboradores').textContent = total;
        document.getElementById('inactivosColaboradores').textContent = inactivos;
    }

    // ========== GUARDAR COLABORADOR ==========
    async function guardarColaborador() {
        const nombre = document.getElementById('nombreColaborador').value.trim();
        const apellidos = document.getElementById('apellidosColaborador').value.trim();
        const tipoDoc = document.getElementById('tipoDocumentoColaborador').value;
        const documento = document.getElementById('documentoColaborador').value.trim();
        const telefono = document.getElementById('telefonoColaborador').value.trim();
        const email = document.getElementById('emailColaborador').value.trim();

        if (!nombre || !apellidos || !documento || !telefono) {
            alert('Por favor completa todos los campos obligatorios');
            return;
        }

        const payload = {
            tipo_documento: tipoDoc,
            nombre_usuario: nombre,
            apellido_usuario: apellidos,
            no_documento_usuario: documento,
            numero_celular: telefono,
            correo_electronico: email,
            id_rol: 1,
            contrasenia: 'empleado123',
            tipo_rol: 'colaborador',
            estado_usuario: true,
            id_plan: null
        };

        try {
            const response = await fetch('/api/usuarios', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'No se pudo crear el empleado');
            }

            alert('Empleado registrado correctamente');

            const modal = bootstrap.Modal.getInstance(document.getElementById('agregarEmpleadoModal'));
            if (modal) modal.hide();

            document.getElementById('formColaborador').reset();
            cargarColaboradores();

        } catch (error) {
            console.error('Error:', error);
            alert('Error: ' + error.message);
        }
    }

    // ========== EDITAR COLABORADOR ==========
    function editarColaborador(documento) {
        alert(`Editar empleado con documento: ${documento}`);
    }

    // ========== ELIMINAR COLABORADOR ==========
    async function eliminarColaborador(documento) {
        if (!confirm(`¿Estás seguro de eliminar el empleado con documento ${documento}?`)) {
            return;
        }

        try {
            const response = await fetch(`/api/colaboradores/${documento}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Error al eliminar empleado');
            }

            alert('Empleado eliminado correctamente');
            cargarColaboradores();

        } catch (error) {
            console.error('Error:', error);
            alert('Error al eliminar: ' + error.message);
        }
    }

    // ========== INICIALIZAR ==========
    document.addEventListener('DOMContentLoaded', function() {
        cargarColaboradores();
    });
</script>