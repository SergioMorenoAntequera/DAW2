<?php
if ($data['security']->check()) {
    echo ("<br>");
    echo ("<h3>Modificando el usuario ".$data['id']."</h3>");

    // nyo = Nick ya ocupado
    if (isset($data['nyo'])) {
        echo ("<h3>El nick " . $_REQUEST['nyo'] . " ya se encuentra en uso </h3>");
    }

    
    ?>
    <form action=index.php method=GET>
    <p><input type=text required=required name=mNick placeholder=Nick size=40> </p>
    <p><input type=text required=required name=mEmail placeholder=Email size=40> </p>
    <p><input type=text required=required name=mPassword placeholder=Contraseña size=40> </p>
    <?php
    //Esto nos permite que si es admin cree otros admins
    /*if($data['security']->isAdmin()){
        echo("<p> administrador: <input type=checkbox name=mAdmin value=1> </p>");
    }*/
    echo("<p><input type=hidden name=mAdmin value='0'></p><br>");
    echo("<p><input type=hidden name=id value=\"".$data['id']."\"></p><br>");
    ?>
    <p><input type=hidden name=mainDo value=UserController> </p>
    <p><input type=hidden name=do value=ModifyCheck> </p>
    <p><input style='width: 25%;' type=submit value=Modificar></p>
    </form>

    <form>
    <p><input type=hidden name=mainDo value=UserController> </p>
    <p><input type=hidden name=do value=ManageUsers></p>
    <p><input style='width: 25%;' type=submit value=Cancelar></p>
    </form>

<?php
} else {
    $data['mainDo'] = "UserController";
    View::redirect("NoPermissionError", $data);
    //echo ("<script>location.href='index.php?do=NoPermissionError'</script>");
}