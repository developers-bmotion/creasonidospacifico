<?php

namespace App\Http\Controllers\Backend;

use App\Artist;
use App\Category;
use App\City;
use App\Project;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PersonType;

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
            array_push($ciudades, (object)[
                'ciudad' => ucwords($ciudad->city->descripcion),
                'cantidad' => Artist::countbycities($ciudad->cities_id),
                'departamento' => ucwords($ciudad->city->departaments->descripcion)

            ]);
        }
        usort($ciudades, function ($a, $b) {
            $diff = $b->cantidad - $a->cantidad;
            return $diff;
        });
        $ciudades = array_slice($ciudades, 0, 3);

        $total = null;
        foreach ($ciudades as $ciudad) {
            $total = $total + $ciudad->cantidad;
        }

        /*=============================================
          DATOS PARA LAS MEJORES CATEGORIAS
       =============================================*/

        $projectscategoires = Project::has('category')->with('category')->groupBy('category_id')->get();
        $objetCategories = new \stdClass();
        $categories = [];
        foreach ($projectscategoires as $projectscategory) {
            array_push($categories, (object)[
                'category' => ucwords($projectscategory->category->category),
                'description' => $projectscategory->category->description,
                'quantity' => Project::countbyCategories($projectscategory->category_id)
            ]);
        }

        usort($categories, function ($a, $b) {
            // compare the tab option value
            $diff = $b->quantity - $a->quantity;
            // and return it. Unless it's zero, then compare order, instead.
            return $diff;
        });
       $categories = array_slice($categories, 0, 3);

        $totalCategories = null;
        foreach ($categories as $category) {
            $totalCategories = $totalCategories + $category->quantity;
        }

        // tipos de persona(actuara como)
        $tipoPersona=PersonType::All();
        $cat=Category::All();


        /*=============================================
            TARJETAS CONTAR PROYECTOS
        =============================================*/
        /* CANTIDA DE PROYECTOS EN REVISIÓN*/
        $projectsStateRevision = Project::where('status', 1)->get()->count();
        /* CANTIDA DE PROYECTOS PENDIENTE*/
        $projectsStatePendiente = Project::where('status', 4)->get()->count();
        /* CANTIDA DE PROYECTOS NUEVA REVISION*/
        $projectsStateNuevaRevision = Project::where('status', 6)->get()->count();
        /* CANTIDA DE PROYECTOS NUEVA ACEPTADOS*/
        $projectsStateAceptado = Project::where('status', 7)->get()->count();
        /* CANTIDA DE PROYECTOS NO SUBSANADAS*/
        $projectsStateNoSubsanadas = Project::where('status', 5)->get()->count();
        /* CANTIDA DE PROYECTOS APROBADAS*/
        $projectsStateAprobadas = Project::where('status', 3)->get()->count();

        return view('backend.dashboard.dashboard', compact('aspiranteRegistroCompleto',
            'aspiranteRegistroSinCanción', 'aspirantessolocuenta',
            'totalregistros', 'ciudades', 'total', 'categories', 'totalCategories','tipoPersona','cat','projectsStateRevision',
        'projectsStatePendiente', 'projectsStateNuevaRevision', 'projectsStateAceptado', 'projectsStateNoSubsanadas', 'projectsStateAprobadas'
        ));

    }

    public function getCitiesAspirants(){
        /*=============================================
           DATOS PARA LA INFORMACIÓN POR CIUDADES
        =============================================*/
        $ciudadesAspirantes = Artist::has('city')->with('city.departaments')->groupBy('cities_id')->get();

        $objetCiudades = new \stdClass();
        $ciudades = [];

        foreach ($ciudadesAspirantes as $ciudad) {
            array_push($ciudades, (object)[
                'ciudad' => ucwords($ciudad->city->descripcion),
                'cantidad' => Artist::countbycities($ciudad->cities_id),
                'departamento' => ucwords($ciudad->city->departaments->descripcion)

            ]);
        }
        usort($ciudades, function ($a, $b) {
            $diff = $b->cantidad - $a->cantidad;
            return $diff;
        });

        $total = null;
        foreach ($ciudades as $ciudad) {
            $total = $total + $ciudad->cantidad;
        }

        return datatables()->of($ciudades)->toJson();
    }
    public function getModalidadesAspirants(){
        /*=============================================
         DATOS PARA LAS MEJORES CATEGORIAS
      =============================================*/

        $projectscategoires = Project::has('category')->with('category')->groupBy('category_id')->get();
        $objetCategories = new \stdClass();
        $categories = [];
        foreach ($projectscategoires as $projectscategory) {
            array_push($categories, (object)[
                'category' => ucwords($projectscategory->category->category),
                'description' => $projectscategory->category->description,
                'quantity' => Project::countbyCategories($projectscategory->category_id)
            ]);
        }

        usort($categories, function ($a, $b) {
            // compare the tab option value
            $diff = $b->quantity - $a->quantity;
            // and return it. Unless it's zero, then compare order, instead.
            return $diff;
        });

        $totalCategories = null;
        foreach ($categories as $category) {
            $totalCategories = $totalCategories + $category->quantity;
        }
        return datatables()->of($categories)->toJson();
    }

    public function reportDashboard(){

        $pdf = PDF::loadView('backend.admin.reports.report-dashboard');
        return $pdf->stream();
    }


}
