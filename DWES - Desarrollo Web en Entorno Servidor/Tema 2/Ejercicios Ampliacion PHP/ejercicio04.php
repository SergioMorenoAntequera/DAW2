<html>
    <head>
        <title> Ejercicio 04 lista de emirps </title>
    </head>

    <body>
        <form name="form" action="ejercicio07.php" method="POST">
            <b> Introduce un numero para obtener los emirps hasta ese numero </b> <br/>
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
                $numerosPrimosInvertidos = [];

                echo ("<h2> Numeros emirps hasta ".$number.": </h2>");

                if($number < 10){
                    return;
                }

                for($i = 10; $i <= $number; $i++){
                    if(comprobarSiEsPrimo($i)){

                        //Darle la vuelta
                        $invertido = strrev($i);
                        
                        //Comprobar otra vez si es primo
                        if(comprobarSiEsPrimo($invertido)){
                            array_push($numerosPrimos, $i);
                            array_push($numerosPrimosInvertidos, $invertido);
                        }
                    }
                }

                for($i = 0; $i <= count($numerosPrimos)-1; $i++){
                    echo("Numero: ".$numerosPrimos[$i]." ///  Invertido: ".$numerosPrimosInvertidos[$i]."<br>");
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