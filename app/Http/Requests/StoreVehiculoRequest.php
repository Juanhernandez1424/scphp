<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehiculoRequest extends FormRequest
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
            'placa_vehiculo' => 'required|string|max:10',
            'no_documento_cliente' => 'required|int',
            'tipo_vehiculo' => 'required|string',
            'color_vehiculo' => 'string',
            'marca_vehiculo' => 'string',
            'modelo_vehiculo' => 'string'
        ];
    }
}
