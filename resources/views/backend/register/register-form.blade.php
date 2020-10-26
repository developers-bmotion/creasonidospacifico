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

    <!--=====================================
            alerta de confirmacion de datos
        ======================================-->
        <div id="alert-info-form" style="display: none"
             class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show"
             role="alert">
            <div class="m-alert__icon">
                <i class="flaticon-exclamation-1"></i>
                <span></span>
            </div>
            <div class="m-alert__text">
                <strong>¡Atención!</strong> Algunos datos son requeridos.
            </div>
            <div class="m-alert__close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
            </div>
        </div>

        <form method="post" action="{{ route('update.profile.artist', auth()->user()->id) }}"
              enctype="multipart/form-data"
              class="m-form m-form--label-align-left- m-form--state-" id="m_form_new_register">
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
                                   data-direction="left" data-width="auto"
                                   title="Por favor dilegencie esta información, para poder continuar">
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
                            <select id="select-linea-convocatoria" name="lineaConvocatoria"
                                    class="form-control m-input m-input--square">
                                <option value="-1">Selecciona una opción</option>
                                @foreach($artisttypes as $artisttype)
                                    <option value="{{$artisttype->id}}">{{ $artisttype->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!--=====================================
		                    ACTUARÁ COMO
                        ======================================-->
                        <div id="content-select-form-actuara-como" class="col-lg-6 m-form__group-sub"
                             style="display: none">
                            <label class="form-control-label">Actuará como:</label>
                            <select id="select-actuara-como" name="actuaraComo"
                                    class="form-control m-input m-input--square">
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
            <div id="content-informacion-aspirante" style="display: none"
                 class="m-portlet m-portlet--mobile m-portlet--body-progress-">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 id="title-info-aspirante" class="m-portlet__head-text">Información personal del
                                aspirante</h3>
                        </div>
                    </div>

                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="#" data-toggle="m-tooltip"
                                   class="m-portlet__nav-link m-portlet__nav-link--icon"
                                   data-direction="left" data-width="auto"
                                   title="Información del aspirante o representante">
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
                                        <label class="form-control-label ">Nombre <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="aspirante[name]" class="form-control m-input"
                                               placeholder="" value="">
                                        <div id="error-aspirante_name" class="form-control-feedback"
                                             style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese nombre completo</span>
                                    </div>

                                    <div id="content-aspirante_lastname" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Primer apellido <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="aspirante[lastname]" class="form-control m-input"
                                               placeholder="" value="">
                                        <div id="error-aspirante_lastname" class="form-control-feedback"
                                             style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese primer apellido</span>
                                    </div>
                                </div>

                                <!--=====================================
                                    SEGUNDO APELLIDO Y TÉLEFONO
                                ======================================-->
                                <div class="form-group m-form__group row">
                                    <div id="content-aspirante_secondLastname" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Segundo apellido <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="aspirante[secondLastname]" class="form-control m-input"
                                               placeholder="" value="">
                                        <div id="error-aspirante_secondLastname" class="form-control-feedback"
                                             style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese segundo apellido</span>
                                    </div>

                                    <div id="content-aspirante_phone" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Teléfono celular <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="la la-phone"></i></span>
                                            </div>
                                            <input type="number" name="aspirante[phone]" class="form-control m-input"
                                                   placeholder="" value="">
                                        </div>
                                        <div id="error-aspirante_phone" class="form-control-feedback"
                                             style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese número de teléfono valido</span>
                                    </div>
                                </div>

                                <!--=====================================
                                    TIPO DE DOCUMENTO Y Nº IDENTIFICACIÓN
                                ======================================-->
                                <div class="form-group m-form__group row">
                                    <div id="content-aspirante_documentType" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Tipo de documento *</label>
                                        <select id="aspirant-document-type" name="aspirante[documentType]" class="form-control m-input">
                                            @foreach($documenttype as $document_type)
                                                @if($document_type->document != "Tarjeta de identidad")
                                                    <option value="{{$document_type->id}}">{{ $document_type->document }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <div id="error-aspirante_documentType" class="form-control-feedback" style="display: none"></div>
                                    </div>

                                    <div id="content-aspirante_identificacion" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Nº de indentificación <span
                                                class="text-danger">*</span></label>
                                        <input type="number" name="aspirante[identificacion]" class="form-control m-input"
                                               placeholder="" value="">
                                        <div id="error-aspirante_identificacion" class="form-control-feedback"
                                             style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese el número de indentificación</span>
                                    </div>
                                </div>

                                <!--=====================================
                                    DEPARTAMENTO EXPED Y MUNICIPIO DE EXPEDI
                                ======================================-->
                                <div class="form-group m-form__group row">
                                    <div id="content-aspirante_departamentoExpedida" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Departamento de expedición <span
                                                class="text-danger">*</span></label>
                                        <select
                                            onchange="onSelectDepartamentosChange(this, 'aspirante-expid-municipios')"
                                            id="m_select2_1"
                                            name="aspirante[departamentoExpedida]" class="form-control m-select2">
                                            <option value="-1">Seleccione departamento</option>
                                            @foreach($departamentos as $departamento)
                                                <option
                                                    value="{{$departamento->id}}">{{ $departamento->descripcion }}</option>
                                            @endforeach
                                        </select>
                                        <div id="error-aspirante_departamentoExpedida" class="form-control-feedback"
                                             style="display: none"></div>
                                    </div>

                                    <div id="content-aspirante_municipioExpedida" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Municipio de expedición <span
                                                class="text-danger">*</span></label>
                                        <select onchange="onSelectMunicipiosChange(this)"
                                                name="aspirante[municipioExpedida]"
                                                class="form-control m-select2 aspirante-expid-municipios"
                                                id="m_select2_2"></select>
                                        <div id="error-aspirante_municipioExpedida" class="form-control-feedback"
                                             style="display: none"></div>
                                    </div>
                                </div>

                                <!--=====================================
                                    CARGAR DOCUMENTO
                                ======================================-->
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Biografía</label>
                                        <textarea class="form-control m-input" name="aspirante[biografia]"
                                                  placeholder="Ingrese la biografía"
                                                  style="min-height: 10rem;"></textarea>
                                        <span class="m-form__help">Ingresa una breve descripción de tu historia como artista.</span>
                                    </div>

                                    <div class="col-lg-6 form-group m-form__group row">
                                        <div id="content-aspirante_birthdate" class="col-lg-12 m-form__group-sub">
                                            <label for="example-text-input" class="form-control-label">Fecha de
                                                nacimiento <span class="text-danger">*</span></label>
                                            <input type="text" name="aspirante[birthdate]" class="form-control" value=""
                                                   id="datepicker_fecha_nacimiento" readonly
                                                   placeholder="{{ __('fecha_nacimiento') }}"/>
                                            <div id="error-aspirante_birthdate" class="form-control-feedback"
                                                 style="display: none"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__group form-group">
                                    <div class="col-lg-12 m-form__group-sub">
                                        <label for="">Seleccione el tipo de formato para subir el documento de
                                            identificación</label>
                                        <div class="m-radio-inline">
                                            <label class="m-radio">
                                                <input type="radio" name="aspirante[identificacionDoc]" value="1"
                                                       checked="checked"> Imagen
                                                <span></span>
                                            </label>
                                            <label class="m-radio">
                                                <input type="radio" name="aspirante[identificacionDoc]" value="2"> PDF
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div id="image-docuemnt-aspirante" class="form-group m-form__group row">
                                        <div id="content-file-image-document-aspirante-frente" class="col-lg-6 m-form__group-sub">
                                            <label for="">Imagen documento identificación frente</label>
                                            <div class="m-dropzone file-image-document-aspirante-frente m-dropzone--success" action="{{ route('upload.image.document') }}" id="m-dropzone-three">
                                                <div class="m-dropzone__msg dz-message needsclick">
                                                    <h3 class="m-dropzone__msg-title">Subir foto del frente de su documento de identificación</h3>
                                                    <span class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                </div>
                                            </div>
                                            <div id="error-file-image-document-aspirante-frente" class="form-control-feedback"></div>
                                            <input type="hidden" name="aspirante[urlImageDocumentFrente]" class="form-control m-input" value="">
                                        </div>

                                        <div id="content-file-image-document-aspirante-atras" class="col-lg-6 m-form__group-sub">
                                            <label for="">Imagen documento identificación atrás</label>
                                            <div class="m-dropzone file-image-document-aspirante-atras m-dropzone--success" action="{{ route('upload.image.document') }}" id="m-dropzone-three">
                                                <div class="m-dropzone__msg dz-message needsclick">
                                                    <h3 class="m-dropzone__msg-title">Subir foto de la parte de atrás de su documento de identificación</h3>
                                                    <span class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                </div>
                                            </div>
                                            <div id="error-file-image-document-aspirante-atras" class="form-control-feedback"></div>
                                            <input type="hidden" name="aspirante[urlImageDocumentAtras]" class="form-control m-input" value="">
                                        </div>
                                    </div>

                                    <div id="pdf-docuemnt-aspirante" style="display: none" class="form-group m-form__group row">
                                        <div id="content-file-pdf-document-aspirante" class="col-lg-6 m-form__group-sub">
                                            <label for="">PDF documento identificación </label>
                                            <div class="m-dropzone file-pdf-document-aspirante m-dropzone--success" action="{{ route('upload.pdf.document') }}" id="m-dropzone-three">
                                                <div class="m-dropzone__msg dz-message needsclick">
                                                    <h3 class="m-dropzone__msg-title">Subir documento de identificación por ambos lados</h3>
                                                    <span class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                </div>
                                            </div>
                                            <div id="error-file-pdf-document-aspirante" class="form-control-feedback"></div>
                                            <input type="hidden" name="aspirante[urlPdfDocument]" class="form-control m-input" value="">
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <div id="content-image-profile-aspirante" class="col-lg-6 m-form__group-sub">
                                            <label for="">Foto de perfil</label>
                                            <div class="m-dropzone file-image-profile-aspirante m-dropzone--success" action="{{ route('upload.image.profile') }}" id="m-dropzone-three">
                                                <div class="m-dropzone__msg dz-message needsclick">
                                                    <h3 class="m-dropzone__msg-title">Subir foto de perfil</h3>
                                                    <span class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                </div>
                                            </div>
                                            <span id="error-image-profile-aspirante" class="form-control-feedback"></span>
                                            <input type="hidden" name="aspirante[urlImageProfile]" class="form-control m-input" value="">
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
                                        <i data-toggle="m-tooltip" data-width="auto"
                                           class="m-form__heading-help-icon flaticon-info"
                                           title="Datos importantes del lugar y sitio de nacimiento"></i>
                                    </h3>
                                </div>

                                <div class="form-group m-form__group row">
                                    <div id="content-aspirante_departamentoNacimiento"
                                         class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Departamento de nacimiento <span
                                                class="text-danger">*</span></label>
                                        <select
                                            onchange="onSelectDepartamentosChange(this, 'aspirante-nacimiento-municipios')"
                                            id="m_select2_3"
                                            name="aspirante[departamentoNacimiento]" class="form-control m-select2">
                                            <option value="-1">Seleccione departamento</option>
                                            @foreach($departamentos as $departamento)
                                                <option
                                                    value="{{$departamento->id}}">{{ $departamento->descripcion }}</option>
                                            @endforeach
                                        </select>
                                        <div id="error-aspirante_departamentoNacimiento" class="form-control-feedback"
                                             style="display: none"></div>
                                    </div>

                                    <div id="content-aspirante_municipioNacimiento" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Municipio de nacimiento <span
                                                class="text-danger">*</span></label>
                                        <select onchange="onSelectMunicipiosChange(this)"
                                                name="aspirante[municipioNacimiento]"
                                                class="form-control m-select2 aspirante-nacimiento-municipios"
                                                id="m_select2_4"></select>
                                        <div id="error-aspirante_municipioNacimiento" class="form-control-feedback"
                                             style="display: none"></div>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <div id="content-aspirante_departamentoResidencia"
                                         class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Departamento de residencia <span
                                                class="text-danger">*</span></label>
                                        <select
                                            onchange="onSelectDepartamentosChange(this, 'aspirante-residencia-municipios')"
                                            id="m_select2_1_2"
                                            name="aspirante[departamentoResidencia]" class="form-control m-select2">
                                            <option value="-1">Seleccione departamento</option>
                                            @foreach($departamentos as $departamento)
                                                <option
                                                    value="{{$departamento->id}}">{{ $departamento->descripcion }}</option>
                                            @endforeach
                                        </select>
                                        <div id="error-aspirante_departamentoResidencia" class="form-control-feedback"
                                             style="display: none"></div>
                                    </div>

                                    <div id="content-aspirante_municipioResidencia" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Municipio de residencia <span
                                                class="text-danger">*</span></label>
                                        <select onchange="onSelectMunicipiosChange(this)"
                                                name="aspirante[municipioResidencia]"
                                                class="form-control m-select2 aspirante-residencia-municipios"
                                                id="m_select2_1_3"></select>
                                        <div id="error-aspirante_municipioResidencia" class="form-control-feedback"
                                             style="display: none"></div>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <div id="content-aspirante_address" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Dirección de residencia <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="aspirante[address]" class="form-control m-input"
                                               placeholder="" value="">
                                        <div id="error-aspirante_address" class="form-control-feedback"
                                             style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese dirección de residencia</span>
                                    </div>

                                    <div class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Vereda/Corregimiento de residencia</label>
                                        <input type="text" name="aspirante[vereda]" class="form-control m-input"
                                               placeholder="" value="">
                                        <span class="m-form__help">En caso de vivir en una vereda ó corregimiento, por favor ingrese el nombre</span>
                                    </div>
                                </div>
                            </div>

                            <!--=====================================
                                EL ASPIRANTE FORMA PARTE DEL GRUPO
                            ======================================-->
                            <div id="forma-parte-grupo" style="display: none">
                                <div class="m-separator m-separator--dashed m-separator--lg"></div>

                                <div class="m-form__section">
                                    <div class="m-form__heading">

                                        <h3 class="m-form__heading-title">Información de si el representante forma parte
                                            del grupo
                                        </h3>

                                    </div>

                                    <div class="m-form__group form-group">
                                        <div class="col-lg-12 m-form__group-sub">
                                            <label for="">¿Usted como representante forma parte del grupo?</label>

                                            <div class="m-radio-inline">
                                                <label class="m-radio">
                                                    <input type="radio" name="aspirante[partGroup]" value="1"> Si
                                                    <span></span>
                                                </label>
                                                <label class="m-radio">
                                                    <input type="radio" name="aspirante[partGroup]" value="2"
                                                           checked="checked"> No
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="content-aspirante_rolMember" class="form-group m-form__group row" style="display: none">
                                        <div class="col-lg-6 m-form__group-sub">
                                            <label class="form-control-label">Instrumento que interpreta</label>
                                            <input type="text" name="aspirante[rolMember]" class="form-control m-input" placeholder="" value="">
                                            <div id="error-aspirante_rolMember" class="form-control-feedback" style="display: none"></div>
                                            <span class="m-form__help">Ingrese el rol que desempeña dentro del grupo (Guitarrista, Vocalista, Pianista, etc.)</span>
                                        </div>
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
            <div id="content-informacion-menor-edad" class="m-portlet m-portlet--mobile m-portlet--body-progress-"
                 style="display: none">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text"> Información del menor de edad participante</h3>
                        </div>
                    </div>

                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="#" data-toggle="m-tooltip"
                                   class="m-portlet__nav-link m-portlet__nav-link--icon"
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
                                        <label class="form-control-label">Nombre <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="beneficiario[name]" class="form-control m-input"
                                               placeholder="" value="">
                                        <div id="error-beneficiario_name" class="form-control-feedback"
                                             style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese nombre completo</span>
                                    </div>

                                    <div id="content-beneficiario_lastname" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Primer apellido <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="beneficiario[lastname]" class="form-control m-input"
                                               placeholder="" value="">
                                        <div id="error-beneficiario_lastname" class="form-control-feedback"
                                             style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese primer apellido</span>
                                    </div>
                                </div>

                                <!--=====================================
                                    SEGUNDO APELLIDO Y TÉLEFONO MENOR DE EDAD
                                ======================================-->
                                <div class="form-group m-form__group row">
                                    <div id="content-beneficiario_secondLastname" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Segundo apellido <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="beneficiario[secondLastname]"
                                               class="form-control m-input" placeholder="" value="">
                                        <div id="error-beneficiario_secondLastname" class="form-control-feedback"
                                             style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese segundo apellido</span>
                                    </div>

                                    <div id="content-beneficiario_phone" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Teléfono celular <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="la la-phone"></i></span>
                                            </div>
                                            <input type="text" name="beneficiario[phone]" class="form-control m-input"
                                                   placeholder="" value="">
                                        </div>
                                        <div id="error-beneficiario_phone" class="form-control-feedback"
                                             style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese número de teléfono valido</span>
                                    </div>
                                </div>

                                <!--=====================================
                                    TIPO DE DOCUMENTO Y Nº IDENTIFICACIÓN MENOR
                                ======================================-->
                                <div class="form-group m-form__group row">
                                    <div id="content-beneficiario_documentType" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Tipo de documento <span
                                                class="text-danger">*</span></label>
                                        <select name="beneficiario[documentType]"
                                                class="form-control m-bootstrap-select m_selectpicker">
                                            <option value="2">Tarjeta de identidad</option>
                                        </select>
                                        <div id="error-beneficiario_documentType" class="form-control-feedback"
                                             style="display: none"></div>
                                    </div>

                                    <div id="content-beneficiario_identificacion" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Nº de indentificación <span
                                                class="text-danger">*</span></label>
                                        <input type="num" name="beneficiario[identificacion]"
                                               class="form-control m-input" placeholder="" value="">
                                        <div id="error-beneficiario_identificacion" class="form-control-feedback"
                                             style="display: none"></div>
                                        <span class="m-form__help">Por favor ingrese el número de indentificación</span>
                                    </div>
                                </div>

                                <!--=====================================
                                    DEPARTAMENTO EXPED Y MUNICIPIO DE EXPEDI MENOR
                                ======================================-->
                                <div class="form-group m-form__group row">
                                    <div id="content-beneficiario_departamentoExpedida"
                                         class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Departamento de expedición <span
                                                class="text-danger">*</span></label>
                                        <select
                                            onchange="onSelectDepartamentosChange(this, 'beneficiario-expid-municipios')"
                                            id="m_select2_5"
                                            name="beneficiario[departamentoExpedida]" class="form-control m-select2">
                                            <option>Seleccione departamento</option>
                                            @foreach($departamentos as $departamento)
                                                <option
                                                    value="{{$departamento->id}}">{{ $departamento->descripcion }}</option>
                                            @endforeach
                                        </select>
                                        <div id="error-beneficiario_departamentoExpedida" class="form-control-feedback"
                                             style="display: none"></div>
                                    </div>

                                    <div id="content-beneficiario_municipioExpedida" class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Municipio de expedición <span
                                                class="text-danger">*</span></label>
                                        <select name="beneficiario[municipioExpedida]"
                                                class="form-control m-select2 beneficiario-expid-municipios"
                                                id="m_select2_9"></select>
                                        <div id="error-beneficiario_municipioExpedida" class="form-control-feedback"
                                             style="display: none"></div>
                                    </div>
                                </div>

                                <!--=====================================
                                    CARGAR DOCUMENTO Y FECHA DE NACIMIENTO MENOR
                                ======================================-->
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6 m-form__group-sub">
                                        <label class="form-control-label">Biografía</label>
                                        <textarea class="form-control m-input" name="beneficiario[biografia]"
                                                  placeholder="Ingrese la biografía"
                                                  style="min-height: 8rem;"></textarea>
                                        <span class="m-form__help">Cuentanos bremente su historia.</span>
                                    </div>

                                    <div id="content-beneficiario_birthdate" class="col-lg-6 m-form__group-sub">
                                        <label for="example-text-input" class="form-control-label">Fecha de nacimiento
                                            <span class="text-danger">*</span></label>
                                        <input type="text" name="beneficiario[birthdate]" class="form-control" value=""
                                               id="datepicker_fecha_nacimiento2" readonly
                                               placeholder="{{ __('fecha_nacimiento') }}"/>
                                        <div id="error-beneficiario_birthdate" class="form-control-feedback"
                                             style="display: none"></div>
                                    </div>
                                </div>

                                <!--=====================================
                                    CARGAR DOCUMENTO DE IDENTIFICACION
                                ======================================-->
                                <div class="m-form__group form-group">
                                    <div class="col-lg-6 m-form__group-sub">
                                        <label for="">Seleccione el tipo de formato para subir el documento de
                                            identificación</label>
                                        <div class="m-radio-inline">
                                            <label class="m-radio">
                                                <input type="radio" name="beneficiario[identificacionDoc]" value="1"
                                                       checked="checked"> Imagen
                                                <span></span>
                                            </label>
                                            <label class="m-radio">
                                                <input type="radio" name="beneficiario[identificacionDoc]" value="2">
                                                PDF
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div id="image-docuemnt-beneficiario" class="form-group m-form__group row">
                                        <div id="content-file-image-document-beneficiario-frente" class="col-lg-6 m-form__group-sub">
                                            <label for="">Imagen documento identificación frente</label>
                                            <div class="m-dropzone file-image-document-beneficiario-frente m-dropzone--success" action="{{ route('upload.image.document') }}" id="m-dropzone-three">
                                                <div class="m-dropzone__msg dz-message needsclick">
                                                    <h3 class="m-dropzone__msg-title">Subir foto del frente de su documento de identificación</h3>
                                                    <span class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                </div>
                                            </div>
                                            <div id="error-file-image-document-beneficiario-frente" class="form-control-feedback"></div>
                                            <input type="hidden" name="beneficiario[urlImageDocumentFrente]" class="form-control m-input" value="">
                                        </div>

                                        <div id="content-file-image-document-beneficiario-atras" class="col-lg-6 m-form__group-sub">
                                            <label for="">Imagen documento identificación atras</label>
                                            <div class="m-dropzone file-image-document-beneficiario-atras m-dropzone--success" action="{{ route('upload.image.document') }}" id="m-dropzone-three">
                                                <div class="m-dropzone__msg dz-message needsclick">
                                                    <h3 class="m-dropzone__msg-title">Subir foto de la parte de atrás de su documento de identificación</h3>
                                                    <span class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                </div>
                                            </div>
                                            <div id="error-file-image-document-beneficiario-atras" class="form-control-feedback"></div>
                                            <input type="hidden" name="beneficiario[urlImageDocumentAtras]" class="form-control m-input" value="">
                                        </div>
                                    </div>

                                    <div id="pdf-docuemnt-beneficiario" style="display: none" class="form-group m-form__group row">
                                        <div id="content-file-pdf-document-beneficiario" class="col-lg-6 m-form__group-sub">
                                            <label for="">PDF documento identificación</label>
                                            <div class="m-dropzone file-pdf-document-beneficiario m-dropzone--success" action="{{ route('upload.pdf.document') }}" id="m-dropzone-three">
                                                <div class="m-dropzone__msg dz-message needsclick">
                                                    <h3 class="m-dropzone__msg-title">Subir documento de identificación por ambos lados</h3>
                                                    <span class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                </div>
                                            </div>
                                            <div id="error-file-pdf-document-beneficiario" class="form-control-feedback"></div>
                                            <input type="hidden" name="beneficiario[urlPdfDocument]" class="form-control m-input" value="">
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <div id="content-file-image-profile-beneficiario" class="col-lg-6 m-form__group-sub">
                                            <label for="">Foto de perfil</label>
                                            <div class="m-dropzone file-image-profile-beneficiario m-dropzone--success" action="{{ route('upload.image.profile') }}" id="m-dropzone-three">
                                                <div class="m-dropzone__msg dz-message needsclick">
                                                    <h3 class="m-dropzone__msg-title">Subir foto de perfil</h3>
                                                    <span class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                </div>
                                            </div>
                                            <div id="error-file-image-profile-beneficiario" class="form-control-feedback"></div>
                                            <input type="hidden" name="beneficiario[urlImageProfile]" class="form-control m-input" value="">
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
                                            <i data-toggle="m-tooltip" data-width="auto"
                                               class="m-form__heading-help-icon flaticon-info"
                                               title="Datos importantes del lugar y sitio de nacimiento"></i>
                                        </h3>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <div id="content-beneficiario_departamentoNacimiento"
                                             class="col-lg-6 m-form__group-sub">
                                            <label class="form-control-label">Departamento de nacimiento <span
                                                    class="text-danger">*</span></label>
                                            <select
                                                onchange="onSelectDepartamentosChange(this, 'beneficiario-nacimiento-municipios')"
                                                id="m_select2_7"
                                                name="beneficiario[departamentoNacimiento]"
                                                class="form-control m-select2">
                                                <option>Seleccione departamento</option>
                                                @foreach($departamentos as $departamento)
                                                    <option
                                                        value="{{$departamento->id}}">{{ $departamento->descripcion }}</option>
                                                @endforeach
                                            </select>
                                            <div id="error-beneficiario_departamentoNacimiento"
                                                 class="form-control-feedback" style="display: none"></div>
                                        </div>

                                        <div id="content-beneficiario_municipioNacimiento"
                                             class="col-lg-6 m-form__group-sub">
                                            <label class="form-control-label">Municipio de nacimiento <span
                                                    class="text-danger">*</span></label>
                                            <select name="beneficiario[municipioNacimiento]"
                                                    class="form-control m-select2 beneficiario-nacimiento-municipios"
                                                    id="m_select2_8"></select>
                                            <div id="error-beneficiario_municipioNacimiento"
                                                 class="form-control-feedback" style="display: none"></div>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <div id="content-beneficiario_departamentoResidencia"
                                             class="col-lg-6 m-form__group-sub">
                                            <label class="form-control-label">Departamento de residencia <span
                                                    class="text-danger">*</span></label>
                                            <select
                                                onchange="onSelectDepartamentosChange(this, 'beneficiario-residencia-municipios')"
                                                id="m_select2_1_4"
                                                name="beneficiario[departamentoResidencia]"
                                                class="form-control m-select2">
                                                <option value="-1">Seleccione departamento</option>
                                                @foreach($departamentos as $departamento)
                                                    <option
                                                        value="{{$departamento->id}}">{{ $departamento->descripcion }}</option>
                                                @endforeach
                                            </select>
                                            <div id="error-beneficiario_departamentoResidencia"
                                                 class="form-control-feedback" style="display: none"></div>
                                        </div>

                                        <div id="content-beneficiario_municipioResidencia"
                                             class="col-lg-6 m-form__group-sub">
                                            <label class="form-control-label">Municipio de residencia <span
                                                    class="text-danger">*</span></label>
                                            <select onchange="onSelectMunicipiosChange(this)"
                                                    name="beneficiario[municipioResidencia]"
                                                    class="form-control m-select2 beneficiario-residencia-municipios"
                                                    id="m_select2_1_5"></select>
                                            <div id="error-beneficiario_municipioResidencia"
                                                 class="form-control-feedback" style="display: none"></div>
                                        </div>
                                    </div>

                                    <div class="form-group m-form__group row">
                                        <div id="content-beneficiario_address" class="col-lg-6 m-form__group-sub">
                                            <label class="form-control-label">Dirección de residencia <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="beneficiario[address]" class="form-control m-input"
                                                   placeholder="" value="">
                                            <div id="error-beneficiario_address" class="form-control-feedback"
                                                 style="display: none"></div>
                                            <span class="m-form__help">Por favor ingrese dirección de residencia</span>
                                        </div>

                                        <div class="col-lg-6 m-form__group-sub">
                                            <label class="form-control-label">Vereda/Corregimiento de residencia</label>
                                            <input type="text" name="beneficiario[vereda]" class="form-control m-input"
                                                   placeholder="" value="">
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
            <div id="content-informacion-grupo-musical" style="display: none"
                 class="m-portlet m-portlet--mobile m-portlet--body-progress-">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">Datos de la agrupación musical</h3>
                        </div>
                    </div>

                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="#" data-toggle="m-tooltip"
                                   class="m-portlet__nav-link m-portlet__nav-link--icon"
                                   data-direction="left" data-width="auto"
                                   title="Información de los integrante del grupo">
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
                                <div id="content-aspirante_nameTeam" class="col-lg-4 col-md-4 col-12 m-form__group-sub">
                                    <label class="form-control-label">Nombre de la agrupación musical <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="aspirante[nameTeam]" class="form-control m-input"
                                           placeholder="" value="">
                                    <div id="error-aspirante_nameTeam" class="form-control-feedback"
                                         style="display: none"></div>
                                    <span
                                        class="m-form__help">Por favor ingrese el nombre de la agrupación musical</span>
                                </div>

                                <div id="content-input-max-members" class="col-12 col-lg-4 col-md-4 m-form__group-sub">
                                    <label for="example-number-input">Ingrese el número de integrantes</label>
                                    <input id="input-max-members" class="form-control m-input" type="number" value="">
                                    <div id="error-input-max-members" class="form-control-feedback" style="display: none"></div>
                                    <span class="m-form__help">Luego clic en agregar integrantes</span>
                                </div>

                                <div class="col-lg-4 col-12 col-md-4 m-form__group-sub">
                                    <div id="event-add-max-members"
                                         class="btn btn btn-sm btn-brand m-btn m-btn--icon m-btn--pill m-btn--wide"
                                         style="margin: 2rem 2rem 0; padding: 0.8rem 2rem;">
                                        <span>
                                            <i class="la la-plus"></i>
                                            <span>Agregar Integrantes</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span id="help-max-members" class="m-form__help"
                                  style="display:none; margin-top: -1rem; color: #f4516c; font-size: 1rem;">Recuerde que el número máximo de integrantes para el grupo es 12 personas</span>
                        </div>

                        <div class="col col-lg-12">
                            <div class="m-tabs-content" id="m_sections">
                                <!-- add members group -->
                                <div class="m-tabs-content__item m-tabs-content__item--active" id="m_section_1">
                                    <div class="m-accordion m-accordion--section m-accordion--padding-lg"
                                         id="m_section_1_content">
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
            <div id="btn-enviar-datos" style="display: none"
                 class="m-portlet m-portlet--mobile m-portlet--body-progress-">
                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group m-form__group m-form__group--sm row">

                                <div id="content-acceptTermsConditions" class="col-lg-9 m-form__group-sub">
                                    <label class="form-control-label">Términos y Condiciones <span
                                            class="text-danger">*</span></label>
                                    <div class="m-radio-inline">
                                        <label class="m-checkbox">
                                            <input type="checkbox" name="acceptTermsConditions" value="1">Haga clic aquí
                                            para indicar que ha leído y acepta el
                                            acuerdo de <a target="_blank"
                                                          href="https://creasonidos.com/terminos-y-condiciones/"><span
                                                    style="color: #CE7250">Términos y Condiciones.</span></a>
                                            <span></span>
                                        </label>
                                    </div>
                                    <div id="error-acceptTermsConditions" class="form-control-feedback"
                                         style="display: none"></div>
                                </div>

                                <div class="col-xl-3">
                                    <button id="send-info"
                                            class=" pull-right btn btn-primary m-btn m-btn--custom m-btn--icon"
                                            data-wizard-action="submit">
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
        // variables que se emplean en form-register 
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
                $('#datepicker_fecha_nacimiento').datepicker({
                    rtl: mUtil.isRTL(),
                    language: 'es',
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
                init: function () { demos(); }
            };
        }();

        var inputSelect = function () {
            $('#m_select2_1_2, #m_select2_1_validate').select2({
                placeholder: "Selecciona una opción"
            });
            $('#m_select2_1_4, #m_select2_1_validate').select2({
                placeholder: "Selecciona una opción"
            });
            $('#m_select2_2').select2({
                placeholder: "Seleccione ciudad ó municipio",
            });
            $('#m_select2_4').select2({
                placeholder: "Seleccione ciudad ó municipio",
            });
            $('#m_select2_9').select2({
                placeholder: "Seleccione ciudad ó municipio",
            });
            $('#m_select2_8').select2({
                placeholder: "Seleccione ciudad ó municipio",
            });
            $('#m_select2_1_3').select2({
                placeholder: "Seleccione ciudad ó municipio",
            });
            $('#m_select2_1_5').select2({
                placeholder: "Seleccione ciudad ó municipio",
            });
        }

        jQuery(document).ready(function () {
            BootstrapDatepicker.init();
            inputSelect();
        });        
    </script>
@endsection
