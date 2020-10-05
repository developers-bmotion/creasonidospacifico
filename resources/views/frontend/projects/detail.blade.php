@extends('frontend.layout')

@section('content')
    <section class="xs-inner-welcome-section fundpress-inner-welcome-section fundpress-inner-bg-1 parallax-window"
             data-parallax="scroll"
             style="background-image: url({{$project->project_picture }});background-position: center;background-attachment: fixed;background-repeat: no-repeat; background-size: cover;">
        <div class="xs-solid-overlay xs-bg-black"></div>
        <div class="container">
            <div class="fundpress-inner-welcome-content xs-inner-welcome-content">
                <!-- xs rating -->
            {{-- <ul class="xs-rating color-yellow xs-mb-30">
                 <li><a href=""><i class="fa fa-star"></i></a></li>
                 <li><a href=""><i class="fa fa-star"></i></a></li>
                 <li><a href=""><i class="fa fa-star"></i></a></li>
                 <li><a href=""><i class="fa fa-star"></i></a></li>
                 <li><a href=""><i class="fa fa-star-half-empty"></i></a></li>
             </ul>--}}
            <!-- End xs rating -->
                <h2 class="color-white">{{ $project->title }}</h2>
                <ul class="xs-tag-category-with-icon xs-mb-30">
                    <li><a href="{{  route('categories.show',$project->category->slug) }}" class="color-white"><i
                                    class="fa fa-tags color-green"></i>{{ $project->category->category }}</a></li>
                    <li><a href="" class="color-white"><img src="{{ $project->countryArtist($project->artists[0]->country_id)->flag }}" width="21" style="margin-top: -3px"> {{ $project->artists[0]->nickname }}</a>
                    </li>
                </ul>
                <ul class="xs-breadcumb fundpress-breadcumb">
                    <li><a href="{{ route('projects') }}" class="color-white">{{ __('proyectos') }}
                            /</a>{{ __('todos') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!--breadcumb end here--><!-- End welcome section -->

    <main class="xs-all-content-wrapper">
        <!-- fund details -->
        <section class="xs-content-section-padding xs-fund-details fundpress-fund-details">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-7">
                        <div class="xs-sync-slider-wraper xs-mb-50">
                            <div class="owl-carousel xs-sync-slider-preview xs-mb-10">
                                @foreach($project->images as $image)
                                <div class="xs-sync-slider-preview-content">
                                    <img src="{{ $image->pathAttachment() }}" alt="">
                                </div>
                                @endforeach
                                <div class="xs-sync-slider-preview-content">
                                    <iframe width="560" height="315" 
                                    id="videoYoutube"
                                    src="https://www.youtube.com/embed/{{$project->iframe_video}}"
                                    frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                                    </iframe>
                                </div>

                            </div><!-- xs-sync-slider-preview -->

                            <div class="owl-carousel xs-sync-slider-thumb">
                                @foreach($project->images as $image)
                                <div class="xs-sync-slider-thumb-content">
                                    <img src="{{ $image->pathAttachment() }}" width="10" alt="" style="height: 74px">
                                </div>
                                @endforeach
                                <div class="xs-sync-slider-thumb-content">
                                    <img src="/frontend//images/fondo_youtube.png" alt="">
                                    <div class="xs-sync-slider icon-position-center">
                                        <a href=""
                                           class="full-round icon-identify-btn blue-btn opacity-btn xs-box-shadow"><i
                                                    class="fa fa-play"></i></a>
                                    </div>
                                </div>

                            </div><!-- xs-sync-slider-thumb -->
                        </div><!-- xs-sync-slider-wraper -->
                        <div class="xs-text-content-tab">
                            <!-- Nav tabs -->
                            <div class="xs-tab-nav fundpress-tab-nav-v2 xs-mb-30">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#description" role="tab" data-toggle="tab">
                                            {{ __('descripcion') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#updates" role="tab" data-toggle="tab">
                                            {{ __('actualizaciones') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#comments_panel" role="tab" data-toggle="tab">
                                            {{ __('comentarios') }} <span class="color-green">({{ $project->reviews->count() }})</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#backers" role="tab" data-toggle="tab">
                                            {{ __('patrocinadores') }}
                                        </a>
                                    </li>
                                </ul>
                            </div><!-- xs-tab-nav fundpress-tab-nav-v2 xs-mb-30 -->
                            <!-- Tab panes -->
                            <div class="tab-content xs-text-tab-content">
                                <div role="tabpanel" class="tab-pane fadeInRights show fade in active" id="description">
                                    <h5 class="color-navy-blue xs-mb-30">{{ $project->short_description }}</h5>
                                    <p class="xs-content-description fundpress-content-description xs-mb-30">{{ $project->description }}</p>
                                </div><!-- tab-pane fadeInRights -->
                                <div role="tabpanel" class="tab-pane fadeInRights fade" id="updates">
                                    <div class="xs-ul-list fundpress-content-text-list-wraper">
                                        <ul class="fundpress-content-text-list xs-content-text-list">
                                            @forelse($project->updates as $update)
                                            <li>
                                                <p class="xs-content-description fundpress-content-description color-navy-blue">
                                                    {{ $update->created_at->toFormattedDateString() }}</p>
                                                <div class="fundpress-title-text-content">
                                                    <h4 class="color-navy-blue medium margin-bottom-0">{{ $update->title }}</h4>
                                                </div>
                                                <p class="xs-content-description fundpress-content-description xs-mb-30">{{ $update->description }}</p>
                                            </li>
                                             @empty
                                                <h1>No hay actualizaciones</h1>
                                            @endforelse
                                        </ul>
                                        <div class="xs-navy-blue-bg fundpress-porject-lunch xs-content-padding text-center content-left">
                                            <h3 class="color-white xs-mb-10 regular">{{ $project->created_at->toFormattedDateString() }}</h3>
                                            <h4 class="color-white xs-mb-0 semi-bold">{{ __('proyecto_lanzado') }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fadeInRights fade" id="comments_panel">
                                    <div class="xs-blog-post-comment border xs-content-padding">
                                        <!-- post comment -->
                                        <div id="comments" class="comments-area">
                                            <h4 class="comments-title"> {{ $project->reviews->count() }} {{ __('comentarios') }}</h4>
                                            <!-- start comment -->
                                            <ol class="comment-list">
                                                @forelse($project->reviews as  $review)
                                                <li id="comment-1"
                                                    class="comment byuser comment-author-admin bypostauthor even thread-even depth-1 parent">
                                                    <article id="div-comment-1" class="comment-body">
                                                        <footer class="comment-meta">
                                                            <div class="comment-author vcard">
                                                                <img alt="comment avatar image"
                                                                     src="{{ $review->users->pathAttachment() }}"
                                                                     class="avatar avatar-34 photo">
                                                                <b class="fn">{{ $review->users->name }}</b>
                                                            </div><!-- .comment-author -->
                                                            <div class="comment-metadata">
                                                                <a href="">
                                                                    <time datetime="2018-08-17T04:24:26+00:00">{{ $review->created_at->toFormattedDateString() }}
                                                                    </time>
                                                                </a>
                                                            </div><!-- .comment-metadata -->
                                                        </footer><!-- .comment-meta -->

                                                        <div class="comment-content">
                                                            <p>{{ $review->comment }}</p>
                                                        </div><!-- .comment-content -->
                                                    </article><!-- .comment-body -->
                                                </li>
                                                    @empty
                                                @endforelse
                                            </ol>
                                            <!-- end comment -->

                                            <!-- start respond form -->
                                            <div id="respond" class="comment-respond">
                                                <h3 id="reply-title" class="comment-reply-title">{{ __('deja_comentario') }}
                                                    <small>
                                                        <a rel="nofollow" id="cancel-comment-reply-link"
                                                           href="/wp/premix/hello-world-2/#respond"
                                                           style="display:none;">
                                                            Cancel reply</a>
                                                    </small>
                                                </h3>
                                                <div class="separator">
                                                    <span></span><span></span><span></span>
                                                </div>
                                                <form action="#" method="post" id="commentform" class="comment-form">

                                                    <div class="comment-info">
                                                        <input placeholder="Enter Name *" id="author"
                                                               class="comment-100" name="author" type="text" value=""
                                                               size="30" aria-required="true">

                                                        <input placeholder="Enter Email *" class="comment-50" id="email"
                                                               name="email" type="email" value="" size="30"
                                                               aria-required="true">

                                                        <input placeholder="Enter Website" class="comment-50" id="url"
                                                               name="url" type="url" value="" size="30">
                                                    </div>
                                                    <div class="commentright ">
                                                        <textarea placeholder="Enter Comments *" id="comment"
                                                                  name="comment" cols="45" rows="8"
                                                                  aria-required="true"></textarea>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p class="form-submit">
                                                        <input name="submit" type="submit" id="submit"
                                                               class="premix-btn light-red-btn coment-btn"
                                                               value="{{ __('publicar_comentario') }}">
                                                        <input type="hidden" name="comment_post_ID" value="165"
                                                               id="comment_post_ID">
                                                        <input type="hidden" name="comment_parent" id="comment_parent"
                                                               value="0">
                                                    </p>
                                                </form>
                                            </div>
                                            <!-- end respond form -->
                                        </div>
                                        <!-- end post comment -->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fadeInRights fade" id="backers">
                                    {{--<div class="xs-backers-lsit-wraprer">
                                        <ul class="fundpress-backer-lsit">
                                            <li class="row xs-margin-0">
                                                <div class="row xs-margin-0 col-md-6 text-left">
                                                    <div class="xs-avatar full-round">
                                                        <img src="assets/images/backers/backers-1.jpg" alt="">
                                                    </div>
                                                    <div class="fundpress-backer-info">
                                                        <h3 class="color-navy-blue semi-bold">Emerson Royle</h3>
                                                        <h4 class="color-green regular xs-mb-0">$54,821 - No reward</h4>
                                                    </div>
                                                </div>
                                                <div class="xs-btn-wraper col-md-6 text-right">
                                                    <a href="#" class="xs-btn round-btn navy-blue-btn">Details</a>
                                                </div>
                                            </li>
                                            <li class="row xs-margin-0">
                                                <div class="row xs-margin-0 col-md-6 text-left">
                                                    <div class="xs-avatar full-round">
                                                        <img src="assets/images/backers/backers-3.jpg" alt="">
                                                    </div>
                                                    <div class="fundpress-backer-info">
                                                        <h3 class="color-navy-blue semi-bold">Emmy Anderson</h3>
                                                        <h4 class="color-green regular xs-mb-0">$33,000 - No reward</h4>
                                                    </div>
                                                </div>
                                                <div class="xs-btn-wraper col-md-6 text-right">
                                                    <a href="#" class="xs-btn round-btn navy-blue-btn">Details</a>
                                                </div>
                                            </li>
                                            <li class="row xs-margin-0">
                                                <div class="row xs-margin-0 col-md-6 text-left">
                                                    <div class="xs-avatar full-round">
                                                        <img src="assets/images/backers/backers-4.jpg" alt="">
                                                    </div>
                                                    <div class="fundpress-backer-info">
                                                        <h3 class="color-navy-blue semi-bold">Angelina Julie</h3>
                                                        <h4 class="color-green regular xs-mb-0">$54,000 - No reward</h4>
                                                    </div>
                                                </div>
                                                <div class="xs-btn-wraper col-md-6 text-right">
                                                    <a href="#" class="xs-btn round-btn navy-blue-btn">Details</a>
                                                </div>
                                            </li>
                                            <li class="row xs-margin-0">
                                                <div class="row xs-margin-0 col-md-6 text-left">
                                                    <div class="xs-avatar full-round">
                                                        <img src="assets/images/backers/backers-1.jpg" alt="">
                                                    </div>
                                                    <div class="fundpress-backer-info">
                                                        <h3 class="color-navy-blue semi-bold">Van Persia</h3>
                                                        <h4 class="color-green regular xs-mb-0">$12,346 - No reward</h4>
                                                    </div>
                                                </div>
                                                <div class="xs-btn-wraper col-md-6 text-right">
                                                    <a href="#" class="xs-btn round-btn navy-blue-btn">Details</a>
                                                </div>
                                            </li>
                                            <li class="row xs-margin-0">
                                                <div class="row xs-margin-0 col-md-6 text-left">
                                                    <div class="xs-avatar full-round">
                                                        <img src="assets/images/backers/backers-2.jpg" alt="">
                                                    </div>
                                                    <div class="fundpress-backer-info">
                                                        <h3 class="color-navy-blue semi-bold">Fula Tarner</h3>
                                                        <h4 class="color-green regular xs-mb-0">$64,000 - No reward</h4>
                                                    </div>
                                                </div>
                                                <div class="xs-btn-wraper col-md-6 text-right">
                                                    <a href="#" class="xs-btn round-btn navy-blue-btn">Details</a>
                                                </div>
                                            </li>
                                            <li class="row xs-margin-0">
                                                <div class="row xs-margin-0 col-md-6 text-left">
                                                    <div class="xs-avatar full-round">
                                                        <img src="assets/images/backers/backers-3.jpg" alt="">
                                                    </div>
                                                    <div class="fundpress-backer-info">
                                                        <h3 class="color-navy-blue semi-bold">Kale Anderson</h3>
                                                        <h4 class="color-green regular xs-mb-0">$40,000 - No reward</h4>
                                                    </div>
                                                </div>
                                                <div class="xs-btn-wraper col-md-6 text-right">
                                                    <a href="#" class="xs-btn round-btn navy-blue-btn">Details</a>
                                                </div>
                                            </li>
                                            <li class="row xs-margin-0">
                                                <div class="row xs-margin-0 col-md-6 text-left">
                                                    <div class="xs-avatar full-round">
                                                        <img src="assets/images/backers/backers-4.jpg" alt="">
                                                    </div>
                                                    <div class="fundpress-backer-info">
                                                        <h3 class="color-navy-blue semi-bold">Emila Perry</h3>
                                                        <h4 class="color-green regular xs-mb-0">$34,700 - No reward</h4>
                                                    </div>
                                                </div>
                                                <div class="xs-btn-wraper col-md-6 text-right">
                                                    <a href="#" class="xs-btn round-btn navy-blue-btn">Details</a>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="xs-animate-btn-wraper xs-gradient-overlay white-gradient-overlay">
                                            <a href="#" class="xs-animate-btn color-navy-blue">
                                                <i class="fa fa-long-arrow-down"></i>
                                            </a>
                                        </div>
                                    </div>--}}
                                </div>
                            </div><!-- tab-content xs-text-tab-content -->
                        </div><!-- xs-text-content-tab -->
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-5">
                        <div class="xs-sidebar-wraper">
                            <div class="xs-single-sidebar xs-mb-20">
                                <div class="xs-pie-chart-wraper fundpress-pie-chart-wraper">
                                    <div class="xs-pie-chart " data-percent="20">
                                        <div class="xs-pie-chart-percent-wraper icon-position-center bold color-navy-blue xs-spilit-container">
                                            <div class="xs-pie-chart-percent"></div>
                                            <span>%</span>
                                        </div>
                                    </div>
                                    <div class="xs-pie-chart-label">{{ __('fondos_recaudados') }}</div>
                                </div><!-- xs-pie-chart-wraper -->
                            </div>

                            <div class="xs-single-sidebar xs-mb-30">
                                <ul class="xs-list-with-content fundpress-simple-list-content">
                                    <li class="color-navy-blue bold xs-mb-20" >US $<span id="txtRecaudado" style="color:inherit;font: inherit;" >75,280</span><span
                                                class="color-semi-black regular">{{ __('prometido') }}</span></li>

                                    <li class="color-green bold xs-mb-20">US ${{ $project->price }}<span
                                                class="color-semi-black regular">{{ __('meta') }}</span></li>

                                    <li class="color-brick-light-2 bold"><span id="txtNumPatrocinadores" style="color:inherit;font: inherit;">119</span><span class="color-semi-black regular">{{ __('patrocinadores') }}</span>
                                    </li>
                                </ul><!-- xs-list-with-content fundpress-simple-list-content -->
                            </div>

                            <div class="xs-single-sidebar xs-mb-40">
                                <div class="xs-countdown-timer-wraper">
                                    <div class="countdown-container xs-countdown-timer-v2"
                                         data-countdown="2020/01/01"></div>
                                </div><!-- xs-countdown-timer-wraper -->
                            </div>

                            <div class="xs-single-sidebar xs-mb-50">
                                <div class="xs-spilit-container">
                                    <div class="xs-btn-wraper">
                                        <a href="#" class="icon-btn xs-btn radius-btn green-btn xs-btn-medium" style="font-size: 13px"><i
                                                    class="fa fa-heart"></i>{{ __('invertir_ahora') }}</a>
                                    </div>
                                    <div class="xs-social-list-wraper">
                                        <ul class="xs-social-list xs-social-list-v3 fundpress-social-list">
                                            <li><a href="" class="color-facebook xs-box-shadow full-round"><i
                                                            class="fa fa-facebook"></i></a></li>
                                            <li><a href="" class="xs-box-shadow color-google-plus full-round"><i
                                                            class="fa fa-google-plus"></i></a></li>
                                            <li><a href="" class="xs-box-shadow color-twitter full-round"><i
                                                            class="fa fa-instagram"></i></a></li>
                                            <li><a href="" class="xs-box-shadow color-youtube full-round" style="background-color: #c4302b !important;"><i
                                                            class="fa fa-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                </div><!-- xs buttons and social list -->
                            </div>

                            <div class="xs-single-sidebar xs-mb-50">
                                <div class="xs-spilit-container xs-spilit-container-v2">
                                    <div class="xs-avatar xs-avatar-big full-round fundpress-avatar">
                                        <img src="{{ $project->artists[0]->users->pathAttachment() }}" alt="">
                                    </div>
                                    <div class="xs-avatar-title fundpress-avatar-title fundpress-avatar-title-v2">
                                    <a href="{{route('projects.artist',$project->artists[0]->users->slug)}}" class="xs-mb-10">{{ $project->artists[0]->nickname }}</a>
                                        <p class="xs-content-description fundpress-content-description xs-mb-20">{{ $project->category->category }}</p>
                                        <ul class="xs-list-item-icon-text list-inline">
                                            <li class="xs-mb-0 align-items-start list-inline-item">
                                                <p class="xs-content-description fundpress-content-description">
                                                    <i class="fa fa-signal color-green"></i>
                                                    {{ $project->artists[0]->levels->level }}
                                                </p>
                                            </li>
                                            <li class="xs-mb-0 list-inline-item">
                                                <p class="xs-content-description fundpress-content-description">
                                                    <img src="{{ $project->artists[0]->countries->flag }}" width="21" alt=""style="margin-top: -3px">
                                                    {{ $project->artists[0]->countries->country }}
                                                </p>
                                            </li>
                                        </ul>
                                    </div><!-- xs-avatar-title fundpress-avatar-title fundpress-avatar-title-v2 -->
                                </div>
                            </div>

                            <div class="xs-single-sidebar">
                                <div class="xs-sidebar-title fundpress-sidebar-title xs-mb-30">
                                    <h3 class="color-navy-blue">{{ __('apoya_proyecto') }}</h3>
                                </div>
                                @forelse( $project->rewards as $reward )
                                <div class="xs-info-card xs-pink-bg fundpress-info-card xs-box-shadow color-white">
                                    <h3 class="xs-mb-30">{{ __('promesa') }} ${{ $reward->price }} {{ __('o_mas') }}</h3>
                                    <h4 class="xs-mb-20">{{ $reward->title }}</h4>
                                    <p class="xs-mb-20 xs-content-description fundpress-content-description">{{ $reward->description }}</p>
                                    <div class="xs-spilit-container">
                                        <div class="xs-info-card-times">
                                            <h5>{{ __('entrega_estimada') }}</h5>
                                            <h6>{{ $reward->estimated->toFormattedDateString() }}</h6>
                                        </div>
                                        <div class="xs-info-card-times">
                                            <h5>{{ __('envios_a') }}</h5>
                                            <h6 style="font-size: 17px">{{ $reward->shipments }}</h6>
                                        </div>
                                    </div>
                                </div>
                                    <br>
                                    @empty
                                    <h2>No hay recompesas</h2>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>     <!-- End fund details -->

        <!-- popular campaigns -->
        <section class="waypoint-tigger xs-gray-bg xs-section-padding">
            <div class="container">
                <div class="xs-section-heading row xs-margin-0">
                    <div class="fundpress-heading-title xs-padding-0 col-xl-9 col-md-9">
                        <h2 class="color-navy-blue">Otros proyectos</h2>
                        <span class="xs-separetor dashed-separetor fundpress-separetor"></span>
                        {{--<p>FundPress has built a platform focused on aiding entrepreneurs, startups, and companies raise
                            capital from anyone.</p>--}}
                    </div><!-- .xs-heading-title .fundpress-heading-title .xs-col-9 END -->
                    <div class="xs-btn-wraper xs-padding-0 col-xl-3 col-md-3 d-flex-center-end">
                        <a href="#" class="xs-btn round-btn navy-blue-btn">{{ __('todos_proyectos') }}</a>
                    </div><!-- .xs-btn-wraper .xs-col-3 .d-flex-center-end END -->
                </div><!-- .xs-section-heading .fundpress-section-heading .xs-spilit-container END -->
                {{--<div class="row">
                    <div class="col-lg-4">
                        <div class="xs-box-shadow fundpress-popular-item xs-bg-white">
                            <div class="fundpress-item-header">
                                <img src="assets/images/campaigns/campaigns-1.jpg" alt="">
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
                                        <img src="assets/images/avatar/avatar_1.jpg" alt="">
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
                                <img src="assets/images/campaigns/campaigns-2.jpg" alt="">
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
                                        <img src="assets/images/avatar/avatar_2.jpg" alt="">
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
                                <img src="assets/images/campaigns/campaigns-3.jpg" alt="">
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
                                <a href="#" class="d-block color-navy-blue fundpress-post-title">BuildOne: $99 3D
                                    Printer w/ WiFi and Auto Bed Leveling!</a>
                                <ul class="xs-list-with-content fundpress-list-item-content">
                                    <li>$12,760<span>Pledged</span></li>
                                    <li><span class="number-percentage-count number-percentage" data-value="35"
                                              data-animation-duration="3500">0</span>% <span>Funded</span></li>
                                    <li>66<span>Days to go</span></li>
                                </ul>
                                <span class="xs-separetor border-separetor xs-separetor-v2 fundpress-separetor"></span>
                                <div class="row xs-margin-0">
                                    <div class="full-round fundpress-avatar">
                                        <img src="assets/images/avatar/avatar_3.jpg" alt="">
                                    </div>
                                    <div class="xs-avatar-title">
                                        <a href="#"><span>By</span>Leo Baddabes</a>
                                    </div>
                                </div>
                            </div><!-- .fundpress-item-content END -->
                        </div>
                    </div>
                </div>--}}
            </div>
        </section>     <!-- End popular campaigns -->
    </main>
@stop

@push('js')
    <script>
        const project = {!! $project !!};
    </script>
    <script src="/frontend/js/detail.js"></script>    
    <script src="/frontend/js/jquery.easypiechart.min.js"></script>    
@endpush
