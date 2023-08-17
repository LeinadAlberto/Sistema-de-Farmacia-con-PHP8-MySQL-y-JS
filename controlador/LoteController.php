<?php 
    date_default_timezone_set('America/La_Paz');
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
        $fecha_actual = new DateTime();
        foreach ($lote -> objetos as $objeto) {
            $vencimiento = new DateTime($objeto -> vencimiento);
            $diferencia = $vencimiento -> diff($fecha_actual);
            $mes = $diferencia -> m;
            $dia = $diferencia -> d;
            $verificado = $diferencia -> invert;
            if ($verificado == 0) {
                $estado = "danger";
                $mes = $mes * (-1);
                $dia = $dia * (-1);
            } else {
                if ($mes >= 3) {
                    $estado = "light";
                }
                if ($mes < 3) {
                    $estado = "warning";
                }
            }
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
                "avatar" => "../img/prod/" . $objeto -> logo,
                "mes" => $mes,
                "dia" => $dia,
                "estado" => $estado,
            );
        }

        $jsonstring = json_encode($json);
        echo $jsonstring; 
    }