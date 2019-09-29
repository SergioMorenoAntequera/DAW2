<html>
    <head>
        <title> Ejercicio 01: Cuadrados aleatorios </title>

        <style type="text/css">
            .polig{
                width:50px;
                height:50px;
                position:fixed;
            }
        </style>
    </head>

    <body>
        <?php
            $colors = ["SILVER", "GRAY", "BLACK", "RED", "MAROON", "YELLOW", "OLIVE", "LIME", "GREEN", "AQUA", "TEAL", "BLUE", "NAVY", "FUCHSIA", "PURPLE"];
            
            for($i = 0; $i < 100; $i++){
                $x = rand(0, 1350);
                $y = rand(0, 600);
                $color = rand(0, count($colors));
                echo ("<div style='background:".$colors[rand(0, count($colors)-1)]."; left:".$x."; top:".$y.";'  class="."polig"."></div>");
            }
             
        ?>
    </body>
</html>