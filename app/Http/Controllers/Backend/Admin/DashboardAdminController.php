<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Artist;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SecondStage;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{

    public function AspirantsAll(Request $request){


      $idstatus=$request->input("tipoProyecto");
      $tipoPer=$request->input("tipoPer");
      $category=$request->input("category");
      $listAspirant="";
        // dd($request->input("tipoPer"));
        // if($tipoPer == 0){
        //     echo 'hola***';
        // }else{
        //     echo 'no hola';
        if($idstatus == null){

            if($tipoPer > 0){

                if($category > 0){

                    $listAspirant = Artist::with('users','documentType','city.departaments')
                    ->whereHas('personType', function ($q) use($tipoPer){
                        $q->where('id', $tipoPer);
                    })->whereHas('projects.category', function ($q) use($category){
                        $q->where('category_id', $category);
                    })->with('personType','projects.category')->get();

                }else{
                    // $listAspirant = Artist::with('users','documentType','city.departaments')
                    //         ->whereHas('personType', function ($q) use($tipoPer){
                        //             $q->where('id', $tipoPer);
                    //         })->with('projects.category','personType')->get();

                   $listAspirant = Artist::with('users','documentType','city.departaments','projects.category')
                    ->whereHas('personType', function ($q) use($tipoPer){
                        $q->where('id', $tipoPer);
                    })->with('personType')->get();
                    // return datatables()->of($listAspirant)->toJson();


                }

            }else{

                if($category > 0){
                    // dd('hola');
                    $listAspirant = Artist::with('users','personType','documentType','city.departaments')
                    ->whereHas('projects.category', function ($q) use($category){
                        $q->where('category_id', $category);
                    })->with('projects.category')->get();
                    return datatables()->of($listAspirant)->toJson();

                }
                // }else{


                //     // $listAspirant = Artist::with('users','personType','projects.category','documentType','city.departaments', 'projects');
                // }
                $listAspirant = Artist::with('users','personType','projects.category','documentType','city.departaments', 'projects')->get();

            }
            // $listAspirant = Artist::with('users','personType','projects.category','documentType','city.departaments', 'projects')->get();

            // dd($listAspirant);
            // dd($listAspirant);
        }else if($idstatus){

             // $listAspirant = Artist::with('users','personType','projects.category','documentType','city.departaments', 'projects')->get();

            // registro pendiente

            if($idstatus==9){


                if($tipoPer > 0){
                    if($category > 0){
                        $listAspirant = Artist::with('users','documentType','city.departaments')
                        ->whereHas('personType', function ($q) use($tipoPer){
                            $q->where('id', $tipoPer);
                        })->whereHas('projects', function ($q) use($idstatus){
                            $q->where('status', $idstatus);
                        })->whereHas('projects.category', function ($q) use($category){
                            $q->where('category_id', $category);
                        })->with('projects.category','personType')->get();
                    }else{
                    $listAspirant = Artist::with('users','documentType','city.departaments')
                    ->whereHas('personType', function ($q) use($tipoPer){
                        $q->where('id', $tipoPer);
                    })->with('personType')->whereNull('nickname')->whereDoesntHave('projects')->get();
                }

                }else{
                    if($category > 0){
                        $listAspirant = Artist::with('users','personType','documentType','city.departaments')->whereHas('projects', function ($q) use($idstatus){
                            $q->where('status', $idstatus);
                        })->whereHas('projects.category', function ($q) use($category){
                            $q->where('category_id', $category);
                        })->with('projects.category')->get();

                    }else{

                            $listAspirant = Artist::with('users','personType','documentType','city.departaments')->whereNull('nickname')->whereDoesntHave('projects')->get();
                    }
                }
                // sin proyecto registrado
             }else if($idstatus==10){

                if($tipoPer > 0){

                    if($category > 0){
                        $listAspirant = Artist::with('users','documentType','city.departaments')
                        ->whereHas('personType', function ($q) use($tipoPer){
                            $q->where('id', $tipoPer);
                        })->whereHas('projects', function ($q) use($idstatus){
                            $q->where('status', $idstatus);
                        })->whereHas('projects.category', function ($q) use($category){
                            $q->where('category_id', $category);
                        })->with('projects.category','personType')->get();
                    }else{

                        $listAspirant = Artist::with('users','documentType','city.departaments')
                        ->whereHas('personType', function ($q) use($tipoPer){
                            $q->where('id', $tipoPer);
                        })->with('personType')->whereNotNull('document_type')->doesnthave('projects.category')->get();
                    }

                }else{

                    if($category > 0){
                        $listAspirant = Artist::with('users','personType','documentType','city.departaments')->whereHas('projects', function ($q) use($idstatus){
                            $q->where('status', $idstatus);
                        })->whereHas('projects.category', function ($q) use($category){
                            $q->where('category_id', $category);
                        })->with('projects.category')->get();

                    }else{
                      $listAspirant = Artist::with('users','personType','documentType','city.departaments')->whereNotNull('document_type')->doesnthave('projects.category')->get();

                    }
                }


            }else{

                if($tipoPer > 0){

                    if($category > 0){

                        $listAspirant = Artist::with('users','documentType','city.departaments')
                        ->whereHas('personType', function ($q) use($tipoPer){
                            $q->where('id', $tipoPer);
                        })->whereHas('projects', function ($q) use($idstatus){
                            $q->where('status', $idstatus);
                        })->whereHas('projects.category', function ($q) use($category){
                            $q->where('category_id', $category);
                        })->with('projects.category','personType')->get();

                    }else{
                        if($category > 0){
                            $listAspirant = Artist::with('users','personType','documentType','city.departaments')->whereHas('projects', function ($q) use($idstatus){
                                $q->where('status', $idstatus);
                            })->whereHas('projects.category', function ($q) use($category){
                                $q->where('category_id', $category);
                            })->with('projects.category')->get();

                        }else{
                            $listAspirant = Artist::with('users','documentType','city.departaments')
                            ->whereHas('personType', function ($q) use($tipoPer){
                                $q->where('id', $tipoPer);
                            })->whereHas('projects', function ($q) use($idstatus){
                                $q->where('status', $idstatus);
                            })->with('projects.category','personType')->get();
                         }
                }



                }else{
                    if($category > 0){
                        $listAspirant = Artist::with('users','personType','documentType','city.departaments')->whereHas('projects', function ($q) use($idstatus){
                            $q->where('status', $idstatus);
                        })->whereHas('projects.category', function ($q) use($category){
                            $q->where('category_id', $category);
                        })->with('projects.category')->get();

                    }else{

                        $listAspirant = Artist::with('users','personType','documentType','city.departaments')->whereHas('projects', function ($q) use($idstatus){
                            $q->where('status', $idstatus);
                        })->with('projects.category')->get();
                        // dd($listAspirant);
                    //    return datatables()->of($listAspirant)->toJson();
                    }


                }
             }
            }



        return datatables()->of($listAspirant)->toJson();


    }


    public function ratings(Request $request){

        $idstatus= 2;
        $tipoPer=$request->input("tipoPerQual");
        $category=$request->input("categoryQual");
        $listRating="";

        // inicio
        if($tipoPer > 0){

            if($category > 0){

                $listRating = Artist::with('users','documentType','city.departaments')
                ->whereHas('personType', function ($q) use($tipoPer){
                    $q->where('id', $tipoPer);
                })->whereHas('projects', function ($q) use($idstatus){
                    $q->where('status', $idstatus);
                })->whereHas('projects.category', function ($q) use($category){
                    $q->where('category_id', $category);
                })->with('projects.category','personType')->get();

            }else{
                if($category > 0){
                    $listRating = Artist::with('users','personType','documentType','city.departaments')->whereHas('projects', function ($q) use($idstatus){
                        $q->where('status', $idstatus);
                    })->whereHas('projects.category', function ($q) use($category){
                        $q->where('category_id', $category);
                    })->with('projects.category')->get();

                }else{

                    // dd($tipoPer);
                    $listRating = Artist::with('users','documentType','city.departaments')
                    ->whereHas('personType', function ($q) use($tipoPer){
                        $q->where('id', $tipoPer);
                    })->whereHas('projects', function ($q) use($idstatus){
                        $q->where('status', $idstatus);
                    })->with('projects.category','personType')->get();
                 }
        }



        }else{

            if($category > 0){
                $listRating = Artist::with('users','personType','documentType','city.departaments')->whereHas('projects', function ($q) use($idstatus){
                    $q->where('status', $idstatus);
                })->whereHas('projects.category', function ($q) use($category){
                    $q->where('category_id', $category);
                })->with('projects.category')->get();

            }else{


            $listRating = Artist::with('users','personType','projects.category','documentType','city.departaments')
            ->whereHas('projects', function($q){
                $q->where('status',2);
            })->get();
        }
        }

        // fin


        // $listRating = Artist::with('users','personType','projects.category','documentType','city.departaments')
        //     ->whereHas('projects', function($q){
        //         $q->where('status',2);
        //     })->get();

        $aspirantRating = [];
        foreach ($listRating as $aspirants) {
            array_push($aspirantRating, (object)[
                'id' => $aspirants->id,
                'names' => ucwords($aspirants->users->name),
                'last_name' => ucwords($aspirants->users->last_name),
                'act_like' => $aspirants->personType->name,
                'category' => $aspirants->projects[0]->category->category,
                'departament' => $aspirants->city->departaments->descripcion,
                'city' => $aspirants->city->descripcion,
                'id_project'=> $aspirants->projects[0]->id,
                'slug'=> $aspirants->projects[0]->slug,
                'identification'=> $aspirants->identification,
                'fecha'=> $aspirants->byrthdate,
                'rating' => Project::sumRating( $aspirants->projects[0]->id)
            ]);
        }

        usort($aspirantRating, function ($a, $b) {
            $diff = $b->rating - $a->rating;
            return $diff;
        });

        return datatables()->of($aspirantRating)->toJson();
    }

    public function ratings_second(Request $request){

        $idstatus= 2;
        $tipoPer=$request->input("tipoPerQualSec");
        $category=$request->input("categoryQualSec");
        $listRating="";

        // inicio
        if($tipoPer > 0){

            if($category > 0){

                $listRating = Artist::with('users','documentType','city.departaments')
                ->whereHas('personType', function ($q) use($tipoPer){
                    $q->where('id', $tipoPer);
                })->whereHas('projects', function ($q) use($idstatus){
                    $q->where('manager_id','<>',0);
                })->whereHas('projects.category', function ($q) use($category){
                    $q->where('category_id', $category);
                })->with('projects.category','personType')->get();

            }else{
                if($category > 0){
                    $listRating = Artist::with('users','personType','documentType','city.departaments')->whereHas('projects', function ($q) use($idstatus){
                        $q->where('manager_id','<>',0);
                    })->whereHas('projects.category', function ($q) use($category){
                        $q->where('category_id', $category);
                    })->with('projects.category')->get();

                }else{

                    // dd($tipoPer);
                    $listRating = Artist::with('users','documentType','city.departaments')
                    ->whereHas('personType', function ($q) use($tipoPer){
                        $q->where('id', $tipoPer);
                    })->whereHas('projects', function ($q) use($idstatus){
                        $q->where('manager_id','<>',0);
                    })->with('projects.category','personType')->get();
                 }
        }



        }else{

            if($category > 0){
                $listRating = Artist::with('users','personType','documentType','city.departaments')->whereHas('projects', function ($q) use($idstatus){
                    $q->where('manager_id','<>',0);
                })->whereHas('projects.category', function ($q) use($category){
                    $q->where('category_id', $category);
                })->with('projects.category')->get();

            }else{


            $listRating = Artist::with('users','personType','projects.category','documentType','city.departaments')
            ->whereHas('projects', function($q){
                $q->where('manager_id','<>',0);
            })->get();
        }
        }

        // fin


        // $listRating = Artist::with('users','personType','projects.category','documentType','city.departaments')
        //     ->whereHas('projects', function($q){
        //         $q->where('status',2);
        //     })->get();

        $aspirantRating = [];
        foreach ($listRating as $aspirants) {
            // $suma= $second->trajectory;
            array_push($aspirantRating, (object)[
                'id' => $aspirants->id,
                'names' => ucwords($aspirants->users->name),
                'last_name' => ucwords($aspirants->users->last_name),
                'act_like' => $aspirants->personType->name,
                'category' => $aspirants->projects[0]->category->category,
                'departament' => $aspirants->city->departaments->descripcion,
                'city' => $aspirants->city->descripcion,
                'id_project'=> $aspirants->projects[0]->id,
                'slug'=> $aspirants->projects[0]->slug,
                'identification'=> $aspirants->identification,
                'fecha'=> $aspirants->byrthdate,
                'rating' => Project::sumRatingSecond( $aspirants->projects[0]->id)
            ]);
        }

        usort($aspirantRating, function ($a, $b) {
            $diff = $b->rating - $a->rating;
            return $diff;
        });

        return datatables()->of($aspirantRating)->toJson();
    }
    public function ratings_finalist(Request $request){

        $idstatus= 2;
        $tipoPer=$request->input("tipoPerQualSec");
        $category=$request->input("categoryQualSec");
        $listRating="";

        // inicio
        if($tipoPer > 0){

            if($category > 0){

                $listRating = Artist::with('users','documentType','city.departaments')
                ->whereHas('personType', function ($q) use($tipoPer){
                    $q->where('id', $tipoPer);
                })->whereHas('projects', function ($q) use($idstatus){
                    $q->where('manager_id','<>',0);
                })->whereHas('projects.category', function ($q) use($category){
                    $q->where('category_id', $category);
                })->whereHas('projects.reviews_second', function ($q){
                    $q->where('finalist', 1);
                })->with('projects.category','personType')->get();

            }else{
                if($category > 0){
                    $listRating = Artist::with('users','personType','documentType','city.departaments')->whereHas('projects', function ($q) use($idstatus){
                        $q->where('manager_id','<>',0);
                    })->whereHas('projects.category', function ($q) use($category){
                        $q->where('category_id', $category);
                    })->whereHas('projects.reviews_second', function ($q){
                        $q->where('finalist', 1);
                    })->with('projects.category')->get();

                }else{

                    // dd($tipoPer);
                    $listRating = Artist::with('users','documentType','city.departaments')
                    ->whereHas('personType', function ($q) use($tipoPer){
                        $q->where('id', $tipoPer);
                    })->whereHas('projects', function ($q) use($idstatus){
                        $q->where('manager_id','<>',0);
                    })->whereHas('projects.reviews_second', function ($q){
                        $q->where('finalist', 1);
                    })->with('projects.category','personType')->get();
                 }
        }



        }else{

            if($category > 0){
                $listRating = Artist::with('users','personType','documentType','city.departaments')->whereHas('projects', function ($q) use($idstatus){
                    $q->where('manager_id','<>',0);
                })->whereHas('projects.category', function ($q) use($category){
                    $q->where('category_id', $category);
                })->whereHas('projects.reviews_second', function ($q){
                    $q->where('finalist', 1);
                })->with('projects.category')->get();

            }else{


            $listRating = Artist::with('users','personType','projects.category','documentType','city.departaments')
            ->whereHas('projects', function($q){
                $q->where('manager_id','<>',0);
            })->whereHas('projects.reviews_second', function ($q){
                $q->where('finalist', 1);
            })->get();
        }
        }

        // fin


        // $listRating = Artist::with('users','personType','projects.category','documentType','city.departaments')
        //     ->whereHas('projects', function($q){
        //         $q->where('status',2);
        //     })->get();

        $aspirantRating = [];
        // dd($listRating);
        foreach ($listRating as $aspirants) {
            // $suma= $second->trajectory;
            array_push($aspirantRating, (object)[
                'id' => $aspirants->id,
                'names' => ucwords($aspirants->users->name),
                'last_name' => ucwords($aspirants->users->last_name),
                'act_like' => $aspirants->personType->name,
                'category' => $aspirants->projects[0]->category->category,
                'departament' => $aspirants->city->departaments->descripcion,
                'city' => $aspirants->city->descripcion,
                'id_project'=> $aspirants->projects[0]->id,
                'slug'=> $aspirants->projects[0]->slug,
                'identification'=> $aspirants->identification,
                'fecha'=> $aspirants->byrthdate,
                'rating' => Project::sumRatingSecond( $aspirants->projects[0]->id),
            ]);
        }

        usort($aspirantRating, function ($a, $b) {
            $diff = $b->rating - $a->rating;
            return $diff;
        });

        return datatables()->of($aspirantRating)->toJson();
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
