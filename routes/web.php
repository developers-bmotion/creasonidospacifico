<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*=============================================
CONSULTAS DE PRUEBAS
=============================================*/

use App\Artist;
use App\Mail\ArtistProjectRevision;
use App\Mail\NewArtist;
use App\Project;
use App\Role;
use App\User;
Route::get('/curadores', function (){
   return \App\Management::with('users')->get();
});
Route::get('/datos', function () {

    $listRating = Artist::with('users','personType','projects.category','documentType','city.departaments')
        ->whereHas('projects', function($q){
            $q->where('status',2);
        })->get();
//    return $listRating;
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
            'rating' => Project::sumRating( $aspirants->projects[0]->id)
        ]);
    }

    usort($aspirantRating, function ($a, $b) {
        $diff = $b->rating - $a->rating;
        return $diff;
    });

    return datatables()->of($aspirantRating)->toJson();


//     $listAspirant = Artist::with('users','personType','projects.category','documentType','city.departaments')->get();
//     return $listAspirant;
});

Route::get('/register', function (){
   return redirect('/login');
});

Route::get('/tabla-curadores', function (){
    $project = \App\Project::where('status','!=',1)->whereHas('management', function ($query) {
        $query->where('managements.user_id', '=', 398);
    })->with('category','artists.users', 'reviews');

    return datatables()->of($project)->toJson();
});

Route::get('/represtante-menor-edad/{id}', function ($id) {
    $artist = Artist::where('id', $id)
        ->with('users', 'beneficiary.documentType', 'beneficiary.city.departaments', 'beneficiary.expeditionPlace.departaments', 'personType', 'artistType', 'documentType')
        ->first();
    return $artist;
});

Route::get('/offline', function () {
    return view('vendor.laravelpwa.offline');
});

Route::get('/prueba-email', function () {
    return new \App\Mail\AspiringCorrection('Mauricio','Gutierrez', 'Pedors', 'holas');
});

Route::get('/')->middleware('');
// Artisan::call('projects:close');
// dd(\App\Category::where('typeCategory_id', $id_category)->get());


Route::get('email/{name}', function ($name) {

    return new \App\Mail\NewArtist($name);
});
Route::get('fecha', function () {
    $date = date('Y-m-d H:i:s');
    $semana2 = date("Y-m-d H:i:s", strtotime($date . "+ 2 week"));
    echo $semana2;
});
Route::get('/count/{id}', function ($id) {
    $hola = \App\Management::select('id')->where('user_id', $id)->first();
    dd($hola->id);
});
Route::get('/projects-sql', function () {
    $projects = \App\Artist::where('user_id', auth()->user()->id)->exists();
    dd($projects);
});
Route::get('/team-all/{id}', function ($id) {
    $artists = \App\Project::where('id', $id)->with('teams')->get();
    return datatables()->of($artists)->toJson();
});
Route::get('/managements/{id}', function ($id) {
    /* $manage_project = \Illuminate\Support\Facades\DB::table('management_project')
         ->select('project_id')->where('management_id',1)
         ->get();
      $array_project = array();
     for ( $i=0; $i<count($manage_project); $i++) {
         $projects = \App\Project::where('id', $manage_project[$i]->project_id)->with('artists')->get();
         $json_project = json_decode($projects);
         array_push($array_project,$json_project);
     }

     $project = \App\Project::whereHas('management', function ($query) {
         $query->where('managements.id', '=', 1);
     })->get();

      return datatables()->of($project)->toJson();*/

    /*   $projects = \App\Artist::where('user_id',$id)->with(
              [   'users',
                  'countries',
                  'projects' => function ($q){
                      $q->select('*')
                          ->where('status',\App\Project::APPROVAL)
                          ->OrWhere('status',\App\Project::PUBLISHED);
                  }
              ])->latest()
              ->first();

          return $projects; */
});
/*=============================================
SELECCIONAR IDIOMAS
=============================================*/
Route::get('/set_language/{lang}', 'Controller@setLanguage')->name('set_language');

Route::get('/', 'Auth\LoginController@index')->name('home')->middleware('home');
/*=============================================
FRONTEND
=============================================*/
Route::group(['namespace' => 'Frontend'], function () {
    //Rutas para el modulo HOME
    /* Route::get('/','HomeController@index')->name('home')->middleware('home'); ; */

    //Rutas para el modulo PROJECTS
    Route::get('/projects', 'ProjectsController@index')->name('projects');
    Route::get('/about-us', 'HomeController@nosotros')->name('about-us');
    Route::get('/info-artist', 'HomeController@artist')->name('info-artist');
    Route::get('/info-backer', 'HomeController@backer')->name('info-backer');

    Route::get('/projects/{project}', 'ProjectsController@show')->name('projects.show');
    Route::get('/projectsArt/{user}', 'ProjectsController@projectArtist')->name('projects.artist');

    Route::get('/projects-for-category', 'ProjectsController@getByCategory');
    Route::get('/projects-for-category-completed', 'ProjectsController@getByCategoryCompleted');


    //Rutas para las Categorias
    Route::get('/projects/category/{category}', 'CategoriesController@show')->name('categories.show');
});

/*=============================================
BACKEND
=============================================*/
Route::group(['namespace' => 'Backend', 'prefix' => 'dashboard', 'middleware' => ['auth', 'acceso_login']], function () {
    //Rutas para el modulo Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');

    //Rutas para el modulo Artistas
    Route::get('/artists', 'ArtistsController@index')->name('index.artists');
    Route::get('/artists-all-table', 'ArtistsController@table_all_artists')->name('all.artists.table');
    Route::get('/artists-manager-table/{user}', 'ProfileController@tableManagerAspirant')->name('artists.manager.table');

    /*=============================================
       NUEVAS RUTAS PARA EL REGISTRO
    =============================================*/
    Route::get('/form-register', 'ProfileController@index')->name('form.register');
    Route::get('/form-gestor', 'ProfileController@indexGestor')->name('form.gestor');
    Route::get('/list-aspirant-gestor', 'ProfileController@ListAspirantGestor')->name('list.aspirant.gestor');
    Route::post('/upload-image-document', 'ProfileController@uploadImageDocument')->name('upload.image.document');
    // Route::post('/upload-image-document-team','ProfileController@uploadImageDocumentTeam')->name('upload.image.document.team');
    Route::post('/upload-image-profile', 'ProfileController@uploadImageProfile')->name('upload.image.profile');
    Route::post('/upload-pdf-document', 'ProfileController@uploadPDFDocument')->name('upload.pdf.document');
    Route::post('/upload-evidence-document', 'ProfileController@uploadEvidenceDocument')->name('upload.evidence.document');
    Route::post('/create-new-aspirant', 'ProfileController@createNewAspirant')->name('create.new.aspirant');

    //RUTAS PARA EL PERFIL
    //Perfil Artista
    Route::get('/profile', 'ProfileController@index_artist')->name('profile.artist')->middleware('register_artist');
    Route::post('/profile-photo-artist', 'ProfileController@photo')->name('profile.photo.artist');
    Route::post('/profile-photo-beneficiario', 'ProfileController@photo_beneficiario')->name('profile.photo.beneficiario');

    Route::post('/front-photo-artist', 'ProfileController@front_photo')->name('front.photo.artist');

    Route::post('/pdf-cedula-aspirante', 'ProfileController@pdf_cedula_aspirante')->name('cedula.pdf.aspirante');
    Route::post('/pdf-cedula-aspirante-gestor', 'ProfileController@pdf_cedula_aspirante_gestor')->name('cedula.pdf.aspirante.gestor');
    Route::post('/soporte-aspirante-gestor', 'ProfileController@pdf_soporte_aspirante_gestor')->name('soporte.aspirante.gestor');
    Route::post('/pdf-cedula-beneficiario', 'ProfileController@pdf_cedula_beneficiario')->name('cedula.pdf.beneficiario');
    Route::post('/pdf-cedula-beneficiario-gestor', 'ProfileController@pdf_cedula_beneficiario_gestor')->name('cedula.pdf.beneficiario.gestor');
    Route::post('/pdf-cedula-team', 'ProfileController@pdf_cedula_team')->name('cedula.pdf.team');
    Route::post('/update-audio', 'ProfileController@update_audio')->name('update.audio');
    Route::put('/update-state-revision', 'ProfileController@update_state_revision')->name('update.state.revision');


    Route::put('/update-profile-artist/{id_artis}', 'ProfileController@profile_update_artist')->name('update.profile.artist');
    Route::put('/update-img-artist', 'ProfileController@update_img_artist')->name('update.imgdoc.artist');
    Route::put('/update-img-artist-gestor', 'ProfileController@update_img_artist_gestor')->name('update.imgdoc.artist.gestor');
    Route::put('/update-img-ben', 'ProfileController@update_img_ben')->name('update.imgdoc.ben');
    Route::put('/update-img-ben-gestor', 'ProfileController@update_img_ben_gestor')->name('update.imgdoc.ben.gestor');
    Route::put('/update-img-team', 'ProfileController@update_img_team')->name('update.imgdoc.team');

    Route::get('/get-municipios/{id}', 'ProfileController@get_municipios')->name('get.municipios');

    Route::get('/expedicion-departamento/{id}', 'ProfileController@get_departamento')->name('get.exped.departamento');

    Route::get('/expedicion-municipio/{id}', 'ProfileController@get_municipio')->name('get.exped.municipio');


    Route::post('/update-password-artist', 'ProfileController@update_password')->name('update.password.artist');
    //Proyectos del Artista
    Route::get('/my-projects', 'MyProjectsController@index_artist')->name('myprojects.artist')->middleware('register_artist');
    Route::get('/config-profile-artist', 'MyProjectsController@config_profile_artist')->name('config.profile.artist')->middleware('register_artist');
    //Apoyos hechos
    Route::get('/backings-made', 'BackingsMadeController@index_artist')->name('backings.made.artist');

    //RUTAS PARA AGREGAR PROYECTOS

    Route::get('/new-project', 'AddProjectController@index')->name('add.project')->middleware(['register_artist', 'exist_project_artist']);

    Route::post('/add-project-audio', 'AddProjectController@upload_image')->name('add.project.audio');
    Route::post('/add-audio-one', 'AddProjectController@audio_one')->name('add.audio.one');
    Route::post('/add-audio-two', 'AddProjectController@audio_two')->name('add.audio.two');
    Route::post('/add-project', 'AddProjectController@store')->name('add.store.project');
    Route::get('/categories_by_id/{id_category}', 'AddProjectController@categoryById');

    //RUTAS PARA VER EL PROJECT
    Route::get('/project/{project}', 'ShowProjectController@index')->name('show.backend.project');
    Route::get('/team-all/{id}', function ($id) {
        $teams = \App\Project::where('id', $id)->with('teams')->get()[0]->teams;
        return datatables()->of($teams)->toJson();
    })->name('team-artist');
    Route::post('/add-review-yuri', 'Manage\ProjectsManageController@add_review_yuri')->name('add.review.yuri');
    Route::get('/managements-admin', 'Admin\ManagementsController@index')->name('managements.admin');
    //RUTAS PARA EL ADMINISTRADOR DEL SISTEMA -------------------------------------------------------------------------------------------

    //Todos los proyectos....
    Route::get('/managements', 'ShowProjectController@table_assing_management')->name('assign.managements');
    Route::group(['middleware' => 'admin_permisos'], function () {

        // Route::post('/add-review-yuri', 'Manage\ProjectsManageController@add_review_yuri')->name('add.review.yuri');
        Route::get('/projects-approved', 'Admin\ProjectsApprovedController@index')->name('projects.approved');
        Route::post('publicarProject', 'Admin\ProjectsApprovedController@togglePublish');
        //Lista proyectos managements
        Route::get('/projects-admin', 'Admin\ProjectsAdminController@index')->name('projects.admin');
        Route::put('/project-rejected-admin', 'Admin\ProjectsAdminController@rejected_project')->name('project.admin.rejected');
        Route::put('/project-finalist-admin', 'Admin\ProjectsAdminController@finalist_project')->name('project.admin.finalist');
        Route::put('/project-finalist-admin-yuri', 'Admin\ProjectsAdminController@finalist_project_yuri')->name('project.admin.finalist.yuri');
        Route::put('/project-pendiente-soporte-admin', 'Admin\ProjectsAdminController@pediente_soporte_project')->name('project.admin.pendiente.soporte');
        Route::post('/project-revision-admin', 'Admin\ProjectsAdminController@revision_project')->name('project.admin.revision');
        Route::get('/datatables-projects-admin', 'Admin\ProjectsAdminController@table_projects')->name('datatables.projects.admin');
        Route::get('/datatables-projects-admin-approved', 'Admin\ProjectsAdminController@table_projects_approved')->name('datatables.projects.admin.approved');
        Route::get('/datatables-managements-admin', 'Admin\ProjectsAdminController@table_managements')->name('datatables.management.admin');
        //Lista de managaments

        Route::get('/gestores-admin', 'Admin\ManagementsController@gestores')->name('gestores.admin');

        Route::post('/add-management-admin', 'Admin\ManagementsController@store')->name('add.management.admin');
        Route::post('/add-gestores-admin', 'Admin\UserController@storeUsers')->name('add.gestores.admin');

//      /* Rutas para los usuarios */
        Route::get('/users-admin', 'Admin\UserController@index')->name('user.admin.index');
        Route::get('/users-system', 'Admin\UserController@getUsersTable')->name('get.users.tables');
        Route::post('/add-users-admin', 'Admin\UserController@storeUsers')->name('add.users.admin');

        //ruta para el perfil del admin
        Route::get('/profile-admin/{user}', 'Admin\ProfileAdminController@indexAdmin')->name('profile.admin');
        Route::post('/update-password-admin', 'Admin\ProfileAdminController@update_password_admin')->name('update.password.admin');
        Route::post('/profile-photo-admin', 'Admin\ProfileAdminController@photo_admin')->name('profile.photo.admin');

        Route::post("/projects-news", "Admin\DashboardAdminController@showProyect")->name("admin.projects_news");
        Route::get("/aspirants-all", "Admin\DashboardAdminController@AspirantsAll")->name("aspirants.all");
        Route::get("/list-ratings", "Admin\DashboardAdminController@ratings")->name("list.ratings");
        Route::get("/list-ratings-second", "Admin\DashboardAdminController@ratings_second")->name("list.ratings.second");
        Route::get("/list-ratings-finalist", "Admin\DashboardAdminController@ratings_finalist")->name("list.ratings.finalist");
        Route::get("/list-finalist-yuri", "Admin\DashboardAdminController@ratings_yuri")->name("list.finalist.yuri");
        Route::get("/list-finalist", "Admin\DashboardAdminController@list_finalist")->name("list.finalist");
        Route::post("/top-countries", "Admin\DashboardAdminController@showTopCountry")->name("admin.top_country");

        Route::get('/aspirants-cities', 'DashboardController@getCitiesAspirants')->name('get.aspirants.cities');
        Route::get('/aspirants-categories', 'DashboardController@getModalidadesAspirants')->name('get.aspirants.modalidades');

        Route::get('/report-dashboard', 'DashboardController@reportDashboard')->name('report.pdf.dashboard');

    });

    //RUTAS PARA EL MANAGEMENT -------------------------------------------------------------------------------------------
    Route::group(['middleware' => 'manage_permisos'], function () {
        Route::get('/projects-management', 'Manage\ProjectsManageController@index')->name('projects.manage');
        Route::get('datatables-projects-manage', 'Manage\ProjectsManageController@table_projects')->name('datatables.projects.manage');
        Route::post('/add-review-second', 'Manage\ProjectsManageController@add_review_second')->name('add.review.second');
        // Route::post('/add-review-yuri', 'Manage\ProjectsManageController@add_review_yuri')->name('add.review.yuri');

        //CALIFICAR PROYECTO POR EL MANAGEMENT
        // Route::post('/update-review-management', 'Manage\ProjectsManageController@add_review')->name('update.review.management');
        //Calificar propuestas
        Route::post('/add-review-second', 'Manage\ProjectsManageController@add_review_second')->name('add.review.second');
        Route::post('/add-review', 'Manage\ProjectsManageController@add_review')->name('add.review');

        Route::post('/add-review', 'Manage\ProjectsManageController@add_review')->name('add.review');

    });
    Route::get('/profile-managament/{user}', 'Manage\ProfileController@index')->name('profile.curador');
    Route::get('/profile-my_proyects/{user}', 'Manage\ProfileController@my_proyects')->name('profile.managament.myProyects');
    Route::put('/update-info-profile-manage/{id}', 'Manage\ProfileController@update_profile_management')->name('update.profile.management');
    Route::post('/profile-photo-management', 'Manage\ProfileController@photo_management')->name('profile.photo.management');
    Route::get('datatables-projects-profile-manage', 'Manage\ProfileController@table_proyects')->name('datatables.projects.profile.manage');
    Route::get('/datatables-projects-profile-manage-rating', 'Manage\ManageRatingController@table_project_rating')->name('datatables.projects.profile.manage.rating');
    Route::get('/datatables-projects-manage-calification-two', 'Manage\ManageRatingController@get_table_calification_two')->name('datatables.projects.calification.manage.two');
    Route::post('/update-password-management', 'Manage\ProfileController@update_password_management')->name('update.password.management');
    Route::get('/backings-made-magement/{user}', 'Manage\BackingsMadeController@index')->name('backings.made.manage');

    //RUTAS PARA EL GESTOR -------------------------------------------------------------------------------------------
    Route::get('/profile-gestor/{user}', 'Gestor\ProfileController@index')->name('profile.managament');
    Route::post('/profile-photo-gestor', 'Gestor\ProfileController@photo_gestor')->name('profile.photo.gestor');
    Route::post('/update-password-gestor', 'Gestor\ProfileController@update_password_gestor')->name('update.password.gestor');

    //RUTAS PARA EL SUBSANADOR -------------------------------------------------------------------------------------------
    Route::get('/profile-subsanador/{user}', 'Subsanador\ProfileController@index')->name('profile.subsanador')->middleware('subsanador_permisos');
    Route::post('/profile-photo-subsanador', 'Subsanador\ProfileController@photo_subsanador')->name('profile.photo.subsanador')->middleware('subsanador_permisos');
    Route::post('/update-password-subsanador', 'Subsanador\ProfileController@update_password_subsanador')->name('update.password.subsanador')->middleware('subsanador_permisos');

    //Enviar Mensajes a managers
    Route::post("send-project-management", "Admin\ProjectsAdminController@send_project_management")->name("send.project.admin");

});


/*=============================================
RUTA PARA CREAR CUENTA
=============================================*/

Route::post('register-artist', 'Auth\RegisterController@create')->name('register.artist');

/*=============================================
RUTAS PARA LOGIN REDES SOCIALES
=============================================*/
Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider')->name('social_auth');
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');
/*=============================================
AUTH RUTAS DE SEGURIDAD
=============================================*/
Auth::routes();

Route::get('/images/{path}/{attachment}', function ($path, $attachment) {
    $file = sprintf('storage/%s/%s', $path, $attachment);
    if (File::exists($file)) {
        return \Intervention\Image\Facades\Image::make($file)->response();
    }
});

Route::post("registrar", "Auth\RegisterController@registrar")->name("registrar");
/* Route::get('/crear-cuenta', function(){
 return view('auth.register');
});
 */

/*=============================================
AUTH RUTAS DE SEGURIDAD
=============================================*/

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');


Route::get('/test', function () {
    $project = \App\Project::with(['artists', 'management'])->get();
    $artist = count($project[0]->artists) > 0 ? $project[0]->artists[0] : null;

    foreach ($project[0]->management as $management) {
        $managementUser = $management->users;
        $managementUser->notify(new \App\Notifications\UpdatedProject($project[0]));
    }
    if ($artist) {
        $artist->users()->first()->notify(new \App\Notifications\UpdatedProject($project[0]));
    }
});

Route::get('/udpdate-project-cron', 'Backend\AddProjectController@updateProjectCron')->name('update.project.cron');
Route::resource('project-message', 'Backend\ProjectMessageController');
Route::get('project-message-artist', 'Backend\ProjectMessageController@showProjectsByArtist');
Route::patch('notification-read/{id}', 'Backend\NotificationController@read');
