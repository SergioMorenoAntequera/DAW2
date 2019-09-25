<HTML>
    <HEAD>
        <title> Ejercicio 01: positivo, negativo // Parte 2 </title>
    </HEAD>
    <BODY>
        <?php
            $number = $_GET['number'];

            echo "<b>Numero elegido: $number </b></br>";
                
            if($number > 0){
                echo "Tu numero es mayor que cero";
            } else if ($number < 0) {
                echo "Tu numero es menor que cero";
            } else {
                echo "Tu numero es igual que 0";
            }
        ?>
    </BODY>
</HTML>