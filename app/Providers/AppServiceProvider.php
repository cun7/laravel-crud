<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use App\Models\Persona;
use App\Policies\PersonaPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Usar Bootstrap para la paginación
        //Paginator::useBootstrap();
        Paginator::useBootstrapFive();
        
    }

    //Registrar Policy (Laravel 11)
    protected $policies = [
        Persona::class => PersonaPolicy::class,
    ];
}
