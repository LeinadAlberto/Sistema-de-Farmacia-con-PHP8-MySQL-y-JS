<?php 

include_once "../modelo/Usuario.php";

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

$usuario = new Usuario();

if ($_POST["funcion"] == "recuperar") {

    $email = $_POST["email"];

    $dni = $_POST["dni"];

    $codigo = generar(5);

    $usuario -> remplazar($codigo, $email, $dni);

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        /* $mail->SMTPDebug = SMTP::DEBUG_SERVER; */                      //Enable verbose debug output
        /* $mail->SMTPDebug = 0; */
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        /* $mail->Username   = 'user@example.com'; */                     //SMTP username
        $mail->Username   = 'correo_origen@gmail.com';
        /* $mail->Password   = 'secret';   */                             //SMTP password
        $mail->Password   = 'contraseña_generada_por_google';
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('correo_origen@gmail.com', 'Sistema Administrativo');
        $mail->addAddress($email);     //Add a recipient
        //$mail->addAddress('ellen@example.com');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Restablecer contraseña';
        $mail->Body    = 'La nueva contraseña es: <b>' . $codigo . '</b>';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->SMTPDebug = false;
        $mail->do_debug = false;
        $mail->send();
        echo 'enviado';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}

if ($_POST["funcion"] == "verificar") {

    $dni = $_POST["dni"];

    $email = $_POST["email"];

    $usuario -> verificar($dni, $email); 

}

function generar($longitud) {

    $key = "";

    $patron = "1234567890abcdefghijklmnopqrstuvwxyz";

    $max = strlen($patron) - 1;

    for ($i = 0; $i < $longitud; $i++) {

        $key .= $patron[mt_rand(0, $max)];

    }

    return $key;

}