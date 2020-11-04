<?php

namespace App\Http\Middleware;

use App\Artist;
use Closure;

class ExistProjectArtist
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
        $artist = Artist::where('user_id', auth()->user()->id)->has('projects')->first();
        if(!$artist){
            return $next($request);
        }else{
            return redirect(route('profile.artist'))->with('existe_cancion','Sr/Sra '.auth()->user()->name.' '.auth()->user()->last_name.' usted ya tiene registrado una propuesta musical.');
        }

    }
}
