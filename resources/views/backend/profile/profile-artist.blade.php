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
            <h1 class="m-subheader__title--separator">Perfil del Aspirante</h1>
            {{-- <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-user"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">{{__('perfil')}} {{ __('artista') }}</span>
            </a>
            </li>
            <li class="m-nav__separator">-</li>
            <li class="m-nav__item">
                <a href="" class="m-nav__link">
                    <span class="m-nav__link-text"></span>
                </a>
            </li>
            </ul> --}}
        </div>
        <div>
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
                    <a href="{{ route('add.project') }}" class="btn m-btn--pill btn-success">{{ __('nuevo_proyecto') }}
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
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1"
                                       role="tab">
                                        <i class="flaticon-share m--hide"></i>
                                        Información personal
                                    </a>
                                </li>
                                {{-- <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2"
                                        role="tab">
                                        {{ __('mensajes') }}
                                </a>
                                </li> --}}
                                @if(count($artist->beneficiary) !== 0)
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_4"
                                       role="tab">Información del beneficiario
                                    </a>
                                </li>
                                @endif
                                @if(count($artist->teams) !== 0)
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3"
                                       role="tab">Información del grupo
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        @include('backend.profile.partials.actions-perfil')
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
                                            <label style="font-weight: bold">Documento de identificación:</label>
                                            <button type="button" class="btn btn-primary btn_pdf_asp" data-toggle="modal" data-target="#verpdfidentificacion">
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
                                        <i class="flaticon-edit ml-3 update_pdf_asp" style="color:#716aca; cursor:pointer;"></i>
                                        <button type="button" class="btn btn-primary cancel_pdf_asp" style="display:none">Cancelar</button>



                                        </div>
                                        <div class="col-md-6 mt-2">

                                            <label style="font-weight: bold">{{ __('Departamento de Expedición') }}:</label>
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

                                            <label style="font-weight: bold">{{ __('Ciudad de Expedición') }}:</label>
                                            <div class="m-scrollable" data-scrollable="true" style="">
                                                <p style="text-align: justify">{{ $artist->expeditionPlace->descripcion }}</p>
                                            </div>
                                            {{-- @dd($artist); --}}
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
                                {{-- <form method="post" action="{{ route('update.profile.artist',auth()->user()->id) }}"
                                    class="m-form m-form--fit m-form--label-align-right">
                                    @csrf {{method_field('PUT')}} --}}
                                <div class="row">
                                    <div class="m-portlet__body">
                                        {{-- <div class="form-group m-form__group row">
                                            <div class="col-10 ml-auto">
                                                <h3 class="m-form__section">1. Info {{ __('artista') }}</h3>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="form-group m-form__group row {{$errors->has('nickname')? 'has-danger':''}}">
                                            <label for="example-text-input"
                                                   class="col-2 col-form-label">{{ __('nombre_artistico') }}</label>
                                                   <div class="col-7">
                                                       <input class="form-control m-input" type="text" name="nickname"
                                                       value="{{ old('nickname', $artist->nickname) }}">
                                                       {!! $errors->first('nickname','<div class="form-control-feedback">*:message
                                                </div>')!!}
                                            </div>
                                        </div> --}}

                                        {{-- <div
                                        class="form-group m-form__group row {{$errors->has('biography')? 'has-danger':''}}">
                                        <label for="example-text-input"
                                        class="col-2 col-form-label">{{ __('biografia') }}</label>
                                        <div class="col-7">
                                            <textarea class="form-control m-input m-input--solid" id="exampleTextarea"
                                                      name="biography"
                                                      rows="9">{{ old('biography',$artist->biography) }}</textarea>
                                                      {!! $errors->first('biography','<div class="form-control-feedback">*:message
                                                </div>')!!}
                                                <span class="m-form__help">{{ __('sugerencia_biografia') }}</span>
                                            </div>
                                        </div> --}}

                                        {{-- <div
                                            class="form-group m-form__group row {{$errors->has('birthdate')? 'has-danger':''}}">
                                            <label for="example-text-input"
                                            class="col-2 col-form-label">{{ __('fecha_nacimiento') }}</label>
                                            @if($artist->birthdate == null)
                                            <div class="col-7">
                                                    <input type="text" name="birthdate" class="form-control"
                                                    value="{{ old('birthdate') }}" id="datepicker_fecha_nacimiento" readonly
                                                           placeholder="{{ __('fecha_nacimiento') }}" />
                                                    {!! $errors->first('birthdate','<div class="form-control-feedback">*:message
                                                    </div>')!!}
                                                </div>
                                            @else
                                            <div class="col-7">
                                                <input type="text" name="birthdate" class="form-control"
                                                value="{{ old('birthdate', $artist->birthdate->format('m/d/Y')) }}"
                                                id="datepicker_fecha_nacimiento" readonly
                                                           placeholder="{{ __('fecha_nacimiento') }}" />
                                                           {!! $errors->first('birthdate','<div class="form-control-feedback">*:message
                                                    </div>')!!}
                                                </div>
                                            @endif
                                        </div> --}}

                                        {{--<div class="form-group m-form__group row {{$errors->has('age')? 'has-danger':''}}">
                                        <label for="example-text-input"
                                        class="col-2 col-form-label">{{ __('edad') }}</label>
                                        <div class="col-2">
                                            <input type="number" min="1" max="100" name="age"
                                            value="{{ old('age', $artist->age) }}" class="form-control m-input"
                                            onKeyPress="if(this.value.length==2) return false;" />
                                            {!! $errors->first('age','<div class="form-control-feedback">*:message</div>
                                            ')!!}
                                        </div>
                                    </div>--}}

{{--                                        <div class="form-group m-form__group row {{$errors->has('level_id')? 'has-danger':''}}">--}}
{{--                                            <label for="example-text-input"--}}
{{--                                                   class="col-2 col-form-label">{{ __('level') }}</label>--}}
{{--                                            <div class="col-7">--}}
    {{--                                                <select name="level_id" class="form-control m-bootstrap-select m_selectpicker">--}}
        {{--                                                    @foreach($levels as $level)--}}
{{--                                                        <option value="{{$level->id}}"--}}
{{--                                                            {{ old('level_id',$artist->level_id) == $level->id ? 'selected':''}}>--}}
{{--                                                            {{ $level->level }}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                    {!! $errors->first('level_id','<div class="form-control-feedback">*:message--}}
{{--                                                    </div>')!!}--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <!--=====================================
                                                AQUI SE MUESTRA EL SELECT DONDE ESTAN LOS PAISES
                                        ======================================-->
                                        {{-- <div
                                                class="form-group m-form__group row {{$errors->has('country_id')? 'has-danger':''}}">
                                        <label for="example-text-input" class="col-2 col-form-label">{{ __('pais') }}</label>
                                        <div class="col-7">
                                            <select class="form-control m-select2" id="m_select2_1" name="country_id">
                                                @foreach($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ old('country_id',$artist->country_id) == $country->id ? 'selected':''}}>
                                                    {{ $country->country }}</option>
                                                @endforeach
                                                {!! $errors->first('country_id','<div class="form-control-feedback">*:message
                                                </div>
                                                ')!!}
                                            </select>
                                            <span class="m-form__help">{{ __('sugerencia_country') }}</span>
                                        </div>
                                    </div> --}}
                                    <!--=====================================
                        AQUI SE MUESTRA EL SELECT DONDE ESTAN LAS LOCALIDADES
                ======================================-->
                                        {{-- <div class="form-group m-form__group row {{$errors->has('country_id')? 'has-danger':''}}">
                                        <label for="example-text-input"
                                            class="col-2 col-form-label">{{ __('localizacion') }}</label>
                                        <div class="col-7">
                                            <select class="form-control m-select2" id="select_2_location" name="location_id">

                                                @foreach($locactions as $location)
                                                <option value="{{ $location->id }}"
                                                    {{ old('country_id',$location->country_id) == $location->id ? 'selected':''}}>
                                                    {{ $location->country }}</option>
                                                @endforeach
                                                {!! $errors->first('country_id','<div class="form-control-feedback">*:message</div>
                                                ')!!}
                                            </select>
                                            <span class="m-form__help">{{ __('sugerencia_location') }}</span>
                                        </div>
                                </div> --}}

                                        {{-- <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                        <div class="form-group m-form__group row ">
                                            <div class="col-10 ml-auto">
                                                <h3 class="m-form__section">2. {{ __('personal') }}</h3>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="form-group m-form__group row {{$errors->has('phone_1')? 'has-danger':''}}">
                                            <label for="example-text-input" class="col-2 col-form-label">{{ __('numero_celular') }}</label>
                                            <div class="col-7">
                                                <input id="phone" name="phone_1" type="tel"
                                                       value="{{ old('phone_1',$artist->users->phone_1 )}}" class="activarTelefono">
                                                {!! $errors->first('phone_1','<div class="form-control-feedback">*:message</div>')!!}
                                                <span class="m-form__help">{{ __('indicativo_pais')  }}</span>
                                            </div>
                                        </div> --}}

                                        {{-- <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-10 ml-auto">
                                                <h3 class="m-form__section">3. {{ __('redes_sociales') }}</h3>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                <i class="fab fa-facebook-square fa-2x" style="color: #3b5999"></i>
                                            </label>
                                            <div class="col-7">
                                                <input class="form-control m-input" name="facebook" type="text"
                                                       value="{{ old('facebook',$artist->facebook) }}">
                                            </div>
                                        </div> --}}
                                        {{-- <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                <i class="fab fa-google-plus-g fa-2x" style="color: #dd4b39;margin-right: -8px;"></i>
                                            </label>
                                            <div class="col-7">
                                                <input class="form-control m-input" name="google" type="text"
                                                       value="{{ old('google',$artist->google) }}">
                                            </div>
                                        </div> --}}
                                        {{-- <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                <i class="fab fa-instagram fa-2x" style="color: #e4405f"></i>
                                            </label>
                                            <div class="col-7">
                                                <input class="form-control m-input" name="instagram" type="text"
                                                       value="{{ old('instagram',$artist->instagram) }}">
                                            </div>
                                        </div> --}}
                                        {{-- <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                <i class="fab fa-youtube fa-2x" style="color: #cd201f; margin-right: -3px;"></i>
                                            </label>
                                            <div class="col-7">
                                                <input class="form-control m-input" name="youtube" type="text"
                                                       value="{{ old('youtube',$artist->youtube) }}">
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                {{-- <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2">
                                            </div>
                                            <div class="col-7 text-center">
                                                <button type="submit"
                                                        class="btn btn-accent m-btn m-btn--air m-btn--custom">{{ __('guardar_cambios') }}</button>

                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            {{-- </form> --}}
                        </div>
                        <!--=====================================
                                       MENSAJES
                                        ======================================-->
                        <div class="tab-pane " id="m_user_profile_tab_2">
                            <div class="m-portlet__body">
                                <messages-projects-artists userjson="{{Auth::user()}}"></messages-projects-artists>
                            </div>
                        </div>
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

                                                <div class="m-accordion m-accordion--bordered m-accordion--solid" id="m_accordion_4" role="tablist">

                                                    <!--begin::Item-->
                                                    @foreach ($artist->teams as $team)
                                                    <div class="m-accordion__item">
                                                        <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_4_item_1_head" data-toggle="collapse" href="#m_accordion_4_item_{{ $loop->iteration }}" aria-expanded="    false">
                                                            <span class="m-accordion__item-icon">{{ $loop->iteration }}</span>
                                                            <span class="m-accordion__item-title">{{ $team->name }}</span>
                                                            <span class="m-accordion__item-mode"></span>
                                                        </div>
                                                        <div class="m-accordion__item-body collapse" id="m_accordion_4_item_{{ $loop->iteration }}" class=" " role="tabpanel" aria-labelledby="m_accordion_4_item_1_head" data-parent="#m_accordion_4">
                                                            <div class="m-accordion__item-content">
                                                             <div class="m-portlet__body ml-5">
                                                                 <div class="row">


                                                             <div class="biografia col-md-12">
                                                             <div class="row">


                                                                 <div class="col-md-4 mt-2">
                                                                 <label style="font-weight: bold">Tipo identificación:</label>
                                                                 <div class="m-scrollable" data-scrollable="true" style="">
                                                                     <p>{{ $team->document_type}}</p>
                                                                 </div>
                                                             </div>
                                                                 <div class="col-md-4 mt-2">
                                                                 <label style="font-weight: bold">Identificación:</label>
                                                                 <div class="m-scrollable" data-scrollable="true" style="">
                                                                     <p>{{ $team->identification}}</p>
                                                                 </div>
                                                             </div>
                                                                 <div class="col-md-4 mt-2">
                                                                 <label style="font-weight: bold">Nombre:</label>
                                                                 <div class="m-scrollable" data-scrollable="true" style="">
                                                                     <p>{{ $team->name}}</p>
                                                                 </div>
                                                             </div>
                                                                 <div class="col-md-4 mt-2">
                                                                 <label style="font-weight: bold">Apellidos:</label>
                                                                 <div class="m-scrollable" data-scrollable="true" style="">
                                                                     <p>{{ $team->last_name}}</p>
                                                                 </div>
                                                             </div>
                                                             <div class="col-md-4 mt-2">
                                                                 <label style="font-weight: bold">Direccion:</label>
                                                                 <div class="m-scrollable" data-scrollable="true" style="">
                                                                     <p>{{ $team->addres}}</p>
                                                                 </div>
                                                             </div>
                                                             <div class="col-md-4 mt-2">
                                                                 <label style="font-weight: bold">Fecha de nacimiento:</label>
                                                                 <div class="m-scrollable" data-scrollable="true" style="">
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
                                                                 <div class="col-md-4 mt-2">
                                                                 <label style="font-weight: bold">Teléfono:</label>
                                                                 <div class="m-scrollable" data-scrollable="true" style="">
                                                                     <p>{{ $team->phone1}}</p>
                                                                 </div>
                                                                 </div>
                                                                 <div class="col-md-4 mt-2">
                                                                 <label style="font-weight: bold">Teléfono:</label>
                                                                 <div class="m-scrollable" data-scrollable="true" style="">
                                                                     <p>{{ $team->phone2}}</p>
                                                                 </div>
                                                                 </div>
                                                                 <div class="col-md-4 mt-2">

                                                                     <label style="font-weight: bold">Rol:</label>
                                                                     <div class="m-scrollable" data-scrollable="true" style="">
                                                                         <p style="text-align: justify">{{ $team->role}}</p>
                                                                     </div>
                                                                 </div>

                                                                 <div class="col-md-5 mt-2">
                                                                     <label style="font-weight: bold">Documento de identificación:</label>

                                                                       <button  type="button" class="btn btn-primary btn_pdf_team{{ $loop->iteration }}" data-toggle="modal" data-target="#pdfidentificacion{{$loop->iteration}}">
                                                                        Ver documento de identidad
                                                                    </button>
                                                                    <div class="row drop_pdf_team{{ $loop->iteration }}" style="display: none" >
                                                                        <div class="col">
                                                                            <div class="form-group m-form__group ">
                                                                                <div class="m-dropzone dropzone-team{{ $loop->iteration }} m-dropzone--success"
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
                                                                <i  class="flaticon-edit ml-3 update_pdf_team{{ $loop->iteration }}" style="color:#716aca; cursor:pointer;"></i>
                                                                <button  type="button" class="btn btn-primary cancel_pdf_team{{ $loop->iteration }}" style="display:none">Cancelar</button>



                                                                 </div>
                                                                 <div class="col-md-4 mt-2">
                                                                    <label style="font-weight: bold">Departamento de expedición:</label>
                                                                    <div class="m-scrollable" data-scrollable="true" style="">
                                                                      <p>{{ $team->expeditionPlace->departaments->descripcion}}</p>
                                                                    </div>

                                                               </div>
                                                                 <div class="col-md-4 mt-3">
                                                                     <label style="font-weight: bold">Ciudad de expedición:</label>
                                                                     <div class="m-scrollable" data-scrollable="true" style="">
                                                                       <p>{{ $team->expeditionPlace->descripcion}}</p>
                                                                     </div>

                                                                </div>
                                                             </div>
                                                         </div>
                                                         </div>
                                                             </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="pdfidentificacion{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                     <div class="modal-dialog modal-lg" role="document">
                                                     <div class="modal-content">
                                                         <div class="modal-header">
                                                             <h5 class="modal-title" id="exampleModalLongTitle">
                                                                 Documento de {{ $team->name}}</h5>
                                                             <button type="button" class="close" data-dismiss="modal"
                                                                 aria-label="Close">
                                                                 <span aria-hidden="true">×</span>
                                                             </button>
                                                         </div>
                                                         <div class="modal-body">
                                                             @if(!$team->pdf_identificacion)
                                                                 <p>No se cargo el documento correctamente</p>
                                                             @else
                                                             <div>
                                                                 <embed src="{{ $team->pdf_identificacion }}" frameborder="0" width="100%" height="400px">
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


                                <div class="col-md-4 mt-2">
                                <label style="font-weight: bold">Tipo identificación:</label>
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
                                <label style="font-weight: bold">Nombre:</label>
                                <div class="m-scrollable" data-scrollable="true" style="">
                                    <p>{{ $artist->beneficiary[0]->name}}</p>
                                </div>
                            </div>
                                <div class="col-md-4 mt-2">
                                <label style="font-weight: bold">Apellidos:</label>
                                <div class="m-scrollable" data-scrollable="true" style="">
                                    <p>{{ $artist->beneficiary[0]->last_name}} {{ $artist->beneficiary[0]->second_last_name}}</p>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label style="font-weight: bold">Direccion:</label>
                                <div class="m-scrollable" data-scrollable="true" style="">
                                    <p>{{ $artist->beneficiary[0]->adress}}</p>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label style="font-weight: bold">Fecha de nacimiento:</label>
                                <div class="m-scrollable" data-scrollable="true" style="">
                                    <p>{{  Carbon\Carbon::parse($artist->beneficiary[0]->birthday)->formatLocalized('%d de %B de %Y') }}</p>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label style="font-weight: bold">Departamento de nacimiento:</label>
                                <div class="m-scrollable" data-scrollable="true" style="">
                         <p>{{ $artist->beneficiary[0]->city->departaments->descripcion}}</p>
                                </div>

                     </div>
                            <div class="col-md-4 mt-2">
                                <label style="font-weight: bold">Ciudad de nacimiento:</label>
                                <div class="m-scrollable" data-scrollable="true" style="">
                         <p>{{ $artist->beneficiary[0]->city->descripcion}}</p>
                                </div>

                     </div>





                                @if($artist->township)
                                <div class="col-md-4 mt-2">
                                <label style="font-weight: bold">Vereda/Corregimiento:</label>
                                <div class="m-scrollable" data-scrollable="true" style="">
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

                                    <label style="font-weight: bold">{{ __('biografia') }}:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">
                                        <p style="text-align: justify">{{ $artist->beneficiary[0]->biography}}</p>
                                    </div>
                                </div>
                                @if ($artist->beneficiary[0]->picture)

                                        <div class="col-md-4 mt-2 pl-5">
                                            <div class="m-scrollable" data-scrollable="true" style="">
                                                <img style="border-radius:8rem; width:7rem" src="{{$artist->beneficiary[0]->picture}}" >
                                            </div>

                                        </div>
                                        @endif

                                <div class="col-md-5 mt-2">
                                    <label style="font-weight: bold">Documento de identificación:</label>

                                      <button type="button" class="btn btn-primary btn_pdf_ben" data-toggle="modal" data-target="#pdfidentificacionBeneficiario">
                                        Ver documento de identidad
                                    </button>
                                    <div class="row drop_pdf_ben" style="display: none">
                                        <div class="col">
                                            <div class="form-group m-form__group ">
                                                <div class="m-dropzone dropzone-ben m-dropzone--success"
                                                     action="inc/api/dropzone/upload.php"
                                                     id="m-dropzone-three">
                                                    <div
                                                        class="m-dropzone__msg dz-message needsclick">
                                                        <h3 class="m-dropzone__msg-title">{{ __('Actualizar documento de identidad') }}</h3>
                                                        <span class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <i class="flaticon-edit ml-3 update_pdf_ben" style="color:#716aca; cursor:pointer;"></i>
                                <button type="button" class="btn btn-primary cancel_pdf_ben" style="display:none">Cancelar</button>

                                </div>

                                <div class="col-md-4 mt-2">

                                    <label style="font-weight: bold">{{ __('Departamento de expedición') }}:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">
                                        <p style="text-align: justify">{{ $artist->beneficiary[0]->expeditionPlace->departaments->descripcion}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">

                                    <label style="font-weight: bold">{{ __('Ciudad de expedición') }}:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">
                                        <p style="text-align: justify">{{ $artist->beneficiary[0]->expeditionPlace->descripcion}}</p>
                                    </div>
                                </div>






                            </div>
                        </div>
                        </div>
                            </div>

                            <div class="modal fade" id="pdfidentificacionBeneficiario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <embed src="{{ $artist->beneficiary[0]->pdf_documento}}" frameborder="0" width="100%" height="400px">
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
    <div class="modal fade" id="verpdfidentificacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <embed src="{{ $artist->users->pdf_cedula }}" frameborder="0" width="100%" height="400px">
                    </div>
            @endif
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

              toastr.info("El documento se actualizo correctamente", "Información");
              setTimeout(function(){
                location.reload();
                  }, 3000);
            }

        });

        /* Dropzone.autoDiscover = false; */
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

              toastr.info("El documento se actualizo correctamente", "Información");
              setTimeout(function(){
                location.reload();
                  }, 3000);

            }

        });

        $.each( @json($artist->teams), function( key, value ) {
        // actualizar pdf team
        new Dropzone('.dropzone-team'+(key+1), {
            url: '{{ route('cedula.pdf.team') }}',
            acceptedFiles: '.pdf',
            maxFiles: 1,
            paramName: 'pdf_cedula_name',
            headers: {
                'id':value.id,
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

              toastr.info("El documento se actualizo correctamente", "Información");
              setTimeout(function(){
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
        $('.update_pdf_asp').click(function(){
            $(this).hide();
            $('.cancel_pdf_asp').show();

            $('.drop_pdf_asp').show();
            $('.btn_pdf_asp').hide();


        });
        $('.cancel_pdf_asp').click(function(){
            $(this).hide();
            $('.update_pdf_asp').show();
            $('.drop_pdf_asp').hide();
            $('.btn_pdf_asp').show();


        });

    </script>
    {{-- editar identificacion beneficiario --}}
    <script>
        $('.update_pdf_ben').click(function(){
            $(this).hide();
            $('.cancel_pdf_ben').show();

            $('.drop_pdf_ben').show();
            $('.btn_pdf_ben').hide();


        });
        $('.cancel_pdf_ben').click(function(){
            $(this).hide();
            $('.update_pdf_ben').show();
            $('.drop_pdf_ben').hide();
            $('.btn_pdf_ben').show();


        });

    </script>
    <script>
        $.each( @json($artist->teams), function( key, value ) {
//   alert('update_pdf_team'+(key+1));

        $('.update_pdf_team'+(key+1)).click(function(){
            $(this).hide();
            $('.cancel_pdf_team'+(key+1)).show();

            $('.drop_pdf_team'+(key+1)).show();
            $('.btn_pdf_team'+(key+1)).hide();


        });
        $('.cancel_pdf_team'+(key+1)).click(function(){
            $(this).hide();
            $('.update_pdf_team'+(key+1)).show();
            $('.drop_pdf_team'+(key+1)).hide();
            $('.btn_pdf_team'+(key+1)).show();


        });

    });

    </script>
@endsection
