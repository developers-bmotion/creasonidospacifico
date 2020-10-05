<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Artist;
use App\EndProject;
use App\Mail\ArtistProjectPreAprov;
use App\Mail\ArtistProjectRejected;
use App\Mail\AssignProjectManager;
use App\Mail\NewProjectArtist;
use App\Management;
use App\Project;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ArtistProjectRevision;
use Illuminate\Support\Facades\DB;

class ProjectsAdminController extends Controller
{
    public function index(){
        return view('backend.admin.projects-admin');
    }

    public function table_projects(Request $request){
        $users = User::where('id', \Auth::user()->id)->with(['roles'])->first();
        $rol = array_pluck($users->roles, 'rol');
        if (in_array('Subsanador', $rol)){
            // dd('asa');
            $project = Project::whereIn('status',[1,4,5,6,7])->with([
                'artists',
                'category',
                'artists.users'
                ]);
                if ($request->input("tipoProyecto")){
                $project->where('status', "=", $request->input("tipoProyecto"));
            }


        }else{

            $project = Project::with([
                'artists',
                'category',
                'artists.users'
                ]);
                if ($request->input("tipoProyecto")){
                    dd($request);
                $project->where('status', "=", $request->input("tipoProyecto"));
            }
        }
        return datatables()->of($project)->toJson();
    }

    public function table_projects_approved(Request $request){
        $project = Project::with([
            'artists',
            'category',
            'artists.users'
        ])->whereIn('status', [Project::APPROVAL]);
        // ])->whereIn('status', [Project::APPROVAL, Project::PENDING, Project::NOPUBLISHED]);
        return datatables()->of($project)->toJson();
    }

    public function table_managements(){
        return datatables()->of(Management::with('users','categories')->get())->toJson();
    }
    public function send_project_management(Request $request){
        //En la consola de el navegador se visualizan los datos que se envian
        $data = $request->input("users");
        $dateNow = date('Y-m-d');
        $week = date("Y-m-d",strtotime($dateNow."+ 2 week"));
        $project = Project::where('id', $request->input('project'))->with('artists')->first();
        $end_project = EndProject::insert(['project_id' => $project->id,'end_time' => $week]);
        $end_time = EndProject::select('end_time')->where('project_id',$project->id)->first();
        $img_artist = User::where('id',$project->artists[0]->user_id)->first();
        $artist= Artist::where('user_id',$img_artist->id)->with('users')->first();
        foreach ($data as $key => $user){
            $nickname = $project->artists[0]->nickname;
            //echo $user['email']."  ".$project->artists[0]->nickname."\n";
            $management = Management::where('user_id',$user['user_id'])->first();
            // se envia email a los managements
            // \Mail::to($user['email'])->send(new AssignProjectManager($project,$nickname,$end_time,$img_artist));
            $project->management()->attach($management->id);
            $reviews = Review::create([
               'project_id' => $project->id,
                'user_id' => $user['user_id'],
                'end_time' => $week
            ]);
        }
        $artistSendEmail = \Mail::to($artist->users->email)->send(new ArtistProjectPreAprov($project,$artist->users->name));
        $statusProject = Project::where('id', $request->input('project'))->update(array('status' => 7));
        return '{"status":200, "msg":"'.__('send_project_management').'"}';
    }

    public function rejected_project(Request $request){
        $id = $request->get('rejected');
        $rejected_project = Project::where('id',$id)->update([
            'status' => 5
        ]);
        $project = Project::where('id',$id)->with('artists.users')->first();

       $artistSendEmail = \Mail::to($project->artists[0]->users->email)->send(new ArtistProjectRejected($project,$project->artists[0]->users->name));

        alert()->success(__("proyecto_rechazado"),__('Ok'))->autoClose(3000);

        return  back();
    }

    public function revision_project(Request $request){
        $id = $request->input('project');
        $revision_project = Project::where('id',$id)->update([
            'status' => 4
            ]);
            // dd($request);
        $project = Project::where('id',$id)->with('artists.users')->first();

       $artistSendEmail = \Mail::to($project->artists[0]->users->email)->send(new ArtistProjectRevision($project,$project->artists[0]->users->name, $request->input('observation')));

        // alert()->success( 'Enviado a revisión',__('Ok'))->autoClose(3000);

        return  '{"status":200, "msg":"Mensaje enviado"}';
    }
}
