@component('mail::message')
# ¡Saludos!  Sr/Sra aspirante {{ $name }} {{ $last_name }}.

Informamos que su proyecto ha sido rechazado por realizar las correciones a tiempo.

{{ __('Gracias') }}.<br>
{{ config('app.name') }}
@endcomponent
