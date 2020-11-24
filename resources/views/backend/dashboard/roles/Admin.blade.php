@push('css')
    <link rel="stylesheet" href="/backend/admin/css/dashboard.css">
    {{-- Custom css --}}
    <link href="/css/main-custom.css" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <div class="m-content">

        <div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3" role="tablist">

            <!--begin::Item-->
            <div class="m-accordion__item">
                <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_3_item_1_head" data-toggle="collapse" href="#m_accordion_3_item_1_body" aria-expanded="false">
                    <span class="m-accordion__item-icon"><i class="fa flaticon-music"></i></span>
                    <span class="m-accordion__item-title">Información por estados</span>
                    <span class="m-accordion__item-mode"></span>
                </div>
                <div class="m-accordion__item-body collapse" id="m_accordion_3_item_1_body" role="tabpanel" aria-labelledby="m_accordion_3_item_1_head" data-parent="#m_accordion_3" style="">
                    <div class="m-accordion__item-content">
                        @include('backend.partials.cards-count-projects')
                    </div>
                </div>
            </div>

        </div>
        <!--=====================================
		    INFORMACIÓN NÚMERICA E IMPORTANTE
        ======================================-->
        <div class="m-portlet">
            <div class="m-portlet__body m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-md-12 col-lg-12 col-xl-4">

                        <!--begin:: Widgets/Stats2-1 -->
                        <div class="m-widget1">
                            <h5 class="m-portlet__head-text">
                                Cantidad de aspirantes registrados
                            </h5>
                            <hr>
                            <div class="displayNoneRegistros" style="display: none">
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">Registrados</h3>
                                            <span class="m-widget1__desc">Aquellos que han hecho todo el proceso</span>
                                        </div>
                                        <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-brand"
                                              style="font-size: 2rem">{{ $aspiranteRegistroCompleto }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">Registros sin canción</h3>
                                            <span class="m-widget1__desc">Aquellos registros sin canción</span>
                                        </div>
                                        <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-danger"
                                              style="font-size: 2rem">{{ $aspiranteRegistroSinCanción }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">Sin Registro</h3>
                                            <span class="m-widget1__desc">Aquellos que solo han creado la cuenta</span>
                                        </div>
                                        <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-warning"
                                              style="font-size: 2rem">{{ $aspirantessolocuenta }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">Total</h3>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-"
                                              style="font-size: 2rem">{{ $totalregistros }}</span>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-12 text-center conteBtn1" style="display: block">
                                        <button type="button" class="btn btn-secondary btnMasInfoRegis1">Más información
                                        </button>
                                    </div>
                                    <div class="col-12 text-center conteBtn2"  style="display: none">
                                        <button type="button" class="btn btn-secondary btnMasInfoRegis2">Ocultar Información
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end:: Widgets/Stats2-1 -->
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-4">

                        <!--begin:: Widgets/Stats2-1 -->
                        <div class="m-widget1">
                            <h5 class="m-portlet__head-text">
                                Las tres ciudades con más registros
                            </h5>
                            <span class="m-widget1__desc">Esta información es basada en el lugar de nacimiento</span>
                            <hr>
                            @forelse($ciudades as $ciudadesAspirante)
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col">
                                            <h3 class="m-widget1__title">{{ $ciudadesAspirante->ciudad }}</h3>

                                            <span class="m-widget1__desc">{{ $ciudadesAspirante->departamento }}</span>
                                        </div>

                                        <div class="col m--align-right">
                                            <span class="m-widget1__number m--font"
                                                  style="font-size: 2rem">{{ $ciudadesAspirante->cantidad }}</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h1>No hay datos</h1>
                            @endforelse
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">Total</h3>
                                    </div>

                                    <div class="col m--align-right">
                                        @if($total)
                                            <span class="m-widget1__number m--font-"
                                                  style="font-size: 2rem">{{ $total }}</span>
                                        @else
                                            <span class="m-widget1__number m--font-"
                                                  style="font-size: 2rem">0</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-12 text-center">
                                        <button data-toggle="collapse" href="#m_accordion_3_item_1_body" type="button"
                                                class="btn btn-secondary btn_info_cities">Más información
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end:: Widgets/Stats2-1 -->
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-4">

                        <!--begin:: Widgets/Stats2-1 -->

                        <div class="m-widget1">
                            <h5 class="m-portlet__head-text">
                                Modalidades más registradas
                            </h5>
                            <hr>
                            @forelse($categories as $category)
                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">
                                        <div class="col-10">
                                            <h3 class="m-widget1__title">{{ $category->category }}</h3>
                                            <span class="m-widget1__desc">{{ $category->description }}</span>
                                        </div>
                                        <div class="col-2 m--align-right">
                                        <span class="m-widget1__number m--font"
                                              style="font-size: 1.8rem">{{ $category->quantity }}</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h1>No hay datos</h1>
                            @endforelse
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">Total</h3>
                                    </div>

                                    <div class="col m--align-right">
                                        @if($total)
                                            <span class="m-widget1__number m--font-"
                                                  style="font-size: 2rem">{{ $totalCategories }}</span>
                                        @else
                                            <span class="m-widget1__number m--font-"
                                                  style="font-size: 2rem">0</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-12 text-center">
                                        <button data-toggle="collapse" href="#m_accordion_3_item_1_body" type="button"
                                                class="btn btn-secondary btn_info_cities">Más información
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end:: Widgets/Stats2-1 -->
                    </div>
                </div>
            </div>
        </div>
        <!--=====================================
		   TABLAS EN ACORDEONES
        ======================================-->
        <div class="row">
            <div class="col-12 col-md-12 col-md-12">
                <div class="m-accordion m-accordion--default m-accordion--solid" id="m_accordion_3" role="tablist">

                    <!--begin::Item-->
                    <div class="m-accordion__item">
                        <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_3_item_1_head"
                             data-toggle="collapse" href="#m_accordion_3_item_1_body" aria-expanded="false">
                            <span class="m-accordion__item-icon"><i class="fa flaticon-user-ok"></i></span>
                            <span class="m-accordion__item-title">Información de ciudades & modalidades (Clic para más información)</span>
                            <span class="m-accordion__item-mode"></span>
                        </div>
                        <div class="m-accordion__item-body collapse" id="m_accordion_3_item_1_body" role="tabpanel"
                             aria-labelledby="m_accordion_3_item_1_head" data-parent="#m_accordion_3" style="">
                            <div class="m-accordion__item-content">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-4">
                                        {{--                                        <h5 class="m-portlet__head-text" style="text-align: center;">--}}
                                        {{--                                            Últimos aspirantes registrados--}}
                                        {{--                                        </h5>--}}
                                        {{--                                        <div class="m-widget4">--}}
                                        {{--                                            <div class="m-widget4__item">--}}
                                        {{--                                                <div class="m-widget4__img m-widget4__img--logo">--}}
                                        {{--                                                    <img src="assets/app/media/img/client-logos/logo5.png" alt="">--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="m-widget4__info">--}}
                                        {{--													<span class="m-widget4__title">--}}
                                        {{--														Trump Themes--}}
                                        {{--													</span><br>--}}
                                        {{--                                                    <span class="m-widget4__sub">--}}
                                        {{--														Make Metronic Great Again--}}
                                        {{--													</span>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <span class="m-widget4__ext">--}}
                                        {{--													<span class="m-widget4__number m--font-brand">+$2500</span>--}}
                                        {{--												</span>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="m-widget4__item">--}}
                                        {{--                                                <div class="m-widget4__img m-widget4__img--logo">--}}
                                        {{--                                                    <img src="assets/app/media/img/client-logos/logo4.png" alt="">--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="m-widget4__info">--}}
                                        {{--													<span class="m-widget4__title">--}}
                                        {{--														StarBucks--}}
                                        {{--													</span><br>--}}
                                        {{--                                                    <span class="m-widget4__sub">--}}
                                        {{--														Good Coffee &amp; Snacks--}}
                                        {{--													</span>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <span class="m-widget4__ext">--}}
                                        {{--													<span class="m-widget4__number m--font-brand">-$290</span>--}}
                                        {{--												</span>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="m-widget4__item">--}}
                                        {{--                                                <div class="m-widget4__img m-widget4__img--logo">--}}
                                        {{--                                                    <img src="assets/app/media/img/client-logos/logo3.png" alt="">--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="m-widget4__info">--}}
                                        {{--													<span class="m-widget4__title">--}}
                                        {{--														Phyton--}}
                                        {{--													</span><br>--}}
                                        {{--                                                    <span class="m-widget4__sub">--}}
                                        {{--														A Programming Language--}}
                                        {{--													</span>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <span class="m-widget4__ext">--}}
                                        {{--													<span class="m-widget4__number m--font-brand">+$17</span>--}}
                                        {{--												</span>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="m-widget4__item">--}}
                                        {{--                                                <div class="m-widget4__img m-widget4__img--logo">--}}
                                        {{--                                                    <img src="assets/app/media/img/client-logos/logo2.png" alt="">--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="m-widget4__info">--}}
                                        {{--													<span class="m-widget4__title">--}}
                                        {{--														GreenMakers--}}
                                        {{--													</span><br>--}}
                                        {{--                                                    <span class="m-widget4__sub">--}}
                                        {{--														Make Green Great Again--}}
                                        {{--													</span>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <span class="m-widget4__ext">--}}
                                        {{--													<span class="m-widget4__number m--font-brand">-$2.50</span>--}}
                                        {{--												</span>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="m-widget4__item">--}}
                                        {{--                                                <div class="m-widget4__img m-widget4__img--logo">--}}
                                        {{--                                                    <img src="assets/app/media/img/client-logos/logo1.png" alt="">--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="m-widget4__info">--}}
                                        {{--													<span class="m-widget4__title">--}}
                                        {{--														FlyThemes--}}
                                        {{--													</span><br>--}}
                                        {{--                                                    <span class="m-widget4__sub">--}}
                                        {{--														A Let's Fly Fast Again Language--}}
                                        {{--													</span>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <span class="m-widget4__ext">--}}
                                        {{--													<span class="m-widget4__number m--font-brand">+$200</span>--}}
                                        {{--												</span>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <h5 class="m-portlet__head-text" style="text-align: center;">
                                            Cantidad de aspirantes por ciudad o municipio
                                        </h5>
                                        <hr>
                                        <table class="table table-striped- table-bordered table-hover table-checkable"
                                               id="table_ciudades">
                                            <thead>
                                            <tr>
                                                {{-- <th>#</th> --}}
                                                <th>{{ __('Ciudad') }}</th>
                                                <th>{{ __('Departamento') }}</th>
                                                <th>{{ __('Aspisrantes') }}</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <h5 class="m-portlet__head-text" style="text-align: center;">
                                            Cantidad de aspirantes por modalidad
                                        </h5>
                                        <hr>
                                        <table class="table table-striped- table-bordered table-hover table-checkable"
                                               id="table_modalidades">
                                            <thead>
                                            <tr>
                                                {{-- <th>#</th> --}}
                                                <th>{{ __('Modalidad') }}</th>
                                                <th>{{ __('Aspirantes') }}</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{ __('Propuestas musicales') }}
                        </h3>
                    </div>
                </div>
            </div>
            {{-- inicio --}}
            <div class="m-portlet__body">
                <ul class="nav nav-tabs  m-tabs-line m-tabs-line--2x m-tabs-line--success" role="tablist">
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_tabs_6_1" role="tab">Todas las propuestas</a>
                    </li>

                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" id="tab_rating" data-toggle="tab" href="#m_tabs_6_3" role="tab">Propuestas calificadas</a>
                    </li>
                </ul>
                <div class="tab-content">
                    {{-- iniciotab1 --}}
                    <div class="tab-pane active" id="m_tabs_6_1" role="tabpanel">
                        <div class="m-portlet__body">
                            {{-- filtros para datatable --}}
                            <div class="row">
                                <select class="form-control m-input m-input--square col-md-3 mb-3  tipoPersona" name="tipoPersona" id="tipoPersona">
                                    <option value="0">Filtrar por tipo persona</option>
                                    @foreach ($tipoPersona as $tipoPer)
                                    <option value="{{$tipoPer->id  }}">{{ $tipoPer->name }}</option>
                                    @endforeach

                                </select>
                                {{-- @dd($cat) --}}
                                <select class="form-control m-input m-input--square col-md-3 mb-3" id="category_filter"

                                >
                                    <option value="0">Filtrar por modalidad</option>
                                    @foreach ($cat as $category)
                                    <option value="{{$category->id}}" >{{$category->category}}</option>
                                    @endforeach

                                </select>

                                {{-- filtro estado --}}
                                <div class="m-portlet__head-tools col-md-6">
                                    <ul class="m-portlet__nav row mr-1 state_mobile">

                                        <li class="m-portlet__nav-item row mr-2" style="margin-top: 0.6rem;">
                                            <h5 class="mr-2">Estado: </h5>
                                            <span id="current_status"
                                                  class="m-badge m-badge--metal m-badge--wide m-badge--rounded" style="height:23px">{{ __('revision') }}</span>
                                        </li>
                                        <div class="m-dropdown m-dropdown--inline  m-dropdown--arrow m-dropdown--align-right"
                                             m-dropdown-toggle="hover">
                                            <a href="#" class="m-dropdown__toggle btn btn-warning dropdown-toggle">
                                                Filtrar
                                            </a>
                                            <div class="m-dropdown__wrapper">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--right"></span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__body">
                                                        <div class="m-dropdown__content selectType">
                                                            <ul class="m-nav">
                                                                <li class="m-nav__section m-nav__section--first">
                                                                    <span class="m-nav__section-text">FILTRAR POR ESTADO</span>
                                                                </li>
                                                                <li class="m-nav__item text-center">
                                                                <span style="background-color: #9c9ca5"
                                                                      class="changeType w-100 btn btn-metal m-btn m-btn--pill m-btn--wide btn-sm"
                                                                      data-type="{{\App\Project::REVISION}}">{{ __('revision') }}</span>
                                                                </li>
                                                                @if(\App\User::navigation() !== "Subsanador")
                                                                    <li class="m-nav__item text-center">
                                                                    <span
                                                                        style="background-color:#9C26EA"
                                                                        class="changeType w-100 btn btn-brand m-btn m-btn--pill m-btn--wide btn-sm"
                                                                        data-type="{{\App\Project::QUALIFIED}}">Calificado</span>

                                                                    </li>
                                                                @endif
                                                                <li class="m-nav__item text-center">
                                                                <span
                                                                    class="changeType w-100 btn btn-success m-btn m-btn--pill m-btn--wide btn-sm"
                                                                    data-type="{{\App\Project::APPROVAL}}">{{ __('Aprobado') }}</span>
                                                                </li>
                                                                <li class="m-nav__item text-center">
                                                                <span style="color:white;"
                                                                      class="changeType w-100 btn btn-warning m-btn m-btn--pill m-btn--wide btn-sm"
                                                                      data-type="{{\App\Project::PENDING}}">{{ __('Pendiente') }}</span>
                                                                </li>
                                                                <li class="m-nav__item text-center">
                                                                <span
                                                                    class="changeType w-100 btn btn-danger m-btn m-btn--pill m-btn--wide btn-sm"
                                                                    data-type="{{\App\Project::REJECTED}}">{{ __('No subsanado') }}</span>
                                                                </li>
                                                                <li class="m-nav__item text-center">
                                                                <span style="color:white"
                                                                      class="changeType w-100 btn btn-success m-btn m-btn--pill m-btn--wide btn-sm"
                                                                      data-type="{{\App\Project::ACEPTED}}">{{ __('Aceptado') }}</span>
                                                                </li>
                                                                <li class="m-nav__item text-center">
                                                                <span
                                                                    class="changeType w-100 btn btn-info m-btn m-btn--pill m-btn--wide btn-sm"
                                                                    data-type="{{\App\Project::REVISON_UPDATE}}">{{ __('Nueva revisión') }}</span>
                                                                </li>

                                                                <li class="m-nav__separator m-nav__separator--fit">
                                                                </li>
                                                                <li class="m-nav__section m-nav__section--first">
                                                                    <span class="m-nav__section-text">FILTRAR POR REGISTRO</span>
                                                                </li>
                                                                <li class="m-nav__item text-center">
                                                                <span style="color:white"
                                                                      class="changeType w-100 btn btn-warning m-btn m-btn--pill m-btn--wide btn-sm"
                                                                      data-type="{{\App\Project::PENDING_REGISTER}}">{{ __('Registro Pendiente') }}</span>
                                                                </li>
                                                                <li class="m-nav__item text-center">
                                                                <span style="color:white"
                                                                      class="changeType w-100 btn btn-danger m-btn m-btn--pill m-btn--wide btn-sm"
                                                                      data-type="{{\App\Project::NOT_PROJECT_REGISTER}}">{{ __('Sin Proyecto Registrado') }}</span>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <span
                                                                        class="changeType w-100 btn btn-metal m-btn m-btn--pill m-btn--wide btn-block"
                                                                        data-type="0">{{ __('todos') }}</span>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </ul>
                                </div>


                            </div>
                            <div>
{{--                                Toggle column: <a class="toggle-vis" data-column="2">Actuara como</a> - <a class="toggle-vis" data-column="3">Categoría</a> - <a class="toggle-vis" data-column="4">Email</a> - <a class="toggle-vis" data-column="5">Departamento de nacimiento</a> - <a class="toggle-vis" data-column="6">Ciudad de nacimiento</a> - <a class="toggle-vis" data-column="7">Estado</a>- <a class="toggle-vis" data-column="8">Acciones</a>--}}
                            </div>
                            <table class="table table-striped- table-bordered table-hover table-checkable "
                                   id="table_projects_management">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ __('Nombres y Apellidos') }}</th>
                                    <th>{{ __('Actuara como') }}</th>
                                    <th>{{ __('Categoría') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Departamento de nacimiento') }}</th>
                                    <th>{{ __('Ciudad de nacimiento') }}</th>
                                    <th>{{ __('Estado') }}</th>
                                    <th>{{ __('Acciones') }}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    {{-- fintab1 --}}
                    <div class="tab-pane" id="m_tabs_6_3" role="tabpanel">
                        <div class="m-portlet__body">
                            {{-- filtros para datatable --}}
                            <div class="row">
                                <select class="form-control m-input m-input--square col-md-3 mb-3  tipoPersona_cualified" name="tipoPersonaCualified" id="tipoPersona_cualified">
                                    <option value="0">Filtrar por tipo persona</option>
                                    @foreach ($tipoPersona as $tipoPer)
                                    <option value="{{$tipoPer->id  }}">{{ $tipoPer->name }}</option>
                                    @endforeach

                                </select>
                                {{-- @dd($cat) --}}
                                <select class="form-control m-input m-input--square col-md-3 mb-3 ml-3" id="category_filter_cualified"

                                >
                                    <option value="0">Filtrar por modalidad</option>
                                    @foreach ($cat as $category)
                                    <option value="{{$category->id}}" >{{$category->category}}</option>
                                    @endforeach

                                </select>



                            </div>
                            <table class="table table-striped- table-bordered table-hover table-checkable "
                                   id="table_qualified">
                                <thead>
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>{{ __('Nombres y Apellidos') }}</th>
                                    <th>{{ __('Actuara como') }}</th>
                                    <th>{{ __('Categoría') }}</th>
                                    <th>{{ __('Departamento de nacimiento') }}</th>
                                    <th>{{ __('Ciudad de nacimiento') }}</th>
                                    <th>{{ __('Calificación') }}</th>
                                    <th>{{ __('Acciones') }}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>

                    </div>

                </div>
            </div>

            {{-- fin tab --}}


@stop

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

    <script src="/backend/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <script src="/backend/assets/demo/custom/crud/datatables/basic/headers.js" type="text/javascript"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
{{--    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js" type="text/javascript"></script>--}}
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js" type="text/javascript"></script>

    {{--  --}}
    <script src="/js/storage.js"></script>


    <script>
        var listStatus = {
            revision: {name: 'En Revisión', color: '#9c9ca5'},
            preaprobados: {name: 'Calificado', color: '#9C26EA'},
            aprobados: {name: 'Aprobados', color: '#34bfa3'},
            pendientes: {name: 'Pendientes', color: '#ffb822'},
            rechazados: {name: 'No subsanado', color: '#f4516c'},
            aceptados: {name: 'Aceptados', color: '#34bfa3'},
            nuevarevision: {name: 'Nueva Revición', color: '#36a3f7'},
            nosubsanados: {name: 'No Subsanados', color: '#36a3f7'},
            registropendiente: {name: 'Registro Pendiente', color: '#ffb822'},
            sinregistroproyecto: {name: 'Sin Proyecto Registrado', color: '#f4516c'},
            todos: {name: 'Todos', color: '#9c9ca5'},
        }
        var estado = getStorage('storeTipoProyecto');

        if (estado) {
            changedStatusColor(parseInt(estado))
        }
        var storeTipoProyecto = "storeTipoProyecto";
        var tipoProyecto = getStorage(storeTipoProyecto);
        var tipoPer = 0;
        var category=0;
        if (tipoProyecto == 11) {
            tipoProyecto = null
        }

        var table = null;

        const loadTable = function () {

            $('a.toggle-vis').on( 'click', function (e) {
                e.preventDefault();

                // Get the column API object
                var column = table.column( $(this).attr('data-column') );

                // Toggle the visibility
                column.visible( ! column.visible() );
            } );

            if (table !== null) {
                table.destroy();
            }
            var cont = 1;
            var cat;
                console.log(tipoProyecto,'el tipo');
            table = $('#table_projects_management').DataTable({

                "processing": true,
                "serverSide": true,
                "scrollX": true,
                "dom": 'Bfrtip',
                "pageLength": 100,
                "data": null,
                "lengthMenu": [[10, 25, 100, -1], [10,25, 100, "All"]],
                "pagingType": "simple_numbers",
                "order": [[0, "desc"]],
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        filename:'Listas de aspirantes'
                    },
                    {
                        extend: 'pdfHtml5',
                        pageSize: "A3",
                        filename:'Listas de aspirantes'
                    }
                ],
                "ajax": {
                    url: "{{route('aspirants.all')}}",
                    data: {
                        tipoProyecto: tipoProyecto,
                        tipoPer:tipoPer,
                        category:category
                    }
                },
                "columns": [

                    {

                     data:'users.id',
                     visible:false,
                     searchable:false

                    },

                    {
                        data: 'users.name',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>',

                        render: function (data, type, JsonResultRow, meta) {
                            // console.log(JsonResultRow,'data****');
                            if (JsonResultRow.users.last_name === null) {
                                return '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                            } else {

                                return '<span class="label label-danger text-center">' + JsonResultRow.users.name + '</span>  <span class="label label-danger text-center">' + JsonResultRow.users.last_name + '</span>';
                            }
                            // return '<img src="' + JsonResultRow + '" width="50px"  style="border-radius: 100%;margin-right: auto;margin-left: auto;display: block; width:50px; height:50px"/>';
                        }
                    },
                    {
                        // data: 'person_type.name',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>',

                        render:function(data,type,JsonResultRow, meta){
                            if (JsonResultRow.person_type){
                                return JsonResultRow.person_type.name;
                            }

                        }
                    },
                    {


                        render: function (data, type, JsonResultRow, meta) {
                            var category = "";
                            if (JsonResultRow.projects) {

                                JsonResultRow.projects.map(item => {
                                    category = item;
                                });
                            }

                           cat = category != "" ? `${category.category.category}` : '<span class="label label-danger text-center ml-4" style="color:#ff0000 !important">Sin categoria</span>'
                           return cat;
                        },




                    },
                    // {
                    //     data: 'document_type.document',
                    //     defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    //     // render: function (data, type, JsonResultRow, meta) {
                    //     //     // console.log(JsonResultRow,'data t');
                    //     //     let artista = JsonResultRow.artists[0];
                    //     //     return `<span target="_blank">${artista.document_type.document}</span>`;
                    //     // }
                    //     // data: 'artists.document_type.document',
                    //     // defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    // },
                    // {
                    //     data: 'identification',
                    //     defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    //     // render: function (data, type, JsonResultRow, meta) {
                    //     //     // console.log(JsonResultRow,'data t');
                    //     //     let artista = JsonResultRow.artists[0];
                    //     //     return `<span target="_blank">${artista.identification}</span>`;
                    //     // }
                    //     // data: 'artista.identification',
                    //     // defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    // },
                    {
                        data:'users.email',
                        render: function (data, type, JsonResultRow, meta) {
                            // console.log(JsonResultRow.users.email,'email');

                            return JsonResultRow.users.email ? '<span class="label label-danger text-center">' + JsonResultRow.users.email + '</span>' : '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>';

                        }
                        // render: function (data, type, JsonResultRow, meta) {
                        //     // console.log(JsonResultRow,'data t');
                        //     let artista = JsonResultRow.artists[0];
                        //     return `<span target="_blank">${artista.users.email}</span>`;
                        // }
                        // data: 'email',
                        // defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    },
                    {
                        data: 'city.departaments.descripcion',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    },
                    {
                        data: 'city.descripcion',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    },

                    {
                        "width": "15%",

                        render: function (data, type, JsonResultRow, meta) {
                            var status = "";

                            if (JsonResultRow.projects) {
                                JsonResultRow.projects.map(item => {
                                    status = item.status;
                                });

                            }
                            console.log(status);
                            let info = '<span class="label label-danger text-center ml-4" style="color:red !important">Sin propuesta</span>';
                            switch (parseInt(status)) {
                                case 1:
                                    info = '<span class="m-badge m-badge--metal m-badge--wide m-badge--rounded">Revisión</span>';
                                    break;
                                case 2:
                                    info = '<span class="m-badge m-badge--brand m-badge--wide" style="background-color:#9C26EA !important;font-size:9px" >{{ __('Calificado') }}</span>';
                                    break;
                                case 3:
                                    info = '<span class="m-badge  m-badge--success m-badge--wide">{{ __('aprovado2') }}</span>';
                                    break;
                                case 4:
                                    info = '<span class="m-badge  m-badge--warning m-badge--wide">Pendiente</span>';
                                    break;
                                case 5:
                                    info = '<span class="m-badge  m-badge--danger m-badge--wide">No subsanado</span>';
                                    break;
                                case 6:
                                    info = '<span class="m-badge  m-badge--info m-badge--wide">Nueva revisión</span>';
                                    break;
                                case 7:
                                    info = '<span class="m-badge  m-badge--info m-badge--wide">Aceptado</span>';
                                    break;
                            }
                            return '<div class="text-center">' + info + '</div>';

                        }
                    },
                    {
                        render: function (data, type, JsonResultRow, meta) {
                            var items = "";
                            if (JsonResultRow.projects) {

                                JsonResultRow.projects.map(item => {
                                    items = item;
                                });
                            }

                            return items != "" ? `<div class="text-center"><a href="/dashboard/project/${items.slug}" class="btn m-btn--pill btn-secondary"><i class="fa fa-eye"></i></a></div>` : '<span class="label label-danger text-center ml-4" style="color:red !important">Sin propuesta</span>'
                        }
                    },
                ],
                "language": {
                    "sProcessing": "{{__('procesando')}}",
                    "sLengthMenu": "{{__('mostrar')}} _MENU_ {{__('registros')}}",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "{{__('nigun_dato_tabla')}}",
                    "sInfo": "{{__('mostrando_registros') }} _START_ {{__('from')}} _END_ {{__('total_de')}} _TOTAL_ {{__('registros')}}",
                    "sInfoEmpty": "{{ __('mostrando_registros_del_cero') }}",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "{{__('buscar')}}:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "{{__('cargando')}}",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": ">",
                        "sPrevious": "<"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },





            });

        };
        // filtro por categoria
        $('#category_filter').on('change', function(){
            category = $(this).val();
            console.log(category,'catt');
            loadTable();
            // console.log(this.value,'value---');
            // console.log(this.value,'value---');
            //     table.search(this.value).draw();
        });
        // filtro por tipo
        $(".selectType").on('click', '.changeType', function () {
            let tipo = parseInt($(this).attr("data-type"));
            console.log(tipo,'otro tipo');
            if (!(tipo > 0)) {
                tipo = null;
            }
            tipoProyecto = tipo;
            if (tipoProyecto == null) {
                tipoProyecto = 11
            }
            setStorage(storeTipoProyecto, tipoProyecto)
            if (tipoProyecto == 11) {
                tipoProyecto = null
            }
            loadTable();
            // console.log(typeof (tipoProyecto),'tipoProyecto')
            // console.log(tipo,'tipoProyecto')
            changedStatusColor(tipoProyecto)
            // tipoProyecto = tipo;
            // loadTable();
        });

        $(".tipoPersona").on('change', function () {

            tipoPer = $(this).val();
            console.log(tipoPer);
            loadTable();
        });

        function changedStatusColor(status) {
            if (status == null) {
                status = 11
            }
            console.log(status, 'prueba')
            console.log(typeof (status));
            switch (status) {
                case 1:
                    $("#current_status").css("background", listStatus.revision.color);
                    $('#current_status').html(listStatus.revision.name)
                    break;
                case 2:
                    $("#current_status").css("background", listStatus.preaprobados.color);
                    $('#current_status').html(listStatus.preaprobados.name)
                    break;
                case 3:
                    $("#current_status").css("background", listStatus.aprobados.color);
                    $('#current_status').html(listStatus.aprobados.name)
                    break;
                case 4:
                    $("#current_status").css("background", listStatus.pendientes.color);
                    $('#current_status').html(listStatus.pendientes.name)
                    break;
                case 5:
                    $("#current_status").css("background", listStatus.rechazados.color);
                    $('#current_status').html(listStatus.rechazados.name)
                    break;
                case 6:
                    $("#current_status").css("background", listStatus.nuevarevision.color);
                    $('#current_status').html(listStatus.nuevarevision.name)
                    break;
                case 7:
                    $("#current_status").css("background", listStatus.aceptados.color);
                    $('#current_status').html(listStatus.aceptados.name)
                    break;
                case 8:
                    $("#current_status").css("background", listStatus.nosubsanados.color);
                    $('#current_status').html(listStatus.nosubsanados.name)
                    break;
                case 9:
                    $("#current_status").css("background", listStatus.registropendiente.color);
                    $('#current_status').html(listStatus.registropendiente.name)
                    break;
                case 10:
                    $("#current_status").css("background", listStatus.sinregistroproyecto.color);
                    $('#current_status').html(listStatus.sinregistroproyecto.name)
                    break;
                case 11:
                    $("#current_status").css("background", listStatus.todos.color);
                    $('#current_status').html(listStatus.todos.name)
                    break;

                default:
                    console.log('no entro')
            }
        }

        loadTable();
        // loadTable();
    </script>

    <script>

        $('#table_ciudades').DataTable({
            "processing": true,
            "order": [[2, "desc"]],
            "pagingType": "simple_numbers",
            "ajax": '{{route('get.aspirants.cities')}}',
            "columns": [
                {
                    data: "ciudad",

                },
                {
                    data: "departamento",

                },
                {
                    data: "cantidad",

                },

            ],
            "language": {
                "sProcessing": "{{__('procesando')}}",
                "sLengthMenu": "{{__('mostrar')}} _MENU_ {{__('registros')}}",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "{{__('nigun_dato_tabla')}}",
                "sInfo": "_TOTAL_ {{__('registros')}}",
                "sInfoEmpty": "{{ __('mostrando_registros_del_cero') }}",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "{{__('buscar')}}:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "{{__('cargando')}}",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": ">",
                    "sPrevious": "<"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }

        });
        $(".btn_info_cities").click(function () {
            $('html,body').animate({
                scrollTop: $("#m_accordion_3_item_1_head").offset().top
            }, 500);
        });
        $(".btnMasInfoRegis1").click(function () {
            $('.displayNoneRegistros').show();
            $('.conteBtn1').hide();
            $('.conteBtn2').show();
        });
        $(".btnMasInfoRegis2").click(function () {
            $('.displayNoneRegistros').hide();
            $('.conteBtn2').hide();
            $('.conteBtn1').show();
        });
    </script>
    <script>
        $('#table_modalidades').DataTable({
            "processing": true,
            "order": [[1, "desc"]],
            "ajax": '{{route('get.aspirants.modalidades')}}',
            "columns": [
                {
                    data: "category",

                },
                {
                    data: "quantity",

                },

            ],
            "language": {
                "sProcessing": "{{__('procesando')}}",
                "sLengthMenu": "{{__('mostrar')}} _MENU_ {{__('registros')}}",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "{{__('nigun_dato_tabla')}}",
                "sInfo": "_TOTAL_ {{__('registros')}}",
                "sInfoEmpty": "{{ __('mostrando_registros_del_cero') }}",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "{{__('buscar')}}:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "{{__('cargando')}}",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": ">",
                    "sPrevious": "<"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }

        });
    </script>

    {{-- tabla calificaciones --}}
<script>

        // var estado = getStorage('storeTipoProyecto');


        // var storeTipoProyecto = "storeTipoProyecto";
        // var tipoProyecto = getStorage(storeTipoProyecto);
        var tipoPerQual = 0;
        var categoryQual=0;


        var tableQuailified = null;

        const loadTableQual = function () {
            if (tableQuailified !== null) {
                tableQuailified.destroy();
            }
            var cont = 1;
            var cat;
            tableQuailified = $('#table_qualified').DataTable({
                "processing": true,
                "serverSide": true,
                "scrollX": true,
                "pageLength": 10,
                "data": null,
                "pagingType": "simple_numbers",
                "order":[5,"desc"],
                "ajax": {
                    url: "{{route('list.ratings')}}",
                    data: {
                        tipoPerQual:tipoPerQual,
                        categoryQual:categoryQual
                    }
                },
                "columns": [

                    {
                        data: 'names',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>',

                        render: function (data, type, JsonResultRow, meta) {
                            // console.log(JsonResultRow,'data****');
                            if (JsonResultRow.last_name === null) {
                                return '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                            } else {

                                return '<span class="label label-danger text-center">' + JsonResultRow.names + '</span>  <span class="label label-danger text-center">' + JsonResultRow.last_name + '</span>';
                            }
                            // return '<img src="' + JsonResultRow + '" width="50px"  style="border-radius: 100%;margin-right: auto;margin-left: auto;display: block; width:50px; height:50px"/>';
                        }
                    },
                    {
                        data: 'act_like',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>',

                        // render:function(data,type,JsonResultRow, meta){
                        //     if (JsonResultRow.person_type){
                        //         return JsonResultRow.act_like;
                        //     }

                        // }
                    },
                    {
                        data: 'category',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>',



                        // render: function (data, type, JsonResultRow, meta) {
                        //     var category = "";
                        //     if (JsonResultRow.projects) {

                        //         JsonResultRow.projects.map(item => {
                        //             category = item;
                        //         });
                        //     }

                        //    cat = category != "" ? `${category.category.category}` : '<span class="label label-danger text-center ml-4" style="color:#ff0000 !important">Sin categoria</span>'
                        //    return cat;
                        // },




                    },

                    {
                        data: 'departament',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    },
                    {
                        data: 'city',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                    },
                    {

                        data: 'rating',
                        defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>',
                        // orderSequence: [ "desc", "asc"],
                        // targets:"descendFirst"
                        // render: function (data, type, JsonResultRow, meta) {

                        // //   console.log(JsonResultRow,'data rating')

                        //    JsonResultRow.projects[0].reviews_curador;

                        //   var cal = "";
                        //     if (JsonResultRow.projects[0].reviews_curador) {

                        //         JsonResultRow.projects[0].reviews_curador.map(value => {
                        //             cal = value;
                        //             console.log(cal,'callificacion')
                        //         });
                        //     }

                        //     var sum= cal.lyric+cal.melody_rhythm+cal.arrangements+cal.originality;
                        //     return cal != "" ? '<div class="text-center">'+(sum)+'</div>': ' ';
                        // }

                    },

                    {
                        render: function (data, type, JsonResultRow, meta) {
                            // var items = "";
                            // if (JsonResultRow.projects) {

                            //     JsonResultRow.projects.map(item => {
                            //         items = item;
                            //     });
                            // }

                            return JsonResultRow.slug != "" ? `<div class="text-center"><a href="/dashboard/project/${JsonResultRow.slug}" class="btn m-btn--pill btn-secondary"><i class="fa fa-eye"></i></a></div>` : '<span class="label label-danger text-center ml-4" style="color:red !important">Sin propuesta</span>'
                        }
                    },
                ],
                "language": {
                    "sProcessing": "{{__('procesando')}}",
                    "sLengthMenu": "{{__('mostrar')}} _MENU_ {{__('registros')}}",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "{{__('nigun_dato_tabla')}}",
                    "sInfo": "{{__('mostrando_registros') }} _START_ {{__('from')}} _END_ {{__('total_de')}} _TOTAL_ {{__('registros')}}",
                    "sInfoEmpty": "{{ __('mostrando_registros_del_cero') }}",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "{{__('buscar')}}:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "{{__('cargando')}}",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": ">",
                        "sPrevious": "<"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },





            });

        };
        // filtro por categoria
        $('#category_filter_cualified').on('change', function(){
            categoryQual = $(this).val();
            console.log(categoryQual,'cattCual');
            loadTableQual();
            // console.log(this.value,'value---');
            // console.log(this.value,'value---');
            //     table.search(this.value).draw();
        });
        // filtro por tipo

        $("#tipoPersona_cualified").on('change', function () {
            // alert();
            tipoPerQual = $(this).val();
            console.log(tipoPerQual,'tipopercual');
            loadTableQual();
        });

        $("#tab_rating").on('click', function () {

            loadTableQual();
        });



        loadTableQual();


</script>
<style>
    .m-nav .m-nav__item {
        display: block;
        padding-bottom: 9px;
    }
</style>

@endpush

