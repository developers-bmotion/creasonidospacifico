function  guardarDatos(){
    console.log('hola bebe');
    var data = {
        nombre: $('#name_prueba').val(),
        apellidos: $('#last_name_prueba').val(),
        email: $('#email_prueba').val()
    };

    localStorage.setItem('datos', JSON.stringify(data));
}





