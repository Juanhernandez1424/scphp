<?php

namespace App\DTOs;

class StoreUsuarioDTO
{
    public function __construct(
        //public int $idUsuario,
        public string $tipoDocumento,
        public int $noDocumentoUsuario,
        public string $nombreUsuario,
        public string $apellidoUsuario,
        public int $numeroCelular,
        public string $contrasenia,
        public int $idRol,
        public string $tipoRol,
        public string $correoElectronico,
        public ?int $idPlan = null
    ) {}

    // Este método toma los datos limpios del Request anterior y los transforma en este objeto DTO
    public static function fromRequest(array $data): self
    {
        return new self(
            //idUsuario: (int)$data['id_usuario'],
            tipoDocumento: $data['tipo_documento'],
            noDocumentoUsuario: (int)$data['no_documento_usuario'],
            nombreUsuario: $data['nombre_usuario'],
            apellidoUsuario: $data['apellido_usuario'],
            numeroCelular: (int)$data['numero_celular'],
            contrasenia: $data['contrasenia'],
            idRol: (int)$data['id_rol'],
            tipoRol: strtolower($data['tipo_rol']),
            correoElectronico: $data['correo_electronico'],
            idPlan: isset($data['id_plan']) ? (int)$data['id_plan'] : null
        );
    }
}
