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
                                           role="tab">Información del beneficiario
                                        </a>
                                    </li>
                                @endif
                                @if(count($artist->teams) !== 0)
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab"
                                           href="#m_user_profile_tab_3"
                                           role="tab">Información del grupo
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
                                    {{-- @dd($artist); --}}

                                    <div class="col-md-6 mt-2">
                                        <label style="font-weight: bold">Identificación:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->identification }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label style="font-weight: bold">Direccion:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->adress }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label style="font-weight: bold">Departamento de nacimiento:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            {{$artist->city->departaments->descripcion}}</p>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label style="font-weight: bold">Fecha de nacimiento:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ Carbon\Carbon::parse($artist->byrthdate)->formatLocalized('%d de %B de %Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <label style="font-weight: bold">Ciudad de nacimiento:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            {{$artist->city->descripcion}}</p>
                                        </div>

                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <label style="font-weight: bold">Teléfono:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->users->phone_1}}</p>
                                        </div>
                                    </div>
                                    @if($artist->township)
                                        <div class="col-md-6 mt-2">
                                            <label style="font-weight: bold">Vereda/Corregimiento:</label>
                                            <div class="m-scrollable" data-scrollable="true" style="">
                                                <p>{{$artist->township }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-6 mt-2">
                                        <label style="font-weight: bold">Linea de convocatoria:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->personType->name}}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <label style="font-weight: bold">Actuara como:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->artistType->name}}</p>
                                        </div>
                                    </div>


                                    <div class="col-md-6 mt-2">

                                        <label style="font-weight: bold">{{ __('Departamento de Expedición') }}
                                            :</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p style="text-align: justify">{{ $artist->expeditionPlace->departaments->descripcion }}</p>
                                        </div>
                                        {{-- @dd($artist); --}}
                                    </div>


                                    @if($artist->users->phone_2)
                                        <div class="col-md-6 mt-2">
                                            <label style="font-weight: bold">Otro teléfono:</label>
                                            <div class="m-scrollable" data-scrollable="true" style="">
                                                <p>{{$artist->users->phone_2 }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-6 mt-2">

                                        <label style="font-weight: bold">{{ __('Ciudad de Expedición') }}
                                            :</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p style="text-align: justify">{{ $artist->expeditionPlace->descripcion }}</p>
                                        </div>
                                        {{-- @dd($artist); --}}
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label style="font-weight: bold">Documento de identificación:</label>
                                        <button type="button" class="btn btn-primary btn_pdf_asp"
                                                data-toggle="modal"
                                                data-target="#verpdfidentificacion">
                                            Ver documento de identidad
                                        </button>
                                        <div class="row drop_pdf_asp" style="display: none">
                                            <div class="col">
                                                <div class="form-group m-form__group ">
                                                    <div class="m-dropzone dropzone m-dropzone--success"
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
                                        <i class="flaticon-edit ml-3 update_pdf_asp"
                                           style="color:#716aca; cursor:pointer;"></i>
                                        <button type="button" class="btn btn-primary cancel_pdf_asp"
                                                style="display:none">Cancelar
                                        </button>


                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-2">

                                        <label style="font-weight: bold">{{ __('biografia') }}:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p style="text-align: justify">{{ $artist->biography }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                            <div class="col-lg-12 m-form__group-sub {{$errors->has('subir_cancion')? 'has-danger':''}}">
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-12">
                                                        <label class="form-control-label" form="nombreProyecto"><span class="text-danger">*</span>
                                                            Subir canción:</label>
                                                        <div class="m-dropzone dropzone-audio m-dropzone--success" action=""
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
                                            <i class="flaticon-edit ml-3 update_audio" style="color:#716aca; cursor:pointer;"></i>
                                           <button type="button" class="btn btn-primary cancel_audio" style="display:none">Cancelar</button>

                                        </div>
                                        <div class="secondary_audios col-md-12 row mt-5">
                                            @if($artist->projects[0]->audio_secundary_two)
                                            <div class="col-6 player">
                                                <label style="font-weight: bold" class="form-control-label" form="nombreProyecto">
                                                    Canción extra uno(no participa en el concurso):</label>
                                                <audio preload="auto" controls>
                                                    <source src="{{ $artist->projects[0]->audio_secundary_two}}">
                                                    {{-- <input name="project_id" id="project_id" type="hidden" value="{{ $project->id }}"> --}}
                                                </audio>

                                            </div>
                                            @endif
                                            @if($artist->projects[0]->audio_secundary_one)
                                            <div class="col-6 player">
                                                <label style="font-weight: bold" class="form-control-label" form="nombreProyecto">
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
                                                    {{-- <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                                                        <div class="m-demo__preview">
                                                            <!-- CAMBIAR LA CONTRASEÑA DEL USUARIO, PERO PRIMERO SE VALIDA SI EL USUARIO ES NO ES DE ALGUNA RED SOCIAL -->
                                                            @if(!$artist->users->socialAcounts)
                                                                <form method="post" action="{{ route('update.password.artist') }}">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div
                                                                                class="form-group m-form__group {{$errors->has('password')? 'has-danger':''}}">
                                                                                <label
                                                                                    for="exampleInputPassword1">{{ __('actualizar_contraseña') }}</label>
                                                                                <input type="password" name="password" class="form-control m-input"
                                                                                       id="exampleInputPassword1"
                                                                                       placeholder="{{ __('actualizar_contraseña') }}">
                                                                                {!! $errors->first('password','<div class="form-control-feedback">
                                                                                    *:message</div>')!!}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div
                                                                                class="form-group m-form__group {{$errors->has('password_confirmation')? 'has-danger':''}}">
                                                                                <label
                                                                                    for="exampleInputPassword1">{{ __('confirmar_contraseña') }}</label>
                                                                                <input type="password" name="password_confirmation"
                                                                                       class="form-control m-input" id="exampleInputPassword1"
                                                                                       placeholder="{{ __('confirmar_contraseña') }}">
                                                                                {!! $errors->first('password_confirmation','<div
                                                                                    class="form-control-feedback">*:message</div>')!!}
                                                                            </div>
                                                                            <button type="submit"
                                                                                    class="btn btn-outline-success btn-sm m-btn m-btn--custom pull-right">{{ __('actualizar') }}</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            @endif
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group m-form__group ">
                                                                        <label for="">Imagén de Perfil</label>
                                                                        <div class="m-dropzone dropzone m-dropzone--success"
                                                                             action="inc/api/dropzone/upload.php" id="m-dropzone-three">
                                                                            <div class="m-dropzone__msg dz-message needsclick">
                                                                                <h3 class="m-dropzone__msg-title">
                                                                                    {{ __('actualizar_foto_perfil') }}</h3>
                                                                                <span
                                                                                    class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group m-form__group ">
                                                                        <label for="">Imagén de Portada</label>
                                                                        <div class="m-dropzone front_dropzone m-dropzone--success"
                                                                             action="inc/api/dropzone/upload.php" id="m-dropzone-three">
                                                                            <div class="m-dropzone__msg dz-message needsclick">
                                                                                <h3 class="m-dropzone__msg-title">
                                                                                    {{ __('actualizar_foto_portada') }}</h3>
                                                                                <span
                                                                                    class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}

                                                    <div
                                                        class="m-accordion m-accordion--bordered m-accordion--solid"
                                                        id="m_accordion_4" role="tablist">

                                                        <!--begin::Item-->
                                                        @foreach ($artist->teams as $team)
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
                                                                                                style="font-weight: bold">Tipo
                                                                                                identificación:</label>
                                                                                            <div
                                                                                                class="m-scrollable"
                                                                                                data-scrollable="true"
                                                                                                style="">
                                                                                                <p>{{ $team->document_type}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-4 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Identificación:</label>
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
                                                                                                <p>{{ $team->last_name}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-4 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Direccion:</label>
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
                                                                                                style="font-weight: bold">Fecha
                                                                                                de
                                                                                                nacimiento:</label>
                                                                                            <div
                                                                                                class="m-scrollable"
                                                                                                data-scrollable="true"
                                                                                                style="">
                                                                                                <p>{{  Carbon\Carbon::parse($team->birthday)->formatLocalized('%d de %B de %Y') }}</p>
                                                                                            </div>
                                                                                        </div>


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
                                                                                        <div
                                                                                            class="col-md-4 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Teléfono:</label>
                                                                                            <div
                                                                                                class="m-scrollable"
                                                                                                data-scrollable="true"
                                                                                                style="">
                                                                                                <p>{{ $team->phone2}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-md-4 mt-2">

                                                                                            <label
                                                                                                style="font-weight: bold">Rol:</label>
                                                                                            <div
                                                                                                class="m-scrollable"
                                                                                                data-scrollable="true"
                                                                                                style="">
                                                                                                <p style="text-align: justify">{{ $team->role}}</p>
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
                                                                                                <p>{{ $team->expeditionPlace->departaments->descripcion}}</p>
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
                                                                                                <p>{{ $team->expeditionPlace->descripcion}}</p>
                                                                                            </div>

                                                                                        </div>

                                                                                        <div
                                                                                            class="col-md-12 mt-2">
                                                                                            <label
                                                                                                style="font-weight: bold">Documento
                                                                                                de
                                                                                                identificación:</label>

                                                                                            <button
                                                                                                type="button"
                                                                                                class="ml-4 btn btn-primary btn_pdf_team{{ $loop->iteration }}"
                                                                                                data-toggle="modal"
                                                                                                data-target="#pdfidentificacion{{$loop->iteration}}">
                                                                                                Ver documento de
                                                                                                identidad
                                                                                            </button>
                                                                                            <div
                                                                                                class="row drop_pdf_team{{ $loop->iteration }}"
                                                                                                style="display: none">
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
                                                                                            <i class="flaticon-edit ml-3 update_pdf_team{{ $loop->iteration }}"
                                                                                               style="color:#716aca; cursor:pointer;"></i>
                                                                                            <button
                                                                                                type="button"
                                                                                                class="btn btn-primary cancel_pdf_team{{ $loop->iteration }}"
                                                                                                style="display:none">
                                                                                                Cancelar
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
                                                                                de {{ $team->name}}</h5>
                                                                            <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            @if(!$team->pdf_identificacion)
                                                                                <p>No se cargo el documento
                                                                                    correctamente</p>
                                                                            @else
                                                                                <div>
                                                                                    <embed
                                                                                        src="{{ $team->pdf_identificacion }}"
                                                                                        frameborder="0"
                                                                                        width="100%"
                                                                                        height="400px">
                                                                                </div>
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

                                                    <div class="col-md-4 mb-5">
                                                        <div class="m-scrollable" data-scrollable="true"
                                                             style="">
                                                            <img class="ml-4"
                                                                 style="border-radius:8rem; width:7rem"
                                                                 src="{{$artist->beneficiary[0]->picture}}">
                                                        </div>

                                                    </div>
                                                @else

                                                    <div class="col-md-4 mb-5">
                                                        <div class="m-scrollable" data-scrollable="true"
                                                             style="">
                                                            <img class="ml-4"
                                                                 style="border-radius:8rem; width:7rem"
                                                                 src="/default/user.png">
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
                                                    <label style="font-weight: bold">Identificación:</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        <p>{{ $artist->beneficiary[0]->identification}}</p>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mt-2">
                                                    <label style="font-weight: bold">Direccion:</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        <p>{{ $artist->beneficiary[0]->adress}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-2">
                                                    <label style="font-weight: bold">Fecha de
                                                        nacimiento:</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        <p>{{  Carbon\Carbon::parse($artist->beneficiary[0]->birthday)->formatLocalized('%d de %B de %Y') }}</p>
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


                                                <div class="col-md-4 mt-2">

                                                    <label
                                                        style="font-weight: bold">{{ __('Departamento de expedición') }}
                                                        :</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        <p style="text-align: justify">{{ $artist->beneficiary[0]->expeditionPlace->departaments->descripcion}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-2">

                                                    <label
                                                        style="font-weight: bold">{{ __('Ciudad de expedición') }}
                                                        :</label>
                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                        <p style="text-align: justify">{{ $artist->beneficiary[0]->expeditionPlace->descripcion}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 mt-2" style="margin-right:-4rem">
                                                    <label style="font-weight: bold">Documento de
                                                        identificación:</label>

                                                    <button type="button" class="btn btn-primary btn_pdf_ben"
                                                            data-toggle="modal"
                                                            data-target="#pdfidentificacionBeneficiario">
                                                        Ver documento de identidad
                                                    </button>
                                                    <div class="row drop_pdf_ben" style="display: none">
                                                        <div class="m-loader m-loader--brand" style="width: 30px; display: inline-block;"></div>
                                                        <div class="col">
                                                            <div class="form-group m-form__group ">
                                                                <div
                                                                    class="m-dropzone dropzone-ben m-dropzone--success"
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
                                                    <i class="flaticon-edit ml-3 update_pdf_ben"
                                                       style="color:#716aca; cursor:pointer;"></i>
                                                    <button type="button" class="btn btn-primary cancel_pdf_ben"
                                                            style="display:none">Cancelar
                                                    </button>

                                                </div>

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
                                                    Documento de {{ $artist->beneficiary[0]->name}}</h5>

                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @if(!$artist->beneficiary[0]->pdf_documento)
                                                    <p>No se cargo el documento correctamente</p>
                                                @else
                                                    <div>
                                                        <embed src="{{ $artist->beneficiary[0]->pdf_documento}}"
                                                               frameborder="0" width="100%" height="400px">
                                                    </div>
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
                                Documento de {{ $artist->users->name }} {{ $artist->users->last_name }}</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            @if(!$artist->users->pdf_cedula )
                                <p>No se cargo el documento correctamente</p>
                            @else
                                <div>
                                    <embed src="{{ $artist->users->pdf_cedula }}" frameborder="0" width="100%"
                                           height="400px">
                                </div>
                            @endif
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
        new Dropzone('.dropzone',{
            url: '{{ route('cedula.pdf.aspirante') }}',
            acceptedFiles: '.pdf',
            maxFiles: 1,
            paramName: 'pdf_cedula_name',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
            }

        });

        Dropzone.autoDiscover = false;
        // actualizar pdf beneficiario
        new Dropzone('.dropzone-ben', {
            url: '{{ route('cedula.pdf.beneficiario') }}',
            acceptedFiles: '.pdf',
            maxFiles: 1,
            paramName: 'pdf_cedula_name',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
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

            }

        });

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
                }

            });
        });


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
        $('.update_pdf_asp').click(function () {
            $(this).hide();
            $('.cancel_pdf_asp').show();

            $('.drop_pdf_asp').show();
            $('.btn_pdf_asp').hide();


        });
        $('.cancel_pdf_asp').click(function () {
            $(this).hide();
            $('.update_pdf_asp').show();
            $('.drop_pdf_asp').hide();
            $('.btn_pdf_asp').show();


        });

    </script>
    {{-- editar identificacion beneficiario --}}
    <script>
        $('.update_pdf_ben').click(function () {
            $(this).hide();
            $('.cancel_pdf_ben').show();

            $('.drop_pdf_ben').show();
            $('.btn_pdf_ben').hide();


        });
        $('.cancel_pdf_ben').click(function () {
            $(this).hide();
            $('.update_pdf_ben').show();
            $('.drop_pdf_ben').hide();
            $('.btn_pdf_ben').show();


        });

    </script>
    <script>
        $.each( @json($artist->teams), function (key, value) {
//   alert('update_pdf_team'+(key+1));

            $('.update_pdf_team' + (key + 1)).click(function () {
                $(this).hide();
                $('.cancel_pdf_team' + (key + 1)).show();

                $('.drop_pdf_team' + (key + 1)).show();
                $('.btn_pdf_team' + (key + 1)).hide();


            });
            $('.cancel_pdf_team' + (key + 1)).click(function () {
                $(this).hide();
                $('.update_pdf_team' + (key + 1)).show();
                $('.drop_pdf_team' + (key + 1)).hide();
                $('.btn_pdf_team' + (key + 1)).show();


            });

        });

    </script>
    <script>
        $('.update_audio').click(function(){

            $(this).hide();
            $('.cancel_audio').show();

            $('.drop_audio').show();
            $('.player').hide();


        });
        $('.cancel_audio').click(function(){
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
        if(id.length != 0){
            idProject= id[0].id;
        }

        var dropzone = new Dropzone('.dropzone-audio', {
            url: '{{route('update.audio')}}',
            acceptedFiles: 'audio/*',
            maxFiles: 1,
            paramName: 'audio',
            headers: {
                'idproject': idProject,
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (file, response) {
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

@endsection

