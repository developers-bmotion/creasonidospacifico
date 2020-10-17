<?php

namespace App\Http\Controllers\Backend;

use App\Artist;
use App\Category;
use App\EndProject;
use App\Mail\AssignProjectManager;
use App\Mail\NewProjectArtist;
use App\Project;
use App\Survey;
use App\typeCategories;
use App\Team;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AddProjectController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $artist_id = Artist::select('id')->where('user_id', auth()->user()->id)->first();
        //$artist = Artist::select('nickname','biography','level_id','country_id')
        $artist = Artist::select('nickname', 'biography', 'level_id')
            ->where('user_id', auth()->user()->id)->first();
        $question = Survey::with('question', 'question.answer')->get();
        $numProject = DB::table('artist_projects')->select('id')->where('artist_id', '=', $artist_id->id)->get();
        $contProject = count($numProject);
        $tipoCategorias = typeCategories::all();
        if ($artist->nickname == null) {
            return redirect(route('profile.artist'))->with('eliminar', __('completa_perfil_artista'));
        } else {
            return view('backend.projects.add-project', compact('categories', 'artist_id', 'question', 'contProject', 'tipoCategorias'));
        }
    }

    public function categoryById(Request $request, $id)
    {
        if ($request->ajax()) {
            $categories = Category::where('typeCategory_id', $id)->get();
            return response()->json($categories);
        }
        // Category::where('typeCategory_id', $id_category)->get();
    }

    public function upload_image(Request $request)
    {
        /*$image = $request->file('image')->store('audio');*/
       $image = $request->file('image')->store('audio', 's3');
       Storage::disk('s3')->setVisibility($image,'public');
       $urlS3 = Storage::disk('s3')->url($image);

    //    dd($urlS3);

        /* $url_go_input = Storage::url($image);
        $url = str_ireplace($request->root(),'',$url_go_input); */

        return $urlS3;
    }
    public function audio_one(Request $request)
    {

        $image = $request->file('image')->store('audio_one','s3');
        Storage::disk('s3')->setVisibility($image,'public');
       $urlS3 = Storage::disk('s3')->url($image);
        /*$image = Storage::disk('s3')->put('audio', $request->file('image'));*/

        /* $url_go_input = Storage::url($image);
        $url = str_ireplace($request->root(),'',$url_go_input); */

        return $urlS3;
    }
    public function audio_two(Request $request)
    {

        $image = $request->file('image')->store('audio_two','s3');
        Storage::disk('s3')->setVisibility($image,'public');
        $urlS3 = Storage::disk('s3')->url($image);
        /*$image = Storage::disk('s3')->put('audio', $request->file('image'));*/

        /* $url_go_input = Storage::url($image);
        $url = str_ireplace($request->root(),'',$url_go_input); */

        return $urlS3;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subir_cancion' => 'required'
        ]);
            
        $slug = str_slug($request->get('title'));
        $ramdoNum = mt_rand(1, 10000);

        $artist = Artist::where('user_id', auth()->user()->id)->with('users')->first();
        $email_artist =  $artist->users->email;

        $project = Project::create([
            'title' => ucfirst($request->get('name_project')),
            'author' => ucfirst($request->get('author')),
            'description' => ucfirst($request->get('description')),
            'audio' => $request->get('subir_cancion'),
            'audio_secundary_one' => $request->get('audio_one'),
            'audio_secundary_two' => $request->get('audio_two'),
            'category_id' => $request->get('tCategory_id'),
            'status' => $request->get('status'),
            'slug' => $slug . '-' . $ramdoNum
        ]);

        $project->artists()->attach($request->get('artist_id'));
        $user_name = auth()->user()->name;
        \Mail::to($email_artist)->send(new NewProjectArtist($project,  $user_name));
        alert()->success(__("projectCreated"), __('projectCreatedTitle'))->autoClose(3000);
        return redirect(route("profile.artist"))->with('proyect_add', 'Tu propuesta musical ha sido registrada');
//        if ($request->get('select_solista') != 1) {
//            if ($request->get('nombres') != null) {
//                for ($i = 0; $i < count($request->get('nombres')); $i++) {
//
//                    $team = new Team();
//                    $team->name = ucwords($request->get('nombres')[$i]);
//                    $team->role = ucwords($request->get('rol')[$i]);
//                    $team->save();
//                    $project->teams()->attach($team);
//                }
//            }
//        }


//        $ans = Artist::findOrFail($request->get('artist_id'));
//        $ans->answers()->attach($request->get('questionGroup'));


//        $artist = Artist::select('nickname')->where('id', $request->get('artist_id'))->first();
//        \Mail::to('silviotista93@gmail.com')->send(new NewProjectArtist($project, auth()->user()->name));
//        alert()->success(__("projectCreated"), __('projectCreatedTitle'))->autoClose(3000);
//        $count_project = count($project_exist->projects);
//        $name_artist = $project_exist->nickname;
//        if ($count_project >= 1) {
//            return redirect(route("myprojects.artist"))->with('proyect_add', '' . $name_artist . ' ' . __('proyecto_add_notificar'));
//        } else {
//            return redirect(route("myprojects.artist"))->with('proyect_add', ' ' . $name_artist . ' ' . __('primer_proyecto_add_notificar'));
//
//        }
    }
}
