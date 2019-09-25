<html>
    <head>
        <title> Ejercicio 02: tabla de multiplicar </title>
    </head>
    <body>
        <?php
            for ($i = 1; $i <= 10; $i++) {

                echo "************</br>";
                echo "Tabla del $i</br>";
                echo "************</br>";

                for ($j = 1; $j <= 10; $j++) {
                    echo "$i x $j = ". $i * $j;
                    echo "</br>";
                }
                echo "</br>";
            }
        ?>
    </body>
</html>