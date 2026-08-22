<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUsuarioRequest extends FormRequest
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
            'id_usuario'             => 'required|integer|unique:usuario,id_usuario',
            'tipo_documento'         => 'required|string|max:20',
            'nombre_usuario'         => 'required|string|max:20',
            'apellido_usuario'       => 'required|string|max:20',
            'numero_celular'         => 'required|integer',
            'id_rol'                 => 'required|integer|exists:rol,id_rol',
            'contrasenia'            => 'required|string|min:6|max:20',
            'tipo_rol'               => ['required', 'string', Rule::in(['cliente', 'colaborador', 'coordinador', 'administrador'])],
            'no_documento_usuario'   => 'required|integer',
            'correo_electronico'     => 'required|email|max:50|unique:correo,correo_electronico',
            'id_plan'                => 'nullable|integer|exists:plan,id_plan',
        ];
    }
}
