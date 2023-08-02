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
            const productos = JSON.parse(response);
            let template = ``;
            productos.forEach(producto => {
                template += `
                    <div prodId="${producto.id}" 
                        prodNombre="${producto.nombre}" 
                        prodConcentracion="${producto.concentracion}" 
                        prodAdicional="${producto.adicional}" 
                        prodPrecio="${producto.precio}" 
                        prodStock="${producto.stock}" 
                        prodLaboratorio="${producto.laboratorio}"
                        prodTipo="${producto.tipo}"
                        prodPresentacion="${producto.presentacion}"
                        prodAvatar="${producto.avatar}"
                        class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0 mb-2">
                            <i class="text-info fas fa-lg fa-cubes mr-1"></i>${producto.stock}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>${producto.nombre}</b></h2>
                                    <h4 class="lead"><b><i class="text-info fas fa-lg fa-dollar-sign mr-1"></i>${producto.precio} Bs.</b></h4> 
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <hr class="mt-1 mb-1 bg-info">
                                        <li class="small"><span class="fa-li"><i class="text-info fas fa-lg fa-mortar-pestle mr-1"></i></span> <b>Concentración:</b> ${producto.concentracion}</li>
                                        <hr class="mt-1 mb-1 bg-info">
                                        <li class="small"><span class="fa-li"><i class="text-info fas fa-lg fa-prescription-bottle-alt mr-1"></i></span> <b>Adicional:</b> ${producto.adicional}</li>
                                        <hr class="mt-1 mb-1 bg-info">
                                        <li class="small"><span class="fa-li"><i class="text-info fas fa-lg fa-flask mr-1"></i></span> <b>Laboratorio:</b> ${producto.laboratorio}</li>
                                        <hr class="mt-1 mb-1 bg-info">
                                        <li class="small"><span class="fa-li"><i class="text-info fas fa-lg fa-copyright mr-1"></i></span> <b>Tipo:</b> ${producto.tipo}</li>
                                        <hr class="mt-1 mb-1 bg-info">
                                        <li class="small"><span class="fa-li"><i class="text-info fas fa-lg fa-pills mr-1"></i></span> <b>Presentación:</b> ${producto.presentacion}</li>
                                        <hr class="mt-1 mb-1 bg-info">
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="${producto.avatar}" alt="" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <button class="avatar btn btn-sm bg-teal mr-1">
                                    <i class="fas fa-image"></i>
                                </button>
                                <button class="editar btn btn-sm btn-success mr-1">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="lote btn btn-sm btn-primary mr-1">
                                    <i class="fas fa-plus-square"></i>
                                </button>
                                <button class="borrar btn btn-sm btn-danger mr-1">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    </div>
                `;
            });
            $('#productos').html(template);
            
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

    $(document).on('click', '.avatar', (e) => {
        funcion = 'cambiar_avatar';
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        console.log(elemento);
        const id = $(elemento).attr('prodId');
        const avatar = $(elemento).attr('prodAvatar');
        console.log(`${id} - ${avatar}`); 
    });

});