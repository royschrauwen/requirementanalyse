<?php
namespace Softalist;
class Controller
{
    private $model;

    public function __construct($model){
    $this->model = $model;
    }

    public function clicked1() {
    $this->model->string = "Updated Data, thanks to MVC and PHP!";
    }

    public function setTemplate(string $templateURL)
    {
    $this->model->template = "./template/" . $templateURL . ".tmp.php";

    }
}