<?php
    class BD{
        public static function getConexao(){
            $conn = new PDO(
                "mysql:host=localhost;dbname=BDpadaria",
                "root",
                "root"
            );

            return $conn;
        }

        public static function setConexao(){

        }
    }
?>