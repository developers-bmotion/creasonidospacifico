@extends('backend.layout')
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
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('proyectos') }}
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
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
                        </div>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <table class="table table-striped- table-bordered table-hover table-checkable"
                       id="table_projects_management">
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
@stop

@push('js')
    <script src="/backend/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <script src="/backend/assets/demo/custom/crud/datatables/basic/headers.js" type="text/javascript"></script>

    <script>
        var tipoProyecto = null;
        var table = null;
        const loadTable = function (){
            if (table !== null){
                table.destroy();
            }
            table = $('#table_projects_management').DataTable({
                "processing": true,
                "serverSide": true,
                "data": null,
                "order": [[ 0, "desc" ]],
                "ajax": {
                    url: "{{route('datatables.projects.manage')}}",
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
                        data: 'artists.nickname',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>',
                        render : function (data, type, JsonResultRow, meta){
                            return JsonResultRow.artists[0].nickname;
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

                    {"width": "15%",
                        data: 'status',
                        render:function (data) {
                            let info = '<span class="m-badge m-badge--danger m-badge--wide">Hola</span>';
                            switch(parseInt(data)){
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

@endpush
