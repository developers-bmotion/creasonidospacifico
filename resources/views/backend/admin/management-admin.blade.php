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
            <h3 class="m-subheader__title m-subheader__title--separator">Curadores</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-check"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">Curadores</span>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <a id="modalAddManager" data-toggle="modal" data-target="#modal_add_management"
               class="btn btn-secondary m-btn m-btn--icon m-btn--pill" style="cursor: pointer">
                <span>
                    <i class="fa flaticon-plus"></i>
                    <span>Nuevo Curador</span>
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
                                <img src="/images/banner-contacto.png" alt=""
                                     style="height: 230px;object-fit: cover;">
                                <h3 class="m-widget19__title m--font-light">
                                    Curadores
                                </h3>
                                <div class="m-widget19__shadow">
                                </div>
                            </div>
                            <div class="form-group"></div>
                            {{--  --}}
                            <div class="row p-3">
                                @forelse($managements as $management)
                                    <div class="col-lg-4">
                                        <div class="m-portlet m-portlet--full-height  ">
                                            <div class="m-portlet__body">
                                                <div class="m-card-profile">
                                                    <div class="m-card-profile__title m--hide">
                                                        Your Profile
                                                    </div>
                                                    <div class="m-card-profile__pic">
                                                        <a href="{{ route('profile.curador',$management->users->slug)}}">
                                                            <div class="m-card-profile__pic-wrapper">

                                                                @if(Storage::disk('public')->exists('users/'.$management->users->picture))
                                                                    <img src="{{ $management->users->pathAttachment()}}"
                                                                        alt=""/>
                                                                @else
                                                                    <img src="{{ $management->users->picture }}" alt="">
                                                                @endif
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="m-card-profile__details">
                                                        <span
                                                            class="m-card-profile__name">{{ $management->users->name }}</span>

                                                        <a href="" class="m-card-profile__email m-link"
                                                        style="margin-left: -15px">{{ $management->users->email  }}</a>

                                                    </div>
                                                    <div class="m-card-profile__details" style=padding-top:20px;>
                                                        <a href="{{ route('profile.curador',$management->users->slug)}}"
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

                            {{ $managements->links() }}
                            {{-- fin tab curador 1 --}}

                            {{--  --}}                            
                        </div>
                        
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
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Curador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('add.management.admin') }}">
                    @csrf
                    <div class="modal-body">
                        {{-- <div class="form-group m-form__group {{$errors->has('country_id')? 'has-danger':''}}">
                            <label for="m_select2_add_management">{{ __('pais') }}</label>
                            <select name="country_id" class="form-control m-bootstrap-select m_selectpicker required">
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{($country->id == old('country_id'))?"selected":""}} >{{ $country->country }}</option>
                                @endforeach
                                {!! $errors->first('country_id','<div class="form-control-feedback">*:message</div>')!!}
                            </select>
                        </div> --}}
                        <div class="row">
                            <div
                                class="form-group m-form__group col-12 col-md-6 col-lg-6 {{$errors->has('name')? 'has-danger':''}}">
                                <label for="exampleInputEmail1">Nombres<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control m-input" id="" name="name"
                                       aria-describedby="emailHelp" placeholder="Ingrese nombres"
                                       value="{{ old('name') }}">
                                {!! $errors->first('name','<div class="form-control-feedback">*:message</div>')!!}
                            </div>
                            <div
                                class="form-group m-form__group col-12 col-md-6 col-lg-6 {{$errors->has('last_name')? 'has-danger':''}}">
                                <label for="exampleInputEmail1">{{ __('apellidos') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control m-input" id=""
                                       aria-describedby="emailHelp" placeholder="Ingrese {{ __('apellidos') }}"
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
                            <div class="form-group m-form__group  col-12 col-md-6 col-lg-6">
                                <label class="form-control-label">Tipo de documento:<span
                                        class="text-danger">*</span></label>
                                <select name="document_type" class="form-control">
                                    <option value="-1">Seleccione documento</option>
                                    <option value="1">Cédula de Ciudadania</option>
                                    <option value="3">Cédula de Extrangeria</option>
                                </select>
                                <div id="error-aspirante_departamentoNacimiento" class="form-control-feedback"
                                     style="display: none"></div>
                                {!! $errors->first('document_type','<div class="form-control-feedback">*:message</div>')!!}
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

                            <div
                                class="form-group m-form__group col-12 col-md-6 col-lg-6 {{$errors->has('email')? 'has-danger':''}}">
                                <label for="exampleInputEmail1">{{ __('email') }}<span
                                        class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control m-input" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="Ingrese {{ __('email') }}"
                                       value="{{ old('email') }}">
                                {!! $errors->first('email','<div class="form-control-feedback">*:message</div>')!!}
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class="form-group m-form__group col-12 col-md-12 col-lg-12 {{$errors->has('insteres')? 'has-danger':''}}">

                                <label for="exampleInputEmail1">{{ __('selecciona_insteres') }} (Modalidades)<span
                                        class="text-danger">*</span></label>

                                <select class="form-control m-select2" id="m_select2_11_tipo" multiple
                                        name="insteres[]">
                                    <option></option>
                                    @foreach($categories as $categorie)
                                        <option
                                            value="{{ $categorie->id }}" {{(old('insteres') && in_array($categorie->id."", old('insteres')))?"selected":""}}>{{ $categorie->category }}</option>
                                    @endforeach
                                    {!! $errors->first('insteres','<div class="form-control-feedback">*:message</div>')!!}
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class="form-group m-form__group  col-12 col-md-12 col-lg-12 {{$errors->has('profile')? 'has-danger':''}}">
                                <label for="exampleInputEmail1">{{ __('Perfil') }}</label>
                                <textarea rows="8" cols="50" name="profile" class="form-control m-input"
                                          placeholder="Describa el perfil"></textarea>
                                {!! $errors->first('profile','<div class="form-control-feedback">*:message</div>')!!}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ __('cerrar') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('guardar') }}</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

@stop
@push('js')
    <script>
        @if(\Session::has('msg'))
        swal({
            "title": "Correcto",
            "text": "Curador creado correctamente",
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
        @if (count($errors) > 0 )
        $('#modal_add_management').modal('show');
        if ($('#tipoCurador').val() == 0) {
            $('.tipoErr').show();

        } else {
            $('.tipoErr').hide();
        }

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
