@extends('backend.layout')

@section('header')
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{ __('bienvenido') }}</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="#" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-user"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">{{__('perfil')}} {{ __('artista') }}</span>
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
                @include('backend.profile.partials.sidebar-profile')
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{ __('apoyos_hechos') }}
                                </h3>
                            </div>
                        </div>

                        @include('backend.profile.partials.actions-perfil')
                    </div>
                    <!-- CONTENIDO -->
                    <div class="m-portlet__body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
