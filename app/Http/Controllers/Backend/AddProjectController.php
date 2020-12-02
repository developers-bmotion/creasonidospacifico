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
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

        $ramdoNum = Str::random(10);
        $slug = Str::slug($request->get('name_project').'-'.$ramdoNum, '-');

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
            'slug' => $slug
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

    public function updateProjectCron(){

        $holidays = [
            "2020-11-14", "2020-11-15", "2020-11-16",
            "2020-11-21", "2020-11-22", "2020-11-28",
            "2020-11-29", "2020-12-05", "2020-12-06",
            "2020-12-08", "2020-12-12", "2020-12-13",
            "2020-12-19", "2020-12-20", "2020-12-25",
            "2020-12-26", "2020-12-27", "2021-01-01",
            "2021-01-02", "2021-01-03", "2021-01-09",
            "2021-01-10", "2021-01-11", "2021-01-17",
        ];

        $date = Carbon::now();
        $MyDateCarbon = Carbon::parse($date);

        $MyDateCarbon->addWeekdays(3);

        for ($i = 1; $i <= 3; $i++) {

            if (in_array(Carbon::parse($date)->addWeekdays($i)->toDateString(), $holidays)) {

                $MyDateCarbon->addDay();

            }
        }
//        dd($MyDateCarbon);
        return $MyDateCarbon->formatLocalized('%A %d de %B de %Y %H:%M:%S');

    }
}
