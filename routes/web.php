<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MateriaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/materias', [MateriaController::class, 'index']);
Route::get('/materias/registrar', [MateriaController::class, 'create']);
Route::post('/materias', [MateriaController::class, 'store']);
Route::get('/materias/eliminar', [MateriaController::class, 'eliminar']);
Route::delete('/materias/{id}', [MateriaController::class, 'destroy']);
