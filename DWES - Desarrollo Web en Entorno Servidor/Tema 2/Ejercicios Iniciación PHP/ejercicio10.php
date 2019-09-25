<html>
    <head>
        <title> Ejercicio 10: devolución de arrays </title>
    </head>
    <body>
        <b>Introduce numeros para saber el mayor, menor y la media</b> <br/>
        <form name="form" action="ejercicio10.php" method="POST">
            <b>num1 </b> <input type="number" required="required" name="num1"/> <br/>
            <b>num2 </b> <input type="number" required="required" name="num2"/> <br/>
            <b>num3 </b> <input type="number" required="required" name="num3"/> <br/>
            <b>num4 </b> <input type="number" required="required" name="num4"/> <br/>
            <b>num2 </b> <input type="number" required="required" name="num5"/> <br/>

            <input type="submit" name="submit">
        </form>

        <?php
            if(isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['num3']) && isset($_POST['num4']) && isset($_POST['num5'])){ 
                $finalArray = manejarArray();
                echo ("Numero mayor: ".$finalArray[0]."<br>".
                        "Numero menor: ".$finalArray[1]."<br>".
                        "Media de todos: ".$finalArray[2]);
            }

            function manejarArray(){
                $auxArray = array($_POST['num1'], $_POST['num2'], $_POST['num3'], $_POST['num4'], $_POST['num5']);

                $menor = null;
                $mayor = null;
                $media = null;

                for($i = 0; $i < count($auxArray); $i++){
                    if($i == 0) {
                        $menor = $auxArray[$i];
                        $mayor = $auxArray[$i];
                    }
                    if($auxArray[$i] < $menor){
                        $menor = $auxArray[$i];
                    }
                    if($auxArray[$i] > $mayor){
                        $mayor = $auxArray[$i];
                    }
                    $media += $auxArray[$i];
                }
                $media /= count($auxArray);

                return array($mayor, $menor, $media);
            }
        ?>
    </body>
</html>