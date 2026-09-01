<?php

namespace App\Http\Controllers;

use App\DTOs\StoreReservaDTO;
use App\Http\Requests\StoreReservaRequest;
use App\Services\ReservaService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function __construct(
        protected ReservaService $reservaService
    ) {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try {
            $reservas = $this->reservaService->getAll();
            return response()->json([
                'success' => true,
                'message' => 'Lista de reservas obtenida correctamente',
                'data' => $reservas
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener la lista de reservas',
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
    public function store(StoreReservaRequest $request): JsonResponse
    {
        try {
            $dto = StoreReservaDTO::fromRequest($request->validated());

            $reserva = $this->reservaService->registrarReserva($dto);
            return response()->json([
                'success' => true,
                'message' => 'Reserva creada correctamente',
                'data' => $reserva
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la reserva',
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
