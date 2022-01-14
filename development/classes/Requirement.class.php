<?php

class Requirement
{
    private string $name;
    private string $priority;
    private string $category;

    public function __construct(Project $project, string $name, string $priority, string $category)
    {
        $this->name = $name;
        $this->priority = $priority;
        $this->category = $category;
        $project->setRequirement($this);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getPriorityName()
    {
        switch ($this->priority) {
            case "M":
                return "Must Have";
                break;
            case "S":
                return "Should Have";
                break;
            case "C":
                return "Could Have";
                break;
            case "W":
                return "Won't Have";
                break;
        }
        return ;
    }

    public function getCategoryName()
    {
        switch ($this->category) {
            case "F":
                return "Functionality";
                break;
            case "U":
                return "Usability";
                break;
            case "R":
                return "Reliability";
                break;
            case "P":
                return "Performance";
                break;
            case "S":
                return "Supportability";
                break;                
        }
        return ;
    }
}