/* SELECT LINEA DE LA CONVOCATORIA */
var lineaConvocatoria = 0;

$('#select-linea-convocatoria').on('change', function() {
    lineaConvocatoria = $(this).val()
    $("#select-actuara-como").prop('disabled', false);
    hideContentInfo();

    switch ( lineaConvocatoria ) {
        case '-1': $("#content-select-form-actuara-como").hide();
                $("#select-actuara-como").val("-1");
            break;
        case '1': $("#content-select-form-actuara-como").show();
                $("#select-actuara-como option[value='1']").show();
                $("#select-actuara-como option[value='3']").hide();
                $("#select-actuara-como").val("-1");
                $("#forma-parte-grupo").hide();
            break;
        case '2': $("#content-select-form-actuara-como").show();
                showInfoGroup()
                $("#select-actuara-como").val("3");
                $("#select-actuara-como option[value='3']").show();
                $("#select-actuara-como").prop('disabled', true);
                $("#forma-parte-grupo").show();
            break;
    }
});

/* funcion para ocultar elementos de la vista */
function hideContentInfo() {
    $('#content-informacion-aspirante').hide();
    $('#content-informacion-menor-edad').hide();
    $('#content-informacion-grupo-musical').hide();
    $('#btn-enviar-datos').hide();
    $("#forma-parte-grupo").hide();
}

/* SELECT ACTUARÁ COMO PARA MOSTRAR CONTENIDO */
var actuaraComo = 0;
$('#select-actuara-como').on('change', function() {
    actuaraComo = $(this).val();
    switch ( $(this).val() ) {
        case '-1': hideContentInfo()
            break;
        case '1': $('#title-info-aspirante').html('Información del aspirante');
                $('#content-informacion-aspirante').show();
                $('#content-informacion-menor-edad').hide();
                $('#content-informacion-grupo-musical').hide();
                $("#aspirant-document-type option[value='3']").hide(); // ocultar cedula de extranjeria
                $('#btn-enviar-datos').show();
            break;
        case '2': $('#title-info-aspirante').html('Información del representante para el menor de edad');
                $('#content-informacion-aspirante').show();
                $('#content-informacion-menor-edad').show();
                $('#content-informacion-grupo-musical').hide();
                $("#aspirant-document-type option[value='3']").show(); // mostrar cedula de extranjeria
                $('#btn-enviar-datos').show();
            break;
    }
});

/* funcion para mostrar los datos del grupo */
function showInfoGroup() {
    $('#title-info-aspirante').html('Información del representante para el grupo');
    $('#content-informacion-aspirante').show();
    $('#content-informacion-menor-edad').hide();
    $('#content-informacion-grupo-musical').show();
    $('#btn-enviar-datos').show();
}


/* evento onChange de los select que contienen los departamentos */
function onSelectDepartamentosChange(element, component ) {
    $.get('/dashboard/get-municipios/' + $(element).val(), function(data) {
        var html_select = '<option value="-1">Seleccione una opción</option>'
        html_select += data.map( municipio => { return `<option value="${ municipio.id }">${ municipio.descripcion }</option>`; } ).join(' ');
        $( `.${ component }` ).html(html_select);
    });

    let tags = $(element).attr('name');
    let arrayTags = tags.split('[')
    let nameTag = '[' + arrayTags[1];
    validateFormSelect(arrayTags[0], nameTag); // realizar validacion
}

/* evento onChange de los select que contienen los municipios */
function onSelectMunicipiosChange(element) {
    let tags = $(element).attr('name');
    let arrayTags = tags.split('[')
    let nameTag = '[' + arrayTags[1];
    validateFormSelect(arrayTags[0], nameTag); // realizar validacion
}

/* evento click para los radio button de subir docuemntos */
$("input[name='aspirante[identificacionDoc]']").click( () => {
    if ($('input:radio[name="aspirante[identificacionDoc]"]:checked').val() === '1') {
        $("#image-docuemnt-aspirante").show();
        $("#pdf-docuemnt-aspirante").hide();
    } else {
        $("#image-docuemnt-aspirante").hide();
        $("#pdf-docuemnt-aspirante").show();
    }
});

$("input[name='beneficiario[identificacionDoc]']").click( () => {
    if ($('input:radio[name="beneficiario[identificacionDoc]"]:checked').val() === '1') {
        $("#image-docuemnt-beneficiario").show();
        $("#pdf-docuemnt-beneficiario").hide();
    } else {
        $("#image-docuemnt-beneficiario").hide();
        $("#pdf-docuemnt-beneficiario").show();
    }
});

// evento click para para selecionar si forma parte del grupo musical
$("input[name='aspirante[partGroup]']").click( () => {
    if ($('input:radio[name="aspirante[partGroup]"]:checked').val() === '1') {
        $("#content-aspirante_rolMember").show();
    } else {
        $("#content-aspirante_rolMember").hide();
    }
});

// validar el número de integrantes del grupo 
$("#input-max-members").keyup( () => validateNumberMin( $("#input-max-members").val() ) );

function validateNumberMin(num) {
    if (num < 1) {
        $("#content-input-max-members").addClass('has-danger');
        $("#error-input-max-members").html('El número mínimo de integrantes es de 1')
        $("#error-input-max-members").show()
        return true
    } else {
        $("#content-input-max-members").removeClass('has-danger');
        $("#error-input-max-members").html('')
        $("#error-input-max-members").hide()
        return false
    }
}

/*  funciones para agragar un nuevo integrante  */
var currentMembers = 0;

$("#event-add-max-members").click( function() {
    let members = parseInt( $("#input-max-members").val() );

    if (validateNumberMin(members)) return;

    if (currentMembers === members) return; // si el valor no cambia se retorna

    currentMembers = members;
    $("#m_section_1_content").empty(); // vaciar la vista

    for(let i = 0; i < members; i++){
        addViewMembers(i);
    }
});

/* funcion para agregar nuevos items */
function addViewMembers(members) {
    var newItem = `<div id="member-${members}" class="m-accordion__item">
                        <div class="m-accordion__item-head collapsed" role="tab" id="section_members_head_${members}" data-toggle="collapse" href="#section_members_body_${members}">
                            <span class="m-accordion__item-title">Datos del Integrante No. ${(members + 1)}</span>
                            <span class="m-accordion__item-mode"></span>
                        </div>
                        <div class="m-accordion__item-body collapse" id="section_members_body_${members}" role="tabpanel" aria-labelledby="section_members_head_${members}" data-parent="#m_section_1_content">
                            <div class="m-accordion__item-content">
                                ${ addViewFormMembers(members) }
                            </div>
                        </div>
                    </div>`;

    $("#m_section_1_content").append(newItem);
}

function addViewFormMembers(member) {
    return `<div class="m-form__section m-form__section--first">
                <div class="m-form__heading">
                    <h3 class="m-form__heading-title">Información personal</h3>
                </div>

                <!-- NOMBRES Y APELLIDOS -->
                ${ addViewNameMembers(member) }

                <!-- SEGUNDO APELLIDO Y TÉLEFONO -->
                ${ addViewPhoneMembers(member) }

                <!-- TIPO DE DOCUMENTO Y Nº IDENTIFICACIÓN -->
                ${ addViewIdentificationMembers(member) }

                <!-- DEPARTAMENTO EXPED Y MUNICIPIO DE EXPEDI -->
                ${ addViewLocationMembers(member, 1) }

                <!-- CARGAR DOCUMENTO -->
                ${ addViewUploadArchiveMember(member) }

                <div class="form-group m-form__group row">
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">Instrumento que interpreta</label>
                        <input type="num" name="integrantes[${member}][rolMember]" class="form-control m-input" placeholder="" value="">
                        <span class="m-form__help">Ingrese el rol que desempeña dentro del grupo (Guitarrista, Vocalista, Pianista, etc.)</span>
                    </div>
                </div>
            </div>

                <div class="m-separator m-separator--dashed m-separator--lg"></div>

                <div class="m-form__section">
                    <div class="m-form__heading">
                        <h3 class="m-form__heading-title">Información de nacimiento y residencia
                            <i data-toggle="m-tooltip" data-width="auto" class="m-form__heading-help-icon flaticon-info"
                                title="Ingrese los datos de nacimiento y residencia"></i>
                        </h3>
                    </div>

                    ${ addViewLocationMembers(member, 2) }

                    ${ addViewLocationMembers(member, 3) }

                    <div class="form-group m-form__group row">
                        <div class="col-lg-6 m-form__group-sub">
                            <label class="form-control-label">Dirección de residencia <span class="text-danger">*</span></label>
                            <input type="text" name="integrantes[${member}][addressMember]" class="form-control m-input" placeholder="" value="">
                            <span class="m-form__help">Por favor ingrese dirección de residencia</span>
                        </div>
                    </div>
                </div>

            </div>`;
}

function addViewNameMembers(member) {  /* NOMBRES Y APELLIDOS */
    return `<div class="form-group m-form__group row">
                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="integrantes[${member}][nameMember]"class="form-control m-input" placeholder="" value="">
                    <span class="m-form__help">Por favor ingrese nombre completo</span>
                </div>

                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Primer apellido <span class="text-danger">*</span></label>
                    <input type="text" name="integrantes[${member}][lastnameMember]" class="form-control m-input" placeholder="" value="">
                    <span class="m-form__help">Por favor ingrese primer apellido</span>
                </div>
            </div>`;
}

function addViewPhoneMembers(member) { /* SEGUNDO APELLIDO Y TÉLEFONO */
    return `<div class="form-group m-form__group row">
                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Segundo apellido <span class="text-danger">*</span></label>
                    <input type="text" name="integrantes[${member}][secondLastnameMember]" class="form-control m-input" placeholder="" value="">
                    <span class="m-form__help">Por favor ingrese segundo apellido</span>
                </div>

                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Teléfono celular <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="la la-phone"></i></span>
                        </div>
                        <input type="text" name="integrantes[${member}][phoneMember]" class="form-control m-input" placeholder="" value="">
                    </div>
                    <span class="m-form__help">Por favor ingrese número de teléfono</span>
                </div>
            </div>`;
}

function addViewIdentificationMembers(member) { /* TIPO DE DOCUMENTO Y Nº IDENTIFICACIÓN */
    return `<div class="form-group m-form__group row">
                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Tipo de documento <span class="text-danger">*</span></label>
                    <select name="integrantes[${member}][documentTypeMember]" class="form-control m-input">
                        ${ typeDocument.map( obj => { return `<option value="${ obj.id }">${ obj.document }</option>` } ).join(' ') }
                    </select>
                    <span class="m-form__help">Por favor seleccione una opción.</span>
                </div>

                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Nº de indentificación <span class="text-danger">*</span></label>
                    <input type="num" name="integrantes[${member}][identificationMember]" class="form-control m-input" placeholder="" value="">
                    <span class="m-form__help">Por favor ingrese el número de indentificación</span>
                </div>
            </div> `;
}

function addViewLocationMembers(member, tipo) { /* DEPARTAMENTO EXPED Y MUNICIPIO DE EXPEDI */
    let tipoSelect = '';

    switch (tipo) {
        case 1: tipoSelect = 'expedición';
        break;
        case 2: tipoSelect = 'nacimiento';
        break;
        case 3: tipoSelect = 'residencia';
        break;
    }

    return `<div class="form-group m-form__group row">
                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Departamento de ${ tipoSelect } <span class="text-danger">*</span></label>
                    <select onchange="eventOnChangeDepartamentos(this, ${ tipo }, ${ member })" id="select-control-departamentos-${ tipo }-${ member }"
                        name="integrantes[${member}][departamento_${ tipoSelect }_member]" class="form-control m-input">
                        <option value="-1">Seleccione departamento</option>
                        ${ departamentos.map( dep => { return `<option value="${ dep.id }">${ dep.descripcion }</option>`; } ).join(' ') }
                    </select>
                    <span class="m-form__help">Por favor seleccione una opción.</span>
                </div>

                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Municipio de ${ tipoSelect } <span class="text-danger">*</span></label>
                    <select id="select-control-municipio-${ tipo }-${ member }" name="integrantes[${member}][municipio_${ tipoSelect }_member]" class="form-control m-input"></select>
                    <span class="m-form__help">Por favor seleccione una opción.</span>
                </div>
            </div> `;
}

/* funcion para cargar los municipio con el id del departamento */
function eventOnChangeDepartamentos(element, tipo, member) {
    // AJAX
    $.get('/dashboard/get-municipios/' + $(element).val(), function(data) {
        var html_select = '<option value="-1">Seleccione una opción</option>'
        html_select += data.map( municipio => { return `<option value="${ municipio.id }">${ municipio.descripcion }</option>`; } ).join(' ');
        $( `#select-control-municipio-${ tipo }-${ member }` ).html(html_select);
    });
}

function addViewUploadArchiveMember(member) {
    return `<div class="form-group m-form__group row">
                <div class="col-lg-12 m-form__group-sub">
                    <label for="">Seleccione el tipo de formato para subir el documento de identificación</label>
                    <div class="m-radio-inline">
                        <label class="m-radio">
                            <input type="radio" onClick="changeOptionDocument(this, ${ member })" name="integrantes[${member}][fileType]" value="1" checked="checked"> Imagen
                            <span></span>
                        </label>
                        <label class="m-radio">
                            <input type="radio" onClick="changeOptionDocument(this, ${ member })" name="integrantes[${member}][fileType]" value="2"> PDF
                            <span></span>
                        </label>
                    </div>
                </div>

                <div id="image-docuemnt-integrantes-${ member }" class="col-lg-12 form-group m-form__group row">
                    <div class="col-lg-6 m-form__group-sub">
                        <label for="">Imagen documento identificación frente</label>
                        <input type="file" name="integrantes[${member}][imgDocfrente]" class="form-control-file" style="border: none;" />
                    </div>
                    <div class="col-lg-6 m-form__group-sub">
                        <label for="">Imagen documento identificación atrás</label>
                        <input type="file" name="integrantes[${member}][imgDocAtras]" class="form-control-file" style="border: none;" />
                    </div>
                </div>

                <div id="pdf-docuemnt-integrantes-${ member }" style="display: none" class="col-lg-12 m-form__group-sub">
                    <label for="">PDF documento identificación </label>
                    <input type="file" name="integrantes[${member}][pdfDocument]" class="form-control-file" style="border: none;" />
                </div>
            </div>`;
}

function changeOptionDocument(element, member) {
    if ($(element).val() === '1'){
        $(`#image-docuemnt-integrantes-${ member }`).show();
        $(`#pdf-docuemnt-integrantes-${ member }`).hide();
    } else {
        $(`#image-docuemnt-integrantes-${ member }`).hide();
        $(`#pdf-docuemnt-integrantes-${ member }`).show();
    }
}


/* contenido para validar el formulario */
var messages = {
    required: "Este campo es requerido.",
    email: "Por favor, ingrese una dirección de correo electrónico válida.",
    url: "Por favor ingrese un URL válida.",
    date: "Por favor ingrese una fecha valida.",
    number: "Por favor ingrese un número valido.",
    digits: "Por favor ingrese solo dígitos.",
};
const fieldsInputs = {
    aspirante_name: false,
    aspirante_lastname: false,
    aspirante_secondLastname: false,
    aspirante_phone: false,
    aspirante_documentType: false,
    aspirante_identificacion: false,
    aspirante_departamentoExpedida: false,
    aspirante_municipioExpedida: false,
    aspirante_birthdate: false,
    aspirante_biografia: false,
    aspirante_departamentoNacimiento: false,
    aspirante_municipioNacimiento: false,
    aspirante_address: false,
    aspirante_vereda: false,
    beneficiario_name: false,
    beneficiario_lastname: false,
    beneficiario_secondLastname: false,
    beneficiario_phone: false,
    beneficiario_documentType: false,
    beneficiario_identificacion: false,
    beneficiario_departamentoExpedida: false,
    beneficiario_municipioExpedida: false,
    beneficiario_birthdate: false,
    beneficiario_biografia: false,
    beneficiario_departamentoNacimiento: false,
    beneficiario_municipioNacimiento: false,
    beneficiario_address: false,
    beneficiario_vereda: false,
}

/* Evento para enviar los datos del formulario */
$("#send-info").click( function(e) {
    e.preventDefault();

    if (validationForm()) {
        $("#alert-info-form").hide();

        swal({
            title: '¡Buen trabajo!',
            text: "¿Esta seguro de guardar los datos?",
            type: 'info',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then(function(result){
            if (result.value) {
                $('#m_form_new_register').submit();
            }
        });
    } else {
        $("#alert-info-form").show();
        viewAlertError();
    }
});

/* mostrar alerta de datos faltantes */
function viewAlertError() {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "2000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr.error("Algunos datos son requeridos", "¡Recuerda!");
}

/* evento para realizar las validaciones del formulario */
function validationForm() {
    let validate = false;

    /* validar inputs */
    validateFormInputs('aspirante', 'name');
    validateFormInputs('aspirante', 'lastname');
    validateFormInputs('aspirante', 'secondLastname');
    validateFormInputs('aspirante', 'phone');
    validateFormInputs('aspirante', 'identificacion');
    validateFormInputs('aspirante', 'address');
    validateFormInputs('aspirante', 'birthdate');
    formatDateSend($('input[name="aspirante[birthdate]"]'))

    /* validar selects  */
    //validateFormSelect('aspirante', 'documentType');
    validateFormSelect('aspirante', '[departamentoExpedida]');
    validateFormSelect('aspirante', '[municipioExpedida]');
    validateFormSelect('aspirante', '[departamentoNacimiento]');
    validateFormSelect('aspirante', '[municipioNacimiento]');
    validateFormSelect('aspirante', '[departamentoResidencia]');
    validateFormSelect('aspirante', '[municipioResidencia]');

    if (lineaConvocatoria === '1' &&  actuaraComo === '1') {
        validate = validateAspirante();
    } else if (lineaConvocatoria === '1' &&  actuaraComo === '2') {
        /* validar inputs */
        validateFormInputs('beneficiario', 'name');
        validateFormInputs('beneficiario', 'lastname');
        validateFormInputs('beneficiario', 'secondLastname');
        validateFormInputs('beneficiario', 'phone');
        validateFormInputs('beneficiario', 'identificacion');
        validateFormInputs('beneficiario', 'address');
        validateFormInputs('beneficiario', 'birthdate');
        formatDateSend($('input[name="beneficiario[birthdate]"]'))

        /* validar selects  */
        //validateFormSelect('beneficiario', 'documentType');
        validateFormSelect('beneficiario', '[departamentoExpedida]');
        validateFormSelect('beneficiario', '[municipioExpedida]');
        validateFormSelect('beneficiario', '[departamentoNacimiento]');
        validateFormSelect('beneficiario', '[municipioNacimiento]');
        validateFormSelect('beneficiario', '[departamentoResidencia]');
        validateFormSelect('beneficiario', '[municipioResidencia]');

        if (validateAspirante() && validateBeneficiario()) validate = true;
    } else {
        validate = validateAspirante();
        validateFormInputs('aspirante', 'nameTeam');
        // validar el rol que desempeña en el grupo  
        if ($('input:radio[name="aspirante[partGroup]"]:checked').val() === '1') {
            validateFormInputs('aspirante', 'rolMember');            
            if ($("input[name='aspirante[rolMember]']").val() == '' || $("input[name='aspirante[nameTeam]']").val() == '') {
                validate =  false;  
            }
        }
        // falta validar el grupo
    }

    console.log('antes::: ', validate)
    if (validateTermsCondition() && validate) {
        validate = true
    } else {
        validate = false;
    }
    console.log('despues::: ', validate)
    return validate;
}

/* funcion para formatear la fecha */
function formatDateSend(element) {
    if ($(element).val()) {
        let arrayDate = $(element).val().split('/');
        arrayDate.reverse();
        $(element).val(arrayDate.map( date => { return date }).join('-'))
    }
}

/* funcion para validar los datos requeridos del aspirante */
const validateAspirante = () => {
    if (fieldsInputs.aspirante_name && fieldsInputs.aspirante_lastname && fieldsInputs.aspirante_secondLastname
        && fieldsInputs.aspirante_phone && fieldsInputs.aspirante_identificacion && fieldsInputs.aspirante_address
        && fieldsInputs.aspirante_departamentoExpedida && fieldsInputs.aspirante_municipioExpedida
        && fieldsInputs.aspirante_departamentoNacimiento && fieldsInputs.aspirante_municipioNacimiento
        && fieldsInputs.aspirante_birthdate) {
        return true;
    }

    return false;
}

/* funcion para validar los datos requeridos del beneficiario */
const validateBeneficiario = () => {
    if (fieldsInputs.beneficiario_name && fieldsInputs.beneficiario_lastname && fieldsInputs.beneficiario_secondLastname
        && fieldsInputs.beneficiario_phone && fieldsInputs.beneficiario_identificacion && fieldsInputs.beneficiario_address
        && fieldsInputs.beneficiario_departamentoExpedida && fieldsInputs.beneficiario_municipioExpedida
        && fieldsInputs.beneficiario_departamentoNacimiento && fieldsInputs.beneficiario_municipioNacimiento
        && fieldsInputs.beneficiario_birthdate) {
        return true;
    }

    return false
}

/* funcion que realiza las validaciones segun el campo input */
const validateFormInputs = (tipo, targetName) => {
    validateFields('input', `${ tipo }[${ targetName }]`, `${ tipo }_${ targetName }`)
    /* switch (`${ tipo }[${ targetName }]`) {
        case `${ tipo }[name]`:
            validateFields('input', `${ tipo }[name]`, `${ tipo }_name`)
            break;
        case `${ tipo }[lastname]`:
            validateFields('input', `${ tipo }[lastname]`, `${ tipo }_lastname`)
            break;
        case `${ tipo }[secondLastname]`:
            validateFields('input', `${ tipo }[secondLastname]`, `${ tipo }_secondLastname`)
            break;
        case `${ tipo }[phone]`:
            validateFields('input', `${ tipo }[phone]`, `${ tipo }_phone`)
            break;
        case `${ tipo }[identificacion]`:
            validateFields('input', `${ tipo }[identificacion]`, `${ tipo }_identificacion`)
            break;
        case `${ tipo }[address]`:
            validateFields('input', `${ tipo }[address]`, `${ tipo }_address`)
            break;
        case `${ tipo }[birthdate]`:
            validateFields('input', `${ tipo }[birthdate]`, `${ tipo }_birthdate`)
            break;
        case `${ tipo }[nameTeam]`:
            validateFields('input', `${ tipo }[nameTeam]`, `${ tipo }_nameTeam`)
            break;
    } */
}

/* funcion que realiza las validaciones segun el campo select */
const validateFormSelect = (type, targetName) => {
    switch (`${ type }${ targetName }`) {
        /* case 'aspirante[documentType]':
            validateFieldsSelect('aspirante[documentType]', 'aspirante_documentType')
            break; */
        case `${ type }[departamentoExpedida]`:
            validateFieldsSelect(`${ type }[departamentoExpedida]`, `${ type }_departamentoExpedida`)
            break;
        case `${ type }[municipioExpedida]`:
            validateFieldsSelect(`${ type }[municipioExpedida]`, `${ type }_municipioExpedida`)
            break;
        case `${ type }[departamentoNacimiento]`:
            validateFieldsSelect(`${ type }[departamentoNacimiento]`, `${ type }_departamentoNacimiento`)
            break;
        case `${ type }[municipioNacimiento]`:
            validateFieldsSelect(`${ type }[municipioNacimiento]`, `${ type }_municipioNacimiento`)
            break;
        case `${ type }[departamentoResidencia]`:
            validateFieldsSelect(`${ type }[departamentoResidencia]`, `${ type }_departamentoResidencia`)
            break;
        case `${ type }[municipioResidencia]`:
            validateFieldsSelect(`${ type }[municipioResidencia]`, `${ type }_municipioResidencia`)
            break;
    }
}

/* funcion que realiza la accion de poner o quitar el error al campo input */
const validateFields = (type, input, campo) => {
    if ( $(`${ type }[name='${ input }']`).val() === '' ){
        $(`#content-${ campo }`).addClass('has-danger');
        $(`#error-${ campo }`).show();
        $(`#error-${ campo }`).html(messages.required);
        fieldsInputs[campo] = false;
    } else {
        $(`#content-${ campo }`).removeClass('has-danger');
        $(`#error-${ campo }`).hide();
        fieldsInputs[campo] = true;
    }
}

/* funcion que realiza la accion de poner o quitar el error al campo select */
const validateFieldsSelect = (input, campo) => {
    if ($(`select[name='${ input }']`).val() == null || $(`select[name='${ input }']`).val() === '-1'
        || $(`select[name='${ input }']`).val() === '' || $(`select[name='${ input }']`).val() === 'undefined'){
        $(`#content-${ campo }`).addClass('has-danger');
        $(`#error-${ campo }`).show();
        $(`#error-${ campo }`).html(messages.required);
        fieldsInputs[campo] = false;
    } else {
        $(`#content-${ campo }`).removeClass('has-danger');
        $(`#error-${ campo }`).hide();
        fieldsInputs[campo] = true;
    }
}

const validateTermsCondition = () => {
    if ( $("input[name='acceptTermsConditions']").is(':checked') ) {
        $('#content-acceptTermsConditions').removeClass('has-danger');
        $('#error-acceptTermsConditions').hide();
        return true;
    } else {
        $('#content-acceptTermsConditions').addClass('has-danger');
        $('#error-acceptTermsConditions').show();
        $('#error-acceptTermsConditions').html(messages.required);
        return false;
    }
}

/* evento onkeyup de los inputs aspirante */
$("input[name='aspirante[name]']").keyup( () => validateFormInputs('aspirante', 'name') );
$("input[name='aspirante[lastname]']").keyup( () => validateFormInputs('aspirante', 'lastname') );
$("input[name='aspirante[secondLastname]']").keyup( () => validateFormInputs('aspirante', 'secondLastname') );
$("input[name='aspirante[phone]']").keyup( () => validateFormInputs('aspirante', 'phone') );
$("input[name='aspirante[identificacion]']").keyup( () => validateFormInputs('aspirante', 'identificacion') );
$("input[name='aspirante[address]']").keyup( () => validateFormInputs('aspirante', 'address') );
$("input[name='aspirante[birthdate]']").change( () => validateFormInputs('aspirante', 'birthdate') );
$("input[name='aspirante[rolMember]']").keyup( () => validateFormInputs('aspirante', 'rolMember') ); 

/* evento onkeyup de los inputs beneficiario */
$("input[name='beneficiario[name]']").keyup( () => validateFormInputs('beneficiario', 'name') );
$("input[name='beneficiario[lastname]']").keyup( () => validateFormInputs('beneficiario', 'lastname') );
$("input[name='beneficiario[secondLastname]']").keyup( () => validateFormInputs('beneficiario', 'secondLastname') );
$("input[name='beneficiario[phone]']").keyup( () => validateFormInputs('beneficiario', 'phone') );
$("input[name='beneficiario[identificacion]']").keyup( () => validateFormInputs('beneficiario', 'identificacion') );
$("input[name='beneficiario[address]']").keyup( () => validateFormInputs('beneficiario', 'address') );
$("input[name='beneficiario[birthdate]']").change( () => validateFormInputs('beneficiario', 'birthdate') );
$("input[name='aspirante[nameTeam]']").keyup( () => validateFormInputs('aspirante', 'nameTeam') );

$("input[name='acceptTermsConditions']").change( () => validateTermsCondition() );


/********************************************
    Funcionalidad de los objetos Dropzone
 ********************************************/
function showLoading() {
    $('body').loading({
        message: 'Subiendo documento...',
        start: true,
    });
}
function dropzoneSuccess(response, nameField, inputField) {
    $('body').loading({ start: false });
    $(`#content-${ nameField }`).removeClass('has-danger');
    $(`#error-${ nameField }`).text('');
    $(`input[name='${ inputField }']`).val(response);
}
function dropzoneError(nameField, msg, inputField) {
    $(`#content-${ nameField }`).addClass('has-danger');
    $(`#error-${ nameField }`).text(msg);
    $(`input[name='${ inputField }']`).val('');
}

var imageDocumentFrenteAspirant = new Dropzone('.file-image-document-aspirante-frente', {
    acceptedFiles: "image/*",
    maxFiles: 1,
    paramName: 'file',
    addRemoveLinks: true,
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    processing: function (file, response) {
        showLoading()
    },
    success: function (file, response) {
        dropzoneSuccess(response, 'file-image-document-aspirante-frente', 'aspirante[urlImageDocumentFrente]')
    },
    error: function (file, responce) {
        dropzoneError('file-image-document-aspirante-frente', 'Recuerda que solo se admiten archivos en formato JPG ó PNG.', 'aspirante[urlImageDocumentFrente]')
        setTimeout( () => { imageDocumentFrenteAspirant.removeFile(file) }, 2000 )
    }
});
var imageDocumentAtrasAspirant = new Dropzone('.file-image-document-aspirante-atras', {
    acceptedFiles: "image/*",
    maxFiles: 1,
    paramName: 'file',
    addRemoveLinks: true,
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    processing: function (file, response) {
        showLoading()
    },
    success: function (file, response) {
        dropzoneSuccess(response, 'file-image-document-aspirante-atras', 'aspirante[urlImageDocumentAtras]')
    },
    error: function (file, responce) {
        dropzoneError('file-image-document-aspirante-atras', 'Recuerda que solo se admiten archivos en formato JPG ó PNG.', 'aspirante[urlImageDocumentAtras]')
        setTimeout( () => { imageDocumentAtrasAspirant.removeFile(file) }, 2000 )
    }
});
var pdfDocumentAspirant = new Dropzone('.file-pdf-document-aspirante', {
    acceptedFiles: "application/pdf",
    maxFiles: 1,
    paramName: 'file',
    addRemoveLinks: true,
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    processing: function (file, response) {
        showLoading()
    },
    success: function (file, response) {
        dropzoneSuccess(response, 'file-pdf-document-aspirante', 'aspirante[urlPdfDocument]')
    },
    error: function (file, responce) {
        dropzoneError('file-pdf-document-aspirante', 'Recuerda que solo se admiten archivos en formato PDF.', 'aspirante[urlPdfDocument]')
        setTimeout( () => { pdfDocumentAspirant.removeFile(file) }, 2000 )
    }
});
var imageProfileAspirant = new Dropzone(".file-image-profile-aspirante", {
    paramName: "file",
    maxFiles: 1,
    maxFilesize: 5, 
    addRemoveLinks: true,
    acceptedFiles: "image/*",
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    processing: function (file, response) {
        showLoading()
    },
    success: function (file, response) {
        dropzoneSuccess(response, 'image-profile-aspirante', 'aspirante[urlImageProfile]')
    },
    error: function (file, responce) {
        dropzoneError('image-profile-aspirante', 'Recuerda que solo se admiten archivos en formato JPG ó PNG.', 'aspirante[urlImageProfile]')
        setTimeout( () => { imageProfileAspirant.removeFile(file) }, 2000 )
    }
});

// eventos para subir la imagen o pdf del beneficiario  
var imageDocumentFrenteBeneficiario = new Dropzone('.file-image-document-beneficiario-frente', {
    acceptedFiles: "image/*",
    maxFiles: 1,
    paramName: 'file',
    addRemoveLinks: true,
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    processing: function (file, response) {
        showLoading()
    },
    success: function (file, response) {
        dropzoneSuccess(response, 'file-image-document-beneficiario-frente', 'beneficiario[urlImageDocumentFrente]')
    },
    error: function (file, responce) {
        dropzoneError('file-image-document-beneficiario-frente', 'Recuerda que solo se admiten archivos en formato JPG ó PNG.', 'beneficiario[urlImageDocumentFrente]')
        setTimeout( () => { imageDocumentFrenteBeneficiario.removeFile(file) }, 2000 )
    }
});
var imageDocumentAtrasBeneficiario = new Dropzone('.file-image-document-beneficiario-atras', {  
    acceptedFiles: "image/*",
    maxFiles: 1,
    paramName: 'file',
    addRemoveLinks: true,
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    processing: function (file, response) {
        showLoading()
    },
    success: function (file, response) {
        dropzoneSuccess(response, 'file-image-document-beneficiario-atras', 'beneficiario[urlImageDocumentAtras]')
    },
    error: function (file, responce) {
        dropzoneError('file-image-document-beneficiario-atras', 'Recuerda que solo se admiten archivos en formato JPG ó PNG.', 'beneficiario[urlImageDocumentAtras]')
        setTimeout( () => { imageDocumentAtrasBeneficiario.removeFile(file) }, 2000 )
    }
});
var pdfDocumentBeneficiario = new Dropzone('.file-pdf-document-beneficiario', {
    acceptedFiles: "application/pdf",
    maxFiles: 1,
    paramName: 'file',
    addRemoveLinks: true,
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    processing: function (file, response) {
        showLoading()
    },
    success: function (file, response) {
        dropzoneSuccess(response, 'file-pdf-document-beneficiario', 'beneficiario[urlPdfDocument]')
    },
    error: function (file, responce) {
        dropzoneError('file-pdf-document-beneficiario', 'Recuerda que solo se admiten archivos en formato PDF.', 'beneficiario[urlPdfDocument]')
        setTimeout( () => { pdfDocumentBeneficiario.removeFile(file) }, 2000 )
    }
});
var imageProfileBeneficiario = new Dropzone(".file-image-profile-beneficiario", {
    paramName: "file",
    maxFiles: 1,
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    acceptedFiles: "image/*",
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    processing: function (file, response) {
        showLoading()
    },
    success: function (file, response) {
        dropzoneSuccess(response, 'file-image-profile-beneficiario', 'beneficiario[urlImageProfile]')
    },
    error: function (file, responce) {
        dropzoneError('file-image-profile-beneficiario', 'Recuerda que solo se admiten archivos en formato JPG ó PNG.', 'beneficiario[urlImageProfile]')
        setTimeout( () => { imageProfileBeneficiario.removeFile(file) }, 2000 )
    }
});
Dropzone.autoDiscover = false;

