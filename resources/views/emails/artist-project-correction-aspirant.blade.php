@component('mail::message')
# {{ __("¡Saludos! :artist", ['artist' => $artist_name]) }}

Informamos que tus documentos se revisaron y todo está en regla, tu propuesta ahora se encuentra habilitada para ser valorada por los curadores de la convocatoria. Te invitamos a estar atent@ a nuestras redes sociales donde se comunicarán los resultados.

**Este es un mensaje enviado por nuestro subsanador, quien se encargó de revisar tus documentos y propuesta musical:**
<br>
<br>
{!! $mesage !!}
<hr>

{{ __('Gracias') }}.<br>
{{ config('app.name') }}
@endcomponent
