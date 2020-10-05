<?php

namespace App\Http\Controllers\Backend;

use App\Artist;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class
MyProjectsController extends Controller
{
    public function index_artist(){

        $artist = Artist::where('user_id',auth()->user()->id)->with('users','countries','projects')->first();
        $projects_revision = Artist::where('user_id',auth()->user()->id)->with(
            [   'users',
                'countries',
                'projects' => function ($q){
                    $q->select('*')
                        ->where('status',Project::REVISION)
                        ->OrWhere('status',Project::PREAPPROVAL);
                }
            ])->latest()
            ->first();
        $projects_approv_published = Artist::where('user_id',auth()->user()->id)->with(
            [   'users',
                'countries',
                'projects' => function ($q){
                    $q->select('*')
                        ->where('status',Project::APPROVAL);
                }
            ])->latest()
            ->first();
        $projects_rejected = Artist::where('user_id',auth()->user()->id)->with(
            [   'users',
                'countries',
                'projects' => function ($q){
                    $q->select('*')
                        ->where('status',Project::REJECTED);
                }
            ])->latest()
            ->first();

        return view('backend.profile.my-projects',compact('artist','projects_revision','projects_approv_published','projects_rejected'));
    }


    public function config_profile_artist(){
        $artist = Artist::where('user_id',auth()->user()->id)->with('users','countries','projects')->first();

        return view('backend.profile.config-artist-profile',compact('artist'));
    }
}
