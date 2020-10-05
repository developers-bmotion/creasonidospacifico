<?php

namespace App\Http\Controllers\Backend\Manage;

use App\Management;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProjectsManageController extends Controller
{
    public function index(){
        return view('backend.management.projects_manage');
    }

    public function table_projects(Request $request){

        $project = \App\Project::where('status','!=',1)->whereHas('management', function ($query) {
            $query->where('managements.user_id', '=', auth()->user()->id);
        })->with('category','artists');
        if ($request->input("tipoProyecto")){
            $project->where('status', "=", $request->input("tipoProyecto"));
        }
     return datatables()->of($project)->toJson();
    }

    public function add_review(Request $request){
        $rating = $request->get('rating_input');
        $comment = $request->get('comment');
        $review = Review::where(['project_id' => $request->get('project_id'),'user_id' => auth()->user()->id])->update(array('rating' => $rating,'comment' => $comment));
        \Artisan::call('projects:close');
        return $review;
    }
}
