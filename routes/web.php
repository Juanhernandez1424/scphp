<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('components.dashboard');
})->name('dashboard');

// Ruta principal para ver la lista/vista de reservas
Route::get('/reservas', function () {
    return view('reservas.reservas');
})->name('reservas');

// Ruta diferente para la vista del formulario de creación
Route::get('/reservas/crear', [ReservaController::class, 'create'])->name('reservas.create');

Route::get('/novedades-cliente', function(){
    return view('components.novedades-cliente');
})-> name('novedades-cliente');

Route::get('/novedades-interno', function(){
    return view('components.novedades-interno');
})-> name('novedades-interno');




// Route::view('/novedades', 'components.novedades')->name('novedades');
// Route::view('/novedades-cliente', 'components.novedades-cliente')->name('cliente');






Route::post('/logout', function () {
    return redirect('/');
})->name('logout');
