<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\AssuntoController;

#Route::get('/', function () {
#    return view('welcome');
#});

Route::resource('livros', LivroController::class);
#Route::resource('autores', AutorController::class);
Route::resource('assuntos', AssuntoController::class);

Route::resource('autores', AutorController::class)->parameters([
    'autores' => 'autor',
]);

Route::get('/', [LivroController::class, 'showroom'])->name('livros.showroom');


