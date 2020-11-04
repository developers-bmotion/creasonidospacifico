<html lang="{{session("applocale")}}">

<!-- begin::Head -->

<head>
    <meta charset="utf-8"/>
    <title>{{config('app.name')}} | {{ auth()->user()->name }}</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @laravelPWA
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


    <link href=" {{ public_path("/backend/vendors/jstree/dist/themes/default/style.css") }} rel="stylesheet" type="text/css"/>
    <link href=" {{ public_path('/backend/vendors/vendors/metronic/css/styles.css') }}" rel="stylesheet" type="text/css"/>


    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Styles -->
    <link href="{{public_path("/backend/assets/demo/base/style.bundle.css") }}" rel="stylesheet" type="text/css"/>
    <link href="{{public_path("/backend/assets/css/backend.css") }}" rel="stylesheet" type="text/css"/>

    {{-- Custom css --}}
    <link href="{{public_path("/css/main-custom.css") }}" rel="stylesheet" type="text/css"/>
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body
    class="m-page--fluid m--skin- m-content--skin-light m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default m-brand--minimize m-aside-left--minimize">
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page" id="app">
@dd(public_path("/backend/assets/css/backend.css"))
    <h1>Hola como estas</h1>
</div>

<script src="{{public_path("/backend/vendors/jquery/dist/jquery.js") }}" type="text/javascript"></script>
<script src=" {{public_path("/backend/vendors/popper.js/dist/umd/popper.js") }}" type="text/javascript"></script>
<script src="{{public_path("/backend//vendors/bootstrap/dist/js/bootstrap.min.js") }}" type="text/javascript"></script>
</body>
