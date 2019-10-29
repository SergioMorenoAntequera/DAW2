<?php
if ($data['security']->check()) {
    $id = $data['id'];
    $title = $data['movie']->getTitle($id);
    if(isset($data['cda'])){
        if($data['cda']){
            $volverA = "ManageMovies";
        } else {
            $volverA = "ListMenu";
        }
    } else {
        $volverA = "ListMenu";
    }

    echo ("<br>¿Estás seguro de que deseas eliminar la película \"" . $title. "\"? <br><br>");

    echo ("<form>
            <input type=hidden value=$id name ='id'>
            <input type=hidden value=$volverA name ='cda'>
            <input type=hidden value='DeleteCheck' name ='do'>
            <input style='width:25%;' type=submit value='Eliminar'> 
        </form>
        <form>
            <input type=hidden value='$volverA' name ='do'>
            <input style='width:25%;' type=submit value='Retroceder'>
        </form>");
        
} else {
    echo ("<script>location.href='index.php?do=NoPermissionError'</script>");
}