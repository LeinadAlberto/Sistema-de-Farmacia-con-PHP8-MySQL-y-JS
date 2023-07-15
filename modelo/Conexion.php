<?php 

    class Conexion {

        private $db = "farmaciasistema";
        private $servidor = "localhost";
        private $puerto = "3306";
        private $charset = "utf8";
        
        private $usuario = "root";
        private $contrasena = "";

        private $atributos = [
            PDO::ATTR_CASE => PDO::CASE_LOWER, 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING, 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        public $pdo = null;
        
        function __construct() {

            $this -> pdo = new PDO("mysql:dbname={$this -> db};
                                    host={$this -> servidor};
                                    port={$this -> puerto};
                                    charset={$this -> charset}",
                                $this -> usuario,
                                $this -> contrasena,
                                $this -> atributos
                            );

        }

    }


?>