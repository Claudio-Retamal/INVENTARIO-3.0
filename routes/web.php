<?php

use App\Http\Controllers\Equipos\EquiposController;
use App\Http\Controllers\Categorias\CategoriasController;
use App\Http\Controllers\Personal\PersonalController;
use App\Http\Controllers\Prestacion\PrestacionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Sala\SalasController;
use App\Models\Equipos;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
    
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/Categorias', [CategoriasController::class, 'index'])->name('Categorias');
    Route::post('/Categorias-store', [CategoriasController::class, 'store'])->name('Categorias-store');
    Route::get('/Categorias-editar{id}', [CategoriasController::class, 'edit'])->name('Categorias-editar');
    Route::post('/Categorias-update{id}', [CategoriasController::class, 'update'])->name('Categorias.update');

    Route::post('/Categorias-excel', [CategoriasController::class, 'import'])->name('Categorias-excel');




    Route::get('/Personal', [PersonalController::class, 'index'])->name('Personal');
    Route::post('/Personal-store', [PersonalController::class, 'store'])->name('Personal-store');
    Route::get('/Personal-editar/{id}', [PersonalController::class, 'edit'])->name('Personal-editar');
    Route::post('/Personal-update/{id}', [PersonalController::class, 'update'])->name('Personal-update');

    Route::post('/Personal-excel', [PersonalController::class, 'import'])->name('Personal-excel');
    Route::post('/Cargo-store', [PersonalController::class, 'cargo'])->name('Cargo-store');


  
    Route::get('/Salas', [SalasController::class, 'index'])->name('Salas');
    Route::post('/Salas-store', [SalasController::class, 'store'])->name('Salas-store');
    Route::get('/Salas-editar/{id}', [SalasController::class, 'edit'])->name('Salas-editar');
    Route::post('/Salas-update/{id}', [SalasController::class, 'update'])->name('Salas-update');


    Route::get('/Equipos', [EquiposController::class, 'index'])->name('Equipos');
    Route::post('/Equipos-store', [EquiposController::class, 'store'])->name('/Equipos-store');
    Route::get('/Equipos-editar/{id}', [EquiposController::class, 'edit'])->name('Equipos-editar');
    Route::post('/Equipos-update/{id}', [EquiposController::class, 'update'])->name('Equipos.update');
    Route::post('/Equipos-excel', [EquiposController::class, 'import'])->name('Equipos-excel');


    Route::get('/Prestacion', [PrestacionController::class, 'index'])->name('Prestacion');
    Route::post('/Prestacion_store', [PrestacionController::class, 'store'])->name('Prestacion_store');
    Route::get('/Prestacion-show', [PrestacionController::class, 'show'])->name('Prestacion-show');

    Route::get('/Prestacion-editar/{id}', [PrestacionController::class, 'edit'])->name('prestacion.edit');
    Route::get('/Prestacion_delete/{id}', [PrestacionController::class, 'destroy'])->name('prestacion.destroy');

    Route::put('/Prestacion_update/{id}', [PrestacionController::class, 'update'])->name('prestacion.update');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
