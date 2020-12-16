@extends('backend.layout')

@section('header')
    <div class="row pt-4">
        <div class="col-12">

            @if(auth()->user()->roles[0]->rol == 'Admin')
                @if( $project->status == 2 )
                    {{-- @dd($qual) --}}
                    <div class="m-accordion m-accordion--default m-accordion--toggle-arrow" id="m_accordion_9"
                         role="tablist">
                        <div class="m-accordion__item ">
                            <div style="background-color: #739594" class="m-accordion__item-head collapsed" role="tab"
                                 id="m_accordion_9_item_2_head"
                                 data-toggle="collapse" href="#m_accordion_9_item_2_body" aria-expanded="false">
                                {{--<span class="m-accordion__item-icon"><i class="fa  flaticon-placeholder"></i></span>--}}
                                <span
                                    class="m-accordion__item-title"
                                    style="color: white">Historial de calificaciones</span>
                                <span class="m-accordion__item-mode"></span>
                            </div>
                            <div class="m-accordion__item-body collapse" id="m_accordion_9_item_2_body" role="tabpanel"
                                 aria-labelledby="m_accordion_9_item_2_head" data-parent="#m_accordion_9" style="">
                                <div class="m-accordion__item-content">
                                    @foreach ($qual as $cal)
                                        {{-- @dd($cal) --}}
                                        <h6> {{ $loop->iteration }} .Calificación:</h6>
                                        <br>
                                        <table style="text-align: center"
                                               class='my-table-admin my-table table-striped review_table'>
                                            <thead>
                                            <tr>
                                                <th scope='col'>Aspectos técnicos musicales</th>
                                                <th scope='col'>Aporte creativo</th>
                                                <th scope='col'>Calidad interpretativa</th>
                                                <th scope='col'>Calidad del repertorio escogido</th>
                                                <th scope='col'>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody style='font-weight:500;'>
                                            <tr>
                                                <th>{{ $cal->melody_rhythm }} </th>
                                                <td>{{ $cal->originality }}</td>
                                                <td>{{ $cal->arrangements }}</td>
                                                <td>{{ $cal->lyric }}</td>
                                                <td>{{ $cal->melody_rhythm + $cal->originality + $cal->arrangements + $cal->lyric }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                        <h6>Observaciones:</h6>
                                        <div>{!! $cal->comment !!}</div>
                                        <br>
                                        <a href="{{ route('profile.curador',$cal->users->slug)}}">

                                            <span style="font-size:1.1rem;color:#739594;"
                                                  class="font-weight-bold mb-3">Calificado por: {{ $cal->users->name }}  {{ $cal->users->last_name }}</span>
                                        </a>
                                        <br>
                                        <hr>


                                    @endforeach

                                    @if($qual_second != null)
                                    <h6>2. Calificación:</h6>
                                        <br>
                                        <table style="text-align: center"
                                               class='my-table-admin my-table table-striped review_table'>
                                            <thead>
                                            <tr>
                                                <th scope='col'>Aspectos técnicos musicales</th>
                                                <th scope='col'>Aporte creativo</th>
                                                <th scope='col'>Calidad interpretativa</th>
                                                <th scope='col'>Calidad del repertorio escogido</th>
                                                <th scope='col'>Trayectoria</th>
                                                <th scope='col'>Capacidad e interès</th>
                                                <th scope='col'>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody style='font-weight:500;'>
                                            <tr>
                                                <th>{{ $qual_second->melody_rhythm }} </th>
                                                <td>{{ $qual_second->originality }}</td>
                                                <td>{{ $qual_second->arrangements }}</td>
                                                <td>{{ $qual_second->lyric }}</td>
                                                <td>{{ $qual_second->trajectory }}</td>
                                                <td>{{ $qual_second->project_interest }}</td>
                                                <td>{{ round(($qual_second->melody_rhythm + $qual_second->originality + $qual_second->arrangements + $qual_second->lyric + $qual_second->trajectory +$qual_second->project_interest)/6, 2) }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                        <h6>Observaciones:</h6>
                                        <div>{!! $qual_second->comment !!}</div>
                                        <br>
                                        <a href="{{ route('profile.curador',$qual_second->users->slug)}}">

                                            <span style="font-size:1.1rem;color:#739594;"
                                                  class="font-weight-bold mb-3">Calificado por: {{ $qual_second->users->name }}  {{ $qual_second->users->last_name }}</span>
                                        </a>
                                        <br>
                                        <hr>
                                        @endif
                                        @if($qual_second != null)
                                            <span style="font-size:1.1rem;color:#739594;float:right;"
                                                class="font-weight-bold mb-3">Calificación final: {{ round(($qual_second->melody_rhythm + $qual_second->originality + $qual_second->arrangements + $qual_second->lyric + $qual_second->trajectory +$qual_second->project_interest)/6, 2) }}</span>
                                        @endif

                                </div>

                            </div>
                        </div>
                    </div>

                @endif
            @endif
            {{-- @dd($qual) --}}
            @if(auth()->user()->roles[0]->rol == 'Gestor')
                @if( $project->status == 4  )

                <!--=====================================
		        ALERTA PARA MOSTRAR EL ESTADO PENDIENTE
            ======================================-->
                    <form id="update_revision" action="{{ route('update.state.revision') }}" method="post">
                        @csrf {{ method_field('PUT') }}
                        <input type="hidden" name="state_revision" value="6">
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="m-alert m-alert--icon m-alert--outline alert alert-warning" role="alert">
                            <div class="m-alert__icon">
                                <i class="la la-warning"></i>
                            </div>
                            <div class="m-alert__text" style="color:#ca8e0c !important;" data-toggle="modal"
                                 data-target="#verObservaciones">
                                Propuesta musical esta en estado <strong>Pendiente</strong>, click
                                <strong
                                    style="cursor: pointer">aquí</strong> para ver los detalles que debes ajustar.
                                Al terminar y estar seguro que todo esta bien, volver a enviar.
                                <p style="font-style: oblique;"> Nota: Recuerda que debes realizar los ajustes antes
                                    del
                                    <strong>{{ \Carbon\Carbon::parse($project->published_at)->formatLocalized('%A %d de %B de %Y %H:%M:%S') }}</strong>
                                </p>


                            </div>
                            <div class="m-alert__actions" style="width: 200px;">
                                <button id="btn_update_revision" href="{{ route('update.state.revision') }}"
                                        class="btn btn-warning btn-sm m-btn m-btn--pill m-btn--wide"
                                        style="color:#fff">Enviar propuesta musical nuevamente
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="modal fade" id="verObservaciones" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                        Observaciones </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @php($count = 1 )
                                    @if(count($artist->historyReviews) != 0)
                                        @forelse($artist->historyReviews as $historyReviews)
                                            <h5 class="pb-3">{{ $count++ }}. Observación </h5>
                                            <div class="row">
                                                <div class="col-12 col-md-10 col-lg-10">
                                                    <div class="form-group m-form__group">
                                                        <div class="m-form__group-sub">
                                                            <label
                                                                class="form-control-label font-weight-bold">Observación:
                                                            </label>
                                                            <p>{!! $historyReviews->pivot->observation !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-2 col-lg-2">
                                                    <div class="form-group m-form__group">
                                                        <div class="m-form__group-sub">
                                                            <label
                                                                class="form-control-label font-weight-bold">Estado:
                                                            </label>
                                                            <br>
                                                            @if($historyReviews->pivot->state == 1)
                                                                <span
                                                                    class="m-badge m-badge--warning m-badge--wide">Pendiente</span>
                                                            @else
                                                                <span
                                                                    class="m-badge m-badge--success m-badge--wide">Corregido</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        @empty
                                            <h4 class="text-center">Sin observaciones</h4>
                                        @endforelse
                                    @endif
                                </div>
                                <div class="modal-footer">

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

        </div>
    </div>
@stop

@section('content')

    <div class="m-content subsanador-content">
        <!--=====================================
		    LISTA DE OBSERVACIONES
        ======================================-->
        @if(auth()->user()->roles[0]->rol == 'Subsanador' || auth()->user()->roles[0]->rol == 'Admin')
            @if(count($artist->historyReviews) != 0)
                <div class="m-accordion m-accordion--default m-accordion--toggle-arrow" id="m_accordion_5"
                     role="tablist">
                    <div class="m-accordion__item m-accordion__item--warning">
                        <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_5_item_2_head"
                             data-toggle="collapse" href="#m_accordion_5_item_2_body" aria-expanded="false">
                            {{--<span class="m-accordion__item-icon"><i class="fa  flaticon-placeholder"></i></span>--}}
                            <span
                                class="m-accordion__item-title">Observaciones luego de revisón por el subsanador</span>
                            <span class="m-accordion__item-mode"></span>
                        </div>
                        <div class="m-accordion__item-body collapse" id="m_accordion_5_item_2_body" role="tabpanel"
                             aria-labelledby="m_accordion_5_item_2_head" data-parent="#m_accordion_5" style="">
                            <div class="m-accordion__item-content">

                                @php($count = 1 )

                                <div class="row pt-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <h5 style="font-weight: bold">Historial de Observaciones:</h5>
                                            <p>Fecha última revisión por el subsanador:
                                                <strong>{{ \Carbon\Carbon::parse($project->original_datetime)->formatLocalized('%A %d de %B de %Y %H:%M:%S') }}</strong>
                                            </p>
                                            <p>Fecha limite de correción por el aspirante:
                                                <strong>{{ \Carbon\Carbon::parse($project->published_at)->formatLocalized('%A %d de %B de %Y %H:%M:%S') }}</strong>
                                            </p>
                                        </div>
                                        <div class="m-section">
                                            <div class="m-section__content">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Observación</th>
                                                        <th>Estado</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($artist->historyReviews as $historyReviews)
                                                        <tr>
                                                            <th scope="row">{{ $count++ }}</th>
                                                            <td>{!! $historyReviews->pivot->observation !!}</td>

                                                            @if($historyReviews->pivot->state == 1)
                                                                <td>
                                                                    <span
                                                                        class="m-badge m-badge--warning m-badge--wide">Pendiente</span>
                                                                </td>
                                                            @elseif($historyReviews->pivot->state == 2)
                                                                <td>
                                                                <span
                                                                    class="m-badge m-badge--success m-badge--wide">Corregido</span>
                                                                </td>
                                                            @endif

                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="m-portlet m-portlet--full-height " style="margin-bottom: 0px;">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Información de la canción
                            </h3>
                        </div>
                    </div>
                    @if(auth()->user()->roles[0]->rol == "Admin")
                    {{-- @dd($qual_second) --}}
                        @if( $project->status == 2 )
                        @if($qual_second != null)

                            <span style="font-size:1.1rem;color:#739594;margin-top: 1.9rem;" class="font-weight-bold">Calificación final: {{ round(($qual_second->melody_rhythm + $qual_second->originality + $qual_second->arrangements + $qual_second->lyric + $qual_second->trajectory +$qual_second->project_interest)/6, 2) }}</span>
                        @endif
                        @endif
                    @endif
                    {{-- @if(auth()->user()->roles[0]->rol == "Admin")
                        @if( $project->status == 2 )
                            <span style="font-size:1.1rem;color:#739594;margin-top: 1.9rem;" class="font-weight-bold">Calificación final: {{ $sumRating }}</span>
                        @endif
                    @endif --}}
                </div>
                <div class="m-portlet__body">
                    <div class="m-section section-movil">
                        <div class="row">
                            <div class="col-12 player" style="padding-right: 2.5rem;">
                                <div class="form-group">
                                    <h5 style="font-weight: bold">Canción principal:</h5>
                                </div>
                                <audio preload="auto" controls>

                                    <source src="{{ $project->audio }}">
                                    {{-- <input name="project_id" id="project_id" type="hidden" value="{{ $project->id }}"> --}}
                                    {{-- <source src="{{ $project->audio }}" type="video/3gpp;" codecs="mp4v.20.8, samr"> --}}
                                </audio>

                            </div>
                            @if(\App\User::navigation() == "Gestor")



                                <div class="row drop_audio col-12" style="display: none">
                                    <div
                                        class="col-lg-12 m-form__group-sub {{$errors->has('subir_cancion')? 'has-danger':''}}">
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-12">
                                                <label class="form-control-label"
                                                       form="nombreProyecto"><span
                                                        class="text-danger">*</span>
                                                    Subir canción:</label>
                                                <div class="m-dropzone dropzone-audio m-dropzone--success"
                                                     action=""
                                                     id="m-dropzone-three">
                                                    <div class="m-dropzone__msg dz-message needsclick">
                                                        <h3 class="m-dropzone__msg-title">
                                                            Agregue su canción en formato MP3</h3>
                                                        <span
                                                            class="m-dropzone__msg-desc">Arrastra o has clic a aquí para subir</span>
                                                    </div>
                                                </div>
                                                {!! $errors->first('subir_cancion','<div class="form-control-feedback">*:message
                                                           </div>')!!}
                                                <span class="m-form__help">Cargue aquí el audio de la canción en formato Mp3.</span>
                                                <input type="hidden" id="inputDBAudioAddProject"
                                                       name="subir_cancion" value="">
                                                <div id="erroresImagen" style="color: var(--danger)"
                                                     class="form-control-feedback"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-1 pt-5 mt-4">
                                    <i class="flaticon-edit ml-3 update_audio"
                                       style="color:#716aca; cursor:pointer;"></i>
                                    <button type="button" class="btn btn-primary cancel_audio"
                                            style="display:none">
                                        Cancelar
                                    </button>

                                </div>



                            @endif

                            <div class="secondary_audios col-md-12 row mt-5">
                                @if($project->audio_secundary_two)
                                    <div class="col-12 col-md-6 col-lg-6 player">
                                        <div class="form-group">
                                            <h5 style="font-weight: bold">Canción extra uno(no participa en
                                                el
                                                concurso):</h5>
                                        </div>
                                        <audio preload="auto" controls>
                                            <source src="{{ $project->audio_secundary_two}}">
                                            {{-- <input name="project_id" id="project_id" type="hidden" value="{{ $project->id }}"> --}}
                                        </audio>

                                    </div>
                                @endif
                                @if($project->audio_secundary_one)
                                    <div class="col-12 col-md-6 col-lg-6 player">
                                        <div class="form-group">
                                            <h5 style="font-weight: bold">Canción extra dos(no participa en
                                                el
                                                concurso):</h5>
                                        </div>
                                        <audio preload="auto" controls>
                                            <source src="{{ $project->audio_secundary_one }}">
                                            {{-- <input name="project_id" id="project_id" type="hidden" value="{{ $project->id }}"> --}}
                                        </audio>
                                    </div>
                                @endif
                            </div>
                            {{-- @dd(\App\User::navigation()); --}}

                        </div>
                        <div class="row p-2" style="margin-right: 0px;">
                            {{-- reproductor --}}

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5 style="font-weight: bold">{{ __('estado') }}:</h5>
                                </div>
                                <div class="form-group">
                                    @if($project->status == 1)
                                        <span
                                            class="m-badge m-badge--metal m-badge--wide m-badge--rounded">{{ __('revision') }}</span>
                                    @elseif($project->status == 2)
                                        <span class="m-badge m-badge--brand m-badge--wide m-badge--rounded"
                                              style="background-color: #9816f4 !important;">Calificado</span>
                                        {{-- @elseif($project->status == 3)
                                            <span
                                                class="m-badge m-badge--success m-badge--wide m-badge--rounded">{{ __('aprobado') }}</span> --}}
                                    @elseif($project->status == 4)
                                        <span
                                            class="m-badge m-badge--warning m-badge--wide m-badge--rounded">Pendiente</span>
                                    @elseif($project->status == 5)
                                        <span
                                            class="m-badge m-badge--danger m-badge--wide m-badge--rounded">No subsanado</span>
                                    @elseif($project->status == 6)
                                        <span
                                            class="m-badge m-badge--brand m-badge--wide m-badge--rounded">Nueva revision</span>
                                    @elseif($project->status == 7)
                                        <span
                                            class="m-badge m-badge--success m-badge--wide m-badge--rounded">Aceptado</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5 style="font-weight: bold">Nombre de la canción:</h5>
                                </div>
                                <div class="form-group">

                                    {{ $project->title }}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5 style="font-weight: bold">Autor:</h5>
                                </div>
                                <div class="form-group">

                                    {{ $project->author }}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5 style="font-weight: bold">Modalidad:</h5>
                                </div>
                                <div class="form-group">
                                    {{ $project->category->category }}
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">

                                <div class="form-group">
                                    <h5 style="font-weight: bold">Descripción:</h5>
                                </div>
                                <div class="form-group" style="text-align: justify">

                                    {{ $project->description }}
                                </div>
                            </div>
                            @if(auth()->user()->roles[0]->rol == "Subsanador")
                                @include('backend.partials.rating.'.\App\User::rating_proyect())
                            @endif

                        </div>

                    </div>
                    @if(\App\User::rating_proyect())
                        {{-- <div id="show_assign_list_management" style="display: none">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            {{ __('lista_managements') }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-section">
                                <br>
                                <div class="row">
                                    <div class="col-xs-4 col-lg-12">
                                        <div class="box-body table-responsive text-center">
                                            <table class="table table-striped- table-bordered table-hover"
                                                   id="table_assign_management">
                                                <thead>
                                                <tr>
                                                    <th>Curador</th>
                                                    <th>{{ __('nombre') }}</th>
                                                    <th>{{ __('compañia') }}</th>
                                                    <th>{{ __('email') }}</th>
                                                    <th>{{ __('calificacion') }}</th>
                                                    <th>{{ __('comentario') }}</th>
                                                    <th>{{ __('acciones') }}</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-lg-4">
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('informacion_artista') }}
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__body ">
                    <div class="row">

                        <div class="col-md-4">

                            <div class="m-portlet m-portlet--full-height  ">
                                <div class="m-portlet__body ">
                                    <div class="m-card-profile">
                                        <div class="m-card-profile__title m--hide">
                                            Your Profile
                                        </div>
                                        <div class="m-card-profile__pic">
                                            <div class="m-card-profile__pic-wrapper">
                                                @if($artist->artists[0]->users->picture)
                                                    <img src="{{ $artist->artists[0]->users->picture }}"
                                                         alt="">

                                                @else
                                                    <img src="/default/user.png"
                                                         alt=""/>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="m-card-profile__details">
                                            <span
                                                class="m-card-profile__name">{{ $artist->artists[0]->users->name }} {{ $artist->artists[0]->users->last_name }} {{ $artist->artists[0]->users->second_last_name }}</span>

                                            <a href="" class="m-card-profile__email m-link"
                                               style="margin-left: -15px; width: 80%; word-wrap: break-word;">{{ $artist->artists[0]->users->email }}</a>

                                        </div>


                                        <div class="form-group pt-5 text-center">
                                            <h5 style="font-weight: bold">Estado de la propuesta
                                                musical:</h5>
                                        </div>
                                        <div class="form-group text-center">
                                            @if($project->status == 1)
                                                <span
                                                    class="m-badge m-badge--metal m-badge--wide m-badge--rounded">{{ __('Revision') }}</span>
                                            @endif
                                            @if($project->status == 2)
                                                <span
                                                    class="m-badge m-badge--brand m-badge--wide m-badge--rounded"
                                                    style="background-color: #9816f4 !important;">Calificado</span>
                                            @endif
                                            @if($project->status == 3)
                                                <span
                                                    class="m-badge m-badge--success m-badge--wide m-badge--rounded">Aprobado</span>
                                            @endif
                                            @if($project->status == 4)
                                                <span class="m-badge m-badge--warning m-badge--wide"
                                                      style="color:#fff">{{ __('Pendiente') }}</span>
                                            @endif
                                            @if($project->status == 5)
                                                <span
                                                    class="m-badge m-badge--danger m-badge--wide m-badge--rounded">No subsanado</span>
                                            @endif
                                            @if($project->status == 6)
                                                <span
                                                    class="m-badge m-badge--metal m-badge--wide m-badge--rounded">De nuevo en revisión</span>
                                            @endif
                                            @if($project->status == 7)
                                                <span
                                                    class="m-badge m-badge--success m-badge--wide m-badge--rounded">Aceptado</span>
                                            @endif
                                        </div>
                                        <div class="form-group pt-5 text-center">
                                            <h5 style="font-weight: bold">Acturá como:</h5>
                                        </div>
                                        <div class="form-group text-center">
                                                <span>
                                                    {{$artist->artists[0]->personType->name}}
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="biografia col-md-7">
                            <div class="row">

                                <div class="col-md-6 mt-2">
                                    <label style="font-weight: bold">Tipo deidentificación:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">
                                        <p>{{ $artist->artists[0]->documentType->document}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label style="font-weight: bold">Nº identificación:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">
                                        <p>{{ $artist->artists[0]->identification }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label style="font-weight: bold">Departamento de Expedición:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">
                                        <p>{{$artist->artists[0]->expeditionPlace->departaments->descripcion}}</p>

                                    </div>

                                </div>
                                <div class="col-md-6 mt-2">
                                    <label style="font-weight: bold">Ciudad de Expedición:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">
                                        <p>{{$artist->artists[0]->expeditionPlace->descripcion}}</p>
                                    </div>

                                </div>
                                <div class="col-md-6 mt-2">
                                    <label style="font-weight: bold">Dirección de residencia:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">
                                        <p>{{ $artist->artists[0]->adress }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label style="font-weight: bold">Departamento de residencia:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">

                                        <p>{{$artist->artists[0]->residencePlace->departaments->descripcion}}</p>

                                    </div>

                                </div>
                                <div class="col-md-6 mt-2">
                                    <label style="font-weight: bold">Ciudad de residencia:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">
                                        <p>{{$artist->artists[0]->residencePlace->descripcion}}</p>
                                    </div>
                                </div>
                                @if($artist->artists[0]->township)
                                    <div class="col-md-6 mt-2">
                                        <label style="font-weight: bold">Vereda/Corregimiento:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{$artist->artists[0]->township }}</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6 mt-2">
                                    <label style="font-weight: bold">Fecha de nacimiento:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">
                                        <p>{{ Carbon\Carbon::parse($artist->artists[0]->byrthdate)->formatLocalized('%d de %B de %Y') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label style="font-weight: bold">Departamento de nacimiento:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">

                                        <p>{{$country->departaments->descripcion}}</p>

                                    </div>

                                </div>

                                <div class="col-md-6 mt-2">
                                    <label style="font-weight: bold">Ciudad de nacimiento:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">
                                        <p>{{$country->descripcion}}</p>
                                    </div>

                                </div>

                                <div class="col-md-6 mt-2">
                                    <label style="font-weight: bold">Teléfono:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">
                                        <p>{{ $artist->artists[0]->users->phone_1}}</p>
                                    </div>
                                </div>
                                @if($artist->artists[0]->users->phone_2)
                                    <div class="col-md-6 mt-2">
                                        <label style="font-weight: bold">Otro teléfono:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{$artist->artists[0]->users->phone_2 }}</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6 mt-2">
                                    <label style="font-weight: bold">Linea de convocatoria:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">
                                        <p>{{ $artist->artists[0]->personType->name}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label style="font-weight: bold">Actuara como:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">
                                        <p>{{ $artist->artists[0]->artistType->name}}</p>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label style="font-weight: bold">Documento de identificación:</label>
                                    <br>
                                    <button type="button" class="btn btn-primary ver_pdf_aspirante"
                                            data-toggle="modal"
                                            data-target="#verpdfidentificacion">
                                        Ver documento de identidad
                                    </button>
                                    @if(\App\User::navigation() == "Gestor")

                                        <div class="row drop_pdf_asp" style="display: none">

                                            <div class="m-form__group form-group">
                                                <div class="col-lg-12 m-form__group-sub">
                                                    <label for="">Seleccione el tipo de formato para subir
                                                        el
                                                        documento de identificación</label>
                                                    <div class="m-radio-inline">
                                                        <label class="m-radio">
                                                            <input type="radio"
                                                                   name="aspirante[identificacionDoc]"
                                                                   value="1" checked="checked"> Imagen
                                                            <span></span>
                                                        </label>
                                                        <label class="m-radio">
                                                            <input type="radio"
                                                                   name="aspirante[identificacionDoc]"
                                                                   value="2"> PDF
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div id="image-docuemnt-aspirante"
                                                     class="form-group m-form__group row">
                                                    <div class="col-lg-6 m-form__group-sub">
                                                        <label for="">Imagen documento identificación
                                                            frente</label>
                                                        <div
                                                            class="m-dropzone file-image-document-aspirante-frente m-dropzone--success"
                                                            action="inc/api/dropzone/upload.php"
                                                            id="m-dropzone-three">
                                                            <div
                                                                class="m-dropzone__msg dz-message needsclick">
                                                                <h3 class="m-dropzone__msg-title">Subir foto
                                                                    del
                                                                    frente de su documento de
                                                                    identificación</h3>
                                                                <span
                                                                    class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 m-form__group-sub">
                                                        <label for="">Imagen documento identificación
                                                            atras</label>
                                                        <div
                                                            class="m-dropzone file-image-document-aspirante-atras m-dropzone--success"
                                                            action="inc/api/dropzone/upload.php"
                                                            id="m-dropzone-three">
                                                            <div
                                                                class="m-dropzone__msg dz-message needsclick">
                                                                <h3 class="m-dropzone__msg-title">Subir foto
                                                                    de la
                                                                    parte de atrás de su documento de
                                                                    identificación</h3>
                                                                <span
                                                                    class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="pdf-docuemnt-aspirante" style="display: none"
                                                     class="form-group m-form__group row">
                                                    <div class="col">
                                                        <div class="form-group m-form__group ">
                                                            <div
                                                                class="m-dropzone dropzone m-dropzone--success"
                                                                action="inc/api/dropzone/upload.php"
                                                                id="m-dropzone-three">
                                                                <div
                                                                    class="m-dropzone__msg dz-message needsclick">
                                                                    <h3 class="m-dropzone__msg-title">{{ __('Subir documento de identificación por ambos lados') }}</h3>
                                                                    <span
                                                                        class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form id="form_update_img" method="post"
                                                  action="{{ route('update.imgdoc.artist.gestor') }}"
                                                  enctype="multipart/form-data"
                                                  class="m-form m-form--label-align-left- m-form--state-"
                                                  id="actualizar_img_asp">
                                                @csrf {{ method_field('PUT') }}
                                                <input type="hidden"
                                                       name="aspirante[urlImageDocumentFrente]"
                                                       class="form-control m-input" value="">
                                                <input type="hidden" name="aspirante[urlImageDocumentAtras]"
                                                       class="form-control m-input" value="">
                                                <input type="hidden" name="aspirante[idAspirante]"
                                                       class="form-control m-input"
                                                       value="{{  $artist->artists[0]->user_id}}">

                                            </form>

                                        </div>
                                        <i class="flaticon-edit ml-3 update_pdf_asp"
                                           style="color:#716aca; cursor:pointer;"></i>
                                        <button type="button" class="btn btn-primary cancel_pdf_asp"
                                                style="display:none">Cancelar
                                        </button>
                                        <button id="btn_enviar_asp" type="button"
                                                class="btn btn-primary  enviar_asp"
                                                style="display:none">enviar
                                        </button>
                                    @endif

                                </div>


                                <div class="col-md-12 pt-4" style="margin-right: 1.5rem;">

                                    <label style="font-weight: bold">{{ __('biografia') }}:</label>
                                    <div class="m-scrollable" data-scrollable="true" style="">
                                        <p style="text-align: justify">{{ $artist->artists[0]->biography }}</p>
                                    </div>
                                </div>
                                {{-- @dd($artist) --}}

                            </div>
                            @if($artist->artists[0]->gestor_id !== null)
                                <hr>
                                <div class="ml-2">

                                    {{-- @dd($artist->users->name) --}}
                                    <h5 style="font-weight: bold"
                                        class="">Aspirante registrado por el gestor <a
                                            href="{{ route('profile.managament', $artist->artists[0]->userGestor->slug)}}"><span>{{ $artist->artists[0]->userGestor->name }} {{$artist->artists[0]->userGestor->last_name}}</span></a>
                                    </h5>
                                    <div class="">
                                        <br>
                                        <label style="font-weight: bold">Documento de soporte:</label>
                                        <br>
                                        <button type="button" class="btn btn-primary btn_pdf_soporte"
                                                data-toggle="modal"
                                                data-target="#verpdfsoporte">
                                            Ver documento de soporte
                                        </button>
                                        @if(\App\User::navigation() == "Gestor")

                                            <div class="row drop_soporte" style="display: none">

                                                <div class="m-form__group form-group">

                                                    <div id="pdf-soporte"
                                                         class="form-group m-form__group row">
                                                        <div class="col">
                                                            <div class="form-group m-form__group ">
                                                                <div
                                                                    class="m-dropzone dropzone-soporte m-dropzone--success"
                                                                    action="inc/api/dropzone/upload.php"
                                                                    id="m-dropzone-three">
                                                                    <div
                                                                        class="m-dropzone__msg dz-message needsclick">
                                                                        <h3 class="m-dropzone__msg-title">{{ __('Subir formulario offline en formato PDF') }}</h3>
                                                                        <span
                                                                            class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <i class="flaticon-edit ml-3 update_pdf_soporte"
                                               style="color:#716aca; cursor:pointer;"></i>
                                            <button type="button" class="btn btn-primary cancel_pdf_soporte"
                                                    style="display:none">Cancelar
                                            </button>

                                        @endif

                                    </div>

                                </div>
                                {{-- modal soporte --}}
                                <div class="modal fade" id="verpdfsoporte" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                    Documento soporte
                                                    de {{ $artist->artists[0]->users->name}} {{ $artist->artists[0]->users->last_name}} {{ $artist->artists[0]->users->second_last_name}}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                @if(!$artist->artists[0]->evidence_document)
                                                    <p>No se cargo el documento correctamente</p>
                                                @else
                                                    <div>
                                                        <object
                                                            data="{{ $artist->artists[0]->evidence_document}}"
                                                            frameborder="0" width="100%" height="400px"></object>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @if( count($artist->artists[0]->teams) != 0)

        <!--begin::Portlet-->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="m-portlet m-portlet--full-height">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Información de los integrantes
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="row mb-4 pl-4">

                            <h5 class="mr-3">Nombre de la agrupación: </h5>
                            <span> {{ $artist->artists[0]->name_team }}</span>
                        </div>
                        <div class="m-accordion m-accordion--bordered m-accordion--solid" id="m_accordion_4"
                             role="tablist">

                            <!--begin::Item-->
                            @foreach ($artist->artists[0]->teams as $team)

                                {{-- @dd($team) --}}
                                <div class="m-accordion__item">
                                    <div class="m-accordion__item-head collapsed" role="tab"
                                         id="m_accordion_4_item_1_head"
                                         data-toggle="collapse"
                                         href="#m_accordion_4_item_{{ $loop->iteration }}"
                                         aria-expanded="    false">
                                        <span class="m-accordion__item-icon">{{ $loop->iteration }}</span>
                                        <span class="m-accordion__item-title">{{ $team->name }}</span>
                                        <span class="m-accordion__item-mode"></span>
                                    </div>
                                    <div class="m-accordion__item-body collapse"
                                         id="m_accordion_4_item_{{ $loop->iteration }}" class=" "
                                         role="tabpanel"
                                         aria-labelledby="m_accordion_4_item_1_head"
                                         data-parent="#m_accordion_4">
                                        <div class="m-accordion__item-content">
                                            <div class="m-portlet__body ml-5">
                                                <div class="row">


                                                    <div class="biografia col-md-12">
                                                        <div class="row">


                                                            <div class="col-md-4 mt-2">
                                                                <label style="font-weight: bold">Tipo
                                                                    identificación:</label>
                                                                <div class="m-scrollable"
                                                                     data-scrollable="true"
                                                                     style="">
                                                                    <p>{{ $team->documentType->document}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-2">
                                                                <label
                                                                    style="font-weight: bold">Identificación:</label>
                                                                <div class="m-scrollable"
                                                                     data-scrollable="true"
                                                                     style="">
                                                                    <p>{{ $team->identification}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-2">
                                                                <label
                                                                    style="font-weight: bold">Nombre:</label>
                                                                <div class="m-scrollable"
                                                                     data-scrollable="true"
                                                                     style="">
                                                                    <p>{{ $team->name}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-2">
                                                                <label
                                                                    style="font-weight: bold">Apellidos:</label>
                                                                <div class="m-scrollable"
                                                                     data-scrollable="true"
                                                                     style="">
                                                                    <p>{{ $team->last_name}} {{ $team->second_last_name }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-2">
                                                                <label
                                                                    style="font-weight: bold">Direccion:</label>
                                                                <div class="m-scrollable"
                                                                     data-scrollable="true"
                                                                     style="">
                                                                    <p>{{ $team->addres}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-2">
                                                                <label style="font-weight: bold">Departamento
                                                                    de
                                                                    residencia:</label>
                                                                <div class="m-scrollable"
                                                                     data-scrollable="true"
                                                                     style="">
                                                                    <p>{{ $team->residencePlace->departaments->descripcion}}</p>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-4 mt-2">
                                                                <label style="font-weight: bold">Ciudad de
                                                                    residencia:</label>
                                                                <div class="m-scrollable"
                                                                     data-scrollable="true"
                                                                     style="">
                                                                    <p>{{ $team->residencePlace->descripcion}}</p>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-4 mt-2">
                                                                <label style="font-weight: bold">Fecha de
                                                                    nacimiento:</label>
                                                                <div class="m-scrollable"
                                                                     data-scrollable="true"
                                                                     style="">
                                                                    <p>{{  Carbon\Carbon::parse($team->birthday)->formatLocalized('%d de %B de %Y') }}</p>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-4 mt-2">
                                                                <label
                                                                    style="font-weight: bold">Teléfono:</label>
                                                                <div class="m-scrollable"
                                                                     data-scrollable="true"
                                                                     style="">
                                                                    <p>{{ $team->phone1}}</p>
                                                                </div>
                                                            </div>
                                                            @if($team->phone2)
                                                                <div class="col-md-4 mt-2">
                                                                    <label style="font-weight: bold">Teléfono
                                                                        2:</label>
                                                                    <div class="m-scrollable"
                                                                         data-scrollable="true"
                                                                         style="">
                                                                        <p>{{ $team->phone2}}</p>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="col-md-4 mt-2">

                                                                <label style="font-weight: bold">Instrumento
                                                                    que
                                                                    interpreta:</label>
                                                                <div class="m-scrollable"
                                                                     data-scrollable="true"
                                                                     style="">
                                                                    <p style="text-align: justify">{{ $team->role}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 mt-2">
                                                                <label style="font-weight: bold">Departamento
                                                                    de
                                                                    expedición:</label>
                                                                <div class="m-scrollable"
                                                                     data-scrollable="true"
                                                                     style="">
                                                                    <p>{{ $team->expeditionPlace->departaments->descripcion}}</p>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-4 mt-2">
                                                                <label style="font-weight: bold">Ciudad de
                                                                    expedición:</label>
                                                                <div class="m-scrollable"
                                                                     data-scrollable="true"
                                                                     style="">
                                                                    <p>{{ $team->expeditionPlace->descripcion}}</p>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-4 mt-2">
                                                                <label style="font-weight: bold">Documento
                                                                    de
                                                                    identificación:</label>
                                                                <br>
                                                                <button type="button"
                                                                        class="btn btn-primary"
                                                                        data-toggle="modal"
                                                                        data-target="#pdfidentificacion{{$loop->iteration}}">
                                                                    Ver documento de identidad
                                                                </button>
                                                                <div
                                                                    class="row drop_pdf_team{{ $loop->iteration }}"
                                                                    style="display: none">
                                                                    @if(\App\User::navigation() == "Gestor")
                                                                        <div
                                                                            class="m-form__group form-group">
                                                                            <div
                                                                                class="col-lg-12 m-form__group-sub">
                                                                                <label for="">Seleccione
                                                                                    el tipo de
                                                                                    formato para
                                                                                    subir el
                                                                                    documento de
                                                                                    identificación</label>
                                                                                <div
                                                                                    class="m-radio-inline">
                                                                                    <label
                                                                                        class="m-radio">
                                                                                        <input
                                                                                            type="radio"
                                                                                            onClick="changeOptionDocument(this, {{$loop->iteration}})"
                                                                                            name="team[identificacionDoc]{{ $loop->iteration }}"
                                                                                            value="1"
                                                                                            checked="checked">
                                                                                        Imagen
                                                                                        <span></span>
                                                                                    </label>
                                                                                    <label
                                                                                        class="m-radio">
                                                                                        <input
                                                                                            type="radio"
                                                                                            onClick="changeOptionDocument(this, {{$loop->iteration}})"
                                                                                            name="team[identificacionDoc]{{ $loop->iteration }}"
                                                                                            value="2">
                                                                                        PDF
                                                                                        <span></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>

                                                                            <div
                                                                                id="image-docuemnt-team{{ $loop->iteration }}"
                                                                                class="form-group m-form__group row">
                                                                                <div
                                                                                    class="col-lg-6 m-form__group-sub">
                                                                                    <label
                                                                                        for="">Imagen
                                                                                        documento
                                                                                        identificación
                                                                                        frente</label>
                                                                                    <div
                                                                                        class="m-dropzone file-image-document-team-frente{{ $loop->iteration }} m-dropzone--success"
                                                                                        action="inc/api/dropzone/upload.php"
                                                                                        id="m-dropzone-three">
                                                                                        <div
                                                                                            class="m-dropzone__msg dz-message needsclick">
                                                                                            <h3 class="m-dropzone__msg-title">
                                                                                                Subir foto
                                                                                                del
                                                                                                frente de su
                                                                                                documento de
                                                                                                identificación</h3>
                                                                                            <span
                                                                                                class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="col-lg-6 m-form__group-sub">
                                                                                    <label
                                                                                        for="">Imagen
                                                                                        documento
                                                                                        identificación
                                                                                        atras</label>
                                                                                    <div
                                                                                        class="m-dropzone file-image-document-team-atras{{ $loop->iteration }} m-dropzone--success"
                                                                                        action="inc/api/dropzone/upload.php"
                                                                                        id="m-dropzone-three">
                                                                                        <div
                                                                                            class="m-dropzone__msg dz-message needsclick">
                                                                                            <h3 class="m-dropzone__msg-title">
                                                                                                Subir foto
                                                                                                de la
                                                                                                parte de
                                                                                                atrás de su
                                                                                                documento de
                                                                                                identificación</h3>
                                                                                            <span
                                                                                                class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div
                                                                                id="pdf-docuemnt-team{{ $loop->iteration }}"
                                                                                style="display: none"
                                                                                class="form-group m-form__group row">
                                                                                <div
                                                                                    class="col">
                                                                                    <div
                                                                                        class="form-group m-form__group ">
                                                                                        <div
                                                                                            class="m-dropzone dropzone-team{{ $loop->iteration }} m-dropzone--success"
                                                                                            action="inc/api/dropzone/upload.php"
                                                                                            id="m-dropzone-three">
                                                                                            <div
                                                                                                class="m-dropzone__msg dz-message needsclick">
                                                                                                <h3 class="m-dropzone__msg-title">{{ __('Subir documento de identificación por ambos lados') }}</h3>
                                                                                                <span
                                                                                                    class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                </div>
                                                                <i class="flaticon-edit ml-3 update_pdf_team{{ $loop->iteration }}"
                                                                   style="color:#716aca; cursor:pointer;"></i>
                                                                <form
                                                                    id="form_update_img_team{{ $loop->iteration }}"
                                                                    method="post"
                                                                    action="{{ route('update.imgdoc.team') }}"
                                                                    enctype="multipart/form-data"
                                                                    class="m-form m-form--label-align-left- m-form--state-"
                                                                    id="actualizar_img_team">
                                                                    @csrf {{ method_field('PUT') }}
                                                                    <input type="hidden"
                                                                           name="team[urlImageDocumentFrente]{{ $loop->iteration }}"
                                                                           class="form-control m-input"
                                                                           value="">
                                                                    <input type="hidden"
                                                                           name="team[urlImageDocumentAtras]{{ $loop->iteration }}"
                                                                           class="form-control m-input"
                                                                           value="">
                                                                    <input type="hidden"
                                                                           name="team[id]"
                                                                           class="form-control m-input"
                                                                           value="{{$team->id}}">

                                                                </form>
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-primary cancel_pdf_team{{ $loop->iteration }}"
                                                                    style="display:none">
                                                                    Cancelar
                                                                </button>
                                                                <button
                                                                    id="btn_enviar_team{{ $loop->iteration }}"
                                                                    type="button"
                                                                    class="btn btn-primary  enviar_team{{ $loop->iteration }}"
                                                                    style="display:none">
                                                                    enviar
                                                                </button>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="pdfidentificacion{{$loop->iteration}}"
                                     tabindex="-1"
                                     role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                    Documento de {{ $team->name}}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @if($team->pdf_identificacion === "" || $team->pdf_identificacion === null)
                                                    @if(!$team->img_document_front && !$team->img_document_back)
                                                        <p>No se cargo el documento
                                                            correctamente</p>
                                                    @else
                                                        <div class="form-group">
                                                            <label for="">Parte frontal del
                                                                documento:</label>
                                                            <img style="width: 100%"
                                                                 src="{{ $team->img_document_front}}"
                                                                 alt="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Parte trasera del
                                                                documento:</label>
                                                            <img style="width: 100%"
                                                                 src="{{ $team->img_document_back}}"
                                                                 alt="">
                                                        </div>
                                                    @endif
                                                @else
                                                    @if(!$team->pdf_identificacion)
                                                        <p>No se cargo el documento
                                                            correctamente</p>
                                                    @else
                                                        <div>
                                                            <object
                                                                data="{{ $team->pdf_identificacion }}"
                                                                frameborder="0" width="100%"
                                                                height="400px"></object>
                                                        </div>
                                                    @endif
                                                @endif

                                            </div>
                                            <div class="modal-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


    @endif
    {{-- informacion de beneficiario --}}
    @if(count($artist->artists[0]->beneficiary) != 0)
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Información del beneficiario
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="m-portlet__body ml-5">
                        <div class="row">
                            <div class="biografia col-md-12">
                                <div class="row">
                                    @if ($artist->artists[0]->beneficiary[0]->picture)
                                        <div class="col-md-4 mb-5">
                                            <div class="m-scrollable" data-scrollable="true" style="">
                                                <img style="border-radius:8rem; width:7rem"
                                                     src="{{$artist->artists[0]->beneficiary[0]->picture}}">
                                            </div>

                                        </div>
                                    @else
                                        <div class="col-md-4 mb-5">
                                            <div class="m-scrollable" data-scrollable="true" style="">
                                                <img style="border-radius:8rem; width:7rem" src="/default/user.png">
                                            </div>

                                        </div>
                                    @endif
                                    <div class="col-md-4 mt-5">
                                        <label style="font-weight: bold">Nombre:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->artists[0]->beneficiary[0]->name}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <label style="font-weight: bold">Apellidos:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->artists[0]->beneficiary[0]->last_name}} {{ $artist->artists[0]->beneficiary[0]->second_last_name}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label style="font-weight: bold">Tipo identificación:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->artists[0]->beneficiary[0]->documentType->document}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label style="font-weight: bold">Nº identificación:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->artists[0]->beneficiary[0]->identification}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">

                                        <label style="font-weight: bold">{{ __('Departamento de expedición') }}
                                            :</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p style="text-align: justify">{{ $artist->artists[0]->beneficiary[0]->expeditionPlace->departaments->descripcion}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">

                                        <label style="font-weight: bold">{{ __('Ciudad de expedición') }}:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p style="text-align: justify">{{ $artist->artists[0]->beneficiary[0]->expeditionPlace->descripcion}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label style="font-weight: bold">Dirección de residencia:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->artists[0]->beneficiary[0]->adress}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label style="font-weight: bold">Departamento de residencia:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">

                                            @if($artist->artists[0]->beneficiary[0]->residencePlace)
                                                <p>{{ $artist->artists[0]->beneficiary[0]->residencePlace->departaments->descripcion}}</p>
                                            @else
                                                <p>No registrado</p>
                                            @endif

                                        </div>

                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label style="font-weight: bold">Ciudad de residencia:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            @if($artist->artists[0]->beneficiary[0]->residencePlace)
                                                <p>{{ $artist->artists[0]->beneficiary[0]->residencePlace->descripcion}}</p>
                                            @else
                                                <p>No registrado</p>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label style="font-weight: bold">Fecha de nacimiento:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{  Carbon\Carbon::parse($artist->artists[0]->beneficiary[0]->birthday)->formatLocalized('%d de %B de %Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label style="font-weight: bold">Departamento de nacimiento:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->artists[0]->beneficiary[0]->city->departaments->descripcion}}</p>
                                        </div>

                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label style="font-weight: bold">Ciudad de nacimiento:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->artists[0]->beneficiary[0]->city->descripcion}}</p>
                                        </div>

                                    </div>


                                    @if($artist->artists[0]->township)
                                        <div class="col-md-4 mt-2">
                                            <label style="font-weight: bold">Vereda/Corregimiento:</label>
                                            <div class="m-scrollable" data-scrollable="true" style="">
                                                <p>{{ $artist->artists[0]->beneficiary[0]->township}}</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-4 mt-2">
                                        <label style="font-weight: bold">Teléfono:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p>{{ $artist->artists[0]->beneficiary[0]->phone}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2 " style="margin-right: -1rem;">
                                        <label style="font-weight: bold">Documento de identificación:</label>
                                        <button type="button" class="btn btn-primary ver_pdf-ben"
                                                data-toggle="modal"
                                                data-target="#pdfidentificacionBeneficiario">
                                            Ver documento de identidad
                                        </button>

                                        @if(\App\User::navigation() == "Gestor")
                                            <div class="row drop_pdf_ben" style="display: none">

                                                <div class="m-form__group form-group">
                                                    <div class="col-lg-12 m-form__group-sub">
                                                        <label for="">Seleccione el tipo de formato para subir
                                                            el documento de identificación</label>
                                                        <div class="m-radio-inline">
                                                            <label class="m-radio">
                                                                <input type="radio"
                                                                       name="beneficiario[identificacionDoc]"
                                                                       value="1" checked="checked"> Imagen
                                                                <span></span>
                                                            </label>
                                                            <label class="m-radio">
                                                                <input type="radio"
                                                                       name="beneficiario[identificacionDoc]"
                                                                       value="2"> PDF
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div id="image-docuemnt-beneficiario"
                                                         class="form-group m-form__group row">
                                                        <div class="col-lg-6 m-form__group-sub">
                                                            <label for="">Imagen documento identificación
                                                                frente</label>
                                                            <div
                                                                class="m-dropzone file-image-document-beneficiario-frente m-dropzone--success"
                                                                action="inc/api/dropzone/upload.php"
                                                                id="m-dropzone-three">
                                                                <div
                                                                    class="m-dropzone__msg dz-message needsclick">
                                                                    <h3 class="m-dropzone__msg-title">Subir foto del
                                                                        frente de su documento de
                                                                        identificación</h3>
                                                                    <span
                                                                        class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 m-form__group-sub">
                                                            <label for="">Imagen documento identificación
                                                                atras</label>
                                                            <div
                                                                class="m-dropzone file-image-document-beneficiario-atras m-dropzone--success"
                                                                action="inc/api/dropzone/upload.php"
                                                                id="m-dropzone-three">
                                                                <div
                                                                    class="m-dropzone__msg dz-message needsclick">
                                                                    <h3 class="m-dropzone__msg-title">Subir foto de
                                                                        la parte de atrás de su documento de
                                                                        identificación</h3>
                                                                    <span
                                                                        class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="pdf-docuemnt-beneficiario" style="display: none"
                                                         class="form-group m-form__group row">
                                                        <div class="col">
                                                            <div class="form-group m-form__group ">
                                                                <div
                                                                    class="m-dropzone dropzone-ben m-dropzone--success"
                                                                    action="inc/api/dropzone/upload.php"
                                                                    id="m-dropzone-three">
                                                                    <div
                                                                        class="m-dropzone__msg dz-message needsclick">

                                                                        <h3 class="m-dropzone__msg-title">{{ __('Subir documento de identificación por ambos lados') }}</h3>
                                                                        <span
                                                                            class="m-dropzone__msg-desc">{{ __('arrastra_click_subir') }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            <i class="flaticon-edit ml-3 update_pdf_ben"
                                               style="color:#716aca; cursor:pointer;"></i>
                                            <button type="button" class="btn btn-primary cancel_pdf_ben"
                                                    style="display:none">Cancelar
                                            </button>
                                            <button id="btn_enviar_ben" type="button"
                                                    class="btn btn-primary  enviar_ben"
                                                    style="display:none">enviar
                                            </button>
                                            <form id="form_update_img_ben" method="post"
                                                  action="{{ route('update.imgdoc.ben.gestor') }}"
                                                  enctype="multipart/form-data"
                                                  class="m-form m-form--label-align-left- m-form--state-"
                                                  id="actualizar_img_asp">
                                                @csrf {{ method_field('PUT') }}
                                                <input type="hidden" name="beneficiario[urlImageDocumentFrente]"
                                                       class="form-control m-input" value="">
                                                <input type="hidden" name="beneficiario[urlImageDocumentAtras]"
                                                       class="form-control m-input" value="">
                                                <input type="hidden" name="beneficiario[idBeneficiario]"
                                                       class="form-control m-input"
                                                       value="{{$artist->artists[0]->beneficiary[0]->id}}">

                                            </form>
                                        @endif

                                    </div>

                                    <div class="col-md-12 pt-4">

                                        <label style="font-weight: bold">{{ __('biografia') }}:</label>
                                        <div class="m-scrollable" data-scrollable="true" style="">
                                            <p style="text-align: justify">{{ $artist->artists[0]->beneficiary[0]->biography}}</p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="pdfidentificacionBeneficiario" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Documento de {{ $artist->artists[0]->beneficiary[0]->name}}</h5>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if($artist->artists[0]->beneficiary[0]->pdf_documento === null)
                            @if(!$artist->artists[0]->beneficiary[0]->img_document_front && !$artist->artists[0]->beneficiary[0]->img_document_back)
                                <p>No se cargo el documento correctamente</p>
                            @else
                                <div class="form-group">
                                    <label for="">Parte frontal del documetno:</label>
                                    <img style="width: 100%"
                                         src="{{$artist->artists[0]->beneficiary[0]->img_document_front }}"
                                         alt="">
                                </div>
                                <div class="form-group">
                                    <label for="">Parte trasera del documento:</label>
                                    <img style="width: 100%"
                                         src="{{ $artist->artists[0]->beneficiary[0]->img_document_back }}"
                                         alt="">
                                </div>

                            @endif
                        @else
                            @if(!$artist->artists[0]->beneficiary[0]->pdf_documento)
                                <p>No se cargo el documento correctamente</p>
                            @else
                                <div>
                                    <object data="{{$artist->artists[0]->beneficiary[0]->pdf_documento}}"
                                            frameborder="0" width="100%" height="400px"></object>
                                </div>
                            @endif
                        @endif

                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
        @endif
        </div>
        <!--=====================================
            MODAL INFORMACION DEL ARTISTA
        ======================================-->

        <div class="modal fade" id="verpdfidentificacion" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Documento de {{ $artist->artists[0]->nickname }}</h5>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if(!$artist->artists[0]->users->pdf_cedula || $artist->artists[0]->users->pdf_cedula === null)
                            @if(!$artist->artists[0]->users->img_document_front && !$artist->artists[0]->users->img_document_back)
                                <p>No se cargo el documento
                                    correctamente</p>
                            @else
                                <div class="form-group">
                                    <label for="">Parte frontal del documento:</label>
                                    <img style="width: 100%"
                                         src="{{ $artist->artists[0]->users->img_document_front}}"
                                         alt="">
                                </div>
                                <div class="form-group">
                                    <label for="">Parte trasera del documento:</label>
                                    <img style="width: 100%"
                                         src="{{$artist->artists[0]->users->img_document_back}}"
                                         alt="">
                                </div>
                            @endif
                        @else
                            @if(!$artist->artists[0]->users->pdf_cedula)
                                <p>No se cargo el documento
                                    correctamente</p>
                            @else
                                <div>
                                    <object
                                        data="{{$artist->artists[0]->users->pdf_cedula}}"
                                        frameborder="0" width="100%"
                                        height="400px"></object>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>


@stop

@section('rating.projects')
    <style>
        .swal2-popup .swal2-file:focus,
        .swal2-popup .swal2-input:focus,
        .swal2-popup .swal2-textarea:focus {
            border-color: #716aca;
        }
    </style>

    <script>
        $(document).ready(function () {

            $('[data-toggle="tooltip"]').tooltip();
            $(function () {
                $('audio').audioPlayer();
            });

        });

        function mostrarComentario(texto) {
            swal({
                title: "{{__('mensaje')}}",
                text: texto,
                icon: "success",
            })
        }

        function getRating(rating, star) {
            if (rating == null) {
                return "";
            } else if (star <= rating) {
                return "yellow-rating"
            }
            return "";
        }

        $('#table_assign_management').DataTable({
            "processing": true,
            "serverSide": true,
            "data": null,
            "ajax": {
                url: "{{ route('assign.managements') }}",
                data: {
                    id_project: {{ $project->id }}
                }
            },
            "columns": [
                {
                    render: function (data, type, JsonResultRow, meta) {
                        return '<img src="' + JsonResultRow.users.picture + '" width="60px" style="border-radius: 100%;margin-right: auto;margin-left: auto;display: block"/>';
                    }
                },
                {
                    data: 'users.name',
                    render: function (data, type, JsonResultRow, meta) {
                        return JsonResultRow.users.name + ' ' + JsonResultRow.users.last_name + '' + JsonResultRow.users.second_last_name;
                    },
                    defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                },
                {
                    data: 'company',
                    defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                },
                {
                    data: 'users.email',
                    defaultContent: '<span class="label label-danger text-center" style="color:red !important">{{ __('nigun_valor_defecto') }}</span>'
                },
                {
                    render: function (data, type, JsonResultRow, meta) {
                        return `
                            <div class="form-group">
                                   <ul id="list_rating" class="list-inline" style="font-size: 20px">
                                        <li class="list-inline-item star"><i
                                                    class="fa fa-star fa-1x ${getRating(JsonResultRow.rating, 1)}"></i></li>
                                        <li class="list-inline-item star"><i
                                                   class="fa fa-star fa-1x ${getRating(JsonResultRow.rating, 2)}"></i></li>
                                        <li class="list-inline-item star"><i
                                                   class="fa fa-star fa-1x ${getRating(JsonResultRow.rating, 3)}"></i></li>
                                        <li class="list-inline-item star"><i
                                                    class="fa fa-star fa-1x ${getRating(JsonResultRow.rating, 4)}"></i></li>
                                        <li class="list-inline-item star"><i
                                                    class="fa fa-star fa-1x ${getRating(JsonResultRow.rating, 5)}"></i></li>
                                     </ul>
                            </div>
                        `;
                    }
                },
                {
                    render: function (data, type, JsonResultRow, meta) {
                        if (JsonResultRow.comment === null) {
                            return "{{ __('nigun_valor_defecto') }}";
                        }
                        return `<div class="text-center"><a onclick='mostrarComentario("${JsonResultRow.comment}")' class="btn m-btn--pill btn-secondary"><i class="fa fa-envelope"></i></a></div>`;
                    }
                },
                {
                    render: function (data, type, JsonResultRow, meta) {
                        return '<div class="text-center"><a href="/dashboard/profile-managament/' + JsonResultRow.users.slug + '" class="btn m-btn--pill btn-secondary"><i class="fa fa-eye"></i></a></div>'
                    }
                },
            ],
            "language": {
                "sProcessing": "{{__('procesando')}}",
                "sLengthMenu": "{{__('mostrar')}} _MENU_ {{__('registros')}}",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "{{__('nigun_dato_tabla')}}",
                "sInfo": "{{__('mostrando_registros') }} _START_ {{__('from')}} _END_ {{__('total_de')}} _TOTAL_ {{__('registros')}}",
                "sInfoEmpty": "{{ __('mostrando_registros_del_cero') }}",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "{{__('buscar')}}:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "{{__('cargando')}}",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "{{__('siguiente')}}",
                    "sPrevious": "{{__('anterior')}}"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });


        $('#table_teams').DataTable({
            "processing": true,
            "serverSide": true,
            "data": null,
            "ajax": "{{ route('team-artist',$project->id) }}",
            "columns": [
                {
                    data: 'name',
                    defaultContent: '<span class="label label-danger text-center">{{ __('nigun_valor_defecto') }}</span>'
                },
                {
                    data: 'role',
                    defaultContent: '<span class="label label-danger text-center">{{ __('nigun_valor_defecto') }}</span>'
                },
            ],
            "language": {
                "sProcessing": "{{__('procesando')}}",
                "sLengthMenu": "{{__('mostrar')}} _MENU_ {{__('registros')}}",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "{{__('nigun_dato_tabla')}}",
                "sInfo": "{{__('mostrando_registros') }} _START_ {{__('from')}} _END_ {{__('total_de')}} _TOTAL_ {{__('registros')}}",
                "sInfoEmpty": "{{ __('mostrando_registros_del_cero') }}",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "{{__('buscar')}}:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "{{__('cargando')}}",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "{{__('siguiente')}}",
                    "sPrevious": "{{__('anterior')}}"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    </script>
    <script>
        // contorles para la actualización del audio
        $('.update_audio').click(function () {

            $(this).hide();
            $('.cancel_audio').show();

            $('.drop_audio').show();
            $('.player').hide();


        });
        $('.cancel_audio').click(function () {
            $(this).hide();
            $('.update_audio').show();
            $('.drop_audio').hide();
            $('.player').show();


        });

        // controles actualizar documentos aspirante
        $("input[name='aspirante[identificacionDoc]']").click(() => {
            if ($('input:radio[name="aspirante[identificacionDoc]"]:checked').val() === '1') {
                $("#image-docuemnt-aspirante").show();
                $(".enviar_asp").show();
                $("#pdf-docuemnt-aspirante").hide();
            } else {
                $("#image-docuemnt-aspirante").hide();
                $(".enviar_asp").hide();
                $("#pdf-docuemnt-aspirante").show();
            }
        });
        $('.update_pdf_asp').click(function () {
            $(this).hide();
            $('.cancel_pdf_asp').show();
            $(".enviar_asp").show();
            $('.drop_pdf_asp').show();
            $('.ver_pdf_aspirante').hide();


        });
        $('.cancel_pdf_asp').click(function () {
            $(this).hide();
            $('.update_pdf_asp').show();
            $('.drop_pdf_asp').hide();
            $(".enviar_asp").hide();
            $('.ver_pdf_aspirante').show();


        });

        /* eventos para subir la imagen o pdf del aspirante */
        new Dropzone('.file-image-document-aspirante-frente', {
            url: '{{ route('upload.image.document') }}',
            acceptedFiles: "image/*",
            maxFiles: 1,
            paramName: 'file',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            processing: function (file, response) {
                $('body').loading({
                    message: 'Subiendo documento...',
                    start: true,
                });
            },
            success: function (file, response) {
                $("input[name='aspirante[urlImageDocumentFrente]']").val(response);
                $('body').loading({

                    start: false,
                });
            },
            error: function (file, response) {
                $('body').loading({
                    start: false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }
        });
        new Dropzone('.file-image-document-aspirante-atras', {
            url: '{{ route('upload.image.document') }}',
            acceptedFiles: "image/*",
            maxFiles: 1,
            paramName: 'file',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            processing: function (file, response) {
                $('body').loading({
                    message: 'Subiendo documento...',
                    start: true,
                });
            },
            success: function (file, response) {
                $("input[name='aspirante[urlImageDocumentAtras]']").val(response);
                $('body').loading({

                    start: false,
                });
            },
            error: function (file, response) {
                $('body').loading({
                    start: false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }
        });

        var id =@json($artist->artists[0]);
        var idAspirante = -1;
        if (id.length != 0) {

            idAspirante = id.user_id;
        }

        new Dropzone('.dropzone', {
            url: '{{ route('cedula.pdf.aspirante.gestor') }}',
            acceptedFiles: '.pdf',
            maxFiles: 1,
            paramName: 'pdf_cedula_name',
            headers: {
                'idAspirante': idAspirante,
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            addedfile: function (file, response) {
                $('body').loading({
                    message: 'Subiendo documento...',
                    start: true,
                });
            },
            success: function (file, response) {

                $('#inputImagenesPostPlan').val(response);
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.success("El documento se actualizo correctamente", "Información");
                setTimeout(function () {
                    location.reload();
                }, 3000);
            },
            error: function (file, response) {
                $('body').loading({
                    start: false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }

        });
        // evento ddel boton enviar imagenes aspirante
        $('#btn_enviar_asp').click(function (e) {
            e.preventDefault();

            if ($("input[name='aspirante[urlImageDocumentAtras]']").val() != "" && $("input[name='aspirante[urlImageDocumentFrente]']").val() != "") {
                $('#form_update_img').submit();
                swal({
                    "title": "",
                    "text": 'Cargado correctamente',
                    "type": "success",
                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                }).then((result) => {
                    if (result.value) {

                        // document.location.reload();
                    }
                });
            } else {
                swal({
                    "title": "",
                    "text": 'Debe cargar las dos imagenes del documento',
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                }).then((result) => {
                    // document.location.reload();
                });
            }


        });

    </script>

    <script>
        // controles de actualizar documentos del beneficiario
        $("input[name='beneficiario[identificacionDoc]']").click(() => {
            if ($('input:radio[name="beneficiario[identificacionDoc]"]:checked').val() === '1') {
                $("#image-docuemnt-beneficiario").show();
                $(".enviar_ben").show();
                $("#pdf-docuemnt-beneficiario").hide();
            } else {
                $("#image-docuemnt-beneficiario").hide();
                $(".enviar_ben").hide();
                $("#pdf-docuemnt-beneficiario").show();
            }
        });
        $('.update_pdf_ben').click(function () {
            $(this).hide();
            $('.cancel_pdf_ben').show();
            $(".enviar_ben").show();
            $('.drop_pdf_ben').show();
            $('.ver_pdf-ben').hide();


        });
        $('.cancel_pdf_ben').click(function () {
            $(this).hide();
            $('.update_pdf_ben').show();
            $('.drop_pdf_ben').hide();
            $('.ver_pdf-ben').show();
            $(".enviar_ben").hide();


        });

        // actualizar pdf beneficiario
        new Dropzone('.dropzone-ben', {
            url: '{{ route('cedula.pdf.beneficiario.gestor') }}',
            acceptedFiles: '.pdf',
            maxFiles: 1,
            paramName: 'pdf_cedula_name',
            headers: {
                'idAspirante': idAspirante,
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            addedfile: function (file, response) {
                $('body').loading({
                    message: 'Subiendo documento...',
                    start: true,
                });
            },
            success: function (file, response) {

                $('#inputImagenesPostPlan').val(response);
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.success("El documento se actualizo correctamente", "Información");
                setTimeout(function () {
                    location.reload();
                }, 3000);

            },
            error: function (file, response) {
                $('body').loading({
                    start: false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }

        });

        /* eventos para subir la imagen o pdf del beneficiario */
        new Dropzone('.file-image-document-beneficiario-frente', {
            url: '{{ route('upload.image.document') }}',
            acceptedFiles: "image/*",
            maxFiles: 1,
            paramName: 'file',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            processing: function (file, response) {
                $('body').loading({
                    message: 'Subiendo documento...',
                    start: true,
                });
            },
            success: function (file, response) {
                $("input[name='beneficiario[urlImageDocumentFrente]']").val(response);
                $('body').loading({

                    start: false,
                });
            },
            error: function (file, response) {
                $('body').loading({
                    start: false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }
        });
        new Dropzone('.file-image-document-beneficiario-atras', {
            url: '{{ route('upload.image.document') }}',
            acceptedFiles: "image/*",
            maxFiles: 1,
            paramName: 'file',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            processing: function (file, response) {
                $('body').loading({
                    message: 'Subiendo documento...',
                    start: true,
                });
            },
            success: function (file, response) {
                $("input[name='beneficiario[urlImageDocumentAtras]']").val(response);
                $('body').loading({

                    start: false,
                });
            },
            error: function (file, response) {
                $('body').loading({
                    start: false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }
        });
        // evento del boton enviar imagenes beneficiario
        $('#btn_enviar_ben').click(function (e) {
            e.preventDefault();

            if ($("input[name='beneficiario[urlImageDocumentAtras]']").val() != "" && $("input[name='beneficiario[urlImageDocumentFrente]']").val() != "") {
                $('#form_update_img_ben').submit();
                swal({
                    "title": "",
                    "text": 'Cargado correctamente',
                    "type": "success",
                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                }).then((result) => {
                    if (result.value) {

                        document.location.reload();
                    }
                });
            } else {
                swal({
                    "title": "",
                    "text": 'Debe cargar las dos imagenes del documento',
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                }).then((result) => {
                    // document.location.reload();
                });
            }


        });
    </script>

    <script>
        // controles para editar documentos de los grupos
        function changeOptionDocument(element, member) {
            // console.log($(element).val(),'element');
            // console.log(member,'menber');
            if ($(element).val() === '1') {
                $(`#image-docuemnt-team${member}`).show();
                $(`.enviar_team${member}`).show();
                $(`#pdf-docuemnt-team${member}`).hide();
            } else {
                $(`#image-docuemnt-team${member}`).hide();
                $(`#pdf-docuemnt-team${member}`).show();
                $(`.enviar_team${member}`).hide();
            }
        }

        $.each( @json($artist->artists[0]->teams), function (key, value) {

            $('.update_pdf_team' + (key + 1)).click(function () {
                $(this).hide();
                $('.cancel_pdf_team' + (key + 1)).show();
                $(".enviar_team" + (key + 1)).show();

                $('.drop_pdf_team' + (key + 1)).show();
                $('.pdfidentificacion' + (key + 1)).hide();


            });
            $('.cancel_pdf_team' + (key + 1)).click(function () {
                $(this).hide();
                $('.update_pdf_team' + (key + 1)).show();
                $('.drop_pdf_team' + (key + 1)).hide();
                $('.pdfidentificacion' + (key + 1)).show();
                $(".enviar_team" + (key + 1)).hide();


            });

        });

        // dropzone para actulizar pdf de un intrgrante del grupo
        $.each( @json($artist->artists[0]->teams), function (key, value) {
            // actualizar pdf team
            new Dropzone('.dropzone-team' + (key + 1), {
                url: '{{ route('cedula.pdf.team') }}',
                acceptedFiles: '.pdf',
                maxFiles: 1,
                paramName: 'pdf_cedula_name',
                headers: {
                    'id': value.id,
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                addedfile: function (file, response) {
                    $('body').loading({
                        message: 'Subiendo documento...',
                        start: true,
                    });
                },
                success: function (file, response) {

                    $('#inputImagenesPostPlan').val(response);
                    // location.reload();
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "3000",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.success("El documento se actualizo correctamente", "Información");
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                },
                error: function (file, response) {
                    $('body').loading({
                        start: false,
                    });
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "3000",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
                }

            });

            /* eventos para subir la imagen del team */
            new Dropzone('.file-image-document-team-frente' + (key + 1), {
                url: '{{ route('upload.image.document') }}',
                acceptedFiles: "image/*",
                maxFiles: 1,
                paramName: 'file',
                headers: {

                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                processing: function (file, response) {
                    $('body').loading({
                        message: 'Subiendo documento...',
                        start: true,
                    });
                },
                success: function (file, response) {
                    $("input[name='team[urlImageDocumentFrente]" + (key + 1) + "']").val(response);
                    $('body').loading({

                        start: false,
                    });
                },
                error: function (file, response) {
                    $('body').loading({
                        start: false,
                    });
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "3000",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
                }
            });

            new Dropzone('.file-image-document-team-atras' + (key + 1), {
                url: '{{ route('upload.image.document') }}',
                acceptedFiles: "image/*",
                maxFiles: 1,
                paramName: 'file',
                headers: {

                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                processing: function (file, response) {
                    $('body').loading({
                        message: 'Subiendo documento...',
                        start: true,
                    });
                },
                success: function (file, response) {
                    $("input[name='team[urlImageDocumentAtras]" + (key + 1) + "']").val(response);
                    $('body').loading({

                        start: false,
                    });
                },
                error: function (file, response) {
                    $('body').loading({
                        start: false,
                    });
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "3000",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
                }
            });
        });


        // evento ddel boton enviar imagenes team

        $.each( @json($artist->artists[0]->teams), function (key, value) {
            $('#btn_enviar_team' + (key + 1)).click(function (e) {
                e.preventDefault();


                if ($("input[name='team[urlImageDocumentAtras]" + (key + 1) + "']").val() != "" && $("input[name='team[urlImageDocumentFrente]" + (key + 1) + "']").val() != "") {
                    $('#form_update_img_team' + (key + 1)).submit();
                    swal({
                        "title": "",
                        "text": 'Cargado correctamente',
                        "type": "success",
                        "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                    }).then((result) => {
                        if (result.value) {

                            //    document.location.reload();
                        }
                    });
                } else {
                    swal({
                        "title": "",
                        "text": 'Debe cargar las dos imagenes del documento',
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                    }).then((result) => {
                        // document.location.reload();
                    });
                }


            });
        });

        // controles actualizar soporte
        $('.update_pdf_soporte').click(function () {
            $(this).hide();
            $('.cancel_pdf_soporte').show();

            $('.drop_soporte').show();
            $('.btn_pdf_soporte').hide();


        });
        $('.cancel_pdf_soporte').click(function () {
            $(this).hide();
            $('.update_pdf_soporte').show();
            $('.drop_soporte').hide();
            $('.btn_pdf_soporte').show();


        });

        new Dropzone('.dropzone-soporte', {
            url: '{{ route('soporte.aspirante.gestor') }}',
            acceptedFiles: '.pdf',
            maxFiles: 1,
            paramName: 'doc',
            headers: {
                'idAspirante': idAspirante,
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            addedfile: function (file, response) {
                $('body').loading({
                    message: 'Subiendo documento...',
                    start: true,
                });
            },
            success: function (file, response) {

                $('#inputImagenesPostPlan').val(response);
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.success("El documento se actualizo correctamente", "Información");
                setTimeout(function () {
                    location.reload();
                }, 3000);

            },
            error: function (file, response) {
                $('body').loading({
                    start: false,
                });
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.warning("El documento no se cargó correctamente, inténtalo más tarde", "Información");
            }

        });


    </script>



@endsection
@section('js.add-project')

    <script>
        var dropzone = new Dropzone('.dropzone-audio', {
            url: '{{route('update.audio')}}',
            acceptedFiles: '.mp3',
            addRemoveLinks: true,
            maxFiles: 1,
            paramName: 'audio',
            headers: {
                'idproject':@json($project->id),
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            addedfile: function (file, response) {
                $('body').loading({
                    message: 'Subiendo canción...',
                    start: true,
                });
                // this.success();
            },
            success: function (file, response) {

                $("#erroresImagen").text('');
                $('#inputDBAudioAddProject').val(response);
                $('#img_add_proyect').attr('src', response);
                $('.update_audio').show();
                $('.drop_audio').hide();
                $('.player').show();
                $('.cancel_audio').hide();

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.success("El audio se actualizo correctamente", "Información");
                window.location.reload();
            },
            error: function (file, e, i, o, u) {

                if (file.accepted == false) {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "3000",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.warning("Formato de audio incorrecto, solo se acepta formato mp3", "Información");
                    // alert('asi no pri')
                } else {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "3000",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.warning("El audio no se cargó correctamente, inténtalo más tarde", "Información");
                }


                $('body').loading({
                    start: false,
                });


                $("#erroresImagen").text('');
                if (file.xhr.status === 413) {
                    $("#erroresImagen").text('{{__("imagen_grande")}}');
                    $(file.previewElement).addClass("dz-error").find('.dz-error-message').text('{{__("imagen_grande")}}');
                    setTimeout(() => {
                        dropzone.removeFile(file)
                    }, 1000)
                }
            }
        });
        // dropzone.on("addedfile", function (file) {
        //     file.previewElement.addEventListener("click", function () {
        //         dropzone.removeFile(file);
        //     });
        // });
        Dropzone.autoDiscover = false;


    </script>

@endsection
