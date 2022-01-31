<?php
session_start();
$_SESSION["userid"] = 1;

require_once ("./includes/functions.inc.php");

// TODO: Haal uit de database het project van de huidige gebruiker
$projectId = isset($_GET['id']) ? $_GET['id'] : 1;
$project = new Softalist\Project(new Softalist\Database(), $projectId);



// TODO: Uitzoeken hoe ik deze kan gebruiken. Misschien met een Default als er geen correcte waarde is?
// $view = (string)filter_input(INPUT_GET, 'view'); 

include ("header.php");
include ("navigation.php"); 

?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
<style>
input[type=checkbox] {
    margin-right: 0.5rem;
    cursor: crosshair;
}
input[type=checkbox]:hover {
    color: green;
}

button {
    text-align: center;
    padding: 0.2rem;
    height: fit-content;
    width: fit-content;
    cursor: copy;
    background: none;
    border: none;
}

button:hover{
    border: 1px green solid;
}

    </style>

    <section>
        <div class="requirements">

            <?php 

// TODO: Onderstaande moet via MVC en htaccess bepaald worden uit de URL
$view = isset($_GET['view']) ? $_GET['view'] : "moscow";

            if ($view == "furps") { 
                include ('./template/furps.template.php');
            } 
            
            if ($view == "moscow") { 
                include ('./template/moscow.template.php');
            } 

            if ($view == "newreq") { 
                include ('./template/newrequirement.template.php');
            } 
            
            if ($view == "mytasks") { 
                include ('./template/mytasks.template.php');
            }
            
            
            ?>

        </div>
    </section>

<?php include ("footer.php"); ?>



<script src="checkbox.js"></script>