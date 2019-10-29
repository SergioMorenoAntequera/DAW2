<?php
if ($data['security']->check()) {

    echo("<br><h3><b>Bienvenido a tu perfil ".$data['security']->getNick()."</h3></b><br>");

    ?>

    <!-- Boton que nos permite administrar todos los usuarios -->
    <form>
        <input type=hidden value=UserController name=mainDo>
        <p> <input type=hidden value=ManageUsers name=do> </p>
        <p> <input type=hidden value=true name=cda> </p>
        <div class=wrapper>
            <input style='width:20%;' type=submit value="Administrar Usuarios">
        </div>
    </form>

    <!-- Boton que nos permite administrar todos las peliculas -->
    <form>
        <p> <input type=hidden value=ManageMovies name=do> </p>
        <div class=wrapper>
            <input style='width:20%;' type=submit value="Administrar Películas">
        </div>
    </form>

    <!-- Boton que vuelve a la lista de peliculas -->
    <form>
        <p> <input type=hidden value=ListMenu name=do> </p>
        <div class=wrapper>
            <input style='width:20%;' type=submit value="Volver a la lista">
        </div>
    </form>

    <!-- Salimos del usuario porque queremos que esto esté en los 2 usuarios -->
    <form>
        <input type=hidden value=UserController name=mainDo>
        <p> <input type=hidden value=DisconnectCheck name=do > </p>
        <div class=wrapper>
        <input style='width:20%;'  type=submit value=Desconectarse>
        </div>
        </form>
    <?php

} else {
    echo("<script>location.href='index.php?do=NoPermissionError'</script>");
}