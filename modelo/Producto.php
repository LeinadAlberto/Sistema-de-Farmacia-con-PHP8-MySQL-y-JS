<?php 

    include_once "Conexion.php";

    class Producto {

        var $objetos;

        public function __construct() {
            $db = new Conexion();
            $this -> acceso = $db -> pdo;
        }

        function crear($nombre, $concentracion, $adicional, $precio, $laboratorio, $tipo, $presentacion, $avatar) {
            /* Verifico primero si el nombre del producto ya existe en la Tabla producto de la BD. */
            $sql = "SELECT id_producto 
                    FROM producto 
                    WHERE nombre = :nombre 
                        AND concentracion = :concentracion 
                        AND adicional = :adicional 
                        AND prod_lab = :laboratorio 
                        AND prod_tip_prod = :tipo 
                        AND prod_present = :presentacion";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":nombre" => $nombre, 
                                    ":concentracion" => $concentracion,
                                    ":adicional" => $adicional,
                                    ":laboratorio" => $laboratorio,
                                    ":tipo" => $tipo,
                                    ":presentacion" => $presentacion));         
            $this -> objetos = $query -> fetchAll();

            /* Si no existe respuesta es porque el nombre del producto ya existe, caso contrario agregamos un producto */
            if (!empty($this -> objetos)) {
                echo "noadd";
            } else {
                $sql = "INSERT INTO producto (nombre, concentracion, adicional, precio, prod_lab, prod_tip_prod, prod_present, avatar)
                        VALUES (:nombre, :concentracion, :adicional, :precio, :laboratorio, :tipo, :presentacion, :avatar)";
                $query = $this -> acceso -> prepare($sql);
                $query -> execute(array(":nombre" => $nombre, 
                                    ":concentracion" => $concentracion,
                                    ":adicional" => $adicional,
                                    ":precio" => $precio,
                                    ":laboratorio" => $laboratorio,
                                    ":tipo" => $tipo,
                                    ":presentacion" => $presentacion,
                                    ":avatar" => $avatar
                                ));         
                echo "add";
            }
        }

        function buscar() {
            if (!empty($_POST["consulta"])) {
                $consulta = $_POST["consulta"];
                $sql = "SELECT 
                            id_producto, 
                            producto.nombre as nombre,
                            concentracion,
                            adicional,
                            precio,
                            laboratorio.nombre as laboratorio,
                            tipo_producto.nombre as tipo,
                            presentacion.nombre as presentacion,
                            producto.avatar as avatar,
                            prod_lab,
                            prod_tip_prod,
                            prod_present
                        FROM producto
                        JOIN laboratorio ON prod_lab = id_laboratorio
                        JOIN tipo_producto ON prod_tip_prod = id_tip_prod
                        JOIN presentacion ON prod_present = id_presentacion
                        AND producto.nombre LIKE :consulta
                        LIMIT 25";
                $query = $this -> acceso -> prepare($sql);
                $query -> execute(array(":consulta" => "%$consulta%"));
                $this -> objetos = $query -> fetchAll();
                return $this -> objetos;
            } else {
                $sql = "SELECT 
                            id_producto, 
                            producto.nombre as nombre,
                            concentracion,
                            adicional,
                            precio,
                            laboratorio.nombre as laboratorio,
                            tipo_producto.nombre as tipo,
                            presentacion.nombre as presentacion,
                            producto.avatar as avatar,
                            prod_lab,
                            prod_tip_prod,
                            prod_present
                        FROM producto
                        JOIN laboratorio ON prod_lab = id_laboratorio
                        JOIN tipo_producto ON prod_tip_prod = id_tip_prod
                        JOIN presentacion ON prod_present = id_presentacion
                        AND producto.nombre NOT LIKE ''
                        ORDER BY producto.nombre
                        LIMIT 25";
                $query = $this -> acceso -> prepare($sql);
                $query -> execute();
                $this -> objetos = $query -> fetchAll();
                return $this -> objetos;
            }
        }

        function cambiar_logo($id, $nombre) {
            $sql = "UPDATE producto 
                    SET avatar = :nombre 
                    WHERE id_producto = :id";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":id" => $id, ":nombre" => $nombre));
        } 

        function editar($id, $nombre, $concentracion, $adicional, $precio, $laboratorio, $tipo, $presentacion) {
            /* Verifico primero si el nombre del producto ya existe en la Tabla producto de la BD. */
            $sql = "SELECT id_producto 
                    FROM producto 
                    WHERE id_producto != :id 
                        AND nombre = :nombre 
                        AND concentracion = :concentracion 
                        AND adicional = :adicional 
                        AND prod_lab = :laboratorio 
                        AND prod_tip_prod = :tipo 
                        AND prod_present = :presentacion";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":id" => $id,
                                    ":nombre" => $nombre, 
                                    ":concentracion" => $concentracion,
                                    ":adicional" => $adicional,
                                    ":laboratorio" => $laboratorio,
                                    ":tipo" => $tipo,
                                    ":presentacion" => $presentacion));
            $this -> objetos = $query -> fetchAll();
            if (!empty($this -> objetos)) {
                echo "noedit";
            } else {
                $sql = "UPDATE producto 
                        SET nombre = :nombre, 
                            concentracion = :concentracion, 
                            adicional = :adicional, 
                            prod_lab = :laboratorio, 
                            prod_tip_prod = :tipo, 
                            prod_present = :presentacion,
                            precio = :precio
                        WHERE id_producto = :id
                            ";
                $query = $this -> acceso -> prepare($sql);
                $query -> execute(array(":nombre" => $nombre, 
                                    ":concentracion" => $concentracion,
                                    ":adicional" => $adicional,
                                    ":laboratorio" => $laboratorio,
                                    ":tipo" => $tipo,
                                    ":presentacion" => $presentacion,
                                    ":precio" => $precio,
                                    ":id" => $id
                                ));
                echo "edit";
            }
        }
        
        function borrar($id) {
            $sql = "DELETE FROM producto 
                    WHERE id_producto = :id";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":id" => $id));

            /* Verifica si se elimino el producto */
            if (!empty($query -> execute(array(":id" => $id)))) {
                echo "borrado";
            } else {
                echo "noborrado";
            }
        }

    }