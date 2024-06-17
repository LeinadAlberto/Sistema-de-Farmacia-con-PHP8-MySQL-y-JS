<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Login</title>

        <!-- Google Fonts - Poppins 700 -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
        
        <!-- Font Awesome Free 6.4.0 - CSS  -->
        <link rel="stylesheet" href="css/css/all.min.css"> 

        <!-- Custom CSS -->
        <link rel="stylesheet" href="css/style.css"> 
    </head>

<?php 
    session_start();

    if (!empty($_SESSION["us_tipo"])) { 
        /* Si existe una sesión iniciada lo redirigimos al controlador */
        header("Location: controlador/LoginController.php");
    } else { 
        /* Si no existe una sesión iniciada muestra la vista login, para iniciar sesión. */
        session_destroy();
?>

    <body>

        <img class="wave" src="img/wave.png" alt="Imágen de olas">

        <div class="contenedor">
            <div class="img">
                <img src="img/bg.svg" alt="">
            </div>

            <div class="contenido-login">

                <form action="controlador/LoginController.php" method="post">
                    <img src="img/logo.png" alt="Imágen de un logo">

                    <h2>Farmacia</h2>

                    <!-- DNI -->
                    <div class="input-div dni">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>

                        <div class="div">
                            <h5>DNI</h5>
                            <input class="input" type="text" name="user">
                        </div>
                    </div><!-- /.input-div -->

                    <!-- PASSWORD -->
                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>

                        <div class="div">
                            <h5>Contraseña</h5>
                            <input class="input" type="password" name="pass">
                        </div>    
                    </div><!-- /.input-div -->

                    <a href="">Created Warpiece</a>

                    <input type="submit" class="btn" value="Iniciar Sesión">
                </form>
                
            </div><!-- /.contenido-login -->

        </div><!-- /.contenedor -->

        <script src="js/login.js"></script>
    </body>
   
</html>

<?php 
    } //Close else 
?>