<?php

namespace App\Http\Controllers\Backend\Manage;

use App\Management;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LastCalification;
use App\Project;
use App\SecondStage;
use Illuminate\Support\Facades\DB;

class ProjectsManageController extends Controller
{
    public function index(){
        return view('backend.management.projects_manage');
    }

    public function table_projects(Request $request){
        $project = \App\Project::where('status','!=',1)->whereHas('management', function ($query) {
            $query->where('managements.user_id', '=', auth()->user()->id);
        })->with('category','artists.users', 'reviews');
        if ($request->input("tipoProyecto")){
            $project->where('status', "=", $request->input("tipoProyecto"));
        }
     return datatables()->of($project)->toJson();
    }

    public function table_project_rating(Request $request){

        $project = \App\Project::where('status','!=',1)->whereHas('management', function ($query) {
            $query->where('managements.user_id', '=', auth()->user()->id);
        })->with('category','artists.users', 'reviews');
        if ($request->input("tipoProyecto")){
            $project->where('status', "=", $request->input("tipoProyecto"));
        }
        return datatables()->of($project)->toJson();
    }

    public function add_review(Request $request){

        // return $request;
        $review = new Review;
        $review->project_id = $request->idProject;
        $review->user_id = auth()->user()->id;
        $review->lyric = $request->criterio_4; //Calidad del repertorio escogido:
        $review->melody_rhythm = $request->criterio_1; //Aspectos técnicos musicales:
        $review->arrangements = $request->criterio_3; //Calidad interpretativa:
        $review->originality = $request->criterio_2; //aporte creativo
        $review->comment = $request->comment;
        $review->save();

        Project::where('id', $request->idProject)->update([
            'status' => 2
        ]);

        return '{"status":200, "msg":"Propuesta musical calificada"}';
    }

    public function add_review_second(Request $request){

        // return $request;
        // dd('holas');
        $review = new SecondStage();
        $review->project_id = $request->idProject;
        $review->user_id = auth()->user()->id;
        $review->lyric = $request->criterio_4; //Calidad del repertorio escogido:
        $review->melody_rhythm = $request->criterio_1; //Aspectos técnicos musicales:
        $review->arrangements = $request->criterio_3; //Calidad interpretativa:
        $review->originality = $request->criterio_2; //aporte creativo
        $review->trajectory = $request->criterio_5; //trayectoria
        $review->project_interest = $request->criterio_6; //interes comercial del proyecto
        $review->comment = $request->comment;
        $review->save();

        // return $request;

        Project::where('id', $request->idProject)->update([
            'status' => 2
        ]);

        return '{"status":200, "msg":"Propuesta musical calificada"}';
    }

    public function add_review_yuri(Request $request){

        // return $request;
        // dd('holas');
        $review = new LastCalification();
        $review->project_id = $request->idProject;
        $review->user_id = auth()->user()->id;
        $review->musicality = $request->criterio_1; //musicalidad
        $review->sonority = $request->criterio_2; //sonoridad:
        $review->coloratura = $request->criterio_3; //coloratura:
        $review->spokesperson = $request->criterio_4; //voceria del proyecto
        $review->finalist = 1; //interes comercial del proyecto
        $review->comment = $request->comment;
        $review->save();

        // return $request;

        // Project::where('id', $request->idProject)->update([
        //     'status' => 2
        // ]);

        return '{"status":200, "msg":"Propuesta musical calificada"}';
    }
    public function add_review_yuri_final(Request $request){

        // return $request;
        // dd('holas');
        $review = new LastCalification();
        $review->project_id = $request->idProject;
        $review->user_id = auth()->user()->id;
        $review->musicality = $request->criterio_1; //musicalidad
        $review->sonority = $request->criterio_2; //sonoridad:
        $review->coloratura = $request->criterio_3; //coloratura:
        $review->spokesperson = $request->criterio_4; //voceria del proyecto
        $review->finalist = 2; //interes comercial del proyecto
        $review->comment = $request->comment;
        $review->save();

        // return $request;

        Project::where('id', $request->idProject)->update([
            'ganadores' => 1
        ]);

        return '{"status":200, "msg":"Propuesta musical calificada"}';
    }

    public function history_review($id){
        $reviews = Review::where('project_id', $id)->with('projects.category')->get();
        return response()->json($reviews);
    }

    public function history_review_second($id){
        $reviews = SecondStage::where('project_id', $id)->with('projects.category')->first();
        return response()->json($reviews);
    }
}
