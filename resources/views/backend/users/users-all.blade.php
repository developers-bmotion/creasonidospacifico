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
            <h3 class="m-subheader__title m-subheader__title--separator">Usuarios</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-users"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">Usuarios</span>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <a id="modalAddManager" data-toggle="modal" data-target="#modal_add_management"
               class="btn btn-secondary m-btn m-btn--icon m-btn--pill" style="cursor: pointer">
                <span>
                    <i class="fa flaticon-plus"></i>
                    <span>Nuevo Usuario</span>
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
                                <img src="/images/banner2.png" alt=""
                                     style="height: 230px;object-fit: cover;">
                                <h3 class="m-widget19__title m--font-light">
                                    Usuarios
                                </h3>
                                <div class="m-widget19__shadow">
                                </div>
                            </div>
                            <div class="form-group">

                            </div>
                            <div class="row p-3">
                                <div class="col-12">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    Usuarios Registrados
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <!--begin::Section-->
                                    <table class="table table-striped- table-bordered table-hover table-checkable"
                                           id="table_users">
                                        <thead>
                                        <tr>
                                            {{-- <th>#</th> --}}
                                            <th>Nombres</th>
                                            <th>Correo Electrónico</th>
                                            <th>Teléfono</th>
                                            <th>Rol</th>
                                            <th>Estado</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>

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
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('add.users.admin') }}">
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
                            <div
                                class="form-group m-form__group col-12 col-md-6 col-lg-6 {{$errors->has('email')? 'has-danger':''}}">
                                <label for="exampleInputEmail1">{{ __('email') }}:<span
                                        class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control m-input" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="Ingrese email"
                                       value="{{ old('email') }}">
                                {!! $errors->first('email','<div class="form-control-feedback">*:message</div>')!!}
                            </div>
                            <div
                                class="form-group m-form__group  col-12 col-md-6 col-lg-6 {{$errors->has('document_type')? 'has-danger':''}}">
                                <div class="m-form__group-sub">
                                    <label class="form-control-label">Rol en el sistema:<span
                                            class="text-danger">*</span></label>
                                    <select name="role_type" class="form-control">
                                        <option value="-1">Seleccione departamento</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Aspirante</option>
                                        <option value="4">Subsanador</option>
                                        <option value="3">Curador</option>
                                        <option value="6">Gestor Cultural</option>
                                    </select>
                                    <div id="error-aspirante_departamentoNacimiento" class="form-control-feedback"
                                         style="display: none"></div>
                                    {!! $errors->first('document_type','<div class="form-control-feedback">*:message</div>')!!}
                                </div>
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
        $('#table_users').DataTable({
            "processing": true,
            "recordsTotal": 10000,
            "recordsFiltered": 3000,
            "order": [[1, "desc"]],
            "ajax": '{{route('get.users.tables')}}',
            "columns": [
                {
                    render: function (data, type, JsonResultRow, meta) {
                        // console.log(JsonResultRow,'data');
                        if (JsonResultRow.name === null) {
                            return '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                        } else {

                            return '<span class="label label-danger text-center">' + JsonResultRow.name + '</span>  <span class="label label-danger text-center">' + JsonResultRow.last_name + '</span>';
                        }
                        // return '<img src="' + JsonResultRow + '" width="50px"  style="border-radius: 100%;margin-right: auto;margin-left: auto;display: block; width:50px; height:50px"/>';
                    }

                },
                {
                    render: function (data, type, JsonResultRow, meta) {
                        // console.log(JsonResultRow,'data');
                        if (JsonResultRow.email === null) {
                            return '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                        } else {

                            return '<span class="label label-danger text-center">' + JsonResultRow.email;
                        }
                        // return '<img src="' + JsonResultRow + '" width="50px"  style="border-radius: 100%;margin-right: auto;margin-left: auto;display: block; width:50px; height:50px"/>';
                    }
                },
                {
                    render: function (data, type, JsonResultRow, meta) {
                        // console.log(JsonResultRow,'data');
                        if (JsonResultRow.phone_1 === null) {
                            return '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                        } else {

                            return '<span class="label label-danger text-center">' + JsonResultRow.phone_1;
                        }
                        // return '<img src="' + JsonResultRow + '" width="50px"  style="border-radius: 100%;margin-right: auto;margin-left: auto;display: block; width:50px; height:50px"/>';
                    }

                },
                {
                    render: function (data, type, JsonResultRow, meta) {
                        // console.log(JsonResultRow,'data');
                        if (JsonResultRow.roles[0].rol === null) {
                            return '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                        } else {

                            return '<span class="label label-danger text-center">' + JsonResultRow.roles[0].rol;
                        }
                    }

                },
                {
                    render: function (data, type, JsonResultRow, meta) {
                        return `<span class="m-switch m-switch--outline m-switch--icon m-switch--success"><label><input class="swicthState` + JsonResultRow.id + `" id-user="` + JsonResultRow.id + `" data-type="` + JsonResultRow.state + `" type="checkbox" ${JsonResultRow.state == 1 ? 'checked' : ""} name=""><span></span></label></span>`
                    }
                },


            ],
            "language": {
                "sProcessing": "{{__('procesando')}}",
                "sLengthMenu": "{{__('mostrar')}} _MENU_ {{__('registros')}}",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "{{__('nigun_dato_tabla')}}",
                "sInfo": "_TOTAL_ {{__('registros')}}",
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
    </script>
    <script>
        $(function () {
            let userId = parseInt($(this).attr("id-user"));
            $(`.swicthState${userId}`).change(function () {
                let status = parseInt($(this).attr("data-type"));
                let user = parseInt($(this).attr("id-user"));
                console.log('estado', status);
                console.log('user', user);

                swal({
                    title: '¡Actualizar Estado!',
                    text: "¿Esta seguro que desea actualizar el estado?",
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then(function (result) {
                    console.log(result);
                    if (result.value) {
                        $('body').loading({
                            message: 'Guardando datos...',
                            start: true,
                        });
                        $.get('/api/change-status-user/' + user + '/' + status, function (r) {
                            $('body').loading({start: false});
                            viewAlertError();
                        })
                    } else if (result.dismiss === 'cancel') {
                        // location.reload();
                        if (status == 1) {
                            $(".swicthState" + userId).prop('checked', true);
                        } else {
                            $(".swicthState" + userId).prop('checked', false);
                        }
                    }
                });


            });

            /* mostrar alerta de datos faltantes */
            function viewAlertError() {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "2000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.success("Estado actualizado correctamente", "");
            }
        })
    </script>
@endpush
