<?php
class App 
{
    private $controller = 'home';
    private $method = 'index';
    private $param = [];


    public function __construct()
    {
        $url = $this->parseUrl();

        if ($url === NULL) {
            $url[0] = $this->controller;
            $url[1] = $this->method;
        }
        
        if(!isset($url[1])) $url[1] = $this->method;

        //controllers
        if (file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {

            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;

        //methode
        if (method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        //param
        if (!empty($url)) {
            $this->param = array_values($url);
        }

        //call methode
        call_user_func_array([$this->controller, $this->method], $this->param);


        
        //echo $this->controller;
        //var_dump($url);

    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], "/");
            $url = explode("/", $url);
            return $url;
        }
    }

}