@component('mail::message')
# {{ __("¡El aspirante han sido registrado!") }}
Que tal Sr/Sra gestor {{ $name_gestor }} {{ $last_name_gestor }}, el aspirante <strong >{{ $artist }} {{$last_name}}</strong> ha sido regitrado exitosamente.

{{--@component('mail::button', ['url' => route('show.backend.project', $project->slug)])
 {{ __('Ir a la canción') }}
@endcomponent--}}

{{ __('Gracias') }},<br>
{{ config('app.name') }}
@endcomponent
