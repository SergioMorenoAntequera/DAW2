<?php
include("controller/MovieController.php");
include("controller/UserController.php");
include_once("core/Security.php");
include_once("core/View.php");

class MainController {

    public $security;

    public function __construct(){
        $this->security = new Security();
    }

    public function main(){
        if (isset($_REQUEST['mainDo'])) {
            $mainDo = $_REQUEST['mainDo'];
        } else {
            $mainDo = "MovieController";
        }
        $controller = new $mainDo();
        $controller->main();
    }
}