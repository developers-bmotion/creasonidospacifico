<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AccesoMiddleware
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
        if (Auth::user()) {
            if (Auth::user()->state == 1) {
                return $next ($request);
            }else{
                $msg = "No tiene permisos para acceder, consulte con el administrador";
                Auth::logout();
                return back()->with('message', $msg);
            }
        }
    }
}
