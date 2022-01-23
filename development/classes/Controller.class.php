<?php
class Controller
{
    private $model;

    public function __construct($model){
    $this->model = $model;
    }

    public function clicked1() {
    $this->model->string = "Updated Data, thanks to MVC and PHP!";
    }
}