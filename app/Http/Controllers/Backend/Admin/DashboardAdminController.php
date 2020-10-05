<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
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
