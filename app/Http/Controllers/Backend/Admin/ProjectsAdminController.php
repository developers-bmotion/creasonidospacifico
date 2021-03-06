<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Artist;
use App\Category;
use App\EndProject;
use App\Mail\ArtistProjectPreAprov;
use App\Mail\ArtistProjectRejected;
use App\Mail\AspiringCorrection;
use App\Mail\AssignProjectManager;
use App\Mail\NewProjectArtist;
use App\Management;
use App\Project;
use App\Review;
use App\User;
use Carbon\Carbon;
use foo\Foo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LastCalification;
use App\Mail\ArtistProjectRevision;
use App\SecondStage;
use Illuminate\Support\Facades\DB;

class ProjectsAdminController extends Controller
{
    public function index()
    {
        return view('backend.admin.projects-admin');
    }

    public function table_projects(Request $request)
    {
        $users = User::where('id', \Auth::user()->id)->with(['roles'])->first();
        $rol = array_pluck($users->roles, 'rol');
        if (in_array('Subsanador', $rol)) {
            // dd('asa');
            $project = Project::whereIn('status', [1, 4, 5, 6, 7])->with([
                'artists',
                'category',
                'artists.users',
                'artists.personType'
            ]);
            if ($request->input("tipoProyecto")) {
                $project->where('status', "=", $request->input("tipoProyecto"));
            }


        } else {

            $project = Project::with([
                'artists',
                'category',
                'artists.users',
                'artists.personType'
            ]);
            if ($request->input("tipoProyecto")) {
                // dd($request);
                $project->where('status', "=", $request->input("tipoProyecto"));
            }
        }
        // dd($project);
        return datatables()->of($project)->toJson();
    }

    public function table_projects_approved(Request $request)
    {
        $project = Project::with([
            'artists',
            'category',
            'artists.users'
        ])->whereIn('status', [Project::APPROVAL]);
        // ])->whereIn('status', [Project::APPROVAL, Project::PENDING, Project::NOPUBLISHED]);
        return datatables()->of($project)->toJson();
    }

    public function table_managements()
    {
        $management = Management::with('users', 'categories')->get();
        // dd($management);
        return datatables()->of($management)->toJson();
    }

    public function send_project_management(Request $request)
    {
        //En la consola de el navegador se visualizan los datos que se envian

//        /*$dateNow = date('Y-m-d');*/
//        $week = date("Y-m-d",strtotime($dateNow."+ 2 week"));

        $idProject = $request->input('project');
        $project = Project::where('id', $idProject)->with('artists')->first();
        $data = Management::whereHas('categories', function ($q) use ($project) {
            $q->where('categories.id', $project->category_id);
        })->with('categories')->get();

        if ($this->siPuedeAsignarProyectoCurador($data)) {
            $this->asignarProyectoCurador($data, $idProject);

        } else {
            foreach ($data as $key => $user) {
                $management = Management::where('user_id', $user['user_id'])->update(["tipoCurador" => 1]);
            }

            $data = Management::whereHas('categories', function ($q) use ($project) {
                $q->where('categories.id', $project->category_id);
            })->with('categories')->first();

            $project = Project::where('id', $idProject)->with('artists')->first();
            $management = Management::where('user_id', $data->user_id)->first();
            // dd($user_manament);
            $project->management()->attach($management->id);
            $project->status = 7;
            $project->save();
            $management->update([
                'tipoCurador' => 2
            ]);
            /*$this->asignarProyectoCurador($data[0], $idProject);*/
            $user_manament = User::where('id', $data->user_id)->first();
            $artist_pro = User::where('id', $project->artists[0]->user_id)->first();
            $artist = Artist::where('user_id', $artist_pro->id)->with('users')->first();
            \Mail::to($artist->users->email)->send(new ArtistProjectPreAprov($project, $artist->users->name));
            \Mail::to($user_manament->email)->send(new AssignProjectManager($project->title, $user_manament, $artist));
        }


        // $project->management()->attach($management->id);
        // $reviews = Review::create([
        //    'project_id' => $project->id,
        //     'user_id' => $user['user_id'],
        //     'end_time' => $week
        // ]);
        // }
        // $statusProject = Project::where('id', $request->input('project'))->update(array('status' => 7));
        return '{"status":200, "msg":"' . __('send_project_management') . '"}';

    }

    public function siPuedeAsignarProyectoCurador($data)
    {
        foreach ($data as $key => $user) {
            if ($user['tipoCurador'] == 1) {

                return true;
            }
        }
    }

    public function asignarProyectoCurador($data, $idProject)
    {

        $project = Project::where('id', $idProject)->with('artists')->first();

        foreach ($data as $key => $user) {
            $management = Management::where('user_id', $user['user_id'])->first();
            /*dd($management);*/
            if ($user['tipoCurador'] == 1) {
                $project->management()->attach($management->id);
                $project->status = 7;
                $project->save();
                $management->update([
                    'tipoCurador' => 2
                ]);
                $user_manament = User::where('id', $user['user_id'])->first();
                $artist_pro = User::where('id', $project->artists[0]->user_id)->first();
                $artist = Artist::where('user_id', $artist_pro->id)->with('users')->first();
                \Mail::to($artist->users->email)->send(new ArtistProjectPreAprov($project, $artist->users->name));
                \Mail::to($user_manament->email)->send(new AssignProjectManager($project->title, $user_manament, $artist));
                return;
            }
//
        }

        // $user_manament=User::where('id',$data->user_id)->first();
        // $artist_pro = User::where('id',$project->artists[0]->user_id)->first();
        // $artist= Artist::where('user_id',$artist_pro->id)->with('users')->first();
        // return \Mail::to($artist->users->email)->send(new ArtistProjectPreAprov($project,$artist->users->name));
        // \Mail::to($user_manament->email)->send(new AssignProjectManager($project->title,$user_manament,$artist));
        // $statusProject = Project::where('id', $idProject)->update(array('status' => 7));
        // return '{"status":200, "msg":"'.__('send_project_management').'"}';

    }

    public function rejected_project(Request $request)
    {
        $id = $request->get('rejected');
        $rejected_project = Project::where('id', $id)->update([
            'status' => 5
        ]);
        $project = Project::where('id', $id)->with('artists.users')->first();

        // $artistSendEmail = \Mail::to($project->artists[0]->users->email)->send(new ArtistProjectRejected($project, $project->artists[0]->users->name));

        alert()->success(__("proyecto_rechazado"), __('Ok'))->autoClose(3000);

        return back();
    }

    public function finalist_project(Request $request)
    {
        $id = $request->get('idProject');
        $finalist = $request->get('finalist');
//        $finalist_project = SecondStage::where('project_id', $id)->update([
//            'finalist' => $finalist
//        ]);
        $project = Project::where('id', $id)->update([
            'third_curaduria' => $finalist
        ]);
        // $project = Project::where('id', $id)->with('artists.users')->first();

        // $artistSendEmail = \Mail::to($project->artists[0]->users->email)->send(new ArtistProjectRejected($project, $project->artists[0]->users->name));

        alert()->success(__("Cambio exitoso"), __('Ok'))->autoClose(3000);

        return back();
    }

    public function sacar_cien(Request $request){
        $id = $request->get('idProject');
        $finalist = $request->get('valSacarCien');
        $finalist_project = SecondStage::where('project_id', $id)->update([
            'finalist' => $finalist
        ]);
        // $project = Project::where('id', $id)->with('artists.users')->first();

        // $artistSendEmail = \Mail::to($project->artists[0]->users->email)->send(new ArtistProjectRejected($project, $project->artists[0]->users->name));

        alert()->success(__("Cambio exitoso"), __('Ok'))->autoClose(3000);

        return back();
    }

    public function agregar_tercera_curaduria(Request $request){
        $id = $request->get('idProject');
        $valueAgregarTerceraCuraduria = $request->get('valAgregarTerceraCuraduria');
        $finalist_project = Project::where('id', $id)->update([
            'third_curaduria' => $valueAgregarTerceraCuraduria
        ]);
        alert()->success(__("Cambio exitoso"), __('Ok'))->autoClose(3000);

        return back();
    }

    public function finalist_project_yuri(Request $request)
    {
        $id = $request->get('idProject');
        $finalist = $request->get('finalist');
        $ganador = $request->get('ganadores');
        // dd($ganador);
        if($ganador != null){
            $finalist_project = Project::where('id', $id)->update([
                'ganadores' => $ganador,
            ]);
        }else{

            $finalist_project = LastCalification::where('project_id', $id)->update([
                'finalist' => $finalist,
            ]);
        }
        // $project = Project::where('id', $id)->with('artists.users')->first();

        // $artistSendEmail = \Mail::to($project->artists[0]->users->email)->send(new ArtistProjectRejected($project, $project->artists[0]->users->name));

        // alert()->success(__("Cambio exitoso"), __('Ok'))->autoClose(3000);

        return back();
    }

    public function pediente_soporte_project(Request $request)
    {
        $id = $request->get('pendiente_soporte');
        $rejected_project = Project::where('id', $id)->update([
            'status' => 4
        ]);

        alert()->success("Propuesta enviada a soporte", __('Ok'))->autoClose(3000);

        return back();
    }
    public function revision_project(Request $request)
    {

        $id = $request->input('project');
        $tipoRevision = $request->input('tipoRevision');

        if ($tipoRevision == 0) {
            $nowDate = Carbon::now();
            $dateNow = Carbon::parse($nowDate);
            $holidays = [
                "2020-11-14", "2020-11-15", "2020-11-16",
                "2020-11-21", "2020-11-22", "2020-11-28",
                "2020-11-29", "2020-12-05", "2020-12-06",
                "2020-12-08", "2020-12-12", "2020-12-13"
            ];

            $date = Carbon::now();
            $MyDateCarbon = Carbon::parse($date);

            $MyDateCarbon->addWeekdays(3);

            for ($i = 1; $i <= 3; $i++) {

                if (in_array(Carbon::parse($date)->addWeekdays($i)->toDateString(), $holidays)) {

                    $MyDateCarbon->addDay();

                }
            }
            $projectDate = Project::where('id', $id)->update([
                'timezone' => config('app.timezone'),
                'original_datetime' => $dateNow,
                'published_at' => $MyDateCarbon,
                'rejected' => '1'
            ]);
        }
        $revision_project = Project::where('id', $id)->update([
            'status' => 4,
        ]);

        $project = Project::where('id', $id)->with('artists.users')->first();
        DB::table('history_revisions')->insert([
            'user_id' => auth()->user()->id,
            'project_id' => $id,
            'observation' => $request->input('observation')
        ]);
        if($tipoRevision == 0){
            $artistSendEmail = \Mail::to($project->artists[0]->users->email)->send(new ArtistProjectRevision($project->title, $project->artists[0]->users->name, $request->input('observation'), $MyDateCarbon->formatLocalized('%A %d de %B de %Y %H:%M:%S')));

        }else if($tipoRevision == 1){
            $artistSendEmail = \Mail::to('developer@bmotion.co')->send(new ArtistProjectRevision($project->title, $project->artists[0]->users->name, $request->input('observation'), Carbon::today()));

        }else if($tipoRevision == 2){
            Project::where('id', $id)->update([
                'rejected' => '0',
                'status' => 7
            ]);
            DB::table('history_revisions')->where('project_id', $id)->update([
                    'state' => 2
            ]);
            \Mail::to($project->artists[0]->users->email)->send(new AspiringCorrection($project->artists[0]->users->name, $project->artists[0]->users->last_name, $project->title, $request->input('observation')));
        }

        // alert()->success( 'Enviado a revisión',__('Ok'))->autoClose(3000);

        return '{"status":200, "msg":"Mensaje enviado"}';
    }
}
