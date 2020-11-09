@component('mail::message')
# {{ __("¡Saludos! :artist", ['artist' => $artist]) }}

Informamos que tu canción <strong>{{$project}}</strong> se ha puesto en estado <strong>Pendiente</strong> por proceso de subsanación. Actualiza tu información lo más pronto posible para seguir concursando.

**Estas son tus observaciones:**
<br>
{!! $mesage !!}
{{--{{ __(":mesage", ['mesage' => $mesage]) }}--}}
{{--@component('mail::button', ['url' => route('show.backend.project', $project->slug)])--}}
{{--{{ __('Ir a la canción') }}--}}
{{--@endcomponent--}}
<hr>
Ten en cuenta que puedes iniciar sesión e ingresar a tu perfil a través de este link usando las credenciales de acceso (correo eléctronico y contreseña) que usaste al crear tu cuenta.
@component('mail::button', ['url' => route('login')])
    {{ __('Iniciar Sesión') }}
@endcomponent

{{ __('Gracias') }}.<br>
{{ config('app.name') }}
@endcomponent
