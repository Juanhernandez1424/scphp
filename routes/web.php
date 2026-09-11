<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservaController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->id_rol == 3) {
            return redirect()->route('reservas');
        }

        return view('components.dashboard');
    })->name('dashboard');

    // Ruta principal para ver la lista/vista de reservas
    Route::get('/reservas', function () {
        $cliente = Auth::user()->id_rol == 3
            ? Auth::user()->cliente()->with(['usuario', 'vehiculo'])->first()
            : null;
        $clienteAutenticado = $cliente ? [
            'no_documento_cliente' => $cliente->no_documento_cliente,
            'usuario' => $cliente->usuario?->only([
                'tipo_documento',
                'nombre_usuario',
                'apellido_usuario',
                'numero_celular'
            ]),
            'vehiculo' => $cliente->vehiculo->map->only([
                'placa_vehiculo',
                'id_tipo_vehiculo',
                'color_vehiculo',
                'marca_vehiculo',
                'modelo_vehiculo'
            ])->values()
        ] : null;

        return view('reservas.reservas', compact('clienteAutenticado'));
    })->name('reservas');

    // Ruta diferente para la vista del formulario de creación
    Route::get('/reservas/crear', [ReservaController::class, 'create'])->name('reservas.create');

    Route::get('/novedades-cliente', function () {
        return view('components.novedades-cliente');
    })->name('novedades-cliente');

    Route::get('/novedades-interno', function () {
        return view('components.novedades-interno');
    })->middleware('prevent.client')->name('novedades-interno');

    Route::get('/gerencia', function () {
        return view('gerencia.gerencia');
    })->middleware('prevent.client')->name('gerencia');

    Route::get('/gerencia/clientes', function () {
        return view('gerencia.gerencia');
    })->middleware('prevent.client')->name('gerencia.clientes');

    Route::get('/gerencia/colaboradores', function () {
        return view('gerencia.gerencia');
    })->middleware('prevent.client')->name('gerencia.colaboradores');

    Route::get('/gerencia/servicios', function () {
        return view('gerencia.gerencia');
    })->middleware('prevent.client')->name('gerencia.servicios');
});

// Route::view('/novedades', 'components.novedades')->name('novedades');
// Route::view('/novedades-cliente', 'components.novedades-cliente')->name('cliente');






Route::post('/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
