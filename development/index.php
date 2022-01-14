<?php

include('./includes/functions.inc.php');

require_once('./includes/includes.inc.php');


$project = new Project("Requirementanalyse-assistent", "Roy Schrauwen");

$requirement = new Requirement($project, "De gebruiker kan een requirement toevoegen aan het project", "M", "F");
$requirement = new Requirement($project, "De requirements worden op volgorde van FURPS en MoSCoW weergegeven op het scherm", "S", "U");
$requirement = new Requirement($project, "De gebruiker kan een requirement wijzigen", "S", "F");
$requirement = new Requirement($project, "De gebruiker kan een requirement verwijderen", "S", "F");
$requirement = new Requirement($project, "Requirements kunnen via drag and drop naar een andere categorie verplaatst worden", "C", "U");
$requirement = new Requirement($project, "Requirements kunnen via drag and drop naar een andere proiriteit verplaatst worden", "C", "U");
$requirement = new Requirement($project, "Een project kan opgeslagen worden in een database", "M", "R");
$requirement = new Requirement($project, "Een project kan ingeladen worden uit een database", "M", "R");
$requirement = new Requirement($project, "Een project kan offline ingelezen worden via een JSON bestand", "C", "R");
$requirement = new Requirement($project, "Er staan tooltips bij de invoervelden", "C", "S");
$requirement = new Requirement($project, "Requirements kunnen een afhankelijkheid hebben van elkaar", "S", "F");
$requirement = new Requirement($project, "Requirements met een afhankelijkheid krijgen een andere weergave", "S", "U");
$requirement = new Requirement($project, "Een project kan beveiligd worden met een wachtwoord", "C", "R");
$requirement = new Requirement($project, "Requirements kunnen gesorteerd worden op keuze van de gebruiker", "C", "U");
$requirement = new Requirement($project, "Er wordt ieder uur een backup gemaakt van de database", "W", "R");
$requirement = new Requirement($project, "Een gebruiker kan de kleuren van de onderdelen aanpassen", "C", "U");
$requirement = new Requirement($project, "Requirements kunnen als voltooid gemarkeerd worden", "S", "F");
$requirement = new Requirement($project, "Voltooide requirements hebben een andere weergave", "S", "U");
$requirement = new Requirement($project, "Een gebruiker kan kiezen om alleen onvoltooide requirements weer te geven", "C", "U");
$requirement = new Requirement($project, "Het laden van de pagina moet binnen 5 seconden en anders moet er een loading screen komen", "S", "P");
$requirement = new Requirement($project, "Het project wordt automatisch opgeslagen na een wijziging", "S", "P");
$requirement = new Requirement($project, "Requirements kunnen als taak aan een developer gekoppeld worden", "C", "F");
$requirement = new Requirement($project, "Een developer kan een overzicht zien van alle taken die aan hem/haar gekoppeld zijn", "C", "U");
$requirement = new Requirement($project, "Er kan een deadline aan een requirement worden toegewezen", "C", "F");
$requirement = new Requirement($project, "Een project kan geexporteerd worden als Word-bestand", "C", "F");
$requirement = new Requirement($project, "Een project kan gekopieerd worden als tabel met opmaak voor een Word-bestand", "C", "F");
$requirement = new Requirement($project, "De software heeft ook een weergave voor mobiel", "C", "U");
$requirement = new Requirement($project, "De software heeft ook een weergave voor tablet", "C", "U");
$requirement = new Requirement($project, "De software heeft ook standalone desktop applicatie", "C", "U");
$requirement = new Requirement($project, "De software kan ook offline werken", "W", "F");
$requirement = new Requirement($project, "Requirements krijgen een vast toegewezen letter-nummer-combinatie", "S", "F");
$requirement = new Requirement($project, "Er kan middels een zoekfunctie gezocht worden binnen de requirements", "C", "F");
$requirement = new Requirement($project, "Er kan een tijdsindicatie gekoppeld worden aan een requirement", "C", "F");
$requirement = new Requirement($project, "Developers kunnen een overzicht zien met de totale tijd van alle toegewezen requirements", "C", "U");
$requirement = new Requirement($project, "Developers kunnen een printbaar-overzicht krijgen met alle toegewezen requirements", "C", "U");
$requirement = new Requirement($project, "Een gebruiker kan kiezen om de koppen van MoSCoW te tonen of te verbergen", "C", "U");
$requirement = new Requirement($project, "Een gebruiker kan kiezen om wel of geen FURPS sortering toe te passen", "C", "U");
$requirement = new Requirement($project, "Invoer wordt gecontroleerd op mysql-injectie en gebruik van onjuiste tekens", "S", "R");
$requirement = new Requirement($project, "Invoer wordt automatisch voorzien van een ucfirst()", "C", "U");
$requirement = new Requirement($project, "Developers kunnen een account aanmaken op de webapp", "S", "F");
$requirement = new Requirement($project, "Developers kunnen inloggen op de webapp", "S", "F");
$requirement = new Requirement($project, "Requirements worden opgeslagen in een database", "M", "R");
$requirement = new Requirement($project, "Requirements worden ingeladen uit een database", "M", "R");
$requirement = new Requirement($project, "De software maakt gebruik van een MVC ontwerppatroon", "S", "P");
$requirement = new Requirement($project, "Een gebruiker kan een verloren wachtwoord opnieuw aanvragen", "C", "R");
$requirement = new Requirement($project, "Een gebruiker kan een eigen emailadres wijzigen", "C", "R");
$requirement = new Requirement($project, "Een project kan een teamhoofd hebben", "C", "S");
$requirement = new Requirement($project, "Een teamhoofd kan instellen welke autorisatie developers van dat team hebben", "C", "F");
$requirement = new Requirement($project, "Een teamhoofd kan developers toevoegen aan een team", "C", "F");
$requirement = new Requirement($project, "Een teamhoofd kan developers verwijderen uit een team", "C", "F");
$requirement = new Requirement($project, "De applicatie kan een kalenderweergave tonen met daarin de requirements", "C", "U");


?>
<link rel="stylesheet" href="./css/style.css">
<header>
<h1><?= $project->getName(); ?></h1>

<h2><?= $project->countRequirements(); ?> Requirements</h2>
</header>


<main>

<nav>navigatie</nav>

<section>

<div class="requirements">
<div class="furps-main">
<?php
    //$project->showAllRequirements();    

    $project->showAllRequirementsOrdered();
?>
</div>


<div class="moscow-main">
<div class="furps">
<?php
echo "<div class=moscow>";
    echo "<h3>" . "Must Have" . "</h3>";
    $project->showAllRequirementsOfPriority("M");  
echo "</div>";    
echo "<div class=moscow>";

    echo "<h3>" . "Should Have" . "</h3>";
    $project->showAllRequirementsOfPriority("S");
    echo "</div>";    
    echo "<div class=moscow>";
    echo "<h3>" . "Could Have" . "</h3>";
    $project->showAllRequirementsOfPriority("C");
    echo "</div>";    
    echo "<div class=moscow>";
    echo "<h3>" . "Won't Have" . "</h3>";
    $project->showAllRequirementsOfPriority("W");
    echo "</div>";    
    //$project->showAllRequirementsOrdered();
?>
</div>
</div>

</div>

</section>

</main>