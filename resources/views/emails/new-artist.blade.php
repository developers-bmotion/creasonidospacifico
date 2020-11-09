@component('mail::message')
# {{ __("¡Tus datos han sido registrados!") }}

{{ __("Sr/Sra :artist hemos recibidos tus datos. ", ['artist' => $artist]) }}
Ten encuenta que puedes iniciar sesión e ingresar a tu perfil a traves de este link usando las credenciales de acceso (correo eléctronico y contreseña) que usaste al crear tu cuenta.
@component('mail::button', ['url' => route('login')])
 {{ __('Iniciar Sesión') }}
@endcomponent

Y no olvides en registrar tu propuesta musical a traves de este link:
@component('mail::button', ['url' => route('add.project')])
    {{ __('Subir Canción') }}
@endcomponent


{{--@component('mail::button', ['url' => route('show.backend.project', $project->slug)])
 {{ __('Ir a la canción') }}
@endcomponent--}}

{{ __('Gracias') }},<br>
{{ config('app.name') }}
@endcomponent
