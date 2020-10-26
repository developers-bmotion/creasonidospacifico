@component('mail::message')
# {{ __("¡Tu propuesta musical ha sido registrada!") }}

{{--{{ __("Sr/Sra :artist tu propuesta musical con la canción ", ['artist' => $artist]) }}--}}
{{--## {{ __(":project ", ['artist' => $artist, 'project' => $project->title]) }}--}}
{{--{{ __('ha sido registrada.') }}--}}

Sr/Sra {{ $artist }} tu propuesta musical con la canción <strong>{{ $project->title }}</strong> ha sido registrada.
{{ __('Pronto nos pondremos en contacto con usted. Gracias') }},<br>
{{--@component('mail::button', ['url' => route('show.backend.project', $project->slug)])
 {{ __('Ir a la canción') }}
@endcomponent--}}


{{ config('app.name') }}
@endcomponent
