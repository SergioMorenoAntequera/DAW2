showDistanceToTheScreenSides();

//Para saber las dimensiones de nuestra pantalla en píxeles
function showScreenDimensions() {
    console.log("Anchura: " + screen.width + "  // Altura: " + screen.height);
}

//La diferencia entre este y el anterior es que nuestra página no cupa toda la pantalla
//Y por lo tanto por ejemplo la barra de busqueda ocupa un espacio, esto nos muestra el máximo posible
function showScreenAvailableDimensions(){
    console.log("Anchura disponible: " + screen.availWidth + " // Altura Disponible:" + screen.availHeight);
}

//Para saber información relacionada con la capacidad de nuestros píxeles de representar colores
function showPixelInfo() {
    //Sabemos el numero de colores que puede representar nuestra pantalla
    
    /* Bit Depth	Number of Colours
    1 bit	2 colours (usually black and white)
    2 bits	4 colours
    4 bits	16 colours
    8 bit greyscale	256 shades of grey
    8 bit colour	256 colours
    16 bits	65, 536 colours (known as 'high' colour)
    24 bits	16.7 million colours (known as 'true' colour)
    32 bits	16.7million colours plus greyscale mask (alpha channel)*/

    console.log("Numero de bits necesarios para representar un color: " + screen.colorDepth);

    //La capacidad de los colores de pasar por intermedios antes de pasar a otro
    console.log("Numero de bits empleados en el cambio del tono de color: " + screen.pixelDepth);
    //Estos dos valores suelen ir parejos
}

//Para saber la distancia de nuestra ventana al margen superEsior e izquierdo de la pantalla
function showDistanceToTheScreenSides() {
    console.log("Distancia de la ventana a la parte superior de la pantalla: " + screenTop);
    console.log("Distancia de la ventana a la parte izquierda de la pantalla: " + screenLeft);
}

//Informacion relacionados con la orientación de la pantalla
function showOrientationInfo(){
    //Primero conseguimos un objeto del tipo ScreenOrientation con el que trabajar
    var orientacion = screen.orientation;
    //Propiedades
    console.log("Tipo de orientacion: " + orientacion.type);
    console.log("Angulo que indica la rotacion: " + orientacion.angle);

    console.log("Esta clase tiene un EventHandler llamado onChange para que le llame cuando se rota la pantalla");
    
    //Métodos 
    //Bloquean o desbloquean la rotacion de la página respectivamente
    orientacion.lock;
    orientacion.unlock;
}

