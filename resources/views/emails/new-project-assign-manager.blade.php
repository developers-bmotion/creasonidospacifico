@component('mail::message')
# {{ __("¡Una nueva propuesta musical te fue asignada!") }}


Sr/Sra {{ $artist->name }}<br>
La canción: <strong>{{$project}}</strong> te fue asignada, recuerda calificarla.

Gracias

{{ config('app.name') }}
@endcomponent
