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