@extends('backend.layout')

@section('header')
    <div class="row">
        <div class="col-md-4 col-lg-4 col-12">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h1 class="m-subheader__title--separator">Perfil del aspirante</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-12">
            @if(count(\App\Artist::projects_artist(auth()->user()->id)) === 0)
                <div class="m-alert m-alert--icon m-alert--outline alert alert-warning" role="alert">
                    <div class="m-alert__icon">
                        <i class="la la-warning"></i>
                    </div>
                    <div class="m-alert__text">
                        Aún no has <strong>registrado tu propuesta musical,</strong>
                        debes registrarla para poder participar.
                    </div>
                    <div class="m-alert__actions" style="width: 200px;">
                        <a href="{{ route('add.project') }}" type="button"
                           class="btn btn-warning btn-sm m-btn m-btn--pill m-btn--wide"
                           style="color:#fff">Subir canción
                        </a>
                    </div>
                </div>
            @endif
            @if(count($artist->projects) !== 0)

                @if($artist->projects[0]->status == 4)
                <!--=====================================
		        ALERTA PARA MOSTRAR EL ESTADO PENDIENTE
            ======================================-->
                    <div class="m-alert m-alert--icon m-alert--outline alert alert-warning" role="alert">
                        <div class="m-alert__icon">
                            <i class="la la-warning"></i>
                        </div>
                        <div class="m-alert__text">
                            Tu propuesta musical esta en estado <strong>Pendiente</strong>, click
                            <strong data-toggle="modal" data-target="#verObservaciones"
                                    style="cursor: pointer">aquí</strong> para ver los detalles que debes ajustar.
                            Al terminar y estar seguro que todo esta bien, volver a enviar.
                        </div>
                        <div class="m-alert__actions" style="width: 200px;">
                            <button type="button" class="btn btn-warning btn-sm m-btn m-btn--pill m-btn--wide"
                                    style="color:#fff">Enviar propuesta musical nuevamente
                            </button>
                        </div>
                    </div>
                @endif
            @endif

        </div>

    </div>
@stop
@section('content')
    <div class="m-content">
        <!--=====================================
            MOSTAR ALERTA PARA CREAR PROYECTO
        ======================================-->
        @if(session()->has('profile_update'))
            <div class="m-alert m-alert--icon m-alert--outline alert alert-success" role="alert">
                <div class="m-alert__icon">
                    <i class="la la-check"></i>
                </div>
                <div class="m-alert__text">
                    <strong>{{ __('bien_hecho') }}!</strong> {{session('profile_update')}}
                    <i class="la la-hand-o-right pull-right" style="font-size: 25px"></i>
                </div>
                <div class="m-alert__actions" style="width: 30px;">
                    <a href="{{ route('add.project') }}"
                       class="btn m-btn--pill btn-success">{{ __('nuevo_proyecto') }}
                    </a>
                </div>
            </div>
        @endif
    <!--=====================================
        ALERTA LUEGO CREAR LA CUENTA
    ======================================-->
        @if(session()->has('welcome_register'))
            <div class="m-alert m-alert--icon m-alert--outline alert alert-success" role="alert">
                <div class="m-alert__icon">
                    <i class="la la-check"></i>
                </div>
                <div class="m-alert__text">
                    <strong>{{ __('bien_hecho') }}!</strong> {{session('welcome_register')}}
                </div>
            </div>

        @endif
        <div class="row">
            <div class="col-xl-3 col-lg-3">
                @include('backend.profile.partials.sidebar-profile')
            </div>
            <div class="col-xl-9 col-lg-9">
                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary"
                                role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab"
                                       href="#m_user_profile_tab_1"
                                       role="tab">
                                        <i class="flaticon-share m--hide"></i>
                                        Información del aspirante o representante
                                    </a>
                                </li>
                                {{-- @dd($artist); --}}
                                @if(count($artist->projects) !== 0)
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2"
                                           role="tab">
                                            Propuesta Musical
                                        </a>
                                    </li>
                                @endif
                                @if(count($artist->beneficiary) !== 0)
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab"
                                           href="#m_user_profile_tab_4"
                                           role="tab">Información del menor de edad
                                        </a>
                                    </li>
                                @endif
                                @if(count($artist->teams) !== 0)
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab"
                                           href="#m_user_profile_tab_3"
                                           role="tab">Información del grupo musical
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        {{-- @include('backend.profile.partials.actions-perfil') --}}
                    </div>
                    <div class="tab-content">


                        <!--=====================================
                            ACTUALIZAR PERFIL DEL USUARIO
                            ======================================-->
                        <div class="tab-pane active" id="m_user_profile_tab_1">
                            <div class="biografia col-md-10 ml-5 mt-5">
                                <div class="row">

                                    @if ($artist->users->picture)

                                        <div class="col-md-4 mb-4">
                                            <div class="m-scrollable update_asp_profile" data-scrollable="true"
                                                 style="">
                                                @if(auth()->user()->picture == null || auth()->user()->picture == '' || auth()->user()->picture =='/images/users/')
                                                    <img class="ml-4"
                                                         style="border-radius:8rem; width:7rem"
                                                         src="/backend/assets/app/media/img/users/perfil.jpg">
                                                    <i class="flaticon-edit ml-3 update_img_profile_asp"
                                                       style="color:#716aca; cursor:pointer;"></i>
                                                @else
                                                    <img class="ml-4"
                                                         style="border-radius:8rem; width:7rem"
                                                         src="{{$artist->users->picture}}">
                                                    <i class="flaticon-edit ml-3 update_img_profile_asp"
                                                       style="color:#716aca; cursor:pointer;"></i>
                                                @endif
                                            </div>
                                            <div class="col-md-4 drop_prof_asp" style="display: none">
                                                <div class="form-group m-form__group ">

                                                    <div class="m-dropzone dropzone_prof_asp m-dropzone--success"
                                                         action="inc/api/dropzone/upload.php"
                                                         id="m-dropzone-three" style="width: 14rem;height: -1px;">
                                                        <div
                                                            class="m-dropzone__msg dz-message needsclick">
                                                            <h3 class="m-dropzone__msg-title">{{ __('actualizar_foto_perfil') }}</h3>
                                                            <span
                                                                class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary cancel_prof_asp"
                                                        style="display:none">Cancelar
                                                </button>

                                            </div>


                                        </div>
                                    @else

                                        <div class="col-md-4 mb-4 update_asp_profile">
                                            <div class="m-scrollable" data-scrollable="true"
                                                 style="">
                                                <img class="ml-4"
                                                     style="border-radius:8rem; width:7rem"
                                                     src="/default/user.png">
                                                <i class="flaticon-edit ml-3 update_img_profile_asp"
                                                   style="color:#716aca; cursor:pointer;"></i>
                                            </div>

                                        </div>
                                        <div class="col-md-4  drop_prof_asp" style="display: none">
                                            <div class="form-group m-form__group ">

                                                <div class="m-dropzone dropzone_prof_asp m-dropzone--success"
                                                     action="inc/api/dropzone/upload.php"
                                                     id="m-dropzone-three" style="width: 14rem;height: -1px;">
                                                    <div
                                                        class="m-dropzone__msg dz-message needsclick">
                                                        <h3 class="m-dropzone__msg-title">{{ __('actualizar_foto_perfil') }}</h3>
                                                        <span
                                                            class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary cancel_prof_asp"
                                                    style="display:none">Cancelar
                                            </button>
                                        </div>

                                    @endif

                                    <div class="col-md-4">
                                        <label style="font-weight: bold">Nombre:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->users->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-weight: bold">Apellidos:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->users->last_name }} {{ $artist->users->second_last_name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-weight: bold">Tipo de identificación:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->documentType->document }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-weight: bold">Nº Identificación:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->identification }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <label style="font-weight: bold">{{ __('Departamento de Expedición') }}:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">

                                            @if($artist->expeditionPlace->departaments)
                                                <p style="text-align: justify">{{ $artist->expeditionPlace->departaments->descripcion }}</p>
                                            @else
                                                <p>No registrado</p>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <label style="font-weight: bold">{{ __('Ciudad de Expedición') }}:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p style="text-align: justify">{{ $artist->expeditionPlace->descripcion }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-weight: bold">Dirección de residencia:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->adress }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-weight: bold">Departamento de residencia:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            @if($artist->residencePlace)
                                            {{$artist->residencePlace->departaments->descripcion}}</p>
                                            @endif

                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-weight: bold">Ciudad de residencia:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            @if($artist->residencePlace)
                                            {{$artist->residencePlace->descripcion}}</p>
                                            @endif
                                        </div>

                                    </div>
                                    @if($artist->township)
                                        <div class="col-md-4">
                                            <label style="font-weight: bold">Vereda/Corregimiento:</label>
                                            <div class="m-scrollable" data-scrollable="true" style="">
                                                <p>{{$artist->township }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-4">
                                        <label style="font-weight: bold">Departamento de nacimiento:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">

                                            {{$artist->city->departaments->descripcion}}</p>
                                        </div>

                                    </div>


                                    <div class="col-md-4">
                                        <label style="font-weight: bold">Ciudad de nacimiento:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            {{$artist->city->descripcion}}</p>
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <label style="font-weight: bold">Fecha de nacimiento:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ Carbon\Carbon::parse($artist->byrthdate)->formatLocalized('%d de %B de %Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-weight: bold">Teléfono:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->users->phone_1}}</p>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <label style="font-weight: bold">Linea de convocatoria:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->personType->name}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label style="font-weight: bold">Actuara como:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            @if($artist->artistType)
                                                <p>{{ $artist->artistType->name}}</p>
                                            @else
                                                <p>No registrado</p>
                                            @endif
                                        </div>
                                    </div>


                                    @if($artist->users->phone_2)
                                        <div class="col-md-4">
                                            <label style="font-weight: bold">Otro teléfono:</label>
                                            <div class="m-scrollable" data-scrollable="true" style="">
                                                <p>{{$artist->users->phone_2 }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-6 mt-2">
                                        <label style="font-weight: bold">Documento de identificación:</label>
                                        <br>
                                        <button type="button" class="btn btn-primary btn_pdf_asp"
                                                data-toggle="modal"
                                                data-target="#verpdfidentificacion">
                                            Ver documento de identidad
                                        </button>
                                        <div class="row drop_pdf_asp" style="display: none">

                                            <div class="m-form__group form-group">
                                                <div class="col-lg-12 m-form__group-sub">
                                                    <label for="">Seleccione el tipo de formato para subir el documento
                                                        de identificación</label>
                                                    <div class="m-radio-inline">
                                                        <label class="m-radio">
                                                            <input type="radio" name="aspirante[identificacionDoc]"
                                                                   value="1" checked="checked"> Imagen
                                                            <span></span>
                                                        </label>
                                                        <label class="m-radio">
                                                            <input type="radio" name="aspirante[identificacionDoc]"
                                                                   value="2"> PDF
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div id="image-docuemnt-aspirante" class="form-group m-form__group row">
                                                    <div class="col-lg-6 m-form__group-sub">
                                                        <label for="">Imagen documento identificación frente</label>
                                                        <div
                                                            class="m-dropzone file-image-document-aspirante-frente m-dropzone--success"
                                                            action="inc/api/dropzone/upload.php" id="m-dropzone-three">
                                                            <div class="m-dropzone__msg dz-message needsclick">
                                                                <h3 class="m-dropzone__msg-title">Subir foto del frente
                                                                    de su documento de identificación</h3>
                                                                <span
                                                                    class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 m-form__group-sub">
                                                        <label for="">Imagen documento identificación atrás</label>
                                                        <div
                                                            class="m-dropzone file-image-document-aspirante-atras m-dropzone--success"
                                                            action="inc/api/dropzone/upload.php" id="m-dropzone-three">
                                                            <div class="m-dropzone__msg dz-message needsclick">
                                                                <h3 class="m-dropzone__msg-title">Subir foto de la parte
                                                                    de atrás de su documento de identificación</h3>
                                                                <span
                                                                    class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="pdf-docuemnt-aspirante" style="display: none"
                                                     class="form-group m-form__group row">
                                                    <div class="col">
                                                        <div class="form-group m-form__group ">
                                                            <div class="m-dropzone dropzone m-dropzone--success"
                                                                 action="inc/api/dropzone/upload.php"
                                                                 id="m-dropzone-three">
                                                                <div
                                                                    class="m-dropzone__msg dz-message needsclick">
                                                                    <h3 class="m-dropzone__msg-title">Subir documento de
                                                                        identificación por ambos lados</h3>
                                                                    <span
                                                                        class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form id="form_update_img" method="post"
                                                  action="{{ route('update.imgdoc.artist') }}"
                                                  enctype="multipart/form-data"
                                                  class="m-form m-form--label-align-left- m-form--state-"
                                                  id="actualizar_img_asp">
                                                @csrf {{ method_field('PUT') }}
                                                <input type="hidden" name="aspirante[urlImageDocumentFrente]"
                                                       class="form-control m-input" value="">
                                                <input type="hidden" name="aspirante[urlImageDocumentAtras]"
                                                       class="form-control m-input" value="">

                                            </form>

                                        </div>
                                        <i class="flaticon-edit ml-3 update_pdf_asp"
                                           style="color:#716aca; cursor:pointer;"></i>
                                        <button type="button" class="btn btn-primary cancel_pdf_asp"
                                                style="display:none">Cancelar
                                        </button>
                                        <button id="btn_enviar_asp" type="button" class="btn btn-primary  enviar_asp"
                                                style="display:none">enviar
                                        </button>


                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-4">

                                        <label style="font-weight: bold">{{ __('biografia') }}:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p style="text-align: justify">{{ $artist->biography }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- @dd($artist) --}}
                            @if($artist->gestor_id !== null)
                            <hr>
                            <div class="ml-4">

                                {{-- @dd($artist->users->name) --}}
                            <h5 style="font-weight: bold" class="">{{ __('Aspirante registrado por gestor') }}</h5>
                            <div class="ml-5">
                            <br>
                            <label style="font-weight: bold">Documento de soporte:</label>
                            <br>
                            <button type="button" class="btn btn-primary btn_pdf_asp"
                                                data-toggle="modal"
                                                data-target="#verpdfsoporte">
                                            Ver documento de soporte
                            </button>

                        </div>

                        </div>
                        {{-- modal soporte --}}
                        <div class="modal fade" id="verpdfsoporte" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                    Documento soporte
                                                    de {{ $artist->users->name}}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                    @if(!$artist->evidence_document)
                                                        <p>No se cargo el documento correctamente</p>
                                                    @else
                                                        <div>
                                                            <embed src="{{ $artist->evidence_document}}"
                                                                   frameborder="0" width="100%" height="400px">
                                                        </div>
                                                    @endif
                                            </div>
                                            <div class="modal-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="m-portlet__body">
                                </div>
                            </div>

                        </div>

                        @if(count($artist->projects) !== 0)
                            <div class="tab-pane " id="m_user_profile_tab_2">
                                <div class="m-portlet__body">
                                    <div class="row">
                                        <div class="col-11 player">
                                            <div class="form-group">
                                                <h5 style="font-weight: bold">Tu canción:</h5>
                                            </div>
                                            <audio preload="auto" controls>
                                                <source src="{{ $artist->projects[0]->audio }}">
                                            </audio>

                                        </div>
                                        <div class="row drop_audio col-12" style="display: none">
                                            <div
                                                class="col-lg-12 m-form__group-sub {{$errors->has('subir_cancion')? 'has-danger':''}}">
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-12">
                                                        <label class="form-control-label" form="nombreProyecto"><span
                                                                class="text-danger">*</span>
                                                            Subir canción:</label>
                                                        <div class="m-dropzone dropzone-audio m-dropzone--success"
                                                             action=""
                                                             id="m-dropzone-three">
                                                            <div class="m-dropzone__msg dz-message needsclick">
                                                                <h3 class="m-dropzone__msg-title">
                                                                    Agregue su canción en formato MP3</h3>
                                                                <span
                                                                    class="m-dropzone__msg-desc">Arrastra o has clic a aquí para subir</span>
                                                            </div>
                                                        </div>
                                                        {!! $errors->first('subir_cancion','<div class="form-control-feedback">*:message
                                                                   </div>')!!}
                                                        <span class="m-form__help">Cargue aquí el audio de la canción en formato Mp3.</span>
                                                        <input type="hidden" id="inputDBAudioAddProject"
                                                               name="subir_cancion" value="">
                                                        <div id="erroresImagen" style="color: var(--danger)"
                                                             class="form-control-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-1 " style="padding-top: 5rem;">
                                            <i class="flaticon-edit ml-3 update_audio"
                                               style="color:#716aca; cursor:pointer;"></i>
                                            <button type="button" class="btn btn-primary cancel_audio"
                                                    style="display:none">Cancelar
                                            </button>


                                        </div>
                                        <div class="secondary_audios col-md-12 row mt-5">
                                            @if($artist->projects[0]->audio_secundary_two)
                                                <div class="col-6 player">
                                                    <label style="font-weight: bold" class="form-control-label"
                                                           form="nombreProyecto">
                                                        Canción extra uno(no participa en el concurso):</label>
                                                    <audio preload="auto" controls>
                                                        <source src="{{ $artist->projects[0]->audio_secundary_two}}">
                                                        {{-- <input name="project_id" id="project_id" type="hidden" value="{{ $project->id }}"> --}}
                                                    </audio>

                                                </div>
                                            @endif
                                            @if($artist->projects[0]->audio_secundary_one)
                                                <div class="col-6 player">
                                                    <label style="font-weight: bold" class="form-control-label"
                                                           form="nombreProyecto">
                                                        Canción extra dos(no participa en el concurso):</label>
                                                    <audio preload="auto" controls>
                                                        <source src="{{ $artist->projects[0]->audio_secundary_one }}">
                                                        {{-- <input name="project_id" id="project_id" type="hidden" value="{{ $project->id }}"> --}}
                                                    </audio>

                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row pt-4">
                                        <div class="col-md-2 col-lg-2 col-12">
                                            <div class="form-group">
                                                <h5 style="font-weight: bold">Estado:</h5>
                                            </div>
                                            <div class="form-group">
                                                @if($artist->projects[0]->status == 1)
                                                    <span
                                                        class="m-badge m-badge--metal m-badge--wide m-badge--rounded">{{ __('Revision') }}</span>
                                                @endif
                                                @if($artist->projects[0]->status == 2)
                                                    <span class="m-badge m-badge--brand m-badge--wide m-badge--rounded"
                                                          style="background-color: #9816f4 !important;">Pre aprobado</span>
                                                @endif
                                                @if($artist->projects[0]->status == 3)
                                                    <span
                                                        class="m-badge m-badge--success m-badge--wide m-badge--rounded">Aprobado</span>
                                                @endif
                                                @if($artist->projects[0]->status == 4)
                                                    <span class="m-badge m-badge--warning m-badge--wide"
                                                          style="color:#fff">{{ __('Pendiente') }}</span>
                                                @endif
                                                @if($artist->projects[0]->status == 5)
                                                    <span
                                                        class="m-badge m-badge--danger m-badge--wide m-badge--rounded">{{ __('Rechazado') }}</span>
                                                @endif
                                                @if($artist->projects[0]->status == 6)
                                                    <span
                                                        class="m-badge m-badge--metal m-badge--wide m-badge--rounded">De nuevo en revisión</span>
                                                @endif
                                                @if($artist->projects[0]->status == 7)
                                                    <span
                                                        class="m-badge m-badge--success m-badge--wide m-badge--rounded">Aceptado</span>
                                                @endif
                                                @if($artist->projects[0]->status == 8)
                                                    <span
                                                        class="m-badge m-badge--success m-badge--wide m-badge--rounded">No subsanado</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-12">
                                            <div class="form-group">
                                                <h5 style="font-weight: bold">Nombre de la canción:</h5>
                                            </div>
                                            <div class="form-group">
                                                {{ $artist->projects[0]->title }}
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-12">
                                            <div class="form-group">
                                                <h5 style="font-weight: bold">Autor:</h5>
                                            </div>
                                            <div class="form-group">
                                                {{ $artist->projects[0]->author }}
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-12">
                                            <div class="form-group">
                                                <h5 style="font-weight: bold">{{ __('genero') }}:</h5>
                                            </div>
                                            <div class="form-group">
                                                {{ $artist->projects[0]->category->category}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-4">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <h5 style="font-weight: bold">Descripción o reseña:</h5>
                                            </div>
                                            <div class="form-group" style="text-align: justify">
                                                {{ $artist->projects[0]->description }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    <!--=====================================
                                       CONFIGURACIONES
                                        ======================================-->
                        @if(count($artist->teams) !== 0)
                            <div class="tab-pane " id="m_user_profile_tab_3">
                                <div class="m-portlet__body">
                                    <div class="row">
                                        <div class="col-lg-12">

                                        </div>
                                        <div class="col-lg-12">
                                            <div class="m-section">
                                                <!--=====================================
                                                                   CONFIGURACIONES PARA EL PERFIL DE USUARIO
                                                                   ======================================-->


                                                <div class="m-section__content">
                                                    <div
                                                        class="m-accordion m-accordion--bordered m-accordion--solid"
                                                        id="m_accordion_4" role="tablist">

                                                        <div class="row pb-2">
                                                            <div class="col-12">
                                                                <label
                                                                    style="font-weight: bold">Nombre de la agrupación
                                                                    musical:</label>
                                                                <div
                                                                    class="m-scrollable"
                                                                    data-scrollable="true"
                                                                    style="">

                                                                    <p>{{ $artist->name_team }}</p>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        @foreach ($artist->teams as $team)
                                                            {{-- @dd($team) --}}
                                                            <div class="m-accordion__item">
                                                                <div class="m-accordion__item-head collapsed"
                                                                     role="tab"
                                                                     id="m_accordion_4_item_1_head"
                                                                     data-toggle="collapse"
                                                                     href="#m_accordion_4_item_{{ $loop->iteration }}"
                                                                     aria-expanded="    false">
                                                                    <span
                                                                        class="m-accordion__item-icon">{{ $loop->iteration }}</span>
                                                                    <span
                                                                        class="m-accordion__item-title">{{ $team->name }}</span>
                                                                    <span class="m-accordion__item-mode"></span>
                                                                </div>
                                                                <div class="m-accordion__item-body collapse"
                                                                     id="m_accordion_4_item_{{ $loop->iteration }}"
                                                                     class=" " role="tabpanel"
                                                                     aria-labelledby="m_accordion_4_item_1_head"
                                                                     data-parent="#m_accordion_4">
                                                                    <div class="m-accordion__item-content">
                                                                        <div class="m-portlet__body ml-5">
                                                                            <div class="row">
                                                                                <div
                                                                                    class="biografia col-md-12">
                                                                                    <div class="row">
                                                                                        <div
                                                                                            class="col-md-4 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Nombre:</label>
                                                                                            <div
                                                                                                class="m-scrollable"
                                                                                                data-scrollable="true"
                                                                                                style="">
                                                                                                <p>{{ $team->name}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-4 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Apellidos:</label>
                                                                                            <div
                                                                                                class="m-scrollable"
                                                                                                data-scrollable="true"
                                                                                                style="">
                                                                                                <p>{{ $team->last_name}} {{ $team->second_last_name}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-4 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Tipo
                                                                                                identificación:</label>
                                                                                            <div
                                                                                                class="m-scrollable"
                                                                                                data-scrollable="true"
                                                                                                style="">
                                                                                                {{-- @dd($team) --}}
                                                                                                <p>{{ $team->documentType->document}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-4 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Nº
                                                                                                Identificación:</label>
                                                                                            <div
                                                                                                class="m-scrollable"
                                                                                                data-scrollable="true"
                                                                                                style="">

                                                                                                <p>{{ $team->identification}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-4 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Departamento
                                                                                                de
                                                                                                expedición:</label>
                                                                                            <div
                                                                                                class="m-scrollable"
                                                                                                data-scrollable="true"
                                                                                                style="">
                                                                                                @if($team->expeditionPlace)
                                                                                                    <p>{{ $team->expeditionPlace->departaments->descripcion}}</p>
                                                                                                @else
                                                                                                    <p>No registrado</p>
                                                                                                @endif

                                                                                            </div>

                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-4 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Ciudad
                                                                                                de
                                                                                                expedición:</label>
                                                                                            <div
                                                                                                class="m-scrollable"
                                                                                                data-scrollable="true"
                                                                                                style="">
                                                                                                @if($team->expeditionPlace)
                                                                                                    <p>{{ $team->expeditionPlace->descripcion}}</p>
                                                                                                @else
                                                                                                    <p>No registrado</p>
                                                                                                @endif
                                                                                            </div>

                                                                                        </div>

                                                                                        <div
                                                                                            class="col-md-4 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Dirección
                                                                                                de residencia:</label>
                                                                                            <div
                                                                                                class="m-scrollable"
                                                                                                data-scrollable="true"
                                                                                                style="">
                                                                                                <p>{{ $team->addres}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-4 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Departamento
                                                                                                de residencia:</label>
                                                                                            <div
                                                                                                class="m-scrollable"
                                                                                                data-scrollable="true"
                                                                                                style="">

                                                                                                <p>{{ $team->residencePlace->departaments->descripcion}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-4 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Ciudad
                                                                                                de residencia:</label>
                                                                                            <div
                                                                                                class="m-scrollable"
                                                                                                data-scrollable="true"
                                                                                                style="">

                                                                                                <p>{{ $team->residencePlace->descripcion}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-4 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Departamento
                                                                                                de nacimiento:</label>
                                                                                            <div
                                                                                                class="m-scrollable"
                                                                                                data-scrollable="true"
                                                                                                style="">

                                                                                                <p>{{ $team->city->departaments->descripcion}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-4 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Ciudad
                                                                                                de nacimiento:</label>
                                                                                            <div
                                                                                                class="m-scrollable"
                                                                                                data-scrollable="true"
                                                                                                style="">
                                                                                                <p>{{ $team->city->descripcion}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        {{--                                                                                        <div--}}
                                                                                        {{--                                                                                            class="col-md-4 mt-2">--}}
                                                                                        {{--                                                                                            <label--}}
                                                                                        {{--                                                                                                style="font-weight: bold">Fecha--}}
                                                                                        {{--                                                                                                de--}}
                                                                                        {{--                                                                                                nacimiento:</label>--}}
                                                                                        {{--                                                                                            <div--}}
                                                                                        {{--                                                                                                class="m-scrollable"--}}
                                                                                        {{--                                                                                                data-scrollable="true"--}}
                                                                                        {{--                                                                                                style="">--}}
                                                                                        {{--                                                                                                <p>{{  Carbon\Carbon::parse($team->birthday)->formatLocalized('%d de %B de %Y') }}</p>--}}
                                                                                        {{--                                                                                            </div>--}}
                                                                                        {{--                                                                                        </div>--}}


                                                                                        {{-- @if($artist->artists[0]->township)
                                                                                        <div class="col-md-4 mt-2">
                                                                                        <label style="font-weight: bold">Vereda/Corregimiento:</label>
                                                                                        <div class="m-scrollable" data-scrollable="true" style="">
                                                                                            <p>{{ $artist->artists[0]->beneficiary[0]->township}}</p>
                                                                                        </div>
                                                                                        </div>
                                                                                        @endif --}}
                                                                                        <div
                                                                                            class="col-md-4 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Teléfono:</label>
                                                                                            <div
                                                                                                class="m-scrollable"
                                                                                                data-scrollable="true"
                                                                                                style="">
                                                                                                <p>{{ $team->phone1}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        @if($team->phone2)
                                                                                            <div
                                                                                                class="col-md-4 mt-2">
                                                                                                <label
                                                                                                    style="font-weight: bold">Teléfono
                                                                                                    2:</label>
                                                                                                <div
                                                                                                    class="m-scrollable"
                                                                                                    data-scrollable="true"
                                                                                                    style="">
                                                                                                    <p>{{ $team->phone2}}</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                        <div
                                                                                            class="col-md-4 mt-2">

                                                                                            <label
                                                                                                style="font-weight: bold">Instrumento
                                                                                                o rol que
                                                                                                desempeña:</label>
                                                                                            @if($team->role)
                                                                                                <div
                                                                                                    class="m-scrollable"
                                                                                                    data-scrollable="true"
                                                                                                    style="">
                                                                                                    <p style="text-align: justify">{{ $team->role}}</p>
                                                                                                </div>
                                                                                            @else
                                                                                                <div
                                                                                                    class="m-scrollable"
                                                                                                    data-scrollable="true"
                                                                                                    style="">
                                                                                                    <p style="text-align: justify">
                                                                                                        No
                                                                                                        registrado</p>
                                                                                                </div>
                                                                                            @endif
                                                                                        </div>

                                                                                        <div
                                                                                            class="col-md-12 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Documento
                                                                                                de
                                                                                                identificación:</label>
                                                                                            <br>
                                                                                            <button
                                                                                                type="button"
                                                                                                class="btn btn-primary btn_pdf_team{{ $loop->iteration }}"
                                                                                                data-toggle="modal"
                                                                                                data-target="#pdfidentificacion{{$loop->iteration}}">
                                                                                                Ver documento de
                                                                                                identidad
                                                                                            </button>
                                                                                            <div
                                                                                                class="row drop_pdf_team{{ $loop->iteration }}"
                                                                                                style="display: none">
                                                                                                <div
                                                                                                    class="m-form__group form-group">
                                                                                                    <div
                                                                                                        class="col-lg-12 m-form__group-sub">
                                                                                                        <label for="">Seleccione
                                                                                                            el tipo de
                                                                                                            formato para
                                                                                                            subir el
                                                                                                            documento de
                                                                                                            identificación</label>
                                                                                                        <div
                                                                                                            class="m-radio-inline">
                                                                                                            <label
                                                                                                                class="m-radio">
                                                                                                                <input
                                                                                                                    type="radio"
                                                                                                                    onClick="changeOptionDocument(this, {{$loop->iteration}})"
                                                                                                                    name="team[identificacionDoc]{{ $loop->iteration }}"
                                                                                                                    value="1"
                                                                                                                    checked="checked">
                                                                                                                Imagen
                                                                                                                <span></span>
                                                                                                            </label>
                                                                                                            <label
                                                                                                                class="m-radio">
                                                                                                                <input
                                                                                                                    type="radio"
                                                                                                                    onClick="changeOptionDocument(this, {{$loop->iteration}})"
                                                                                                                    name="team[identificacionDoc]{{ $loop->iteration }}"
                                                                                                                    value="2">
                                                                                                                PDF
                                                                                                                <span></span>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div
                                                                                                        id="image-docuemnt-team{{ $loop->iteration }}"
                                                                                                        class="form-group m-form__group row">
                                                                                                        <div
                                                                                                            class="col-lg-6 m-form__group-sub">
                                                                                                            <label
                                                                                                                for="">Imagen
                                                                                                                documento
                                                                                                                identificación
                                                                                                                frente</label>
                                                                                                            <div
                                                                                                                class="m-dropzone file-image-document-team-frente{{ $loop->iteration }} m-dropzone--success"
                                                                                                                action="inc/api/dropzone/upload.php"
                                                                                                                id="m-dropzone-three">
                                                                                                                <div
                                                                                                                    class="m-dropzone__msg dz-message needsclick">
                                                                                                                    <h3 class="m-dropzone__msg-title">
                                                                                                                        Subir
                                                                                                                        foto
                                                                                                                        del
                                                                                                                        frente
                                                                                                                        de
                                                                                                                        su
                                                                                                                        documento
                                                                                                                        de
                                                                                                                        identificación</h3>
                                                                                                                    <span
                                                                                                                        class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="col-lg-6 m-form__group-sub">
                                                                                                            <label
                                                                                                                for="">Imagen
                                                                                                                documento
                                                                                                                identificación
                                                                                                                atrás</label>
                                                                                                            <div
                                                                                                                class="m-dropzone file-image-document-team-atras{{ $loop->iteration }} m-dropzone--success"
                                                                                                                action="inc/api/dropzone/upload.php"
                                                                                                                id="m-dropzone-three">
                                                                                                                <div
                                                                                                                    class="m-dropzone__msg dz-message needsclick">
                                                                                                                    <h3 class="m-dropzone__msg-title">
                                                                                                                        Subir
                                                                                                                        foto
                                                                                                                        de
                                                                                                                        la
                                                                                                                        parte
                                                                                                                        de
                                                                                                                        atrás
                                                                                                                        de
                                                                                                                        su
                                                                                                                        documento
                                                                                                                        de
                                                                                                                        identificación</h3>
                                                                                                                    <span
                                                                                                                        class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div
                                                                                                        id="pdf-docuemnt-team{{ $loop->iteration }}"
                                                                                                        style="display: none"
                                                                                                        class="form-group m-form__group row">
                                                                                                        <div
                                                                                                            class="col">
                                                                                                            <div
                                                                                                                class="form-group m-form__group ">
                                                                                                                <div
                                                                                                                    class="m-dropzone dropzone-team{{ $loop->iteration }} m-dropzone--success"
                                                                                                                    action="inc/api/dropzone/upload.php"
                                                                                                                    id="m-dropzone-three">
                                                                                                                    <div
                                                                                                                        class="m-dropzone__msg dz-message needsclick">
                                                                                                                        <h3 class="m-dropzone__msg-title">{{ __('Actualizar documento de identidad') }}</h3>
                                                                                                                        <span
                                                                                                                            class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>


                                                                                            </div>
                                                                                            <i class="flaticon-edit ml-3 update_pdf_team{{ $loop->iteration }}"
                                                                                               style="color:#716aca; cursor:pointer;"></i>
                                                                                            <form
                                                                                                id="form_update_img_team{{ $loop->iteration }}"
                                                                                                method="post"
                                                                                                action="{{ route('update.imgdoc.team') }}"
                                                                                                enctype="multipart/form-data"
                                                                                                class="m-form m-form--label-align-left- m-form--state-"
                                                                                                id="actualizar_img_team">
                                                                                                @csrf {{ method_field('PUT') }}
                                                                                                <input type="hidden"
                                                                                                       name="team[urlImageDocumentFrente]{{ $loop->iteration }}"
                                                                                                       class="form-control m-input"
                                                                                                       value="">
                                                                                                <input type="hidden"
                                                                                                       name="team[urlImageDocumentAtras]{{ $loop->iteration }}"
                                                                                                       class="form-control m-input"
                                                                                                       value="">
                                                                                                <input type="hidden"
                                                                                                       name="team[id]"
                                                                                                       class="form-control m-input"
                                                                                                       value="{{$team->id}}">

                                                                                            </form>
                                                                                            <button
                                                                                                type="button"
                                                                                                class="btn btn-primary cancel_pdf_team{{ $loop->iteration }}"
                                                                                                style="display:none">
                                                                                                Cancelar
                                                                                            </button>
                                                                                            <button
                                                                                                id="btn_enviar_team{{ $loop->iteration }}"
                                                                                                type="button"
                                                                                                class="btn btn-primary  enviar_team{{ $loop->iteration }}"
                                                                                                style="display:none">
                                                                                                enviar
                                                                                            </button>


                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal fade"
                                                                 id="pdfidentificacion{{$loop->iteration}}"
                                                                 tabindex="-1" role="dialog"
                                                                 aria-labelledby="exampleModalLabel"
                                                                 aria-hidden="true">
                                                                <div class="modal-dialog modal-lg"
                                                                     role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLongTitle">
                                                                                Documento
                                                                                de identificación
                                                                                de {{ $team->name}}</h5>
                                                                            <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            {{-- @dd($team->pdf_identificacion) --}}
                                                                            @if($team->pdf_identificacion === "" || $team->pdf_identificacion === null)
                                                                                @if(!$team->img_document_front && !$team->img_document_back)
                                                                                    <p>No se cargo el documento
                                                                                        correctamente</p>
                                                                                @else
                                                                                    <div class="form-group">
                                                                                        <label for="">Parte frontal del
                                                                                            documento:</label>
                                                                                        <img style="width: 100%"
                                                                                             src="{{ $team->img_document_front}}"
                                                                                             alt="">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="">Parte trasera del
                                                                                            documento:</label>
                                                                                        <img style="width: 100%"
                                                                                             src="{{ $team->img_document_back}}"
                                                                                             alt="">
                                                                                    </div>
                                                                                @endif
                                                                            @else
                                                                                @if(!$team->pdf_identificacion)
                                                                                    <p>No se cargo el documento
                                                                                        correctamente</p>
                                                                                @else
                                                                                    <div>
                                                                                        <embed
                                                                                            src="{{ $team->pdf_identificacion }}"
                                                                                            frameborder="0" width="100%"
                                                                                            height="400px">
                                                                                    </div>
                                                                                @endif
                                                                            @endif
                                                                        </div>
                                                                        <div class="modal-footer">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif
                        @if(count($artist->beneficiary) !== 0)
                            <div class="tab-pane " id="m_user_profile_tab_4">
                                <div class="m-portlet__body ml-5">
                                    <div class="row">


                                        <div class="biografia col-md-12">
                                            <div class="row">

                                                @if ($artist->beneficiary[0]->picture)

                                                    <div class="col-md-4 mb-5 ">
                                                        <div class="m-scrollable update_ben_profile"
                                                             data-scrollable="true"
                                                             style="">
                                                            <img class="ml-4"
                                                                 style="border-radius:8rem; width:7rem"
                                                                 src="{{$artist->beneficiary[0]->picture}}">
                                                            <i class="flaticon-edit ml-3 update_img_profile_ben"
                                                               style="color:#716aca; cursor:pointer;"></i>
                                                        </div>
                                                        <div class="col-md-4 drop_prof_ben" style="display: none">
                                                            <div class="form-group m-form__group ">

                                                                <div
                                                                    class="m-dropzone dropzone_prof_ben m-dropzone--success"
                                                                    action="inc/api/dropzone/upload.php"
                                                                    id="m-dropzone-three"
                                                                    style="width: 14rem;height: -1px;">
                                                                    <div
                                                                        class="m-dropzone__msg dz-message needsclick">
                                                                        <h3 class="m-dropzone__msg-title">{{ __('actualizar_foto_perfil') }}</h3>
                                                                        <span
                                                                            class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="button"
                                                                    class="btn btn-primary cancel_prof_ben"
                                                                    style="display:none">Cancelar
                                                            </button>

                                                        </div>

                                                    </div>
                                                @else

                                                    <div class="col-md-4 mb-5">
                                                        <div class="m-scrollable update_ben_profile"
                                                             data-scrollable="true"
                                                             style="">
                                                            <img class="ml-4 "
                                                                 style="border-radius:8rem; width:7rem"
                                                                 src="/default/user.png">
                                                            <i class="flaticon-edit ml-3 update_img_profile_ben"
                                                               style="color:#716aca; cursor:pointer;"></i>
                                                        </div>
                                                        <div class="col-md-4 drop_prof_ben" style="display: none">
                                                            <div class="form-group m-form__group ">

                                                                <div
                                                                    class="m-dropzone dropzone_prof_ben m-dropzone--success"
                                                                    action="inc/api/dropzone/upload.php"
                                                                    id="m-dropzone-three"
                                                                    style="width: 14rem;height: -1px;">
                                                                    <div
                                                                        class="m-dropzone__msg dz-message needsclick">
                                                                        <h3 class="m-dropzone__msg-title">{{ __('actualizar_foto_perfil') }}</h3>
                                                                        <span
                                                                            class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="button"
                                                                    class="btn btn-primary cancel_prof_ben"
                                                                    style="display:none">Cancelar
                                                            </button>

                                                        </div>
                                                    </div>

                                                @endif

                                                <div class="col-md-4 mt-5">
                                                    <label style="font-weight: bold">Nombre:</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        <p>{{ $artist->beneficiary[0]->name}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-5">
                                                    <label style="font-weight: bold">Apellidos:</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        <p>{{ $artist->beneficiary[0]->last_name}} {{ $artist->beneficiary[0]->second_last_name}}</p>
                                                    </div>
                                                </div>


                                                <div class="col-md-4 mt-2">
                                                    <label style="font-weight: bold">Tipo
                                                        identificación:</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        <p>{{ $artist->beneficiary[0]->documentType->document}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-2">
                                                    <label style="font-weight: bold">Nº Identificación:</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        <p>{{ $artist->beneficiary[0]->identification}}</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mt-2">

                                                    <label
                                                        style="font-weight: bold">{{ __('Departamento de expedición') }}
                                                        :</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">

                                                        @if($artist->beneficiary[0]->expeditionPlace !== null)
                                                            <p style="text-align: justify">{{ $artist->beneficiary[0]->expeditionPlace->departaments->descripcion}}</p>
                                                        @else
                                                            <p style="text-align: justify">No registrado</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-2">

                                                    <label
                                                        style="font-weight: bold">{{ __('Ciudad de expedición') }}
                                                        :</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        @if($artist->beneficiary[0]->expeditionPlace !== null)
                                                            <p style="text-align: justify">{{ $artist->beneficiary[0]->expeditionPlace->descripcion}}</p>
                                                        @else
                                                            <p style="text-align: justify">No registrado</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mt-2">
                                                    <label style="font-weight: bold">Dirección de residencia:</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        <p>{{ $artist->beneficiary[0]->adress}}</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mt-2">
                                                    <label style="font-weight: bold">Departamento de residencia:</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        @if($artist->beneficiary[0]->residencePlace)
                                                            <p>{{ $artist->beneficiary[0]->residencePlace->departaments->descripcion}}</p>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="col-md-4 mt-2">
                                                    <label style="font-weight: bold">Ciudad de residencia:</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        @if($artist->beneficiary[0]->residencePlace)
                                                            <p>{{ $artist->beneficiary[0]->residencePlace->descripcion}}</p>
                                                        @endif
                                                    </div>

                                                </div>
                                                <div class="col-md-4 mt-2">
                                                    <label style="font-weight: bold">Departamento de
                                                        nacimiento:</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        <p>{{ $artist->beneficiary[0]->city->departaments->descripcion}}</p>
                                                    </div>

                                                </div>
                                                <div class="col-md-4 mt-2">
                                                    <label style="font-weight: bold">Ciudad de
                                                        nacimiento:</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        <p>{{ $artist->beneficiary[0]->city->descripcion}}</p>
                                                    </div>

                                                </div>
                                                @if($artist->beneficiary[0]->township)
                                                    <div class="col-md-4 mt-2">
                                                        <label style="font-weight: bold">Vereda/Corregimiento:</label>
                                                        <div class="m-scrollable" data-scrollable="true" style="">
                                                            <p>{{$artist->beneficiary[0]->township}}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-md-4 mt-2">
                                                    <label style="font-weight: bold">Fecha de
                                                        nacimiento:</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        <p>{{  Carbon\Carbon::parse($artist->beneficiary[0]->birthday)->formatLocalized('%d de %B de %Y') }}</p>
                                                    </div>
                                                </div>


                                                @if($artist->township)
                                                    <div class="col-md-4 mt-2">
                                                        <label
                                                            style="font-weight: bold">Vereda/Corregimiento:</label>
                                                        <div class="m-scrollable" data-scrollable="true"
                                                             style="">
                                                            <p>{{ $artist->beneficiary[0]->township}}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-md-4 mt-2">
                                                    <label style="font-weight: bold">Teléfono:</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        <p>{{ $artist->beneficiary[0]->phone}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 mt-2" style="margin-right:-4rem">
                                                    <label style="font-weight: bold">Documento de
                                                        identificación:</label>
                                                    <br>
                                                    <button type="button" class="btn btn-primary btn_pdf_ben"
                                                            data-toggle="modal"
                                                            data-target="#pdfidentificacionBeneficiario">
                                                        Ver documento de identidad
                                                    </button>
                                                    <div class="row drop_pdf_ben" style="display: none">

                                                        <div class="m-form__group form-group">
                                                            <div class="col-lg-12 m-form__group-sub">
                                                                <label for="">Seleccione el tipo de formato para subir
                                                                    el documento de identificación</label>
                                                                <div class="m-radio-inline">
                                                                    <label class="m-radio">
                                                                        <input type="radio"
                                                                               name="beneficiario[identificacionDoc]"
                                                                               value="1" checked="checked"> Imagen
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="m-radio">
                                                                        <input type="radio"
                                                                               name="beneficiario[identificacionDoc]"
                                                                               value="2"> PDF
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div id="image-docuemnt-beneficiario"
                                                                 class="form-group m-form__group row">
                                                                <div class="col-lg-6 m-form__group-sub">
                                                                    <label for="">Imagen documento identificación
                                                                        frente</label>
                                                                    <div
                                                                        class="m-dropzone file-image-document-beneficiario-frente m-dropzone--success"
                                                                        action="inc/api/dropzone/upload.php"
                                                                        id="m-dropzone-three">
                                                                        <div
                                                                            class="m-dropzone__msg dz-message needsclick">
                                                                            <h3 class="m-dropzone__msg-title">Subir foto
                                                                                del frente de su documento de
                                                                                identificación</h3>
                                                                            <span
                                                                                class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 m-form__group-sub">
                                                                    <label for="">Imagen documento identificación
                                                                        atrás</label>
                                                                    <div
                                                                        class="m-dropzone file-image-document-beneficiario-atras m-dropzone--success"
                                                                        action="inc/api/dropzone/upload.php"
                                                                        id="m-dropzone-three">
                                                                        <div
                                                                            class="m-dropzone__msg dz-message needsclick">
                                                                            <h3 class="m-dropzone__msg-title">Subir foto
                                                                                de la parte de atrás de su documento de
                                                                                identificación</h3>
                                                                            <span
                                                                                class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div id="pdf-docuemnt-beneficiario" style="display: none"
                                                                 class="form-group m-form__group row">
                                                                <div class="col">
                                                                    <div class="form-group m-form__group ">
                                                                        <div
                                                                            class="m-dropzone dropzone-ben m-dropzone--success"
                                                                            action="inc/api/dropzone/upload.php"
                                                                            id="m-dropzone-three">
                                                                            <div
                                                                                class="m-dropzone__msg dz-message needsclick">

                                                                                <h3 class="m-dropzone__msg-title">Subir
                                                                                    documento de identificación por
                                                                                    ambos lados</h3>
                                                                                <span
                                                                                    class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <i class="flaticon-edit ml-3 update_pdf_ben"
                                                       style="color:#716aca; cursor:pointer;"></i>
                                                    <button type="button" class="btn btn-primary cancel_pdf_ben"
                                                            style="display:none">Cancelar
                                                    </button>
                                                    <button id="btn_enviar_ben" type="button"
                                                            class="btn btn-primary  enviar_ben"
                                                            style="display:none">enviar
                                                    </button>

                                                </div>
                                                <form id="form_update_img_ben" method="post"
                                                      action="{{ route('update.imgdoc.ben') }}"
                                                      enctype="multipart/form-data"
                                                      class="m-form m-form--label-align-left- m-form--state-"
                                                      id="actualizar_img_asp">
                                                    @csrf {{ method_field('PUT') }}
                                                    <input type="hidden" name="beneficiario[urlImageDocumentFrente]"
                                                           class="form-control m-input" value="">
                                                    <input type="hidden" name="beneficiario[urlImageDocumentAtras]"
                                                           class="form-control m-input" value="">

                                                </form>

                                                <div class="col-md-12 mt-3">

                                                    <label style="font-weight: bold">{{ __('biografia') }}
                                                        :</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        <p style="text-align: justify">{{ $artist->beneficiary[0]->biography}}</p>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="pdfidentificacionBeneficiario" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                    Documento de identificación
                                                    de {{ $artist->beneficiary[0]->name}}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                @if($artist->beneficiary[0]->pdf_documento === null)
                                                    @if(!$artist->beneficiary[0]->img_document_front && !$artist->beneficiary[0]->img_document_back)
                                                        <p>No se cargo el documento correctamente</p>
                                                    @else
                                                        <div class="form-group">
                                                            <label for="">Parte frontal del documetno:</label>
                                                            <img style="width: 100%"
                                                                 src="{{ $artist->beneficiary[0]->img_document_front }}"
                                                                 alt="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Parte trasera del documento:</label>
                                                            <img style="width: 100%"
                                                                 src="{{ $artist->beneficiary[0]->img_document_back }}"
                                                                 alt="">
                                                        </div>

                                                    @endif
                                                @else
                                                    @if(!$artist->beneficiary[0]->pdf_documento)
                                                        <p>No se cargo el documento correctamente</p>
                                                    @else
                                                        <div>
                                                            <embed src="{{ $artist->beneficiary[0]->pdf_documento}}"
                                                                   frameborder="0" width="100%" height="400px">
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="modal-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal fade" id="verpdfidentificacion" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">
                                Documento de
                                identificación de {{ $artist->users->name }} {{ $artist->users->last_name }}</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            {{--                            @if(!$artist->users->pdf_cedula )--}}
                            {{--                                <p>No se cargo el documento correctamente</p>--}}
                            {{--                            @else--}}

                            @if($artist->users->pdf_cedula === null)
                                @if(!$artist->users->img_document_front && !$artist->users->img_document_back)
                                    <p>No se cargo el documento correctamente</p>
                                @else
                                    <div class="form-group">
                                        <label for="">Parte frontal del documento:</label>
                                        <img style="width: 100%" src="{{ $artist->users->img_document_front }}" alt="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Parte trasera del documento:</label>
                                        <img style="width: 100%" src="{{ $artist->users->img_document_back }}" alt="">
                                    </div>
                                @endif
                            @else
                                @if(!$artist->users->pdf_cedula)
                                    <p>No se cargo el documento correctamente</p>
                                @else
                                    <div>
                                        <embed src="{{ $artist->users->pdf_cedula }}" frameborder="0" width="100%"
                                               height="400px">
                                    </div>
                                @endif
                            @endif
                            {{--                            @endif--}}
                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="verObservaciones" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">
                                Observaciones </h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                @if(count($artist->projects) !== 0)
                                    @foreach($artist->projects[0]->observations as $observations)
                                        <div class="col-12">
                                            {{ $observations->description }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
@section('dropzonePhotoArtist')
    <script>
        $(document).ready(function () {

            $('[data-toggle="tooltip"]').tooltip();
            $(function () {
                $('audio').audioPlayer();
            });

        });
        var BootstrapDatepicker = function () {

            var arrows;
            if (mUtil.isRTL()) {
                arrows = {
                    leftArrow: '<i class="la la-angle-right"></i>',
                    rightArrow: '<i class="la la-angle-left"></i>'
                }
            } else {
                arrows = {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            }

            //== Private functions
            var demos = function () {
                // minimum setup
                $('#datepicker_fecha_nacimiento #m_datepicker_1_validate').datepicker({
                    rtl: mUtil.isRTL(),
                    todayHighlight: true,
                    orientation: "bottom left",
                    templates: arrows
                });
                $('#datepicker_fecha_nacimiento').datepicker({
                    rtl: mUtil.isRTL(),
                    todayHighlight: true,
                    orientation: "bottom left",
                    templates: arrows
                });
            }

            return {
                // public functions
                init: function () {
                    demos();
                }
            };
        }();

        jQuery(document).ready(function () {
            BootstrapDatepicker.init();
        });
        // actualizar pdf aspirante
        new Dropzone('.dropzone', {
            url: '{{ route('cedula.pdf.aspirante') }}',
            acceptedFiles: '.pdf',
            maxFiles: 1,
            paramName: 'pdf_cedula_name',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            addedfile: function (file, response) {
                $('body').loading({
                    message: 'Subiendo documento...',
                    start: true,
                });
            },
            success: function (file, response) {

                $('#inputImagenesPostPlan').val(response);
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.success("El documento se actualizo correctamente", "Información");
                setTimeout(function () {
                    location.reload();
                }, 3000);
            },
            error:function(file,response){
                $('body').loading({
                    start:false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }

        });

        /* eventos para subir la imagen o pdf del aspirante */
        new Dropzone('.file-image-document-aspirante-frente', {
            url: '{{ route('upload.image.document') }}',
            acceptedFiles: "image/*",
            maxFiles: 1,
            paramName: 'file',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            processing: function (file, response) {
                $('body').loading({
                    message: 'Subiendo documento...',
                    start: true,
                });
            },
            success: function (file, response) {
                $("input[name='aspirante[urlImageDocumentFrente]']").val(response);
                $('body').loading({

                    start: false,
                });
            },
            error:function(file,response){
                $('body').loading({
                    start:false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }
        });
        new Dropzone('.file-image-document-aspirante-atras', {
            url: '{{ route('upload.image.document') }}',
            acceptedFiles: "image/*",
            maxFiles: 1,
            paramName: 'file',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            processing: function (file, response) {
                $('body').loading({
                    message: 'Subiendo documento...',
                    start: true,
                });
            },
            success: function (file, response) {
                $("input[name='aspirante[urlImageDocumentAtras]']").val(response);
                $('body').loading({

                    start: false,
                });
            },
            error:function(file,response){
                $('body').loading({
                    start:false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }
        });

        var issetBenefis =@json($artist->beneficiary);

        if (issetBenefis.length != 0) {
            /* eventos para subir la imagen o pdf del beneficiario */
            new Dropzone('.file-image-document-beneficiario-frente', {
                url: '{{ route('upload.image.document') }}',
                acceptedFiles: "image/*",
                maxFiles: 1,
                paramName: 'file',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                processing: function (file, response) {
                    $('body').loading({
                        message: 'Subiendo documento...',
                        start: true,
                    });
                },
                success: function (file, response) {
                    $("input[name='beneficiario[urlImageDocumentFrente]']").val(response);
                    $('body').loading({

                        start: false,
                    });
                },
            error:function(file,response){
                $('body').loading({
                    start:false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }
            });
            new Dropzone('.file-image-document-beneficiario-atras', {
                url: '{{ route('upload.image.document') }}',
                acceptedFiles: "image/*",
                maxFiles: 1,
                paramName: 'file',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                processing: function (file, response) {
                    $('body').loading({
                        message: 'Subiendo documento...',
                        start: true,
                    });
                },
                success: function (file, response) {
                    $("input[name='beneficiario[urlImageDocumentAtras]']").val(response);
                    $('body').loading({

                        start: false,
                    });
                },
            error:function(file,response){
                $('body').loading({
                    start:false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }
            });

        }

        //Actualizar imagen de perfil aspirante
        new Dropzone('.dropzone_prof_asp', {
            url: '{{ route('profile.photo.artist') }}',
            acceptedFiles: 'image/*',
            maxFiles: 1,
            paramName: 'photo',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            addedfile: function (file, response) {
                $('body').loading({
                    message: 'Subiendo imagen...',
                    start: true,
                });
            },
            success: function (file, response) {

                $('#inputImagenesPostPlan').val(response);
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.success("La foto de perfil se actualizo correctamente", "Información");

                setTimeout(function () {
                    location.reload();
                }, 3000);
            },
            error:function(file,response){
                $('body').loading({
                    start:false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }

        });

        if (issetBenefis.length != 0) {
            //Actualizar imagen de perfil beneficiario
            new Dropzone('.dropzone_prof_ben', {
                url: '{{ route('profile.photo.beneficiario') }}',
                acceptedFiles: 'image/*',
                maxFiles: 1,
                paramName: 'photo',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                addedfile: function (file, response) {
                    $('body').loading({
                        message: 'Subiendo imagen...',
                        start: true,
                    });
                },
                success: function (file, response) {

                    $('#inputImagenesPostPlan').val(response);
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "3000",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.success("Foto actualizada correctamente", "Información");
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                },
            error:function(file,response){
                $('body').loading({
                    start:false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }

            });

        }


        Dropzone.autoDiscover = false;
        // actualizar pdf beneficiario


        if (issetBenefis.length != 0) {

            new Dropzone('.dropzone-ben', {
                url: '{{ route('cedula.pdf.beneficiario') }}',
                acceptedFiles: '.pdf',
                maxFiles: 1,
                paramName: 'pdf_cedula_name',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                addedfile: function (file, response) {
                    $('body').loading({
                        message: 'Subiendo documento...',
                        start: true,
                    });
                },
                success: function (file, response) {

                    $('#inputImagenesPostPlan').val(response);
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "3000",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.success("El documento se actualizo correctamente", "Información");
                    setTimeout(function () {
                        location.reload();
                    }, 3000);

                },
            error:function(file,response){
                $('body').loading({
                    start:false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }

            });
        }

        var teams =@json($artist->teams);
        if (teams.length !== 0) {

            $.each( @json($artist->teams), function (key, value) {
                // actualizar pdf team
                new Dropzone('.dropzone-team' + (key + 1), {
                    url: '{{ route('cedula.pdf.team') }}',
                    acceptedFiles: '.pdf',
                    maxFiles: 1,
                    paramName: 'pdf_cedula_name',
                    headers: {
                        'id': value.id,
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    addedfile: function (file, response) {
                        $('body').loading({
                            message: 'Subiendo documento...',
                            start: true,
                        });
                    },
                    success: function (file, response) {

                        $('#inputImagenesPostPlan').val(response);
                        // location.reload();
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "3000",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };

                        toastr.success("El documento se actualizo correctamente", "Información");
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    },
            error:function(file,response){
                $('body').loading({
                    start:false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }

                });

                /* eventos para subir la imagen del team */
                new Dropzone('.file-image-document-team-frente' + (key + 1), {
                    url: '{{ route('upload.image.document') }}',
                    acceptedFiles: "image/*",
                    maxFiles: 1,
                    paramName: 'file',
                    headers: {

                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    processing: function (file, response) {
                        $('body').loading({
                            message: 'Subiendo documento...',
                            start: true,
                        });
                    },
                    success: function (file, response) {
                        $("input[name='team[urlImageDocumentFrente]" + (key + 1) + "']").val(response);
                        $('body').loading({

                            start: false,
                        });
                    },
            error:function(file,response){
                $('body').loading({
                    start:false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }
                });
                new Dropzone('.file-image-document-team-atras' + (key + 1), {
                    url: '{{ route('upload.image.document') }}',
                    acceptedFiles: "image/*",
                    maxFiles: 1,
                    paramName: 'file',
                    headers: {

                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    processing: function (file, response) {
                        $('body').loading({
                            message: 'Subiendo documento...',
                            start: true,
                        });
                    },
                    success: function (file, response) {
                        $("input[name='team[urlImageDocumentAtras]" + (key + 1) + "']").val(response);
                        $('body').loading({

                            start: false,
                        });
                    },
            error:function(file,response){
                $('body').loading({
                    start:false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }
                });
            });

        }


        Dropzone.autoDiscover = false;

        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            // allowDropdown: false,
            // autoHideDialCode: false,
            // autoPlaceholder: "off",
            // dropdownContainer: document.body,
            // excludeCountries: ["us"],
            // formatOnDisplay: false,
            // geoIpLookup: function(callback) {
            //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            //     var countryCode = (resp && resp.country) ? resp.country : "";
            //     callback(countryCode);
            //   });
            // },
            // hiddenInput: "full_number",
            // initialCountry: "auto",
            // localizedCountries: { 'de': 'Deutschland' },
            // nationalMode: false,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // placeholderNumberType: "MOBILE",
            // preferredCountries: ['cn', 'jp'],
            // separateDialCode: true,
            utilsScript: "/backend/build/js/utils.js",
        });
    </script>

    {{-- editar identificacion aspirante --}}
    <script>

        // controles actualizar documentos aspirante
        $("input[name='aspirante[identificacionDoc]']").click(() => {
            if ($('input:radio[name="aspirante[identificacionDoc]"]:checked').val() === '1') {
                $("#image-docuemnt-aspirante").show();
                $(".enviar_asp").show();
                $("#pdf-docuemnt-aspirante").hide();
            } else {
                $("#image-docuemnt-aspirante").hide();
                $(".enviar_asp").hide();
                $("#pdf-docuemnt-aspirante").show();
            }
        });
        $('.update_pdf_asp').click(function () {
            $(this).hide();
            $('.cancel_pdf_asp').show();
            $(".enviar_asp").show();
            $('.drop_pdf_asp').show();
            $('.btn_pdf_asp').hide();


        });
        $('.cancel_pdf_asp').click(function () {
            $(this).hide();
            $('.update_pdf_asp').show();
            $('.drop_pdf_asp').hide();
            $(".enviar_asp").hide();
            $('.btn_pdf_asp').show();


        });

        // coontroles actualizacion imagen perfil
        $('.update_img_profile_asp').click(function () {
            $('.update_asp_profile').hide();

            $('.drop_prof_asp').show();
            $('.cancel_prof_asp').show();

        });

        $('.cancel_prof_asp').click(function () {
            $('.update_asp_profile').show();

            $('.drop_prof_asp').hide();
            $(this).hide();

        });

        // coontroles actualizacion imagen perfil beneficiario
        $('.update_img_profile_ben').click(function () {

            $('.update_ben_profile').hide();
            $('.drop_prof_ben').show();
            $('.cancel_prof_ben').show();

        });

        $('.cancel_prof_ben').click(function () {
            $('.update_ben_profile').show();
            $('.drop_prof_ben').hide();
            $(this).hide();

        });

    </script>
    {{-- editar identificacion beneficiario --}}
    <script>
        $("input[name='beneficiario[identificacionDoc]']").click(() => {
            if ($('input:radio[name="beneficiario[identificacionDoc]"]:checked').val() === '1') {
                $("#image-docuemnt-beneficiario").show();
                $(".enviar_ben").show();
                $("#pdf-docuemnt-beneficiario").hide();
            } else {
                $("#image-docuemnt-beneficiario").hide();
                $(".enviar_ben").hide();
                $("#pdf-docuemnt-beneficiario").show();
            }
        });
        $('.update_pdf_ben').click(function () {
            $(this).hide();
            $('.cancel_pdf_ben').show();
            $(".enviar_ben").show();
            $('.drop_pdf_ben').show();
            $('.btn_pdf_ben').hide();


        });
        $('.cancel_pdf_ben').click(function () {
            $(this).hide();
            $('.update_pdf_ben').show();
            $('.drop_pdf_ben').hide();
            $('.btn_pdf_ben').show();
            $(".enviar_ben").hide();


        });

    </script>
    {{-- editar identificacion team--}}
    <script>
        function changeOptionDocument(element, member) {
            // console.log($(element).val(),'element');
            // console.log(member,'menber');
            if ($(element).val() === '1') {
                $(`#image-docuemnt-team${member}`).show();
                $(`.enviar_team${member}`).show();
                $(`#pdf-docuemnt-team${member}`).hide();
            } else {
                $(`#image-docuemnt-team${member}`).hide();
                $(`#pdf-docuemnt-team${member}`).show();
                $(`.enviar_team${member}`).hide();
            }
        }

        $.each( @json($artist->teams), function (key, value) {

            $('.update_pdf_team' + (key + 1)).click(function () {
                $(this).hide();
                $('.cancel_pdf_team' + (key + 1)).show();
                $(".enviar_team" + (key + 1)).show();

                $('.drop_pdf_team' + (key + 1)).show();
                $('.btn_pdf_team' + (key + 1)).hide();


            });
            $('.cancel_pdf_team' + (key + 1)).click(function () {
                $(this).hide();
                $('.update_pdf_team' + (key + 1)).show();
                $('.drop_pdf_team' + (key + 1)).hide();
                $('.btn_pdf_team' + (key + 1)).show();
                $(".enviar_team" + (key + 1)).hide();


            });

        });

    </script>

    <script>
        $('.update_audio').click(function () {

            $(this).hide();
            $('.cancel_audio').show();

            $('.drop_audio').show();
            $('.player').hide();


        });
        $('.cancel_audio').click(function () {
            $(this).hide();
            $('.update_audio').show();
            $('.drop_audio').hide();
            $('.player').show();


        });

    </script>
@endsection
@section('js.add-project')

    <script>
        var id =@json($artist->projects);
        var idProject = -1;
        if (id.length != 0) {
            idProject = id[0].id;
        }

        var dropzone = new Dropzone('.dropzone-audio', {
            url: '{{route('update.audio')}}',
            acceptedFiles: 'audio/*,video/*',
            maxFiles: 1,
            paramName: 'audio',
            headers: {
                'idproject': idProject,
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            processing: function (file, response) {
                $('body').loading({
                    message: 'Subiendo canción...',
                    start: true,
                });
                // this.success();
            },
            success: function (file, response) {

                $('body').loading({
                    message: 'Subiendo canción...',
                    start: false,
                });
                $("#erroresImagen").text('');
                $('#inputDBAudioAddProject').val(response);
                $('#img_add_proyect').attr('src', response);
                $('.update_audio').show();
                $('.drop_audio').hide();
                $('.player').show();
                $('.cancel_audio').hide();

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.success("El audio se actualizo correctamente", "Información");
                window.location.reload();
            },
            error: function (file, e, i, o, u) {

                $('body').loading({
                    start:false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El audio no se cargó correctamente, inténtalo más tarde", "Información");

                $("#erroresImagen").text('');
                if (file.xhr.status === 413) {
                    $("#erroresImagen").text('{{__("imagen_grande")}}');
                    $(file.previewElement).addClass("dz-error").find('.dz-error-message').text('{{__("imagen_grande")}}');
                    setTimeout(() => {
                        dropzone.removeFile(file)
                    }, 1000)
                }
            }
        });
        dropzone.on("addedfile", function (file) {
            file.previewElement.addEventListener("click", function () {
                dropzone.removeFile(file);
            });
        });
        Dropzone.autoDiscover = false;


    </script>

    <script>
        // evento ddel boton enviar imagenes aspirante
        $('#btn_enviar_asp').click(function (e) {
            e.preventDefault();

            if ($("input[name='aspirante[urlImageDocumentAtras]']").val() != "" && $("input[name='aspirante[urlImageDocumentFrente]']").val() != "") {
                $('#form_update_img').submit();
                swal({
                    "title": "",
                    "text": 'Cargado correctamente',
                    "type": "success",
                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                }).then((result) => {
                    if (result.value) {

                        document.location.reload();
                    }
                });
            } else {
                swal({
                    "title": "",
                    "text": 'Debe cargar las dos imagenes del documento',
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                }).then((result) => {
                    // document.location.reload();
                });
            }


        });

        // evento ddel boton enviar imagenes beneficiario
        $('#btn_enviar_ben').click(function (e) {
            e.preventDefault();

            if ($("input[name='beneficiario[urlImageDocumentAtras]']").val() != "" && $("input[name='beneficiario[urlImageDocumentFrente]']").val() != "") {
                $('#form_update_img_ben').submit();
                swal({
                    "title": "",
                    "text": 'Cargado correctamente',
                    "type": "success",
                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                }).then((result) => {
                    if (result.value) {

                        document.location.reload();
                    }
                });
            } else {
                swal({
                    "title": "",
                    "text": 'Debe cargar las dos imagenes del documento',
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                }).then((result) => {
                    // document.location.reload();
                });
            }


        });


        // evento ddel boton enviar imagenes team

        $.each( @json($artist->teams), function (key, value) {
            $('#btn_enviar_team' + (key + 1)).click(function (e) {
                e.preventDefault();


                if ($("input[name='team[urlImageDocumentAtras]" + (key + 1) + "']").val() != "" && $("input[name='team[urlImageDocumentFrente]" + (key + 1) + "']").val() != "") {
                    $('#form_update_img_team' + (key + 1)).submit();
                    swal({
                        "title": "",
                        "text": 'Cargado correctamente',
                        "type": "success",
                        "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                    }).then((result) => {
                        if (result.value) {

                            //    document.location.reload();
                        }
                    });
                } else {
                    swal({
                        "title": "",
                        "text": 'Debe cargar las dos imagenes del documento',
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                    }).then((result) => {
                        // document.location.reload();
                    });
                }


            });
        });
    </script>

@endsection

