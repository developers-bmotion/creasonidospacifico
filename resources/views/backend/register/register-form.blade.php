@extends('backend.layout')

@section('header')
    
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h1 class="m-subheader__title--separator">Proceso de registro del aspirante</h1>            
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

        <form method="post" action="{{ route('update.profile.artist', auth()->user()->id) }}"
            onsubmit="return validationForm()" class="m-form m-form--label-align-left- m-form--state-" id="m_form_new_register">
            @csrf {{method_field('PUT')}}

            <!--=====================================
                CONTENIDO PARA SELECCIONAR LA INFORMACIÓN LEGAL
            ======================================-->
            <div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Información
                            </h3>
                        </div>
                    </div>

                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="#" data-toggle="m-tooltip"
                                   class="m-portlet__nav-link m-portlet__nav-link--icon"
                                   data-direction="left" data-width="auto" title="Por favor dilegencie esta información, para poder continuar">
                                    <i class="flaticon-info m--icon-font-size-lg3"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="m-portlet__body">
                    <div class="row">
                        <!--=====================================
		                    LINEA DE LA CONVOCATORIA
                        ======================================-->
                        <div class="col-lg-6 m-form__group-sub">
                            <label class="form-control-label">Linea de la convocatoria:</label>
                            <select id="select-linea-convocatoria" name="lineaConvocatoria" class="form-control m-input m-input--square">
                                <option value="-1">Selecciona una opción</option>
                                    @foreach($artisttypes as $artisttype)
                                        <option value="{{$artisttype->id}}">{{ $artisttype->name }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <!--=====================================
		                    ACTUARÁ COMO
                        ======================================-->
                        <div id="content-select-form-actuara-como" class="col-lg-6 m-form__group-sub" style="display: none">
                            <label class="form-control-label">Actuará como:</label>
                            <select id="select-actuara-como" name="actuaraComo" class="form-control m-input m-input--square">
                                <option value="-1">Selecciona una opción</option>
                                @foreach($persontypes as $persontype)
                                    <option value="{{$persontype->id}}"> {{ $persontype->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!--=====================================
                INFORMACIÓN DEL ASPIRATEN
            ======================================-->
            <div id="content-informacion-aspirante" style="display: none" class="m-portlet m-portlet--mobile m-portlet--body-progress-">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 id="title-info-aspirante" class="m-portlet__head-text">Información personal del aspirante</h3>
                        </div>
                    </div>

                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="#" data-toggle="m-tooltip" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                   data-direction="left" data-width="auto" title="Información del aspirante o representante">
                                    <i class="flaticon-info m--icon-font-size-lg3"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col-xl-8 offset-xl-2">
                            <div class="m-form__section m-form__section--first">
                                <div class="m-form__heading">
                                    <h3 class="m-form__heading-title">Información personal</h3>
                                </div>

                                <!--=====================================
                                    NOMBRES Y APELLIDOS
                                ======================================-->
                                <div class="form-group m-form__group row">
                                    <div id="content-aspirante_name" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label ">Nombre *</label>
                                        <input type="text" name="aspirante[name]"class="form-control m-input"
                                            placeholder=""value="{{ old('name', $artist->users->name)}}">
                                        <div id="error-aspirante_name" class="form-control-feedback" style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese su nombre completo</span>
                                    </div>

                                    <div id="content-aspirante_lastname" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label {{$errors->has('lastname')? 'has-danger':''}}">Primer apellido *</label>
                                        <input type="text" name="aspirante[lastname]" class="form-control m-input"
                                            placeholder="" value="{{ old('last_name', $artist->users->last_name ) }}">
                                        <div id="error-aspirante_lastname" class="form-control-feedback" style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese su primer apellido</span>
                                    </div>
                                </div>

                                <!--=====================================
                                    SEGUNDO APELLIDO Y TÉLEFONO
                                ======================================-->
                                <div class="form-group m-form__group row">
                                    <div id="content-aspirante_secondLastname" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label {{$errors->has('second_last_name')? 'has-danger':''}}">Segundo apellido *</label>
                                        <input type="text" name="aspirante[secondLastname]" class="form-control m-input"
                                            placeholder="" value="{{ old('second_last_name', $artist->users->second_last_name) }}">
                                        <div id="error-aspirante_secondLastname" class="form-control-feedback" style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese su segundo apellido</span>
                                    </div>

                                    <div id="content-aspirante_phone" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label {{$errors->has('phone_1')? 'has-danger':''}}">Teléfono celular *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="la la-phone"></i></span>
                                            </div>
                                            <input type="text" name="aspirante[phone]" class="form-control m-input"
                                                placeholder="" value="{{ old('phone_1', $artist->users->phone_1) }}">                                            
                                        </div>
                                        <div id="error-aspirante_phone" class="form-control-feedback" style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese su número de teléfono valido</span>
                                    </div>
                                </div> 

                                <!--=====================================
                                    TIPO DE DOCUMENTO Y Nº IDENTIFICACIÓN
                                ======================================-->
                                <div class="form-group m-form__group row">
                                    <div id="content-aspirante_documentType" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label {{$errors->has('document_type')? 'has-danger':''}}">Tipo de documento *</label>                                        
                                        <select name="aspirante[documentType]" class="form-control m-bootstrap-select m_selectpicker">
                                            @foreach($documenttype as $document_type)
                                                <option value="{{$document_type->id}}" {{ old('document_type',$artist->document_type) == $document_type->id ? 'selected':''}}>
                                                {{ $document_type->document }}</option>
                                            @endforeach                                            
                                        </select>
                                        <div id="error-aspirante_documentType" class="form-control-feedback" style="display: none"></div>
                                    </div>

                                    <div id="content-aspirante_identificacion" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label {{$errors->has('identificacion')? 'has-danger':''}}">Nº de indentificación *</label>
                                        <input type="num" name="aspirante[identificacion]" class="form-control m-input"
                                            placeholder="" value="{{ old('identificacion', $artist->identification) }}">
                                        <div id="error-aspirante_identificacion" class="form-control-feedback" style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese el número de indentificación</span>
                                    </div>
                                </div>

                                <!--=====================================
                                    DEPARTAMENTO EXPED Y MUNICIPIO DE EXPEDI
                                ======================================-->
                                <div class="form-group m-form__group row">
                                    <div id="content-aspirante_departamentoExpedida" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Departamento de expedición *</label>
                                        <select onchange="onSelectDepartamentosChange(this, 'aspirante-expid-municipios')" id="m_select2_1"
                                            name="aspirante[departamentoExpedida]" class="form-control m-select2" >    
                                            <option value="-1" >Seleccione departamento</option>
                                            @foreach($departamentos as $departamento)
                                                <option value="{{$departamento->id}}" {{ old('expedition_place', ($artist->expedition_place == $departamento->id) ? 'selected':'') }}>
                                                    {{ $departamento->descripcion }}</option>
                                            @endforeach                                            
                                        </select>
                                        <div id="error-aspirante_departamentoExpedida" class="form-control-feedback" style="display: none"></div>
                                    </div>

                                    <div id="content-aspirante_municipioExpedida" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Municipio de expedición *</label>
                                        <select onchange="onSelectMunicipiosChange(this)" name="aspirante[municipioExpedida]" class="form-control m-select2 aspirante-expid-municipios" id="m_select2_2"></select> 
                                        <div id="error-aspirante_municipioExpedida" class="form-control-feedback" style="display: none"></div>
                                    </div>
                                </div> 

                                <!--=====================================
                                    CARGAR DOCUMENTO
                                ======================================-->
                                <div class="form-group m-form__group row">   
                                    <div class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Biografía</label>
                                        <textarea class="form-control m-input" name="aspirante[biografia]" 
                                            placeholder="Ingrese la bografía" style="min-height: 8rem;"></textarea>
                                        <span class="m-form__help">Ingresa una breve descripción de tu historia como artista.</span>
                                    </div>

                                    <div id="content-aspirante_birthdate" class="col-lg-6 m-form__group-sub">
                                        <label for="example-text-input" class="form-control-label">Fecha de nacimiento *</label>                                        
                                        <input type="text" name="aspirante[birthdate]" class="form-control" value="" 
                                            id="datepicker_fecha_nacimiento" readonly placeholder="{{ __('fecha_nacimiento') }}" />
                                        <div id="error-aspirante_birthdate" class="form-control-feedback" style="display: none"></div>
                                    </div>
                                </div>    

                                <div class="form-group m-form__group row">                                                                       
                                    <div class="col-lg-6 m-form__group-sub">
                                        <label for="">Pdf Cédula</label>
                                        <div class="m-dropzone pdf_cedula_dropzone m-dropzone--success"
                                             action="inc/api/dropzone/upload.php" id="m-dropzone-three">
                                            <div class="m-dropzone__msg dz-message needsclick">
                                                <h3 class="m-dropzone__msg-title">Subir documento de identificación</h3>
                                                <span class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                           
                            <div class="m-separator m-separator--dashed m-separator--lg"></div>

                            <!--=====================================
                                DIRECCIÓN Y CIUDAD DE RESIDENCIA
                            ======================================-->
                            <div class="m-form__section">
                                <div class="m-form__heading">
                                    <h3 class="m-form__heading-title">Información de nacimiento y residencia
                                        <i data-toggle="m-tooltip" data-width="auto" class="m-form__heading-help-icon flaticon-info"
                                           title="Datos importantes del lugar y sitio de nacimiento"></i>
                                    </h3>
                                </div>

                                <div class="form-group m-form__group row">
                                    <div id="content-aspirante_departamentoNacimiento" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Departamento de nacimiento *</label>
                                        <select onchange="onSelectDepartamentosChange(this, 'aspirante-nacimiento-municipios')"  id="m_select2_3" 
                                            name="aspirante[departamentoNacimiento]" class="form-control m-select2">  
                                            <option value="-1">Seleccione departamento</option>
                                            @foreach($departamentos as $departamento)
                                                <option value="{{$departamento->id}}" {{ old('cities_id', ($artist->cities_id == $departamento->id) ? 'selected':'')}}>
                                                {{ $departamento->descripcion }}</option>
                                            @endforeach
                                        </select>
                                        <div id="error-aspirante_departamentoNacimiento" class="form-control-feedback" style="display: none"></div>
                                    </div>

                                    <div id="content-aspirante_municipioNacimiento" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Municipio de nacimiento *</label>
                                        <select onchange="onSelectMunicipiosChange(this)" name="aspirante[municipioNacimiento]" class="form-control m-select2 aspirante-nacimiento-municipios" id="m_select2_4"></select> 
                                        <div id="error-aspirante_municipioNacimiento" class="form-control-feedback" style="display: none"></div>
                                    </div>
                                </div> 

                                <div class="form-group m-form__group row">
                                    <div id="content-aspirante_address" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label {{$errors->has('adress')? 'has-danger':''}}">Dirección de residencia *</label>
                                        <input type="text" name="aspirante[address]" class="form-control m-input"
                                            placeholder="" value="{{ old('adress', $artist->adress) }}">
                                        <div id="error-aspirante_address" class="form-control-feedback" style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese dirección de residencia</span>
                                    </div>

                                    <div class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label {{$errors->has('vereda')? 'has-danger':''}}">Vereda/Corregimiento</label>
                                        <input type="text" name="aspirante[vereda]" class="form-control m-input"
                                            placeholder="" value=""> {{-- value="{{ old('vereda', $artist->users->last_name ) }}" corregir --}}
                                        {!! $errors->first('vereda','<div class="form-control-feedback">*:message</div>')!!}
                                        <span class="m-form__help">En caso de vivir en una vereda ó corregimiento, por favor ingrese el nombre</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--=====================================
                INFORMACIÓN DEL MENOR DE EDAD BENEFICIARIO
            ======================================-->
            <div id="content-informacion-menor-edad" class="m-portlet m-portlet--mobile m-portlet--body-progress-" style="display: none">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text"> Información del menor de edad beneficiario</h3>
                        </div>
                    </div>

                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="#" data-toggle="m-tooltip" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                   data-direction="left" data-width="auto" title="Información del menor de edad">
                                    <i class="flaticon-info m--icon-font-size-lg3"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="m-portlet__body">  {{-- toca poner display none para que no se envien los datos --}}
                    <div class="row">
                        <div class="col-xl-8 offset-xl-2">
                            <div class="m-form__section m-form__section--first">
                                <div class="m-form__heading">
                                    <h3 class="m-form__heading-title">Información del menor de edad</h3>
                                </div>
                               
                                <!--=====================================
                                    NOMBRES Y APELLIDOS MENOR DE EDAD
                                ======================================-->
                                <div class="form-group m-form__group row">
                                    <div id="content-beneficiario_name" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label {{$errors->has('name_menor')? 'has-danger':''}}">Nombre *</label>
                                        <input type="text" name="beneficiario[name]" class="form-control m-input" 
                                            placeholder="" value="{{ old('name_menor', $artist->users->name_menor)}}">
                                        <div id="error-beneficiario_name" class="form-control-feedback" style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese su nombre completo</span>
                                    </div>

                                    <div id="content-beneficiario_lastname" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label {{$errors->has('last_name_menor')? 'has-danger':''}}">Primer apellido *</label>
                                        <input type="text" name="beneficiario[lastname]" class="form-control m-input"
                                            placeholder="" value="{{ old('last_name_menor', $artist->users->last_name_menor ) }}">
                                        <div id="error-beneficiario_lastname" class="form-control-feedback" style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese su primer apellido</span>
                                    </div>
                                </div>

                                <!--=====================================
                                    SEGUNDO APELLIDO Y TÉLEFONO MENOR DE EDAD
                                ======================================-->
                                <div class="form-group m-form__group row">
                                    <div id="content-beneficiario_secondLastname" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label {{$errors->has('second_last_name_menor')? 'has-danger':''}}">Segundo apellido *</label>
                                        <input type="text" name="beneficiario[secondLastname]" class="form-control m-input"
                                            placeholder="" value="{{ old('second_last_name', $artist->users->second_last_name_menor) }}">
                                        <div id="error-beneficiario_secondLastname" class="form-control-feedback" style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese su segundo apellido</span>
                                    </div>

                                    <div id="content-beneficiario_phone" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label {{$errors->has('phone_1_menor')? 'has-danger':''}}">Teléfono celular *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="la la-phone"></i></span>
                                            </div>
                                            <input type="text" name="beneficiario[phone]" class="form-control m-input"
                                                placeholder="" value="{{ old('phone_1', $artist->users->phone_1_menor) }}">
                                        </div>
                                        <div id="error-beneficiario_phone" class="form-control-feedback" style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese su número de teléfono valido</span>
                                    </div>
                                </div> 

                                <!--=====================================
                                    TIPO DE DOCUMENTO Y Nº IDENTIFICACIÓN MENOR
                                ======================================-->
                                <div class="form-group m-form__group row">
                                    <div id="content-beneficiario_documentType" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label {{$errors->has('document_type_menor')? 'has-danger':''}}">Tipo de documento *</label>                                        
                                        <select name="beneficiario[documentType]" class="form-control m-bootstrap-select m_selectpicker">
                                            <option value="2">Tarjeta de identidad</option>
                                        </select>
                                        <div id="error-beneficiario_documentType" class="form-control-feedback" style="display: none"></div>
                                    </div>

                                    <div id="content-beneficiario_identificacion" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label {{$errors->has('identificacion_menor')? 'has-danger':''}}">Nº de indentificación *</label>
                                        <input type="num" name="beneficiario[identificacion]" class="form-control m-input"
                                            placeholder="" value="{{ old('identificacion_menor', $artist->identification_menor) }}">
                                        <div id="error-beneficiario_identificacion" class="form-control-feedback" style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese el número de indentificación</span>
                                    </div>
                                </div> 

                                <!--=====================================
                                    DEPARTAMENTO EXPED Y MUNICIPIO DE EXPEDI MENOR
                                ======================================-->
                                <div class="form-group m-form__group row">
                                    <div id="content-beneficiario_departamentoExpedida" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Departamento de expedición *</label>
                                        <select onchange="onSelectDepartamentosChange(this, 'beneficiario-expid-municipios')" id="m_select2_5"
                                            name="beneficiario[departamentoExpedida]" class="form-control m-select2"> 
                                            <option>Seleccione departamento</option>
                                            @foreach($departamentos as $departamento)
                                                <option value="{{$departamento->id}}">{{ $departamento->descripcion }}</option>
                                            @endforeach
                                        </select>
                                        <div id="error-beneficiario_departamentoExpedida" class="form-control-feedback" style="display: none"></div>
                                    </div>
                                    
                                    <div id="content-beneficiario_municipioExpedida" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Municipio de expedición *</label>
                                        <select name="beneficiario[municipioExpedida]" class="form-control m-select2 beneficiario-expid-municipios" id="m_select2_9"></select>
                                        <div id="error-beneficiario_municipioExpedida" class="form-control-feedback" style="display: none"></div>
                                    </div>
                                </div> 

                                <!--=====================================
                                    CARGAR DOCUMENTO Y FECHA DE NACIMIENTO MENOR
                                ======================================-->
                                <div class="form-group m-form__group row">                                    
                                    <div class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Biografía</label>
                                        <textarea class="form-control m-input" name="beneficiario[biografia]" 
                                            placeholder="Ingrese la bografía" style="min-height: 8rem;"></textarea>
                                        <span class="m-form__help">Ingresa una breve descripción de tu historia como artista.</span>
                                    </div>

                                    <div id="content-beneficiario_birthdate" class="col-lg-6 m-form__group-sub">
                                        <label for="example-text-input" class="form-control-label">Fecha de nacimiento *</label>                                        
                                        <input type="text" name="beneficiario[birthdate]" class="form-control" value="" 
                                            id="datepicker_fecha_nacimiento2" readonly placeholder="{{ __('fecha_nacimiento') }}" />
                                        <div id="error-beneficiario_birthdate" class="form-control-feedback" style="display: none"></div>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6 m-form__group-sub">
                                        <label for="">PDF documento de identidad</label>
                                        <div class="m-dropzone pdf_cedula_dropzone m-dropzone--success"
                                            action="inc/api/dropzone/upload.php" id="m-dropzone-three">
                                            <div class="m-dropzone__msg dz-message needsclick">
                                                <h3 class="m-dropzone__msg-title">Subir documento de identificación</h3>
                                                <span class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                
                                <!--=====================================
                                    DIRECCIÓN Y CIUDAD DE RESIDENCIA MENOR
                                ======================================-->
                                <div class="m-form__section">
                                    <div class="m-form__heading">
                                        <h3 class="m-form__heading-title">Información de nacimiento y residencia
                                            <i data-toggle="m-tooltip" data-width="auto" class="m-form__heading-help-icon flaticon-info"
                                                title="Datos importantes del lugar y sitio de nacimiento"></i>
                                        </h3>
                                    </div>

                                   <div class="form-group m-form__group row">
                                        <div id="content-beneficiario_departamentoNacimiento" class="col-lg-6 m-form__group-sub">
                                            <label class="form-control-label">Departamento de nacimiento *</label>
                                            <select onchange="onSelectDepartamentosChange(this, 'beneficiario-nacimiento-municipios')" id="m_select2_7" 
                                                name="beneficiario[departamentoNacimiento]" class="form-control m-select2"> 
                                                <option>Seleccione departamento</option>
                                                @foreach($departamentos as $departamento)
                                                    <option value="{{$departamento->id}}">{{ $departamento->descripcion }}</option>
                                                @endforeach
                                            </select>
                                            <div id="error-beneficiario_departamentoNacimiento" class="form-control-feedback" style="display: none"></div>
                                        </div>

                                        <div id="content-beneficiario_municipioNacimiento" class="col-lg-6 m-form__group-sub">
                                            <label class="form-control-label">Municipio de nacimiento *</label>
                                            <select name="beneficiario[municipioNacimiento]" class="form-control m-select2 beneficiario-nacimiento-municipios" id="m_select2_8"></select> 
                                            <div id="error-beneficiario_municipioNacimiento" class="form-control-feedback" style="display: none"></div>
                                        </div>
                                    </div> 

                                    <div class="form-group m-form__group row">
                                        <div id="content-beneficiario_address" class="col-lg-6 m-form__group-sub">
                                            <label class="form-control-label {{$errors->has('adress')? 'has-danger':''}}">Dirección de residencia *</label>
                                            <input type="text" name="beneficiario[address]" class="form-control m-input" 
                                                placeholder="" value="">
                                            <div id="error-beneficiario_address" class="form-control-feedback" style="display: none"></div>
                                            <span class="m-form__help">Por favor ingrese dirección de residencia</span>
                                        </div>

                                        <div class="col-lg-6 m-form__group-sub">
                                            <label class="form-control-label {{$errors->has('vereda')? 'has-danger':''}}">Vereda/Corregimiento</label>
                                            <input type="text" name="beneficiario[vereda]" class="form-control m-input"
                                                placeholder="" value="">{{-- value="{{ old('vereda', $artist->users->last_name ) }}" --}}
                                            <span class="m-form__help">En caso de vivir en una vereda ó corregimiento, por favor ingrese el nombre</span>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--=====================================
                INFORMACIÓN DEL GRUPO
            ======================================-->
            <div id="content-informacion-grupo-musical" style="display: none" class="m-portlet m-portlet--mobile m-portlet--body-progress-">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">Datos del Grupo Musical</h3>
                        </div>
                    </div>

                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="#" data-toggle="m-tooltip" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                   data-direction="left" data-width="auto" title="Información de los integrante del grupo">
                                    <i class="flaticon-info m--icon-font-size-lg3"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col col-lg-12" style="padding-bottom: 1.5rem;">
                            <div class="row" style="padding-left: 1rem;">
                                <div class="col-3 form-group m-form__group row">
                                    <label for="example-number-input">Ingrese el número de integrantes</label>
                                    <input id="input-max-members" class="form-control m-input" type="number" value="">
                                </div>
                                <div class="col-lg-4">
                                    <div id="event-add-max-members" class="btn btn btn-sm btn-brand m-btn m-btn--icon m-btn--pill m-btn--wide" style="margin: 2rem 2rem 0; padding: 0.8rem 2rem;">
                                        <span>
                                            <i class="la la-plus"></i>
                                            <span>Agregar Integrantes</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span id="help-max-members" class="m-form__help" style="display:none; margin-top: -1rem; color: #f4516c; font-size: 1rem;">Recuerde que el número máximo de integrantes para el grupo es 12 personas</span>
                        </div>

                        <div class="col col-lg-12">
                            <div class="m-tabs-content" id="m_sections">
                                <!-- add members group -->
                                <div class="m-tabs-content__item m-tabs-content__item--active" id="m_section_1">
                                    <div class="m-accordion m-accordion--section m-accordion--padding-lg" id="m_section_1_content">                   
                                    </div>
                                </div>
                                <!-- add members group -->                                
                            </div>                            
                        </div>                        
                    </div>
                </div>
            </div>

            <!--=====================================
                BOTON ENVIAR DATOS
            ======================================-->
            <div id="btn-enviar-datos" style="display: none" class="m-portlet m-portlet--mobile m-portlet--body-progress-">
                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group m-form__group m-form__group--sm row">

                                <div id="content-acceptTermsConditions" class="col-lg-9 m-form__group-sub">
                                    <label class="form-control-label">Términos y Condiciones *</label>
                                    <div class="m-radio-inline">
                                        <label class="m-radio">
                                            <input type="checkbox" name="acceptTermsConditions" value="1">Haga clic aquí para indicar que ha leído y acepta el
                                            acuerdo de Términos y Condiciones.
                                            <span></span>
                                        </label>
                                    </div>
                                    <div id="error-acceptTermsConditions" class="form-control-feedback" style="display: none"></div>
                                </div>

                                <div class="col-xl-3">                                    
                                    <button class=" pull-right btn btn-primary m-btn m-btn--custom m-btn--icon" data-wizard-action="submit">
                                        <span>
                                            <i class="la la-check"></i>&nbsp;&nbsp;
                                            <span>Enviar registro</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('js.form-register')
    <script src="/backend/assets/js/form-register.js" type="text/javascript"></script>
@endsection
@section('dropzonePhotoArtist')
    <script>
        /* variables que se emplean en form-register */
        var typeDocument = @json($documenttype);
        var departamentos = @json($departamentos);

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
                    language: 'es',
                    startDate: '-18y',
                    templates: arrows
                });

                $('#datepicker_fecha_nacimiento').datepicker({
                    rtl: mUtil.isRTL(),
                    language: 'es',
                    startDate: '-18y',
                    todayHighlight: true,
                    orientation: "bottom left",
                    templates: arrows
                });

                $('#datepicker_fecha_nacimiento2').datepicker({
                    rtl: mUtil.isRTL(),
                    language: 'es',
                    startDate: '-18y',
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

        new Dropzone('.dropzone', {
            url: '{{ route('profile.photo.artist') }}',
            acceptedFiles: 'image/*',
            maxFiles: 1,
            paramName: 'photo',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (file, response) {
                $('#inputImagenesPostPlan').val(response);
                location.reload();
            }
        });

        /* Dropzone.autoDiscover = false; */
        /* {{-- new Dropzone('.front_dropzone', {
            url: '{{ route('front.photo.artist') }}',
            acceptedFiles: 'image/*',
            maxFiles: 1,
            paramName: 'front_photo',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (file, response) {

                $('#inputImagenesPostPlan').val(response);
                location.reload();
            }

        }); --}} */

        new Dropzone('.pdf_cedula_dropzone', {
            url: '{{ route('cedula.pdf.aspirante') }}',
            acceptedFiles: '.pdf',
            maxFiles: 1,
            paramName: 'pdf_cedula_name',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (file, response) {
                $('#inputImagenesPostPlan').val(response);
                /* {{-- location.reload(); --}} */
            }
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
@endsection
