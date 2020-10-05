<!-- Acciones para el Admin -->
@if($project->status == 1)
    <div class="form-group">
        <h5 style="font-weight: bold">{{ __('asignar_proyecto') }}:</h5>
    </div>
    <div class="form-group">
        <button type="button" data-toggle="modal" data-target="#list_modal_manage"
                class="btn btn-info m-btn m-btn--icon">
        <span>
            <i class="la la-user"></i>
            <span>{{ __('buscar') }}</span>
        </span>
        </button>

        <form method="post" action="{{ route('project.admin.rejected') }}" class="" style="display: inline"
              id="frm_rejected_admin">
            @csrf {{ method_field('PUT') }}
            <button id="btn_rejected_admin" class="btn btn-danger m-btn m-btn--icon">
        <span>
            <i class="la la-close"></i>
            <span>{{ __('rechazar') }}</span>
        </span>
            </button>
            <input type="hidden" name="rejected" value="{{ $project->id }}">
        </form>
    </div>
@else
    <!-- TIEMPO ESTIMADO PARA CALIFICAR-->
    @if(! $project->status == 5)
    <div class="form-group">
        <h5 style="font-weight: bold">{{ __('tiempo_calificar') }}:</h5>
    </div>
    <div class="form-group">
        @if(!$end_time == null)
            <span class="m--font-bold m--font-primary"
                  style="font-weight: bold; font-size: 16px">{{ $end_time->end_time->toFormattedDateString() }}</span>
        @endif
    </div>
    @endif
    @if($project->status == 2)
        <!-- Rating Project -->
        <div class="form-group">
            <h5 style="font-weight: bold">{{ __('calificacion') }}:</h5>
        </div>
        <div class="form-group">
            <ul id="list_rating" class="list-inline" style="font-size: 20px">
                <li class="list-inline-item star" data-number="1"><i
                        class="fa fa-star fa-1x {{$currentRaing>=1?"yellow-rating":""}}"></i></li>
                <li class="list-inline-item star" data-number="2"><i
                        class="fa fa-star fa-1x {{$currentRaing>=2?"yellow-rating":""}}"></i></li>
                <li class="list-inline-item star" data-number="3"><i
                        class="fa fa-star fa-1x {{$currentRaing>=3?"yellow-rating":""}}"></i></li>
                <li class="list-inline-item star" data-number="4"><i
                        class="fa fa-star fa-1x {{$currentRaing>=4?"yellow-rating":""}}"></i></li>
                <li class="list-inline-item star" data-number="5"><i
                        class="fa fa-star fa-1x {{$currentRaing==5?"yellow-rating":""}}"></i></li>
            </ul>
        </div>
    @endif
    <!-- VER A QUIEN SE ASIGNO EL PROYECTO-->
    @if($project->status !== 1 && $asignado !== 0)
        <div class="form-group">
            <h5 style="font-weight: bold">{{ __('asignado_a') }}:</h5>
        </div>
        <div class="form-group">
            <button type="button" id="mostrar_managements_asignados" class="btn btn-danger m-btn m-btn--icon">
        <span>
            <i class="la la-users"></i>
            <span>{{ __('mostrar') }}</span>
        </span>
            </button>

        </div>
    @endif
@endif


<!-- MODAL, BUSCAR MANAGEMENT-->
<div class="modal fade" id="list_modal_manage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('management') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_managements">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>{{ __('management') }}</th>
                        <th>Email</th>
                        <th>{{ __('intereses') }}</th>

                    </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSendMessage">{{ __('enviar') }}</button>
            </div>
        </div>
    </div>
</div>

@section('table.admin.management')
    <script>
        let usuarios = [];
        var DatatablesBasicBasic = function () {
            var initTable1 = function () {
                var table = $('#m_table_managements');

                // begin first table
                table.DataTable({
                    responsive: true,

                    lengthMenu: [5, 10, 25, 50],

                    pageLength: 5,


                    //== Order settings
                    order: [[1, 'asc']],

                    headerCallback: function (thead, data, start, end, display) {
                        thead.getElementsByTagName('th')[0].innerHTML = `
                    <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">
                        <input type="checkbox" value="" class="m-group-checkable">
                        <span></span>
                    </label>`;
                    },
                    searching: true,
                    processing: true,
                    serverSide: true,
                    data: null,
                    ajax: "{{route('datatables.management.admin')}}",
                    columns: [
                        {
                            targets: 0,
                            width: '30px',
                            className: 'dt-right',
                            orderable: false,
                            render: function (data, type, full, meta) {
                                console.log(full);
                                return `
                        <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">
                            <input type="checkbox" data-value='${JSON.stringify({
                                    id: full.id,
                                    user_id: full.user_id,
                                    email: full.users.email
                                })}' class="m-checkable ckeck-${full.id}">
                            <span></span>
                        </label>`;
                            },
                        },
                        {
                            data: 'users.name',
                            defaultContent: '<span class="label label-danger text-center">Ningún valor por defecto</span>'
                        },
                        {
                            data: 'users.email',
                            render: function (data, type, JsonResultRow, meta) {
                                return '<a class="m-link--primary" href="mailto:' + JsonResultRow.users.email + '">' + JsonResultRow.users.email + '</a>'

                            }
                        },
                        {
                            defaultContent: '<span class="label label-danger text-center">Ningún valor por defecto</span>',
                            render: function (data, type, JsonResultRow, meta) {
                                let categorias = JsonResultRow.categories;
                                let categoriasNombre = '';
                                categorias.forEach(function (categoria) {
                                    if (categoriasNombre !== '') {
                                        categoriasNombre += ', ';
                                    }
                                    categoriasNombre += categoria.category;
                                });
                                return categoriasNombre;
                            }
                        },

                    ],
                    "language": {
                        "sProcessing": "{{__('procesando')}}",
                        "sLengthMenu": " _MENU_ {{__('registros')}}",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "{{__('mostrando_registros')}} _START_ {{__('from')}} _END_ {{__('total_de')}} _TOTAL_ {{__('registros')}}",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "{{__('siguiente')}}",
                            "sPrevious": "{{__('anterior') }}"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    },
                    "drawCallback": function () {
                        for (let i = 0; i < usuarios.length; i++) {
                            let check = $(".ckeck-" + usuarios[i].id);
                            if (check && !check.is(":checked")) {
                                check.click();
                            }
                        }
                    }
                });

                table.on('change', '.m-group-checkable', function () {
                    var set = $(this).closest('table').find('td:first-child .m-checkable');
                    var checked = $(this).is(':checked');
                    $(set).each(function () {
                        if (checked) {
                            $(this).prop('checked', true);
                            $(this).closest('tr').removeClass('active')
                                .find(".m-checkbox").change();
                        } else {
                            $(this).prop('checked', false);
                            $(this).closest('tr').addClass('active')
                                .find(".m-checkbox").change();
                        }
                    });
                });

                table.on('change', 'tbody tr .m-checkbox', function () {
                    $(this).parents('tr').toggleClass('active');
                    let user = JSON.parse($(this).find(".m-checkable").attr("data-value"));
                    if ($(this).parents('tr').hasClass("active")) {
                        let index = usuarios.findIndex(function (u) {
                            return u.id === user.id;
                        });
                        if (index === -1) {
                            usuarios.push(user);
                        }
                    } else {
                        let index = usuarios.findIndex(function (u) {
                            return u.id === user.id;
                        });
                        usuarios.splice(index, 1);
                    }
                });
            };

            return {
                //main function to initiate the module
                init: function () {
                    initTable1();
                },

            };

        }();

        jQuery(document).ready(function () {
            DatatablesBasicBasic.init();
        });
    </script>
@endsection

@push('js')
    <script src="/js/ajax.js"></script>
    <script>
        (function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#btnSendMessage").click(function () {
                const
                    token = '{{ csrf_token() }}',
                    url = '{{route("send.project.admin")}}';
                let data = {
                    __token: token,
                    users: usuarios,
                    project: {{ $project->id }}
                };
                const success = function (r) {
                    console.log(r);
                    if (r.status === 200) {
                        swal({
                            "title": "",
                            "text": r.msg,
                            "type": "success",
                            "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                        }).then((result) => {
                            document.location.reload();
                        });
                    }
                };
                const error = function (e) {
                    swal({
                        "title": "",
                        "text": "No se ha enviado el mensaje.",
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                    });
                };


                ajax(url, data, success, "post", error, true, "#list_modal_manage");
            });
        })();
    </script>
    <script>
        $('#btn_rejected_admin').click(function (e) {
            e.preventDefault();
            swal({
                title: "{{__('porfavor')}}",
                text: "{{ __('esta_seguro_rechazar') }}",
                icon: "success",

                confirmButtonText: "<span><i class='la la-thumbs-o-up'></i><span>{{ __('si') }}</span></span>",
                confirmButtonClass: "btn btn-danger m-btn m-btn--pill m-btn--air m-btn--icon",

                showCancelButton: true,
                cancelButtonText: "<span><i class='la la-thumbs-down'></i><span>{{ __('cancelar') }}</span></span>",
                cancelButtonClass: "btn btn-secondary m-btn m-btn--pill m-btn--icon"
            }).then(function (result) {
                if (result.value) {
                    $('#frm_rejected_admin').submit();
                }
            })
        });
    </script>
@endpush
