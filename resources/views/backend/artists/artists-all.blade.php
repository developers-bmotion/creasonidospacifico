@extends('backend.layout')
<!--=====================================
   HEADER
======================================-->
@section('header')
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">{{ __('artistas') }}</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon flaticon-user-ok"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">{{ __('artistas') }}</span>
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
        {{-- <div>
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
        </div> --}}
    </div>
@stop
<!--=====================================
CONTENIDO DEL MODULO PROYECTOS ADMIN
======================================-->
@section('content')
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('todos_artistas') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">

                        <li class="m-portlet__nav-item"></li>
                        {{-- <div class="m-dropdown m-dropdown--inline  m-dropdown--arrow m-dropdown--align-right"
                             m-dropdown-toggle="hover">
                            <a href="#" class="m-dropdown__toggle btn btn-warning dropdown-toggle">
                                <span>
                                    <i class="la la-filter"></i>
                                    <span>{{ __('filtrar') }}</span>
                                </span>

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
                                                    <span class="changeType w-100 btn btn-outline-info m-btn m-btn--pill m-btn--wide btn-sm" data-type="{{\App\Project::PUBLISHED}}">{{ __('publicado') }}</span>
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
                        </div> --}}
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <table class="table table-striped- table-bordered table-hover table-checkable"
                       id="table_artists">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Artista</th>
                        <th>Nombres</th>
                        <th>Nombre Artistico</th>
                        <th>Nivel</th>
                        <th>Email</th>
                        <th>Genero</th>
                        <th>Nacionalidad</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>

        var DatatablesExtensionsScroller = function() {

            var initTable1 = function() {
                var table = $('#table_artists');

                // begin first table
                table.DataTable({
                    "processing": true,
                    "serverSide": true,
                    "data": null,
                    "order": [[ 0, "desc" ]],
                    "responsive": true,
                    "ajax": {
                        url: "{{ route('all.artists.table') }}",

                    },
                    "columns": [

                        {
                            data: 'id',
                            defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                        },
                        {
                            render: function (data, type, JsonResultRow, meta) {
                                return '<img src="' + JsonResultRow.users.picture + '" width="50px"  style="border-radius: 100%;margin-right: auto;margin-left: auto;display: block; width:50px; height:50px"/>';
                            }
                        },
                        {
                            data: 'users.name',
                            defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                        },
                        {
                            data: 'nickname',
                            defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                        },
                        {
                            data: 'levels.level',
                            defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                            // data: 'ganancias',
                            // defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                        },
                        {
                            data: 'users.email',
                            defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                        },
                        {
                            data: 'nickname',
                            defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                        },
                        {
                            data: 'countries.country',
                            defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                        },
                    ],
                    "columnDefs": [
                        {
                            targets: -1,
                            title: 'Actions',
                            orderable: false,
                            render: function(data, type, full, meta) {
                                return `
                       
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
                            },
                        },
                        {
                            "targets": 8,
                            render: function(data, type, full, meta) {
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
                init: function() {
                    initTable1();
                },

            };

        }();

        jQuery(document).ready(function() {
            DatatablesExtensionsScroller.init();
        });

    </script>
     {{-- <span class="dropdown">
        <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">
          <i class="la la-ellipsis-h"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
            <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
            <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
        </div>
    </span> --}}
@endpush
