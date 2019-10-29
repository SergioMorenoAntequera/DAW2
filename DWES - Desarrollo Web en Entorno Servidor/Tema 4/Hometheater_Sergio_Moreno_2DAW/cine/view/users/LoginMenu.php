<?php

if(isset($_SESSION['nick'])){
    echo("<script>location.href='index.php?mainDo=UserController&do=UserMenu'</script>");
}

echo("<br>");
echo("<h3>Bienvenid@, entra en tu cuenta o regístrate para empezar</h3>");

if($data['conn']->connect_error){
    echo ("<script>location.href='index.php?do=ConnectionError'</script>");
}
//Comprobamos si venimos de DESCONECTARNOS
// dc -> desconexion
if(isset($data['dc'])){
    echo("<b> Desconectado correctamente <br><br></b>");
}
//Comprobamos si venimos de borrar un usuario
// nqb -> nick que borrar
if(isset($data['nqb'])){
    echo("<b> Usuario ".$data['nqb']." borrado con exito <br><br></b>");
}
// Cuando llegamos de LoginCheck y ha habido algun problema
// bflc -> Back from loginCheck
if(isset($data['bflc'])){
    if($data['bflc'] == "pass"){
        echo("<br><p>Contraseña incorrecta</p><br>");
    }
    if($data['bflc'] == "user"){
        echo("<br><p>Usuario no encontrado</p><br>");
    }
}

?>
<form action="index.php" method="GET">
<p><input type="text" required="required" name="nick" placeholder="Usuario" size="40"> </p>
<p><input type="password" required="required" name="password" placeholder="Contraseña" size="40"> </p>

<!-- Boton de Login -->
<input type="hidden" name="mainDo" value="UserController">  
<p><input type="hidden" name="do" value="LoginCheck"> </p><br><br>
<p> 
    <div class='wrapper'>
    <input style='width:20%;' type="submit" value="Log in">
    </div>
</form>

<!-- Boton y form de Registro OPCION RETIRADA PORQUE SOLO HABRÁ USUARIOS ADMINISTRADORES
<form action="index.php" method="GET">
    <div class="wrapper">
    <input type="hidden" name="mainDo" value="UserController">  
    <input type="hidden" name="do" value="RegisterMenu">
    <input style='width:20%;' type="submit" value="Registrarse">
    </div>
</form> -->

<!-- Boton para retroceder -->
<form>
    <div class="wrapper">
    <input type="hidden" name="do" value="ListMenu">
    <input style='width:20%;' type="submit" value="Volver a la lista">
    </div>
</form>
</p>