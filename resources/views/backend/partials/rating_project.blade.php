<!-- Acciones para el Admin -->
<div class="form-group">
    <h5 style="font-weight: bold">{{ __('asignar_proyecto') }}:</h5>
</div>
<div class="form-group">
    <a href="#" class="btn btn-info m-btn m-btn--icon">
        <span>
            <i class="la la-user"></i>
            <span>{{ __('buscar') }}</span>
        </span>
    </a>
</div>

<!-- Acciones para el Managment -->
<div class="form-group">
    <h5 style="font-weight: bold">{{ __('calificar_proyecto') }}:</h5>
</div>
<form method="POST" action="" class="form-inline" id="rating_form">
    @csrf
    <div class="form-group">
        <ul id="list_rating" class="list-inline" style="font-size: 20px">
            <li class="list-inline-item star" data-number="1"><i
                        class="fa fa-star fa-1x yellow-rating"></i></li>
            <li class="list-inline-item star" data-number="2"><i
                        class="fa fa-star fa-1x"></i></li>
            <li class="list-inline-item star" data-number="3"><i
                        class="fa fa-star fa-1x"></i></li>
            <li class="list-inline-item star" data-number="4"><i
                        class="fa fa-star fa-1x"></i></li>
            <li class="list-inline-item star" data-number="5"><i
                        class="fa fa-star fa-1x"></i></li>
        </ul>
    </div>

    <input type="hidden" name="rating_input" value="1">
    <input type="hidden" name="course_id" value="{{ $project->id }}">

    <button type="submit" class="btn btn-warning m-btn m-btn--icon">
                                            <span>
                                                <i class="la la-check"></i>
                                                    <span>{{ __('calificar') }}</span>
                                            </span>
    </button>
</form>
