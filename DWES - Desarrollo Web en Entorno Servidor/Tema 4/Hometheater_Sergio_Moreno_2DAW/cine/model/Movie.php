<?php
include_once("core/AbstractionLayerSQL.php");
class Movie {

    public $abstractionLayer;
    public $conn;

    // CONSTRUCTOR ////////////////////////////////////////////////////////////////////
    public function __construct(){
        $this->abstractionLayer = new AbstractionLayer();
        $this->conn = $this->abstractionLayer->getMySQLConnection();
    }
    
    // GET EACH PROPERTY ////////////////////////////////////////////////////////////////////
    function getId($title){
        $registro = $this->abstractionLayer->queryRow("movies", "title", $title);
        if(!$registro)
            return false;
        else
            return $registro->id;
    }

    function getTitle($id){
        $registro = $this->abstractionLayer->queryRow("movies", "id", $id);
        if(!$registro)
            return false;
        else
            return $registro->title;
    }

    function getYear($id){
        $registro = $this->abstractionLayer->queryRow("movies", "id", $id);
        if(!$registro)
            return false;
        else
            return $registro->year;
    }

    function getDuration($id){
        $registro = $this->abstractionLayer->queryRow("movies", "id", $id);
        if(!$registro)
            return false;
        else
            return $registro->duration;
    }

    function getRating($id){
        $registro = $this->abstractionLayer->queryRow("movies", "id", $id);
        if(!$registro)
            return false;
        else
            return $registro->rating;
    }

    function getCover($id){
        $registro = $this->abstractionLayer->queryRow("movies", "id", $id);
        if(!$registro)
            return false;
        else
            return $registro->cover;
    }

    function getFilepath($id){
        $registro = $this->abstractionLayer->queryRow("movies", "id", $id);
        if(!$registro)
            return false;
        else
            return $registro->filepath;
    }

    function getFilename($id){
        $registro = $this->abstractionLayer->queryRow("movies", "id", $id);
        if(!$registro)
            return false;
        else
            return $registro->filename;
    }
    
    function getExternalUrl($id){
        $registro = $this->abstractionLayer->queryRow("movies", "id", $id);
        if(!$registro)
            return false;
        else
            return $registro->external_url;
    }

    public function getConnection(){
        return $this->conn;
    }

    // GET INNER JOINS ////////////////////////////////////////////////////////////////////
    public function getGenres($movieId){
        $registros = $this->abstractionLayer->queryInnerJoin("movies", "genres", "genres_movies", "id_movie", "id_genre", $movieId);
        if(!$registros)
            return false;
        else {
            $genres = Array();
            foreach($registros as $registro){
                $genres[] = $registro->genres;
            }
            return $genres;
        }
    }

    public function getActors($movieId){
        $registros = $this->abstractionLayer->queryInnerJoin("movies", "people", "people_act_movies", "id_movie", "id_person", $movieId);
        if(!$registros)
            return false;
        else {
            $actors = Array();
            foreach($registros as $registro){
                $actors[] = $registro->people;
            }
            return $actors;
        }
    }

    public function getDirectors($movieId){
        $registros = $this->abstractionLayer->queryInnerJoin("movies", "people", "people_direct_movies", "id_movie", "id_person", $movieId);
        if(!$registros)
            return false;
        else {
            $actors = Array();
            foreach($registros as $registro){
                $actors[] = $registro->people;
            }
            return $actors;
        }
    }

    // GET EVERYTHING IN A ROW ////////////////////////////////////////////////////////////////////
    public function getEverything($id){
        $registro = $this->abstractionLayer->queryRow("movies", "id", $id);
        if(!$registro)
            return false;
        else
            return $registro;
    }

    // GET ALL ////////////////////////////////////////////////////////////////////
    public function getAll(){
        $registros = $this->abstractionLayer->queryAll("movies");
        if(!$registros)
            return false;
        else
            return $registros;
    }

    // DB FUNCTIONS ////////////////////////////////////////////////////////////////////
    function insert($arr){
        $this->abstractionLayer->insertRow("movies", $arr);
    }
    
    function delete($pk, $value){
        $this->abstractionLayer->deleteRow("movies", $pk, $value);
    }

    function update($arr, $value){
        $keys = Array("title", "year", "duration", "rating", "cover", "filepath", "filename", "external_url");
        $this->abstractionLayer->updateRow("movies", $keys, $arr, $value);
    }
}
?>