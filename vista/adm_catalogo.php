<?php 
    session_start();

    if ($_SESSION["us_tipo"] == 1 || $_SESSION["us_tipo"] == 3) {

        include_once "layouts/header.php";
?>

        <title>Adm | Catálogo</title>

        <?php include_once "layouts/nav.php"; ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1>Catálogo</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Catálogo</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section><!-- /.content-header -->

            <section>
                <div class="container-fluid">
                    <card class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Lotes en riesgo</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div><!-- /.card-header -->

                        <div class="card-body p-0 table-responsive">
                            <table class="table table-hover text-nowrap">
                                <thead class="table-success">
                                    <tr>
                                        <th>Cod</th>
                                        <th>Producto</th>
                                        <th>Stock</th>
                                        <th>Laboratorio</th>
                                        <th>Presentación</th>
                                        <th>Proveedor</th>
                                        <th>Mes</th>
                                        <th>Día</th>
                                    </tr>
                                </thead>
                                <tbody id="lotes" class="table-active">

                                </tbody>
                            </table>
                        </div><!-- /.card-body -->

                        <div class="card-footer">

                        </div><!-- /.card-footer -->
                    </card>
                </div>
            </section>

            <section>
                <div class="container-fluid">
                    <card class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title mb-2">Buscar producto</h3>
                            <div class="input-group">
                                <input id="buscar-producto" type="text" class="form-control float-left" placeholder="Ingrese nombre del producto...">
                                <div class="input-group-append">
                                    <button class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div> 
                        </div><!-- /.card-header -->

                        <div class="card-body">
                            <div id="productos" class="row d-flex align-items-stretch">

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

<script src="../js/Catalogo.js"></script>
<script src="../js/Carrito.js"></script>
