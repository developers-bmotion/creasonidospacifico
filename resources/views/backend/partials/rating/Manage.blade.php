@push('css')
    <style>
    .fa-star{
        cursor: pointer;
    }
    </style>
@endpush
@php
if ($review == null){
    $review = new \stdClass();
    $review->rating = null;
}
@endphp
<!-- Acciones para el Managment -->
@if($project->status == 2)
<div class="form-group">
    <h5 style="font-weight: bold">{{ $review->rating==null?__('calificar_proyecto'):__("recalificar_proyecto") }}:</h5>
</div>
<form method="POST" action="{{ route('update.review.management') }}" class="" id="rating_form">
    @csrf
    <div class="form-group">
        <ul id="list_rating" class="list-inline" style="font-size: 20px">
            <li class="list-inline-item star" data-number="1"><i
                        class="fa fa-star fa-1x {{ $review->rating >=1?"yellow-rating":""}}"></i></li>
            <li class="list-inline-item star" data-number="2"><i
                        class="fa fa-star fa-1x {{ $review->rating >=2?"yellow-rating":""}}"></i></li>
            <li class="list-inline-item star" data-number="3"><i
                        class="fa fa-star fa-1x {{ $review->rating >=3?"yellow-rating":""}}"></i></li>
            <li class="list-inline-item star" data-number="4"><i
                        class="fa fa-star fa-1x {{ $review->rating >=4?"yellow-rating":""}}"></i></li>
            <li class="list-inline-item star" data-number="5"><i
                        class="fa fa-star fa-1x {{ $review->rating ==5?"yellow-rating":""}}"></i></li>
        </ul>
    </div>
    <input type="hidden" name="rating_input" value="1">
    <input type="hidden" name="comment" id="txtComentManager">
    <input type="hidden" name="project_id" value="{{ $project->id }}">
    <button type="submit" class="btn btn-warning m-btn m-btn--icon" id="btnEnviarReview">
            <span>
                <i class="la la-check"></i>
                <span>{{ __('calificar') }}</span>
            </span>
    </button>
</form>
<br>
<div class="form-group">
    @if(!$end_time == null)
    <span class="">{{ __('tiempo_calificacion') }}</span>
    <span>{{ $end_time->end_time->toFormattedDateString()}}</span>
    @endif
</div>
@endif

@push('js')
    <script>
    jQuery(document).ready(function () {
        const ratingSelector = jQuery('#list_rating');
        let currentRating = {{ $review->rating?$review->rating:"null" }};
        let rating = {{ $review->rating?$review->rating:"null" }};

        ratingSelector.find('li').on('click', function () {
            const number = $(this).data('number');
            rating = number;
            $('#rating_form').find('input[name=rating_input]').val(number);
            ratingSelector.find('li i').removeClass('yellow-rating').each(function (index) {
                if ((index + 1) <= number) {
                    $(this).addClass('yellow-rating');
                }
            })
        });

        $("#btnEnviarReview").click(function (e) {
            e.preventDefault();
            if (rating !== null && currentRating == rating){
                swal("{{ __('managerTitleRate') }}", "{{ __('managerMsgRate') }}", "success");
                return;
            }
            if (rating===null){
                swal({
                    "title": "{{ __('seleccionarClasificacionTitle') }}",
                    "text": "{{ __('seleccionarClasificacionText') }}",
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                });
                return;
            }
            let textarea = null;
            swal({
                title: '{{ __('comment_review_manager') }}',
                input: 'textarea',
                inputPlaceholder: '{{ __('tu_mensaje') }}',
                inputClass: "form-control m-input",
                confirmButtonText: '{{ __('calificar') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonClass: 'btn btn-warning'
            }).then(function (result) {
                if (result.value === "" || result.value) {
                    $("#txtComentManager").val(result.value);
                    let form = $("#rating_form");
                    let url = form.attr("action");
                    let data = form.serialize();
                    $.post(url, data, function (e) {
                        if (e) {
                            swal("{{ __('managerTitleRate') }}", "{{ __('managerMsgRate') }}", "success")
                            .then(function () {
                                window.location.reload();
                            });
                        }
                    });
                }
            });
            textarea = $("textarea.form-control.m-input");
            textarea.removeClass("swal2-textare").attr("rows", '5');
        });
    });
    </script>
@endpush
