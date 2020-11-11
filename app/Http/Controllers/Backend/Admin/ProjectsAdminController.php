<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Artist;
use App\Category;
use App\EndProject;
use App\Mail\ArtistProjectPreAprov;
use App\Mail\ArtistProjectRejected;
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
use App\Mail\ArtistProjectRevision;
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

                $project->management()->attach($management->id);
                $management->update([
                    'tipoCurador' => 2
                ]);

            /*$this->asignarProyectoCurador($data[0], $idProject);*/
        }

        // $end_project = EndProject::insert(['project_id' => $project->id,'end_time' => $week]);
        // $end_time = EndProject::select('end_time')->where('project_id',$project->id)->first();
//        $img_artist = User::where('id',$project->artists[0]->user_id)->first();
//        $artist= Artist::where('user_id',$img_artist->id)->with('users')->first();
        // $nickname = $project->artists[0]->nickname;
        //echo $user['email']."  ".$project->artists[0]->nickname."\n";
        // $management = Management::where('user_id',$user['user_id'])->first();
        // se envia email a los managements
        // \Mail::to($user['email'])->send(new AssignProjectManager($project,$nickname,$end_time,$img_artist));
        // $project->management()->attach($management->id);
        // $reviews = Review::create([
        //    'project_id' => $project->id,
        //     'user_id' => $user['user_id'],
        //     'end_time' => $week
        // ]);
        // }
        // $artistSendEmail = \Mail::to($artist->users->email)->send(new ArtistProjectPreAprov($project,$artist->users->name));
        // $statusProject = Project::where('id', $request->input('project'))->update(array('status' => 7));
        // return '{"status":200, "msg":"'.__('send_project_management').'"}';

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
                $management->update([
                    'tipoCurador' => 2
                ]);
                return;
            }
//
        }

    }

    public function rejected_project(Request $request)
    {
        $id = $request->get('rejected');
        $rejected_project = Project::where('id', $id)->update([
            'status' => 8
        ]);
        $project = Project::where('id', $id)->with('artists.users')->first();

        $artistSendEmail = \Mail::to($project->artists[0]->users->email)->send(new ArtistProjectRejected($project, $project->artists[0]->users->name));

        alert()->success(__("proyecto_rechazado"), __('Ok'))->autoClose(3000);

        return back();
    }

    public function revision_project(Request $request)
    {

        $id = $request->input('project');

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

        $revision_project = Project::where('id', $id)->update([
            'status' => 4,
        ]);

        $project = Project::where('id', $id)->with('artists.users')->first();
        DB::table('history_revisions')->insert([
            'user_id' => auth()->user()->id,
            'project_id' => $id,
            'observation' => $request->input('observation')
        ]);
        $artistSendEmail = \Mail::to($project->artists[0]->users->email)->send(new ArtistProjectRevision($project->title, $project->artists[0]->users->name, $request->input('observation'), $MyDateCarbon->formatLocalized('%A %d de %B de %Y %H:%M:%S')));

        // alert()->success( 'Enviado a revisión',__('Ok'))->autoClose(3000);

        return '{"status":200, "msg":"Mensaje enviado"}';
    }
}
