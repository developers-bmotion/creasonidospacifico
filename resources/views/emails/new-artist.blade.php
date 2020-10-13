@component('mail::message')
# {{ __("¡Tus datos han sido registrados!") }}

{{ __("Sr/Sra :artist hemos recibidos tus datos. ", ['artist' => $artist]) }}

{{ __('ahora es momento de que registres tu propuesta musical.') }}

{{--@component('mail::button', ['url' => route('show.backend.project', $project->slug)])
 {{ __('Ir a la canción') }}
@endcomponent--}}

{{ __('Gracias') }},<br>
{{ config('app.name') }}
@endcomponent
