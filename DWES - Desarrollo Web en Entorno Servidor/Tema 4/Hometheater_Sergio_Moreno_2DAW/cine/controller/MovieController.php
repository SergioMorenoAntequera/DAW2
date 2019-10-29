<?php
include_once("model/Movie.php");
include_once("model/Person.php");
include_once("model/Genre.php");

Class MovieController extends MainController {

    public $movie;
    public $person;
    public $genre;

    function __construct(){
        parent::__construct();
        $this->movie = new Movie();
        $this->person = new Person();
        $this->genre = new Genre();
    }

    //Header of the controler
    public function main() {
        if (isset($_REQUEST['do'])) {
            $do = $_REQUEST['do'];
        } else {
            $do = "ListMenu";
        }
        $this->$do();
    }

    // MAIN MENU //////////////////////////////////////////////////////////////////////////
    public function ListMenu(){
        $data['movie'] = $this->movie;
        $data['security'] = $this->security;
        View::show("movies/ListMenu", $data);
    }

    // MOVIE PAGE //////////////////////////////////////////////////////////////////////////
    public function MoviePage(){
        $data['security'] = $this->security;
        $data['person'] = $this->person;
        $data['movie'] = $this->movie;
        $data['genre'] = $this->genre;
        $data['id'] = $_REQUEST['id'];
        View::show("movies/MoviePage", $data);
    }

    // MANAGE MOVIES //////////////////////////////////////////////////////////////////////////
    public function ManageMovies(){
        $data['rows'] = $this->movie->getAll();
        View::show("movies/ManageMoviesMenu", $data);
    }

    // EXTERNAL URL //////////////////////////////////////////////////////////////////////////
    public function ExternalWebPage(){
        $url = $this->movie->getEverything($_REQUEST['id'])->external_url;
        View::extenalWebpage($url);
    }

    // REGISTER MENU //////////////////////////////////////////////////////////////////////////
    public function RegisterMenu(){
        $data = Array();
        if(isset($_REQUEST['uyc']) ? $data['uyc'] = $_REQUEST['uyc'] : null);
        if(isset($_REQUEST['cda']) ? $data['cda'] = true : null);
        View::show("/movies/RegisterMenu", $data);
    }

    // REGISTER CHECH //////////////////////////////////////////////////////////////////////////
    public function RegisterCheck(){
        //Si está declara la variable que se crea al hacer un registro
        //Al volver despues de registrar comprobamos si existe con ese nick
        if($this->security->check()){
            if(isset($_REQUEST['rTitle']) && $_REQUEST['rTitle'] != ""){
                do{
                    $idRand = rand(99999, 1000000);
                } while($this->movie->getEverything($idRand) != false);
                
                $arr = array($idRand, $_REQUEST['rTitle'],
                            $_REQUEST['rYear'], 
                            $_REQUEST['rDuration'],
                            $_REQUEST['rRating'],
                            $_REQUEST['rCover'],
                            $_REQUEST['rFilepath'],
                            $_REQUEST['rFilename'],
                            $_REQUEST['rExternalurl']
                        );
                echo($this->movie->insert($arr));

                View::redirect("ManageMovies");
            } /*else {
                $url = $_REQUEST['rExternalurl']; //Convierte la información de la URL en cadena
                $ch = curl_init($url); // Inicia sesión cURL
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Configura cURL para devolver el resultado como cadena
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Configura cURL para que no verifique el peer del certificado dado que nuestra URL utiliza el protocolo HTTPS
                $info = curl_exec($ch); // Establece una sesión cURL y asigna la información a la variable $info
                curl_close($ch); // Cierra sesión cURL
                
                $pos1 = intval(strpos($info, "main-title"));
                $pos2 = $pos1;
                $title = substr($info, strpos($info, "main-title"), (strpos($info, "main-title")));
                echo("pos1". $pos1);
                echo("    pos2". $pos2);
                echo("  //  ".strlen($title));
           }*/
        } else {

        }
    }

    // MODIFY FILM MENU //////////////////////////////////////////////////////////////////////////
    public function ModifyMenu(){
        $data['movie'] = $this->movie;
        $data['security'] = $this->security;
        $data['id'] = $_REQUEST['id'];
        $data['adv'] = $_REQUEST['adv'];
        View::show("movies/ModifyMenu", $data);
    }

    // MODIFY FILM CHECK //////////////////////////////////////////////////////////////////////////
    public function ModifyCheck(){
        $data['movie'] = $this->movie;
        $data['id'] = $_REQUEST['id'];
        $data['security'] = $this->security;
        $arr = [$_REQUEST['mTitle'], $_REQUEST['mYear'], $_REQUEST['mDuration'], $_REQUEST['mRating'], 
                $_REQUEST['mCover'], $_REQUEST['mFilepath'], $_REQUEST['mFilename'], $_REQUEST['mExternalUrl']];
        $this->movie->update($arr, $_REQUEST['id']);
        if($_REQUEST['adv'] == "ListMenu"){
            View::show("movies/".$_REQUEST['adv'], $data);
        } else {
            View::redirect($_REQUEST['adv']);
        }
    }

    
    // MODIFY FILM MENU //////////////////////////////////////////////////////////////////////////
    public function DeleteMenu(){
        $data['movie'] = $this->movie;
        $data['security'] = $this->security;
        if(isset($_REQUEST['cda'])){
            $data['cda'] = true;
        } else {
            $data['cda'] = false;
        }
        $data['id'] = $_REQUEST['id'];
        View::show("movies/DeleteMenu", $data);
    }

    // MODIFY FILM CHECK //////////////////////////////////////////////////////////////////////////
    public function DeleteCheck(){
        $data['movie'] = $this->movie;
        $data['id'] = $_REQUEST['id'];
        $data['security'] = $this->security;
        $this->movie->delete("id", $_REQUEST['id']);
        View::redirect("".$_REQUEST['cda']."");
    }

} // Class Controller
?>