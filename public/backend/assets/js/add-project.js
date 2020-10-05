//== Class definition
var Wizard = function() {
    //== Base elements
    var wizardEl = $('#wizard_project_add');
    var formEl = $('#form_add_project');
    var validator;
    var wizard;

    //== Private functions
    var initWizard = function() {
        //== Initialize form wizard
        wizard = new mWizard('wizard_project_add', {
            startStep: 1
        });

        //== Validation before going to next page
        wizard.on('beforeNext', function(wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop(); // don't go to the next step
            }
        })

        //== Change event
        wizard.on('change', function(wizard) {
            mUtil.scrollTop();
        });

        //== Change event
        wizard.on('change', function(wizard) {
            if (wizard.getStep() === 1) {

            }
        });
    };

    var initValidation = function() {
        validator = formEl.validate({
            //== Validate only visible fields
            ignore: ":hidden",

            //== Validation rules
            rules: {
                //===(step 1)
                txtFrame: {
                    required: true
                },
                //===(step 2)
                nombreProyecto: {
                    required: true
                },
                descripcionProyecto: {
                    required: true
                },
                category_id: {
                    required: true,
                },
                costo_proyecto: {
                    required: true
                },
                //===(step 3)
                txtCardName: {
                    required: true
                },
                txtCardNumber: {
                    required: true
                },

                //===(step 4)
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    phoneUS: true
                },

                //== Mailing address
                address1: {
                    required: true
                },
                city: {
                    required: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                },
                country: {
                    required: true
                },

                //=== Client Information(step 2)
                //== Account Details
                account_url: {
                    required: true,
                    url: true
                },
                account_username: {
                    required: true,
                    minlength: 4
                },
                account_password: {
                    required: true,
                    minlength: 6
                },

                //== Client Settings
                account_group: {
                    required: true
                },
                'account_communication[]': {
                    required: true
                },

                //=== Client Information(step 3)
                //== Billing Information
                billing_card_name: {
                    required: true
                },
                billing_card_number: {
                    required: true,
                    creditcard: true
                },
                billing_card_exp_month: {
                    required: true
                },
                billing_card_exp_year: {
                    required: true
                },
                billing_card_cvv: {
                    required: true,
                    minlength: 2,
                    maxlength: 3
                },

                //== Billing Address
                billing_address_1: {
                    required: true
                },
                billing_address_2: {

                },
                billing_city: {
                    required: true
                },
                billing_state: {
                    required: true
                },
                billing_zip: {
                    required: true,
                    number: true
                },
                billing_delivery: {
                    required: true
                },

                //=== Confirmation(step 4)
                accept: {
                    required: true
                }
            },

            //== Validation messages
            messages: {
                'account_communication[]': {
                    required: 'You must select at least one communication option'
                },
                accept: {
                    required: "You must accept the Terms and Conditions agreement!"
                }
            },

            //== Display error
            invalidHandler: function(event, validator) {
                mUtil.scrollTop();

                swal({
                    "title": "",
                    "text": txtInvalidAlert,
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                });
            },


        });
    };

    var initSubmit = function() {
        var btn = formEl.find('[data-wizard-action="submit"]');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        btn.on('click', function(e) {
            e.preventDefault();
            if (validator.form()) {

                $('#form_add_project').submit();
            }

        });
    };

    return {
        // public functions
        init: function() {
            wizardEl = $('#wizard_project_add');
            formEl = $('#form_add_project');

            initWizard();
            initValidation();
            initSubmit();
        }
    };
}();

/*=============================================
CAMBIAR EL VALOR INGRESADO POR EL VALOR A GUARDAR EN LA DB
=============================================*/

jQuery(document).ready(function() {
    Wizard.init();
});

$(document).ready(function() {
    $('.valor_add_proyecto').number(true, 2);
    $('.costo_proyecto_confirmacion').number(true, 2);
});
$(".valor_add_proyecto").keyup(function() {

    valorIngresado = $(this).val();
    var total = valorIngresado;
    $('.valorDBProject').val(total);

});

/*=============================================
AYUDA VIDEO YOUTUBE
=============================================*/

$(function() {
    $('#btn_help_youtube').click(function(e) {
        e.preventDefault();
        $('video_help_add_project_youtube').stop();
        $('video_help_add_project_youtube').play()
    });
});

/*=============================================
AGREGAR VIDEO AL CONFIRMACION
=============================================*/

$(".title_add_proyecto").keyup(function() {

    valorIngresado = $(this).val();
    $('.nombre_project_confirmacion').text(valorIngresado);

});

$(".corta_descr_add_proyecto").keyup(function() {

    valorIngresado = $(this).val();
    $('.descripcion_corta_confirmacion').text(valorIngresado);

});

$("#genero_add_proyecto").change(function() {
    var texto = $(this).find('option:selected').text(); // Capturamos el texto del option seleccionado

    $(".genero_musical_confirmacion").text(texto);
});

$(".valor_add_proyecto").keyup(function() {

    valorIngresado = $(this).val();
    $('.costo_proyecto_confirmacion').val(valorIngresado);

});

function getIdYoutube(url) {
    let paramsString = url.replace(/.+\?{1}/g, '');
    let params = paramsString.split("&");
    let idYoutube = "";
    params.forEach(function(param) {
        if (param[0] === "v" && param[1] === "=") {
            idYoutube = param.substr(2);
        }
    });
    return idYoutube;
}

$("#txtFrame").change(function() {
    let id = getIdYoutube($(this).val());
    $("#txtIdVideo").val(id);
    let video = $("#videoYoutube");
    let url = video.attr("data-url");
    video.attr("src", url + id);
});

$("#category_add_proyecto").change(function() {

    if ($(this).val() === "1") {
        $(".cont_solista").show();
    } else {
        $(".cont_solista").hide();
    }

});

$("#select_solista").change(function() {

    if ($(this).val() === "2") {
        $(".registro").show();
    } else {
        $(".registro").hide();
    }

});

$("#category_add_proyecto").change(event => {
    // alert("------");
    $.get(`/dashboard/categories_by_id/${event.target.value}`, function(response, category) {
        // console.log(response);
        $("#genero_add_proyecto").empty();
        response.forEach(cat => {
            //  console.log(cat);
            //  console.log(cat.category);
            $("#genero_add_proyecto").append(`<option value="${cat.id}">${cat.category}</option>`);
            // console.log('selector',$("#genero_add_proyecto").append(`<option value=${cat.id}>${cat.category}</option>`));
        });

    });
});

// $("#category_add_proyecto").change(function (event) {

//     $.get("/dashboard/categories_by_id/" + event.target.value + "", function (res, cat) {
//         $("#genero_add_proyecto").empty();
//         for (i = 0; i < Response.length; i++) {
//             $("#genero_add_proyecto").append("<option value='" + res[i].id + "'>" + res[i].category + "</option>");

//         }
//     });

// });



// agregar otro input
var cont = 0;

$("#masInte").click(function(e) {
    e.preventDefault();
    cont += 1;

    var agregar = `<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label class="form-control-label" form="nombreIntegrante">* ${nombre}:</label>
        <input type="text" name="nombres[]" class="form-control m-input title_add_proyecto required" id="nombreIntegrante" placeholder=""
            value="">
        <span class="m-form__help">${help}</span>
    </div>
</div>

<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label class="form-control-label" form="rolIntegrante">* ${rol}:</label>
        <input type="text" name="rol[]" class="form-control m-input title_add_proyecto required" id="rolIntegrante" placeholder=""
            value="">
        <span class="m-form__help">${helpRol}</span>
    </div>
</div>
</div>`;


    if (cont <= 4) {

        $("#integrantes").append(agregar);

    } else {
        alert("maximo 5 registros");
    }


    console.log(cont);
});