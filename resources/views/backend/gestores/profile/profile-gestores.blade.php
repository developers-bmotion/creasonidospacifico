@extends('backend.layout')

@section('header')
    {{--@if($errors->any())

        <ul class="list-group">

            @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <strong>Error!</strong> {{$error}}
                </div>
            @endforeach

        </ul>

    @endif--}}
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{ __('perfil') }}</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-user"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('perfil')}} Gestor</span>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text"></span>
                    </a>
                </li>
            </ul>
        </div>
        <div>
        </div>
    </div>

@stop
@section('content')
    <div class="m-content">
        @if(session()->has('new_register'))
            <div class="m-alert m-alert--icon m-alert--outline alert alert-success" role="alert">
                <div class="m-alert__icon">
                    <i class="la la-check"></i>
                </div>
                <div class="m-alert__text">
                    <strong>¡Bien hecho!</strong> {{session('new_register')}}
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-xl-3 col-lg-4">
                @include('backend.gestores.partials.siderbar-profile')
            </div>
            <div class="col-xl-9 col-lg-8">
                <!--=====================================
		         VISTA PARA EL MANAGEMENT
                ======================================-->

                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                    @if(auth()->user()->roles[0]->rol == "Manage")
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-tools">
                                <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary"
                                    role="tablist">
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link active" data-toggle="tab"
                                           href="#m_user_profile_tab_1" role="tab">
                                            <i class="flaticon-share m--hide"></i>
                                            {{ __('actualizar_perfil') }}
                                        </a>
                                    </li>
                                    {{-- <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2"
                                           role="tab">
                                            {{ __('mensajes') }}
                                        </a>
                                    </li> --}}
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3"
                                           role="tab">
                                            {{ __('configuracion') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <!--=====================================
                             ACTUALIZAR PERFIL DEL USUARIO
                            ======================================-->
                        {{--                            <div class="tab-pane active" id="m_user_profile_tab_1">--}}
                        {{--                                <form method="post" action="{{ route('update.profile.management',$user->id) }}"--}}
                        {{--                                      class="m-form m-form--fit m-form--label-align-right">--}}
                        {{--                                    @csrf {{method_field('PUT')}}--}}
                        {{--                                    <div class="m-portlet__body">--}}
                        {{--                                        <div class="form-group m-form__group row">--}}
                        {{--                                            <div class="col-10 ml-auto">--}}
                        {{--                                                <h3 class="m-form__section">1. Info {{ __('management') }}</h3>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="form-group m-form__group row {{$errors->has('company')? 'has-danger':''}}">--}}
                        {{--                                            <label for="example-text-input"--}}
                        {{--                                                   class="col-2 col-form-label">{{ __('empresa') }}</label>--}}
                        {{--                                            <div class="col-7">--}}
                        {{--                                                <input class="form-control m-input" type="text" name="company"--}}
                        {{--                                                       value="{{ $managements->company }}">--}}
                        {{--                                                {!! $errors->first('company','<div class="form-control-feedback">*:message</div>')!!}--}}
                        {{--                                                <span class="m-form__help">{{ __('sugerencia_compañia') }}</span>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}

                        {{--                                        <div class="form-group m-form__group row {{$errors->has('descripcion')? 'has-danger':''}}">--}}
                        {{--                                            <label for="example-text-input"--}}
                        {{--                                                   class="col-2 col-form-label">{{ __('descripcion') }}</label>--}}
                        {{--                                            <div class="col-7">--}}
                        {{--                                            <textarea class="form-control m-input m-input--solid" id="exampleTextarea"--}}
                        {{--                                                      name="descripcion"--}}
                        {{--                                                      rows="9">{{ $managements->description }}</textarea>--}}
                        {{--                                                {!! $errors->first('descripcion','<div class="form-control-feedback">*:message</div>')!!}--}}
                        {{--                                                <span class="m-form__help">{{ __('sugerencia_descripcion') }}</span>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                        <div class="form-group m-form__group row {{$errors->has('web_site')? 'has-danger':''}}">--}}
                        {{--                                            <label for="example-text-input"--}}
                        {{--                                                   class="col-2 col-form-label">Web Site</label>--}}
                        {{--                                            <div class="col-7">--}}
                        {{--                                                <input class="form-control m-input" type="text" name="web_site"--}}
                        {{--                                                       value="{{ $managements->website_url }}">--}}
                        {{--                                                {!! $errors->first('web_site','<div class="form-control-feedback">*:message</div>')!!}--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="m-portlet__foot m-portlet__foot--fit">--}}
                        {{--                                        <div class="m-form__actions">--}}
                        {{--                                            <div class="row">--}}
                        {{--                                                <div class="col-2">--}}
                        {{--                                                </div>--}}
                        {{--                                                <div class="col-7 text-center">--}}
                        {{--                                                    <button type="submit"--}}
                        {{--                                                            class="btn btn-accent m-btn m-btn--air m-btn--custom">{{ __('guardar_cambios') }}</button>--}}

                        {{--                                                </div>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </div>--}}
                        {{--                                    <input type="hidden" name="id_management" value="">--}}
                        {{--                                </form>--}}
                        {{--                            </div>--}}

                        <!--=====================================
                             CONFIGURACIONES
                            ======================================-->
                            <div class="tab-pane " id="m_user_profile_tab_1">
                                <div class="m-portlet__body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="m-section">
                                                <!--=====================================
                                                CONFIGURACIONES PARA EL BACKER
                                                ======================================-->
                                                <span class="m-section__sub">
												{{ __('patrocinador') }}
											</span>
                                                <div class="m-section__content">
                                                    <div class="m-demo" data-code-preview="true" data-code-html="true"
                                                         data-code-js="false">
                                                        <div class="m-demo__preview">

                                                            <!--begin::Form-->
                                                            <form class="m-form">
                                                                <div class="m-form__group form-group row">
                                                                    <label
                                                                        class="col-12 col-form-label">{{ __('mostrar_patrocinador') }}</label>
                                                                    <div class="col-12">
                                                                    <span class="m-switch m-switch--icon">
                                                                        <label>
                                                                            <input type="checkbox" checked="checked"
                                                                                   name="">
                                                                            <span></span>
                                                                        </label>
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <!--end::Form-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="m-section">
                                                <!--=====================================
                                               CONFIGURACIONES PARA EL PERFIL DE USUARIO
                                               ======================================-->
                                                <span class="m-section__sub">
												{{ __('perfil') }}
                                            </span>

                                                <div class="m-section__content">
                                                    <div class="m-demo" data-code-preview="true" data-code-html="true"
                                                         data-code-js="false">
                                                        <div class="m-demo__preview">
                                                            <!-- CAMBIAR LA CONTRASEÑA DEL USUARIO, PERO PRIMERO SE VALIDA SI EL USUARIO ES NO ES DE ALGUNA RED SOCIAL -->
                                                            <form method="post"
                                                                  action="{{ route('update.password.management') }}">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div
                                                                            class="form-group m-form__group {{$errors->has('password')? 'has-danger':''}}">
                                                                            <label
                                                                                for="exampleInputPassword1">{{ __('actualizar_contraseña') }}</label>
                                                                            <input type="password" name="password"
                                                                                   class="form-control m-input"
                                                                                   id="exampleInputPassword1"
                                                                                   placeholder="{{ __('actualizar_contraseña') }}">
                                                                            {!! $errors->first('password','<div class="form-control-feedback">*:message</div>')!!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div
                                                                            class="form-group m-form__group {{$errors->has('password_confirmation')? 'has-danger':''}}">
                                                                            <label
                                                                                for="exampleInputPassword1">{{ __('confirmar_contraseña') }}</label>
                                                                            <input type="password"
                                                                                   name="password_confirmation"
                                                                                   class="form-control m-input"
                                                                                   id="exampleInputPassword1"
                                                                                   placeholder="{{ __('confirmar_contraseña') }}">
                                                                            {!! $errors->first('password_confirmation','<div class="form-control-feedback">*:message</div>')!!}
                                                                        </div>
                                                                        <button type="submit"
                                                                                class="btn btn-outline-success btn-sm m-btn m-btn--custom pull-right">{{ __('actualizar') }}</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group m-form__group">
                                                                        <label for="">Imagén de Perfil</label>
                                                                        <div
                                                                            class="m-dropzone dropzone-management m-dropzone--success"
                                                                            action="inc/api/dropzone/upload.php"
                                                                            id="m-dropzone-three">
                                                                            <div
                                                                                class="m-dropzone__msg dz-message needsclick">
                                                                                <h3 class="m-dropzone__msg-title">{{ __('actualizar_foto_perfil') }}</h3>
                                                                                <span
                                                                                    class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group m-form__group">
                                                                        <label for="">Imagén de Portada</label>
                                                                        <div class="m-dropzone dropzone-management m-dropzone--success"
                                                                             action="inc/api/dropzone/upload.php"
                                                                             id="m-dropzone-three">
                                                                            <div class="m-dropzone__msg dz-message needsclick">
                                                                                <h3 class="m-dropzone__msg-title">{{ __('actualizar_foto_perfil') }}</h3>
                                                                                <span class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @else
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-tools">
                                <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary"
                                    role="tablist">
                                    <li class="nav-item m-tabs__item">
                                        @if(session()->has('new_register'))
                                            <a class="nav-link m-tabs__link" data-toggle="tab"
                                               href="#m_user_profile_tab_1"
                                               role="tab">Información del gestor
                                            </a>
                                        @else
                                            <a class="nav-link m-tabs__link active" data-toggle="tab"
                                               href="#m_user_profile_tab_1"
                                               role="tab">Información del gestor
                                            </a>
                                        @endif
                                    </li>
                                    @if(auth()->user()->roles[0]->rol == "Gestor")
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link" data-toggle="tab"
                                               href="#m_user_profile_tab_12"
                                               role="tab">Configuración del perfil
                                            </a>
                                        </li>
                                    @endif
                                    <li class="nav-item m-tabs__item">
                                        @if(session()->has('new_register'))
                                            <a class="nav-link m-tabs__link active" data-toggle="tab"
                                               href="#m_user_profile_tab_3"
                                               role="tab">Aspirantes Registrados
                                            </a>
                                        @else
                                            <a class="nav-link m-tabs__link" data-toggle="tab"
                                               href="#m_user_profile_tab_3"
                                               role="tab">Aspirantes Registrados
                                            </a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            @if(session()->has('new_register'))
                                <div class="tab-pane" id="m_user_profile_tab_1">
                                    @else
                                        <div class="tab-pane active" id="m_user_profile_tab_1">
                                            @endif
                                            <div class="m-portlet__body">
                                                <div class="row">
                                                    <div class="col-md-4 col-lg-4 col-12">
                                                        <div class="form-group m-form__group">
                                                            <div id="content-aspirante_name" class="m-form__group-sub">
                                                                <label
                                                                    class="form-control-label font-weight-bold">Nombre:</label>
                                                                <p>{{ $userProfile->name }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-12">
                                                        <div class="form-group m-form__group">
                                                            <div id="content-aspirante_name" class="m-form__group-sub">
                                                                <label
                                                                    class="form-control-label font-weight-bold">Apellidos:</label>
                                                                <p>{{ $userProfile->last_name }}</p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-12">
                                                        <div class="form-group m-form__group">
                                                            <div id="content-aspirante_name" class="m-form__group-sub">
                                                                <label
                                                                    class="form-control-label font-weight-bold">Correo
                                                                    Eléctronico:</label>
                                                                <p>{{ $userProfile->email }}</p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-12">
                                                        <div class="form-group m-form__group">
                                                            <div id="content-aspirante_name" class="m-form__group-sub">
                                                                <label
                                                                    class="form-control-label font-weight-bold">Teléfono:</label>
                                                                <p>{{ $userProfile->phone_1 }}</p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-12">
                                                        <div class="form-group m-form__group">
                                                            <div id="content-aspirante_name" class="m-form__group-sub">

                                                                <label
                                                                    class="form-control-label font-weight-bold">Tipo de
                                                                    Documento:</label>
                                                                <p>{{ $userProfile->documentType->document }}</p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-12">
                                                        <div class="form-group m-form__group">
                                                            <div id="content-aspirante_name" class="m-form__group-sub">

                                                                <label
                                                                    class="form-control-label font-weight-bold">Nº
                                                                    Identificación:</label>
                                                                <p>{{ $userProfile->identification }}</p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-12">
                                                        <div class="form-group m-form__group">
                                                            <div id="content-aspirante_name" class="m-form__group-sub">
                                                                <label
                                                                    class="form-control-label font-weight-bold">Departamento:</label>
                                                                <p>{{ $userProfile->city->departaments->descripcion }}</p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-12">
                                                        <div class="form-group m-form__group">
                                                            <div id="content-aspirante_name" class="m-form__group-sub">
                                                                <label
                                                                    class="form-control-label font-weight-bold">Ciudad:</label>
                                                                <p>{{ $userProfile->city->descripcion }}</p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-12 col-lg-12">
                                                        <div class="form-group m-form__group">
                                                            <div id="content-aspirante_name" class="m-form__group-sub">
                                                                <label
                                                                    class="form-control-label font-weight-bold">Perfil:</label>
                                                                <p>{{ $userProfile->profile }}</p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="tab-pane" id="m_user_profile_tab_12">
                                            <div class="m-portlet__body">
                                                <div class="row">
                                                    <div class="col-lg-12">

                                                        <!--=====================================
                                                       CONFIGURACIONES PARA EL PERFIL DE USUARIO
                                                       ======================================-->
                                                        <!-- CAMBIAR LA CONTRASEÑA DEL USUARIO, PERO PRIMERO SE VALIDA SI EL USUARIO ES NO ES DE ALGUNA RED SOCIAL -->
                                                        <form method="post"
                                                              action="{{ route('update.password.gestor') }}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div
                                                                        class="form-group m-form__group {{$errors->has('password')? 'has-danger':''}}">
                                                                        <label
                                                                            for="exampleInputPassword1">{{ __('actualizar_contraseña') }}</label>
                                                                        <input type="password" name="password"
                                                                               class="form-control m-input"
                                                                               id="exampleInputPassword1"
                                                                               placeholder="{{ __('actualizar_contraseña') }}">
                                                                        {!! $errors->first('password','<div class="form-control-feedback">*:message</div>')!!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div
                                                                        class="form-group m-form__group {{$errors->has('password_confirmation')? 'has-danger':''}}">
                                                                        <label
                                                                            for="exampleInputPassword1">{{ __('confirmar_contraseña') }}</label>
                                                                        <input type="password"
                                                                               name="password_confirmation"
                                                                               class="form-control m-input"
                                                                               id="exampleInputPassword1"
                                                                               placeholder="{{ __('confirmar_contraseña') }}">
                                                                        {!! $errors->first('password_confirmation','<div class="form-control-feedback">*:message</div>')!!}
                                                                    </div>
                                                                    <button type="submit"
                                                                            class="btn btn-outline-success btn-sm m-btn m-btn--custom pull-right">{{ __('actualizar') }}</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group m-form__group">
                                                                    <label for="">Imagén de Perfil</label>
                                                                    <div
                                                                        class="m-dropzone dropzone-management m-dropzone--success"
                                                                        action="inc/api/dropzone/upload.php"
                                                                        id="m-dropzone-three">
                                                                        <div
                                                                            class="m-dropzone__msg dz-message needsclick">
                                                                            <h3 class="m-dropzone__msg-title">{{ __('actualizar_foto_perfil') }}</h3>
                                                                            <span
                                                                                class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if(session()->has('new_register'))
                                            <div class="tab-pane active" id="m_user_profile_tab_3">
                                                @else
                                                    <div class="tab-pane" id="m_user_profile_tab_3">
                                                        @endif
                                                        <div class="m-portlet__body">
                                                            <div class="m-portlet__head">
                                                                <div class="m-portlet__head-caption">
                                                                    <div class="m-portlet__head-title">
                                                                        <h3 class="m-portlet__head-text">
                                                                            Todos los aspirantes
                                                                        </h3>
                                                                    </div>
                                                                </div>
                                                                <div class="m-portlet__head-tools">

                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="m-portlet__body">
                                                                        <table
                                                                            class="table table-striped- table-bordered table-hover table-checkable"
                                                                            id="table_artists">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>Id</th>
                                                                                <th>Aspirante</th>
                                                                                <th>Email</th>
                                                                                <th>N° documento</th>
                                                                                <th>Actuará Como</th>
                                                                                <th>Acciones</th>
                                                                            </tr>
                                                                            </thead>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        @endif
                                </div>
                        </div>
                </div>
            </div>
            @stop

            @push('js')
                <script>
                    var DatatablesExtensionsScroller = function () {
                        var initTable1 = function () {
                            var table = $('#table_artists');
                            var cont = 1;

                            // begin first table
                            table.DataTable({
                                "processing": true,
                                "serverSide": true,
                                "data": null,
                                "order": [[0, "asc"]],
                                "responsive": true,
                                "ajax": {
                                    url: "{{ route('artists.manager.table',$userProfile->slug )}}",

                                },
                                "columns": [

                                    {
                                        render: function () {
                                            return cont++;
                                        }

                                    },
                                    {
                                        render: function (data, type, JsonResultRow, meta) {
                                            return '<span class="label label-danger text-center">' + JsonResultRow.users.name + '</span>  <span class="label label-danger text-center">' + JsonResultRow.users.last_name + '</span>';
                                            // return '<img src="' + JsonResultRow + '" width="50px"  style="border-radius: 100%;margin-right: auto;margin-left: auto;display: block; width:50px; height:50px"/>';
                                        },
                                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'


                                    },
                                    {
                                        render: function (data, type, JsonResultRow, meta) {
                                            // console.log(JsonResultRow.users.email,'email');

                                            return JsonResultRow.users.email ? '<span class="label label-danger text-center">' + JsonResultRow.users.email + '</span>' : '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>';

                                        }

                                        // defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                                    },
                                    {
                                        data: 'identification',
                                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                                    },
                                    {
                                        data: 'person_type.name',
                                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                                        // data: 'ganancias',
                                        // defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                                    },
                                    {
                                        render: function (data, type, JsonResultRow, meta) {
                                            // console.log(JSON.stringify(JsonResultRow.projects.slug),'json');
                                            var items = "";
                                            JsonResultRow.projects.map(item => {
                                                // console.log(item,'item');
                                                items = item;
                                            });
                                            return items != "" ? `<div class="text-center"><a href="/dashboard/project/${items.slug}" class="btn m-btn--pill btn-secondary"><i class="fa fa-eye"></i></a></div>` : '<span class="label label-danger text-center ml-4" style="color:red !important">N/A</span>'
                                            // return '<div class="text-center"><a href="/dashboard/project/' + JsonResultRow.projects.slug + '" class="btn m-btn--pill btn-secondary"><i class="fa fa-eye"></i></a></div>'
                                        }
                                    },


                                ],
                                "columnDefs": [
                                    {
                                        targets: -1,
                                        title: 'Acciones',
                                        orderable: false,
                                        render: function (data, type, full, meta) {
                                            return `

                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
                                        },
                                    },
                                    {
                                        "targets": 5,
                                        render: function (data, type, full, meta) {
                                            var status = {
                                                1: {'title': 'Pending', 'class': 'm-badge--brand'},
                                                2: {'title': 'Delivered', 'class': ' m-badge--metal'},
                                                3: {'title': 'Canceled', 'class': ' m-badge--primary'},
                                                4: {'title': 'Success', 'class': ' m-badge--success'},
                                                5: {'title': 'Info', 'class': ' m-badge--info'},
                                                6: {'title': 'Danger', 'class': ' m-badge--danger'},
                                                7: {'title': 'Warning', 'class': ' m-badge--warning'},
                                            };
                                            if (typeof status[data] === 'undefined') {
                                                return data;
                                            }
                                            return '<span class="m-badge ' + status[data].class + ' m-badge--wide">' + status[data].title + '</span>';
                                        },
                                    },

                                ],
                                "language": {
                                    "sProcessing": "{{__('procesando')}}",
                                    "sLengthMenu": "{{__('mostrar')}} _MENU_ {{__('registros')}}",
                                    "sZeroRecords": "No se encontraron resultados",
                                    "sEmptyTable": "{{__('nigun_dato_tabla')}}",
                                    "sInfo": "{{__('mostrando_registros') }} _START_ {{__('from')}} _END_ {{__('total_de')}} _TOTAL_ {{__('registros')}}",
                                    "sInfoEmpty": "{{ __('mostrando_registros_del_cero') }}",
                                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                                    "sInfoPostFix": "",
                                    "sSearch": "{{__('buscar')}}:",
                                    "sUrl": "",
                                    "sInfoThousands": ",",
                                    "sLoadingRecords": "{{__('cargando')}}",
                                    "oPaginate": {
                                        "sFirst": "Primero",
                                        "sLast": "Último",
                                        "sNext": "{{__('siguiente')}}",
                                        "sPrevious": "{{__('anterior')}}"
                                    },
                                    "oAria": {
                                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                    }
                                }
                            });
                        };

                        return {

                            //main function to initiate the module
                            init: function () {
                                initTable1();
                            },

                        };

                    }();

                    jQuery(document).ready(function () {
                        DatatablesExtensionsScroller.init();
                    });

                </script>
                <script>
                    new Dropzone('.dropzone-management', {
                        url: '{{ route('profile.photo.gestor') }}',
                        acceptedFiles: 'image/*',
                        maxFiles: 1,
                        paramName: 'photo',
                        params: {'id_user': '{{  $userProfile->id }}'},
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function (file, response) {

                            location.reload();
                        }

                    });

                    Dropzone.autoDiscover = false;
                </script>
    @endpush
