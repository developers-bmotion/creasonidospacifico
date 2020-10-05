<div class="m-portlet m-portlet--full-height  ">
    <div class="m-portlet__body">
        <div class="m-card-profile">
            <div class="m-card-profile__title m--hide">
                Your Profile
            </div>
            <div class="m-card-profile__pic">
                <div class="m-card-profile__pic-wrapper">
                    @if(Storage::disk('public')->exists('users/'.$user->picture))
                        <img src="{{ $user->pathAttachment() }}" alt=""/>
                    @else
                        <img src="{{ $user->picture }}" alt="">
                    @endif
                </div>
            </div>
            <div class="m-card-profile__details">
                <span class="m-card-profile__name">{{ $user->name }} {{ $user->last_name }}</span>

                <a href="" class="m-card-profile__email m-link" style="margin-left: -15px;width: 80%; word-wrap: break-word;">{{ $user->email }}</a>

            </div>
            {{--@if($artist->countries !== null)
                <div class="text-center" style="margin-top: 5px"><img src="{{ $artist->countries->flag }}"
                                                                      width="21" alt="" style="margin-top: 6px;margin-left: -10px"></div>
            @endif--}}

        </div>
        <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
            <li class="m-nav__separator m-nav__separator--fit"></li>
            <li class="m-nav__section m--hide">
                <span class="m-nav__section-text">Section</span>
            </li>
            <li class="m-nav__item" {!! request()->is('dashboard/profile-managament*') ? 'style="background-color:#f2f4f9"' : '' !!}>
                <a href="{{ route('profile.managament',$user->slug) }}" class="m-nav__link active">
                    <i class="m-nav__link-icon flaticon-profile-1" {!! request()->is('dashboard/profile-managament*') ? 'style="color:#716aca !important"' : '' !!}></i>
                    <span class="m-nav__link-title">
                        <span class="m-nav__link-wrap">
                            <span class="m-nav__link-text" {!!request()->is('dashboard/profile-managament*') ? 'style="color:#716aca !important"' : '' !!}>{{ ( __('perfil')) }}</span>

                        </span>
                    </span>
                </a>
            </li>
            <li class="m-nav__item" {!! request()->is('dashboard/profile-my_proyects*') ? 'style="background-color:#f2f4f9"' : '' !!}>
                <a href="{{ route('profile.managament.myProyects',$user->slug) }}" class="m-nav__link">
                    <i class="m-nav__link-icon flaticon-share" {!! request()->is('dashboard/profile-my_proyects*') ? 'style="color:#716aca !important"' : '' !!}></i>
                    <span class="m-nav__link-text" {!! request()->is('dashboard/profile-my_proyects*') ? 'style="color:#716aca !important"' : '' !!}>{{ __('proyectos_asignados') }}</span>
                </a>
            </li>
            <li class="m-nav__item" {!! request()->is('dashboard/backings-made-magement*') ? 'style="background-color:#f2f4f9"' : '' !!}>
                <a href="{{ route('backings.made.manage',$user->slug) }}" class="m-nav__link">
                    <i class="m-nav__link-icon la la-hand-o-right"></i>
                    <span class="m-nav__link-text" {!! request()->is('dashboard/backings-made-magement*') ? 'style="color:#716aca !important"' : '' !!}>{{ __('apoyos_hechos') }}</span>
                </a>
            </li>
            {{--<li class="m-nav__item">
                <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                    <i class="m-nav__link-icon flaticon-graphic-2"></i>
                    <span class="m-nav__link-text">Sales</span>
                </a>
            </li>
            <li class="m-nav__item">
                <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                    <i class="m-nav__link-icon flaticon-time-3"></i>
                    <span class="m-nav__link-text">Events</span>
                </a>
            </li>
            <li class="m-nav__item">
                <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                    <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                    <span class="m-nav__link-text">Support</span>
                </a>
            </li>--}}
        </ul>
        <div class="m-portlet__body-separator"></div>
        {{--<div class="m-widget1 m-widget1--paddingless">
            <div class="m-widget1__item">
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <h3 class="m-widget1__title text-center">{{ __('total_recaudado') }}</h3>
                    </div>
                    <div class="col m--align-center">
                        <span class="m-widget1__number m--font-brand">$17,800</span>
                    </div>
                </div>
            </div>
            <div class="m-widget1__item">
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <h3 class="m-widget1__title">{{ __('proyectos_subidos') }}</h3>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-danger"></span>
                    </div>
                </div>
            </div>--}}
            {{--<div class="m-widget1__item">
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <h3 class="m-widget1__title">{{ __('total_patrocinadores') }}</h3>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-success">22</span>
                    </div>
                </div>
            </div>--}}
    </div>
</div>
