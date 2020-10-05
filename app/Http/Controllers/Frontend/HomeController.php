<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $projects = Project::withCount(['artists'])
            ->with('category')
            ->where('status',4)
            ->latest()
            ->get();
        $categories = Category::select('category', 'id')->get();
        $projects_slider = Project::with('artists')->take(3)->where('status',4)->get();

        return view('frontend.home.home',compact('categories','projects','projects_slider'));
    }

    public function nosotros(){
        return view('frontend.nosotros.nosotros');
    }

    public function artist(){
        $projects = \App\Project::
        where('status',Project::PUBLISHED)
        ->with("category","artists",'artists.users', 'donations')->latest()->paginate(8);
        $projects->setCollection( \App\Project::card($projects->getCollection()) );
        $user = \App\User::first();
        $categories = Category::select('*')->get();
        return view('frontend.artist.artist', compact('categories', 'projects','user'));
    }

    public function backer(){
        return view('frontend.backer.backer');
    }
}
