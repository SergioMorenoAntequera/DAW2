<?php
if ($data['security']->check()) {
    $id = $data['id'];
    $nick = $data['nick'];
    echo ("<br>¿Estás seguro de que deseas eliminar el usuario \"" . $nick. "\"? <br><br>");

    echo ("<form>
            <input type=hidden value=$id name ='id'>
            <input type=hidden value='UserController' name ='mainDo'>
            <input type=hidden value='DeleteCheck' name ='do'>
            <input style='width:25%;' type=submit value='Eliminar'> 
        </form>
    
        <form>
            <input type=hidden value='UserController' name ='mainDo'>
            <input type=hidden value='UserMenu' name ='do'>
            <input style='width:25%;' type=submit value='Retroceder'>
        </form>");
} else {
    echo ("<script>location.href='index.php?mainDo=UserController&do=NoPermissionError'</script>");
}