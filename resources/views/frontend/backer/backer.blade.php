@extends('frontend.layout')

@section('content')
   
    <section class="xs-inner-welcome-section fundpress-inner-welcome-section fundpress-inner-bg-1 parallax-window" data-parallax="scroll" style=" background-image: url(/frontend/images/pasos_artista/manager.jpg);background-position: center;background-attachment: fixed;background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="fundpress-inner-welcome-content">
                <h2 class="color-white">{{__('patrocinador')}}</h2>
            </div>
        </div>
    </section>
    <!--breadcumb end here--><!-- End welcome section -->

    <main class="xs-all-content-wrapper" style="margin-bottom: 520px; z-index: 100; position: relative; background-color: rgb(255, 255, 255);">
        <!-- blog post details -->
        <div class="xs-blog-details xs-content-section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="xs-blog-details-wraper">
                            <article class="post format-standard hentry post xs-post-format-standard xs-style-border">
                                <div class="post-body xs-content-padding">
                                    <div class="entry-header row xs-mb-30">
                                        <div class="col-md-2 xs-padding-0">
                                            <div class="post-meta">
                                                <div class="xs-post-meta-date xs-mb-30">
                                                    <span class="post-meta-date xs-navy-blue-bg color-white xs-border-radius"><b>1</b></span>
                                                </div>


                                            </div>
                                        </div><!-- .xs-entry-header-date END -->
                                        <div class="col-md-10 xs-padding-0">

                                            <h2 class="entry-title xs-mb-20 xs-post-entry-title">
                                                <a href="blog-single.html" class="color-navy-blue bold">What People Did with the Artiphon Instrument</a>
                                            </h2>
                                            <div class="xs-entry-content entry-content xs-font-alt">
                                                <p class="xs-mb-0">Founded by Berlin's Clubcommissioner alongside Amsterdam's with Nightori Mayor, the Creative Footprint works with our partner Poor Advisor, local NYC scene experts and researchers to gather data need for regular life.</p>
                                            </div><!-- .xs-entry-content END -->
                                        </div><!-- .xs-entry-header-content END -->
                                    </div><!-- header end -->

                                </div><!-- post-body end -->
                            </article>
                        </div>
                    </div>


                        @include('frontend.backer.partials.sidebar-backer')


                </div>
            </div>
        </div>	<!-- End blog post details -->
    </main>


@stop
