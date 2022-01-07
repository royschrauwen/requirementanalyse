<?php

class Controller
{
    protected function model($model)
    {
        // TODO: Eerst checken of de file bestaat
        require_once('../app/models/' . $model . '.php');
        return new $model();
    }

    public function view($view, $data = [])
    {
        // TODO: Voor het requiren eerst checken of de file bestaat
        require_once('../app/views/' . $view . '.php');

    }

}