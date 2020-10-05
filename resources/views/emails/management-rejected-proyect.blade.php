@component('mail::message')
# {{ __("¡Saludos! :management", ['management' => $management]) }}

{{ __("Informamos que el canción **:project** del artista :artist ha sido **Rechazada**.
", ['artist' => $artist, 'project' => $project->title]) }}
@component('mail::button', ['url' => route('show.backend.project', $project->slug)])
{{ __('Ir a la canción') }}
@endcomponent

{{ __('Gracias') }},<br>
{{ config('app.name') }}
@endcomponent
