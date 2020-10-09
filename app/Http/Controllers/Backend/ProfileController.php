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
use DateTime;
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
        $artist = Artist::where('user_id', auth()->user()->id)->with('projects.category','projects.observations', 'city.departaments','users','teams','artistType','personType','beneficiary.documentType','beneficiary.city.departaments','beneficiary.expeditionPlace.departaments','teams.expeditionPlace.departaments','expeditionPlace.departaments')->first();
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


    /* metodo para actualizar datos del aspirante */
    public function profile_update_artist(Request $request, $id_artis) {
        if ($request->lineaConvocatoria == '1') { // Este caso es para solistas
            if ($request->actuaraComo == '1'){
                /* solo se guarda el aspirante */
                $this->insertAspirante($id_artis, $request);
                return redirect()->route('profile.artist');
            } else { // se debe guardar los datos del representante
                $this->insertAspirante($id_artis, $request);

                $artist = Artist::select('id')->where('user_id', $id_artis)->first();
                $sitieneartist = null;
                $sitieneartist = Beneficiary::where('artist_id', $artist->id)->first();

                /* se debe guardar los datos del aspirante */
                if ($sitieneartist) {
                    $this->updateBeneficiario($request, $artist->id);
                } else {
                    $this->createBeneficiario($request, $artist->id);
                }

                return redirect()->route('profile.artist');
            }
        } else { // Para este caso se debe guardar el representante
            $this->insertAspirante($id_artis, $request);

            $artist = Artist::select('id')->where('user_id', $id_artis)->first();
            $existTeam = null;
            $existTeam = Team::where('artist_id', $artist->id)->first();

            /* se guardan los datos del los integrantes del grupo */
            if ($existTeam == null) $this->insertGroupMembers($request, $artist);

            return redirect()->route('profile.artist');
        }
    }

    /* metodo para actualizar un aspirante en la base de datos */
    public function insertAspirante($id_artis, $request) {
        $aspirante = (object) $request->aspirante;
        //dd($aspirante);
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
            'expedition_place' => $aspirante->municipioExpedida,
            'byrthdate' => Carbon::parse($aspirante->birthdate),
            'byrthdate' => $aspirante->birthdate,
            'township' => $aspirante->vereda,
            'name_team' => $aspirante->nameTeam,
        ]);

        User::where('id', '=', $id_artis)->update([
            'name' => $aspirante->name,
            'last_name' => $aspirante->lastname,
            'second_last_name' => $aspirante->secondLastname,
            'phone_1' => $aspirante->phone,
            'pdf_cedula' => $aspirante->urlPdfDocument,
            'img_document_front' => $aspirante->urlImageDocumentFrente,
            'img_document_back' => $aspirante->urlImageDocumentAtras,
        ]);
    }

    /* metodo para insertar un beneficiario en la base de datos */
    public function createBeneficiario($request, $idArtst) {
        $beneficiario = (object) $request->beneficiario;

        Beneficiary::create([
            'document_type' => $beneficiario->documentType,
            'identification' => $beneficiario->identificacion,
            'name' => $beneficiario->name,
            'last_name' => $beneficiario->lastname,
            'second_last_name' => $beneficiario->secondLastname,
            'pdf_documento' => $beneficiario->urlPdfDocument,
            'img_document_front' => $beneficiario->urlImageDocumentFrente,
            'img_document_back' => $beneficiario->urlImageDocumentAtras,
            'phone' => $beneficiario->phone,
            'adress' => $beneficiario->address,
            'biography' => $beneficiario->biografia,
            'birthday' => Carbon::parse($beneficiario->birthdate),
            'cities_id' => $beneficiario->municipioNacimiento,
            'township' => $request->vereda,
            'expedition_place' => $request->municipioExpedida,
            'artist_id' =>  $idArtst
        ]);
    }

    /* metodo para actualizar un beneficiario en la base de datos */
    public function updateBeneficiario($request, $idArtst) {
        $beneficiario = (object) $request->beneficiario;

        Beneficiary::where('artist_id', '=', $idArtst)->update([
            'document_type' => $beneficiario->documentType,
            'identification' => $beneficiario->identificacion,
            'name' => $beneficiario->name,
            'last_name' => $beneficiario->lastname,
            'second_last_name' => $beneficiario->secondLastname,
            'pdf_documento' => $beneficiario->urlPdfDocument,
            'img_document_front' => $beneficiario->urlImageDocumentFrente,
            'img_document_back' => $beneficiario->urlImageDocumentAtras,
            'phone' => $beneficiario->phone,
            'adress' => $beneficiario->address,
            'biography' => $beneficiario->biografia,
            'birthday' => Carbon::parse($beneficiario->birthdate),
            'cities_id' => $beneficiario->municipioNacimiento,
            'township' => $request->vereda,
            'expedition_place' => $request->municipioExpedida,
            //'artist_id' =>  $idArtst
        ]);
    }

    /* metodo para insertar los integrantes del grupo */
    public function insertGroupMembers($request, $artist) {
        foreach ($request->integrantes as $integrante) {
            $member = new Team();
            $member->name = $integrante['nameMember'];
            $member->last_name = $integrante['lastnameMember'];
            $member->second_last_name = $integrante['secondLastnameMember'];
            $member->type_document = $integrante['documentTypeMember'];
            $member->identification = $integrante['identificationMember'];
            $member->place_expedition = $integrante['municipio_expedición_member'];
            $member->place_birth = $integrante['municipio_nacimiento_member'];
            $member->addres = $integrante['addressMember'];
            $member->phone1 = $integrante['phoneMember'];
            $member->role = $integrante['rolMember'];
            $member->artist_id = $artist->id;

            /* Guardar archivos del documento de los integrantes */
            if ($integrante['fileType'] == '1') { // guardar imagenes
                $urlS3 = $this->uploadFile($integrante['imgDocfrente']);
                if ($urlS3) $member->img_document_front = $urlS3;

                $urlS3 = $this->uploadFile($integrante['imgDocAtras']);
                if ($urlS3) $member->img_document_back = $urlS3;
            } else { // guradar PDF
                $urlS3 = $this->uploadFile($integrante['pdfDocument']);
                if ($urlS3) $member->pdf_identificacion = $urlS3;
            }
            $member->save();
        }
    }

    /* funcion para subir los archivos al servidor s3 de amazon */
    public function uploadFile($file) {
        $currentFile = $file->store('pdfdoc', 's3');
        Storage::disk('s3')->setVisibility($currentFile, 'public');
        $urlS3 = Storage::disk('s3')->url($currentFile);
        return $urlS3;
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

    public function uploadImageDocument(Request $request)
    {
        $image = $request->file('file')->store('imagendoc', 's3');
        Storage::disk('s3')->setVisibility($image, 'public');
        $urlS3 = Storage::disk('s3')->url($image);

        return $urlS3;
    }

    public function uploadPDFDocument(Request $request)
    {
        $image = $request->file('file')->store('pdfdoc', 's3');
        Storage::disk('s3')->setVisibility($image, 'public');
        $urlS3 = Storage::disk('s3')->url($image);

        return $urlS3;
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
        // $pdf_cedula =  str_replace('storage', '', $user->pdf_cedula);
        //Elimnar pdf de cédula o tarjeta
        Storage::disk('s3')->delete($user->pdf_cedula);
        //Agregar cedula o tarjeta de identidad
        $pdf_cedula_save = $request->file('pdf_cedula_name')->store('pdfdoc','s3');
        Storage::disk('s3')->setVisibility($pdf_cedula_save, 'public');
        $urlS3 = Storage::disk('s3')->url($pdf_cedula_save);
        User::where('id', auth()->user()->id)->update([
            'pdf_cedula' => $urlS3
        ]);

        return $urlS3;
    }

    public function pdf_cedula_beneficiario(Request $request)
    {

        // $user = User::where('id', auth()->user()->id)->first();
        $artist = Artist::where('user_id', auth()->user()->id)->first();
        $beneficiario = Beneficiary::where('artist_id', $artist->id)->first();
        // dd($beneficiario);
        // $pdf_cedula =  str_replace('storage', '', $beneficiario->pdf_documento);
        //Elimnar pdf de cédula o tarjeta
        Storage::disk('s3')->delete($beneficiario->pdf_documento);
        //Agregar cedula o tarjeta de identidad
        $pdf_cedula_save = $request->file('pdf_cedula_name')->store('pdfdoc','s3');
        Storage::disk('s3')->setVisibility($pdf_cedula_save, 'public');
        $urlS3 = Storage::disk('s3')->url($pdf_cedula_save);
        Beneficiary::where('id', $beneficiario->id)->update([
            'pdf_documento' => $urlS3
        ]);

        return $urlS3;
    }
    public function update_audio(Request $request)
    {

        // dd($request->headers->get('idproject'));
        $idproject=$request->headers->get('idproject');
        $urlS3="";
        // dd($idproject);
        if($idproject != '-1'){

            $audio = $request->file('audio')->store('audio','s3');
            Storage::disk('s3')->setVisibility($audio,'public');
            $urlS3 = Storage::disk('s3')->url($audio);
            Project::where('id',$idproject)->update([
                'audio' => $urlS3
            ]);
        }

        return $urlS3;
    }

    public function pdf_cedula_team(Request $request)
    {
        // dd($request->headers->get('id'));
        $teamid=$request->headers->get('id');
        // $user = User::where('id', auth()->user()->id)->first();
        // $artist = Artist::where('user_id', auth()->user()->id)->first();
        $team = Team::where('id',$teamid)->first();
        //  dd($team);
        // $pdf_cedula =  str_replace('storage', '', $team->pdf_identificacion);
        //Elimnar pdf de cédula o tarjeta
        Storage::disk('s3')->delete($team->pdf_identificacion);
        //Agregar cedula o tarjeta de identidad
        $pdf_cedula_save = $request->file('pdf_cedula_name')->store('pdfdoc','s3');
        Storage::disk('s3')->setVisibility($pdf_cedula_save, 'public');
        $urlS3 = Storage::disk('s3')->url($pdf_cedula_save);
        Team::where('id', $teamid)->update([
            'pdf_identificacion' => $urlS3
        ]);

        return $urlS3;
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
