@extends('frontend.layout')


@push('css')
    <style>
        .sin_proyectos .informacion__container,
        .sin_proyectos .columna--derecha{
            margin: auto;

        }
        .sin_proyectos .informacion__title{
            text-align: center;
        }
        .container__projects{
            padding-top: 2rem;
            padding-bottom: 3rem;
        }
        .projects__title{
            padding-top: 1rem;
            padding-bottom: 2rem;
        }
        .container__projects .xs-content-section-padding{
            padding-top: 0;
        }
    </style>
@endpush
@section('content')
{{-- url(/frontend/images/projects/background_perfil.jpg) --}}
{{-- _______________________________
     nombre del artista y generos
     _______________________________ --}}
     <section class="xs-inner-welcome-section fundpress-inner-welcome-section fundpress-inner-bg-1 parallax-window"
     data-parallax="scroll"
     style=" background-image: url({{ $artist->users->front_picture }});background-position: center;background-attachment: fixed;background-repeat: no-repeat; background-size: cover;">
     <div class="xs-solid-overlay xs-bg-black"></div>
     <div class="container">
        <div class="fundpress-inner-welcome-content" style="padding:200px 0 123px;">

            <h2 class="color-white">{{ $artist->nickname }}</h2>
            <ul class="xs-breadcumb fundpress-breadcumb">
                <li> <img src="{{ $artist->countries->flag }}" width="21"> {{ $artist->countries->country }} </li>
            </ul>
        </div>
    </div>


</section>

<div style="    overflow: hidden; position: relative; margin: auto;margin-top: -7%;border-radius: 100px;width: 200px;height: 200px;border: 4px solid; border-color:#191818; z-index: 1000; ">
<img src="{{$artist->users->pathAttachment()}}" style="max-width: 400px; margin-left:-105px">
{{-- <img src="{{  }}$artist->users->pathAttachment()}}" style="height: 100%; width: 100%;border-radius: inherit;"> --}}

</div>

<!--breadcumb end here--><!-- End welcome section -->

<div style="margin-top: 16px; margin-left: 41%;">
  <div class="xs-single-sidebar xs-mb-50">
    <div class="xs-spilit-container">
        <div class="xs-social-list-wraper">
            <ul class="xs-social-list xs-social-list-v3 fundpress-social-list">
                <li><a {{ $artist->facebook ? "href=".$artist->facebook:''  }}  target="_blank" class="color-facebook xs-box-shadow full-round"><i class="fa fa-facebook" style="color: white"></i></a></li>
                <li><a {{ $artist->wesite_url ? "href=".$artist->website_url:''  }}  target="_blank" class="xs-box-shadow color-google-plus full-round"><i class="fa fa-google-plus" style="color: white"></i></a></li>
                <li><a {{ $artist->instagram ? "href=".$artist->instagram:''  }}  target="_blank" class="xs-box-shadow color-twitter full-round"><i class="fa fa-instagram" style="color: white"></i></a></li>
                <li><a {{ $artist->youtube ? "href=".$artist->youtube:''  }} target="_blank" class="xs-box-shadow color-youtube full-round" style="background-color: #c4302b !important;"><i class="fa fa-youtube" style="color: white"></i></a></li>
            </ul>
        </div>
    </div><!-- xs buttons and social list -->
</div>
</div>

<div class="container {{ $projects[0]?"":"sin_proyectos" }}">
    @if($projects[0])
    {{-- <div class="row">
        <div class="col-lg-6">
            <div class="xs-welcome-content">
                <div class="xs-welcome-wraper">
                    <iframe width="560" height="315"
                        id="videoYoutube"
                        src="https://www.youtube.com/embed/{{ $projects[0]->iframe_video }}"
                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
            </div><!-- .xs-welcome-wraper END -->
        </div><!-- .xs-welcome-content END -->
    </div> --}}
    @endif
    {{-- <div class="col-lg-5 offset-1 columna--derecha">
        <div class="xs-welcome-content version-3">
            <div class="xs-welcome-wraper informacion__container">
                <h3 class="informacion__title">Sobre mi</h3>
                <p align="justify" style="width: 410px; margin: auto;">
                    {{ $artist->biography }}
                </p>



            </div><!-- .xs-welcome-wraper END -->
        </div><!-- .xs-welcome-content END -->
    </div> --}}
    <div class="xs-text-content-tab" style=" margin-left: 30%;">
        <!-- Nav tabs -->
        <div class="xs-tab-nav fundpress-tab-nav-v2 xs-mb-30">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#description" role="tab" data-toggle="tab" aria-selected="true">
                        Biografia
                    </a>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#updates" role="tab" data-toggle="tab" aria-selected="false">
                        Actualizaciones
                    </a>
                </li>                
                <li class="nav-item">
                    <a class="nav-link" href="#backers" role="tab" data-toggle="tab" aria-selected="false">
                        Patrocinadores
                    </a>
                </li>
            </ul>
        </div><!-- xs-tab-nav fundpress-tab-nav-v2 xs-mb-30 -->
        <!-- Tab panes -->
        <div class="tab-content xs-text-tab-content" style="margin-left: -30%;">
            <div role="tabpanel" class="tab-pane fadeInRights fade in active show" id="description">
                <h5 class="color-navy-blue xs-mb-30">{{ $artist->biography }}</h5>
                <p class="xs-content-description fundpress-content-description xs-mb-30"></p>
            </div><!-- tab-pane fadeInRights -->
            <div role="tabpanel" class="tab-pane fadeInRights fade" id="updates">
                <div class="xs-ul-list fundpress-content-text-list-wraper">
                    <ul class="fundpress-content-text-list xs-content-text-list">
                                                                        <h1>No hay actualizaciones</h1>
                                                                </ul>
                    
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fadeInRights fade" id="comments_panel">
                <div class="xs-blog-post-comment border xs-content-padding">
                    <!-- post comment -->
                    <div id="comments" class="comments-area">
                        <h4 class="comments-title"> 0 Comentarios</h4>
                        <!-- start comment -->
                        <ol class="comment-list">
                                                                                                                        </ol>
                        <!-- end comment -->

                        <!-- start respond form -->
                        <div id="respond" class="comment-respond">
                            <h3 id="reply-title" class="comment-reply-title">Deja tu comentario
                                <small>
                                    <a rel="nofollow" id="cancel-comment-reply-link" href="/wp/premix/hello-world-2/#respond" style="display:none;">
                                        Cancel reply</a>
                                </small>
                            </h3>
                            <div class="separator">
                                <span></span><span></span><span></span>
                            </div>
                            <form action="#" method="post" id="commentform" class="comment-form">

                                <div class="comment-info">
                                    <input placeholder="Enter Name *" id="author" class="comment-100" name="author" type="text" value="" size="30" aria-required="true">

                                    <input placeholder="Enter Email *" class="comment-50" id="email" name="email" type="email" value="" size="30" aria-required="true">

                                    <input placeholder="Enter Website" class="comment-50" id="url" name="url" type="url" value="" size="30">
                                </div>
                                <div class="commentright ">
                                    <textarea placeholder="Enter Comments *" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                                </div>
                                <div class="clearfix"></div>
                                <p class="form-submit">
                                    <input name="submit" type="submit" id="submit" class="premix-btn light-red-btn coment-btn" value="Publicar Comentario">
                                    <input type="hidden" name="comment_post_ID" value="165" id="comment_post_ID">
                                    <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                                </p>
                            </form>
                        </div>
                        <!-- end respond form -->
                    </div>
                    <!-- end post comment -->
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fadeInRights fade" id="backers">
                
            </div>
        </div><!-- tab-content xs-text-tab-content -->
    </div>
</div>

<!-- fin biografia-->

<main class="xs-all-content-wrapper">
	<div class="container container__projects">
        <hr>
        <h2 class="text-center projects__title">Proyectos</h2>
     {{--       <!-- fund details -->
    <section class="xs-content-section-padding xs-fund-details fundpress-fund-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-7">
                    <div class="xs-sync-slider-wraper xs-mb-50">


                        <div class="owl-carousel xs-sync-slider-thumb">
                          {{ --   @foreach($project->images as $image) -- }}
                          <div class="xs-sync-slider-thumb-content">
                            <img src="{{ -- {{ $image->pathAttachment() }} -- }}" width="10" alt="" style="height: 74px">
                        </div>
                        {{ --   @endforeach -- }}
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

            </div>

        </div>
    </div>
</section>     <!-- End fund details -->
 --}}
        <section class="xs-content-section-padding xs-news-feeds-inner-section fundpress-news-feeds-inner-section">
            <div class="container">
        {{-- contenedor de las tarjetas que vienen del js cards --}}
		<div class="row" id="projectContainer">

		</div>
         <!--=====================================
                             PAGINACIÓN
                            ======================================-->
                            {{ $projects->links() }}
	</div>
</section>
</main>
</div>

@stop

@push('js')
<script>
    const artist = {!! json_encode($artist) !!};
    const projects = {!! json_encode($projects)!!};
    fnRenderView = function () {
        startCard();
    }
</script>
 <script>
         const rutaPro = "{{route('projects.artist',"")}}";

     </script>
<script src="/frontend/js/detail.js"></script>
 <script src="/js/libs/moment-with-locales.min.js"></script>
 <script src="/frontend/js/card_project.js"></script>
 <script src="/frontend/js/projects.js"></script>

{{-- <script src="/frontend/js/detail.js"></script>    --}}
@endpush
