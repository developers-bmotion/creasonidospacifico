@extends('backend.layout')

@push('css')
    <link rel="stylesheet" href="/frontend/css/style.css">
@endpush
<!--=====================================
   HEADER
======================================-->

@section('header')
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">Gestores</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-music"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">{{ __('Gestores') }}</span>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <a id="modalAddManager" data-toggle="modal" data-target="#modal_add_management"
               class="btn btn-secondary m-btn m-btn--icon m-btn--pill" style="cursor: pointer">
                <span>
                    <i class="fa flaticon-plus"></i>
                    <span>Nuevo Gestor</span>
                </span>
            </a>
        </div>
    </div>
@stop
<!--=====================================
CONTENIDO DEL MODULO PROYECTOS ADMIN
======================================-->
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force">
                    <div class="m-portlet__body">
                        <div class="m-widget19">
                            <div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides"
                                 style="min-height-: 100px">
                                <img src="/images/fondo_gestores.png" alt=""
                                     style="height: 230px;object-fit: cover;">
                                <h3 class="m-widget19__title m--font-light">
                                    Gestores
                                </h3>
                                <div class="m-widget19__shadow">
                                </div>
                            </div>
                            <div class="form-group">

                            </div>
                            <div class="row p-3">
                                @forelse($gestores as $gestor)
                                    <div class="col-lg-4">
                                        <div class="m-portlet m-portlet--full-height  ">
                                            <div class="m-portlet__body">
                                                <div class="m-card-profile">
                                                    <div class="m-card-profile__title m--hide">
                                                        Your Profile
                                                    </div>
                                                    <div class="m-card-profile__pic">
                                                        <a href="{{ route('profile.managament',$gestor->slug)}}">
                                                            <div class="m-card-profile__pic-wrapper">
                                                                @if(Storage::disk('public')->exists('users/'.$gestor->picture))
                                                                    <img src="{{ $gestor->pathAttachment()}}"
                                                                         alt=""/>
                                                                @else
                                                                    <img src="{{ $gestor->picture }}" alt="">
                                                                @endif
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="m-card-profile__details">
                                                        <span
                                                            class="m-card-profile__name">{{ $gestor->name }} {{ $gestor->last_name }}</span>
                                                        <p>{{ $gestor->city->departaments->descripcion }}</p>
                                                        <a href="" class="m-card-profile__email m-link"
                                                           style="margin-left: -15px">{{ $gestor->email  }}</a>

                                                    </div>
                                                    <div class="m-card-profile__details" style=padding-top:20px;>
                                                        <a href="{{ route('profile.managament',$gestor->slug)}}"
                                                           class="btn btn-secondary m-btn m-btn--icon m-btn--pill">{{ __('mas_informacion') }}</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <h4 class="text-center">{{ __('no_hay_registros') }}</h4>
                                @endforelse
                            </div>
                            {{--                            {{ $gestor->links() }}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====================================
	MODAL AGREGAR NUEVO MANAGEMENT
    ======================================-->
    <div class="modal fade" id="modal_add_management" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Gestor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('add.gestores.admin') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div
                                class="form-group col-12 col-md-6 col-lg-6 m-form__group {{$errors->has('name')? 'has-danger':''}}">
                                <label for="exampleInputEmail1">{{ __('nombre') }}:<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control m-input" id="" name="name"
                                       aria-describedby="emailHelp" placeholder="Ingrese nombres"
                                       value="{{ old('name') }}">
                                {!! $errors->first('name','<div class="form-control-feedback">*:message</div>')!!}
                            </div>
                            <div
                                class="form-group m-form__group  col-12 col-md-6 col-lg-6 {{$errors->has('last_name')? 'has-danger':''}}">
                                <label for="exampleInputEmail1">{{ __('apellidos') }}:<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control m-input" id=""
                                       aria-describedby="emailHelp" placeholder="Ingrese apellidos"
                                       value="{{ old('last_name') }}">
                                {!! $errors->first('last_name','<div class="form-control-feedback">*:message</div>')!!}
                            </div>
                            <div
                                class="form-group m-form__group col-12 col-md-6 col-lg-6 {{$errors->has('phone')? 'has-danger':''}}">
                                <label for="exampleInputEmail1">{{ __('Teléfono') }}:<span
                                        class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control m-input" id=""
                                       aria-describedby="emailHelp" placeholder="Ingrese teléfono"
                                       value="{{ old('phone') }}">
                                {!! $errors->first('phone','<div class="form-control-feedback">*:message</div>')!!}
                            </div>
                            <div
                                class="form-group m-form__group  col-12 col-md-6 col-lg-6 {{$errors->has('document_type')? 'has-danger':''}}">
                                <div class="m-form__group-sub">
                                    <label class="form-control-label">Tipo de documento:<span
                                            class="text-danger">*</span></label>
                                    <select name="document_type" class="form-control">
                                        <option value="-1">Seleccione departamento</option>
                                        <option value="1">Cédula de Ciudadania</option>
                                        <option value="3">Cédula de Extrangeria</option>
                                    </select>
                                    <div id="error-aspirante_departamentoNacimiento" class="form-control-feedback"
                                         style="display: none"></div>
                                    {!! $errors->first('document_type','<div class="form-control-feedback">*:message</div>')!!}
                                </div>
                            </div>
                            <div
                                class="form-group m-form__group col-12 col-md-6 col-lg-6 {{$errors->has('identificacion')? 'has-danger':''}}">
                                <label for="exampleInputEmail1">Nº Identificación:<span
                                        class="text-danger">*</span></label>
                                <input type="num" name="identificacion" class="form-control m-input" id=""
                                       aria-describedby="emailHelp" placeholder="Ingrese documento"
                                       value="{{ old('identificacion') }}">
                                {!! $errors->first('identificacion','<div class="form-control-feedback">*:message</div>')!!}
                            </div>
                            <div class="form-group m-form__group  col-12 col-md-6 col-lg-6">
                                <div id="content-aspirante_departamentoNacimiento"
                                     class="m-form__group-sub">
                                    <label class="form-control-label">Departamento:<span
                                            class="text-danger">*</span></label>
                                    <select
                                        onchange="onSelectDepartamentosChange(this, 'aspirante-nacimiento-municipios')"
                                        id="m_select2_3"
                                        name="departamento" class="form-control m-select2">
                                        <option value="-1">Seleccione departamento</option>
                                        @foreach($departamentos as $departamento)
                                            <option
                                                value="{{$departamento->id}}">{{ $departamento->descripcion }}</option>
                                        @endforeach
                                    </select>
                                    <div id="error-aspirante_departamentoNacimiento" class="form-control-feedback"
                                         style="display: none"></div>
                                </div>
                            </div>
                            <div class="form-group m-form__group  col-12 col-md-6 col-lg-6">
                                <div id="content-aspirante_municipioNacimiento" class="m-form__group-sub">
                                    <label class="form-control-label">Municipio o Ciudad: <span
                                            class="text-danger">*</span></label>
                                    <select onchange="onSelectMunicipiosChange(this)"
                                            name="city"
                                            class="form-control m-select2 aspirante-nacimiento-municipios"
                                            id="m_select2_4"></select>
                                    <div id="error-aspirante_municipioNacimiento" class="form-control-feedback"
                                         style="display: none"></div>
                                </div>
                            </div>
                            <div
                                class="form-group m-form__group  col-12 col-md-6 col-lg-6 {{$errors->has('profile')? 'has-danger':''}}">
                                <label for="exampleInputEmail1">{{ __('Perfil') }}</label>
                                <textarea name="profile" class="form-control m-input"
                                          placeholder="Describa el perfil"></textarea>
                                {!! $errors->first('profile','<div class="form-control-feedback">*:message</div>')!!}
                            </div>
                            <div
                                class="form-group m-form__group col-12 col-md-6 col-lg-6 {{$errors->has('email')? 'has-danger':''}}">
                                <label for="exampleInputEmail1">{{ __('email') }}:<span
                                        class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control m-input" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="Ingrese email"
                                       value="{{ old('email') }}">
                                {!! $errors->first('email','<div class="form-control-feedback">*:message</div>')!!}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('cerrar') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('guardar') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
@section('js.form-register')
    <script src="/backend/assets/js/form-register.js" type="text/javascript"></script>
@endsection
@push('js')
    <script>
        @if(\Session::has('msg'))
        swal({
            "title": "{{\Session::get('msg')[0]}}",
            "text": "{{\Session::get('msg')[1]}}",
            "type": "{{\Session::get('msg')[2]}}",
            "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
        });
        @endif
        var select = false;
        const startSelectTag = function () {
            setTimeout(function () {
                $('#m_select2_11_tipo').select2({
                    placeholder: "{{ __('selecciona_insteres') }}",
                    tags: true
                });
            }, 500);
        };
        @if (count($errors) > 0)
        $('#modal_add_management').modal('show');
        startSelectTag();
        @endif
        $('#modalAddManager').click(function () {
            if (select) {
                return;
            }
            select = true;
            startSelectTag();
        });

    </script>
@endpush
