<?php

include ('./classes/Database.class.php');

$db = new Database();
$returnPage = "test.php";
$errorMessage = "";

// Als het formulier niet ingevuld is, moeten we die weergeven
// En anders verwerken we de data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Het geuplaode bestand in een variabele zetten voor verdere munipulatie
    $uploadedFile = $_POST['myfile'];

    // Controle of er een bestand is gekozen
    if(!isset($uploadedFile) || $uploadedFile == "" || $uploadedFile == NULL) {
        $errorMessage = "Geen bestand gevonden.";
        echo $errorMessage;
        exit();
    }


    // Controle of het geuploaden bestand een CSV-type is
    $allowedFiletypes =  array('csv');
    $extention = pathinfo($uploadedFile, PATHINFO_EXTENSION);
    if(!in_array($extention,$allowedFiletypes) ) {
        $errorMessage =  "Geen CVS-bestand.";
        echo $errorMessage;
        exit();
    }


    // Controle of het bestand geopend kan worden
    $file = fopen($uploadedFile,'r') or die('cant open file');
    if ($file == FALSE) {
        $errorMessage =  "Bestand kan niet geopend worden.";
        echo $errorMessage;
        exit();
    }
    

    // Alle checks zijn goed dus dan gaan we het bestand inlezen en converteren naar een array
    $row = 0;
    while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
        for ($i=0; $i < count($data); $i++) {
            $input[$row][$i] = $data[$i];
        }
        $row++;
    }
    fclose($file);


    // Query opstellen uit de array
    $aantalkolommen = count($input[0]);
    $query = "INSERT INTO `requirements` ( ";
        
        // Eerst de kolomnamen invoeren in de volgorde waarin ze in het CSV-bestand staan
        for ($i=0; $i < $aantalkolommen; $i++) { 
            $query .= "`" . $input[0][$i] . "`";
            
            // De laatste naam moet geen komma hebben
            if($i < $aantalkolommen-1) {
                $query .= ", ";
            }
        }
        
        $query .= ") VALUES (";

        // Het aantal kolommen ook als aantal argumenten met een ? in de query zetten
        for ($i=0; $i < $aantalkolommen; $i++) { 
            $query .= "?";
            if($i < $aantalkolommen-1) {
                $query .= ", ";
            }
        }

        $query .= ")";

        // Per regel van het CSV-bestand een record maken in de database door de query steeds aan te roepen met andere argumenten
        for ($i=1; $i < count($input); $i++) { 
            $result = $db->insert($query, $input[$i]);
            if(!$result) {
                $errorMessage = "Invoer regel " . $i . " is niet gelukt.";
                echo $errorMessage;
                exit();
            }
        }

    echo "Data succesvol geimporteerd. Terug naar " . $returnPage;
    // TODO: Doorsturen naar weergavepagina


} else {

    // Er is geen Submit gedetecteerd, dus we geven het uploadformulier weer
    ?>

    <form action="import.php" method="post">
    <label for="myfile">Select a file:</label>
    <input type="file" id="myfile" name="myfile"> 
    <button submit>Importeren</button>
    </form>

    <?php
}

?>