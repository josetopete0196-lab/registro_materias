<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/materias', fn () => view('materias.mostrar', ['materias' => []]));
Route::get('/materias/registrar', fn () => view('materias.registrar'));
Route::get('/materias/eliminar', fn () => view('materias.eliminar', ['materias' => []]));
