<?php

namespace App\Http\Controllers\Backend\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageRatingController extends Controller
{
    public function table_project_rating(Request $request){

        $project = \App\Project::where('status','!=',1)->whereHas('management', function ($query) {
            $query->where('managements.user_id', '=', auth()->user()->id);
        })->with('category','artists.users', 'reviews');
        if ($request->input("tipoProyecto")){
            $project->where('status', "=", $request->input("tipoProyecto"));
        }
        return datatables()->of($project)->toJson();
    }
}
