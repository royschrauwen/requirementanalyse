<?php

class Project
{
    private string $name;
    private $requirements;
    private $developers;

    public function __construct(string $projectname, $developer)
    {
        $this->setName($projectname);
        $this->setDeveloper($developer);
    }

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

    public function showAllRequirements()
    {
        for ($i=0; $i < count($this->getRequirements()); $i++) { 
            echo $i+1 . ": " . $this->getRequirement($i)->getName() . " - " . $this->getRequirement($i)->getPriorityName() . " - " . $this->getRequirement($i)->getCategoryName() . "<br>";
        }
    }

    public function showAllRequirementsOrdered()
    {
        $this->showAllRequirementsOfCategory("F");
        $this->showAllRequirementsOfCategory("U");
        $this->showAllRequirementsOfCategory("R");
        $this->showAllRequirementsOfCategory("P");
        $this->showAllRequirementsOfCategory("S");
    }

    public function showAllRequirementsOfPriority($prio)
    {
        $result = $this->getRequirementByPriority($this->requirements, $prio);
        for ($i=0; $i < count($result); $i++) { 



            echo "<div class=";
            
            switch ($prio) {
                case "M":
                    echo "musthave";
                    break;
                case "S":
                    echo "shouldhave";
                    break;
                case "C":
                    echo "couldhave";
                    break;
                case "W":
                    echo "wonthave";
                    break;              
            }
            
            
            echo ">";


            echo "<b>" . $prio . sprintf("%02d", $i+1) . "</b> ";

            echo "<input type=checkbox> ";
                echo $result[$i]->getName();
            echo "</div>";
    }
}

    public function showAllRequirementsOfCategory($cat)
    {
        echo "<div class=furps>";
        
        $temp = $this->getRequirementByCategory($this->requirements, $cat);
        echo "<h2>" . $temp[0]->getCategoryName() . "</h2>";
        $m = $this->getRequirementByCategoryAndPriority($cat, "M");
        $s = $this->getRequirementByCategoryAndPriority($cat, "S");
        $c = $this->getRequirementByCategoryAndPriority($cat, "C");
        $w = $this->getRequirementByCategoryAndPriority($cat, "W");
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