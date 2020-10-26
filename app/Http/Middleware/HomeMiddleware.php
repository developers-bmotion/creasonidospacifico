<?php

namespace App\Http\Middleware;

use Closure;
use Request;

class HomeMiddleware
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
        if (Request::url() === '/') {
            return redirect("/login")->with('login', __('no_session'));
        }else if (auth()->user()->roles[0]->rol == "Artist"){
            return redirect("/dashboard/profile");
        }
        return $next($request);
    }
}
