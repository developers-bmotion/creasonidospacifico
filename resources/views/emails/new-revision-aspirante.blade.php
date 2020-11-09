@component('mail::message')
# ¡Saludos! {{ $name }}

Informamos que tu canción <strong>{{$name_project}}</strong> se ha puesto en estado <strong>De nuevo a revisión.</strong>
<br>
Las correcciones que has realizado serán revisadas oportunamente.

{{ __('Gracias') }}.<br>
{{ config('app.name') }}
@endcomponent
