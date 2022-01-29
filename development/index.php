<?php
session_start();

require_once ("./includes/functions.inc.php");

// TODO: Haal uit de database het project van de huidige gebruiker
$projectId = isset($_GET['id']) ? $_GET['id'] : 1;
$project = new Softalist\Project(new Softalist\Database(), $projectId);

// TODO: Onderstaande moet via MVC en htaccess bepaald worden uit de URL
$view = isset($_GET['view']) ? $_GET['view'] : "moscow";

// TODO: Uitzoeken hoe ik deze kan gebruiken. Misschien met een Default als er geen correcte waarde is?
// $view = (string)filter_input(INPUT_GET, 'view'); 

include ("header.php");
include ("navigation.php"); 

?>

    <section>
        <div class="requirements">

            <?php 
            if ($view == "furps") { 
                include ('./template/furps.template.php');
            } 
            
            if ($view == "moscow") { 
                include ('./template/moscow.template.php');
            } 

            if ($view == "newreq") { 
                include ('./template/newrequirement.template.php');
            } 
            
            
            
            ?>

        </div>
    </section>

<?php include ("footer.php"); ?>