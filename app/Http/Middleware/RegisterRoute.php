<?php

namespace App\Http\Middleware;

use Closure;

class RegisterRoute
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
        return redirect()->route('login')->with('message', 'El plazo para recibir propuestas terminó el 11 de diciembre de 2020 a las 6:00 pm. Siguenos en nuestras redes Instagram y Facebook como Crea Sonidos.');
    }
}
