<html>
    <head>
        <title> Ejercicio 08: juego del número secreto</title>
    </head>

    <body>
        <?php
            if(isset($_REQUEST['do'])){
                $do = $_REQUEST['do'];
            } else {
                $do = "PrimeraPagina";
            }
            
            switch ($do) {
                case "PrimeraPagina": {
                    ?>
                    <form name="form" action="ejercicio08.php" method="GET">
                        <b> ADIVINA MI NUMERO </b> <input type="text" name="number"/>
                        <!-- Modo para dentro del formulario modificar siempre la variable que maneja el cambio -->
                        <input type="hidden" value="SegundaPagina" name="do"/> <br/><br/>
                        <input type="submit" name="submit">
                    </form>  
                    <?php
                }
                break;
                case "SegundaPagina": {
                    echo "$do";
                    echo $_POST['do']." /// Esto es de la segunda página";
                }
                break;
                default: {
                    echo ("Ups, la pagina no existe");
                }
            }
        ?>
    </body>
</html>