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

        echo $request;
        die();
        Review::create([
            'project_id' => $request->idProject,
            'user_id'=>auth()->user()->id,
            'lyric'=>$request->criterio_4, //Calidad del repertorio escogido:
            'melody_rhythm'=>$request->criterio_1, //Aspectos técnicos musicales:
            'arrangements'=>$request->criterio_3, //Calidad interpretativa:
            'originality'=> $request->criterio_2, //aporte creativo
            'comment'=>$request->comment
         ]);

        return $request;
    }
}
