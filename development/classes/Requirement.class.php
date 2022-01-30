<?php
namespace Softalist;


class Requirement
{
    private $id;

    private string $name;
    private string $priority;
    private string $category;
    private string $datetime_deadline = "25/01/2022 - 18:00";
    private Project $project;
    private $tasks = [];
    private int $user_task_id;
    private $status;


 
    public function getId()
    {
        return $this->id;
    }

    public function setId($newId)
    {
        $this->id = $newId;
    }

    public function addTask(Task $newTask)
    {
        $this->tasks[] = $newTask;
    }

    public function getTasks()
    {
        return $this->tasks;
    }


    public function getUserTaskId()
    {
        return $this->user_task_id;
    }

    public function setUserTaskId(int $userId)
    {
        $this->user_task_id = $userId;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($newStatus)
    {
        $this->status = $newStatus;
    }


    public function __construct(Project $project, string $name, string $priority, string $category, $status = 1)
    {
        $this->setName($name);
        $this->priority = $priority;
        $this->category = $category;
        $this->project = $project;
        $this->setStatus($status);
        //$project->setRequirement($this);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDateTimeDeadline()
    {
        return $this->datetime_deadline;
    }

    public function setName($name)
    {
        $this->name = $name;
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
            case "1":
                return "Must Have";
                break;
            case "2":
                return "Should Have";
                break;
            case "3":
                return "Could Have";
                break;
            case "4":
                return "Won't Have";
                break;
        }
        return ;
    }

    public function getCategoryName()
    {
        switch ($this->category) {
            case "1":
                return "Functionality";
                break;
            case "2":
                return "Usability";
                break;
            case "3":
                return "Reliability";
                break;
            case "4":
                return "Performance";
                break;
            case "5":
                return "Supportability";
                break;                
        }
        return ;
    }
}