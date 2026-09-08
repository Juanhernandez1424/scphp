<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNovedadRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tipo_novedad' => 'required|string',
            'descripcion_novedad' => 'required|string',
            'no_documento_colaborador' => 'required|integer|exists:colaborador,no_documento_colaborador',
            'no_documento_cliente' => 'required|integer|exists:cliente,no_documento_cliente',
            'etapo_novedad' => 'nullable|string',
            'id_reserva' => 'required|integer|exists:reserva,id_reserva'
        ];
    }
}