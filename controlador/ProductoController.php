<?php 

    include_once "../modelo/Producto.php";

    $producto = new Producto();

    if ($_POST["funcion"] == "crear") {

        $nombre = $_POST["nombre"];
        $concentracion = $_POST["concentracion"];
        $adicional = $_POST["adicional"];
        $precio = $_POST["precio"];
        $laboratorio = $_POST["laboratorio"];
        $tipo = $_POST["tipo"];
        $presentacion = $_POST["presentacion"];
        $avatar = "prod_default.png";

        $producto -> crear($nombre, $concentracion, $adicional, $precio, $laboratorio, $tipo, $presentacion, $avatar);
    }

    if ($_POST["funcion"] == "buscar") {

        $producto -> buscar();

        $json = array();

        foreach ($producto -> objetos as $objeto) {

            $producto -> obtener_stock($objeto -> id_producto);

            foreach ($producto -> objetos as $obj) {
                $total = $obj -> total;
            }

            $json[] = array(
                "id" => $objeto -> id_producto,
                "nombre" => $objeto -> nombre,
                "concentracion" => $objeto -> concentracion,
                "adicional" => $objeto -> adicional,
                "precio" => $objeto -> precio,
                "stock" => $total,
                "laboratorio" => $objeto -> laboratorio,
                "tipo" => $objeto -> tipo,
                "presentacion" => $objeto -> presentacion,
                "laboratorio_id" => $objeto -> prod_lab,
                "tipo_id" => $objeto -> prod_tip_prod,
                "presentacion_id" => $objeto -> prod_present,
                "avatar" => "../img/prod/" . $objeto -> avatar,
            );
        }

        $jsonstring = json_encode($json);
        
        echo $jsonstring;
    }

    if ($_POST["funcion"] == "cambiar_avatar") {

        $id = $_POST["id_logo_prod"];

        $avatar = $_POST["avatar"]; /* Obtenemos la ruta del avatar actual del Producto */
        
        /* Valida que el archivo solo sea una imagen de tipo jpeg, png o gif. */
        if (($_FILES["photo"]["type"] == "image/jpeg") || ($_FILES["photo"]["type"] == "image/png") || ($_FILES["photo"]["type"] == "image/gif")) {

            $nombre = uniqid() . "-" . $_FILES["photo"]["name"]; /* Obtiene el nombre de la imágen y le concatena un valor unico. */
            
            $ruta = "../img/prod/" . $nombre;
            
            move_uploaded_file($_FILES["photo"]["tmp_name"], $ruta); /* Mueve la foto en la ruta definida para ser almacenada */
            
            /* Envia al modelo para cambiar avatar */
            $producto -> cambiar_logo($id, $nombre);
        
            if ($avatar != "../img/prod/prod_default.png") { /* La condición evita que se borre la imágen por defecto */
                /* Elimina el antiguo avatar */
                unlink($avatar); // Borra un fichero, como parametro la ruta del fichero.
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

    if ($_POST["funcion"] == "editar") {

        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $concentracion = $_POST["concentracion"];
        $adicional = $_POST["adicional"];
        $precio = $_POST["precio"];
        $laboratorio = $_POST["laboratorio"];
        $tipo = $_POST["tipo"];
        $presentacion = $_POST["presentacion"];
        
        $producto -> editar($id, $nombre, $concentracion, $adicional, $precio, $laboratorio, $tipo, $presentacion);
        
    }

    if ($_POST["funcion"] == "borrar") {

        $id = $_POST["id"];

        $producto -> borrar($id);
        
    }

    /* Obtiene los datos de un producto mediante su id */
    if ($_POST["funcion"] == "buscar_id") {

        $id = $_POST["id_producto"];

        $producto -> buscar_id($id);

        $json = array();

        foreach ($producto -> objetos as $objeto) {

            $producto -> obtener_stock($objeto -> id_producto);

            foreach ($producto -> objetos as $obj) {

                $total = $obj -> total;

            }

            $json[] = array(
                "id" => $objeto -> id_producto,
                "nombre" => $objeto -> nombre,
                "concentracion" => $objeto -> concentracion,
                "adicional" => $objeto -> adicional,
                "precio" => $objeto -> precio,
                "stock" => $total,
                "laboratorio" => $objeto -> laboratorio,
                "tipo" => $objeto -> tipo,
                "presentacion" => $objeto -> presentacion,
                "laboratorio_id" => $objeto -> prod_lab,
                "tipo_id" => $objeto -> prod_tip_prod,
                "presentacion_id" => $objeto -> prod_present,
                "avatar" => "../img/prod/" . $objeto -> avatar,
            );

        }

        $jsonstring = json_encode($json[0]); /* Solo se esta retornando un registro por petición */

        echo $jsonstring;
        
    }

    if ($_POST["funcion"] == "traer_productos") {
        $html = "";

        /* json_decode : Función PHP que se utiliza para decodificar una cadena JSON
        y convertirla en un objeto o array de PHP. */
        $productos = json_decode($_POST["productos"]);
        /* print_r($productos); */
        /* var_dump($productos); */
        /* echo $productos[0] -> adicional;  Forma de acceder a la propiedad adicional del objeto en la posición 0 del array.*/
        foreach ($productos as $resultado) {
            $producto -> buscar_id($resultado -> id);
            /* print_r($producto); */
            /* echo $producto->objetos[0]->concentracion; Objeto que tiene una propiedad que se llama objetos, que a la vez almacena un array de objetos. */
            foreach ($producto -> objetos as $objeto) {
                $subtotal = $objeto -> precio * $resultado -> cantidad;
                /* print_r($objeto); */
                $producto -> obtener_stock($objeto -> id_producto); 
                /* echo ($objeto -> id_producto); */
                /* print_r($producto); */
                foreach ($producto -> objetos as $obj) {
                    $stock = $obj -> total;
                }
                $html .= "
                    <tr prodId='$objeto->id_producto' prodPrecio='$objeto->precio'>
                        <td>$objeto->nombre</td>
                        <td>$stock</td>
                        <td class='precio'>$objeto->precio</td>
                        <td>$objeto->concentracion</td>
                        <td>$objeto->adicional</td>
                        <td>$objeto->laboratorio</td>
                        <td>$objeto->presentacion</td>
                        <td>
                            <input type='number' min='1' class='form-control cantidad_producto' value='$resultado->cantidad'>
                        </td>
                        <td class='subtotales'>
                            <h5>$subtotal</h5>
                        </td>

                        <td><button class='borrar-producto btn btn-danger'><i class='fas fa-times-circle'></i></button></td>
                    </tr>
                "; 
            }  
        } 
        echo $html;
        /* print_r($producto); */
    }