<?php

namespace App\Http\Middleware;

use Closure;

class ManagePermisos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->roles[0]->rol == "Manage"){
            return $next($request);
        }else{
            return back()->with('eliminar', __('no_permisos'));
        }
    }
}
