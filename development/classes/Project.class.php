<?php
namespace Softalist;
class Project
{
    private int $id;
    private string $name;
    private Database $database;
    private array $requirements = [];
    private array $categories = [];
    private array $priorities = [];


    public function __construct(Database $db, int $id)
    {
        $this->id = $id;
        $this->database = $db;

        $this->selectName();
        $this->selectCategories();

        $priorityArray = $this->selectArrayOfPriorities();
        $this->convertArrayToPriorities($priorityArray);
        
        $requirementArray = $this->selectArrayOfRequirements();
        $this->convertArrayToRequirementObjects($requirementArray);
    }

    
    /* ================================================ */
    /* ========== INTERACTIE MET DE DATABASE ========== */
    /* ================================================ */


    // Haal de naam van het huidige project op uit de database
    // TODO: Controleren of er rijen zijn die aan de query voldoen
    private function selectName()
    {
        $query = "SELECT `project_name` FROM projecten WHERE `project_id` = ?";
        $this->setName($this->database->select($query, [$this->id])[0]["project_name"]);
    }


    // Haal een array op uit de database met alle requirements-records die horen bij het huidige project
    // TODO: Controleren of er rijen zijn die aan de query voldoen
    private function selectArrayOfRequirements()
    {
        $query = "SELECT * FROM requirements WHERE `project_id` = ? ORDER BY `requirement_id` ASC, `date_deadline` DESC, `priority_id` ASC, `category_id` ASC";
        return $this->database->select($query, [$this->id]);
    }


    // Haal een array met de categorieen die bij dit project horen op uit de database
    // TODO: Controleren of er rijen zijn die aan de query voldoen
    // TODO: Categories moeten een eigen klasse krijgen zodat er ook nummers enzo van gebruikt kunnen worden
    private function selectCategories()
    {
        $query = "SELECT * FROM requirement_categories WHERE `project_id` = ? ORDER BY `category_id` ASC";
        $result = $this->database->select($query, [$this->id]);
        for ($i=0; $i < count($result); $i++) { 
            $this->categories[] = $result[$i]["category_name"];
        }
    }


    // Haal een array met de prioriteiten die bij dit project horen op uit de database
    // TODO: Controleren of er rijen zijn die aan de query voldoen
    private function selectArrayOfPriorities()
    {
        $query = "SELECT * FROM `requirement_priorities` WHERE `project_id` = ? ORDER BY `priority_id` ASC";
        return $this->database->select($query, [$this->id]);
    }

    

    /* ========================================= */
    /* ========== AFWIJKENDE METHODES ========== */
    /* ========================================= */


    // Converteer een array met requirements uit de database naar Requirement-Objecten en sla deze op als array in dit Project-Object
    public function convertArrayToPriorities($array)
    {
        for ($i = 0; $i < count($array); $i++) { 
            $priority = new Priority(
                $array[$i]["priority_id"], 
                $array[$i]["priority_name"], 
                $array[$i]["priority_color"], 
                $array[$i]["priority_backgroundcolor"]
            );
            $this->setPriority($priority);
        }
    }


    public function convertArrayToRequirementObjects($array)
    {
        for ($i = 0; $i < count($array); $i++) { 
            $requirement = new Requirement(
                $this, 
                $array[$i]["requirement_name"],
                $array[$i]["priority_id"],
                $array[$i]["category_id"]
            );
            $this->setRequirement($requirement);
        }
    }


    // Geen idee of het good practice is om dergelijke methodes te maken of niet
    // TODO: Uitzoeken of je beter dit soort methodes kunt maken of dat je beter de code gewoon los in je document zet ipv deze methode aanroepen
    public function countRequirements()
    {
        return count($this->requirements);
    }


    /* ====================================================== */
    /* ========== STANDAARD GETTER/SETTER METHODES ========== */
    /* ====================================================== */

    public function getName()
    {
        return $this->name;
    }

    public function setName($newName)
    {
        $this->name = $newName;
    }

    public function getPriorities()
    {
        return $this->priorities;
    }

    private function setPriority(Priority $prioritie)
    {
        $this->priorities[] = $prioritie;
    }

    public function getRequirement($i)
    {
        return $this->requirements[$i];
    }

    // Voeg een requirement toe aan dit Project-Object
    // TODO: Een requirement moet ook aan de database toegevoegd worden
    private function setRequirement(Requirement $requirement)
    {
        $this->requirements[] = $requirement;
    }

    public function getRequirements()
    {
        return $this->requirements;
    }



    /* =============================== */
    /* ========== UITZOEKEN ========== */
    /* =============================== */

    public function getRequirementByCategory($array, $cat)
    {
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i]->getCategory() == $cat) {
                $result[] = $array[$i];
            }
        }
        if (!isset($result)) {
            return false;
        }
        return $result;
    }

    public function getRequirementByPriority($array, $prio)
    {
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i]->getPriority() == $prio) {
                $result[] = $array[$i];
            }
        }
        if (!isset($result)) {
            return false;
        }
        return $result;
    }

    public function getRequirementByCategoryAndPriority($cat, $prio)
    {
        $result1 = $this->getRequirementByCategory(
            $this->getRequirements(),
            $cat
        );
        $result2 = $this->getRequirementByPriority($result1, $prio);
        return $result2;
    }


    public function showAllRequirementsOrdered($arrayOfCategories)
    {
        for ($i = 0; $i < count($arrayOfCategories); $i++) {
            $this->showAllRequirementsOfCategory($arrayOfCategories[$i]);
        }
    }

    public function showAllRequirementsOfPriority($prio)
    {
        $result = $this->getRequirementByPriority($this->requirements, $prio+1);
        for ($i = 0; $i < count($result); $i++) {
            switch ($prio+1) {
                case "1":
                    $moscowTypeName = "musthave";
                    break;
                case "2":
                    $moscowTypeName = "shouldhave";
                    break;
                case "3":
                    $moscowTypeName = "couldhave";
                    break;
                case "4":
                    $moscowTypeName = "wonthave";
                    break;
            }

            echo "<div class=\"";
            echo $moscowTypeName;

            if (rand(0, 4) >= 4) {
                echo " completed";
            }

            echo " \" draggable=true";
            echo ">";

            //echo "<b>" . ucfirst(substr($moscowTypeName, 0, 1)) . "." . sprintf("%02d", $i+1) . "</b> ";

            //echo "<input type=checkbox> ";
            echo "<div class=\"card-info\">";
            echo "<span>" . $result[$i]->getName() . "</span>";
            echo "<span class=\"card-deadline\">" .
                $result[$i]->getDateTimeDeadline() .
                "</span>";
            echo "</div>";
            echo "<img class=\"card-image\" src=";
            if (rand(0, 4) == 1) {
                $urlImage = "./images/profielfoto/royschrauwen.jpg";
            } else {
                $urlImage = "./images/profielfoto/generic.jpg";
            }
            echo $urlImage;
            echo " width=80 height=80>";
            echo "</div>";
            
            // if (rand(0,10) >= 8) {
            //     // Vak eronder voor de tasks
            //     // TODO: Dynamisch genereren?
            //     echo "<div class=musthave>";
            //     echo "<ul>";
            //     echo "<li>Task</li>";
            //     echo "<li>Task</li>";
            //     echo "<li>Task</li>";
            //     echo "<li>Task</li>";
            //     echo "</ul>";
            //     echo "</div>";
            // }
        }
    }

    public function showAllRequirementsOfCategory($cat)
    {
        // TODO: Deze methode herschrijven. Code is niet mooi en zeker niet DRY
        echo "<div class=furps>";

        $result = $this->getRequirementByCategory($this->requirements, $cat);
        echo "<h2>" . $result[0]->getCategoryName() . "</h2>";
        $m = $this->getRequirementByCategoryAndPriority($cat, "1");
        $s = $this->getRequirementByCategoryAndPriority($cat, "2");
        $c = $this->getRequirementByCategoryAndPriority($cat, "3");
        $w = $this->getRequirementByCategoryAndPriority($cat, "4");
        if ($m) {
            echo "<div class=moscow>";

            echo "<h3>" . "Must Have" . "</h3>";
            for ($i = 0; $i < count($m); $i++) {
                echo "<div class=musthave>";
                echo "<input type=checkbox> ";
                echo $m[$i]->getName();
                echo "</div>";
            }
            echo "</div>";
        }
        if ($s) {
            echo "<div class=moscow>";
            echo "<h3>" . "Should Have" . "</h3>";

            for ($i = 0; $i < count($s); $i++) {
                echo "<div class=shouldhave>";
                echo "<input type=checkbox> ";

                echo $s[$i]->getName();
                echo "</div>";
            }
            echo "</div>";
        }
        if ($c) {
            echo "<div class=moscow>";

            echo "<h3>" . "Could Have" . "</h3>";

            for ($i = 0; $i < count($c); $i++) {
                echo "<div class=couldhave>";
                echo "<input type=checkbox> ";

                echo $c[$i]->getName();
                echo "</div>";
            }
            echo "</div>";
        }
        if ($w) {
            echo "<div class=moscow>";
            echo "<h3>" . "Won't Have" . "</h3>";
            for ($i = 0; $i < count($w); $i++) {
                echo "<div class=wonthave>";
                echo "<input type=checkbox> ";

                echo $w[$i]->getName();
                echo "</div>";
            }
            echo "</div>";
        }
        echo "</div>";
    }
}
