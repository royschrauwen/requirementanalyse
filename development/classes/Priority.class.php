<?php
namespace Softalist;

class Priority
{
    private string $id;
    private string $name;
    private string $textColor;
    private string $backgroundColor;

    public function __construct(string $id,  string $name, string $textColor, string $backgroundColor)
    {
        $this->id = $id;
        $this->setName($name);
        $this->setTextColor($textColor);
        $this->setBackgroundColor($backgroundColor);
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

    public function getTextColor()
    {
        return $this->textColor;
    }

    public function setTextColor($newTextColor)
    {
        $this->textColor = $newTextColor;
    }

    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    public function setBackgroundColor($newBackgroundColor)
    {
        $this->backgroundColor = $newBackgroundColor;
    }

}