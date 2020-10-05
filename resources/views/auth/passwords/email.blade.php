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
<html lang="en">

<!-- begin::Head -->

<head>
    <meta charset="utf-8" />
    <title>Metronic | Login Page - 1</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
    </script>

    <!--end::Web font -->

    <!--begin:: Global Mandatory Vendors -->
    <link href="/backend/vendors/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />

    <!--end:: Global Mandatory Vendors -->

    <!--begin:: Global Optional Vendors -->
    <link href="/backend/vendors/tether/dist/css/tether.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet"
        type="text/css" />
    <link href="/backend/vendors/bootstrap-datetime-picker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"
        type="text/css" />
    <link href="/backend/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"
        type="text/css" />
    <link href="/backend/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css" rel="stylesheet"
        type="text/css" />
    <link href="/backend/vendors/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet"
        type="text/css" />
    <link href="/backend/vendors/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/nouislider/distribute/nouislider.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/owl.carousel/dist/assets/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/owl.carousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/animate.css/animate.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/toastr/build/toastr.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/jstree/dist/themes/default/style.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/morris.js/morris.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/chartist/dist/chartist.min.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/socicon/css/socicon.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/vendors/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/vendors/flaticon/css/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/vendors/metronic/css/styles.css" rel="stylesheet" type="text/css" />
    <link href="/backend/vendors/vendors/fontawesome5/css/all.min.css" rel="stylesheet" type="text/css" />

    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Styles -->
    <link href="/backend/assets/demo/base/style.bundle.css" rel="stylesheet" type="text/css" />

    <!--RTL version:<link href="/backend/assets/demo/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

    <!--end::Global Theme Styles -->
    <link rel="shortcut icon" href="/backend/assets/demo/media/img/logo/favicon.ico" />
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body
    class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin"
            id="m_login">
            <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
                <div class="m-stack m-stack--hor m-stack--desktop">
                    <div class="m-stack__item m-stack__item--fluid">
                        <div class="m-login__wrapper">
                            <div class="m-login__logo">
                                <a href="#">
                                    <img src="/backend/assets/app/media/img/logos/logo-2.png">
                                </a>
                            </div>
                            @if(session('message'))
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <div class="alert alert-{{session('message')[0]}}">
                                        <h4 class="alert-heading">{{__("Mensaje Informativo")}}</h4>
                                        <p>{{session('message')[1]}}</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="login__signin">
                                <div class="m-login__head">
                                    <h3 class="m-login__title">¿No recuerdas tu contraseña?</h3>
                                    <div class="m-login__desc">Ingrese su correo electrónico para restablecer su
                                        contraseña:</div>
                                </div>
                                <form class="m-login__form m-form" method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-group m-form__group">
                                        <input
                                            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} m-input"
                                            type="text" placeholder="Ingresa tu correo eléctronico" name="email" id="m_email"
                                            autocomplete="off">
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="m-login__form-action">
                                        <button type="submit"
                                            class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">Enviar</button>
                                        <a href="/login"
                                            class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom">Cancelar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="m-stack__item m-stack__item--center">
                        <div class="m-login__account">
                            <span class="m-login__account-msg">
                                Para registrarte como aspirante al concurso
                            </span>&nbsp;&nbsp;
                            <a href="/register" class="m-link m-link--focus m-login__account-link">Clic a aquí</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1  m-login__content m-grid-item--center"
                style="background-image: url(/backend/assets/app/media/img//bg/bg-4.jpg)">
                <div class="m-grid__item">
                    <h3 class="m-login__welcome">¿Olvidó su contraseña?</h3>
                    <p class="m-login__msg">
                        Ingresa tu correo eléctronico y enviaremos un enlace para que restablezcas tu contraseña
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Page -->

    <!--begin:: Global Mandatory Vendors -->
    <script src="/backend/vendors/jquery/dist/jquery.js" type="text/javascript"></script>
    <script src="/backend/vendors/popper.js/dist/umd/popper.js" type="text/javascript"></script>
    <script src="/backend/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/backend/vendors/js-cookie/src/js.cookie.js" type="text/javascript"></script>
    <script src="/backend/vendors/moment/min/moment.min.js" type="text/javascript"></script>
    <script src="/backend/vendors/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
    <script src="/backend/vendors/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
    <script src="/backend/vendors/wnumb/wNumb.js" type="text/javascript"></script>

    <!--end:: Global Mandatory Vendors -->

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
    <script src="/backend/vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript">
    </script>
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
    <script src="/backend/vendors/js/framework/components/plugins/charts/chart.init.js" type="text/javascript">
    </script>
    <script src="/backend/vendors/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js"
        type="text/javascript"></script>
    <script src="/backend/vendors/vendors/jquery-idletimer/idle-timer.min.js" type="text/javascript"></script>
    <script src="/backend/vendors/waypoints/lib/jquery.waypoints.js" type="text/javascript"></script>
    <script src="/backend/vendors/counterup/jquery.counterup.js" type="text/javascript"></script>
    <script src="/backend/vendors/es6-promise-polyfill/promise.min.js" type="text/javascript"></script>
    <script src="/backend/vendors/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
    <script src="/backend/vendors/js/framework/components/plugins/base/sweetalert2.init.js" type="text/javascript">
    </script>

    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Bundle -->
    <script src="/backend/assets/demo/base/scripts.bundle.js" type="text/javascript"></script>

    <!--end::Global Theme Bundle -->

    <!--begin::Page Scripts -->
    <script src="/backend/assets/snippets/custom/pages/user/login.js" type="text/javascript"></script>

    <!--end::Page Scripts -->
</body>

<!-- end::Body -->

</html>
