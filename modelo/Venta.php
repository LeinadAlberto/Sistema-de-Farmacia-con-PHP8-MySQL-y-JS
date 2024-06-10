<?php 

include_once "Conexion.php";

class Venta {

    var $objetos;

    public function __construct() {

        $db = new Conexion();

        $this -> acceso = $db -> pdo;

    }

    function crear($nombre, $dni, $total, $fecha, $vendendor) {

        $sql = "INSERT INTO venta (fecha, cliente, dni, total, vendedor)
                VALUES (:fecha, :cliente, :dni, :total, :vendedor)";
        
        $query = $this -> acceso -> prepare($sql);

        $query -> execute(array(":fecha" => $fecha, 
                            ":cliente" => $nombre, 
                            ":dni" => $dni, 
                            ":total" => $total, 
                            ":vendedor" => $vendendor
                        ));
        
    }

    function ultima_venta() {

        $sql = "SELECT MAX(id_venta) as ultima_venta 
                FROM venta";
        
        $query = $this -> acceso -> prepare($sql);

        $query -> execute();

        $this -> objetos = $query -> fetchAll();

        return $this -> objetos;

    }

    function borrar($id_venta) {

        $sql = "DELETE FROM venta WHERE id_venta = :id_venta";

        $query = $this -> acceso -> prepare($sql);

        $query -> execute(array(":id_venta" => $id_venta));

    }

}