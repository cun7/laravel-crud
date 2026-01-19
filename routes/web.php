<?php

use Illuminate\Support\Facades\Route;

Route::get('/vista', function () {
    //return view('welcome');
    //return "Hola desde laravel";
    return view("hola");
});

use App\Http\Controllers\PersonaController;

//Mostrar formulario crear
Route::get('/personas.create', [PersonaController::class, 'create'])->name('personas.create');

//Mostrar listado
Route::get('/personas',[PersonaController::class, 'index'])->name('personas.index');

//Guardar datos
Route::post('/personas',[PersonaController::class, 'store'])->name('personas.guardar');

//Formulario editar
Route::get('/personas/{id}/edit', [PersonaController::class, 'edit'])->name('personas.edit');

//Actualizar
Route::put('/personas/{id}', [PersonaController::class, 'update'])->name('personas.actualizar');

//Eliminar
Route::delete('/personas/{id}', [PersonaController::class, 'destroy'])->name('personas.eliminar');
