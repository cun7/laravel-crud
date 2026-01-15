<?php

use Illuminate\Support\Facades\Route;

Route::get('/vista', function () {
    //return view('welcome');
    //return "Hola desde laravel";
    return view("hola");
});
