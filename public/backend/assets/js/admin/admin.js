$("#cancelar_abono").click(function(){


    $('#realizar-abono').hide('blind');


});

$("#mostrar_managements_asignados").click(function(){
    $('#show_assign_list_management').show('fold');
    $('html,body').animate({
            scrollTop: $('#show_assign_list_management').offset().top},
        'slow');

});

$("#ocultar_historial").click(function(){


    $('#show_assign_list_management').hide('blind');

});