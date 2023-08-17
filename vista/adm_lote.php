<?php 
    session_start();
    if ($_SESSION["us_tipo"] == 3) {

        include_once "layouts/header.php";
?>

    <title>Gestión Lote</title>
        
<?php include_once "layouts/nav.php"; ?>

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