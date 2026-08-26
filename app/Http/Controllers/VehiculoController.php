<?php

namespace App\Http\Controllers;

use App\DTOs\StoreVehiculoDTO;
use App\Http\Requests\StoreVehiculoRequest;
use App\Services\VehiculoService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function __construct(
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
            $vehiculos = $this->vehiculoService->getAll();

            return response()->json([
                'success' => true,
                'message' => 'Listado de vehículos consultado con éxito',
                'data' => $vehiculos
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error consultando los vehículos',
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
    public function store(StoreVehiculoRequest $request): JsonResponse
    {
        try {
            $dto = StoreVehiculoDTO::fromRequest($request->validated());

            $vehiculo = $this->vehiculoService->registrarVehiculo($dto);

            return response()->json([
                'success' => true,
                'message' => 'Vehículo registrado correctamente',
                'data' => $vehiculo
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ha ocurrido un error registrando el vehículo',
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
