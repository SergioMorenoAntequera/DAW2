<html>
    <head>
    </head>
    <body>
        <h1>Adivina mi número</h1>
        <?php
            if (isset($_REQUEST["do"]))
                $do = $_REQUEST["do"];
            else
                $do = "mostrarFormulario";
            
            switch ($do) {
                case "mostrarFormulario":
                        ?>
                        <form action="numsecreto.php" method="get">
                        
                            Introduce un número:<input type='text' name='numero'><br/>
                            <?php
                                if (isset($_REQUEST["numsecreto"]))
                                    $numsecreto = $_REQUEST["numsecreto"];
                                else
                                    $numsecreto = mt_rand(1,100);
                                echo "<input type='hidden' name='numsecreto' value='$numsecreto'><br/>";
                            ?>
                            <input type="hidden" name="do" value="comprobarNumero">
                            <input type="submit" value="Aceptar">
                        </form>
                        <?php
                break;
                case "comprobarNumero":
                    $numsecreto = $_REQUEST["numsecreto"];
                    $numero = $_REQUEST["numero"];

                    if ($numsecreto < $numero)
                        echo "Mi número es MENOR<br>";
                    else if ($numsecreto > $numero)
                        echo "Mi número es MAYOR<br>";
                    else 
                        echo "ENHORABUENA. Has acertado<br>";
                        
                    echo "<a href='numsecreto.php?do=mostrarFormulario&numsecreto=$numsecreto'>Volver</a>";
                break;
                default:
                    echo "Ooops. La página que has solicitado no existe";
                    break;
            } // switch
        ?>
    </body>
</html>
