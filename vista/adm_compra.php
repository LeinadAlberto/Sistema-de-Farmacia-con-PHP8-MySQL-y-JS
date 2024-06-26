<?php 
    session_start();

    if ($_SESSION["us_tipo"] == 1 || $_SESSION["us_tipo"] == 3 || $_SESSION["us_tipo"] == 2) {

        include_once "layouts/header.php";
?>

        <title>Adm | Compra</title>

        <?php include_once "layouts/nav.php"; ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1>Compra</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="adm_catalogo.php">Inicio</a></li>
                                <li class="breadcrumb-item active">Compra</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section><!-- /.content-header -->

            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                </div>

                                <div class="card-body p-0">
                                    <!-- Datos de la Compra -->
                                    <header>
                                        <div class="logo_cp">
                                            <img src="../img/logo.png" width="100" height="100">
                                        </div>
                                        <h1 class="titulo_cp">SOLICITUD DE COMPRA</h1>
                                        <div class="datos_cp">
                                            <!-- Cliente -->
                                            <div class="form-group row">
                                                <span>Cliente: </span>
                                                <div class="input-group-append col-md-6">
                                                    <input id="cliente" type="text" class="form-control" placeholder="Ingresa nombre">
                                                </div>
                                            </div>
                                            <!-- DNI -->
                                            <div class="form-group row">
                                                <span>DNI: </span>
                                                <div class="input-group-append col-md-6">
                                                    <input id="dni" type="number" class="form-control" placeholder="Ingresa DNI">
                                                </div>
                                            </div>
                                            <!-- Vendedor -->
                                            <div class="form-group row">
                                                <span>Vendedor: </span>
                                                <h3>usuario</h3>
                                            </div>
                                        </div><!-- /.datos_cp -->
                                    </header>

                                    <button id="actualizar" class="btn btn-success">Actualizar</button>

                                    <div id="cp" class="card-body p-0">
                                        <!-- Tabla de Productos -->
                                        <table class="compra table table-hover text-nowrap">
                                            <thead class='table-success'>
                                                <tr>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Stock</th>
                                                    <th scope="col">Precio</th>
                                                    <th scope="col">Concentración</th>
                                                    <th scope="col">Adicional</th>
                                                    <th scope="col">Laboratorio</th>
                                                    <th scope="col">Presentación</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Sub Total</th>
                                                    <th scope="col">Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody id="lista-compra" class='table-active'>
                                                
                                            </tbody>
                                        </table>

                                        <!-- Calculo 1 - Calculo 2 - Cambio -->
                                        <div class="row">
                                            <!-- Calculo 1 -->
                                            <div class="col-md-4">
                                                <div class="card card-default">
                                                    <div class="card-header">
                                                        <h3 class="card-title">
                                                            <i class="fas fa-dollar-sign"></i>
                                                            Calculo 1
                                                        </h3>
                                                    </div><!-- /.card-header -->

                                                    <div class="card-body">
                                                        <!-- SUB TOTAL -->
                                                        <div class="info-box mb-3 bg-warning p-0">
                                                            <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-left ">SUB TOTAL</span>
                                                                <span id="subtotal" class="info-box-number">10</span>
                                                            </div>
                                                        </div>
                                                        <!-- IGV -->
                                                        <div class="info-box mb-3 bg-warning">
                                                            <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-left ">IGV</span>
                                                                <span id="con_igv" class="info-box-number">2</span>
                                                            </div>
                                                        </div>
                                                        <!-- SIN DESCUENTO -->
                                                        <div class="info-box mb-3 bg-info">
                                                            <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-left ">SIN DESCUENTO</span>
                                                                <span id="total_sin_descuento" class="info-box-number">12</span>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.card-body -->
                                                </div><!-- /.card -->
                                            </div><!-- /.col-md-4 -->

                                            <!-- Calculo 2 -->
                                            <div class="col-md-4">
                                                <div class="card card-default">
                                                    <div class="card-header">
                                                        <h3 class="card-title">
                                                            <i class="fas fa-bullhorn"></i>
                                                            Calculo 2
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="info-box mb-3 bg-danger">
                                                            <span class="info-box-icon"><i class="fas fa-comment-dollar"></i></span>
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-left ">DESCUENTO</span>
                                                                <input id="descuento"type="number" min="1" placeholder="Ingrese descuento" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="info-box mb-3 bg-info">
                                                            <span class="info-box-icon"><i class="ion ion-ios-cart-outline"></i></span>
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-left ">TOTAL</span>
                                                                <span id="total" class="info-box-number">12</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- /.col-md-4 -->

                                            <!-- Cambio -->
                                            <div class="col-md-4">
                                                <div class="card card-default">
                                                    <div class="card-header">
                                                        <h3 class="card-title">
                                                            <i class="fas fa-cash-register"></i>
                                                            Cambio
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="info-box mb-3 bg-success">
                                                            <span class="info-box-icon"><i class="fas fa-money-bill-alt"></i></span>
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-left ">INGRESO</span>
                                                                <input id="pago" type="number" min="1" placeholder="Ingresa Dinero" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="info-box mb-3 bg-info">
                                                            <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                                                            <div class="info-box-content">
                                                                <span class="info-box-text text-left ">VUELTO</span>
                                                                <span id="vuelto" class="info-box-number">3</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- /.col-md-4 -->
                                        </div><!-- /.row -->
                                    </div><!-- /.card-body -->

                                    <!-- Botones: Seguir Comprando - Realizar Compra -->
                                    <div class="row justify-content-between">
                                        <div class="col-md-4 mb-2">
                                            <a href="../vista/adm_catalogo.php" class="btn btn-primary btn-block">Seguir comprando</a>
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <a type="number" id="procesar-compra" class="btn btn-success btn-block" >Realizar compra</a>
                                        </div>
                                    </div><!-- /.row -->

                                </div><!-- /.card-body -->
                            </div><!-- /.card -->
                        </div><!-- /.col-md-12 -->
                    </div><!-- /.row -->
                </div><!-- container-fluid -->
            </section>

        </div><!-- /.content-wrapper -->

<?php 
        include_once "layouts/footer.php";

    } else { // Closed if

        header("Location: ../index.php");
        
    }  
?>

<script src="../js/Carrito.js"></script>
