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
                        <span class="m-nav__link-text">{{__('perfil')}} Curador</span>
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
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                @include('backend.management.partials.siderbar-profile')
            </div>
            <div class="col-xl-9 col-lg-8">
                <!--=====================================
		         VISTA PARA EL MANAGEMENT
                ======================================-->

                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary"
                                role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab"
                                       href="#m_user_profile_tab_2"
                                       role="tab">
                                        Canciones Asignadas
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab"
                                       href="#m_user_profile_tab_1" role="tab">
                                        <i class="flaticon-share m--hide"></i>
                                        Información
                                    </a>
                                </li>
                                @if(auth()->user()->roles[0]->rol == "Manage")
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3"
                                           role="tab">
                                            {{ __('configuracion') }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <!--=====================================
                         INFORMACIÓN DEL CURADOR
                        ======================================-->
                        <div class="tab-pane" id="m_user_profile_tab_1">

                            <div class="m-portlet__body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 col-12">
                                        <div class="form-group m-form__group">
                                            <div id="content-aspirante_name" class="m-form__group-sub">
                                                <label
                                                    class="form-control-label font-weight-bold">Nombre:</label>
                                                <p>{{ $user->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-12">
                                        <div class="form-group m-form__group">
                                            <div id="content-aspirante_name" class="m-form__group-sub">
                                                <label
                                                    class="form-control-label font-weight-bold">Apellidos:</label>
                                                <p>{{ $user->last_name }}</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-12">
                                        <div class="form-group m-form__group">
                                            <div id="content-aspirante_name" class="m-form__group-sub">
                                                <label
                                                    class="form-control-label font-weight-bold">Correo
                                                    Electrónico:</label>
                                                <p>{{ $user->email }}</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-12">
                                        <div class="form-group m-form__group">
                                            <div id="content-aspirante_name" class="m-form__group-sub">
                                                <label
                                                    class="form-control-label font-weight-bold">Teléfono:</label>
                                                <p>{{ $user->phone_1 }}</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-12">
                                        <div class="form-group m-form__group">
                                            <div id="content-aspirante_name" class="m-form__group-sub">

                                                <label
                                                    class="form-control-label font-weight-bold">Tipo de
                                                    Documento:</label>
                                                <p>{{ $user->documentType->document }}</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-12">
                                        <div class="form-group m-form__group">
                                            <div id="content-aspirante_name" class="m-form__group-sub">

                                                <label
                                                    class="form-control-label font-weight-bold">Nº
                                                    Identificación:</label>
                                                <p>{{ $user->identification }}</p>

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
                                                <p>{{ $user->profile }}</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <div
                                            class="form-group m-form__group {{$errors->has('web_site')? 'has-danger':''}}">
                                            <h5 class="m-section__heading"
                                            >Modalidades Interesadas:</h5>
                                            <div class="m-demo__preview m-demo__preview--badge">
                                                @forelse($managements->categories as $insteres)
                                                    <span class="m-badge m-badge-- m-badge--wide"
                                                          style="font-size: 13px;">{{ $insteres->category }}</span>
                                                @empty
                                                    <p>{{ __('aun_no_registrado') }}</p>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane active" id="m_user_profile_tab_2">
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
                                            <table class="table table-striped- table-bordered table-hover table-checkable"
                                                   id="table__profile_projects_management">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('artista') }}</th>
                                                    <th>{{ __('titulo') }}</th>
                                                    <th>{{ __('categoria') }}</th>
                                                    <th>{{ __('estado') }}</th>
                                                    <th>{{ __('acciones') }}</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--=====================================
                         CONFIGURACIÓN PARA EL CURADOR
                        ======================================-->
                        @if(auth()->user()->roles[0]->rol == "Manage")
                            <div class="tab-pane " id="m_user_profile_tab_3">
                                <div class="m-portlet__body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="m-section">
                                                <!--=====================================
                                               CONFIGURACIONES PARA EL PERFIL DE USUARIO
                                               ======================================-->
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
                                                        </div>
                                                    </div>
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
    </div>
@stop

@push('js')
    <script>
        var tipoProyecto = null;
        var table = null;
        const loadTable = function (){
            if (table !== null){
                table.destroy();
            }
            table = $('#table__profile_projects_management').DataTable({
                "processing": true,
                "serverSide": true,
                "data": null,
                "order": [[ 0, "desc" ]],
                "ajax": {
                    url: "{{route('datatables.projects.profile.manage')}}",
                    data: {
                        tipoProyecto: tipoProyecto,
                        id_user: {{ $user->id }}
                    }
                },
                "columns": [
                    {
                        "width": "1%",
                        data: 'id',
                        defaultContent: '<span class="label label-danger text-center">Ningún valor por defecto</span>'
                    },
                    {
                        data: 'artists.nickname',
                        defaultContent: '<span class="label label-danger text-center">Ningún valor por defecto</span>',
                        render : function (data, type, JsonResultRow, meta){
                            return JsonResultRow.artists[0].nickname;
                        }
                    },
                    {
                        data: 'title',
                        defaultContent: '<span class="label label-danger text-center">Ningún valor por defecto</span>'
                    },
                    {
                        data: 'category.category',
                        defaultContent: '<span class="label label-danger text-center">Ningún valor por defecto</span>'
                    },
                    {"width": "15%",
                        data: 'status',
                        render:function (data) {
                            let info = '<span class="m-badge m-badge--danger m-badge--wide">Hola</span>';
                            switch(parseInt(data)){
                                case 1:
                                    info = '<span class="m-badge m-badge--brand m-badge--wide" style="background-color:#C4C5D4 !important" >{{ __('revision') }}</span>';
                                    break;
                                case 2:
                                    info = '<span class="m-badge m-badge--brand m-badge--wide" style="background-color:#9C26EA !important;font-size:7px" >{{ __('pre_aprovado') }}</span>';
                                    break;
                                case 3:
                                    info = '<span class="m-badge  m-badge--success m-badge--wide">{{ __('aprovado2') }}</span>';
                                    break;
                                case 4:
                                    info = '<span class="m-badge  m-badge--info m-badge--wide">{{ __('publicado2') }}</span>';
                                    break;
                                case 5:
                                    info = '<span class="m-badge  m-badge--danger m-badge--wide">{{ __('rechazado') }}</span>';
                                    break;
                            }
                            return '<div class="text-center">'+info+'</div>';
                        }
                    },
                    {
                        render:function (data,type, JsonResultRow,meta) {
                            return '<div class="text-center"><a href="/dashboard/project/'+JsonResultRow.slug+'" class="btn m-btn--pill btn-secondary"><i class="fa fa-eye"></i></a></div>'
                        }
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
        $(".selectType").on('click', '.changeType', function(){
            let tipo = parseInt($(this).attr("data-type"));
            if (!(tipo >  0)){
                tipo = null;
            }
            tipoProyecto = tipo;
            loadTable();
        });
        loadTable();
    </script>
    <script>
        new Dropzone('.dropzone-management', {
            url: '{{ route('profile.photo.management') }}',
            acceptedFiles: 'image/*',
            maxFiles: 1,
            paramName: 'photo',
            params: {'id_user': '{{ $user->id }}'},
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
