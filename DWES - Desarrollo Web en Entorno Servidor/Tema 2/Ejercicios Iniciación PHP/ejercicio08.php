<html>
    <head>
        POR TERMINAR
        <title> Ejercicio 08: juego del número secreto</title>
    </head>

    <body>
        <form name="form" action="ejercicio08.php" method="POST">
            <b> ADIVINA MI NUMERO </b>
            <input type="text" name="number"/> <br/><br/>
            <input type="submit" name="submit">
        </form>

        <?php

            if(!isset($_SESSION['test'])){
                $_SESSION['test'] = rand(0, 100);
            }
            
            if(isset($_POST['number'])){ 
                echo("asd ".$_POST['number']." // aaasd ".$_SESSION['test']);

                /*if($_SESSION['test'] == 1) {
                    echo("???");
                    $_SESSION['test'] = null;
                }*/
            }

            function checkString(){
                $cadenaCortada = strtolower(str_replace(" ", "", $_GET['string']));
                $cadenaInvertida = strtolower(strrev($cadenaCortada));
                if($cadenaCortada == $cadenaInvertida){
                    echo("<h1>La cadena es palindroma </h1>");
                } else {
                    echo("<h1>La cadena NO es palindroma </h1>");
                }
            }
        ?>
    </body>
</html>