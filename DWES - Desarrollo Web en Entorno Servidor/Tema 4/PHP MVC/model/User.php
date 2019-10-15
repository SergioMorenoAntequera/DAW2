<?php
include("AbstractionLayerSQL.php");
class User {

    public $abstractionLayer;
    public $conn;

    // CONSTRUCTOR ////////////////////////////////////////////////////////////////////
    public function __construct(){
        $this->abstractionLayer = new AbstractionLayer();
        $this->conn = $this->abstractionLayer->getMySQLConnection();
    }
    
    // GET EACH PROPERTY ////////////////////////////////////////////////////////////////////
    function getIDUsuario($nick){
        $registro = $this->abstractionLayer->queryRow("usuarios", "nick", $nick);
        if(!$registro)
            return false;
        else
            return $registro->idusuario;
    }

    function getNombre($nick){
        $registro = $this->abstractionLayer->queryRow("usuarios", "nick", $nick);
        if(!$registro)
            return false;
        else
            return $registro->nombre;
    }

    function getApellido($nick){
        $registro = $this->abstractionLayer->queryRow("usuarios", "nick", $nick);
        if(!$registro)
            return false;
        else
            return $registro->apellido;
    }

    function getEmail($nick){
        $registro = $this->abstractionLayer->queryRow("usuarios", "nick", $nick);
        if(!$registro)
            return false;
        else
            return $registro->email;
    }

    function getNick($idUsuario){
        $registro = $this->abstractionLayer->queryRow("usuarios", "idusuario", $idUsuario);
        if(!$registro)
            return false;
        else
            return $registro->nick;
    }

    function getPasswd($nick){
        $registro = $this->abstractionLayer->queryRow("usuarios", "nick", $nick);
        if(!$registro)
            return false;
        else
            return $registro->passwd;
    }

    function getTipo($nick){
        $registro = $this->abstractionLayer->queryRow("usuarios", "nick", $nick);
        if(!$registro)
            return false;
        else
            return $registro->tipo;
    }

    public function getConnection(){
        return $this->conn;
    }

    // GET ALL ////////////////////////////////////////////////////////////////////
    public function getEverything($nick){
        $registro = $this->abstractionLayer->queryRow("usuarios", "nick", $nick);
        if(!$registro)
            return false;
        else
            return $registro;
    }

    public function getAll(){
        $registros = $this->abstractionLayer->queryAll("usuarios");
        if(!$registros)
            return false;
        else
            return $registros;
    }

    // DB FUNCTIONS ////////////////////////////////////////////////////////////////////
    function insert($arr){
        $this->abstractionLayer->insertRow("usuarios", $arr);
    }
    
    function delete($pk, $value){
        $this->abstractionLayer->deleteRow("usuarios", $pk, $value);
    }

    function update($arr, $value){
        $this->abstractionLayer->updateRow("usuarios", $arr, $value);
    }
}
?>