/*=============================================
WIZARD PASO A PASO PARA EL REGISTRO
=============================================*/

/* Variables para el proceso de registro */
var menordedad;
var primeravez = true;

/* titulos del wixard */
$("#title-wizard-menor-edad").hide();
$("#title-wizard-grupo-constituido").hide();
/* $(".content-wizard-menor-edad").hide();
$(".content-wizard-grupo-constituido").hide(); */

/* oculatar elementos */  
$("#content-actuara-como").hide();

/* Evento para selecionar la linea de convocatoria */
$("#select-linea-convocatoria").on( 'change', function() {
    hideTitlewizard();
    switch ($(this).val()) {
        case '-1': $("#content-actuara-como").hide();
            break;
        case '1': $("#content-actuara-como").show();
                $("#select-actuara-como option[value='1']").show();
                $("#select-actuara-como option[value='3']").hide();
            break;
        case '2': $("#content-actuara-como").show();
                $("#select-actuara-como option[value='1']").hide();
                $("#select-actuara-como option[value='3']").show();
            break;
    }
    
    $("#select-actuara-como").val("-1");
});

function hideTitlewizard() {
    $("#title-wizard-menor-edad").hide();
    $("#title-wizard-grupo-constituido").hide();
}

/* Evento para seleccionar como actuara el artista */ 
$("#select-actuara-como").on( 'change', function() {
    switch ($(this).val()) {
        case '-1': $("#title-step-two").html('Datos Personales');
                hideTitlewizard();
            break;
        case '1': $("#title-step-two").html('Datos Personales');
                hideTitlewizard();   
            break;
        case '2': 
                if ($("#select-linea-convocatoria").val() === '1') {
                    $("#title-step-two").html('Datos del Representante del Menor');
                    $("#title-wizard-menor-edad").show();
                    $("#title-wizard-grupo-constituido").hide();
                } 
                if ($("#select-linea-convocatoria").val() === '2') {
                    $("#title-step-two").html('Datos del Representante del Menor y el grupo');
                    $("#title-wizard-menor-edad").hide();
                    $("#title-wizard-grupo-constituido").show();
                }     
            break;
        case '3': $("#title-step-two").html('Datos del Representante del Grupo');
                $("#title-wizard-menor-edad").hide();
                $("#title-wizard-grupo-constituido").show();
            break;
    }
});

var Wizard = function() {
    //== Base elements
    var wizardEl = $('#m_wizard_new_register');
    var formEl = $('#m_form_new_register');
    var validator;
    var wizard;

    //== Private functions
    var initWizard = function() {
        //== Initialize form wizard
        wizard = new mWizard('m_wizard_new_register', {
            startStep: 1
        });

        //== Validation before going to next page
        wizard.on('beforeNext', function(wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop(); // don't go to the next step
            }
        })

        //== Change event  wizard.getStep()
        wizard.on('change', function(wizard) {
            console.log('step:::. ', wizard.getStep())
            mUtil.scrollTop();
            /* if (menordedad === 1 && primeravez) {
                wizard.goTo(4);
                primeravez = false;
                return;
            }
            if (wizard.getStep() === 3 && menordedad === 1 && !primeravez) {
                wizard.goTo(1);
                primeravez = true
                return;
            } */
        });

        //== Change event
        wizard.on('change', function(wizard) {

        });
    }

    var initValidation = function() {
        validator = formEl.validate({
            //== Validate only visible fields
            ignore: ":hidden",

            //== Validation rules
            rules: {
                //=== Client Information(step 1)
                //== Client details
                name: {
                    required: true
                },
                lastname: {
                    required: true,
                },
                second_last_name: {
                    required: true,
                },
                phone_1: {
                    required: true,

                },

                //== Mailing address
                document_type: {
                    required: true
                },
                identificacion: {
                    required: true
                },
                expedition_place: {
                    required: true
                },
                nacimiento_municipios: {
                    required: true
                },
                adress: {
                    required: true
                },

                //=== Client Information(step 2)
                //== Account Details
                cities_id: {
                    required: true,

                },
                person_types_id: {
                    required: true,
                },
                artist_type_id: {
                    required: true,
                },

                //== Client Settings
                level_id: {
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
                    required: "¡Debe aceptar el acuerdo de Términos y Condiciones!"
                }
            },

            //== Display error
            invalidHandler: function(event, validator) {
                mUtil.scrollTop();

                swal({
                    "title": "",
                    "text": "Hay algunos errores. Por favor corríjalos.",
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                });
            },

        });
    }

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
                //== See: src\js\framework\base\app.js
                mApp.progress(btn);
                //mApp.block(formEl);

                //== See: http://malsup.com/jquery/form/#ajaxSubmit
                formEl.ajaxSubmit({
                    success: function() {
                        mApp.unprogress(btn);
                        //mApp.unblock(formEl);

                        swal({
                            "title": "",
                            "text": "¡Tu registro se realizo con exito!",
                            "type": "success",
                            "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                        });
                    }
                });
            }
        });
    }

    return {
        // public functions
        init: function() {
            wizardEl = $('#m_wizard_new_register');
            formEl = $('#m_form_new_register');

            initWizard();
            initValidation();
            initSubmit();
        }
    };
}();

jQuery(document).ready(function() {
    Wizard.init();
});

/*=============================================
PASAMOS LOS DATOS QUE SE REGISTRAN PARA CONFIRMACIÓN
=============================================*/
$(function() {

    $('.confirmTxtNameAspirante').html($(".inputNameRegisterAspirante").val());
    $('.confirmTxtLastNameAspirante').html($(".inputLastNameRegisterAspirante").val());
    $('.confirmTxtSecondLastNameAspirante').html($(".inputSecondLastNameRegisterAspirante").val());
    $('.confirmTxtPhone1Aspirante').html($(".inputPhone1RegisterAspirante").val());
    $('.confirmTxtNoDocumentAspirante').html($(".inputNoDocumentRegisterAspirante").val());
    $('.confirmTxtDireccionAspirante').html($(".inputDireccionRegisterAspirante").val());


    $(".inputNameRegisterAspirante").keyup(function() {
        valorIngresado = $(this).val();
        $('.confirmTxtNameAspirante').html(valorIngresado);
        console.log(valorIngresado);
    });

    $(".inputLastNameRegisterAspirante").keyup(function() {
        valorIngresado = $(this).val();
        $('.confirmTxtLastNameAspirante').html(valorIngresado);
        console.log(valorIngresado);
    });

    $(".inputSecondLastNameRegisterAspirante").keyup(function() {
        valorIngresado = $(this).val();
        $('.confirmTxtSecondLastNameAspirante').html(valorIngresado);
        console.log(valorIngresado);
    });

    $(".inputPhone1RegisterAspirante").keyup(function() {
        valorIngresado = $(this).val();
        $('.confirmTxtPhone1Aspirante').html(valorIngresado);
        console.log(valorIngresado);
    });

    $(".inputNoDocumentRegisterAspirante").keyup(function() {
        valorIngresado = $(this).val();
        $('.confirmTxtNoDocumentAspirante').html(valorIngresado);
        console.log(valorIngresado);
    });

    $(".inputDireccionRegisterAspirante").keyup(function() {
        valorIngresado = $(this).val();
        $('.confirmTxtDireccionAspirante').html(valorIngresado);
        console.log(valorIngresado);
    });
});


$(function() {
    var actuaraComo = $('.selectActuaraComoRegisterAspirante').find('option:selected').text();
    var lineaConvocatoria = $('.selectLineaConvocatoriaRegisterAspirante').find('option:selected').text();
    var experienciaMusical = $('.selectExperienciaMusicalRegisterAspirante').find('option:selected').text();

    $('.confirmTxtActuaraComoAspirante').html(actuaraComo);
    $('.confirmTxtLineaConvocatoriaAspirante').html(lineaConvocatoria);
    $('.confirmTxtExperienciaMusicalAspirante').html(experienciaMusical);


    $('.confirmSelectTypeDocumentAspirante').html('Cédula de Ciudadania');

    $('.selectTipoDocumentRegisterAspirante').on('change', onSelectTypeDocumentChange);

    $('.selectActuaraComoRegisterAspirante').on('change', onSelectActuaraComoChange);

    $('.selectLineaConvocatoriaRegisterAspirante').on('change', onSelectLineaConvocatoriaChange);

    $('.selectExperienciaMusicalRegisterAspirante').on('change', onSelectExperienciaMusicalChange);
});

function onSelectTypeDocumentChange() {
    var id = $(this).val();

    if (id == 1) {

        $('.confirmSelectTypeDocumentAspirante').html('Cédula de Ciudadania');
    } else if (id == 2) {

        $('.confirmSelectTypeDocumentAspirante').html('Tarjeta de Identidad');
    }
}

function onSelectActuaraComoChange() {
    var id = $(this).val();

    if (id == 1) {

        $('.confirmTxtActuaraComoAspirante').html('Persona Natural');
    } else if (id == 2) {

        $('.confirmTxtActuaraComoAspirante').html('Grupo Constituido');
    }
}

function onSelectLineaConvocatoriaChange() {
    var id = $(this).val();

    if (id == 1) {

        $('.confirmTxtLineaConvocatoriaAspirante').html('Solista');
    } else if (id == 2) {

        $('.confirmTxtLineaConvocatoriaAspirante').html('Agrupación Musical');
    }
}

function onSelectExperienciaMusicalChange() {
    var id = $(this).val();

    if (id == 1) {

        $('.confirmTxtExperienciaMusicalAspirante').html('Principiante');
    } else if (id == 2) {

        $('.confirmTxtExperienciaMusicalAspirante').html('Intermedio');
    } else if (id == 3) {

        $('.confirmTxtExperienciaMusicalAspirante').html('Profesional');
    }
}
