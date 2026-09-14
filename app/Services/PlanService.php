<?php

namespace App\Services;

use App\Models\Plan;

class PlanService
{
    public function getAll()
    {
        return Plan::orderBy('id_plan', 'desc')->get();
    }

    public function getById(int $idPlan): Plan
    {
        return Plan::findOrFail($idPlan);
    }

    public function actualizar(int $idPlan, array $data): Plan
    {
        $plan = Plan::findOrFail($idPlan);
        $plan->update($data);
        return $plan;
    }

    public function eliminar(int $idPlan): void
    {
        $plan = Plan::findOrFail($idPlan);
        $plan->delete();
    }
}