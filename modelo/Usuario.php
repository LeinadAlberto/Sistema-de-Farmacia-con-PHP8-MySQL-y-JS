<?php 

    include_once "Conexion.php";

    class Usuario {

        var $objetos;

        public function __construct() {
            $db = new Conexion();
            $this -> acceso = $db -> pdo;
        }

        function loguearse($dni, $pass) {
            $sql = "SELECT * 
                    FROM usuario 
                    INNER JOIN tipo_us
                    ON us_tipo = id_tipo_us
                    WHERE dni_us = :dni AND contrasena_us = :pass";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":dni" => $dni, ":pass" => $pass));
            $this -> objetos = $query -> fetchAll();
            return $this -> objetos;
        }

        function obtener_datos($id) {
            $sql = "SELECT * 
                    FROM usuario 
                    INNER JOIN tipo_us
                    ON us_tipo = id_tipo_us
                    WHERE id_usuario = :id";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":id" => $id));
            $this -> objetos = $query -> fetchAll();
            return $this -> objetos;
        }

        function editar($id_usuario, $telefono, $residencia, $correo, $sexo, $adicional) {
            $sql = "UPDATE usuario
                    SET telefono_us = :telefono, 
                        residencia_us = :residencia, 
                        correo_us = :correo, 
                        sexo_us = :sexo, 
                        adicional_us = :adicional
                    WHERE id_usuario = :id";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":id" => $id_usuario, 
                                    ":telefono" => $telefono, 
                                    ":residencia" => $residencia, 
                                    ":correo" => $correo, 
                                    ":sexo" => $sexo, 
                                    ":adicional" => $adicional
                                ));
        }

        function cambiar_contra($id_usuario, $oldpass, $newpass) {
            $sql = "SELECT * 
                    FROM usuario 
                    WHERE id_usuario = :id AND contrasena_us = :oldpass";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":id" => $id_usuario, ":oldpass" => $oldpass));
            $this -> objetos = $query -> fetchAll();
            if (!empty($this -> objetos)) {
                $sql = "UPDATE usuario
                    SET contrasena_us = :newpass
                    WHERE id_usuario = :id";
                $query = $this -> acceso -> prepare($sql);
                $query -> execute(array(":id" => $id_usuario, ":newpass" => $newpass));
                echo "update";
            } else {
                echo "noupdate";
            }
        }

        function cambiar_photo($id_usuario, $nombre) {
            /* Obtenemos el avatar actual */
            $sql = "SELECT avatar 
                    FROM usuario 
                    WHERE id_usuario = :id";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":id" => $id_usuario));
            $this -> objetos = $query -> fetchAll();

            /* Remplazamos el nuevo avatar */
            $sql = "UPDATE usuario 
                    SET avatar = :nombre 
                    WHERE id_usuario = :id";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":id" => $id_usuario, ":nombre" => $nombre));

            return $this -> objetos; /* Retornamos al controlador el avatar antiguo */
        } 

        function buscar() {
            if (!empty($_POST["consulta"])) {
                $consulta = $_POST["consulta"];
                $sql = "SELECT *
                        FROM usuario
                        INNER JOIN tipo_us
                        ON us_tipo = id_tipo_us
                        WHERE nombre_us LIKE :consulta";
                $query = $this -> acceso -> prepare($sql);
                $query -> execute(array(":consulta" => "%$consulta%"));
                $this -> objetos = $query -> fetchAll();
                return $this -> objetos;
            } else {
                $sql = "SELECT *
                        FROM usuario
                        INNER JOIN tipo_us
                        ON us_tipo = id_tipo_us
                        WHERE nombre_us NOT LIKE '' 
                        ORDER BY id_usuario
                        LIMIT 25";
                $query = $this -> acceso -> prepare($sql);
                $query -> execute();
                $this -> objetos = $query -> fetchAll();
                return $this -> objetos;
            }
        }

        function crear($nombre, $apellido, $edad, $dni, $pass, $tipo, $avatar) {
            /* Verifico primero si el dni del usuario ya existe en la Base de Datos */
            $sql = "SELECT id_usuario 
                    FROM usuario 
                    WHERE dni_us = :dni";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":dni" => $dni));
            $this -> objetos = $query -> fetchAll();

            /* Si no existe respuesta es porque el dni del usuario ya existe, caso contrario agregamos usuario */
            if (!empty($this -> objetos)) {
                echo "noadd";
            } else {
                $sql = "INSERT INTO usuario (nombre_us, apellidos_us, edad, dni_us, contrasena_us, us_tipo, avatar)
                    VALUES (:nombre, :apellido, :edad, :dni, :pass, :tipo, :avatar)";
                $query = $this -> acceso -> prepare($sql);
                $query -> execute(array(":nombre" => $nombre,
                                        ":apellido" => $apellido,
                                        ":edad" => $edad,
                                        ":dni" => $dni,
                                        ":pass" => $pass,
                                        ":tipo" => $tipo,
                                        ":avatar" => $avatar,
                                    ));
                echo "add";
            }
        }

        /* Asciende de rol Técnico a Administrador */
        function ascender($pass, $id_ascendido, $id_usuario) {
            /* Valido si la contraseña del usuario Root es valida */
            $sql = "SELECT id_usuario 
                    FROM usuario 
                    WHERE id_usuario = :id_usuario AND contrasena_us = :pass";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":id_usuario" => $id_usuario, ":pass" => $pass));
            $this -> objetos = $query -> fetchAll();
            /* Si la validación del usuario Root es correcta procedemos a ascender */
            if (!empty($this -> objetos)) {
                $tipo = 1;
                $sql = "UPDATE usuario 
                    SET us_tipo = :tipo
                    WHERE id_usuario = :id";
                $query = $this -> acceso -> prepare($sql);
                $query -> execute(array(":id" => $id_ascendido, ":tipo" => $tipo));
                echo "ascendido";
            } else {
                echo "noascendido";
            }

        }

        /* Desciende de rol Administrador a Técnico */
        function descender($pass, $id_descendido, $id_usuario) {
            /* Valido si la contraseña del usuario Root es valida */
            $sql = "SELECT id_usuario 
                    FROM usuario 
                    WHERE id_usuario = :id_usuario AND contrasena_us = :pass";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":id_usuario" => $id_usuario, ":pass" => $pass));
            $this -> objetos = $query -> fetchAll();
            /* Si la validación del usuario Root es correcta procedemos a ascender */
            if (!empty($this -> objetos)) {
                $tipo = 2;
                $sql = "UPDATE usuario 
                    SET us_tipo = :tipo
                    WHERE id_usuario = :id";
                $query = $this -> acceso -> prepare($sql);
                $query -> execute(array(":id" => $id_descendido, ":tipo" => $tipo));
                echo "descendido";
            } else {
                echo "nodescendido";
            }

        }

        /* Elimina un Usuario */
        function borrar($pass, $id_borrado, $id_usuario) {
            /* Valido si la contraseña del usuario Root es valida */
            $sql = "SELECT id_usuario 
                    FROM usuario 
                    WHERE id_usuario = :id_usuario AND contrasena_us = :pass";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":id_usuario" => $id_usuario, ":pass" => $pass));
            $this -> objetos = $query -> fetchAll();
            /* Si la validación del usuario Root es correcta procedemos a eliminar un Usuario */
            if (!empty($this -> objetos)) {
                $sql = "DELETE FROM usuario 
                    WHERE id_usuario = :id";
                $query = $this -> acceso -> prepare($sql);
                $query -> execute(array(":id" => $id_borrado));
                echo "borrado";
            } else {
                echo "noborrado";
            }

        }
    }

?>