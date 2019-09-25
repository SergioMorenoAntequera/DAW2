<html>
    <head>
        <title> Ejercicio 05: palíndromo </title>
    </head>

    <body>
        <form name="form" action="ejercicio05.php" method="GET">
            <b> Introduce una cadena para comprobar si es palíndroma </b> <br/>
            <input type="text" required="required" name="string"/>
            <input type="submit" name="submit">
        </form>

        <?php
            if(isset($_GET['string'])){ 
                checkString();
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