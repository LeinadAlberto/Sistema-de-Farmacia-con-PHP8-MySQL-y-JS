<?php 
    session_start();

    if ($_SESSION["us_tipo"] == 1 || $_SESSION["us_tipo"] == 3) {

        include_once "layouts/header.php";
?>

    <title>Gestión Atributo</title>

    <?php include_once "layouts/nav.php"; ?>

    <!-- Modal para Crear Laboratorio -->
    <div class="modal fade" id="crearlaboratorio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear laboratorio</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <!-- Mensajes de Alerta -->
                        <div class="alert alert-success text-center" id="add-laboratorio" style="display:none;">
                            <span><i class="fas fa-thumbs-up m-1"></i> Laboratorio registrado con exito</span>
                        </div>

                        <div class="alert alert-danger text-center" id="noadd-laboratorio" style="display:none;">
                            <span><i class="fas fa-exclamation-triangle m-1"></i> <b>El Laboratorio ya existe</b></span>
                        </div>
                        <!-- Fin Mensajes de Alerta -->

                        <form id="form-crear-laboratorio">
                            <div class="form-group">
                                <label for="nombre-laboratorio">Nombre</label>
                                <input id="nombre-laboratorio" type="text" class="form-control" placeholder="Ingrese nombre" required>
                            </div>
                    </div><!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-1">Crear</button>
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                        </form>
                    </div><!-- /.card-footer -->
                </div><!-- /.card -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Modal para Crear Tipo -->
    <div class="modal fade" id="creartipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear tipo</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <!-- Mensajes de Alerta -->
                        <div class="alert alert-success text-center" id="add" style="display:none;">
                            <span><i class="fas fa-thumbs-up m-1"></i> Usuario registrado con exito</span>
                        </div>

                        <div class="alert alert-danger text-center" id="noadd" style="display:none;">
                            <span><i class="fas fa-exclamation-triangle m-1"></i> <b>El DNI ya existe en otro Usuario</b></span>
                        </div>
                        <!-- Fin Mensajes de Alerta -->

                        <form id="form-crear-tipo">
                            <div class="form-group">
                                <label for="nombre-tipo">Nombre</label>
                                <input id="nombre-tipo" type="text" class="form-control" placeholder="Ingrese nombre" required>
                            </div>
                    </div><!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-1">Crear</button>
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                        </form>
                    </div><!-- /.card-footer -->
                </div><!-- /.card -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Modal para Crear Presentación -->
    <div class="modal fade" id="crearpresentacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear presentación</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <!-- Mensajes de Alerta -->
                        <div class="alert alert-success text-center" id="add" style="display:none;">
                            <span><i class="fas fa-thumbs-up m-1"></i> Usuario registrado con exito</span>
                        </div>

                        <div class="alert alert-danger text-center" id="noadd" style="display:none;">
                            <span><i class="fas fa-exclamation-triangle m-1"></i> <b>El DNI ya existe en otro Usuario</b></span>
                        </div>
                        <!-- Fin Mensajes de Alerta -->

                        <form id="form-crear-presentacion">
                            <div class="form-group">
                                <label for="nombre-presentacion">Nombre</label>
                                <input id="nombre-presentacion" type="text" class="form-control" placeholder="Ingrese nombre" required>
                            </div>
                    </div><!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-1">Crear</button>
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
                        <h1>Gestión atributos</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestión atributo</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a href="#laboratorio" class="nav-link active" data-toggle="tab">
                                        Laboratorio
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tipo" class="nav-link" data-toggle="tab">
                                        Tipo
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#presentacion" class="nav-link" data-toggle="tab">
                                        Presentación
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->

                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Laboratorio -->
                                <div class="tab-pane active" id="laboratorio">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <div class="card-title">Buscar Laboratorio 
                                                <button type="button" data-toggle="modal" data-target="#crearlaboratorio" class="btn bg-gradient-primary btn-sm m-2">
                                                    Crear Laboratorio
                                                </button>
                                            </div><!-- /.card-title -->
                                            <div class="input-group">
                                                <input id="buscar-laboratorio" type="text" class="form-control float-left" placeholder="Ingrese nombre">
                                                <div class="input-group-append">
                                                    <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div><!-- /.input-group -->
                                        </div><!-- /.card-header -->

                                        <div class="card-body p-0">
                                            <table class="table table-over text-nowrap">
                                                <thead class="table-success">
                                                    <tr>
                                                        <th>Laboratorio</th>
                                                        <th>Logo</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-active" id="laboratorios">

                                                </tbody>
                                            </table>
                                        </div><!-- /.card-body -->

                                        <div class="card-footer">

                                        </div><!-- /.card-footer -->
                                    </div><!-- /.card -->
                                </div><!-- /.tab -->

                                <!-- Tipo -->
                                <div class="tab-pane" id="tipo">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <div class="card-title">Buscar Tipo 
                                                <button type="button" data-toggle="modal" data-target="#creartipo" class="btn bg-gradient-primary btn-sm m-2">
                                                    Crear Tipo
                                                </button>
                                            </div><!-- /.card-title -->
                                            <div class="input-group">
                                                <input id="buscar-tipo" type="text" class="form-control float-left" placeholder="Ingrese nombre">
                                                <div class="input-group-append">
                                                    <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div><!-- /.input-group -->
                                        </div><!-- /.card-header -->
                                        <div class="card-body"></div>
                                        <div class="card-footer"></div>
                                    </div><!-- /.card -->
                                </div><!-- /.tab -->

                                <!-- Presentación -->
                                <div class="tab-pane" id="presentacion">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <div class="card-title">Buscar Presentación 
                                                <button type="button" data-toggle="modal" data-target="#crearpresentacion" class="btn bg-gradient-primary btn-sm m-2">
                                                    Crear Presentación
                                                </button>
                                            </div><!-- /.card-title -->
                                            <div class="input-group">
                                                <input id="buscar-presentacion" type="text" class="form-control float-left" placeholder="Ingrese nombre">
                                                <div class="input-group-append">
                                                    <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div><!-- /.input-group -->
                                        </div><!-- /.card-header -->
                                        <div class="card-body"></div>
                                        <div class="card-footer"></div>
                                    </div><!-- /.card -->
                                </div><!-- /.tab -->
                            </div><!-- /.tab-content -->
                        </div><!-- /.card-body -->

                        <div class="card-footer">

                        </div><!-- /.card-footer -->
                    </div><!-- /.card -->
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

<?php 
        include_once "layouts/footer.php";

    } else { // Closed if

        header("Location: ../index.php");
        
    }  
?>

<script src="../js/Laboratorio.js"></script>
