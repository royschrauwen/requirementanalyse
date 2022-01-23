<?php

require_once('./includes/functions.inc.php');

$db = new Database();

$project = new Project();


// TODO: Haal uit de database het project van de huidige gebruiker
$projectID = '1';
$project->setName("TestProject");


// TODO: Zorg dat onderstaande methode wordt aangeroepen via de constructor van Project met argument projectID
$requirementList = $project->gRequirements($projectID);


include('header.php'); 


 // TODO: Onderstaande moet via MVC en htaccess bepaald worden uit de URL
if(!isset($_GET['view'])) {
    $view = "furps";
} else {
    $view = $_GET['view'];
}


// TODO:
// Requirements moeten opgedeeld kunnen worden in taken.
// Een Requirement is dan een soort use-case / userstory en daaraan verbonden hangen taken.


?>




<main>
<!-- TODO: Navigatie moet uit aparte include komen -->
        <nav>     
            <h4>Navigatie</h4>
            <ul>
                <li>Requirements-weergave</li>
                <li>Requirement toevoegen</li>
                <li>Project-instellingen</li>
                <li>Gebruikers-instellingen</li>
            </ul>
        </nav>

    <section>

        <div class="requirements">

        <?php
        if ($view == "furps") {
            ?>
            <div class="furps-main">
                <?php

                // TODO: Haal de onderstaande array op uit het de categorieen die bij het project horen volgens de database
                // TODO: Pas dus ook in Project.class.php aan dat hij de namen dus ook uit de database haalt
                $arrayOfCategories = ["1", "2", "3", "4", "5"];
                //$arrayOfCategories = ["3", "5"];

                $project->showAllRequirementsOrdered($arrayOfCategories);

                ?>
            </div>
            <?php 
        }
        ?>

        <?php
        if ($view == "moscow") {
            ?>

            <div class="moscow-main">
                <?php

                    // Onderstaande dingen moeten als methode in de Project klasse
                    $testArray = $project->testGetPriorities($projectID);
                    //pvd($testArray);

                    for ($i=1; $i <= count($testArray); $i++) { 
                        echo "<div class=moscow-card>";
                            echo "<h3>" . $i . "</h3>";
                            $project->showAllRequirementsOfPriority($i);  
                        echo "</div>"; 
                    }


                ?>
            </div>

            <?php 
        }
        ?>

        </div>

    </section>

</main>

<!-- <?php include('footer.php'); ?> -->