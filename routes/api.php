<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ComprobantePagoController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\NovedadController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\TipoVehiculoController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\MetodoPagoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('usuarios', UsuarioController::class);

Route::get('/clientes/byTipoNumDoc', [ClienteController::class, 'getByTipoNumeroDocumento']);
Route::apiResource('clientes', ClienteController::class);

Route::apiResource('administradores', AdministradorController::class);

Route::apiResource('colaboradores', ColaboradorController::class);

Route::apiResource('coordinadores', CoordinadorController::class);

Route::apiResource('vehiculos', VehiculoController::class);

Route::apiResource('novedades', NovedadController::class);

Route::apiResource('tipo-vehiculo', TipoVehiculoController::class);

Route::get('/servicios/tipo-vehiculo/{idTipoVehiculo}', [ServicioController::class, 'getByTipoVehiculo']);
Route::apiResource('servicios', ServicioController::class);
Route::apiResource('planes', PlanController::class);
Route::apiResource('metodos-pago', MetodoPagoController::class);
Route::get('/comprobantes-pago/reserva/{idReserva}', [ComprobantePagoController::class, 'show']);
Route::apiResource('comprobantes-pago', ComprobantePagoController::class);
