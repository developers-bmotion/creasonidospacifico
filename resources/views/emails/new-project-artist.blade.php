@component('mail::message')
# {{ __("¡Tu proyecto ha sido registrado!") }}

{{ __("Sr/Sra :artist tu propuesta musical con la canción ", ['artist' => $artist]) }}
## {{ __(":project ", ['artist' => $artist, 'project' => $project->title]) }}
{{ __('ha sido registrada.') }}

{{--@component('mail::button', ['url' => route('show.backend.project', $project->slug)])
 {{ __('Ir a la canción') }}
@endcomponent--}}

{{ __('Pronto nos pondremos en contacto con usted. Gracias') }},<br>
{{ config('app.name') }}
@endcomponent
