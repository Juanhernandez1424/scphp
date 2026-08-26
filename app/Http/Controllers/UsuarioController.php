<?php

namespace App\Http\Controllers;

use App\DTOs\StoreUsuarioDTO;
use App\Http\Requests\StoreUsuarioRequest;
use App\Services\UsuarioService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{

    public function __construct(
        protected UsuarioService $usuarioService
    ) {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            $usuarios = $this->usuarioService->getAll();

            return response()->json([
                'success' => true,
                'message' => 'Listado de usuarios consultado con éxito',
                'data' => $usuarios
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error consultando los usuarios',
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
    public function store(StoreUsuarioRequest $request): JsonResponse
    {
        try {
            $dto = StoreUsuarioDTO::fromRequest($request->validated());

            $usuario = $this->usuarioService->registrarUsuarioCompleto($dto);

            return response()->json([
                'success' => true,
                'message' => 'Usuario registrado correctamente',
                'data' => $usuario
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'sucess' => false,
                'message' => 'Ha ocurrido un error registrando el usuario',
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
