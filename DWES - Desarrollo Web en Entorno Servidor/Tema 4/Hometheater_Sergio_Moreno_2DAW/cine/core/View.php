<?php
class View
{
    public static function show($viewName, $data){
        include("view/header.php");
        include("view/$viewName.php");
        //include("view/footer.php");
    }

    public static function redirect($actionName, $data = null){
        include("view/header.php");
        $url = "<script>location.href='index.php?do=$actionName";
        if ($data != null) {
            foreach ($data as $clave => $valor) {
                $url = $url."&".$clave."=".$valor;
            }
        }
        $url = $url."'</script>";
        echo $url;
    }

    public static function extenalWebpage($url){
        echo("<script>window.location='$url';</script>");
    }
}
