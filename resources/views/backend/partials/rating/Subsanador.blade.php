<!-- Acciones para el Admin -->
@if($project->status == 1 || $project->status == 6)
    <div class="col-md-12 mt-5">
        <div class="form-group">
            <h5 style="font-weight: bold">{{ __('Acciones') }}:</h5>
        </div>
        <div class="form-group">
            <form method="post" action="{{ route('project.admin.rejected') }}" class="btn-subsanador" style="display: inline"
                  id="frm_rejected_admin">
                @csrf {{ method_field('PUT') }}
                <button id="btn_rejected_admin" class="btn btn-danger m-btn m-btn--icon">
                        <span>
                            <i class="la la-close"></i>
                            <span>{{ __('No subsanado') }}</span>
                        </span>
                </button>
                <input type="hidden" name="rejected" value="{{ $project->id }}">
            </form>
            <button type="button" data-toggle="modal" data-target="#revision"
                    class="btn-subsanador btn btn-warning m-btn m-btn--icon btn-revision">
            <span style="color: white">
                <i class="la la-exclamation-triangle"></i>
                <span>Enviar a revisión</span>
            </span>
            </button>
            <button type="button" data-toggle="modal" data-target="#revision"
                    class="btn-subsanador btn btn-info m-btn m-btn--icon btn-revision-soporte">
            <span style="color: white">
                <i class="la la-exclamation-triangle"></i>
                <span>Enviar a soporte</span>
            </span>
            </button>
            <button type="button" class="btn-subsanador btn btn-success m-btn m-btn--icon">
                <span><i class="la la-user"></i><span id="btnSendMessage">{{ __('Enviar a curador') }}</span></span>
            </button>
            <input type="hidden" value="" class="valueTipoRevision">
        </div>
    </div>
@endif
@if($project->status == 4)
    <div class="col-md-12 mt-5">
        <div class="form-group">
            <h5 style="font-weight: bold">{{ __('Acciones') }}:</h5>
        </div>
        <div class="form-group">
            <button type="button" data-toggle="modal" data-target="#revision"
                    class="btn-subsanador btn btn-success m-btn m-btn--icon btn-revision-curador-aspirantes">
            <span style="color: white">
                <i class="la la-check"></i>
                <span>Aceptar y enviar mensaje de correción al aspirante</span>
            </span>
            </button>
            <input type="hidden" value="" class="valueTipoRevision">
        </div>
    </div>
@endif
<!-- MODAL REVISIÓN PROJECTO-->
<div class="modal fade" id="revision" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enviar observación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <label style="font-weight: bold" class="col-md-12">Observación:</label>
                <div class="summernote" id="m_summernote_1"></div>
                {{--                <textarea name="mesage" id="mesage" cols="50" rows="10" class="col-md-12" required></textarea>--}}
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <button type="button" class="btn btn-primary"
                        id="btnSendObservation">{{ __('enviar') }}</button>
            </div>
        </div>
    </div>
</div>


@section('table.admin.management')
    <script>
        /*Boton que permite enviar a curador y al aspirante con mensaje de correo*/
        $(".btn-revision-curador-aspirantes").click(function (){
            $('.valueTipoRevision').val(2)
        });
        /*Boton que permite enviar a soporte*/
        $(".btn-revision-soporte").click(function (){
            $('.valueTipoRevision').val(1)
        });
        /*Boton que permite enviar a revisión*/
        $(".btn-revision").click(function (){
            $('.valueTipoRevision').val(0)
        });

    </script>
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
    <script src="/backend/assets/demo/custom/crud/forms/widgets/summernote.js" type="text/javascript"></script>
    <script src="/js/ajax.js"></script>
    <script>
        (function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#btnSendMessage").click(function () {
                swal({
                    title: '¡Atención!',
                    text: "¿ Esta seguro de enviar a Curación ?",
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then(function (result) {
                    console.log(result);
                    if (result.value) {
                        $('#revision').loading({
                            message: 'Enviando...',
                            start: true,
                        });
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
            }

});

            });
        })();
    </script>
    <script>

        (function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#btnSendObservation").click(function () {
                let tipoRevisión = $('.valueTipoRevision').val();
                swal({
                    title: '¡Observación!',
                    // text: "¿Esta seguro de enviar a correción?",
                    text: tipoRevisión == 0 || tipoRevisión == 1 ? '¿Esta seguro de enviar a correción?' : 'Esta seguro de aceptar y enviar mensaje de correción',
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then(function (result) {
                    console.log(result);
                    if (result.value) {
                        $('#revision').loading({
                            message: 'Enviando...',
                            start: true,
                        });

                        if ($('#m_summernote_1').summernote('code') !== '') {
                            const
                                mesage = $('#m_summernote_1').summernote('code'),
                                tipoRevision = $('.valueTipoRevision').val(),
                                token = '{{ csrf_token() }}',
                                url = '{{route("project.admin.revision")}}';

                            let data = {
                                __token: token,
                                observation: mesage,
                                project: {{ $project->id }},
                                tipoRevision: tipoRevision
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
                                $('#revision').loading({
                                    start: false,
                                });
                                swal({
                                    "title": "",
                                    "text": "No se ha enviado el mensaje.",
                                    "type": "error",
                                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                                });
                            };


                            ajax(url, data, success, "post", error, true, "#list_modal_manage");
                        } else {
                            swal({
                                "title": "",
                                "text": "Debe llenar el campo de observación.",
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                            });
                        }
                    }

                });

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
                reverseButtons: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                showCancelButton: true,
            }).then(function (result) {
                if (result.value) {
                    $('body').loading({
                        message: 'Enviando...',
                        start: true,
                    });
                    $('#frm_rejected_admin').submit();
                }
            })
        });
        $('#btn_pendiente_soporte_admin').click(function (e) {
            e.preventDefault();
            swal({
                title: "{{__('porfavor')}}",
                text: "¿Esta seguro de enviar a soporte?",
                icon: "success",
                reverseButtons: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                showCancelButton: true,
            }).then(function (result) {
                if (result.value) {
                    $('body').loading({
                        message: 'Enviando...',
                        start: true,
                    });
                    $('#frm_pendiente_soporte_admin').submit();
                }
            })
        });

    </script>
@endpush
