
<!-- Insertar registros en una tabla usuarios -->
<?php

// uyc = Usuario ya creado
if (isset($data['uyc'])) {
    echo ("<br>Usuario <b>" . $_REQUEST['uyc'] . "</b> ocupado, elige otro nick");
}
?>

<br>
<h3>Introduce los datos para el registro</h3>
<form action=index.php method=GET>
    <p><input type=text required=required name=rTitle placeholder=Title size=40> </p>
    <p><input type=text required=required name=rYear placeholder=Year size=40> </p>
    <p><input type=text required=required name=rDuration placeholder=Duration size=40> </p>
    <p><input type=text required=required name=rRating placeholder=Rating size=40> </p>
    <p><input type=text required=required name=rCover placeholder=Cover size=40> </p>
    <p><input type=text required=required name=rFilepath placeholder=Filepath size=40> </p>
    <p><input type=text required=required name=rFilename placeholder=Filename size=40> </p>
    <p><input type=text required=required name=rExternalurl placeholder='External URL' size=40> </p>
    <br>
    <p><input type=hidden name=do value='RegisterCheck'></p>
        <div class='wrapper'>
        <input style="width: 25%;" type=submit value=Registrar>
        </div>
</form>

<form action=index.php method=GET>
    <p><input type=hidden name=do value='ManageMovies'> </p>
    <div class='wrapper'>
    <p><input style="width: 25%;" type=submit value=Retroceder></p>
    </div>
</form>
