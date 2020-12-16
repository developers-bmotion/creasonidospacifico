<?php

namespace App\Http\Controllers\Backend\Manage;

use App\Http\Controllers\Controller;
use App\Management;
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

    public function get_table_calification_two(Request $request){
        $manage = Management::where('user_id', auth()->user()->id)->first();
        $id_user = $request->input('id_user');
        $project = \App\Project::where('manager_id',$manage->id)->with('category','artists.users', 'reviews_second')->get();
        if ($request->input("tipoProyecto")){
            $project->where('status', "=", $request->input("tipoProyecto"));
        }
        return datatables()->of($project)->toJson();
    }
}
