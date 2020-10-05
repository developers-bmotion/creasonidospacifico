function start(){
    let telefonos = $(".activarTelefono");
    telefonos.each(function (){
        let numeroInicial = $(this).attr("value");
        let id = $(this).attr("id");
        let name = $(this).attr("name");
        let cambioNumero = getNumero(id);

        $(this).parent()
        .append(`<input type="hidden" name="${name}" id="${id}_hidden" >`);
        $(this).attr("name", name+"original");
        $(this).change(function (){
            let number = cambioNumero.getNumber();
            cambioNumero._updateValFromNumber(number);
            $("#"+id+"_hidden").val(number);
        });

        cambioNumero._updateValFromNumber(numeroInicial);
        $("#"+id+"_hidden").val(numeroInicial);
    });
}

function getNumero(id){
    let i = 0;
    while(i<100){
        let element = intlTelInputGlobals.instances[i];
        if (element.telInput.id === id){
            return element;
        }
        i++;
    }
    return false;
}

start();
