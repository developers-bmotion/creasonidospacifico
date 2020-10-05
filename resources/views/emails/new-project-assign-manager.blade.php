@component('mail::message')
# {{ __("¡Una nueva canción se te ha sido asignado!") }}
<img class="img-responsive text-center" align="center" width="90" src="{{ url($img_artist->picture )}}" alt="{{ $project->title }}" style="border-radius: 50%;margin-right: auto;margin-left: auto;display: block">
{{ __("El artista :artist desea que conozcas su proyecto: ", ['artist' => $artist]) }}
## {{ __(":project ", ['project' => $project->title]) }}
<img class="img-responsive" src="{{ $project->project_picture?url($project->project_picture):'#' }}" alt="{{ $project->title }}">
@component('mail::button', ['url' => route('show.backend.project', $project->slug)])
{{ __('Ir a la canción') }}
@endcomponent
{{ __("Recuerda valorar esta canción antes de :end_time para tener en cuenta tu valoracion y opinión.", ['end_time' => $end_time->end_time->toFormattedDateString()]) }}<br><br>
{{ __('Gracias') }},<br>
{{ config('app.name') }}
@endcomponent
