<?php

namespace App\Http\Controllers;

use App\Services\PlanService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function __construct(
        protected PlanService $planService
    ) {}

    public function index(): JsonResponse
    {
        try {
            $planes = $this->planService->getAll();
            return response()->json([
                'success' => true,
                'message' => 'Listado de planes consultado con éxito',
                'data' => $planes
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al consultar los planes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $plan = $this->planService->getById((int)$id);
            return response()->json([
                'success' => true,
                'message' => 'Plan consultado con éxito',
                'data' => $plan
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Plan no encontrado',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al consultar el plan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $data = $request->validate([
                'nombre_plan' => 'sometimes|string',
                'descripcion_plan' => 'sometimes|string',
                'cantidad_servicios' => 'sometimes|integer',
                'costo_plan' => 'sometimes|numeric',
                'id_metodo_pago' => 'sometimes|integer',
                'estado_plan' => 'sometimes|boolean',
            ]);

            $plan = $this->planService->actualizar((int)$id, $data);

            return response()->json([
                'success' => true,
                'message' => 'Plan actualizado correctamente',
                'data' => $plan
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Plan no encontrado',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el plan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->planService->eliminar((int)$id);
            return response()->json([
                'success' => true,
                'message' => 'Plan eliminado correctamente'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Plan no encontrado',
                'error' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo eliminar el plan (puede tener clientes asociados)',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}