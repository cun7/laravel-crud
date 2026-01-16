<?php

use Illuminate\Support\Facades\Route;

Route::get('/vista', function () {
    //return view('welcome');
    //return "Hola desde laravel";
    return view("hola");
});

use App\Http\Controllers\PersonaController;

//Mostrar formulario
Route::get('/personas.create', [PersonaController::class, 'create'])->name('personas.create');

//Mostrar listado
Route::get('/personas',[PersonaController::class, 'index'])->name('personas.index');

//Guardar datos
Route::post('/personas',[PersonaController::class, 'store'])->name('personas.guardar');
