
<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <li class="m-menu__item {{request()->is('dashboard') ? 'm-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{route('dashboard')}}" class="m-menu__link "><i class="m-menu__link-icon la la-dashboard"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Dashboard</span><i
                            class="m-menu__ver-arrow la la-angle-right"></i>
											 </span></span></a></li>

        <!--=====================================
		NAVEGACIÓN PARA EL ADMIN
        ======================================-->

        @include('backend.partials.navigation_roles.' .\App\User::navigation())

    </ul>
</div>
