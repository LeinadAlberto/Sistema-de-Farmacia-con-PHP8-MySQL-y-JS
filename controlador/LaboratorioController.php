<?php 

    include_once "../modelo/Laboratorio.php";

    $laboratorio = new Laboratorio();

    if ($_POST["funcion"] == "crear") {
        $nombre = $_POST["nombre_laboratorio"];
        $avatar = "lab_default.png";
        $laboratorio -> crear($nombre, $avatar);
    }

    if ($_POST["funcion"] == "buscar") { 
        $laboratorio -> buscar();
        $json = array();
        foreach ($laboratorio -> objetos as $objeto) {
            $json[] = array(
                "id" => $objeto -> id_laboratorio,
                "nombre" => $objeto -> nombre,
                "avatar" => "../img/lab/" . $objeto -> avatar
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

    if ($_POST["funcion"] == "cambiar_logo") {
        $id = $_POST["id_logo_lab"];
        /* Valida que el archivo solo sea una imagen de tipo jpeg, png o gif. */
        if (($_FILES["photo"]["type"] == "image/jpeg") || ($_FILES["photo"]["type"] == "image/png") || ($_FILES["photo"]["type"] == "image/gif")) {
            $nombre = uniqid() . "-" . $_FILES["photo"]["name"]; /* Obtiene el nombre de la imágen y le concatena un valor unico. */
            $ruta = "../img/lab/" . $nombre;
            move_uploaded_file($_FILES["photo"]["tmp_name"], $ruta); /* Mueve la foto en la ruta definida para ser almacenada */
            
            /* Envia al modelo para cambiar logo */
            $laboratorio -> cambiar_logo($id, $nombre);
            
            foreach ($laboratorio -> objetos as $objeto) {
                if ($objeto -> avatar != "lab_default.png") {
                    /* Eliminamos el antiguo logo */
                    unlink("../img/lab/" . $objeto -> avatar); // Borra un fichero, como parametro la ruta del fichero.
                }
            }

            $json = array();
            $json[] = array(
                "ruta" => $ruta, /* Ruta de la nueva imágen para ser enviada a la vista */
                "alert" => "edit" /* Mensaje de alerta para ser enviada a la vista */
            );
            $jsonstring = json_encode($json[0]);
            echo $jsonstring;
        } else {
            $json = array();
            $json[] = array(
                "alert" => "noedit"
            );
            $jsonstring = json_encode($json[0]);
            echo $jsonstring;
        }   
    }