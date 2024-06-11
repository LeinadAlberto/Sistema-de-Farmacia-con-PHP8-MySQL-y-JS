$(document).ready(function() {

    let funcion = 'listar';

    /* $.post('../controlador/VentaController.php', {funcion}, (response) => {

        console.log(JSON.parse(response));

    }); */

    new DataTable('#tabla_venta', {
        ajax: {
            'url' : '../controlador/VentaController.php',
            'method': 'POST',
            'data' : {funcion:funcion} 
        },
        columns: [
            { data: 'id_venta' },
            { data: 'fecha' },
            { data: 'cliente' },
            { data: 'dni' },
            { data: 'total' },
            { data: 'vendedor' }
        ]
    });

});