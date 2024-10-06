<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\ReportController;

Route::resource('livros', LivroController::class);
Route::resource('assuntos', AssuntoController::class);
Route::resource('autores', AutorController::class)->parameters([
    'autores' => 'autor',
]);
Route::get('/', [LivroController::class, 'showroom'])->name('livros.showroom');
Route::get('/relatorio/autores', [ReportController::class, 'autores'])->name('relatorio.autores');;