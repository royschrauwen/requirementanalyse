<?php

use Softalist\Requirement;

require_once "./includes/functions.inc.php";


// TODO: Haal uit de database het project van de huidige gebruiker
$projectId = isset($_GET['id']) ? $_GET['id'] : 1;
$project = new Softalist\Project(new Softalist\Database(), $projectId);



include "header.php";

// TODO: Onderstaande moet via MVC en htaccess bepaald worden uit de URL
$view = isset($_GET['view']) ? $_GET['view'] : "furps";



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

        <?php if ($view == "furps") { ?>
            <div class="furps-main">
                <?php
                // TODO: Haal de onderstaande array op uit het de categorieen die bij het project horen volgens de database
                // TODO: Pas dus ook in Project.class.php aan dat hij de namen dus ook uit de database haalt
                $arrayOfCategories = ["1", "2", "3", "4", "5"];
                //$arrayOfCategories = ["3", "5"];

                $project->showAllRequirementsOrdered($arrayOfCategories);
                ?>
            </div>
            <?php } ?>

        <?php if ($view == "moscow") { ?>

            <div class="moscow-main">
                <?php

                for ($i = 1; $i <= count($project->getPriorities()); $i++) {
                    echo "<div class=moscow-card>";
                    echo "<h3>" . $project->getPriorities()[$i - 1] . "</h3>";
                    $project->showAllRequirementsOfPriority($i);
                    echo "</div>";
                }
                ?>
            </div>

            <?php } ?>

        </div>

    </section>

</main>

<!-- <?php include "footer.php"; ?> -->