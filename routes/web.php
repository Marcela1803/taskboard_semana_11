<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComercioController;
use App\Http\Controllers\TransaccionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/registro', [AuthController::class, 'mostrarRegistro'])->name('registro');
    Route::post('/registro', [AuthController::class, 'registrar'])->name('registro.store');

    Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

   
    Route::get('/comercios', [ComercioController::class, 'index'])->name('comercios.index');
    Route::get('/comercios/{comercio}', [ComercioController::class, 'show'])->name('comercios.show');

   
    Route::get('/transacciones/create', [TransaccionController::class, 'create'])->name('transacciones.create');
    Route::post('/transacciones', [TransaccionController::class, 'store'])->name('transacciones.store');
    
    Route::get('/transacciones/{transaccion}/edit', [TransaccionController::class, 'edit'])->name('transacciones.edit');
    Route::put('/transacciones/{transaccion}', [TransaccionController::class, 'update'])->name('transacciones.update');
    Route::delete('/transacciones/{transaccion}', [TransaccionController::class, 'destroy'])->name('transacciones.destroy');
    
    
    Route::patch('/transacciones/{transaccion}/mover/{estado}', [TransaccionController::class, 'moverEstado'])->name('transacciones.mover');
});