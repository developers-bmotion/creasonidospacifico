<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

    <!-- BEGIN: Horizontal Menu -->
    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark "
            id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div id="m_header_menu"
         class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
        @if(\App\User::navigation() !== "Subsanador")
            <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
               {{-- <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click"
                    m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;"
                                                                     class="m-menu__link m-menu__toggle"
                                                                     title="Non functional dummy link"><i
                            class="m-menu__link-icon la la-desktop"></i><span
                            class="m-menu__link-text">{{ __('ir_web') }}</span><i
                            class="m-menu__hor-arrow la la-angle-down"></i><i
                            class="m-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"><span
                            class="m-menu__arrow m-menu__arrow--adjust"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('home') }}"
                                                                              class="m-menu__link "><i
                                        class="m-menu__link-icon la la-home"></i><span
                                        class="m-menu__link-text">{{ __('inicio') }}</span></a>
                            </li>
                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                    href="{{ route('projects') }}" class="m-menu__link "><i
                                        class="m-menu__link-icon la la-share-alt"></i><span
                                        class="m-menu__link-title"> <span
                                            class="m-menu__link-wrap">
																<span
                                                                    class="m-menu__link-text">{{ __('proyectos') }}</span> <span
                                                class="m-menu__link-badge"><span
                                                    class="m-badge m-badge--success">2</span></span> </span></span></a>
                            </li>
                            --}}{{--<li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover"
                                m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;"
                                                                                 class="m-menu__link m-menu__toggle"
                                                                                 title="Non functional dummy link"><i
                                            class="m-menu__link-icon flaticon-business"></i><span
                                            class="m-menu__link-text">Manage Orders</span><i
                                            class="m-menu__hor-arrow la la-angle-right"></i><i
                                            class="m-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right"><span
                                            class="m-menu__arrow "></span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="header/actions.html" class="m-menu__link "><span
                                                        class="m-menu__link-text">Latest Orders</span></a></li>
                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="header/actions.html" class="m-menu__link "><span
                                                        class="m-menu__link-text">Pending Orders</span></a></li>
                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="header/actions.html" class="m-menu__link "><span
                                                        class="m-menu__link-text">Processed Orders</span></a></li>
                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="header/actions.html" class="m-menu__link "><span
                                                        class="m-menu__link-text">Delivery Reports</span></a></li>
                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="header/actions.html" class="m-menu__link "><span
                                                        class="m-menu__link-text">Payments</span></a></li>
                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="header/actions.html" class="m-menu__link "><span
                                                        class="m-menu__link-text">Customers</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover"
                                m-menu-link-redirect="1" aria-haspopup="true"><a href="#"
                                                                                 class="m-menu__link m-menu__toggle"><i
                                            class="m-menu__link-icon flaticon-chat-1"></i><span class="m-menu__link-text">Customer
                                                                Feedbacks</span><i
                                            class="m-menu__hor-arrow la la-angle-right"></i><i
                                            class="m-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right"><span
                                            class="m-menu__arrow "></span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="header/actions.html" class="m-menu__link "><span
                                                        class="m-menu__link-text">Customer Feedbacks</span></a></li>
                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="header/actions.html" class="m-menu__link "><span
                                                        class="m-menu__link-text">Supplier Feedbacks</span></a></li>
                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="header/actions.html" class="m-menu__link "><span
                                                        class="m-menu__link-text">Reviewed Feedbacks</span></a></li>
                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="header/actions.html" class="m-menu__link "><span
                                                        class="m-menu__link-text">Resolved Feedbacks</span></a></li>
                                        <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                                    href="header/actions.html" class="m-menu__link "><span
                                                        class="m-menu__link-text">Feedback Reports</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a
                                        href="header/actions.html" class="m-menu__link "><i
                                            class="m-menu__link-icon flaticon-users"></i><span class="m-menu__link-text">Register Member</span></a>
                            </li>--}}{{--
                        </ul>
                    </div>
                </li>--}}
                @if(auth()->user()->roles[0]->rol == "Artist")
                    <li class="m-menu__item ">
                        <a href="{{ route('add.project') }}" class="m-menu__link"><i
                                class="m-menu__link-icon la la-music"></i><span
                                class="m-menu__link-text">Subir tu canción</span>
                        </a>
                    </li>
                    <li class="m-menu__item ">
                        <a href="{{ route('profile.artist') }}" class="m-menu__link"><i
                                class="m-menu__link-icon la la-user"></i><span
                                class="m-menu__link-text">Ir a tu perfil</span>
                        </a>
                    </li>
                @endif
            </ul>
        @endif
        @if(\App\User::navigation() === "Subsanador")
            <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click"
                    m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;"
                                                                     class="m-menu__link m-menu__toggle"
                                                                     title="Non functional dummy link"><i
                            class="m-menu__link-icon la la-desktop"></i><span
                            class="m-menu__link-text">{{ __('ir_web') }}</span><i
                            class="m-menu__hor-arrow la la-angle-down"></i><i
                            class="m-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"><span
                            class="m-menu__arrow m-menu__arrow--adjust"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('home') }}/dashboard"
                                                                              class="m-menu__link "><i
                                        class="m-menu__link-icon la la-home"></i><span
                                        class="m-menu__link-text">{{ __('inicio') }}</span></a>
                            </li>

                        </ul>
                    </div>
                </li>
            </ul>
        @endif
    </div>

    <!-- END: Horizontal Menu -->

    <!-- BEGIN: Topbar -->
    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
        <div class="m-stack__item m-topbar__nav-wrapper">
            <ul class="m-topbar__nav m-nav m-nav--inline">
                {{--
                                <li class="m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light"
                                    m-dropdown-toggle="click" id="m_quicksearch"
                                    m-quicksearch-mode="dropdown" m-dropdown-persistent="1">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
                                        <span class="m-nav__link-icon"><i class="flaticon-search-1"></i></span>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                        <div class="m-dropdown__inner ">
                                            <div class="m-dropdown__header">
                                                <form class="m-list-search__form">
                                                    <div class="m-list-search__form-wrapper">
                                                                                <span class="m-list-search__form-input-wrapper">
                                                                                    <input id="m_quicksearch_input"
                                                                                           autocomplete="off"
                                                                                           type="text" name="q"
                                                                                           class="m-list-search__form-input"
                                                                                           value=""
                                                                                           placeholder="Search...">
                                                                                </span>
                                                        <span class="m-list-search__form-icon-close" id="m_quicksearch_close">
                                                                                    <i class="la la-remove"></i>
                                                                                </span>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__scrollable m-scrollable" data-scrollable="true"
                                                     data-height="300" data-mobile-height="200">
                                                    <div class="m-dropdown__content">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                --}}
               {{-- <li
                    class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width"
                    m-dropdown-toggle="click"
                    m-dropdown-persistent="1"
                    id="notificationContainer"
                >
                    <notification-component
                        notificationsjson="{{Auth::user()->unreadNotifications}}"></notification-component>
                </li>--}}
{{--
                <li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light"
                    m-dropdown-toggle="click">
                    <a href="#" class="m-nav__link m-dropdown__toggle">
                        <span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
                        <span class="m-nav__link-icon"><i class="flaticon-share"></i></span>
                    </a>
                    --}}
{{--<div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__header m--align-center"
                                 style="background: url(/backend/assets/app/media/img/misc/quick_actions_bg.jpg); background-size: cover;">
                                <span class="m-dropdown__header-title">Quick Actions</span>
                                <span class="m-dropdown__header-subtitle">Shortcuts</span>
                            </div>
                            <div class="m-dropdown__body m-dropdown__body--paddingless">
                                <div class="m-dropdown__content">
                                    <div class="data" data="false" data-height="380" data-mobile-height="200">
                                        <div class="m-nav-grid m-nav-grid--skin-light">
                                            <div class="m-nav-grid__row">
                                                <a href="#" class="m-nav-grid__item">
                                                    <i class="m-nav-grid__icon flaticon-file"></i>
                                                    <span class="m-nav-grid__text">Generate Report</span>
                                                </a>
                                                <a href="#" class="m-nav-grid__item">
                                                    <i class="m-nav-grid__icon flaticon-time"></i>
                                                    <span class="m-nav-grid__text">Add New Event</span>
                                                </a>
                                            </div>
                                            <div class="m-nav-grid__row">
                                                <a href="#" class="m-nav-grid__item">
                                                    <i class="m-nav-grid__icon flaticon-folder"></i>
                                                    <span class="m-nav-grid__text">Create New Task</span>
                                                </a>
                                                <a href="#" class="m-nav-grid__item">
                                                    <i class="m-nav-grid__icon flaticon-clipboard"></i>
                                                    <span class="m-nav-grid__text">Completed Tasks</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>--}}{{--

                </li>
--}}
{{--
                <li class="m-nav__item m-topbar__languages m-dropdown m-dropdown--small m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--mobile-full-width"
                    m-dropdown-toggle="click">
                    <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-text">
													<img class="m-topbar__language-selected-img"
                                                         src="{{Config::get('app.locale') == 'en' ? '/backend/assets/app/media/img/flags/020-flag.svg' : '/backend/assets/app/media/img/flags/016-spain.svg'}}">
												</span>
                    </a>
                    <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__header m--align-center"
                                 style="background: url(/backend/assets/app/media/img/misc/quick_actions_bg.jpg); background-size: cover;">
                                <span class="m-dropdown__header-subtitle">{{ __('seleccione_lenguaje') }}</span>
                            </div>
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                    <ul class="m-nav m-nav--skin-light">
                                        <li class="m-nav__item m-nav__item--active">
                                            <a href="{{ route('set_language', ['en']) }}"
                                               class="m-nav__link m-nav__link--active">
                                                <span class="m-nav__link-icon"><img class="m-topbar__language-img"
                                                                                    src="/backend/assets/app/media/img/flags/020-flag.svg"></span>
                                                <span
                                                    class="m-nav__link-title m-topbar__language-text m-nav__link-text">USA</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="{{ route('set_language', ['es']) }}" class="m-nav__link">
                                                <span class="m-nav__link-icon"><img class="m-topbar__language-img"
                                                                                    src="/backend/assets/app/media/img/flags/016-spain.svg"></span>
                                                <span
                                                    class="m-nav__link-title m-topbar__language-text m-nav__link-text">Spain</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
--}}
                <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                    m-dropdown-toggle="click">
                    <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">

                                                                @if(Storage::disk('public')->exists('users/'.auth()->user()->picture))
                                                        <img src="{{ auth()->user()->pathAttachment() }}"
                                                             class="m--img-rounded m--marginless" alt=""/>
                                                    @else
                                                        <img src="{{ auth()->user()->picture}}"
                                                             class="m--img-rounded m--marginless"
                                                             alt=""/>

                                                    @endif


												</span>
                        <span class="m-topbar__username m--hide">Nick</span>
                    </a>
                    <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__header m--align-center"
                                 style="background: url(/backend/assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                                <div class="m-card-user m-card-user--skin-dark">
                                    <div class="m-card-user__pic">

                                        @if(Storage::disk('public')->exists('users/'.auth()->user()->picture))
                                            <img src="{{ auth()->user()->pathAttachment()}}"
                                                 class="m--img-rounded m--marginless" alt=""/>
                                        @else
                                            <img src="{{ auth()->user()->picture}}" class="m--img-rounded m--marginless"
                                                 alt=""/>

                                        @endif
                                    </div>
                                    <div class="m-card-user__details">
                                        <span
                                            class="m-card-user__name m--font-weight-500">{{ auth()->user()->name }}</span>
                                        <a href=""
                                           class="m-card-user__email m--font-weight-300 m-link">{{ auth()->user()->email }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                    <ul class="m-nav m-nav--skin-light">
                                        <li class="m-nav__section m--hide">
                                            <span class="m-nav__section-text">Section</span>
                                        </li>
                                        <li class="m-nav__item">
                                            @if(auth()->user()->roles[0]->rol == "Admin")
                                                <a href="{{ route('profile.admin',auth()->user()->slug) }}"
                                                   class="m-nav__link">
                                                    @elseif(auth()->user()->roles[0]->rol == "Manage")
                                                        <a href="{{ route('profile.managament',auth()->user()->slug) }}"
                                                           class="m-nav__link">
                                                            @elseif(auth()->user()->roles[0]->rol == "Artist")
                                                                <a href="{{ route('profile.artist') }}"
                                                                   class="m-nav__link">
                                                                    @endif
                                                                    <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                    <span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">Perfil</span>
																				<span class="m-nav__link-badge"><span
                                                                                        class="m-badge m-badge--success">2</span></span>
																			</span>
																		</span>
                                                                </a>
                                        </li>
                                        {{-- <li class="m-nav__item">
                                            <a href="header/profile.html" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                <span class="m-nav__link-text">Activity</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="header/profile.html" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                <span class="m-nav__link-text">Messages</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__separator m-nav__separator--fit">
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="header/profile.html" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                <span class="m-nav__link-text">FAQ</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="header/profile.html" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                <span class="m-nav__link-text">Support</span>
                                            </a>
                                        </li> --}}
                                        <li class="m-nav__separator m-nav__separator--fit">
                                        </li>
                                        <li class="m-nav__item">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit"
                                                        class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">{{ __('cerrar_cesion_backend') }}</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
{{--                <li id="m_quick_sidebar_toggle" class="m-nav__item">--}}
{{--                    <a href="#" class="m-nav__link m-dropdown__toggle">--}}
{{--                        <span class="m-nav__link-icon"><i class="flaticon-grid-menu"></i></span>--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
    </div>

    <!-- END: Topbar -->
</div>
