<?php
namespace Softalist;
class View
{
    private $model;
    private $controller;

    public function __construct($controller,$model) {
    $this->controller = $controller;
    $this->model = $model;
    }

    public function output() {
        return "<p><a href=mvctest.php?action=clicked1>" . $this->model->string . "</a></p>";
    }

    public function output2(){
        $paginaTitel = $this->model->paginaTitel;
        $stringName = $this->model->string;
        $data = "<p>" . $this->model->tstring ."</p>";
        require_once($this->model->template);
    }
}