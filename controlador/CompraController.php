<?php 

include "../modelo/Venta.php";

include_once "../modelo/Conexion.php";

$venta = new Venta();

session_start();

$vendedor = $_SESSION["usuario"]; /* ID del usuario Logueado */

if ($_POST["funcion"] == "registrar_compra") {

    $total = $_POST["total"];

    $nombre = $_POST["nombre"];

    $dni = $_POST["dni"];

    $productos = json_decode($_POST["json"]);

    date_default_timezone_set("America/La_Paz");

    $fecha = date("Y-m-d H:i:s");

    $venta -> Crear($nombre, $dni, $total, $fecha, $vendedor);

    $venta -> ultima_venta();

    foreach ($venta -> objetos as $objeto) {

        $id_venta = $objeto -> ultima_venta;

        echo $id_venta;

    }

    try {

        $db = new Conexion();

        $conexion = $db->pdo;

        $conexion->beginTransaction();

        
       
    } catch (Exception $error) {

        $conexion->rollBack();
        
        echo $error->getMessage();

    }
    
}