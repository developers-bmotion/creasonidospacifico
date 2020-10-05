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
        }
        return $next($request);
    }
}
