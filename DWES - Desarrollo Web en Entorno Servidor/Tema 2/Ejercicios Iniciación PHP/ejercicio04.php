<html>
    <head>
        <title> Ejercicio 04: tabla aleatoria de dimension variable </title>

        <style>
            table {
                text-align: center;
            }
            td {
                padding: 1.5vh;
            }
        </style>
    </head>

    <body>
        <form name="form" action="ejercicio04.php" method="GET">
            <b>Dimension en x </b> <input type="text" required="required" name="x"/> <br/>
            <b>Dimension en y </b> <input type="text" required="required" name="y"/> <br/>
            <input type="submit" name="submit">
        </form>

        <?php
            if(isset($_GET['x'], $_GET['y'])){ //Con isset ponemos a la espera de que ambos valores tengan valor
                createTable();
            }
            function createTable(){
                echo "<table border = 1>";
                for ($i = 1; $i <= $_GET['y']; $i++) {
                    echo "<tr>";
                    for ($j = 1; $j <= $_GET['x']; $j++) {
                        echo "<td>". rand(0, 9) ."</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
        ?>
    </body>
</html>