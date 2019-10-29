<h3> Menú de administración de películas </h3>
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
?>

<!-- Primera linea de la tabla con los nombres -->
<table id="t01">
    <tr>
        <br>
        <th> ID </th>
        <th> Title </th>
        <th> Year </th>
        <th> Duration </th>
        <th> Rating </th>
        <th> Cover </th>
        <th> Filepath </th>
        <th> Filename </th>
        <th> External URL</th>
    </tr>

    <?php

    // MOSTRAR TABLA ANDMIN //////////////////////////////////////////////////////////////////
    foreach ($data['rows'] as $registro) {
        echo ("<tr>
            <td> " . $registro->id . " </td>
            <td> " . $registro->title . " </td>
            <td> " . $registro->year . " </td>
            <td> " . $registro->duration . " </td>
            <td> " . $registro->rating . " </td>
            <td> " . $registro->cover . " </td>
            <td> " . $registro->filepath . " </td>
            <td> " . $registro->filename . " </td>
            <td> " . $registro->external_url . " </td>
            <td><form>
                <!-- nqm = Nick que modificar -->
                <input type='hidden' name='adv' value='ManageMovies'>
                <input type=hidden value=$registro->id name ='id'>
                <input type=hidden value='ModifyMenu' name ='do'>
                <input style='width:50%;' type=submit value='Modificar'>
            </form></td>
            <td><form>
                <!-- cda = Creado desde admin -->
                <input type=hidden value=true name=cda>
                <input type=hidden value=$registro->id name=id>
                <input type=hidden value='DeleteMenu' name ='do'>
                <input style='width:50%;' type=submit value='Eliminar'> 
            </form></td>
        </tr>");
    }
    echo ("</table><br><br>");
    ?>

    <!-- Ponemos el boton de crear aqui porque solo los admin pueden crear otro usuarios -->
    <form>
        <!-- rda = Registro desde admin -->
        <p> <input type=hidden value=RegisterMenu name=do> </p>
        <div class=wrapper>
            <input style='width:20%;' type=submit value="Crear nueva película">
        </div>
    </form>

    <!-- Ponemos el boton de crear aqui porque solo los admin pueden crear otro usuarios -->
    <form>
        <!-- rda = Registro desde admin -->
        <input type=hidden value=UserController name=mainDo>
        <p> <input type=hidden value=UserMenu name=do> </p>
        <div class=wrapper>
            <input style='width:20%;' type=submit value="Retroceder">
        </div>
    </form>