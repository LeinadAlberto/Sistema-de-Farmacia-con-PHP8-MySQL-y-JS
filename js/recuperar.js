$(document).ready(function() {

    $('#aviso1').hide();

    $('#aviso').hide();

    $('#form-recuperar').submit( e => {

        let email = $('#email-recuperar').val();

        let dni = $('#dni-recuperar').val();

        if (email == '' || dni == '') {

            $('#aviso').show();

            $('#aviso').text('Rellene todo los campos');

        } else {

            $('#aviso').hide();

            let funcion = 'verificar';

            $.post('../controlador/recuperar.php', { dni, email, funcion }, (response) => {

                if (response == 'encontrado') {

                    let funcion = 'recuperar';

                    $('#aviso').hide();

                    $.post('../controlador/recuperar.php', { funcion, email, dni }, (response2) => {

                        $('#aviso').hide();

                        $('aviso1').hide();

                        if (response2 == 'remplazado') {

                            $('#aviso1').show();

                            $('#aviso1').text('Se restablecio la contraseña');

                            $('#form-recuperar').trigger('reset');

                        } else {

                            $('#aviso').show();

                            $('#aviso').text('No se pudo reestablcer la contraseña');

                            $('#form-recuperar').trigger('reset');

                        }

                    });

                } else {

                    $('#aviso').hide();

                    $('aviso1').hide();

                    $('#aviso').show();

                    $('#aviso').text('El Correo Electrónico y DNI no se encuentran asociados o no estan registrados en el sistema');
                }

            });

        }

        e.preventDefault();
        
    });

});