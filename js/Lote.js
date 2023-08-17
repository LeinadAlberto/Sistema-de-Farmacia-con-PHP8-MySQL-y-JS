$(document).ready(function() {
    var funcion = '';
    buscar_lote();

    function buscar_lote(consulta) {
        funcion = "buscar";
        $.post("../controlador/LoteController.php", {consulta, funcion}, (response) => {
            const lotes = JSON.parse(response);
            let template = ``;
            lotes.forEach(lote => {
                template += `
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0 mb-2">
                            <i class="text-info fas fa-lg fa-cubes mr-1"></i>${lote.stock}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>${lote.nombre}</b></h2> 
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <hr class="mt-1 mb-1 bg-info">
                                        <li class="small"><span class="fa-li"><i class="text-info fas fa-lg fa-mortar-pestle mr-1"></i></span> <b>Concentración:</b> ${lote.concentracion}</li>
                                        <hr class="mt-1 mb-1 bg-info">
                                        <li class="small"><span class="fa-li"><i class="text-info fas fa-lg fa-prescription-bottle-alt mr-1"></i></span> <b>Adicional:</b> ${lote.adicional}</li>
                                        <hr class="mt-1 mb-1 bg-info">
                                        <li class="small"><span class="fa-li"><i class="text-info fas fa-lg fa-flask mr-1"></i></span> <b>Laboratorio:</b> ${lote.laboratorio}</li>
                                        <hr class="mt-1 mb-1 bg-info">
                                        <li class="small"><span class="fa-li"><i class="text-info fas fa-lg fa-copyright mr-1"></i></span> <b>Tipo:</b> ${lote.tipo}</li>
                                        <hr class="mt-1 mb-1 bg-info">
                                        <li class="small"><span class="fa-li"><i class="text-info fas fa-lg fa-pills mr-1"></i></span> <b>Presentación:</b> ${lote.presentacion}</li>
                                        <hr class="mt-1 mb-1 bg-info">
                                        <li class="small"><span class="fa-li"><i class="text-info fas fa-lg fa-calendar-times mr-1"></i></span> <b>Vencimiento:</b> ${lote.vencimiento}</li>
                                        <hr class="mt-1 mb-1 bg-info">
                                        <li class="small"><span class="fa-li"><i class="text-info fas fa-lg fa-truck mr-1"></i></span> <b>Proveedor:</b> ${lote.proveedor}</li>
                                        <hr class="mt-1 mb-1 bg-info">
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="${lote.avatar}" alt="" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <button class="avatar btn btn-sm bg-teal mr-1" type="button" data-toggle="modal" data-target="#cambiologo">
                                    <i class="fas fa-image"></i>
                                </button>
                                <button class="editar btn btn-sm btn-success mr-1" type="button" data-toggle="modal" data-target="#crearproducto">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="lote btn btn-sm btn-primary mr-1" type="button" data-toggle="modal" data-target="#crearlote">
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
            $('#lotes').html(template);
            
        });
    }

    $(document).on('keyup', '#buscar-lote', function() {
        let valor = $(this).val(); 
        console.log(valor);
        if (valor != '') {
            buscar_lote(valor);
        } else {
            buscar_lote();
        } 
    });

});