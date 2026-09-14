<?php

namespace App\Http\Controllers;

use App\Services\ColaboradorService;
use App\Services\UsuarioService;
use Exception;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    public function __construct(
    protected ColaboradorService $colaboradorService,
    protected UsuarioService $usuarioService
) {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $colaboradores = $this->colaboradorService->getAll();
            return response()->json([
                'success' => true,
                'message' => 'Listado de colaboradores consultado con éxito',
                'data' => $colaboradores
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error consultando los colaboradores',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            $colaborador = $this->colaboradorService->getById($id);
            return response()->json([
                'success' => true,
                'message' => 'Colaborador consultado con éxito',
                'data' => $colaborador
            ], 200);
        } catch(ModelNotFoundException $e){
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error consultando el colaborador',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error consultando el colaborador',
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
        try {
            $colaborador = $this->colaboradorService->getById($id);
            $dto = \App\DTOs\StoreUpdateUsuarioDTO::fromRequest($request->all());
            $this->usuarioService->actualizarUsuario($colaborador->id_usuario, $dto);

            $colaboradorActualizado = $this->colaboradorService->getById($id);

            return response()->json([
                'success' => true,
                'message' => 'Colaborador actualizado correctamente',
                'data' => $colaboradorActualizado
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Colaborador no encontrado',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el colaborador',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function destroy($id)
    {
        try {
            $this->colaboradorService->eliminar($id);

            return response()->json([
                'success' => true,
                'message' => 'Colaborador eliminado correctamente'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Colaborador no encontrado',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo eliminar el colaborador (puede tener reservas asociadas)',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
