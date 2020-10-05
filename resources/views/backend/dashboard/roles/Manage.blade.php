@push('css')
    <link rel="stylesheet" href="/backend/admin/css/dashboard.css">
@endpush
<div class="m-content">
    <!--Begin::Section-->
    <div class="m-portlet ">
        <div class="m-portlet__body  m-portlet__body--no-padding">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('numero_proyectos_registrados') }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <!--begin::Total Profit-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{ __('proyec_pre_aprobados') }}
                            </h4><br>
                            <span class="m-widget24__desc">
												</span>
                            <span class="m-widget24__stats m--font-brand">
                                           {{ $pre_approved }}
                                        
												</span>
                            <div class="m--space-10"></div>
                            {{-- <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-brand" role="progressbar" style="width: 78%;"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> --}}
                        </div>
                    </div>
                    <!--end::Total Profit-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <!--begin::New Feedbacks-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{ __('publicados') }}
                            </h4><br>
                            <span class="m-widget24__desc">
												</span>
                            <span class="m-widget24__stats m--font-info">
                                {{ $published }}
												</span>
                            <div class="m--space-10"></div>
                            {{-- <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-info" role="progressbar" style="width: 84%;"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> --}}
                        </div>
                    </div>
                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <!--begin::New Orders-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{ __('rechazados') }}
                            </h4><br>
                            <span class="m-widget24__desc">
												</span>
                            <span class="m-widget24__stats m--font-danger">
                                {{ $rejected }}
												</span>
                            <div class="m--space-10"></div>
                            {{-- <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-danger" role="progressbar" style="width: 69%;"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> --}}

                        </div>
                    </div>
                    <!--end::New Orders-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <!--begin::New Users-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{ __('aprovado') }}
                            </h4><br>
                            <span class="m-widget24__desc">
												</span>
                            <span class="m-widget24__stats m--font-success">
                                {{ $approved }}
												</span>
                            <div class="m--space-10"></div>
                            {{-- <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-success" role="progressbar" style="width: 90%;"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> --}}
                            <span class="m-widget24__change">

                            </span>
                            <span class="m-widget24__number">

                            </span>
                        </div>
                    </div>
                    <!--end::New Users-->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-md-12 col-lg-6 col-xl-8">
                    <div class="m-portlet ">
                            <div class="m-portlet m-portlet--full-height ">
                                    <div class="m-portlet__head">
                                            <div class="m-portlet__head-caption">
                                                    <div class="m-portlet__head-title">
                                                            <a class="m-link m--font-success m--font-bolder" href=""
                                                            style="padding-bottom: 5px;cursor: pointer;font-size: 15px">{{ __('mis_proyectos') }}
                                                         </a>
          
        
           
               
                   
                        
                            
                                
                                <h3 class="m-portlet__head-text">

                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                                <div class="m-portlet__head-tools">
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
                </div>
            </div>
        </div>
        <div class="col-xl-4 m-portlet--full-height">
            <!--begin:: Widgets/New Users-->
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                <a class="m-link m--font-success m--font-bolder" href="{{route('index.artists')}}"
                                   style="padding-bottom: 5px;cursor: pointer;font-size: 15px">{{ __('nuevos_artistas') }}
                                </a>

                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_widget4_tab1_content">

                            <div class="m-widget4">

                                @forelse($last_artists as $last_artist)
                                <div class="m-widget4__item">
                                    <div class="m-widget4__img m-widget4__img--pic">
                                        @if(Storage::disk('public')->exists('users/'.$last_artist->users->picture))
                                        <img src="{{ $last_artist->users->pathAttachment()}}" alt="">
                                            @else
                                            <img src="{{ $last_artist->users->picture}}" alt="">
                                        @endif
                                    </div>
                                    <div class="m-widget4__info">
                                        @if($last_artist->nickname == null)
															<span class="m-widget4__title">
                                                                {{ $last_artist->users->name }} {{ $last_artist->users->last_name }}
															</span><br>
                                        @else
                                            <span class="m-widget4__title">
                                                                {{ $last_artist->nickname }}
															</span><br>
                                        @endif

                                        <span class="m-widget4__sub">
                                             @if($last_artist->countries != null)
                                                <img data-toggle="tooltip" title="{{ $last_artist->countries->country }}"
                                                     src="{{ $last_artist->countries->flag }}" width="21" alt="" style="">
                                                {{ $last_artist->countries->country }}
                                            @endif

                                        </span>
                                    </div>
                                    <div class="m-widget4__ext">
                                        <a href="#"
                                           class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">Info</a>
                                    </div>
                                </div>
                                    @empty
                                    <div class="alert m-alert--default text-center">
                                        <strong>{{ __('ningun_proyect_estado') }}</strong>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafica de ultimos proyectos -->
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text m-link m--font-success m--font-bolder">
                                {{__("title_top_country_char")}}
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <!--
                        <div class='input-group pull-right' id='date_chart_new_projects'>
                            <input type='text' class="form-control m-input" readonly placeholder="Select date range" />
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                            </div>
                        </div>
                    -->
                    </div>
                </div>
                <div class="m-portlet__body" id="contenedorTopCountry">
                    <div id="char_top_country" style="height: 300px;"></div>
                    <p class="alert m-alert--default text-center top__country--text">{{__("no_data_chart")}}</p>
                </div>
            </div>
        </div>

    </div>
</div>

@push('js')
    <script>
    // setUrl("proyectosNuevos", "{{ route("admin.projects_news") }}");
    // setUrl("topCountry", "{{ route("admin.top_country") }}");
    // setText("proyectosRevision", "{{ __("proyectos_en_revicion_chart")}}");
    </script>
    {{-- <script src="/backend/assets/vendors/custom/flot/flot.bundle.min.js"></script>
    <script src="/js/storage.js"></script>
    <script src="/js/ajax.js"></script>
    <script src="/js/daterangepicker.js"></script>
    <script src="/backend/admin/js/dashboard.js"></script> --}}

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
