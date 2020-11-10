@component('mail::message')
# ¡Saludos!  Sr/Sra Subsanador {{ $name }} {{ $last_name }}.

Informamos que el aspirante <strong>{{$name_aspirante}} {{ $last_name_aspirante }}</strong> ha enviado nuevamente ha revisión su propuesta musical con la canción <strong>{{ $name_project }}.</strong>

{{ __('Gracias') }}.<br>
{{ config('app.name') }}
@endcomponent
