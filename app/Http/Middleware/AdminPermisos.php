<?php

namespace App\Http\Middleware;

use Closure;

class AdminPermisos
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
        if (auth()->user()->roles[0]->rol == "Admin"|| auth()->user()->roles[0]->rol == "Subsanador"){
            return $next ($request);
        }else{
            return back()->with('eliminar', __('no_permisos'));
        }

    }
}
