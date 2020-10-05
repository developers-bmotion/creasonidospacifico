<?php

namespace App\Http\Controllers\Backend;

use App\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackingsMadeController extends Controller
{
    public function index_artist(){
        $artist = Artist::where('user_id',auth()->user()->id)->with('users','countries','projects')->first();

        return view('backend.profile.backings-made',compact('artist'));
    }
}
