@component('mail::message')
# ¡Saludos!  Sr/Sra Subsanador {{ $name }}.

Informamos que su proyecto ha sido rechazado

{{ __('Gracias') }}.<br>
{{ config('app.name') }}
@endcomponent
