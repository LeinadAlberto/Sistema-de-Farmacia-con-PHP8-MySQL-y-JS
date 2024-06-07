<?php 
    session_start();

    /* Si Usuario es Técnico se le proporciona la vista para Técnico */
    if ($_SESSION["us_tipo"] == 2) {

?>

    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Tecnico</title>
        </head>
        <body>
            <h1>Hola Tecnico</h1>
            <a href="../controlador/Logout.php">Cerrar Sesión</a>
        </body>
    </html>

<?php 
    } else {
        /* Si Usuario no es Técnico, se lo redirecciona al Login*/
        header ("Location: ../index.php");
    }
?> 