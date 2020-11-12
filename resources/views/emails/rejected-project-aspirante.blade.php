@component('mail::message')
# ¡Saludos!  Sr/Sra aspirante {{ $name }} {{ $last_name }}.

Informamos que su propuesta musical ha pasado a estado <strong>No subsanado</strong>; por no realizar las correciones a tiempo, pedidas por el subsanador.

{{ __('Gracias') }}.<br>
{{ config('app.name') }}
@endcomponent
