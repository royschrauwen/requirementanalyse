<?php

class Controller
{
    protected function model($model)
    {
        // TODO: Eerst checken of de file bestaat
        // Anders foutmelding geven
        if(file_exists('../app/models/' . $model . '.php')){
            require_once('../app/models/' . $model . '.php');
            return new $model();
        }
    }

    public function view($view, $data = [])
    {
        // TODO: Voor het requiren eerst checken of de file bestaat
        // Anders foutmelding geven
        if(file_exists('../app/views/' . $view . '.php')){
            require_once('../app/views/' . $view . '.php');
        }

    }

}