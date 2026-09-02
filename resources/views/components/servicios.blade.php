<div>
    <!-- Encabezado con estadísticas -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Tipos de Vehículo</h6>
                    <h2 class="mb-0">3</h2>
                    <small class="text-muted">Categorías registradas</small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Servicios y Precios</h6>
                    <h2 class="mb-0">8</h2>
                    <small class="text-muted">Total servicios disponibles</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Tipos de Vehículos y Servicios -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-tools me-2"></i>Tipos de Vehículos y Servicios</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarVehiculoModal">
                <i class="bi bi-plus-circle me-1"></i>Agregar Tipo de Vehículo
            </button>
        </div>
        <div class="card-body">
            <p class="text-muted mb-3">Cada tipo de vehículo puede tener varios servicios con diferentes precios</p>
            
            <div class="list-group">
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1"><strong>Automovil</strong></h6>
                        <small class="text-muted">3 servicios</small>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1"><strong>Camioneta</strong></h6>
                        <small class="text-muted">2 servicios</small>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1"><strong>Moto</strong></h6>
                        <small class="text-muted">3 servicios</small>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-outline-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#agregarVehiculoModal">
                    <i class="bi bi-plus-circle me-1"></i>Agregar Tipo de Vehículo
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Tipo de Vehículo -->
<div class="modal fade" id="agregarVehiculoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Tipo de Vehículo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Tipo de Vehículo</label>
                        <input type="text" class="form-control" placeholder="Ej: Automovil, Camioneta, Moto">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" rows="2" placeholder="Descripción del tipo de vehículo"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar Tipo</button>
            </div>
        </div>
    </div>
</div>