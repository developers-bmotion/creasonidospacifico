@push('css')
    <link rel="stylesheet" href="/backend/admin/css/dashboard.css">
@endpush
<div class="m-content">
    <!--Begin::Section-->
    <div class="m-portlet ">
        <div class="m-portlet__body  m-portlet__body--no-padding">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('numero_proyectos_registrados') }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <!--begin::Total Profit-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{ __('proyec_pre_aprobados') }}
                            </h4><br>
                            <span class="m-widget24__desc">
												</span>
                            <span class="m-widget24__stats m--font-brand">
                                           {{ $pre_approved }}
                                        
												</span>
                            <div class="m--space-10"></div>
                            {{-- <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-brand" role="progressbar" style="width: 78%;"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> --}}
                        </div>
                    </div>
                    <!--end::Total Profit-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <!--begin::New Feedbacks-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{ __('publicados') }}
                            </h4><br>
                            <span class="m-widget24__desc">
												</span>
                            <span class="m-widget24__stats m--font-info">
                                {{ $published }}
												</span>
                            <div class="m--space-10"></div>
                            {{-- <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-info" role="progressbar" style="width: 84%;"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> --}}
                        </div>
                    </div>
                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <!--begin::New Orders-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{ __('rechazados') }}
                            </h4><br>
                            <span class="m-widget24__desc">
												</span>
                            <span class="m-widget24__stats m--font-danger">
                                {{ $rejected }}
												</span>
                            <div class="m--space-10"></div>
                            {{-- <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-danger" role="progressbar" style="width: 69%;"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> --}}

                        </div>
                    </div>
                    <!--end::New Orders-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">
                    <!--begin::New Users-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                {{ __('aprovado') }}
                            </h4><br>
                            <span class="m-widget24__desc">
												</span>
                            <span class="m-widget24__stats m--font-success">
                                {{ $approved }}
												</span>
                            <div class="m--space-10"></div>
                            {{-- <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-success" role="progressbar" style="width: 90%;"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> --}}
                            <span class="m-widget24__change">

                            </span>
                            <span class="m-widget24__number">

                            </span>
                        </div>
                    </div>
                    <!--end::New Users-->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-6 col-xl-8">
            <div class="m-portlet ">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <a class="m-link m--font-success m--font-bolder" href="{{route('projects.admin')}}"
                                   style="padding-bottom: 5px;cursor: pointer;font-size: 15px">{{ __('ultimos_proyectos') }}
                                </a>
                                <h3 class="m-portlet__head-text">

                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm"
                                role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab"
                                       href="#m_widget5_tab1_content" role="tab">
                                        {{ __('revision') }}
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget5_tab2_content"
                                       role="tab">
                                        {{ __('proyec_pre_aprobados') }}
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget5_tab3_content"
                                       role="tab">
                                        {{ __('aprovado') }}
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget5_tab4_content"
                                       role="tab">
                                        {{ __('publicado') }}
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget5_tab5_content"
                                       role="tab">
                                        {{ __('rechazados') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">

                        <!--begin::Content-->

                        <div class="tab-content">
                            <!--=====================================
                            ULTMOS PROYECTOS EN REVISION
                             ======================================-->
                            <div class="tab-pane active" id="m_widget5_tab1_content" aria-expanded="true">
                                <div class="m-widget5">
                                    @forelse($last_revisions as $last_revision)
                                        <div class="m-widget5__item">
                                            <div class="m-widget5__content">
                                                <div class="m-widget5__pic">
                                                    @if(Storage::disk('public')->exists('projects/'.$last_revision->project_picture))
                                                        <img src="{{ auth()->user()->pathAttachment() }}" alt=""/>
                                                    @else
                                                        <img class="m-widget7__img"
                                                             src="{{ $last_revision->project_picture }}"
                                                             alt="">
                                                    @endif

                                                </div>
                                                <div class="m-widget5__section">
                                                    <span
                                                        class="m-badge m-badge--metal m-badge--wide m-badge--rounded pull-right"
                                                        style="font-size:13px;">{{ __('revision') }}</span>
                                                    <h4 class="m-widget5__title">
                                                        {{ str_limit($last_revision->title,40) }}
                                                    </h4>
                                                    <span class="m-widget5__desc m--font-success"
                                                          style="font-size: 14px">
                                                    {{ $last_revision->category->category }}
                                                </span>
                                                    <div class="m-widget5__info">
                                                        <span
                                                            class="m-widget5__author">{{ str_limit($last_revision->short_description,200)}}</span>
                                                    </div>
                                                </div>

                                                <div class="m-widget5__stats2 pull-right" >
                                                    <span class="m-widget5__number">$10000</span><br>
                                                    <span class="m-widget5__votes">{{ __('fondos_recaudados') }}</span>
                                                </div>
                                                <div class="m-widget5__stats1 pull-right" style="margin-right: 40px;">
                                                    <span class="m-widget5__number" style="margin-right: 0px">${{ $last_revision->price }}</span><br>
                                                    <span class="m-widget5__sales">{{ __('meta') }}</span>
                                                </div>

                                                <div class="m-widget5__stats1">
                                                    <a href="{{ route('show.backend.project',$last_revision->slug) }}"
                                                       class="btn btn-secondary m-btn m-btn--icon m-btn--pill">
                                                    <span><i class="la la-info-circle"></i>
                                                    <span>{{ __('mas_informacion') }}</span></span>
                                                    </a>
                                                    @if($last_revision->status == 4)
                                                        <a href="{{ route('projects.show',$last_revision->slug) }}"
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
                                            <strong>{{ __('ningun_proyect_estado') }}</strong>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <!--=====================================
                            ULTMOS PROYECTOS PRE APROBADOS
                            ======================================-->
                            <div class="tab-pane" id="m_widget5_tab2_content" aria-expanded="false">
                                <div class="m-widget5">
                                    @forelse($last_pre_approved as $last_pre_approveds)
                                        <div class="m-widget5__item">
                                            <div class="m-widget5__content">
                                                <div class="m-widget5__pic">
                                                    @if(Storage::disk('public')->exists('projects/'.$last_pre_approveds->project_picture))
                                                        <img src="{{ auth()->user()->pathAttachment() }}" alt=""/>
                                                    @else
                                                        <img class="m-widget7__img"
                                                             src="{{ $last_pre_approveds->project_picture }}"
                                                             alt="">
                                                    @endif

                                                </div>
                                                <div class="m-widget5__section">
                                                    <span
                                                        class="m-badge m-badge--brand m-badge--wide m-badge--rounded pull-right"
                                                        style="font-size:13px; background-color: #9C26EA !important;">{{ __('pre_aprobado') }}</span>
                                                    <h4 class="m-widget5__title">
                                                        {{ str_limit($last_pre_approveds->title,40) }}
                                                    </h4>
                                                    <span class="m-widget5__desc m--font-success"
                                                          style="font-size: 14px">
                                                    {{ $last_pre_approveds->category->category }}
                                                </span>
                                                    <div class="m-widget5__info">
                                                        <span
                                                            class="m-widget5__author">{{ str_limit($last_pre_approveds->short_description,200)}}</span>
                                                    </div>
                                                </div>

                                                <div class="m-widget5__stats2 pull-right" >
                                                    <span class="m-widget5__number">$10000</span><br>
                                                    <span class="m-widget5__votes">{{ __('fondos_recaudados') }}</span>
                                                </div>
                                                <div class="m-widget5__stats1 pull-right" style="margin-right: 40px;">
                                                    <span class="m-widget5__number" style="margin-right: 0px">${{ $last_pre_approveds->price }}</span><br>
                                                    <span class="m-widget5__sales">{{ __('meta') }}</span>
                                                </div>

                                                <div class="m-widget5__stats1">
                                                    <a href="{{ route('show.backend.project',$last_pre_approveds->slug) }}"
                                                       class="btn btn-secondary m-btn m-btn--icon m-btn--pill">
                                                    <span><i class="la la-info-circle"></i>
                                                    <span>{{ __('mas_informacion') }}</span></span>
                                                    </a>
                                                    @if($last_pre_approveds->status == 4)
                                                        <a href="{{ route('projects.show',$last_pre_approveds->slug) }}"
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
                                            <strong>{{ __('ningun_proyect_estado') }}</strong>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <!--=====================================
                            ULTMOS PROYECTOS APROBADOS
                            ======================================-->
                            <div class="tab-pane" id="m_widget5_tab3_content" aria-expanded="false">
                                <div class="m-widget5">
                                    @forelse($last_approved as $last_approveds)
                                        <div class="m-widget5__item">
                                            <div class="m-widget5__content">
                                                <div class="m-widget5__pic">
                                                    @if(Storage::disk('public')->exists('projects/'.$last_approveds->project_picture))
                                                        <img src="{{ auth()->user()->pathAttachment() }}" alt=""/>
                                                    @else
                                                        <img class="m-widget7__img"
                                                             src="{{ $last_approveds->project_picture }}"
                                                             alt="">
                                                    @endif

                                                </div>
                                                <div class="m-widget5__section">
                                                    <span
                                                        class="m-badge m-badge--success m-badge--wide m-badge--rounded pull-right"
                                                        style="font-size:13px;">{{ __('aprobado') }}</span>
                                                    <h4 class="m-widget5__title">
                                                        {{ str_limit($last_approveds->title,40) }}
                                                    </h4>
                                                    <span class="m-widget5__desc m--font-success"
                                                          style="font-size: 14px">
                                                    {{ $last_approveds->category->category }}
                                                </span>
                                                    <div class="m-widget5__info">
                                                        <span
                                                            class="m-widget5__author">{{ str_limit($last_approveds->short_description,200)}}</span>
                                                    </div>
                                                </div>

                                                <div class="m-widget5__stats2 pull-right" >
                                                    <span class="m-widget5__number">$10000</span><br>
                                                    <span class="m-widget5__votes">{{ __('fondos_recaudados') }}</span>
                                                </div>
                                                <div class="m-widget5__stats1 pull-right" style="margin-right: 40px;">
                                                    <span class="m-widget5__number" style="margin-right: 0px">${{ $last_approveds->price }}</span><br>
                                                    <span class="m-widget5__sales">{{ __('meta') }}</span>
                                                </div>

                                                <div class="m-widget5__stats1">
                                                    <a href="{{ route('show.backend.project',$last_approveds->slug) }}"
                                                       class="btn btn-secondary m-btn m-btn--icon m-btn--pill">
                                                    <span><i class="la la-info-circle"></i>
                                                    <span>{{ __('mas_informacion') }}</span></span>
                                                    </a>
                                                    @if($last_approveds->status == 4)
                                                        <a href="{{ route('projects.show',$last_approveds->slug) }}"
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
                                            <strong>{{ __('ningun_proyect_estado') }}</strong>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <!--=====================================
                            ULTMOS PROYECTOS PUBLICADOS
                            ======================================-->
                            <div class="tab-pane" id="m_widget5_tab4_content" aria-expanded="false">
                                <div class="m-widget5">
                                    @forelse($last_published as $last_publisheds)
                                        <div class="m-widget5__item">
                                            <div class="m-widget5__content">
                                                <div class="m-widget5__pic">
                                                    @if(Storage::disk('public')->exists('projects/'.$last_publisheds->project_picture))
                                                        <img src="{{ auth()->user()->pathAttachment() }}" alt=""/>
                                                    @else
                                                        <img class="m-widget7__img"
                                                             src="{{ $last_publisheds->project_picture }}"
                                                             alt="">
                                                    @endif

                                                </div>
                                                <div class="m-widget5__section">
                                                    <span
                                                        class="m-badge m-badge--info m-badge--wide m-badge--rounded pull-right"
                                                        style="font-size:13px;">{{ __('publicado') }}</span>
                                                    <h4 class="m-widget5__title">
                                                        {{ str_limit($last_publisheds->title,40) }}
                                                    </h4>
                                                    <span class="m-widget5__desc m--font-success"
                                                          style="font-size: 14px">
                                                    {{ $last_publisheds->category->category }}
                                                </span>
                                                    <div class="m-widget5__info">
                                                        <span
                                                            class="m-widget5__author">{{ str_limit($last_publisheds->short_description,200)}}</span>
                                                    </div>
                                                </div>
                                                <div class="m-widget5__stats2 pull-right" >
                                                    <span class="m-widget5__number">$10000</span><br>
                                                    <span class="m-widget5__votes">{{ __('fondos_recaudados') }}</span>
                                                </div>
                                                <div class="m-widget5__stats1 pull-right" style="margin-right: 40px;">
                                                    <span class="m-widget5__number" style="margin-right: 0px">${{ $last_publisheds->price }}</span><br>
                                                    <span class="m-widget5__sales">{{ __('meta') }}</span>
                                                </div>
                                                <div class="m-widget5__stats1">
                                                    <a href="{{ route('show.backend.project',$last_publisheds->slug) }}"
                                                       class="btn btn-secondary m-btn m-btn--icon m-btn--pill">
                                                    <span><i class="la la-info-circle"></i>
                                                    <span>{{ __('mas_informacion') }}</span></span>
                                                    </a>
                                                    @if($last_publisheds->status == 4)
                                                        <a href="{{ route('projects.show',$last_publisheds->slug) }}"
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
                                            <strong>{{ __('ningun_proyect_estado') }}</strong>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <!--=====================================
                            ULTMOS PROYECTOS RECHAZADOS
                            ======================================-->
                            <div class="tab-pane" id="m_widget5_tab5_content" aria-expanded="false">
                                <div class="m-widget5">
                                    @forelse($last_rejected as $last_rejecteds)
                                        <div class="m-widget5__item">
                                            <div class="m-widget5__content">
                                                <div class="m-widget5__pic">
                                                    @if(Storage::disk('public')->exists('projects/'.$last_rejecteds->project_picture))
                                                        <img src="{{ auth()->user()->pathAttachment() }}" alt=""/>
                                                    @else
                                                        <img class="m-widget7__img"
                                                             src="{{ $last_rejecteds->project_picture }}"
                                                             alt="">
                                                    @endif

                                                </div>
                                                <div class="m-widget5__section">
                                                    <span
                                                        class="m-badge m-badge--danger m-badge--wide m-badge--rounded pull-right"
                                                        style="font-size:13px;">{{ __('rechazado') }}</span>
                                                    <h4 class="m-widget5__title">
                                                        {{ str_limit($last_rejecteds->title,40) }}
                                                    </h4>
                                                    <span class="m-widget5__desc m--font-success"
                                                          style="font-size: 14px">
                                                    {{ $last_rejecteds->category->category }}
                                                </span>
                                                    <div class="m-widget5__info">
                                                        <span
                                                            class="m-widget5__author">{{ str_limit($last_rejecteds->short_description,200)}}</span>
                                                    </div>
                                                </div>
                                                <div class="m-widget5__stats2 pull-right" >
                                                    <span class="m-widget5__number">$10000</span><br>
                                                    <span class="m-widget5__votes">{{ __('fondos_recaudados') }}</span>
                                                </div>
                                                <div class="m-widget5__stats1 pull-right" style="margin-right: 40px;">
                                                    <span class="m-widget5__number" style="margin-right: 0px">${{ $last_rejecteds->price }}</span><br>
                                                    <span class="m-widget5__sales">{{ __('meta') }}</span>
                                                </div>
                                                <div class="m-widget5__stats1">
                                                    <a href="{{ route('show.backend.project',$last_rejecteds->slug) }}"
                                                       class="btn btn-secondary m-btn m-btn--icon m-btn--pill">
                                                    <span><i class="la la-info-circle"></i>
                                                    <span>{{ __('mas_informacion') }}</span></span>
                                                    </a>
                                                    @if($last_rejecteds->status == 4)
                                                        <a href="{{ route('projects.show',$last_rejecteds->slug) }}"
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
                                            <strong>{{ __('ningun_proyect_estado') }}</strong>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Grafica de ultimos proyectos -->
            <div class="m-portlet ">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text m-link m--font-success m--font-bolder">
                                    {{__("title_ultimos_proyectos_registrados")}}
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <div class='input-group pull-right' id='date_chart_new_projects'>
                                <input type='text' class="form-control m-input" readonly placeholder="Select date range" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body" id="contenedorProyectos">
                        <div id="char_ultimos_proyectos" style="height:250px;"></div>
                        <p class="alert m-alert--default text-center ultimos__proyectos--text">{{__("no_data_chart")}}</p>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-xl-4 m-portlet--full-height">
            <!--begin:: Widgets/New Users-->
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                <a class="m-link m--font-success m--font-bolder" href="{{route('index.artists')}}"
                                   style="padding-bottom: 5px;cursor: pointer;font-size: 15px">{{ __('nuevos_artistas') }}
                                </a>

                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_widget4_tab1_content">

                            <div class="m-widget4">

                                @forelse($last_artists as $last_artist)
                                <div class="m-widget4__item">
                                    <div class="m-widget4__img m-widget4__img--pic">
                                        @if(Storage::disk('public')->exists('users/'.$last_artist->users->picture))
                                        <img src="{{ $last_artist->users->pathAttachment()}}" alt="">
                                            @else
                                            <img src="{{ $last_artist->users->picture}}" alt="">
                                        @endif
                                    </div>
                                    <div class="m-widget4__info">
                                        @if($last_artist->nickname == null)
															<span class="m-widget4__title">
                                                                {{ $last_artist->users->name }} {{ $last_artist->users->last_name }}
															</span><br>
                                        @else
                                            <span class="m-widget4__title">
                                                                {{ $last_artist->nickname }}
															</span><br>
                                        @endif

                                        <span class="m-widget4__sub">
                                             @if($last_artist->countries != null)
                                                <img data-toggle="tooltip" title="{{ $last_artist->countries->country }}"
                                                     src="{{ $last_artist->countries->flag }}" width="21" alt="" style="">
                                                {{ $last_artist->countries->country }}
                                            @endif

                                        </span>
                                    </div>
                                    <div class="m-widget4__ext">
                                        <a href="#"
                                           class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">Info</a>
                                    </div>
                                </div>
                                    @empty
                                    <div class="alert m-alert--default text-center">
                                        <strong>{{ __('ningun_proyect_estado') }}</strong>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafica de ultimos proyectos -->
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text m-link m--font-success m--font-bolder">
                                {{__("title_top_country_char")}}
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <!--
                        <div class='input-group pull-right' id='date_chart_new_projects'>
                            <input type='text' class="form-control m-input" readonly placeholder="Select date range" />
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                            </div>
                        </div>
                    -->
                    </div>
                </div>
                <div class="m-portlet__body" id="contenedorTopCountry">
                    <div id="char_top_country" style="height: 300px;"></div>
                    <p class="alert m-alert--default text-center top__country--text">{{__("no_data_chart")}}</p>
                </div>
            </div>
        </div>

    </div>
</div>

@push('js')
    <script>
    setUrl("proyectosNuevos", "{{ route("admin.projects_news") }}");
    setUrl("topCountry", "{{ route("admin.top_country") }}");
    setText("proyectosRevision", "{{ __("proyectos_en_revicion_chart")}}");
    </script>
    <script src="/backend/assets/vendors/custom/flot/flot.bundle.min.js"></script>
    <script src="/js/storage.js"></script>
    <script src="/js/ajax.js"></script>
    <script src="/js/daterangepicker.js"></script>
    <script src="/backend/admin/js/dashboard.js"></script>   
     
    
    <script src="/backend/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <script src="/backend/assets/demo/custom/crud/datatables/basic/headers.js" type="text/javascript"></script>
    
    
@endpush
