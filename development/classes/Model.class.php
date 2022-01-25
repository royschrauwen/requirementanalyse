<?php
namespace Softalist;
class Model extends Database
{

    /* TUTORIAL */    
    public $string;
    public $tstring;
    public $template;
    public $paginaTitel;

    public function __construct(){
        $this->string = "MVC + PHP = Awesome, click here!";
        $this->tstring = "The string has been loaded through the template.";
        $this->template = "./template/mvctest.tmp.php";
        $this->paginaTitel = "Template Test met Titel";
    }
    /* EINDE TUTORIAL */

    protected function selectRequirements($project_id)
    {
        $query = "SELECT * FROM requirements WHERE `project_id` = ? ORDER BY `date_deadline` DESC, `priority_id` ASC, `category_id` ASC";
        $arguments = [$project_id];
        return $this->select($query, $arguments);
    }

    protected function selectPriorities($project_id)
    {
        $query = "SELECT * FROM requirement_priorities WHERE `project_id` = ?";
        $arguments = [$project_id];
        return $this->select($query, $arguments);
    }

    protected function selectCategories($project_id)
    {
        $query = "SELECT * FROM requirement_categories WHERE `project_id` = ?";
        $arguments = [$project_id];
        return $this->select($query, $arguments);
    }
}