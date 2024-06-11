<?php 

    session_start();
    
    if ($_SESSION["us_tipo"] == 3 || $_SESSION["us_tipo"] == 1) {

        include_once "layouts/header.php";
?>

    <title>Gestión Ventas</title>
        
<?php include_once "layouts/nav.php"; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión Ventas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="adm_catalogo.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Gestión Ventas</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section><!-- /.content-header -->

    <section>
        <div class="container-fluid">
            <card class="card card-info">
                <div class="card-header">
                    <h3 class="card-title mb-2">Buscar Ventas</h3>
                    
                </div><!-- /.card-header -->

                <div class="card-body">
                    <table id="tabla_venta" class="display table table-hover text-nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>DNI</th>
                                <th>Total</th>
                                <th>Vendedor</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
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

<!-- JS para uso de libreria DataTables -->
<script src="../js/datatables.js"></script>

<script src="../js/Venta.js"></script>