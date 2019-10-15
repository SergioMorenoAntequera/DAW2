<?php
class View
{
    //Clase no es uso actualmente
    //**************************/
    
    public static function show($viewName, $data){
        include("view/$viewName.php");
        include("view/footer.php");
    }

    public static function redirect($actionName, $data = null){
        $url = "<script>location.href='index.php?do=$actionName";
        if ($data != null) {
            foreach ($data as $clave => $valor) {
                $url = $url."&".$clave."=".$valor;
            }
        }
        $url = $url."'</script>";
        echo $url;
    }
}
