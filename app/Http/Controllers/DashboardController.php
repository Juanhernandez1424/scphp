<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(private DashboardService $dashboardService) {}

    public function metricas(Request $request): JsonResponse
    {
        $fecha = $request->validate([
            'fecha' => 'nullable|date_format:Y-m-d',
        ])['fecha'] ?? now()->toDateString();

        return response()->json([
            'success' => true,
            'message' => 'Métricas del dashboard obtenidas correctamente',
            'data' => $this->dashboardService->obtenerMetricas($fecha),
        ]);
    }
}
