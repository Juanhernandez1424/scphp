<?php

namespace App\Services;

use App\DTOs\StoreUpdateUsuarioDTO;
use App\DTOs\StoreUsuarioDTO;
use App\Models\Usuario;
use App\Models\Correo;
use App\Models\Telefono;
use App\Models\Cliente;
use App\Models\Colaborador;
use App\Models\Coordinador;
use App\Models\Administrador;
use Illuminate\Support\Facades\DB;
use Exception;

class UsuarioService
{

    /**
     * Obtener la lista completa de usuarios con sus datos de contacto y roles asignados
     */

    public function getAll()
    {
        return Usuario::with([
            'correo',
            'telefono',
            'administrador',
            'coordinador',
            'cliente',
            'colaborador'
        ])
            ->orderBy('id_usuario', 'desc')
            ->get();
    }

    public function getById(int $idUsuario)
    {
        return Usuario::with([
            'correo',
            'telefono',
            'administrador',
            'coordinador',
            'cliente',
            'colaborador'
        ])
            ->findOrFail($idUsuario);
    }

    /**
     * Registra un usuario y su rol correspondiente de forma atómica.
     * 
     * @param StoreUsuarioDTO $dto
     * @return Usuario
     * @throws Exception
     */
    public function registrarUsuarioCompleto(StoreUsuarioDTO $dto): Usuario
    {
        // DB::transaction asegura que si algo falla, no se guarde nada a medias en la BD
        return DB::transaction(function () use ($dto) {

            // 1. Crear el registro principal en la tabla 'usuario'
            $usuario = Usuario::create([
                //'id_usuario'       => $dto->idUsuario,
                'tipo_documento'   => $dto->tipoDocumento,
                'nombre_usuario'   => $dto->nombreUsuario,
                'apellido_usuario' => $dto->apellidoUsuario,
                'numero_celular'   => $dto->numeroCelular,
                'id_rol'           => $dto->idRol,
                'contrasenia'      => password_hash($dto->contrasenia, PASSWORD_BCRYPT), // Encriptación segura
                'estado_usuario'   => true
            ]);

            // 2. Insertar el correo en la tabla 'correo'
            Correo::create([
                'id_usuario'         => $usuario->id_usuario,
                'correo_electronico' => $dto->correoElectronico
            ]);

            // 3. Insertar el número telefónico en la tabla 'telefono'
            Telefono::create([
                'id_usuario'     => $usuario->id_usuario,
                'numero_celular' => (string)$dto->numeroCelular
            ]);

            // 4. Evaluar el rol especificado e insertar en su respectiva subtabla
            switch ($dto->tipoRol) {
                case 'cliente':
                    Cliente::create([
                        'no_documento_cliente' => $dto->noDocumentoUsuario,
                        'id_usuario'           => $usuario->id_usuario,
                        'id_plan'              => $dto->idPlan
                    ]);
                    break;

                case 'colaborador':
                    Colaborador::create([
                        'no_documento_colaborador' => $dto->noDocumentoUsuario,
                        'id_usuario'               => $usuario->id_usuario
                    ]);
                    break;

                case 'coordinador':
                    Coordinador::create([
                        'no_documento_coordinador' => $dto->noDocumentoUsuario,
                        'id_usuario'               => $usuario->id_usuario
                    ]);
                    break;

                case 'administrador':
                    Administrador::create([
                        'no_documento_administrador' => $dto->noDocumentoUsuario,
                        'id_usuario'                 => $usuario->id_usuario
                    ]);
                    break;

                default:
                    throw new Exception("El tipo de rol '{$dto->tipoRol}' no es válido en el sistema.");
            }

            return $usuario;
        });
    }

    public function actualizarUsuario(int $idUsuario, StoreUpdateUsuarioDTO $dto): Usuario
    {
        return DB::transaction(function () use ($idUsuario, $dto) {
            $usuario = Usuario::findOrFail($idUsuario);

            // Construir array solo con campos enviados
            $data = [];

            if ($dto->tipoDocumento !== null) {
                $data['tipo_documento'] = $dto->tipoDocumento;
            }
            if ($dto->nombreUsuario !== null) {
                $data['nombre_usuario'] = $dto->nombreUsuario;
            }
            if ($dto->apellidoUsuario !== null) {
                $data['apellido_usuario'] = $dto->apellidoUsuario;
            }
            if ($dto->numeroCelular !== null) {
                $data['numero_celular'] = $dto->numeroCelular;
            }
            if ($dto->idRol !== null) {
                $data['id_rol'] = $dto->idRol;
            }
            // Solo actualizar contraseña si se envía una nueva
            if (!empty($dto->contrasenia)) {
                $data['contrasenia'] = password_hash($dto->contrasenia, PASSWORD_BCRYPT);
            }

            // Actualizar solo los campos que llegaron
            if (!empty($data)) {
                $usuario->update($data);
            }

            // Actualizar correo si se envía
            if ($dto->correoElectronico !== null) {
                $correo = Correo::where('id_usuario', $usuario->id_usuario)->first();
                if ($correo) {
                    $correo->update(['correo_electronico' => $dto->correoElectronico]);
                } else {
                    Correo::create([
                        'id_usuario' => $usuario->id_usuario,
                        'correo_electronico' => $dto->correoElectronico
                    ]);
                }
            }

            // Actualizar teléfono si se envía
            if ($dto->numeroCelular !== null) {
                $telefono = Telefono::where('id_usuario', $usuario->id_usuario)->first();
                if ($telefono) {
                    $telefono->update(['numero_celular' => (string)$dto->numeroCelular]);
                } else {
                    Telefono::create([
                        'id_usuario' => $usuario->id_usuario,
                        'numero_celular' => (string)$dto->numeroCelular
                    ]);
                }
            }

            // Cargar relaciones actualizadas
            $usuario->load([
                'correo',
                'telefono',
                'administrador',
                'coordinador',
                'cliente',
                'colaborador'
            ]);

            return $usuario;
        });
    }
}
