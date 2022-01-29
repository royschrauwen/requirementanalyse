<?php
namespace Softalist;

class Category
{
    private string $id;
    private string $name;

    public function __construct(int $id,  string $name)
    {
        $this->id = $id;
        $this->setName($name);
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

}