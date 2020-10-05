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
        @if(session()->has('proyect_add'))
            <div class="m-alert m-alert--outline alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                </button>
                <strong>{{ __('felicidades') }}!</strong> {{session('proyect_add')}}
            </div>
        @endif
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
                                    {{ __('mis_proyectos') }}
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm"
                                role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab"
                                       href="#m_widget5_tab1_content" role="tab">
                                        {{ __('todos') }}
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget5_tab2_content"
                                       role="tab">
                                        {{ __('revision') }}
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget5_tab3_content"
                                       role="tab">
                                        {{ __('aprobados_publicados') }}
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget5_tab4_content"
                                       role="tab">
                                        {{ __('rechazados') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        @include('backend.profile.partials.actions-perfil')
                    </div>
                    <div class="m-portlet__body">

                        <!--begin::Content-->
                        <div class="tab-content">
                            <!--=====================================
		                  TODOS LOS PROYECTOS
                            ======================================-->
                            <div class="tab-pane active" id="m_widget5_tab1_content" aria-expanded="true">

                                <!--begin::m-widget5-->
                                <div class="m-widget5">
                                    @forelse($artist->projects as $projects)
                                        @if($projects->status == 1)
                                            <span class="m-badge m-badge--metal m-badge--wide pull-right">{{ __('revision') }}</span>
                                        @elseif($projects->status == 2)
                                            <span class="m-badge m-badge--focus m-badge--wide pull-right">{{ __('pre_aprobado') }}</span>
                                        @elseif($projects->status == 3)
                                            <span class="m-badge m-badge--success m-badge--wide pull-right">{{ __('aprobado') }}</span>
                                        @elseif($projects->status == 4)
                                            <span class="m-badge m-badge--warning m-badge--wide pull-right">{{ __('Pendiente') }}</span>
                                        @elseif($projects->status == 5)
                                            <span class="m-badge m-badge--danger m-badge--wide pull-right">{{ __('rechazado') }}</span>
                                        @elseif($projects->status == 6)
                                            <span class="m-badge m-badge--brand m-badge--wide pull-right">{{ __('Nuevo revisión') }}</span>
                                        @elseif($projects->status == 7)
                                            <span class="m-badge m-badge--success m-badge--wide pull-right">{{ __('Aceptado') }}</span>
                                        @else
                                            <span class="m-badge m-badge--danger m-badge--wide pull-right">{{ __('rechazado') }}</span>
                                        @endif
                                        <div class="m-widget5__item">
                                            <div class="m-widget5__content">
                                                <div class="m-widget5__pic">
                                                    @if(Storage::disk('public')->exists('projects/'.$projects->project_picture))
                                                        <img src="{{ auth()->user()->pathAttachment() }}" alt=""/>
                                                    @else
                                                        <img class="m-widget7__img" src="{{ $projects->project_picture }}"
                                                             alt="">
                                                    @endif

                                                </div>
                                                <div class="m-widget5__section">
                                                    <h4 class="m-widget5__title">
                                                        {{ str_limit($projects->title,55) }}
                                                    </h4>
                                                    <span class="m-widget5__desc m--font-success"
                                                          style="font-size: 14px">
                                                    {{ $projects->category->category }}
                                                </span>
                                                    <div class="m-widget5__info">
                                                        <span class="m-widget5__author">{{ str_limit($projects->short_description,200)}}</span>
                                                    </div>
                                                </div>
                                                {{-- <div class="m-widget5__stats2 pull-right" >
                                                    <span class="m-widget5__number">$10000</span><br>
                                                    <span class="m-widget5__votes">{{ __('fondos_recaudados') }}</span>
                                                </div> --}}
                                                {{-- <div class="m-widget5__stats1 pull-right" style="margin-right: 40px;">
                                                    <span class="m-widget5__number" style="margin-right: 0px">${{ $projects->price }}</span><br>
                                                    <span class="m-widget5__sales">{{ __('meta') }}</span>
                                                </div> --}}
                                                <div class="m-widget5__stats1" style="float: right">
                                                    <a href="{{ route('show.backend.project',$projects->slug) }}" class="btn btn-secondary m-btn m-btn--icon m-btn--pill">
                                                    <span><i class="la la-info-circle"></i>
                                                    <span>{{ __('mas_informacion') }}</span></span>
                                                    </a>
                                                    @if($projects->status == 4)
                                                        <a href="{{ route('projects.show',$projects->slug) }}"
                                                           class="btn btn-secondary m-btn m-btn--icon m-btn--pill">
                                                    <span><i class="la la-eye"></i>
                                                    <span>{{ __('ver_online') }}</span></span>
                                                        </a>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>

                                    @empty
                                        <div class="alert m-alert--default text-center">
                                            <strong>{{ __('no_hay_proyectos') }}</strong>
                                        </div>
                                    @endforelse
                                </div>

                                <!--end::m-widget5-->
                            </div>
                            <!--=====================================
                           PROYECTOS  PENDIENTES
                           ======================================-->
                            <div class="tab-pane" id="m_widget5_tab2_content" aria-expanded="false">

                                <!--begin::m-widget5-->
                                <div class="m-widget5">
                                    @forelse($projects_revision->projects as $projects)
                                        @if($projects->status == 1)
                                            <span class="m-badge m-badge--metal m-badge--wide pull-right">{{ __('revision') }}</span>
                                        @elseif($projects->status == 2)
                                            <span class="m-badge m-badge--focus m-badge--wide pull-right">{{ __('pre_aprobado') }}</span>
                                        @elseif($projects->status == 3)
                                            <span class="m-badge m-badge--success m-badge--wide pull-right">{{ __('aprobado') }}</span>
                                        @elseif($projects->status == 4)
                                            <span class="m-badge m-badge--info m-badge--wide pull-right">{{ __('publicado') }}</span>
                                        @elseif($projects->status == 5)
                                            <span class="m-badge m-badge--info m-badge--wide pull-right">{{ __('publicado') }}</span>
                                        @elseif($projects->status == 6)
                                            <span class="m-badge m-badge--info m-badge--wide pull-right">{{ __('publicado') }}</span>
                                        @else
                                            <span class="m-badge m-badge--danger m-badge--wide pull-right">{{ __('rechazado') }}</span>
                                        @endif
                                        <div class="m-widget5__item">
                                            <div class="m-widget5__content">
                                                <div class="m-widget5__pic">
                                                    @if(Storage::disk('public')->exists('projects/'.$projects->project_picture))
                                                        <img src="{{ auth()->user()->pathAttachment() }}" alt=""/>
                                                    @else
                                                        <img class="m-widget7__img" src="{{ $projects->project_picture }}"
                                                             alt="">
                                                    @endif
                                                </div>
                                                <div class="m-widget5__section">
                                                    <h4 class="m-widget5__title">
                                                        {{ str_limit($projects->title,55) }}
                                                    </h4>
                                                    <span class="m-widget5__desc m--font-success"
                                                          style="font-size: 14px">
                                                    {{ $projects->category->category }}
                                                </span>
                                                    <div class="m-widget5__info">
                                                        <span class="m-widget5__author">{{ str_limit($projects->short_description,200)}}</span>
                                                    </div>
                                                </div>
                                                <div class="m-widget5__stats2 pull-right" >
                                                    <span class="m-widget5__number">$10000</span><br>
                                                    <span class="m-widget5__votes">{{ __('fondos_recaudados') }}</span>
                                                </div>
                                                <div class="m-widget5__stats1 pull-right" style="margin-right: 40px;">
                                                    <span class="m-widget5__number" style="margin-right: 0px">${{ $projects->price }}</span><br>
                                                    <span class="m-widget5__sales">{{ __('meta') }}</span>
                                                </div>
                                                <div class="m-widget5__stats1">
                                                    <a href="#" class="btn btn-secondary m-btn m-btn--icon m-btn--pill">
                                                    <span><i class="la la-info-circle"></i>
                                                    <span>{{ __('mas_informacion') }}</span></span>
                                                    </a>
                                                    @if($projects->status == 4)
                                                        <a href="{{ route('projects.show',$projects->slug) }}"
                                                           class="btn btn-secondary m-btn m-btn--icon m-btn--pill">
                                                    <span><i class="la la-eye"></i>
                                                    <span>{{ __('ver_online') }}</span></span>
                                                        </a>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    @empty
                                        <div class="alert m-alert--default text-center">
                                            <strong>{{ __('no_hay_proyectos') }}</strong>
                                        </div>
                                    @endforelse
                                </div>

                                <!--end::m-widget5-->
                            </div>
                            <!--=====================================
                           PROYECTOS APROVADOS Y PUBLICADOS
                           ======================================-->
                            <div class="tab-pane" id="m_widget5_tab3_content" aria-expanded="false">

                                <!--begin::m-widget5-->
                                <div class="m-widget5">
                                    @forelse($projects_approv_published->projects as $projects)
                                        @if($projects->status == 1)
                                            <span class="m-badge m-badge--metal m-badge--wide pull-right">{{ __('revision') }}</span>
                                        @elseif($projects->status == 2)
                                            <span class="m-badge m-badge--focus m-badge--wide pull-right">{{ __('pre_aprobado') }}</span>
                                        @elseif($projects->status == 3)
                                            <span class="m-badge m-badge--success m-badge--wide pull-right">{{ __('aprobado') }}</span>
                                        @elseif($projects->status == 4)
                                            <span class="m-badge m-badge--info m-badge--wide pull-right">{{ __('publicado') }}</span>
                                        @else
                                            <span class="m-badge m-badge--danger m-badge--wide pull-right">{{ __('rechazado') }}</span>
                                        @endif
                                        <div class="m-widget5__item">
                                            <div class="m-widget5__content">
                                                <div class="m-widget5__pic">
                                                    @if(Storage::disk('public')->exists('projects/'.$projects->project_picture))
                                                        <img src="{{ auth()->user()->pathAttachment() }}" alt=""/>
                                                    @else
                                                        <img class="m-widget7__img" src="{{ $projects->project_picture }}"
                                                             alt="">
                                                    @endif
                                                </div>
                                                <div class="m-widget5__section">
                                                    <h4 class="m-widget5__title">
                                                        {{ str_limit($projects->title,55) }}
                                                    </h4>
                                                    <span class="m-widget5__desc m--font-success"
                                                          style="font-size: 14px">
                                                    {{ $projects->category->category }}
                                                </span>
                                                    <div class="m-widget5__info">
                                                        <span class="m-widget5__author">{{ str_limit($projects->short_description,200)}}</span>
                                                    </div>
                                                </div>
                                                <div class="m-widget5__stats2 pull-right" >
                                                    <span class="m-widget5__number">$10000</span><br>
                                                    <span class="m-widget5__votes">{{ __('fondos_recaudados') }}</span>
                                                </div>
                                                <div class="m-widget5__stats1 pull-right" style="margin-right: 40px;">
                                                    <span class="m-widget5__number" style="margin-right: 0px">${{ $projects->price }}</span><br>
                                                    <span class="m-widget5__sales">{{ __('meta') }}</span>
                                                </div>
                                                <div class="m-widget5__stats1">
                                                    <a href="#" class="btn btn-secondary m-btn m-btn--icon m-btn--pill">
                                                    <span><i class="la la-info-circle"></i>
                                                    <span>{{ __('mas_informacion') }}</span></span>
                                                    </a>
                                                    @if($projects->status == 4)
                                                        <a href="{{ route('projects.show',$projects->slug) }}"
                                                           class="btn btn-secondary m-btn m-btn--icon m-btn--pill">
                                                    <span><i class="la la-eye"></i>
                                                    <span>{{ __('ver_online') }}</span></span>
                                                        </a>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    @empty
                                        <div class="alert m-alert--default text-center">
                                            <strong>{{ __('no_hay_proyectos') }}</strong>
                                        </div>
                                    @endforelse
                                </div>

                                <!--end::m-widget5-->
                            </div>
                            <!--=====================================
                          PROYECTOS RECHAZADOS
                          ======================================-->
                            <div class="tab-pane" id="m_widget5_tab4_content" aria-expanded="false">

                                <!--begin::m-widget5-->
                                <div class="m-widget5">
                                    @forelse($projects_rejected->projects as $projects)
                                        @if($projects->status == 1)
                                            <span class="m-badge m-badge--metal m-badge--wide pull-right">{{ __('revision') }}</span>
                                        @elseif($projects->status == 2)
                                            <span class="m-badge m-badge--focus m-badge--wide pull-right">{{ __('pre_aprobado') }}</span>
                                        @elseif($projects->status == 3)
                                            <span class="m-badge m-badge--success m-badge--wide pull-right">{{ __('aprobado') }}</span>
                                        @elseif($projects->status == 4)
                                            <span class="m-badge m-badge--info m-badge--wide pull-right">{{ __('publicado') }}</span>
                                        @else
                                            <span class="m-badge m-badge--danger m-badge--wide pull-right">{{ __('rechazado') }}</span>
                                        @endif
                                        <div class="m-widget5__item">
                                            <div class="m-widget5__content">
                                                <div class="m-widget5__pic">
                                                    @if(Storage::disk('public')->exists('projects/'.$projects->project_picture))
                                                        <img src="{{ auth()->user()->pathAttachment() }}" alt=""/>
                                                    @else
                                                        <img class="m-widget7__img" src="{{ $projects->project_picture }}"
                                                             alt="">
                                                    @endif
                                                </div>
                                                <div class="m-widget5__section">
                                                    <h4 class="m-widget5__title">
                                                        {{ str_limit($projects->title,55) }}
                                                    </h4>
                                                    <span class="m-widget5__desc m--font-success"
                                                          style="font-size: 14px">
                                                    {{ $projects->category->category }}
                                                </span>
                                                    <div class="m-widget5__info">
                                                        <span class="m-widget5__author">{{ str_limit($projects->short_description,200)}}</span>
                                                    </div>
                                                </div>
                                                <div class="m-widget5__stats2 pull-right" >
                                                    <span class="m-widget5__number">$10000</span><br>
                                                    <span class="m-widget5__votes">{{ __('fondos_recaudados') }}</span>
                                                </div>
                                                <div class="m-widget5__stats1 pull-right" style="margin-right: 40px;">
                                                    <span class="m-widget5__number" style="margin-right: 0px">${{ $projects->price }}</span><br>
                                                    <span class="m-widget5__sales">{{ __('meta') }}</span>
                                                </div>
                                                <div class="m-widget5__stats1">
                                                    <a href="{{ route('show.backend.project',$projects->slug) }}" class="btn btn-secondary m-btn m-btn--icon m-btn--pill">
                                                    <span><i class="la la-info-circle"></i>
                                                    <span>{{ __('mas_informacion') }}</span></span>
                                                    </a>
                                                    @if($projects->status == 4)
                                                        <a href="{{ route('projects.show',$projects->slug) }}"
                                                           class="btn btn-secondary m-btn m-btn--icon m-btn--pill">
                                                    <span><i class="la la-eye"></i>
                                                    <span>{{ __('ver_online') }}</span></span>
                                                        </a>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    @empty
                                        <div class="alert m-alert--default text-center">
                                            <strong>{{ __('no_hay_proyectos') }}</strong>
                                        </div>
                                    @endforelse
                                </div>

                                <!--end::m-widget5-->
                            </div>
                        </div>

                        <!--end::Content-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
