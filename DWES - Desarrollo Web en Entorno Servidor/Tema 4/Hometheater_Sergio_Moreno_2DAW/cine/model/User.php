<?php
include_once("core/AbstractionLayerSQL.php");
class User {

    public $abstractionLayer;
    public $conn;

    // CONSTRUCTOR ////////////////////////////////////////////////////////////////////
    public function __construct(){
        $this->abstractionLayer = new AbstractionLayer();
        $this->conn = $this->abstractionLayer->getMySQLConnection();
    }
    
    // GET EACH PROPERTY ////////////////////////////////////////////////////////////////////
    function getID($nick){
        $registro = $this->abstractionLayer->queryRow("users", "nick", $nick);
        if(!$registro)
            return false;
        else
            return $registro->idusuario;
    }

    function getEmail($nick){
        $registro = $this->abstractionLayer->queryRow("users", "nick", $nick);
        if(!$registro)
            return false;
        else
            return $registro->email;
    }

    function getNick($idUsuario){
        $registro = $this->abstractionLayer->queryRow("users", "idusuario", $idUsuario);
        if(!$registro)
            return false;
        else
            return $registro->nick;
    }

    function getPassword($nick){
        $registro = $this->abstractionLayer->queryRow("users", "nick", $nick);
        if(!$registro)
            return false;
        else
            return $registro->passwd;
    }

    function getTipo($nick){
        $registro = $this->abstractionLayer->queryRow("users", "nick", $nick);
        if(!$registro)
            return false;
        else
            return $registro->type;
    }

    public function getConnection(){
        return $this->conn;
    }

    // GET ALL ////////////////////////////////////////////////////////////////////
    public function getEverything($nick){
        $registro = $this->abstractionLayer->queryRow("users", "nick", $nick);
        if(!$registro)
            return false;
        else
            return $registro;
    }

    public function getAll(){
        $registros = $this->abstractionLayer->queryAll("users");
        if(!$registros)
            return false;
        else
            return $registros;
    }

    // DB FUNCTIONS ////////////////////////////////////////////////////////////////////
    function insert($arr){
        $this->abstractionLayer->insertRow("users", $arr);
    }
    
    function delete($pk, $value){
        $this->abstractionLayer->deleteRow("users", $pk, $value);
    }

    function update($arr, $value){
        $keys = Array("nick", "email", "password", "type");
        $this->abstractionLayer->updateRow("users", $keys, $arr, $value);
    }
}
?>