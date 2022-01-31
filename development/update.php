<?php

use Softalist\Database;

session_start();

require_once ("./includes/functions.inc.php");


$requirementId = isset($_GET['rid']) ?  (int)$_GET['rid'] : 127;
$userId = isset($_GET['uid']) ?  (int)$_GET['uid'] : 3;
$returnView = isset($_GET['return']) ?  $_GET['return'] : "furps";

$database = new Database();

$query = "UPDATE requirements SET user_id_task = ? WHERE requirement_id = ?";
$arguments = [$userId, $requirementId];

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