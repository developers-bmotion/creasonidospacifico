<?php

namespace App\Http\Middleware;

use App\Artist;
use Closure;
use Request;

class RegisterArtist
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
        $artist=Artist::where('user_id', '=', auth()->user()->id )->first();
        // dd($artist->document_type);
        // if(Request::url() !== '/dashboard/form-register'){

        if($artist->document_type == null){

            return back()->with('registro','Debe registrarse primero');
            // return redirect('/dashboard/form-register');
        }else{
            return $next($request);
        }
    // }
        // dd($artist->document_type);
        // return $next($request);
    }
}
