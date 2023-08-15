$(document).ready(function() {

    var funcion;
    buscar_prov();

    $('#form-crear').submit(e => {
        let nombre = $('#nombre').val();
        let telefono = $('#telefono').val();
        let correo = $('#correo').val();
        let direccion = $('#direccion').val();
        funcion = 'crear';
        $.post('../controlador/ProveedorController.php', {funcion, nombre, telefono, correo, direccion}, (response) => {
            if (response == "add") {
                $('#add-prov').hide('slow');
                $('#add-prov').show(1200);
                $('#add-prov').hide(1700);
                $('#form-crear').trigger('reset');
                /* buscar_lab(); */
            }
            if (response == "noadd") {
                $('#noadd-prov').hide('slow');
                $('#noadd-prov').show(1200);
                $('#noadd-prov').hide(1700);
                $('#form-crear').trigger('reset');
                /* buscar_lab(); */
            }  
        });
        e.preventDefault();
    });

    function buscar_prov(consulta) {
        funcion = 'buscar';
        $.post('../controlador/ProveedorController.php', {funcion, consulta}, (response) => {
            console.log(response);
        });
    }

    $(document).on('keyup', '#buscar_proveedor', function() {
        let valor = $(this).val();
        if (valor != '') {
            buscar_prov(valor);
        } else {
            buscar_prov();
        }
    });

});