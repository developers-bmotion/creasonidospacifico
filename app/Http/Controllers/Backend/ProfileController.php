<?php

namespace App\Http\Controllers\Backend;

use App\Artist;
use App\ArtistType;
use App\Beneficiary;
use App\City;
use App\Country;
use App\DocumentType;
use App\Level;
use App\Location;
use App\Update;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PersonType;
use App\Project;
use App\Team;
use App\typeCategories;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index_artist()
    {
        /* $countries = Country::all(); */
        /* $locactions = Location::all(); */
        $documenttype = DocumentType::all();
        $departamentos = Country::all();
        $persontypes = PersonType::all();
        $artisttypes = ArtistType::all();
        $leveltypes = Level::all();


        /*   dd($departamentos); */
        $artist = Artist::where('user_id', auth()->user()->id)->with('city.departaments','users','teams','artistType','personType','beneficiary.documentType','beneficiary.city.departaments','beneficiary.expeditionPlace.departaments','teams.expeditionPlace.departaments','expeditionPlace.departaments')->first();
        return view('backend.profile.profile-artist', compact('documenttype', 'artist', 'departamentos', 'persontypes', 'artisttypes', 'leveltypes'));
    }

    /*=============================================
        NUEVA RUTA PARA LOS FORMULARIOS DE REGISTRO PARA ASPIRANTES
    =============================================*/
    public function index()
    {
        /* $countries = Country::all(); */
        /* $locactions = Location::all(); */
        $documenttype = DocumentType::all();
        $departamentos = Country::all();
        $persontypes = PersonType::all();
        $artisttypes = ArtistType::all();
        $leveltypes = Level::all();


        /*   dd($departamentos); */
        $artist = Artist::where('user_id', auth()->user()->id)->with('users')->first();
        //dd($artist);
        return view('backend.register.register-form', compact('documenttype', 'artist', 'departamentos', 'persontypes', 'artisttypes', 'leveltypes'));
    }

    public function get_municipios($id)
    {

        $municipios = City::where('iddepartamento', $id)->get();
        return response()->json($municipios);
    }

    public function profile_update_artist(Request $request, $id_artis)
    {
        $aspirante = (object) $request->aspirante;

        if ($request->lineaConvocatoria == '1') {
            /* Este caso es para solistas */ // $date = new Carbon( $request->input('currentDate', Carbon::now()) );

            if ($request->actuaraComo == '1'){
                /* solo se guarda el aspirante */
                Artist::where('user_id', '=', $id_artis)->update([
                    'nickname' => $aspirante->name,
                    'biography' => $aspirante->biografia,
                    'document_type' => $aspirante->documentType,
                    'identification' => $aspirante->identificacion,
                    'user_id' => auth()->user()->id,
                    'adress' => $aspirante->address,
                    'cities_id' => $aspirante->municipioNacimiento,
                    'person_types_id' => $request->lineaConvocatoria,
                    'artist_types_id' => $request->actuaraComo,
                    //'level_id' => $request->get('level_id'),
                    'expedition_place' => $aspirante->municipioExpedida,
                    //'birthdate' => Carbon::parse($request->get('birthdate')),
                    //'age' => $request->get('age')
                    'township' => $aspirante->vereda,
                ]);
        
                User::where('id', '=', $id_artis)->update([
                    'name' => $aspirante->name,
                    'last_name' => $aspirante->lastname,
                    'second_last_name' => $aspirante->secondLastname,
                    'phone_1' => $aspirante->phone,
                    //'phone_2' => $request->get('phone_2'),
                ]);

                // Route::get('/profile','ProfileController@index_artist')->name('profile.artist');
                return redirect()->route('profile.artist');

            } else {
                /* se debe guardar los datos del representante y el aspirante */

                $beneficiario = (object) $request->beneficiario;
                dd('representante');

            }
        } else {
            /* Para este caso se debe guardar el representante y los integrantes del grupo */ // gettype($request->integrantes)

            foreach ($request->integrantes as $integrante) {
                dd( $integrante['nameMember'] ); // aceder a los datos
            }
        }



        /*=============================================
            AGREGAR ASPIRANTE
        =============================================*/
        /* Artist::where('user_id', '=', $id_artis)->update([
            'nickname' => $request->get('nickname'),
            'biography' => ucfirst($request->get('biography')),
            'level_id' => $request->get('level_id'),
            'document_type' => $request->get('document_type'),
            'identification' => $request->get('identificacion'),
            'user_id' => auth()->user()->id,
            'adress' => $request->get('adress'),
            'cities_id' => $request->get('cities_id'),
            'person_types_id' => $request->get('person_types_id'),
            'artist_types_id' => $request->get('artist_type_id'),
            'level_id' => $request->get('level_id'),
            'expedition_place' => $request->get('expedition_place'),
            'birthdate' => Carbon::parse($request->get('birthdate')),
            'age' => $request->get('age'),
        ]); */

        /* User::where('id', '=', $id_artis)->update([
            'name' => $request->get('name'),
            'last_name' => $request->get('lastname'),
            'second_last_name' => $request->get('second_last_name'),
            'phone_1' => $request->get('phone_1'),
            'phone_2' => $request->get('phone_2'),
        ]); */

        //$artist = Artist::select('id')->where('user_id', $id_artis)->first();


        /*=============================================
            AGREGAR MENOR DE EDAD NIÑO
            =============================================*/
        /* $sitieneartist = null;
        $sitieneartist = Beneficiary::where('artist_id', $artist)->first();

        if ($sitieneartist) {
            Beneficiary::create([

                'document_type' => $request->get('document_type_menor'),
                'identification' => $request->get('identificacion_menor'),
                'name' => $request->get('name_menor'),
                'last_name' => $request->get('last_name_menor'),
                'second_last_name' => $request->get('second_last_name_menor'),
                'phone' => $request->get('phone_1_menor'),
                'adress' => $request->get('adress_menor'),
                'cities_id' => $request->get('cities_id_menor'),
                'expedition_place' => $request->get('expedition_place_menor'),
                'birthday' => Carbon::parse($request->get('birthdate_menor')),
                'artist_id' =>  $artist->id

            ]);
        } else {

            Beneficiary::where('artist_id', '=', $artist->id)->update([

                'document_type' => $request->get('document_type_menor'),
                'identification' => $request->get('identificacion_menor'),
                'name' => $request->get('name_menor'),
                'last_name' => $request->get('last_name_menor'),
                'second_last_name' => $request->get('second_last_name_menor'),
                'phone' => $request->get('phone_1_menor'),
                'adress' => $request->get('adress_menor'),
                'cities_id' => $request->get('cities_id_menor'),
                'expedition_place' => $request->get('expedition_place_menor'),
                'birthday' => Carbon::parse($request->get('birthdate_menor')),
                'artist_id' =>  $artist->id

            ]);
        } */
        /* alert()->success(__('perfil_actualizado'), __('muy_bien'))->autoClose(3000);
        $count_project = count($project_exist->projects);
        if ($count_project >= 1) {
            return back();
        } else {
            return back()->with('profile_update', __('hora_crear_primer_project'));
        } */
    }


    public function profile_update_artist22(Request $request, $id_artis)
    {

        dd($id_artis);
        /*  $project_exist = Artist::where('user_id', auth()->user()->id)->with('projects')->first(); */
        //Actualizar en la tabla Artist
        //Validaciones
        /* $this->validate($request, [
            'nickname' => 'required',
            'biography' => 'required',
            'level_id' => 'required',
            'country_id' => 'required',
            'location_id' => 'required',
            'phone_1' => 'required',
            'birthdate' => 'required',
        ]);
 */
        /*=============================================
            AGREGAR ASPIRANTE O REPRESENTANTE DEL NIÑO
            =============================================*/



        Artist::where('user_id', '=', $id_artis)->update([
            'nickname' => $request->get('nickname'),
            'biography' => ucfirst($request->get('biography')),
            'level_id' => $request->get('level_id'),
            'document_type' => $request->get('document_type'),
            'identification' => $request->get('identificacion'),
            'user_id' => auth()->user()->id,
            'adress' => $request->get('adress'),
            'cities_id' => $request->get('cities_id'),
            'person_types_id' => $request->get('person_types_id'),
            'artist_types_id' => $request->get('artist_type_id'),
            'level_id' => $request->get('level_id'),
            'expedition_place' => $request->get('expedition_place'),
            /* 'birthdate' => Carbon::parse($request->get('birthdate')), */
            'age' => $request->get('age'),
        ]);

        User::where('id', '=', $id_artis)->update([
            'name' => $request->get('name'),
            'last_name' => $request->get('lastname'),
            'second_last_name' => $request->get('second_last_name'),
            'phone_1' => $request->get('phone_1'),
            /* 'phone_2' => $request->get('phone_2'), */
        ]);

        $artist = Artist::select('id')->where('user_id', $id_artis)->first();


        /*=============================================
            AGREGAR MENOR DE EDAD NIÑO
            =============================================*/
        $sitieneartist = null;
        $sitieneartist = Beneficiary::where('artist_id', $artist)->first();

        if ($sitieneartist) {
            Beneficiary::create([

                'document_type' => $request->get('document_type_menor'),
                'identification' => $request->get('identificacion_menor'),
                'name' => $request->get('name_menor'),
                'last_name' => $request->get('last_name_menor'),
                'second_last_name' => $request->get('second_last_name_menor'),
                'phone' => $request->get('phone_1_menor'),
                'adress' => $request->get('adress_menor'),
                'cities_id' => $request->get('cities_id_menor'),
                'expedition_place' => $request->get('expedition_place_menor'),
                'birthday' => Carbon::parse($request->get('birthdate_menor')),
                'artist_id' =>  $artist->id

            ]);
        } else {

            Beneficiary::where('artist_id', '=', $artist->id)->update([

                'document_type' => $request->get('document_type_menor'),
                'identification' => $request->get('identificacion_menor'),
                'name' => $request->get('name_menor'),
                'last_name' => $request->get('last_name_menor'),
                'second_last_name' => $request->get('second_last_name_menor'),
                'phone' => $request->get('phone_1_menor'),
                'adress' => $request->get('adress_menor'),
                'cities_id' => $request->get('cities_id_menor'),
                'expedition_place' => $request->get('expedition_place_menor'),
                'birthday' => Carbon::parse($request->get('birthdate_menor')),
                'artist_id' =>  $artist->id

            ]);
        }
        /* alert()->success(__('perfil_actualizado'), __('muy_bien'))->autoClose(3000);
        $count_project = count($project_exist->projects);
        if ($count_project >= 1) {
            return back();
        } else {
            return back()->with('profile_update', __('hora_crear_primer_project'));
        } */
    }

    public function update_password(Request $request)
    {

        if ($request->filled('password')) {

            $this->validate($request, [

                'password' => 'confirmed|min:6',

            ]);
            $password = $request->get('password');
            $newpassword = bcrypt($password);

            $user = User::where('id', auth()->user()->id)->update([
                'password' => $newpassword
            ]);

            alert()->success(__('password_actualizado'), __('muy_bien'))->autoClose(3000);
            return back();
        } else {


            return back()->with('eliminar', 'Ningún Cambio');
        }
    }

    public function photo(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $user_picture =  str_replace('storage', '', $user->picture);;
        //Elimnar foto de perfil del servidor
        Storage::delete($user_picture);
        //Agregar la nueva foto de perfil
        $photo = $request->file('photo')->store('users');
        User::where('id', auth()->user()->id)->update([
            'picture' => '/storage/' . $photo
        ]);

        return $user_picture;
    }

    public function front_photo(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $front_picture =  str_replace('storage', '', $user->front_picture);
        //Elimnar foto de perfil del servidor
        Storage::delete($front_picture);
        //Agregar la nueva foto de perfil
        $front_photo = $request->file('front_photo')->store('front');
        User::where('id', auth()->user()->id)->update([
            'front_picture' => '/storage/' . $front_photo
        ]);

        return $front_picture;
    }

    public function pdf_cedula_aspirante(Request $request)
    {

        $user = User::where('id', auth()->user()->id)->first();
        $pdf_cedula =  str_replace('storage', '', $user->pdf_cedula);
        //Elimnar pdf de cédula o tarjeta
        Storage::delete($pdf_cedula);
        //Agregar cedula o tarjeta de identidad
        $pdf_cedula_save = $request->file('pdf_cedula_name')->store('pdfidentificacion');
        User::where('id', auth()->user()->id)->update([
            'pdf_cedula' => '/storage/' . $pdf_cedula_save
        ]);

        return $pdf_cedula;
    }

    public function pdf_cedula_beneficiario(Request $request)
    {

        // $user = User::where('id', auth()->user()->id)->first();
        $artist = Artist::where('user_id', auth()->user()->id)->first();
        $beneficiario = Beneficiary::where('artist_id', $artist->id)->first();
        // dd($beneficiario);
        $pdf_cedula =  str_replace('storage', '', $beneficiario->pdf_documento);
        //Elimnar pdf de cédula o tarjeta
        Storage::delete($pdf_cedula);
        //Agregar cedula o tarjeta de identidad
        $pdf_cedula_save = $request->file('pdf_cedula_name')->store('pdfidentificacion');
        Beneficiary::where('id', $beneficiario->id)->update([
            'pdf_documento' => '/storage/' . $pdf_cedula_save
        ]);

        return $pdf_cedula;
    }
    public function update_audio(Request $request)
    {

        // dd($request->headers->get('idproject'));
        $idproject=$request->headers->get('idproject');
        // $user = User::where('id', auth()->user()->id)->first();
        // $artist = Artist::where('user_id', auth()->user()->id)->first();
        $project = Project::where('id', $idproject)->first();
        // dd($beneficiario);
        $audio =  str_replace('storage', '', $project->audio);
        //Elimnar pdf de cédula o tarjeta
        Storage::delete($audio);
        //Agregar cedula o tarjeta de identidad
        // $pdf_cedula_save = $request->file('pdf_cedula_name')->store('pdfidentificacion');
        $audio = $request->file('audio')->store('audio');
        Project::where('id',$idproject)->update([
            'audio' => '/storage/' . $audio
        ]);

        return $audio;
    }

    public function pdf_cedula_team(Request $request)
    {
        // dd($request->headers->get('id'));
        $teamid=$request->headers->get('id');
        // $user = User::where('id', auth()->user()->id)->first();
        // $artist = Artist::where('user_id', auth()->user()->id)->first();
        $team = Team::where('id',$teamid)->first();
        //  dd($team);
        $pdf_cedula =  str_replace('storage', '', $team->pdf_identificacion);
        //Elimnar pdf de cédula o tarjeta
        Storage::delete($pdf_cedula);
        //Agregar cedula o tarjeta de identidad
        $pdf_cedula_save = $request->file('pdf_cedula_name')->store('pdfidentificacion');
        Team::where('id', $teamid)->update([
            'pdf_identificacion' => '/storage/' . $pdf_cedula_save
        ]);

        return $pdf_cedula;
    }


    public function get_departamento($id)
    {
        $departamento = Country::where('id', $id)->first();
        return response()->json($departamento);
    }
    public function get_municipio($id)
    {
        $municipio = City::where('id', $id)->first();
        return response()->json($municipio);
    }
}
