<?php 

    include_once "Conexion.php";

    class Lote {

        var $objetos;

        public function __construct() {
            $db = new Conexion();
            $this -> acceso = $db -> pdo;
        }

        function crear($id_producto, $proveedor, $stock, $vencimiento) {
            $sql = "INSERT INTO lote (stock, vencimiento, lote_id_prod, lote_id_prov)
                        VALUES (:stock, :vencimiento, :id_producto, :id_proveedor)";
            $query = $this -> acceso -> prepare($sql);
            $query -> execute(array(":stock" => $stock, 
                                    ":vencimiento" => $vencimiento, 
                                    ":id_producto" => $id_producto, 
                                    ":id_proveedor" => $proveedor, 
                                ));
            echo "add";
        }

        function buscar() {
            if (!empty($_POST["consulta"])) {
                $consulta = $_POST["consulta"];
                $sql = "SELECT 
                            id_lote, 
                            stock, 
                            vencimiento, 
                            concentracion, 
                            adicional,
                            producto.nombre AS prod_nom,
                            laboratorio.nombre AS lab_nom,
                            tipo_producto.nombre AS tip_nom,
                            presentacion.nombre AS pre_nom,
                            proveedor.nombre AS proveedor,
                            producto.avatar AS logo 
                            FROM lote
                            JOIN proveedor ON lote_id_prov = id_proveedor
                            JOIN producto ON lote_id_prod = id_producto
                            JOIN laboratorio ON prod_lab = id_laboratorio
                            JOIN tipo_producto ON prod_tip_prod = id_tip_prod
                            JOIN presentacion ON prod_present = id_presentacion
                            AND producto.nombre LIKE :consulta 
                            ORDER BY producto.nombre 
                            LIMIT 25";
                $query = $this -> acceso -> prepare($sql);
                $query -> execute(array(":consulta" => "%$consulta%"));
                $this -> objetos = $query -> fetchAll();
                return $this -> objetos;
            } else {
                $sql = "SELECT 
                            id_lote, 
                            stock, 
                            vencimiento, 
                            concentracion, 
                            adicional,
                            producto.nombre AS prod_nom,
                            laboratorio.nombre AS lab_nom,
                            tipo_producto.nombre AS tip_nom,
                            presentacion.nombre AS pre_nom,
                            proveedor.nombre AS proveedor,
                            producto.avatar AS logo 
                            FROM lote
                            JOIN proveedor ON lote_id_prov = id_proveedor
                            JOIN producto ON lote_id_prod = id_producto
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
    }