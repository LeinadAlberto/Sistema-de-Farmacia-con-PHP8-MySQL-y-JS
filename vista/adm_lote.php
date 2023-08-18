<?php 
    session_start();
    if ($_SESSION["us_tipo"] == 3) {

        include_once "layouts/header.php";
?>

    <title>Gestión Lote</title>
        
<?php include_once "layouts/nav.php"; ?>

<!-- Modal para Editar Lote -->
<div class="modal fade" id="editarlote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Editar Lote</h3>
                    <button data-dismiss="modal" aria-label="close" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div><!-- /.card-header -->

                <div class="card-body">
                    <!-- Mensajes de Alerta -->
                    <div class="alert alert-success text-center" id="edit-lote" style="display:none;">
                        <span><i class="fas fa-thumbs-up m-1"></i> Lote editado con exito</span>
                    </div>
                    <!-- Fin Mensajes de Alerta -->

                    <form id="form-editar-lote">
                        <div class="form-group">
                            <label>Código Lote: </label>
                            <span id="codigo_lote" class="ml-2 text-info"></span>
                        </div>
                        <!-- Stock -->
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input id="stock" type="number" class="form-control" placeholder="Ingrese stock" required>
                        </div>
                        <!-- ID del Producto -->
                        <input type="text" id="id_lote_prod">
                    
                </div><!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                    </form>
                </div><!-- /.card-footer -->
            </div><!-- /.card -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión lotes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
                        <li class="breadcrumb-item active">Gestión Lote</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section><!-- /.content-header -->

    <section>
        <div class="container-fluid">
            <card class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title mb-2">Buscar lote</h3>
                    <div class="input-group">
                        <input id="buscar-lote" type="text" class="form-control float-left" placeholder="Ingrese nombre del producto...">
                        <div class="input-group-append">
                            <button class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div> 
                </div><!-- /.card-header -->

                <div class="card-body">
                    <div id="lotes" class="row d-flex align-items-stretch">

                    </div>
                </div><!-- /.card-body -->

                <div class="card-footer">

                </div><!-- /.card-footer -->
            </card>
        </div>
    </section>
    
</div><!-- /.content-wrapper -->


<?php 
        include_once "layouts/footer.php";

    } else { // Closed if
        header("Location: ../index.php");
    }  
?>

<script src="../js/Lote.js"></script>