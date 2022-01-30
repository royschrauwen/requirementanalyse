<?php

use Softalist\Database;

session_start();

require_once ("./includes/functions.inc.php");

$idToChange = isset($_GET['id']) ?  (int)$_GET['id'] : 21;
$newStatus = isset($_GET['status']) ?  (int)$_GET['status'] : 2;
$returnView = isset($_GET['return']) ?  $_GET['return'] : "furps";

// echo "idToChange (" . $idToChange . ") is_int: " . is_int($idToChange) . "<br>";
// echo "newStatus (" . $newStatus . ") is_int: " . is_int($newStatus) . "<br>";

// echo "returnView: " . $returnView . "<br>";

if(!is_int($idToChange)) {
    echo "ID onjuist. Stop!";
    exit();
}

if(!is_int($newStatus)) {
    echo "Status onjuist. Stop!";
    exit();
}

echo "<h1>Change status of : ";
echo $idToChange;
echo " to ";
echo $newStatus;
echo "</h1>";

$database = new Database();

//$query = "INSERT INTO `requirements` (`requirement_name`, `project_id`, `priority_id`, `category_id`) VALUES (?, ?, ?, ?)";

$query = "UPDATE requirements SET status_id = ? WHERE requirement_id = ?";
$arguments = [$newStatus, $idToChange];

//$project->getDatabase()->insert($query, $arguments);
$result = $database->update($query, $arguments);

if ($result) {
    header("Location: index.php?view=" . $returnView);
    echo "Gelukt";
exit();
} else {
    // Foutmelding genereren
    echo "Wijziging niet gelukt!";
var_dump($result);
}

?>