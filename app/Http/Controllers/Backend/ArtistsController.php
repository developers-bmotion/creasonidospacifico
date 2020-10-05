<?php

namespace App\Http\Controllers\Backend;

use App\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistsController extends Controller
{
    public function index(){

        return view('backend.artists.artists-all');
    }

    public function table_all_artists(){
        $artists = Artist::with('users','countries','levels')->get();
        return datatables()->of($artists)->toJson();
    }
}
