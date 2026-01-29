<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\http\Controllers\PersonaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Ruta para mostrar el listado de personas
Route::get('/personas', [PersonaController::class, 'index'])->name('personas.index');

//Ruta para mostrar el formulario crear
Route::get('/personas.create', [PersonaController::class, 'create'])->name('personas.create');

//Ruta para guardar datos de la persona
Route::post('/personas', [PersonaController::class, 'store'])->name('personas.guardar');

//Ruta para mostrar el formulario de edicción
Route::get('/personas.{id}.edit', [PersonaController::class, 'edit'])->name('personas.edit');

//Ruta para actualizar (guardar cambios)
Route::put('/personas/{id}', [PersonaController::class, 'update'])->name('personas.actualizar');

//Ruta para elimianar una persona
Route::delete('/personas/{id}', [PersonaController::class, 'destroy'])->name('personas.eliminar');



require __DIR__.'/auth.php';
