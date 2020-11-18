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
                        <span class="m-nav__link-text">{{__('perfil')}} Subsanador</span>
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
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="my-scroll-nav nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary"
                                role="tablist">
                                <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link active" data-toggle="tab"
                                           href="#m_user_profile_tab_1"
                                           role="tab">Información del subsanador
                                        </a>
                                </li>
                                @if(auth()->user()->roles[0]->rol == "Subsanador")
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab"
                                           href="#m_user_profile_tab_12"
                                           role="tab">Configuración del perfil
                                        </a>
                                    </li>
                                @endif
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
                                                                Electrónico:</label>
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
{{--                                                <div class="col-md-4 col-lg-4 col-12">--}}
{{--                                                    <div class="form-group m-form__group">--}}
{{--                                                        <div id="content-aspirante_name" class="m-form__group-sub">--}}
{{--                                                            <label--}}
{{--                                                                class="form-control-label font-weight-bold">Departamento:</label>--}}
{{--                                                            <p>{{ $userProfile->city->departaments->descripcion }}</p>--}}

{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-4 col-lg-4 col-12">--}}
{{--                                                    <div class="form-group m-form__group">--}}
{{--                                                        <div id="content-aspirante_name" class="m-form__group-sub">--}}
{{--                                                            <label--}}
{{--                                                                class="form-control-label font-weight-bold">Ciudad:</label>--}}
{{--                                                            <p>{{ $userProfile->city->descripcion }}</p>--}}

{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
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
                                                          action="{{ route('update.password.subsanador') }}">
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
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        new Dropzone('.dropzone-management', {
            url: '{{ route('profile.photo.subsanador') }}',
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
