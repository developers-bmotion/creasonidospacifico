@extends('frontend.layout')
@push('css')
    <link rel="stylesheet" href="/frontend/css/project_home.css">
@endpush
@section('content')
    <!--=====================================
	SLIDER DE INICIO
    ======================================-->
    <section class="xs-screen-height xs-welcome-section xs-bg fundpress-welcome-section">
        <div class="xs-banner-slider owl-carousel">
            <!--=====================================
	         SLIDER 1
             ======================================-->
            <div class="xs-banner-slider-item" style="background-image: url(/frontend/images/slider_home/slider_home_1_edit.jpg);background-position: center; background-size: cover;margin-top: 108px;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="xs-welcome-content version-3">
                                <div class="xs-welcome-wraper">
                                    <h2 class="color-white" style="color: white !important;">{{ __('deja_huella_musica') }}</h2>
                                    <p style="color: white;font-size: 20px;margin-top: -40px;">{{ __('solo_registrate_graba_video') }}</p>
                                    {{--<div class="xs-skill-bar-v2" data-percent="65%">
                                        <div class="xs-skill-track">
                                            <p><span class="number-percentage-count">65</span>%</p>
                                        </div>
                                    </div>--}}
                                    {{--<ul class="fundpress-welcome-list-content list-inline">
                                        <li>$45,280<span class="d-block">Pledged</span></li>
                                        <li>$87,000<span class="d-block">Goal</span></li>
                                        <li>119<span class="d-block">Backers</span></li>
                                    </ul>--}}
                                    <div class="xs-btn-wraper">
                                    <a href="{{ route("info-artist")}}" class="xs-btn btn-primary round-btn">{{ __('mas_informacion') }}</a>
                                        <a href="{{ route("add.project") }}" class="xs-btn btn navy-blue-btn round-btn" style="margin-bottom: 36px; !important;">{{ __('iniciar_proyecto') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" >
                            {{--<div class="xs-welcome-content">
                                <div class="xs-welcome-wraper">
                                    <img src="assets/images/slider_3_1.png" alt="">
                                </div><!-- .xs-welcome-wraper END -->
                            </div><--}}
                        </div>
                    </div>
                </div>
            </div>
            <!--=====================================
	         SLIDER 2
             ======================================-->
            {{--<div class="xs-banner-slider-item" style="background-image: url(/frontend/images/slider_home/slider_home_1_edit.jpg);background-position: center; background-size: cover;margin-top: 108px;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="xs-welcome-content fundpress-welcome-content">
                                <div class="xs-welcome-wraper fundpress-welcome-wraper">
                                    <div class="xs-welcome-title fundpress-welcome-title">
                                        <h2 class="color-navy-blue">Exclusive Bunny Cam</h2>
                                    </div>
                                    <ul class="xs-list-with-content fundpress-welcome-list-content">
                                        <li>US $45,280.00<span>Pledged</span></li>
                                        <li>US $87,000.00<span>Goal</span></li>
                                    </ul>
                                    <div class="xs-btn-wraper">
                                        <a href="#" class="xs-btn round-btn navy-blue-btn icon-btn"><i class="fa fa-heart"></i>invest Now</a>
                                        <a href="#" class="xs-btn round-btn blue-btn icon-btn"><i class="fa fa-facebook"></i>Share Now</a>
                                    </div>
                                </div><!-- .xs-welcome-wraper .fundpress-welcome-wraper END -->
                            </div><!-- .xs-welcome-content .fundpress-welcome-content END -->
                        </div>
                    </div>
                </div>
            </div>--}}
            @forelse($projects_slider as $project)
            <div class="xs-banner-slider-item" style="">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="xs-welcome-content version-3">
                                <div class="xs-welcome-wraper">
                                    <h2>{{ $project->title }}</h2>
                                    <div class="xs-skill-bar-v2" data-percent="65%">
                                        <div class="xs-skill-track">
                                            <p><span class="number-percentage-count">65</span>%</p>
                                        </div>
                                    </div>
                                    <ul class="fundpress-welcome-list-content list-inline">
                                        <li>$45,280<span class="d-block">{{ __('prometido') }}</span></li>
                                        <li>$87,000<span class="d-block">{{ __('meta') }}</span></li>
                                        <li>119<span class="d-block">{{ __('patrocinadores') }}</span></li>
                                    </ul>
                                    <div class="xs-btn-wraper">
                                        <a href="{{ route('projects.show',$project->slug) }}" class="xs-btn navy-blue-btn round-btn">{{ __('ver_proyecto') }}</a>
                                    </div>
                                </div><!-- .xs-welcome-wraper END -->
                            </div><!-- .xs-welcome-content END -->
                        </div>
                        <div class="col-lg-6">
                            <div class="xs-welcome-content">
                                <div class="xs-welcome-wraper">
                                    <iframe width="560" height="315"
                                    id="videoYoutube"
                                    src="https://www.youtube.com/embed/{{$project->iframe_video}}"
                                    frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                    </iframe>
                                </div><!-- .xs-welcome-wraper END -->
                            </div><!-- .xs-welcome-content END -->
                        </div>
                    </div>
                </div>
            </div>
                @empty
                @endforelse
        </div>
    </section>
    <!-- descripcion de  service -->
    <section class="xs-navy-blue-bg fundpress-square-service-section">
        <div class="container">
            <div class="fundpress-section-heading fundpress-heading-title fundpress-heading-title-v2 content-left">
            <h2 class="color-white">{{__('title_home')}}</h2>
            </div><!-- .xs-heading-title .fundpress-heading-title-v2 .fundpress-heading-title END -->
            <div class="row">
                <div class="col-md-6 col-sm-12 col-lg-3">
                    <div class="fundpress-icon-with-square-service">
                        <img src="/frontend/images/home/talento.PNG" width="60" height="50" style="margin-right: auto;margin-bottom: auto;">
                        <a href="#" class="color-white">{{__('talento')}}</a>
                        <p>{{__('par_talento')}} </p>
                    </div><!-- .fundpress-icon-with-square-service END -->
                </div>
                <div class="col-md-6 col-sm-12 col-lg-3">
                    <div class="fundpress-icon-with-square-service">
                        <img src="/frontend/images/home/Apoyo.PNG" width="60" height="50" style="margin-right: auto;margin-bottom: auto;">
                        <a href="#" class="color-white">{{__('apoyo')}}</a>
                        <p>{{__('par_apoyo')}}.</p>
                    </div><!-- .fundpress-icon-with-square-service END -->
                </div>
                <div class="col-md-6 col-sm-12 col-lg-3">
                    <div class="fundpress-icon-with-square-service">
                        <img src="/frontend/images/home/comunidad.PNG" width="60" height="50" style="margin-right: auto;margin-bottom: auto;">
                        <a href="#" class="color-white">{{__('comunidad')}}</a>
                        <p>{{__('par_comunidad')}}</p>
                    </div><!-- .fundpress-icon-with-square-service END -->
                </div>
                <div class="col-md-6 col-sm-12 col-lg-3">
                    <div class="fundpress-icon-with-square-service">
                        <img src="/frontend/images/home/rentabilidad.PNG" width="60" height="50" style="margin-right: auto;margin-bottom: auto;">
                        <a href="#" class="color-white">{{__('rentabilidad')}}</a>
                        <p>{{__('par_rentabilidad')}} </p>
                    </div><!-- .fundpress-icon-with-square-service END -->
                </div>
            </div>
        </div>
        <div class="xs-shape-background">
            <div class="xs-waves">
                <div class="xs-wave xs-wave_1"></div>
                <div class="xs-wave xs-wave_2"></div>
                <div class="xs-wave xs-wave_3"></div>
                <div class="xs-wave xs-wave_4"></div>
                <div class="xs-wave xs-wave_5"></div>
            </div>
        </div>
    </section>    <!-- End square service -->
   

    <!--=====================================
    PROYECTOS POR CATEGORIAS
    ======================================-->
    <section id="cause-matters" class="waypoint-tigger xs-section-padding">
        <div class="container">
            <div class="xs-section-heading row xs-margin-0">
                <div class="fundpress-heading-title xs-padding-0 col-md-9 col-xl-9">
                    <h2 class="color-navy-blue">{{ __('explora_todos_los_proyectos') }}</h2>
                    <span class="xs-separetor dashed-separetor fundpress-separetor"></span>
                    <p>{{ __('apoya_nuestros_proyectos') }}</p>
                </div><!-- .fundpress-heading-title .xs-col-9 END -->
                <div class="xs-btn-wraper xs-padding-0 col-xl-3 col-md-3 d-flex-center-end">
                    <a href="{{ route('projects') }}" class="xs-btn round-btn navy-blue-btn">{{ __('todos_proyectos') }}</a>
                </div><!-- .xs-btn-wraper .xs-col-3 .d-flex-center-end END -->
            </div><!-- .xs-section-heading .fundpress-section-heading .xs-spilit-container END -->
            <div class="xs-tab-wraper fundpress-tab-wraper" id="containerProject">
                <div class="fundpress-tab-nav xs-tab-nav">
                    <ul class="nav nav-tabs" role="tablist" id="categoryProjects">
                        @foreach($categories as $categorie)
                            <li class="nav-item" data-category="{{$categorie->category}}" data-id="{{$categorie->id}}">
                                <a class="nav-link" href="#projectsView{{ $categorie->id }}" role="tab"
                                   data-toggle="tab">{{ $categorie->category }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-content" id="dataCategory" style="min-height: 5rem">
                    @foreach($categories as $categorie)
                        <div role="tabpanel" class="tab-pane fade in" id="projectsView{{$categorie->id}}"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>    <!-- End cause matters -->

    {{-- ++++++++++++++++++++
        ++++++++++++++++++++++ --}}
         <!--=====================================
    INFO PATROCINADORES Y ARTISTAS
    ======================================-->
    <section class="xs-full-width-section fundpress-full-width-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-6 xs-padding-0">
                    <div class="fundpress-full-width-wraper-v2"
                         style="background-image: url(/frontend/images/home/artist_info.jpg)">
                        <div class="fundpress-product-hover-content-v2">
                            <div class="fundpress-sub-title">
                                <h2>{{ __('artista') }}</h2>
                            </div>
                            <div class="fundpress-product-text-content">
                                <p>{{ __('aqui_podras_info_artista') }}</p>
                            </div>
                            <div class="xs-btn-wrapre">
                                <a href="{{ route('info-artist') }}"
                                   class="xs-btn btn xs-box-shadow btn-primary btn-lg round-btn">{{ __('mas_informacion') }}</a>
                            </div>
                        </div><!-- .fundpress-product-hover-content-v2 END -->
                        <div class="xs-solid-overlay xs-bg-black"></div>
                    </div><!-- .fundpress-full-width-wraper-v2 END -->
                </div>
                <div class="col-md-12 col-lg-6 xs-padding-0">
                    <div class="fundpress-full-width-wraper-v2"
                         style="background-image: url(/frontend/images/home/backer_info.jpg)">
                        <div class="fundpress-product-hover-content-v2">
                            <div class="fundpress-sub-title">
                                <h2>{{ __('patrocinador') }}</h2>
                            </div>
                            <div class="fundpress-product-text-content">

                                {{--<p>We recently we discovered a major problem – organizing accessories for these Apple
                                    devices while on the road or in our workspace was a major.</p>--}}

                                <p>{{ __('aqui_podras_info_patrocinador') }}</p>

                            </div>
                            <div class="xs-btn-wrapre">
                            <a href="{{route('info-backer')}}"
                                   class="xs-btn xs-box-shadow btn btn-primary btn-lg round-btn">{{ __('mas_informacion') }}</a>
                            </div>
                        </div><!-- .fundpress-product-hover-content-v2 END -->
                        <div class="xs-solid-overlay xs-bg-black"></div>
                    </div><!-- .fundpress-full-width-wraper-v2 END -->
                </div>
            </div>
        </div>
    </section>    <!-- End side by side product -->

    

    <!-- popular campaigns -->
    <section id="popular-campaigns" class="xs-gray-bg waypoint-tigger xs-section-padding">
        <div class="container">
            <div class="xs-section-heading row xs-margin-0">
                <div class="fundpress-heading-title xs-padding-0 col-xl-9 col-md-9">
                    <h2 class="color-navy-blue">{{ __('casos_de_exito') }}</h2>
                    <span class="xs-separetor dashed-separetor fundpress-separetor"></span>
                    <p>{{ __('ellos_han_recaudado') }}</p>
                </div><!-- .xs-heading-title .fundpress-heading-title .xs-col-9 END -->
                <div class="xs-btn-wraper xs-padding-0 col-xl-3 col-md-3 d-flex-center-end">
                    <a href="#" class="xs-btn round-btn navy-blue-btn">{{ __('ver_todos') }}</a>
                </div><!-- .xs-btn-wraper .xs-col-3 .d-flex-center-end END -->
            </div><!-- .xs-section-heading .fundpress-section-heading .xs-spilit-container END -->
            <div class="xs-tab-wraper fundpress-tab-wraper" id="containerProjectC">
                <div class="fundpress-tab-nav xs-tab-nav">
                    <ul class="nav nav-tabs" role="tablist" id="categoryProjectsC">
                        @foreach($categories as $categorie)
                            <li class="nav-item" data-category="{{$categorie->category}}" data-id="{{$categorie->id}}">
                                <a class="nav-link" href="#projectsViewC{{ $categorie->id }}" role="tab"
                                   data-toggle="tab">{{ $categorie->category }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-content" id="dataCategory" style="min-height: 5rem">
                    @foreach($categories as $categorie)
                        <div role="tabpanel" class="tab-pane fade in" id="projectsViewC{{$categorie->id}}"></div>
                    @endforeach
                </div>
            </div>
            {{--<div class="row">
                <div class="col-lg-4">
                    <div class="xs-box-shadow fundpress-popular-item xs-bg-white">
                        <div class="fundpress-item-header">
                            <img src="/images/campaigns/campaigns-1.jpg" alt="">
                            <div class="xs-item-header-content">
                                <div class="xs-skill-bar">
                                    <div class="xs-skill-track">
                                        <p><span class="number-percentage-count number-percentage" data-value="90"
                                                 data-animation-duration="3500">0</span>%</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .xs-item-header .fundpress-item-header END -->
                        <div class="fundpress-item-content xs-content-padding bg-color-white">
                            <ul class="xs-simple-tag fundpress-simple-tag">
                                <li><a href="">Technology</a></li>
                            </ul>
                            <a href="#" class="d-block color-navy-blue fundpress-post-title">Splash Drone 3 a Fully
                                Waterproof Drone that floats</a>
                            <ul class="xs-list-with-content fundpress-list-item-content">
                                <li>$67,000<span>Pledged</span></li>
                                <li><span class="number-percentage-count number-percentage" data-value="90"
                                          data-animation-duration="3500">0</span>% <span>Funded</span></li>
                                <li>3<span>Days to go</span></li>
                            </ul>
                            <span class="xs-separetor border-separetor xs-separetor-v2 fundpress-separetor"></span>
                            <div class="row xs-margin-0">
                                <div class="full-round fundpress-avatar">
                                    <img src="/images/avatar/avatar_1.jpg" alt="">
                                </div>
                                <div class="xs-avatar-title">
                                    <a href="#"><span>By</span>Ema Watson</a>
                                </div>
                            </div>
                        </div><!-- .fundpress-item-content END -->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="xs-box-shadow fundpress-popular-item xs-bg-white">
                        <div class="fundpress-item-header">
                            <img src="/images/campaigns/campaigns-2.jpg" alt="">
                            <div class="xs-item-header-content">
                                <div class="xs-skill-bar">
                                    <div class="xs-skill-track">
                                        <p><span class="number-percentage-count number-percentage" data-value="59"
                                                 data-animation-duration="3500">0</span>%</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .xs-item-header .fundpress-item-header END -->
                        <div class="fundpress-item-content xs-content-padding bg-color-white">
                            <ul class="xs-simple-tag fundpress-simple-tag">
                                <li><a href="">Charity</a></li>
                            </ul>
                            <a href="#" class="d-block color-navy-blue fundpress-post-title">The Read Read: Braille
                                Literacy Tool for the Blind</a>
                            <ul class="xs-list-with-content fundpress-list-item-content">
                                <li>$33,600<span>Pledged</span></li>
                                <li><span class="number-percentage-count number-percentage" data-value="59"
                                          data-animation-duration="3500">0</span>% <span>Funded</span></li>
                                <li>10<span>Days to go</span></li>
                            </ul>
                            <span class="xs-separetor border-separetor xs-separetor-v2 fundpress-separetor"></span>
                            <div class="row xs-margin-0">
                                <div class="full-round fundpress-avatar">
                                    <img src="/images/avatar/avatar_2.jpg" alt="">
                                </div>
                                <div class="xs-avatar-title">
                                    <a href="#"><span>By</span>Kene Williamson</a>
                                </div>
                            </div>
                        </div><!-- .fundpress-item-content END -->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="xs-box-shadow fundpress-popular-item xs-bg-white">
                        <div class="fundpress-item-header">
                            <img src="/images/campaigns/campaigns-3.jpg" alt="">
                            <div class="xs-item-header-content">
                                <div class="xs-skill-bar">
                                    <div class="xs-skill-track">
                                        <p><span class="number-percentage-count number-percentage" data-value="35"
                                                 data-animation-duration="3500">0</span>%</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .xs-item-header .fundpress-item-header END -->
                        <div class="fundpress-item-content xs-content-padding bg-color-white">
                            <ul class="xs-simple-tag fundpress-simple-tag">
                                <li><a href="">Funding</a></li>
                                <li><a href="">Charity</a></li>
                            </ul>
                            <a href="#" class="d-block color-navy-blue fundpress-post-title">BuildOne: $99 3D Printer w/
                                WiFi and Auto Bed Leveling!</a>
                            <ul class="xs-list-with-content fundpress-list-item-content">
                                <li>$12,760<span>Pledged</span></li>
                                <li><span class="number-percentage-count number-percentage" data-value="35"
                                          data-animation-duration="3500">0</span>% <span>Funded</span></li>
                                <li>66<span>Days to go</span></li>
                            </ul>
                            <span class="xs-separetor border-separetor xs-separetor-v2 fundpress-separetor"></span>
                            <div class="row xs-margin-0">
                                <div class="full-round fundpress-avatar">
                                    <img src="/images/avatar/avatar_3.jpg" alt="">
                                </div>
                                <div class="xs-avatar-title">
                                    <a href="#"><span>By</span>Leo Baddabes</a>
                                </div>
                            </div>
                        </div><!-- .fundpress-item-content END -->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="xs-box-shadow fundpress-popular-item xs-bg-white">
                        <div class="fundpress-item-header">
                            <img src="/images/campaigns/campaigns-4.jpg" alt="">
                            <div class="xs-item-header-content">
                                <div class="xs-skill-bar">
                                    <div class="xs-skill-track">
                                        <p><span class="number-percentage-count number-percentage" data-value="85"
                                                 data-animation-duration="3500">0</span>%</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .xs-item-header .fundpress-item-header END -->
                        <div class="fundpress-item-content xs-content-padding bg-color-white">
                            <ul class="xs-simple-tag fundpress-simple-tag">
                                <li><a href="">Games</a></li>
                                <li><a href="">Technology</a></li>
                            </ul>
                            <a href="#" class="d-block color-navy-blue fundpress-post-title">DACBerry PRO – Professional
                                Soundcard for Raspberry Pi</a>
                            <ul class="xs-list-with-content fundpress-list-item-content">
                                <li>$99,980<span>Pledged</span></li>
                                <li><span class="number-percentage-count number-percentage" data-value="85"
                                          data-animation-duration="3500">0</span>% <span>Funded</span></li>
                                <li>2<span>Days to go</span></li>
                            </ul>
                            <span class="xs-separetor border-separetor xs-separetor-v2 fundpress-separetor"></span>
                            <div class="row xs-margin-0">
                                <div class="full-round fundpress-avatar">
                                    <img src="/images/avatar/avatar_4.jpg" alt="">
                                </div>
                                <div class="xs-avatar-title">
                                    <a href="#"><span>By</span>Jhung Li</a>
                                </div>
                            </div>
                        </div><!-- .fundpress-item-content END -->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="xs-box-shadow fundpress-popular-item xs-bg-white">
                        <div class="fundpress-item-header">
                            <img src="/images/campaigns/campaigns-5.jpg" alt="">
                            <div class="xs-item-header-content">
                                <div class="xs-skill-bar">
                                    <div class="xs-skill-track">
                                        <p><span class="number-percentage-count number-percentage" data-value="74"
                                                 data-animation-duration="3500">0</span>%</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .xs-item-header .fundpress-item-header END -->
                        <div class="fundpress-item-content xs-content-padding bg-color-white">
                            <ul class="xs-simple-tag fundpress-simple-tag">
                                <li><a href="">Charity</a></li>
                            </ul>
                            <a href="#" class="d-block color-navy-blue fundpress-post-title">BIKI: First Bionic Wireless
                                Under water Fish Drone</a>
                            <ul class="xs-list-with-content fundpress-list-item-content">
                                <li>$40,000<span>Pledged</span></li>
                                <li><span class="number-percentage-count number-percentage" data-value="74"
                                          data-animation-duration="3500">0</span>% <span>Funded</span></li>
                                <li>70<span>Days to go</span></li>
                            </ul>
                            <span class="xs-separetor border-separetor xs-separetor-v2 fundpress-separetor"></span>
                            <div class="row xs-margin-0">
                                <div class="full-round fundpress-avatar">
                                    <img src="/images/avatar/avatar_5.jpg" alt="">
                                </div>
                                <div class="xs-avatar-title">
                                    <a href="#"><span>By</span>Chirstina Perry</a>
                                </div>
                            </div>
                        </div><!-- .fundpress-item-content END -->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="xs-box-shadow fundpress-popular-item xs-bg-white">
                        <div class="fundpress-item-header">
                            <img src="/images/campaigns/campaigns-6.jpg" alt="">
                            <div class="xs-item-header-content">
                                <div class="xs-skill-bar">
                                    <div class="xs-skill-track">
                                        <p><span class="number-percentage-count number-percentage" data-value="90"
                                                 data-animation-duration="3500">0</span>%</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .xs-item-header .fundpress-item-header END -->
                        <div class="fundpress-item-content xs-content-padding bg-color-white">
                            <ul class="xs-simple-tag fundpress-simple-tag">
                                <li><a href="">Charity</a></li>
                            </ul>
                            <a href="#" class="d-block color-navy-blue fundpress-post-title">Brilliant After All, A New
                                Album by Rebecca: Help poor people</a>
                            <ul class="xs-list-with-content fundpress-list-item-content">
                                <li>$98,900<span>Pledged</span></li>
                                <li><span class="number-percentage-count number-percentage" data-value="85"
                                          data-animation-duration="3500">0</span>% <span>Funded</span></li>
                                <li>2<span>Days to go</span></li>
                            </ul>
                            <span class="xs-separetor border-separetor xs-separetor-v2 fundpress-separetor"></span>
                            <div class="row xs-margin-0">
                                <div class="full-round fundpress-avatar">
                                    <img src="/images/avatar/avatar_6.jpg" alt="">
                                </div>
                                <div class="xs-avatar-title">
                                    <a href="#"><span>By</span>Prekina William</a>
                                </div>
                            </div>
                        </div><!-- .fundpress-item-content END -->
                    </div>
                </div>
            </div>--}}
        </div>
    </section>    <!-- End popular campaigns -->


    <section class="xs-bg fundpress-event-section xs-section-padding"
             style="background-image: url(/images/icons-background-1.png);">
        <div class="container">
            <div class="xs-section-heading row xs-margin-0">
                <div class="fundpress-heading-title xs-padding-0 col-md-9 col-xl-9">
                    <h2 class="color-navy-blue">{{ __('anuncios') }}</h2>
                    <span class="xs-separetor dashed-separetor fundpress-separetor"></span>
                    {{--<p>This equity FundPress platform allows businesses to sell shares in their company to accredited
                        investors.</p>--}}
                </div><!-- .xs-heading-title .fundpress-heading-title .xs-col-9 END -->
                <div class="xs-btn-wraper xs-padding-0 col-md-3 col-xl-3 d-flex-center-end">
                    <a href="events.html" class="xs-btn round-btn navy-blue-btn">{{ __('mas_informacion') }}</a>
                </div><!-- .xs-btn-wraper .d-flex-center-end .xs-col-3 END -->
            </div><!-- .xs-section-heading .fundpress-section-heading .xs-spilit-container END -->
            {{--<div class="fundpress-event-wraper">
                <div class="fundpress-single-event-wraper row">
                    <div class="col-md-3">
                        <div class="fundpress-event-image">
                            <img src="/images/event/event-1.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-6 fundpress-event-details">
                        <h3 class="color-white xs-post-title fundpress-post-title">Using HRV and CorSense to Otimize
                            Training.</h3>
                        <p>In a time of overwhelming emotions, sadness, and pain, the last thing the families need to be
                            worrying obligations associated with this tragic.</p>
                        <div class="countdown-container xs-countdown-timer" data-countdown="2019/01/01"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="fundpress-btn-wraper">
                            <a href="#" class="xs-btn round-btn green-btn">subscribe</a>
                        </div>
                    </div>
                </div><!-- .fundpress-single-event-wraper END -->
                <div class="fundpress-single-event-wraper row">
                    <div class="col-md-3">
                        <div class="fundpress-event-image">
                            <img src="/images/event/event-2.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-6 fundpress-event-details">
                        <h3 class="color-white xs-post-title fundpress-post-title">Otimize Training & Recovery Using
                            HRV</h3>
                        <p>In a time of overwhelming emotions, sadness, and pain, the last thing the families need to be
                            worrying obligations associated with this tragic.</p>
                        <div class="countdown-container xs-countdown-timer" data-countdown="2020/01/01"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="fundpress-btn-wraper">
                            <a href="#" class="xs-btn round-btn green-btn">subscribe</a>
                        </div>
                    </div>
                </div><!-- .fundpress-single-event-wraper END -->
            </div>--}}
        </div>
    </section>    <!-- End event section -->


    <!-- sponsor section -->
    <section class="xs-bg xs-section-padding fundpress-sponsor-section"
             style="background-image: url(/images/background/sponsor_section_bg.jpg);">
        <div class="xs-solid-overlay xs-bg-white"></div>
        <div class="container fundpress-partners-wraper">
            <div class="fundpress-heading-title">
                <h2 class="color-navy-blue xs-mb-0">{{ __('ellos_son_quienes_apoyan') }}</h2>
            </div><!-- .xs-heading-title .fundpress-heading-title END -->
            <div class="content-center">
                <ul class="fundpress-partners">
                    <li><a href="#" class="full-round fundpress-single-partner"><img src="/images/partner/partner-1.png"
                                                                                     alt=""></a></li>
                    <li><a href="#" class="full-round fundpress-single-partner"><img src="/images/partner/partner-2.png"
                                                                                     alt=""></a></li>
                    <li><a href="#" class="full-round fundpress-single-partner"><img src="/images/partner/partner-3.png"
                                                                                     alt=""></a></li>
                    <li><a href="#" class="full-round fundpress-single-partner"><img src="/images/partner/partner-4.png"
                                                                                     alt=""></a></li>
                </ul><!-- .fundpress-partners END -->
            </div>
            <div class="content-center">
                <ul class="fundpress-partners">
                    <li><a href="#" class="full-round fundpress-single-partner"><img src="/images/partner/partner-5.png"
                                                                                     alt=""></a></li>
                    <li><a href="#" class="full-round fundpress-single-partner"><img src="/images/partner/partner-6.png"
                                                                                     alt=""></a></li>
                    <li><a href="#" class="full-round fundpress-single-partner"><img src="/images/partner/partner-7.png"
                                                                                     alt=""></a></li>
                    <li><a href="#" class="full-round fundpress-single-partner"><img src="/images/partner/partner-8.png"
                                                                                     alt=""></a></li>
                    <li><a href="#" class="full-round fundpress-single-partner"><img src="/images/partner/partner-9.png"
                                                                                     alt=""></a></li>
                </ul><!-- .fundpress-partners END -->
            </div>
        </div>
    </section>    <!-- End sponsor section -->
@stop

@push('js')
    <script src="/js/libs/moment-with-locales.min.js"></script>
    <script src="/frontend/js/card_project.js"></script>
    <script src="/frontend/js/projects_home.js"></script>
@endpush
