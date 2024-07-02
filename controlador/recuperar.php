<?php 

include_once "../modelo/Usuario.php";

$usuario = new Usuario();

if ($_POST["funcion"] == "verificar") {

    $dni = $_POST["dni"];

    $email = $_POST["email"];

    $usuario -> verificar($dni, $email); 

}

if ($_POST["funcion"] == "recuperar") {

    $email = $_POST["email"];

    $dni = $_POST["dni"];

    $codigo = generar(5);

    $usuario -> remplazar($codigo, $email, $dni);

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