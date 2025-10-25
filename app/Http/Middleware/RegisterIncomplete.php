<?php

namespace App\Http\Middleware;

use Closure;

class RegisterIncomplete
{
    /**
     * Handle an incoming request. register.incomplete
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       if ($request->user() && $request->user()->cod_confirmacion != null) {
            //la pagina de destino no debe mostrar una barra con todas las opciones
            \Auth::logout();
            $request->session()->flush();
            return view('register-sucessfull');
        }
    
        return $next($request);
    }
}
