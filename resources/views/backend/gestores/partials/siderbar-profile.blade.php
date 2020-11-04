<div class="m-portlet m-portlet--full-height  ">
    <div class="m-portlet__body">
        <div class="m-card-profile">
            <div class="m-card-profile__title m--hide">
                Your Profile
            </div>
            <div class="m-card-profile__pic">
                <div class="m-card-profile__pic-wrapper">
                    @if(Storage::disk('public')->exists('users/'.$userProfile->picture))
                        <img src="{{ $userProfile->pathAttachment() }}" alt=""/>
                    @else
                        <img src="{{ $userProfile->picture }}" alt="">
                    @endif
                </div>
            </div>
            <div class="m-card-profile__details">
                <span class="m-card-profile__name">{{ $userProfile->name }} {{ $userProfile->last_name }} {{$userProfile->second_last_name }}</span>
                <a href="" class="m-card-profile__email m-link text-center" style="margin-left: -15px;width: 80%; word-wrap: break-word;">{{ $userProfile->email }}</a>
                <h5 class="m-card-profile__name pt-4"> Tel: {{ $userProfile->phone_1 }}</h5>

            </div>
            {{--@if($artist->countries !== null)
                <div class="text-center" style="margin-top: 5px"><img src="{{ $artist->countries->flag }}"
                                                                      width="21" alt="" style="margin-top: 6px;margin-left: -10px"></div>
            @endif--}}

        </div>
{{--        <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">--}}
{{--            <li class="m-nav__separator m-nav__separator--fit"></li>--}}
{{--            <li class="m-nav__section m--hide">--}}
{{--                <span class="m-nav__section-text">Section</span>--}}
{{--            </li>--}}
{{--            <li class="m-nav__item" {!! request()->is('dashboard/profile-managament*') ? 'style="background-color:#f2f4f9"' : '' !!}>--}}
{{--                <a href="{{ route('profile.managament',$user->slug) }}" class="m-nav__link active">--}}
{{--                    <i class="m-nav__link-icon flaticon-profile-1" {!! request()->is('dashboard/profile-managament*') ? 'style="color:#716aca !important"' : '' !!}></i>--}}
{{--                    <span class="m-nav__link-title">--}}
{{--                        <span class="m-nav__link-wrap">--}}
{{--                            <span class="m-nav__link-text" {!!request()->is('dashboard/profile-managament*') ? 'style="color:#716aca !important"' : '' !!}>{{ ( __('perfil')) }}</span>--}}

{{--                        </span>--}}
{{--                    </span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
        <div class="m-portlet__body-separator"></div>
    </div>
</div>
