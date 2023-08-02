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
                    WHERE nombre = :nombre AND concentracion = :concentracion AND adicional = :adicional AND prod_lab = :laboratorio AND prod_tip_prod = :tipo AND prod_present = :presentacion";
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
                            producto.avatar as avatar
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
                            producto.avatar as avatar
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
            /* Obtenemos el avatar actual */
            $sql = "SELECT avatar 
                    FROM laboratorio 
                    WHERE id_laboratorio = :id";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":id" => $id));
            $this -> objetos = $query -> fetchAll();

            /* Remplazamos el nuevo avatar */
            $sql = "UPDATE laboratorio 
                    SET avatar = :nombre 
                    WHERE id_laboratorio = :id";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":id" => $id, ":nombre" => $nombre));

            return $this -> objetos; /* Retornamos al controlador el avatar antiguo */
        } 

        function borrar($id) {
            $sql = "DELETE FROM laboratorio 
                    WHERE id_laboratorio = :id";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":id" => $id));

            /* Verifica si se elimino el registro */
            if (!empty($query -> execute(array(":id" => $id)))) {
                echo "borrado";
            } else {
                "noborrado";
            }
        }

        function editar($id_editado, $nombre) {
            $sql = "UPDATE laboratorio
                    SET nombre = :nombre 
                    WHERE id_laboratorio = :id";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":id" => $id_editado, ":nombre" => $nombre));
            echo "edit";
        }

        function rellenar_laboratorios() {
            $sql = "SELECT *
                    FROM laboratorio
                    ORDER BY nombre ASC";
                $query = $this -> acceso -> prepare($sql);
                $query -> execute();
                $this -> objetos = $query -> fetchAll();
                return $this -> objetos;
        }

    }