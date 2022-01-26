<?php
session_start();

require_once ("./includes/functions.inc.php");

// TODO: Haal uit de database het project van de huidige gebruiker
$projectId = isset($_GET['id']) ? $_GET['id'] : 1;
$project = new Softalist\Project(new Softalist\Database(), $projectId);

// TODO: Onderstaande moet via MVC en htaccess bepaald worden uit de URL
$view = isset($_GET['view']) ? $_GET['view'] : "moscow";

include ("header.php");
include ("navigation.php"); 

?>

    <section>
        <div class="requirements">

            <?php if ($view == "furps") { ?>
                <div class="moscow-main">
                    <?php
                    for ($i = 0; $i < count($project->getCategories()); $i++) {
                        echo "<div class=moscow-card>";
                        echo "<h3>" . $project->getCategories()[$i]->getName() . "</h3>";
                        $project->showAllRequirementsOfCategory($i);
                        echo "</div>";
                    }
                    ?>
                </div>
                <?php } ?>

            <?php if ($view == "moscow") { ?>
                <div class="moscow-main">
                    <?php
                    for ($i = 0; $i < count($project->getPriorities()); $i++) {
                        echo "<div class=moscow-card>";
                        echo "<h3>" . $project->getPriorities()[$i]->getName() . "</h3>";
                        $project->showAllRequirementsOfPriority($i);
                        echo "</div>";
                    }
                    ?>
                </div>
            <?php } ?>

        </div>
    </section>

<?php include ("footer.php"); ?>