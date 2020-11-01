<?php

namespace App\Http\Controllers\Backend;

use App\Artist;
use App\City;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {

        //ULTIMO PROYECTOS SEGUN SU ESTADO
//        $last_approved = Project::where('status',Project::APPROVAL)->with('artists')->take(2)->get();
//        $last_published = Project::where('status',Project::PENDING)->with('artists')->take(2)->get();
//        $last_rejected = Project::where('status',Project::REJECTED)->with('artists')->take(2)->get();
//        $last_revisions = Project::where('status',Project::REVISION)->with('artists')->take(2)->get();
//        $last_pre_approved = Project::where('status',Project::PREAPPROVAL)->with('artists')->take(2)->get();
//        // numero de proyectos por estado
//        $published = Project::where('status', 4)->with('artists')->count();
//        $rejected = Project::where('status', 5)->with('artists')->count();
//        $approved = Project::where('status', 3)->with('artists')->count();
//        $pre_approved = Project::where('status', 2)->with('artists')->count();
//
//        //ULTIMOS ARTISTAS REGISTRADOS
//        $last_artists = Artist::with('users')->latest()->take(5)->get();
        // $last_artists = Artist::with('users','location','countries')->latest()->take(5)->get();

        /*=============================================
           DATOS PARA LOS INFORMACIÓN DE REGISTROS
        =============================================*/
        $aspiranteRegistroCompleto = Artist::whereHas('projects')->count();
        $aspiranteRegistroSinCanción = $listAspirant = Artist::whereNotNull('document_type')->doesnthave('projects')->count();
        $aspirantessolocuenta = Artist::whereNull('nickname')->whereDoesntHave('projects')->count();
        $totalregistros = User::whereHas('roles', function ($q) {
            $q->where('rol', 'Artist');
        })->with('projects')->count();
        /*=============================================
           DATOS PARA LA INFORMACIÓN POR CIUDADES
        =============================================*/
        $ciudadesAspirantes = Artist::has('city')->with('city.departaments')->groupBy('cities_id')->get();

        $objetCiudades = new \stdClass();
        $ciudades = [];
        foreach ($ciudadesAspirantes as $ciudad) {
//            $objetCiudades->ciudad = $ciudad->city->descripcion;
//            $objetCiudades->cantidad = Artist::countbycities($ciudad->cities_id);
//            array_push($ciudades, $objetCiudades);
            array_push($ciudades, (object)[
                'ciudad' => $ciudad->city->descripcion,
                'cantidad' => Artist::countbycities($ciudad->cities_id),
                'departamento' => $ciudad->city->departaments->descripcion

            ]);
        }
        usort($ciudades, function ($a, $b) {
            // compare the tab option value
            $diff = $b->cantidad - $a->cantidad;
            // and return it. Unless it's zero, then compare order, instead.
            return $diff;
        });
        $ciudades = array_slice($ciudades, 0, 3);

        $total = null;
        foreach ($ciudades as $ciudad){
            $total = $total + $ciudad->cantidad;
        }
        return view('backend.dashboard.dashboard', compact('aspiranteRegistroCompleto',
            'aspiranteRegistroSinCanción', 'aspirantessolocuenta',
            'totalregistros', 'ciudades', 'total'));

    }
}
