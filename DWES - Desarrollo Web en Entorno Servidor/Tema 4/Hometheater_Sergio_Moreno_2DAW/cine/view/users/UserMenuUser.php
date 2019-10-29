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
        <th> ID </th>
        <th> Nick </th>
        <th> Email </th>
        <th> Password </th>
        <th> Tipo </th>
        </tr>
    <?php
    // MOSTRAR TABLA USER //////////////////////////////////////////////////////////////////
        $nick = $data['user']->nick;
        echo("<tr>
            <td> ".$data['user']->id." </td>
            <td> ".$data['user']->nick." </td>
            <td> ".$data['user']->email." </td>
            <td> ".$data['user']->password." </td>
            <td> ".$data['user']->type." </td>
            <td><form>
                <!-- nqm = Nick que modificar -->
                <input type=hidden value=$nick name ='nqm'>
                <input type=hidden value='ModifyMenu' name ='do'>
                <input type=submit value='Modificar' style='width:50%;'>
            </form></td>
            <td><form>
                <!-- nqb = Nick que borrar -->
                <input type=hidden value=$nick name=nqb>
                <input type=hidden value='DeleteMenu' name ='do'>
                <input type=submit value='Eliminar' style='width:50%;'>   
            </form></td>
        </tr>");
        
    echo("</table><br><br>");
?>

    <form>
        <input type=hidden value='ListMenu' name ='do'>
        <input style='width:20%;' type=submit value='Mostrar Películas' style='width:50%;'>
    </form>

    <!-- Salimos del usuario porque queremos que esto esté en los 2 usuarios -->
    <form>
        <input type=hidden value=UserController name=mainDo >
        <input type=hidden value=DisconnectCheck name=do>
        <div class=wrapper>
        <input style='width:20%;' type=submit value=Desconectarse>
        </div>
    </form>

<?php
} else {
    echo("<script>location.href='index.php?do=NoPermissionError'</script>");
}