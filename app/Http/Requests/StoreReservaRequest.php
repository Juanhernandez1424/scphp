<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'no_documento_cliente' => 'required|int',
            'placa_vehiculo' => 'required|string',
            'no_documento_colaborador' => 'required|int',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'id_plan' => 'required|int',
            'id_servicio' => 'required|int',
            'etapa_lavado' => 'nullable|string',
            'fotos_vehiculo' => 'required|string'
        ];
    }
}
