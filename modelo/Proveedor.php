<?php 

    include_once "Conexion.php";

    class Proveedor {

        var $objetos;

        public function __construct() {
            $db = new Conexion();
            $this -> acceso = $db -> pdo;
        }

        function crear($nombre, $telefono, $correo, $direccion, $avatar) {
            /* Verifico primero si el nombre del proveedor ya existe en la Base de Datos */
            $sql = "SELECT id_proveedor 
                    FROM proveedor
                    WHERE nombre = :nombre";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":nombre" => $nombre));
            $this -> objetos = $query -> fetchAll();

            /* Si no existe respuesta es porque el nombre del proveedor ya existe, caso contrario agregamos un proveedor */
            if (!empty($this -> objetos)) {
                echo "noadd";
            } else {
                $sql = "INSERT INTO proveedor (nombre, telefono, correo, direccion, avatar)
                    VALUES (:nombre, :telefono, :correo, :direccion, :avatar)";
                $query = $this -> acceso -> prepare($sql);
                $query -> execute(array(":nombre" => $nombre, 
                                        ":telefono" => $telefono, 
                                        ":correo" => $correo, 
                                        ":direccion" => $direccion, 
                                        ":avatar" => $avatar
                                    ));
                echo "add";
            }
        }

        function buscar() {
            if (!empty($_POST["consulta"])) {
                $consulta = $_POST["consulta"];
                $sql = "SELECT *
                        FROM proveedor
                        WHERE nombre LIKE :consulta";
                $query = $this -> acceso -> prepare($sql);
                $query -> execute(array(":consulta" => "%$consulta%"));
                $this -> objetos = $query -> fetchAll();
                return $this -> objetos;
            } else {
                $sql = "SELECT *
                        FROM proveedor
                        WHERE nombre NOT LIKE '' 
                        ORDER BY id_proveedor DESC
                        LIMIT 25";
                $query = $this -> acceso -> prepare($sql);
                $query -> execute();
                $this -> objetos = $query -> fetchAll();
                return $this -> objetos;
            }
        }

        function cambiar_logo($id, $nombre) {
            $sql = "UPDATE proveedor 
                    SET avatar = :nombre 
                    WHERE id_proveedor = :id";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":id" => $id, ":nombre" => $nombre));
        } 

    }