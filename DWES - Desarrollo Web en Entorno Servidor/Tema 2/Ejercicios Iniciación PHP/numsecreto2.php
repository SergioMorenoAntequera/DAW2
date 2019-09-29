<html>
    <head>
    </head>
    <body>
        <h1>Adivina mi número</h1>
        <?php
            session_start();
            
            if (isset($_REQUEST["do"]))
                $do = $_REQUEST["do"];
            else
                $do = "mostrarFormulario";
            
            switch ($do) {
                case "mostrarFormulario":
                        ?>
                        <form action="numsecreto2.php" method="get">
                        
                            Introduce un número:<input type='text' name='numero'><br/>
                            <?php
                                if (isset($_SESSION['numsecreto']))
                                    $numsecreto = $_SESSION['numsecreto'];
                                else {
                                    $_SESSION['numsecreto'] = mt_rand(1,100);
                                }
                            ?>
                            <input type="hidden" name="do" value="comprobarNumero">
                            <input type="submit" value="Aceptar">
                        </form>
                        <?php
                break;
                case "comprobarNumero":
                    $numsecreto = $_SESSION["numsecreto"];
                    $numero = $_REQUEST["numero"];

                    if ($numsecreto < $numero)
                        echo "Mi número es MENOR<br>";
                    else if ($numsecreto > $numero)
                        echo "Mi número es MAYOR<br>";
                    else 
                        echo "ENHORABUENA. Has acertado<br>";
                        
                    echo "<a href='numsecreto2.php?do=mostrarFormulario'>Volver</a>";
                break;
                default:
                    echo "Ooops. La página que has solicitado no existe";
                    break;
            } // switch
        ?>
    </body>
</html>
