<li class="m-menu__item {{request()->is('dashboard/managements-admin') ? 'm-menu__item--active' : '' }} m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="{{ route('managements.admin')}}" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon la la-check"></i><span class="m-menu__link-text">Curadores</span><i
                class="m-menu__ver-arrow la la-angle-right"></i></a>
</li>
<li class="m-menu__item {{request()->is('dashboard/gestores-admin') ? 'm-menu__item--active' : '' }} m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="{{ route('gestores.admin')}}" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon la la-music"></i><span class="m-menu__link-text">Gestores Culturales</span><i
            class="m-menu__ver-arrow la la-angle-right"></i></a>
</li>
<li class="m-menu__item {{request()->is('dashboard/users-admin') ? 'm-menu__item--active' : '' }} m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="{{ route('user.admin.index')}}" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon la la-users"></i><span class="m-menu__link-text">Usuarios</span><i
            class="m-menu__ver-arrow la la-angle-right"></i></a>
</li>
