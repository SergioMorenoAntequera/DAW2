<?php
    $admin = $data['security']->isAdmin();
    $movie = $data['movie'];
    $rows = $movie->getAll();
    
    // Botón de Login //////////////////////////////////////////////////////////////
    if($data['security']->check()){
        $mensaje = "Tu perfil";
    } else {
        $mensaje = "Iniciar Sesión";
    }
    echo("<br><form>
        <input type='hidden' name='mainDo' value='UserController'>
        <input type='hidden' name='do' value='LoginMenu'>
        <input style='width:250px;' type='submit' value='$mensaje'>
    </form>");

    echo("<h1> Listado de películas </h1>");

    // BARRA DE BUSQUEDA Y SU SCRIPT //////////////////////////////////////////////////////////////
    echo("
    <input id = 'search' type='text' placeholder='Buscar por nombres..'>
    ");
    
    ?>
    <script>
        var search = document.getElementById("search"),
        movie = document.getElementsByTagName("span"),
        forEach = Array.prototype.forEach;

        search.addEventListener("keyup", function(e){
            var choice = search.value;
            forEach.call(movie, function(f){
                movieName = f.innerHTML;
                if (movieName.toLowerCase().search(choice.toLowerCase()) == -1){
                    f.parentNode.parentNode.style.display = "none";   
                } else {
                    f.parentNode.parentNode.style.display = "block";
                }
            });
        }, false);
    </script>
    <?php

    // MOSTRAMOS LAS PELICULAS //////////////////////////////////////////////////////////////
    $index = 0;
    echo"<div>";
    foreach($rows as $row){
        echo"<div style='float:left; width:25%;' background-color:white'%; '>";
            echo("<br><h3><span>".$row->title."</span></h3>");
            echo("<a href='index.php?do=MoviePage&id=$row->id'><img src=./resources/covers/".$row->cover." alt=''/></a><br><br>");

            if($admin){
                echo("<form action='index.php'>
                    <input type='hidden' name='adv' value='ListMenu'>
                    <input type='hidden' name='do' value='ModifyMenu'>
                    <input type='hidden' name='id' value='".$row->id."'>
                    <input style='width:250px;' type='submit' value='Modificar'>
                </form>");
                echo("<form action='index.php'>
                    <input type='hidden' name='do' value='DeleteMenu'>
                    <input type='hidden' name='id' value='".$row->id."'>
                    <input style='width:250px;' type='submit' value='Eliminar'>
                </form>");
            }

        echo"</div>";
    }
    echo"</div>";