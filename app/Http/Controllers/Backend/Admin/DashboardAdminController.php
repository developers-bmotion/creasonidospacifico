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


    public function ratings(){
        $listRating = Artist::with('users','personType','projects.category','documentType','city.departaments','projects.reviews_curador')
        ->whereHas('projects', function($q){
            $q->where('status',2);
        })->get();
        return datatables()->of($listRating)->toJson();
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
