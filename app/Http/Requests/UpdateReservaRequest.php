<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'placa_vehiculo' => 'required|string|exists:vehiculo,placa_vehiculo',
            'no_documento_colaborador' => 'required|integer|exists:colaborador,no_documento_colaborador',
            'fecha' => 'required|date',
            'hora' => ['required', 'date_format:H:i', 'in:' . implode(',', $this->horasDisponibles())],
            'id_servicio' => 'required|integer|exists:servicio,id_servicio',
            'id_tipo_vehiculo' => 'required|integer|exists:tipo_vehiculo,id_tipo_vehiculo',
        ];
    }

    private function horasDisponibles(): array
    {
        $horas = [];

        for ($minutos = 7 * 60; $minutos < 18 * 60; $minutos += 30) {
            $horas[] = sprintf('%02d:%02d', intdiv($minutos, 60), $minutos % 60);
        }

        return $horas;
    }
}
