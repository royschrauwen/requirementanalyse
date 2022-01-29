<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $project->getName(); ?></title>
</head>
<body>
    
<link rel="stylesheet" href="./css/style.css">
<header>
<img src="./images/softalist_temp_logo.png" height=35px alt="Logo">
<div class="">
    <center>
    <h1><?= $project->getName(); ?></h1>
    <?= $project->countRequirements(); ?> Requirements
    </center>
</div>

<div class="">
    <a href="">Logout</a>
</div>

</header>
<main>