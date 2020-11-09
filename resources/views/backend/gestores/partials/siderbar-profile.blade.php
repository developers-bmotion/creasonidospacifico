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
                <span class="m-badge m-badge--warning m-badge--wide" style="margin-top: -3rem">{{ $userProfile->roles[0]->rol }}</span>
                <span class="m-card-profile__name">{{ $userProfile->name }} {{ $userProfile->last_name }} {{$userProfile->second_last_name }}</span>
                <a href="" class="m-card-profile__email m-link text-center" style="margin-left: -15px;width: 80%; word-wrap: break-word;">{{ $userProfile->email }}</a>
                <h5 class="m-card-profile__name pt-4"> Tel: {{ $userProfile->phone_1 }}</h5>

            </div>
        </div>
        <div class="m-portlet__body-separator"></div>
    </div>
</div>
