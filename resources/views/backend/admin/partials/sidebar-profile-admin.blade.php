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
                <span class="m-card-profile__name">{{ auth()->user()->name }} {{ auth()->user()->last_name }} {{auth()->user()->second_last_name }}</span>
                <a href="" class="m-card-profile__email m-link text-center" style="margin-left: -15px;width: 80%; word-wrap: break-word;">{{ auth()->user()->email }}</a>
                <h5 class="m-card-profile__name pt-4"> Tel: {{ auth()->user()->phone_1 }}</h5>

            </div>
        </div>
        <div class="m-portlet__body-separator"></div>
    </div>
</div>
