<?php

namespace App\Http\Controllers;

use App\DTOs\StoreReservaDTO;
use App\Http\Requests\StoreReservaRequest;
use App\Services\ReservaService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $reservas = $this->reservaService->getAll(
                $this->colaboradorAutenticadoId(),
                $this->clienteAutenticadoId()
            );
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
            $this->rechazarColaborador();
            $dto = StoreReservaDTO::fromRequest($request->validated());

            $reserva = $this->reservaService->registrarReserva($dto);
            return response()->json([
                'success' => true,
                'message' => 'Reserva creada correctamente',
                'data' => $reserva
            ], 201);
        } catch (\RuntimeException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 409);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function disponibilidad(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'no_documento_colaborador' => 'required|integer',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i'
        ]);

        $disponible = $this->reservaService->colaboradorDisponible(
            (int) $validated['no_documento_colaborador'],
            $validated['fecha'],
            $validated['hora']
        );

        return response()->json([
            'success' => true,
            'disponible' => $disponible,
            'message' => $disponible
                ? 'El colaborador está disponible para esta ventana.'
                : 'El colaborador ya está ocupado. Cambia de colaborador, hora o día.'
        ]);
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
            $reserva = $this->reservaService->getById(
                (int) $id,
                $this->colaboradorAutenticadoId(),
                $this->clienteAutenticadoId()
            );
            return response()->json([
                'success' => true,
                'message' => 'Reserva obtenida correctamente',
                'data' => $reserva
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'La reserva con el ID especificado no fue encontrada',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener la reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getByDate($fecha): JsonResponse
    {
        try {
            $reservas = $this->reservaService->getByDate(
                $fecha,
                $this->colaboradorAutenticadoId(),
                $this->clienteAutenticadoId()
            );
            return response()->json([
                'success' => true,
                'message' => 'Reservas obtenidas correctamente',
                'data' => $reservas
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las reservas por fecha',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getByEtapaLavado($etapaLavado): JsonResponse
    {
        try {
            $reservas = $this->reservaService->getByEtapaLavado($etapaLavado);
            return response()->json([
                'success' => true,
                'message' => 'Reservas obtenidas correctamente',
                'data' => $reservas
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las reservas por etapa de lavado',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function activarReserva($idReserva): JsonResponse
    {
        try {
            $this->rechazarColaborador();
            $reserva = $this->reservaService->activarReserva((int)$idReserva);
            return response()->json([
                'success' => true,
                'message' => 'Reserva activada correctamente',
                'data' => $reserva
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'La reserva con el ID especificado no fue encontrada',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al activar la reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function iniciarReserva($idReserva): JsonResponse
    {
        try {
            $reserva = $this->reservaService->iniciarReserva(
                (int) $idReserva,
                $this->colaboradorAutenticadoId()
            );
            return response()->json([
                'success' => true,
                'message' => 'Reserva iniciada correctamente',
                'data' => $reserva
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'La reserva con el ID especificado no fue encontrada',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al iniciar la reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function finalizarReserva($idReserva): JsonResponse
    {
        try {
            $reserva = $this->reservaService->finalizarReserva(
                (int) $idReserva,
                $this->colaboradorAutenticadoId()
            );
            return response()->json([
                'success' => true,
                'message' => 'Reserva finalizada correctamente',
                'data' => $reserva
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'La reserva con el ID especificado no fue encontrada',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al finalizar la reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function cancelarReserva($idReserva): JsonResponse
    {
        try {
            $this->rechazarColaborador();
            $reserva = $this->reservaService->cancelarReserva((int)$idReserva);
            return response()->json([
                'success' => true,
                'message' => 'Reserva cancelada correctamente',
                'data' => $reserva
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'La reserva con el ID especificado no fue encontrada',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cancelar la reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $this->rechazarColaborador();

            $reserva = $this->reservaService->actualizarEtapaLavado((int)$id, $request->etapa_lavado);

            return response()->json([
                'success' => true,
                'message' => 'Etapa de la reserva actualizada correctamente',
                'data' => $reserva
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'La reserva con el ID especificado no fue encontrada',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function colaboradorAutenticadoId(): ?int
    {
        if ((int) Auth::user()?->id_rol !== 4) {
            return null;
        }

        $colaboradorId = Auth::user()->colaborador?->no_documento_colaborador;

        if ($colaboradorId === null) {
            abort(403, 'El usuario no tiene un colaborador asociado.');
        }

        return (int) $colaboradorId;
    }

    private function clienteAutenticadoId(): ?int
    {
        if ((int) Auth::user()?->id_rol !== 3) {
            return null;
        }

        $clienteId = Auth::user()->cliente?->no_documento_cliente;

        if ($clienteId === null) {
            abort(403, 'El usuario no tiene un cliente asociado.');
        }

        return (int) $clienteId;
    }

    private function rechazarColaborador(): void
    {
        if ((int) Auth::user()?->id_rol === 4) {
            abort(403, 'El colaborador solo puede iniciar y finalizar reservas.');
        }
    }
}
