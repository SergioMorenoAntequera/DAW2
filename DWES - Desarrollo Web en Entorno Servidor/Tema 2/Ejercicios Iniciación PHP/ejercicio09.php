<html>
    <head>
        <title> Ejercicio 09: función potencia </title>
    </head>
    
    <body>
        <form name="form" action="ejercicio09.php" method="POST">
            <b>Base </b> <input type="number" required="required" name="x"/> <br/>
            <b>Exponente </b> <input type="number" required="required" name="y"/> <br/>
            <input type="submit" name="submit">
        </form>

        <?php
            if(isset($_POST['x']) && isset($_POST['y'])){
                echo ("Resultado de la potencia de ".$_POST['x']." y ".$_POST['y']." es: <br>"
                .potencia($_POST['x'], $_POST['y']));
            }

            function potencia($x, $y){
                return pow($x, $y);
            }
        ?>
    </body>
</html>