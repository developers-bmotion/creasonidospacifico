<?php

namespace App\Http\Controllers\Backend;

use App\Artist;
use App\ArtistType;
use App\Beneficiary;
use App\Category;
use App\City;
use App\Country;
use App\DocumentType;
use App\Level;
use App\Location;
use App\Mail\NewArtist;
use App\Update;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\NewGestorAdmin;
use App\PersonType;
use App\Project;
use App\Team;
use App\typeCategories;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $artist = Artist::where('user_id', auth()->user()->id)->with('documentType','projects.category','projects.observations', 'city.departaments','users','teams.documentType','teams.expeditionPlace','teams.city.departaments','artistType','personType','beneficiary.documentType','beneficiary.city.departaments','beneficiary.expeditionPlace.departaments','teams.expeditionPlace.departaments','expeditionPlace.departaments')->first();
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
    /*=============================================
        NUEVA RUTA PARA REGISTRAR ASPIRANTES POR UN GESTOR
    =============================================*/
    public function indexGestor()
    {
        /* $countries = Country::all(); */
        /* $locactions = Location::all(); */
        $documenttype = DocumentType::all();
        $departamentos = Country::all();
        $persontypes = PersonType::all();
        $artisttypes = ArtistType::all();
        $leveltypes = Level::all();
        $categories = Category::all();


        /*   dd($departamentos); */
        $artist = Artist::where('user_id', auth()->user()->id)->with('users')->first();
        //dd($artist);
        return view('backend.register.register-gestor', compact('documenttype', 'artist', 'departamentos', 'persontypes', 'artisttypes', 'leveltypes', 'categories'));
    }

    public function ListAspirantGestor() {
        $listAspirant = Artist::where('gestor_id', auth()->user()->id)->with('users')->get();
        return view('backend.gestores.aspirants-all', compact('listAspirant'));
    }

    public function get_municipios($id)
    {

        $municipios = City::where('iddepartamento', $id)->get();
        return response()->json($municipios);
    }


    /* metodo para actualizar datos del aspirante */
    public function profile_update_artist(Request $request, $id_artis) {
        //dd($request);
        if ($request->lineaConvocatoria == '1') { // Este caso es para solistas
            if ($request->actuaraComo == '1'){
                /* solo se guarda el aspirante */
                $this->insertAspirante($id_artis, $request);

                //return redirect()->route('add.project')->with('aspirant_register', 'Es momento de subir tu propuesta musical');
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
                //return redirect()->route('add.project')->with('aspirant_register', 'Es momento de subir tu propuesta musical');
            }
        } else { // Para este caso se debe guardar el representante
            $this->insertAspirante($id_artis, $request);

            $artist = Artist::select('id')->where('user_id', $id_artis)->first();
            $existTeam = null;
            $existTeam = Team::where('artist_id', $artist->id)->first();

            /* se guardan los datos del los integrantes del grupo */
            if ($existTeam == null) $this->insertGroupMembers($request, $artist->id);
        }

        return redirect()->route('add.project')->with('aspirant_register', 'Es momento de subir tu propuesta musical');
    }

    /* metodo para actualizar un aspirante en la base de datos */
    public function insertAspirante($id_artis, $request) {
        $aspirante = (object) $request->aspirante;
        $personType = 3;

        if ($request->actuaraComo) {
            $personType = $request->actuaraComo;
        }

        Artist::where('user_id', '=', $id_artis)->update([
            'nickname' => $aspirante->name,
            'biography' => $aspirante->biografia,
            'document_type' => $aspirante->documentType,
            'identification' => $aspirante->identificacion,
            'user_id' => auth()->user()->id,
            'adress' => $aspirante->address,
            'cities_id' => $aspirante->municipioNacimiento,
            'person_types_id' => $personType,
            'artist_types_id' => $request->lineaConvocatoria,
            'expedition_place' => $aspirante->municipioExpedida,
            'place_residence' => $aspirante->municipioResidencia,
            'byrthdate' => Carbon::parse($aspirante->birthdate),
            'township' => $aspirante->vereda,
            'name_team' => $aspirante->nameTeam,
        ]);

       $user = User::where('id', '=', $id_artis)->update([
            'name' => $aspirante->name,
            'last_name' => $aspirante->lastname,
            'second_last_name' => $aspirante->secondLastname,
            'phone_1' => $aspirante->phone,
            'pdf_cedula' => $aspirante->urlPdfDocument,
            'img_document_front' => $aspirante->urlImageDocumentFrente,
            'img_document_back' => $aspirante->urlImageDocumentAtras,
            'picture' => $aspirante->urlImageProfile,
        ]);

        \Mail::to(auth()->user()->email)->send(new NewArtist($aspirante->name));
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
            'picture' => $beneficiario->urlImageProfile,
            'phone' => $beneficiario->phone,
            'adress' => $beneficiario->address,
            'biography' => $beneficiario->biografia,
            'birthday' => Carbon::parse($beneficiario->birthdate),
            'cities_id' => $beneficiario->municipioNacimiento,
            'township' => $beneficiario->vereda,
            'expedition_place' => $beneficiario->municipioExpedida,
            'place_residence' => $beneficiario->municipioResidencia,
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
            'picture' => $beneficiario->urlImageProfile,
            'phone' => $beneficiario->phone,
            'adress' => $beneficiario->address,
            'biography' => $beneficiario->biografia,
            'birthday' => Carbon::parse($beneficiario->birthdate),
            'cities_id' => $beneficiario->municipioNacimiento,
            'township' => $request->vereda,
            'expedition_place' => $request->municipioExpedida,
            'place_residence' => $beneficiario->municipioResidencia,
            //'artist_id' =>  $idArtst
        ]);
    }

    /* metodo para insertar los integrantes del grupo */
    public function insertGroupMembers($request, $idArtist) {
        foreach ($request->integrantes as $integrante) {
            $member = new Team();
            $member->name = $integrante['nameMember'];
            $member->last_name = $integrante['lastnameMember'];
            $member->second_last_name = $integrante['secondLastnameMember'];
            $member->document_type = $integrante['documentTypeMember'];
            $member->identification = $integrante['identificationMember'];
            $member->expedition_place = $integrante['municipio_expedición_member'];
            $member->place_birth = $integrante['municipio_nacimiento_member'];
            $member->place_residence = $integrante['municipio_residencia_member'];
            $member->addres = $integrante['addressMember'];
            $member->phone1 = $integrante['phoneMember'];
            $member->role = $integrante['rolMember'];
            $member->artist_id = $idArtist;

            /* Guardar archivos del documento de los integrantes */
            if ($integrante['fileType'] == '1') { // guardar imagenes
                if (isset($integrante['imgDocfrente'])) {
                    $urlS3 = $this->uploadFile($integrante['imgDocfrente']);
                    if ($urlS3) $member->img_document_front = $urlS3;
                }
                
                if (isset($integrante['imgDocAtras'])) {
                    $urlS3 = $this->uploadFile($integrante['imgDocAtras']);
                    if ($urlS3) $member->img_document_back = $urlS3;
                }
            } else { // guradar PDF
                if (isset($integrante['pdfDocument'])) {
                    $urlS3 = $this->uploadFile($integrante['pdfDocument']);
                    if ($urlS3) $member->pdf_identificacion = $urlS3;
                }
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

    /* metodo para actualizar datos del aspirante */
    public function createNewAspirant(Request $request) {
        $idArtist = -1;

        if ($request->lineaConvocatoria == '1') { // Este caso es para solistas
            if ($request->actuaraComo == '1'){
                // solo se guarda el aspirante 
                $idArtist = $this->saveNewAspirant($request);
            } else { // se debe guardar los datos del representante
                $idArtist = $this->saveNewAspirant($request);
                $this->createBeneficiario($request, $idArtist);                
            }
        } else { // Para este caso se debe guardar el representante
            $idArtist = $this->saveNewAspirant($request);
            $this->insertGroupMembers($request, $idArtist);
        }
        $this->createNewProject($request, $idArtist); // guardar proyecto        
        return redirect()->route('profile.managament', auth()->user()->slug)->with('new_register', 'El aspirante se registro de forma exitosa');
    }

    /* metodo para crear un aspirante en la base de datos */
    public function saveNewAspirant($request) {
        $aspirante = (object) $request->aspirante;

        // crear el usuario
        $user = new User();
        $user->name = $aspirante->name;
        $user->last_name = $aspirante->lastname;
        $user->second_last_name = $aspirante->secondLastname;
        $user->phone_1 = $aspirante->phone;
        $user->pdf_cedula = $aspirante->urlPdfDocument;
        $user->img_document_front = $aspirante->urlImageDocumentFrente;
        $user->img_document_back = $aspirante->urlImageDocumentAtras;
        $user->picture = $aspirante->urlImageProfile;
        $user->slug = Str::slug($aspirante->name.'-'.str_random(1000), '-');

        if ( isset($aspirante->email) ) { // si existe un correo 
            if ($aspirante->email != auth()->user()->email){ // debe ser diferente al del usuario gestor
                $password = trim(str_random(8));
                $pass = bcrypt($password);
                $user->email = $aspirante->email;
                $user->password = $pass;
                \Mail::to($user->email)->send(new NewGestorAdmin($user->email, $password));
            }   
        }
        $user->save(); // guardar datos del usuario  
        
        $personType = 3;
        if (isset($request->actuaraComo)) { $personType = $request->actuaraComo; }

        // crear el aspirante
        $aspirant = new Artist();
        $aspirant->nickname = $aspirante->name;
        $aspirant->biography = $aspirante->biografia;
        $aspirant->document_type = $aspirante->documentType;
        $aspirant->identification = $aspirante->identificacion;
        $aspirant->user_id = $user->id;
        $aspirant->adress = $aspirante->address;
        $aspirant->cities_id = $aspirante->municipioNacimiento;
        $aspirant->person_types_id = $personType;
        $aspirant->artist_types_id = $request->lineaConvocatoria;
        $aspirant->expedition_place = $aspirante->municipioExpedida;
        $aspirant->place_residence = $aspirante->municipioResidencia;
        $aspirant->byrthdate = Carbon::parse($aspirante->birthdate);
        $aspirant->township = $aspirante->vereda;
        $aspirant->name_team = $aspirante->nameTeam;
        $aspirant->gestor_id = auth()->user()->id;
        $aspirant->save();

        //\Mail::to(auth()->user()->email)->send(new NewArtist($aspirante->name));
        return $aspirant->id;
    }

    /* metodo para registrar un proyecto y asociarlo con un aspirante en la base de datos */
    public function createNewProject($request, $idArtist) {
        $song = (object) $request->song;
       
        $project = new Project();
        $project->title = $song->nameProject;
        $project->author = $song->author; 
        $project->category_id = $song->categoryID; 
        $project->audio = $song->urlSong; 
        //$project->audio_secundary_one = $song->urlSong; 
        //$project->audio_secundary_two = $song->urlSong; 
        $project->description = $song->description; 
        $project->status = 1; 
        $project->slug = Str::slug($song->nameProject.'-'.str_random(1000), '-');
        $project->save();

        $project->artists()->attach($idArtist); // relacionar el proyecto con el artista
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

    public function uploadImageProfile(Request $request)
    {
        $image = $request->file('file')->store('imageprofile', 's3');
        Storage::disk('s3')->setVisibility($image, 'public');
        $urlS3 = Storage::disk('s3')->url($image);

        return $urlS3;
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

    // actualizar pdf aspirante
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
            'pdf_cedula' => $urlS3,
            'img_document_back'=> null,
            'img_document_front'=> null,
        ]);


        return $urlS3;
    }

    //

    public function update_img_artist(Request $request)
    {

        $aspirante = (object) $request->aspirante;
        //
        $user = User::where('id', auth()->user()->id)->first();



       $user_upt = User::where('id', auth()->user()->id)->update([
            'pdf_cedula' => null,
            'img_document_front' => $aspirante->urlImageDocumentFrente,
            'img_document_back' => $aspirante->urlImageDocumentAtras,
        ]);

        return back();
    }

    // actualizar imagen beneficiario
    public function update_img_ben(Request $request)
    {

        $beneficiari = (object) $request->beneficiario;
        //
        // $user = User::where('id', auth()->user()->id)->first();

        $artist = Artist::where('user_id', auth()->user()->id)->first();
        $beneficiario = Beneficiary::where('artist_id', $artist->id)->first();

        $ben=Beneficiary::where('id', $beneficiario->id)->update([
            'pdf_documento' => null,
            'img_document_front' => $beneficiari->urlImageDocumentFrente,
            'img_document_back' => $beneficiari->urlImageDocumentFrente,
        ]);
        return back();
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
            'pdf_documento' => $urlS3,
            'img_document_front' => null,
            'img_document_back' => null,
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

        // return ;
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
