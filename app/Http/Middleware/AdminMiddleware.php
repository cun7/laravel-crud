<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Si no está logueado o no es admin -> accseso denegado
        //if(!auth()->check() ||!auth()->user()->isAdmin()){
            //abort(403, 'No autoriado');
        //}
        

        /*
        $user = auth()->user();
        if(!$user || !$user->isAdmin()){
            abort(403, 'No autorizadoo');
        }
        */

        //Solo admin puede eliminar
         /** @var \App\Models\User $user */
         $user = Auth::user();
         if(!$user->isAdmin()){
            abort(403, 'No autorizadoo');
         }

        return $next($request);
    }
}
