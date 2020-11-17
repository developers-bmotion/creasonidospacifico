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
                            <ul class="nav my-scroll-nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary"
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
                                            <table
                                                class="table table-striped- table-bordered table-hover table-checkable"
                                                id="table__profile_projects_management">
                                                <thead>
                                                <tr>
                                                    <th>{{ __('Canción') }}</th>
                                                    <th>{{ __('Modalidad') }}</th>
                                                    <th>{{ __('Estado') }}</th>
                                                    <th>{{ __('Acciones') }}</th>
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

    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal2" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title tileProjectQualifie" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bodyAppendAudio">
                    {{--                    <audio class="audioProject" preload="auto" controls>--}}
                    {{--                                                 <source class="srcAudio" >--}}

                    {{--                    </audio>--}}

                    <input type="hidden" class="idProject" value="" name="idProject">
                    <div class="sliderCalificadorUno">
                        <!--=====================================
                            SLIDER CRITERIO # 1
                        ======================================-->
                        <div class="form-group m-form__group row" style="padding-top: 2rem">
                            <label class="col-form-label col-lg-3 col-sm-12">Aspectos técnicos musicales: <span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-md-12 col-sm-12">
                                <div class="row align-items-center" style="margin-bottom: 1rem">
                                    <div class="col-2">
                                        <input type="text" required class="form-control my-form-control"
                                               name="criterio_1" id="criterio_1_input"
                                               placeholder="Quantity">
                                    </div>
                                    <div class="col-10">
                                        <div id="criterio_1" class="m-nouislider--drag-danger"></div>
                                    </div>
                                </div>
                                <span class="m-form__help" style="margin-top: 5rem">afinación, ritmo, fraseo, tiempo - dinámica, equilibrio sonoro, dicción y articulación.</span>
                            </div>
                        </div>
                        <hr>
                        <!--=====================================
                            SLIDER CRITERIO # 2
                        ======================================-->
                        <div class="form-group m-form__group row" style="padding-top: 2rem">
                            <label class="col-form-label col-lg-3 col-sm-12">Aporte creativo:<span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-md-12 col-sm-12">
                                <div class="row align-items-center" style="margin-bottom: 1rem">
                                    <div class="col-2">
                                        <input type="text" required class="form-control my-form-control"
                                               name="criterio_2" id="criterio_2_input"
                                               placeholder="Quantity">
                                    </div>
                                    <div class="col-10">
                                        <div id="criterio_2" class="m-nouislider--drag-danger"></div>
                                    </div>
                                </div>
                                <span class="m-form__help" style="margin-top: 5rem"> realización vocal e instrumental. Originalidad, y fidelidad a las formas y estilos tradicionales, cuando sea aplicable al contexto.</span>
                            </div>
                        </div>
                        <!--=====================================
                            SLIDER CRITERIO # 3
                        ======================================-->

                        <div class="form-group m-form__group row" style="padding-top: 2rem">
                            <label class="col-form-label col-lg-3 col-sm-12">Calidad interpretativa:<span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-md-12 col-sm-12">
                                <div class="row align-items-center" style="margin-bottom: 1rem">
                                    <div class="col-2">
                                        <input type="text" required class="form-control my-form-control"
                                               name="criterio_3" id="criterio_3_input"
                                               placeholder="Quantity">
                                    </div>
                                    <div class="col-10">
                                        <div id="criterio_3" class="m-nouislider--drag-danger"></div>
                                    </div>
                                </div>
                                <span class="m-form__help"
                                      style="margin-top: 5rem">comunicación, proyección, dicción.</span>
                            </div>
                        </div>
                        <!--=====================================
                            SLIDER CRITERIO # 4
                        ======================================-->

                        <div class="form-group m-form__group row" style="padding-top: 2rem">
                            <label class="col-form-label col-lg-3 col-sm-12">Calidad del repertorio escogido:<span class="text-danger">*</span></label>
                            <div class="col-lg-9 col-md-12 col-sm-12">
                                <div class="row align-items-center" style="margin-bottom: 1rem">
                                    <div class="col-2">
                                        <input type="text" required class="form-control my-form-control"
                                               name="criterio_4" id="criterio_4_input"
                                               placeholder="Quantity">
                                    </div>
                                    <div class="col-10">
                                        <div id="criterio_4" class="m-nouislider--drag-danger"></div>
                                    </div>
                                </div>
                                <span class="m-form__help" style="margin-top: 5rem">selección de la obra con relación a la diversidad de ritmos, tonalidades y formas.</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group m-form__group" style="padding-top: 2rem">
                                <label class="col-form-label">Comentario:<span class="text-danger">*</span></label>
                                <div class="summernote" id="m_summernote_1"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-send-rating" id="btnSeendReview">Enviar
                        calificación
                    </button>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>

        $(document).ready(function () {

            $('.btn-send-rating').click(function () {

                $('#frm_qualification').submit();


            });

            $(document).on('click', '.btnOpenProject', function () {
                $(".audioProject").show();
                let title = $(this).attr('titleProject');
                let audioProject = $(this).attr('audioProject');
                let idProject = $(this).attr('idProject');

                $(".tileProjectQualifie").text(title);
                $(".idProject").val(idProject);


                let audioHtml = `
                   <audio src="${audioProject}" class="audioProject" controls> este es un elemento de audio no soportado por tu navegador, prueba con otro </audio> `;
                $(audioHtml).insertBefore(".sliderCalificadorUno");

                $('#modal2').on('hidden.bs.modal', function (e) {
                    $(".audioProject").remove();
                })
            });

            // $(".btnOpenProject").on('click','id',function () {
            //     alert('Nata hagamolo otra vez')
            //     let title = $(this).attr('titleProject');
            //     let audioProject = $(this).attr('audioProject');
            //     console.log(audioProject);
            //     $(".tileProjectQualifie").text(title);
            //     $('.audioProject').attr('src', audioProject);

//                 let audioHtml = `
//                     <audio class="audioProject" preload="auto" controls>
//                         <source class="srcAudio" src="${audioProject}">
//                     </audio>
// `
//                 // $(".bodyAppendAudio").append(audioHtml);
            //     $(audioHtml).insertBefore(".sliderCalificadorUno");

            // $('#modal2').on('hidden.bs.modal', function (e) {
            //     $(".audioProject").remove();
            // })
            // });

            // init slider

            /*=============================================
            CRITERIO # 1
            =============================================*/
            var slider1 = document.getElementById('criterio_1');

            noUiSlider.create(slider1, {
                start: [0],
                step: 1,
                range: {
                    'min': [0],
                    'max': [35]
                },
                format: wNumb({
                    decimals: 0
                })
            });

            // init slider input
            var sliderInput = document.getElementById('criterio_1_input');

            slider1.noUiSlider.on('update', function (values, handle) {
                sliderInput.value = values[handle];
            });

            sliderInput.addEventListener('change', function () {
                slider1.noUiSlider.set(this.value);
            });


            sliderInput.addEventListener('change', function () {
                slider1.noUiSlider.set(this.value);
            });

            /*=============================================
            CRITERIO # 2
            =============================================*/
            var slider2 = document.getElementById('criterio_2');

            noUiSlider.create(slider2, {
                start: [0],
                step: 1,
                range: {
                    'min': [0],
                    'max': [30]
                },
                format: wNumb({
                    decimals: 0
                })
            });

            // init slider input
            var sliderInput2 = document.getElementById('criterio_2_input');

            slider2.noUiSlider.on('update', function (values, handle) {
                sliderInput2.value = values[handle];
            });

            sliderInput2.addEventListener('change', function () {
                slider2.noUiSlider.set(this.value);
            });


            sliderInput2.addEventListener('change', function () {
                slider2.noUiSlider.set(this.value);
            });
            /*=============================================
            CRITERIO # 3
            =============================================*/
            var slider3 = document.getElementById('criterio_3');

            noUiSlider.create(slider3, {
                start: [0],
                step: 1,
                range: {
                    'min': [0],
                    'max': [25]
                },
                format: wNumb({
                    decimals: 0
                })
            });

            // init slider input
            var sliderInput3 = document.getElementById('criterio_3_input');

            slider3.noUiSlider.on('update', function (values, handle) {
                sliderInput3.value = values[handle];
            });

            sliderInput3.addEventListener('change', function () {
                slider3.noUiSlider.set(this.value);
            });


            sliderInput3.addEventListener('change', function () {
                slider3.noUiSlider.set(this.value);
            });
            /*=============================================
            CRITERIO # 4
            =============================================*/
            var slider4 = document.getElementById('criterio_4');

            noUiSlider.create(slider4, {
                start: [0],
                step: 1,
                range: {
                    'min': [0],
                    'max': [10]
                },
                format: wNumb({
                    decimals: 0
                })
            });

            // init slider input
            var sliderInput4 = document.getElementById('criterio_4_input');

            slider4.noUiSlider.on('update', function (values, handle) {
                sliderInput4.value = values[handle];
            });

            sliderInput4.addEventListener('change', function () {
                slider4.noUiSlider.set(this.value);
            });


            sliderInput4.addEventListener('change', function () {
                slider4.noUiSlider.set(this.value);
            });
        });

    </script>
    <script>
        var tipoProyecto = null;
        var table = null;
        const loadTable = function () {
            if (table !== null) {
                table.destroy();
            }
            table = $('#table__profile_projects_management').DataTable({
                "processing": true,
                "serverSide": true,
                "data": null,
                "order": [[0, "desc"]],
                "pagginType": "simple_numbers",
                "ajax": {
                    url: "{{route('datatables.projects.profile.manage')}}",
                    data: {
                        tipoProyecto: tipoProyecto,
                        id_user: {{ $user->id }}
                    }
                },
                "columns": [

                    {
                        data: 'title',
                        defaultContent: '<span class="label label-danger text-center">Ningún valor por defecto</span>'
                    },
                    {
                        data: 'category.category',
                        defaultContent: '<span class="label label-danger text-center">Ningún valor por defecto</span>'
                    },
                    {
                        "width": "15%",
                        data: 'status',
                        render: function (data) {
                            let info = '<span class="m-badge m-badge--danger m-badge--wide">N/A</span>';
                            switch (parseInt(data)) {
                                case 1:
                                    info = '<span class="m-badge m-badge--brand m-badge--wide" style="background-color:#C4C5D4 !important" >{{ __('Revision') }}</span>';
                                    break;
                                case 2:
                                    info = '<span class="m-badge m-badge--brand m-badge--wide" style="background-color:#9C26EA !important;font-size:7px" >{{ __('Calificado') }}</span>';
                                    break;
                                case 3:
                                    info = '<span class="m-badge  m-badge--success m-badge--wide">{{ __('Aprobado') }}</span>';
                                    break;
                                case 4:
                                    info = '<span class="m-badge  m-badge--warning m-badge--wide">{{ __('Pendiente') }}</span>';
                                    break;
                                case 5:
                                    info = '<span class="m-badge  m-badge--danger m-badge--wide">{{ __('Rechazado') }}</span>';
                                    break;
                                case 6:
                                    info = '<span class="m-badge  m-badge--info m-badge--wide">{{ __('Nueva revisión') }}</span>';
                                    break;
                                case 7:
                                    info = '<span class="m-badge  m-badge--brand m-badge--wide">{{ __('Aceptado') }}</span>';
                                    break;
                                case 8:
                                    info = '<span class="m-badge  m-badge--danger m-badge--wide">{{ __('No subsanado') }}</span>';
                                    break;
                                case 9:
                                    info = '<span class="m-badge  m-badge--danger m-badge--wide">{{ __('Registro pendiente') }}</span>';
                                    break;
                                case 10:
                                    info = '<span class="m-badge  m-badge--danger m-badge--wide">{{ __('Sin propuesta') }}</span>';
                                    break;
                            }
                            return '<div class="text-center">' + info + '</div>';
                        }
                    },
                    {


                        render: function (data, type, JsonResultRow, meta) {
                            // {{-- modal calificacion --}}
                            console.log(JsonResultRow);


                            return `
<span  type="button"  id="id" class="btnOpenProject btn m-btn--pill btn-secondary text-center" idProject="${JsonResultRow.id}" audioProject="${JsonResultRow.audio}" titleProject="${JsonResultRow.title}"  data-toggle="modal" data-target="#modal2"><i data-toggle="tooltip" data-placement="top" title="Calificar propuesta musical" class="fa fa-check"></i></span>
<span  type="button"  id="" class="btnHistorialReview btn m-btn--pill btn-secondary text-center" idProject="${JsonResultRow.id}" titleProject="${JsonResultRow.title}"  data-toggle="modal" data-target="#historial"><i data-toggle="tooltip" data-placement="top" title="Ver historial de calificación" class="fa fa-eye"></i></span>
`;


                        }
                    },
                ],
                "language": {
                    "sProcessing": "{{__('procesando')}}",
                    "sLengthMenu": "{{__('mostrar')}} _MENU_ {{__('registros')}}",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "{{__('nigun_dato_tabla')}}",
                    "sInfo": "{{__('mostrando_registros') }} _START_ {{__('al')}} _END_ {{__('total_de')}} _TOTAL_ {{__('registros')}}",
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
                        "sNext": ">",
                        "sPrevious": "<"
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
    <script src="/backend/assets/demo/custom/crud/forms/widgets/summernote.js" type="text/javascript"></script>
    <script src="/js/ajax.js"></script>
    <script>

        (function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#btnSeendReview").click(function () {
                //
                swal({
                    title: '¡Atención!',
                    text: "¿Esta seguro de enviar calificación?",
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then(function (result) {
                    if (result.value) {
                        $('body').loading({
                            message: 'Enviando...',
                            start: true,
                        });

                        if ($('#m_summernote_1').summernote('code') !== '') {
                            const
                                mesage = $('#m_summernote_1').summernote('code'),
                                cristerio1 = $('#criterio_1_input').val(),
                                cristerio2 = $('#criterio_2_input').val(),
                                cristerio3 = $('#criterio_3_input').val(),
                                cristerio4 = $('#criterio_3_input').val(),
                                idProject = $('.idProject').val(),
                                token = '{{ csrf_token() }}',
                                url = '{{ route('add.review') }}';

                            let data = {
                                __token: token,
                                comment: mesage,
                                idProject: idProject,
                                criterio_1:cristerio1,
                                criterio_2:cristerio2,
                                criterio_3:cristerio3,
                                criterio_4:cristerio4,
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
                                $('body').loading({
                                    start: false,
                                });
                                swal({
                                    "title": "",
                                    "text": "No se ha enviado su calificación.",
                                    "type": "error",
                                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                                });
                            };


                            ajax(url, data, success, "post", error, true, "#list_modal_manage");
                            /*$('body').loading({
                                start: false,
                            });*/
                        } else {
                            swal({
                                "title": "",
                                "text": "Sra/Sr Curador, debe agregar un comentario.",
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                            });
                        }
                    }

                });

            });
        })();
    </script>
@endpush

