<?php

include('./includes/functions.inc.php');
require_once('./includes/includes.inc.php');

$project = new Project("Requirementanalyse-assistent", "Roy Schrauwen");

include('./temp_requirements.inc.php');
include('header.php'); 

?>




<main>

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

            <div class="furps-main">
            <?php
                $project->showAllRequirementsOrdered();
            ?>
            </div>

            <div class="moscow-main">
                <div class="furps">
                <?php
                    echo "<div class=moscow>";
                        echo "<h3>" . "Must Have" . "</h3>";
                        $project->showAllRequirementsOfPriority("M");  
                    echo "</div>";    
                    echo "<div class=moscow>";
                        echo "<h3>" . "Should Have" . "</h3>";
                        $project->showAllRequirementsOfPriority("S");
                    echo "</div>";    
                    echo "<div class=moscow>";
                        echo "<h3>" . "Could Have" . "</h3>";
                        $project->showAllRequirementsOfPriority("C");
                    echo "</div>";    
                    echo "<div class=moscow>";
                        echo "<h3>" . "Won't Have" . "</h3>";
                        $project->showAllRequirementsOfPriority("W");
                    echo "</div>";    
                    //$project->showAllRequirementsOrdered();
                ?>
                </div>
            </div>

        </div>

    </section>

</main>

<?php include('footer.php'); ?>