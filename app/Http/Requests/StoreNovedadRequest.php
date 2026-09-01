<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNovedadRequest extends FormRequest
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
            'tipo_novedad' => 'required|string',
            'descripcion_novedad' => 'required|string',
            'ticket_novedad' => 'required|string',
            'no_documento_colaborador' => 'required|int',
            'no_documento_cliente' => 'required|int',
            'id_reserva' => 'required|int'
        ];
    }
}
