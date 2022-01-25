<?php

require_once('./includes/functions.inc.php');

$model = new Model();
$controller = new Controller($model);
$view = new View($controller, $model);

$templateToLoad = "mvctest2";
$controller->setTemplate($templateToLoad);

if (isset($_GET['action']) && !empty($_GET['action'])) {
$controller->{$_GET['action']}();
}


echo $view->output2();


