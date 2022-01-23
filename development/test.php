<?php

require_once ('./classes/Database.class.php');
require_once ('./classes/Model.class.php');
require_once ('./classes/Requirement.class.php');
require_once ('./classes/Project.class.php');

include ('./includes/functions.inc.php');

$db = new Database();
$projectID = '1';
$projectTest = new Project();

$requirementList = $projectTest->gRequirements($projectID);


echo "<h1>Project " . $projectID . "</h1>";
echo "<table border=1>";

    echo "<tr>";
        echo "<td>i</td>";
        echo "<td>requirement_name</td>";
        echo "<td>priority_id</td>";
        echo "<td>category_id</td>";
        echo "<td>date_deadline</td>";
        echo "<td>status_id</td>";
        echo "<td>date_added</td>";
    echo "</tr>";

    for ($i=0; $i < count($requirementList); $i++) { 
        echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $requirementList[$i]->getName() . " </td>";
            echo "<td>" . $requirementList[$i]->getPriorityName() . " </td>";
            echo "<td>" . $requirementList[$i]->getCategoryName() . " </td>";
            echo "<td>" . "-" . " </td>";
            echo "<td>" . "-" . " </td>";
            echo "<td>" . "-" . " </td>";
        echo "</tr>";
    }

echo "</table>";


?>
<div>
    <form action="#" method="post">
        <label>Project: </label><input type="text" disabled name="projectID" value= "1">
        <label>Requirement: </label><input type="text" name="requirement">

        <select name="priority">
            <option value="1">Must Have</option>
            <option value="2">Should Have</option>
            <option value="3">Could Have</option>
            <option value="4">Won't Have</option>
        </select>

        <select name="category">
            <option value="1">Functionality</option>
            <option value="2">Useability</option>
            <option value="3">Reliability</option>
            <option value="4">Performance</option>
            <option value="5">Supportability</option>
        </select>

        <!-- Deadline moet default de Project-Deadline zijn -->
        <input type="datetime-local" name="deadline">

    <button submit>Submit</button>
    </form>
</div>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $arguments[] = $_POST['requirement'];

    $arguments[] = $_POST['projectID'];
    $arguments[] = $_POST['priority'];
    $arguments[] = $_POST['category'];

    $query = "INSERT INTO `requirements` (`requirement_name`, `projectID`, `priority_id`, `category_id`) VALUES (?, ?, ?, ?)";
    pvd($query);
    pvd($arguments);

    //$projecten = $db->insert($query, $arguments);
}
?>