<li class="m-menu__item {{request()->is('dashboard/projects-manage') ? 'm-menu__item--active' : '' }} m-menu__item--submenu {{request()->is('dashboard/projects-manage') ? 'm-menu__item--open' : '' }}" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-share"></i><span class="m-menu__link-text">{{ __('proyectos') }}</span><i
                class="m-menu__ver-arrow la la-angle-right"></i></a>
    <div class="m-menu__submenu"><span class="m-menu__arrow"></span>
        <ul class="m-menu__subnav">
            <li class="m-menu__item  " aria-haspopup="true"><a href="{{ route('projects.manage') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">{{ __('todos') }}</span></a></li>
            {{-- <li class="m-menu__item"  aria-haspopup="true"><a href="components/icons/fontawesome5.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">----</span></a></li>
            <li class="m-menu__item " aria-haspopup="true"><a href="components/icons/lineawesome.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">-----</span></a></li>
            <li class="m-menu__item " aria-haspopup="true"><a href="components/icons/socicons.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">------</span></a></li> --}}
        </ul>
    </div>
</li>