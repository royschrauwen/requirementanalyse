<?php


class Project extends Model
{
    private string $name;
    private $requirements;
    private $developers;

    public function gRequirements($project_id)
    {
        
        $reqs = $this->selectRequirements($project_id);
        for ($i=0; $i < count($reqs); $i++) { 
            $req[] = new Requirement($this, $reqs[$i]["requirement_name"], $reqs[$i]["priority_id"], $reqs[$i]["category_id"]);
        }
        return $req;

    }

    public function testGetPriorities($projectID)
    {
        return $this->selectPriorities($projectID);
    }

    // public function __construct(string $projectname, $developer)
    // {
    //     $this->setName($projectname);
    //     $this->setDeveloper($developer);
    // }

    public function getName()
    {
        return $this->name;
    }

    public function setName($newName)
    {
        $this->name = $newName;
    }

    public function setDeveloper($developer)
    {
        $this->developers[] = $developer;
    }

    public function getDevelopers()
    {
        return $this->developers;
    }

    public function getDeveloper($i)
    {
        return $this->developers[$i];
    }

    public function setRequirement(Requirement $requirement)
    {
        $this->requirements[] = $requirement;
    }

    public function getRequirement($i)
    {
        return $this->requirements[$i];
    }

    public function getRequirements()
    {
        return $this->requirements;
    }

    public function countRequirements()
    {
        return count($this->requirements);
    }

    public function getRequirementByCategory($array, $cat)
    {
        for ($i=0; $i < count($array); $i++) { 
            if($array[$i]->getCategory() == $cat) {
                $result[] = $array[$i];
            }
        }
        if(!isset($result))
        {
            return false;
        }
        return $result;
    }

    public function getRequirementByPriority($array, $prio)
    {
        for ($i=0; $i < count($array); $i++) { 
            if($array[$i]->getPriority() == $prio) {
                $result[] = $array[$i];
            }
        }
        if(!isset($result))
        {
            return false;
        }
        return $result;
    }

    public function getRequirementByCategoryAndPriority($cat, $prio)
    {
        $result1 = $this->getRequirementByCategory($this->getRequirements(), $cat);
        $result2 = $this->getRequirementByPriority($result1, $prio);
        return $result2;
    }

    // public function showAllRequirements()
    // {
    //     for ($i=0; $i < count($this->getRequirements()); $i++) { 
    //         echo $i+1 . ": " . $this->getRequirement($i)->getName() . " - " . $this->getRequirement($i)->getPriorityName() . " - " . $this->getRequirement($i)->getCategoryName() . "<br>";
    //     }
    // }

    public function showAllRequirementsOrdered($arrayOfCategories)
    {
        for ($i=0; $i < count($arrayOfCategories); $i++) { 
            $this->showAllRequirementsOfCategory($arrayOfCategories[$i]);
        }
    }

    public function showAllRequirementsOfPriority($prio)
    {
        $result = $this->getRequirementByPriority($this->requirements, $prio);
        for ($i=0; $i < count($result); $i++) { 



            
            switch ($prio) {
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
            
            if(rand(0,4) >= 4) {
                echo " completed";
            }
            
            echo " \" draggable=true";
            echo ">";


            //echo "<b>" . ucfirst(substr($moscowTypeName, 0, 1)) . "." . sprintf("%02d", $i+1) . "</b> ";

            //echo "<input type=checkbox> ";
            echo "<div class=\"card-info\">";
            echo "<span>" . $result[$i]->getName() . "</span>";
            echo "<span class=\"card-deadline\">" . $result[$i]->getDateTimeDeadline() . "</span>";
            echo "</div>";
                echo "<img class=\"card-image\" src=";
                if(rand(0, 4) == 1){
                $urlImage = "./images/profielfoto/royschrauwen.jpg";
                } else {
                $urlImage = "./images/profielfoto/generic.jpg";

                }
                echo $urlImage;
                echo " width=80 height=80>";
            echo "</div>";
    }
}

    public function showAllRequirementsOfCategory($cat)
    {
        echo "<div class=furps>";
        
        $temp = $this->getRequirementByCategory($this->requirements, $cat);
        echo "<h2>" . $temp[0]->getCategoryName() . "</h2>";
        $m = $this->getRequirementByCategoryAndPriority($cat, "1");
        $s = $this->getRequirementByCategoryAndPriority($cat, "2");
        $c = $this->getRequirementByCategoryAndPriority($cat, "3");
        $w = $this->getRequirementByCategoryAndPriority($cat, "4");
        if($m){
        echo "<div class=moscow>";

            echo "<h3>" . "Must Have" . "</h3>";
            for ($i=0; $i < count($m); $i++) { 
            echo "<div class=musthave>";
            echo "<input type=checkbox> ";
                echo $m[$i]->getName();
            echo "</div>";

            }
            echo "</div>";

        }
        if($s){
            echo "<div class=moscow>";
            echo "<h3>" . "Should Have" . "</h3>";

        for ($i=0; $i < count($s); $i++) { 
            echo "<div class=shouldhave>";
            echo "<input type=checkbox> ";

            echo $s[$i]->getName();
        echo "</div>";

        }
        echo "</div>";
    }
    if($c){
        echo "<div class=moscow>";

        echo "<h3>" . "Could Have" . "</h3>";

        for ($i=0; $i < count($c); $i++) { 
        echo "<div class=couldhave>";
        echo "<input type=checkbox> ";

            echo $c[$i]->getName();
        echo "</div>";

        }
        echo "</div>";

    }
    if($w){
        echo "<div class=moscow>";
            echo "<h3>" . "Won't Have" . "</h3>";
            for ($i=0; $i < count($w); $i++) { 
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