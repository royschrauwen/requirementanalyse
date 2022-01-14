<?php

class Home extends Controller
{
    public function index($name = '')
    {
        $user = $this->model('User');
        $user->name = $name;

        $this->view('home/index', ['name'=>$user->name]);
    }

    public function user($name = '')
    {
        $user = $this->model('User');
        $user->name = $name;

        $this->view('home/index', ['name'=>$user->name]);
    }

    public function requirement($title = '')
    {
        $requirement = $this->model('Requirement');
        $requirement->title = $title;

        $this->view('home/requirement', ['title'=>$requirement->title]);
    }

}