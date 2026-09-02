<?php

namespace App\Http\Controllers;

use App\DTOs\StoreUsuarioDTO;
use App\Http\Requests\StoreClienteRequest;
use App\Services\ClienteService;
use App\Services\UsuarioService;
use App\Services\VehiculoService;
use App\DTOs\StoreVehiculoDTO;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct(
        protected ClienteService $clienteService,
        protected UsuarioService $usuarioService,
        protected VehiculoService $vehiculoService
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            $clientes = $this->clienteService->getAll();

            return response()->json([
                'success' => true,
                'message' => 'Listado de clientes consultado con éxito',
                'data' => $clientes
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error consultando los clientes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $dto = StoreUsuarioDTO::fromRequest([
                'tipo_documento' => $data['tipo_documento'],
                'nombre_usuario' => $data['nombre_usuario'],
                'apellido_usuario' => $data['apellido_usuario'],
                'numero_celular' => $data['numero_celular'],
                'id_rol' => $data['id_rol'],
                'contrasenia' => $data['contrasenia'],
                'tipo_rol' => 'cliente',
                'no_documento_usuario' => $data['no_documento_usuario'],
                'correo_electronico' => $data['correo_electronico'],
                'id_plan' => $data['id_plan'] ?? null,
            ]);

            $usuario = $this->usuarioService->registrarUsuarioCompleto($dto);
            $cliente = $usuario->cliente;

            if (!$cliente) {
                throw new Exception('No se pudo crear el cliente asociado al usuario.');
            }

            return response()->json([
                'success' => true,
                'message' => 'Cliente registrado correctamente',
                'data' => [
                    'usuario' => $usuario,
                    'cliente' => $cliente
                ]
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ha ocurrido un error registrando el cliente',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $cliente = $this->clienteService->getById($id);

            return response()->json([
                'success' => true,
                'message' => 'Cliente consultado con éxito',
                'data' => $cliente
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cliente no encontrado',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error consultando el cliente',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
