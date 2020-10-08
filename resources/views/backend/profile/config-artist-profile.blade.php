@extends('backend.layout')

@section('header')
    <div class="row">
        <div class="col-md-4 col-lg-4 col-12">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h1 class="m-subheader__title--separator">Perfil del aspirante</h1>
                </div>

            </div>
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-12">
        @if(count($artist->projects) !== 0)
            @if($artist->projects[0]->status == 4)
                <!--=====================================
		        ALERTA PARA MOSTRAR EL ESTADO PENDIENTE
            ======================================-->
                    <div class="m-alert m-alert--icon m-alert--outline alert alert-warning" role="alert">
                        <div class="m-alert__icon">
                            <i class="la la-warning"></i>
                        </div>
                        <div class="m-alert__text">
                            Tu propuesta musical esta en estado <strong>Pendiente</strong>, click
                            <strong data-toggle="modal" data-target="#verObservaciones"
                                    style="cursor: pointer">aquí</strong> para ver los detalles que debes ajustar.
                            Al terminar y estar seguro que todo esta bien, volver a enviar.
                        </div>
                        <div class="m-alert__actions" style="width: 200px;">
                            <button type="button" class="btn btn-warning btn-sm m-btn m-btn--pill m-btn--wide"
                                    style="color:#fff">Enviar propuesta musical nuevamente
                            </button>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@stop
@section('content')
    <div class="m-content">
        @if(session()->has('proyect_add'))
            <div class="m-alert m-alert--outline alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
                <strong>{{ __('felicidades') }}!</strong> {{session('proyect_add')}}
            </div>
        @endif
        <div class="row">
            <div class="col-xl-3 col-lg-3">
                @include('backend.profile.partials.sidebar-profile')
            </div>
            <div class=" col-lg-9">
                <div class="m-portlet m-portlet--full-height">

                    <div class="m-portlet__body">
                        <div class="">
                            <div class="" data-code-preview="true" data-code-html="true"
                                 data-code-js="false">
                                <div class="m-demo__preview">
                                    <!-- CAMBIAR LA CONTRASEÑA DEL USUARIO, PERO PRIMERO SE VALIDA SI EL USUARIO ES NO ES DE ALGUNA RED SOCIAL -->
                                    @if(!$artist->users->socialAcounts)
                                        <form method="post"
                                              action="{{ route('update.password.artist') }}">
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
                                    @endif
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group m-form__group ">
                                                <label for="">Imagén de Perfil</label>
                                                <div class="m-dropzone dropzone m-dropzone--success"
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


        <!--end::m-widget5-->
    </div>


    <!--end::Content-->

    <div class="modal fade" id="verObservaciones" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Observaciones </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if(count($artist->projects) !== 0)
                            @foreach($artist->projects[0]->observations as $observations)
                                <div class="col-12">
                                    {{ $observations->description }}
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

@stop

@section('dropzonePhotoArtist')
    <script>

        var BootstrapDatepicker = function () {

            var arrows;
            if (mUtil.isRTL()) {
                arrows = {
                    leftArrow: '<i class="la la-angle-right"></i>',
                    rightArrow: '<i class="la la-angle-left"></i>'
                }
            } else {
                arrows = {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            }

            //== Private functions
            var demos = function () {
                // minimum setup
                $('#datepicker_fecha_nacimiento #m_datepicker_1_validate').datepicker({
                    rtl: mUtil.isRTL(),
                    todayHighlight: true,
                    orientation: "bottom left",
                    templates: arrows
                });
                $('#datepicker_fecha_nacimiento').datepicker({
                    rtl: mUtil.isRTL(),
                    todayHighlight: true,
                    orientation: "bottom left",
                    templates: arrows
                });
            }

            return {
                // public functions
                init: function () {
                    demos();
                }
            };
        }();

        jQuery(document).ready(function () {
            BootstrapDatepicker.init();
        });

        new Dropzone('.dropzone', {
            url: '{{ route('profile.photo.artist') }}',
            acceptedFiles: 'image/*',
            maxFiles: 1,
            paramName: 'photo',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (file, response) {

                $('#inputImagenesPostPlan').val(response);
                location.reload();
            }

        });

        /* Dropzone.autoDiscover = false; */

        new Dropzone('.front_dropzone', {
            url: '{{ route('front.photo.artist') }}',
            acceptedFiles: 'image/*',
            maxFiles: 1,
            paramName: 'front_photo',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (file, response) {

                $('#inputImagenesPostPlan').val(response);
                location.reload();
            }

        });

        Dropzone.autoDiscover = false;

        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            // allowDropdown: false,
            // autoHideDialCode: false,
            // autoPlaceholder: "off",
            // dropdownContainer: document.body,
            // excludeCountries: ["us"],
            // formatOnDisplay: false,
            // geoIpLookup: function(callback) {
            //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            //     var countryCode = (resp && resp.country) ? resp.country : "";
            //     callback(countryCode);
            //   });
            // },
            // hiddenInput: "full_number",
            // initialCountry: "auto",
            // localizedCountries: { 'de': 'Deutschland' },
            // nationalMode: false,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // placeholderNumberType: "MOBILE",
            // preferredCountries: ['cn', 'jp'],
            // separateDialCode: true,
            utilsScript: "/backend/build/js/utils.js",
        });
    </script>
@endsection

