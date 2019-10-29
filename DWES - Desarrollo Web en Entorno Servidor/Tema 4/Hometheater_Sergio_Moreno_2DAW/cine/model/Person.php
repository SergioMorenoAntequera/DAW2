<?php
include_once("core/AbstractionLayerSQL.php");
class Person {

    public $abstractionLayer;
    public $conn;

    // CONSTRUCTOR ////////////////////////////////////////////////////////////////////
    public function __construct(){
        $this->abstractionLayer = new AbstractionLayer();
        $this->conn = $this->abstractionLayer->getMySQLConnection();
    }
    
    // GET EACH PROPERTY ////////////////////////////////////////////////////////////////////
    function getName($id){
        $registro = $this->abstractionLayer->queryRow("people", "id", $id);
        if(!$registro)
            return false;
        else
            return $registro->name;
    }

    public function getConnection(){
        return $this->conn;
    }

    // GET EVERYTHING IN A ROW ////////////////////////////////////////////////////////////////////
    public function getEverything($id){
        $registro = $this->abstractionLayer->queryRow("people", "id", $id);
        if(!$registro)
            return false;
        else
            return $registro;
    }

    // GET ALL THE ROWS ////////////////////////////////////////////////////////////////////
    public function getAll(){
        $registros = $this->abstractionLayer->queryAll("people");
        if(!$registros)
            return false;
        else
            return $registros;
    }

    // DB FUNCTIONS ////////////////////////////////////////////////////////////////////
    function insert($arr){
        $this->abstractionLayer->insertRow("people", $arr);
    }
    
    function delete($pk, $value){
        $this->abstractionLayer->deleteRow("people", $pk, $value);
    }

    function update($arr, $value){
        $keys = Array("name", "photo", "external_url");
        $this->abstractionLayer->updateRow("people", $keys, $arr, $value);
    }
}
?>