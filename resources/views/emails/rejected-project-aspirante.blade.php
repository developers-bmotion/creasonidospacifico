@component('mail::message')
# ¡Saludos!  Sr/Sra aspirante {{ $name }} {{ $last_name }}.

Informamos que su proyecto ha sido rechazado por no realizar las correciones a tiempo.

{{ __('Gracias') }}.<br>
{{ config('app.name') }}
@endcomponent
