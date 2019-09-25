<html>
    <head>
        <title> Ejercicio 03: tabla de multiplicar en forma de tabla // Parten 2</title>
    
        <style>
            td {
                padding: 1.5vh;
            }
            .primera {
                background-color: #C2C2C2;
            }
        </style>
    </head>

    <body>
        <table border="1" style="text-align: center;">
            <?php
                echo "<tr>
                    <td class=primera colspan=5>
                        <b>Tabla de multiplicar del numero ".$_GET['number']."</b>
                    </td>
                </tr>";
                
                $index = 1;
                for ($i = 1; $i <= 5; $i++) {
                    echo "<tr>";
                    for ($j = 1; $j <= 5; $j++) {
                        echo "<td>".$_GET['number']." x ".$index." = ".$_GET['number'] * $index++." </td>";
                    }
                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>

