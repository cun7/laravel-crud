<?php

use Illuminate\Support\Facades\Route;

Route::get('/vista', function () {
    //return view('welcome');
    //return "Hola desde laravel";
    return view("hola");
});

use App\Http\Controllers\PersonaController;

Route::get('/personas',[PersonaController::class, 'index']);
Route::post('/guardar',[PersonaController::class, 'guardar']);
