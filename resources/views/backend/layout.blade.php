<!DOCTYPE html>

<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="{{session("applocale")}}">

<!-- begin::Head -->

<head>
    <meta charset="utf-8"/>
    <title>{{config('app.name')}} | {{ auth()->user()->name }}</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->

    <!--begin:: Global Mandatory Vendors -->
    <link href="/backend/vendors/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>

    <!--end:: Global Mandatory Vendors -->

    <!--begin:: Global Optional Vendors -->
    <link href="/backend/vendors/tether/dist/css/tether.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="/backend/vendors/bootstrap-datetime-picker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="/backend/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="/backend/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css" rel="stylesheet"
          type="text/css"/>
    <link href="/backend/vendors/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="/backend/build/css/intlTelInput.css">
    <link rel="stylesheet" href="/backend/assets/css/circle.player.css">
    <link rel="stylesheet" href="/backend/player/css/audioplayer.css">
    {{-- <link rel="stylesheet" href="/backend/assets/css/jplayer.blue.monday.css"> --}}
    <link rel="stylesheet" href="/backend/assets/css/jplayer.pink.flag.css">
    <link rel="stylesheet" href="/backend/build/css/demo.css">
    <link href="/backend/vendors/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/select2/dist/css/select2.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/nouislider/distribute/nouislider.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/owl.carousel/dist/assets/owl.carousel.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/owl.carousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/summernote/dist/summernote.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/animate.css/animate.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/toastr/build/toastr.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/jstree/dist/themes/default/style.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/morris.js/morris.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/chartist/dist/chartist.min.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/socicon/css/socicon.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/vendors/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/vendors/flaticon/css/flaticon.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/vendors/metronic/css/styles.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/vendors/vendors/fontawesome5/css/all.min.css" rel="stylesheet" type="text/css"/>

    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Styles -->
    <link href="/backend/assets/demo/base/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/assets/css/backend.css" rel="stylesheet" type="text/css"/>

    <!--RTL version:<link href="assets/demo/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

    <!--end::Global Theme Styles -->

    <!--begin::Page Vendors Styles -->
    <link href="/backend/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="/backend/assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>


    <!--RTL version:<link href="assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

    <!--end::Page Vendors Styles -->
    {{--<link rel="shortcut icon" href="/backend/assets/demo/media/img/logo/favicon.ico"/>--}}
    @stack('css')
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body
    class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default m-brand--minimize m-aside-left--minimize">
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page" id="app">

    <!-- BEGIN: Header -->

    <header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
        <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop">

                <!-- BEGIN: Brand -->
                <div class="m-stack__item m-brand  m-brand--skin-dark ">
                    <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="#" class="m-brand__logo-wrapper">
                                {{--<h4 style="color: white">{{ config('app.name') }}</h4>--}}
                                <h4 style="color: white;width: 170px;">Caza talentos</h4>
                            </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">

                            <!-- BEGIN: Left Aside Minimize Toggle -->
                            <a href="javascript:;" id="m_aside_left_minimize_toggle"
                               class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block m-brand__toggler--active">
                                <span></span>
                            </a>

                            <!-- END -->

                            <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                            <a href="javascript:;" id="m_aside_left_offcanvas_toggle"
                               class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block m-brand__toggler--active">
                                <span></span>
                            </a>

                            <!-- END -->

                            <!-- BEGIN: Responsive Header Menu Toggler -->
                            <a id="m_aside_header_menu_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>

                            <!-- END -->

                            <!-- BEGIN: Topbar Toggler -->
                            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                <i class="flaticon-more"></i>
                            </a>

                            <!-- BEGIN: Topbar Toggler -->
                        </div>
                    </div>
                </div>

                <!-- END: Brand -->
                @include('backend.partials.navigation')
            </div>
        </div>
    </header>


    <!-- END: Header -->

    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i
                class="la la-close"></i></button>
        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

            <!--=====================================
      NAVEGACION
        ======================================-->
            @if(\App\User::navigation() !== "Subsanador" )
                @include('backend.partials.menu_navigation')
            @endif

        </div>
        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <div class="m-subheader ">
                @if($errors->any())

                    <ul class="list-group">

                        @foreach($errors->all() as $error)
                            <div class="container">
                                <div class="alert alert-danger" role="alert">
                                    <strong>Oh!</strong> {{$error}}
                                </div>
                            </div>

                        @endforeach

                    </ul>

                @endif
                @if(session()->has('eliminar'))
                    <div class="container">
                        <div class="alert alert-danger" role="alert">
                            <strong>Oh!</strong> {{session('eliminar')}}
                        </div>
                    </div>

                @endif
                @yield('header')
            </div>
            @yield('content')
        </div>
    </div>
    <!-- end:: Body -->

    <!-- begin::Footer -->
    <footer class="m-grid__item m-footer ">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
                        <span class="m-footer__copyright">
                            <span class="font-weight-bold">{{ config('app.name') }} </span> &copy; 2020 Powered by <a href="https://bmotion.co" class="m-link">Bmotion SAS </a> Todos los derechos reservados
                        </span>
                </div>
                <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                    <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link">
                                <span class="m-nav__link-text">Términos y Condiciones</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link">
                                <span class="m-nav__link-text">Política de Privacidad</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- end::Footer -->
</div>

<!-- end:: Page -->

<!-- begin::Quick Sidebar -->
<div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
    <project-messages id="mensajeProjects" userJson="{{Auth::check()? Auth::user() : "{}" }}"></project-messages>
</div>

<!-- end::Quick Sidebar -->

<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>

<!-- end::Scroll Top -->

<!-- begin::Quick Nav -->
<ul class="m-nav-sticky" style="margin-top: 30px;">
    {{--<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Purchase" data-placement="left">
    <a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes"
       target="_blank"><i class="la la-cart-arrow-down"></i></a>
</li>--}}
    <li class="m-nav-sticky__item" data-toggle="m-tooltip" title="{{ __('documentacion') }}" data-placement="left">
        <a href="" target="_blank"><i class="la la-code-fork"></i></a>
    </li>
    <li class="m-nav-sticky__item" data-toggle="m-tooltip" title="{{ __('soporte') }}" data-placement="left">
        <a href="" target="_blank"><i class="la la-life-ring"></i></a>
    </li>
</ul>

<!-- begin::Quick Nav -->
<script src="/js/common.js"></script>
<script>
    const lang = "{{ session("applocale") }}";
    window.lang = lang;
</script>

<!--begin:: Global Mandatory Vendors -->
<meta name="_token" content="{!! csrf_token() !!}"/>
<script src="/backend/vendors/jquery/dist/jquery.js" type="text/javascript"></script>
<script src="/backend/vendors/popper.js/dist/umd/popper.js" type="text/javascript"></script>
<script src="/backend//vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/app.js"></script>
<script src="/js/messages.js"></script>
<script src="/backend/vendors/js-cookie/src/js.cookie.js" type="text/javascript"></script>
<script src="/js/libs/moment-with-locales.min.js" type="text/javascript"></script>
<script src="/backend/vendors/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
<script src="/backend/vendors/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
<script src="/backend/vendors/wnumb/wNumb.js" type="text/javascript"></script>

<!--end:: Global Mandatory Vendors -->

{{-- js de reproductor --}}
{{-- <script src="/backend/vendors/jplayer/jquery-1.11.1.min.js" type="text/javascript"></script> --}}
<script src="/backend/vendors/jplayer/circle.player.js" type="text/javascript"></script>
<script src="/backend/vendors/jplayer/jquery.grab.js" type="text/javascript"></script>
<script src="/backend/vendors/jplayer/jquery.jplayer.min.js" type="text/javascript"></script>
<script src="/backend/vendors/jplayer/jquery.transform2d.js" type="text/javascript"></script>
<script src="/backend/vendors/jplayer/mod.csstransforms.min.js" type="text/javascript"></script>
<script src="/backend/player/js/audioplayer.js" type="text/javascript"></script>


<!--begin:: Global Optional Vendors -->
<script src="/backend/vendors/jquery.repeater/src/lib.js" type="text/javascript"></script>
<script src="/backend/vendors/jquery.repeater/src/jquery.input.js" type="text/javascript"></script>
<script src="/backend/vendors/jquery.repeater/src/repeater.js" type="text/javascript"></script>
<script src="/backend/vendors/jquery-form/dist/jquery.form.min.js" type="text/javascript"></script>
<script src="/backend/vendors/block-ui/jquery.blockUI.js" type="text/javascript"></script>
<script src="/backend/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript">
</script>
<script src="/backend/vendors/js/framework/components/plugins/forms/bootstrap-datepicker.init.js"
        type="text/javascript"></script>
<script src="/backend/vendors/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js" type="text/javascript">
</script>
<script src="/backend/vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="/backend/vendors/js/framework/components/plugins/forms/bootstrap-timepicker.init.js"
        type="text/javascript"></script>
<script src="/backend/vendors/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="/backend/vendors/js/framework/components/plugins/forms/bootstrap-daterangepicker.init.js"
        type="text/javascript"></script>
<script src="/backend/vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript">
</script>
<script src="/backend/vendors/bootstrap-maxlength/src/bootstrap-maxlength.js" type="text/javascript"></script>
<script src="/backend/vendors/bootstrap-switch/dist/js/bootstrap-switch.js" type="text/javascript"></script>
<script src="/backend/vendors/js/framework/components/plugins/forms/bootstrap-switch.init.js"
        type="text/javascript"></script>
<script src="/backend/vendors/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js"
        type="text/javascript"></script>
<script src="/backend/vendors/bootstrap-select/dist/js/bootstrap-select.js" type="text/javascript"></script>
<script src="/backend/vendors/select2/dist/js/select2.full.js" type="text/javascript"></script>
<script src="/backend/vendors/typeahead.js/dist/typeahead.bundle.js" type="text/javascript"></script>
<script src="/backend/vendors/handlebars/dist/handlebars.js" type="text/javascript"></script>
<script src="/backend/vendors/inputmask/dist/jquery.inputmask.bundle.js" type="text/javascript"></script>
<script src="/backend/vendors/inputmask/dist/inputmask/inputmask.date.extensions.js" type="text/javascript">
</script>
<script src="/backend/vendors/inputmask/dist/inputmask/inputmask.numeric.extensions.js" type="text/javascript">
</script>
<script src="/backend/vendors/inputmask/dist/inputmask/inputmask.phone.extensions.js" type="text/javascript">
</script>
<script src="/backend/vendors/nouislider/distribute/nouislider.js" type="text/javascript"></script>
<script src="/backend/vendors/owl.carousel/dist/owl.carousel.js" type="text/javascript"></script>
<script src="/backend/vendors/autosize/dist/autosize.js" type="text/javascript"></script>
<script src="/backend/vendors/clipboard/dist/clipboard.min.js" type="text/javascript"></script>
<script src="/backend/vendors/ion-rangeslider/js/ion.rangeSlider.js" type="text/javascript"></script>
<script src="/backend/vendors/dropzone/dist/dropzone.js" type="text/javascript"></script>
<script src="/backend/vendors/summernote/dist/summernote.js" type="text/javascript"></script>
<script src="/backend/vendors/markdown/lib/markdown.js" type="text/javascript"></script>
<script src="/backend/vendors/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
<script src="/backend/vendors/js/framework/components/plugins/forms/bootstrap-markdown.init.js"
        type="text/javascript"></script>
<script src="/backend/vendors/jquery-validation/dist/jquery.validate.js" type="text/javascript"></script>
<script src="/backend/vendors/jquery-validation/dist/additional-methods.js" type="text/javascript"></script>
<script src="/backend/vendors/js/framework/components/plugins/forms/jquery-validation.init.js"
        type="text/javascript"></script>
<script src="/backend/vendors/bootstrap-notify/bootstrap-notify.min.js" type="text/javascript"></script>
<script src="/backend/vendors/js/framework/components/plugins/base/bootstrap-notify.init.js" type="text/javascript">
</script>
<script src="/backend/vendors/toastr/build/toastr.min.js" type="text/javascript"></script>
<script src="/backend/vendors/jstree/dist/jstree.js" type="text/javascript"></script>
<script src="/backend/vendors/raphael/raphael.js" type="text/javascript"></script>
<script src="/backend/vendors/morris.js/morris.js" type="text/javascript"></script>
<script src="/backend/vendors/chartist/dist/chartist.js" type="text/javascript"></script>
<script src="/backend/vendors/chart.js/dist/Chart.bundle.js" type="text/javascript"></script>
<script src="/backend/vendors/js/framework/components/plugins/charts/chart.init.js" type="text/javascript"></script>
<script src="/backend/vendors/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js"
        type="text/javascript"></script>
<script src="/backend/vendors/vendors/jquery-idletimer/idle-timer.min.js" type="text/javascript"></script>
<script src="/backend/vendors/waypoints/lib/jquery.waypoints.js" type="text/javascript"></script>
<script src="/backend/vendors/counterup/jquery.counterup.js" type="text/javascript"></script>
<script src="/backend/vendors/es6-promise-polyfill/promise.min.js" type="text/javascript"></script>
<script src="/backend/vendors/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
<script src="/backend//vendors/js/framework/components/plugins/base/sweetalert2.init.js" type="text/javascript">
</script>

<!--end:: Global Optional Vendors -->

<!--begin::Global Theme Bundle -->
<script src="/backend/assets/demo/base/scripts.bundle.js" type="text/javascript"></script>
<script src="/backend/assets/demo/custom/crud/forms/widgets/select2.js" type="text/javascript"></script>
<script src="/backend/assets/demo/custom/crud/forms/widgets/bootstrap-select.js" type="text/javascript"></script>
<script src="/backend/assets/demo/custom/crud/forms/widgets/input-mask.js" type="text/javascript"></script>
<script src="/backend/assets/demo/custom/components/base/sweetalert2.js" type="text/javascript"></script>
<script src="/backend/assets/demo/custom/crud/wizard/wizard.js" type="text/javascript"></script>
<script src="/backend/assets/js/jqueryNumber.js" type="text/javascript"></script>
<script src="/backend/assets/js/admin/admin.js" type="text/javascript"></script>
<script src="/backend/build/js/intlTelInput.js"></script>

@section('js.new-register')
@show
@section('js.form-register')
@show

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors -->
<script src="/backend/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<script src="/backend/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<script src="/backend/assets/demo/custom/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript">
</script>
<script src="/backend/assets/js/select_expendicion_departamentos.js"></script>
<script src="/backend/assets/js/lenguage-datepicker.js"></script>


<!--end::Page Vendors -->

<!--begin::Page Scripts -->
<script src="/backend/assets/app/js/dashboard.js" type="text/javascript"></script>
<script>
    moment.locale(lang);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    $(document).ready(function () {
        if (lang !== "es") {
            return;
        }
        jQuery.extend(jQuery.validator.messages, {
            required: "Este campo es obligatorio.",
            remote: "Por favor, rellena este campo.",
            email: "Por favor, escribe una dirección de correo válida",
            url: "Por favor, escribe una URL válida.",
            date: "Por favor, escribe una fecha válida.",
            dateISO: "Por favor, escribe una fecha (ISO) válida.",
            number: "Por favor, escribe un número entero válido.",
            digits: "Por favor, escribe sólo dígitos.",
            creditcard: "Por favor, escribe un número de tarjeta válido.",
            equalTo: "Por favor, escribe el mismo valor de nuevo.",
            accept: "Por favor, escribe un valor con una extensión aceptada.",
            maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
            minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
            rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
            range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
            max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
            min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
        });
    });
</script>

<!--end::Page Scripts -->
@include('sweet::alert')
@section('dropzonePhotoArtist')
@show
@section('js.add-project')
@show

@section('table.admin.projects')
@show
@section('rating.projects')
@show
@section('table.admin.management')
@show
@stack('js')

<script src="/backend/build/js/changeInputPhone.js"></script>
</body>

<!-- end::Body -->

</html>
