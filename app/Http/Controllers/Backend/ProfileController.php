<?php

namespace App\Http\Controllers\Backend;

use App\Artist;
use App\ArtistType;
use App\Beneficiary;
use App\Category;
use App\City;
use App\Country;
use App\DocumentType;
use App\HistoryRevision;
use App\Level;
use App\Location;
use App\Mail\NewArtist;
use App\Mail\NewArtistRegisterGestor;
use App\Mail\NewAspirantGestor;
use App\Mail\NewRevisionProjectAspirant;
use App\Mail\NewRevisionProjectSubsanador;
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
        $artist = Artist::where('user_id', auth()->user()->id)->with('documentType','projects.category','projects.observations', 'projects.historyReviews','city.departaments','users','teams.documentType','teams.expeditionPlace','teams.city.departaments','artistType','personType','beneficiary.documentType','beneficiary.city.departaments','beneficiary.expeditionPlace.departaments','beneficiary.residencePlace.departaments','teams.expeditionPlace.departaments','teams.residencePlace.departaments','expeditionPlace.departaments','residencePlace.departaments')->first();
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

        // $listAspirant = Artist::where('gestor_id', auth()->user()->id)->with('users','personType','projects')->get();

        return view('backend.gestores.aspirants-all');
    }

    public function tableManagerAspirant(User $user) {

        $listAspirant = Artist::where('gestor_id', $user->id)->with('users','personType','projects')->get();
        return datatables()->of($listAspirant)->toJson();
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
            }
        } else { // Para este caso se debe guardar el representante
            $this->insertAspirante($id_artis, $request);

            $artist = Artist::select('id')->where('user_id', $id_artis)->first();
            $existTeam = null;
            $existTeam = Team::where('artist_id', $artist->id)->first();

            /* se guardan los datos del los integrantes del grupo */
            if ($existTeam == null) {
                $this->registerAspiranteGroup($request, $artist->id);
                $this->insertGroupMembers($request, $artist->id);
            }
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
            'nickname' => ucwords($aspirante->name),
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
            'name' => ucwords($aspirante->name),
            'last_name' => ucwords($aspirante->lastname),
            'second_last_name' => ucwords($aspirante->secondLastname),
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
            'name' => ucwords($beneficiario->name),
            'last_name' => ucwords($beneficiario->lastname),
            'second_last_name' => ucwords($beneficiario->secondLastname),
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
            'name' => ucwords($beneficiario->name),
            'last_name' => ucwords($beneficiario->lastname),
            'second_last_name' => ucwords($beneficiario->secondLastname),
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

    /* metodo para registrar el aspirante como un integrante del grupo en la base de datos */
    public function registerAspiranteGroup($request, $idArtist) {
        $aspirante = (object) $request->aspirante;
        $Artist =Artist::where('id',$idArtist)->get();
        // dd($Artist[0]->user_id);

        if ($aspirante->partGroup == '1') {
            $member = new Team();
            $member->name = ucwords($aspirante->name);
            $member->last_name = ucwords($aspirante->lastname);
            $member->second_last_name = ucwords($aspirante->secondLastname);
            $member->document_type = $aspirante->documentType;
            $member->identification = $aspirante->identificacion;
            $member->expedition_place = $aspirante->municipioExpedida;
            $member->place_birth = $aspirante->municipioNacimiento;
            $member->place_residence = $aspirante->municipioResidencia;
            $member->addres = $aspirante->address;
            $member->phone1 = $aspirante->phone;
            $member->role = $aspirante->rolMember;
            $member->img_document_front = $aspirante->urlImageDocumentFrente;
            $member->img_document_back = $aspirante->urlImageDocumentAtras;
            $member->pdf_identificacion = $aspirante->urlPdfDocument;
            $member->artist_id = $idArtist;
            $member->user_id =$Artist[0]->user_id;
            $member->save();
        }
    }

    /* metodo para insertar los integrantes del grupo */
    public function insertGroupMembers($request, $idArtist) {
        if (!isset($request->integrantes)) return;

        foreach ($request->integrantes as $integrante) {
            $member = new Team();
            $member->name = ucwords($integrante['nameMember']);
            $member->last_name = ucwords($integrante['lastnameMember']);
            $member->second_last_name = ucwords($integrante['secondLastnameMember']);
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

    /* metodo para crear nuevos aspirantes desde rol gestor */
    public function createNewAspirant(Request $request) {
        $idArtist = -1;
        //dd($request);
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
            $this->registerAspiranteGroup($request, $idArtist);
            $this->insertGroupMembers($request, $idArtist);
        }
        $this->createNewProject($request, $idArtist); // guardar proyecto
        return redirect()->route('profile.managament', auth()->user()->slug)->with('new_register', 'El aspirante se registro de forma exitosa');
    }

    /* metodo para crear un aspirante en la base de datos */
    public function saveNewAspirant($request) {
        $aspirante = (object) $request->aspirante;
        $song = (object) $request->song;

        if ($aspirante->urlImageProfile == '' || $aspirante->urlImageProfile == null){
            $aspirante->urlImageProfile = '/backend/assets/app/media/img/users/perfil.jpg';
        }
        // crear el usuario
        $user = new User();
        $user->name = ucwords($aspirante->name);
        $user->last_name = ucwords($aspirante->lastname);
        $user->second_last_name = ucwords($aspirante->secondLastname);
        $user->phone_1 = $aspirante->phone;
        $user->pdf_cedula = $aspirante->urlPdfDocument;
        $user->img_document_front = $aspirante->urlImageDocumentFrente;
        $user->img_document_back = $aspirante->urlImageDocumentAtras;
        $user->picture = $aspirante->urlImageProfile;
        $user->slug = Str::slug($aspirante->name.'-'.str_random(100000), '-');

        if ( isset($aspirante->email) ) { // si existe un correo
            if ($aspirante->email != auth()->user()->email){ // debe ser diferente al del usuario gestor
                $password = trim(str_random(8));
                $pass = bcrypt($password);
                $user->email = $aspirante->email;
                $user->password = $pass;
                \Mail::to($user->email)->send(new NewGestorAdmin($user->email, $password)); // credenciales de acceso
                \Mail::to($user->email)->send(new NewArtistRegisterGestor($aspirante->name, $aspirante->lastname, $song->nameProject )); // registro exitoso
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
        $aspirant->evidence_document = $aspirante->urlEvidenceDocument;
        $aspirant->gestor_id = auth()->user()->id;
        $aspirant->save();

        $user->roles()->attach(['2']);
        \Mail::to(auth()->user()->email)->send(new NewAspirantGestor($user->name, $user->last_name, auth()->user()->name, auth()->user()->last_name)); // correo para el gestor
        return $aspirant->id;
    }

    /* metodo para registrar un proyecto y asociarlo con un aspirante en la base de datos */
    public function createNewProject($request, $idArtist) {
        $song = (object) $request->song;

        $project = new Project();
        $project->title = $song->nameProject;
        $project->author = ucwords($song->author);
        $project->category_id = $song->categoryID;
        $project->audio = $song->urlSong;
        $project->audio_secundary_one = $song->urlAdditionalSongOne;
        $project->audio_secundary_two = $song->urlAdditionalSongTwo;
        $project->description = $song->description;
        $project->status = 1;
        $project->slug = Str::slug($song->nameProject.'-'.str_random(100000), '-');
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

    public function uploadImageDocument(Request $request) {
        $image = $request->file('file')->store('imagendoc', 's3');
        Storage::disk('s3')->setVisibility($image, 'public');
        $urlS3 = Storage::disk('s3')->url($image);

        return $urlS3;
    }

    // public function uploadImageDocumentTeam(Request $request)
    // {
    //     $image = $request->file('file')->store('imagendoc', 's3');
    //     Storage::disk('s3')->setVisibility($image, 'public');
    //     $urlS3 = Storage::disk('s3')->url($image);
    //     $id = $request->headers->get('id');

    //     return [$id,$urlS3];
    // }

    public function uploadEvidenceDocument(Request $request) {
        $image = $request->file('doc')->store('evidencedoc', 's3');
        Storage::disk('s3')->setVisibility($image, 'public');
        $urlS3 = Storage::disk('s3')->url($image);
        return $urlS3;
    }

    public function uploadPDFDocument(Request $request) {
        $image = $request->file('file')->store('pdfdoc', 's3');
        Storage::disk('s3')->setVisibility($image, 'public');
        $urlS3 = Storage::disk('s3')->url($image);

        return $urlS3;
    }

    public function photo(Request $request) {
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

    public function photo_beneficiario(Request $request)
    {
        $artist = Artist::where('user_id', auth()->user()->id)->first();
        $beneficiario = Beneficiary::where('artist_id', $artist->id)->first();
        $ben_picture =  str_replace('storage', '', $beneficiario->picture);;
        //Elimnar foto de perfil del servidor
        Storage::delete($ben_picture);
        //Agregar la nueva foto de perfil
        $photo = $request->file('photo')->store('users');
        Beneficiary::where('id', $beneficiario->id)->update([
            'picture' => '/storage/' . $photo
        ]);

        return $ben_picture;
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

        $team = Team::where('user_id', auth()->user()->id)->first();


        //Elimnar pdf de cédula o tarjeta
        Storage::disk('s3')->delete($user->pdf_cedula);
        //Agregar cedula o tarjeta de identidad
        $pdf_cedula_save = $request->file('pdf_cedula_name')->store('pdfdoc','s3');
        Storage::disk('s3')->setVisibility($pdf_cedula_save, 'public');
        $urlS3 = Storage::disk('s3')->url($pdf_cedula_save);

        if($team && $team->user_id){
            Team::where('user_id', $team->user_id)->update([
                'pdf_identificacion' => $urlS3,
                'img_document_front' => null,
                'img_document_back' => null,
            ]);

        }

        User::where('id', auth()->user()->id)->update([
            'pdf_cedula' => $urlS3,
            'img_document_back'=> null,
            'img_document_front'=> null,
        ]);


        return $urlS3;
    }

    // actualizar el documento en pdf desde el rol de gestor
    public function pdf_cedula_aspirante_gestor(Request $request)
    {

        $idUser=$request->headers->get('idAspirante');
        // dd($idUser);
        $user = User::where('id',$idUser )->first();
        $team = Team::where('user_id', $user->id)->first();
        // $pdf_cedula =  str_replace('storage', '', $user->pdf_cedula);
        //Elimnar pdf de cédula o tarjeta
        Storage::disk('s3')->delete($user->pdf_cedula);
        //Agregar cedula o tarjeta de identidad
        $pdf_cedula_save = $request->file('pdf_cedula_name')->store('pdfdoc','s3');
        Storage::disk('s3')->setVisibility($pdf_cedula_save, 'public');
        $urlS3 = Storage::disk('s3')->url($pdf_cedula_save);

       if($team && $team->user_id){
            Team::where('user_id', $team->user_id)->update([
                'pdf_identificacion' => $urlS3,
                'img_document_front' => null,
                'img_document_back' => null,
            ]);

         }

        User::where('id',$idUser)->update([
            'pdf_cedula' => $urlS3,
            'img_document_back'=> null,
            'img_document_front'=> null,
        ]);


        return $urlS3;
    }

    public function pdf_soporte_aspirante_gestor(Request $request)
    {



        $idUser=$request->headers->get('idAspirante');
        // dd($idUser);
        $user = User::where('id',$idUser )->first();

        // $pdf_cedula =  str_replace('storage', '', $user->pdf_cedula);
        //Elimnar pdf de cédula o tarjeta
        $image = $request->file('doc')->store('evidencedoc', 's3');
        Storage::disk('s3')->setVisibility($image, 'public');
        $urlS3 = Storage::disk('s3')->url($image);


        Artist::where('user_id',$idUser)->update([
            'evidence_document' => $urlS3,

        ]);


        return $urlS3;
    }

    //actualizar la imagen del documento desde el perfil del aspirante

    public function update_img_artist(Request $request)
    {

        $aspirante = (object) $request->aspirante;

        $team = Team::where('user_id', auth()->user()->id)->first();

        $user = User::where('id', auth()->user()->id)->first();
        if($team && $team->user_id){
            Team::where('user_id', $team->user_id)->update([
                'pdf_identificacion' => null,
                'img_document_front' => $aspirante->urlImageDocumentFrente,
                'img_document_back' => $aspirante->urlImageDocumentAtras,
            ]);

        }


       $user_upt = User::where('id', auth()->user()->id)->update([
            'pdf_cedula' => null,
            'img_document_front' => $aspirante->urlImageDocumentFrente,
            'img_document_back' => $aspirante->urlImageDocumentAtras,
        ]);

        return back();
    }
    //actualizar la imagen del documento desde el perfil del gestor
    public function update_img_artist_gestor(Request $request)
    {

        $aspirante = (object) $request->aspirante;
        // dd($aspirante);
        //
        $user = User::where('id', $aspirante->idAspirante)->first();
        $team = Team::where('user_id', $aspirante->idAspirante)->first();
        if($team && $team->user_id){
                    Team::where('user_id', $team->user_id)->update([
                        'pdf_identificacion' => null,
                        'img_document_front' => $aspirante->urlImageDocumentFrente,
                        'img_document_back' => $aspirante->urlImageDocumentAtras,
                    ]);

                }




       $user_upt = User::where('id', $aspirante->idAspirante)->update([
            'pdf_cedula' => null,
            'img_document_front' => $aspirante->urlImageDocumentFrente,
            'img_document_back' => $aspirante->urlImageDocumentAtras,
        ]);

        return back() ;
    }

    // actualizar imagen documento beneficiario
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
            'img_document_back' => $beneficiari->urlImageDocumentAtras,
        ]);
        return back();
    }

    // actualizar imagen documento beneficiario desde el perfil del gestor
    public function update_img_ben_gestor(Request $request)
    {

        $beneficiari = (object) $request->beneficiario;
        //
        // $user = User::where('id', auth()->user()->id)->first();

        // $artist = Artist::where('user_id', auth()->user()->id)->first();
        // $beneficiario = Beneficiary::where('artist_id', $artist->id)->first();

        $ben=Beneficiary::where('id', $beneficiari->idBeneficiario)->update([
            'pdf_documento' => null,
            'img_document_front' => $beneficiari->urlImageDocumentFrente,
            'img_document_back' => $beneficiari->urlImageDocumentAtras,
        ]);
        return back();
    }

// actualizar imagen documento team
    public function update_img_team(Request $request)
    {


        $teams = (object) $request->team;
        $team = Team::where('id',$teams->id )->first();

        if($team && $team->user_id){
            // dd('hola');
            User::where('id',$team->user_id)->update([
                'pdf_cedula' => null,
                'img_document_front' => $teams->urlImageDocumentFrente,
                'img_document_back' => $teams->urlImageDocumentAtras,
            ]);
        }

        Team::where('id', $teams->id)->update([
            'pdf_identificacion' => null,
            'img_document_front' => $teams->urlImageDocumentFrente,
            'img_document_back' => $teams->urlImageDocumentAtras,
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

    // actualizar el pdf del aspirante desde el perfil del gestor
    public function pdf_cedula_beneficiario_gestor(Request $request)
    {

        $idUser=$request->headers->get('idAspirante');
        // $user = User::where('id', auth()->user()->id)->first();
        $artist = Artist::where('user_id', $idUser)->first();
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

        $teamid=$request->headers->get('id');

        $team = Team::where('id',$teamid)->first();

        Storage::disk('s3')->delete($team->pdf_identificacion);
        //Agregar cedula o tarjeta de identidad
        $pdf_cedula_save = $request->file('pdf_cedula_name')->store('pdfdoc','s3');
        Storage::disk('s3')->setVisibility($pdf_cedula_save, 'public');
        $urlS3 = Storage::disk('s3')->url($pdf_cedula_save);

        if($team && $team->user_id){
            // dd('hola');
            User::where('id',$team->user_id)->update([
                'pdf_cedula' => $urlS3,
                'img_document_back'=> null,
                'img_document_front'=> null,
            ]);
        }

        Team::where('id', $teamid)->update([
            'pdf_identificacion' => $urlS3,
            'img_document_front' => null,
            'img_document_back' => null,
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

    public function update_state_revision(Request $request){
        $idProject = $request->get('project_id');
        $userSubsanador = Project::where('id', $request->get('project_id'))->with('historyReviews')->first();

        $stateProjectRevision = $request->get('state_revision');
        $project = Project::where('id', $idProject)->update(['status' => $stateProjectRevision]);
        $projectName = Project::where('id', $idProject)->first();

        HistoryRevision::where('project_id', $request->get('project_id'))->orWhere('state','<>' ,1)->update(['state' => 2, '']);

        /*ENVIO DE CORREO AL ASPRIANTE*/
        \Mail::to(auth()->user()->email)->send(new NewRevisionProjectAspirant(auth()->user()->name, auth()->user()->last_name, $projectName->title));
        /*ENVIO DE CORREO AL SUBSANADOR*/
        \Mail::to($userSubsanador->historyReviews[0]->email)->send(new NewRevisionProjectSubsanador($userSubsanador->historyReviews[0]->name, $userSubsanador->historyReviews[0]->last_name, $projectName->title,auth()->user()->name, auth()->user()->last_name));

        return back()->with('exitoso', 'Se ha enviado su correción exitosamente');
    }
}
