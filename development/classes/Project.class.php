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
        $this->selectArrayOfPriorities();
        $this->selectArrayOfCategories();
        $this->selectArrayOfRequirements();
        
    }

    
    /* ================================================ */
    /* ========== INTERACTIE MET DE DATABASE ========== */
    /* ================================================ */


    // Haal de naam van het huidige project op uit de database
    // TODO: Controleren of er rijen zijn die aan de query voldoen
    private function selectName()
    {
        $query = "SELECT `project_name` FROM projecten WHERE `project_id` = ?";
        $result = $this->database->select($query, [$this->id])[0]["project_name"];
        if(!$result){
            echo "Geen project gevonden met dit ID";
            return;
        }
        $this->setName($result);
    }


    // Haal een array op uit de database met alle requirements-records die horen bij het huidige project
    // TODO: Controleren of er rijen zijn die aan de query voldoen
    private function selectArrayOfRequirements()
    {
        $query = "SELECT * FROM requirements WHERE `project_id` = ? ORDER BY `status_id` ASC, `date_deadline` DESC, `priority_id` ASC, `category_id` ASC, `requirement_id` ASC";
        $this->convertArrayToRequirementObjects($this->database->select($query, [$this->id]));
    }


    // Haal een array met de prioriteiten die bij dit project horen op uit de database
    // TODO: Controleren of er rijen zijn die aan de query voldoen
    private function selectArrayOfPriorities()
    {
        $query = "SELECT * FROM `requirement_priorities` WHERE `project_id` = ? ORDER BY `priority_id` ASC";
        $this->convertArrayToPriorities($this->database->select($query, [$this->id]));
    }


    // Haal een array met de prioriteiten die bij dit project horen op uit de database
    // TODO: Controleren of er rijen zijn die aan de query voldoen
    private function selectArrayOfCategories()
    {
        $query = "SELECT * FROM `requirement_categories` WHERE `project_id` = ? ORDER BY `category_id` ASC";
        $this->convertArrayToCategories($this->database->select($query, [$this->id]));
    }

    // Een test methode om te kijken of ik er meteen een object van kan maken
    private function selectArrayOfCategories2()
    {
        $query = "SELECT * FROM `requirement_categories` WHERE `project_id` = ? ORDER BY `category_id` ASC";
        echo "<pre>";
        var_dump($this->database->selectObject($query, [$this->id]));
        echo "</pre>";
    }

    

    /* ========================================= */
    /* ========== AFWIJKENDE METHODES ========== */
    /* ========================================= */


    // Converteer een array met priorities uit de database naar Requirement-Objecten en sla deze op als array in dit Project-Object
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


    // Converteer een array met categories uit de database naar Requirement-Objecten en sla deze op als array in dit Project-Object
    public function convertArrayToCategories($array)
    {
        for ($i = 0; $i < count($array); $i++) { 
            $category = new Category(
                $array[$i]["category_id"], 
                $array[$i]["category_name"]
            );
            $this->setCategory($category);
        }
        
    }

    // Converteer een array met requirements uit de database naar Requirement-Objecten en sla deze op als array in dit Project-Object
    public function convertArrayToRequirementObjects($array)
    {
        for ($i = 0; $i < count($array); $i++) { 
            $requirement = new Requirement(
                $this, 
                $array[$i]["requirement_name"],
                $array[$i]["priority_id"],
                $array[$i]["category_id"],
                $array[$i]["status_id"]
            );

            if ($array[$i]["user_id_task"]) {
                $requirement->setUserTaskId($array[$i]["user_id_task"]);
            } else {
                $requirement->setUserTaskId(0);
            }

            $this->setRequirement($requirement);
        }
    }


    // Geen idee of het good practice is om dergelijke methodes te maken of niet
    // TODO: Uitzoeken of je beter dit soort methodes kunt maken of dat je beter de code gewoon los in je document zet ipv deze methode aanroepen
    public function countRequirements()
    {
        return count($this->requirements);
    }

    // Functie om binnen FURPS ook MoSCoW te kunnen tonen
    public function showAllRequirementsOfCategoryWithPriority(Category $category, $priority)
    {
        
        for ($i=0; $i < count($this->requirements); $i++) { 
            if ($this->requirements[$i]->getCategory() == $category->getId() && $this->requirements[$i]->getPriority() == $priority->getId()) {
                $this->displayRequirementCard($this->requirements[$i]);
            }
        }
    }

    public function showAllRequirementsOfPriority($prio)
    {
        $result = $this->getRequirementByPriority($this->requirements, $prio+1);
        for ($i = 0; $i < count($result); $i++) {
            $this->displayRequirementCard($result[$i]);
        }
    }

    public function displayRequirementCard(Requirement $requirement)
    {
        echo "<div class=\"";
        switch ($requirement->getPriority()) {
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
            echo $moscowTypeName;

            if ($requirement->getStatus() == 5) {
                echo " completed";
            }

            echo " \" draggable=true";
            echo ">";

            //echo "<b>" . ucfirst(substr($moscowTypeName, 0, 1)) . "." . sprintf("%02d", $i+1) . "</b> ";

            //echo "<input type=checkbox> ";

            echo "<div class=\"card-info\">";
            echo "<span>" . $requirement->getName() . "</span>";
            echo "<span class=\"card-deadline\">" .
                $requirement->getDateTimeDeadline() .
                "</span>";
            echo "</div>";
            echo "<img class=\"card-image\" src=./images/profielfoto/";
            echo $requirement->getUserTaskId();
            echo ".jpg width=80 height=80>";
            echo "</div>";
    }

    /* ====================================================== */
    /* ========== STANDAARD GETTER/SETTER METHODES ========== */
    /* ====================================================== */

    public function getId()
    {
        return $this->id;
    }

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

    private function setPriority(Priority $priority)
    {
        $this->priorities[] = $priority;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    private function setCategory(Category $category)
    {
        $this->categories[] = $category;
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

    public function getDatabase()
    {
        return $this->database;
    }



    /* =============================== */
    /* ========== UITZOEKEN ========== */
    /* =============================== */



    // public function getRequirementByCategory($array, $category)
    // {
    //     for ($i = 0; $i < count($array); $i++) {
    //         if ($array[$i]->getCategory() == $category) {
    //             $result[] = $array[$i];
    //         }
    //     }
    //     if (!isset($result)) {
    //         return false;
    //     }
    //     return $result;
    // }

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

    // public function getRequirementByCategoryAndPriority($category, $prio)
    // {
    //     $result1 = $this->getRequirementByCategory(
    //         $this->getRequirements(),
    //         $category
    //     );
    //     $result2 = $this->getRequirementByPriority($result1, $prio);
    //     return $result2;
    // }


    // public function showAllRequirementsOrdered($arrayOfCategories)
    // {
    //     for ($i = 0; $i < count($arrayOfCategories); $i++) {
    //         $this->showAllRequirementsOfCategory($arrayOfCategories[$i]);
    //     }
    // }



    

    // public function showAllRequirementsOfCategory(Category $category)
    // {
    //     echo "<div class=furps>";

    //     for ($i = 0; $i < count($this->priorities); $i++) { 
    //         echo "<h4>" . $this->priorities[$i]->getName() . "</h4>";
    //         echo "<div>";
            
    //         echo "Haal alle requirements op van category <strong>"
    //         . $category->getName()
    //         . "</strong> met priority <strong>" 
    //         . $this->priorities[$i]->getName() 
    //         . "</strong><br><br>";

    //         echo "</div>";
    //     }

    //     echo "</div>";
    // }



}
