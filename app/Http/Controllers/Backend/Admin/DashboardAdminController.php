<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Artist;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{

    public function AspirantsAll(Request $request){

        $listAspirant = Artist::with('users','personType','projects','documentType','city.departaments')->get();


        if ($request->input("tipoProyecto")){
            $project=Project::where('artist_id',$listAspirant->id);
            $listAspirant = Artist::with('users','personType','projects','documentType','city.departaments')->get();
        }

        // $project = Project::with([
        //     'artists',
        //     'category',
        //     'artists.users',
        //     'artists.personType',
        //     'artists.documentType'
        //     ]);
        //     if ($request->input("tipoProyecto")){
        //         // dd($request);
        //     $project->where('status', "=", $request->input("tipoProyecto"));
        // }

        return datatables()->of($listAspirant)->toJson();


        // old
        // $project = \App\User::whereNotNull('last_name')->has('artista')->with('artista.projects','artista.documentType','artista.city.departaments','artista.personType');

        // if ($request->input("tipoProyecto")){
        //     $project->where('status', "=", $request->input("tipoProyecto"));
        // }
        // dd($project);
        // if ($request->input("tipoProyecto")){
        //     // dd($project);
        //     $project = \App\User::whereNotNull('last_name')->has('artista')->with(['artista.projects' => function($q){

        //         return $q->where('status',$request->input("tipoProyecto"));
        //     },'artista.documentType','artista.city.departaments','artista.personType'])->get();
        // }
        // dd($project);
        // return datatables()->of($project)->toJson();
    }
    public function showProyect (Request $request){

        $data = Project::select(array(
            DB::raw('count(id) as a, DATE_FORMAT(created_at, "%Y-%m-%d") as y')
        ))->where('status',Project::REVISION);

        if ($request->get('fechaInicio') && $request->get('fechaFin')) {
            $fi = \Carbon\Carbon::parse($request->get('fechaInicio'))->toDateString();
            $ff = \Carbon\Carbon::parse($request->get('fechaFin'))->toDateString();

            if ($fi === $ff){
				$data = Project::select(array(
					DB::raw('count(id) as a, DATE_FORMAT(created_at, "%Y-%m-%d %HH") as y')
				))->where('status',Project::REVISION);
			}

            $data = $data->whereDate("created_at",">=",$fi." 00:00:00")->whereDate("created_at", "<=", $ff." 11:59:59");
        }

        return json_encode($data->groupBy("y")->get());
    }

    public function showTopCountry(){
        $data = DB::table('artists')
            ->join('artist_projects', 'artists.id', '=', 'artist_projects.artist_id')
            ->join('ciudad', 'artists.location_id', '=', 'ciudad.id')
            ->selectRaw('ciudad.descripcion as label, count(artist_projects.project_id) as data')
            ->groupBy('ciudad.id')
            ->orderBy('data', 'desc')
            ->limit(5)
            ->get();
        return json_encode($data);
    }
    // public function showTopCountry(){
    //     $data = DB::table('artists')
    //         ->join('artist_projects', 'artists.id', '=', 'artist_projects.artist_id')
    //         ->join('countries', 'artists.location_id', '=', 'countries.id')
    //         ->selectRaw('countries.country as label, count(artist_projects.project_id) as data')
    //         ->groupBy('countries.id')
    //         ->orderBy('data', 'desc')
    //         ->limit(5)
    //         ->get();
    //     return json_encode($data);
    // }

    public function countProjects($id){

        $count=Project::where('status', $id)->count();
    }




}
