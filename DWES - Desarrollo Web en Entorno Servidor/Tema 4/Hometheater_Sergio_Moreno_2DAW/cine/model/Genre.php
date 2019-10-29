<?php
include_once("core/AbstractionLayerSQL.php");
class Genre {

    public $abstractionLayer;
    public $conn;

    // CONSTRUCTOR ////////////////////////////////////////////////////////////////////
    public function __construct(){
        $this->abstractionLayer = new AbstractionLayer();
        $this->conn = $this->abstractionLayer->getMySQLConnection();
    }
    
    // GET EACH PROPERTY ////////////////////////////////////////////////////////////////////
    function getDescription($id){
        $registro = $this->abstractionLayer->queryRow("genres", "id", $id);
        if(!$registro)
            return false;
        else
            return $registro->description;
    }

    public function getConnection(){
        return $this->conn;
    }

    // GET EVERYTHING IN A ROW ////////////////////////////////////////////////////////////////////
    public function getEverything($id){
        $registro = $this->abstractionLayer->queryRow("genres", "id", $id);
        if(!$registro)
            return false;
        else
            return $registro;
    }

    // GET ALL THE ROWS ////////////////////////////////////////////////////////////////////
    public function getAll(){
        $registros = $this->abstractionLayer->queryAll("genres");
        if(!$registros)
            return false;
        else
            return $registros;
    }

    // DB FUNCTIONS ////////////////////////////////////////////////////////////////////
    function insert($arr){
        $this->abstractionLayer->insertRow("genres", $arr);
    }
    
    function delete($pk, $value){
        $this->abstractionLayer->deleteRow("genres", $pk, $value);
    }

    function update($arr, $value){
        $keys = Array("description");
        $this->abstractionLayer->updateRow("genres", $keys, $arr, $value);
    }
}
?>