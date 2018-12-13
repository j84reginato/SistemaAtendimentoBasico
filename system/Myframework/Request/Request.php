<?php

namespace core;

class System extends Router
{
    private $url;
    private $url_array;

    protected $enviroment;
    protected $controller;
    protected $method;

    private $params;
    private $obj_controller;

    public function __construct()
    {
        $this->setUrl();
        $this->setUrlArray();
        $this->setEnviroment();
        $this->setController();
        $this->setMethod();
        $this->setParrams();
    }

    private function setUrl()
    {
        $input_url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING);
        $this->url = isset($input_url) ? $input_url : 'home/index';
    }

    private function setUrlArray()
    {
        $this->url_array = explode('/', $this->url);
    }

    private function setEnviroment()
    {
        foreach ($this->routers as $key => $value) {
            if ($this->on_default_router && $this->url_array[0] == $key) {
                $this->enviroment = $value;
                $this->on_default_router = false;
            }
        }
        $this->enviroment = empty($this->enviroment) ? $this->default_router : $this->enviroment;
        if (!defined('APP_ENVIROMENT')) {
            define('APP_ENVIROMENT', $this->enviroment);
        }
    }

    public function getEnviroment()
    {
        return $this->enviroment;
    }

    private function setController()
    {
        $this->controller = $this->on_default_router
            ? $this->url_array[0]
            : (!isset($this->url_array[1]) || is_null($this->url_array[1]) || empty($this->url_array[1]) ? 'home' : $this->url_array[1]);
    }

    public function getController()
    {
        return $this->controller;
    }

    private function setMethod()
    {
        $this->method = $this->on_default_router
            ? (!isset($this->url_array[1]) || is_null($this->url_array[1]) || empty($this->url_array[1]) ? 'index' : $this->url_array[1])
            : (!isset($this->url_array[2]) || is_null($this->url_array[2]) || empty($this->url_array[2]) ? 'index' : $this->url_array[2]);
    }

    public function getMethod()
    {
        return $this->method;
    }

    private function setParrams()
    {
        if ($this->on_default_router) {
            unset($this->url_array[0], $this->url_array[1]);
        } else {
            unset($this->url_array[0], $this->url_array[1], $this->url_array[2]);
        }
        if (end($this->url_array) == null) {
            array_pop($this->url_array);
        }
        if (empty($this->url_array)) {
            $this->params = array();
        } else {
            foreach ($this->url_array as $value) {
                $params[] = $value;
            }
            $this->params = $params;
        }
    }

    public function getParams($index)
    {
        return isset($this->params[$index]) ? $this->params[$index] : 'NULL';
    }

    public function run()
    {
        $controller = '\\controllers\\' . $this->enviroment . '\\' . ucfirst($this->controller) . 'Controller';
        $method = $this->method;

        $this->controllerValidation($controller);
        $this->obj_controller = new $controller();
        $this->methodValidation();
        $this->obj_controller->$method();
    }

    private function controllerValidation($controller)
    {
        if (!class_exists($controller)) {
            header('HTTP/1.0 404 Not Found');
            define('ERROR', 'O controller ' . ucfirst($this->controller) . 'Controller não existe');
            include "views/{$this->enviroment}/shared/404_error.php";
            exit();
        }
    }

    private function methodValidation()
    {
        if (!method_exists($this->obj_controller, $this->method)) {
            header('HTTP/1.0 404 Not Found');
            define('ERROR', 'O método ' . ucfirst($this->controller) . 'Controller/' .$this->method . ' não existe');
            include "views/{$this->enviroment}/shared/404_error.php";
            exit();
        }
    }
}
