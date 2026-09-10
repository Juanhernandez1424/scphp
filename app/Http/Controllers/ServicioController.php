<?php

namespace App\Http\Controllers;

use App\DTOs\StoreServicioDTO;
use App\Http\Requests\StoreServicioRequest;
use App\Services\ServicioService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function __construct(
        protected ServicioService $servicioService
    ) {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            $servicios = $this->servicioService->getAll();
            return response()->json([
                'success' => true,
                'message' => 'Servicios obtenidos correctamente',
                'data' => $servicios
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los servicios',
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
    public function store(StoreServicioRequest $request): JsonResponse
    {
        try {
            $dto = StoreServicioDTO::fromRequest($request->validated());

            $servicio = $this->servicioService->registrarServicio($dto);

            return response()->json([
                'success' => true,
                'message' => 'Servicio creado correctamente',
                'data' => $servicio
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el servicio',
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
            $servicio = $this->servicioService->getById((int)$id);
            return response()->json([
                'success' => true,
                'message' => 'Servicio consultado correctamente',
                'data' => $servicio
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Servicio con el ID especificado no fue encontrado',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el servicio',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getByTipoVehiculo(int $idTipoVehiculo)
    {
        try {
            $servicios = $this->servicioService->getByTipoVehiculo((int)$idTipoVehiculo);
            return response()->json([
                'success' => true,
                'message' => 'Servicios consultado correctamente',
                'data' => $servicios
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los servicios',
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
