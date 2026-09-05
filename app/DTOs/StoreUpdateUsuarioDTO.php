<?php

namespace App\DTOs;

class StoreUpdateUsuarioDTO
{
    public function __construct(
        public ?string $noDocumentoUsuario,
        public ?string $tipoDocumento,
        public ?string $nombreUsuario,
        public ?string $apellidoUsuario,
        public ?string $numeroCelular,
        public ?int $idRol,
        public ?string $tipoRol,
        public ?string $correoElectronico,
        public ?string $contrasenia,
        public ?int $idPlan = null
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            noDocumentoUsuario: $data['no_documento_usuario'] ?? null,
            tipoDocumento: $data['tipo_documento'] ?? null,
            nombreUsuario: $data['nombre_usuario'] ?? null,
            apellidoUsuario: $data['apellido_usuario'] ?? null,
            numeroCelular: $data['numero_celular'] ?? null,
            idRol: isset($data['id_rol']) ? (int)$data['id_rol'] : null,
            tipoRol: $data['tipo_rol'] ?? null,
            correoElectronico: $data['correo_electronico'] ?? null,
            contrasenia: $data['contrasenia'] ?? null,
            idPlan: isset($data['id_plan']) ? (int)$data['id_plan'] : null
        );
    }
}
