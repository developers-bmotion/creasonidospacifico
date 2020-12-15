<?php

namespace App\Http\Controllers\Backend\Manage;

use App\Management;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    public function history_review($id){
        $reviews = Review::where('project_id', $id)->with('projects.category')->get();
        return response()->json($reviews);
    }
    public function history_review_second($id){
        $reviews = SecondStage::where('project_id', $id)->with('projects.category')->first();
        return response()->json($reviews);
    }

    public function add_review_second(Request $request){

        // return $request;
        // dd('holas');
        $review = new SecondStage;
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
}
