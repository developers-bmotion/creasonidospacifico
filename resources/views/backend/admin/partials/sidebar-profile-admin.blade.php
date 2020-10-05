<div class="m-portlet m-portlet--full-height  ">
    <div class="m-portlet__body">
        <div class="m-card-profile">
            <div class="m-card-profile__title m--hide">
                Your Profile
            </div>
            <div class="m-card-profile__pic">
                <div class="m-card-profile__pic-wrapper">
                    @if(Storage::disk('public')->exists('users/'.auth()->user()->picture))
                        <img src="{{ auth()->user()->pathAttachment() }}" alt=""/>
                    @else
                        <img src="{{ auth()->user()->picture }}" alt="">
                    @endif
                </div>
            </div>
            <div class="m-card-profile__details">
                <span class="m-card-profile__name">{{ auth()->user()->name }}</span>

                    <a href="" class="m-card-profile__email m-link" style="margin-left: -15px;width: 80%; word-wrap: break-word;">{{ auth()->user()->email }}</a>

            </div>
            {{-- @if($artist->countries !== null)
                <div class="form-group m-form__group row">
                    <label for="example-text-input"
                           class="col-2 col-form-label">{{ __('Origen') }}:</label>
                    <div class="col-10 pull-right">
                        <img data-toggle="tooltip" title="{{ $artist->countries->country }}"
                             src="{{ $artist->countries->flag }}" width="21" alt="" style="margin-left: 80px;margin-top: 7px">
                    </div>
                </div>
            @endif
            @if($artist->location !== null)
                <div class="form-group m-form__group row">
                    <label for="example-text-input"
                           class="col-2 col-form-label">{{ __('localizacion') }}:</label>
                    <div class="col-10 pull-right">
                        <img data-toggle="tooltip" title="{{ $artist->location->country }}"
                             src="{{ $artist->location->flag }}" width="21" alt="" style="margin-left: 80px;margin-top: 7px">
                    </div>
                </div>
            @endif --}}

        </div>
        <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
            <li class="m-nav__separator m-nav__separator--fit"></li>
            <li class="m-nav__section m--hide">
                <span class="m-nav__section-text">Section</span>
            </li>
            <li class="m-nav__item" {!! request()->is('dashboard/profile') ? 'style="background-color:#f2f4f9"' : '' !!}>
                <a href="{{ route('profile.admin') }}" class="m-nav__link active">
                    <i class="m-nav__link-icon flaticon-profile-1" {!! request()->is('dashboard/profile') ? 'style="color:#716aca !important"' : '' !!}></i>
                    <span class="m-nav__link-title">
                        <span class="m-nav__link-wrap">
                            <span class="m-nav__link-text" {!! request()->is('dashboard/profile') ? 'style="color:#716aca !important"' : '' !!}>{{ ( __('perfil')) }}</span>

                        </span>
                    </span>
                </a>
            </li>
            <li class="m-nav__item" {!! request()->is('dashboard/my-projects') ? 'style="background-color:#f2f4f9"' : '' !!}>
                <a href="{{ route('myprojects.artist') }}" class="m-nav__link">
                    <i class="m-nav__link-icon flaticon-share" {!! request()->is('dashboard/my-projects') ? 'style="color:#716aca !important"' : '' !!}></i>
                    <span class="m-nav__link-text" {!! request()->is('dashboard/my-projects') ? 'style="color:#716aca !important"' : '' !!}>{{ __('mis_proyectos') }}</span>
                </a>
            </li>
            <li class="m-nav__item" {!! request()->is('dashboard/backings-made') ? 'style="background-color:#f2f4f9"' : '' !!}>
                <a href="{{ route('backings.made.artist') }}" class="m-nav__link">
                    <i class="m-nav__link-icon la la-hand-o-right"></i>
                    <span class="m-nav__link-text" {!! request()->is('dashboard/backings-made') ? 'style="color:#716aca !important"' : '' !!}>{{ __('apoyos_hechos') }}</span>
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
        <div class="m-widget1 m-widget1--paddingless">
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
                        <span class="m-widget1__number m--font-danger">{{ $artist->projects->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="m-widget1__item">
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <h3 class="m-widget1__title">{{ __('total_patrocinadores') }}</h3>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-success">22</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
