<html>
    <head>
        <title> Actividad obligatoria PHP </title>
        <style>
            body {
                color: white;
                background-color: #1c2329;
                text-align: center;
                margin: 0;
                font-family:Arial;
            }
            table {
                width:90%;
                margin-left:auto; 
                margin-right:auto;
            }
            table, th, td {
                color:black;
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

            .header {
                padding: 2px;
                font-family: 'Lato', sans-serif;
                text-align: center;
                background: #FF5B5B;
                color: white;
                font-size: 24px;
            }

            p { color: #adb7bd; font-family: 'Lucida Sans', Arial, sans-serif; font-size: 16px; line-height: 26px; margin: 0; }
            a { color: #fe921f; text-decoration: underline; }
            a:hover { color: #ffffff }

            input[type=text],[type=password]  {
                width: 35%;
                box-sizing: border-box;
                border: 2px solid #ccc;
                border-radius: 4px;
                font-size: 16px;
                background-color: white;
                background-position: 10px 10px; 
                background-repeat: no-repeat;
                padding: 12px 20px 12px 20px;
                margin: 10px 10px 10px 10px;
                -webkit-transition: width 0.4s ease-in-out;
                transition: width 0.4s ease-in-out;
            }
            input[type=text]:focus, [type=password]:focus{
                width: 40%;
            }

            .wrapper {
                text-align: center;
            }

            input[type=submit] {
                width: 15%;
                padding: 16px 3px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 0px 2px;
                -webkit-transition-duration: 0.4s; /* Safari */
                transition-duration: 0.4s;
                cursor: pointer;
                background-color: white;
                color: black;
                border: 2px solid #e7e7e7;
                border-radius: 8px;
            }
            input[type=submit]:hover {
                background-color: #5D5D5D;
                border: 2px solid #5D5D5D;
            }

        </style>
    </head>
    
    <body>
        <div class="header">
            <h1>phpMyAdmin2</h1>
        </div>    

        <?php
        //Header of the controler
        if(isset($_REQUEST['do'])){
            $do = $_REQUEST['do'];
        } else {
            $do = "LoginMenu";
        }
        //Connections
        $conn = new mysqli('localhost', 'root', 'admin5', 'practicaphp');
        $conn->set_charset("utf8");
        //Session
        session_start();

        switch($do) {
            // LOGIN MENU //////////////////////////////////////////////////////////////////////////
            case "LoginMenu": {
                if(isset($_SESSION['nick'])){
                    echo("<script>location.href='actividad.php?do=UserMenu'</script>");
                }

                echo("<br>");
                echo("<h3>Bienvenid@, entra en tu cuenta o regístrate para empezar</h3>");

                if($conn->connect_error){
                    echo ("<script>location.href='actividad.php?do=ConnectionError'</script>");
                }

                //Comprobamos si venimos de borrar un usuario
                // nqb -> nick que borrar
                if(isset($_REQUEST['nqb'])){
                    echo("<b> Usuario ".$_REQUEST['nqb']." borrado con exito <br><br></b>");
                    session_destroy();
                }

                // Cuando llegamos de LoginCheck y ha habido algun problema
                // bflc -> Back from loginCheck
                if(isset($_REQUEST['bflc'])){
                    if($_REQUEST['bflc'] == "pass"){
                        echo("<br><p>Contraseña incorrecta</p><br>");
                    }
                    if($_REQUEST['bflc'] == "user"){
                        echo("<br><p>Usuario no encontrado</p><br>");
                    }
                }

                ?>
                <form action="actividad.php" method="GET">
                <p><input type="text" required="required" name="nick" placeholder="Usuario" size="40"> </p>
                <p><input type="password" required="required" name="password" placeholder="Contraseña" size="40"> </p>
                <!-- Boton de Login -->
                <p><input type="hidden" name="do" value="LoginCheck"> </p><br><br>
                <p> 
                    <div class='wrapper'>
                    <input type="submit" value="Log in">
                    </div>
                </form>
                <!-- Boton y form de Registro -->
                <form action="actividad.php" method="GET">
                <input type="hidden" name="do" value="RegisterMenu">
                    <div class="wrapper">
                    <input type="submit" value="Registrarse">
                    </div>
                </form>
                </p>
                <?php

                break;
            }

            // LOGIN CHECK ///////////////////////////////////////////////////////////////////////////////////
            case "LoginCheck": {
                if(isset($_REQUEST['nick']) && isset($_REQUEST['password'])){
                    //Requisitos el nick y la contraseña en REQUEST
                $result = $conn->query ("SELECT * FROM usuarios WHERE nick = \"".$_REQUEST['nick']."\"");
                while($registro = $result->fetch_object()){
                    //Comprobamos si la contraseña es correcta
                    //Si NO ES correcta acaba el programa
                    if($registro->passwd != $_REQUEST["password"]){
                        //bflc -> back from logincheck // pass
                        echo ("<script>location.href='actividad.php?do=LoginMenu&bflc=pass'</script>");
                    }

                    //Si ES correcta selecciona el tipo de usuario y entra
                    $_SESSION["nick"] = $_REQUEST["nick"];
                    if($registro->tipo == 0){
                        $_SESSION["admin"] = true;
                    } else {
                        $_SESSION["admin"] = false;
                    }

                    //Nos manda al panel del usuario
                    echo("<script>location.href='actividad.php?do=UserMenu'</script>");
                    //header("Location: http://localhost/ejercicios3/actividad.php?do=UserMenu");
                }

                //Si llegamos aqui es que no hemos encontrado el usuario
                //bflc -> back from logincheck // user
                echo ("<script>location.href='actividad.php?do=LoginMenu&bflc=user'</script>");

                } else {
                    echo("<script>location.href='actividad.php?do=NoPermissionError'</script>");
                }
                
                break;
            }

            // REGISTER MENU //////////////////////////////////////////////////////////////////////////
            case "RegisterMenu": {
                //Insertar registros en una tabla usuarios
                // uyc = Usuario ya creado
                if(isset($_REQUEST['uyc'])){
                    echo("<br>Usuario <b>".$_REQUEST['uyc']."</b> ocupado, elige otro nick");
                }

                ?>
                <br>
                <h3>Introduce los datos para el registro</h3>
                
                <form action=actividad.php method=GET>
                <p><input type=text required=required name=rName placeholder=Nombre size=40> </p>
                <p><input type=text required=required name=rSurname placeholder=Apellido size=40> </p>
                <p><input type=text required=required name=rEmail placeholder=Email size=40> </p>
                <p><input type=text required=required name=rNick placeholder=Nick size=40> </p>
                <p><input type=text required=required name=rPassword placeholder=Contraseña size=40> </p>
                <?php
                //Ponemos esto aqui para solo poder hacer admins desde admin
                //cda -> Creando desde admin
                if(isset($_REQUEST['cda'])){
                    echo("<p> Administrador: <input type=checkbox name=rAdmin value=1> </p><br>");
                } else {
                    echo("<br>");
                }
                ?>
                
                
                <?php

                //Boton de Registrar
                echo("<p><input type=hidden name=do value='RegisterCheck'></p>
                    <div class='wrapper'>
                    <input type=submit value=Registrar>
                    </div>
                    </form>");

                echo("<form action=actividad.php method=GET>
                    <p><input type=hidden name=do value='LoginMenu'> </p>
                    <div class='wrapper'>
                    <p><input type=submit value=Retroceder></p>
                    </div>
                    </form>");

                break;
            }

            // REGISTER CHECH //////////////////////////////////////////////////////////////////////////
            case "RegisterCheck": {
                //Si está declara la variable que se crea al hacer un registro
                //Al volver despues de registrar comprobamos si existe con ese nick
                $usuarioYaCreado = null;
                if(isset($_REQUEST['rName'])){

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
                            //admins
                            $admin = 0;
                        }
                        $conn->query("INSERT INTO usuarios (nombre, apellido, email, nick, passwd, tipo) VALUES ('".$_REQUEST['rName']."', '".$_REQUEST['rSurname']."', '".$_REQUEST['rEmail']."', '".$_REQUEST['rNick']."', '".$_REQUEST['rPassword']."', '".$admin."')");
                        
                        //Comprobamos si estamos logueados lo que significa
                        //que estamos creando el usuario desde un admin y no cambiamos la sesion
                        if(isset($_SESSION['nick'])){
                            echo("<script>location.href='actividad.php?do=UserMenu'</script>");
                            //header("Location: http://localhost/ejercicios3/actividad.php?do=UserMenu");
                            //break;
                        }

                        // Le damos valor a la variable de nick y contraseña
                        // y la mandamos a UserMenu para que se loguee solo
                        $rNick = $_REQUEST['rNick'];
                        $rPassword = $_REQUEST['rPassword'];
                        echo("<script>location.href='actividad.php?do=LoginCheck&nick=$rNick&password=$rPassword'</script>");
                        //header("Location: http://localhost/ejercicios3/actividad.php?do=LoginCheck&nick=$rNick&password=$rPassword");
                    }

                    if($usuarioYaCreado){
                        //Mandamos una señal a la pagina de registro y la actualizamos
                        //uyc -> Usuario ya creado
                        echo("<script>location.href='actividad.php?do=RegisterMenu&uyc=$rNick'</script>");
                        //header("Location: http://localhost/ejercicios3/actividad.php?do=RegisterMenu&uyc=$rNick");
                    }
                } else {
                    echo("<script>location.href='actividad.php?do=NoPermissionError'</script>");
                }

                break;
            }
            
            // USER MENU //////////////////////////////////////////////////////////////////////////
            case "UserMenu": {
                if (isset($_SESSION["nick"])) {
                    
                    echo("<br><h3><b>Bienvenido a tu perfil ".$_SESSION["nick"]."</h3></b><br>");

                    //Comprobamos si venimos de borrar un registro
                    if(isset($_REQUEST['nqb'])){
                        echo("<b> Usuario ".$_REQUEST['nqb']." borrado con exito </b>");
                    }
                    
                    //var_dump($_SESSION);
                    //Primera linea de la tabla con los nombres
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
                    
                    // MOSTRAR TABLA ANDMIN //////////////////////////////////////////////////////////////////
                    if($_SESSION["admin"]) {
                        //Mostramos la tabla con todos los usuarios
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
                                <td><form>
                                    <!-- nqm = Nick que modificar -->
                                    <input type=hidden value=$registro->nick name ='nqm'>
                                    <input type=hidden value='ModifyMenu' name ='do'>
                                    <input type=submit value='Modificar' style='width:100%'>
                                </form></td>
                                <td><form>
                                    <!-- nqb = Nick que borrar -->
                                    <input type=hidden value=$registro->nick name=nqb>
                                    <input type=hidden value='DeleteMenu' name ='do'>
                                    <input type=submit value='Eliminar' style='width:100%'>   
                                </form></td>
                            </tr>");
                        }
                        echo("</table><br><br>");
                        
                        //Ponemos el boton de crear aqui porque solo los admin pueden crear otro usuarios
                        echo("
                            <form>
                                <!-- rda = Registro desde admin -->
                                <p> <input type=hidden value=RegisterMenu name=do> </p>
                                <p> <input type=hidden value=true name=cda> </p>
                                <div class=wrapper>
                                    <input type=submit value=\"Crear nuevo usuario\">
                                </div>
                            </form>
                        ");
                    }

                    // LOGIN USUARIO NORMAL //////////////////////////////////////////////////////////////////
                    if(!$_SESSION['admin']){
                        
                        echo("<br>");
                        $result = $conn->query ("SELECT * FROM usuarios WHERE nick = \"".$_SESSION['nick']."\"");
                        while($registro = $result->fetch_object()){
                            echo("<tr>
                                <td> ".$registro->idusuario." </td>
                                <td> ".$registro->nombre." </td>
                                <td> ".$registro->apellido." </td>
                                <td> ".$registro->email." </td>
                                <td> ".$registro->nick." </td>
                                <td> ".$registro->passwd." </td>
                                <td> ".comprobarTipo($registro->tipo)." </td>
                                <td> <form> 
                                    <!-- nqm = Nick que modificar -->
                                    <input type=hidden value=$registro->nick name ='nqm'>
                                    <input type=hidden value='ModifyMenu' name ='do'>
                                    <input type=submit value='Modificar' style='width:100%'>
                                </form> </td>
                                <td> <form>
                                    <!-- nqb = Nick que borrar -->
                                    <input type=hidden value=$registro->nick name ='nqb'>
                                    <input type=hidden value='DeleteMenu' name ='do'>
                                    <input type=submit value='Eliminar' style='width:100%'>   
                                </form></td>
                            </tr>");
                        }
                        echo("</table><br><br>");
                    }

                    

                    //Salimos del usuario porque queremos que esto esté en los 2 usuarios
                    echo("<form>
                        <p> <input type=hidden value=DisconnectsCheck name=do > </p>
                        <div class=wrapper>
                        <input type=submit value=Desconectarse>
                        </div>
                        </form>");

                } else {
                    echo("<script>location.href='actividad.php?do=NoPermissionError'</script>");
                }
                break;
            }

            // DISCONNECTION CHECK //////////////////////////////////////////////////////////////////////////
            case "DisconnectsCheck": {
                session_destroy();
                echo("<script>location.href='actividad.php?do=LoginMenu'</script>");
                break;
            }

            // MODIFY USER MENU //////////////////////////////////////////////////////////////////////////
            case "ModifyMenu": {
                if(isset($_SESSION['nick'])){
                    echo("<br>");
                    echo("<h3>Modificando el usuario ".$_REQUEST['nqm']."</h3>");
                    
                    // nyo = Nick ya ocupado
                    if(isset($_REQUEST['nyo'])){
                        echo("<h3>El nick ".$_REQUEST['nyo']." ya se encuentra en uso </h3>");
                    }
    
                    echo("
                        <form action=actividad.php method=GET>
                        <p><input type=text required=required name=mName placeholder=Nombre size=40> </p>
                        <p><input type=text required=required name=mSurname placeholder=Apellidos size=40> </p>
                        <p><input type=text required=required name=mEmail placeholder=Email size=40> </p>
                        <p><input type=text required=required name=mNick placeholder=Nick size=40> </p>
                        <p><input type=text required=required name=mPassword placeholder=Password size=40> </p>
                        <p> administrador: <input type=checkbox name=mAdmin value=1> </p>
                        <p><input type=hidden name=nqm value=\"".$_REQUEST['nqm']."\"> </p>
                        <br>");
                        
                    echo("<p><input type=hidden name=do value=ModifyCheck> </p>");
                    echo("<p><input type=submit value=Modificar></p>");
                    echo("</form>");
    
                    echo("<form>");
                    echo("<p><input type=hidden name=do value=UserMenu> </p>");
                    echo("<p><input type=submit value=Cancelar></p>");
                    echo("</form>");
                } else {
                    echo("<script>location.href='actividad.php?do=NoPermissionError'</script>");
                }
                break;
            }

            case "ModifyCheck": {
                if(isset($_SESSION['nick'])){
                    //Recorremos los usuarios para ver si conciden con el nuevo nick
                    //Si lo hace lo mandamos al menu de modificar otra vez
                    $result = $conn->query ("SELECT * FROM usuarios");
                    while($registro = $result->fetch_object()){                             // nyo = Nick ya ocupado
                        if($registro->nick == $_REQUEST['mNick']){
                            if($registro->nick != $_SESSION['nick']){
                                header("Location: http://localhost/ejercicios3/actividad.php?do=ModifyMenu&nqm=".$_REQUEST['nqm']."&nyo=".$_REQUEST['mNick']);
                                exit;
                            }
                        }
                    }

                    //Si no encuetra el usuario 
                    $result = $conn->query ("SELECT * FROM usuarios WHERE nick = \"".$_REQUEST['nqm']."\"");
                    while($registro = $result->fetch_object()){
                        //Cogemos la id para cambiar desde aqui en el select
                        $id = $registro->idusuario;

                        //Preparaciones para asignar el valor de admin
                        if(isset($_REQUEST['mAdmin'])){
                            $admin = 0;
                            $adminAux = true;
                        } else {
                            $admin = 1;
                            $adminAux = false;
                        }
                        //Landamos la actualizacion
                        $result = $conn->query("UPDATE usuarios SET nombre = \"".$_REQUEST['mName']."\", apellido = \"".$_REQUEST['mSurname']."\", email = \"".$_REQUEST['mEmail']."\", nick = \"".$_REQUEST['mNick']."\", passwd = \"".$_REQUEST['mPassword']."\", tipo = \"".$admin."\" WHERE `usuarios`.`idusuario` = $id;");
                        
                        //Si modificamos los datos del que estamos rehacemos la sesion
                        console.log($_REQUEST['nqm']);
                        console.log($_REQUEST['nick']);
                        
                        if($_REQUEST['nqm'] == $_SESSION['nick']){
                            $_SESSION['nick'] = $_REQUEST['mNick'];
                            $_SESSION['admin'] = $adminAux;
                        }
                        //Nos dirigimos al menu de usuario
                        echo("<script>location.href='actividad.php?do=UserMenu'</script>");
                        //header("Location: http://localhost/ejercicios3/actividad.php");
                    }
                } else {
                    echo("<script>location.href='actividad.php?do=NoPermissionError'</script>");
                }
                break;
            }
            
            // DELETE USER MENU //////////////////////////////////////////////////////////////////////////
            case "DeleteMenu": {
                if (isset($_SESSION["nick"])) {
                    echo("<br>");
                    $nqb = $_REQUEST['nqb'];

                    echo("¿Estás seguro de que deseas eliminar el usuario \"".$nqb."\"? <br><br>");

                    echo("<form>
                            <input type=hidden value='UserMenu' name ='do'>
                            <input type=submit value='Retroceder'>
                        </form>
                        <form>
                            <input type=hidden value=$nqb name ='nqb'>
                            <input type=hidden value='DeleteCheck' name ='do'>
                            <input type=submit value='Eliminar'> 
                        </form>");
                } else {
                    echo("<script>location.href='actividad.php?do=NoPermissionError'</script>");
                }
                break;
            }
            
            // DELETE CHECK //////////////////////////////////////////////////////////////////////////
            case "DeleteCheck": {
                if(isset($_SESSION['nick'])){

                    $result = $conn->query("DELETE FROM usuarios WHERE nick = \"".$_REQUEST['nqb']."\"");

                    //Si hemos destruido un usuario propio nos manda al menú principal
                    if($_REQUEST['nqb'] == $_SESSION['nick']){
                        header("Location: http://localhost/ejercicios3/actividad.php?do=LoginMenu&nqb=".$_REQUEST['nqb']);
                        break;
                    } else {
                        header("Location: http://localhost/ejercicios3/actividad.php?do=UserMenu&nqb=".$_REQUEST['nqb']);
                        break;
                    }
                } else {
                    echo("<script>location.href='actividad.php?do=NoPermissionError'</script>");
                }
            }
           
            // CONNECTION ERROR //////////////////////////////////////////////////////////////////////////
            case "ConnectionError": {
                echo("<br>");
                //This page pops up if the program is not able t connect with the db
                echo ("<h2><b> ***** Internal connection problem **** </b></h2>");
                echo ($bd->connect_error);
                ?>
                <form action="actividad.php" method="GET">
                <p> <input type="hidden" value="LoginMenu" name="do" > </p>
                <p> <input type="submit" value="Re-Try"> </p>
                </form>
                <?php
                break;
            }

            case "NoPermissionError":{
                echo("<br><br><h3> Quieto vaquero, no tienes acceso a esta página. </h3>
                    <p> Inicia sesión y ya hablamos <br><br></p>
                    <form>
                    <input type=hidden value='LoginMenu' name ='do'>
                    <input type=submit value='Vale, lo siento'> 
                    </form>");
                break;
            }

            // PAGE NOT FOUND //////////////////////////////////////////////////////////////////////////
            default: {
                echo("<br>");
                //This will appear whenever the user opens a page that it's not done
                echo ("<h2> Hola pequeño 404 ¿Te has perdido? </h2>
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
                return "admin(0)";
            }
        }
        ?>
    </body>
</html>