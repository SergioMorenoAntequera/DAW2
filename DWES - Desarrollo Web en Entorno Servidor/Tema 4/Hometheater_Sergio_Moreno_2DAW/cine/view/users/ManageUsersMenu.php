
<h3> Menú de administración de usuarios </h3>

<?php
//Comprobamos si venimos de borrar un registro
    //nqb -> Nick que borrar
    if(isset($data['nqb'])){
        echo("<b> Usuario ".$data['nqb']." borrado con exito </b><br><br>");
    }
    // Usuario modificado correctamente
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
<table id="t01">
    <tr>
        <br>
        <th> ID </th>
        <th> Nick </th>
        <th> Email </th>
        <th> Password </th>
        <th> Tipo </th>
    </tr>

    <?php

    // MOSTRAR TABLA ANDMIN //////////////////////////////////////////////////////////////////
    foreach ($data['rows'] as $registro) {
        echo ("<tr>
            <td> " . $registro->id . " </td>
            <td> " . $registro->nick . " </td>
            <td> " . $registro->email . " </td>
            <td> " . $registro->password . " </td>
            <td> " . comprobarTipo($registro->type) . " </td>
            <td><form>
                <!-- id = Nick que modificar -->
                <input type=hidden value=$registro->nick name ='id'>
                <input type=hidden value='UserController' name ='mainDo'>
                <input type=hidden value='ModifyMenu' name ='do'>
                <input style='width:50%;' type=submit value='Modificar'>
            </form></td>
            <td><form>
                <!-- id = Nick que borrar -->
                <input type=hidden value=$registro->id name=id>
                <input type=hidden value=$registro->nick name=nick>
                <input type=hidden value='UserController' name ='mainDo'>
                <input type=hidden value='DeleteMenu' name ='do'>
                <input style='width:50%;' type=submit value='Eliminar'> 
            </form></td>
        </tr>");
    }
    echo ("</table><br><br>");
    ?>

    <!-- Ponemos el boton de crear aqui porque solo los admin pueden crear otro usuarios -->
    <form>
        <input type=hidden value=UserController name=mainDo>
        <p> <input type=hidden value=RegisterMenu name=do> </p>
        <div class=wrapper>
            <input style='width:20%;' type=submit value="Crear nuevo usuario">
        </div>
    </form>

    <!-- Ponemos el boton de crear aqui porque solo los admin pueden crear otro usuarios -->
    <form>
        <input type=hidden value=UserController name=mainDo>
        <p> <input type=hidden value=UserMenu name=do> </p>
        <div class=wrapper>
            <input style='width:20%;' type=submit value="Retroceder">
        </div>
    </form>