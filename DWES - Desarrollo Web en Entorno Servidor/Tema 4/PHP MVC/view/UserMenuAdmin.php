<?php
if ($data['security']->check()) {
                
    echo("<br><h3><b>Bienvenido a tu perfil ".$data['security']->getNick()."</h3></b><br>");

    //Comprobamos si venimos de borrar un registro
    //nqb -> Nick que borrar
    if(isset($data['nqb'])){
        echo("<b> Usuario ".$data['nqb']." borrado con exito </b><br><br>");
    }
    if(isset($data['umc'])){
        echo("<b> Usuario ".$data['umc']." modificado con exito </b><br><br>");
    }

    //var_dump($_SESSION);
    function comprobarTipo($numero) {
        if ($numero == 1) {
            return "Usuario(1)";
        } else {
            return "admin(0)";
        }
    }
    ?>
    
    <!-- Primera linea de la tabla con los nombres -->
    <table id= "t01"> 
        <tr>
        <th> idUsuario </th>
        <th> Nombre </th>
        <th> Apellido </th>
        <th> Email </th>
        <th> Nick </th>
        <th> Password </th>
        <th> Tipo </th>
        </tr>
    
    <?php
    // MOSTRAR TABLA ANDMIN //////////////////////////////////////////////////////////////////

    foreach ($data['rows'] as $registro){
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
    ?>

    <!-- Ponemos el boton de crear aqui porque solo los admin pueden crear otro usuarios -->
        <form>
            <!-- rda = Registro desde admin -->
            <p> <input type=hidden value=RegisterMenu name=do> </p>
            <p> <input type=hidden value=true name=cda> </p>
            <div class=wrapper>
                <input type=submit value="Crear nuevo usuario">
            </div>
        </form>

    <!-- Salimos del usuario porque queremos que esto esté en los 2 usuarios -->
    <form>
        <p> <input type=hidden value=DisconnectCheck name=do > </p>
        <div class=wrapper>
        <input type=submit value=Desconectarse>
        </div>
        </form>
    
    <?php

} else {
    echo("<script>location.href='index.php?do=NoPermissionError'</script>");
}