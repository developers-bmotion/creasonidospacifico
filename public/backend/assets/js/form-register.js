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
            break;
        case '2': $("#content-select-form-actuara-como").show();                
                showInfoGroup()
                $("#select-actuara-como").val("3");    
                $("#select-actuara-como").prop('disabled', true);
            break;
    }   
});

/* funcion para ocultar elementos de la vista */
function hideContentInfo() {
    $('#content-informacion-aspirante').hide();
    $('#content-informacion-menor-edad').hide();
    $('#content-informacion-grupo-musical').hide();
    $('#btn-enviar-datos').hide();
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
                $('#btn-enviar-datos').show();
            break;
        case '2': $('#title-info-aspirante').html('Información del representante para el menor de edad');
                $('#content-informacion-aspirante').show();
                $('#content-informacion-menor-edad').show();
                $('#content-informacion-grupo-musical').hide();
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
    console.log('tagname: ', $(element).attr('name'));

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
    console.log('name tag:  ', arrayTags, nameTag);
    validateFormSelect(arrayTags[0], nameTag); // realizar validacion
}


/*  funciones para agragar un nuevo integrante  */
var currentMembers = 0;

$("#event-add-max-members").click( function() {    
    let members = parseInt( $("#input-max-members").val() );   

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
                ${ addViewLocationMembers(member, true) }

                <!-- CARGAR DOCUMENTO -->
                ${ addViewUploadArchiveMember(member) }

                <div class="m-separator m-separator--dashed m-separator--lg"></div>

                <div class="m-form__section">
                    <div class="m-form__heading">
                        <h3 class="m-form__heading-title">Información de nacimiento y residencia
                            <i data-toggle="m-tooltip" data-width="auto" class="m-form__heading-help-icon flaticon-info"
                                title="Ingrese los datos de nacimiento y residencia"></i>
                        </h3>
                    </div>

                    ${ addViewLocationMembers(member, false) }

                    <div class="form-group m-form__group row">
                        <div class="col-lg-6 m-form__group-sub">
                            <label class="form-control-label">Dirección de residencia *</label>
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
                    <label class="form-control-label">Nombre *</label>
                    <input type="text" name="integrantes[${member}][nameMember]"class="form-control m-input" placeholder="" value="">
                    <span class="m-form__help">Por favor ingrese su nombre completo</span>
                </div>

                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Primer apellido *</label>
                    <input type="text" name="integrantes[${member}][lastnameMember]" class="form-control m-input" placeholder="" value="">
                    <span class="m-form__help">Por favor ingrese su primer apellido</span>
                </div>
            </div>`;
}

function addViewPhoneMembers(member) { /* SEGUNDO APELLIDO Y TÉLEFONO */
    return `<div class="form-group m-form__group row">
                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Segundo apellido *</label>
                    <input type="text" name="integrantes[${member}][secondLastnameMember]" class="form-control m-input" placeholder="" value="">
                    <span class="m-form__help">Por favor ingrese su segundo apellido</span>
                </div>

                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Teléfono celular *</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="la la-phone"></i></span>
                        </div>
                        <input type="text" name="integrantes[${member}][phoneMember]" class="form-control m-input" placeholder="" value="">
                    </div>
                    <span class="m-form__help">Por favor ingrese su número de teléfono</span>
                </div>
            </div>`;
}

function addViewIdentificationMembers(member) { /* TIPO DE DOCUMENTO Y Nº IDENTIFICACIÓN */
    return `<div class="form-group m-form__group row">
                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Tipo de documento *</label>                        
                    <select name="integrantes[${member}][documentTypeMember]" class="form-control m-input">
                        ${ typeDocument.map( obj => { return `<option value="${ obj.id }">${ obj.document }</option>` } ).join(' ') }
                    </select>
                    <span class="m-form__help">Por favor seleccione una opción.</span>
                </div>

                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Nº de indentificación *</label>
                    <input type="num" name="integrantes[${member}][identificationMember]" class="form-control m-input" placeholder="" value="">                        
                    <span class="m-form__help">Por favor ingrese el número de indentificación</span>
                </div>
            </div> `;
}

function addViewLocationMembers(member, tipo) { /* DEPARTAMENTO EXPED Y MUNICIPIO DE EXPEDI */
    let tipoSelect = (tipo) ? 'expedición' : 'nacimiento';

    return `<div class="form-group m-form__group row">
                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Departamento de ${ tipoSelect } *</label>
                    <select onchange="eventOnChangeDepartamentos(this, ${ tipo }, ${ member })" id="select-control-departamentos-${ tipo }-${ member }" 
                        name="integrantes[${member}][departamento_${ tipoSelect }_member]" class="form-control m-input">
                        <option value="-1">Seleccione departamento</option>
                        ${ departamentos.map( dep => { return `<option value="${ dep.id }">${ dep.descripcion }</option>`; } ).join(' ') }
                    </select>
                    <span class="m-form__help">Por favor seleccione una opción.</span>
                </div>

                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Municipio de ${ tipoSelect } *</label>
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
                <div class="col-lg-6 m-form__group-sub">
                    <label for="">Pdf Cédula</label>
                    <div class="m-dropzone pdf_cedula_dropzone m-dropzone--success"
                        action="inc/api/dropzone/upload.php" id="m-dropzone-three">
                        <div class="m-dropzone__msg dz-message needsclick">
                            <h3 class="m-dropzone__msg-title">Subir documento de identificación</h3>
                            <span class="m-dropzone__msg-desc">Arrastra, o has click aqui para subir</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 m-form__group-sub">
                    <label class="form-control-label">Rol artistico</label>
                    <input type="num" name="integrantes[${member}][rolMember]" class="form-control m-input" placeholder="" value="">                        
                    <span class="m-form__help">Ingrese el rol que desempeña dentro del grupo (Guitarrista, Bocalista, Pianosta, etc.)</span>
                </div>
            </div>`;
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

    /* validar selects  */
    //validateFormSelect('aspirante', 'documentType'); 
    validateFormSelect('aspirante', '[departamentoExpedida]'); 
    validateFormSelect('aspirante', '[municipioExpedida]');
    validateFormSelect('aspirante', '[departamentoNacimiento]');
    validateFormSelect('aspirante', '[municipioNacimiento]');

    if (lineaConvocatoria === '1' &&  actuaraComo === '1') {
        validate = validateAspirante();
    } else if (lineaConvocatoria === '1' &&  actuaraComo === '2') {
        console.log('validar con beneficiario');
        /* validar inputs */
        validateFormInputs('beneficiario', 'name');
        validateFormInputs('beneficiario', 'lastname');
        validateFormInputs('beneficiario', 'secondLastname'); 
        validateFormInputs('beneficiario', 'phone'); 
        validateFormInputs('beneficiario', 'identificacion'); 
        validateFormInputs('beneficiario', 'address'); 
        validateFormInputs('beneficiario', 'birthdate'); 

        /* validar selects  */
        //validateFormSelect('beneficiario', 'documentType');   
        validateFormSelect('beneficiario', '[departamentoExpedida]'); 
        validateFormSelect('beneficiario', '[municipioExpedida]');
        validateFormSelect('beneficiario', '[departamentoNacimiento]');
        validateFormSelect('beneficiario', '[municipioNacimiento]');

        if (validateAspirante() && validateBeneficiario()) validate = true;
    } else {
        validate = validateAspirante();
        // falata validar el grupo
    }
    
    console.log('antes::: ', validate)    
    if (validateTermsCondition() && validate) validate = true;
    console.log('despues::: ', validate)

    //return validate;
    return false;
}

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

const validateBeneficiario = () => {
    if (fieldsInputs.beneficiario_name && fieldsInputs.beneficiario_lastname && fieldsInputs.beneficiario_secondLastname
        && fieldsInputs.beneficiario_phone && fieldsInputs.beneficiario_identificacion && fieldsInputs.beneficiario_address 
        && fieldsInputs.beneficiario_departamentoExpedida && fieldsInputs.beneficiario_municipioExpedida 
        && fieldsInputs.beneficiario_departamentoNacimiento && fieldsInputs.beneficiario_municipioNacimiento) {
        return true;
    }
    
    return false
}

/* funcion que realiza las validaciones segun el campo input */
const validateFormInputs = (tipo, targetName) => {  
    switch (`${ tipo }[${ targetName }]`) {
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
    }
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
    console.log('llega:: ', input, campo)
    if ($(`select[name='${ input }']`).val() == null || $(`select[name='${ input }']`).val() === '-1' 
        || $(`select[name='${ input }']`).val() === '' || $(`select[name='${ input }']`).val() === 'undefined'){  
            console.log('llega:: if')
        $(`#content-${ campo }`).addClass('has-danger');
        $(`#error-${ campo }`).show();
        $(`#error-${ campo }`).html(messages.required);
        fieldsInputs[campo] = false;
    } else {
        console.log('llega:: else')
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

/* evento onkeyup de los inputs beneficiario */
$("input[name='beneficiario[name]']").keyup( () => validateFormInputs('beneficiario', 'name') );
$("input[name='beneficiario[lastname]']").keyup( () => validateFormInputs('beneficiario', 'lastname') );
$("input[name='beneficiario[secondLastname]']").keyup( () => validateFormInputs('beneficiario', 'secondLastname') );
$("input[name='beneficiario[phone]']").keyup( () => validateFormInputs('beneficiario', 'phone') );
$("input[name='beneficiario[identificacion]']").keyup( () => validateFormInputs('beneficiario', 'identificacion') );
$("input[name='beneficiario[address]']").keyup( () => validateFormInputs('beneficiario', 'address') );
$("input[name='beneficiario[birthdate]']").change( () => validateFormInputs('beneficiario', 'birthdate') );

$("input[name='acceptTermsConditions']").change( () => validateTermsCondition() );
