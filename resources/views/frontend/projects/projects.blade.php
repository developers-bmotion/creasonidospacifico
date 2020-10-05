@extends('frontend.layout')

@section('content')
    <!--=====================================
    JUMBOTROM
    ======================================-->
    <section class="xs-inner-welcome-section fundpress-inner-welcome-section fundpress-inner-bg-1 parallax-window"
             data-parallax="scroll"
             style=" background-image: url(/frontend/images/projects/projects_bagraound.jpg);background-position: center;background-attachment: fixed;background-repeat: no-repeat; background-size: cover;">
        <div class="xs-solid-overlay xs-bg-black"></div>
        <div class="container">
            <div class="fundpress-inner-welcome-content">
                @if( isset($category_name))
                    <h2 class="color-white">{{ $category_name->category }}</h2>
                @else
                    <h2 class="color-white">{{ __('proyectos') }}</h2>
                @endif
                <ul class="xs-breadcumb fundpress-breadcumb">
                    <li><a href="{{ route('projects') }}" class="color-white">{{ __('proyectos') }}
                            /</a>{{ __('todos') }}</li>
                </ul>
            </div>
        </div>
    </section>

    <!--=====================================
    LISTA DE PROJECTOS
    ======================================-->
    <main class="xs-all-content-wrapper">
        <!-- blog post details -->
        <div class="xs-blog-details xs-content-section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="xs-isotope-grid-wraper">
                            <div class="xs-col-3-isotope-grid" id="projectContainer">
                            </div>
                        </div>
                            <!--=====================================
                             PAGINACIÓN
                            ======================================-->
                        {{ $projects->links() }}

                        </div>

                        <!--=====================================
                        SIDEBAR PROJECTS LATERAL
                        ======================================-->
                        @include('frontend.partials.sidebar.sidebar_projects')

                </div>
            </div>
        </div>
    </main>
    <!-- End blog post details -->
@stop
@push('js')
    <script>
        const projects = {!! json_encode($projects)!!};
        fnRenderView = function () {
            startCard();
        }
    </script>
    <script src="/js/libs/moment-with-locales.min.js"></script>
    <script src="/frontend/js/card_project.js"></script>
    <script src="/frontend/js/projects.js"></script>
@endpush