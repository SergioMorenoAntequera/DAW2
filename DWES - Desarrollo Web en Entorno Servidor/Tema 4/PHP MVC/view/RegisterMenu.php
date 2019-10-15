
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
    <p><input type=text required=required name=rName placeholder=Nombre size=40> </p>
    <p><input type=text required=required name=rSurname placeholder=Apellido size=40> </p>
    <p><input type=text required=required name=rEmail placeholder=Email size=40> </p>
    <p><input type=text required=required name=rNick placeholder=Nick size=40> </p>
    <p><input type=text required=required name=rPassword placeholder=Contraseña size=40> </p>
    <?php
    //Ponemos esto aqui para solo poder hacer admins desde admin
    //cda -> Creando desde admin
    if (isset($data['cda'])) {
        echo("<p> Administrador: <input type=checkbox name=rAdmin value=1> </p><br>");
        echo("<p> <input type=hidden name=cda value='cda'></p>");
    } else {
        echo("<br>");
    }
    ?>
    <p><input type=hidden name=do value='RegisterCheck'></p>

        <div class='wrapper'>
        <input type=submit value=Registrar>
        </div>
        </form>

    <form action=index.php method=GET>
        <p><input type=hidden name=do value='LoginMenu'> </p>
        <div class='wrapper'>
        <p><input type=submit value=Retroceder></p>
        </div>
    </form>
