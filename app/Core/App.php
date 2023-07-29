<?php

namespace App\Core;

class App
{
    protected $container;

    public function run()
    {
        $urlParams = explode('/', $_SERVER['REQUEST_URI']);
        $urlActionMethod = $_SERVER['REQUEST_METHOD'];
        $controller =  $urlParams[1] ?? null;
        $action = $urlParams[2] ?? null;

       return $this->route($this->prepareController($controller), $this->prepareAction($action));

    }

    public function route($controller, $action)  
    {
        $controller = ucfirst($controller).'Controller';
        $action  = $action . 'Action';
        $params = [];
        $class = "\\App\Controllers\\{$controller}";
        $controller = new $class($this);
        return call_user_func_array(
            array($controller, $action), 
            array($params)
        );
    }

    public function bind($key, Callable $callable)
	{
		$this->container[$key] = $callable;
	}

    private function prepareAction($action)
    {
        if (!$action) {
            $action = 'index';
        }
        
        return $action;
    }

    private function prepareController($controller)
    {
        if (!$controller) {
            $controller = 'index';
        }

        return $controller;
    }
}
