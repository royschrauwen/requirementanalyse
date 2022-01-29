<?php

?>

<div class="moscow-main">
<?php
for ($i = 0; $i < count($project->getCategories()); $i++) {
    echo "<div class=moscow-card>";
    echo "<h3>" . $project->getCategories()[$i]->getName() . "</h3>";
    $project->showAllRequirementsOfCategory($project->getCategories()[$i]);
    echo "</div>";
}
?>
</div>