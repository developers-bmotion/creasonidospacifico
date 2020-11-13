@component('mail::message')
# {{ __("¡Saludos! :artist", ['artist' => $artist]) }}

{{ __("Informamos que tus documentos se revisaron y todo está en regla, tu propuesta ahora se encuentra habilitada para ser valorada por los curadores de la convocatoria. Te invitamos a estar atent@ a nuestras redes sociales donde se comunicarán los resultados.
 ", ['artist' => $artist, 'project' => $project->title]) }}
{{-- @component('mail::button', ['url' => route('show.backend.project', $project->slug)])
        {{ __('Ir a la canción') }}
@endcomponent --}}

{{ __('Gracias') }},<br>
{{ config('app.name') }}
@endcomponent
