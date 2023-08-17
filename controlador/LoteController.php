<?php 

    include_once "../modelo/Lote.php";

    $lote = new Lote();

    if ($_POST["funcion"] == "crear") {
        $id_producto = $_POST["id_producto"];
        $proveedor = $_POST["proveedor"];
        $stock = $_POST["stock"];
        $vencimiento = $_POST["vencimiento"];
        $lote -> crear($id_producto, $proveedor, $stock, $vencimiento);
    }

    if ($_POST["funcion"] == "buscar") {
        $lote -> buscar();
        $json = array();
        foreach ($lote -> objetos as $objeto) {
            $json[] = array(
                "id" => $objeto -> id_lote,
                "stock" => $objeto -> stock,
                "vencimiento" => $objeto -> vencimiento,
                "concentracion" => $objeto -> concentracion,
                "adicional" => $objeto -> adicional,
                "nombre" => $objeto -> prod_nom,
                "laboratorio" => $objeto -> lab_nom,
                "tipo" => $objeto -> tip_nom,
                "presentacion" => $objeto -> pre_nom,
                "proveedor" => $objeto -> proveedor,
                "avatar" => "../img/prod/" . $objeto -> logo
            );
        }

        $jsonstring = json_encode($json);
        echo $jsonstring; 
    }