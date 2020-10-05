@component('mail::message')
# {{ __("¡Nuevo proyecto ha sido registrado!") }}

{{ __("El artista :artist ha enviado una nueva canción: ", ['artist' => $artist]) }}
## {{ __(":project ", ['artist' => $artist, 'project' => $project->title]) }}

@component('mail::button', ['url' => route('show.backend.project', $project->slug)])
 {{ __('Ir a la canción') }}
@endcomponent

{{ __('Gracias') }},<br>
{{ config('app.name') }}
@endcomponent
