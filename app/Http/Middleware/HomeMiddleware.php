<?php

namespace App\Http\Middleware;

use App\Artist;
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
            $artist=Artist::where('user_id', '=', auth()->user()->id )->first();
            if ($artist->document_type == null){
                return redirect("/dashboard/form-register");
            }else{
                return redirect("/dashboard/profile");
            }
        }else if(auth()->user()->roles[0]->rol == "Gestor"){
            return redirect("/dashboard/profile-gestor/".auth()->user()->slug);

        }else if (auth()->user()->roles[0]->rol == "Manage"){
            return redirect("/dashboard");
        }else if(auth()->user()->roles[0]->rol = "Subsanador"){
            return redirect("/dashboard");
        }else if(auth()->user()->roles[0]->rol = "Admin"){
            return redirect("/dashboard");
        }
        return $next($request);
    }
}
