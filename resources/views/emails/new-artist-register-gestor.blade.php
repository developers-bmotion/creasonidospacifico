@component('mail::message')
# {{ __("¡Tus datos han sido registrados!") }}

Sr/Sra <strong>{{ $name }}  {{ $last_name }}</strong> hemos recibidos tus datos y su propuesta musical con la canción <strong>{{ $name_project }}</strong> han sido registrados.

{{ __('Pronto nos pondremos en contacto con usted.') }}<br>

{{--@component('mail::button', ['url' => route('show.backend.project', $project->slug)])
 {{ __('Ir a la canción') }}
@endcomponent--}}

{{ __('Gracias') }},<br>
{{ config('app.name') }}
@endcomponent
