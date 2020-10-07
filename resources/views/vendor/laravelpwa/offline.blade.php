@extends('backend.layout')

@section('header')

    <div class="align-items-center">
        <div class="mr-auto">
            <h1 class="m-subheader__title--separator">Proceso de registro del aspirante</h1>
        </div>
    </div>

@stop
@section('content')
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

                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="#" data-toggle="m-tooltip"
                               class="m-portlet__nav-link m-portlet__nav-link--icon"
                               data-direction="left" data-width="auto"
                               title="Por favor dilegencie esta información, para poder continuar">
                                <i class="flaticon-info m--icon-font-size-lg3"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="row">
                    <!--=====================================
                        LINEA DE LA CONVOCATORIA
                    ======================================-->
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">Nombres:</label>
                        <input type="text" id="name_prueba" placeholder="nombres">
                    </div>
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">Apellidos:</label>
                        <input type="text" id="last_name_prueba" placeholder="apellidos">
                    </div>
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">Email:</label>
                        <input type="email" id="email_prueba" placeholder="email">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-primary" onclick="guardarDatos()">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="application/json" src="/backend/assets/js/pwa-local-storage.js"></script>
@endpush
