<?php

require_once ('core/App.php');
require_once ('controllers/Controller.php');

// PRE VARDUMP -- HELPER FUNCTIE DIE DE VARDUPS PRE TAGS GEEFT
function pvd($stringToDisplay)
{
    echo "<div style=\"background-color: lightgray;\">";
    echo "<h3 style=\"margin-bottom: 0\">" . $stringToDisplay . "</h3>";
    echo "<pre>";
    var_dump($stringToDisplay);
    echo "</pre>";
    echo "</div>";
}