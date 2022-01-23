<?php

require_once('./includes/functions.inc.php');

$model = new Model();
$controller = new Controller($model);
$view = new View($controller, $model);

if (isset($_GET['action']) && !empty($_GET['action'])) {
$controller->{$_GET['action']}();
}

echo "<h1>MVCTEST</h1>";

echo $view->output2();


