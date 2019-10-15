<?php
    class AbstractionLayer{

        public $mySQLConn;

        public function __construct(){
            $this->mySQLConn = new mysqli('localhost', 'root', 'admin5', 'practicaphp');
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

        // INSERTAR UNA LINEA //////////////////////////////////////////////////////////////////////////////
        public function insertRow($table, $arr){
            $q = "INSERT INTO $table (nombre, apellido, email, nick, passwd, tipo)
                    VALUES ('$arr[0]','$arr[1]','$arr[2]','$arr[3]','$arr[4]','$arr[5]');";     
            $result = $this->mySQLConn->query($q);
        }

        // ELIMINAR UNA LINEA //////////////////////////////////////////////////////////////////////////////
        public function deleteRow($table, $pk, $value){
            $result = $this->mySQLConn->query("DELETE FROM $table WHERE $pk = '$value';");
            return $result;
        }

        // ACTUALIZAR UNA LINEA //////////////////////////////////////////////////////////////////////////////
        public function updateRow($table, $arr, $value){
            $q = "UPDATE $table
            SET nombre = '$arr[0]', apellido = '$arr[1]', email = '$arr[2]', nick = '$arr[3]', passwd = '$arr[4]', tipo = '$arr[5]'
            WHERE idusuario = $value;"; 
            $result = $this->mySQLConn->query($q);
        }

        //Obtenemos la conexion
        public function getMySQLConnection(){
            return $this->mySQLConn;
        }
    }