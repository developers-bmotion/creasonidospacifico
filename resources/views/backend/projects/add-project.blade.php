@extends('backend.layout') @push('css')
{{--    <style>--}}
{{--        .m-wizard.m-wizard--4 .m-wizard__head .m-wizard__nav .m-wizard__steps .m-wizard__step .m-wizard__step-info .m-wizard__step-label {--}}
{{--            padding-left: 1rem;--}}
{{--        }--}}
{{--    </style>--}}

@endpush
@section('header')
{{--    @if($errors->any())--}}

{{--    <ul class="list-group">--}}

{{--        @foreach($errors->all() as $error)--}}
{{--            <div class="alert alert-danger" role="alert">--}}
{{--                <strong>Error!</strong> {{$error}}--}}
{{--            </div>--}}
{{--        @endforeach--}}

{{--    </ul>--}}

{{--@endif--}}

<div class="d-flex align-items-center">
    <div class="mr-auto">
        <h3 class="m-subheader__title m-subheader__title--separator">Subir canción</h3>
        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
            <li class="m-nav__item m-nav__item--home">
                <a href="#" class="m-nav__link m-nav__link--icon">
                    <i class="m-nav__link-icon la la-plus-circle"></i>
                </a>
            </li>
            <li class="m-nav__separator">-</li>
            <li class="m-nav__item">
                <a href="" class="m-nav__link">
                    <span class="m-nav__link-text">Subir canción</span>
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
    <!-- END: Subheader -->

    <div class="m-content">
        <br>
        @if(count(\App\Artist::projects_artist(auth()->user()->id)) === 0)
                    <div class="m-alert m-alert--icon m-alert--outline alert alert-warning" role="alert">
                        <div class="m-alert__icon">
                            <i class="la la-warning"></i>
                        </div>
                        <div class="m-alert__text">
                            Si tu propuesta musical es un video ingresa al <a target="_blank" href="https://online-audio-converter.com/es/"><strong class="text-warning" style="cursor: pointer">siguiente link</strong></a> y conviértela en formato mp3, si no sabes como <strong style="cursor: pointer" data-toggle="modal" data-target="#exampleModalLong">ingresa aquí</strong> para tener instrucciones.
                       </div>

                    </div>
                @endif

                {{-- modal convertir mp3 --}}
                <div class="modal fade" id="convertirMp3" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">
                                Convertir </h5>
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>
                {{-- modal Instrucciones --}}
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Instrucciones</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <video style="width:100%" controls>
                                        <source src="/video/video.mp4" type="video/mp4">
                                    </video>
{{--                                    <video autoplay style="width: 100%" src="/video/video.mov"></video>--}}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                        </div>
                      </div>
                    </div>
                  </div>

        <!--=====================================
           MOSTAR ALERTA PARA CREAR PROYECTO
       ======================================-->
        @if(session()->has('aspirant_register'))
            <div class="m-alert m-alert--icon m-alert--outline alert alert-success" role="alert">
                <div class="m-alert__icon">
                    <i class="la la-check"></i>
                </div>
                <div class="m-alert__text">
                    <strong>Bien hecho!</strong> {{session('aspirant_register')}}
                </div>
            </div>
        @endif


        <div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Información
                        </h3>
                    </div>
                </div>

            </div>
            <form  method="post" action="{{ route('add.store.project') }}"
                  class="m-form m-form--label-align-left- m-form--state-" id="form_add_project">
                @csrf
                <input type="hidden" name="artist_id" value="{{ $artist_id->id }}">
                <input type="hidden" name="status" value="1">
                <!--=====================================
                     AGREGAR UNA NUEVA CANCIÓN
                ======================================-->
                <div class="m-portlet__body">
                    <div class="row">

                        <!--=====================================
                            NOMBRE DE LA CANCIÓN
                        ======================================-->
                        <div class="col-lg-6 m-form__group-sub">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <label class="form-control-label" form="nombreProyecto"><span class="text-danger">*</span>
                                        Nombre de la canción:</label>
                                    <input type="text" name="name_project"
                                           class="form-control m-input title_add_proyecto required"
                                           id="nombreProyecto" placeholder="" value="{{ old('name_project') }}" required>
                                    <span class="m-form__help">{{ __('help_nombre_proyecto') }}</span>
                                </div>
                            </div>
                        </div>
                        <!--=====================================
                            NOMBRE DEL AUTOR
                        ======================================-->
                        <div class="col-lg-6 m-form__group-sub">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <label class="form-control-label" form="nombreProyecto"><span class="text-danger">*</span>
                                        Nombre del autor o compositor:</label>
                                    <input type="text" name="author" required
                                           class="form-control m-input title_add_proyecto required"
                                           id="" placeholder="" value="{{ old('author') }}">
                                </div>
                            </div>
                        </div>

                        <!--=====================================
                            SELECCIONE CATEGORÍA
                        ======================================-->
                        <div class="col-lg-6 m-form__group-sub pt-4">
                            <label class="form-control-label" form="category_add_proyecto"><span class="text-danger">*</span>
                                Seleccione modalidad:</label><a target="_blank" class="pl-2" href="/documents/GUIA-DESCRIPTIVA-DE-MODALIDADES.pdf"><span>Más Información</span></a>
                            <select name="tCategory_id" required
                                    class="form-control m-bootstrap-select m_selectpicker required"
                                    id="category_add_proyecto">
                                <option value="">Seleccione</option>

                                @foreach($categories as $tCategorie)
                                    <option value="{{ $tCategorie->id }}" {{ old('tCategory_id') == $tCategorie->id ? 'selected':''}} >
                                        {{ $tCategorie->category }} ({{ $tCategorie->description }})
                                    </option>
                                @endforeach
                                {!! $errors->first('category_id','<div
                                    class="form-control-feedback">*:message</div>')!!}
                            </select>
                            <span class="m-form__help">{{ __('categoria_de_proyecto') }}</span>
                        </div>
                        <!--=====================================
                           SUBIR MP3
                       ======================================-->
                        <div class="col-lg-6 m-form__group-sub {{$errors->has('subir_cancion')? 'has-danger':''}}">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <label class="form-control-label" form="nombreProyecto"><span class="text-danger">*</span>
                                        Subir canción <span class="text-danger">(Tenga en cuenta que la canción que va a subir aquí, participará en el concurso)</span></label>
                                    <div class="m-dropzone dropzone m-dropzone--success" action=""
                                         id="m-dropzone-three">
                                        <div class="m-dropzone__msg dz-message needsclick">
                                            <h3 class="m-dropzone__msg-title">
                                                Agregue su canción en formato MP3</h3>
                                            <span
                                                class="m-dropzone__msg-desc">Arrastra o has clic a aquí para subir</span>
                                        </div>
                                    </div>
                                    {!! $errors->first('subir_cancion','<div class="form-control-feedback">*:message
                                               </div>')!!}
                                    <span class="m-form__help">Cargue aquí el audio de la canción en formato Mp3.</span>
                                    <input type="hidden" id="inputDBAudioAddProject"
                                           name="subir_cancion" value="">
                                    <div id="erroresImagen" style="color: var(--danger)"
                                         class="form-control-feedback"></div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6 m-form__group-sub " style="margin-top: -8rem;">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12 pt-4">
                                    <label class="form-control-label" form="nombreProyecto">
                                        Agregar canciones si lo desea (No obligatorio)<span class="text-danger"> (Tenga en cuenta que la canciónes que agregue aquÍ, no participarán en el concurso. Solo para mostrar tu talento)</span></label>
                                    <button class="btn btn-primary btn-block add-song">Agregar canciones</button>
                                </div>
                            </div>
                        </div>
<div class="col-md-6"></div>

                        <div style="display:none" class="add-song-drop col-lg-6 m-form__group-sub ">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <label class="form-control-label" form="nombreProyecto">
                                    Canción dos <span class="text-danger">(Tenga en cuenta que la canción que va a subir aquí, No participará en el concurso)</span></label>
                                    <div class="m-dropzone dropzone-one m-dropzone--success" action=""
                                         id="m-dropzone-three">
                                        <div class="m-dropzone__msg dz-message needsclick">
                                            <h3 class="m-dropzone__msg-title">
                                                Agregue su canción en formato MP3</h3>
                                            <span
                                                class="m-dropzone__msg-desc">Arrastra o has clic a aquí para subir</span>
                                        </div>
                                    </div>

                                    <span class="m-form__help">Cargue aquí el audio de la canción en formato Mp3.</span>
                                    <input type="hidden" id="inputDropOne"
                                           name="audio_one" value="">
                                    <div id="erroresImagen" style="color: var(--danger)"
                                         class="form-control-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div style="display:none" class="add-song-drop col-lg-6 m-form__group-sub ">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <label class="form-control-label" form="nombreProyecto">
                                    Canción tres <span class="text-danger">(Tenga en cuenta que la canción que va a subir aquí, No participará en el concurso)</span></label>
                                    <div class="m-dropzone dropzone-two m-dropzone--success" action=""
                                         id="m-dropzone-three">
                                        <div class="m-dropzone__msg dz-message needsclick">
                                            <h3 class="m-dropzone__msg-title">
                                                Agregue su canción en formato MP3</h3>
                                            <span
                                                class="m-dropzone__msg-desc">Arrastra o has clic a aquí para subir</span>
                                        </div>
                                    </div>

                                    <span class="m-form__help">Cargue aquí el audio de la canción en formato Mp3.</span>
                                    <input type="hidden" id="inputDropTwo"
                                           name="audio_two" value="">
                                    <div id="erroresImagen" style="color: var(--danger)"
                                         class="form-control-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <button style="display: none" class="btn btn-primary btn-block cancel-song col-md-4 ml-3 mt-3">Cancelar</button>



                    </div>
                    <div class="row pt-4">
                        <!--=====================================
                            BREVE RESEÑA
                        ======================================-->
                        <div class="col-lg-12 m-form__group-sub">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-12">
                                    <label class="form-control-label" form="nombreProyecto"><span class="text-danger">*</span>
                                        Escriba aquí una breve reseña :</label>
                                    <textarea class="form-control m-input"
                                              id="exampleTextarea" rows="8" name="description" required>{{ old('description') }}</textarea>
                                    <span class="m-form__help">(máximo 300 palabras) de su proyecto musical, incluyendo una corta descripción de su trayectoria.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <button id="btn_add_project" class="btn btn-primary pull-right">Registrar canción</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('js.add-project')
    <script>
        const txtInvalidAlert = "{{ __('txtInvalidAlertAddProject') }}";
    </script>
    <script src="/backend/assets/js/add-project.js" type="text/javascript"></script>
    <script>
        const nombre = "{{ __('nombre') }}";
        const help = "{{ __('help_nombre_integrante') }}";
        const rol = "{{ __('rol') }}";
        const helpRol = "{{ __('help_rol_integrante') }}";
    </script>
    <script>
        var dropzone = new Dropzone('.dropzone', {
            url: '{{route('add.project.audio')}}',
            acceptedFiles: '.mp3',
            timeout: 180000,
            maxFiles: 1,
            paramName: 'image',
            addRemoveLinks: true,
            headers: {

                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            processing: function(file, response){
                // console.log(file,'prosesing')
                $('body').loading({
                    message: 'Subiendo canción...',
                    start:true,
                });
                // this.success();
            },
            success: function (file, response) {
                $('body').loading({
                    start:false,
                });
                $("#erroresImagen").text('');
                $('#inputDBAudioAddProject').val(response);
                $('#img_add_proyect').attr('src', response);
            },
            error: function (file, e, i, o, u) {
                if(file.accepted == false){
                    toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("Formato de audio incorrecto, solo se acepta formato mp3", "Información");
                    // alert('asi no pri')
                }else{
                    toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El audio no se cargó correctamente, inténtalo más tarde", "Información");
                $("#erroresImagen").text('');

                }
                console.log(file,'file');
                $('body').loading({
                    start:false,
                });

                // if (file.xhr.status === 413) {
                //     $("#erroresImagen").text('{{__("imagen_grande")}}');
                //     $(file.previewElement).addClass("dz-error").find('.dz-error-message').text('{{__("imagen_grande")}}');
                //     setTimeout(() => {
                //         dropzone.removeFile(file)
                //     }, 1000)
                // }
            }
        });

        // dropzone one
        var fileOne;
        var dropzoneOne = new Dropzone('.dropzone-one', {
            url: '{{route('add.audio.one')}}',
            acceptedFiles: '.mp3',
            addRemoveLinks: true,
            timeout: 360000,
            maxFiles: 1,
            paramName: 'image',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            processing: function(file, response){
                $('body').loading({
                    message: 'Subiendo canción...',
                    start:true,
                });
            },
            success: function (file, response) {
                fileOne=file;
                $('body').loading({
                    start:false,
                });
                $("#erroresImagen").text('');
                $('#inputDropOne').val(response);
                $('#img_add_proyect').attr('src', response);
            },
            error: function (file, e, i, o, u) {
                if(file.accepted == false){
                    toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("Formato de audio incorrecto, solo se acepta formato mp3", "Información");
                    // alert('asi no pri')
                }else{
                    toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El audio no se cargó correctamente, inténtalo más tarde", "Información");
                $("#erroresImagen").text('');

                }
                $('body').loading({
                    start:false,
                });

                $("#erroresImagen").text('');
                if (file.xhr.status === 413) {
                    $("#erroresImagen").text('{{__("imagen_grande")}}');
                    $(file.previewElement).addClass("dz-error").find('.dz-error-message').text('{{__("imagen_grande")}}');
                    setTimeout(() => {
                        dropzoneOne.removeFile(file)
                    }, 1000)
                }
            }
        });

        // dorp two
        var fileTwo;
        var dropzoneTwo = new Dropzone('.dropzone-two', {
            url: '{{route('add.audio.two')}}',
            acceptedFiles: '.mp3',
            addRemoveLinks: true,
            timeout: 360000,
            maxFiles: 1,
            paramName: 'image',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            processing: function(file, response){
                $('body').loading({
                    message: 'Subiendo canción...',
                    start:true,
                });
            },
            success: function (file, response) {
                fileTwo=file;
                $('body').loading({
                    start:false,
                });

                $("#erroresImagen").text('');
                $('#inputDropTwo').val(response);
                $('#img_add_proyect').attr('src', response);
            },
            error: function (file, e, i, o, u) {

                if(file.accepted == false){
                    toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("Formato de audio incorrecto, solo se acepta formato mp3", "Información");
                    // alert('asi no pri')
                }else{
                    toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El audio no se cargó correctamente, inténtalo más tarde", "Información");
                $("#erroresImagen").text('');

                }
                $('body').loading({
                    start:false,
                });

                $("#erroresImagen").text('');
                if (file.xhr.status === 413) {
                    $("#erroresImagen").text('{{__("imagen_grande")}}');
                    $(file.previewElement).addClass("dz-error").find('.dz-error-message').text('{{__("imagen_grande")}}');
                    setTimeout(() => {
                        dropzoneTwo.removeFile(file)
                    }, 1000)
                }
            }
        });
        dropzone.on("addedfile", function (file) {
            file.previewElement.addEventListener("click", function () {
                dropzone.removeFile(file);
            });
        });
        Dropzone.autoDiscover = false;


    </script>
    <script>
        $('.add-song').click(function(e){
            e.preventDefault();
            // $(this).hide();
            $('.add-song-drop').show();
            $('.cancel-song').show();

        });
        $('.cancel-song').click(function(e){
            e.preventDefault();
            // console.log(fileOne,'fileOne');
            $(this).hide();
            $('.add-song-drop').hide();
            $('.add-song').show();
            $('#inputDropOne').val(null);
            $('#inputDropTwo').val(null);
            if(fileOne){

                dropzoneOne.removeFile(fileOne);
            }
            if(fileTwo){

                dropzoneTwo.removeFile(fileTwo);
            }
        });


    </script>
    <script>

        $('#btn_add_project').click(function (e) {
            e.preventDefault();
            swal({
                title: "{{__('Anuncio')}}",
                text: "{{ __('¿ Esta seguro de guardar los datos ?') }}",
                icon: "success",


                cancelButtonText: "<span>{{ __('cancelar') }}</span>",
                cancelButtonClass: "btn btn-danger m-btn m-btn--pill m-btn--icon",
                confirmButtonText: "<span>{{ __('Aceptar') }}</span>",
                confirmButtonClass: "btn btn-success m-btn m-btn--pill m-btn--air m-btn--icon",

                reverseButtons: true,

                showCancelButton: true,



            }).then(function (result) {
                if (result.value) {
                    $('body').loading({
                        message: 'Tu propuesta musical se esta enviando...',
                        start:true,
                    });
                    $('#form_add_project').submit();
                }
            })
        });
    </script>
@endsection
