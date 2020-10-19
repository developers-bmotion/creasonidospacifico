@extends('backend.layout')
<!--=====================================
   HEADER
======================================-->
@section('header')
<div class="d-flex align-items-center">
    <div class="mr-auto">
        <h1 class="m-subheader__title--separator">Listado de aspirantes registrados</h1>
    </div>
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

                </div>
            </div>
            <div class="m-portlet__body">
                <table class="table table-striped- table-bordered table-hover table-checkable"
                       id="table_artists">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Aspirante</th>
                        <th>Email</th>
                        <th>N° documento</th>
                        <th>Actura Como</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        {{-- @dd($listAspirant) --}}
    </div>
@stop

@push('js')
    <script>
       var DatatablesExtensionsScroller = function() {
            var initTable1 = function() {
                var table = $('#table_artists');
                var cont=1;

                // begin first table
                table.DataTable({
                    "processing": true,
                    "serverSide": true,
                    "data": null,
                    "order": [[ 0, "asc" ]],
                    "responsive": true,
                    "ajax": {
                        url: "{{ route('artists.manager.table') }}",

                    },
                    "columns": [

                        {
                            render: function () {
                                return cont++;
                            }

                        },
                        {
                            render: function (data, type, JsonResultRow, meta) {
                                return '<span class="label label-danger text-center">'+JsonResultRow.users.name+'</span>  <span class="label label-danger text-center">'+JsonResultRow.users.last_name+'</span>';
                                // return '<img src="' + JsonResultRow + '" width="50px"  style="border-radius: 100%;margin-right: auto;margin-left: auto;display: block; width:50px; height:50px"/>';
                            }
                        },
                        {
                            render: function (data, type, JsonResultRow, meta) {
                                // console.log(JsonResultRow.users.email,'email');

                             return JsonResultRow.users.email?  '<span class="label label-danger text-center">'+JsonResultRow.users.email+'</span>':'<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>';

                            }

                            // defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                        },
                        {
                            data: 'identification',
                            defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                        },
                        {
                            data: 'person_type.name',
                            defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                            // data: 'ganancias',
                            // defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                        },
                        {
                        render: function (data, type, JsonResultRow, meta) {
                            // console.log(JSON.stringify(JsonResultRow.projects.slug),'json');
                            var items="";
                            JsonResultRow.projects.map(item => {
                                // console.log(item,'item');
                                items=item;
                            });
                                return items != ""? `<div class="text-center"><a href="/dashboard/project/${ items.slug }" class="btn m-btn--pill btn-secondary"><i class="fa fa-eye"></i></a></div>` : '<span class="label label-danger text-center ml-4" style="color:red !important">N/A</span>'
                            // return '<div class="text-center"><a href="/dashboard/project/' + JsonResultRow.projects.slug + '" class="btn m-btn--pill btn-secondary"><i class="fa fa-eye"></i></a></div>'
                        }
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
                            "targets": 5,
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
@endpush
