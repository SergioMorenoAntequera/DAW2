<html>
    <head>
        <title> Actividad obligatoria PHP </title>
        <style>
            body {
                text-align: center;
            }
            table {
                width:90%;
                margin-left:auto; 
                margin-right:auto;
            }
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 15px;
                text-align: left;
            }
            table#t01 tr:nth-child(even) {
                background-color: #eee;
            }
            table#t01 tr:nth-child(odd) {
                background-color: #fff;
            }
            table#t01 th {
                background-color: black;
                color: white;
            }
        </style>
    
    </head>
    
    <body>
        <br><br><br>
        <h1> phpMyAdmin 2 </h1>

        <?php
            //Header of the controler
            if(isset($_REQUEST['do'])){
                $do = $_REQUEST['do'];
            } else {
                $do = "Logi nMenu";
            }
            $conn = new mysqli('localhost', 'root', 'admin5', 'practicaphp');
            $conn->set_charset("utf8");

            switch($do){
                // LOGIN MENU //////////////////////////////////////////////////////////////////////////
                case "LoginMenu": {
                    
                    if($conn->connect_error){
                        echo ("<script>location.href='actividad.php?do=ConnectionError'</script>");
                    } 

                    ?>
                    <form action="actividad.php" method="GET">
                    <p> Username: <input type="text" required="required" name="nick" size="40"> </p>
                    <p> Password: <input type="text" required="required" name="password" size="40"> </p>
                    <p><input type="hidden" name="do" value="UserMenu"> </p>
                    <p> 
                        <input type="submit" value="Log in">
                        <a href="actividad.php?do=RegisterMenu"> <button type="button">Register</button> </a>
                    </p>
                    </form>
                    <?php

                    //Al volver despues de registrar comprobamos si existe con ese nick
                    $usuarioYaCreado = null;
                    if(isset($_REQUEST['rNick'])){
                        $result = $conn->query("SELECT * FROM usuarios WHERE nick = '".$_REQUEST['rNick']."'");
                        while($registro = $result->fetch_object()){
                            echo("Ya existe un usuario con el nick ".$_REQUEST["rNick"]."<br>");
                            $usuarioYaCreado = true;
                        }

                        if(!$usuarioYaCreado){
                            //Registrar usuario
                            //Esto lo usamos para evitar problemas al no crear admins
                            if(!isset($_REQUEST['rAdmin'])){
                                //No admins
                                $admin = 1;
                            } else {
                                //Admins
                                $admin = 0;
                            }
                            $conn->query("INSERT INTO usuarios (nombre, apellido, email, nick, passwd, tipo) VALUES ('".$_REQUEST['rName']."', '".$_REQUEST['rSurname']."', '".$_REQUEST['rEmail']."', '".$_REQUEST['rNick']."', '".$_REQUEST['rPassword']."', '".$admin."')");
                            echo("Usuario <b>".$_REQUEST['rNick']." </b> registrado con éxito");
                        }
                    }

                    //Delete a user depending on the nick ***** LOGIN SCREEN ******
                    if(isset($_REQUEST['accion'])){
                        $result = $conn->query("DELETE FROM usuarios WHERE nick = \"".$_REQUEST['nickQueBorrar']."\"");
                        echo("Usuario borrado exitosamente");
                    }
                    break;
                } 
                
                // REGISTER MENU //////////////////////////////////////////////////////////////////////////
                case "RegisterMenu": {
                    //Insertar registros en una tabla usuarios
                    
                    echo("
                    <form action=actividad.php method=GET>
                    <p> Name: <input type=text required=required name=rName size=40> </p>
                    <p> Surname: <input type=text required=required name=rSurname size=40> </p>
                    <p> Email: <input type=text required=required name=rEmail size=40> </p>
                    <p> Nick: <input type=text required=required name=rNick size=40> </p>
                    <p> Password: <input type=text required=required name=rPassword size=40> </p>
                    <p> Administrador: <input type=checkbox name=rAdmin value=1> </p>");

                    if(isset($_REQUEST['accion']) && $_REQUEST['accion'] = "RegistroDesdeAdmin"){
                        echo("<p><input type=hidden name=nick value=\"".$_REQUEST['nick']."\"> </p>");
                        echo("<p><input type=hidden name=password value=\"".$_REQUEST['password']."\"> </p>");
                        $volverA = "UserMenu";
                    } else {
                        $volverA = "LoginMenu";
                    }

                    echo("<p><input type=hidden name=do value=$volverA> </p>");
                    echo("<p> <input type=submit value=Register></p>");
                    echo("</form>");

                    break;
                }

                // USER MENU //////////////////////////////////////////////////////////////////////////
                case "UserMenu": {
                    /*The users with a 1 en their type will be able to:
                    - Modify their own data in the users table
                    - Detelete treir own user from the table*/
                    $userFound = false;
                    
                    $result = $conn->query ("SELECT * FROM usuarios WHERE nick = \"".$_REQUEST['nick']."\"");
                    
                    while($registro = $result->fetch_object()){
                        
                        if($registro->passwd != $_REQUEST["password"]){
                            echo("Contraseña incorrecta <br><br>");
                            echo ("<a href='actividad.php?do=LoginMenu&username'> <button type='button'>Retroceder</button> </a>");
                            exit();
                        }

                        $userFound = true;
                        if($registro->tipo == 0){
                            $isAdmin = true;
                        } else {
                            $isAdmin = false;
                        }
                    }

                    //Delete a user depending on the nick **** USER MENU *****
                    if($userFound){
                        
                        echo("<b>Bienvenido a tu perfil ".$_REQUEST['nick']."</b><br>");

                        //Si venimos de borrar un perfil
                        if(isset($_REQUEST['accion'])){
                            $result = $conn->query("DELETE FROM usuarios WHERE nick = \"".$_REQUEST['nickQueBorrar']."\"");
                            echo("<br> Usuario \"".$_REQUEST['nickQueBorrar']."\" eliminado satisfactoriamente");
                        }

                        //Si venimos de modificar un perfil
                        if(isset($_REQUEST['mName'])){
                            $nickEncontrado = false;
                            //Recorremos los usuarios para ver si conciden con el nuevo nick
                            if(!$nickEncontrado){
                                $result = $conn->query ("SELECT * FROM usuarios WHERE nick = \"".$_REQUEST['nickQueModificar']."\"");
                                while($registro = $result->fetch_object()){
                                    $id = $registro->idusuario;
                                }

                                if(isset($_REQUEST['mAdmin'])){
                                    $admin = 0;
                                } else {
                                    $admin = 1;
                                }
                                
                                if(isset($_REQUEST['mNick'])){
                                    if($_REQUEST['nick'] == $_REQUEST['nickQueModificar']){
                                        $nick = $_REQUEST['mNick'];
                                        $pass = $_REQUEST['mPassword'];
                                    }
                                }
                                $result = $conn->query("UPDATE usuarios 
                                                        SET nombre = \"".$_REQUEST['mName']."\",
                                                        apellido = \"".$_REQUEST['mSurname']."\",
                                                        email = \"".$_REQUEST['mEmail']."\",
                                                        nick = \"".$_REQUEST['mNick']."\",
                                                        passwd = \"".$_REQUEST['mPassword']."\",
                                                        tipo = \"".$admin."\"
                                                    WHERE `usuarios`.`idusuario` = $id;");

                            echo("<br> Usuario \"".$_REQUEST['nickQueModificar']."\" modificado satisfactoriamente a \"".$_REQUEST['mNick']."\"");
                            }
                        }

                        echo("<table id= \"t01\"> 
                                <tr>
                                    <th> idUsuario </th>
                                    <th> Nombre </th>
                                    <th> Apellido </th>
                                    <th> Email </th>
                                    <th> Nick </th>
                                    <th> Password </th>
                                    <th> Tipo </th>
                                </tr>");
                        
                        if($isAdmin) {
                            // LOGIN USUARIO ADMIN //////////////////////////////////////////////////////////////////
                            echo("
                                <form>
                                    <p> <input type=hidden value=registroDesdeAdmin name=accion> </p>
                                    <p> <input type=hidden value=\"".$_REQUEST["nick"]."\" name=nick> </p>
                                    <p> <input type=hidden value=\"".$_REQUEST["password"]."\" name=password> </p>
                                    <p> <input type=hidden value=RegisterMenu name=do> </p>
                                    <p> <input type=submit value=\"Crear nuevo usuario\"> </p>
                                </form>
                            ");

                            //Al volver despues de registrar comprobamos si existe con ese nick
                            $usuarioYaCreado = null;
                            if(isset($_REQUEST['rNick'])){
                                $result = $conn->query("SELECT * FROM usuarios WHERE nick = '".$_REQUEST['rNick']."'");
                                while($registro = $result->fetch_object()){
                                    echo("Ya existe un usuario con el nick ".$_REQUEST["rNick"]."<br>");
                                    $usuarioYaCreado = true;
                                }

                                if(!$usuarioYaCreado){
                                    //Registrar usuario
                                    //Esto lo usamos para evitar problemas al no crear admins
                                    if(!isset($_REQUEST['rAdmin'])){
                                        //No admins
                                        $admin = 1;
                                    } else {
                                        //Admins
                                        $admin = 0;
                                    }
                                    $conn->query("INSERT INTO usuarios (nombre, apellido, email, nick, passwd, tipo) VALUES ('".$_REQUEST['rName']."', '".$_REQUEST['rSurname']."', '".$_REQUEST['rEmail']."', '".$_REQUEST['rNick']."', '".$_REQUEST['rPassword']."', '".$admin."')");
                                    echo("Usuario <b>".$_REQUEST['rNick']." </b> registrado con éxito");
                                }
                            }

                            echo("
                                <form>
                                    <p> <input type=hidden value=LoginMenu name=do > </p>
                                    <p> <input type=submit value=Desconectarse> </p>
                                </form>
                            ");

                            $result = $conn->query ("SELECT * FROM usuarios");
                            while($registro = $result->fetch_object()){
                                echo("<tr>
                                    <td> ".$registro->idusuario." </td>
                                    <td> ".$registro->nombre." </td>
                                    <td> ".$registro->apellido." </td>
                                    <td> ".$registro->email." </td>
                                    <td> ".$registro->nick." </td>
                                    <td> ".$registro->passwd." </td>
                                    <td> ".comprobarTipo($registro->tipo)." </td>
                                    <form> <td>
                                        <input type=hidden value=\"".$_REQUEST['nick']."\" name =\"nick\">
                                        <input type=hidden value=\"".$_REQUEST['password']."\" name =\"password\">
                                        <input type=hidden value=$registro->nick name =\"nickQueModificar\">
                                        <input type=hidden value=\"ModifyMenu\" name =\"do\">
                                        <input type=submit value=\"Modificar\" style=\"width:100%\">
                                    </form> </td>
                                    <form> <td>
                                        <input type=hidden value=\"".$_REQUEST['nick']."\" name =\"nick\">
                                        <input type=hidden value=\"".$_REQUEST['password']."\" name =\"password\">
                                        <input type=hidden value=\"Admin\" name =\"tipoUsuario\">
                                        <input type=hidden value=$registro->nick name =\"nickQueBorrar\">
                                        <input type=hidden value=\"DeleteMenu\" name =\"do\">
                                        <input type=submit value=\"Eliminar\" style=\"width:100%\">   
                                    </form></td>
                                </tr>");
                            }

                            // LOGIN USUARIO NORMAL //////////////////////////////////////////////////////////////////
                        } else {
                            if(isset($_REQUEST['mName'])){
                                $result = $conn->query ("SELECT * FROM usuarios WHERE nick = \"".$_REQUEST['mNick']."\"");
                            } else {
                                $result = $conn->query ("SELECT * FROM usuarios WHERE nick = \"".$_REQUEST['nick']."\"");
                            }
                            
                            echo("<br>");
                            while($registro = $result->fetch_object()){
                                echo("<tr>
                                    <td> ".$registro->idusuario." </td>
                                    <td> ".$registro->nombre." </td>
                                    <td> ".$registro->apellido." </td>
                                    <td> ".$registro->email." </td>
                                    <td> ".$registro->nick." </td>
                                    <td> ".$registro->passwd." </td>
                                    <td> ".comprobarTipo($registro->tipo)." </td>
                                    <form> <td>
                                        <input type=hidden value=\"".$_REQUEST['nick']."\" name =\"nick\">
                                        <input type=hidden value=\"".$_REQUEST['password']."\" name =\"password\">
                                        <input type=hidden value=$registro->nick name =\"nickQueModificar\">
                                        <input type=hidden value=\"ModifyMenu\" name =\"do\">
                                        <input type=submit value=\"Modificar\" style=\"width:100%\">
                                    </form> </td>
                                    <form> <td>
                                        <input type=hidden value=\"".$_REQUEST['nick']."\" name =\"nick\">
                                        <input type=hidden value=\"".$_REQUEST['password']."\" name =\"password\">
                                        <input type=hidden value=\"DeleteMenu\" name =\"do\">
                                        <input type=hidden value=\"".$_REQUEST['nick']."\" name =\"nickQueBorrar\">
                                        <input type=submit value=\"Eliminar\" style=\"width:100%\">   
                                    </form></td>
                                </tr>");
                            }
                        }
                        

                    } else {
                        echo("Usuario no encontrado <br><br>");
                        echo ("<a href='actividad.php?do=LoginMenu'> <button type='button'>Retroceder</button> </a>");
                        exit();
                    }
                    break;
                }

                // MODIFY USER MENU //////////////////////////////////////////////////////////////////////////
                case "ModifyMenu": {
                    $result = $conn->query ("SELECT * FROM usuarios WHERE nick = \"".$_REQUEST['nickQueModificar']."\"");
                    while($registro = $result->fetch_object()){
                        echo("Modificando el usuario ".$_REQUEST['nickQueModificar']);
                    }
                    
                    echo("
                    <form action=actividad.php method=GET>
                    <p> Name: <input type=text required=required name=mName size=40> </p>
                    <p> Surname: <input type=text required=required name=mSurname size=40> </p>
                    <p> Email: <input type=text required=required name=mEmail size=40> </p>
                    <p> Nick: <input type=text required=required name=mNick size=40> </p>
                    <p> Password: <input type=text required=required name=mPassword size=40> </p>
                    <p> Administrador: <input type=checkbox name=mAdmin value=1> </p>
                    <p><input type=hidden name=nick value=\"".$_REQUEST['nick']."\"> </p>
                    <p><input type=hidden name=password value=\"".$_REQUEST['password']."\"> </p>
                    <p><input type=hidden name=nickQueModificar value=\"".$_REQUEST['nickQueModificar']."\"> </p>");
                    echo("<p><input type=hidden name=do value=UserMenu> </p>");
                    echo("<p><input type=submit value=Modificar></p>");
                    echo("</form>");

                    echo("<form>");
                    echo("<p><input type=hidden name=do value=UserMenu> </p>");
                    echo("<p><input type=hidden name=nick value=\"".$_REQUEST['nick']."\"> </p>");
                    echo("<p><input type=hidden name=password value=\"".$_REQUEST['password']."\"> </p>");
                    echo("<p><input type=submit value=Cancelar></p>");
                    echo("</form>");
                    
                    break;
                }

                // DELETE USER MENU //////////////////////////////////////////////////////////////////////////
                case "DeleteMenu": {
                    if(!isset($_REQUEST['nickQueBorrar'])){
                        $aux = $_REQUEST['nick'];
                    } else {
                        $aux = $_REQUEST['nickQueBorrar'];
                    }
                    echo("¿Estás seguro de que deseas eliminar el usuario \"".$aux."\"? <br><br>");

                    if(isset($_REQUEST['tipoUsuario'])){
                        $siguiente = "UserMenu";
                    } else {
                        $siguiente = "LoginMenu";
                    }

                    if($_REQUEST['nickQueBorrar'] == $_REQUEST['nick']){
                        $siguiente = "LoginMenu";
                    }
                    
                    
                    echo("<form>
                            <input type=hidden value=\"".$_REQUEST['nick']."\" name =\"nick\">
                            <input type=hidden value=\"".$_REQUEST['password']."\" name =\"password\">
                            <input type=hidden value=\"UserMenu\" name =\"do\">
                            <input type=submit value=\"Retroceder\">
                        </form>
                        <form>
                            <input type=hidden value=\"".$aux."\" name =\"nickQueBorrar\">
                            <input type=hidden value=\"".$_REQUEST['nick']."\" name =\"nick\">
                            <input type=hidden value=\"".$_REQUEST['password']."\" name =\"password\">
                            <input type=hidden value=\"UsuarioBorrado\" name =\"accion\">
                            <input type=hidden value=\"$siguiente\" name =\"do\">
                            <input type=submit value=\"Eliminar\"> 
                        </form>");
                    break;
                }
               
                // CONNECTION ERROR //////////////////////////////////////////////////////////////////////////
                case "ConnectionError": {
                    //This page pops up if the program is not able t connect with the db
                    echo ("<h2><b> ***** Internal connection problem **** </b></h2>");
                    echo ($bd->connect_error);
                    ?>
                    <form action="actividad.php" method="POST">
                    <p> <input type="hidden" value="LoginMenu" name="do" > </p>
                    <p> <input type="submit" value="Re-Try"> </p>
                    </form>
                    <?php
                    break;
                }

                // PAGE NOT FOUND //////////////////////////////////////////////////////////////////////////
                default: {
                    //This will appear whenever the user opens a page that it's not done
                    echo ("<h2> Hola pequeño ¿Te has perdido? </h2>
                        <form>
                            <input type=\"hidden\" value=\"LoginMenu\" name=\"do\" >
                            <p> <input type=\"submit\" value=\"Volver\"> </p>
                        </form>");
                    
                    break;
                }
            }

            function comprobarTipo($numero){
                if($numero == 1){
                    return "Usuario(1)";
                } else {
                    return "Admin(0)";
                }
            }
        ?>
    </body>
</html>