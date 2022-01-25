<?php

namespace Softalist;

class Task
{
    private int $id;
    private string $name;
    private int $status;

    public function __construct(Requirement $requirement, string $taskName)
    {
        $this->name = $taskName;
        $this->status = 0;
        $requirement->addTask($this);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($newName)
    {
        $this->name = $newName;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus(int $newStatus)
    {
        $this->status = $newStatus;
    }

    public function getRequirement()
    {
        return $this->requirement;
    }
}