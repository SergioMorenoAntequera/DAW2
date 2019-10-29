<?php

if ($data['security']->check()) {
    echo ("<br>");
    $row = $data['movie']->getEverything($data['id']);

    echo ("<h3>Modificando la pelicula ".$row->title."</h3>");

    echo("
    <form action=index.php>
    <p><input type=text required=required name=mTitle value='$row->title' xplaceholder=Título size=40> </p>
    <p><input type=text required=required name=mYear value='$row->year' placeholder=Año size=40> </p>
    <p><input type=text required=required name=mDuration value='$row->duration' placeholder=Duración size=40> </p>
    <p><input type=text required=required name=mRating value='$row->rating' placeholder=Valoración size=40> </p>
    <p><input type=text required=required name=mCover value='$row->cover' placeholder='Nombre de la portada' size=40> </p>
    <p><input type=text required=required name=mFilepath value='$row->filepath' placeholder='Path del archivo' size=40> </p>
    <p><input type=text required=required name=mFilename value='$row->filename' placeholder='Nombre del archivo' size=40> </p>
    <p><input type=text required=required name=mExternalUrl value='$row->external_url' placeholder='URL Externa' size=40> </p>
    <p><input type=hidden name=id value=\"".$data['id']."\"></p><br>
    ");

    echo("
    <p><input type=hidden name=do value=ModifyCheck> </p>
    <p><input type=hidden name=adv value=".$data['adv']."></p>
    <p><input type=hidden name=id value=\"".$data['id']."\"></p>
    <p><input style='width: 25%;' type=submit value=Modificar></p>
    </form>
    ");

    echo("
    <form>
    <p><input type=hidden name=do value=".$data['adv']."></p>
    <p><input type=hidden name=id value=\"".$data['id']."\"></p>
    <p><input style='width: 25%;' type=submit value=Cancelar></p>
    </form>
    ");
} else {
    $data2['mainDo'] = "userController";
    View::redirect("NoPermissionError", $data2);
    //echo ("<script>location.href='index.php?do=NoPermissionError'</script>");
}
