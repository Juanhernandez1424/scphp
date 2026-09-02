<div>
    <!-- Encabezado con estadísticas -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Empleados</h6>
                    <h2 class="mb-0">2</h2>
                    <small class="text-muted">Lista de empleados registrados en el sistema</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Servicios y Precios</h6>
                    <h2 class="mb-0">2 <small class="h6 text-muted">/ 0</small></h2>
                    <small class="text-muted">Activos / Inactivos</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Inactivos</h6>
                    <h2 class="mb-0">0</h2>
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
            
            <div class="list-group">
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1"><strong>Carlos Ramirez</strong></h6>
                        <small class="text-muted">3101234567</small>
                    </div>
                    <span class="badge bg-success">Activo</span>
                </div>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1"><strong>Andres Lopez</strong></h6>
                        <small class="text-muted">3109876543</small>
                    </div>
                    <span class="badge bg-success">Activo</span>
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-outline-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#agregarEmpleadoModal">
                    <i class="bi bi-plus-circle me-1"></i>Agregar Empleado
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Empleado -->
<div class="modal fade" id="agregarEmpleadoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" placeholder="Nombre del empleado">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" placeholder="Teléfono">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar Empleado</button>
            </div>
        </div>
    </div>
</div>