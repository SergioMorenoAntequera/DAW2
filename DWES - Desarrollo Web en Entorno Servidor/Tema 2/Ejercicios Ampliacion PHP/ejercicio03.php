<html>
    <head>
        <title> Ejercicio 03: lista de primos </title>
    </head>

    <body>
        <form name="form" action="ejercicio06.php" method="POST">
            <b> Introduce un numero para obtener los primos hasta ese numero </b> <br/>
            <input type="text" required="required" name="number"/>
            <input type="submit" name="submit">
        </form>

        <?php
            if(isset($_POST['number'])){ 
                buscarPrimos();
            }

            function buscarPrimos(){
                $number = $_POST['number'];
                $numerosPrimos = [];

                echo ("<h2> Numeros primos hasta ".$number.": </h2>");

                for($i = 1; $i <= $number; $i++){
                    if(comprobarSiEsPrimo($i)){
                        array_push($numerosPrimos, $i);
                    }
                }

                foreach($numerosPrimos as $valor){
                    echo($valor."<br>");
                }
            }

            function comprobarSiEsPrimo($numero){
                $esPrimo = true;

                for($i = 1; $i < $numero; $i++){
                    if($numero % $i == 0 && $i != 1){
                        $esPrimo = false;
                    }
                }
                return $esPrimo;
            }
        ?>
    </body>
</html>