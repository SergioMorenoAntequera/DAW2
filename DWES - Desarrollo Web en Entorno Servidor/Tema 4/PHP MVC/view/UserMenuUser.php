<?php
if ($data['security']->check()) {          
    echo("<br><h3><b>Bienvenido a tu perfil ".$data['security']->getNick()."</h3></b><br>");
    
    if(isset($data['ubc'])){
        echo("<b> Usuario ".$data['ubc']." modificado con exito </b><br><br>");
    }
    if(isset($data['umc'])){
        echo("<b> Usuario ".$data['umc']." modificado con exito </b><br><br>");
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
    // MOSTRAR TABLA USER //////////////////////////////////////////////////////////////////
        $nick = $data['user']->nick;
        echo("<tr>
            <td> ".$data['user']->idusuario." </td>
            <td> ".$data['user']->nombre." </td>
            <td> ".$data['user']->apellido." </td>
            <td> ".$data['user']->email." </td>
            <td> ".$data['user']->nick." </td>
            <td> ".$data['user']->passwd." </td>
            <td> ".$data['user']->tipo." </td>
            <td><form>
                <!-- nqm = Nick que modificar -->
                <input type=hidden value=$nick name ='nqm'>
                <input type=hidden value='ModifyMenu' name ='do'>
                <input type=submit value='Modificar' style='width:100%'>
            </form></td>
            <td><form>
                <!-- nqb = Nick que borrar -->
                <input type=hidden value=$nick name=nqb>
                <input type=hidden value='DeleteMenu' name ='do'>
                <input type=submit value='Eliminar' style='width:100%'>   
            </form></td>
        </tr>");
        
    echo("</table><br><br>");
?>

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