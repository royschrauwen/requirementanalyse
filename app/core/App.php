<?php

class App
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $parameters = [];
    
    public function __construct()
    {
        $url = $this->parseUrl();

        echo "<h3>url</h3>";
            echo "<pre>";
            var_dump($url);
            echo "</pre><br>";

        if(file_exists('../app/controllers/' . $url[0] . '.php')){
            $this->controller = $url[0];

            echo "<h3>this controller</h3>";
            echo "<pre>";
            var_dump($this->controller);
            echo "</pre><br>";
            
            unset($url[0]);
        }

        require_once('../app/controllers/' . $this->controller . '.php');

        $this->controller = new $this->controller;
        echo "<h3>this controller</h3>";
            echo "<pre>";
            var_dump($this->controller);
            echo "</pre><br>";


        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                echo "<h3>this method</h3>";
            echo "<pre>";
            var_dump($this->method);
            echo "</pre><br>";
                unset($url[1]);
            }
        }

        $this->parameters = $url ? array_values($url) : [];
        echo "<h3>this parameters</h3>";
            echo "<pre>";
            var_dump($this->parameters);
            echo "</pre><br>";


        call_user_func_array([$this->controller, $this->method], $this->parameters);
    }

    protected function parseUrl()
    {
        if(isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) ;
        }
    }
}