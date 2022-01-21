<?php

include('./includes/functions.inc.php');
require_once('./includes/includes.inc.php');

$project = new Project("Requirementanalyse-assistent", "Roy Schrauwen");

include('./temp_requirements.inc.php');


for ($i=0; $i < count($project->getRequirements()); $i++) { 
    $prio = $project->getRequirement($i)->getCategory();
    switch($prio){
        case "F":
            echo "1";
            break;
        case "U":
            echo "2";
            break;
        case "R":
            echo "3";
            break;
        case "P":
            echo "4";
            break;
        case "S":
            echo "5";
            break;            
    }
    echo "<br>";
}

?>