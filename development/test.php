<?php

include ('./classes/Database.class.php');
include ('./includes/functions.inc.php');

$db = new Database();

?>

<form action="#" method="post">
    <label>Project: </label><input type="text" disabled name="project_id" value= "1">
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

<input type="hidden" name="table" value="projects">
<button submit>Submit</button>
</form>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $table = $_POST['table'];
    $arguments[] = $_POST['requirement'];

    $arguments[] = $_POST['project_id'];
    $arguments[] = $_POST['priority'];
    $arguments[] = $_POST['category'];

    $query = "INSERT INTO `requirements` (`requirement_name`, `project_id`, `priority_id`, `category_id`) VALUES (?, ?, ?, ?)";
    pvd($query);
    pvd($arguments);

    //$projecten = $db->insert($query, $arguments);
}


$projectID = 1;

$q = "SELECT * FROM `requirements` WHERE `project_id` = " . $projectID . " ORDER BY `date_deadline` DESC, `priority_id` ASC, `category_id` ASC, `user_id_task` ASC, `date_added` DESC";
$projecten = $db->select($q);
echo " <h1>Project " . $projectID . "</h1>";
echo " <table border=1>";
echo " <tr>";
echo "<td>requirement_id</td>";
echo "<td>requirement_name</td>";
echo "<td>priority_id</td>";
echo "<td>category_id</td>";
echo "<td>date_added</td>";
echo " </tr>";
for ($i=0; $i < count($projecten); $i++) { 
    echo " <tr>";
    echo " <td>" . $projecten[$i]["requirement_id"] . "</td>";
    echo "<td>" . $projecten[$i]["requirement_name"] . " </td>";
    echo "<td>" . $projecten[$i]["priority_id"] . " </td>";
    echo "<td>" . $projecten[$i]["category_id"] . " </td>";
    echo "<td>" . $projecten[$i]["date_added"] . " </td>";
    echo " </tr>";
}
echo " </table>";




?>

