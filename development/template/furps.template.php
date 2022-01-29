<?php

?>

<div class="moscow-main">
<?php
for ($i = 0; $i < count($project->getCategories()); $i++) {
    echo "<div class=moscow-card>";
    echo "<h3>" . $project->getCategories()[$i]->getName() . "</h3>";
    //$project->showAllRequirementsOfCategory($project->getCategories()[$i]);
    for ($u = 0; $u < count($project->getPriorities()); $u++) {   
        
        $project->showAllRequirementsOfCategoryWithPriority($project->getCategories()[$i], $project->getPriorities()[$u]);
    }
    echo "</div>";
}
?>
</div>