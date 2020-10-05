@push('css')
<style>
    .btn_reset_password{
        display: inline-block; color: #031F53;
    }
    .btn_reset_password:hover{
        color: #4CC899;
    }

    .btn_volvel_login{
        display: inline-block; color: #031F53;
    }
    .btn_volvel_login:hover{
        color: #4CC899;
    }
</style>
@endpush
@auth
@else

<div class="modal fade bd-example-modal-lg xs-modal" id="modal_auth_login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="fundpress-tab-nav-v5">
                <!--=====================================
		       TAB LOGIN Y SING UP
                ======================================-->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#login" role="tab" data-toggle="tab">
                            {{ __('Login') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#signup" role="tab" data-toggle="tab">
                            {{ __('Signup') }}
                        </a>
                    </li>
                </ul>
            </div>
            <!--=====================================
		        INICIAR SESION
            ======================================-->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fadeInRights show fade in active" id="login">
                    <form style="display: block" method="POST" id="frmLogin" action="{{ route('login') }}" aria-label="{{ __('Login') }} ">
                        @csrf
                        <div class="xs-input-group-v2">
                            <i class="icon icon-profile-male"></i>
                            <input type="email" name="email" id="xs_user_login_name" class="xs-input-control" placeholder="{{ __('PlaceHolder_email') }}" value="{{ old('email') }}" required autofocus>
                        </div>
                        <span class="invalid-feedback mesajesError d-block" role="alert">
                            <strong id="error-email"></strong>
                        </span>
                        <div class="xs-input-group-v2">
                            <i class="icon icon-key2"></i>
                            <input type="password" name="password" id="xs_login_password" class="xs-input-control" placeholder="{{ __('PlaceHolder_password') }}" required>
                        </div>
                        <span class="invalid-feedback mesajesError d-block" role="alert">
                            <strong id="error-password"></strong>
                        </span>
                        <div class="xs-submit-wraper xs-mb-20">
                            <input type="submit" name="submit" value="{{ __('btn_login') }}" id="xs_contact_get_action" class="btn btn-warning btn-block login">
                        </div>
                        <p class="text-center">
                            <a href="#" class="btn_reset_password">{{ __('olvido_contraseña') }}</a>
                        </p>
                        <p class="xs-mb-20">or</p>
                        <div class="xs-submit-wraper xs-mb-20">
                            <a href="{{route('social_auth',['driver' => 'facebook'])}}" id="xs_facebook" class="btn btn-info btn-block">{{ __('btn_login_facebook') }}</a>
                        </div>
                        <div class="xs-submit-wraper">
                            <a href="{{route('social_auth',['driver' => 'google'])}}"  class="btn btn-success btn-block" style="background-color: #d34836 !important;">{{ __('btn_login_google') }}</a>
                        </div>
                    </form>

                    <!--=====================================
                    REESTABLECER CONTRASEÑA
                    ======================================-->

                    <reset-password-component></reset-password-component>
                </div>
                <!--=====================================
		      REGISTRAR
                ======================================-->
                <div role="tabpanel" class="tab-pane fadeInRights fade" id="signup">
                    <form method="POST" action="{{ route('register') }}" id="frmRegister">
                        @csrf
                        <div class="xs-input-group-v2">
                            <i class="icon icon-profile-male"></i>
                            <input type="text" name="name" id="xs_register_name" class="xs-input-control" placeholder="{{ __('PlaceHolder_name') }}" required>
                        </div>
                        <span class="invalid-feedback mesajesError d-block" role="alert">
                            <strong id="error-name"></strong>
                        </span>
                        <div class="xs-input-group-v2">
                            <i class="icon icon-envelope2"></i>
                            <input type="email" name="email" id="xs_register_email" class="xs-input-control" placeholder="{{ __('PlaceHolder_email') }}" required>
                        </div>
                        <span class="invalid-feedback mesajesError d-block" role="alert">
                            <strong id="error-email"></strong>
                        </span>
                        <div class="xs-input-group-v2">
                            <i class="icon icon-key2"></i>
                            <input type="password" name="password" id="xs_register_password" class="xs-input-control" placeholder="{{ __('PlaceHolder_password') }}" required>
                        </div>
                        <span class="invalid-feedback mesajesError d-block" role="alert">
                            <strong id="error-password"></strong>
                        </span>
                        <div class="xs-input-group-v2">
                            <i class="icon icon-key2"></i>
                            <input type="password" name="password_confirmation" id="xs_register_repeat_pass" class="xs-input-control" placeholder="{{ __('PlaceHolder_password_confirmation') }}">
                        </div>
                        <div class="xs-submit-wraper xs-mb-20">
                            <button type="submit" value="login now" id="xs_register_get_action" class="btn btn-warning btn-block">{{ __('btn_register') }}</button>
                        </div>
                        <p class="xs-mb-20">or</p>
                        <div class="xs-submit-wraper xs-mb-20">
                            <a href="{{route('social_auth',['driver' => 'facebook'])}}" id="xs_facebook" class="btn btn-info btn-block">{{ __('btn_login_facebook') }}</a>
                        </div>
                        <div class="xs-submit-wraper">
                            <a href="{{route('social_auth',['driver' => 'google'])}}"  class="btn btn-success btn-block" style="background-color: #d34836 !important;">{{ __('btn_login_google') }}</a>
                        </div>
                    </form>
                </div><!-- tab-pane -->
            </div><!-- tab-content -->
        </div>
    </div>
</div><!-- End modal --><!-- End home section -->
@endauth

@push('js')
    <script src="/js/login.js"></script>
    <script>
        $(function () {
            $(".btn_volvel_login").click(function(){

               /* $('#frmResetPassword').hide();
                $('#frmLogin').show();*/
                $("#frmResetPassword").css("display", "none");
                $("#frmLogin").css("display", "block");

            });
            $(".btn_reset_password").click(function(){

                /*$('#frmResetPassword').show();
                $('#frmLogin').hide();*/
                $("#frmResetPassword").css("display", "block");
                $("#frmLogin").css("display", "none");

            });

        });
    </script>
    <script>
        window.modal_login = function () {
            try {
                $('#modal_auth_login').modal('hide')
            }catch (e) {
                return null
            }
        };
    </script>
    <script>

        window.Text_reset = '{{ __('correo_reset_password')}}';

        window.text_traduction_reset_pass = function () {
            try {

            }catch (e) {
                return null
            }
        };
    </script>
@endpush
