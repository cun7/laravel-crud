<?php

use Illuminate\Support\Facades\Route;

Route::get('/vista', function () {
    //return view('welcome');
    //return "Hola desde laravel";
    return view("hola");
});

use App\Http\Controllers\PersonaController;

//Ruta para mostrar listado de personas
Route::get('/personas',[PersonaController::class, 'index'])->name('personas.index');

//Ruta para mostrar formulario crear
Route::get('/personas.create', [PersonaController::class, 'create'])->name('personas.create');

//Ruta para guardar datos de la persona
Route::post('/personas',[PersonaController::class, 'store'])->name('personas.guardar');

//Ruta para mostrar formulario de edicción
Route::get('/personas/{id}/edit', [PersonaController::class, 'edit'])->name('personas.edit');

//Ruta para ctualizar (gurdar cambios)
Route::put('/personas/{id}', [PersonaController::class, 'update'])->name('personas.actualizar');

//Ruta para eliminar
Route::delete('/personas/{id}', [PersonaController::class, 'destroy'])->name('personas.eliminar');
