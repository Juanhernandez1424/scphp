<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function create(Request $request)
    {
        $cliente = null;

        // Lista de clientes quemados (Mock Data)
        $clientesQuemados = [
            [
                'id' => 1,
                'tipo_documento' => 'CC',
                'documento' => '1098765432',
                'nombre' => 'María García',
                'telefono' => '3201234567',
                'placa' => 'ABC-123'
            ],
            [
                'id' => 2,
                'tipo_documento' => 'CE',
                'documento' => '987654321',
                'nombre' => 'Carlos López',
                'telefono' => '3109876543',
                'placa' => 'XYZ-789'
            ]
        ];

        // Buscar el cliente en la lista quemada si se enviaron los campos
        if ($request->filled('tipo_doc') && $request->filled('num_doc')) {
            
            foreach ($clientesQuemados as $c) {
                if ($c['tipo_documento'] === $request->tipo_doc && $c['documento'] === $request->num_doc) {
                    $cliente = (object) $c; // Convertimos a objeto para acceder con $cliente->nombre en Blade
                    break;
                }
            }

            if (!$cliente) {
                session()->now('error', 'Cliente no encontrado.');
            }
        }

        return view('reservas.reservas', compact('cliente'));
    }
}