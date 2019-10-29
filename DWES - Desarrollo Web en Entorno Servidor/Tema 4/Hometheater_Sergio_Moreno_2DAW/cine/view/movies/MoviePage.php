<?php
$rowMovie = $data['movie']->getEverything($data['id']);
echo("<h1 style='text-align:left; margin-left: 30px;'>". $rowMovie->title ."</h1>");
echo("<div id='moviePage'>");
    
// Left Panel //////////////////////////////////////////////////////////////////////
echo("<div id='left'>");
echo("<img src=./resources/covers/".$rowMovie->cover." alt=''/><br><br>");
echo("</div>");

// Middle Pannel //////////////////////////////////////////////////////////////////////
echo("<div id='middle'>");
echo("<h3>Título:</h3>");
echo("$rowMovie->title");
echo("<h3>📅 Año de salida:</h3>");
echo("$rowMovie->year");
echo("<h3>⌚ Duración:</h3>");
echo("$rowMovie->duration  minutos");
echo("<h3>⭐ Votación:</h3>");
echo("$rowMovie->rating / 10");
// Directores /////////////////////////////
$directors = $data['movie']->getDirectors($data['id']);
if($directors){
    echo("<h3>🎬 Director/a:</h3>");
    $q = "";
    foreach($directors as $director){
        $q = $q . $data['person']->getName($director).", ";
    }
    echo(substr($q, 0, strlen($q)-2));
}
// Listado de actores /////////////////////////////
$actors = $data['movie']->getActors($data['id']);
if($actors){
    echo("<h3>👥 Reparto:</h3>");
    $q = "";
    foreach($actors as $actor){
        $q = $q . $data['person']->getName($actor).", ";
    }
    echo(substr($q, 0, strlen($q)-2));
}
// Listado de géneros /////////////////////////////
$genres = $data['movie']->getGenres($data['id']);
if($genres){
    echo("<h3>💽 Géneros:</h3>");
    $q = "";
    foreach($genres as $genre){
        $q = $q . $data['genre']->getDescription($genre).", ";
    }
    echo(substr($q, 0, strlen($q)-2));
}


echo("</div>");

// Right Panel //////////////////////////////////////////////////////////////////////
echo("<div id='right'>");

echo("<form action='index.php'>
    <input type='hidden' name='do' value='ExternalWebPage'>
    <input type='hidden' name='id' value='".$rowMovie->id."'>
    <input type='submit' value='Incluso más informacion'>
</form>");
echo("<form>
    <input type=hidden name=do value=ListMenu>
    <input type=submit value=Volver>
</form>");

echo("</div>");

echo("</div>");

