<?php
if ($data['security']->check()) {
    echo ("<br>");
    //nqm -> Nick que modificar
    echo ("<h3>Modificando el usuario ".$data['nqm']."</h3>");

    // nyo = Nick ya ocupado
    if (isset($data['nyo'])) {
        echo ("<h3>El nick " . $_REQUEST['nyo'] . " ya se encuentra en uso </h3>");
    }

    
    ?>
    <form action=index.php method=GET>
    <p><input type=text required=required name=mName placeholder=Nombre size=40> </p>
    <p><input type=text required=required name=mSurname placeholder=Apellidos size=40> </p>
    <p><input type=text required=required name=mEmail placeholder=Email size=40> </p>
    <p><input type=text required=required name=mNick placeholder=Nick size=40> </p>
    <p><input type=text required=required name=mPassword placeholder=Password size=40> </p>
    <?php
    //Esto nos permite que si es admin cree otros admins
    if($data['security']->isAdmin()){
        echo("<p> administrador: <input type=checkbox name=mAdmin value=1> </p>");
    }
    echo("<p><input type=hidden name=nqm value=\"".$data['nqm']."\"></p><br>");
    ?>
    <p><input type=hidden name=do value=ModifyCheck> </p>
    <p><input type=submit value=Modificar></p>
    </form>

    <form>
    <p><input type=hidden name=do value=UserMenu> </p>
    <p><input type=submit value=Cancelar></p>
    </form>

<?php
} else {
    echo ("<script>location.href='index.php?do=NoPermissionError'</script>");
}