<?php
include_once("core/config.php");
    class AbstractionLayer{

        public $mySQLConn;

        public function __construct(){
            $this->mySQLConn = new mysqli(Config::$host, Config::$dbuser, Config::$dbpassword, Config::$dbname);
        }

        // NOS DEVUELVE UNA LINEA COMPLETA FILTRADA /////////////////////////////////////////////////////////
        public function queryRow($table, $pk, $value){
            $result = $this->mySQLConn->query("SELECT * FROM  $table WHERE $pk = '$value'");
            if($result != false){
                while($registro = $result->fetch_object()){
                    return $registro;
                }
            } else {
                return false;
            }
        }

        // NOS DEVUELVE UN ARRAY DE LINEAS CON TODA LA TABLA //////////////////////////////////////////////////
        public function queryAll($table){
            $registros = Array();
            
            $result = $this->mySQLConn->query("SELECT * FROM $table");
            if($result != false){
                while($registro = $result->fetch_object()){
                    $registros[] = $registro;
                }
                return $registros;
            } else {
                return false;
            }
        }

        public function queryInnerJoin($table1, $table2, $midleTable, $mTColum1, $mTColum2, $value){
            $q = "SELECT 
                    t1.id $table1, 
                    t2.id $table2  
                FROM $midleTable mt
                INNER JOIN $table1 t1 ON mt.$mTColum1 =  t1.id
                INNER JOIN $table2 t2 ON mt.$mTColum2 =  t2.id
                WHERE t1.id = '$value'";
            $result = $this->mySQLConn->query($q);

            $registros = Array();
            if($result != false){
                while($registro = $result->fetch_object()){
                    $registros[] = $registro;
                }
                return $registros;
            } else {
                return false;
            }
        }

        // INSERTAR UNA LINEA //////////////////////////////////////////////////////////////////////////////
        public function insertRow($table, $arr){
            $q = "INSERT INTO $table VALUES (";
            foreach($arr as $aux){
                $q = $q . "'$aux', ";
            }
            $q = substr($q, 0, strlen($q)-2);
            $q = $q . ");";
            
            $result = $this->mySQLConn->query($q);
            return($result);
        }

        // ELIMINAR UNA LINEA //////////////////////////////////////////////////////////////////////////////
        public function deleteRow($table, $pk, $value){
            $result = $this->mySQLConn->query("DELETE FROM $table WHERE $pk = '$value';");
            return $result;
        }

        // ACTUALIZAR UNA LINEA //////////////////////////////////////////////////////////////////////////////
        public function updateRow($table, $key, $arr, $value){
            $q = "UPDATE $table SET ";
            for($i = 0; $i < count($arr); $i++){
                $q = $q ."".$key[$i]." = '".$arr[$i]."', ";
            }
            $q = substr($q, 0, strlen($q)-2);
            $q = $q . " WHERE id = $value;";

            $result = $this->mySQLConn->query($q);
            return $result;
        }

        //Obtenemos la conexion
        public function getMySQLConnection(){
            return $this->mySQLConn;
        }
    }