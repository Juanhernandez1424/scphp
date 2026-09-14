<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComprobantePagoRequest extends FormRequest
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
            'id_reserva' => 'required|integer|exists:reserva,id_reserva',
            'id_metodo_pago' => 'required|integer|exists:metodo_pago,id_metodo_pago',
        ];
    }
}
