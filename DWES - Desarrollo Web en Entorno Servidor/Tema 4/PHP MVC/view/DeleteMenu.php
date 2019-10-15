<?php
if ($data['security']->check()) {
    $nqb = $data['nqb'];
    echo ("<br>¿Estás seguro de que deseas eliminar el usuario \"" . $nqb. "\"? <br><br>");

    echo ("<form>
            <input type=hidden value='UserMenu' name ='do'>
            <input type=submit value='Retroceder'>
        </form>
        <form>
            <input type=hidden value=$nqb name ='nqb'>
            <input type=hidden value='DeleteCheck' name ='do'>
            <input type=submit value='Eliminar'> 
        </form>");
} else {
    echo ("<script>location.href='index.php?do=NoPermissionError'</script>");
}