$(document).ready(function() {
    var funcion = '';

    $('.select2').select2();

    rellenar_laboratorios();
    rellenar_tipos();
    rellenar_presentaciones();
    buscar_producto();

    function rellenar_laboratorios() {
        funcion = 'rellenar_laboratorios';
        $.post("../controlador/LaboratorioController.php", {funcion}, (response) => {
            const laboratorios = JSON.parse(response);
            let template = ``;
            laboratorios.forEach(laboratorio => {
                template += `
                    <option value="${laboratorio.id}">${laboratorio.nombre}</option>
                `;
            });
            $('#laboratorio').html(template);
        });
    }

    function rellenar_tipos() {
        funcion = 'rellenar_tipos';
        $.post("../controlador/TipoController.php", {funcion}, (response) => {
            const tipos = JSON.parse(response);
            let template = ``;
            tipos.forEach(tipo => {
                template += `
                    <option value="${tipo.id}">${tipo.nombre}</option>
                `;
            });
            $('#tipo').html(template);
        });
    }

    function rellenar_presentaciones() {
        funcion = 'rellenar_presentaciones';
        $.post("../controlador/PresentacionController.php", {funcion}, (response) => {
            const presentaciones = JSON.parse(response);
            let template = ``;
            presentaciones.forEach(presentacion => {
                template += `
                    <option value="${presentacion.id}">${presentacion.nombre}</option>
                `;
            });
            $('#presentacion').html(template);
        });
    }

    $('#form-crear-producto').submit(e => {
        let nombre = $('#nombre_producto').val();
        let concentracion = $('#concentracion').val();
        let adicional = $('#adicional').val();
        let precio = $('#precio').val();
        let laboratorio = $('#laboratorio').val();
        let tipo = $('#tipo').val();
        let presentacion = $('#presentacion').val();

        funcion = "crear";
        $.post("../controlador/ProductoController.php", {nombre, concentracion, adicional, precio, laboratorio, tipo, presentacion, funcion}, (response) => {
            if (response == "add") {
                $('#add').hide('slow');
                $('#add').show(1200);
                $('#add').hide(1700);
                $('#form-crear-producto').trigger('reset');
            }  
            if (response == "noadd") {
                $('#noadd').hide('slow');
                $('#noadd').show(1200);
                $('#noadd').hide(1700);
                $('#form-crear-producto').trigger('reset');
            }
            buscar_producto();
        });

        e.preventDefault();    
    });

    function buscar_producto(consulta) {
        funcion = "buscar";
        $.post("../controlador/ProductoController.php", {consulta, funcion}, (response) => {
            console.log(response);
        });
    }

    $(document).on('keyup', '#buscar-producto', function() {
        let valor = $(this).val(); /* Almacena dentro la variable valor los datos que se ingresan dentro #buscar. */
        console.log(valor);
        if (valor != '') {
            buscar_producto(valor);
        } else {
            buscar_producto();
        } 
    });

});