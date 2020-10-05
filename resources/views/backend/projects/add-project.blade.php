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
            <form method="post" action="{{ route('add.store.project') }}"
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
                                Seleccione categoría:</label>
                            <select name="tCategory_id" required
                                    class="form-control m-bootstrap-select m_selectpicker required"
                                    id="category_add_proyecto">
                                <option value="">Seleccione</option>

                                @foreach($categories as $tCategorie)
                                    <option value="{{ $tCategorie->id }}" {{ old('tCategory_id') == $tCategorie->id ? 'selected':''}} >
                                        {{ $tCategorie->category }}
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
                                <div class="col-lg-12">
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
                        <button type="submit" class="btn btn-primary pull-right">Enviar información</button>
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
            acceptedFiles: 'audio/*',
            maxFiles: 1,
            paramName: 'image',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (file, response) {
                $("#erroresImagen").text('');
                $('#inputDBAudioAddProject').val(response);
                $('#img_add_proyect').attr('src', response);
            },
            error: function (file, e, i, o, u) {
                $("#erroresImagen").text('');
                if (file.xhr.status === 413) {
                    $("#erroresImagen").text('{{__("imagen_grande")}}');
                    $(file.previewElement).addClass("dz-error").find('.dz-error-message').text('{{__("imagen_grande")}}');
                    setTimeout(() => {
                        dropzone.removeFile(file)
                    }, 1000)
                }
            }
        });

        // dropzone one

        var dropzone = new Dropzone('.dropzone-one', {
            url: '{{route('add.audio.one')}}',
            acceptedFiles: 'audio/*',
            maxFiles: 1,
            paramName: 'image',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (file, response) {
                $("#erroresImagen").text('');
                $('#inputDropOne').val(response);
                $('#img_add_proyect').attr('src', response);
            },
            error: function (file, e, i, o, u) {
                $("#erroresImagen").text('');
                if (file.xhr.status === 413) {
                    $("#erroresImagen").text('{{__("imagen_grande")}}');
                    $(file.previewElement).addClass("dz-error").find('.dz-error-message').text('{{__("imagen_grande")}}');
                    setTimeout(() => {
                        dropzone.removeFile(file)
                    }, 1000)
                }
            }
        });

        // dorp two
        var dropzone = new Dropzone('.dropzone-two', {
            url: '{{route('add.audio.two')}}',
            acceptedFiles: 'audio/*',
            maxFiles: 1,
            paramName: 'image',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (file, response) {
                $("#erroresImagen").text('');
                $('#inputDropTwo').val(response);
                $('#img_add_proyect').attr('src', response);
            },
            error: function (file, e, i, o, u) {
                $("#erroresImagen").text('');
                if (file.xhr.status === 413) {
                    $("#erroresImagen").text('{{__("imagen_grande")}}');
                    $(file.previewElement).addClass("dz-error").find('.dz-error-message').text('{{__("imagen_grande")}}');
                    setTimeout(() => {
                        dropzone.removeFile(file)
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
        $('.add-song').click(function(){
            // $(this).hide();
            $('.add-song-drop').show();
            $('.cancel-song').show();

        });
        $('.cancel-song').click(function(){
            $(this).hide();
            $('.add-song-drop').hide();
            $('.add-song').show();
        });


    </script>
@endsection
