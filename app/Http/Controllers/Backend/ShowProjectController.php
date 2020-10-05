<?php

namespace App\Http\Controllers\Backend;

use App\Artist;
use App\City;
use App\Country;
use App\EndProject;
use App\Location;
use App\Management;
use App\Project;
use App\User;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ShowProjectController extends Controller
{
    public function index(Project $project)
    {


        $users = User::where('id', \Auth::user()->id)->with(['roles'])->first();
        $rol = array_pluck($users->roles, 'rol');
        $end_time = EndProject::where('project_id',$project->id)->first();
        $artist= Project::where('id',$project->id)->with('artists.users','artists.artistType','artists.personType','artists.beneficiary.documentType','artists.beneficiary.city','artists.beneficiary.expeditionPlace','artists.teams','artists.teams.expeditionPlace','artists.expeditionPlace.departaments')->first();
        $country = City::where('id',$artist->artists[0]->cities_id)->with('departaments')->first();
        // $location = Location::where('id',$artist->artists[0]->location_id)->first();
        // dd($artist);
        $team = Project::where('id',$project->id)->with('teams')->first();
        if (in_array('Admin', $rol)) {
            $review = Review::where("project_id","=", $project->id)->get();
            $asignado = count($review);


            // $currentRaing = $review->avg("rating");
            return view('backend.projects.show-project', compact("asignado",'project','end_time','artist','team','country'));
            // return view('backend.projects.show-project', compact("asignado",'project','end_time','artist','country', "currentRaing",'location','team'));
        }else if(in_array('Subsanador', $rol)) {
            $review = Review::where("project_id","=", $project->id)->get();
            $asignado = count($review);

            // $currentRaing = $review->avg("rating");
            return view('backend.projects.show-project', compact("asignado",'project','end_time','artist','team','country'));

        }else if(in_array('Manage', $rol)){
            $review = Review::where("project_id","=", $project->id)
                ->where("user_id","=", auth()->user()->id)->first();
            return view('backend.projects.show-project', compact('project','end_time','artist', 'review','team','country'));
            // return view('backend.projects.show-project', compact('project','end_time','artist','country', 'review','location','team'));
        }else {

            $verify = Artist::where('user_id',$artist->artists[0]->user_id)->with([
                'projects' => function ($q) {
                    $q->select('slug');
                },
            ])->first();
            $seacharSlug = $project->slug;
            // dd($artist->artists[0]->user_id);
            $projectsSlug = json_decode($verify->projects);
            $array = array_pluck($projectsSlug, 'slug');
            $project->first();

            if (in_array($seacharSlug, $array)) {
                return view('backend.projects.show-project', compact('project','end_time','artist','team','country'));
                // return view('backend.projects.show-project', compact('project','end_time','artist','country','location','team'));
            } else {
                return response('No puedes continuar', 404);
            }
        }
    }

    public function table_assing_management(Request $request){
        $managers = Management::whereHas('projects', function ($query) use ($request){
            $query->where('projects.id', '=', $request->get('id_project'));
        })->with('users')->get();
        $managers->map(function ($manager) use ($request){
            $review = Review::where("project_id","=", $request->get('id_project'))
                ->where("user_id","=", $manager->user_id)->first();
            // $manager->rating = $review->rating;
            $manager->comment = $review->comment;
           return  $manager;
        });
        return datatables()->of($managers)->toJson();

    }

}
