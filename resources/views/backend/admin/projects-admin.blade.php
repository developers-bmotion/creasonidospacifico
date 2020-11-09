@extends('backend.layout')
@push('css')
    <link rel="stylesheet" href="/backend/admin/css/dashboard.css">
    {{-- Custom css --}}
    <link href="/css/main-custom.css" rel="stylesheet" type="text/css"/>
@endpush
<!--=====================================
   HEADER
======================================-->

@section('header')

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{ __('proyectos') }}</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon flaticon-share"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">{{ __('proyectos') }}</span>
                    </a>
                </li>

                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text"></span>
                    </a>
                </li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">{{ __('todos') }}</span>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push"
                 m-dropdown-toggle="hover" aria-expanded="true">
                <a href="#"
                   class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                    <i class="la la-plus m--hide"></i>
                    <i class="la la-ellipsis-h"></i>
                </a>
                <div class="m-dropdown__wrapper">
                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                    <div class="m-dropdown__inner">
                        <div class="m-dropdown__body">
                            <div class="m-dropdown__content">
                                <ul class="m-nav">
                                    <li class="m-nav__section m-nav__section--first m--hide">
                                        <span class="m-nav__section-text">Quick Actions</span>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-share"></i>
                                            <span class="m-nav__link-text">Activity</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                            <span class="m-nav__link-text">Messages</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-info"></i>
                                            <span class="m-nav__link-text">FAQ</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                            <span class="m-nav__link-text">Support</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__separator m-nav__separator--fit">
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">Submit</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
<!--=====================================
CONTENIDO DEL MODULO PROYECTOS ADMIN
======================================-->
@section('content')
    {{-- <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Todos los proyectos
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">

                        <li class="m-portlet__nav-item">
                            <h5 class="mr-2">Mostrando todos los: </h5>
                            <span id="current_status"
                                  class="m-badge m-badge--metal m-badge--wide m-badge--rounded">{{ __('revision') }}</span>
                        </li>
                        <div class="m-dropdown m-dropdown--inline  m-dropdown--arrow m-dropdown--align-right"
                             m-dropdown-toggle="hover">
                            <a href="#" class="m-dropdown__toggle btn btn-warning dropdown-toggle">
                                {{ __('estado') }}
                            </a>
                            <div class="m-dropdown__wrapper">
                                <span class="m-dropdown__arrow m-dropdown__arrow--right"></span>
                                <div class="m-dropdown__inner">
                                    <div class="m-dropdown__body">
                                        <div class="m-dropdown__content selectType">
                                            <ul class="m-nav">
                                                <li class="m-nav__section m-nav__section--first">
                                                    <span class="m-nav__section-text">{{ __('selecciona') }}</span>
                                                </li>
                                                <li class="m-nav__item text-center">
                                                    <span style="background-color: #9c9ca5"
                                                          class="changeType w-100 btn btn-metal m-btn m-btn--pill m-btn--wide btn-sm"
                                                          data-type="{{\App\Project::REVISION}}">{{ __('revision') }}</span>
                                                </li>
                                                @if(\App\User::navigation() !== "Subsanador")
                                                    <li class="m-nav__item text-center">
                                                        <span
                                                            class="changeType w-100 btn btn-brand m-btn m-btn--pill m-btn--wide btn-sm"
                                                            data-type="{{\App\Project::PREAPPROVAL}}">{{ __('pre_aprovado') }}</span>

                                                    </li>
                                                @endif
                                                <li class="m-nav__item text-center">
                                                    <span
                                                        class="changeType w-100 btn btn-success m-btn m-btn--pill m-btn--wide btn-sm"
                                                        data-type="{{\App\Project::APPROVAL}}">{{ __('Aprovados') }}</span>
                                                </li>
                                                <li class="m-nav__item text-center">
                                                    <span style="color:white;"
                                                          class="changeType w-100 btn btn-warning m-btn m-btn--pill m-btn--wide btn-sm"
                                                          data-type="{{\App\Project::PENDING}}">{{ __('Pendientes') }}</span>
                                                </li>
                                                <li class="m-nav__item text-center">
                                                    <span
                                                        class="changeType w-100 btn btn-danger m-btn m-btn--pill m-btn--wide btn-sm"
                                                        data-type="{{\App\Project::REJECTED}}">{{ __('rechazados') }}</span>
                                                </li>
                                                <li class="m-nav__item text-center">
                                                    <span style="color:white"
                                                          class="changeType w-100 btn btn-success m-btn m-btn--pill m-btn--wide btn-sm"
                                                          data-type="{{\App\Project::ACEPTED}}">{{ __('Aceptados') }}</span>
                                                </li>
                                                <li class="m-nav__item text-center">
                                                    <span
                                                        class="changeType w-100 btn btn-info m-btn m-btn--pill m-btn--wide btn-sm"
                                                        data-type="{{\App\Project::REVISON_UPDATE}}">{{ __('Nueva revisión') }}</span>
                                                </li>
                                                <li class="m-nav__item text-center">
                                                    <span
                                                        class="changeType w-100 btn btn-info m-btn m-btn--pill m-btn--wide btn-sm"
                                                        data-type="{{\App\Project::NOT_REMEDIED}}">{{ __('No subsanados') }}</span>
                                                </li>
                                                <li class="m-nav__separator m-nav__separator--fit">
                                                </li>
                                                <li class="m-nav__item">
                                                    <span
                                                        class="changeType w-100 btn btn-metal m-btn m-btn--pill m-btn--wide btn-block">{{ __('todos') }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <table class="table table-striped- table-bordered table-hover table-checkable"
                       id="table_projects_admin">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Aspirante') }}</th>
                        <th>Actuará como</th>
                        <th>Nombre de la canción</th>
                        <th>Género musical</th>
                        <th>{{ __('estado') }}</th>
                        <th>{{ __('acciones') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div> --}}
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        {{ __('Propuestas musicales') }}
                    </h3>
                </div>
            </div>

            {{-- <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">

                    <li class="m-portlet__nav-item"></li>
                    <div class="m-dropdown m-dropdown--inline  m-dropdown--arrow m-dropdown--align-right"
                         m-dropdown-toggle="hover">
                        <a href="#" class="m-dropdown__toggle btn btn-warning dropdown-toggle">
                            {{ __('estado') }}
                        </a>
                        <div class="m-dropdown__wrapper">
                            <span class="m-dropdown__arrow m-dropdown__arrow--right"></span>
                            <div class="m-dropdown__inner">
                                <div class="m-dropdown__body">
                                    <div class="m-dropdown__content selectType">
                                        <ul class="m-nav">
                                            <li class="m-nav__section m-nav__section--first">
                                                <span class="m-nav__section-text">{{ __('selecciona') }}</span>
                                            </li>
                                            <li class="m-nav__item text-center">
                                                <span class="changeType w-100 btn btn-outline-metal m-btn m-btn--pill m-btn--wide btn-sm" data-type="{{\App\Project::REVISION}}">{{ __('revision') }}</span>
                                            </li>
                                            <li class="m-nav__item text-center">
                                                <span class="changeType w-100 btn btn-outline-brand m-btn m-btn--pill m-btn--wide btn-sm" data-type="{{\App\Project::PREAPPROVAL}}">{{ __('pre_aprovado') }}</span>

                                            </li>
                                            <li class="m-nav__item text-center">
                                                <span class="changeType w-100 btn btn-outline-success m-btn m-btn--pill m-btn--wide btn-sm" data-type="{{\App\Project::APPROVAL}}">{{ __('aprovado') }}</span>
                                            </li>
                                            <li class="m-nav__item text-center">
                                            </li>
                                            <li class="m-nav__item text-center">
                                                <span class="changeType w-100 btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm" data-type="{{\App\Project::REJECTED}}">{{ __('rechazados') }}</span>
                                            </li>
                                            <li class="m-nav__separator m-nav__separator--fit">
                                            </li>
                                            <li class="m-nav__item">
                                                <span class="changeType w-100 btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-block">{{ __('todos') }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
            </div> --}}
        </div>

        <div class="m-portlet__body">
            {{-- filtros para datatable --}}
            <div class="row">
                <select class="form-control m-input m-input--square col-md-3 mb-3  tipoPersona" name="tipoPersona" id="tipoPersona">
                    <option value="0">Filtrar por tipo persona</option>
                    @foreach ($tipoPersona as $tipoPer)
                    <option value="{{$tipoPer->id  }}">{{ $tipoPer->name }}</option>
                    @endforeach

                </select>
                {{-- @dd($cat) --}}
                <select class="form-control m-input m-input--square col-md-3 mb-3" id="category_filter"

                >
                    <option value="0">Filtrar por modalidad</option>
                    @foreach ($cat as $category)
                    <option value="{{$category->id}}" >{{$category->category}}</option>
                    @endforeach

                </select>

                {{-- filtro estado --}}
                <div class="m-portlet__head-tools col-md-6">
                    <ul class="m-portlet__nav row mr-1 state_mobile">

                        <li class="m-portlet__nav-item row mr-2" style="margin-top: 0.6rem;">
                            <h5 class="mr-2">Estado: </h5>
                            <span id="current_status"
                                  class="m-badge m-badge--metal m-badge--wide m-badge--rounded" style="height:23px">{{ __('revision') }}</span>
                        </li>
                        <div class="m-dropdown m-dropdown--inline  m-dropdown--arrow m-dropdown--align-right"
                             m-dropdown-toggle="hover">
                            <a href="#" class="m-dropdown__toggle btn btn-warning dropdown-toggle">
                                Filtrar
                            </a>
                            <div class="m-dropdown__wrapper">
                                <span class="m-dropdown__arrow m-dropdown__arrow--right"></span>
                                <div class="m-dropdown__inner">
                                    <div class="m-dropdown__body">
                                        <div class="m-dropdown__content selectType">
                                            <ul class="m-nav">
                                                <li class="m-nav__section m-nav__section--first">
                                                    <span class="m-nav__section-text">FILTRAR POR ESTADO</span>
                                                </li>
                                                <li class="m-nav__item text-center">
                                                <span style="background-color: #9c9ca5"
                                                      class="changeType w-100 btn btn-metal m-btn m-btn--pill m-btn--wide btn-sm"
                                                      data-type="{{\App\Project::REVISION}}">{{ __('revision') }}</span>
                                                </li>
                                                {{-- @if(\App\User::navigation() !== "Subsanador") --}}
                                                    <li class="m-nav__item text-center">
                                                    <span
                                                        style="background-color:#9C26EA"
                                                        class="changeType w-100 btn btn-brand m-btn m-btn--pill m-btn--wide btn-sm"
                                                        data-type="{{\App\Project::PREAPPROVAL}}">{{ __('pre_aprovado') }}</span>

                                                    </li>
                                                {{-- @endif --}}
                                                <li class="m-nav__item text-center">
                                                <span
                                                    class="changeType w-100 btn btn-success m-btn m-btn--pill m-btn--wide btn-sm"
                                                    data-type="{{\App\Project::APPROVAL}}">{{ __('Aprobado') }}</span>
                                                </li>
                                                <li class="m-nav__item text-center">
                                                <span style="color:white;"
                                                      class="changeType w-100 btn btn-warning m-btn m-btn--pill m-btn--wide btn-sm"
                                                      data-type="{{\App\Project::PENDING}}">{{ __('Pendiente') }}</span>
                                                </li>
                                                <li class="m-nav__item text-center">
                                                <span
                                                    class="changeType w-100 btn btn-danger m-btn m-btn--pill m-btn--wide btn-sm"
                                                    data-type="{{\App\Project::REJECTED}}">{{ __('Rechazado') }}</span>
                                                </li>
                                                <li class="m-nav__item text-center">
                                                <span style="color:white"
                                                      class="changeType w-100 btn btn-success m-btn m-btn--pill m-btn--wide btn-sm"
                                                      data-type="{{\App\Project::ACEPTED}}">{{ __('Aceptado') }}</span>
                                                </li>
                                                <li class="m-nav__item text-center">
                                                <span
                                                    class="changeType w-100 btn btn-info m-btn m-btn--pill m-btn--wide btn-sm"
                                                    data-type="{{\App\Project::REVISON_UPDATE}}">{{ __('Nueva revisión') }}</span>
                                                </li>
                                                <li class="m-nav__item text-center">
                                                <span
                                                    class="changeType w-100 btn btn-info m-btn m-btn--pill m-btn--wide btn-sm"
                                                    data-type="{{\App\Project::NOT_REMEDIED}}">{{ __('No subsanado') }}</span>
                                                </li>
                                                <li class="m-nav__separator m-nav__separator--fit">
                                                </li>
                                                <li class="m-nav__section m-nav__section--first">
                                                    <span class="m-nav__section-text">FILTRAR POR REGISTRO</span>
                                                </li>
                                                <li class="m-nav__item text-center">
                                                <span style="color:white"
                                                      class="changeType w-100 btn btn-warning m-btn m-btn--pill m-btn--wide btn-sm"
                                                      data-type="{{\App\Project::PENDING_REGISTER}}">{{ __('Registro Pendiente') }}</span>
                                                </li>
                                                <li class="m-nav__item text-center">
                                                <span style="color:white"
                                                      class="changeType w-100 btn btn-danger m-btn m-btn--pill m-btn--wide btn-sm"
                                                      data-type="{{\App\Project::NOT_PROJECT_REGISTER}}">{{ __('Sin Proyecto Registrado') }}</span>
                                                </li>
                                                <li class="m-nav__item">
                                                    <span
                                                        class="changeType w-100 btn btn-metal m-btn m-btn--pill m-btn--wide btn-block"
                                                        data-type="0">{{ __('todos') }}</span>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>


            </div>
            <table class="table table-striped- table-bordered table-hover table-checkable "
                   id="table_projects_management">
                <thead>
                <tr>
                    {{-- <th>#</th> --}}
                    <th>{{ __('Nombres y Apellidos') }}</th>
                    <th>{{ __('Actuara como') }}</th>
                    <th>{{ __('Categoría') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Departamento de nacimiento') }}</th>
                    <th>{{ __('Ciudad de nacimiento') }}</th>
                    <th>{{ __('Estado') }}</th>
                    <th>{{ __('Acciones') }}</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

@stop

@push('js')
    <script src="/js/storage.js"></script>
    <script src="/backend/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <script src="/backend/assets/demo/custom/crud/datatables/basic/headers.js" type="text/javascript"></script>

    {{-- <script>

        var listStatus = {
            revision: {name: 'En Revisión', color: '#9c9ca5'},
            aprobados: {name: 'Aprobados', color: '#34bfa3'},
            pendientes: {name: 'Pendientes', color: '#ffb822'},
            rechazados: {name: 'Rechazados', color: '#f4516c'},
            aceptados: {name: 'Aceptados', color: '#34bfa3'},
            nuevarevision: {name: 'Nueva Revición', color: '#36a3f7'},
            nosubsanados: {name: 'No Subsanados', color: '#36a3f7'},
        }
        var estado = getStorage('storeTipoProyecto');

        if (estado){
            changedStatusColor(parseInt(estado))
        }
        console.log(estado);
        var storeTipoProyecto = "storeTipoProyecto";
        var tipoProyecto = getStorage(storeTipoProyecto);
        var table = null;
        const loadTable = function () {
            if (table !== null) {
                table.destroy();
            }
            table = $('#table_projects_admin').DataTable({
                "processing": true,
                "serverSide": true,
                "data": null,
                "order": [[0, "desc"]],
                "ajax": {
                    url: "{{route('datatables.projects.admin')}}",
                    data: {
                        tipoProyecto: tipoProyecto
                    }
                },
                "columns": [
                    {
                        "width": "1%",
                        data: 'id',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    },

                    {
                        data: 'artists.users.name',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>',
                        render: function (data, type, JsonResultRow, meta) {
                            // console.log(JsonResultRow,'data t');
                            let artista = JsonResultRow.artists[0];
                            //console.log(JsonResultRow);
                            //if (JsonResultRow.status+"" === 4+""){
                            return `<span target="_blank">${artista.users.name} ${artista.users.last_name} ${artista.users.second_last_name}</span>`;
                            //}
                            //return artista.nickname;
                        }
                    },
                    {
                        "width": "1%",
                        data: 'artists',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>',
                        render: function (data, type, JsonResultRow, meta) {
                            console.log(JsonResultRow,'data t');
                            let artista = JsonResultRow.artists[0];
                            return `<span target="_blank">${artista.person_type.name}</span>`;
                        }
                    },
                    {
                        data: 'title',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    },
                    {
                        data: 'category.category',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    },

                    {
                        "width": "15%",
                        data: 'status',
                        render: function (data) {
                            let info = '<span class="m-badge m-badge--danger m-badge--wide">Hola</span>';
                            switch (parseInt(data)) {
                                case 1:
                                    info = '<span class="m-badge m-badge--brand m-badge--wide" style="background-color:#C4C5D4 !important" >{{ __('revision') }}</span>';
                                    break;
                                case 2:
                                    info = '<span class="m-badge m-badge--brand m-badge--wide" style="background-color:#9C26EA !important;font-size:9px" >{{ __('pre_aprovado') }}</span>';
                                    break;
                                case 3:
                                    info = '<span class="m-badge  m-badge--success m-badge--wide">{{ __('aprovado2') }}</span>';
                                    break;
                                case 4:
                                    info = '<span class="m-badge  m-badge--warning m-badge--wide">Pendiente</span>';
                                    break;
                                case 5:
                                    info = '<span class="m-badge  m-badge--danger m-badge--wide">{{ __('rechazado') }}</span>';
                                    break;
                                case 6:
                                    info = '<span class="m-badge  m-badge--info m-badge--wide">Nueva revisión</span>';
                                    break;
                                case 7:
                                    info = '<span class="m-badge  m-badge--success m-badge--wide">Aceptado</span>';
                                    break;
                            }
                            return '<div class="text-center">' + info + '</div>';
                        }
                    },
                    {
                        render: function (data, type, JsonResultRow, meta) {
                            return '<div class="text-center"><a href="/dashboard/project/' + JsonResultRow.slug + '" class="btn m-btn--pill btn-secondary"><i class="fa fa-eye"></i></a></div>'
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

        $(".selectType").on('click', '.changeType', function () {
            let tipo = parseInt($(this).attr("data-type"));
            if (!(tipo > 0)) {
                tipo = null;
            }
            tipoProyecto = tipo;
            setStorage(storeTipoProyecto, tipoProyecto)
            loadTable();
            console.log(typeof(tipoProyecto))
            changedStatusColor(tipoProyecto)
        });
        function changedStatusColor(status){
            console.log(status)
            console.log(typeof(status));
            switch (status) {
                case 1:
                    $("#current_status").css("background", listStatus.revision.color);
                    $('#current_status').html(listStatus.revision.name)
                    break;
                case 3:
                    $("#current_status").css("background", listStatus.aprobados.color);
                    $('#current_status').html(listStatus.aprobados.name)
                    break;
                case 4:
                    $("#current_status").css("background", listStatus.pendientes.color);
                    $('#current_status').html(listStatus.pendientes.name)
                    break;
                case 5:
                    $("#current_status").css("background", listStatus.rechazados.color);
                    $('#current_status').html(listStatus.rechazados.name)
                    break;
                case 6:
                    $("#current_status").css("background", listStatus.nuevarevision.color);
                    $('#current_status').html(listStatus.nuevarevision.name)
                    break;
                case 7:
                    $("#current_status").css("background", listStatus.aceptados.color);
                    $('#current_status').html(listStatus.aceptados.name)
                    break;
                case 8:
                    $("#current_status").css("background", listStatus.nosubsanados.color);
                    $('#current_status').html(listStatus.nosubsanados.name)
                    break;
                default:
                    console.log('no entro')
            }
        }
        loadTable();
    </script> --}}

    <script>
        var listStatus = {
            revision: {name: 'En Revisión', color: '#9c9ca5'},
            preaprobados: {name: 'Pre Aprobados', color: '#9C26EA'},
            aprobados: {name: 'Aprobados', color: '#34bfa3'},
            pendientes: {name: 'Pendientes', color: '#ffb822'},
            rechazados: {name: 'Rechazados', color: '#f4516c'},
            aceptados: {name: 'Aceptados', color: '#34bfa3'},
            nuevarevision: {name: 'Nueva Revición', color: '#36a3f7'},
            nosubsanados: {name: 'No Subsanados', color: '#36a3f7'},
            registropendiente: {name: 'Registro Pendiente', color: '#ffb822'},
            sinregistroproyecto: {name: 'Sin Proyecto Registrado', color: '#f4516c'},
            todos: {name: 'Todos', color: '#9c9ca5'},
        }
        var estado = getStorage('storeTipoProyecto');

        if (estado) {
            changedStatusColor(parseInt(estado))
        }
        var storeTipoProyecto = "storeTipoProyecto";
        var tipoProyecto = getStorage(storeTipoProyecto);
        var tipoPer = 0;
        var category=0;
        if (tipoProyecto == 11) {
            tipoProyecto = null
        }

        var table = null;

        const loadTable = function () {
            if (table !== null) {
                table.destroy();
            }
            var cont = 0;
            var cat;
            table = $('#table_projects_management').DataTable({
                "processing": true,
                "serverSide": true,
                "scrollX": true,
                "data": null,
                "order": [[0, "asc"]],

                "ajax": {
                    url: "{{route('aspirants.all')}}",
                    data: {
                        tipoProyecto: tipoProyecto,
                        tipoPer:tipoPer,
                        category:category
                    }
                },
                "columns": [

                    {
                        data: 'users.name',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>',

                        render: function (data, type, JsonResultRow, meta) {
                            // console.log(JsonResultRow,'data****');
                            if (JsonResultRow.users.last_name === null) {
                                return '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                            } else {

                                return '<span class="label label-danger text-center">' + JsonResultRow.users.name + '</span>  <span class="label label-danger text-center">' + JsonResultRow.users.last_name + '</span>';
                            }
                            // return '<img src="' + JsonResultRow + '" width="50px"  style="border-radius: 100%;margin-right: auto;margin-left: auto;display: block; width:50px; height:50px"/>';
                        }
                    },
                    {
                        // data: 'person_type.name',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>',

                        render:function(data,type,JsonResultRow, meta){
                            if (JsonResultRow.person_type){
                                return JsonResultRow.person_type.name;
                            }

                        }
                    },
                    {


                        render: function (data, type, JsonResultRow, meta) {
                            var category = "";
                            if (JsonResultRow.projects) {

                                JsonResultRow.projects.map(item => {
                                    category = item;
                                });
                            }

                           cat = category != "" ? `${category.category.category}` : '<span class="label label-danger text-center ml-4" style="color:red !important">Sin categoria</span>'
                           return cat;
                        },




                    },
                    // {
                    //     data: 'document_type.document',
                    //     defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    //     // render: function (data, type, JsonResultRow, meta) {
                    //     //     // console.log(JsonResultRow,'data t');
                    //     //     let artista = JsonResultRow.artists[0];
                    //     //     return `<span target="_blank">${artista.document_type.document}</span>`;
                    //     // }
                    //     // data: 'artists.document_type.document',
                    //     // defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    // },
                    // {
                    //     data: 'identification',
                    //     defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    //     // render: function (data, type, JsonResultRow, meta) {
                    //     //     // console.log(JsonResultRow,'data t');
                    //     //     let artista = JsonResultRow.artists[0];
                    //     //     return `<span target="_blank">${artista.identification}</span>`;
                    //     // }
                    //     // data: 'artista.identification',
                    //     // defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    // },
                    {
                        data:'users.email',
                        render: function (data, type, JsonResultRow, meta) {
                            // console.log(JsonResultRow.users.email,'email');

                            return JsonResultRow.users.email ? '<span class="label label-danger text-center">' + JsonResultRow.users.email + '</span>' : '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>';

                        }
                        // render: function (data, type, JsonResultRow, meta) {
                        //     // console.log(JsonResultRow,'data t');
                        //     let artista = JsonResultRow.artists[0];
                        //     return `<span target="_blank">${artista.users.email}</span>`;
                        // }
                        // data: 'email',
                        // defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    },
                    {
                        data: 'city.departaments.descripcion',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    },
                    {
                        data: 'city.descripcion',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    },

                    {
                        "width": "15%",

                        render: function (data, type, JsonResultRow, meta) {
                            var status = "";

                            if (JsonResultRow.projects) {
                                JsonResultRow.projects.map(item => {
                                    status = item.status;
                                });

                            }

                            let info = '<span class="label label-danger text-center ml-4" style="color:red !important">Sin propuesta</span>';
                            switch (parseInt(status)) {
                                case 1:
                                    info = '<span class="m-badge m-badge--metal m-badge--wide m-badge--rounded">Revisión</span>';
                                    break;
                                case 2:
                                    info = '<span class="m-badge m-badge--brand m-badge--wide" style="background-color:#9C26EA !important;font-size:9px" >{{ __('pre_aprovado') }}</span>';
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
                            return '<div class="text-center">' + info + '</div>';

                        }
                    },
                    {
                        render: function (data, type, JsonResultRow, meta) {
                            var items = "";
                            if (JsonResultRow.projects) {

                                JsonResultRow.projects.map(item => {
                                    items = item;
                                });
                            }

                            return items != "" ? `<div class="text-center"><a href="/dashboard/project/${items.slug}" class="btn m-btn--pill btn-secondary"><i class="fa fa-eye"></i></a></div>` : '<span class="label label-danger text-center ml-4" style="color:red !important">Sin propuesta</span>'
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
                },





            });

        };
        // filtro por categoria
        $('#category_filter').on('change', function(){
            category = $(this).val();
            console.log(category,'catt');
            loadTable();
            // console.log(this.value,'value---');
            // console.log(this.value,'value---');
            //     table.search(this.value).draw();
        });
        // filtro por tipo
        $(".selectType").on('click', '.changeType', function () {
            let tipo = parseInt($(this).attr("data-type"));
            if (!(tipo > 0)) {
                tipo = null;
            }
            tipoProyecto = tipo;
            if (tipoProyecto == null) {
                tipoProyecto = 11
            }
            setStorage(storeTipoProyecto, tipoProyecto)
            if (tipoProyecto == 11) {
                tipoProyecto = null
            }
            loadTable();
            // console.log(typeof (tipoProyecto),'tipoProyecto')
            // console.log(tipo,'tipoProyecto')
            changedStatusColor(tipoProyecto)
            // tipoProyecto = tipo;
            // loadTable();
        });

        $(".tipoPersona").on('change', function () {

            tipoPer = $(this).val();
            console.log(tipoPer);
            loadTable();
        });

        function changedStatusColor(status) {
            if (status == null) {
                status = 11
            }
            console.log(status, 'prueba')
            console.log(typeof (status));
            switch (status) {
                case 1:
                    $("#current_status").css("background", listStatus.revision.color);
                    $('#current_status').html(listStatus.revision.name)
                    break;
                case 2:
                    $("#current_status").css("background", listStatus.preaprobados.color);
                    $('#current_status').html(listStatus.preaprobados.name)
                    break;
                case 3:
                    $("#current_status").css("background", listStatus.aprobados.color);
                    $('#current_status').html(listStatus.aprobados.name)
                    break;
                case 4:
                    $("#current_status").css("background", listStatus.pendientes.color);
                    $('#current_status').html(listStatus.pendientes.name)
                    break;
                case 5:
                    $("#current_status").css("background", listStatus.rechazados.color);
                    $('#current_status').html(listStatus.rechazados.name)
                    break;
                case 6:
                    $("#current_status").css("background", listStatus.nuevarevision.color);
                    $('#current_status').html(listStatus.nuevarevision.name)
                    break;
                case 7:
                    $("#current_status").css("background", listStatus.aceptados.color);
                    $('#current_status').html(listStatus.aceptados.name)
                    break;
                case 8:
                    $("#current_status").css("background", listStatus.nosubsanados.color);
                    $('#current_status').html(listStatus.nosubsanados.name)
                    break;
                case 9:
                    $("#current_status").css("background", listStatus.registropendiente.color);
                    $('#current_status').html(listStatus.registropendiente.name)
                    break;
                case 10:
                    $("#current_status").css("background", listStatus.sinregistroproyecto.color);
                    $('#current_status').html(listStatus.sinregistroproyecto.name)
                    break;
                case 11:
                    $("#current_status").css("background", listStatus.todos.color);
                    $('#current_status').html(listStatus.todos.name)
                    break;

                default:
                    console.log('no entro')
            }
        }

        loadTable();
        // loadTable();
    </script>

<style>
    .m-nav .m-nav__item {
        display: block;
        padding-bottom: 9px;
    }
</style>
@endpush


